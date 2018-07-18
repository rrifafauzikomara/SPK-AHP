<?php
include("includes/header.inc.php");

include_once("includes/user.inc.php");
$pro = new User($db);
$stmt = $pro->readAll();
$count = $pro->countAll();

if (isset($_POST['hapus-contengan'])) {
  $imp = "('".implode("','",array_values($_POST['checkbox']))."')";
  $result = $pro->hapusell($imp);
  if($result){ ?>
    <script type="text/javascript">
      window.onload=function(){
          showSuccessToast();
          setTimeout(function(){
              window.location.reload(1);
              history.go(0)
              location.href = location.href
          }, 5000);
      };
    </script> <?php
  } else { ?>
    <script type="text/javascript">
      window.onload=function(){
          showErrorToast();
          setTimeout(function(){
              window.location.reload(1);
              history.go(0)
              location.href = location.href
          }, 5000);
      };
    </script> <?php
  }
}
?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
  	<ol class="breadcrumb">
  	  <li><a href="index.php">Beranda</a></li>
  	  <li class="active">Data Pengguna</li>
  	</ol>
    <form method="post">
      <div class="row">
        <div class="col-md-6 text-left">
          <strong style="font-size:18pt;"><span class="fa fa-users"></span> Data Pengguna</strong>
        </div>
        <div class="col-md-6 text-right">
          <div class="btn-group">
            <button type="submit" name="hapus-contengan" class="btn btn-danger">Hapus Contengan</button>
            <button type="button" onclick="location.href='user-baru.php'" class="btn btn-primary">Tambah Data</button>
          </div>
        </div>
      </div>
      <br/>
      <table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <thead>
          <tr>
            <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
            <th>Nama Lengkap</th>
            <th>Role</th>
            <th>Username</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
            <th>Nama Lengkap</th>
            <th>Role</th>
            <th>Username</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
        <tbody>
          <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
              <td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row['id_pengguna'] ?>" name="checkbox[]" /></td>
        	    <td style="vertical-align:middle;"><?php echo $row['nama_lengkap'] ?></td>
        	    <td style="vertical-align:middle;"><?php echo $row['role'] ?></td>
        	    <td style="vertical-align:middle;"><?php echo $row['username'] ?></td>
              <td class="text-center" style="vertical-align:middle;">
                <div class="btn-group">
                  <?php if ($row["role"] == "kepegawaian"): ?>
              		  <a href="user-ubah.php?id=<?php echo $row['id_pengguna'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                  <?php else: ?>
                    <a href="user-ubah.php?id=<?php echo $row['id_pengguna'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a href="user-hapus.php?id=<?php echo $row['id_pengguna'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                  <?php endif; ?>
                </div>
        	    </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </form>
  </div>
</div>

<?php include("includes/footer.inc.php"); ?>
