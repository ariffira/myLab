-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2015 at 01:43 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ihrarzt24_medical`
--

-- --------------------------------------------------------

--
-- Table structure for table `epres_medicine`
--

CREATE TABLE IF NOT EXISTS `epres_medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `sickness` varchar(255) NOT NULL,
  `medicine` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `epres_medicine`
--

INSERT INTO `epres_medicine` (`id`, `code`, `sickness`, `medicine`) VALUES
(1, 'bp', 'Bluthochdruck', 'Metoprolol'),
(2, 'bp', 'Bluthochdruck', 'Captoprill'),
(3, 'bp', 'Bluthochdruck', 'Enalaprin'),
(4, 'bp', 'Bluthochdruck', 'Lisinopril'),
(5, 'ch', 'Erhöhtes Cholestorins', 'Simvastatin'),
(6, 'ch', 'Erhöhtes Cholestorins', 'Atorvastatin'),
(7, 'al', 'Allergien', 'Lorano'),
(8, 'al', 'Allergien', 'Aerius'),
(9, 'al', 'Allergien', 'Zyrtec'),
(10, 'al', 'Allergien', 'Loratadin'),
(12, 'al', 'Allergien', 'Cetirizin'),
(14, 'bp', 'Bluthochdruck', 'Bisoprolol'),
(15, 'bp', 'Bluthochdruck', 'Candesartan'),
(16, 'bp', 'Bluthochdruck', 'Losartan'),
(17, 'bp', 'Bluthochdruck', 'Valsartan'),
(18, 'bp', 'Bluthochdruck', 'Telmisartan'),
(19, 'bp', 'Bluthochdruck', 'Olmesartan'),
(20, 'bp', 'Bluthochdruck', 'Amlodipil'),
(21, 'bp', 'Bluthochdruck', 'Fosinopril'),
(22, 'bp', 'Bluthochdruck', 'Lercanidipin'),
(23, 'ch', 'Erhöhtes Cholestorins', 'Pravastatin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
