<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_SESSION['email'])) {
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
							<a>Pengaturan</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Admin</h3>
					</div>
					<div class="head">
						<a href="admin-tambah.php" class="ijo">Tambah Admin</a>
					</div>
					<table>
						<thead>
							<tr>
								<th>ID Admin</th>
								<th>Email</th>
								<th>Nama</th>
								<th>Password</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php
								$result = $koneksi->query('SELECT * FROM admin');

								if($result){

									while($obj = $result->fetch_object()) {
									?>
								<td><?php echo $obj->id_admin?></td>
								<td><?php echo $obj->email?></td>
								<td><?php echo $obj->nama?></td>
								<td><?php echo str_repeat('*', strlen($obj->password)); ?></td>
								<td><a href="admin-edit.php?id=<?php echo $obj->id_admin ?>"><span class="status edit">Edit</span><br><br>
									<a href="admin-hapus.php?id=<?php echo $obj->id_admin ?>"><span class="status hapus">Hapus</span></td>
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