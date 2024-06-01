<?php 
   session_start();
   include("../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Masuk</title>
</head>
<body>
    <br>
      <div class="container">
        <div class="box form-box-login">
            <?php 
              if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($koneksi,$_POST['email']);
                $password = mysqli_real_escape_string($koneksi,$_POST['password']);

                $result = mysqli_query($koneksi,"SELECT * FROM admin WHERE email='$email' AND password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['email'] = $row['email'];
                }else{
                    echo "<div class='message-error'>
                      <p>Email atau Password Yang Anda Masukkan Salah!</p>
                       </div> <br>";
                   echo "<a href='login.php'><button class='btn-back'>Kembali</button></a>";
                }
                if(isset($_SESSION['email'])) {
                    echo "<script>alert('Login Berhasil'); window.location.href='index.php';</script>";
                    exit(); 
                }
                }else{
                
            
            ?>
            <header>Masuk Sebagai Admin</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Masuk" required>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>