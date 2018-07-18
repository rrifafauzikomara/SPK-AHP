<?php
include_once('includes/header.inc.php');
include_once('includes/alternatif.inc.php');
include_once('includes/kriteria.inc.php');
include_once('includes/ranking.inc.php');

$altObj = new Alternatif($db);

$kriObj = new Kriteria($db);

$ranObj = new Ranking($db);
$stmt = $ranObj->readKhusus();
$stmty = $ranObj->readKhusus();
$count = $ranObj->countAll();
$stmtx1y = $ranObj->readBob();
$stmtx2y = $ranObj->readBob();
?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<br/>

		<h3>Hasil Perankingan</h3>
		<hr>
		<br>
		<?php for ($i=2017; $i<=2018; $i++): ?>
			<h4>Tahun <?=$i?></h4>
			<table width="100%" class="table table-striped table-bordered">
			    <thead>
					<tr>
						<th>NIK</th>
						<th>Nama</th>
						<th>Hasil Akhir</th>
						<th class="success">Ranking</th>
					</tr>
			    </thead>
			    <tbody>
					<?php $altObj->periode = $i; $rank = 1; $alt1c = $altObj->readByRank(); while ($row = $alt1c->fetch(PDO::FETCH_ASSOC)): ?>
				        <tr>
							<td><?=$row["nik"]?></td>
							<td><?=$row["nama"]?></td>
							<td><?=number_format($row["hasil_akhir"], 4, '.', ',')?></td>
							<td class="success"><?=$rank++?></td>
				        </tr>
					<?php endwhile; ?>
			    </tbody>
		  </table>
		  <br>
	  <?php endfor; ?>
	</div>
</div>

<?php include_once('includes/footer.inc.php'); ?>
