<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_SESSION['email'])){
	$email = $_SESSION['email'];
 }else{
	$email = '';
	header('location:homepage.php');
 };
 
 if(isset($_POST['batal'])){
    $id = $_SESSION['email'];
	$email = $_SESSION['email'];

	$sql = mysqli_query($koneksi, "UPDATE transaksi SET status = 'Dibatalkan' WHERE email = '".$id."'");
	if($sql){
	$message[] = 'Pesanan Berhasil Dibatalkan';
	} else {
	$message[] = 'Pesanan Gagal Dibatalkan';
	}
}

if(isset($message)){
	foreach($message as $message){
	   echo '<div class="message"><span>'.$message.'</span></div>';
	};
  };

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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/styleprofil.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/css/stylehome.css">

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
    <li class="breadcrumb-item active" aria-current="page">Status Pesanan</li>
  </ol>
</nav>
 </div>
 <!-- Breadcrumb -->


<section class="orders">
<div class="box-container">

<?php
$id = $_SESSION['email'];
$sql = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE email = '".$id."'");
if (mysqli_num_rows($sql) > 0) {
    while ($result = mysqli_fetch_assoc($sql)) {
      $sql2 = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '".$id."'");
        if (mysqli_num_rows($sql2) > 0) {
            while ($result2 = mysqli_fetch_assoc($sql2)) {
?>
<div class="box">
   <p class="date"><i class="fa fa-calendar"></i><span><?= $result['tanggal']; ?></span></p>
   <p><i class="fa fa-user"></i> Nama : <span><?= $result2['nama']; ?></span></p>
   <p><i class="fa fa-phone"></i> Nomor : <span><?= $result2['no_telp']; ?></span> </p>
   <p><i class="fa fa-envelope"></i> Email : <span><?= $result2['email']; ?></span> </p>
   <p><i class="fa fa-map-marker"></i> Alamat : <span><?= $result2['alamat']; ?></span></p>
   <p><i class="fa fa-credit-card"></i> Metode Pembayaran : <span><?= $result['metode']; ?></span></p>
   <p><i class="fa fa-shopping-cart"></i> Pesanan Kamu : <span><?= $result['total_produk']; ?></span></p>
   <p><i class="fa fa-money"></i> Total Harga : <span>Rp.<?= number_format($result['total_harga']); ?></span></p>
   <p class="status" style="color:<?php if($result['status'] == 'Pesanan Berhasil'){echo 'green';}elseif($result['status'] == 'Pesanan Batal' || $result['status'] == 'Pesanan Gagal'){echo 'red';}else{echo 'orange';}; ?>"><?= $result['status']; ?></p>
   <?php if ($result['status'] !== 'Pesanan Berhasil' && $result['status'] !== 'Pesanan Batal' && $result['status'] !== 'Sedang Diantar'  && $result['status'] !== 'Sedang Dikemas'  && $result['status'] !== 'Pesanan Gagal') {
    if ($result['bukti'] == '') { ?>
    <p>Silahkan Lakukan Pembayaran <a href="pembayaran.php" class="btn btn-primary"> LAKUKAN PEMBAYARAN</a></p>
    <?php }
    else {
    } ?>
	<form method="post" action="">
	<input type="hidden" name="status" value="<?php echo $result['status']; ?>">
    <input type="submit" value="BATALKAN PESANAN" name="batal" class="btn btn-danger">
	</form>
        <?php } ?>
	<?php if ($result['status'] !== 'Verifikasi Pembayaran' && $result['status'] !== 'Sedang Dikemas') { ?>
        <p>NOMOR RESI: <?= $result['no_resi']; ?></p>
    <?php } ?>
</div>
<?php
   }
  }
}
   }else{
	  echo '<p class="empty">Tidak Ada Pesanan</p>';
   }
?>
</div>
</section>

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