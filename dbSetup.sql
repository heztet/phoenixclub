-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2017 at 05:56 AM
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
-- Table structure for table `phoenix_documents`
--

DROP TABLE IF EXISTS `phoenix_documents`;
CREATE TABLE `phoenix_documents` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Link` varchar(1023) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `TotalStudents` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_floors`
--

DROP TABLE IF EXISTS `phoenix_floors`;
CREATE TABLE `phoenix_floors` (
  `Floor` varchar(256) NOT NULL,
  `TotalPoints` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_globals`
--

DROP TABLE IF EXISTS `phoenix_globals`;
CREATE TABLE `phoenix_globals` (
  `Variable` varchar(256) NOT NULL,
  `Value` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phoenix_globals`
--

INSERT INTO `phoenix_globals` (`Variable`, `Value`) VALUES
('BanquetAmount', '5'),
('RollcallAmount', '5');

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_links`
--

DROP TABLE IF EXISTS `phoenix_links`;
CREATE TABLE `phoenix_links` (
  `Id` int(11) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Link` varchar(534) DEFAULT NULL,
  `Lookup` varchar(534) DEFAULT NULL,
  `VisitCount` int(11) NOT NULL DEFAULT '0'
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
-- Table structure for table `phoenix_rollcalls`
--

DROP TABLE IF EXISTS `phoenix_rollcalls`;
CREATE TABLE `phoenix_rollcalls` (
  `Id` int(11) NOT NULL,
  `Floor` varchar(256) NOT NULL,
  `PointDelta` int(11) NOT NULL DEFAULT '0',
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
  `Email` varchar(256) DEFAULT '-',
  `Phone` varchar(12) DEFAULT '-',
  `Floor` int(3) NOT NULL,
  `Side` varchar(2) NOT NULL,
  `Year` int(11) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BanquetEligible` tinyint(1) NOT NULL DEFAULT '0',
  `LastSemesterPoints` int(11) NOT NULL DEFAULT '0',
  `TotalEvents` int(11) NOT NULL DEFAULT '0',
  `TotalPoints` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_users`
--

DROP TABLE IF EXISTS `phoenix_users`;
CREATE TABLE `phoenix_users` (
  `id` int(9) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phoenix_users`
--

INSERT INTO `phoenix_users` (`id`, `username`, `password`, `created`, `last_login`) VALUES
(1, 'admin', 'admin', '2017-02-09 04:35:24', '2017-02-10 04:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_year_conversion`
--

DROP TABLE IF EXISTS `phoenix_year_conversion`;
CREATE TABLE `phoenix_year_conversion` (
  `YearNumber` int(11) NOT NULL,
  `YearString` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phoenix_year_conversion`
--

INSERT INTO `phoenix_year_conversion` (`YearNumber`, `YearString`) VALUES
(1, 'Freshman'),
(2, 'Sophomore'),
(3, 'Junior'),
(4, 'Senior');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phoenix_documents`
--
ALTER TABLE `phoenix_documents`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `phoenix_events`
--
ALTER TABLE `phoenix_events`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `phoenix_floors`
--
ALTER TABLE `phoenix_floors`
  ADD PRIMARY KEY (`Floor`);

--
-- Indexes for table `phoenix_globals`
--
ALTER TABLE `phoenix_globals`
  ADD PRIMARY KEY (`Variable`);

--
-- Indexes for table `phoenix_links`
--
ALTER TABLE `phoenix_links`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `phoenix_records`
--
ALTER TABLE `phoenix_records`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `PUID` (`PUID`);

--
-- Indexes for table `phoenix_rollcalls`
--
ALTER TABLE `phoenix_rollcalls`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `phoenix_students`
--
ALTER TABLE `phoenix_students`
  ADD PRIMARY KEY (`PUID`);

--
-- Indexes for table `phoenix_users`
--
ALTER TABLE `phoenix_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phoenix_year_conversion`
--
ALTER TABLE `phoenix_year_conversion`
  ADD PRIMARY KEY (`YearNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phoenix_documents`
--
ALTER TABLE `phoenix_documents`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `phoenix_events`
--
ALTER TABLE `phoenix_events`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `phoenix_links`
--
ALTER TABLE `phoenix_links`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `phoenix_records`
--
ALTER TABLE `phoenix_records`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `phoenix_rollcalls`
--
ALTER TABLE `phoenix_rollcalls`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `phoenix_users`
--
ALTER TABLE `phoenix_users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
