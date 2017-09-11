-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2015 at 07:35 PM
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
-- Table structure for table `epres_questions`
--

CREATE TABLE IF NOT EXISTS `epres_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `input_type` varchar(50) NOT NULL,
  `option_count` int(10) NOT NULL,
  `option1` varchar(50) NOT NULL,
  `option2` varchar(50) NOT NULL,
  `option3` varchar(50) NOT NULL,
  `option4` varchar(50) NOT NULL,
  `option5` varchar(50) NOT NULL,
  `class` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `epres_questions`
--

INSERT INTO `epres_questions` (`id`, `question`, `type`, `input_type`, `option_count`, `option1`, `option2`, `option3`, `option4`, `option5`, `class`) VALUES
(0, 'Medikament', 'xxxx', '', 0, '', '', '', '', '', ''),
(1, 'Haben Sie das Medikament bereits einmal eingenommen?', 'ge', 'radio', 3, 'ja', 'nein', 'nicht aktuell', '', '', ''),
(2, 'In welcher Dosierung nehmen Sie das Medikament ein?', 'ge', 'text', 0, '', '', '', '', '', 'follow_up'),
(3, 'Seit wann nehmen Sie dieses Medikament?', 'ge', 'date', 0, '', '', '', '', '', 'follow_up'),
(4, 'Wie häufig nehmen Sie dieses Medikament?', 'ge', 'text', 0, '', '', '', '', '', 'follow_up'),
(5, 'Zu welchen Zeiten nehmen Sie das Medikament?', 'ge', 'multi_time', 0, '', '', '', '', '', 'follow_up'),
(6, 'Nehmen Sie eine ganze oder eine halbe Tablette?', 'ge', 'radio', 2, 'ganz', 'halb', '', '', '', 'follow_up'),
(7, 'Wann haben Sie dieses Medikament das letzte Mal eingenommen?', 'ge', 'date', 0, '', '', '', '', '', ''),
(8, 'Bitte geben Sie Ihen letzten bekannten Blutdruck ein?', 'bp', 'text', 0, '', '', '', '', '', ''),
(9, 'An welchen Krankheiten außer hohen Blutdruck leiden Sie noch?', 'bp', 'text', 0, '', '', '', '', '', ''),
(10, 'Sind Sie vor kurzen operiert worden oder ist eine Operation geplannt?', 'bpch', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(11, 'Leiden Sie an einer Nierenschwäche?', 'bp', 'radio', 2, 'ja ', 'nein', '', '', '', ''),
(12, 'Leiden Sie an einer Lebererkrankung?', 'bpch', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(13, 'Haben Sie eine Erkrankung des Magen-Darm-Traktes?', 'bp', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(14, 'Leiden Sie an einer Störung des Elektrolyt- (Natrium, Kalium, Magnesium, Kalzium) oder des Säure-Basen-Haushaltes?', 'bpch', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(15, 'Leiden Sie an einer Hormonstörung?', 'bpch', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(16, 'Leiden Sie an Gicht?', 'bpch', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(17, 'Leiden Sie an Diabetes?', 'bpch', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(18, 'Leiden Sie an einer chroischen Atemwegserkrankung wie Astma oder chronischer Bronchitis?', 'bp', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(19, 'Neigen Sie zu Schwindel oder sind Sie schon einmal kollabiert oder gar ohnmächtig geworden?', 'bp', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(20, 'Hatten Sie schon einmal Herzinfarkt?', 'bpch', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(21, 'Hatten Sie schon einmal einen Schlaganfall?', 'bpch', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(22, 'Leiden Sie an Durchblutungsstörungen der Armen oder Beine?(z.B. Schaufensterkrankheit)', 'bp', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(23, 'Leiden Sie an anderen chronischen Herzerkrankungen oder einer Herzrhythmusstörung?', 'bp', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(24, 'Haben Sie Beschwerden aufgrund Ihrer Erkrankung?', 'ge', 'text', 0, '', '', '', '', '', ''),
(25, 'Haben Sie Beschwerden durch Ihrer Medikamente?', 'ge', 'text', 0, '', '', '', '', '', ''),
(26, 'Wurde bei Ihnen bereits einmal eine Langzeitblutdruckbestimmung durchgeführt?(24 Stunden)', 'bp', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(27, 'Messen Sie Ihren Blutdruck regelmäßig?', 'bp', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(28, 'Rauchen Sie?', 'ge', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(29, 'Trinken Sie Alkohol?', 'ge', 'radio', 4, 'nein', 'selten', 'regelmäßig', 'täglich', '', ''),
(30, 'Konsumieren Sie Drogen oder haben Sie Drogen konsumiert?', 'ge', 'text', 0, '', '', '', '', '', ''),
(31, 'An welchen Krankheiten außer erhöhtem Cholesterin leiden Sie noch?', 'ch', 'text', 0, '', '', '', '', '', ''),
(32, 'Sind in letzter Zeit Ihre Leberwerte kntrolliert worden?', 'ch', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(33, 'Litten Sie schon einmal an Muskelzerfall oder hatten Sie in letzter Zeit starke nicht belastungabhängige Muskelschmerzen oder einen Muskelkater?', 'ch', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(34, 'Wer hat Ihnen das Medikament verschrieben?', 'ge', 'text', 0, '', '', '', '', '', ''),
(35, 'Wann haben Sie das letzte mal mit Ihrem behandelden Arzt über Ihre Krankheit gesprochen?', 'ge', 'text', 0, '', '', '', '', '', ''),
(36, 'Nehmen Sie derzeit andere Medikamente oder haben Sie in letzter Zeit andere Medikamente eingenommen (wenn auch nur über kurze Zeit)?', 'ge', 'text', 0, '', '', '', '', '', ''),
(37, 'Haben Sie Allergien gegen Medikament?', 'ge', 'text', 0, '', '', '', '', '', ''),
(38, 'Wogegen Sind Sie allergisch?', 'al', 'text', 0, '', '', '', '', '', ''),
(39, 'Welche Beschwerden verursacht Ihre Allergie?', 'al', 'text', 0, '', '', '', '', '', ''),
(40, 'Sind Sie schwanger?', 'fe', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(41, 'Stillen Sie?', 'fe', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(42, 'Planen Sie eine Schwangerschaft?', 'fe', 'radio', 2, 'ja', 'nein', '', '', '', ''),
(43, 'Führen Sie beruflich Maschinen, Kraftfahrzeuge, LKW, Flugzeuge etc. oder sind Sie regälmäßig auf ein Auto angewiesen?', 'al', 'radio', 2, 'ja', 'nein', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
