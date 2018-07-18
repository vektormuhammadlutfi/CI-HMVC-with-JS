/*
Navicat MySQL Data Transfer

Source Server         : lokal
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : dok_logistik

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-07-18 09:26:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cabang
-- ----------------------------
DROP TABLE IF EXISTS `cabang`;
CREATE TABLE `cabang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_cabang` varchar(20) NOT NULL,
  `nm_cabang` varchar(50) DEFAULT NULL,
  `alamat` mediumtext,
  `rekening` varchar(50) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `kota` varchar(11) DEFAULT NULL,
  `prov` varchar(11) DEFAULT NULL,
  `pimpinan` varchar(30) DEFAULT NULL,
  `no_hp_pimpinan` varchar(15) DEFAULT NULL,
  `biaya_pesawat_kepusat` double(15,0) DEFAULT NULL,
  `referensi_cabang` varchar(11) DEFAULT NULL,
  `jenis_cabang` enum('Biasa','Mandiri') DEFAULT NULL,
  `active` enum('1','0') DEFAULT NULL,
  `id_user` varchar(11) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of cabang
-- ----------------------------
INSERT INTO `cabang` VALUES ('1', 'MKS', 'Makassar', 'jl. Topul', 'BNI - 09876543', '04111757567', '7371', '73', 'A. Fatmawati ', '08543635375', '0', '27', 'Biasa', '1', '1', '2018-04-22 00:09:29', '2018-06-23 23:26:13');
INSERT INTO `cabang` VALUES ('2', 'BPP', 'Balikpapan', 'jl. Balikpapan', 'BRI - 34567890', '089-balikpapa', '6471', '64', 'Hj. Sitti', '08967676253', '1200000', '0', 'Mandiri', '1', '1', '2018-04-22 00:09:29', '2018-06-22 22:00:16');
INSERT INTO `cabang` VALUES ('3', 'CDW', 'Cendrawasih', 'Jl. Suka damain', 'BNI - 534634', '0987654321', '7371', '73', 'Hj. Sitti', '08967676253', null, '0', 'Mandiri', '1', '1', '2018-06-11 23:59:15', '2018-06-25 19:24:31');

-- ----------------------------
-- Table structure for drivers
-- ----------------------------
DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pooling_id` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `identitas_id` int(11) NOT NULL,
  `no_identitas` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tmp_lahir` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama_id` int(11) unsigned NOT NULL,
  `telepon` text COLLATE utf8_unicode_ci NOT NULL,
  `hp` text COLLATE utf8_unicode_ci NOT NULL,
  `sim_id` int(11) unsigned NOT NULL,
  `no_sim` text COLLATE utf8_unicode_ci NOT NULL,
  `tgl_exp_sim` date NOT NULL,
  `no_rekening` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gapok` double(20,0) NOT NULL,
  `absensi_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `absensi_label` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `absensi_date` date NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jenis_driver` enum('logistics','carcarrier') COLLATE utf8_unicode_ci DEFAULT 'logistics',
  `active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `kode_cabang` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `identitas_id` (`identitas_id`),
  KEY `agama_id` (`agama_id`),
  KEY `jns_sim` (`sim_id`),
  KEY `absensi_id` (`absensi_status`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of drivers
-- ----------------------------
INSERT INTO `drivers` VALUES ('1', '1', '1', '3672032901870000', 'RIZKI ARDIANSYAH', 'LINK. CIREME', 'rizky@gmail.com', 'KEBUMEN', '1987-01-29', '1', '-', '-', '1', '-', '0000-11-30', '', '0', 'ready', 'primary', '0000-00-00', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('2', '1', '1', '3604031808730566', 'AGUS SUBARJA', 'JERAKAH', 'agus@gamil.com', 'SERANG', '1973-08-18', '1', '-', '-', '1', '-', '2017-05-02', '', '0', 'ready', 'primary', '0000-00-00', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('3', '1', '1', '3672081603820007', 'M.JAELANI AKBAR', 'LINK. MEKAR SARI', 'jaelani@gmail.com', 'BOGOR', '1982-03-16', '1', '-', '-', '1', '-', '2017-05-02', '', '0', 'ready', 'primary', '0000-00-00', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('4', '1', '1', '3672060202560002', 'MASRAH', 'LINGK.CIDANGDANG', 'masrah@gmail.com', 'SERANG', '1956-02-02', '1', '-', '-', '1', '-', '2017-05-02', '', '0', 'ready', 'primary', '0000-00-00', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('5', '1', '1', '3175071808830022', 'AGUS FERDIANTO', 'JL. PONCOL RAYA', 'agus@gmail.com', 'JAKARTA', '1983-08-18', '1', '-', '-', '1', '-', '2017-05-02', '66', '0', 'ready', 'primary', '0000-00-00', 'noavatar.png', 'carcarrier', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('6', '1', '1', '3672022504840002', 'ACHMAD RIADI MAHA PUTRA', 'JL. MAWARI I No. 82', 'achmad@gmail.com', 'JAKARTA', '1984-04-25', '1', '-', '-', '1', '-', '2017-05-02', '', '0', 'ready', 'primary', '0000-00-00', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('7', '1', '1', '3602140812790004', 'IMAN HERMANUDIN', 'BTN ONA BLOK E.7 NO. 10', 'iman@gmail.com', 'LEBAK', '1979-12-08', '1', '-', '-', '1', '-', '2017-05-02', '', '0', 'ready', 'primary', '0000-00-00', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('8', '1', '1', '3175031208740003', 'SARTONO', 'JL. CIPINANG MUARA', 'driver@gmail.com', 'JAKATA', '1974-08-12', '1', '-', '-', '1', '-', '2017-05-02', '', '0', 'ready', 'primary', '0000-00-00', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('9', '1', '1', '3217082509780005', 'ARIEF PRASETYO', 'CIAMPEL', 'driver@gmail.com', 'SEMARANG', '1978-09-25', '1', '-', '-', '1', '-', '2017-05-02', '', '0', 'ready', 'primary', '0000-00-00', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('10', '1', '1', '3672051111830001', 'Makmur', 'LINK. JOMBANG TANGSI', 'makmur@kallatransport.co.id', 'Makassar', '1983-11-11', '1', '082188593130', '082188593130', '1', '-', '2017-05-02', '1111111', '0', 'ready', 'primary', '0000-00-00', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('106', '1', '2', '710119220008', 'H. Syamsul', 'Maros', 'haji.syamsul71@gmail.com', 'MAROS', '1971-01-09', '1', '0858245360007', '0858245360007', '3', '710119220008', '2020-01-09', '1520015596139', '0', 'ready', 'default', '2018-06-26', 'noavatar.png', 'logistics', '0', 'MKS1');
INSERT INTO `drivers` VALUES ('108', '1', '2', '1292943298432487', 'anonym', 'Jln maccini gusung stapak 13', 'distpachermks2@mail.com', 'makassar', '1994-12-20', '1', '08098212', '09370927384', '1', '1243247863', '2018-12-26', '298734873897', '10000000', 'ready', 'primary', '2017-12-27', 'noavatar.png', 'logistics', '1', 'MKS2');
INSERT INTO `drivers` VALUES ('109', '1', '2', '1905170302100', 'EMIL SALIM', 'jl. kampus uvri II', 'thier.salim@gmail.com', 'UJUNG PANDANG', '1989-12-28', '1', '085240544171', '085240544171', '1', '1905170302100', '2022-12-28', '-', '1500000', 'ready', 'primary', '2018-01-17', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('110', '1', '2', '771219052570', 'KIKY. D', 'BTN KODAM III BLOK A6 NO. 11', 'Kikykallatransport12@gmail.com', 'MANADO', '1977-12-13', '1', '081342639993', '081342639993', '1', '771219052570', '2021-12-13', '-', '0', 'ready', 'primary', '2018-01-17', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('111', '1', '1', '7371072009790001', 'FACHRUL SYAFRI', 'JL. BATUA RAYA 1NO 10', 'fachrul.syafri@gmail.com', 'JAYAPURA', '2018-01-17', '1', '08124856459', '08124856459', '3', '790919052232', '2018-09-20', '-', '0', 'ready', 'primary', '2018-01-17', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('112', '1', '1', '7371131506700001', 'SAF AGUNISMAN', 'KOMP. HARTACO PERMAI BLOK I NO. 5', 'safagung@gmail.com', 'BATU-BATU', '1970-06-15', '1', '082193771001', '082193771001', '1', '700619320051', '2021-06-15', '-', '0', 'ready', 'primary', '2018-01-23', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('113', '1', '2', '710119220008', 'H SYAMSUL', 'JL. AZALEA LOK D/5 MAROS', 'haji.syamsul71@gmail.com', 'MAROS', '1971-01-09', '1', '0858245360007', '0858245360007', '3', '710119220008', '2020-01-09', '-', '0', 'ready', 'primary', '2018-01-26', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('114', '1', '2', '1905161100070', 'ANDI FIRMAN T', 'BTN MINASA UPA BLOK K 15/ 12', 'andifatimahutami@gmail.com', 'CENDRANA', '1967-06-01', '1', '085235349522', '085235349522', '1', '1905161100070', '2021-06-01', '-', '0', 'ready', 'primary', '2018-02-05', 'noavatar.png', 'logistics', '1', 'MKS1');
INSERT INTO `drivers` VALUES ('115', '1', '2', '730912212778', 'R CHANDRA AGUNG R', 'JL.TALAS 1 NO 31 RT 02/10.PONDOK CABE ILIR PAMULANG KOTA TANGSEL', 'DRIVER@GMAIL.COM', 'TANGERANG', '1973-09-28', '1', '089632351170', '089632351170', '1', '730912212778', '2023-09-28', '-', '0', 'ready', 'primary', '2018-02-14', 'noavatar.png', 'logistics', '1', 'JKT1');
INSERT INTO `drivers` VALUES ('116', '1', '2', '641212057319', 'KARNADI', 'KALI BARU TMR GG 7/27 RT 03/07 KEL BUNGUR  JAK PUS', 'KARNADI@GMAIL.COM', 'JAKARTA PUSAT', '1964-12-16', '1', '081297678500', '081297678500', '1', '641212057319', '2018-12-16', '-', '0', 'ready', 'primary', '2018-06-26', 'noavatar.png', 'logistics', '1', 'JKT1');
INSERT INTO `drivers` VALUES ('117', '1', '2', '780913053301', 'LUKI LUWINANDANA', 'JL.MANDALA V NO 103 RT 003/011 BANDUNG', 'LUKI2@GMAIL.COM', 'BANDUNG', '1978-09-06', '1', '-', '082120222743', '1', '780913053301', '2018-06-09', '-', '0', 'ready', 'primary', '2018-02-15', 'noavatar.png', 'logistics', '1', 'JKT1');
INSERT INTO `drivers` VALUES ('118', '1', '2', '801116160808', 'TUBAGUS RIDWAN R', 'KP EMPANGSARI RT 018/005 KEL SUKATANI KEC SUKATANI', 'chris@gmail.com', 'PURWAKARTA', '1983-11-01', '1', '-', '081909374083', '1', '801116160808', '2020-11-01', '-', '0', 'ready', 'primary', '2018-02-15', 'noavatar.png', 'logistics', '1', 'JKT1');
INSERT INTO `drivers` VALUES ('119', '1', '2', '920813280672', 'DIAN MULYANA', 'TAMELANG RT 07/04 TAMELANG PURWASARI KARAWANG', 'DIAN@GMAIL.COM', 'KARAWANG', '1992-08-16', '1', '-', '081316263766', '3', '920813280672', '2020-08-16', '-', '0', 'absen', 'danger', '2018-02-15', 'noavatar.png', 'logistics', '0', 'JKT1');
INSERT INTO `drivers` VALUES ('120', '1', '2', '4103130510864', 'christian yustika w', 'JL. HEBRAS V NO 49 RT 10/12 RANCAEKEK KENCANA BANDUNG ', 'chris@gmail.com', 'CIREBON', '1973-11-05', '1', '-', '082120222743', '1', '4103130510864', '2022-11-05', '-', '0', 'ready', 'primary', '2018-02-15', 'noavatar.png', 'logistics', '1', 'JKT1');

-- ----------------------------
-- Table structure for driver_mabsen
-- ----------------------------
DROP TABLE IF EXISTS `driver_mabsen`;
CREATE TABLE `driver_mabsen` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `absensi_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `absensi_label` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of driver_mabsen
-- ----------------------------
INSERT INTO `driver_mabsen` VALUES ('1', 'Ready', 'success');
INSERT INTO `driver_mabsen` VALUES ('2', 'Izin', 'danger');
INSERT INTO `driver_mabsen` VALUES ('3', 'Match', 'default');
INSERT INTO `driver_mabsen` VALUES ('4', 'Used', 'primary');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Super Admin', 'Administrator', '2018-04-22 00:10:29', '2018-05-31 00:23:56');
INSERT INTO `groups` VALUES ('2', 'Admin', 'General User', '2018-04-22 00:10:29', '2018-05-31 00:23:56');
INSERT INTO `groups` VALUES ('3', 'Admin CS', 'bos', '2018-05-15 17:57:58', '2018-05-31 00:23:56');
INSERT INTO `groups` VALUES ('4', 'CS', '1', '2018-05-31 00:24:48', '2018-05-31 00:24:48');
INSERT INTO `groups` VALUES ('5', 'Admin Manivest', '1', '2018-05-31 00:24:48', '2018-05-31 00:24:48');
INSERT INTO `groups` VALUES ('6', 'Manivest', '1', '2018-05-31 00:24:48', '2018-05-31 00:24:48');
INSERT INTO `groups` VALUES ('7', 'Admin Baggage', '1', '2018-05-31 00:24:48', '2018-05-31 00:24:48');
INSERT INTO `groups` VALUES ('8', 'Baggage', '1', '2018-05-31 00:24:48', '2018-05-31 00:24:48');
INSERT INTO `groups` VALUES ('9', 'Admin Finance', '1', '2018-05-31 00:24:48', '2018-05-31 00:24:48');
INSERT INTO `groups` VALUES ('10', 'Finance', '1', '2018-05-31 00:24:48', '2018-05-31 00:24:48');
INSERT INTO `groups` VALUES ('11', 'Admin Marketing', '1', '2018-05-31 00:24:48', '2018-05-31 00:24:48');
INSERT INTO `groups` VALUES ('12', 'Marketing', '1', '2018-05-31 00:24:48', '2018-05-31 00:24:48');
INSERT INTO `groups` VALUES ('13', 'Admin Driver', '1', '2018-05-31 00:24:48', '2018-07-10 10:06:52');
INSERT INTO `groups` VALUES ('14', 'Driver', '1', '2018-05-31 00:24:48', '2018-07-10 10:07:04');
INSERT INTO `groups` VALUES ('15', 'Handling', '1', '2018-06-24 09:58:59', '2018-06-24 09:58:59');

-- ----------------------------
-- Table structure for ind_provinces
-- ----------------------------
DROP TABLE IF EXISTS `ind_provinces`;
CREATE TABLE `ind_provinces` (
  `id` char(2) NOT NULL,
  `name_provinces` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ind_provinces
-- ----------------------------
INSERT INTO `ind_provinces` VALUES ('11', 'ACEH');
INSERT INTO `ind_provinces` VALUES ('12', 'SUMATERA UTARA');
INSERT INTO `ind_provinces` VALUES ('13', 'SUMATERA BARAT');
INSERT INTO `ind_provinces` VALUES ('14', 'RIAU');
INSERT INTO `ind_provinces` VALUES ('15', 'JAMBI');
INSERT INTO `ind_provinces` VALUES ('16', 'SUMATERA SELATAN');
INSERT INTO `ind_provinces` VALUES ('17', 'BENGKULU');
INSERT INTO `ind_provinces` VALUES ('18', 'LAMPUNG');
INSERT INTO `ind_provinces` VALUES ('19', 'KEPULAUAN BANGKA BELITUNG');
INSERT INTO `ind_provinces` VALUES ('21', 'KEPULAUAN RIAU');
INSERT INTO `ind_provinces` VALUES ('31', 'DKI JAKARTA');
INSERT INTO `ind_provinces` VALUES ('32', 'JAWA BARAT');
INSERT INTO `ind_provinces` VALUES ('33', 'JAWA TENGAH');
INSERT INTO `ind_provinces` VALUES ('34', 'DI YOGYAKARTA');
INSERT INTO `ind_provinces` VALUES ('35', 'JAWA TIMUR');
INSERT INTO `ind_provinces` VALUES ('36', 'BANTEN');
INSERT INTO `ind_provinces` VALUES ('51', 'BALI');
INSERT INTO `ind_provinces` VALUES ('52', 'NUSA TENGGARA BARAT');
INSERT INTO `ind_provinces` VALUES ('53', 'NUSA TENGGARA TIMUR');
INSERT INTO `ind_provinces` VALUES ('61', 'KALIMANTAN BARAT');
INSERT INTO `ind_provinces` VALUES ('62', 'KALIMANTAN TENGAH');
INSERT INTO `ind_provinces` VALUES ('63', 'KALIMANTAN SELATAN');
INSERT INTO `ind_provinces` VALUES ('64', 'KALIMANTAN TIMUR');
INSERT INTO `ind_provinces` VALUES ('65', 'KALIMANTAN UTARA');
INSERT INTO `ind_provinces` VALUES ('71', 'SULAWESI UTARA');
INSERT INTO `ind_provinces` VALUES ('72', 'SULAWESI TENGAH');
INSERT INTO `ind_provinces` VALUES ('73', 'SULAWESI SELATAN');
INSERT INTO `ind_provinces` VALUES ('74', 'SULAWESI TENGGARA');
INSERT INTO `ind_provinces` VALUES ('75', 'GORONTALO');
INSERT INTO `ind_provinces` VALUES ('76', 'SULAWESI BARAT');
INSERT INTO `ind_provinces` VALUES ('81', 'MALUKU');
INSERT INTO `ind_provinces` VALUES ('82', 'MALUKU UTARA');
INSERT INTO `ind_provinces` VALUES ('91', 'PAPUA BARAT');
INSERT INTO `ind_provinces` VALUES ('94', 'PAPUA');

-- ----------------------------
-- Table structure for ind_regencies
-- ----------------------------
DROP TABLE IF EXISTS `ind_regencies`;
CREATE TABLE `ind_regencies` (
  `id_kota` char(4) NOT NULL,
  `province_id` char(2) NOT NULL,
  `name_regencies` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kota`) USING BTREE,
  KEY `regencies_province_id_index` (`province_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ind_regencies
-- ----------------------------
INSERT INTO `ind_regencies` VALUES ('1101', '11', 'KABUPATEN SIMEULUE');
INSERT INTO `ind_regencies` VALUES ('1102', '11', 'KABUPATEN ACEH SINGKIL');
INSERT INTO `ind_regencies` VALUES ('1103', '11', 'KABUPATEN ACEH SELATAN');
INSERT INTO `ind_regencies` VALUES ('1104', '11', 'KABUPATEN ACEH TENGGARA');
INSERT INTO `ind_regencies` VALUES ('1105', '11', 'KABUPATEN ACEH TIMUR');
INSERT INTO `ind_regencies` VALUES ('1106', '11', 'KABUPATEN ACEH TENGAH');
INSERT INTO `ind_regencies` VALUES ('1107', '11', 'KABUPATEN ACEH BARAT');
INSERT INTO `ind_regencies` VALUES ('1108', '11', 'KABUPATEN ACEH BESAR');
INSERT INTO `ind_regencies` VALUES ('1109', '11', 'KABUPATEN PIDIE');
INSERT INTO `ind_regencies` VALUES ('1110', '11', 'KABUPATEN BIREUEN');
INSERT INTO `ind_regencies` VALUES ('1111', '11', 'KABUPATEN ACEH UTARA');
INSERT INTO `ind_regencies` VALUES ('1112', '11', 'KABUPATEN ACEH BARAT DAYA');
INSERT INTO `ind_regencies` VALUES ('1113', '11', 'KABUPATEN GAYO LUES');
INSERT INTO `ind_regencies` VALUES ('1114', '11', 'KABUPATEN ACEH TAMIANG');
INSERT INTO `ind_regencies` VALUES ('1115', '11', 'KABUPATEN NAGAN RAYA');
INSERT INTO `ind_regencies` VALUES ('1116', '11', 'KABUPATEN ACEH JAYA');
INSERT INTO `ind_regencies` VALUES ('1117', '11', 'KABUPATEN BENER MERIAH');
INSERT INTO `ind_regencies` VALUES ('1118', '11', 'KABUPATEN PIDIE JAYA');
INSERT INTO `ind_regencies` VALUES ('1171', '11', 'KOTA BANDA ACEH');
INSERT INTO `ind_regencies` VALUES ('1172', '11', 'KOTA SABANG');
INSERT INTO `ind_regencies` VALUES ('1173', '11', 'KOTA LANGSA');
INSERT INTO `ind_regencies` VALUES ('1174', '11', 'KOTA LHOKSEUMAWE');
INSERT INTO `ind_regencies` VALUES ('1175', '11', 'KOTA SUBULUSSALAM');
INSERT INTO `ind_regencies` VALUES ('1201', '12', 'KABUPATEN NIAS');
INSERT INTO `ind_regencies` VALUES ('1202', '12', 'KABUPATEN MANDAILING NATAL');
INSERT INTO `ind_regencies` VALUES ('1203', '12', 'KABUPATEN TAPANULI SELATAN');
INSERT INTO `ind_regencies` VALUES ('1204', '12', 'KABUPATEN TAPANULI TENGAH');
INSERT INTO `ind_regencies` VALUES ('1205', '12', 'KABUPATEN TAPANULI UTARA');
INSERT INTO `ind_regencies` VALUES ('1206', '12', 'KABUPATEN TOBA SAMOSIR');
INSERT INTO `ind_regencies` VALUES ('1207', '12', 'KABUPATEN LABUHAN BATU');
INSERT INTO `ind_regencies` VALUES ('1208', '12', 'KABUPATEN ASAHAN');
INSERT INTO `ind_regencies` VALUES ('1209', '12', 'KABUPATEN SIMALUNGUN');
INSERT INTO `ind_regencies` VALUES ('1210', '12', 'KABUPATEN DAIRI');
INSERT INTO `ind_regencies` VALUES ('1211', '12', 'KABUPATEN KARO');
INSERT INTO `ind_regencies` VALUES ('1212', '12', 'KABUPATEN DELI SERDANG');
INSERT INTO `ind_regencies` VALUES ('1213', '12', 'KABUPATEN LANGKAT');
INSERT INTO `ind_regencies` VALUES ('1214', '12', 'KABUPATEN NIAS SELATAN');
INSERT INTO `ind_regencies` VALUES ('1215', '12', 'KABUPATEN HUMBANG HASUNDUTAN');
INSERT INTO `ind_regencies` VALUES ('1216', '12', 'KABUPATEN PAKPAK BHARAT');
INSERT INTO `ind_regencies` VALUES ('1217', '12', 'KABUPATEN SAMOSIR');
INSERT INTO `ind_regencies` VALUES ('1218', '12', 'KABUPATEN SERDANG BEDAGAI');
INSERT INTO `ind_regencies` VALUES ('1219', '12', 'KABUPATEN BATU BARA');
INSERT INTO `ind_regencies` VALUES ('1220', '12', 'KABUPATEN PADANG LAWAS UTARA');
INSERT INTO `ind_regencies` VALUES ('1221', '12', 'KABUPATEN PADANG LAWAS');
INSERT INTO `ind_regencies` VALUES ('1222', '12', 'KABUPATEN LABUHAN BATU SELATAN');
INSERT INTO `ind_regencies` VALUES ('1223', '12', 'KABUPATEN LABUHAN BATU UTARA');
INSERT INTO `ind_regencies` VALUES ('1224', '12', 'KABUPATEN NIAS UTARA');
INSERT INTO `ind_regencies` VALUES ('1225', '12', 'KABUPATEN NIAS BARAT');
INSERT INTO `ind_regencies` VALUES ('1271', '12', 'KOTA SIBOLGA');
INSERT INTO `ind_regencies` VALUES ('1272', '12', 'KOTA TANJUNG BALAI');
INSERT INTO `ind_regencies` VALUES ('1273', '12', 'KOTA PEMATANG SIANTAR');
INSERT INTO `ind_regencies` VALUES ('1274', '12', 'KOTA TEBING TINGGI');
INSERT INTO `ind_regencies` VALUES ('1275', '12', 'KOTA MEDAN');
INSERT INTO `ind_regencies` VALUES ('1276', '12', 'KOTA BINJAI');
INSERT INTO `ind_regencies` VALUES ('1277', '12', 'KOTA PADANGSIDIMPUAN');
INSERT INTO `ind_regencies` VALUES ('1278', '12', 'KOTA GUNUNGSITOLI');
INSERT INTO `ind_regencies` VALUES ('1301', '13', 'KABUPATEN KEPULAUAN MENTAWAI');
INSERT INTO `ind_regencies` VALUES ('1302', '13', 'KABUPATEN PESISIR SELATAN');
INSERT INTO `ind_regencies` VALUES ('1303', '13', 'KABUPATEN SOLOK');
INSERT INTO `ind_regencies` VALUES ('1304', '13', 'KABUPATEN SIJUNJUNG');
INSERT INTO `ind_regencies` VALUES ('1305', '13', 'KABUPATEN TANAH DATAR');
INSERT INTO `ind_regencies` VALUES ('1306', '13', 'KABUPATEN PADANG PARIAMAN');
INSERT INTO `ind_regencies` VALUES ('1307', '13', 'KABUPATEN AGAM');
INSERT INTO `ind_regencies` VALUES ('1308', '13', 'KABUPATEN LIMA PULUH KOTA');
INSERT INTO `ind_regencies` VALUES ('1309', '13', 'KABUPATEN PASAMAN');
INSERT INTO `ind_regencies` VALUES ('1310', '13', 'KABUPATEN SOLOK SELATAN');
INSERT INTO `ind_regencies` VALUES ('1311', '13', 'KABUPATEN DHARMASRAYA');
INSERT INTO `ind_regencies` VALUES ('1312', '13', 'KABUPATEN PASAMAN BARAT');
INSERT INTO `ind_regencies` VALUES ('1371', '13', 'KOTA PADANG');
INSERT INTO `ind_regencies` VALUES ('1372', '13', 'KOTA SOLOK');
INSERT INTO `ind_regencies` VALUES ('1373', '13', 'KOTA SAWAH LUNTO');
INSERT INTO `ind_regencies` VALUES ('1374', '13', 'KOTA PADANG PANJANG');
INSERT INTO `ind_regencies` VALUES ('1375', '13', 'KOTA BUKITTINGGI');
INSERT INTO `ind_regencies` VALUES ('1376', '13', 'KOTA PAYAKUMBUH');
INSERT INTO `ind_regencies` VALUES ('1377', '13', 'KOTA PARIAMAN');
INSERT INTO `ind_regencies` VALUES ('1401', '14', 'KABUPATEN KUANTAN SINGINGI');
INSERT INTO `ind_regencies` VALUES ('1402', '14', 'KABUPATEN INDRAGIRI HULU');
INSERT INTO `ind_regencies` VALUES ('1403', '14', 'KABUPATEN INDRAGIRI HILIR');
INSERT INTO `ind_regencies` VALUES ('1404', '14', 'KABUPATEN PELALAWAN');
INSERT INTO `ind_regencies` VALUES ('1405', '14', 'KABUPATEN S I A K');
INSERT INTO `ind_regencies` VALUES ('1406', '14', 'KABUPATEN KAMPAR');
INSERT INTO `ind_regencies` VALUES ('1407', '14', 'KABUPATEN ROKAN HULU');
INSERT INTO `ind_regencies` VALUES ('1408', '14', 'KABUPATEN BENGKALIS');
INSERT INTO `ind_regencies` VALUES ('1409', '14', 'KABUPATEN ROKAN HILIR');
INSERT INTO `ind_regencies` VALUES ('1410', '14', 'KABUPATEN KEPULAUAN MERANTI');
INSERT INTO `ind_regencies` VALUES ('1471', '14', 'KOTA PEKANBARU');
INSERT INTO `ind_regencies` VALUES ('1473', '14', 'KOTA D U M A I');
INSERT INTO `ind_regencies` VALUES ('1501', '15', 'KABUPATEN KERINCI');
INSERT INTO `ind_regencies` VALUES ('1502', '15', 'KABUPATEN MERANGIN');
INSERT INTO `ind_regencies` VALUES ('1503', '15', 'KABUPATEN SAROLANGUN');
INSERT INTO `ind_regencies` VALUES ('1504', '15', 'KABUPATEN BATANG HARI');
INSERT INTO `ind_regencies` VALUES ('1505', '15', 'KABUPATEN MUARO JAMBI');
INSERT INTO `ind_regencies` VALUES ('1506', '15', 'KABUPATEN TANJUNG JABUNG TIMUR');
INSERT INTO `ind_regencies` VALUES ('1507', '15', 'KABUPATEN TANJUNG JABUNG BARAT');
INSERT INTO `ind_regencies` VALUES ('1508', '15', 'KABUPATEN TEBO');
INSERT INTO `ind_regencies` VALUES ('1509', '15', 'KABUPATEN BUNGO');
INSERT INTO `ind_regencies` VALUES ('1571', '15', 'KOTA JAMBI');
INSERT INTO `ind_regencies` VALUES ('1572', '15', 'KOTA SUNGAI PENUH');
INSERT INTO `ind_regencies` VALUES ('1601', '16', 'KABUPATEN OGAN KOMERING ULU');
INSERT INTO `ind_regencies` VALUES ('1602', '16', 'KABUPATEN OGAN KOMERING ILIR');
INSERT INTO `ind_regencies` VALUES ('1603', '16', 'KABUPATEN MUARA ENIM');
INSERT INTO `ind_regencies` VALUES ('1604', '16', 'KABUPATEN LAHAT');
INSERT INTO `ind_regencies` VALUES ('1605', '16', 'KABUPATEN MUSI RAWAS');
INSERT INTO `ind_regencies` VALUES ('1606', '16', 'KABUPATEN MUSI BANYUASIN');
INSERT INTO `ind_regencies` VALUES ('1607', '16', 'KABUPATEN BANYU ASIN');
INSERT INTO `ind_regencies` VALUES ('1608', '16', 'KABUPATEN OGAN KOMERING ULU SELATAN');
INSERT INTO `ind_regencies` VALUES ('1609', '16', 'KABUPATEN OGAN KOMERING ULU TIMUR');
INSERT INTO `ind_regencies` VALUES ('1610', '16', 'KABUPATEN OGAN ILIR');
INSERT INTO `ind_regencies` VALUES ('1611', '16', 'KABUPATEN EMPAT LAWANG');
INSERT INTO `ind_regencies` VALUES ('1612', '16', 'KABUPATEN PENUKAL ABAB LEMATANG ILIR');
INSERT INTO `ind_regencies` VALUES ('1613', '16', 'KABUPATEN MUSI RAWAS UTARA');
INSERT INTO `ind_regencies` VALUES ('1671', '16', 'KOTA PALEMBANG');
INSERT INTO `ind_regencies` VALUES ('1672', '16', 'KOTA PRABUMULIH');
INSERT INTO `ind_regencies` VALUES ('1673', '16', 'KOTA PAGAR ALAM');
INSERT INTO `ind_regencies` VALUES ('1674', '16', 'KOTA LUBUKLINGGAU');
INSERT INTO `ind_regencies` VALUES ('1701', '17', 'KABUPATEN BENGKULU SELATAN');
INSERT INTO `ind_regencies` VALUES ('1702', '17', 'KABUPATEN REJANG LEBONG');
INSERT INTO `ind_regencies` VALUES ('1703', '17', 'KABUPATEN BENGKULU UTARA');
INSERT INTO `ind_regencies` VALUES ('1704', '17', 'KABUPATEN KAUR');
INSERT INTO `ind_regencies` VALUES ('1705', '17', 'KABUPATEN SELUMA');
INSERT INTO `ind_regencies` VALUES ('1706', '17', 'KABUPATEN MUKOMUKO');
INSERT INTO `ind_regencies` VALUES ('1707', '17', 'KABUPATEN LEBONG');
INSERT INTO `ind_regencies` VALUES ('1708', '17', 'KABUPATEN KEPAHIANG');
INSERT INTO `ind_regencies` VALUES ('1709', '17', 'KABUPATEN BENGKULU TENGAH');
INSERT INTO `ind_regencies` VALUES ('1771', '17', 'KOTA BENGKULU');
INSERT INTO `ind_regencies` VALUES ('1801', '18', 'KABUPATEN LAMPUNG BARAT');
INSERT INTO `ind_regencies` VALUES ('1802', '18', 'KABUPATEN TANGGAMUS');
INSERT INTO `ind_regencies` VALUES ('1803', '18', 'KABUPATEN LAMPUNG SELATAN');
INSERT INTO `ind_regencies` VALUES ('1804', '18', 'KABUPATEN LAMPUNG TIMUR');
INSERT INTO `ind_regencies` VALUES ('1805', '18', 'KABUPATEN LAMPUNG TENGAH');
INSERT INTO `ind_regencies` VALUES ('1806', '18', 'KABUPATEN LAMPUNG UTARA');
INSERT INTO `ind_regencies` VALUES ('1807', '18', 'KABUPATEN WAY KANAN');
INSERT INTO `ind_regencies` VALUES ('1808', '18', 'KABUPATEN TULANGBAWANG');
INSERT INTO `ind_regencies` VALUES ('1809', '18', 'KABUPATEN PESAWARAN');
INSERT INTO `ind_regencies` VALUES ('1810', '18', 'KABUPATEN PRINGSEWU');
INSERT INTO `ind_regencies` VALUES ('1811', '18', 'KABUPATEN MESUJI');
INSERT INTO `ind_regencies` VALUES ('1812', '18', 'KABUPATEN TULANG BAWANG BARAT');
INSERT INTO `ind_regencies` VALUES ('1813', '18', 'KABUPATEN PESISIR BARAT');
INSERT INTO `ind_regencies` VALUES ('1871', '18', 'KOTA BANDAR LAMPUNG');
INSERT INTO `ind_regencies` VALUES ('1872', '18', 'KOTA METRO');
INSERT INTO `ind_regencies` VALUES ('1901', '19', 'KABUPATEN BANGKA');
INSERT INTO `ind_regencies` VALUES ('1902', '19', 'KABUPATEN BELITUNG');
INSERT INTO `ind_regencies` VALUES ('1903', '19', 'KABUPATEN BANGKA BARAT');
INSERT INTO `ind_regencies` VALUES ('1904', '19', 'KABUPATEN BANGKA TENGAH');
INSERT INTO `ind_regencies` VALUES ('1905', '19', 'KABUPATEN BANGKA SELATAN');
INSERT INTO `ind_regencies` VALUES ('1906', '19', 'KABUPATEN BELITUNG TIMUR');
INSERT INTO `ind_regencies` VALUES ('1971', '19', 'KOTA PANGKAL PINANG');
INSERT INTO `ind_regencies` VALUES ('2101', '21', 'KABUPATEN KARIMUN');
INSERT INTO `ind_regencies` VALUES ('2102', '21', 'KABUPATEN BINTAN');
INSERT INTO `ind_regencies` VALUES ('2103', '21', 'KABUPATEN NATUNA');
INSERT INTO `ind_regencies` VALUES ('2104', '21', 'KABUPATEN LINGGA');
INSERT INTO `ind_regencies` VALUES ('2105', '21', 'KABUPATEN KEPULAUAN ANAMBAS');
INSERT INTO `ind_regencies` VALUES ('2171', '21', 'KOTA B A T A M');
INSERT INTO `ind_regencies` VALUES ('2172', '21', 'KOTA TANJUNG PINANG');
INSERT INTO `ind_regencies` VALUES ('3101', '31', 'KABUPATEN KEPULAUAN SERIBU');
INSERT INTO `ind_regencies` VALUES ('3171', '31', 'KOTA JAKARTA SELATAN');
INSERT INTO `ind_regencies` VALUES ('3172', '31', 'KOTA JAKARTA TIMUR');
INSERT INTO `ind_regencies` VALUES ('3173', '31', 'KOTA JAKARTA PUSAT');
INSERT INTO `ind_regencies` VALUES ('3174', '31', 'KOTA JAKARTA BARAT');
INSERT INTO `ind_regencies` VALUES ('3175', '31', 'KOTA JAKARTA UTARA');
INSERT INTO `ind_regencies` VALUES ('3201', '32', 'KABUPATEN BOGOR');
INSERT INTO `ind_regencies` VALUES ('3202', '32', 'KABUPATEN SUKABUMI');
INSERT INTO `ind_regencies` VALUES ('3203', '32', 'KABUPATEN CIANJUR');
INSERT INTO `ind_regencies` VALUES ('3204', '32', 'KABUPATEN BANDUNG');
INSERT INTO `ind_regencies` VALUES ('3205', '32', 'KABUPATEN GARUT');
INSERT INTO `ind_regencies` VALUES ('3206', '32', 'KABUPATEN TASIKMALAYA');
INSERT INTO `ind_regencies` VALUES ('3207', '32', 'KABUPATEN CIAMIS');
INSERT INTO `ind_regencies` VALUES ('3208', '32', 'KABUPATEN KUNINGAN');
INSERT INTO `ind_regencies` VALUES ('3209', '32', 'KABUPATEN CIREBON');
INSERT INTO `ind_regencies` VALUES ('3210', '32', 'KABUPATEN MAJALENGKA');
INSERT INTO `ind_regencies` VALUES ('3211', '32', 'KABUPATEN SUMEDANG');
INSERT INTO `ind_regencies` VALUES ('3212', '32', 'KABUPATEN INDRAMAYU');
INSERT INTO `ind_regencies` VALUES ('3213', '32', 'KABUPATEN SUBANG');
INSERT INTO `ind_regencies` VALUES ('3214', '32', 'KABUPATEN PURWAKARTA');
INSERT INTO `ind_regencies` VALUES ('3215', '32', 'KABUPATEN KARAWANG');
INSERT INTO `ind_regencies` VALUES ('3216', '32', 'KABUPATEN BEKASI');
INSERT INTO `ind_regencies` VALUES ('3217', '32', 'KABUPATEN BANDUNG BARAT');
INSERT INTO `ind_regencies` VALUES ('3218', '32', 'KABUPATEN PANGANDARAN');
INSERT INTO `ind_regencies` VALUES ('3271', '32', 'KOTA BOGOR');
INSERT INTO `ind_regencies` VALUES ('3272', '32', 'KOTA SUKABUMI');
INSERT INTO `ind_regencies` VALUES ('3273', '32', 'KOTA BANDUNG');
INSERT INTO `ind_regencies` VALUES ('3274', '32', 'KOTA CIREBON');
INSERT INTO `ind_regencies` VALUES ('3275', '32', 'KOTA BEKASI');
INSERT INTO `ind_regencies` VALUES ('3276', '32', 'KOTA DEPOK');
INSERT INTO `ind_regencies` VALUES ('3277', '32', 'KOTA CIMAHI');
INSERT INTO `ind_regencies` VALUES ('3278', '32', 'KOTA TASIKMALAYA');
INSERT INTO `ind_regencies` VALUES ('3279', '32', 'KOTA BANJAR');
INSERT INTO `ind_regencies` VALUES ('3301', '33', 'KABUPATEN CILACAP');
INSERT INTO `ind_regencies` VALUES ('3302', '33', 'KABUPATEN BANYUMAS');
INSERT INTO `ind_regencies` VALUES ('3303', '33', 'KABUPATEN PURBALINGGA');
INSERT INTO `ind_regencies` VALUES ('3304', '33', 'KABUPATEN BANJARNEGARA');
INSERT INTO `ind_regencies` VALUES ('3305', '33', 'KABUPATEN KEBUMEN');
INSERT INTO `ind_regencies` VALUES ('3306', '33', 'KABUPATEN PURWOREJO');
INSERT INTO `ind_regencies` VALUES ('3307', '33', 'KABUPATEN WONOSOBO');
INSERT INTO `ind_regencies` VALUES ('3308', '33', 'KABUPATEN MAGELANG');
INSERT INTO `ind_regencies` VALUES ('3309', '33', 'KABUPATEN BOYOLALI');
INSERT INTO `ind_regencies` VALUES ('3310', '33', 'KABUPATEN KLATEN');
INSERT INTO `ind_regencies` VALUES ('3311', '33', 'KABUPATEN SUKOHARJO');
INSERT INTO `ind_regencies` VALUES ('3312', '33', 'KABUPATEN WONOGIRI');
INSERT INTO `ind_regencies` VALUES ('3313', '33', 'KABUPATEN KARANGANYAR');
INSERT INTO `ind_regencies` VALUES ('3314', '33', 'KABUPATEN SRAGEN');
INSERT INTO `ind_regencies` VALUES ('3315', '33', 'KABUPATEN GROBOGAN');
INSERT INTO `ind_regencies` VALUES ('3316', '33', 'KABUPATEN BLORA');
INSERT INTO `ind_regencies` VALUES ('3317', '33', 'KABUPATEN REMBANG');
INSERT INTO `ind_regencies` VALUES ('3318', '33', 'KABUPATEN PATI');
INSERT INTO `ind_regencies` VALUES ('3319', '33', 'KABUPATEN KUDUS');
INSERT INTO `ind_regencies` VALUES ('3320', '33', 'KABUPATEN JEPARA');
INSERT INTO `ind_regencies` VALUES ('3321', '33', 'KABUPATEN DEMAK');
INSERT INTO `ind_regencies` VALUES ('3322', '33', 'KABUPATEN SEMARANG');
INSERT INTO `ind_regencies` VALUES ('3323', '33', 'KABUPATEN TEMANGGUNG');
INSERT INTO `ind_regencies` VALUES ('3324', '33', 'KABUPATEN KENDAL');
INSERT INTO `ind_regencies` VALUES ('3325', '33', 'KABUPATEN BATANG');
INSERT INTO `ind_regencies` VALUES ('3326', '33', 'KABUPATEN PEKALONGAN');
INSERT INTO `ind_regencies` VALUES ('3327', '33', 'KABUPATEN PEMALANG');
INSERT INTO `ind_regencies` VALUES ('3328', '33', 'KABUPATEN TEGAL');
INSERT INTO `ind_regencies` VALUES ('3329', '33', 'KABUPATEN BREBES');
INSERT INTO `ind_regencies` VALUES ('3371', '33', 'KOTA MAGELANG');
INSERT INTO `ind_regencies` VALUES ('3372', '33', 'KOTA SURAKARTA');
INSERT INTO `ind_regencies` VALUES ('3373', '33', 'KOTA SALATIGA');
INSERT INTO `ind_regencies` VALUES ('3374', '33', 'KOTA SEMARANG');
INSERT INTO `ind_regencies` VALUES ('3375', '33', 'KOTA PEKALONGAN');
INSERT INTO `ind_regencies` VALUES ('3376', '33', 'KOTA TEGAL');
INSERT INTO `ind_regencies` VALUES ('3401', '34', 'KABUPATEN KULON PROGO');
INSERT INTO `ind_regencies` VALUES ('3402', '34', 'KABUPATEN BANTUL');
INSERT INTO `ind_regencies` VALUES ('3403', '34', 'KABUPATEN GUNUNG KIDUL');
INSERT INTO `ind_regencies` VALUES ('3404', '34', 'KABUPATEN SLEMAN');
INSERT INTO `ind_regencies` VALUES ('3471', '34', 'KOTA YOGYAKARTA');
INSERT INTO `ind_regencies` VALUES ('3501', '35', 'KABUPATEN PACITAN');
INSERT INTO `ind_regencies` VALUES ('3502', '35', 'KABUPATEN PONOROGO');
INSERT INTO `ind_regencies` VALUES ('3503', '35', 'KABUPATEN TRENGGALEK');
INSERT INTO `ind_regencies` VALUES ('3504', '35', 'KABUPATEN TULUNGAGUNG');
INSERT INTO `ind_regencies` VALUES ('3505', '35', 'KABUPATEN BLITAR');
INSERT INTO `ind_regencies` VALUES ('3506', '35', 'KABUPATEN KEDIRI');
INSERT INTO `ind_regencies` VALUES ('3507', '35', 'KABUPATEN MALANG');
INSERT INTO `ind_regencies` VALUES ('3508', '35', 'KABUPATEN LUMAJANG');
INSERT INTO `ind_regencies` VALUES ('3509', '35', 'KABUPATEN JEMBER');
INSERT INTO `ind_regencies` VALUES ('3510', '35', 'KABUPATEN BANYUWANGI');
INSERT INTO `ind_regencies` VALUES ('3511', '35', 'KABUPATEN BONDOWOSO');
INSERT INTO `ind_regencies` VALUES ('3512', '35', 'KABUPATEN SITUBONDO');
INSERT INTO `ind_regencies` VALUES ('3513', '35', 'KABUPATEN PROBOLINGGO');
INSERT INTO `ind_regencies` VALUES ('3514', '35', 'KABUPATEN PASURUAN');
INSERT INTO `ind_regencies` VALUES ('3515', '35', 'KABUPATEN SIDOARJO');
INSERT INTO `ind_regencies` VALUES ('3516', '35', 'KABUPATEN MOJOKERTO');
INSERT INTO `ind_regencies` VALUES ('3517', '35', 'KABUPATEN JOMBANG');
INSERT INTO `ind_regencies` VALUES ('3518', '35', 'KABUPATEN NGANJUK');
INSERT INTO `ind_regencies` VALUES ('3519', '35', 'KABUPATEN MADIUN');
INSERT INTO `ind_regencies` VALUES ('3520', '35', 'KABUPATEN MAGETAN');
INSERT INTO `ind_regencies` VALUES ('3521', '35', 'KABUPATEN NGAWI');
INSERT INTO `ind_regencies` VALUES ('3522', '35', 'KABUPATEN BOJONEGORO');
INSERT INTO `ind_regencies` VALUES ('3523', '35', 'KABUPATEN TUBAN');
INSERT INTO `ind_regencies` VALUES ('3524', '35', 'KABUPATEN LAMONGAN');
INSERT INTO `ind_regencies` VALUES ('3525', '35', 'KABUPATEN GRESIK');
INSERT INTO `ind_regencies` VALUES ('3526', '35', 'KABUPATEN BANGKALAN');
INSERT INTO `ind_regencies` VALUES ('3527', '35', 'KABUPATEN SAMPANG');
INSERT INTO `ind_regencies` VALUES ('3528', '35', 'KABUPATEN PAMEKASAN');
INSERT INTO `ind_regencies` VALUES ('3529', '35', 'KABUPATEN SUMENEP');
INSERT INTO `ind_regencies` VALUES ('3571', '35', 'KOTA KEDIRI');
INSERT INTO `ind_regencies` VALUES ('3572', '35', 'KOTA BLITAR');
INSERT INTO `ind_regencies` VALUES ('3573', '35', 'KOTA MALANG');
INSERT INTO `ind_regencies` VALUES ('3574', '35', 'KOTA PROBOLINGGO');
INSERT INTO `ind_regencies` VALUES ('3575', '35', 'KOTA PASURUAN');
INSERT INTO `ind_regencies` VALUES ('3576', '35', 'KOTA MOJOKERTO');
INSERT INTO `ind_regencies` VALUES ('3577', '35', 'KOTA MADIUN');
INSERT INTO `ind_regencies` VALUES ('3578', '35', 'KOTA SURABAYA');
INSERT INTO `ind_regencies` VALUES ('3579', '35', 'KOTA BATU');
INSERT INTO `ind_regencies` VALUES ('3601', '36', 'KABUPATEN PANDEGLANG');
INSERT INTO `ind_regencies` VALUES ('3602', '36', 'KABUPATEN LEBAK');
INSERT INTO `ind_regencies` VALUES ('3603', '36', 'KABUPATEN TANGERANG');
INSERT INTO `ind_regencies` VALUES ('3604', '36', 'KABUPATEN SERANG');
INSERT INTO `ind_regencies` VALUES ('3671', '36', 'KOTA TANGERANG');
INSERT INTO `ind_regencies` VALUES ('3672', '36', 'KOTA CILEGON');
INSERT INTO `ind_regencies` VALUES ('3673', '36', 'KOTA SERANG');
INSERT INTO `ind_regencies` VALUES ('3674', '36', 'KOTA TANGERANG SELATAN');
INSERT INTO `ind_regencies` VALUES ('5101', '51', 'KABUPATEN JEMBRANA');
INSERT INTO `ind_regencies` VALUES ('5102', '51', 'KABUPATEN TABANAN');
INSERT INTO `ind_regencies` VALUES ('5103', '51', 'KABUPATEN BADUNG');
INSERT INTO `ind_regencies` VALUES ('5104', '51', 'KABUPATEN GIANYAR');
INSERT INTO `ind_regencies` VALUES ('5105', '51', 'KABUPATEN KLUNGKUNG');
INSERT INTO `ind_regencies` VALUES ('5106', '51', 'KABUPATEN BANGLI');
INSERT INTO `ind_regencies` VALUES ('5107', '51', 'KABUPATEN KARANG ASEM');
INSERT INTO `ind_regencies` VALUES ('5108', '51', 'KABUPATEN BULELENG');
INSERT INTO `ind_regencies` VALUES ('5171', '51', 'KOTA DENPASAR');
INSERT INTO `ind_regencies` VALUES ('5201', '52', 'KABUPATEN LOMBOK BARAT');
INSERT INTO `ind_regencies` VALUES ('5202', '52', 'KABUPATEN LOMBOK TENGAH');
INSERT INTO `ind_regencies` VALUES ('5203', '52', 'KABUPATEN LOMBOK TIMUR');
INSERT INTO `ind_regencies` VALUES ('5204', '52', 'KABUPATEN SUMBAWA');
INSERT INTO `ind_regencies` VALUES ('5205', '52', 'KABUPATEN DOMPU');
INSERT INTO `ind_regencies` VALUES ('5206', '52', 'KABUPATEN BIMA');
INSERT INTO `ind_regencies` VALUES ('5207', '52', 'KABUPATEN SUMBAWA BARAT');
INSERT INTO `ind_regencies` VALUES ('5208', '52', 'KABUPATEN LOMBOK UTARA');
INSERT INTO `ind_regencies` VALUES ('5271', '52', 'KOTA MATARAM');
INSERT INTO `ind_regencies` VALUES ('5272', '52', 'KOTA BIMA');
INSERT INTO `ind_regencies` VALUES ('5301', '53', 'KABUPATEN SUMBA BARAT');
INSERT INTO `ind_regencies` VALUES ('5302', '53', 'KABUPATEN SUMBA TIMUR');
INSERT INTO `ind_regencies` VALUES ('5303', '53', 'KABUPATEN KUPANG');
INSERT INTO `ind_regencies` VALUES ('5304', '53', 'KABUPATEN TIMOR TENGAH SELATAN');
INSERT INTO `ind_regencies` VALUES ('5305', '53', 'KABUPATEN TIMOR TENGAH UTARA');
INSERT INTO `ind_regencies` VALUES ('5306', '53', 'KABUPATEN BELU');
INSERT INTO `ind_regencies` VALUES ('5307', '53', 'KABUPATEN ALOR');
INSERT INTO `ind_regencies` VALUES ('5308', '53', 'KABUPATEN LEMBATA');
INSERT INTO `ind_regencies` VALUES ('5309', '53', 'KABUPATEN FLORES TIMUR');
INSERT INTO `ind_regencies` VALUES ('5310', '53', 'KABUPATEN SIKKA');
INSERT INTO `ind_regencies` VALUES ('5311', '53', 'KABUPATEN ENDE');
INSERT INTO `ind_regencies` VALUES ('5312', '53', 'KABUPATEN NGADA');
INSERT INTO `ind_regencies` VALUES ('5313', '53', 'KABUPATEN MANGGARAI');
INSERT INTO `ind_regencies` VALUES ('5314', '53', 'KABUPATEN ROTE NDAO');
INSERT INTO `ind_regencies` VALUES ('5315', '53', 'KABUPATEN MANGGARAI BARAT');
INSERT INTO `ind_regencies` VALUES ('5316', '53', 'KABUPATEN SUMBA TENGAH');
INSERT INTO `ind_regencies` VALUES ('5317', '53', 'KABUPATEN SUMBA BARAT DAYA');
INSERT INTO `ind_regencies` VALUES ('5318', '53', 'KABUPATEN NAGEKEO');
INSERT INTO `ind_regencies` VALUES ('5319', '53', 'KABUPATEN MANGGARAI TIMUR');
INSERT INTO `ind_regencies` VALUES ('5320', '53', 'KABUPATEN SABU RAIJUA');
INSERT INTO `ind_regencies` VALUES ('5321', '53', 'KABUPATEN MALAKA');
INSERT INTO `ind_regencies` VALUES ('5371', '53', 'KOTA KUPANG');
INSERT INTO `ind_regencies` VALUES ('6101', '61', 'KABUPATEN SAMBAS');
INSERT INTO `ind_regencies` VALUES ('6102', '61', 'KABUPATEN BENGKAYANG');
INSERT INTO `ind_regencies` VALUES ('6103', '61', 'KABUPATEN LANDAK');
INSERT INTO `ind_regencies` VALUES ('6104', '61', 'KABUPATEN MEMPAWAH');
INSERT INTO `ind_regencies` VALUES ('6105', '61', 'KABUPATEN SANGGAU');
INSERT INTO `ind_regencies` VALUES ('6106', '61', 'KABUPATEN KETAPANG');
INSERT INTO `ind_regencies` VALUES ('6107', '61', 'KABUPATEN SINTANG');
INSERT INTO `ind_regencies` VALUES ('6108', '61', 'KABUPATEN KAPUAS HULU');
INSERT INTO `ind_regencies` VALUES ('6109', '61', 'KABUPATEN SEKADAU');
INSERT INTO `ind_regencies` VALUES ('6110', '61', 'KABUPATEN MELAWI');
INSERT INTO `ind_regencies` VALUES ('6111', '61', 'KABUPATEN KAYONG UTARA');
INSERT INTO `ind_regencies` VALUES ('6112', '61', 'KABUPATEN KUBU RAYA');
INSERT INTO `ind_regencies` VALUES ('6171', '61', 'KOTA PONTIANAK');
INSERT INTO `ind_regencies` VALUES ('6172', '61', 'KOTA SINGKAWANG');
INSERT INTO `ind_regencies` VALUES ('6201', '62', 'KABUPATEN KOTAWARINGIN BARAT');
INSERT INTO `ind_regencies` VALUES ('6202', '62', 'KABUPATEN KOTAWARINGIN TIMUR');
INSERT INTO `ind_regencies` VALUES ('6203', '62', 'KABUPATEN KAPUAS');
INSERT INTO `ind_regencies` VALUES ('6204', '62', 'KABUPATEN BARITO SELATAN');
INSERT INTO `ind_regencies` VALUES ('6205', '62', 'KABUPATEN BARITO UTARA');
INSERT INTO `ind_regencies` VALUES ('6206', '62', 'KABUPATEN SUKAMARA');
INSERT INTO `ind_regencies` VALUES ('6207', '62', 'KABUPATEN LAMANDAU');
INSERT INTO `ind_regencies` VALUES ('6208', '62', 'KABUPATEN SERUYAN');
INSERT INTO `ind_regencies` VALUES ('6209', '62', 'KABUPATEN KATINGAN');
INSERT INTO `ind_regencies` VALUES ('6210', '62', 'KABUPATEN PULANG PISAU');
INSERT INTO `ind_regencies` VALUES ('6211', '62', 'KABUPATEN GUNUNG MAS');
INSERT INTO `ind_regencies` VALUES ('6212', '62', 'KABUPATEN BARITO TIMUR');
INSERT INTO `ind_regencies` VALUES ('6213', '62', 'KABUPATEN MURUNG RAYA');
INSERT INTO `ind_regencies` VALUES ('6271', '62', 'KOTA PALANGKA RAYA');
INSERT INTO `ind_regencies` VALUES ('6301', '63', 'KABUPATEN TANAH LAUT');
INSERT INTO `ind_regencies` VALUES ('6302', '63', 'KABUPATEN KOTA BARU');
INSERT INTO `ind_regencies` VALUES ('6303', '63', 'KABUPATEN BANJAR');
INSERT INTO `ind_regencies` VALUES ('6304', '63', 'KABUPATEN BARITO KUALA');
INSERT INTO `ind_regencies` VALUES ('6305', '63', 'KABUPATEN TAPIN');
INSERT INTO `ind_regencies` VALUES ('6306', '63', 'KABUPATEN HULU SUNGAI SELATAN');
INSERT INTO `ind_regencies` VALUES ('6307', '63', 'KABUPATEN HULU SUNGAI TENGAH');
INSERT INTO `ind_regencies` VALUES ('6308', '63', 'KABUPATEN HULU SUNGAI UTARA');
INSERT INTO `ind_regencies` VALUES ('6309', '63', 'KABUPATEN TABALONG');
INSERT INTO `ind_regencies` VALUES ('6310', '63', 'KABUPATEN TANAH BUMBU');
INSERT INTO `ind_regencies` VALUES ('6311', '63', 'KABUPATEN BALANGAN');
INSERT INTO `ind_regencies` VALUES ('6371', '63', 'KOTA BANJARMASIN');
INSERT INTO `ind_regencies` VALUES ('6372', '63', 'KOTA BANJAR BARU');
INSERT INTO `ind_regencies` VALUES ('6401', '64', 'KABUPATEN PASER');
INSERT INTO `ind_regencies` VALUES ('6402', '64', 'KABUPATEN KUTAI BARAT');
INSERT INTO `ind_regencies` VALUES ('6403', '64', 'KABUPATEN KUTAI KARTANEGARA');
INSERT INTO `ind_regencies` VALUES ('6404', '64', 'KABUPATEN KUTAI TIMUR');
INSERT INTO `ind_regencies` VALUES ('6405', '64', 'KABUPATEN BERAU');
INSERT INTO `ind_regencies` VALUES ('6409', '64', 'KABUPATEN PENAJAM PASER UTARA');
INSERT INTO `ind_regencies` VALUES ('6411', '64', 'KABUPATEN MAHAKAM HULU');
INSERT INTO `ind_regencies` VALUES ('6471', '64', 'KOTA BALIKPAPAN');
INSERT INTO `ind_regencies` VALUES ('6472', '64', 'KOTA SAMARINDA');
INSERT INTO `ind_regencies` VALUES ('6474', '64', 'KOTA BONTANG');
INSERT INTO `ind_regencies` VALUES ('6501', '65', 'KABUPATEN MALINAU');
INSERT INTO `ind_regencies` VALUES ('6502', '65', 'KABUPATEN BULUNGAN');
INSERT INTO `ind_regencies` VALUES ('6503', '65', 'KABUPATEN TANA TIDUNG');
INSERT INTO `ind_regencies` VALUES ('6504', '65', 'KABUPATEN NUNUKAN');
INSERT INTO `ind_regencies` VALUES ('6571', '65', 'KOTA TARAKAN');
INSERT INTO `ind_regencies` VALUES ('7101', '71', 'KABUPATEN BOLAANG MONGONDOW');
INSERT INTO `ind_regencies` VALUES ('7102', '71', 'KABUPATEN MINAHASA');
INSERT INTO `ind_regencies` VALUES ('7103', '71', 'KABUPATEN KEPULAUAN SANGIHE');
INSERT INTO `ind_regencies` VALUES ('7104', '71', 'KABUPATEN KEPULAUAN TALAUD');
INSERT INTO `ind_regencies` VALUES ('7105', '71', 'KABUPATEN MINAHASA SELATAN');
INSERT INTO `ind_regencies` VALUES ('7106', '71', 'KABUPATEN MINAHASA UTARA');
INSERT INTO `ind_regencies` VALUES ('7107', '71', 'KABUPATEN BOLAANG MONGONDOW UTARA');
INSERT INTO `ind_regencies` VALUES ('7108', '71', 'KABUPATEN SIAU TAGULANDANG BIARO');
INSERT INTO `ind_regencies` VALUES ('7109', '71', 'KABUPATEN MINAHASA TENGGARA');
INSERT INTO `ind_regencies` VALUES ('7110', '71', 'KABUPATEN BOLAANG MONGONDOW SELATAN');
INSERT INTO `ind_regencies` VALUES ('7111', '71', 'KABUPATEN BOLAANG MONGONDOW TIMUR');
INSERT INTO `ind_regencies` VALUES ('7171', '71', 'KOTA MANADO');
INSERT INTO `ind_regencies` VALUES ('7172', '71', 'KOTA BITUNG');
INSERT INTO `ind_regencies` VALUES ('7173', '71', 'KOTA TOMOHON');
INSERT INTO `ind_regencies` VALUES ('7174', '71', 'KOTA KOTAMOBAGU');
INSERT INTO `ind_regencies` VALUES ('7201', '72', 'KABUPATEN BANGGAI KEPULAUAN');
INSERT INTO `ind_regencies` VALUES ('7202', '72', 'KABUPATEN BANGGAI');
INSERT INTO `ind_regencies` VALUES ('7203', '72', 'KABUPATEN MOROWALI');
INSERT INTO `ind_regencies` VALUES ('7204', '72', 'KABUPATEN POSO');
INSERT INTO `ind_regencies` VALUES ('7205', '72', 'KABUPATEN DONGGALA');
INSERT INTO `ind_regencies` VALUES ('7206', '72', 'KABUPATEN TOLI-TOLI');
INSERT INTO `ind_regencies` VALUES ('7207', '72', 'KABUPATEN BUOL');
INSERT INTO `ind_regencies` VALUES ('7208', '72', 'KABUPATEN PARIGI MOUTONG');
INSERT INTO `ind_regencies` VALUES ('7209', '72', 'KABUPATEN TOJO UNA-UNA');
INSERT INTO `ind_regencies` VALUES ('7210', '72', 'KABUPATEN SIGI');
INSERT INTO `ind_regencies` VALUES ('7211', '72', 'KABUPATEN BANGGAI LAUT');
INSERT INTO `ind_regencies` VALUES ('7212', '72', 'KABUPATEN MOROWALI UTARA');
INSERT INTO `ind_regencies` VALUES ('7271', '72', 'KOTA PALU');
INSERT INTO `ind_regencies` VALUES ('7301', '73', 'KABUPATEN KEPULAUAN SELAYAR');
INSERT INTO `ind_regencies` VALUES ('7302', '73', 'KABUPATEN BULUKUMBA');
INSERT INTO `ind_regencies` VALUES ('7303', '73', 'KABUPATEN BANTAENG');
INSERT INTO `ind_regencies` VALUES ('7304', '73', 'KABUPATEN JENEPONTO');
INSERT INTO `ind_regencies` VALUES ('7305', '73', 'KABUPATEN TAKALAR');
INSERT INTO `ind_regencies` VALUES ('7306', '73', 'KABUPATEN GOWA');
INSERT INTO `ind_regencies` VALUES ('7307', '73', 'KABUPATEN SINJAI');
INSERT INTO `ind_regencies` VALUES ('7308', '73', 'KABUPATEN MAROS');
INSERT INTO `ind_regencies` VALUES ('7309', '73', 'KABUPATEN PANGKAJENE DAN KEPULAUAN');
INSERT INTO `ind_regencies` VALUES ('7310', '73', 'KABUPATEN BARRU');
INSERT INTO `ind_regencies` VALUES ('7311', '73', 'KABUPATEN BONE');
INSERT INTO `ind_regencies` VALUES ('7312', '73', 'KABUPATEN SOPPENG');
INSERT INTO `ind_regencies` VALUES ('7313', '73', 'KABUPATEN WAJO');
INSERT INTO `ind_regencies` VALUES ('7314', '73', 'KABUPATEN SIDENRENG RAPPANG');
INSERT INTO `ind_regencies` VALUES ('7315', '73', 'KABUPATEN PINRANG');
INSERT INTO `ind_regencies` VALUES ('7316', '73', 'KABUPATEN ENREKANG');
INSERT INTO `ind_regencies` VALUES ('7317', '73', 'KABUPATEN LUWU');
INSERT INTO `ind_regencies` VALUES ('7318', '73', 'KABUPATEN TANA TORAJA');
INSERT INTO `ind_regencies` VALUES ('7322', '73', 'KABUPATEN LUWU UTARA');
INSERT INTO `ind_regencies` VALUES ('7325', '73', 'KABUPATEN LUWU TIMUR');
INSERT INTO `ind_regencies` VALUES ('7326', '73', 'KABUPATEN TORAJA UTARA');
INSERT INTO `ind_regencies` VALUES ('7371', '73', 'MAKASSAR');
INSERT INTO `ind_regencies` VALUES ('7372', '73', 'PAREPARE');
INSERT INTO `ind_regencies` VALUES ('7373', '73', 'PALOPO');
INSERT INTO `ind_regencies` VALUES ('7401', '74', 'KABUPATEN BUTON');
INSERT INTO `ind_regencies` VALUES ('7402', '74', 'KABUPATEN MUNA');
INSERT INTO `ind_regencies` VALUES ('7403', '74', 'KABUPATEN KONAWE');
INSERT INTO `ind_regencies` VALUES ('7404', '74', 'KABUPATEN KOLAKA');
INSERT INTO `ind_regencies` VALUES ('7405', '74', 'KABUPATEN KONAWE SELATAN');
INSERT INTO `ind_regencies` VALUES ('7406', '74', 'KABUPATEN BOMBANA');
INSERT INTO `ind_regencies` VALUES ('7407', '74', 'KABUPATEN WAKATOBI');
INSERT INTO `ind_regencies` VALUES ('7408', '74', 'KABUPATEN KOLAKA UTARA');
INSERT INTO `ind_regencies` VALUES ('7409', '74', 'KABUPATEN BUTON UTARA');
INSERT INTO `ind_regencies` VALUES ('7410', '74', 'KABUPATEN KONAWE UTARA');
INSERT INTO `ind_regencies` VALUES ('7411', '74', 'KABUPATEN KOLAKA TIMUR');
INSERT INTO `ind_regencies` VALUES ('7412', '74', 'KABUPATEN KONAWE KEPULAUAN');
INSERT INTO `ind_regencies` VALUES ('7413', '74', 'KABUPATEN MUNA BARAT');
INSERT INTO `ind_regencies` VALUES ('7414', '74', 'KABUPATEN BUTON TENGAH');
INSERT INTO `ind_regencies` VALUES ('7415', '74', 'KABUPATEN BUTON SELATAN');
INSERT INTO `ind_regencies` VALUES ('7471', '74', 'KOTA KENDARI');
INSERT INTO `ind_regencies` VALUES ('7472', '74', 'KOTA BAUBAU');
INSERT INTO `ind_regencies` VALUES ('7501', '75', 'KABUPATEN BOALEMO');
INSERT INTO `ind_regencies` VALUES ('7502', '75', 'KABUPATEN GORONTALO');
INSERT INTO `ind_regencies` VALUES ('7503', '75', 'KABUPATEN POHUWATO');
INSERT INTO `ind_regencies` VALUES ('7504', '75', 'KABUPATEN BONE BOLANGO');
INSERT INTO `ind_regencies` VALUES ('7505', '75', 'KABUPATEN GORONTALO UTARA');
INSERT INTO `ind_regencies` VALUES ('7571', '75', 'KOTA GORONTALO');
INSERT INTO `ind_regencies` VALUES ('7601', '76', 'KABUPATEN MAJENE');
INSERT INTO `ind_regencies` VALUES ('7602', '76', 'KABUPATEN POLEWALI MANDAR');
INSERT INTO `ind_regencies` VALUES ('7603', '76', 'KABUPATEN MAMASA');
INSERT INTO `ind_regencies` VALUES ('7604', '76', 'KABUPATEN MAMUJU');
INSERT INTO `ind_regencies` VALUES ('7605', '76', 'KABUPATEN MAMUJU UTARA');
INSERT INTO `ind_regencies` VALUES ('7606', '76', 'KABUPATEN MAMUJU TENGAH');
INSERT INTO `ind_regencies` VALUES ('8101', '81', 'KABUPATEN MALUKU TENGGARA BARAT');
INSERT INTO `ind_regencies` VALUES ('8102', '81', 'KABUPATEN MALUKU TENGGARA');
INSERT INTO `ind_regencies` VALUES ('8103', '81', 'KABUPATEN MALUKU TENGAH');
INSERT INTO `ind_regencies` VALUES ('8104', '81', 'KABUPATEN BURU');
INSERT INTO `ind_regencies` VALUES ('8105', '81', 'KABUPATEN KEPULAUAN ARU');
INSERT INTO `ind_regencies` VALUES ('8106', '81', 'KABUPATEN SERAM BAGIAN BARAT');
INSERT INTO `ind_regencies` VALUES ('8107', '81', 'KABUPATEN SERAM BAGIAN TIMUR');
INSERT INTO `ind_regencies` VALUES ('8108', '81', 'KABUPATEN MALUKU BARAT DAYA');
INSERT INTO `ind_regencies` VALUES ('8109', '81', 'KABUPATEN BURU SELATAN');
INSERT INTO `ind_regencies` VALUES ('8171', '81', 'KOTA AMBON');
INSERT INTO `ind_regencies` VALUES ('8172', '81', 'KOTA TUAL');
INSERT INTO `ind_regencies` VALUES ('8201', '82', 'KABUPATEN HALMAHERA BARAT');
INSERT INTO `ind_regencies` VALUES ('8202', '82', 'KABUPATEN HALMAHERA TENGAH');
INSERT INTO `ind_regencies` VALUES ('8203', '82', 'KABUPATEN KEPULAUAN SULA');
INSERT INTO `ind_regencies` VALUES ('8204', '82', 'KABUPATEN HALMAHERA SELATAN');
INSERT INTO `ind_regencies` VALUES ('8205', '82', 'KABUPATEN HALMAHERA UTARA');
INSERT INTO `ind_regencies` VALUES ('8206', '82', 'KABUPATEN HALMAHERA TIMUR');
INSERT INTO `ind_regencies` VALUES ('8207', '82', 'KABUPATEN PULAU MOROTAI');
INSERT INTO `ind_regencies` VALUES ('8208', '82', 'KABUPATEN PULAU TALIABU');
INSERT INTO `ind_regencies` VALUES ('8271', '82', 'KOTA TERNATE');
INSERT INTO `ind_regencies` VALUES ('8272', '82', 'KOTA TIDORE KEPULAUAN');
INSERT INTO `ind_regencies` VALUES ('9101', '91', 'KABUPATEN FAKFAK');
INSERT INTO `ind_regencies` VALUES ('9102', '91', 'KABUPATEN KAIMANA');
INSERT INTO `ind_regencies` VALUES ('9103', '91', 'KABUPATEN TELUK WONDAMA');
INSERT INTO `ind_regencies` VALUES ('9104', '91', 'KABUPATEN TELUK BINTUNI');
INSERT INTO `ind_regencies` VALUES ('9105', '91', 'KABUPATEN MANOKWARI');
INSERT INTO `ind_regencies` VALUES ('9106', '91', 'KABUPATEN SORONG SELATAN');
INSERT INTO `ind_regencies` VALUES ('9107', '91', 'KABUPATEN SORONG');
INSERT INTO `ind_regencies` VALUES ('9108', '91', 'KABUPATEN RAJA AMPAT');
INSERT INTO `ind_regencies` VALUES ('9109', '91', 'KABUPATEN TAMBRAUW');
INSERT INTO `ind_regencies` VALUES ('9110', '91', 'KABUPATEN MAYBRAT');
INSERT INTO `ind_regencies` VALUES ('9111', '91', 'KABUPATEN MANOKWARI SELATAN');
INSERT INTO `ind_regencies` VALUES ('9112', '91', 'KABUPATEN PEGUNUNGAN ARFAK');
INSERT INTO `ind_regencies` VALUES ('9171', '91', 'KOTA SORONG');
INSERT INTO `ind_regencies` VALUES ('9401', '94', 'KABUPATEN MERAUKE');
INSERT INTO `ind_regencies` VALUES ('9402', '94', 'KABUPATEN JAYAWIJAYA');
INSERT INTO `ind_regencies` VALUES ('9403', '94', 'KABUPATEN JAYAPURA');
INSERT INTO `ind_regencies` VALUES ('9404', '94', 'KABUPATEN NABIRE');
INSERT INTO `ind_regencies` VALUES ('9408', '94', 'KABUPATEN KEPULAUAN YAPEN');
INSERT INTO `ind_regencies` VALUES ('9409', '94', 'KABUPATEN BIAK NUMFOR');
INSERT INTO `ind_regencies` VALUES ('9410', '94', 'KABUPATEN PANIAI');
INSERT INTO `ind_regencies` VALUES ('9411', '94', 'KABUPATEN PUNCAK JAYA');
INSERT INTO `ind_regencies` VALUES ('9412', '94', 'KABUPATEN MIMIKA');
INSERT INTO `ind_regencies` VALUES ('9413', '94', 'KABUPATEN BOVEN DIGOEL');
INSERT INTO `ind_regencies` VALUES ('9414', '94', 'KABUPATEN MAPPI');
INSERT INTO `ind_regencies` VALUES ('9415', '94', 'KABUPATEN ASMAT');
INSERT INTO `ind_regencies` VALUES ('9416', '94', 'KABUPATEN YAHUKIMO');
INSERT INTO `ind_regencies` VALUES ('9417', '94', 'KABUPATEN PEGUNUNGAN BINTANG');
INSERT INTO `ind_regencies` VALUES ('9418', '94', 'KABUPATEN TOLIKARA');
INSERT INTO `ind_regencies` VALUES ('9419', '94', 'KABUPATEN SARMI');
INSERT INTO `ind_regencies` VALUES ('9420', '94', 'KABUPATEN KEEROM');
INSERT INTO `ind_regencies` VALUES ('9426', '94', 'KABUPATEN WAROPEN');
INSERT INTO `ind_regencies` VALUES ('9427', '94', 'KABUPATEN SUPIORI');
INSERT INTO `ind_regencies` VALUES ('9428', '94', 'KABUPATEN MAMBERAMO RAYA');
INSERT INTO `ind_regencies` VALUES ('9429', '94', 'KABUPATEN NDUGA');
INSERT INTO `ind_regencies` VALUES ('9430', '94', 'KABUPATEN LANNY JAYA');
INSERT INTO `ind_regencies` VALUES ('9431', '94', 'KABUPATEN MAMBERAMO TENGAH');
INSERT INTO `ind_regencies` VALUES ('9432', '94', 'KABUPATEN YALIMO');
INSERT INTO `ind_regencies` VALUES ('9433', '94', 'KABUPATEN PUNCAK');
INSERT INTO `ind_regencies` VALUES ('9434', '94', 'KABUPATEN DOGIYAI');
INSERT INTO `ind_regencies` VALUES ('9435', '94', 'KABUPATEN INTAN JAYA');
INSERT INTO `ind_regencies` VALUES ('9436', '94', 'KABUPATEN DEIYAI');
INSERT INTO `ind_regencies` VALUES ('9471', '94', 'KOTA JAYAPURA');

-- ----------------------------
-- Table structure for login_attempts
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of login_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for master_agama
-- ----------------------------
DROP TABLE IF EXISTS `master_agama`;
CREATE TABLE `master_agama` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `agama` char(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of master_agama
-- ----------------------------
INSERT INTO `master_agama` VALUES ('1', 'Islam');
INSERT INTO `master_agama` VALUES ('2', 'Kristen Katolik');
INSERT INTO `master_agama` VALUES ('3', 'Kristen Protestan');
INSERT INTO `master_agama` VALUES ('4', 'Hindu');
INSERT INTO `master_agama` VALUES ('5', 'Budha');

-- ----------------------------
-- Table structure for master_identitas
-- ----------------------------
DROP TABLE IF EXISTS `master_identitas`;
CREATE TABLE `master_identitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_identitas` char(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of master_identitas
-- ----------------------------
INSERT INTO `master_identitas` VALUES ('1', 'KTP');
INSERT INTO `master_identitas` VALUES ('2', 'SIM');
INSERT INTO `master_identitas` VALUES ('3', 'KK');

-- ----------------------------
-- Table structure for master_sim
-- ----------------------------
DROP TABLE IF EXISTS `master_sim`;
CREATE TABLE `master_sim` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `jenis` char(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of master_sim
-- ----------------------------
INSERT INTO `master_sim` VALUES ('1', 'A');
INSERT INTO `master_sim` VALUES ('2', 'C');
INSERT INTO `master_sim` VALUES ('3', 'B1');
INSERT INTO `master_sim` VALUES ('4', 'B2');

-- ----------------------------
-- Table structure for tbl_cabang
-- ----------------------------
DROP TABLE IF EXISTS `tbl_cabang`;
CREATE TABLE `tbl_cabang` (
  `id_cabang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_cabang` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `inisial_cabang` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `nama_cabang` varchar(255) CHARACTER SET latin1 NOT NULL,
  `alamat_cabang` text CHARACTER SET latin1 NOT NULL,
  `provinsi` int(11) NOT NULL,
  `kota_kabupaten` int(11) NOT NULL,
  `email_cabang` varchar(255) CHARACTER SET latin1 NOT NULL,
  `telepon_cabang` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fax_cabang` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nama_pic` varchar(100) CHARACTER SET latin1 NOT NULL,
  `adh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat_pic` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email_pic` varchar(255) CHARACTER SET latin1 NOT NULL,
  `telepon_pic` varchar(255) CHARACTER SET latin1 NOT NULL,
  `hp_pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `latlng` text COLLATE utf8_unicode_ci,
  `is_aktif` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cabang`),
  KEY `kode_cabang` (`kode_cabang`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_cabang
-- ----------------------------
INSERT INTO `tbl_cabang` VALUES ('1', 'MKS1', '01', 'Makassar', 'Jl. Ir Sutami .No.9 Makassar', '1', '1', 'makassar@email.com', '0411-551991', '0411-551992', 'Ali Wardana', 'FAISAL FAHRUL', 'jl. Andalas', 'email@email.com', '0411-7892345', '', '{\"lat\":\"-5.072704\",\"lng\":\"119.520485\"}', '1');
INSERT INTO `tbl_cabang` VALUES ('2', 'BPP1', '02', 'Balikpapan', 'JL. Ruhui Rahayu No. 27', '0', '0', 'bju.kallatransport@gmail.com', '0542-8879428', '', 'Muh. Agus', 'MUH.  FARUL', 'Jl. Ruhui Rahayu No. 27 Balikpapan 76114', 'ahmad.muhammad@kallatransport.com', '0542-8879428', '', '{\"lat\":\"-1.269160\",\"lng\":\"116.825264\"}', '1');
INSERT INTO `tbl_cabang` VALUES ('3', 'JKT1', '03', 'Jakarta', 'Jl. Intan No. 14 RSPP, Cilandak - Jakarta Selatan', '0', '0', '', '021-7693464', '021-7693605', 'Indra Sastrawat', 'BUDI WALUYO', 'Jl. Cidodol Komplek Kampus Jaya No. 8 Kebayoran Lama Jakarta Selatan \r\n', 'rino_wattimena@kallarent.com', '087877788599/081218989375', '', '{\"lat\":\"-6.202555\",\"lng\":\"106.844813\"}', '1');
INSERT INTO `tbl_cabang` VALUES ('4', 'SBY1', '04', 'Surabaya', 'Perumahan Araya Galaxy Bumi Permai Blok N 1 No.12 A, Kel. Medokan Semampir, Surabaya', '0', '0', 'info@kallatransport.co.id', '(031)5912221', '', 'Hasanuddin Soedarno', 'MUH. RODJA', 'Perum. Citra Harmoni Blok C2 / 23 Taman-Sepanjang Sidoarjo Kelurahan Taman Sepanjang Sidoarjo', 'hasanuddin@outlook.com', '', '', '{\"lat\":\"-7.256679\",\"lng\":\"112.752074\"}', '1');
INSERT INTO `tbl_cabang` VALUES ('5', 'JOG1', '05', 'Yogyakarta', '', '0', '0', 'info@kallatransport.co.id', '', '', 'Avif Detak Aji', 'HERI WIBOWO', '', '', '', '', '{\"lat\":\"-7.797185\",\"lng\":\"110.388711\"}', '1');
INSERT INTO `tbl_cabang` VALUES ('6', 'CABO', '06', 'Cahaya Bone', 'Jl. Andalas', '0', '0', '', '', '', 'Zainuddin', null, '', '', '', '', '{\"lat\":\"-5.129987\",\"lng\":\"119.418906\"}', '1');
INSERT INTO `tbl_cabang` VALUES ('7', 'PDC1', '07', 'Pre Delivery Center - Makassar', '', '0', '0', 'info@kallatransport.co.id', '', '', 'Fardi Gaffar', null, '', '', '', '', '{\"lat\":\"-5.072704\",\"lng\":\"119.520485\"}', '1');
INSERT INTO `tbl_cabang` VALUES ('8', 'HO', '00', 'Head Office', 'Jl. Dr. Samratulangi No 8 Wisma Kalla Lt. 15 ', '1', '1', '-', '0411-', '-', 'Triowijaya Putra', null, 'JL. Minasaupa', '-', '-', '-', '{\"lat\":\"-5.158661\",\"lng\":\"119.436548\"}', '1');
INSERT INTO `tbl_cabang` VALUES ('9', 'MKS2', '08', 'Makassar 2', 'Jl. ', '0', '0', '-', '', '', 'Pieter Yulles', 'PIETER YULLES', '-', '-', '-', '-', null, '1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `kode_cabang` varchar(11) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', null, null, null, '1268889823', '1531876995', '1', 'Admin', 'istrator', 'ADMIN', '0', 'MKS', '2018-04-22 00:13:59', '2018-07-18 09:23:15');
INSERT INTO `users` VALUES ('14', '::1', 'cs', '$2y$08$gB8c/lOa03Cmw9UewYo0rusFpnnVn.snayit1BPSwXEzCtE56M8s.', null, 'cs@cs.com', null, null, null, null, '1527697847', '1529612916', '1', 'CS', 'Tini', null, '-', 'MKS', '2018-05-31 00:30:47', '2018-06-22 04:28:36');
INSERT INTO `users` VALUES ('15', '::1', 'manivest', '$2y$08$.xRNmSLdQkHBl50H98n3oe7A77CqO4.YFf6AWf8KFu7CCy1VaPJkS', null, 'manivest@manivest.com', null, null, null, null, '1527705824', '1529997933', '1', 'Manivest', '-', null, '-', 'MKS', '2018-05-31 02:43:44', '2018-06-26 15:25:33');
INSERT INTO `users` VALUES ('16', '::1', 'finance', '$2y$08$kq0jkMVpOXkUd4ZgS2KjDu36/y/tkTkhichRsrO0mQlcKG4F4Vhl.', null, 'finance@finance.com', null, null, null, null, '1527705885', '1529995482', '1', 'Umrah', '-', null, '-', 'MKS', '2018-05-31 02:44:45', '2018-06-26 14:44:42');
INSERT INTO `users` VALUES ('17', '::1', 'marketing', '$2y$08$s47Grck1Fja3.bE/5wTzm.HRBqOo9ODM3GJqGWgmyrVOy1y6bNh42', null, 'marketing@marketing.com', null, null, null, null, '1527705950', '1527707210', '1', 'Marketing', '-', null, '-', 'MKS', '2018-05-31 02:45:50', '2018-05-31 03:06:50');
INSERT INTO `users` VALUES ('18', '::1', 'baggage', '$2y$08$mA/GNl3uS6E5e7NZNR/4teRSqC8BydgzA48NdDc/asF4MOVyDe/ge', null, 'baggage@baggage.com', null, null, null, null, '1527706010', '1529464626', '1', 'Baggage', '-', null, '-', 'MKS', '2018-05-31 02:46:50', '2018-06-20 11:24:43');
INSERT INTO `users` VALUES ('19', '::1', 'financee', '$2y$08$yg5Ws7tIgxwRPLMVopafGO6Ai/pGsYcPYKPuCOZxuUNIziDasnsYa', null, 'financee@financee.com', null, null, null, null, '1528302266', '1528306878', '0', 'Financee', '-', null, '085342131946', 'MKS', '2018-06-07 00:24:26', '2018-07-10 10:06:32');

-- ----------------------------
-- Table structure for users_agent
-- ----------------------------
DROP TABLE IF EXISTS `users_agent`;
CREATE TABLE `users_agent` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `ip` varchar(250) NOT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `perangkat` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `pengunjung` varchar(255) DEFAULT NULL,
  `user_id` int(250) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of users_agent
-- ----------------------------
INSERT INTO `users_agent` VALUES ('1', '::1', '2018-05-08 23:59:03', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('2', '::1', '2018-05-09 11:08:53', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('3', '::1', '2018-05-10 01:23:29', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('4', '::1', '2018-05-10 01:52:20', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('5', '::1', '2018-05-11 10:10:16', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('6', '::1', '2018-05-11 10:48:57', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('7', '::1', '2018-05-12 06:22:38', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('8', '::1', '2018-05-12 12:01:39', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('9', '::1', '2018-05-12 12:05:37', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('10', '::1', '2018-05-14 15:46:22', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('11', '::1', '2018-05-14 19:59:23', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('12', '::1', '2018-05-15 17:47:40', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('13', '::1', '2018-05-15 23:20:12', 'Windows 10', 'Chrome 66.0.3359.139', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('14', '192.168.1.27', '2018-06-26 15:25:33', 'Windows 7', 'Chrome 67.0.3396.99', 'VISITOR', '15', null);
INSERT INTO `users_agent` VALUES ('15', '::1', '2018-07-06 14:28:16', 'Windows 10', 'Chrome 67.0.3396.99', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('16', '::1', '2018-07-09 11:01:13', 'Windows 10', 'Chrome 67.0.3396.99', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('17', '::1', '2018-07-10 08:58:05', 'Windows 10', 'Chrome 67.0.3396.99', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('18', '::1', '2018-07-11 11:02:16', 'Windows 10', 'Chrome 67.0.3396.99', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('19', '::1', '2018-07-12 08:31:45', 'Windows 10', 'Chrome 67.0.3396.99', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('20', '::1', '2018-03-13 14:24:25', 'Windows 10', 'Chrome 67.0.3396.99', 'VISITOR', '1', null);
INSERT INTO `users_agent` VALUES ('21', '::1', '2018-07-18 09:23:15', 'Windows 10', 'Chrome 67.0.3396.99', 'VISITOR', '1', null);

-- ----------------------------
-- Table structure for users_groups
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`) USING BTREE,
  KEY `fk_users_groups_users1_idx` (`user_id`) USING BTREE,
  KEY `fk_users_groups_groups1_idx` (`group_id`) USING BTREE,
  CONSTRAINT `users_groups_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES ('1', '1', '1', null, '2018-05-31 00:43:20');
INSERT INTO `users_groups` VALUES ('17', '14', '3', null, '2018-06-22 04:29:38');
INSERT INTO `users_groups` VALUES ('18', '15', '5', null, null);
INSERT INTO `users_groups` VALUES ('19', '16', '9', null, null);
INSERT INTO `users_groups` VALUES ('20', '17', '11', null, null);
INSERT INTO `users_groups` VALUES ('21', '18', '7', null, '2018-06-20 11:24:49');
INSERT INTO `users_groups` VALUES ('22', '19', '9', null, '2018-06-26 14:13:07');

-- ----------------------------
-- Table structure for uti_customer
-- ----------------------------
DROP TABLE IF EXISTS `uti_customer`;
CREATE TABLE `uti_customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nm_customer` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_customer` varchar(15) DEFAULT NULL,
  `ktp` varchar(30) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  `kode_cabang` char(10) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_customer`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of uti_customer
-- ----------------------------
INSERT INTO `uti_customer` VALUES ('1', 'Makmur', null, 'Jl. Sepakat No. 53', 'Personal', '7272727272727', '0909090909', '-', 'MKS1', '1', '2018-04-11 09:54:37');
INSERT INTO `uti_customer` VALUES ('2', 'Akbar Anugrah', null, '-', 'Personal', '-', '-', '-', 'MKS1', '1', '2018-04-11 09:54:38');
INSERT INTO `uti_customer` VALUES ('3', 'Harisma', null, '-', 'Personal', '-', '-', '-', 'MKS1', '1', '2018-04-11 09:54:39');
INSERT INTO `uti_customer` VALUES ('4', 'Perindo Sulselxx', null, '-', 'Personal', '-', '-', '-', 'MKS1', '1', '2018-04-11 09:54:40');
INSERT INTO `uti_customer` VALUES ('14', 'Burhanuddim', null, 'Makassar Kota Daeng', 'Personal', '-', '-', '-', 'MKS1', '1', '2018-04-11 09:54:41');
INSERT INTO `uti_customer` VALUES ('15', 'Portlets', null, 'Northern', 'Business', '', '', 'Antartica', 'MKS1', '1', '2018-04-11 09:54:45');
INSERT INTO `uti_customer` VALUES ('16', 'dfsdfsd', 'sdfdsfds@mail.com', 'sdfsdfsd', 'Personal', '4363466', '34543534', '4436435', 'MKS1', '1', '2018-04-11 10:49:58');
INSERT INTO `uti_customer` VALUES ('17', 'dscdcdscdsvds', 'sddsdscdsc', 'sddsvdsvdsvds', 'Personal', 'sdcdscdsc', 'dscdscdsc', 'sdcdsdsvds', 'MKS1', '1', '2018-04-11 15:11:06');
INSERT INTO `uti_customer` VALUES ('18', 'lutfi', 'sddsdscdsc', 'sddsvdsvdsvds', 'Personal', 'sdcdscdsc', 'dscdscdsc', 'sdcdsdsvds', 'MKS1', '1', '2018-04-11 16:11:12');
INSERT INTO `uti_customer` VALUES ('19', 'lutfi', 'sddsdscdsc', 'sddsvdsvdsvds', 'Personal', 'sdcdscdsc', '12123123213', 'sdcdsdsvds', 'MKS1', '1', '2018-04-11 16:15:44');
INSERT INTO `uti_customer` VALUES ('20', 'lutfi', 'sddsdscdsc', 'sddsvdsvdsvds', 'Personal', 'sdcdscdsc', '0000000000000', 'sdcdsdsvds', 'MKS1', '1', '2018-04-12 13:34:26');
INSERT INTO `uti_customer` VALUES ('21', 'dbhhjbads', 'dskjvbdskjvbjkds', 'sdjvbsdvbsdjbvh', 'Personal', 'dskjbsdkjvbsjkdvb', 'sdvbsdjvbs', 'sdkvbsdhv', 'MKS1', '1', '2018-04-12 13:36:00');
INSERT INTO `uti_customer` VALUES ('22', 'Erwin', 'dddd@g.com', 'sdjvbsdvbsdjbvh', 'Personal', 'dskjbsdkjvbsjkdvb', 'sdvbsdjvbs', 'sdkvbsdhv', 'MKS1', '1', '2018-04-17 11:31:25');
SET FOREIGN_KEY_CHECKS=1;
