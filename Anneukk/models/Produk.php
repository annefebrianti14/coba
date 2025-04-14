<?php
require_once 'config/database.php';

class Produk {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Ambil semua data produk
    public function getAllProduk() {
        $query = "SELECT * FROM produk";
        $result = $this->db->conn->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil produk berdasarkan ProdukID
    public function getProdukById($id) {
        $query = "SELECT * FROM produk WHERE ProdukID = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Kembalikan data produk sebagai array asosiatif
    }

    // Tambah produk baru
    public function addProduk($nama, $harga, $kategori, $stok, $gambar) {
        $query = "INSERT INTO produk (NamaProduk, HargaSatuan, Kategori, Stok, Gambar_Produk) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("sdsis", $nama, $harga, $kategori, $stok, $gambar);
        return $stmt->execute();
    }

    // Ubah data produk
    public function updateProduk($id, $nama, $harga, $kategori, $stok, $gambar = null) {
        if ($gambar) {
            $query = "UPDATE produk SET NamaProduk = ?, HargaSatuan = ?, Kategori = ?, Stok = ?, Gambar_Produk = ? WHERE ProdukID = ?";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bind_param("sdsisi", $nama, $harga, $kategori, $stok, $gambar, $id);
        } else {
            $query = "UPDATE produk SET NamaProduk = ?, HargaSatuan = ?, Kategori = ?, Stok = ? WHERE ProdukID = ?";
            $stmt = $this->db->conn->prepare($query);
            $stmt->bind_param("sdsii", $nama, $harga, $kategori, $stok, $id);
        }
        return $stmt->execute();
    }

    // Hapus produk berdasarkan ProdukID
    public function deleteProduk($id) {
        $query = "DELETE FROM produk WHERE ProdukID = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>