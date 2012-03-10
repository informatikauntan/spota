-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2012 at 11:28 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spota`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatter`
--

CREATE TABLE `chatter` (
  `id_chat` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(32) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `chitchat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_chat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=351 ;

--
-- Dumping data for table `chatter`
--


-- --------------------------------------------------------

--
-- Table structure for table `data_dosen`
--

CREATE TABLE `data_dosen` (
  `NIP` int(9) NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`NIP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_dosen`
--

INSERT INTO `data_dosen` VALUES(132326600, 'NOVI SAFRIADI, ST, MT', 'bangnops@gmail.com');
INSERT INTO `data_dosen` VALUES(132205637, 'ARIF B. PUTRA N., ST, MT', 'arif_putra@yahoo.com');
INSERT INTO `data_dosen` VALUES(132162449, 'HERRY SUJAINI, ST, MT', 'herri_sujaini@yahoo.com');
INSERT INTO `data_dosen` VALUES(132326577, 'EVA FAJA R., S.Kom, MMSI', 'eva_faja@yahoo.com');
INSERT INTO `data_dosen` VALUES(132303791, 'YUS SHOLVA, ST, MT', 'kb3845an@yahoo.com');
INSERT INTO `data_dosen` VALUES(132303795, 'HERI PRIYANTO, ST, MT', '');
INSERT INTO `data_dosen` VALUES(132326578, 'YULIANTI, S.Kom, MMSI', '');
INSERT INTO `data_dosen` VALUES(132229731, 'M. SOFITRA, ST, MT', '');
INSERT INTO `data_dosen` VALUES(130520057, 'IR. EDDY SURYANTO, M.ENGSC', '');
INSERT INTO `data_dosen` VALUES(132206455, 'HELFI NASUTION, S.Kom, MCs.', '');
INSERT INTO `data_dosen` VALUES(132302425, 'TURSINA, ST', '');
INSERT INTO `data_dosen` VALUES(132307991, 'RUDY DWI NYOTO, ST, M.Eng.', '');
INSERT INTO `data_dosen` VALUES(132229730, 'H.HENGKY ANRA, ST, M.Kom', '');
INSERT INTO `data_dosen` VALUES(19850606, 'M. AZHAR IRWANSYAH, ST, M.ENG', 'azhar03@mti.ugm.ac.id');

-- --------------------------------------------------------

--
-- Table structure for table `data_mahasiswa`
--

CREATE TABLE `data_mahasiswa` (
  `NIM` varchar(9) NOT NULL,
  `nama_mhs` varchar(255) NOT NULL,
  `angkatan` char(2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status_upload` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`NIM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_mahasiswa`
--

INSERT INTO `data_mahasiswa` VALUES('D03104051', 'RUDY TANDRA', '04', 'nikolaidiez@yahoo.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D01199429', 'SISWOYO', '99', 'siswoyoprayogi@gmail.com', '0');
INSERT INTO `data_mahasiswa` VALUES('D03104002', 'ARIE ADITYA WIBOWO', '04', 'ari_aditya@yahoo.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03104005', 'G. AYU WULANDARI', '04', 'ayuayu@yahoo.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03104052', 'FINA APRIANI', '04', 'finfin@yahoo.com', '0');
INSERT INTO `data_mahasiswa` VALUES('D03104030', 'YOSEP ADITYA PRAWIGA', '04', 'yosep@yahoo.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03106006', 'INDRA AZIMI', '06', 'indraazimi@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03104071', 'M. MUDRIKA BAFADAL', '04', 'mud2.newbieIT@gmail.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03104047', 'MERY LISTIANA', '04', 'meyaziela@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105040', 'FITZASTRI AL-RASSI', '05', 'greatz_poltergeist@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105020', 'URAY IRVAN PRASETYA', '05', 'urayirvan@gmail.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03104073', 'M. SONY MAULANA', '04', 'sylver_campus@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03104046', 'DWIJA SAPTAHADI', '04', 'djdwija@gmail.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106018', 'DOCHI RAMADHANI', '06', 'dochiramadhani@gmail.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106024', 'PRATIWI OKTAVIANI', '06', 'qhiun_qhiun88@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105022', 'DIDIK SUPARDI', '05', 'edogawa_conan_07@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106034', 'RINA SEPTIRIANA', '06', 'rinze_deacon@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106041', 'IRNI IRMAYANI', '06', 'd2_dbez@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106021', 'NAUFA FATHIA', '06', 'sieben_vier@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105013', 'KRISANDY PONTI', '05', 'krisandy_00@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106007', 'DEDI HANDOKO', '06', 'live_on_deddy@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106013', 'YUNITA', '06', 'unie_syalala@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106027', 'AGUS RIYANTO', '06', 'spansa08@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105014', 'AAAA', '05', 'aa_12@yahoo.com', '0');
INSERT INTO `data_mahasiswa` VALUES('D03105041', 'LILY AMALIA', '05', 'strow_2108@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105005', 'ADI UTAMA', '05', 'co_arcadia@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106029', 'M. TRIYANDA TARUNA JAYA', '06', 'taruna.jaya@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106037', 'SYARIFAH PUTRI AGUSTINI', '06', 'princezz.pochie@gmail.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106023', 'FEBRIANAWATI', '06', 'febriiiiiiiii@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03103043', 'FIRMAN SYAHPUTRA', '03', 'mamane314@gmail.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03104006', 'VENNY ARIANDASARI YANIMINATI', '04', 'd2vy_honey@yahoo.com', '0');
INSERT INTO `data_mahasiswa` VALUES('D03104013', 'TEGUH YUNANTO', '04', 'teguh_blacktea@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106039', 'VIORITA ZULVIANTI', '06', 'vio_madden@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106026', 'RYAN PERMANA', '06', 'sq034ll@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105026', 'DENNY SETIADI', '05', 'endo.kenji@ymail.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03104032', 'NOVIANTO ASYNUZAR', '04', 'razun_86@yahoo.co.id', '0');
INSERT INTO `data_mahasiswa` VALUES('D03105042', 'FIRMAN KURNIAWAN', '05', 'rukrif@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105019', 'ALDILAH RAHMAWATI', '05', 'yuya_mungil@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105012', 'NOVIANI MAYASARI', '05', 'novi_5w33t@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105043', 'ADEN ABDI ADOW', '05', 'aadan21@gmail.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106008', 'M. ANDILLA ADITYA NOVARIANDI', '06', 'siriandi2@gmail.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106017', 'YENI MARIANI', '06', 'yenimariani@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106002', 'RIJA SUNANTRI', '06', 'blue_eyes_daneron@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106009', 'YUNI LESTARI', '06', 'un_enza@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106025', 'SYAHRIANI F. SIREGAR', '06', 'buteto@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03103063', 'RANDHIE AKBAR MULA PUTRA', '03', 'randhie.akbar@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03104072', 'RINI CAROLINA BAKARA', '04', 'rini3119@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106014', 'ENDA ESYUDHA PRATAMA', '06', 'enda@student.untan.ac.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03103003', 'WENDY ALFRED S', '03', 'justwendhie@gmail.com', '0');
INSERT INTO `data_mahasiswa` VALUES('D03106028', 'RIMA FRIYANI', '06', 'riefrezti@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03104027', 'MUHTADIN SABHAN', '04', 'muhtadin_sabhan@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106030', 'GALIH PRADIPTA', '06', 'gp_angga@yahoo.co.id', '1');
INSERT INTO `data_mahasiswa` VALUES('D03104031', 'MUSRIADI', '04', 'moes85@gmail.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03107011', 'RINDITA DESTRIYANTI', '07', 'sweety_destha@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03107032', 'ANGGI PERWITASARI', '07', 'anggi_monkey@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106016', 'RANDI ARIEFIANTO', '06', 'vans_randi@yahoo.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03107022', 'EKO SUGIONO', '07', 'eckohehe@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03107005', 'CHARLES DARWIS H', '07', 'hayashi_i_sama@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03107007', 'RADIAN AZIMI', '07', 'arsponti@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105004', 'HARANI', '05', 'jay_vh3gh4@yahoo.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03107021', 'TARI MARDIANA', '07', 'cew_band@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03105030', 'FRANKI TELLO PANJAITAN', '05', 'frankitello@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03107008', 'NARTI PRIHARTINI', '07', 'nhawaraluvgreen@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03107013', 'HENDRO', '07', 'hendro.informatika@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03107006', 'KRISTA RANITA HUTABARAT', '07', 'crackriz_htbrt@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03107043', 'TATUM TRISTY MONALISA', '07', 'lily_andorz@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106046', 'DESSY ANGGELA', '06', 'anggela_detaka@yahoo.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03107018', 'SANTRI SAMANHUDI', '07', 'santrie_samanhudi@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03107009', 'NESSA PUTRI ANDAYU', '07', 'nessaputri@yahoo.co.id', '2');
INSERT INTO `data_mahasiswa` VALUES('D03106012', 'RINNE DWI ZORAYA', '06', 'zoraya_88@yahoo.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03107034', 'RIZQIA LESTIKA ATIMI', '07', 'luchuwquyangluchuw@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03107036', 'RINO SETIAWAN', '07', 'rino_ndud90@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03103058', 'SUPARMANTO', '03', 'marianussuparmanto@yahoo.com', '2');
INSERT INTO `data_mahasiswa` VALUES('D03107025', 'M. MUNDZIR WIJDANI', '07', 'wm.mundzir@yahoo.com', '0');
INSERT INTO `data_mahasiswa` VALUES('D03106038', 'MEISYA FITRI', '06', 'meisyathedream@gmail.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03105039', 'M. FARISI GUSTIAR', '05', 'mfarisig@gmail.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03105033', 'MARIA NOVENA RS', '05', 'marianovena@rocketmail.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03107031', 'JURISTA PURNAMA JUMRI', '07', 'jurista_meong@yahoo.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03107030', 'HENDY PONIMAN', '07', 'chendymail@aol.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03107004', 'ROMI YUNIARDI', '07', 'yuniardiromi@yahoo.com', '1');
INSERT INTO `data_mahasiswa` VALUES('D03107010', 'ENDAH WULANSARI', '07', 'endwulan10@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `kotak_pesan`
--

CREATE TABLE `kotak_pesan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `saran` text NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kotak_pesan`
--

INSERT INTO `kotak_pesan` VALUES(3, 'Arifian Sulthana', 'pian_sulthana@yahoo.co.id', 'Alhamdulillah.. Spota Informatika Untan sudah bisa diakses kembali melalui website..\r\nSaran saya sebagai alumni :\r\n1. Kalo bisa dirawat baik2 sistem ini, jangan sampai skripsi mahasiswa terkendala karena berbagai macam alasan baik teknis maupun alasan lain nya. Jika perlu adakan penambahan fitur dan fasilitas pendukung lain nya, perbaikan terhadap kekurangan sistem dan evaluasi sistem secara berkala.\r\n2. Tolong sediakan ruang bagi alumni agar dapat melakukan interaksi dengan segenap Civitas Akademika Teknik Informatika.', '2010-03-29', '20:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `log_admin`
--

CREATE TABLE `log_admin` (
  `user_name` varchar(50) NOT NULL,
  `pwadmin` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_admin`
--

INSERT INTO `log_admin` VALUES('spota', 'f52e2cfffa707390de2175f94098fe7d');

-- --------------------------------------------------------

--
-- Table structure for table `log_dos`
--

CREATE TABLE `log_dos` (
  `no` int(2) NOT NULL AUTO_INCREMENT,
  `NIP` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `pwdosen` varchar(255) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `log_dos`
--

INSERT INTO `log_dos` VALUES(1, '132326600', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(2, '132205637', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(3, '132162449', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(4, '132326577', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(5, '132303791', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(13, '132229730', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(12, '132307991', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(11, '132302425', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(10, '132206455', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(9, '130520057', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(8, '132229731', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(7, '132326578', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(6, '132303795', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_dos` VALUES(14, '19850606', 'spota', 'f52e2cfffa707390de2175f94098fe7d');

-- --------------------------------------------------------

--
-- Table structure for table `log_kaprodi`
--

CREATE TABLE `log_kaprodi` (
  `kaprodi_name` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `pwkaprodi` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_kaprodi`
--

INSERT INTO `log_kaprodi` VALUES('kaprodi', 'spota', 'f52e2cfffa707390de2175f94098fe7d');

-- --------------------------------------------------------

--
-- Table structure for table `log_mhs`
--

CREATE TABLE `log_mhs` (
  `no` int(2) NOT NULL AUTO_INCREMENT,
  `NIM` varchar(9) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `pwmhs` varchar(255) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `log_mhs`
--

INSERT INTO `log_mhs` VALUES(1, 'D03104051', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(2, 'D01199429', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(3, 'D03104002', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(4, 'D03104005', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(5, 'D03104052', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(6, 'D03104030', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(7, 'D03106006', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(8, 'D03104071', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(9, 'D03104047', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(10, 'D03105040', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(11, 'D03105020', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(12, 'D03104073', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(13, 'D03104046', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(14, 'D03106018', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(15, 'D03106024', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(16, 'D03105022', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(17, 'D03106034', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(18, 'D03106041', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(19, 'D03106021', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(20, 'D03105013', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(21, 'D03106007', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(22, 'D03106013', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(23, 'D03106027', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(24, 'D03105014', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(25, 'D03105041', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(26, 'D03105005', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(27, 'D03106029', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(28, 'D03106037', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(29, 'D03106023', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(30, 'D03103043', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(31, 'D03104006', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(32, 'D03104013', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(33, 'D03106039', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(34, 'D03106026', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(35, 'D03105026', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(36, 'D03104032', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(37, 'D03105042', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(38, 'D03105019', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(39, 'D03105012', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(40, 'D03105043', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(41, 'D03106008', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(42, 'D03106017', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(43, 'D03106002', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(44, 'D03106009', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(45, 'D03106025', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(46, 'D03103063', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(47, 'D03104072', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(48, 'D03106014', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(50, 'D03103003', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(51, 'D03106028', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(52, 'D03104027', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(53, 'D03106030', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(54, 'D03104031', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(55, 'D03107011', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(56, 'D03107032', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(57, 'D03106016', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(58, 'D03107022', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(59, 'D03107005', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(60, 'D03107007', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(61, 'D03105004', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(62, 'D03107021', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(63, 'D03105030', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(64, 'D03107008', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(65, 'D03107013', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(66, 'D03107006', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(67, 'D03107043', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(68, 'D03106046', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(69, 'D03107018', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(70, 'D03107009', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(71, 'D03106012', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(72, 'D03107034', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(73, 'D03107036', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(74, 'D03103058', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(75, 'D03107025', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(76, 'D03106038', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(77, 'D03105039', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(78, 'D03105033', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(79, 'D03107031', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(80, 'D03107030', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(81, 'D03107004', 'spota', 'f52e2cfffa707390de2175f94098fe7d');
INSERT INTO `log_mhs` VALUES(82, 'D03107010', 'spota', 'f52e2cfffa707390de2175f94098fe7d');

-- --------------------------------------------------------

--
-- Table structure for table `online_user`
--

CREATE TABLE `online_user` (
  `id` varchar(15) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `tm` datetime NOT NULL,
  `sta` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `pesan_pribadi_mini`
--

CREATE TABLE `pesan_pribadi_mini` (
  `id_pesan` int(11) NOT NULL AUTO_INCREMENT,
  `pengirim` varchar(20) NOT NULL,
  `penerima` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `pesan` text NOT NULL,
  `status_pesan` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pesan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pesan_pribadi_mini`
--


-- --------------------------------------------------------

--
-- Table structure for table `rekap`
--

CREATE TABLE `rekap` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_judul` int(11) NOT NULL,
  `NIM` varchar(9) NOT NULL,
  `kep_akhir` char(1) NOT NULL,
  `judul_out` varchar(255) NOT NULL,
  `pemb1` varchar(9) NOT NULL,
  `pemb2` varchar(9) NOT NULL,
  `peng1` varchar(9) NOT NULL,
  `peng2` varchar(9) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `semester` varchar(5) NOT NULL,
  `tahun_aj` varchar(9) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rekap`
--


-- --------------------------------------------------------

--
-- Table structure for table `reply_review`
--

CREATE TABLE `reply_review` (
  `id_reply` int(11) NOT NULL AUTO_INCREMENT,
  `id_rev` int(11) NOT NULL,
  `reply_name` varchar(9) NOT NULL,
  `reply_text` text NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  PRIMARY KEY (`id_reply`,`id_rev`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `reply_review`
--


-- --------------------------------------------------------

--
-- Table structure for table `review_mhs`
--

CREATE TABLE `review_mhs` (
  `id_rev_mhs` int(11) NOT NULL AUTO_INCREMENT,
  `id_judul` varchar(9) NOT NULL,
  `NIM` varchar(9) NOT NULL,
  `review` text NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_rev_mhs`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `review_mhs`
--


-- --------------------------------------------------------

--
-- Table structure for table `review_praoutline`
--

CREATE TABLE `review_praoutline` (
  `id_review` int(11) NOT NULL AUTO_INCREMENT,
  `id_upload` int(11) NOT NULL,
  `reviewer` varchar(9) NOT NULL,
  `review_text` text NOT NULL,
  `review_sound` varchar(255) NOT NULL,
  `jenis_rev` char(1) NOT NULL,
  `hasil` char(1) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  PRIMARY KEY (`id_review`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `review_praoutline`
--


-- --------------------------------------------------------

--
-- Table structure for table `tahun_ang`
--

CREATE TABLE `tahun_ang` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `ang` varchar(9) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tahun_ang`
--

INSERT INTO `tahun_ang` VALUES(1, '2004/2005');
INSERT INTO `tahun_ang` VALUES(2, '2005/2006');
INSERT INTO `tahun_ang` VALUES(3, '2006/2007');
INSERT INTO `tahun_ang` VALUES(4, '2007/2008');
INSERT INTO `tahun_ang` VALUES(5, '2008/2009');
INSERT INTO `tahun_ang` VALUES(6, '2009/2010');
INSERT INTO `tahun_ang` VALUES(7, '2010/2011');
INSERT INTO `tahun_ang` VALUES(8, '2011/2012');
INSERT INTO `tahun_ang` VALUES(9, '2012/2013');
INSERT INTO `tahun_ang` VALUES(10, '2013/2014');

-- --------------------------------------------------------

--
-- Table structure for table `uploadbak`
--

CREATE TABLE `uploadbak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NIM` varchar(9) NOT NULL,
  `judul_praoutline` varchar(255) NOT NULL,
  `berkas` varchar(255) NOT NULL,
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `waktu` time NOT NULL,
  `status_review` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `uploadbak`
--


-- --------------------------------------------------------

--
-- Table structure for table `upload_mhs`
--

CREATE TABLE `upload_mhs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NIM` varchar(9) NOT NULL,
  `judul_praoutline` varchar(255) NOT NULL,
  `berkas` varchar(255) NOT NULL,
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `waktu` time NOT NULL,
  `status_review` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `upload_mhs`
--

