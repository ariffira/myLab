-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2015 at 07:34 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

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
-- Table structure for table `eprescription`
--

CREATE TABLE IF NOT EXISTS `eprescription` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `follow_up` varchar(100) NOT NULL,
  `trade_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `drug` varchar(255) NOT NULL,
  `atc_code` varchar(255) NOT NULL,
  `packsize` varchar(255) NOT NULL,
  `pzn` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `sickness` varchar(100) NOT NULL,
  `doc_comments` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `eprescription`
--

INSERT INTO `eprescription` (`id`, `follow_up`, `trade_name`, `drug`, `atc_code`, `packsize`, `pzn`, `manufacturer`, `comments`, `patient_id`, `status`, `delete_status`, `sickness`, `doc_comments`) VALUES
(65, 'yes', 'test201', 'asasas', '11', '11', '', '', '', 24, 0, 0, '0', ''),
(78, 'yes', 'testing400', 'sdsd', '', '', '', '', '', 24, 0, 0, '0', ''),
(79, 'yes', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(80, 'yes', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(81, 'yes', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(82, 'yes', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(83, 'no', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(84, 'yes', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(85, 'yes', 'testing400', 'sajsha', 'A10BF01', '', '', 'qwqw', 'qwqw', 24, 0, 0, '0', ''),
(86, 'yes', 'testing400', 'sasha', 'A10BF01', '', '', 'qwqw', 'qwqw', 24, 0, 0, '0', ''),
(87, 'yes', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(88, 'yes', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(89, 'no', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(90, 'no', 'asgasjkhg', 'asasa', '', '', '', '', '', 24, 0, 0, '0', ''),
(91, 'no', 'asgasjkhg', 'test', '', '', '', '', '', 24, 0, 0, '0', ''),
(92, 'yes', 'gsdsd', 'gdsdsgsdg', '', '', '', '', '', 24, 0, 0, '0', ''),
(93, 'yes', '', 'testing500', '', '', '', '', '', 24, 0, 0, '0', ''),
(94, 'yes', '', 'testing501', '', '', '', '', '', 24, 0, 0, '0', ''),
(95, 'no', 'testing400', 'sadad', 'adasd', 'adasd', '', 'adasd', '', 24, 0, 0, '0', ''),
(96, 'no', 'testing600', 'sadad', 'adasd', 'adasd', '', 'adasd', '', 24, 3, 0, '0', ''),
(97, 'yes', 'testing600', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(98, 'yes', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(100, 'yes', 'testing700', 'sfahsf', 'asas', 'asas', '', '', '', 24, 0, 0, '0', ''),
(101, 'yes', 'testing700', 'sfahsf', 'asas', 'asas', '', '', '', 24, 2, 0, '0', '0'),
(102, 'no', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(103, 'no', '', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(104, 'yes', 'arif', '', '', '', '', '', '', 24, 0, 0, '0', ''),
(105, 'yes', 'Angela', 'markel', 'dd', '1001', '', 'markel pharma', 'tttt', 24, 2, 0, '0', '0'),
(106, 'yes', '', '', '', '', '', '', '', 24, 0, 0, 'allergie', ''),
(107, 'no', 'Gripoflexzou', 'Acamprosat', 'N07BB03', '20', '', 'hexal', '', 24, 1, 0, 'allergie', ''),
(108, 'yes', 'Loratadin', 'Cetirizin', 'R06AE07', '2', '', 'Hexal', '', 24, 2, 0, '', '0'),
(109, 'no', 'Atorvastatin', 'Atorvastatin', 'C10AA05', '20', '', '', '', 24, 1, 0, '', ''),
(110, 'no', 'Atorvastatin', 'Hidrosmin', 'C05CA05', '', '', '', '', 24, 1, 0, '', ''),
(111, 'no', 'Lorano', '', '', '', '', '', '', 24, 2, 0, '', '0'),
(112, 'no', 'Lorano', '', '', '', '', '', '', 24, 2, 0, 'allergie', '0'),
(113, 'no', 'Lorano', '', '', '', '', '', '', 24, 0, 0, 'allergie', ''),
(114, 'no', 'Metoprolol', '', '', '', '', '', '', 24, 0, 0, 'blutdruck', ''),
(115, 'no', 'Lorano', '', '', '', '', '', '', 24, 0, 0, 'allergie', ''),
(116, 'no', 'Lorano', '', '', '', '', '', '', 24, 0, 0, 'allergie', ''),
(117, 'no', 'Atorvastatin', 'Chinin, Kombinationen', 'C05AF51', '10', '', 'hexal', 'Im moment keine', 24, 0, 0, 'cholesterins', ''),
(118, 'no', 'Bisoprolol', 'Bisacodyl', 'A06AG02', '10', '', 'dgadgf', 'kein moment', 24, 0, 0, 'blutdruck', ''),
(119, 'no', 'Metoprolol', '', '', '', '', '', '', 24, 0, 0, 'blutdruck', ''),
(120, 'no', '0', '', '', '', '', '', '', 24, 0, 0, 'allergie', ''),
(121, 'no', '0', '', '', '', '', '', '', 24, 0, 0, 'allergie', ''),
(122, 'no', '0', '', '', '', '', '', '', 24, 0, 0, 'allergie', ''),
(123, 'no', '0', '', '', '', '', '', '', 24, 0, 0, 'cholesterins', ''),
(124, 'no', '0', '', '', '', '', '', '', 24, 0, 0, 'cholesterins', ''),
(125, 'no', '0', '', '', '10', '', 'hexal', '', 24, 0, 0, 'blutdruck', ''),
(126, 'no', '0', 'Loratadin', '', '10', '', 'Hexal', '', 24, 0, 0, 'allergie', ''),
(127, 'yes', '0', 'Loratadin', '', '1', '', 'hexal', '', 24, 0, 0, 'allergie', ''),
(128, 'yes', '0', 'Aerius', '', '', '', '', '', 24, 0, 0, 'allergie', ''),
(129, 'no', '0', 'Zyrtec', '', '', '', '', '', 24, 0, 0, 'allergie', ''),
(130, 'no', '0', 'Zyrtec', '', '', '', '', '', 24, 2, 0, 'allergie', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
