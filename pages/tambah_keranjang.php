<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){
  session_start();}

include '../config/koneksi.php';

if(isset($_SESSION['email'])){
  
$product_id = $_GET['id'];
$action = $_GET['action'];

$result = mysqli_query($koneksi, "SELECT stok FROM produk WHERE id_produk = ".$product_id);


if($result){

  if($obj = $result->fetch_object()) {

    switch($action) {

      case "add":
      if($_SESSION['cart'][$product_id]+1 <= $obj->stok)
        $_SESSION['cart'][$product_id]++;
      break;

      case "remove":
      $_SESSION['cart'][$product_id]--;
      if($_SESSION['cart'][$product_id] == 0)
        unset($_SESSION['cart'][$product_id]);
        break;

      case "delete":
        unset($_SESSION['cart'][$product_id]);
        break;

    }
  }
}

header("location:keranjang.php");
}

else { ?>
  <script>
  alert("Anda Belum Masuk. Tekan OK Untuk Dialihkan Ke Halaman Masuk Agar Anda Dapat Menambahkan Barang Ke Keranjang.");
  window.location.href = "login.php";
  <?php } ?>
  </script>