-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2020 at 09:57 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdp_consignment`
--
CREATE DATABASE IF NOT EXISTS `sdp_consignment` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sdp_consignment`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `ADMINP_ID` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `NAMA_ADMINP` char(50) DEFAULT NULL,
  `PASSWORD_ADMINP` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ADMINP_ID`, `email`, `NAMA_ADMINP`, `PASSWORD_ADMINP`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0', 'admin1@admin.com', 'admin1', 'admin1', '2020-11-04', '2020-11-12', NULL),
('1', 'admin2@admin.com', 'admin2', 'admin2', '2020-11-04', '2020-11-04', NULL),
('2', 'admin3@admin.com', 'admin3', 'admin3', '2020-11-04', '2020-11-04', NULL),
('3', 'admin4@admin.com', 'admin4', 'admin4', '2020-11-12', '2020-11-12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks` (
  `bank_id` int(11) NOT NULL,
  `nama_bank` varchar(30) DEFAULT NULL,
  `rekening` varchar(20) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `nama_bank`, `rekening`, `pemilik`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bank Rakyat Indonesia', '5230001', 'Michael Louis Chandra', '2020-11-11', '2020-11-11', NULL),
(2, 'Bank MandirI', '5230002', 'Michael Louis Chandra', '2020-11-11', '2020-11-11', NULL),
(3, 'Bank Central Asia ', '5230003', 'Michael Louis Chandra', '2020-11-11', '2020-11-11', NULL),
(4, 'Bank Negara Indonesia', '5230004', 'Michael Louis Chandra', '2020-11-11', '2020-11-11', NULL),
(5, 'Bank Tabungan Negara', '5230005', 'Michael Louis Chandra', '2020-11-11', '2020-11-11', NULL),
(6, 'Bank CIMB Niaga', '5230006', 'Michael Louis Chandra', '2020-11-11', '2020-11-11', NULL),
(7, 'Bank BTPN', '5230007', 'Michael Louis Chandra', '2020-11-11', '2020-11-11', NULL),
(8, 'Panin Bank', '5230008', 'Michael Louis Chandra', '2020-11-11', '2020-11-11', NULL),
(9, 'Bank OCBC NISP', '5230009', 'Michael Louis Chandra', '2020-11-11', '2020-11-11', NULL),
(10, 'Bank Maybank Indonesia', '5230010', 'Michael Louis Chandra', '2020-11-11', '2020-11-11', NULL),
(11, 'Jenius', '5230011', 'Michael Louis Chandra', '2020-11-04', '2020-11-04', NULL),
(12, 'Bank BRI Syariah', '52300112', 'Michael Louis Chandra', '2020-11-12', '2020-11-12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenisbarangs`
--

DROP TABLE IF EXISTS `jenisbarangs`;
CREATE TABLE `jenisbarangs` (
  `JENIS_ID` varchar(5) NOT NULL,
  `NAMA_JENIS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenisbarangs`
--

INSERT INTO `jenisbarangs` (`JENIS_ID`, `NAMA_JENIS`) VALUES
('1', 'Headset'),
('2', 'Mouse'),
('3', 'Keyboard'),
('4', 'Laptop'),
('5', 'Wallet');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_barang`
--

DROP TABLE IF EXISTS `kondisi_barang`;
CREATE TABLE `kondisi_barang` (
  `KONDISI_ID` varchar(5) NOT NULL,
  `JENIS_KONDISI` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kondisi_barang`
--

INSERT INTO `kondisi_barang` (`KONDISI_ID`, `JENIS_KONDISI`) VALUES
('KOND0', '-RATING-'),
('KOND1', 'BAIK'),
('KOND2', 'BAGUS'),
('KOND3', 'SANGAT BAGUS');

-- --------------------------------------------------------

--
-- Table structure for table `merkbarangs`
--

DROP TABLE IF EXISTS `merkbarangs`;
CREATE TABLE `merkbarangs` (
  `MERK_ID` varchar(5) NOT NULL,
  `NAMA_MERK2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merkbarangs`
--

INSERT INTO `merkbarangs` (`MERK_ID`, `NAMA_MERK2`) VALUES
('1', 'Logitech'),
('2', 'Razer'),
('3', 'SteelSeries'),
('4', 'Tazer');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_11_16_115253_create_images_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuans`
--

DROP TABLE IF EXISTS `pengajuans`;
CREATE TABLE `pengajuans` (
  `ADMINP_ID` varchar(10) DEFAULT NULL,
  `MERK_ID` varchar(5) DEFAULT NULL,
  `KONDISI_ID` varchar(5) DEFAULT NULL,
  `PENGAJUAN_ID` int(5) NOT NULL,
  `USERPB_ID` varchar(5) DEFAULT NULL,
  `email_penjual` varchar(1000) NOT NULL,
  `TRANSAKSI_ID` varchar(5) DEFAULT NULL,
  `JENIS_ID` varchar(5) DEFAULT NULL,
  `NAMA_BARANG` varchar(25) DEFAULT NULL,
  `TGL_PENGAJUAN` datetime DEFAULT NULL,
  `WARNA_BARANGP` varchar(15) DEFAULT NULL,
  `PERSENTASE_KUALITAS` int(11) DEFAULT NULL,
  `FUNGSIONALITAS` varchar(100) DEFAULT NULL,
  `DESKRIPSI_BARANG` varchar(100) DEFAULT NULL,
  `STATUS_PENGAJUAN` varchar(1) DEFAULT NULL,
  `STATUS_BARANG` varchar(1) DEFAULT NULL,
  `FOTO_KIRI` varchar(1000) DEFAULT NULL,
  `FOTO_KANAN` varchar(1000) DEFAULT NULL,
  `FOTO_ATAS` varchar(1000) DEFAULT NULL,
  `FOTO_BAWAH` varchar(1000) DEFAULT NULL,
  `FOTO_DEPAN` varchar(1000) DEFAULT NULL,
  `FOTO_BELAKANG` varchar(1000) DEFAULT NULL,
  `HARGA_MIN` int(11) DEFAULT NULL,
  `HARGA_MAX` int(11) DEFAULT NULL,
  `HARGA_APPROVE` int(11) DEFAULT NULL,
  `HARGA_JASA` int(11) DEFAULT NULL,
  `USERPB_IDENTITY` varchar(1000) DEFAULT NULL,
  `bank_id` varchar(5) DEFAULT NULL,
  `USERPB_NOREK` varchar(20) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `alasan` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuans`
--

INSERT INTO `pengajuans` (`ADMINP_ID`, `MERK_ID`, `KONDISI_ID`, `PENGAJUAN_ID`, `USERPB_ID`, `email_penjual`, `TRANSAKSI_ID`, `JENIS_ID`, `NAMA_BARANG`, `TGL_PENGAJUAN`, `WARNA_BARANGP`, `PERSENTASE_KUALITAS`, `FUNGSIONALITAS`, `DESKRIPSI_BARANG`, `STATUS_PENGAJUAN`, `STATUS_BARANG`, `FOTO_KIRI`, `FOTO_KANAN`, `FOTO_ATAS`, `FOTO_BAWAH`, `FOTO_DEPAN`, `FOTO_BELAKANG`, `HARGA_MIN`, `HARGA_MAX`, `HARGA_APPROVE`, `HARGA_JASA`, `USERPB_IDENTITY`, `bank_id`, `USERPB_NOREK`, `created_at`, `updated_at`, `deleted_at`, `alasan`) VALUES
('1', '1', 'KOND0', 3, '0', 'yungming6@gmail.com', '0', '1', 'YA BARANG', '2020-11-13 14:46:11', '#000000', 0, 'asdasd', 'Ini sudah jelas', '1', '0', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 'https://images-na.ssl-images-amazon.com/images/I/71-QPWNH%2BVL._AC_SX466_.jpg', 'https://lh3.googleusercontent.com/proxy/NIIlc6fQTkpQt7qGlx1UzzjqT1P6zxIQXOEGTlA-n2gLiXpanEmeKCXw_VExH_t5gXmkjdhGhx2H7txFN6PABgs0Aeey9hL2Ejn_YCyhQDDCjaEk7ZE4cx7k_JGlXTD0b7kuzzz6wNYN0FKQrXw0IFUmmq-sQykbr4gNucZqY1vKiQ8jnDmFUr5VX4HVcsYJ_2Z2A1NeBTrKXpn_U2Z4kpaaoSG5MWqN', 'https://images-na.ssl-images-amazon.com/images/I/71-QPWNH%2BVL._AC_SX466_.jpg', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 'https://lh3.googleusercontent.com/proxy/NIIlc6fQTkpQt7qGlx1UzzjqT1P6zxIQXOEGTlA-n2gLiXpanEmeKCXw_VExH_t5gXmkjdhGhx2H7txFN6PABgs0Aeey9hL2Ejn_YCyhQDDCjaEk7ZE4cx7k_JGlXTD0b7kuzzz6wNYN0FKQrXw0IFUmmq-sQykbr4gNucZqY1vKiQ8jnDmFUr5VX4HVcsYJ_2Z2A1NeBTrKXpn_U2Z4kpaaoSG5MWqN', 1000000, 2000000, 1000000, 0, 'https://images.bisnis-cdn.com/posts/2019/02/27/894082/e-ktp-guohui-chen.jpg', '1', '123123123', '2020-11-13', '2020-11-16', NULL, 'Deskripsi barang tidak jelas!!!'),
('0', '1', 'KOND0', 4, '0', 'asd@asd.asd', '0', '1', 'asd', '2020-11-16 23:16:34', '', 0, 'Ngerungokno suara gendang', 'dudududut', '0', '0', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 'https://lh3.googleusercontent.com/proxy/NIIlc6fQTkpQt7qGlx1UzzjqT1P6zxIQXOEGTlA-n2gLiXpanEmeKCXw_VExH_t5gXmkjdhGhx2H7txFN6PABgs0Aeey9hL2Ejn_YCyhQDDCjaEk7ZE4cx7k_JGlXTD0b7kuzzz6wNYN0FKQrXw0IFUmmq-sQykbr4gNucZqY1vKiQ8jnDmFUr5VX4HVcsYJ_2Z2A1NeBTrKXpn_U2Z4kpaaoSG5MWqN', 'https://lh3.googleusercontent.com/proxy/NIIlc6fQTkpQt7qGlx1UzzjqT1P6zxIQXOEGTlA-n2gLiXpanEmeKCXw_VExH_t5gXmkjdhGhx2H7txFN6PABgs0Aeey9hL2Ejn_YCyhQDDCjaEk7ZE4cx7k_JGlXTD0b7kuzzz6wNYN0FKQrXw0IFUmmq-sQykbr4gNucZqY1vKiQ8jnDmFUr5VX4HVcsYJ_2Z2A1NeBTrKXpn_U2Z4kpaaoSG5MWqN', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 1, 2, 0, 0, '', NULL, NULL, '2020-11-16', '2020-11-16', '2020-11-16', NULL),
('0', '1', 'KOND0', 5, '0', 'yungming6@gmail.com', '0', '1', 'asd', '2020-11-17 15:56:08', '', 0, 'cursor pada layar', 'asd', '0', '0', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 'https://www.meijer.com/content/dam/meijer/product/0009/78/5508/05/0009785508059_1200.png', 1, 1, 0, 0, '', NULL, NULL, '2020-11-17', '2020-11-17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman_danas`
--

DROP TABLE IF EXISTS `pengiriman_danas`;
CREATE TABLE `pengiriman_danas` (
  `PDANA_ID` varchar(5) NOT NULL,
  `TRANSAKSI_ID` varchar(5) NOT NULL,
  `ADMINP_ID` varchar(10) DEFAULT NULL,
  `BUKTI_PENGIRIMAN` longblob DEFAULT NULL,
  `TOTAL_DANA` int(11) DEFAULT NULL,
  `RANGE_HARGA_JASA` int(11) DEFAULT NULL,
  `TGL_PENGIRIMAN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rekeningtokos`
--

DROP TABLE IF EXISTS `rekeningtokos`;
CREATE TABLE `rekeningtokos` (
  `REKENING_ID` varchar(5) NOT NULL,
  `NOMOR_REKENING` varchar(12) DEFAULT NULL,
  `JENIS_BANK` varchar(10) DEFAULT NULL,
  `NAMA_PEMILIK` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekeningtokos`
--

INSERT INTO `rekeningtokos` (`REKENING_ID`, `NOMOR_REKENING`, `JENIS_BANK`, `NAMA_PEMILIK`) VALUES
('0', 'def', 'def', 'def');

-- --------------------------------------------------------

--
-- Table structure for table `returs`
--

DROP TABLE IF EXISTS `returs`;
CREATE TABLE `returs` (
  `RETUR_ID` varchar(5) NOT NULL,
  `TRANSAKSI_ID` varchar(5) NOT NULL,
  `ADMINP_ID` varchar(10) DEFAULT NULL,
  `DESKRIPSI_RETUR` varchar(250) DEFAULT NULL,
  `LINK_VIDEO` varchar(250) DEFAULT NULL,
  `BUKTI_PENGEMBALIAN` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

DROP TABLE IF EXISTS `transaksis`;
CREATE TABLE `transaksis` (
  `TRANSAKSI_ID` varchar(5) NOT NULL,
  `USERPB_ID` varchar(5) NOT NULL,
  `REKENING_ID` varchar(5) DEFAULT NULL,
  `HARGA_TOTAL` int(11) DEFAULT NULL,
  `TGL_TRANSAKSI` datetime DEFAULT NULL,
  `BUKTI_TRANSAKSI` varchar(100) DEFAULT NULL,
  `NO_RESI` varchar(50) DEFAULT NULL,
  `KEUNTUNGAN_JASA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`TRANSAKSI_ID`, `USERPB_ID`, `REKENING_ID`, `HARGA_TOTAL`, `TGL_TRANSAKSI`, `BUKTI_TRANSAKSI`, `NO_RESI`, `KEUNTUNGAN_JASA`) VALUES
('0', '0', '0', 0, '2020-10-09 02:10:26', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userpembelis`
--

DROP TABLE IF EXISTS `userpembelis`;
CREATE TABLE `userpembelis` (
  `USERPB_ID` varchar(5) NOT NULL,
  `USERPB_NAME` varchar(50) DEFAULT NULL,
  `USERPB_EMAIL` varchar(50) DEFAULT NULL,
  `USERPB_PHONE_NUMBER` varchar(20) DEFAULT NULL,
  `USERPB_ADDRESS` varchar(50) DEFAULT NULL,
  `USERPB_PASSWORD` varchar(100) DEFAULT NULL,
  `NIK` varchar(100) DEFAULT NULL,
  `FOTO_KTP` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userpembelis`
--

INSERT INTO `userpembelis` (`USERPB_ID`, `USERPB_NAME`, `USERPB_EMAIL`, `USERPB_PHONE_NUMBER`, `USERPB_ADDRESS`, `USERPB_PASSWORD`, `NIK`, `FOTO_KTP`) VALUES
('0', '0', 'def@def.def', '000000', 'def', 'def', NULL, NULL),
('1', 'ming1', 'yungming6@gmail.com', '082233101007', 'lokasiA', 'asd', NULL, NULL),
('2', 'asdasd', 'asd@asd.asd', '082233101008', 'lokasiBSD', 'asdasdasd', NULL, NULL),
('3', 'ko keset', 'ko@ko.ko', '082233101009', 'lokasiBSDe', 'asdasdasd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ADMINP_ID`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenisbarangs`
--
ALTER TABLE `jenisbarangs`
  ADD PRIMARY KEY (`JENIS_ID`);

--
-- Indexes for table `kondisi_barang`
--
ALTER TABLE `kondisi_barang`
  ADD PRIMARY KEY (`KONDISI_ID`);

--
-- Indexes for table `merkbarangs`
--
ALTER TABLE `merkbarangs`
  ADD PRIMARY KEY (`MERK_ID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuans`
--
ALTER TABLE `pengajuans`
  ADD PRIMARY KEY (`PENGAJUAN_ID`),
  ADD KEY `FK_PENGAJUA_BERMEREK_MERKBARA` (`MERK_ID`),
  ADD KEY `FK_PENGAJUA_MEJUAL_TRANSAKS` (`TRANSAKSI_ID`),
  ADD KEY `FK_PENGAJUA_MEMPUNYAI_KONDISI_` (`KONDISI_ID`),
  ADD KEY `FK_PENGAJUA_MENANGANI_ADMIN` (`ADMINP_ID`),
  ADD KEY `FK_PENGAJUA_MENGAJUKA_USERPEMB` (`USERPB_ID`),
  ADD KEY `FK_JENISBAR_BERJENISB_PENGAJUA` (`JENIS_ID`);

--
-- Indexes for table `pengiriman_danas`
--
ALTER TABLE `pengiriman_danas`
  ADD PRIMARY KEY (`PDANA_ID`),
  ADD KEY `FK_PENGIRIM_MEMBAYARK_TRANSAKS` (`TRANSAKSI_ID`),
  ADD KEY `FK_PENGIRIM_MENGIRIM_ADMIN` (`ADMINP_ID`);

--
-- Indexes for table `rekeningtokos`
--
ALTER TABLE `rekeningtokos`
  ADD PRIMARY KEY (`REKENING_ID`);

--
-- Indexes for table `returs`
--
ALTER TABLE `returs`
  ADD PRIMARY KEY (`RETUR_ID`),
  ADD KEY `FK_RETUR_MENANGANI_ADMIN` (`ADMINP_ID`),
  ADD KEY `FK_RETUR_MENGEMBAL_TRANSAKS` (`TRANSAKSI_ID`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`TRANSAKSI_ID`),
  ADD KEY `FK_TRANSAKS_MEMBELI_USERPEMB` (`USERPB_ID`),
  ADD KEY `FK_TRANSAKS_MENGGUNAK_REKENING` (`REKENING_ID`);

--
-- Indexes for table `userpembelis`
--
ALTER TABLE `userpembelis`
  ADD PRIMARY KEY (`USERPB_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengajuans`
--
ALTER TABLE `pengajuans`
  MODIFY `PENGAJUAN_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengajuans`
--
ALTER TABLE `pengajuans`
  ADD CONSTRAINT `FK_JENISBAR_BERJENISB_PENGAJUA` FOREIGN KEY (`JENIS_ID`) REFERENCES `jenisbarangs` (`JENIS_ID`),
  ADD CONSTRAINT `FK_PENGAJUA_BERMEREK_MERKBARA` FOREIGN KEY (`MERK_ID`) REFERENCES `merkbarangs` (`MERK_ID`),
  ADD CONSTRAINT `FK_PENGAJUA_MEJUAL_TRANSAKS` FOREIGN KEY (`TRANSAKSI_ID`) REFERENCES `transaksis` (`TRANSAKSI_ID`),
  ADD CONSTRAINT `FK_PENGAJUA_MEMPUNYAI_KONDISI_` FOREIGN KEY (`KONDISI_ID`) REFERENCES `kondisi_barang` (`KONDISI_ID`),
  ADD CONSTRAINT `FK_PENGAJUA_MENANGANI_ADMIN` FOREIGN KEY (`ADMINP_ID`) REFERENCES `admins` (`ADMINP_ID`),
  ADD CONSTRAINT `FK_PENGAJUA_MENGAJUKA_USERPEMB` FOREIGN KEY (`USERPB_ID`) REFERENCES `userpembelis` (`USERPB_ID`);

--
-- Constraints for table `pengiriman_danas`
--
ALTER TABLE `pengiriman_danas`
  ADD CONSTRAINT `FK_PENGIRIM_MEMBAYARK_TRANSAKS` FOREIGN KEY (`TRANSAKSI_ID`) REFERENCES `transaksis` (`TRANSAKSI_ID`),
  ADD CONSTRAINT `FK_PENGIRIM_MENGIRIM_ADMIN` FOREIGN KEY (`ADMINP_ID`) REFERENCES `admins` (`ADMINP_ID`);

--
-- Constraints for table `returs`
--
ALTER TABLE `returs`
  ADD CONSTRAINT `FK_RETUR_MENANGANI_ADMIN` FOREIGN KEY (`ADMINP_ID`) REFERENCES `admins` (`ADMINP_ID`),
  ADD CONSTRAINT `FK_RETUR_MENGEMBAL_TRANSAKS` FOREIGN KEY (`TRANSAKSI_ID`) REFERENCES `transaksis` (`TRANSAKSI_ID`);

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `FK_TRANSAKS_MEMBELI_USERPEMB` FOREIGN KEY (`USERPB_ID`) REFERENCES `userpembelis` (`USERPB_ID`),
  ADD CONSTRAINT `FK_TRANSAKS_MENGGUNAK_REKENING` FOREIGN KEY (`REKENING_ID`) REFERENCES `rekeningtokos` (`REKENING_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
