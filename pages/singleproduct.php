<?php
session_start();
require_once("../config/koneksi.php");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM produk WHERE id_produk = $product_id";
    $result = $koneksi->query($query);
} else {
    header("Location: #");
    exit();
}
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
    <link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/css/styleproduct.css">

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
 <!-- Breadcrumb -->
 <div class="container">
   <nav aria-label="breadcrumb" style="background-color: #fff" class="mt-3">
  <ol class="breadcrumb p-3">
    <li class="breadcrumb-item"><a href="homepage.php" class="text-decoration-none">Beranda</a></li>
    <li class="breadcrumb-item active" aria-current="page">Produk</li>
  </ol>
</nav>
 </div>
 <!-- Breadcrumb -->
 
 <!-- single product -->
 <?php
  $i=0;
    if($result){
      while($obj = $result->fetch_object()) { ?>

 <div class="container">
   <div class="row row-product">
     <div class="col-lg-5">
       <figure class="figure">
        <img src="../assets/images/produk/<?php echo $obj->gambar?>" class="figure-img img-fluid" style="border-radius: 5px; width: 450px;">
        <figcaption class="figure-caption d-flex justify-content-evenly">
          <a href="#">
          <img src="../assets/images/produk/<?php echo $obj->gambar?>" class="figure-img img-fluid" style="border-radius: 5px; width: 70px;">
          </a>

          <a href="#">
          <img src="../assets/images/produk/<?php echo $obj->gambar?>" class="figure-img img-fluid" style="border-radius: 5px; width: 70px;">
          </a>

          <a href="#">
          <img src="../assets/images/produk/<?php echo $obj->gambar?>" class="figure-img img-fluid" style="border-radius: 5px; width: 70px;">
          </a>

          <a href="#">
          <img src="../assets/images/produk/<?php echo $obj->gambar?>" class="figure-img img-fluid" style="border-radius: 5px; width: 70px;">
          </a>

          <a href="#">
          <img src="../assets/images/produk/<?php echo $obj->gambar?>" class="figure-img img-fluid" style="border-radius: 5px; width: 70px;">
          </a>
        </figcaption>
      </figure>
     </div>

     <div class="col-lg-7">
       <h4><?php echo $obj->nama_produk?></h4>
       <div class="garis-product"></div>
       <h3 class="text-muted mb-2">Rp<?php echo number_format ($obj->harga, 0, ',', '.');?></h3>
       <span class="mx-2">Tersisa <?php echo $obj->stok?> Stok</span>

       <div class="btn-produk mt-4">
       <a href="tambah_keranjang.php?action=add&id=<?php echo $obj->id_produk ?>" class="btn btn-dark btn-lg" style="font-size: 14px"><i class="fas fa-shopping-cart fs-6 me-2"></i>Masukkan Keranjang</a>
       </div>
     </div>
   </div>

   <!-- review-->
   <div class="row row-product">
           <divv class="col-12">
             <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="deskripsi-tab" data-bs-toggle="tab" data-bs-target="#deskripsi" type="button" role="tab" aria-controls="deskripsi" aria-selected="true">Deskripsi Produk</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Review Produk</button>
        </li>
      </ul>
      <div class="tab-content p-3" id="myTabContent">
        <div class="tab-pane fade show active deskripsi" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab">
          <p><?php echo $obj->deskripsi?></p>
        </div>
        <div class="tab-pane fade review" id="review" role="tabpanel" aria-labelledby="review-tab">
          <div class="row">
            <div class="col-1">
              <img src="../assets/images/profil/pic.png" class="review-img rounded-circle">
            </div>
            <div class="col">
              <h5 class="review-name">hiham</h5>
              <p class="review-des">Produk Original, Packing rapi, dan pengiriman super cepat</p>
            </div>
          </div>

          <div class="row">
            <div class="col-1">
              <img src="../assets/images/profil/pic1.png" class="review-img rounded-circle">
            </div>
            <div class="col">
              <h5 class="review-name">pajar</h5>
              <p class="review-des">Produk Original, Packing rapi, dan pengiriman super cepat</p>
            </div>
          </div>

          <div class="row">
            <div class="col-1">
              <img src="../assets/images/profil/pic2.png" class="review-img rounded-circle">
            </div>
            <div class="col">
              <h5 class="review-name">Al-faridho</h5>
              <p class="review-des">Produk Original, Packing rapi, dan pengiriman super cepat</p>
            </div>
          </div>

          <div class="row">
            <div class="col-1">
              <img src="../assets/images/profil/pic3.jpeg" class="review-img rounded-circle">
            </div>
            <div class="col">
              <h5 class="review-name">iron men</h5>
              <p class="review-des">Produk Original, Packing rapi, dan pengiriman super cepat</p>
            </div>
          </div>
        </div>
      </div>
     </divv>
   </div>
   <?php 
      }
    }
  
    $_SESSION['product_id'] = $product_id;
    ?>
   <!-- review-->

 </div>
 <!-- single product -->
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