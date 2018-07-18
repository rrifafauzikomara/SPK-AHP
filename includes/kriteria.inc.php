<?php
class Kriteria {
	private $conn;
	private $table_name = "data_kriteria";

	public $id;
	public $nama;
	public $bobot;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(?, ?, 0, 0)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->bindParam(2, $this->nama);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function getNewID() {
		$query = "SELECT id_kriteria FROM {$this->table_name} ORDER BY id_kriteria DESC LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount()) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$pcs = explode("C", $row['id_kriteria']);
			$result = "C".($pcs[1]+1);
		} else {
			$result = "C1";
		}
		return $result;
	}

	function readAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_kriteria ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function countAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_kriteria ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_name} WHERE id_kriteria=? LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $row['id_kriteria'];
		$this->nama = $row['nama_kriteria'];
		$this->bobot = $row['bobot_kriteria'];
	}

	function readSatu($a) {
		$query = "SELECT * FROM {$this->table_name} WHERE id_kriteria='$a' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					nama_kriteria = :nama
				WHERE
					id_kriteria = :id";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':nama', $this->nama);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete() {
		$query = "DELETE FROM {$this->table_name} WHERE id_kriteria=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function hapusell($ids) {
		$query = "DELETE FROM {$this->table_name} WHERE id_kriteria IN $ids";
		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
