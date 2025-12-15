-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20250914.f72491a1c0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2025 at 10:29 PM
-- Server version: 8.4.3
-- PHP Version: 8.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `layanan_id` varchar(5) NOT NULL,
  `nama_layanan` varchar(20) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `harga_satuan` int NOT NULL,
  `aktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`layanan_id`, `nama_layanan`, `deskripsi`, `harga_satuan`, `aktif`) VALUES
('L001', 'Cuci Regular', 'Layanan cuci standar 2 hari', 5000, 'N'),
('L002', 'Cuci Express', 'Layanan cuci cepat 1 hari', 8000, 'Y'),
('L003', 'Cuci Premium', 'Layanan cuci premium dengan pengharum', 10000, 'Y'),
('L004', 'Cuci Setrika', 'Layanan cuci + setrika 3 hari', 12000, 'Y'),
('L005', 'Dry Clean', 'Layanan dry clean untuk baju formal', 15000, 'Y'),
('L006', 'Cuci Basah', 'mantap', 4000, 'Y'),
('PK001', 'Cuci Paket', 'Paket cucian standar per kilo', 6000, 'Y'),
('PK002', 'Cuci Kering', 'Layanan cuci kering kiloan', 4500, 'Y'),
('PK003', 'Cuci Basah', 'Layanan cuci basah kiloan', 4500, 'N'),
('PK004', 'Cuci Express', 'Layanan cuci express per kilo', 4500, 'Y'),
('PK005', 'Cuci Premium', 'Layanan cuci premium per kilo', 6000, 'Y'),
('ST001', 'Boneka', 'Layanan cuci boneka/mainan', 10000, 'N'),
('ST002', 'Helm', 'Layanan cuci helm', 15000, 'Y'),
('ST003', 'Tas', 'Layanan cuci tas/dompet', 15000, 'Y'),
('ST004', 'Sepatu', 'Layanan cuci sepatu', 15000, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `pemesanan_id` varchar(5) NOT NULL,
  `nama_pemesan` varchar(20) NOT NULL,
  `no_pemesan` varchar(12) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `jumlah_berat` int NOT NULL,
  `total_bayar` int NOT NULL,
  `metode_bayar` enum('tunai','transfer','ewallet') NOT NULL,
  `status` enum('pending','diproses','selesai','batal') NOT NULL,
  `user_id` varchar(5) NOT NULL,
  `layanan_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`pemesanan_id`, `nama_pemesan`, `no_pemesan`, `tanggal_pemesanan`, `jumlah_berat`, `total_bayar`, `metode_bayar`, `status`, `user_id`, `layanan_id`) VALUES
('274D4', 'kk', '08342424', '2025-12-15', 3, 30000, 'ewallet', 'selesai', 'U0006', 'L003'),
('86B2F', 'maulana', '08342424', '2025-12-15', 7, 105000, 'transfer', 'selesai', 'U0006', 'ST002'),
('A7254', 'husen', '08342424', '2025-12-16', 7, 105000, 'transfer', 'pending', 'U0006', 'ST002');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('admin','owner','karyawan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_tlpn` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama`, `username`, `password`, `role`, `no_tlpn`) VALUES
('K0007', 'ahmad', 'maluki', '', 'karyawan', '0812335466'),
('U0002', 'Owner Test', 'owner', 'owner123', 'owner', '08987654321'),
('U0006', 'Citra Dewi', 'test', 'test123', 'karyawan', '0812335466');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`layanan_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`pemesanan_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `layanan_id` (`layanan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`layanan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
