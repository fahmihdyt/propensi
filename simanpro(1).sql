-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2015 at 01:39 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simanpro`
--
CREATE DATABASE IF NOT EXISTS `simanpro` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `simanpro`;

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE IF NOT EXISTS `aktivitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `judul` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `status_approval_pm` tinyint(1) DEFAULT NULL,
  `status_approval_supervi` tinyint(1) DEFAULT NULL,
  `creator` varchar(12) DEFAULT NULL,
  `siteId` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creator` (`creator`),
  KEY `siteId` (`siteId`),
  KEY `deadline` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `tanggal`, `judul`, `status`, `foto`, `keterangan`, `status_approval_pm`, `status_approval_supervi`, `creator`, `siteId`, `type`) VALUES
(7, '2015-02-02', 'menggali', 'Start', '', '<p>asasasas</p><p>\r\n		 	<strong>Approval Notes:<br></strong>\r\n		 	20/05/2015 - Voldemort :\r\n		 	<br >\r\n		  </p>', NULL, 1, '123', 35, 13);

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas2`
--

CREATE TABLE IF NOT EXISTS `aktivitas2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `status_approval_pm` varchar(10) DEFAULT NULL,
  `status_approval_supervi` varchar(10) DEFAULT NULL,
  `creator` varchar(12) DEFAULT NULL,
  `siteId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `aktivitas2`
--

INSERT INTO `aktivitas2` (`id`, `tanggal`, `judul`, `status`, `foto`, `keterangan`, `status_approval_pm`, `status_approval_supervi`, `creator`, `siteId`) VALUES
(1, NULL, 'asas', 'sadsad', '', '<p>sdsad</p>', NULL, NULL, NULL, NULL),
(2, NULL, 'cece', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE IF NOT EXISTS `akun` (
  `nik` varchar(15) NOT NULL DEFAULT '',
  `nama` varchar(30) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `jabatan` varchar(30) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`nik`),
  KEY `jabatan` (`jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`nik`, `nama`, `gender`, `email`, `username`, `password`, `alamat`, `jabatan`, `no_telp`) VALUES
('0867121', 'Fahmi Hidayat', 'L', 'fahmi.hidayat@gmail.com', 'fahmi', '41851c2c39e9729d51870dc74e098950', '', 'Administrator', ''),
('1206208776', 'Harry James Potter', 'L', '', 'admin', 'c93ccd78b2076528346216b3b2f701e6', '', 'Administrator', ''),
('121212', 'Voldemort', 'L', '', 'sp', '1b2753dfcb111675497b08509b09e5d2', '', 'Supervisor', ''),
('1212121', 'Hermione Granger', 'P', '', 'pm1', '48028e7eb3282307e3c20f1f3f79952a', '', 'Project Manager', ''),
('123', 'Ronald Billius Weasley', 'L', 'ronald@hogwarts.com', 'coor', 'b5190e427c466e6c90e167d5471c8044', '', 'Coordinator', '');

-- --------------------------------------------------------

--
-- Table structure for table `barismilestone`
--

CREATE TABLE IF NOT EXISTS `barismilestone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `kategoriId` int(11) DEFAULT NULL,
  `siteId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategoriId` (`kategoriId`),
  KEY `siteId` (`siteId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `barismilestone`
--

INSERT INTO `barismilestone` (`id`, `tanggal`, `kategoriId`, `siteId`) VALUES
(13, '2015-05-21', 2, 35),
(14, '2015-05-20', 1, 34);

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `judul` varchar(100) NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `status` varchar(30) DEFAULT NULL,
  `creator` varchar(12) DEFAULT NULL,
  `siteId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creator` (`creator`),
  KEY `siteId` (`siteId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`) VALUES
(2, 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Menggali'),
(2, 'Pembangunan'),
(3, 'Cor'),
(4, 'sss'),
(5, 'Survey'),
(6, 'haha'),
(7, 'Penggalian'),
(8, 'haha'),
(9, 'hihi'),
(10, 'menggali');

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE IF NOT EXISTS `klien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` text,
  `email` varchar(50) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `klien`
--

INSERT INTO `klien` (`id`, `nama`, `alamat`, `email`, `no_telp`) VALUES
(2, 'Durmstrang Institute', '<p>JalanCengkeh</p>', 'office@durmstrang.com', '081219'),
(5, 'Beauxbaton Academy of Magic', 'Jalan Cengkeh', 'office@beauxbaton.com', '02187797884');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `creator` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creator` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `tanggal`, `judul`, `isi`, `creator`) VALUES
(1, '2015-05-11 07:00:00', 'Libur Cuti Bersama', '<p><strong>Semua kegiatan di liburkan coyyyy</strong></p>', '1206208776'),
(2, '2015-05-14 07:00:00', 'SOP Humas', '<p style="text-align: center;"><strong>SOP PUBLIKASI HUMAS</strong></p>\r\n<p style="text-align: left; padding-left: 30px;"><strong>SOP REQUEST PUBLIKASI HUMAS</strong></p>\r\n<ol>\r\n<li><strong>Semua permintaan publikasi melalui fuki.cs.ui.ac.id/siput</strong></li>\r\n<li><strong>Semua poster/konten media lainnya harus lulus uji mutu publikasi oleh media</strong></li>\r\n<li><strong>Semua konten media akan diambil secara langsung dari request publikasi media pada sistem ini</strong></li>\r\n</ol>\r\n<p style="text-align: left; padding-left: 30px;"><strong>Publikasi Twitter</strong></p>\r\n<ol>\r\n<li><strong>Submit draft tweet yang siap dipublish maksimal H-2 jadwal tweet</strong></li>\r\n<li><strong>Follow up tweetnya, remind dan pantau untuk memastikan tidak ada kesalahan</strong></li>\r\n<li><strong>Apabila ingin meminta pembuatan draft maksimal H-3 sebelum jadwal tweet dengan memberikan content yang jelas</strong></li>\r\n</ol>\r\n<p style="padding-left: 30px;"><strong>Publikasi Fanpage Facebook</strong></p>\r\n<ol>\r\n<li><strong>Apabila ada booming, selalu mengingatkan humas untuk menyebarkan di fanpage</strong></li>\r\n<li><strong>Contentnya bebas dan apabila ingin dibuatkan maksimal H-3 sebelum waktu publikasi</strong></li>\r\n<li><strong>Follow Up humas, remind dan pantau untuk memastikan tidak ada kesalahan publikasi</strong></li>\r\n</ol>\r\n<p style="padding-left: 30px;"><strong>Scele</strong></p>\r\n<ol>\r\n<li><strong>Selalu menyertakan header [FUKI 2015] untuk subject thread, dan sertakan judulnya, contoh [FUKI 2015] Kalam Akbar</strong></li>\r\n<li><strong>Humas yang akan post di scele, dan pemilik acara akan diberikan izin untuk langsung post di scele pada kasus tertentu dan atas perizinan humas</strong></li>\r\n<li><strong>Follow up humas dan threadnya, remind dan pantau karena waktu pengeditan hanya 30 menit</strong></li>\r\n</ol>\r\n<p style="padding-left: 30px;"><strong>"SEGALA HAL YANG BERHUBUNGAN DENGAN REQUEST PUBLIKASI HUMAS HARUS MELALUI <em>fuki.cs.ui.ac.id/siput</em>"</strong></p>\r\n<p style="padding-left: 30px;"><strong>Apabila ada pertanyaan lebih lanjut silahkan menghubungi:<br />Azelea : 0896-5131-4249<br />Aulia : 0838-7148-5515</strong></p>', '1206208776');

-- --------------------------------------------------------

--
-- Table structure for table `picklien`
--

CREATE TABLE IF NOT EXISTS `picklien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `klienId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `klienId` (`klienId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projectteam`
--

CREATE TABLE IF NOT EXISTS `projectteam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyekId` int(11) DEFAULT NULL,
  `nik` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proyekId` (`proyekId`),
  KEY `nik` (`nik`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `projectteam`
--

INSERT INTO `projectteam` (`id`, `proyekId`, `nik`) VALUES
(5, 13, '121212'),
(6, 16, '123');

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE IF NOT EXISTS `proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `klienId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proyek_ibfk_1` (`klienId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id`, `nama`, `klienId`) VALUES
(12, 'Pembangunan tower sekolah', 5),
(13, 'Pembangunan lorong bawah tanah', 2),
(15, 'Pembangunan Tower Sinyal', 5),
(16, 'Baru 1', 2),
(17, 'Baru 2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_mulai` date DEFAULT NULL,
  `siteID` varchar(30) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `titik_nominal` varchar(10) DEFAULT NULL,
  `status_kepemilikan` varchar(50) DEFAULT NULL,
  `tipe_antena` varchar(20) DEFAULT NULL,
  `keterangan` text,
  `foto` varchar(200) DEFAULT NULL,
  `status_kerja` varchar(100) DEFAULT NULL,
  `proyek` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_ibfk_1` (`proyek`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `tanggal_mulai`, `siteID`, `nama`, `alamat`, `titik_nominal`, `status_kepemilikan`, `tipe_antena`, `keterangan`, `foto`, `status_kerja`, `proyek`) VALUES
(34, NULL, '', 'asasas', '', '', 'pemda', '', '', '', '', 13),
(35, '2015-05-17', '', 'Site Baru', '', '', '', '', '', '', '', 16);

-- --------------------------------------------------------

--
-- Table structure for table `titikkandidat`
--

CREATE TABLE IF NOT EXISTS `titikkandidat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titik_kandidat` varchar(10) NOT NULL,
  `siteId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `siteId` (`siteId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD CONSTRAINT `aktivitas_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `akun` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aktivitas_ibfk_2` FOREIGN KEY (`siteId`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aktivitas_ibfk_3` FOREIGN KEY (`type`) REFERENCES `barismilestone` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `barismilestone`
--
ALTER TABLE `barismilestone`
  ADD CONSTRAINT `barismilestone_ibfk_1` FOREIGN KEY (`kategoriId`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barismilestone_ibfk_2` FOREIGN KEY (`siteId`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issue`
--
ALTER TABLE `issue`
  ADD CONSTRAINT `issue_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `akun` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_ibfk_2` FOREIGN KEY (`siteId`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `akun` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `picklien`
--
ALTER TABLE `picklien`
  ADD CONSTRAINT `picklien_ibfk_1` FOREIGN KEY (`klienId`) REFERENCES `klien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projectteam`
--
ALTER TABLE `projectteam`
  ADD CONSTRAINT `projectteam_ibfk_1` FOREIGN KEY (`proyekId`) REFERENCES `proyek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projectteam_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `akun` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proyek`
--
ALTER TABLE `proyek`
  ADD CONSTRAINT `proyek_ibfk_1` FOREIGN KEY (`klienId`) REFERENCES `klien` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_ibfk_1` FOREIGN KEY (`proyek`) REFERENCES `proyek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `titikkandidat`
--
ALTER TABLE `titikkandidat`
  ADD CONSTRAINT `titikkandidat_ibfk_1` FOREIGN KEY (`siteId`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
