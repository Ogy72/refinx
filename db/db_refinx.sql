-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 01, 2019 at 05:56 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_refinx`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartridge`
--

CREATE TABLE `cartridge` (
  `no_cartridge` varchar(11) NOT NULL,
  `tipe` varchar(8) NOT NULL,
  `merek` varchar(7) NOT NULL,
  `jenis` varchar(9) NOT NULL,
  `warna` varchar(9) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cartridge`
--

INSERT INTO `cartridge` (`no_cartridge`, `tipe`, `merek`, `jenis`, `warna`, `no_telp`) VALUES
('CR.19.1814', 'PG810', 'Canon', 'Inkjet', 'Black', '0814'),
('CR.19.1815', 'CL811', 'Canon', 'Inkjet', 'C/M/Y', '0814'),
('CR.19.1816', '85A', 'HP', 'Laserjet', 'Black', '0821'),
('CR.19.1817', 'PG810', 'Canon', 'Inkjet', 'Black', '0821'),
('CR.19.1818', 'CL811', 'Canon', 'Inkjet', 'C/M/Y', '0821'),
('CR.19.1819', 'HP802B', 'HP', 'Inkjet', 'Black', '0811'),
('CR.19.1820', 'HP802C', 'HP', 'Inkjet', 'C/M/Y', '0811'),
('CR.19.1821', '35A', 'HP', 'Laserjet', 'Black', '0811'),
('CR.19.1991', 'PG810', 'Canon', 'Inkjet', 'Black', '0822'),
('CR.19.1992', 'CL811', 'Canon', 'Inkjet', 'C/M/Y', '0822');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(3) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `no_telp`) VALUES
(64, 'BPKP Samarinda', '0822'),
(69, 'Dewi', '0813'),
(71, 'Imigrasi', '0811'),
(72, 'PT. Kaltim Jaya Sentosa', '0814'),
(74, 'Holland Bakery', '0821');

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan_tinta`
--

CREATE TABLE `penggunaan_tinta` (
  `idrefill` int(5) NOT NULL,
  `kd_tinta` varchar(7) NOT NULL,
  `isi` int(3) NOT NULL,
  `biaya` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunaan_tinta`
--

INSERT INTO `penggunaan_tinta` (`idrefill`, `kd_tinta`, `isi`, `biaya`) VALUES
(204, 'BC21BK', 10, 20000),
(205, 'BC05C', 3, 6000),
(205, 'BC05M', 3, 6000),
(205, 'BC05Y', 3, 6000),
(215, 'HP27BK', 6, 12000),
(216, 'HP28C', 3, 6000),
(216, 'HP28M', 3, 6000),
(216, 'HP28Y', 3, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `refill`
--

CREATE TABLE `refill` (
  `idrefill` int(5) NOT NULL,
  `date` date NOT NULL,
  `hasil_test` varchar(15) NOT NULL,
  `ket` varchar(35) NOT NULL,
  `no_cartridge` varchar(11) NOT NULL,
  `user_id` int(3) NOT NULL,
  `status` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refill`
--

INSERT INTO `refill` (`idrefill`, `date`, `hasil_test`, `ket`, `no_cartridge`, `user_id`, `status`) VALUES
(204, '2019-06-27', 'Standar', 'isi', 'CR.19.1814', 7, 'dibayar'),
(205, '2019-06-27', 'Standar', 'isi', 'CR.19.1815', 7, 'dibayar'),
(212, '2019-06-27', '', '', 'CR.19.1818', 0, ''),
(213, '2019-06-27', '', '', 'CR.19.1817', 0, ''),
(214, '2019-06-27', '', '', 'CR.19.1816', 0, ''),
(215, '2019-06-27', 'No Print', 'isi', 'CR.19.1819', 5, ''),
(216, '2019-06-27', 'No Print', 'isi', 'CR.19.1820', 5, ''),
(217, '2019-06-27', '', '', 'CR.19.1821', 0, ''),
(219, '2019-06-27', '', '', 'CR.19.1991', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `stok_tinta`
--

CREATE TABLE `stok_tinta` (
  `kd_tinta` varchar(7) NOT NULL,
  `warna` varchar(9) NOT NULL,
  `merek` varchar(7) NOT NULL,
  `jenis` varchar(9) NOT NULL,
  `stok` int(9) NOT NULL,
  `satuan` varchar(7) NOT NULL,
  `hrg_beli` int(7) NOT NULL,
  `hrg_jual` int(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_tinta`
--

INSERT INTO `stok_tinta` (`kd_tinta`, `warna`, `merek`, `jenis`, `stok`, `satuan`, `hrg_beli`, `hrg_jual`, `date`) VALUES
('BC05C', 'Cyan', 'Canon', 'Inkjet', 3000, 'ml', 250000, 2000, '2019-06-27'),
('BC05M', 'Magenta', 'Canon', 'Inkjet', 2997, 'ml', 250000, 2000, '2019-06-17'),
('BC05Y', 'Yellow', 'Canon', 'Inkjet', 2997, 'ml', 250000, 2000, '2019-06-17'),
('BC21BK', 'Black', 'Canon', 'Inkjet', 4990, 'ml', 250000, 2000, '2019-06-17'),
('HP27BK', 'Black', 'HP', 'Inkjet', 3994, 'ml', 250000, 2000, '2019-06-17'),
('HP28C', 'Cyan', 'HP', 'Inkjet', 2997, 'ml', 250000, 2000, '2019-06-17'),
('HP28M', 'Magenta', 'HP', 'Inkjet', 2997, 'ml', 250000, 2000, '2019-06-17'),
('HP28Y', 'Yellow', 'HP', 'Inkjet', 2997, 'ml', 250000, 2000, '2019-06-17'),
('TO27BK', 'Black', 'HP', 'Laserjet', 3000, 'gr', 250000, 2000, '2019-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `level` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(2, 'Ogy', 'ogy72', 'tirta', 'Admin'),
(5, 'Budi', 'budi93', 'budi1993', 'Teknisi'),
(7, 'Joni', 'joni97', 'joni1997', 'Teknisi'),
(8, 'Senja', 'senja9', 'mentari', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartridge`
--
ALTER TABLE `cartridge`
  ADD PRIMARY KEY (`no_cartridge`),
  ADD KEY `Foreign key` (`no_telp`) USING BTREE;

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `no_telp` (`no_telp`) USING BTREE;

--
-- Indexes for table `penggunaan_tinta`
--
ALTER TABLE `penggunaan_tinta`
  ADD KEY `Foreign key1` (`idrefill`),
  ADD KEY `Foreign key2` (`kd_tinta`);

--
-- Indexes for table `refill`
--
ALTER TABLE `refill`
  ADD PRIMARY KEY (`idrefill`),
  ADD KEY `Foreign key1` (`no_cartridge`),
  ADD KEY `Foreign key2` (`user_id`);

--
-- Indexes for table `stok_tinta`
--
ALTER TABLE `stok_tinta`
  ADD PRIMARY KEY (`kd_tinta`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `refill`
--
ALTER TABLE `refill`
  MODIFY `idrefill` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartridge`
--
ALTER TABLE `cartridge`
  ADD CONSTRAINT `memiliki` FOREIGN KEY (`no_telp`) REFERENCES `pelanggan` (`no_telp`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `penggunaan_tinta`
--
ALTER TABLE `penggunaan_tinta`
  ADD CONSTRAINT `detail penggunaan` FOREIGN KEY (`idrefill`) REFERENCES `refill` (`idrefill`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `digunakan` FOREIGN KEY (`kd_tinta`) REFERENCES `stok_tinta` (`kd_tinta`);

--
-- Constraints for table `refill`
--
ALTER TABLE `refill`
  ADD CONSTRAINT `direfill` FOREIGN KEY (`no_cartridge`) REFERENCES `cartridge` (`no_cartridge`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
