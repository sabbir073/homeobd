-- phpMyAdmin SQL Dump
-- version 4.3.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 18, 2019 at 02:41 PM
-- Server version: 5.6.25
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `homeobd`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortform` varchar(255) NOT NULL,
  `chapter` varchar(255) NOT NULL,
  `subchapter` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `prover` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `addedby` varchar(255) NOT NULL,
  `pending` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `shortform`, `chapter`, `subchapter`, `source`, `prover`, `type`, `addedby`, `pending`) VALUES
(32, 'Napa', 'Np', 'Head', 'Fever', 'Homeobd', 'Homeobd', 'Antibiotic', 'Raisa Islam Noushin', 'Approved'),
(34, 'Paracitamol', 'Prm', 'Head', 'Fever', 'Homeobd', 'Homeobd', 'Antibiotic', 'Raisa Islam Noushin', 'Approved'),
(35, 'Ace+', 'Ace', 'Head', 'Fever', 'Homeobd', 'Homeobd', 'antibiotic', 'Raisa Islam Noushin', 'Approved'),
(36, 'Test medicine', 'Test medicine', 'Test medicine', 'Test medicine', 'Test medicine', 'Test medicine', 'Test medicine', 'Md Sabbir Ahmed', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `bp` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `symptoms` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `age`, `gender`, `address`, `weight`, `height`, `bp`, `cell`, `symptoms`) VALUES
(1, 'Motahar ali', '25', 'Male', 'Uttara, dhaka', '75', '5.6', '120/80', '01732036568', 'headche, flue, denger');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE IF NOT EXISTS `symptoms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `chapter` varchar(255) NOT NULL,
  `subchapter` varchar(255) NOT NULL,
  `shortform` varchar(255) NOT NULL,
  `relatedmedicine` varchar(10000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `name`, `chapter`, `subchapter`, `shortform`, `relatedmedicine`) VALUES
(1, 'headache', 'head', 'normal', 'hd', 'paracitamol');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'doctor',
  `credit` int(255) NOT NULL DEFAULT '20',
  `pending` varchar(255) NOT NULL DEFAULT 'Pending',
  `refferid` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `token`, `role`, `credit`, `pending`, `refferid`) VALUES
(1, 'Md Sabbir Ahmed', 'md.sabbir073@gmail.com', '67e4a0b2338a76fbb5bf7b85fced2e72', '', 'Admin', 20, 'Approved', ''),
(2, 'Raisa Islam Noushin', 'md.sabbir073@outlook.com', 'a1083f1528d8b91288ace29d4a250649', '', 'doctor', 20, 'Pending', 'Md Sabbir Ahmed'),
(3, 'Shabekunnaher Masuma', 'md.sabbir073@hotmail.com', '5114b8021ea68f2df4e057cf57c052ac', '', 'doctor', 20, 'Banned', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`) COMMENT 'primary';

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) COMMENT 'id';

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
