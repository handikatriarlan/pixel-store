<?php
session_start();
require_once("../config/koneksi.php");

if(isset($_SESSION['email'])) {
    if (isset($_POST['edit'])) {
        $id_admin = $_POST['id_admin'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Escape user input to prevent SQL injection
        $nama = mysqli_real_escape_string($koneksi, $nama);
        $email = mysqli_real_escape_string($koneksi, $email);
        $password = mysqli_real_escape_string($koneksi, $password);

        if($password!="") {
            $edit = mysqli_query($koneksi, "UPDATE admin SET password='$password' WHERE id_admin='$id_admin'");
          }
        $edit = mysqli_query($koneksi, "UPDATE admin SET nama='$nama', email='$email' WHERE id_admin='$id_admin'");

        if ($edit) {
            echo "<script>alert('Data berhasil diedit'); window.location.href='pengaturan.php';</script>";
        }
    }

    if (isset($_GET['id'])) {
        $id_admin = $_GET['id'];
        $sql = $koneksi->query("SELECT * FROM admin WHERE id_admin='$id_admin'");
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

	<title>Lavieenbleu Admin</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar" class="hide">
		<a href="index.php" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">LavieenbleuAdmin</span>
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
							<a>Edit Admin</a>
						</li>
					</ul>
                </div>
            </div>

            <div class="table-data-produk">
                <div class="order">
                    <div class="head">
                        <h3>Edit Admin</h3>
                    </div>
                    <form method="post" action="">
						<input type="hidden" name="id_admin" value="<?php echo $obj->id_admin; ?>">
						<div class="field input">
							<label for="spek">Email</label>
							<input type="text" name="email" pattern="[^ @]*@[^ @]*" class="form-control" value="<?php echo $obj->email; ?>"required>
						</div>
						<div class="field input">
							<label for="harga">Nama</label>
							<input type="text" name="nama" class="form-control" value="<?php echo $obj->nama; ?>" required>
						</div>
						<div class="field input">
							<label for="stok">Password</label>
							<input type="password" name="password" class="form-control">
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
