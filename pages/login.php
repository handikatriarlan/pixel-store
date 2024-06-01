<?php

session_start();
	require_once("../config/koneksi.php");

if(isset($_POST['submit']) == 'MASUK'){
  $email = $_POST['email'];
  $password = $_POST['password'];
  if(empty($email) || empty($password)){ 
      echo"<meta http-equiv='refresh' content='0 url =login.php'>";
  }else{
      $sql = mysqli_query($koneksi, "SELECT * FROM user
      WHERE email='$email' and password = '$password'");
      $result = mysqli_fetch_array($sql);
      if($result){
          $_SESSION['email'] = $email;
          //header('Location: Login.php);
          echo "<meta http-equiv='refresh' content='0 url=homepage.php'>";
          }else{
              //Tidak ada di database
              echo "<meta http-equiv='refresh' content='0 url=login.php'>";
          }
}
}
if (isset($_GET['action']) && $_GET['action'] == "logout"){
  session_destroy();
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
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <title>Pixel Store</title>
  </head>
  <body>
    <div class="container">
      <form action="" method="post" class="login-container">
        <h3 class="textJudul mb-5" align="center">Masuk</h3>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label textForm">Alamat Email</label>
          <input type="email" class="form-control" name="email" pattern="[^ @]*@[^ @]*" placeholder="Masukkan Email" Required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label textForm">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Masukkan Password" Required>
        </div>
        <div class="text-end">
        <a href="#" class="textForm text-hover">Lupa Password?</a>
        </div>
        <div class="d-grid textForm mt-5">
        <input type="submit" name="submit" class="btn btn-primary" value="MASUK">
        </div>
        <div class="mt-3">
          <span class="textForm">Belum Punya Akun? <a href="register.php" class="text-hover">Daftar</a></span>
        </div>
        </form>
      </form>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>