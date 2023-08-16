-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2023 at 05:39 PM
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
-- Database: `inventaris_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal_k` date NOT NULL DEFAULT current_timestamp(),
  `tujuan` varchar(64) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal_k`, `tujuan`, `qty`) VALUES
(28, 53, '2023-07-18', 'KCP Bintaro Jaya', 450),
(29, 52, '2023-07-18', 'KCP Bintaro', 150),
(35, 58, '2023-07-24', 'KCP Alam Sutera', 100),
(36, 58, '2023-07-24', 'KCP Bintaro', 100),
(38, 59, '2023-07-25', 'KCP Alam Sutera', 199),
(39, 60, '2023-07-25', 'KCP Pahlawan Seribu', 10),
(44, 63, '2023-08-25', 'KCP Bintaro', 50),
(45, 66, '2023-09-07', 'KCP Cirendeu', 1),
(46, 65, '2023-08-07', 'KCP Ciputat', 10),
(47, 64, '2023-08-07', 'KCP Alam Sutera', 11),
(48, 67, '2023-08-01', 'KCP Bintaro Jaya', 10),
(55, 76, '2013-06-20', 'KCP Alam Sutera', 1),
(56, 75, '2012-06-23', 'KCP Bintaro', 1),
(57, 72, '2012-06-23', 'KCP Bintaro Jaya', 1),
(60, 69, '2023-08-15', 'KCP Ciputat', 4),
(61, 69, '2023-08-01', 'KCP Bintaro Jaya', 2),
(62, 81, '2023-08-15', 'Cabang Tangerang Selatan', 1),
(63, 69, '2023-08-15', 'Cabang Tangerang Selatan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `username`, `password`) VALUES
(2, 'admin', 'admin'),
(4, 'fawwaz', '28b662d883b6d76fd96e4ddc5e9ba780');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `total` int(50) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `deskripsi`, `keterangan`, `harga`, `jumlah`, `total`, `tanggal`) VALUES
(69, 'KERTAS FAX', 'ATK', 'roll', 21000, 14, 294000, '2023-08-07'),
(70, 'CF 4 PLY JPLUS', 'ATK', 'dus', 425000, 4, 1700000, '2023-08-07'),
(71, 'F4', 'ATK', 'rim', 42500, 2, 85000, '2023-08-07'),
(72, 'CATRDIGE COMPUPRINT 3065', 'ATK', 'pcs', 268750, 1, 268750, '2023-08-07'),
(73, 'COMPUPRINT SP40 PLUS', 'ATK', 'pcs', 257100, 1, 257100, '2023-08-07'),
(74, 'CF PAPERLINE (K2:2) 2PLY', 'ATK', 'dus', 257000, 5, 1285000, '2023-08-07'),
(75, 'CATRIDGE LX310', 'ATK', 'pcs', 70500, 4, 282000, '2023-08-07'),
(76, 'TINTA BROTHER SET', 'ATK', 'pcs', 374000, 6, 2244000, '2023-08-07'),
(77, 'CF 3:2 PLY', 'ATK', 'dus', 14000, 3, 42000, '2023-08-07'),
(78, 'CF 1 PLY J-PLUS', 'ATK', 'dus', 249500, 3, 748500, '2023-08-07'),
(79, 'BINDER CLIP 155', 'ATK', 'box', 7900, 16, 126400, '2023-08-07'),
(80, 'BHG 311', 'ATK', 'pcs', 13750, 24, 330000, '2023-08-07'),
(81, 'dus arsip', 'Cetakan', 'dus', 10000, 4, 40000, '2023-08-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`),
  ADD KEY `idbarang` (`idbarang`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
