<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_SESSION['email'])) {
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $nama_produk = $_POST['nama_produk'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // Escape user input to prevent SQL injection
        $nama_produk = mysqli_real_escape_string($koneksi, $nama_produk);
        $deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);
        $harga = mysqli_real_escape_string($koneksi, $harga);
        $stok = mysqli_real_escape_string($koneksi, $stok);

        $edit = mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga='$harga', stok='$stok' WHERE id_produk='$id'");
		
		if ($edit) {
			echo "<script>alert('Produk berhasil diedit'); window.location.href='produk.php';</script>";
		}		
			
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id'");
        if ($sql) {
            $obj = $sql->fetch_object();
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
							<a>Edit Produk</a>
						</li>
					</ul>
                </div>
            </div>

            <div class="table-data-produk">
                <div class="order">
                    <div class="head">
                        <h3>Produk</h3>
                    </div>
					<form method="post" action="">
						<input type="hidden" name="id" value="<?php echo $obj->id_produk; ?>">
						<div class="field input">
							<label for="nama_produk">Nama Produk</label>
							<input type="text" name="nama_produk" value="<?php echo $obj->nama_produk; ?>" required>
						</div>
						<div class="field input">
							<label for="deskripsi">Deskripsi</label>
							<input  type="text" name="deskripsi" value="<?php echo $obj->deskripsi; ?>" required></input>
						</div>
						<div class="field input">
							<label for="harga">Harga</label>
							<input type="number" name="harga" value="<?php echo $obj->harga ?>" required>
						</div>
						<div class="field input">
							<label for="stok">Jumlah Stok</label>
							<input type="number" name="stok" value="<?php echo $obj->stok; ?>" required>
						</div>
						<div class="field input">
							<div class="head">
								<button type="submit" name="edit" class="biru" value="Simpan" required>Edit</button>
							</div>
						</div>
						<?php
							}
						}
						?>
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
}
?>
