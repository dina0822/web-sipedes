-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2026 at 02:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipedes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `tujuan` text NOT NULL,
  `instansi` varchar(150) NOT NULL,
  `keterangan` text NOT NULL,
  `cara_ambil` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'menunggu',
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_kk` varchar(255) DEFAULT NULL,
  `foto_surat_rt` varchar(255) DEFAULT NULL,
  `ttd_kades` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `nik`, `jenis_surat`, `tujuan`, `instansi`, `keterangan`, `cara_ambil`, `status`, `foto_ktp`, `foto_kk`, `foto_surat_rt`, `ttd_kades`) VALUES
(1, '3209056', 'Surat Domisili', 'keperluan administrasi sekolah', 'sekolah', '', 'Unduh PDF', 'menunggu', NULL, NULL, NULL, NULL),
(2, '3209056', 'Surat Domisili', 'keperluan administrasi sekolah', 'sekolah', '', 'Unduh PDF', 'menunggu', NULL, NULL, NULL, NULL),
(3, '3209057', 'Pengantar KTP / KK', 'keperluan pembukaan rekening bank', 'bank', '', 'Unduh PDF', 'menunggu', NULL, NULL, NULL, NULL),
(4, '3209057', 'Pengantar KTP / KK', 'keperluan pembukaan rekening bank', 'bank', '', 'Ambil di Kantor Desa', 'menunggu', NULL, NULL, NULL, NULL),
(5, '3209056', 'Pengantar KTP / KK', 'keperluan pembukaan rekening bank', 'bank', '', 'Ambil di Kantor Desa', 'ditolak', NULL, NULL, NULL, NULL),
(6, '3209054', 'Surat Domisili', 'keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'menunggu', '1781934194_WhatsApp Image 2025-10-25 at 10.29.10_df526132.jpg', '1781934194_WhatsApp Image 2025-10-25 at 10.29.16_55948c33.jpg', '1781934194_WhatsApp Image 2025-10-25 at 10.31.14_c7da1ff7.jpg', NULL),
(7, '3209054', 'Surat Domisili', 'keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'menunggu', NULL, NULL, NULL, NULL),
(8, '3209054', 'Surat Domisili', 'untuk keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'ditolak', NULL, NULL, NULL, NULL),
(9, '3209054', 'Surat Domisili', 'untuk keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'menunggu', NULL, NULL, NULL, NULL),
(10, '3209054', 'Surat Domisili', 'untuk keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'menunggu', NULL, NULL, NULL, NULL),
(11, '3209054', 'Surat Domisili', 'untuk keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'menunggu', NULL, NULL, NULL, NULL),
(12, '3209054', 'Surat Domisili', 'untuk keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'menunggu', NULL, NULL, NULL, NULL),
(13, '3209054', 'Surat Domisili', 'untuk keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'menunggu', NULL, NULL, NULL, NULL),
(14, '3209054', 'Surat Domisili', 'untuk keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'menunggu', NULL, NULL, NULL, NULL),
(15, '3209054', 'Surat Domisili', 'untuk keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'menunggu', NULL, NULL, NULL, NULL),
(16, '3209054', 'Surat Domisili', 'untuk keperluan administrasi sekolah', 'sekolah', '', 'Unduh PDF', 'menunggu', '1781949174_WhatsApp Image 2025-10-25 at 10.29.16_55948c33.jpg', '1781949174_WhatsApp Image 2025-10-25 at 10.29.10_df526132.jpg', '1781949174_WhatsApp Image 2025-10-25 at 10.30.07_46c76151.jpg', NULL),
(17, '3209054', 'Surat Domisili', 'untuk keperluan administrasi sekolah', 'sekolah', '', 'Ambil di Kantor Desa', 'menunggu', '1782006601_WhatsApp Image 2025-10-25 at 10.29.10_df526132.jpg', '1782006601_WhatsApp Image 2025-10-25 at 10.29.16_55948c33.jpg', '1782006601_WhatsApp Image 2025-10-25 at 10.30.07_46c76151.jpg', NULL),
(18, '3209054', 'Surat Domisili', 'Administrasi Sekolah', 'Sekolah', '', 'Unduh PDF', 'menunggu', '1782645933_WhatsApp Image 2025-10-25 at 10.30.07_46c76151.jpg', '1782645933_WhatsApp Image 2025-10-25 at 10.30.07_46c76151.jpg', '1782645933_WhatsApp Image 2025-10-25 at 10.29.16_55948c33.jpg', NULL),
(19, '3209054', 'Surat Domisili', 'Administrasi Sekolah', 'Sekolah', '', 'Unduh PDF', 'menunggu', '1782649987_WhatsApp Image 2025-10-25 at 10.29.10_df526132.jpg', '1782649987_WhatsApp Image 2025-10-25 at 10.29.16_55948c33.jpg', '1782649987_WhatsApp Image 2025-10-25 at 10.30.07_46c76151.jpg', NULL),
(20, '3209054', 'Surat Domisili', 'Administrasi Sekolah', 'Sekolah', '', 'Unduh PDF', 'menunggu', '1783189221_WhatsApp_Image_2025-10-25_at_10_29_10_df526132.jpg', '1783189221_WhatsApp_Image_2025-10-25_at_10_29_16_55948c33.jpg', '1783189221_WhatsApp_Image_2025-10-25_at_10_30_07_46c76151.jpg', NULL),
(21, '3209054', 'Surat Domisili', 'Administrasi Sekolah', 'Sekolah', '', 'Unduh PDF', 'menunggu', '1783189284_WhatsApp_Image_2025-10-25_at_10_29_10_df526132.jpg', '1783189284_WhatsApp_Image_2025-10-25_at_10_29_16_55948c33.jpg', '1783189284_WhatsApp_Image_2025-10-25_at_10_30_07_46c76151.jpg', NULL),
(22, '', 'Surat Domisili', 'Administrasi Sekolah', 'Sekolah', '', 'Unduh PDF', 'menunggu', '1783193089_WhatsApp Image 2025-10-25 at 10.29.10_df526132.jpg', '1783193089_WhatsApp Image 2025-10-25 at 10.29.16_55948c33.jpg', '1783193089_WhatsApp Image 2025-10-25 at 10.30.07_46c76151.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kelamin` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `rt` varchar(5) NOT NULL,
  `rw` varchar(5) NOT NULL,
  `kelurahan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `email`, `password`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `kelamin`, `alamat`, `rt`, `rw`, `kelurahan`) VALUES
(1, '3209054', '', '123', '', '', NULL, '', '', '', '', ''),
(4, '3209055', 'gggg@gmail.com', '456', 'Dina Agustina', 'Ciamis', '2005-08-01', 'Perempuan', 'Jl.Anggrek', '1', '2', 'Ciamis'),
(5, '3209056', 'rrrr@gmail.com', '111', 'Rainna Putri', 'Ciamis', '2005-02-02', 'Perempuan', 'Jl.Benteng', '2', '3', 'Ciamis'),
(14, '3209057', '', '222', 'Syafna Gianti', 'Ciamis', '2006-03-17', 'Perempuan', 'Jl.Mawar', '1', '2', 'Ciamis'),
(15, '3209058', '', '', 'Syifa', 'Tasikmalaya', '2005-01-01', 'Perempuan', 'Jl.Mawar', '1', '2', 'Tasikmalaya'),
(16, '', '', '111', '', '', '0000-00-00', '', '', '', '', ''),
(17, '', 'rrr@gmail.com', '111', '', '', NULL, '', '', '', '', ''),
(18, '', 'ddd@gmail.com', '1234', '', '', NULL, '', '', '', '', ''),
(19, '', 'sss@gmail.com', '333', '', '', NULL, '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
