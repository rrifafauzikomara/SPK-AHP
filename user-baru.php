<?php
include_once('includes/header.inc.php');

if ($_POST) {
  include_once('includes/user.inc.php');
  $eks = new User($db);
  $eks->nl = $_POST['nl'];
  $eks->rl = $_POST['rl'];
  $eks->un = $_POST['un'];
  $eks->pw = md5($_POST['pw']);

  if ($eks->pw == md5($_POST['up'])) {
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
  } else { ?>
    <script type="text/javascript">
      window.onload=function(){
        showStickyWarningToast();
      };
    </script> <?php
  }
}
?>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
	  <ol class="breadcrumb">
		  <li><a href="index.php">Beranda</a></li>
		  <li><a href="user.php">Data Pengguna</a></li>
		  <li class="active">Tambah Data</li>
		</ol>
  	<p style="margin-bottom:10px;">
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Pengguna</strong>
  	</p>
    <div class="panel panel-default">
      <div class="panel-body">
        <form method="post">
          <div class="form-group">
            <label for="nl">Nama Lengkap</label>
            <input type="text" class="form-control" id="nl" name="nl" required>
          </div>
          <div class="form-group">
            <label for="rl">Role</label>
            <select class="form-control" name="rl" id="rl" required>
              <option value="">----</option>
              <option value="atasan">Atasan</option>
              <option value="kepegawaian">Kepegawaian</option>
              <option value="manajer">Manajer</option>
            </select>
          </div>
          <div class="form-group">
            <label for="un">Username</label>
            <input type="text" class="form-control" id="un" name="un" required>
          </div>
          <div class="form-group">
            <label for="pw">Password</label>
            <input type="password" class="form-control" id="pw" name="pw" required>
          </div>
          <div class="form-group">
            <label for="up">Ulangi Password</label>
            <input type="password" class="form-control" id="up" name="up" required>
          </div>
          <div class="btn-group">
            <button type="submit" class="btn btn-dark">Simpan</button>
      		  <button type="button" onclick="location.href='user.php'" class="btn btn-default">Kembali</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('includes/footer.inc.php'); ?>
