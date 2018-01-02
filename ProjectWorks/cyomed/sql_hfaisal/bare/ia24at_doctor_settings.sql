-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2015 at 05:18 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prelaunch_ihrarzt24`
--

-- --------------------------------------------------------

--
-- Table structure for table `ia24at_doctor_settings`
--

CREATE TABLE IF NOT EXISTS `ia24at_doctor_settings` (
  `doctor_id` bigint(20) unsigned NOT NULL,
  `working_days` tinyint(3) unsigned NOT NULL,
  `working_hours_start` varchar(100) NOT NULL,
  `working_hours_end` varchar(100) NOT NULL,
  `calendar_cell` int(10) unsigned NOT NULL,
  `termin_default_length` int(10) unsigned NOT NULL,
  `regular_termin_on` tinyint(3) unsigned NOT NULL,
  `lunch_start` time NOT NULL,
  `lunch_end` time NOT NULL,
  `private_hours_start` varchar(100) NOT NULL,
  `private_hours_end` varchar(100) NOT NULL,
  PRIMARY KEY (`doctor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ia24at_doctor_settings`
--

INSERT INTO `ia24at_doctor_settings` (`doctor_id`, `working_days`, `working_hours_start`, `working_hours_end`, `calendar_cell`, `termin_default_length`, `regular_termin_on`, `lunch_start`, `lunch_end`, `private_hours_start`, `private_hours_end`) VALUES
(1, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 30, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(2, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 1, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(3, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(5, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(6, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(7, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(8, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 30, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(9, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(10, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(11, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(12, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(13, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(14, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(15, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(16, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(17, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(18, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(19, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(20, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(21, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(22, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(23, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(24, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(25, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(26, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(27, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(28, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(29, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(33, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(34, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(35, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(36, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(37, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(38, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(57, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(55, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(48, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(56, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(58, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(59, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(60, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(61, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(62, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(63, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(64, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(65, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(66, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(4, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(30, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(31, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(32, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(39, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(40, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(41, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(42, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(43, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(44, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(45, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(46, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(47, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(67, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(49, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(68, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(69, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(70, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(71, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(73, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(74, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(75, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(76, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(77, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(78, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(79, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(80, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(81, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(82, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(83, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(84, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(85, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(86, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(87, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(88, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(89, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(90, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(91, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(92, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(93, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(97, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(96, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(100, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(101, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(105, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(108, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 1, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(109, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(110, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(104, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(111, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(112, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(107, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(115, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(116, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(125, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(120, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(119, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(124, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(127, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(128, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(126, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(103, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(130, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00'),
(134, 5, '1|09:00,2|09:00,3|09:00,4|09:00,5|09:00', '1|17:00,2|16:00,3|16:00,4|17:00,5|16:00', 15, 30, 0, '12:00:00', '14:00:00', '1|15:00,2|14:00,3|15:00,4|15:00,5|15:00', '1|16:00,2|15:00,3|16:00,4|16:00,5|16:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;