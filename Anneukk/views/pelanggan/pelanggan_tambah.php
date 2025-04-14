<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <!-- Memasukkan link CSS Bootstrap dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua7Kw1TIq0g8gHJwH7qKddr2DlHnZYzZXs5VxOS2bfsg72mTpGGvL1nXr" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Pelanggan</h1>
        <form action="index.php?action=pelanggan_store" method="post">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" id="telepon" name="telepon" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </form>
        <a href="index.php?action=pelanggan_list" class="btn btn-secondary btn-block mt-3">Kembali ke Daftar Pelanggan</a>
    </div>

    <!-- Memasukkan script JS Bootstrap dari CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy/6t7H5dbb5oFq2RxHhF4SzDgsdPndt4G11kNf6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0g8gHJwH7qKddr2DlHnZYzZXs5VxOS2bfsg72mTpGGvL1nXr" crossorigin="anonymous"></script>
</body>
</html>