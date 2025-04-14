<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Pelanggan</h1>
        <div class="mb-3 text-end">
            <a href="index.php?action=pelanggan_create" class="btn btn-primary">Tambah Pelanggan</a>
        </div>

        <!-- Tabel Daftar Pelanggan -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pelangganList as $pelanggan): ?>
                <tr>
                    <td><?= $pelanggan['PelangganID']; ?></td>
                    <td><?= $pelanggan['Nama']; ?></td>
                    <td><?= $pelanggan['Alamat']; ?></td>
                    <td><?= $pelanggan['Telepon']; ?></td>
                    <td><?= $pelanggan['Email']; ?></td>
                    <td>
                        <a href="index.php?action=pelanggan_edit&id=<?= $pelanggan['PelangganID']; ?>" class="btn btn-warning btn-sm">Ubah</a> 
                        <a href="index.php?action=pelanggan_destroy&id=<?= $pelanggan['PelangganID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">Hapus</a>
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