-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2013 at 05:58 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pemiluhimatika`
--

-- --------------------------------------------------------

--
-- Table structure for table `calon`
--

CREATE TABLE IF NOT EXISTS `calon` (
  `id_calon` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `img_url` varchar(50) NOT NULL DEFAULT './img/a.jpg',
  PRIMARY KEY (`id_calon`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `calon`
--

INSERT INTO `calon` (`id_calon`, `nama`, `nim`, `img_url`) VALUES
(1, 'Calon A', '10100000', './img/a.jpg'),
(2, 'Calon B', '10100001', './img/a.jpg'),
(3, 'Calon C', '10100002', './img/a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `var_name` varchar(20) NOT NULL,
  `value` varchar(10) NOT NULL,
  PRIMARY KEY (`var_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`var_name`, `value`) VALUES
('evote-enabled-1', '0'),
('evote-enabled-2', '0'),
('evote-enabled-3', '0');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_calon` int(11) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `id_calon`, `status`) VALUES
(1, 1, ''),
(2, 3, ''),
(3, 2, ''),
(4, 3, ''),
(5, 2, ''),
(6, 1, ''),
(7, 2, ''),
(8, 1, ''),
(9, 3, ''),
(10, 3, ''),
(11, 2, ''),
(12, 2, ''),
(13, 2, ''),
(14, 2, ''),
(15, 2, ''),
(16, 1, ''),
(17, 3, ''),
(18, 1, ''),
(19, 1, ''),
(20, 1, ''),
(21, 1, ''),
(22, 2, ''),
(23, 3, ''),
(24, 2, ''),
(25, 3, ''),
(26, 3, ''),
(27, 1, ''),
(28, 3, ''),
(29, 3, ''),
(30, 2, ''),
(31, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `time_vote` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `is_voted` tinyint(1) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `id_priviledge` int(11) NOT NULL DEFAULT '0',
  `is_logged_in` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `time_vote`, `nama`, `nim`, `no_hp`, `is_voted`, `username`, `password`, `id_priviledge`, `is_logged_in`) VALUES
(1, '2013-01-19 14:15:37', 'Admin 1', '10111000', '012345678', 0, 'admin', 'd3e0f235d7ebc3af0955dbc88ca555f6', 1, 1),
(2, '2013-01-19 13:59:33', 'bilik 1', '10111111', '9876543210', 0, 'bilik1', 'd83bd048e928c1a9076df467182546de', 0, 0),
(3, '2013-01-19 14:40:26', 'bilik 2', '10111112', '101101101', 0, 'bilik2', 'ce9934e7faa0187fb8bd8fd8796dd810', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
