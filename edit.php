<?php 
include "koneksi.php"; 
$id = $_GET['id'];
$q = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id'");
$data = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container">
  <h3 class="mb-4">Edit Produk</h3>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3"><label>Nama Produk</label><input type="text" name="nama" value="<?= $data['nama_product'] ?>" class="form-control"></div>
    <div class="mb-3"><label>Harga</label><input type="number" name="harga" value="<?= $data['harga'] ?>" class="form-control"></div>
    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"><?= $data['deskripsi'] ?></textarea></div>
    <div class="mb-3"><label>Kategori</label><input type="text" name="kategori" value="<?= $data['kategori'] ?>" class="form-control"></div>
    <div class="mb-3"><label>Stok</label><input type="number" name="stok" value="<?= $data['stok'] ?>" class="form-control"></div>
    <div class="mb-3">
      <label>Gambar</label>
      <input type="file" name="gambar" class="form-control">
      <small>Gambar sekarang: <img src="uploads/<?= $data['gambar'] ?>" width="100"></small>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>

<?php
if(isset($_POST['update'])){
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $desk = $_POST['deskripsi'];
  $kat = $_POST['kategori'];
  $stok = $_POST['stok'];

  $gambar = $data['gambar']; // default tetap gambar lama

  if($_FILES['gambar']['name'] != ""){
    $file = $_FILES['gambar']['name'];
    $tmp  = $_FILES['gambar']['tmp_name'];
    $folder = "uploads/";

    if(!is_dir($folder)){
      mkdir($folder, 0777, true);
    }

    $newName = time() . "_" . basename($file);
    move_uploaded_file($tmp, $folder.$newName);

    $gambar = $newName;

    // hapus gambar lama jika ada
    if(file_exists($folder.$data['gambar'])){
      unlink($folder.$data['gambar']);
    }
  }

  mysqli_query($koneksi, "UPDATE produk SET 
      nama_product='$nama', 
      harga='$harga', 
      deskripsi='$desk', 
      kategori='$kat', 
      stok='$stok', 
      gambar='$gambar' 
      WHERE id='$id'");
      
  echo "<script>alert('Produk berhasil diupdate!');location.href='index.php';</script>";
}
?>