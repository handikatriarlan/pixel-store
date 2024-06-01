<?php
session_start();
require_once("../config/koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id_transaksi = $_POST['id_transaksi'];
    $status = $_POST['status'];

    $edit = mysqli_query($koneksi, "UPDATE transaksi SET status='$status' WHERE id_transaksi='$id'");
    if ($edit) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='transaksi.php';</script>";
        exit();
    }
}
?>
