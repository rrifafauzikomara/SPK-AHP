<?php include("includes/header.inc.php"); ?>
    <div id="container" class="container">
			<?php
			include_once('includes/alternatif.inc.php');
			$pro1 = new Alternatif($db);
			$stmt1 = $pro1->readAll();
			$stmt1x = $pro1->readAll();
			$stmt1y = $pro1->readAll();

			include_once('includes/bobot.inc.php');
			$pro2 = new Bobot($db);
			$stmt2 = $pro2->readAll();
			$stmt2x = $pro2->readAll();
			$stmt2y = $pro2->readAll();
			$stmt2yx = $pro2->readAll();

			include_once('includes/ranking.inc.php');
			$pro = new Ranking($db);
			$stmt = $pro->readKhusus();
			$stmtx = $pro->readKhusus();
			$stmty = $pro->readKhusus();
			?>

			<br/>
			<div>
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#rangking" aria-controls="rangking" role="tab" data-toggle="tab">Laporan Perangkingan</a></li>
					<li role="presentation" style="cursor: pointer;"><a id="cetak" role="tab">Cetak Laporan 1 (PrintMe)</a></li>
					<li role="presentation"><a href="laporan-cetak.php" role="tab">Cetak Laporan 2 (FPDF)</a></li>
					<li role="presentation" style="cursor: pointer;"><a onClick ="$('#container').tableExport({type:'png',escape:'false'});" role="tab">Cetak Laporan 3 (tableExport)</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="rangking">
					<br/>

					<h4>Nilai Alternatif Kriteria</h4>
					<table width="100%" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th rowspan="2" style="vertical-align: middle" class="text-center">Alternatif</th>
								<th colspan="<?php echo $stmt2x->rowCount(); ?>" class="text-center">Kriteria</th>
							</tr>
							<tr>
							<?php while ($row2x = $stmt2x->fetch(PDO::FETCH_ASSOC)): ?>
								<th><?php echo $row2x['nama_kriteria'] ?><br/>(<?php //echo $row2x['tipe_kriteria'] ?>)</th>
							<?php endwhile; ?>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>Bobot</th>
								<?php while ($row2y = $stmt2y->fetch(PDO::FETCH_ASSOC)){ ?>
									<td>
										<?php //echo $row2y['hasil_bobot']; ?>
									</td>
								<?php } ?>
							</tr>
							<?php while ($row1x = $stmt1x->fetch(PDO::FETCH_ASSOC)){ ?>
								<tr>
									<th><?php echo $row1x['nama_alternatif'] ?></th>
									<?php $ax= $row1x['id_alternatif']; $stmtrx = $pro->readR($ax, ""); while ($rowrx = $stmtrx->fetch(PDO::FETCH_ASSOC)){ ?>
										<td>
										<?=$rowrx['nilai_rangking']?>
										</td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>

					<h4>Perangkingan Metode Weighted Product</h4>
						<table width="100%" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th rowspan="2" style="vertical-align: middle" class="text-center">Alternatif</th>
									<th colspan="<?php echo $stmt2->rowCount(); ?>" class="text-center">Kriteria</th>
									<th rowspan="2" style="vertical-align: middle" class="text-center">Vektor S</th>
									<th rowspan="2" style="vertical-align: middle" class="text-center">Vektor V</th>
								</tr>
								<tr>
								<?php while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
									<th><?php echo $row2['nama_kriteria'] ?></th>
								<?php endwhile; ?>
								</tr>
							</thead>
							<tbody>
							<?php while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)): ?>
								<tr>
									<th><?php echo $row1['nama_alternatif'] ?></th>
									<?php
									$a= $row1['id_alternatif'];
									$stmtr = $pro->readR($a);
									while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) :
										$b = $rowr['id_kriteria'];
										$tipe = $rowr['tipe_kriteria'];
										$bobot = $rowr['hasil_bobot'];
									?>
									<td>
										<?php
										if ($tipe=='benefit') {
										echo $nor = pow($rowr['nilai_rangking'],$bobot);
										} else {
										echo $nor = pow($rowr['nilai_rangking'],-$bobot);
										}

										$pro->ia = $a;
										$pro->ik = $b;
										$pro->nn4 = $nor;
										$pro->normalisasi1();
										?>
									</td>
								<?php endwhile; ?>
									<td>
										<?php
										$stmthasil = $pro->readHasil1($a);
										$hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
										echo $hasil['bbn'];
										$pro->has1 = $hasil['bbn'];
										$pro->hasil1();
										?>
									</td>
									<td>
										<?php
										$stmtmax = $pro->readMax();
										$maxnr = $stmtmax->fetch(PDO::FETCH_ASSOC);
										echo $hasil['bbn']/$maxnr['mnr1'];
										$pro->has2 = $hasil['bbn']/$maxnr['mnr1'];
										$pro->hasil2();
										?>
									</td>
								</tr>
							<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
	<footer class="text-center">&copy; 2015</footer>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-printme.js"></script>
    <script>
    	$('#cetak').click(function() {

    		$("#rangking").printMe({ "path": "css/bootstrap.min.css", "title": "LAPORAN HASIL AKHIR" });

		});
    </script>
    <script type="text/javascript" src="js/tableExport.js"></script>
	<script type="text/javascript" src="js/jquery.base64.js"></script>
	<script type="text/javascript" src="js/html2canvas.js"></script>
	<script type="text/javascript" src="js/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="js/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="js/jspdf/libs/base64.js"></script>
  </body>
</html>
