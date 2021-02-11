-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_balai_teknik
DROP DATABASE IF EXISTS `db_balai_teknik`;
CREATE DATABASE IF NOT EXISTS `db_balai_teknik` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_balai_teknik`;

-- Dumping structure for table db_balai_teknik.barang
DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(25) NOT NULL,
  `nama_alat` varchar(150) NOT NULL,
  `stock` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `update_date` datetime NOT NULL,
  `update_by` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_balai_teknik.barang: ~2 rows (approximately)
DELETE FROM `barang`;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id`, `kode_barang`, `nama_alat`, `stock`, `created_date`, `created_by`, `update_date`, `update_by`) VALUES
	(1, 'AU-102', 'SKID', 5, '2020-06-09 04:35:10', 1, '2020-07-27 07:47:35', 1),
	(2, 'AU-103', 'SKIB', 0, '2020-06-09 04:35:10', 1, '2020-06-09 04:46:32', 1);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table db_balai_teknik.log_barang_keluar
DROP TABLE IF EXISTS `log_barang_keluar`;
CREATE TABLE IF NOT EXISTS `log_barang_keluar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(25) NOT NULL,
  `nama_alat` varchar(150) NOT NULL,
  `tanggal_keluar` datetime NOT NULL,
  `merk` varchar(150) NOT NULL,
  `no_serial` varchar(150) NOT NULL,
  `jumlah` smallint(6) NOT NULL,
  `tujuan` varchar(150) NOT NULL,
  `keterangan` mediumtext NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table db_balai_teknik.log_barang_keluar: ~1 rows (approximately)
DELETE FROM `log_barang_keluar`;
/*!40000 ALTER TABLE `log_barang_keluar` DISABLE KEYS */;
INSERT INTO `log_barang_keluar` (`id`, `kode_barang`, `nama_alat`, `tanggal_keluar`, `merk`, `no_serial`, `jumlah`, `tujuan`, `keterangan`, `created_date`, `created_by`) VALUES
	(1, '1', 'SKID', '2020-06-13 00:00:00', 'ccc', '3434343', 0, 'rererere', 'dsdfsfs', '2020-06-13 11:23:29', 1),
	(3, 'AU-102', 'SKID', '2020-07-27 00:00:00', 'ccc', '4454545', 5, 'rererere', 'dede', '2020-07-27 07:47:35', 1);
/*!40000 ALTER TABLE `log_barang_keluar` ENABLE KEYS */;

-- Dumping structure for table db_balai_teknik.log_barang_masuk
DROP TABLE IF EXISTS `log_barang_masuk`;
CREATE TABLE IF NOT EXISTS `log_barang_masuk` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(25) NOT NULL,
  `nama_alat` varchar(150) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `merk` varchar(150) NOT NULL,
  `no_serial` varchar(150) NOT NULL,
  `referensi` mediumtext NOT NULL,
  `pengirim` varchar(150) NOT NULL,
  `jumlah` smallint(6) NOT NULL,
  `to` int(10) NOT NULL,
  `from` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table db_balai_teknik.log_barang_masuk: ~2 rows (approximately)
DELETE FROM `log_barang_masuk`;
/*!40000 ALTER TABLE `log_barang_masuk` DISABLE KEYS */;
INSERT INTO `log_barang_masuk` (`id`, `kode_barang`, `nama_alat`, `tanggal_masuk`, `merk`, `no_serial`, `referensi`, `pengirim`, `jumlah`, `to`, `from`, `created_date`, `created_by`) VALUES
	(1, '1', 'SKID', '2020-06-13 00:00:00', 'ccc', '1231231', '1-2020-06-13-497.pdf,1-2020-06-13-924.pdf', 'asada', 5, 5, 2, '2020-06-13 10:30:29', 1),
	(23, 'AU-102', 'SKID', '2020-07-27 00:00:00', 'ccc', '454545', '', 'asada', 5, 2, 5, '2020-07-27 07:38:50', 1);
/*!40000 ALTER TABLE `log_barang_masuk` ENABLE KEYS */;

-- Dumping structure for table db_balai_teknik.pegawai
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nip` int(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status_pegawai` varchar(30) NOT NULL,
  `workgroup_id` int(10) NOT NULL,
  `user_type_id` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `update_date` datetime NOT NULL,
  `update_by` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_balai_teknik.pegawai: ~3 rows (approximately)
DELETE FROM `pegawai`;
/*!40000 ALTER TABLE `pegawai` DISABLE KEYS */;
INSERT INTO `pegawai` (`id`, `nip`, `password`, `nama`, `no_telp`, `email`, `status_pegawai`, `workgroup_id`, `user_type_id`, `created_date`, `created_by`, `update_date`, `update_by`) VALUES
	(1, 12121314, '$2y$10$/tg1c73.jeqQSFKG2xn2welt13lq29Nl0nAgclwr3hOWV4dcQRDAO', 'test pegawai', '888997722', 'test@email.com', 'honorer', 1, 1, '2020-06-02 09:36:06', 1, '2020-06-05 10:56:27', 1),
	(6, 4444, '$2y$10$P6NB45M9Nlr454nZkEbsdueteQSyEdWjmN23z7Dlmhudpri5pMeiC', 'Staff', '083873373051', 'staff@gmail.com', 'Honorer', 0, 2, '2020-07-27 13:19:24', 1, '0000-00-00 00:00:00', 0),
	(7, 5555, '$2y$10$4dkTQXCkt/fnCaU71ow4VeBuPwRPg7qOLmq.bL/J8WNUZrzBXFrFG', 'Administrator', '083873373051', 'admin@gmail.com', 'Honorer', 0, 1, '2020-07-27 13:19:49', 1, '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `pegawai` ENABLE KEYS */;

-- Dumping structure for table db_balai_teknik.users_type
DROP TABLE IF EXISTS `users_type`;
CREATE TABLE IF NOT EXISTS `users_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_balai_teknik.users_type: ~2 rows (approximately)
DELETE FROM `users_type`;
/*!40000 ALTER TABLE `users_type` DISABLE KEYS */;
INSERT INTO `users_type` (`id`, `nama`) VALUES
	(1, 'admininstrator'),
	(2, 'staff');
/*!40000 ALTER TABLE `users_type` ENABLE KEYS */;

-- Dumping structure for table db_balai_teknik.workgroup
DROP TABLE IF EXISTS `workgroup`;
CREATE TABLE IF NOT EXISTS `workgroup` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `unit_kerja` varchar(50) NOT NULL,
  `sub_bagian` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `update_date` datetime NOT NULL,
  `update_by` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_balai_teknik.workgroup: ~2 rows (approximately)
DELETE FROM `workgroup`;
/*!40000 ALTER TABLE `workgroup` DISABLE KEYS */;
INSERT INTO `workgroup` (`id`, `nama`, `unit_kerja`, `sub_bagian`, `created_date`, `created_by`, `update_date`, `update_by`) VALUES
	(1, 'Final', 'Final', 'Final', '2020-06-05 10:57:39', 1, '2020-06-05 10:57:49', 1),
	(3, 'Final2', 'Final', 'Final', '2020-06-05 10:57:39', 1, '2020-06-05 10:57:49', 1);
/*!40000 ALTER TABLE `workgroup` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
