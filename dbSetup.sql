-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2016 at 04:37 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marinon`
--

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_students`
--

CREATE TABLE `phoenix_students` (
  `PUID` varchar(9) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(60) NOT NULL,
  `Floor` int(3) NOT NULL,
  `Side` varchar(2) NOT NULL,
  `Year` int(11) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BanquetEligible` tinyint(1) NOT NULL DEFAULT '1',
  `TotalEvents` int(11) NOT NULL DEFAULT '0',
  `TotalPoints` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phoenix_students`
--
ALTER TABLE `phoenix_students`
  ADD PRIMARY KEY (`PUID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
