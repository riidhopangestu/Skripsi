-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 05:53 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_moora`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_kendaraan`
--

CREATE TABLE `tbl_jenis_kendaraan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_kendaraan`
--

INSERT INTO `tbl_jenis_kendaraan` (`id`, `nama`) VALUES
(1, 'Kopling'),
(2, 'Gigi'),
(3, 'Matic');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_service`
--

CREATE TABLE `tbl_jenis_service` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_service`
--

INSERT INTO `tbl_jenis_service` (`id`, `nama`) VALUES
(1, 'Service Ringan'),
(2, 'Service Besar'),
(3, 'Service Khusus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kendaraan`
--

CREATE TABLE `tbl_kendaraan` (
  `id` int(11) NOT NULL,
  `plat_nomor` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kendaraan`
--

INSERT INTO `tbl_kendaraan` (`id`, `plat_nomor`, `nama`, `merek`, `jenis_id`, `tahun`, `nama_file`, `path`, `created_at`, `created_by`) VALUES
(3, 'b 4567 fg', 'vega r', 'yamaha', 1, 2001, 'warung.png', 'http://localhost/spk-moora//assets/upload/', '2021-06-04 10:54:51', 5),
(4, 'b 4567 fgf', 'mio', 'yamaha', 3, 2011, 'bengkel1.png', 'http://localhost/spk-moora//assets/upload/', '2021-06-04 18:40:00', 4),
(6, 'b 1234 fd', 'vega r', 'yamaha', 2, 2001, 'testing.jpg', 'http://localhost/spk-moora//assets/upload/', '2021-06-07 05:21:15', 6),
(7, 'b 1234 fde', 'mio', 'yamaha', 3, 2001, 'soto.jpg', 'http://localhost/spk-moora//assets/upload/', '2021-06-07 05:30:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mekanik`
--

CREATE TABLE `tbl_mekanik` (
  `id` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mekanik`
--

INSERT INTO `tbl_mekanik` (`id`, `nik`, `nama`, `umur`, `alamat`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(9, '201973', 'dory achmad', 22, 'gfff', '2021-05-31 12:36:15', 3, '2021-06-01 14:05:34', 3),
(10, '2019733', 'dory', 22, 'ddd', '2021-05-31 12:39:27', 3, '2021-05-31 12:46:36', 3),
(13, '1', 'testing1', 20, 'j', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(14, '2', 'testing22', 22, 'j', '2021-06-02 05:28:23', 3, '0000-00-00 00:00:00', 0),
(15, '3', 'testing3', 20, 'j', '2021-06-09 00:00:00', 1, '2021-06-16 00:00:00', 1),
(16, '6', 'testing4', 20, 'j', '2021-06-02 00:00:00', 1, '2021-06-02 00:00:00', 1),
(17, '7', 'testing6', 20, 'j', '2021-06-02 00:00:00', 1, '2021-06-02 00:00:00', 1),
(18, '8', 'testing7', 20, 'j', '2021-06-02 00:00:00', 1, '2021-06-02 00:00:00', 1),
(19, '9', 'testing8', 20, 'j', '2021-06-02 00:00:00', 1, '2021-06-02 00:00:00', 1),
(21, '11', 'testing10', 20, 'j', '2021-06-02 00:00:00', 1, '2021-06-02 00:00:00', 1),
(22, '12', 'testing11', 20, 'j', '2021-06-02 00:00:00', 1, '2021-06-02 00:00:00', 1),
(23, '13', 'testing12', 20, 'j', '2021-06-02 00:00:00', 1, '2021-06-02 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sevice`
--

CREATE TABLE `tbl_sevice` (
  `id` int(11) NOT NULL,
  `prefik` varchar(50) NOT NULL,
  `no` int(11) NOT NULL,
  `tgl_estimasi` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_tlpn` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `jenis_service_id` int(11) NOT NULL,
  `plat_nomor` varchar(50) NOT NULL,
  `jenis_kendaraan_id` int(11) NOT NULL,
  `merek_kendaraan` varchar(100) NOT NULL,
  `nama_kendaraan` varchar(100) NOT NULL,
  `tahun_kendaraan` int(11) NOT NULL,
  `gambar_kendaraan` varchar(255) NOT NULL,
  `path_kendaraan` text NOT NULL,
  `id_mekanik` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `catatan_admin` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sevice`
--

INSERT INTO `tbl_sevice` (`id`, `prefik`, `no`, `tgl_estimasi`, `nama`, `email`, `no_tlpn`, `alamat`, `kendaraan_id`, `jenis_service_id`, `plat_nomor`, `jenis_kendaraan_id`, `merek_kendaraan`, `nama_kendaraan`, `tahun_kendaraan`, `gambar_kendaraan`, `path_kendaraan`, `id_mekanik`, `status`, `catatan`, `catatan_admin`, `created_at`, `created_by`) VALUES
(3, '', 0, '0000-00-00', 'dory achmad', 'dory@krokretmail.com', '22222', 'f', 0, 0, '', 1, 'vega r', 'yamaha', 2001, '', '', 9, 5, '', '', '2021-06-02 16:13:22', 1),
(4, 'OR202106', 2, '2021-06-08', 'dory achmad', 'dory@krokretmail.com', '34566', 'ttt', 0, 0, '', 2, 'd', 'd', 2001, '', '', 0, 5, 'ddd', '', '2021-06-03 06:34:19', 1),
(5, 'OR202106', 3, '2021-06-02', 'rido', 'rido@gmail.com', '09876543', 'jl.titik', 0, 0, '', 1, 'vega r', 'yamaha', 2001, '', '', 9, 4, 'testing', '', '2021-06-04 05:11:52', 4),
(7, 'OR202106', 4, '2021-06-02', 'tije', 'tj@yhoo.com', '0987656', 'jl kelana', 3, 1, 'b 4567 fg', 1, 'yamaha', 'vega r', 2001, 'warung.png', 'http://localhost/spk-moora//assets/upload/', 14, 4, 'testing', 'tttt', '2021-06-04 13:25:09', 5),
(8, 'OR202106', 5, '2021-06-07', 'rido test', 'ridotest@gmail.com', '098764433', 'jl. kedoya bogor', 6, 1, 'b 1234 fd', 2, 'yamaha', 'vega r', 2001, 'testing.jpg', 'http://localhost/spk-moora//assets/upload/', 9, 4, 'ganti  oli dan sevice', 'ok', '2021-06-07 05:22:00', 6),
(9, 'OR202106', 6, '2021-06-07', 'rido test', 'ridotest@gmail.com', '098764433', 'jl. kedoya bogor', 6, 2, 'b 1234 fd', 2, 'yamaha', 'vega r', 2001, 'testing.jpg', 'http://localhost/spk-moora//assets/upload/', 14, 4, 'turun mesin', 'te', '2021-06-07 05:28:16', 6),
(10, 'OR202106', 7, '2021-06-07', 'dory achmad', '', '', '', 7, 1, 'b 1234 fde', 3, 'yamaha', 'mio', 2001, 'soto.jpg', 'http://localhost/spk-moora//assets/upload/', 10, 3, 'ganti oli', 'ok', '2021-06-07 05:30:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(155) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `tipe` int(11) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `tipe`, `bobot`) VALUES
(1, 'C1', 'TROUBLESHOOTING', 1, 2.7),
(2, 'C2', 'KOMUNIKASI DAN KERJASAMA', 1, 2.8),
(3, 'C3', 'PENGALAMAN KERJA', 1, 2.5),
(4, 'C4', 'HUMAN ERROR', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `keterangan` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `keterangan`) VALUES
(1, 'Administrator'),
(2, 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `fk_id_kriteria` int(11) NOT NULL,
  `total_nilai` float NOT NULL,
  `fk_id_mekanik` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `fk_id_kriteria`, `total_nilai`, `fk_id_mekanik`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(17, 1, 85, 9, '0000-00-00 00:00:00', 0, '2021-06-02 08:19:48', 3),
(18, 2, 3, 9, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(19, 3, 5, 9, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(20, 4, 2, 9, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, 1, 90, 10, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(22, 2, 2, 10, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(23, 3, 5, 10, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(24, 4, 2, 10, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(25, 1, 80, 13, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(26, 2, 3, 13, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(27, 3, 5, 13, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(28, 4, 3, 13, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(29, 1, 75, 14, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(30, 2, 2, 14, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(31, 3, 5, 14, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(32, 4, 3, 14, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(33, 1, 85, 15, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(34, 2, 3, 15, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(35, 3, 5, 15, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(36, 4, 2, 15, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(37, 1, 70, 16, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(38, 2, 2, 16, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(39, 3, 2, 16, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(40, 4, 4, 16, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(41, 1, 71, 17, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(42, 2, 2, 17, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(43, 3, 1, 17, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(44, 4, 2, 17, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(45, 1, 85, 18, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(46, 2, 2, 18, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(47, 3, 5, 18, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(48, 4, 2, 18, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(49, 1, 95, 19, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(50, 2, 4, 19, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(51, 3, 5, 19, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(52, 4, 2, 19, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(53, 1, 75, 20, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(54, 2, 4, 20, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(55, 3, 5, 20, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(56, 4, 2, 20, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(57, 1, 85, 21, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(58, 2, 4, 21, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(59, 3, 5, 21, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(60, 4, 2, 21, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(61, 1, 75, 22, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(62, 2, 4, 22, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(63, 3, 5, 22, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(64, 4, 3, 22, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(155) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fk_id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `email`, `username`, `password`, `fk_id_level`) VALUES
(3, 'admin', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_customer`
--

CREATE TABLE `user_customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_tlpn` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_customer`
--

INSERT INTO `user_customer` (`id_customer`, `nama`, `username`, `password`, `no_tlpn`, `email`, `alamat`) VALUES
(1, 'dory achmad', 'dori', '81dc9bdb52d04dc20036dbd8313ed055', '', '', ''),
(3, 'd', 'dori', 'c4ca4238a0b923820dcc509a6f75849b', '', '', ''),
(4, 'rido', 'rido', '25f9e794323b453885f5181f1b624d0b', '', '', ''),
(5, 'tije', 'tj', 'd93591bdf7860e1e4ee2fca799911215', '0987656', 'tj@yhoo.com', 'jl kelana'),
(6, 'rido test', 'ridotest', '81dc9bdb52d04dc20036dbd8313ed055', '098764433', 'ridotest@gmail.com', 'jl. kedoya bogor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jenis_kendaraan`
--
ALTER TABLE `tbl_jenis_kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jenis_service`
--
ALTER TABLE `tbl_jenis_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kendaraan`
--
ALTER TABLE `tbl_kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mekanik`
--
ALTER TABLE `tbl_mekanik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sevice`
--
ALTER TABLE `tbl_sevice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`fk_id_level`);

--
-- Indexes for table `user_customer`
--
ALTER TABLE `user_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jenis_kendaraan`
--
ALTER TABLE `tbl_jenis_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_jenis_service`
--
ALTER TABLE `tbl_jenis_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kendaraan`
--
ALTER TABLE `tbl_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_mekanik`
--
ALTER TABLE `tbl_mekanik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_sevice`
--
ALTER TABLE `tbl_sevice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_customer`
--
ALTER TABLE `user_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`fk_id_level`) REFERENCES `tb_level` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
