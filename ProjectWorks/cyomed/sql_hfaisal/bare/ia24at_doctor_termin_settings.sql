-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2015 at 05:57 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ihrarzt24`
--

-- --------------------------------------------------------

--
-- Table structure for table `ia24at_doctor_termin_settings`
--

CREATE TABLE IF NOT EXISTS `ia24at_doctor_termin_settings` (
  `doctor_id` bigint(20) unsigned NOT NULL,
  `afterwards_message` text COLLATE utf8_unicode_ci NOT NULL,
  `email_subject` text COLLATE utf8_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8_unicode_ci NOT NULL,
  `email_closing` text COLLATE utf8_unicode_ci NOT NULL,
  `email_signature` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` text COLLATE utf8_unicode_ci NOT NULL,
  `reminder_email_subject` text COLLATE utf8_unicode_ci NOT NULL,
  `reminder_email_body` text COLLATE utf8_unicode_ci NOT NULL,
  `reminder_email_closing` text COLLATE utf8_unicode_ci NOT NULL,
  `followup_email_subject` text COLLATE utf8_unicode_ci NOT NULL,
  `followup_email_body` text COLLATE utf8_unicode_ci NOT NULL,
  `followup_email_closing` text COLLATE utf8_unicode_ci NOT NULL,
  `reminder_time` varchar(255) CHARACTER SET latin1 NOT NULL,
  `reminder_time_wrapper` tinyint(3) unsigned NOT NULL,
  `followup_time` varchar(255) CHARACTER SET latin1 NOT NULL,
  `followup_time_wrapper` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`doctor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ia24at_doctor_termin_settings`
--

INSERT INTO `ia24at_doctor_termin_settings` (`doctor_id`, `afterwards_message`, `email_subject`, `email_body`, `email_closing`, `email_signature`, `logo`, `reminder_email_subject`, `reminder_email_body`, `reminder_email_closing`, `followup_email_subject`, `followup_email_body`, `followup_email_closing`, `reminder_time`, `reminder_time_wrapper`, `followup_time`, `followup_time_wrapper`) VALUES
(8, 'Thanks for your booking!', 'Thank you for booking', 'Check again', '                                                                                                                              Notes: Lorem ipsum dolor sit amet consectetur adipisicing elit seddo eiusmod tempor incididunt utlabore etdolore magna aliqua Ut enimad minim veniam quis nostrud exercitation ullamco laboris nisiut aliquip exeacommodo consequat                                                                                                           ', 'http://localhost/ihrarzt24/beta.cyomed/./assets/uploads/doctor/c9f0f895fb98ab9159f51fd0297e236d/email_signature/7f87b5c43ecba102867e72c6d60e8134.jpg', 'http://localhost/ihrarzt/beta.cyomed/./assets/uploads/doctor/c9f0f895fb98ab9159f51fd0297e236d/logo/f090d07368bb1b0755a691697a33d666.png', 'sfsdgs', '       www     ', '     2   ', 'Booking followup', 'Notes:<br />\n<br />\nLorem ipsum dolor sit amet consectetur adipisicing elit seddo eiusmod tempor incididunt utlabore etdolore magna aliqua Ut enimad minim veniam quis nostrud exercitation ullamco laboris nisiut aliquip exeacommodo consequat         ', '               Notes: Here comes the closing notes         ', '2', 1, '4', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
