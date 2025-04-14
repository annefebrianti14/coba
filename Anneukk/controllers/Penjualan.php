<?php
class PenjualanController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Menampilkan daftar penjualan
    public function index()
    {
        $sql = "SELECT * FROM penjualan";
        $result = $this->db->query($sql);
        $penjualanList = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $penjualant[] = $row;
            }
        }
        include 'views/penjualan/penjualan_list.php';
    }

    // Menampilkan form untuk menambah penjualan
    public function create()
    {
        include 'views/penjualan/penjualan_tambah.php'; // Memanggil form tambah penjualan
    }

    // Menyimpan penjualan baru ke database
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $email = $_POST['email'];

            $sql = "INSERT INTO penjualan (Nama, Alamat, Telepon, Email) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssss", $nama, $alamat, $telepon, $email);

            if ($stmt->execute()) {
                // Redirect ke halaman daftar penjualan setelah berhasil disimpan
                header("Location: index.php?action=penjualan_list");
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }

    // Menampilkan form untuk mengedit penjualan
    public function edit($penjualanID)
    {
        $sql = "SELECT * FROM penjualan WHERE PenjualanID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $penjualanID);
        $stmt->execute();
        $result = $stmt->get_result();
        $pelanggan = $result->fetch_assoc();
        include 'views/penjualan/penjualan_ubah.php';
    }

    // Mengupdate data penjualan
    public function update($penjualanID)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pastikan semua inputan ada
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $email = $_POST['email'];

            // Validasi input
            if (empty($nama) || empty($alamat) || empty($telepon) || empty($email)) {
                echo "All fields are required!";
                return;
            }

            // Update data penjualan
            $sql = "UPDATE penjualan SET Nama = ?, Alamat = ?, Telepon = ?, Email = ? WHERE PenjualanID = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssi", $nama, $alamat, $telepon, $email, $penjualanID);

            if ($stmt->execute()) {
                // Redirect ke halaman daftar penjualan setelah berhasil diperbarui
                header("Location: index.php?action=penjualan_list");
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }

    // Menghapus data pelanggan
    public function destroy($penjualanID)
    {
        // Hapus semua data penjualan yang terkait dengan pelanggan terlebih dahulu
        $sql = "DELETE FROM penjualan WHERE PelangganID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $penjualanID);
        $stmt->execute();
    
        // Setelah data penjualan terhapus, baru hapus pelanggan
        $sql = "DELETE FROM pelanggan WHERE PelangganID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $penjualanID);
        
        if ($stmt->execute()) {
            header("Location: index.php?action=pelanggan_list");
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?> 