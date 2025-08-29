<?php
$host = "127.0.0.1:3307";
$user = "root";
$pass = "";
$db   = "ecommerce";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
session_start();
?>
