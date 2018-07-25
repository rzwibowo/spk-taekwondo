-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2018 at 03:38 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_bsw`
--
CREATE DATABASE IF NOT EXISTS `spk_bsw` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `spk_bsw`;

-- --------------------------------------------------------

--
-- Table structure for table `beasiswa`
--

CREATE TABLE `beasiswa` (
  `kode_beasiswa` varchar(18) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `jumlah_beasiswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` int(3) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL,
  `bobot_kriteria` double(9,1) NOT NULL,
  `nim` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `bobot_kriteria`, `nim`) VALUES
(1, 'Test', 23.0, '223244');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `thn_angkatan` int(4) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan','','') NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `ipk` int(11) NOT NULL,
  `kendaraan` varchar(255) NOT NULL,
  `pgh_orangtua` int(11) NOT NULL,
  `pkj_orangtua` varchar(255) NOT NULL,
  `jml_tanggungan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `thn_angkatan`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `ipk`, `kendaraan`, `pgh_orangtua`, `pkj_orangtua`, `jml_tanggungan`) VALUES
('223244', 'Sahrun', 300, 'laki-laki', 'Jakarta', '2018-06-12', 'Jalan R.A.Kartini No. 9, RT. 10 / RW. 4, Cilandak Barat, Cilandak, RT.10/RW.4, Cilandak Bar., Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12440', 0, '', 0, '', 0),
('234423', 'Ardi', 2003, 'laki-laki', 'Jakarta', '2018-06-23', 'Jalan R.A.Kartini No. 9, RT. 10 / RW. 4, Cilandak Barat, Cilandak, RT.10/RW.4, Cilandak Bar., Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12440', 12, 'sdsads', 2321, 'sadsd', 23),
('29111', 'Handa Yono', 2019, 'laki-laki', 'Asgard', '2002-01-07', 'Wakanda Foreva', 7, 'Polygon', 20000, 'Buruh Tani', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pengelola`
--

CREATE TABLE `pengelola` (
  `nip` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengelola`
--

INSERT INTO `pengelola` (`nip`, `username`, `password`) VALUES
(1, 'sahrun', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD PRIMARY KEY (`kode_beasiswa`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `pengelola`
--
ALTER TABLE `pengelola`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `kode_kriteria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pengelola`
--
ALTER TABLE `pengelola`
  MODIFY `nip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD CONSTRAINT `beasiswa_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
