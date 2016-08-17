-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2016 at 12:57 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `phoenix_events`
--

DROP TABLE IF EXISTS `phoenix_events`;
CREATE TABLE `phoenix_events` (
  `Id` int(11) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `PointValue` int(11) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsCurrentYear` tinyint(1) NOT NULL DEFAULT '1',
  `DateArchived` datetime DEFAULT NULL,
  `IsOpen` tinyint(1) NOT NULL DEFAULT '1',
  `TotalStudents` int(11) NOT NULL DEFAULT '0',
  `TotalNonRAs` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_records`
--

DROP TABLE IF EXISTS `phoenix_records`;
CREATE TABLE `phoenix_records` (
  `Id` int(11) NOT NULL,
  `PUID` varchar(9) NOT NULL,
  `EventId` int(11) NOT NULL,
  `PointDelta` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_students`
--

DROP TABLE IF EXISTS `phoenix_students`;
CREATE TABLE `phoenix_students` (
  `PUID` varchar(9) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(60) NOT NULL,
  `Floor` varchar(3) NOT NULL,
  `Year` int(11) NOT NULL,
  `IsRA` int(11) NOT NULL DEFAULT '0',
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsCurrent` tinyint(1) NOT NULL DEFAULT '1',
  `DateArchived` datetime DEFAULT NULL,
  `TotalEvents` int(11) NOT NULL DEFAULT '0',
  `TotalPoints` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phoenix_events`
--
ALTER TABLE `phoenix_events`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `phoenix_records`
--
ALTER TABLE `phoenix_records`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `PUID` (`PUID`);

--
-- Indexes for table `phoenix_students`
--
ALTER TABLE `phoenix_students`
  ADD PRIMARY KEY (`PUID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phoenix_events`
--
ALTER TABLE `phoenix_events`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `phoenix_records`
--
ALTER TABLE `phoenix_records`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4753;

--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for phoenix_events
--

--
-- Metadata for phoenix_records
--

--
-- Metadata for phoenix_students
--

--
-- Metadata for marinon
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
