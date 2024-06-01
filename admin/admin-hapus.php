<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_GET['id'])) {
    $id_admin = $_GET['id'];

    $sql = mysqli_query($koneksi, "DELETE FROM admin WHERE id_admin = '$id_admin'");
    if($sql){
        echo "<script>alert('Data berhasil dihapus'); window.location.href='pengaturan.php';</script>";
    } 
}
?>
