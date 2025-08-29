<?php include "koneksi.php";
$id = $_GET['id'];
// cek apakah produk sudah ada di session
if(isset($_SESSION['keranjang'][$id])){
  $_SESSION['keranjang'][$id]+=1;
} else {
  $_SESSION['keranjang'][$id]=1;
}
echo "<script>alert('Produk ditambahkan ke keranjang!');location.href='keranjang.php';</script>";
?>