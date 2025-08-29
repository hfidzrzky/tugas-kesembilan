<?php 
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Keranjang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container">
  <h3 class="mb-4">Keranjang Belanja</h3>

  <form action="update_keranjang.php" method="post">
    <table class="table table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        if (!empty($_SESSION['keranjang'])) {
          foreach ($_SESSION['keranjang'] as $id => $jumlah) {
            $q = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id'");
            if(mysqli_num_rows($q) > 0) {
              $p = mysqli_fetch_assoc($q);
              $sub = $p['harga'] * $jumlah;
              $total += $sub;
        ?>
        <tr>
          <td><?= $p['nama_product'] ?></td>
          <td>Rp<?= number_format($p['harga'],0,',','.') ?></td>
          <td>
            <input type="number" name="jumlah[<?= $id ?>]" value="<?= $jumlah ?>" min="1" class="form-control text-center" style="width:80px;margin:auto;">
          </td>
          <td>Rp<?= number_format($sub,0,',','.') ?></td>
          <td>
            <a href="hapus.php?type=keranjang&id=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini dari keranjang?')">Hapus</a>
          </td>
        </tr>
        <?php 
            } else {
              unset($_SESSION['keranjang'][$id]);
            }
          } 
        } else { 
        ?>
        <tr><td colspan="5" class="text-center">Keranjang kosong 😔</td></tr>
        <?php } ?>
        <tr>
          <td colspan="3" class="text-end"><b>Total</b></td>
          <td colspan="2"><b>Rp<?= number_format($total,0,',','.') ?></b></td>
        </tr>
      </tbody>
    </table>

    <div class="d-flex justify-content-between">
      <a href="index.php" class="btn btn-secondary">← Lanjut Belanja</a>
      <?php if(!empty($_SESSION['keranjang'])) { ?>
      <button type="submit" name="update" class="btn btn-primary">Update Keranjang</button>
      <?php } ?>
    </div>
  </form>
</div>
</body>
</html>