<?php 
require_once ("../config/koneksi.php");
session_start();

if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $email = ($_POST['email']);
  $no_telp = $_POST['no_telp'];
  $alamat = $_POST['alamat'];
  $password = ($_POST['password']);
  $cpassword = ($_POST['cpassword']);

  $select = "SELECT * FROM user WHERE email = '$email' && password = '$password'";
  $result = mysqli_query($koneksi, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'Alamat email sudah digunakan'; }
      else{
        if ($password !== $cpassword) {
          echo "Password tidak cocok. Silakan coba lagi."; }
        else{
          mysqli_query($koneksi,"INSERT INTO user(nama,email,password,alamat,no_telp) VALUES('$nama','$email','$password','$alamat','$no_telp')") or die("Erroe Occured");
          header("location: login.php");
        }
      }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/styleRegister.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/css/all.min.css">

    <title>Pixel Store</title>
  </head>
  <body>
  <div class="container">
    <form class="form-container" action="" method="post">
      <h3 class="text-judul">Daftar</h3>
      <div class="row mt-5">
        <div class="col-md-7">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user-pen"></i></span>
              <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama lengkap" Required>
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="mb-3">
            <label for="email" class="form-label">Password</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
              <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" Required>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">E-mail</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" pattern="[^ @]*@[^ @]*" aria-describedby="emailHelp" placeholder="E-mail" Required>
              </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="mb-3">
            <label for="email" class="form-label">Konfirmasi Password</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
              <input type="password" name="cpassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" Required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="mb-3">
              <label for="no_telp" class="form-label">No Handphone</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-mobile-button"></i></i></span>
                <input type="number" name="no_telp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Handphone" Required>
              </div>
            </div>
          </div>
          
          <div class="col-md-8">
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-location-dot"></i></span>
                <input type="text" name="alamat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Alamat" Required>
              </div>
            </div>
          </div>
          
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" Required>
            <label class="form-check-label" for="exampleCheck1">Saya menyetujui <span class="text-merah">Syarat & Ketentuan</span> Yang Berlaku <span class="text-merah">*</span></label>
          </div>

          <div class="mt-5">
            <div class="row">
              <div class="col-md-6 d-grid">
                <button type="submit" name="submit" class="btn btn-outline-primary">Daftar</button>
              </div>
              <div class="col-md-6 d-grid">
                <button type="reset" class="btn btn-outline-danger">Reset</button>
            </div>
          </div>
        </div>

        <div class="mt-3">
          <label>Sudah punya akun? <a href="login.php" class="text-login">Login Disini</label>
        </div>
      </div>
    </form>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>