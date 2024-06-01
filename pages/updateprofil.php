<?php

session_start();
require_once("../config/koneksi.php");

if(isset($_POST['edit_profil'])){
    $email = $_SESSION['email'];
    $gambar = $_FILES['gambar']; 
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    
    if($gambar != ""){
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $x = explode('.', $gambar['name']);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak.'-'.$gambar['name'];

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        move_uploaded_file($file_tmp, '../assets/images/profil/'.$nama_gambar_baru);
        
        $edit = mysqli_query($koneksi, "UPDATE user
        SET gambar='$nama_gambar_baru', nama='$nama', no_telp='$no_telp', alamat='$alamat'
        WHERE email='$email'");
        }
        if($edit){
            $message[] = 'Profil Berhasil Diedit';
        }else{
            $message[] = 'Profil Gagal Diedit';
        }
        }
    }

    if(isset($message)){
        foreach($message as $message){
           echo '<div class="message"><span>'.$message.'</span> <i class="fa fa-times" onclick="this.parentElement.style.display = none;"></i> </div>';
        };
      };
$email = $_SESSION['email'];
$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");
$result = mysqli_fetch_assoc($sql);
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
    <link rel="stylesheet" type="text/css" href="../assets/css/styleprofil.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/css/stylehome.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/css/all.min.css">

    <title>Pixel Store</title>
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="homepage.php">
      <img src="../assets/images/Logos.png" alt="" width="35" height="27" class="me-2">
      Pixel <strong>Store</strong>
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <form class="d-flex ms-auto">
      <input class="form-control me-2" type="search" placeholder="Cari Barang Anda!" aria-label="Cari">
      <button class="btn btn-light" type="submit">Cari</button>
    </form>
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
              <a class="nav-link active" href="profil.php">Profil</a>
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
    <li class="breadcrumb-item active" aria-current="page">Profil</li>
  </ol>
</nav>
 </div>
 <!-- Breadcrumb -->
 
<section class="form-container update-form">
<form action="" method="post" enctype="multipart/form-data">
   <a href="profil.php"> << Kembali Ke Profil User </a>
   <br>
   <br>
   <h3>Edit Profil</h3>
   <input type="file" name="gambar" placeholder="Masukkan Foto Anda" value="<?php echo $result['gambar']; ?>" class="box" maxlength="50">
   <input type="text" name="nama" placeholder="Masukkan Nama Anda" value="<?php echo $result['nama']; ?>" class="box" maxlength="50">
   <input type="number" name="no_telp" placeholder="Masukkan Nomor Telp Anda" value="<?php echo $result['no_telp']; ?>" class="box" maxlength="50">
   <input type="text" name="alamat" placeholder="Masukkan Alamat Anda" value="<?php echo $result['alamat']; ?>" class="box" maxlength="50">
   <input type="submit" value="Edit Sekarang" name="edit_profil" class="btn btn-primary">
</form>
</section>
<?php     
?>

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