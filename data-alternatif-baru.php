<?php
include_once('includes/header.inc.php');

include_once('includes/alternatif.inc.php');
$altObj = new Alternatif($db);

if($_POST){
	$altObj->id = $_POST["id_alternatif"];
	$altObj->nik = $_POST["nik"];
	$altObj->nama = $_POST["nama"];
	$altObj->tempat_lahir = $_POST["tempat_lahir"];
	$altObj->tanggal_lahir = $_POST["tanggal_lahir"];
	$altObj->kelamin = $_POST["kelamin"];
	$altObj->alamat = $_POST["alamat"];
	$altObj->jabatan = $_POST["jabatan"];
	$altObj->tanggal_masuk = $_POST["tanggal_masuk"];
	$altObj->pendidikan = $_POST["pendidikan"];

	if($altObj->insert()){ ?>
		<script type="text/javascript">
			window.onload=function(){
				showStickySuccessToast();
			};
		</script> <?php
	} else { ?>
		<script type="text/javascript">
			window.onload=function(){
				showStickyErrorToast();
			};
		</script> <?php
	}
}
?>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
	  <ol class="breadcrumb">
		  <li><a href="index.php">Beranda</a></li>
		  <li><a href="data-alternatif.php">Data Alternatif</a></li>
		  <li class="active">Tambah Data</li>
		</ol>
  	<p style="margin-bottom:10px;">
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Alternatif</strong>
  	</p>
  	<div class="panel panel-default">
			<div class="panel-body">
				    <form method="post">
						  <div class="form-group">
						    <label for="id_alternatif">ID Alternatif</label>
						    <input type="text" class="form-control" id="id_alternatif" name="id_alternatif" required readonly="on" value="<?php echo $altObj->getNewID(); ?>">
						  </div>
							<div class="form-group">
									<label for="nik">Nomor Induk Dosen</label>
									<input type="text" name="nik" id="nik" class="form-control" autofocus="on" required="on">
							</div>
							<div class="form-group">
									<label for="nama">Nama Lengkap</label>
									<input type="text" name="nama" id="nama" class="form-control" required="on">
							</div>
							<div class="form-group">
									<label for="tempat_lahir">Tempat Lahir</label>
									<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required="on">
							</div>
							<div class="form-group">
									<label for="tanggal_lahir">Tanggal Lahir</label>
									<input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control datepicker" required="on">
							</div>
							<div class="form-group">
									<label for="kelamin">Jenis Kelamin</label>
									<select class="form-control" name="kelamin" id="kelamin" required="on">
											<option value="">---</option>
											<option value="Pria">Pria</option>
											<option value="Wanita">Wanita</option>
									</select>
							</div>
							<div class="form-group">
									<label for="alamat">Alamat</label>
									<input type="text" name="alamat" id="alamat" class="form-control" required="on">
							</div>
							<div class="form-group">
									<label for="jabatan">Jabatan</label>
									<input type="text" name="jabatan" id="jabatan" class="form-control" required="on">
							</div>
							<div class="form-group">
									<label for="tanggal_masuk">Tanggal Masuk</label>
									<input type="text" name="tanggal_masuk" id="tanggal_masuk" class="form-control datepicker" required="on">
							</div>
							<div class="form-group">
									<label for="pendidikan">Pendidikan</label>
									<input type="text" name="pendidikan" id="pendidikan" class="form-control" required="on">
							</div>
							<div class="btn-group">
							  <button type="submit" class="btn btn-dark">Simpan</button>
							  <button type="button" onclick="location.href='data-alternatif.php'" class="btn btn-default">Kembali</button>
							</div>
					</form>
			  </div>
		</div>
	</div>
</div>

<?php include_once('includes/footer.inc.php'); ?>
