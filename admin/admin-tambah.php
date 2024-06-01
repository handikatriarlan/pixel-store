<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_SESSION['email'])) {
    if(isset($_POST['simpan'])){
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $insert = mysqli_query($koneksi, "INSERT INTO admin (email, nama, password) VALUES ('$email', '$nama', '$password')");
    if($insert){
        echo "<script>alert('Data berhasil ditambah'); window.location.href='pengaturan.php';</script>";
    } else {
        echo 'Gagal disimpan';
    }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<title>Pixel Admin</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar" class="hide">
		<a href="index.php" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Pixel Admin</span>
		</a>
		<ul class="side-menu top">
            <li>
				<a href="index.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
            </li>
			<li>
				<a href="produk.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Produk</span>
				</a>
			</li>
			<li>
				<a href="transaksi.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Transaksi</span>
				</a>
			</li>
			<li>
				<a href="pesan.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Pesan</span>
				</a>
			</li>
			<li>
				<a href="user.php">
					<i class='bx bxs-group' ></i>
					<span class="text">User</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu top">
			<li class="active">
				<a href="pengaturan.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Pengaturan</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Keluar</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<form>
			</form>
			<a href="pengaturan.php" class="profile">
				<img src="assets/img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
						<li>
							<a class="active" href="index.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="pengaturan.php">Pengaturan</a>
                        <li><i class='bx bx-chevron-right' ></i></li>
						</li>
						<li>
							<a>Tambah Admin</a>
						</li>
					</ul>
                </div>
            </div>

            <div class="table-data-produk">
				<div class="order">
					<div class="head">
						<h3>Tambah Admin</h3>
					</div>
                    <form action="" method="post">
					<div class="field input">
							<label for="spek">Masukkan Alamat Email</label>
							<input type="text" name="email" pattern="[^ @]*@[^ @]*" required>
						</div>
						<div class="field input">
							<label for="harga">Masukkan Nama</label>
							<input type="text" name="nama" required>
						</div>
						<div class="field input">
							<label for="stok">Masukkan Password</label>
							<input type="password" name="password" required>
						</div>
						<div class="field input">
							<div class="head">
								<button type="submit" name="simpan" class="ijo" value="Simpan" required>Simpan</button>
							</div>
						</div>
                    </form>
                </div>
            </div>
        </main>
		<!-- MAIN -->

	</section>
	<!-- CONTENT -->

        <script src="assets/js/script.js"></script>
</body>
</html>

<?php
}
else {
	header("location:login.php");
}