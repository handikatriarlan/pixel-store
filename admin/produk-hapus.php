<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    $sql = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$id_produk'");
    if($sql){
        echo "<script>alert('Produk berhasil dihapus'); window.location.href='produk.php';</script>";
    } 
}
?>
