<?php
class Skor {
	private $conn;
	private $table_name = "analisa_alternatif";

	public $kp;
	public $nak;
	public $hak;
	public $kk;
	public $bb;
	public $kri;
	public $jak;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert($a,$b,$c,$d) {
		$query = "INSERT INTO {$this->table_name} VALUES('$a','$b','','$c','$d')";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert2($a, $b, $c, $d) {
		$query = "UPDATE {$this->table_name} SET hasil_analisa_alternatif = '$a' WHERE alternatif_pertama = '$b' AND alternatif_kedua = '$c' AND id_kriteria='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert3($a, $b, $c) {
		$query = "INSERT INTO jum_alt_kri VALUES('$a', '$b', $c, 0, 0)";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert4($a, $b, $c) {
		$query = "UPDATE jum_alt_kri SET skor_alt_kri='$a' WHERE id_alternatif='$b' AND id_kriteria='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert5($a, $b, $c) {
		$query = "UPDATE jum_alt_kri SET jumlah_alt_kri='$a' WHERE id_alternatif='$b' AND id_kriteria='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM data_alternatif";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAlternatif($a) {
		$query = "SELECT * FROM data_alternatif WHERE id_alternatif='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAll1($a, $b, $c) {
		$query = "SELECT * FROM {$this->table_name} WHERE alternatif_pertama='$a' AND alternatif_kedua='$b' AND id_kriteria='$c' LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->kp = $row['nilai_analisa_alternatif'];
	}

	function readAll2() {
		$query = "SELECT * FROM data_alternatif";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAll3($a, $b) {
		$query = "SELECT * FROM jum_alt_kri WHERE id_alternatif='$a' AND id_kriteria='$b' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->jak = $row['jumlah_alt_kri'];
	}

	function countAll() {
		$query = "SELECT * FROM data_alternatif";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readSum1($a, $b) {
		$query = "SELECT sum(nilai_analisa_alternatif) AS jumkr FROM {$this->table_name} WHERE alternatif_kedua='$a' AND id_kriteria='$b' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['jumkr'];
	}

	function readSum2($a, $b) {
		$query = "SELECT sum(hasil_analisa_alternatif) AS jumkr2 FROM {$this->table_name} WHERE alternatif_kedua='$a' AND id_kriteria='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['jumkr2'];
	}

	function readSum3($a) {
		$query = "SELECT sum(skor_alt_kri) AS bbkr FROM jum_alt_kri WHERE id_kriteria='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->bb = $row['bbkr'];
	}

	function readSum4($a) {
		$query = "SELECT sum(skor_alt_kri) AS bbkr FROM jum_alt_kri WHERE id_kriteria='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->bb = $row['bbkr'];
	}

	function readAvg($a) {
		$query = "SELECT avg(hasil_analisa_alternatif) AS avgkr FROM {$this->table_name} WHERE alternatif_pertama = '$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['avgkr'];
	}

	function readKri($a) {
		$query = "SELECT * FROM data_kriteria WHERE id_kriteria='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->kri = $row['nama_kriteria'];
	}

	function update($a,$b,$c,$d) {
		$query = "UPDATE  ".$this->table_name."  SET nilai_analisa_alternatif = '$b' WHERE alternatif_pertama = '$a' and alternatif_kedua = '$c' and id_kriteria = '$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete() {
		$query = "DELETE FROM " . $this->table_name;
		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
