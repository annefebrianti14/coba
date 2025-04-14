<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Produk</h1>
        
        <div class="mb-3 text-end">
            <a href="index.php?action=tambah" class="btn btn-primary">Tambah Produk</a>
        </div>

        <!-- Tabel Daftar Produk -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga Satuan</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Gambar Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produk as $p): ?>
                <tr>
                    <td><?= $p['ProdukID']; ?></td>
                    <td><?= $p['NamaProduk']; ?></td>
                    <td>Rp <?= number_format($p['HargaSatuan'], 2, ',', '.'); ?></td>
                    <td><?= $p['Kategori']; ?></td>
                    <td><?= $p['Stok']; ?></td>
                    <td>
                        <?php if (!empty($p['Gambar_Produk'])): ?>
                            <img src="uploads/<?= $p['Gambar_Produk']; ?>" alt="Gambar Produk" style="width: 70px; height: 70px; object-fit: cover; border-radius: 5px;">
                        <?php else: ?>
                            <p>No Image</p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?action=ubah&id=<?= $p['ProdukID']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                        <a href="index.php?action=hapus&id=<?= $p['ProdukID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>