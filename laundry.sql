-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2020 at 07:12 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(20) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `sub_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_jenis`, `sub_total`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '35000', '7', '2020-02-24 00:21:27', '2020-03-03 23:38:13'),
(3, 9, 4, '15000', '6', '2020-02-25 00:12:12', '2020-02-25 00:12:12'),
(4, 2, 2, '60000', '6', '2020-02-25 00:12:17', '2020-02-25 00:12:17'),
(5, 2, 3, '30000', '10', '2020-02-25 00:12:24', '2020-02-25 00:12:24'),
(6, 1, 2, '100000', '10', '2020-02-25 00:12:29', '2020-02-25 00:12:29'),
(7, 11, 1, '25000', '5', '2020-03-03 23:35:47', '2020-03-03 23:35:47'),
(9, 14, 2, '100000', '10', '2020-03-03 23:36:24', '2020-03-03 23:36:24'),
(11, 15, 5, '40000', '10', '2020-03-04 00:12:27', '2020-03-04 00:12:27'),
(12, 15, 2, '50000', '5', '2020-03-04 00:14:35', '2020-03-04 00:14:35'),
(13, 15, 3, '15000', '5', '2020-03-04 00:14:37', '2020-03-04 00:14:37'),
(14, 15, 4, '7500', '3', '2020-03-04 00:14:47', '2020-03-04 00:14:47'),
(16, 14, 4, '10000', '4', '2020-03-22 23:02:25', '2020-03-22 23:02:25'),
(17, 14, 3, '12000', '4', '2020-03-22 23:02:27', '2020-03-22 23:02:27'),
(18, 14, 1, '20000', '4', '2020-03-22 23:02:32', '2020-03-22 23:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_cuci`
--

CREATE TABLE `jenis_cuci` (
  `id_jenis` int(20) NOT NULL,
  `nama_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_per_kg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_cuci`
--

INSERT INTO `jenis_cuci` (`id_jenis`, `nama_jenis`, `harga_per_kg`, `created_at`, `updated_at`) VALUES
(1, 'Cuci Kering', '5000', '2020-02-23 23:55:13', '2020-02-23 23:55:13'),
(2, 'Cuci Kering Setrika', '10000', '2020-02-23 23:55:24', '2020-02-23 23:55:24'),
(3, 'Cuci Basah', '3000', '2020-02-23 23:55:35', '2020-02-23 23:55:35'),
(4, 'Setrika', '2500', '2020-02-23 23:55:46', '2020-02-23 23:56:40'),
(5, 'Cuci Kering Selimut', '4000', '2020-03-03 23:19:44', '2020-03-03 23:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2020_02_19_062127_create_pelanggan_table', 1),
(4, '2020_02_19_062300_create_jenis_cuci_table', 1),
(5, '2020_02_19_062417_create_transaksi_table', 1),
(6, '2020_02_19_062551_create_detail_transaksi_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telp`, `created_at`, `updated_at`) VALUES
(1, 'Ananda Rafi Amanullah', 'Kota Probolinggo', '082231954774', NULL, NULL),
(3, 'Ananda Rafi Amanullah', 'Kota Probolinggo', '082231954774', '2020-02-23 23:53:56', '2020-02-23 23:53:56'),
(4, 'Bambang', 'Malang', '825123124151231', '2020-02-24 00:00:15', '2020-02-24 00:00:15'),
(5, 'Faiz', 'SURABAYA', '084123125131231', '2020-03-03 23:17:45', '2020-03-03 23:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(20) NOT NULL,
  `nama_petugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `telp`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Ananda Rafi Amanullah', '082231954774', 'anndrf_', 'rafi1234', 'admin', NULL, NULL),
(2, 'Bambang', '082231954774', 'Bambang', 'bambang1', 'petugas', NULL, NULL),
(7, 'Anandarafi', '0823415212313', 'anndrf1', '$2y$10$PLr/H4FLDyvzSoqZU17fRuRQM56xt4iBLAJVIMllFTXG98tVeefTi', 'admin', NULL, NULL),
(8, 'rafi', '082314123141', 'ananda1', '$2y$10$8HWwHYR6LPtMRAC8kvqjAuRRAe2Cd/ShR9PyreW5csG1.r/A7gcZy', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(20) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `id_petugas`, `tgl_transaksi`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-02-24', '2020-02-26', '2020-02-23 23:58:30', '2020-02-23 23:58:30'),
(2, 1, 2, '2020-02-24', '2020-02-25', NULL, NULL),
(9, 3, 2, '2020-02-26', '2020-02-28', NULL, NULL),
(10, 5, 7, '2020-03-04', '2020-03-06', NULL, NULL),
(11, 4, 2, '2020-03-03', '2020-03-04', NULL, NULL),
(14, 5, 2, '2020-03-05', '2020-03-06', NULL, NULL),
(15, 5, 8, '2020-03-04', '2020-03-05', NULL, NULL),
(17, 4, 8, '2020-03-22', '2020-03-23', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`,`id_jenis`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `jenis_cuci`
--
ALTER TABLE `jenis_cuci`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`,`id_petugas`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jenis_cuci`
--
ALTER TABLE `jenis_cuci`
  MODIFY `id_jenis` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_cuci` (`id_jenis`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
