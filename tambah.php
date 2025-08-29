<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h3 class="mb-4">Tambah Produk</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3"><label>Nama Produk</label><input type="text" name="nama" class="form-control" required></div>
            <div class="mb-3"><label>Harga</label><input type="number" name="harga" class="form-control" required></div>
            <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"></textarea></div>
            <div class="mb-3"><label>Kategori</label><input type="text" name="kategori" class="form-control"></div>
            <div class="mb-3"><label>Stok</label><input type="number" name="stok" class="form-control"></div>
            <div class="mb-3"><label>Gambar</label><input type="file" name="gambar" class="form-control" required></div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $desk = $_POST['deskripsi'];
    $kat = $_POST['kategori'];
    $stok = $_POST['stok'];

    // Pastikan folder uploads ada
    $folder = "uploads/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // Upload gambar
    $file = $_FILES['gambar']['name'];
    $tmp  = $_FILES['gambar']['tmp_name'];
    $newName = time() . "_" . basename($file);
    
    if(move_uploaded_file($tmp, $folder . $newName)) {
        mysqli_query($koneksi, "INSERT INTO produk (nama_product, gambar, harga, deskripsi, kategori, stok) 
                               VALUES('$nama', '$newName', '$harga', '$desk', '$kat', '$stok')");
        echo "<script>alert('Produk ditambahkan!');location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal upload gambar!');</script>";
    }
}
?>