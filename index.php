<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h3 class="my-4">Daftar Produk</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM produk");
            while ($row = mysqli_fetch_assoc($query)) { ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="uploads/<?= $row['gambar'] ?>" class="card-img-top" style="height:200px;object-fit:cover;"
                            onerror="this.src='https://via.placeholder.com/200x200?text=Gambar+Tidak+Ada'">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama_product'] ?></h5>
                            <p class="text-muted">Rp<?= number_format($row['harga'], 0, ',', '.') ?></p>
                            <p class="card-text"><?= substr($row['deskripsi'], 0, 100) ?>...</p>
                            <span class="badge bg-primary"><?= $row['kategori'] ?></span>
                            <p class="mt-2">Stok: <?= $row['stok'] ?></p>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus produk ini dari halaman?')">Hapus</a>
                            <a href="tambah_keranjang.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">+ Keranjang</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>