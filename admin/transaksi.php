<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_SESSION['email'])) {
	if (isset($_POST['update'])) {
		$id_transaksi = $_POST['id_transaksi'];
		$status = $_POST['status'];

		$status = mysqli_real_escape_string($koneksi, $status);
		
		if ($status == 'Sedang Diantar') {
			$angka_acak = rand(1, 999999999);
			$resi = 'LPCM' . '' . $angka_acak;

			$update = mysqli_query($koneksi, "UPDATE transaksi SET status='$status', no_resi='$resi' WHERE id_transaksi='$id_transaksi'");
			
		} else {
			$update = mysqli_query($koneksi, "UPDATE transaksi SET status='$status' WHERE id_transaksi='$id_transaksi'");
		}

		if ($update) {
			echo "<script>alert('Data berhasil diupdate'); window.location.href='transaksi.php';</script>";
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
			<li class="active">
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
							<a>Transaksi</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="table-transaksi">
				<div class="order">
					<div class="head">
						<h3>Transaksi</h3>
        			</div>
        			<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Email</th>
								<th>Alamat</th>
								<th>Tanggal</th>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Total Produk</th>
								<th>Ongkir</th>
								<th>Total Harga</th>
								<th>Metode</th>
								<th>Bukti Transfer</th>
								<th>Status</th>
								<th>No. Resi</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$result = $koneksi->query('SELECT * FROM transaksi ORDER BY tanggal DESC ');

							if ($result) {
								while ($obj = $result->fetch_object()) {
									$sql2 = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '".$obj->email."'");
										if (mysqli_num_rows($sql2) > 0) {
											while ($result2 = mysqli_fetch_assoc($sql2)) {
									?>
									<form action="" method="POST">
                					<input type="hidden" name="id_transaksi" value="<?php echo $obj->id_transaksi ?>">
										<tr>
											<td><?php echo $obj->id_transaksi ?></td>
											<td><?php echo $obj->email ?></td>
											<td><?php echo $result2['alamat']; ?></td>
											<td><?php echo $obj->tanggal ?></td>
											<td><?php echo $obj->nama_produk ?></td>
											<td>Rp<?php echo number_format($obj->harga, 0, ',', '.'); ?></td>
											<td><?php echo $obj->total_produk ?></td>
											<td>Rp<?php echo number_format($obj->ongkir, 0, ',', '.'); ?></td>
											<td>Rp<?php echo number_format($obj->total_harga, 0, ',', '.'); ?></td>
											<td><?php echo $obj->metode ?></td>
											<td>
												<?php
												if ($obj->bukti == '') {
												} else { ?>
													<img src="../assets/images/bukti/<?php echo $obj->bukti?>" onclick="document.getElementById('modal').style.display='block';document.getElementById('modal-img').src=this.src;">
													<div id="modal" class="modal" onclick="this.style.display='none'">
														<span class="close" onclick="document.getElementById('modal').style.display='none'">&times;</span>
														<img id="modal-img" class="modal-content">
													</div>
												<?php } ?>
											</td>
											<td>
												<select name="status" class="form-select">
													<option selected><?php echo $obj->status ?></option>
													<option value="Verifikasi Pembayaran">Verifikasi Pembayaran</option>
													<option value="Sedang Dikemas">Sedang Dikemas</option>
													<option value="Sedang Diantar">Sedang Diantar</option>
													<option value="Pesanan Berhasil">Pesanan Berhasil</option>
													<option value="Pesanan Gagal">Pesanan Gagal</option>
													<option value="Pesanan Batal">Pesanan Batal</option>
												</select>
											</td>
											<td><?php echo $obj->no_resi ?></td>
											<td>
												<button type="submit" name="update" class="status pending" required>Update</button><br><br>
												<a href="transaksi-hapus.php?id=<?php echo $obj->id_transaksi ?>"><span class="status pendingg">Hapus</span></a>
											</td>
										</tr> 
									</form><?php
											}
										}
								}
							} ?>
						</tbody>
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