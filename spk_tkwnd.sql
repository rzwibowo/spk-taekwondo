-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 5.7.24 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk spk_tkwnd
DROP DATABASE IF EXISTS `spk_tkwnd`;
CREATE DATABASE IF NOT EXISTS `spk_tkwnd` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `spk_tkwnd`;

-- membuang struktur untuk table spk_tkwnd.analisis_kriteria
DROP TABLE IF EXISTS `analisis_kriteria`;
CREATE TABLE IF NOT EXISTS `analisis_kriteria` (
  `analisis_kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_buat` date DEFAULT NULL,
  `Id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`analisis_kriteria_id`),
  KEY `dibuat_oleh` (`Id_user`),
  CONSTRAINT `analisis_kriteria_ibfk_1` FOREIGN KEY (`Id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.analisis_kriteria: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `analisis_kriteria` DISABLE KEYS */;
INSERT INTO `analisis_kriteria` (`analisis_kriteria_id`, `tanggal_buat`, `Id_user`) VALUES
	(7, '2019-06-22', 2);
/*!40000 ALTER TABLE `analisis_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.detail_analisis_kriteria
DROP TABLE IF EXISTS `detail_analisis_kriteria`;
CREATE TABLE IF NOT EXISTS `detail_analisis_kriteria` (
  `detail_analisis_kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `analisis_kriteria_id` int(11) DEFAULT NULL,
  `kriteria_id` int(11) NOT NULL,
  `bobot` decimal(10,4) NOT NULL,
  PRIMARY KEY (`detail_analisis_kriteria_id`),
  KEY `FK_detail_analisis_kriteria_kriteria` (`kriteria_id`),
  KEY `FK_detail_analisis_kriteria_analisis_kriteria` (`analisis_kriteria_id`),
  CONSTRAINT `FK_detail_analisis_kriteria_analisis_kriteria` FOREIGN KEY (`analisis_kriteria_id`) REFERENCES `analisis_kriteria` (`analisis_kriteria_id`),
  CONSTRAINT `FK_detail_analisis_kriteria_kriteria` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.detail_analisis_kriteria: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `detail_analisis_kriteria` DISABLE KEYS */;
INSERT INTO `detail_analisis_kriteria` (`detail_analisis_kriteria_id`, `analisis_kriteria_id`, `kriteria_id`, `bobot`) VALUES
	(29, 7, 1, 0.4471),
	(30, 7, 2, 0.2321),
	(31, 7, 3, 0.1923),
	(32, 7, 4, 0.0778),
	(33, 7, 5, 0.0506);
/*!40000 ALTER TABLE `detail_analisis_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.detail_kriteria
DROP TABLE IF EXISTS `detail_kriteria`;
CREATE TABLE IF NOT EXISTS `detail_kriteria` (
  `id_detail_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `id_tempat_latihan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_detail_kriteria`),
  KEY `id_tempat_latihan` (`id_tempat_latihan`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `detail_kriteria_ibfk_1` FOREIGN KEY (`id_tempat_latihan`) REFERENCES `tempat_latihan` (`id_tempat_latihan`),
  CONSTRAINT `detail_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.detail_kriteria: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `detail_kriteria` DISABLE KEYS */;
INSERT INTO `detail_kriteria` (`id_detail_kriteria`, `id_tempat_latihan`, `id_kriteria`, `nilai`, `keterangan`) VALUES
	(1, 3, 2, 12000, ''),
	(3, 3, 3, 10, '');
/*!40000 ALTER TABLE `detail_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.h_perbandingan
DROP TABLE IF EXISTS `h_perbandingan`;
CREATE TABLE IF NOT EXISTS `h_perbandingan` (
  `h_perbandingan_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`h_perbandingan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.h_perbandingan: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `h_perbandingan` DISABLE KEYS */;
INSERT INTO `h_perbandingan` (`h_perbandingan_id`, `user_id`, `tanggal`) VALUES
	(4, 2, '2019-07-14');
/*!40000 ALTER TABLE `h_perbandingan` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.h_perbandingan_alternatif
DROP TABLE IF EXISTS `h_perbandingan_alternatif`;
CREATE TABLE IF NOT EXISTS `h_perbandingan_alternatif` (
  `H_perbandingan_alternatif_id` int(11) NOT NULL AUTO_INCREMENT,
  `H_perbandingan_id` int(11) DEFAULT NULL,
  `tempat_latihan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`H_perbandingan_alternatif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.h_perbandingan_alternatif: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `h_perbandingan_alternatif` DISABLE KEYS */;
INSERT INTO `h_perbandingan_alternatif` (`H_perbandingan_alternatif_id`, `H_perbandingan_id`, `tempat_latihan_id`) VALUES
	(5, 4, 2),
	(6, 4, 3);
/*!40000 ALTER TABLE `h_perbandingan_alternatif` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.h_perbandingan_kriteria
DROP TABLE IF EXISTS `h_perbandingan_kriteria`;
CREATE TABLE IF NOT EXISTS `h_perbandingan_kriteria` (
  `H_perbandingan_kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `H_perbandingan_alternatif_id` int(11) DEFAULT NULL,
  `kriteria_id` int(11) DEFAULT NULL,
  `rata_rata` int(11) DEFAULT NULL,
  PRIMARY KEY (`H_perbandingan_kriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.h_perbandingan_kriteria: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `h_perbandingan_kriteria` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `h_perbandingan_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.h_perbandingan_sub_kriteria
DROP TABLE IF EXISTS `h_perbandingan_sub_kriteria`;
CREATE TABLE IF NOT EXISTS `h_perbandingan_sub_kriteria` (
  `H_perbandingan_sub_kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `H_perbandingan_kriteria_id` int(11) DEFAULT NULL,
  `sub_kriteria_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`H_perbandingan_sub_kriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.h_perbandingan_sub_kriteria: ~20 rows (lebih kurang)
/*!40000 ALTER TABLE `h_perbandingan_sub_kriteria` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `h_perbandingan_sub_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.kriteria
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(30) NOT NULL,
  `min_max` varchar(20) NOT NULL,
  `is_multi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.kriteria: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `min_max`, `is_multi`) VALUES
	(1, 'Level Pelatih', 'max', 1),
	(2, 'Biaya Latihan', 'min', 0),
	(3, 'Jarak', 'min', 0),
	(4, 'Fasilitas', 'max', 0),
	(5, 'Prestasi Anggota', 'max', 1);
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.sub_kriteria
DROP TABLE IF EXISTS `sub_kriteria`;
CREATE TABLE IF NOT EXISTS `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `nama_sub` varchar(50) NOT NULL,
  `bobot_kriteria` int(11) NOT NULL,
  `sifat` enum('min','max') NOT NULL,
  PRIMARY KEY (`id_sub_kriteria`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.sub_kriteria: ~25 rows (lebih kurang)
/*!40000 ALTER TABLE `sub_kriteria` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `sub_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.tempat_latihan
DROP TABLE IF EXISTS `tempat_latihan`;
CREATE TABLE IF NOT EXISTS `tempat_latihan` (
  `id_tempat_latihan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  PRIMARY KEY (`id_tempat_latihan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.tempat_latihan: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `tempat_latihan` DISABLE KEYS */;
INSERT INTO `tempat_latihan` (`id_tempat_latihan`, `nama`, `alamat`, `latitude`, `longitude`) VALUES
	(2, 'adasdasd aasasa', 'asdasdsad', 8, 7),
	(3, 'padepokan sekti', 'ringroad utara', 10, 5);
/*!40000 ALTER TABLE `tempat_latihan` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.user: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
	(2, 'katijo', '62dad6e273d32235ae02b7d321578ee8', 'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
