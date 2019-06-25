-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2019 at 04:22 PM
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
  `dibuat_oleh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisis_kriteria`
--

INSERT INTO `analisis_kriteria` (`analisis_kriteria_id`, `tanggal_buat`, `dibuat_oleh`) VALUES
(7, '2019-06-22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id_bobot_kriteria` int(11) NOT NULL,
  `bobot_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `detail_sub_kriteria`
--

CREATE TABLE `detail_sub_kriteria` (
  `id_detail_sub_kriteria` int(11) NOT NULL,
  `id_sub_kriteria` int(11) NOT NULL,
  `id_tempat_latihan` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Level Pelatih', '', 1),
(2, 'Biaya Latihan', '', 0),
(3, 'Jarak', '', 0),
(4, 'Fasilitas', 'max', 0),
(5, 'Prestasi Anggota', '', 1);

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
(2, 'katijo', '62dad6e273d32235ae02b7d321578ee8', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisis_kriteria`
--
ALTER TABLE `analisis_kriteria`
  ADD PRIMARY KEY (`analisis_kriteria_id`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`);

--
-- Indexes for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id_bobot_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_user` (`id_user`);

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
-- Indexes for table `detail_sub_kriteria`
--
ALTER TABLE `detail_sub_kriteria`
  ADD PRIMARY KEY (`id_detail_sub_kriteria`),
  ADD KEY `id_sub_kriteria` (`id_sub_kriteria`),
  ADD KEY `id_tempat_latihan` (`id_tempat_latihan`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

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
-- AUTO_INCREMENT for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id_bobot_kriteria` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `detail_sub_kriteria`
--
ALTER TABLE `detail_sub_kriteria`
  MODIFY `id_detail_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `bobot_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

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
-- Constraints for table `detail_sub_kriteria`
--
ALTER TABLE `detail_sub_kriteria`
  ADD CONSTRAINT `detail_sub_kriteria_ibfk_1` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`);

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
