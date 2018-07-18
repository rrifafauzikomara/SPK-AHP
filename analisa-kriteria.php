<?php
include_once('includes/header.inc.php');
include_once('includes/kriteria.inc.php');
include_once('includes/nilai.inc.php');

$kriteriaObj = new Kriteria($db);
$nilaiObj = new Nilai($db);

$kriteriaCount = $kriteriaObj->countAll();

$r = [];
$kriterias = $kriteriaObj->readAll();
while ($row = $kriterias->fetch(PDO::FETCH_ASSOC)) {
	$kriteriass = $kriteriaObj->readSatu($row['id_kriteria']);
	while ($roww = $kriteriass->fetch(PDO::FETCH_ASSOC)) {
		$pcs = explode("C", $roww['id_kriteria']);
		$c = $kriteriaCount - $pcs[1];
	}
	if ($c>=1) {
		$r[$row['id_kriteria']] = $c;
	}
}
?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php">Beranda</a></li>
			<li class="active">Analisa Kriteria</li>
			<li><a href="analisa-kriteria-tabel.php">Tabel Analisa Kriteria</a></li>
		</ol>
		<p style="margin-bottom:10px;">
			<strong style="font-size:18pt;"><span class="fa fa-bomb"></span> Analisa Kriteria</strong>
		</p>
		<div class="panel panel-default">
			<div class="panel-body">
				<form method="post" action="analisa-kriteria-tabel.php">
					<div class="row">
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<label>Kriteria Pertama</label>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label>Pernilaian</label>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<label>Kriteria Kedua</label>
							</div>
						</div>
					</div>
					<?php $no=1; foreach ($r as $k => $v): ?>
						<?php for ($i=1; $i<=$v; $i++): ?>
							<?php $rows = $kriteriaObj->readSatu($k); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
								<div class="row">
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<?php $rows = $kriteriaObj->readSatu($k); while($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
												<input type="text" class="form-control" value="<?=$row['nama_kriteria'] ?>" readonly />
												<input type="hidden" name="<?=$k?><?=$no?>" value="<?=$row['id_kriteria']?>" />
											<?php endwhile; ?>
										</div>
									</div>
									<div class="col-xs-12 col-md-6">
										<div class="form-group">
											<select class="form-control" name="nl<?=$no?>">
												<?php $rows = $nilaiObj->readAll(); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
													<option value="<?=$row['jum_nilai']?>"><?=$row['jum_nilai']?> - <?=$row['ket_nilai']?></option>
												<?php endwhile; ?>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<?php $pcs = explode("C", $k); $nid = "C".($pcs[1]+$i); ?>
											<?php $rows = $kriteriaObj->readSatu($nid); while($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
												<input type="text" class="form-control" value="<?=$row['nama_kriteria']?>" readonly />
												<input type="hidden" name="<?=$nid?><?=$no?>" value="<?=$row['id_kriteria']?>" />
											<?php endwhile; ?>
										</div>
									</div>
								</div>
							<?php endwhile; $no++; ?>
						<?php endfor; ?>
					<?php endforeach; ?>
					<button type="submit" name="submit" class="btn btn-dark"> Selanjutnya <span class="fa fa-arrow-right"></span></button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include_once('includes/footer.inc.php'); ?>
