<?php
include("includes/config.php");
session_start();
if (!isset($_SESSION['nama_lengkap'])) {
  echo "<script>location.href='login.php'</script>";
}
$config = new Config();
$db = $config->getConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilihan Dosen Terbaik</title>
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
    <link type="text/css" rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/css/jquery.toastmessage.css"/>
    <link type="text/css" rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/css/sweetalert.css">
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <div class="navbar-header">
              <button type="button" class="navbar-atas collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
              <?php if ($_SESSION["role"] == "kepegawaian"): ?>
                  <li role="presentation"><a href="data-alternatif.php">Pegawai</a></li>
              <?php endif; ?>

              <?php if ($_SESSION["role"] == "atasan"): ?>
                  <li role="presentation"><a href="nilai.php">Skala Dasar AHP</a></li>
                  <li role="presentation"><a href="data-kriteria.php">Kriteria</a></li>
                  <li role="presentation"><a href="data-alternatif.php">Alternatif</a></li>
                  <li role="presentation"><a href="nilai-awal.php">Nilai Awal</a></li>
              <?php endif; ?>

              <?php if ($_SESSION["role"] == "atasan"): ?>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perbandingan <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <li role="presentation"><a href="analisa-kriteria.php">Kriteria</a></li>
                          <li role="presentation"><a href="analisa-alternatif.php">Alternatif</a></li>
                      </ul>
                  </li>
              <?php endif; ?>
              <?php if ($_SESSION["role"] == "atasan" OR $_SESSION["role"] == "manajer"): ?>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li role="presentation"><a href="hasil-akhir.php">Hasil Akhir</a></li>
                        <li role="presentation"><a href="ranking.php">Rangking</a></li>
                      </ul>
                  </li>
              <?php endif; ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle text-red text-bold" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$_SESSION["nama_lengkap"]?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="profil.php">Profil</a></li>
                      <?php if ($_SESSION["role"] == "kepegawaian"): ?>
                          <li><a href="user.php">Manejer Pengguna</a></li>
                      <?php endif; ?>
                      <li role="separator" class="divider"></li>
                      <li><a href="logout.php">Logout</a></li>
                  </ul>
              </li>
          </ul>
          </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
  </nav>
