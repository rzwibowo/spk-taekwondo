-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 04:46 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_tkwnd`
--

-- --------------------------------------------------------

--
-- Table structure for table `analisis_kriteria`
--

CREATE TABLE `analisis_kriteria` (
  `analisis_kriteria_id` int(11) NOT NULL,
  `tanggal_buat` date DEFAULT NULL,
  `Id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisis_kriteria`
--

INSERT INTO `analisis_kriteria` (`analisis_kriteria_id`, `tanggal_buat`, `Id_user`) VALUES
(7, '2019-06-22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_analisis_kriteria`
--

CREATE TABLE `detail_analisis_kriteria` (
  `detail_analisis_kriteria_id` int(11) NOT NULL,
  `analisis_kriteria_id` int(11) DEFAULT NULL,
  `kriteria_id` int(11) NOT NULL,
  `bobot` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_analisis_kriteria`
--

INSERT INTO `detail_analisis_kriteria` (`detail_analisis_kriteria_id`, `analisis_kriteria_id`, `kriteria_id`, `bobot`) VALUES
(29, 7, 1, '0.4471'),
(30, 7, 2, '0.2321'),
(31, 7, 3, '0.1923'),
(32, 7, 4, '0.0778'),
(33, 7, 5, '0.0506');

-- --------------------------------------------------------

--
-- Table structure for table `detail_kriteria`
--

CREATE TABLE `detail_kriteria` (
  `id_detail_kriteria` int(11) NOT NULL,
  `id_tempat_latihan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_kriteria`
--

INSERT INTO `detail_kriteria` (`id_detail_kriteria`, `id_tempat_latihan`, `id_kriteria`, `nilai`, `keterangan`) VALUES
(1, 3, 2, 12000, ''),
(3, 3, 3, 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `h_perbandingan`
--

CREATE TABLE `h_perbandingan` (
  `h_perbandingan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_perbandingan`
--

INSERT INTO `h_perbandingan` (`h_perbandingan_id`, `user_id`, `tanggal`) VALUES
(4, 2, '2019-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `h_perbandingan_alternatif`
--

CREATE TABLE `h_perbandingan_alternatif` (
  `H_perbandingan_alternatif_id` int(11) NOT NULL,
  `H_perbandingan_id` int(11) DEFAULT NULL,
  `tempat_latihan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_perbandingan_alternatif`
--

INSERT INTO `h_perbandingan_alternatif` (`H_perbandingan_alternatif_id`, `H_perbandingan_id`, `tempat_latihan_id`) VALUES
(5, 4, 2),
(6, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `h_perbandingan_kriteria`
--

CREATE TABLE `h_perbandingan_kriteria` (
  `H_perbandingan_kriteria_id` int(11) NOT NULL,
  `H_perbandingan_alternatif_id` int(11) DEFAULT NULL,
  `kriteria_id` int(11) DEFAULT NULL,
  `rata_rata` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_perbandingan_kriteria`
--

INSERT INTO `h_perbandingan_kriteria` (`H_perbandingan_kriteria_id`, `H_perbandingan_alternatif_id`, `kriteria_id`, `rata_rata`) VALUES
(21, 5, 1, 3),
(22, 5, 5, 3),
(23, 5, 2, 1),
(24, 5, 3, 1),
(25, 5, 4, 1),
(26, 6, 1, 3),
(27, 6, 5, 3),
(28, 6, 2, 3),
(29, 6, 3, 2),
(30, 6, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `h_perbandingan_sub_kriteria`
--

CREATE TABLE `h_perbandingan_sub_kriteria` (
  `H_perbandingan_sub_kriteria_id` int(11) NOT NULL,
  `H_perbandingan_kriteria_id` int(11) DEFAULT NULL,
  `sub_kriteria_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_perbandingan_sub_kriteria`
--

INSERT INTO `h_perbandingan_sub_kriteria` (`H_perbandingan_sub_kriteria_id`, `H_perbandingan_kriteria_id`, `sub_kriteria_id`, `nilai`) VALUES
(41, 21, 1, 1),
(42, 21, 2, 1),
(43, 21, 3, 1),
(44, 21, 4, 1),
(45, 21, 5, 1),
(46, 22, 21, 1),
(47, 22, 22, 1),
(48, 22, 23, 1),
(49, 22, 24, 1),
(50, 22, 25, 1),
(51, 26, 1, 1),
(52, 26, 2, 1),
(53, 26, 3, 1),
(54, 26, 4, 1),
(55, 26, 5, 1),
(56, 27, 21, 1),
(57, 27, 22, 1),
(58, 27, 23, 1),
(59, 27, 24, 1),
(60, 27, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `min_max` varchar(20) NOT NULL,
  `is_multi` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `min_max`, `is_multi`) VALUES
(1, 'Level Pelatih', 'max', 1),
(2, 'Biaya Latihan', 'min', 0),
(3, 'Jarak', 'min', 0),
(4, 'Fasilitas', 'max', 0),
(5, 'Prestasi Anggota', 'max', 1);

-- --------------------------------------------------------

--
-- Table structure for table `peringkat_alternatif`
--

CREATE TABLE `peringkat_alternatif` (
  `id_peringkat` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peringkat_alternatif`
--

INSERT INTO `peringkat_alternatif` (`id_peringkat`, `tanggal`, `user`) VALUES
(4, '2019-07-22', 3);

-- --------------------------------------------------------

--
-- Table structure for table `peringkat_alternatif_detail`
--

CREATE TABLE `peringkat_alternatif_detail` (
  `id_detail` int(11) NOT NULL,
  `id_peringkat_alternatif` int(11) NOT NULL,
  `peringkat` int(11) NOT NULL,
  `id_tempat_latihan` int(11) NOT NULL,
  `jumlah_nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peringkat_alternatif_detail`
--

INSERT INTO `peringkat_alternatif_detail` (`id_detail`, `id_peringkat_alternatif`, `peringkat`, `id_tempat_latihan`, `jumlah_nilai`) VALUES
(5, 4, 1, 3, 1.4632),
(6, 4, 2, 2, 1.00507);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_sub` varchar(50) NOT NULL,
  `bobot_kriteria` int(11) NOT NULL,
  `sifat` enum('min','max') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `nama_sub`, `bobot_kriteria`, `sifat`) VALUES
(1, 1, 'Sabuk merah belum ada lisensi pelatih', 1, ''),
(2, 1, 'Sabuk hitam belum ada lisensi pelatih', 2, ''),
(3, 1, 'Sabuk hitam lisensi pelatih Daerah', 3, ''),
(4, 1, 'Sabuk hitam lisensi pelatih Nasional', 4, ''),
(5, 1, 'Sabuk hitam lisensi pelatih Internasional', 5, ''),
(6, 2, 'Rp 0 - Rp 50.000', 1, ''),
(7, 2, 'Rp 50.000 - Rp 100.000', 2, ''),
(8, 2, 'Rp 100.000 - Rp 150.000', 3, ''),
(9, 2, 'Rp 150.000 -  Rp 200.000', 4, ''),
(10, 2, '> Rp 200.000', 5, ''),
(11, 3, '0 - 5 km', 1, ''),
(12, 3, '5 km - 10 km', 2, ''),
(13, 3, '10 km - 30 km', 3, ''),
(14, 3, '30 km - 50 km', 4, ''),
(15, 3, '> 50 km', 5, ''),
(16, 4, 'Lapangan', 1, ''),
(17, 4, 'Gedung', 2, ''),
(18, 4, 'Lapangan, Peralatan Latihan', 3, ''),
(19, 4, 'Gedung, Peralatan Latihan', 4, ''),
(20, 4, 'Lapangan, Gedung, Peralatan Latihan', 5, ''),
(21, 5, 'Tingkat Kabupaten', 1, ''),
(22, 5, 'Tingkat Daerah', 2, ''),
(23, 5, 'Tingkat Regional', 3, ''),
(24, 5, 'Tingkat Nasional', 4, ''),
(25, 5, 'Tingkat Internasional', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `tempat_latihan`
--

CREATE TABLE `tempat_latihan` (
  `id_tempat_latihan` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempat_latihan`
--

INSERT INTO `tempat_latihan` (`id_tempat_latihan`, `nama`, `alamat`, `latitude`, `longitude`) VALUES
(2, 'adasdasd aasasa', 'asdasdsad', 8, 7),
(3, 'padepokan sekti', 'ringroad utara', 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(2, 'katijo', '62dad6e273d32235ae02b7d321578ee8', 'user'),
(3, 'admin', '202cb962ac59075b964b07152d234b70', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisis_kriteria`
--
ALTER TABLE `analisis_kriteria`
  ADD PRIMARY KEY (`analisis_kriteria_id`),
  ADD KEY `dibuat_oleh` (`Id_user`);

--
-- Indexes for table `detail_analisis_kriteria`
--
ALTER TABLE `detail_analisis_kriteria`
  ADD PRIMARY KEY (`detail_analisis_kriteria_id`),
  ADD KEY `FK_detail_analisis_kriteria_kriteria` (`kriteria_id`),
  ADD KEY `FK_detail_analisis_kriteria_analisis_kriteria` (`analisis_kriteria_id`);

--
-- Indexes for table `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
  ADD PRIMARY KEY (`id_detail_kriteria`),
  ADD KEY `id_tempat_latihan` (`id_tempat_latihan`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `h_perbandingan`
--
ALTER TABLE `h_perbandingan`
  ADD PRIMARY KEY (`h_perbandingan_id`);

--
-- Indexes for table `h_perbandingan_alternatif`
--
ALTER TABLE `h_perbandingan_alternatif`
  ADD PRIMARY KEY (`H_perbandingan_alternatif_id`);

--
-- Indexes for table `h_perbandingan_kriteria`
--
ALTER TABLE `h_perbandingan_kriteria`
  ADD PRIMARY KEY (`H_perbandingan_kriteria_id`);

--
-- Indexes for table `h_perbandingan_sub_kriteria`
--
ALTER TABLE `h_perbandingan_sub_kriteria`
  ADD PRIMARY KEY (`H_perbandingan_sub_kriteria_id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `peringkat_alternatif`
--
ALTER TABLE `peringkat_alternatif`
  ADD PRIMARY KEY (`id_peringkat`);

--
-- Indexes for table `peringkat_alternatif_detail`
--
ALTER TABLE `peringkat_alternatif_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tempat_latihan`
--
ALTER TABLE `tempat_latihan`
  ADD PRIMARY KEY (`id_tempat_latihan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analisis_kriteria`
--
ALTER TABLE `analisis_kriteria`
  MODIFY `analisis_kriteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_analisis_kriteria`
--
ALTER TABLE `detail_analisis_kriteria`
  MODIFY `detail_analisis_kriteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
  MODIFY `id_detail_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `h_perbandingan`
--
ALTER TABLE `h_perbandingan`
  MODIFY `h_perbandingan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `h_perbandingan_alternatif`
--
ALTER TABLE `h_perbandingan_alternatif`
  MODIFY `H_perbandingan_alternatif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `h_perbandingan_kriteria`
--
ALTER TABLE `h_perbandingan_kriteria`
  MODIFY `H_perbandingan_kriteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `h_perbandingan_sub_kriteria`
--
ALTER TABLE `h_perbandingan_sub_kriteria`
  MODIFY `H_perbandingan_sub_kriteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peringkat_alternatif`
--
ALTER TABLE `peringkat_alternatif`
  MODIFY `id_peringkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peringkat_alternatif_detail`
--
ALTER TABLE `peringkat_alternatif_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tempat_latihan`
--
ALTER TABLE `tempat_latihan`
  MODIFY `id_tempat_latihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analisis_kriteria`
--
ALTER TABLE `analisis_kriteria`
  ADD CONSTRAINT `analisis_kriteria_ibfk_1` FOREIGN KEY (`Id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `detail_analisis_kriteria`
--
ALTER TABLE `detail_analisis_kriteria`
  ADD CONSTRAINT `FK_detail_analisis_kriteria_analisis_kriteria` FOREIGN KEY (`analisis_kriteria_id`) REFERENCES `analisis_kriteria` (`analisis_kriteria_id`),
  ADD CONSTRAINT `FK_detail_analisis_kriteria_kriteria` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Constraints for table `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
  ADD CONSTRAINT `detail_kriteria_ibfk_1` FOREIGN KEY (`id_tempat_latihan`) REFERENCES `tempat_latihan` (`id_tempat_latihan`),
  ADD CONSTRAINT `detail_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
