-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 03:00 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_pelanggan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_3`
--

CREATE TABLE `tb_3` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `daya` int(15) NOT NULL,
  `no_telp` int(15) NOT NULL,
  `teknis` tinyint(1) NOT NULL,
  `p2tl` tinyint(1) NOT NULL,
  `tunggakan` tinyint(1) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_3`
--

INSERT INTO `tb_3` (`id`, `nama`, `alamat`, `daya`, `no_telp`, `teknis`, `p2tl`, `tunggakan`, `file_path`) VALUES
(5, 'Hendra', 'Kolongan', 2200, 97769869, 1, 1, 1, 'uploads/646e569ca7a109.74757035.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_3`
--
ALTER TABLE `tb_3`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_3`
--
ALTER TABLE `tb_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
