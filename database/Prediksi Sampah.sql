/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.7.25 : Database - prediksi_sampah
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`prediksi_sampah` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `prediksi_sampah`;

/*Table structure for table `mst_app_data` */

DROP TABLE IF EXISTS `mst_app_data`;

CREATE TABLE `mst_app_data` (
  `app_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `portal_id` varchar(10) DEFAULT NULL,
  `logo_app` varchar(256) DEFAULT 'default.png',
  `no_tlp_app` varchar(25) DEFAULT NULL,
  `email_app` varchar(50) DEFAULT NULL,
  `no_whatsapp_app` varchar(50) DEFAULT NULL,
  `no_telegram_app` varchar(50) DEFAULT NULL,
  `instagram_app` varchar(50) DEFAULT NULL,
  `facebook_app` varchar(30) DEFAULT NULL,
  `tiktok_app` varchar(50) DEFAULT NULL,
  `twitter_app` varchar(50) DEFAULT NULL,
  `github_app` varchar(50) DEFAULT NULL,
  `linkedin_app` varchar(50) DEFAULT NULL,
  `youtube_app` varchar(50) DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  `mdb` varchar(30) DEFAULT NULL,
  `mdb_created` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`app_data_id`),
  KEY `portal_id` (`portal_id`),
  CONSTRAINT `mst_app_data_ibfk_1` FOREIGN KEY (`portal_id`) REFERENCES `mst_portal` (`portal_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mst_app_data` */

insert  into `mst_app_data`(`app_data_id`,`portal_id`,`logo_app`,`no_tlp_app`,`email_app`,`no_whatsapp_app`,`no_telegram_app`,`instagram_app`,`facebook_app`,`tiktok_app`,`twitter_app`,`github_app`,`linkedin_app`,`youtube_app`,`mdd`,`mdb`,`mdb_created`) values 
(1,'01','12.png','083850010004','predsampah@mail.com','083850010004','083850010004','-','-','sarjanasipil.ed','-','-','-','-','2023-07-27 10:59:51','230621000001','adminbase');

/*Table structure for table `mst_email` */

DROP TABLE IF EXISTS `mst_email`;

CREATE TABLE `mst_email` (
  `email_id` int(5) NOT NULL AUTO_INCREMENT,
  `email_name` varchar(100) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `smtp_host` varchar(50) DEFAULT NULL,
  `smtp_port` int(5) DEFAULT NULL,
  `smtp_username` varchar(50) DEFAULT NULL,
  `smtp_password` varchar(50) DEFAULT NULL,
  `use_smtp` enum('1','0') DEFAULT '1',
  `use_authorization` enum('1','0') DEFAULT '1',
  `mdb` varchar(10) DEFAULT NULL,
  `mdb_name` varchar(50) DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mst_email` */

insert  into `mst_email`(`email_id`,`email_name`,`email_address`,`smtp_host`,`smtp_port`,`smtp_username`,`smtp_password`,`use_smtp`,`use_authorization`,`mdb`,`mdb_name`,`mdd`) values 
(1,'[No Reply] Email Verifikasi','bajamelon65@gmail.com','ssl://smtp.gmail.com',465,'bajamelon65@gmail.com','uvzzmpdaetuplojk','1','1','2306210000','adminbase','2023-07-21 00:06:37');

/*Table structure for table `mst_group` */

DROP TABLE IF EXISTS `mst_group`;

CREATE TABLE `mst_group` (
  `group_id` varchar(2) NOT NULL,
  `group_nama` varchar(50) DEFAULT NULL,
  `group_deskripsi` varchar(100) DEFAULT NULL,
  `mdb` varchar(10) DEFAULT NULL,
  `mdb_name` varchar(50) DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_group` */

insert  into `mst_group`(`group_id`,`group_nama`,`group_deskripsi`,`mdb`,`mdb_name`,`mdd`) values 
('01','Developer','Pengembang Aplikasi',NULL,NULL,NULL),
('02','Pengguna','Pengguna Aplikasi',NULL,NULL,NULL);

/*Table structure for table `mst_menu` */

DROP TABLE IF EXISTS `mst_menu`;

CREATE TABLE `mst_menu` (
  `menu_id` varchar(10) NOT NULL,
  `portal_id` varchar(2) DEFAULT NULL,
  `menu_level` enum('induk','submenu','tunggal') DEFAULT NULL,
  `menu_induk` varchar(10) DEFAULT NULL,
  `menu_judul` varchar(50) DEFAULT NULL,
  `menu_deskripsi` varchar(100) DEFAULT NULL,
  `menu_url` varchar(100) DEFAULT NULL,
  `menu_urut` int(11) DEFAULT NULL,
  `status_aktif` enum('1','0') DEFAULT '1',
  `status_tampil` enum('1','0') DEFAULT '1',
  `menu_icon` varchar(50) DEFAULT NULL,
  `mdb` varchar(10) DEFAULT NULL,
  `mdb_name` varchar(50) DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `FK_com_menu_p` (`portal_id`),
  CONSTRAINT `mst_menu_ibfk_1` FOREIGN KEY (`portal_id`) REFERENCES `mst_portal` (`portal_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_menu` */

insert  into `mst_menu`(`menu_id`,`portal_id`,`menu_level`,`menu_induk`,`menu_judul`,`menu_deskripsi`,`menu_url`,`menu_urut`,`status_aktif`,`status_tampil`,`menu_icon`,`mdb`,`mdb_name`,`mdd`) values 
('01','01','tunggal','0','Dashboard','Menu Utama','dashboard',1,'1','1','fa fa-home',NULL,NULL,NULL),
('02','01','induk','0','Sistem','Sistem Aplikasi','#',20,'1','1','fa fa-cogs','2306210000','adminbase','2023-07-27 11:31:32'),
('03','01','submenu','02','Portal','Portal Aplikasi','setting/sistem/portal',1,'1','1','-',NULL,NULL,NULL),
('04','01','submenu','02','Grup','Grup User','setting/sistem/group',2,'1','1','-',NULL,NULL,NULL),
('05','01','submenu','02','Role','Role User','setting/sistem/role',3,'1','1','-',NULL,NULL,NULL),
('06','01','submenu','02','Menu','Manajemen Menu','setting/sistem/menu',4,'1','1','-',NULL,NULL,NULL),
('07','01','submenu','02','Hak Akses','Hak Akses Menu','setting/sistem/akses',5,'1','1','-',NULL,NULL,NULL),
('1689667594','01','induk','0','User Manajemen','Manajemen Data User','#',18,'1','1','fa fa-users','2306210000','adminbase','2023-07-27 11:32:06'),
('1689670027','01','submenu','1689667594','User','Data User','setting/user/user',1,'1','1','-','2306210000','adminbase','2023-07-18 15:47:07'),
('1689750554','01','induk','0','Profil','Menu Profile Akun Saya','#',19,'1','1','fa fa-user','2306210000','adminbase','2023-07-27 11:31:46'),
('1689750660','01','submenu','1689750554','Profil Saya','Data Profile Saya','profile/myprofile/profile',1,'1','1','-','2306210000','adminbase','2023-07-19 14:11:00'),
('1689870222','01','submenu','02','Email Verifikasi','Email aktifasi akun pengguna dan verifikasi reset password','setting/sistem/email',6,'1','1','-','2306210000','adminbase','2023-07-20 23:23:42'),
('1689949241','01','submenu','02','Data Aplikasi','Data-data Aplikasi','setting/sistem/app_data',7,'1','1','-','2306210000','adminbase','2023-07-21 21:20:41'),
('1690431550','01','submenu','02','Rekening Bank','Data rekening bank perusahaan','setting/sistem/rekening',8,'1','1','-','2306210000','adminbase','2023-07-27 11:38:52'),
('1690431782','01','submenu','1690431344','Transaksi Paket','Data transaksi pembeli paket','transaksi/keuangan/transaksi_paket',1,'1','1','-','2306210000','adminbase','2023-07-27 11:23:02'),
('1701856865','01','tunggal','0','Data Sampah','-','master/data/sampah',4,'1','1','fa fa-trash','2306210000','adminbase','2023-12-06 17:01:05'),
('1701856974','01','tunggal','0','Data Daerah','-','master/data/daerah',2,'1','1','fa fa-globe','2306210000','adminbase','2023-12-06 17:02:54'),
('1701857038','01','tunggal','0','Data Sungai','-','master/data/sungai',3,'1','1','fa fa-globe','2306210000','adminbase','2023-12-06 17:03:58'),
('1701879862','01','tunggal','0','Data Prediksi','-','master/data/prediksi',5,'1','1','fa fa-search-plus','2306210000','adminbase','2023-12-06 23:24:22');

/*Table structure for table `mst_portal` */

DROP TABLE IF EXISTS `mst_portal`;

CREATE TABLE `mst_portal` (
  `portal_id` varchar(2) NOT NULL,
  `portal_nm` varchar(50) DEFAULT NULL,
  `site_title` varchar(100) DEFAULT NULL,
  `site_desc` varchar(100) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `mdb` varchar(10) DEFAULT NULL,
  `mdb_name` varchar(50) DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`portal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_portal` */

insert  into `mst_portal`(`portal_id`,`portal_nm`,`site_title`,`site_desc`,`meta_desc`,`meta_keyword`,`mdb`,`mdb_name`,`mdd`) values 
('01','Prediksi Sampah','Base Code Igniter Arnap','PREDIKSI VOLUME TPA - KAB. HULU SUNGAI SELATAN, KALIMANTAN SELATAN','PREDIKSI VOLUME TPA - KAB. HULU SUNGAI SELATAN, KALIMANTAN SELATAN','PREDIKSI VOLUME TPA - KAB. HULU SUNGAI SELATAN, KALIMANTAN SELATAN','2306210000','adminbase','2023-07-27 10:53:16');

/*Table structure for table `mst_role` */

DROP TABLE IF EXISTS `mst_role`;

CREATE TABLE `mst_role` (
  `role_id` varchar(5) NOT NULL,
  `group_id` varchar(2) DEFAULT NULL,
  `role_nama` varchar(100) DEFAULT NULL,
  `role_deskripsi` varchar(100) DEFAULT NULL,
  `default_halaman` varchar(50) DEFAULT NULL,
  `mdb` varchar(50) DEFAULT NULL,
  `mdb_name` varchar(50) DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `mst_role_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `mst_group` (`group_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_role` */

insert  into `mst_role`(`role_id`,`group_id`,`role_nama`,`role_deskripsi`,`default_halaman`,`mdb`,`mdb_name`,`mdd`) values 
('01','01','Sistem Administrator','Administrator Untuk Sistem','dashboard',NULL,NULL,NULL),
('02','02','User','User','dashboard',NULL,NULL,NULL),
('03','02','Siswa','Siswa','dashboard',NULL,NULL,NULL);

/*Table structure for table `mst_role_menu` */

DROP TABLE IF EXISTS `mst_role_menu`;

CREATE TABLE `mst_role_menu` (
  `role_id` varchar(5) NOT NULL,
  `menu_id` varchar(10) NOT NULL,
  `role_menu_akses` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `mst_role_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `mst_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mst_role_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `mst_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_role_menu` */

insert  into `mst_role_menu`(`role_id`,`menu_id`,`role_menu_akses`) values 
('01','01','1'),
('01','02','1'),
('01','03','1'),
('01','04','1'),
('01','05','1'),
('01','06','1'),
('01','07','1'),
('01','1689667594','1'),
('01','1689670027','1'),
('01','1689750554','1'),
('01','1689750660','1'),
('01','1689870222','1'),
('01','1689949241','1'),
('01','1690431550','1'),
('01','1690431782','1'),
('01','1701856865','1'),
('01','1701856974','1'),
('01','1701857038','1'),
('01','1701879862','1');

/*Table structure for table `mst_role_user` */

DROP TABLE IF EXISTS `mst_role_user`;

CREATE TABLE `mst_role_user` (
  `user_id` varchar(20) NOT NULL,
  `role_id` varchar(5) NOT NULL,
  `role_default` enum('1','2') DEFAULT '2',
  `role_tampil` enum('1','0') DEFAULT '1',
  KEY `role_id` (`role_id`),
  CONSTRAINT `mst_role_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `mst_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_role_user` */

insert  into `mst_role_user`(`user_id`,`role_id`,`role_default`,`role_tampil`) values 
('230621000001','01','2','1'),
('230721000001','03','2','1'),
('230721000001','03','2','1'),
('230721000001','03','2','1');

/*Table structure for table `mst_token_verification` */

DROP TABLE IF EXISTS `mst_token_verification`;

CREATE TABLE `mst_token_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_verifikasi` enum('aktifasi_akun','reset_password') DEFAULT NULL,
  `user_mail` varchar(50) DEFAULT NULL,
  `token` varchar(256) DEFAULT NULL,
  `date_created` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mst_token_verification` */

insert  into `mst_token_verification`(`id`,`jenis_verifikasi`,`user_mail`,`token`,`date_created`) values 
(4,'','debokgedang405@gmail.com','YHzitxLUDtE017WoJ7cJn2WFxFFxraGNaiUUwORdfU4=',1689944020),
(5,'','debokgedang405@gmail.com','fugsrqqjRIkkPzHw5FG3SEGi6vTZG7KXYQ1hwYDOlZg=',1689944279);

/*Table structure for table `mst_user` */

DROP TABLE IF EXISTS `mst_user`;

CREATE TABLE `mst_user` (
  `user_id` varchar(20) NOT NULL,
  `user_alias` varchar(50) DEFAULT NULL,
  `user_nama` varchar(50) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_mail` varchar(50) DEFAULT NULL,
  `user_img_name` varchar(255) DEFAULT NULL,
  `user_st` enum('1','0','2') DEFAULT '0',
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_tlp` varchar(20) DEFAULT NULL,
  `no_whatsapp` varchar(20) DEFAULT NULL,
  `no_telegram` varchar(20) DEFAULT NULL,
  `facebook` varchar(30) DEFAULT NULL,
  `instagram` varchar(30) DEFAULT NULL,
  `twitter` varchar(30) DEFAULT NULL,
  `mdb` varchar(10) DEFAULT NULL,
  `mdb_name` varchar(50) DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mst_user` */

insert  into `mst_user`(`user_id`,`user_alias`,`user_nama`,`user_pass`,`user_mail`,`user_img_name`,`user_st`,`tgl_lahir`,`tempat_lahir`,`alamat`,`no_tlp`,`no_whatsapp`,`no_telegram`,`facebook`,`instagram`,`twitter`,`mdb`,`mdb_name`,`mdd`) values 
('230621000001','Admin Bases','adminbase','$2y$10$HFP0uf0A0IFmFGjuiu4W0eg0nhxMCW2b5DfPB3onBd0ajRVHg2As6','adminbase123@mail.com','230621000001.jpg','1','2023-07-19','Yogyakarta','Condong Catur, Depok, Sleman, Yogyakarta','082456887634','0824568876342','0824568876','admin','admin','admin','2306210000','adminbase','2023-07-19 23:55:36'),
('230721000001','DEBOK GEDANG','debokgedang','$2y$10$/x9zJAx..A039dxjRJTjpeu1d2hmYAwDIRM2JDI6vZf8fxSTEJVhG','debokgedang405@gmail.com','default.png','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-07-21 11:44:11');

/*Table structure for table `tb_daerah` */

DROP TABLE IF EXISTS `tb_daerah`;

CREATE TABLE `tb_daerah` (
  `id_daerah` int(11) NOT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kab_kota` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_daerah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_daerah` */

insert  into `tb_daerah`(`id_daerah`,`desa`,`kecamatan`,`kab_kota`,`provinsi`,`status`,`created`,`created_name`) values 
(1,'-','-','Hulu Sungai Selatan','Kalimantan Selatan','aktif','2023-12-06 16:43:53','adminbase');

/*Table structure for table `tb_prediksi` */

DROP TABLE IF EXISTS `tb_prediksi`;

CREATE TABLE `tb_prediksi` (
  `id_prediksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_sungai` int(11) DEFAULT NULL,
  `tahun_prediksi` varchar(10) DEFAULT NULL,
  `data_prediksi` text,
  `created` datetime DEFAULT NULL,
  `created_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_prediksi`),
  KEY `id_sungai` (`id_sungai`),
  CONSTRAINT `tb_prediksi_ibfk_2` FOREIGN KEY (`id_sungai`) REFERENCES `tb_sungai` (`id_sungai`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_prediksi` */

/*Table structure for table `tb_sampah` */

DROP TABLE IF EXISTS `tb_sampah`;

CREATE TABLE `tb_sampah` (
  `id_sampah` int(11) NOT NULL AUTO_INCREMENT,
  `id_sungai` int(11) DEFAULT NULL,
  `volume` varchar(100) DEFAULT NULL,
  `tgl_volume` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sampah`),
  KEY `id_sungai` (`id_sungai`),
  CONSTRAINT `tb_sampah_ibfk_1` FOREIGN KEY (`id_sungai`) REFERENCES `tb_sungai` (`id_sungai`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `tb_sampah` */

insert  into `tb_sampah`(`id_sampah`,`id_sungai`,`volume`,`tgl_volume`,`created`,`created_name`) values 
(1,1,'1263','2020-01-31',NULL,NULL),
(2,1,'1259','2020-02-28',NULL,NULL),
(3,1,'1238','2020-03-31',NULL,NULL),
(4,1,'1212','2020-04-30',NULL,NULL),
(5,1,'1235','2020-05-31',NULL,NULL),
(6,1,'1229','2020-06-30',NULL,NULL),
(7,1,'1195','2020-07-31',NULL,NULL),
(8,1,'1178','2020-08-30',NULL,NULL),
(9,1,'1170','2020-09-30',NULL,NULL),
(10,1,'1167','2020-10-31',NULL,NULL),
(11,1,'1140','2020-11-30',NULL,NULL),
(12,1,'1131','2020-12-31',NULL,NULL),
(13,1,NULL,'2021-01-31',NULL,NULL),
(14,1,NULL,'2021-02-28',NULL,NULL),
(15,1,NULL,'2021-03-30',NULL,NULL),
(16,1,NULL,'2021-04-30',NULL,NULL),
(17,1,NULL,'2021-05-30',NULL,NULL),
(18,1,NULL,'2021-06-30',NULL,NULL),
(19,1,NULL,'2021-07-30',NULL,NULL),
(20,1,NULL,'2021-08-30',NULL,NULL),
(21,1,NULL,'2021-09-30',NULL,NULL),
(22,1,NULL,'2021-10-30',NULL,NULL),
(23,1,NULL,'2021-11-30',NULL,NULL),
(24,1,NULL,'2021-12-30',NULL,NULL),
(25,1,'1311','2022-01-30',NULL,NULL),
(26,1,'1152','2022-02-28',NULL,NULL),
(27,1,'1248','2022-03-30',NULL,NULL),
(28,1,'1206','2022-04-30',NULL,NULL),
(29,1,'1266','2022-05-30',NULL,NULL),
(30,1,'1167','2022-06-30',NULL,NULL),
(31,1,'1242','2022-07-30',NULL,NULL),
(32,1,'1239','2022-08-30',NULL,NULL),
(33,1,'1197','2022-09-30',NULL,NULL),
(34,1,'1275','2022-10-30',NULL,NULL),
(35,1,'1272','2022-11-30',NULL,NULL),
(36,1,'1278','2022-12-30',NULL,NULL);

/*Table structure for table `tb_sungai` */

DROP TABLE IF EXISTS `tb_sungai`;

CREATE TABLE `tb_sungai` (
  `id_sungai` int(11) NOT NULL AUTO_INCREMENT,
  `id_daerah` int(11) DEFAULT NULL,
  `nama_sungai` varchar(50) DEFAULT NULL,
  `letak_sungai` varchar(50) DEFAULT NULL,
  `status_cctv` enum('aktif','nonaktif') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sungai`),
  KEY `id_daerah` (`id_daerah`),
  CONSTRAINT `tb_sungai_ibfk_1` FOREIGN KEY (`id_daerah`) REFERENCES `tb_daerah` (`id_daerah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_sungai` */

insert  into `tb_sungai`(`id_sungai`,`id_daerah`,`nama_sungai`,`letak_sungai`,`status_cctv`,`created`,`created_name`) values 
(1,1,'Sg. Hulu Sungai Selatan',' KAB. HULU SUNGAI SELATAN, KALIMANTAN SELATAN','aktif','2023-12-06 16:45:39','adminbase');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
