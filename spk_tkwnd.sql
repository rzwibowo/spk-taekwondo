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
CREATE DATABASE IF NOT EXISTS `spk_tkwnd` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `spk_tkwnd`;

-- membuang struktur untuk table spk_tkwnd.analisis_kriteria
CREATE TABLE IF NOT EXISTS `analisis_kriteria` (
  `analisis_kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_buat` date DEFAULT NULL,
  `dibuat_oleh` int(11) DEFAULT NULL,
  PRIMARY KEY (`analisis_kriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.analisis_kriteria: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `analisis_kriteria` DISABLE KEYS */;
INSERT INTO `analisis_kriteria` (`analisis_kriteria_id`, `tanggal_buat`, `dibuat_oleh`) VALUES
	(4, '2019-05-25', 0);
/*!40000 ALTER TABLE `analisis_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.bobot_kriteria
CREATE TABLE IF NOT EXISTS `bobot_kriteria` (
  `id_bobot_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `bobot_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_bobot_kriteria`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `bobot_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.bobot_kriteria: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `bobot_kriteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `bobot_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.detail_analisis_kriteria
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.detail_analisis_kriteria: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `detail_analisis_kriteria` DISABLE KEYS */;
INSERT INTO `detail_analisis_kriteria` (`detail_analisis_kriteria_id`, `analisis_kriteria_id`, `kriteria_id`, `bobot`) VALUES
	(14, 4, 1, 0.5238),
	(15, 4, 2, 0.2387),
	(16, 4, 3, 0.1400),
	(17, 4, 4, 0.0721),
	(18, 4, 5, 0.0255);
/*!40000 ALTER TABLE `detail_analisis_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.detail_kriteria
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.detail_kriteria: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `detail_kriteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.detail_sub_kriteria
CREATE TABLE IF NOT EXISTS `detail_sub_kriteria` (
  `id_detail_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `id_sub_kriteria` int(11) NOT NULL,
  `id_tempat_latihan` int(11) NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_detail_sub_kriteria`),
  KEY `id_sub_kriteria` (`id_sub_kriteria`),
  KEY `id_tempat_latihan` (`id_tempat_latihan`),
  CONSTRAINT `detail_sub_kriteria_ibfk_1` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.detail_sub_kriteria: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `detail_sub_kriteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_sub_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.kriteria
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(30) NOT NULL,
  `min_max` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.kriteria: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `min_max`) VALUES
	(1, 'level pelatih', '10000'),
	(2, 'biaya', '20000'),
	(3, 'jarak', '20000'),
	(4, 'fasilitas', '50000'),
	(5, 'prestasi anggota\r\n', '5000');
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.sub_kriteria
CREATE TABLE IF NOT EXISTS `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `nama_sub` varchar(50) NOT NULL,
  `bobot_kriteria` int(11) NOT NULL,
  `sifat` enum('min','max') NOT NULL,
  PRIMARY KEY (`id_sub_kriteria`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.sub_kriteria: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `sub_kriteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.tempat_latihan
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
	(2, 'adasdasd', 'asdasdsad', 8, 7),
	(3, 'padepokan sekti', 'ringroad utara', 10, 5);
/*!40000 ALTER TABLE `tempat_latihan` ENABLE KEYS */;

-- membuang struktur untuk table spk_tkwnd.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel spk_tkwnd.user: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
	(1, 'admin@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
