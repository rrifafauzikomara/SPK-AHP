<?php
include_once('includes/header.inc.php');
include_once('includes/kriteria.inc.php');

$pro = new Kriteria($db);
$stmt = $pro->readAll();
$count = $pro->countAll();

if (isset($_POST['hapus-contengan'])) {
    $imp = "('".implode("','", array_values($_POST['checkbox']))."')";
    $result = $pro->hapusell($imp);
    if ($result) { ?>
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
  	  <li class="active">Data Kriteria</li>
  	</ol>
    <form method="post">
    	<div class="row">
    		<div class="col-md-6 text-left">
    			<strong style="font-size:18pt;"><span class="fa fa-bank"></span> Data Kriteria</strong>
    		</div>
    		<div class="col-md-6 text-right">
          <div class="btn-group">
            <button type="submit" name="hapus-contengan" class="btn btn-danger"><span class="fa fa-close"></span> Hapus Contengan</button>
      			<button type="button" onclick="location.href='data-kriteria-baru.php'" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</button>
          </div>
    		</div>
    	</div>
    	<br/>
    	<table width="100%" class="table table-striped table-bordered" id="tabeldata">
          <thead>
            <tr>
              <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
              <th>ID Kriteria</th>
              <th>Nama Kriteria</th>
              <th>Bobot Kriteria</th>
              <th width="100px">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
                <th>ID Kriteria</th>
                <th>Nama Kriteria</th>
                <th>Bobot Kriteria</th>
                <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php $no=1; while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :  ?>
              <tr>
                <td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row['id_kriteria'] ?>" name="checkbox[]" /></td>
                <td style="vertical-align:middle;"><?php echo $row['id_kriteria'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_kriteria'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['bobot_kriteria'] ?></td>
                <td style="text-align:center;vertical-align:middle;">
                  <a href="data-kriteria-ubah.php?id=<?php echo $row['id_kriteria'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                  <a href="data-kriteria-hapus.php?id=<?php echo $row['id_kriteria'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
    </form>
  </div>
</div>
<?php include_once('includes/footer.inc.php'); ?>
