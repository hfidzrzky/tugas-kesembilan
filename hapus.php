<?php 
include "koneksi.php";
session_start();

// Mendapatkan parameter
$id = $_GET['id'];
$type = isset($_GET['type']) ? $_GET['type'] : 'produk';

if ($type == 'produk') {
    // Hapus produk dari database
    mysqli_query($koneksi, "DELETE FROM produk WHERE id='$id'");
    echo "<script>alert('Produk dihapus!');location.href='index.php';</script>";
} else if ($type == 'keranjang') {
    // Hapus produk dari keranjang
    if (isset($_SESSION['keranjang'][$id])) {
        unset($_SESSION['keranjang'][$id]);
        echo "<script>alert('Produk dihapus dari keranjang!');location.href='keranjang.php';</script>";
    } else {
        echo "<script>alert('Produk tidak ditemukan dalam keranjang!');location.href='keranjang.php';</script>";
    }
} else {
    echo "<script>alert('Aksi tidak valid!');location.href='index.php';</script>";
}
?>