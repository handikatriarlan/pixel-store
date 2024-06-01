<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_GET['id'])) {
    $id_user = $_GET['id'];

    $sql = mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id_user'");
    if($sql){
        echo "<script>alert('User berhasil dihapus'); window.location.href='user.php';</script>";
    } 
}
?>
