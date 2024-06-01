<?php

session_start();
require_once("../config/koneksi.php");

if(isset($_SESSION['email'])) { 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/css/keranjang.css">

    <title>Pixel Store</title>
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="homepage.php">
      <img src="../assets/images/Logos.png" alt="" width="35" height="27" class="me-2">
      Pixel <strong>Store</strong>
    </a>
      <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="homepage.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="keranjang.php">Keranjang</a>
          </li>
          <?php
          if (isset($_SESSION['email'])){?>
            <li class="nav-item">
              <a class="nav-link" href="profil.php">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Keluar</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Masuk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Daftar</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
 <!-- Breadcrumb -->
 <div class="container">
   <nav aria-label="breadcrumb" style="background-color: #fff" class="mt-3">
  <ol class="breadcrumb p-3">
    <li class="breadcrumb-item"><a href="homepage.php" class="text-decoration-none">Beranda</a></li>
    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
  </ol>
</nav>
 </div>
 <!-- Breadcrumb -->
 <!-- Keranjang-->
 <?php 
 if (isset($_SESSION['cart'])) { ?>
  <div class="container">
    <div class="row row-product">
      <div class="col">
        <table class="table">
            <thead class="table-secondary">
              <tr>
                <th scope="col">Hapus</th>
                <th scope="col">Gambar</th>
                <th scope="col">Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Sub Total</th>
              </tr>
            </thead>
            <tbody class="align-middle">
            <?php
              $total = 0;
              foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $result = $koneksi->query('SELECT nama_produk, gambar, harga, stok FROM produk WHERE id_produk = ' .$product_id);

                if ($result) {
                  while ($obj = $result->fetch_object()) {
                    $cost = $obj->harga * $quantity;
                    $total += $cost;
                    ?>
              <tr>
                <td><a href="tambah_keranjang.php?action=delete&id=<?php echo $product_id; ?>" ><i class="fa-solid fa-trash-can"></i></a></td>
                <td><img src="../assets/images/produk/<?php echo $obj->gambar ?>" class=img-keranjang></td>
                <td><?php echo $obj->nama_produk?></td>
                <td>Rp<?php echo number_format ($obj->harga, 0, ',', '.');?></td>
                <td>
                  <a href="tambah_keranjang.php?action=remove&id=<?php echo $product_id; ?>" class="button btn-dark btn-sm"><i class="fas fa-minus"></i></a>
                  <span class="mx-2"> <?php echo $quantity ?> </span>
                  <a href="tambah_keranjang.php?action=add&id=<?php echo $product_id; ?>" class="button btn-dark btn-sm"><i class="fas fa-plus text-white"></i></a>
                </td>
                <td>Rp<?php echo number_format ($cost, 0, ',', '.') ?></td>
                <?php }
                }
                } ?>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <table class="table">
          <tbody>
            <tr>
              <td class="fw-bold">Total Harga: &NonBreakingSpace;&NonBreakingSpace;  Rp<?php echo number_format ($total, 0, ',', '.'); ?></td>
            </tr>
            <tr>
              <form action="checkout.php" method="post">
                <td><button class="btn btn-dark btn-sm">Checkout</button></td>
              </form>
              </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php
    if ($quantity < 1) {
    unset($_SESSION['cart']);
    echo '<script>window.location.reload();</script>';
    }
  } else { ?>
    <div class="alert alert-light" style="margin-bottom: -25px; width: 100%; height: 100px; text-align: center;" role="alert">
  <br>Keranjang Anda Kosong! Silahkan Kembali Ke <a href="homepage.php" class="alert-link">Halaman Awal.</a>
</div>
      <?php }?>
 <!-- Keranjang-->
  <!-- footer -->
  <footer class="bg-light p-5 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <a href="" class="text-decoration-none">
            <img src="../assets/images/Logos.png" style="width: 30px;">
          </a>
          <span>Copyright @2023 | Dibuat Oleh <a class="text-decoration-none text-dark fw-bold">Pixel Grub</a></span>
        </div>

        
      </div>
    </div>
  </footer>
  <!-- footer -->
    <br><!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
<?php
}
else { ?>
  <script>
  alert("Anda Belum Masuk. Tekan OK Untuk Dialihkan Ke Halaman Masuk Agar Anda Dapat Membuka Halaman Keranjang.");
  window.location.href = "login.php";
  <?php } ?>
  </script>