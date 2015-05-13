-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2015 at 07:47 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `tanggal`, `judul`, `status`, `foto`, `keterangan`, `status_approval_pm`, `status_approval_supervi`, `creator`, `siteId`, `type`) VALUES
(42, '2015-05-06', 'Bermain Bola', 'Start', '', '<p>Tak Ada yang Abadi</p>', NULL, NULL, '1234567', 33, NULL),
(43, '2015-05-06', 'Mengecor Galian', 'On Process', '', '<p>asasa</p>', NULL, NULL, '1234567', 33, NULL),
(44, '2015-05-08', 'Menggali Lobang', 'Start', '', '<p>Dodododo</p>', NULL, NULL, '1234567', 30, 9),
(45, '2015-05-05', 'Menggali Lobang', 'Start', 'narupi_by_edumander-d51cwpa.png', '<p>ada deh</p>', NULL, NULL, '1234567', 30, 11),
(46, '2015-05-12', 'asasasas', 'Start', '', '<p>asasas</p>', NULL, NULL, '1234567', 30, 12),
(47, '2015-05-08', 'baru2', 'Start', '', '<p>asasas</p>', NULL, NULL, '1234567', 30, NULL),
(49, '2015-05-12', 'Menggali Lobang', 'On Process', '', '<p>asasasas</p>', NULL, NULL, '1234567', 30, 12);

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
('1206208776', 'Fahmi Hidayat', 'L', '', 'admin', 'c93ccd78b2076528346216b3b2f701e6', '', 'Administrator', ''),
('120920', 'Administrator''s Name', 'L', 'fahmi@gmail.com', 'fahmi12', 'c93ccd78b2076528346216b3b2f701e6', 'Jl.Bungur', 'Administrator', '0861712881212'),
('121212', 'Ghaisani Kusumo', 'L', '', 'sp', '1b2753dfcb111675497b08509b09e5d2', '', 'Supervisor', ''),
('1212121', 'Mitra Surya', 'L', '', 'pm1', '48028e7eb3282307e3c20f1f3f79952a', '', 'Project Manager', ''),
('123', 'Inuyasha', 'L', 'kagome@inuyasha.com', 'inu', '005c6f6e8780ed95a83f0b8d195201dc', '', 'Coordinator', ''),
('1234567', 'Khoirunnida', 'L', '', 'tes', '0134a762b1c7d4acab4a766061b57093', '', 'Coordinator', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `barismilestone`
--

INSERT INTO `barismilestone` (`id`, `tanggal`, `kategoriId`, `siteId`) VALUES
(8, '2015-04-19', 5, 30),
(9, '2015-04-20', 2, 30),
(11, '2015-04-19', 7, 30),
(12, '2015-04-13', 1, 30);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(9, 'hihi');

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
(2, 'PT Telkom  x', '<p>JalanCengkeh</p>', 'telkom@y.com', '081219'),
(5, 'PT Indosat', 'Jalan Cengkeh', 'indosat@yahoo.com', '02187797884');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `creator` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creator` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `tanggal`, `judul`, `isi`, `creator`) VALUES
(1, '2015-05-11', 'Libur Cuti Bersama', '<p><strong>Semua kegiatan di liburkan coyyyy</strong></p>', '1206208776');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `projectteam`
--

INSERT INTO `projectteam` (`id`, `proyekId`, `nik`) VALUES
(1, 11, '120920'),
(2, 11, '123'),
(3, 11, '1212121'),
(4, 11, '121212'),
(5, 13, '121212');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id`, `nama`, `klienId`) VALUES
(11, 'Percobaan', 5),
(12, 'Pembangunan proyek Pembangunan', 5),
(13, 'halo', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `tanggal_mulai`, `siteID`, `nama`, `alamat`, `titik_nominal`, `status_kepemilikan`, `tipe_antena`, `keterangan`, `foto`, `status_kerja`, `proyek`) VALUES
(30, NULL, '', 'Rajawali 1', 'Jl.Rajawali 3 no.15', '', 'pemda', '', '', '', 'survey', 11),
(32, '2015-05-06', '', 'Rajawali 2', '', '', 'pemda', '', '', '', 'survey', 11),
(33, NULL, '', 'rajawali12345', '', '', 'pemda', '', '', '', 'survey', 11),
(34, NULL, '', 'asasas', '', '', 'pemda', '', '', '', '', 13);

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
