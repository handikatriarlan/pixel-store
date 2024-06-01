<?php

session_start();
require_once("../config/koneksi.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/css/all.min">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/css/stylehome.css">

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
            <a class="nav-link active" aria-current="page" href="homepage.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="keranjang.php">Keranjang</a>
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
 
<div class="container">
    <div id="carouselExampleControls" class="carousel slide mt-5" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../assets/images/banner1.jpg" class="d-block img-fluid" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../assets/images/banner2.jpg" class="d-block img-fluid" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../assets/images/banner3.jpg" class="d-block img-fluid" alt="...">
        </div>
        
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
</div>
  
  <!-- produk -->
    <div class="container mt-5">
      <div class="judul-kategori" style="background-color: #FFF; padding: 5px 10px;">
        <h5 class="text-center" style="margin-top: 5px;">PRODUK</h5>
        <div class="row mt-2">
          <?php
          $i=0;
          $product_id = array();
          $product_quantity = array();

          $result = $koneksi->query('SELECT * FROM produk');

          if($result){

            while($obj = $result->fetch_object()) { ?>
              <div class="col-lg-2 col-md-2 col-sm-4 col-6 mt-2">
                  <div class="card text-center">
                    <img src="../assets/images/produk/<?php echo $obj->gambar?>" class="card-img-top">
                    <div class="card-body">
                      <h6 class="card-title"><?php echo $obj->nama_produk?></h6>
                      <p class="card-text">Rp<?php echo number_format ($obj->harga, 0, ',', '.');?></p>
                      <a href="tambah_keranjang.php?action=add&id=<?php echo $obj->id_produk ?>" class="btn btn-dark d-grid">Beli</a><br>
                      <a href="singleproduct.php?id=<?php echo $obj->id_produk ?>" class="btn btn-dark d-grid">Lihat Detail</a>
                    </div>
                  </div>
              </div>
              
    <?php 
    $i++;
      }
    }
    $_SESSION['product_id'] = $product_id;
    ?>
        </div>
      </div>
    </div>
  <!-- produk -->

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