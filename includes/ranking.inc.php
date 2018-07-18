<?php
class Ranking {
	private $conn;
	private $table_name = "ranking";

	public $ia;
	public $ik;
	public $nn;
	public $nn2;
	public $nn3;
	public $nn4;
	public $mnr1;
	public $mnr2;
	public $has1;
	public $has2;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO ".$this->table_name." VALUES(?,?,?,'')";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);
		$stmt->bindParam(3, $this->nn);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM ".$this->table_name;
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		return $stmt;
	}

	function readBob() {
		$query = "SELECT * FROM data_kriteria";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function countAll(){
		$query = "SELECT * FROM ".$this->table_name;
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readKhusus(){

		$query = "SELECT * FROM data_alternatif a, data_kriteria b, data_rangking c where a.id_alternatif=c.id_alternatif and b.id_kriteria=c.id_kriteria order by a.id_alternatif asc";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readR($a,$b){
		$query = "SELECT * FROM jum_alt_kri where id_kriteria='$b' and id_alternatif='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readMax($a){
		$query = "SELECT sum(skor_alt_kri) as mnr1 FROM jum_alt_kri where id_kriteria='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		return $stmt;
	}

	function readMax2(){

		$query = "SELECT sum(hasil_akhir) as mnr2 FROM data_alternatif";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readHasil1($a){

		$query = "SELECT sum(hasil_alt_kri) as bbn FROM jum_alt_kri WHERE id_alternatif='$a' LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readHasil2($a){

		$query = "SELECT hasil_akhir FROM data_alternatif WHERE id_alternatif='$a' LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	// used when filling up the update product form
	function readOne(){

		$query = "SELECT * FROM " . $this->table_name . " WHERE id_alternatif=? and id_kriteria=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->ia = $row['id_alternatif'];
		$this->ik = $row['id_kriteria'];
		$this->nn = $row['nilai_rangking'];
	}

	// update the product
	function update(){

		$query = "UPDATE
					" . $this->table_name . "
				SET
					nilai_rangking = :nn
				WHERE
					id_alternatif = :ia
				AND
					id_kriteria = :ik";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn', $this->nn);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function normalisasi1(){

		$query = "UPDATE jum_alt_kri
				SET
					hasil_alt_kri = :nn4
				WHERE
					id_alternatif = :ia
				AND
					id_kriteria = :ik";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn4', $this->nn4);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function hasil1(){

		$query = "UPDATE
					data_alternatif
				SET
					hasil_akhir = :has1
				WHERE
					id_alternatif = :ia";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':has1', $this->has1);
		$stmt->bindParam(':ia', $this->ia);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	// delete the product
	function delete(){

		$query = "DELETE FROM " . $this->table_name . " WHERE id_alternatif = ? and id_kriteria = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>
