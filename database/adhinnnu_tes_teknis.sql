-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2022 at 08:49 AM
-- Server version: 10.3.34-MariaDB-cll-lve
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adhinnnu_tes_teknis`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `id_barang` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` text NOT NULL,
  `stok` int(110) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`id_barang`, `kode`, `nama_barang`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'ID12862', 'shampo', 'Rp. 10.000', 92, '2022-04-01 08:27:04', '2022-04-01 10:23:18'),
(2, 'IDAE801', 'kopi', 'Rp. 12.000', 3, '2022-04-01 08:28:02', '2022-04-01 10:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `m_customer`
--

CREATE TABLE `m_customer` (
  `id_customer` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kode_customer` varchar(250) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_tlp` char(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_customer`
--

INSERT INTO `m_customer` (`id_customer`, `user_id`, `kode_customer`, `nama`, `no_tlp`, `created_at`, `updated_at`) VALUES
(1, 1, 'ID1OCO2UR222', 'adhi nugroho', '1234567890', '2022-04-01 08:28:31', '2022-04-01 08:28:31'),
(2, 1, 'ID12E8OO1K46', 'Adhi Nugroho', '087848790080', '2022-04-01 08:33:57', '2022-04-01 08:33:57'),
(3, 2, 'ID2T28SR840K', 'sri', '081395970707', '2022-04-01 10:21:27', '2022-04-01 10:21:27'),
(4, 2, 'IDRSEMU806OO', 'nunu', '081395970707', '2022-04-01 10:22:51', '2022-04-01 10:22:51'),
(5, 2, 'ID82EO494668', 'susan', '081395970707', '2022-04-01 10:23:18', '2022-04-01 10:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `sementara`
--

CREATE TABLE `sementara` (
  `id_sementara` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL DEFAULT 0,
  `user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `kode_barang` text DEFAULT NULL,
  `kode_sementara` text DEFAULT NULL,
  `qty` text DEFAULT NULL,
  `harga_diskon` text DEFAULT NULL,
  `diskon` decimal(40,0) DEFAULT NULL,
  `ongkir` decimal(40,0) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sementara`
--

INSERT INTO `sementara` (`id_sementara`, `barang_id`, `user`, `status`, `time`, `date`, `kode_barang`, `kode_sementara`, `qty`, `harga_diskon`, `diskon`, `ongkir`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '08:28:21', '2022-04-01', 'ID12862', 'IDRH0E6N', '2', '10000', '50', '20001', '2022-04-01 08:28:21', '2022-04-01 10:23:18'),
(2, 2, 1, 1, '08:28:26', '2022-04-01', 'IDAE801', 'IDES4M80', '2', '0', '100', '100000', '2022-04-01 08:28:26', '2022-04-01 10:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `t_sales`
--

CREATE TABLE `t_sales` (
  `id_t_sales` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `kode_sementara` text NOT NULL,
  `kode` varchar(15) DEFAULT NULL,
  `no_transaksi` varchar(250) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `subtotal` decimal(20,6) DEFAULT NULL,
  `total_bayar` decimal(20,6) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_sales`
--

INSERT INTO `t_sales` (`id_t_sales`, `user`, `kode_sementara`, `kode`, `no_transaksi`, `tgl`, `cust_id`, `subtotal`, `total_bayar`, `created_at`, `updated_at`) VALUES
(1, 1, 'IDRH0E6N', 'ID1OCO2UR222', '1240664134', '2022-04-02', 1, '22000.000000', '22000.000000', '2022-04-01 08:28:31', '2022-04-01 08:28:31'),
(2, 1, 'IDES4M80', 'ID1OCO2UR222', '1240664134', '2022-04-02', 1, '22000.000000', '22000.000000', '2022-04-01 08:28:31', '2022-04-01 08:28:31'),
(3, 1, 'IDRH0E6N', 'ID12E8OO1K46', '0880182568', '2022-04-15', 1, '10000.500000', '10000.500000', '2022-04-01 08:33:57', '2022-04-01 08:33:57'),
(4, 1, 'IDES4M80', 'ID12E8OO1K46', '0880182568', '2022-04-15', 1, '10000.500000', '10000.500000', '2022-04-01 08:33:57', '2022-04-01 08:33:57'),
(5, 2, 'IDRH0E6N', 'ID2T28SR840K', '5128437617', '2022-04-01', 2, '10000.000000', '10000.000000', '2022-04-01 10:21:27', '2022-04-01 10:21:27'),
(6, 2, 'IDES4M80', 'ID2T28SR840K', '5128437617', '2022-04-01', 2, '10000.000000', '10000.000000', '2022-04-01 10:21:27', '2022-04-01 10:21:27'),
(7, 2, 'IDRH0E6N', 'IDRSEMU806OO', '8965141985', '2022-04-01', 2, '10000.000000', '10000.000000', '2022-04-01 10:22:51', '2022-04-01 10:22:51'),
(8, 2, 'IDES4M80', 'IDRSEMU806OO', '8965141985', '2022-04-01', 2, '10000.000000', '10000.000000', '2022-04-01 10:22:51', '2022-04-01 10:22:51'),
(9, 2, 'IDRH0E6N', 'ID82EO494668', '0368757212', '2022-04-01', 2, '10000.000000', '10000.000000', '2022-04-01 10:23:18', '2022-04-01 10:23:18'),
(10, 2, 'IDES4M80', 'ID82EO494668', '0368757212', '2022-04-01', 2, '10000.000000', '10000.000000', '2022-04-01 10:23:18', '2022-04-01 10:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Adhi nugroho', 'adhin@gmail.com', '$2y$10$UwBbXIHg1XG3nVGIByQjG.V7UfNs5AjESfNl.AEbBQleDxZ/mvTNO', '2022-04-01 08:13:27', '2022-04-01 08:13:27'),
(2, 'sri rejeki novianti', 'tanyasrirejekinovianti@gmail.com', '$2y$10$uDdG.5IV.RTbSbrQmUrkPu8FJYPnGwU2PcoEMPYvOUzdnXQGyhmUa', '2022-04-01 10:20:14', '2022-04-01 10:20:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `m_customer`
--
ALTER TABLE `m_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `sementara`
--
ALTER TABLE `sementara`
  ADD PRIMARY KEY (`id_sementara`);

--
-- Indexes for table `t_sales`
--
ALTER TABLE `t_sales`
  ADD PRIMARY KEY (`id_t_sales`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_customer`
--
ALTER TABLE `m_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sementara`
--
ALTER TABLE `sementara`
  MODIFY `id_sementara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_sales`
--
ALTER TABLE `t_sales`
  MODIFY `id_t_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
