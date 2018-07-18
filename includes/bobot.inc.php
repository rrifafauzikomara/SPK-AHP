<?php
class Bobot {
	private $conn;
	private $table_name = "analisa_kriteria";

	public $kp;
	public $nak;
	public $hak;
	public $kk;
	public $bb;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert($a, $b, $c) {
		$query = "INSERT INTO {$this->table_name} VALUES('$a', '$b', 0, '$c')";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert2($a, $b, $c) {
		$query = "UPDATE {$this->table_name} SET hasil_analisa_kriteria='$a' WHERE kriteria_pertama='$b' AND kriteria_kedua='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert3($a, $b) {
		$query = "UPDATE data_kriteria SET jumlah_kriteria='$a' WHERE id_kriteria='$b'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert4($a, $b) {
		$query = "UPDATE data_kriteria SET bobot_kriteria='$a' WHERE id_kriteria='$b'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM data_kriteria";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readAll1($a, $b) {
		$query = "SELECT * FROM {$this->table_name} WHERE kriteria_pertama = '$a' AND kriteria_kedua = '$b' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->kp = $row['nilai_analisa_kriteria'];
	}

	function readAll2() {
		$query = "SELECT * FROM data_kriteria";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		return $stmt;
	}

	function countAll() {
		$query = "SELECT * FROM data_kriteria";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readSum1($a) {
		$query = "SELECT sum(nilai_analisa_kriteria) AS jumkr FROM {$this->table_name} WHERE kriteria_kedua='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['jumkr'];
	}

	function getIr($n) {
		switch ($n) {
		case 3:
			$r = 0.58;
			break;
		case 4:
			$r = 0.90;
			break;
		case 5:
			$r = 1.12;
			break;
		case 6:
			$r = 1.24;
			break;
		case 7:
			$r = 1.32;
			break;
		case 8:
			$r = 1.41;
			break;
		case 9:
			$r = 1.45;
			break;
		case 10:
			$r = 1.49;
			break;
		case 11:
			$r = 1.51;
			break;
		case 12:
			$r = 1.48;
			break;
		case 13:
			$r = 1.56;
			break;
		case 14:
			$r = 1.57;
			break;
		case 15:
			$r = 1.59;
			break;

		default:
			$r = 0.00;
			break;
		}
		return $r;
	}

	function readSum2($a) {
		$query = "SELECT sum(hasil_analisa_kriteria) AS jumlah FROM {$this->table_name} WHERE kriteria_pertama='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['jumlah'];
	}

	function readSum3() {
		$query = "SELECT sum(bobot_kriteria) AS bbkr FROM data_kriteria";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->bb = $row['bbkr'];
	}

	function readAvg($a) {
		$query = "SELECT avg(hasil_analisa_kriteria) AS avgkr FROM {$this->table_name} WHERE kriteria_pertama = '$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['avgkr'];
	}

	function update($a, $b, $c) {
		$query = "UPDATE  {$this->table_name} SET nilai_analisa_kriteria = '$b' WHERE kriteria_pertama = '$a' and kriteria_kedua = '$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete() {
		$query = "DELETE FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
