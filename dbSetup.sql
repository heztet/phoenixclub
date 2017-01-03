SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_events`
--

DROP TABLE IF EXISTS `phoenix_events`;
CREATE TABLE IF NOT EXISTS `phoenix_events` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) NOT NULL,
  `PointValue` int(11) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsCurrentYear` tinyint(1) NOT NULL DEFAULT '1',
  `DateArchived` datetime DEFAULT NULL,
  `IsOpen` tinyint(1) NOT NULL DEFAULT '1',
  `TotalStudents` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_floors`
--

DROP TABLE IF EXISTS `phoenix_floors`;
CREATE TABLE IF NOT EXISTS `phoenix_floors` (
  `Floor` varchar(256) NOT NULL,
  `TotalPoints` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Floor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table values for table 'phoenix_floors'
--

INSERT INTO phoenix_floors (Floor, TotalPoints)
                           VALUES
                           ("1E", 0),
                           ("2E", 0),
                           ("3E", 0),
                           ("4E", 0),
                           ("5E", 0),
                           ("6E", 0),
                           ("7E", 0),
                           ("8E", 0),
                           ("1W", 0),
                           ("2W", 0),
                           ("3W", 0),
                           ("4W", 0),
                           ("5W", 0),
                           ("6W", 0),
                           ("7W", 0),
                           ("8W", 0);

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_globals`
--

DROP TABLE IF EXISTS `phoenix_globals`;
CREATE TABLE IF NOT EXISTS `phoenix_globals` (
  `Variable` varchar(256) NOT NULL,
  `Value` varchar(256) NOT NULL,
  PRIMARY KEY (`Variable`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table rows for 'phoenix_globals'
--

INSERT INTO phoenix_globals (Variable, Value)
                            VALUES
                            ("BanquetAmount", NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_newsletters`
--

DROP TABLE IF EXISTS `phoenix_newsletters`;
CREATE TABLE IF NOT EXISTS `phoenix_newsletters` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Link` varchar(1023) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_records`
--

DROP TABLE IF EXISTS `phoenix_records`;
CREATE TABLE IF NOT EXISTS `phoenix_records` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PUID` varchar(9) NOT NULL,
  `EventId` int(11) NOT NULL,
  `PointDelta` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `PUID` (`PUID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_rollcalls`
--

DROP TABLE IF EXISTS `phoenix_rollcalls`;
CREATE TABLE IF NOT EXISTS `phoenix_rollcalls` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Floor` varchar(256) NOT NULL,
  `PointDelta` int(11) NOT NULL DEFAULT '0',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_students`
--

DROP TABLE IF EXISTS `phoenix_students`;
CREATE TABLE IF NOT EXISTS `phoenix_students` (
  `PUID` varchar(9) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(60) NOT NULL,
  `Email` varchar(256) DEFAULT NULL,
  `Floor` int(3) NOT NULL,
  `Side` varchar(2) NOT NULL,
  `Year` int(11) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BanquetEligible` tinyint(1) NOT NULL DEFAULT '0',
  `LastSemesterPoints` int(11) NOT NULL DEFAULT '0',
  `TotalEvents` int(11) NOT NULL DEFAULT '0',
  `TotalPoints` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PUID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_users`
--
DROP TABLE IF EXISTS `phoenix_users`;
CREATE TABLE IF NOT EXISTS `phoenix_users` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table `phoenix_year_conversion`
--
DROP TABLE IF EXISTS `phoenix_year_conversion`;
CREATE TABLE IF NOT EXISTS `phoenix_year_conversion` (
  `YearNumber` int(11) NOT NULL,
  `YearString` varchar(16) NOT NULL
  PRIMARY KEY (`YearNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table rows for table `phoenix_year_conversion`
--

INSERT INTO `phoenix_year_conversion` (`YearNumber`, `YearString`) VALUES
                                      (1, 'Freshman'),
                                      (2, 'Sophomore'),
                                      (3, 'Junior'),
                                      (4, 'Senior');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
