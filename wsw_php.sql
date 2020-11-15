/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.5.4-MariaDB : Database - db_wsw
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_wsw` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_wsw`;

/*Table structure for table `divisi` */

DROP TABLE IF EXISTS `divisi`;

CREATE TABLE `divisi` (
  `id_divisi` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_divisi`),
  UNIQUE KEY `nama_divisi` (`nama_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `divisi` */

insert  into `divisi`(`id_divisi`,`nama_divisi`) values 
(4,'finance'),
(2,'HR'),
(1,'IT'),
(5,'marketing'),
(3,'sales');

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`),
  UNIQUE KEY `nama_jabatan` (`nama_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id_jabatan`,`nama_jabatan`) values 
(2,'manager'),
(1,'staff'),
(3,'supervisor');

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_karyawan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_jabatan` int(10) unsigned NOT NULL,
  `id_divisi` int(10) unsigned NOT NULL,
  `date_joined` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_karyawan`),
  UNIQUE KEY `username` (`username`),
  KEY `id_jabatan` (`id_jabatan`,`id_divisi`),
  KEY `id_divisi_fk1` (`id_divisi`),
  CONSTRAINT `id_divisi_fk1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`),
  CONSTRAINT `id_jabatan_fk1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `karyawan` */

insert  into `karyawan`(`id_karyawan`,`username`,`full_name`,`password`,`id_jabatan`,`id_divisi`,`date_joined`) values 
(1,'luky','luky sad','123123',2,1,'2019-03-01 00:24:20'),
(2,'lexa','ale sdfaw','poqwe',1,4,'2020-10-07 00:24:32'),
(3,'ekohadi','eko hadi','ekohadi',2,2,'2014-05-01 00:24:37'),
(4,'mamangracing','mamang asdaw','123123',1,1,'2016-05-30 00:24:48'),
(5,'septian','septian sdaw','123123',2,4,'2017-10-01 00:25:04'),
(6,'tita','cynantia pratita <3','123123',2,4,'2017-10-01 00:25:04'),
(7,'johnwick','john wick','123123',2,3,'2020-10-07 00:24:32'),
(8,'pinkguy','pink guy','123123',2,5,'2019-03-01 00:24:20'),
(9,'lukiss','luki kiss','123123',1,4,'2020-10-07 00:24:32'),
(10,'bangblek','bang blek','eko123',1,5,'2020-11-01 14:36:32');

/*Table structure for table `karyawan_surat_mapped` */

DROP TABLE IF EXISTS `karyawan_surat_mapped`;

CREATE TABLE `karyawan_surat_mapped` (
  `id_ksm` varchar(255) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `id_karyawan` int(10) unsigned DEFAULT NULL,
  `surat_peringatan_type_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_ksm`),
  KEY `id_karyawan_fk1` (`id_karyawan`),
  KEY `surat_peringatan_type_id_fk1` (`surat_peringatan_type_id`),
  CONSTRAINT `id_karyawan_fk1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_peringatan_type_id_fk1` FOREIGN KEY (`surat_peringatan_type_id`) REFERENCES `surat_peringatan_type` (`surat_peringatan_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `karyawan_surat_mapped` */

insert  into `karyawan_surat_mapped`(`id_ksm`,`date`,`id_karyawan`,`surat_peringatan_type_id`) values 
('SP/2020/1/15/3/39','2020-01-13 17:30:20',4,1),
('SP/2020/10/30/2/2','2020-10-30 02:06:11',2,1),
('SP/2020/11/10/5/13','2020-11-10 16:49:50',5,2),
('SP/2020/11/10/5/17','2020-11-10 18:19:37',5,3),
('SP/2020/11/10/5/4','2020-11-10 16:40:54',5,1),
('SP/2020/11/12/10/20','2020-11-12 23:05:04',10,1),
('SP/2020/11/14/1/33','2020-11-15 01:19:59',1,1),
('SP/2020/11/14/1/37','2020-11-15 01:25:05',1,3),
('SP/2020/11/14/3/24','2020-11-15 01:11:12',3,1),
('SP/2020/11/15/3/38','2020-11-15 15:55:23',3,2),
('SP/2020/11/15/4/45','2020-11-15 17:33:30',4,1);

/*Table structure for table `sp_points` */

DROP TABLE IF EXISTS `sp_points`;

CREATE TABLE `sp_points` (
  `point_sp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `point_sp_name` tinytext NOT NULL,
  PRIMARY KEY (`point_sp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `sp_points` */

insert  into `sp_points`(`point_sp_id`,`point_sp_name`) values 
(1,'Ketidakhadiran: Tidak datang (absen) bekerja secara konsisten tanpa pemberitahuan'),
(2,'Keterlambatan: Sering terlambat bekerja'),
(3,'Tidak Menunjukkan Performa Maksimal: Kurang produktif atau tidak bertanggung jawab pada pekerjaan'),
(4,'Melanggar Kebijakan: Mengabaikan peraturan perusahaan atau membuka rahasia'),
(5,'Pencurian: Mengambil barang dari tempat kerja atau orang lain tanpa izin');

/*Table structure for table `surat_peringatan` */

DROP TABLE IF EXISTS `surat_peringatan`;

CREATE TABLE `surat_peringatan` (
  `id_surat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_ksm` varchar(255) DEFAULT NULL,
  `point_sp_id` int(10) unsigned DEFAULT NULL,
  `id_author` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_surat`),
  KEY `point_sp_id_fk1` (`point_sp_id`),
  KEY `id_ksm_fk1` (`id_ksm`),
  CONSTRAINT `id_ksm_fk1` FOREIGN KEY (`id_ksm`) REFERENCES `karyawan_surat_mapped` (`id_ksm`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `point_sp_id_fk1` FOREIGN KEY (`point_sp_id`) REFERENCES `sp_points` (`point_sp_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `surat_peringatan` */

insert  into `surat_peringatan`(`id_surat`,`id_ksm`,`point_sp_id`,`id_author`) values 
(1,'SP/2020/10/30/2/2',1,2),
(2,'SP/2020/10/30/2/2',5,2),
(9,'SP/2020/11/10/5/4',1,3),
(10,'SP/2020/11/10/5/4',3,3),
(11,'SP/2020/11/10/5/4',5,3),
(12,'SP/2020/11/10/5/13',1,3),
(13,'SP/2020/11/10/5/13',3,3),
(14,'SP/2020/11/10/5/13',4,3),
(15,'SP/2020/11/10/5/13',4,3),
(16,'SP/2020/11/10/5/17',2,3),
(17,'SP/2020/11/10/5/17',1,3),
(18,'SP/2020/11/10/5/17',2,3),
(19,'SP/2020/11/12/10/20',1,3),
(20,'SP/2020/11/12/10/20',2,3),
(21,'SP/2020/11/12/10/20',3,3),
(22,'SP/2020/11/12/10/20',5,3),
(31,'SP/2020/11/14/3/24',1,3),
(32,'SP/2020/11/14/1/33',1,3),
(33,'SP/2020/11/14/1/33',3,3),
(36,'SP/2020/11/14/1/37',1,3),
(37,'SP/2020/11/15/3/38',4,3),
(38,'SP/2020/11/15/3/38',2,3),
(39,'SP/2020/11/15/3/38',1,3),
(43,'SP/2020/1/15/3/39',1,3),
(44,'SP/2020/11/15/4/45',1,3);

/*Table structure for table `surat_peringatan_type` */

DROP TABLE IF EXISTS `surat_peringatan_type`;

CREATE TABLE `surat_peringatan_type` (
  `surat_peringatan_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `surat_peringatan_type_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`surat_peringatan_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `surat_peringatan_type` */

insert  into `surat_peringatan_type`(`surat_peringatan_type_id`,`surat_peringatan_type_name`) values 
(1,'SURAT PERINGATAN PERTAMA'),
(2,'SURAT PERINGATAN KEDUA'),
(3,'SURAT PERINGATAN KETIGA');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
