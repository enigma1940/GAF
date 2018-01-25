-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2018 at 10:07 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gafdb`
--
CREATE DATABASE IF NOT EXISTS `gafdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gafdb`;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `datea` varchar(40) NOT NULL,
  `cat` varchar(20) NOT NULL,
  `url` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=703 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conseil`
--

CREATE TABLE IF NOT EXISTS `conseil` (
  `ID` int(11) NOT NULL,
  `content` text NOT NULL,
  `datea` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `deliberation` text NOT NULL,
  `nomination` text NOT NULL,
  `communication` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=477 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loi`
--

CREATE TABLE IF NOT EXISTS `loi` (
  `ID` int(11) NOT NULL,
  `title` text NOT NULL,
  `filelink` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rapport`
--

CREATE TABLE IF NOT EXISTS `rapport` (
  `ID` int(11) NOT NULL,
  `title` text NOT NULL,
  `filelink` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `conseil`
--
ALTER TABLE `conseil`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `loi`
--
ALTER TABLE `loi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rapport`
--
ALTER TABLE `rapport`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=703;
--
-- AUTO_INCREMENT for table `conseil`
--
ALTER TABLE `conseil`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=477;
--
-- AUTO_INCREMENT for table `loi`
--
ALTER TABLE `loi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `rapport`
--
ALTER TABLE `rapport`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
