<?php
class Nilai {
	private $conn;
	private $table_name = "nilai";

	public $id;
	public $jm;
	public $kt;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES('',?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->jm);
		$stmt->bindParam(2, $this->kt);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_nilai ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function countAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_nilai ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_name} WHERE id_nilai=? LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $row['id_nilai'];
		$this->jm = $row['jum_nilai'];
		$this->kt = $row['ket_nilai'];
	}

	// update the product
	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					jum_nilai = :jm,
					ket_nilai = :kt
				WHERE
					id_nilai = :id";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':jm', $this->jm);
		$stmt->bindParam(':kt', $this->kt);
		$stmt->bindParam(':id', $this->id);

		// execute the query
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	// delete the product
	function delete() {
		$query = "DELETE FROM {$this->table_name} WHERE id_nilai = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function hapusell($ax) {
		$query = "DELETE FROM {$this->table_name} WHERE id_nilai in $ax";
		$stmt = $this->conn->prepare($query);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
