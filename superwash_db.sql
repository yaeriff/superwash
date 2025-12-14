-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2025 at 10:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `superwash_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `alamat` text,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(20) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `nohp`, `alamat`, `username`, `password`, `updated_at`, `role`) VALUES
('ADM001', 'Admin Staff', '0855555555', 'Surabaya', 'admin', 'admin123', '2025-12-14 09:54:43', 'admin'),
('K0002', 'hartono', '0814567890111', 'Semarang barat', 'duren', 'tutik123', '2025-12-14 03:47:09', 'admin'),
('K0003', 'Rifqi', '0895382977168', 'Tokyo', 'yaerip', '1234', '2025-12-14 03:47:09', 'admin'),
('OWNER01', 'Rifqi', '0895382977168', 'Semarang', 'yaerip', 'owner123', '2025-12-14 10:39:52', 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `kode_booking` varchar(10) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `no_handphone` varchar(15) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_paket` varchar(50) DEFAULT NULL,
  `jenis_cuci` varchar(20) DEFAULT NULL,
  `jumlah` decimal(10,1) DEFAULT NULL,
  `estimasi` int DEFAULT NULL,
  `total_harga` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`kode_booking`, `nama_pelanggan`, `no_handphone`, `tanggal`, `nama_paket`, `jenis_cuci`, `jumlah`, `estimasi`, `total_harga`, `updated_at`) VALUES
('BK00001', 'naura', '082345673455', '2025-11-29', 'Cuci Paket', 'reguler', '1.8', 3, 10800, '2025-12-14 09:12:48'),
('BK00002', 'ausu', '082345673455', '2025-11-29', 'Cuci Paket', 'reguler', '1.8', 3, 10800, '2025-12-14 09:16:28'),
('BK00003', 'nana', '082345673455', '2025-11-29', 'Cuci Paket', 'reguler', '1.8', 3, 10800, '2025-12-14 08:58:54'),
('BK00004', 'nana', '082345673455', '2025-11-29', 'Cuci Paket', 'reguler', '1.8', 3, 10800, '2025-12-14 08:58:54'),
('BK00005', 'nana', '082345673455', '2025-11-29', 'Cuci Paket', 'reguler', '1.8', 3, 10800, '2025-12-14 08:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(10) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_kg` decimal(10,1) DEFAULT NULL,
  `id_karyawan` varchar(10) DEFAULT NULL,
  `kode_booking` varchar(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_bayar` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `tanggal`, `jumlah_kg`, `id_karyawan`, `kode_booking`, `updated_at`, `total_bayar`) VALUES
('TR0001', '2025-11-29', '1.8', 'K001', 'BK0001', '2025-12-14 04:13:23', 15000),
('TR0002', '2025-11-29', '2.5', 'K002', 'BK0002', '2025-12-14 04:13:23', 20000),
('TR0003', '2025-11-30', '5.0', 'K001', 'BK0003', '2025-12-14 04:13:23', 45000),
('TR0004', '2025-12-01', '1.8', 'K001', 'BK0004', '2025-12-14 04:13:23', 12000),
('TR0005', '2025-12-02', '3.2', 'K003', 'BK0005', '2025-12-14 04:13:23', 25000),
('TR0006', '2025-12-02', '1.8', 'K001', 'BK0006', '2025-12-14 04:13:23', 15000),
('TR0007', '2025-12-03', '4.0', 'K002', 'BK0007', '2025-12-14 04:13:23', 32000),
('TR0008', '2025-12-03', '1.8', 'K001', 'BK0008', '2025-12-14 04:13:23', 14000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`kode_booking`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
