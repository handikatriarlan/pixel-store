-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 03:43 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pixel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `stok` int(255) NOT NULL,
  `harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `gambar`, `deskripsi`, `stok`, `harga`) VALUES
(1, 'LOGITECH K380 MULTI DEVICE', 'a.jpg', 'Minimalis, modern, dan mudah dibawa. K380 Multi-Device keyboard yang tipis dan ringan ini dilengkapi dengan Bluetooth® sehingga kamu bisa melakukan multitasking di rumah, dalam perjalanan, atau di kafe favoritmu. Mengetik di laptop, ponsel, atau tablet dan kuasai ruang gerakmu di mana pun kamu berada.', 42, 450000),
(2, 'Ajazz Gaming AK33\r\n', 'b.jpg', 'Ajazz mechanical gaming keyboard hadir dengan Blue Switch yang memberikan respon feedback yang baik pada saat penggunaan. Desain keren ala gamer dengan panel logam yang terintegrasi membuat keyboard ini sangat kuat dan tahan lama. Dilengkapi LED RGB yang makin membuat keyboard ini terlihat keren.\r\n', 35, 1057000),
(3, 'Magic Keyboard IPad\r\n', 'c.jpg', 'Smart Keyboard Folio untuk iPad Pro dan iPad Air adalah keyboard yang nyaman saat Anda membutuhkannya, dan memberikan perlindungan depan dan belakang yang elegan saat Anda tidak membutuhkannya. Dengan dua sudut pandang yang nyaman dan tidak perlu mengisi daya atau memasangkan, Anda cukup memasang keyboard dan mulai mengetik.', 30, 4099000),
(4, 'AKKO 3084 SILENT', 'd.jpg', 'AKKO Morandi Bluetooth Wireles Mechanical Gaming Keyboard Switch 84 Keys PBT Computer Gamer. \r\nConnection method: Wireless\r\nInterface type: USB Bluetooth\r\nModel: Quiet Bluetooth 5.0\r\n', 44, 1299000),
(5, 'RK61 GAMING KEYBOARD \r\n', 'e.jpg', 'RK61 Keyboard kantor Gaming lampu latar mekanis berkabel Bluetooth nirkabel portabel untuk Android/Windows/iOS\r\n', 24, 1473000),
(6, 'Anne PRO2 60% Mechanical', 'f.png', 'Ini dia 60% compact Wireless Mechanical Keyboard paling HYPE dan MANTAP. Dengan fitur 2 tombol FN dan 1 Magic FN memberikan pengalaman pengetikan terbaik (hingga 3 layer macro) dan dapat terhubung hingga 4 bluetooh device tentu sangat praktis.\r\n', 11, 259000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(100) NOT NULL,
  `nama_produk` varchar(40) NOT NULL,
  `harga` int(30) NOT NULL,
  `total_produk` int(255) NOT NULL,
  `ongkir` int(20) NOT NULL,
  `total_harga` int(30) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Verifikasi Pembayaran',
  `no_resi` varchar(40) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `metode` varchar(50) NOT NULL DEFAULT 'E-Wallet'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
