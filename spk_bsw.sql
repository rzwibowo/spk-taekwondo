-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06 Agu 2018 pada 13.11
-- Versi Server: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_bsw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `beasiswa`
--

CREATE TABLE `beasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `jumlah_beasiswa` int(11) NOT NULL,
  `id_beasiswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(255) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `istext` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `istext`) VALUES
(7, '001', 'IPK', 0),
(8, '002', 'Kendaraan', 1),
(9, '003', 'Penghasilan Orang Tua', 0),
(10, '004', 'Pekerjaan Orang Tua', 1),
(11, '005', 'Jumlah Tanggungan', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan','','') NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `ipk` int(11) NOT NULL,
  `kendaraan` int(11) NOT NULL,
  `pkj_orangtua` int(11) NOT NULL,
  `jml_tanggungan` int(11) NOT NULL,
  `id_tahun_angkatan` int(11) NOT NULL,
  `ipkCriteria` int(11) NOT NULL,
  `penghasilanCriteria` int(11) NOT NULL,
  `tanggunganCriteria` int(11) NOT NULL,
  `pgh_orangtua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `ipk`, `kendaraan`, `pkj_orangtua`, `jml_tanggungan`, `id_tahun_angkatan`, `ipkCriteria`, `penghasilanCriteria`, `tanggunganCriteria`, `pgh_orangtua`) VALUES
(7, 56789, 'Sahurn', 'laki-laki', 'Jakarta', '2018-08-22', 'Jalan R.A.Kartini No. 9, RT. 10 / RW. 4, Cilandak Barat, Cilandak, RT.10/RW.4, Cilandak Bar., Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12440', 2, 1, 5, 2, 2, 3, 5, 9, 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengelola`
--

CREATE TABLE `pengelola` (
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nip` int(11) NOT NULL,
  `id_pengelola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengelola`
--

INSERT INTO `pengelola` (`username`, `password`, `nip`, `id_pengelola`) VALUES
('sahrun', '21232f297a57a5a743894a0e4a801fc3', 32323, 1),
('admin', '21232f297a57a5a743894a0e4a801fc3', 123455, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_criteria_nontext`
--

CREATE TABLE `sub_criteria_nontext` (
  `id_sub_criteria` int(11) NOT NULL,
  `max` varchar(20) NOT NULL,
  `operator_max` varchar(10) NOT NULL,
  `min` varchar(20) NOT NULL,
  `operator_min` varchar(10) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `kriteria` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_criteria_nontext`
--

INSERT INTO `sub_criteria_nontext` (`id_sub_criteria`, `max`, `operator_max`, `min`, `operator_min`, `id_kriteria`, `kriteria`, `keterangan`, `bobot`) VALUES
(1, '', '', '3.50', '>', 7, '>3.50', 'penting', 3),
(2, '2.50', '>=', '3.49', '<=', 7, '<=3.49-2.50', 'cukup penting', 2),
(3, '', '', '2.49', '<', 7, '<2.49', 'kurang penting', 1),
(4, '', '', '500.000', '<', 9, '<500.000', 'Sangat Penting', 4),
(5, '1.000.000', '<=', '500.000', '>', 9, '>500.000 - 1.000.000', 'Penting', 3),
(6, '1.500.000', '<=', '1.000.000', '>', 9, '>1.000.000 - 1.500.000', 'Cukup Penting', 2),
(7, '', '', '1.500.000', '>', 9, '>1.500.000', 'Kurang Penting', 1),
(8, '', '', '4', '>', 11, '>4 anak', 'Sangat Penting', 4),
(9, '', '', '2', '==', 11, '2 anak', 'Cukup Penting', 2),
(10, '', '', '3', '==', 11, '3 anak', 'Penting', 3),
(11, '', '', '1', '==', 11, '1 anak', 'Kurang Penting', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_criteria_text`
--

CREATE TABLE `sub_criteria_text` (
  `id_sub_criteria` int(11) NOT NULL,
  `kriteria` varchar(255) NOT NULL,
  `bobot` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_criteria_text`
--

INSERT INTO `sub_criteria_text` (`id_sub_criteria`, `kriteria`, `bobot`, `keterangan`, `id_kriteria`) VALUES
(1, 'Tidak memiliki kendaraan', 4, 'Sangat Penting', 8),
(2, 'Speda', 3, 'Penting', 8),
(3, 'Motor', 2, 'Cukup penting', 8),
(4, 'Mobil', 1, 'Kurang penting', 8),
(5, 'Pekerjaan Tidak Tetap', 2, 'Sangat Penting', 10),
(6, 'Pekerjaan Tetap', 1, 'Kurang Penting', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_angkatan`
--

CREATE TABLE `tahun_angkatan` (
  `id_tahun_angkatan` int(11) NOT NULL,
  `tahun_angkatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tahun_angkatan`
--

INSERT INTO `tahun_angkatan` (`id_tahun_angkatan`, `tahun_angkatan`) VALUES
(1, 2010),
(2, 2011),
(3, 2010);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD PRIMARY KEY (`id_beasiswa`),
  ADD KEY `nim` (`id_mahasiswa`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `id_tahun_angkatan` (`id_tahun_angkatan`),
  ADD KEY `ipkCriteria` (`ipkCriteria`),
  ADD KEY `penghasilanCriteria` (`penghasilanCriteria`),
  ADD KEY `tanggunganCriteria` (`tanggunganCriteria`),
  ADD KEY `kendaraan` (`kendaraan`),
  ADD KEY `pkj_orangtua` (`pkj_orangtua`);

--
-- Indexes for table `pengelola`
--
ALTER TABLE `pengelola`
  ADD PRIMARY KEY (`id_pengelola`);

--
-- Indexes for table `sub_criteria_nontext`
--
ALTER TABLE `sub_criteria_nontext`
  ADD PRIMARY KEY (`id_sub_criteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `sub_criteria_text`
--
ALTER TABLE `sub_criteria_text`
  ADD PRIMARY KEY (`id_sub_criteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tahun_angkatan`
--
ALTER TABLE `tahun_angkatan`
  ADD PRIMARY KEY (`id_tahun_angkatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beasiswa`
--
ALTER TABLE `beasiswa`
  MODIFY `id_beasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pengelola`
--
ALTER TABLE `pengelola`
  MODIFY `id_pengelola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sub_criteria_nontext`
--
ALTER TABLE `sub_criteria_nontext`
  MODIFY `id_sub_criteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sub_criteria_text`
--
ALTER TABLE `sub_criteria_text`
  MODIFY `id_sub_criteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tahun_angkatan`
--
ALTER TABLE `tahun_angkatan`
  MODIFY `id_tahun_angkatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD CONSTRAINT `beasiswa_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_tahun_angkatan`) REFERENCES `tahun_angkatan` (`id_tahun_angkatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`ipkCriteria`) REFERENCES `sub_criteria_nontext` (`id_sub_criteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_3` FOREIGN KEY (`penghasilanCriteria`) REFERENCES `sub_criteria_nontext` (`id_sub_criteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_4` FOREIGN KEY (`tanggunganCriteria`) REFERENCES `sub_criteria_nontext` (`id_sub_criteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_5` FOREIGN KEY (`kendaraan`) REFERENCES `sub_criteria_text` (`id_sub_criteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_6` FOREIGN KEY (`pkj_orangtua`) REFERENCES `sub_criteria_text` (`id_sub_criteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_criteria_nontext`
--
ALTER TABLE `sub_criteria_nontext`
  ADD CONSTRAINT `sub_criteria_nontext_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_criteria_text`
--
ALTER TABLE `sub_criteria_text`
  ADD CONSTRAINT `sub_criteria_text_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
