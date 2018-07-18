<?php
include_once('includes/header.inc.php');
include_once('includes/skor.inc.php');
include_once('includes/alternatif.inc.php');
include_once('includes/kriteria.inc.php');
include_once('includes/nilai.inc.php');

$altObj = new Alternatif($db);
$skoObj = new Skor($db);
$kriObj = new Kriteria($db);
$nilObj = new Nilai($db);

$altCount = $altObj->countByFilter();

$no = 1; $r = []; $nid = [];
$alt1 = $altObj->readByFilter();
while ($row = $alt1->fetch(PDO::FETCH_ASSOC)){
	$alt2 = $altObj->readByFilter();
	while ($roww = $alt2->fetch(PDO::FETCH_ASSOC)) {
		$nid[$row['id_alternatif']][] = $roww['id_alternatif'];
	}
	$total = $altCount-$no;
	if ($total>=1) {
		$r[$row['id_alternatif']] = $total;
	}
	$no++;
}

$ni=1;
foreach ($nid as $key => $value) {
	array_splice($nid[$key], 0, $ni++);
}
$ne = count($nid)-1;
array_splice($nid, $ne, 1);
?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php">Beranda</a></li>
			<li class="active">Analisa Alternatif</li>
			<li><a href="#" data-toggle="modal" data-target="#myModalalt">Tabel Analisa Alternatif</a></li>
		</ol>
		<table width="100%" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th width="50px"></th>
					<th width="50px">No</th>
					<th>ID</th>
					<th>Nama</th>
					<th>Nilai</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; $alt1a = $altObj->readByFilter(); while($row = $alt1a->fetch(PDO::FETCH_ASSOC)): ?>
					<tr>
						<td class="text-center">
							<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalNilaiDetail" data-id-alternatif="<?=$row["id_alternatif"]?>"><span class="fa fa-eye" aria-hidden="true"></span></button>
						</td>
						<td><?=$no++?></td>
						<td><?=$row["id_alternatif"]?></td>
						<td><?=$row["nama"]?></td>
						<td><?=$row["nilai"]?></td>
						<td><?php
								if ($row['keterangan'] == "B") {
									echo "Baik";
								}elseif($row['keterangan'] == "C"){
									echo "Cukup";
								}else{
									echo "Kurang";
								}
							?></td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>

		<div class="panel panel-default">
			<div class="panel-body">
				<form method="post" action="analisa-alternatif-tabel.php">
					<div class="row">
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<p style="padding:10px 0;"><label>Pilih Kriteria</label></p>
							</div>
						</div>
						<div class="col-xs-12 col-md-9">
							<div class="form-group">
								<select class="form-control" id="kriteria" name="kriteria">
								<?php $kri2 = $kriObj->readAll(); while ($row = $kri2->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?=$row['id_kriteria']?>"><?=$row['nama_kriteria']?></option>
								<?php endwhile; ?>
								</select>
							</div>
						</div>
					</div>
					<hr>
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
						<?php $j=0; for ($i=1; $i<=$v; $i++): ?>
							<?php $rows = $altObj->readSatu($k); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
								<div class="row">
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
											<?php $rows = $skoObj->readAlternatif($k); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
												<input type="text" class="form-control" value="<?=$row['nama']?>" readonly />
												<input type="hidden" name="<?=$k?><?=$no?>" value="<?=$row['id_alternatif']?>" />
											<?php endwhile; ?>
										</div>
									</div>
									<div class="col-xs-12 col-md-6">
										<div class="form-group">
											<select class="form-control" name="nl<?=$no?>">
											<?php $stmt1 = $nilObj->readAll(); while ($row2 = $stmt1->fetch(PDO::FETCH_ASSOC)): ?>
												<option value="<?=$row2['jum_nilai']?>"><?=$row2['jum_nilai']?> - <?=$row2['ket_nilai']?></option>
											<?php endwhile; ?>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-md-3">
										<div class="form-group">
										<?php $rows = $skoObj->readAlternatif($nid[$k][$j]); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
											<input type="text" class="form-control" value="<?=$row['nama']?>" readonly />
											<input type="hidden" name="<?=$nid[$k][$j]?><?=$no?>" value="<?=$row['id_alternatif']?>" />
										<?php endwhile;?>
										</div>
									</div>
								</div>
							<?php endwhile; $no++; $j++;?>
						<?php endfor; ?>
					<?php endforeach; ?>
					<button type="submit" name="submit" class="btn btn-dark"> Selanjutnya <span class="fa fa-arrow-right"></span></button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModalalt" tabindex="-1" role="dialog" aria-labelledby="myModalLabelalt">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabelalt">Pilih Kriteria</h4>
			</div>
			<div class="modal-body">
				<div class="list-group">
					<?php $kri1 = $kriObj->readAll(); while ($row = $kri1->fetch(PDO::FETCH_ASSOC)): ?>
						<a href="analisa-alternatif-tabel.php?kriteria=<?=$row['id_kriteria']?>" class="list-group-item"><?=$row['nama_kriteria']?></a>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalNilaiDetail" tabindex="-1" role="dialog" aria-labelledby="modalNilaiDetailLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalNilaiDetailLabel">Nilai Detail</h4>
			</div>
			<div class="modal-body">
				<p>One fine body&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<?php include_once('includes/footer.inc.php'); ?>
