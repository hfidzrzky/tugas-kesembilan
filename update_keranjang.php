<?php
session_start();

if(isset($_POST['update'])){
    foreach($_POST['jumlah'] as $id => $jumlah){
        if($jumlah > 0){
            $_SESSION['keranjang'][$id] = $jumlah;
        } else {
            unset($_SESSION['keranjang'][$id]);
        }
    }
    echo "<script>alert('Keranjang updated!');location.href='keranjang.php';</script>";
} else {
    echo "<script>alert('Akses tidak valid!');location.href='keranjang.php';</script>";
}
?>