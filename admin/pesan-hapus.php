<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = mysqli_query($koneksi, "DELETE FROM kontak WHERE id_kontak = '$id'");
    if($sql){
        echo "<script>alert('Pessan berhasil dihapus'); window.location.href='pesan.php';</script>";
    } 
}
?>
