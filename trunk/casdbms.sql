-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2011 at 05:19 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `casdbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `sbasic`
--

CREATE TABLE IF NOT EXISTS `sbasic` (
  `Student_Number` varchar(10) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Middle_Initial` varchar(1) NOT NULL,
  `Course` varchar(10) NOT NULL,
  `Major` varchar(20) DEFAULT NULL,
  `Title_Thesis` varchar(100) DEFAULT NULL,
  `Classification_Start` varchar(3) DEFAULT NULL,
  `Classification_End` varchar(3) DEFAULT NULL,
  `GWA` decimal(3,2) NOT NULL,
  `Unit` int(3) NOT NULL,
  `Res` int(3) NOT NULL,
  `Adviser` varchar(20) DEFAULT NULL,
  `Reg_Adviser` varchar(20) DEFAULT NULL,
  `Home_Number_Street_Vill` varchar(50) NOT NULL,
  `Home_Barangay` varchar(20) NOT NULL,
  `Home_Town_City` varchar(50) NOT NULL,
  `Home_Province` varchar(50) NOT NULL,
  `Contact_Number` varchar(20) NOT NULL,
  `College_Number_Street_Vill` varchar(50) NOT NULL,
  `College_Village_Barangay` varchar(50) NOT NULL,
  `College_Town_City` varchar(50) NOT NULL,
  PRIMARY KEY (`Student_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sbasic`
--

INSERT INTO `sbasic` (`Student_Number`, `Last_Name`, `First_Name`, `Middle_Initial`, `Course`, `Major`, `Title_Thesis`, `Classification_Start`, `Classification_End`, `GWA`, `Unit`, `Res`, `Adviser`, `Reg_Adviser`, `Home_Number_Street_Vill`, `Home_Barangay`, `Home_Town_City`, `Home_Province`, `Contact_Number`, `College_Number_Street_Vill`, `College_Village_Barangay`, `College_Town_City`) VALUES
('2008-14391', 'Dela Cruz', 'Juan', 'E', 'BSCS', 'CMSC 128', 'Thesis', 'Se', 'Non', '1.00', 55, 0, 'Angelina Bully', 'Bruce Dilis', '77', 'Balintawak', 'Lipa City', 'Batangas', '09101101010', '66', 'Batong Malake', 'Los Banos'),
('2008-30752', 'Uragon', 'Jeric', 'T', 'BSCS', 'PAD', 'Ang Alamat ng Itlog na Orange', 'So', 'NF', '3.00', 3, 0, '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sdeli`
--

CREATE TABLE IF NOT EXISTS `sdeli` (
  `Student_Number` varchar(10) NOT NULL,
  `Semester` int(4) NOT NULL,
  `AY` int(4) NOT NULL,
  `Form5` varchar(20) DEFAULT NULL,
  `Form5A` varchar(20) DEFAULT NULL,
  `Status` varchar(20) NOT NULL,
  `Remarks` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Student_Number`,`Semester`,`AY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sdeli`
--

INSERT INTO `sdeli` (`Student_Number`, `Semester`, `AY`, `Form5`, `Form5A`, `Status`, `Remarks`, `Date`) VALUES
('1', 1, 1, 'X', '1', 'Good', '1', '2011-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `sgwapersem`
--

CREATE TABLE IF NOT EXISTS `sgwapersem` (
  `Student_Number` varchar(10) NOT NULL,
  `Semester` int(4) NOT NULL,
  `AY` int(4) NOT NULL,
  `GWA` int(3) NOT NULL,
  `Status` varchar(20) NOT NULL,
  PRIMARY KEY (`Student_Number`,`Semester`,`AY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sgwapersem`
--

INSERT INTO `sgwapersem` (`Student_Number`, `Semester`, `AY`, `GWA`, `Status`) VALUES
('', 1, 0, 0, 'University Scholar'),
('', 3, 0, 0, 'University Scholar'),
('2008-14391', 1, 2008, 2, 'Good'),
('2008-14391', 1, 2009, 0, 'Warning'),
('2008-14391', 2, 2010, 0, 'Probation'),
('2008-14391', 3, 2009, 1, 'Dismissed');

-- --------------------------------------------------------

--
-- Table structure for table `ssdt`
--

CREATE TABLE IF NOT EXISTS `ssdt` (
  `Student_Number` varchar(10) NOT NULL,
  `Sem` int(4) NOT NULL,
  `AY` int(4) NOT NULL,
  `Case_Number` varchar(10) NOT NULL,
  `Academic_Status` varchar(20) NOT NULL,
  `Remarks` varchar(50) NOT NULL,
  `Case_Status` varchar(50) NOT NULL,
  `Date_Ordered` date NOT NULL,
  `Date_Effective` date NOT NULL,
  PRIMARY KEY (`Student_Number`,`Sem`,`AY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssdt`
--

INSERT INTO `ssdt` (`Student_Number`, `Sem`, `AY`, `Case_Number`, `Academic_Status`, `Remarks`, `Case_Status`, `Date_Ordered`, `Date_Effective`) VALUES
('1', 1, 1, '1', 'University Scholar', '4234', '2134', '2011-01-19', '2011-01-12'),
('1', 1, 2, '2', 'Dismissed', '1', '1', '2011-02-15', '2011-02-22'),
('2', 1, 1, '1', 'College Scholar', '2', '2', '2011-02-02', '2011-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `Transaction_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Date_In` date NOT NULL,
  `Name_Unit_Who_Requested` varchar(64) NOT NULL,
  `Student_Number` varchar(10) NOT NULL,
  `Course_Unit` varchar(32) NOT NULL,
  `Indicator` varchar(32) NOT NULL,
  `Operation` varchar(32) NOT NULL,
  `Code` varchar(32) NOT NULL,
  `Count` int(10) NOT NULL,
  `Signed_Performed_By` varchar(32) NOT NULL,
  `Received_By` varchar(32) NOT NULL,
  `Date_Out` date NOT NULL,
  PRIMARY KEY (`Transaction_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `transactions`
--


-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE IF NOT EXISTS `userdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `username`, `password`) VALUES
(1, 'admin', '861613f5a80abdf5a15ea283daa64be3');
