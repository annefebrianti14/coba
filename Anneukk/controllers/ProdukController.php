<?php
require_once 'models/Produk.php';

class ProdukController {
    private $produkModel;

    public function __construct() {
        $this->produkModel = new Produk();
    }
    
    public function index() {
        // Mengambil data produk dari model
        $produk = $this->produkModel->getAllProduk();  // Mengambil semua produk dari model
    
        // Jika produk kosong, tampilkan pesan error
        if ($produk === null || empty($produk)) {
            echo "Tidak ada produk yang tersedia";
            return;
        }
    
        // Mengirimkan data produk ke tampilan
        require_once 'views/produk/index.php'; 
    }
    
      // Show the list of products
    public function produkList() {
        // Fetch all products from the model
        $produk = $this->produkModel->getAllProduk();
        
        // Include the produk_list.php view
        require_once 'views/produk/produk_list.php'; 
    }

    // Menambah produk
    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $kategori = $_POST['kategori'];
            $stok = $_POST['stok'];

            // Pastikan kategori diisi
            if (empty($kategori)) {
                echo "Kategori wajib diisi!";
                return;
            }

            // Proses upload gambar
            $gambar = $_FILES['gambar_produk']['name'];
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($gambar);

            if (move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $targetFile)) {
                $this->produkModel->addProduk($nama, $harga, $kategori, $stok, $gambar);
                header("Location: index.php");
                exit();
            } else {
                echo "Upload gambar gagal!";
            }
        } else {
            require_once 'views/produk/produk_tambah.php';
        }
    }

    // Mengubah produk
    public function ubah() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $produk = $this->produkModel->getProdukById($id);  // Ambil data produk berdasarkan ID

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nama = $_POST['nama'];
                $harga = $_POST['harga'];
                $kategori = $_POST['kategori'];
                $stok = $_POST['stok'];

                // Pastikan kategori diisi
                if (empty($kategori)) {
                    echo "Kategori wajib diisi!";
                    return;
                }

                // Periksa apakah ada gambar baru yang diunggah
                $gambar = !empty($_FILES['gambar_produk']['name']) ? $_FILES['gambar_produk']['name'] : $produk['Gambar_Produk'];

                // Proses upload gambar jika ada gambar baru
                if (!empty($_FILES['gambar_produk']['name'])) {
                    $targetDir = "uploads/";
                    $targetFile = $targetDir . basename($gambar);
                    move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $targetFile);
                }

                // Update produk di database
                $this->produkModel->updateProduk($id, $nama, $harga, $kategori, $stok, $gambar);
                header("Location: index.php");
                exit();
            } else {
                require_once 'views/produk/produk_ubah.php';  // Tampilkan form ubah produk
            }
        }
    }    

    // Menghapus produk
    public function hapus() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->produkModel->deleteProduk($id);
            header("Location: index.php");
            exit();
        }
    }

    
}
?>