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
			<li class="active">
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
							<a href="#">Pesan</a>
						</li>
					</ul>
				</div>
			</div>
			<?php
$result = $koneksi->query('SELECT * FROM kontak');

if ($result) {
    if ($result->num_rows > 0) {
        ?>
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Pesan Masuk</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Waktu</th>
                            <th>Pesan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($obj = $result->fetch_object()) {
                            ?>
                            <tr>
                                <td><?php echo $obj->email; ?></td>
                                <td><?php echo $obj->nama; ?></td>
                                <td><?php echo $obj->waktu; ?></td>
                                <td><?php echo $obj->pesan; ?></td>
                                <td><a href="pesan-hapus.php?id=<?php echo $obj->id_kontak; ?>"><span class="status pendingg">Hapus</span></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    } else { ?>
        <div class="table-data">
            <div class="order">
                <div class="head">
					<h3>Tidak Ada Pesan Masuk</h3>
				</div>
			</div>
		</div> <?php
    }
    $result->close();
}
?>

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