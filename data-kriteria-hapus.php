<?php
include_once("includes/config.php");
$database = new Config();
$db = $database->getConnection();

include_once('includes/kriteria.inc.php');
$pro = new Kriteria($db);
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$pro->id = $id;

if($pro->delete()){
	echo "<script>location.href='data-kriteria.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='data-kriteria.php';</script>";
}
