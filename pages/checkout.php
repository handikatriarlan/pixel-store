<?php
session_start();
include '../config/koneksi.php';

if(isset($_SESSION['cart'])) {
  if(isset($_POST['upload'])){
    $folder = 'assets/images/bukti/';
    $name_p = $_FILES['bukti']['name'];
    $sumber_p = $_FILES['bukti']['tmp_name'];
    
    move_uploaded_file($sumber_p, $folder.$name_p);
    }

  $total = 0;
  $jumlah = 0;

  foreach($_SESSION['cart'] as $product_id => $quantity) {

    $result = $koneksi->query("SELECT * FROM produk WHERE id_produk = ".$product_id);

    if($result){

      if($obj = $result->fetch_object()) {


        $jumlah += $quantity;
        $ongkir = $jumlah * 150000;
        $cost = $obj->harga * $quantity + $ongkir;

        $user = $_SESSION["email"];

        $query = $koneksi->query("INSERT INTO transaksi (nama_produk, harga, total_produk, total_harga, email, bukti, ongkir) VALUES('$obj->nama_produk', '$obj->harga', '$quantity', '$cost', '$user', '$name_p', '$ongkir')");

        if($query){
          $newstok = $obj->stok - $quantity;
          if($koneksi->query("UPDATE produk SET stok = ".$newstok." WHERE id_produk = ".$product_id)){

          }
        }
      }
    }
  }
}

unset($_SESSION['cart']);
header("location:berhasil.php");

?>
