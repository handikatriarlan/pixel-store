<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_SESSION['email'])) {
    if(isset($_POST['simpan'])){
		$folder = '../assets/images/produk/';
		$name_p = $_FILES['gambar']['name'];
		$sumber_p = $_FILES['gambar']['tmp_name'];
		
		move_uploaded_file($sumber_p, $folder.$name_p);
		
		$nama_produk = $_POST['nama_produk'];
		$deskripsi = $_POST['deskripsi'];
		$harga = $_POST['harga'];
		$stok = $_POST['stok'];
		$insert = mysqli_query($koneksi, "INSERT INTO produk (gambar, nama_produk, deskripsi, harga, stok) VALUES ('$name_p', '$nama_produk', '$deskripsi', '$harga', '$stok')");
		
		if($insert){
			echo "<script>alert('Produk berhasil ditambah'); window.location.href='produk.php';</script>";
		} else {
			echo "<script>alert('Produk gagal ditambah'); window.location.href='produk-tambah.php';</script>";
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
			<li class="active">
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
		<ul class="side-menu">
			<li>
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
							<a class="active" href="produk.php">Produk</a>
                        <li><i class='bx bx-chevron-right' ></i></li>
						</li>
						<li>
							<a>Tambah Produk</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="table-data-produk">
				<div class="order">
					<div class="head">
						<h3>Tambah Produk</h3>
					</div>
                    <form action="" method="post" enctype="multipart/form-data">
						<div class="field input">
							<label for="gambar">Pilih Gambar</label>
							<input type="file" name="gambar" accept="image/*" required>
						</div>
						<div class="field input">
							<label for="nama_produk">Masukkan Nama Produk</label>
							<input type="text" name="nama_produk" required>
						</div>
						<div class="field input">
							<label for="deskripsi">Masukkan Deskripsi Produk</label>
							<input type="text" name="deskripsi" required></input>
						</div>
						<div class="field input">
							<label for="harga">Masukkan Harga</label>
							<input type="number" name="harga" required>
						</div>
						<div class="field input">
							<label for="stok">Masukkan Jumlah Stok</label>
							<input type="number" name="stok" required>
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
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<?php
}
else {
	header("location:login.php");
} ?>