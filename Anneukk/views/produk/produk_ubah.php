<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .img-preview {
            display: block;
            margin: 10px auto;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-primary">Ubah Produk</h2>
    <form action="index.php?action=ubah&id=<?= $produk['ProdukID'] ?>" method="POST" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label class="form-label">Nama Produk:</label>
            <input type="text" name="nama" class="form-control" value="<?= $produk['NamaProduk']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Satuan:</label>
            <input type="number" name="harga" class="form-control" value="<?= $produk['HargaSatuan']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori:</label>
            <input type="text" name="kategori" class="form-control" value="<?= $produk['Kategori']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok:</label>
            <input type="number" name="stok" class="form-control" value="<?= $produk['Stok']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Produk:</label>
            <input type="file" name="gambar_produk" class="form-control" onchange="previewImage(event)">
            <img src="uploads/<?= $produk['Gambar_Produk']; ?>" class="img-preview mt-2" id="imagePreview">
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
            <a href="index.php" class="btn btn-secondary">🔙 Kembali</a>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const imgPreview = document.getElementById('imagePreview');
            imgPreview.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>