-- phpMyAdmin SQL Dump
-- version 4.3.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 24, 2019 at 03:17 PM
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
-- Table structure for table `antidot`
--

CREATE TABLE IF NOT EXISTS `antidot` (
  `id` int(11) NOT NULL,
  `antimedicine` varchar(255) NOT NULL,
  `medicine` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antidot`
--

INSERT INTO `antidot` (`id`, `antimedicine`, `medicine`) VALUES
(14, 'Napa', 'Proto'),
(16, 'Proto', 'Test medicine');

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `shortform`, `chapter`, `subchapter`, `source`, `prover`, `type`, `addedby`, `pending`) VALUES
(32, 'Napa', 'Np', 'Head', 'Fever', 'Homeobd', 'Homeobd', 'Antibiotic', 'Raisa Islam Noushin', 'Approved'),
(34, 'Paracitamol', 'Prm', 'Head', 'Fever', 'Homeobd', 'Homeobd', 'Antibiotic', 'Raisa Islam Noushin', 'Approved'),
(35, 'Ace+', 'Ace', 'Head', 'Fever', 'Homeobd', 'Homeobd', 'antibiotic', 'Raisa Islam Noushin', 'Approved'),
(36, 'Test medicine', 'Test medicine', 'Test medicine', 'Test medicine', 'Test medicine', 'Test medicine', 'Test medicine', 'Md Sabbir Ahmed', 'Pending'),
(37, 'Proto', 'PT', 'Health', 'Food', 'Homeobd', 'Homeobd', 'Ebergy Gainer', 'Md Sabbir Ahmed', 'Approved');

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
-- Table structure for table `relatedmedicine`
--

CREATE TABLE IF NOT EXISTS `relatedmedicine` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `symptom` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relatedmedicine`
--

INSERT INTO `relatedmedicine` (`id`, `name`, `grade`, `symptom`) VALUES
(8, 'Ace+', '1', 'Senseless'),
(9, 'Paracitamol', '2', 'Senseless'),
(10, 'Napa+', '3', 'Senseless'),
(17, 'Ace+', '1', 'Chulkani'),
(18, 'Paracitamol', '1', 'Chulkani'),
(25, 'Ace+', '1', 'test'),
(26, 'Paracitamol', '2', 'test'),
(27, 'Ace+', '3', 'Food Poison'),
(28, 'Paracitamol', '2', 'Food Poison'),
(29, 'Napa+', '1', 'Food Poison'),
(30, 'Ace+', '3', 'Fever'),
(31, 'Paracitamol', '3', 'Fever'),
(32, 'Napa+', '3', 'Fever');

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
  `pending` varchar(255) NOT NULL DEFAULT 'Pending',
  `addedby` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `name`, `chapter`, `subchapter`, `shortform`, `pending`, `addedby`) VALUES
(1, 'headache', 'head', 'normal', 'hd', 'Approved', 'Md Sabbir Ahmed'),
(5, 'Fever', 'Head', 'Fever', 'FV', 'Approved', 'Md Sabbir Ahmed'),
(6, 'Chulkani', 'Body', 'Skin', 'CH', 'Approved', 'Md Sabbir Ahmed'),
(7, 'Senseless', 'Body', 'Sense', 'SNS', 'Approved', 'Md Sabbir Ahmed'),
(9, 'Food Poison', 'Health', 'Food', 'FP', 'Pending', 'Raisa Islam Noushin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `token`, `role`, `credit`, `pending`, `refferid`) VALUES
(1, 'Md Sabbir Ahmed', 'md.sabbir073@gmail.com', '01732036568', '67e4a0b2338a76fbb5bf7b85fced2e72', '', 'Admin', 20, 'Approved', ''),
(2, 'Raisa Islam Noushin', 'md.sabbir073@outlook.com', '01643059745', 'a1083f1528d8b91288ace29d4a250649', '', 'Doctor', 20, 'Approved', 'Md Sabbir Ahmed'),
(3, 'Shabekunnaher Masuma', 'md.sabbir073@hotmail.com', '01705068511', '5114b8021ea68f2df4e057cf57c052ac', '', 'Doctor', 20, 'Pending', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antidot`
--
ALTER TABLE `antidot`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `relatedmedicine`
--
ALTER TABLE `relatedmedicine`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `antidot`
--
ALTER TABLE `antidot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `relatedmedicine`
--
ALTER TABLE `relatedmedicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
