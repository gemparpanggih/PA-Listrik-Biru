-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 04:35 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `iduser` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id` varchar(10) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `daya` varchar(20) NOT NULL,
  `tarifperkwh` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id`, `foto`, `daya`, `tarifperkwh`) VALUES
('TR/8Q-F2', '5.png', '3500VA', '1656'),
('TR/92-F3', '4.png', '2200VA', '1500'),
('TR/B4-F9', '3.png', '1300VA', '1444'),
('TR/U1-F9', '2.png', '900VA', '1352'),
('TR/VF-F9', '1.png', '450VA', '1500');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` varchar(15) NOT NULL,
  `iduser` varchar(10) NOT NULL,
  `tanggal` varchar(16) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `nometer` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `totalkwh` float NOT NULL,
  `idtarif` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `iduser`, `tanggal`, `nominal`, `nometer`, `token`, `totalkwh`, `idtarif`) VALUES
('userOIVW-KMAD', 'userOIVW', 'Mon, 14 Nov 2022', '100000', '9218390481', '1790-4225-1458-7740', 69.25, 'TR/B4-F9');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `telepon`, `alamat`, `foto`, `level`) VALUES
('user7NLP', 'admin', '$2y$10$NZ7cKFbi02wsRqweFHmpyuHPHAvV1hPgzlgy5IferkQ8C2rndIh7C', 'admin', '08123456789', 'alamat', '', 'admin'),
('userFW1M', 'yanto', '$2y$10$Xz5qwOXa/yCMkBC5kQ520eluxav/3v6n.dbHPedKypZHLP1Izm2Um', 'Haji Yanto', '082238781', 'Jl. Suwandi 5', 'yanto-FW1M.jpg', 'user'),
('userOIVW', 'gilang', '$2y$10$ZigGEqRlIxny/33.IgMd2ODc1V8qNe2aiDVbmGgfbCvQn297yxSwG', 'Gilang Ahmad', '0891919123', 'Jl Antasari No. 3', 'gilang-OIVW.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `iduser_2` (`iduser`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idtarif` (`idtarif`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kontak`
--
ALTER TABLE `kontak`
  ADD CONSTRAINT `kontak_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`idtarif`) REFERENCES `tarif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
