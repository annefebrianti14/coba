<?php
class PelangganController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Menampilkan daftar pelanggan
    public function index()
    {
        $sql = "SELECT * FROM pelanggan";
        $result = $this->db->query($sql);
        $pelangganList = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $pelangganList[] = $row;
            }
        }
        include 'views/pelanggan/pelanggan_list.php';
    }

    // Menampilkan form untuk menambah pelanggan
    public function create()
    {
        include 'views/pelanggan/pelanggan_tambah.php'; // Memanggil form tambah pelanggan
    }

    // Menyimpan pelanggan baru ke database
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $email = $_POST['email'];

            $sql = "INSERT INTO pelanggan (Nama, Alamat, Telepon, Email) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssss", $nama, $alamat, $telepon, $email);

            if ($stmt->execute()) {
                // Redirect ke halaman daftar pelanggan setelah berhasil disimpan
                header("Location: index.php?action=pelanggan_list");
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }

    // Menampilkan form untuk mengedit pelanggan
    public function edit($pelangganID)
    {
        $sql = "SELECT * FROM pelanggan WHERE PelangganID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $pelangganID);
        $stmt->execute();
        $result = $stmt->get_result();
        $pelanggan = $result->fetch_assoc();
        include 'views/pelanggan/pelanggan_ubah.php';
    }

    // Mengupdate data pelanggan
    public function update($pelangganID)
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

            // Update data pelanggan
            $sql = "UPDATE pelanggan SET Nama = ?, Alamat = ?, Telepon = ?, Email = ? WHERE PelangganID = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssi", $nama, $alamat, $telepon, $email, $pelangganID);

            if ($stmt->execute()) {
                // Redirect ke halaman daftar pelanggan setelah berhasil diperbarui
                header("Location: index.php?action=pelanggan_list");
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }

    // Menghapus data pelanggan
    public function destroy($pelangganID)
    {
        // Hapus semua data penjualan yang terkait dengan pelanggan terlebih dahulu
        $sql = "DELETE FROM penjualan WHERE PelangganID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $pelangganID);
        $stmt->execute();
    
        // Setelah data penjualan terhapus, baru hapus pelanggan
        $sql = "DELETE FROM pelanggan WHERE PelangganID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $pelangganID);
        
        if ($stmt->execute()) {
            header("Location: index.php?action=pelanggan_list");
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?> 