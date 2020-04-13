-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2020 at 04:13 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewa`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `no_barang` char(10) NOT NULL,
  `merek` varchar(20) NOT NULL,
  `jenis` enum('Baru','Bekas') NOT NULL,
  `warna` varchar(15) NOT NULL,
  `status_barang` enum('Disewa','Tidak Disewa') NOT NULL DEFAULT 'Tidak Disewa',
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `no_barang`, `merek`, `jenis`, `warna`, `status_barang`, `harga`) VALUES
(7, '3', 'Monitor Samsung', 'Baru', 'Hitam', 'Tidak Disewa', 500000),
(8, '4', 'Kulkas Samsung', 'Bekas', 'Ungu', 'Tidak Disewa', 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id_bayar` int(11) NOT NULL,
  `id_sewa` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `status_bayar` enum('Lunas','DP') NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `kurang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bayar`
--

INSERT INTO `bayar` (`id_bayar`, `id_sewa`, `tgl_bayar`, `status_bayar`, `total_bayar`, `kurang`) VALUES
(1, 1, '2020-04-05', 'Lunas', 12050000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jaminan`
--

CREATE TABLE `jaminan` (
  `id_jaminan` int(11) NOT NULL,
  `jenis_jaminan` enum('SIM','KTP') NOT NULL,
  `no_jaminan` varchar(20) NOT NULL,
  `atas_nama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jaminan`
--

INSERT INTO `jaminan` (`id_jaminan`, `jenis_jaminan`, `no_jaminan`, `atas_nama`) VALUES
(1, 'KTP', '1', 'Bily');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id_pemilik` int(11) NOT NULL,
  `nama_pemilik` varchar(45) DEFAULT NULL,
  `alamat_pemilik` varchar(45) DEFAULT NULL,
  `no_tlp_pemilik` char(13) NOT NULL,
  `status_pemilik` enum('Disewa','Tidak Disewa') NOT NULL DEFAULT 'Tidak Disewa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `nama_pemilik`, `alamat_pemilik`, `no_tlp_pemilik`, `status_pemilik`) VALUES
(1, 'Tidak Ada', '-', '-', 'Tidak Disewa'),
(9, 'Alvin', 'Pringgading', '05723472384', 'Tidak Disewa'),
(10, 'Alvino', 'Mataram', '01723472384', 'Tidak Disewa');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_sewa` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `denda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_sewa`, `tgl_kembali`, `denda`) VALUES
(1, 1, '2020-04-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id_penyewa` int(11) NOT NULL,
  `nama_penyewa` varchar(45) DEFAULT NULL,
  `alamat_penyewa` varchar(45) DEFAULT NULL,
  `notlp_penyewa` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id_penyewa`, `nama_penyewa`, `alamat_penyewa`, `notlp_penyewa`) VALUES
(7, 'Decson', 'Cakrawala', '08423432542'),
(8, 'Alvino', 'Pringgading', '082134764976'),
(9, 'Tom Howard', 'Golden Earth', '01723472384');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id_sewa` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_penyewa` int(11) NOT NULL,
  `id_pemilik` int(11) DEFAULT NULL,
  `id_jaminan` int(11) NOT NULL,
  `tgl_sewa` date NOT NULL,
  `lama_sewa` int(11) NOT NULL,
  `harga_sewa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id_sewa`, `id_barang`, `id_penyewa`, `id_pemilik`, `id_jaminan`, `tgl_sewa`, `lama_sewa`, `harga_sewa`) VALUES
(1, 4, 7, 5, 1, '2020-04-05', 24, 12050000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_mobil` (`id_barang`);

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_bayar` (`id_bayar`);

--
-- Indexes for table `jaminan`
--
ALTER TABLE `jaminan`
  ADD PRIMARY KEY (`id_jaminan`),
  ADD KEY `id_jaminan` (`id_jaminan`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`),
  ADD KEY `id_sopir` (`id_pemilik`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_pengembalian` (`id_pengembalian`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id_penyewa`),
  ADD KEY `id_penyewa` (`id_penyewa`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `id_sewa` (`id_sewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jaminan`
--
ALTER TABLE `jaminan`
  MODIFY `id_jaminan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id_penyewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
