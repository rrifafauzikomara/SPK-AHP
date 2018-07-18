<?php
class NilaiAwalDetail {
	private $conn;
	private $table_name = "nilai_awal_detail";

	public $id;
	public $id_nilai;
	public $id_kriteria;
	public $nilai;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(NULL,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_nilai);
		$stmt->bindParam(2, $this->id_kriteria);
		$stmt->bindParam(3, $this->nilai);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_nilai_awal_detail ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readAllWithCriteria() {
		$query = "SELECT c.nama_kriteria AS kriteria, b.nilai FROM nilai_awal a JOIN {$this->table_name} b ON a.id_nilai_awal=b.id_nilai_awal JOIN data_kriteria c ON b.id_kriteria=c.id_kriteria WHERE a.id_alternatif=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_name} WHERE id_nilai_awal_detail=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $row['id_nilai_awal_detail'];
		$this->nim = $row['id_nilai'];
		$this->nim = $row['id_kriteria'];
		$this->nilai = $row['nilai'];
	}

	function countAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_nilai_awal_detail ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->rowCount();
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					id_nilai = :id_nilai,
					id_kriteria = :id_kriteria,
					nilai = :nilai
				WHERE
					id_nilai_awal_detail = :id";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_nilai', $this->id_nilai);
		$stmt->bindParam(':id_kriteria', $this->id_kriteria);
		$stmt->bindParam(':nilai', $this->nilai);

		// execute the query
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete() {
		$query = "DELETE FROM {$this->table_name} WHERE id_nilai_awal_detail = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function hapusell($ax) {
		$query = "DELETE FROM {$this->table_name} WHERE id_nilai_awal_detail in $ax";
		$stmt = $this->conn->prepare($query);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
