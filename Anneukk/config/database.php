<?php
class Database {
    private $host = "localhost";
    private $user = "root";  // Sesuaikan dengan user MySQL Anda
    private $pass = "";  // Sesuaikan dengan password MySQL Anda
    private $db_name = "KlmpkFdln";  // Ganti dengan nama database Anda
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function close() {
        $this->conn->close();
    }
}
?>