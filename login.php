<?php
include_once 'includes/config.php';

$config = new Config();
$db = $config->getConnection();

if ($_POST) {
    include_once 'includes/login.inc.php';
    $login = new Login($db);
    $login->userid = $_POST['username'];
    $login->passid = md5($_POST['password']);
    if ($login->login()) {
        echo "<script>location.href='index.php'</script>";
    } else {
        $msg = "Username / Password tidak sesuai!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemilihan Pegawai Terbaik</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <link rel="stylesheet" href="assets/css/tampilan.css">
    <link rel="stylesheet" href="assets/css/st.css">
</head>
<body>
<div class="konten">
        <div class="row">
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                <div class="panel panel-dark login-box">
                    <div 
                        class="panel-heading">
                            <h3 class="text-center">LOGIN</h3></div>
                            <div class="panel-body">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" autofocus="on">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                     
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-dark raised btn-block">Login</button>
                            <br>
                       
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5"></div>
        </div>
    </div>

    
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
	<?php if (isset($msg)): ?>
    <script type="text/javascript">
		swal({
            title: "Maaf!",
            text: "<?=$msg?>",
            type: "error",
            timer: 2000,
            confirmButtonColor: "#DD6B55"
		})
	</script>
	<?php endif; ?>
</body>
</html>
