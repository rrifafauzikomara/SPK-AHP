<?php
class Login {
    private $conn;
    private $table_name = "pengguna";

    public $user;
    public $userid;
    public $passid;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $user = $this->checkCredentials();
        if ($user) {
            $this->user = $user;
            session_start();
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['id_pengguna'] = $user['id_pengguna'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            return $user['nama_lengkap'];
        }
        return false;
    }

    protected function checkCredentials() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_name.' WHERE username=? and password=? ');
        $stmt->bindParam(1, $this->userid);
        $stmt->bindParam(2, $this->passid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->passid;
            if ($submitted_pass == $data['password']) {
                return $data;
            }
        }
        return false;
    }

    public function getUser() {
        return $this->user;
    }
}
