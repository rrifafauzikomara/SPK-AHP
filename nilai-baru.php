<?php
include_once('includes/header.inc.php');

if ($_POST) {
    include_once 'includes/nilai.inc.php';
    $eks = new Nilai($db);
    $eks->jm = $_POST['jm'];
    $eks->kt = $_POST['kt'];
    if ($eks->insert()) { ?>
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
					  <li><a href="nilai.php">Nilai</a></li>
					  <li class="active">Tambah Data</li>
				</ol>
		  	<p style="margin-bottom:10px;">
			  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Nilai Preferensi</strong>
		  	</p>
	  	<div class="panel panel-default">
					<div class="panel-body">
						<form method="post">
								<div class="form-group">
										<label for="jm">Jumlah Nilai</label>
										<input type="text" class="form-control" id="jm" name="jm" required>
								</div>
								<div class="form-group">
										<label for="kt">Keterangan Nilai</label>
										<input type="text" class="form-control" id="kt" name="kt" required>
								</div>
								<div class="btn-group">
										<button type="submit" class="btn btn-dark">Simpan</button>
										<button type="button" onclick="location.href='nilai.php'" class="btn btn-default">Kembali</button>
								</div>
						</form>
					</div>
			</div>
	  </div>
</div>

<?php include_once('includes/footer.inc.php');?>
