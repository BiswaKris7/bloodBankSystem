-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 30, 2022 at 05:43 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbanksystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

DROP TABLE IF EXISTS `clinic`;
CREATE TABLE IF NOT EXISTS `clinic` (
  `clinicNum` int(11) NOT NULL,
  `clinicNm` varchar(45) DEFAULT NULL,
  `phoneNum` varchar(10) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`clinicNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinicNum`, `clinicNm`, `phoneNum`, `address`) VALUES
(1, 'Tokyo Blood Bank', '1111111111', 'address 1'),
(2, 'Grand Line Blood', '2222222222', 'address 2'),
(3, 'Muzan Blood Services', '3333333333', 'address 3'),
(4, 'Lugnica Blood Center', '4444444444', 'address 4'),
(5, 'Spirit Blood Donation Services', '5555555555', 'address 5'),
(6, 'Toronto Blood Bank', '6666666666', 'address 6');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

DROP TABLE IF EXISTS `donation`;
CREATE TABLE IF NOT EXISTS `donation` (
  `donationNum` int(11) NOT NULL,
  `clinicNum` int(11) DEFAULT NULL,
  `donorNum` varchar(45) DEFAULT NULL,
  `donationDt` varchar(45) DEFAULT NULL,
  `donationAmount` double DEFAULT NULL,
  `bloodType` enum('AB+','AB-','A+','A-','B+','B-','O+','O-') NOT NULL,
  PRIMARY KEY (`donationNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`donationNum`, `clinicNum`, `donorNum`, `donationDt`, `donationAmount`, `bloodType`) VALUES
(1, 1, '4', '20220222', 1, 'AB+'),
(2, 3, '2', '20220212', 2, 'A+'),
(3, 3, '2', '20220330', 2, 'A+'),
(4, 3, '3', '20220418', 0.5, 'B-'),
(5, 4, '5', '20220526', 1, 'AB-'),
(6, 2, '1', '20220101', 1, 'A-');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

DROP TABLE IF EXISTS `donor`;
CREATE TABLE IF NOT EXISTS `donor` (
  `DonorNum` int(11) NOT NULL,
  `physicianNum` int(11) DEFAULT NULL,
  `firstNm` varchar(45) DEFAULT NULL,
  `lastNm` varchar(45) DEFAULT NULL,
  `birthDt` date DEFAULT NULL,
  `phoneNum` varchar(10) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `bloodType` enum('AB+','AB-','A+','A-','B+','B-','O+','O-') NOT NULL,
  `healthCardNum` varchar(11) DEFAULT NULL,
  `lastDonationDt` date DEFAULT NULL,
  PRIMARY KEY (`DonorNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`DonorNum`, `physicianNum`, `firstNm`, `lastNm`, `birthDt`, `phoneNum`, `address`, `bloodType`, `healthCardNum`, `lastDonationDt`) VALUES
(4, 3, 'Shigeo', 'Kageyama', '2012-04-18', '1234567890', '24 Seasoning City Rd', 'O-', '9999999999', '2022-11-10'),
(3, 2, 'Nezuko', 'Kamado', '2016-06-03', NULL, '2 Wandering Swordsman Ave', 'B-', '1234123987', '2022-10-31'),
(2, 2, 'Tanjiro', 'Kamado', '2016-06-03', NULL, '1 Wandering Swordsman Ave', 'A+', '1234123123', '2022-11-01'),
(1, 1, 'Luffy', 'Monkey\'D', '1997-12-24', '647123987', '1 Going Merry', 'A-', '1234567890', '2022-03-28'),
(5, 4, 'Yuji', 'Itadori', '2018-03-05', '7777777777', 'Tokyo Jujutsu High School of Sorcery', 'AB+', '1111111111', '2022-09-29'),
(6, 5, 'Subaru', 'Natsuki', '2014-01-27', '3436760000', '3 Denial Rd', 'AB-', '0000000001', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employeeNum` int(11) NOT NULL,
  `clinicNum` int(11) DEFAULT NULL,
  `firstNm` varchar(45) DEFAULT NULL,
  `lastNm` varchar(45) DEFAULT NULL,
  `birthDt` date DEFAULT NULL,
  `phoneNum` varchar(10) NOT NULL,
  `startDt` date DEFAULT NULL,
  `salary` int(10) DEFAULT NULL,
  `isManager` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`employeeNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeNum`, `clinicNum`, `firstNm`, `lastNm`, `birthDt`, `phoneNum`, `startDt`, `salary`, `isManager`) VALUES
(1, 1, 'Kris', 'Biswa', '2000-01-01', '1001001000', '2020-01-01', 100000, NULL),
(2, 2, 'Cole', 'McMullin', '0001-01-01', '2002002000', '2020-01-01', 1000000, 1),
(3, 3, 'Ononsen', 'Aziegbe', '2000-01-01', '3003003000', '2021-01-01', 2000, NULL),
(4, 3, 'Kibutsuji', 'Muzan', '2016-06-03', '4004004000', '2021-01-01', 1000000, 1),
(5, 4, 'Abdullah', 'Khan', '2000-01-01', '5005005000', '2022-01-01', 20000, 1),
(6, 3, 'Stanley', 'Watemi', '2000-01-01', '6006006000', '2022-01-01', 20000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

DROP TABLE IF EXISTS `hospital`;
CREATE TABLE IF NOT EXISTS `hospital` (
  `hospitalNum` int(11) NOT NULL,
  `hospitalNm` varchar(45) DEFAULT NULL,
  `phoneNum` varchar(10) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`hospitalNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hospitalNum`, `hospitalNm`, `phoneNum`, `address`) VALUES
(1, 'Tokyo General Hospital', '9999999999', '666 Lawrence Ave E'),
(2, 'North York General Hospital', '8888888888', '22 Sheppard Ave'),
(3, 'Michael Garron Hospital', '7777777777', '442 wilson Ave'),
(4, 'Lakeridge Health Oshawa', '6666666665', '1 Lake Ridge Rd'),
(5, 'Humber River Hospital', '5555555554', '3 Maple Leaf Dr'),
(6, 'CAMH', '4444444443', '76 Pinedale Ave');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `healthCardNum` int(11) NOT NULL,
  `patientNum` int(11) DEFAULT NULL,
  `physician` int(11) DEFAULT NULL,
  `firstNm` varchar(45) DEFAULT NULL,
  `lastNm` varchar(45) DEFAULT NULL,
  `birthDt` date DEFAULT NULL,
  `phoneNum` varchar(10) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `bloodType` enum('AB+','AB-','A+','A-','B+','B-','O+','O-') NOT NULL,
  `medicalCondition` varchar(500) DEFAULT NULL,
  `litresNeeded` double NOT NULL,
  PRIMARY KEY (`healthCardNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`healthCardNum`, `patientNum`, `physician`, `firstNm`, `lastNm`, `birthDt`, `phoneNum`, `address`, `bloodType`, `medicalCondition`, `litresNeeded`) VALUES
(1232343456, 4, 3, 'Shigeo', 'Kageyama', '2012-04-18', '1234567890', '24 Seasoning City Rd', 'O-', 'Anxiety, Inferiority Complex', 2.5),
(1234123987, 3, 2, 'Nezuko', 'Kamado', '2016-06-03', NULL, '2 Wandering Swordsman Ave', 'B-', 'Porphyria', 3),
(1234123123, 2, 2, 'Tanjiro', 'Kamado', '2016-06-03', NULL, '1 Wandering Swordsman Ave', 'A+', 'sometimes has a hard time breathing', 2.5),
(1234567890, 1, 1, 'Luffy', 'Monkey\'D', '1997-12-24', NULL, '1 Going Merry', 'A-', 'stretchy', 0),
(1111111111, 5, 4, 'Yuji', 'Itadori', '2018-03-05', '7777777777', 'Tokyo Jujutsu High School of Sorcery', 'AB+', 'schizophrenia', 1.5),
(1, 6, 5, 'Subaru', 'Natsuki', '2014-01-27', '3436760000', '3 Denial Rd', 'AB-', 'depression', 2);

-- --------------------------------------------------------

--
-- Table structure for table `physician`
--

DROP TABLE IF EXISTS `physician`;
CREATE TABLE IF NOT EXISTS `physician` (
  `physicianNum` int(11) NOT NULL,
  `lisenceNum` varchar(12) NOT NULL,
  `hospitalNum` int(11) DEFAULT NULL,
  `firstNm` varchar(45) DEFAULT NULL,
  `lastNm` varchar(45) DEFAULT NULL,
  `phoneNum` varchar(10) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `birthDt` date DEFAULT NULL,
  PRIMARY KEY (`physicianNum`,`lisenceNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physician`
--

INSERT INTO `physician` (`physicianNum`, `lisenceNum`, `hospitalNum`, `firstNm`, `lastNm`, `phoneNum`, `address`, `birthDt`) VALUES
(1, 'CAMD1007980', 1, 'Melissa', 'Finlay', '1212121212', '12 Armour Bvd', '2000-07-21'),
(2, 'JPMD2345678', 1, 'Tamayo', NULL, '6565656565', '12 Side Alley Rd', '2016-06-03'),
(3, 'JPMD0987654', 2, 'Kunkung', 'Margolese', '2000000002', '342 Weston rd', '2005-05-05'),
(4, 'CAMD1234567', 3, 'Lauren', 'Pavao', '1000000001', '98 Keele St', '2000-02-02'),
(5, 'CAMD3456789', 4, 'Slava', 'Osakin', '3000000003', '144 East Mall Rd', '2000-03-03'),
(6, 'CAMD7654321', 5, 'Matthew ', NULL, '4000000004', '223 Wilson Ave', '2004-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `requisition`
--

DROP TABLE IF EXISTS `requisition`;
CREATE TABLE IF NOT EXISTS `requisition` (
  `requisitionNum` int(11) NOT NULL,
  `hospitalNum` int(11) DEFAULT NULL,
  `requisitionDetails` varchar(300) DEFAULT NULL,
  `clinicNum` int(11) DEFAULT NULL,
  `requisitionDt` date DEFAULT NULL,
  `isComplete` tinyint(4) NOT NULL DEFAULT '0',
  `completionDt` date DEFAULT NULL,
  PRIMARY KEY (`requisitionNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisition`
--

INSERT INTO `requisition` (`requisitionNum`, `hospitalNum`, `requisitionDetails`, `clinicNum`, `requisitionDt`, `isComplete`, `completionDt`) VALUES
(1, 1, '1L O-', 1, '2022-01-21', 1, '2022-02-03'),
(2, 1, '34L AB+', 2, '2022-02-02', 0, NULL),
(3, 1, '12L A-', 1, '2022-03-23', 0, NULL),
(4, 2, '9L B+', 5, '2022-04-14', 1, '2022-06-30'),
(5, 3, '3L A+', 3, '2022-05-15', 0, NULL),
(6, 6, '4L A-', 1, '2022-06-26', 1, '2022-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

DROP TABLE IF EXISTS `storage`;
CREATE TABLE IF NOT EXISTS `storage` (
  `hospitalNum` int(11) NOT NULL,
  `donationNum` int(11) NOT NULL,
  `donationUsed` tinyint(1) NOT NULL,
  PRIMARY KEY (`hospitalNum`,`donationNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage`
--

INSERT INTO `storage` (`hospitalNum`, `donationNum`, `donationUsed`) VALUES
(1, 1, 0),
(1, 6, 1),
(2, 4, 0),
(3, 3, 1),
(4, 2, 0),
(6, 5, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
