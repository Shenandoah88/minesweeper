-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql111.byetcluster.com
-- Generation Time: Jun 03, 2019 at 10:12 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epiz_23985290_minesweeper`
--

-- --------------------------------------------------------

--
-- Table structure for table `Game`
--

CREATE TABLE IF NOT EXISTS `Game` (
  `name` text NOT NULL,
  `sessionID` int(11) NOT NULL,
  `gameState` longtext NOT NULL,
  `gameBoard` longtext NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `salt` varchar(1048) NOT NULL DEFAULT 'this$*+Salt+is++&*Being((*()used))_)(for**&&*^security+@)#($reasons888786'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
