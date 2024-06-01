<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi = '$id'");
    if($sql){
        echo "<script>alert('Data berhasil dihapus'); window.location.href='transaksi.php';</script>";
    } 
}
?>
