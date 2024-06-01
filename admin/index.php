<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_SESSION['email'])) {

	$get_user = "SELECT * FROM user";
	$run_user = mysqli_query($koneksi, $get_user);
	$count_user = mysqli_num_rows($run_user);

	$get_transaksi = "SELECT * FROM transaksi WHERE status = 'Pesanan Berhasil'";
	$run_transaksi = mysqli_query($koneksi,$get_transaksi);
	$count_transaksi = mysqli_num_rows($run_transaksi);

	$get_total_earnings = "SELECT SUM(total_harga) as Total FROM transaksi WHERE status = 'Pesanan Berhasil'";
	$run_total_earnings = mysqli_query($koneksi, $get_total_earnings);
	$row = mysqli_fetch_assoc($run_total_earnings);                       
	$count_total_earnings = $row['Total'];
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
			<li class="active">
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
							<a>Beranda</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<a  href="user.php"  class='bx bxs-group' ></a>
					<span class="text">
						<h3><?php echo $count_user; ?></h3>
						<p>User</p>
					</span>
				</li>
				<li>
					<a href="transaksi.php" class='bx bxs-calendar-check' ></a>
					<span class="text">
						<h3><?php echo $count_transaksi; ?></h3>
						<p>Pesanan</p>
					</span>
				</li>
				<li>
					<a  href="transaksi.php"  class='bx bxs-dollar-circle' ></a>
					<span class="text">
						<h4>Rp<?php echo number_format ($count_total_earnings, 0, ',', '.') ?></h4>
						<p>Total Penjualan</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Pesanan Terakhir</h3>
					</div>
					<table>
					<thead>
							<tr>
								<th>ID Transaksi</th>
								<th>Email</th>
								<th>Tanggal</th>
								<th>Total Harga</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php
								$result = $koneksi->query('SELECT * FROM transaksi ORDER BY tanggal DESC LIMIT 5');

								if($result){

									while($obj = $result->fetch_object()) {
									?>
								<td><?php echo $obj->id_transaksi?></td>
								<td><?php echo $obj->email?></td>
								<td><?php echo $obj->tanggal?></td>
								<td>Rp<?php echo number_format ($obj->total_harga, 0, ',', '.');?></td>
								<td><?php echo $obj->status?></td>
							</tr>
						</tbody>
						<?php 
							}
						}?>
					</table>
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