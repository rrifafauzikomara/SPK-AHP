<?php
class NilaiAwal {
	private $conn;
	private $table_name = "nilai_awal";

	public $id;
	public $id_alternatif;
	public $nilai;
	public $keterangan;
	public $periode;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(NULL,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_alternatif);
		$stmt->bindParam(2, $this->nilai);
		$stmt->bindParam(3, $this->keterangan);
		$stmt->bindParam(4, $this->periode);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_nilai_awal ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_name} WHERE id_nilai_awal=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $row['id_nilai_awal'];
		$this->id_alternatif = $row['id_alternatif'];
		$this->nilai = $row['nilai'];
		$this->keterangan = $row['keterangan'];
		$this->periode = $row['periode'];
	}

	function readByAlternatif() {
		$query = "SELECT * FROM {$this->table_name} WHERE id_alternatif=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_alternatif);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			$this->id = $row['id_nilai_awal'];
			$this->id_alternatif = $row['id_alternatif'];
			$this->nilai = $row['nilai'];
			$this->keterangan = $row['keterangan'];
			$this->periode = $row['periode'];
		} else {
			$this->id = false;
		}
	}

	function getRange($n) {
	  if ($n >= 75 AND $n <= 100) {
	    return "B";
	  } else if ($n > 64 AND $n <= 74) {
	    return "C";
	  } else {
	    return "K";
	  }
	}

	function countAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_nilai_awal ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->rowCount();
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					id_alternatif = :id_alternatif,
					nilai = :nilai,
					keterangan = :keterangan,
					periode = :periode
				WHERE
					id_nilai_awal = :id";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_alternatif', $this->id_alternatif);
		$stmt->bindParam(':nilai', $this->nilai);
		$stmt->bindParam(':keterangan', $this->keterangan);
		$stmt->bindParam(':periode', $this->periode);

		// execute the query
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	// delete the product
	function delete() {
		$query = "DELETE FROM {$this->table_name} WHERE id_nilai_awal=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function hapusell($ax) {
		$query = "DELETE FROM {$this->table_name} WHERE id_nilai_awal in $ax";
		$stmt = $this->conn->prepare($query);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
