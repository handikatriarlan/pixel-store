<?php
  session_start();
  unset ($_SESSION['email']);
  echo "<script>alert('Logout Berhasil'); window.location.href='login.php';</script>";
  exit();
?>
