-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2011 at 07:24 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `casdbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE IF NOT EXISTS `alumni` (
  `Student_Number` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Middle_Initial` varchar(5) NOT NULL,
  `Home_Address` varchar(50) NOT NULL,
  `Office_Address` varchar(80) DEFAULT NULL,
  `Contact_Number` varchar(20) DEFAULT NULL,
  `Mobile_Number` varchar(20) DEFAULT NULL,
  `Email_Address` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Student_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`Student_Number`, `Last_Name`, `First_Name`, `Middle_Initial`, `Home_Address`, `Office_Address`, `Contact_Number`, `Mobile_Number`, `Email_Address`) VALUES
('2000-00001', 'Tandoc', 'Froilan', 'B', 'Los Banos', 'Los Banos', '09090909', '0909090909', 'froi@tandoc.b'),
('2000-00002', 'aaaaaaaa', 'aaaaaaaaa', 'aaaaa', 'aaaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaaaa', 'aaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaa'),
('2000-00003', 'bbbbbbb', 'bbbbbbbb', 'bbbbb', 'bbbbbbbbb', 'bbbbbbbbbb', 'bbbbbbbbbbbb', 'bbbbbbbbbbbbb', 'bbbbbbbbbbbbbbb');

-- --------------------------------------------------------

--
-- Table structure for table `alumni_degrees`
--

CREATE TABLE IF NOT EXISTS `alumni_degrees` (
  `Student_Number` varchar(10) NOT NULL,
  `Degree` varchar(10) NOT NULL,
  `Semester_Graduated` varchar(1) NOT NULL,
  `Year_Graduated` int(11) NOT NULL,
  PRIMARY KEY (`Student_Number`,`Degree`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumni_degrees`
--

INSERT INTO `alumni_degrees` (`Student_Number`, `Degree`, `Semester_Graduated`, `Year_Graduated`) VALUES
('2000-00001', 'BSCS', '2', 2004),
('2000-00001', 'MSCS', 'S', 2009),
('2000-00003', 'BACA', '2', 1111),
('2000-00003', 'BSCS', '1', 2000),
('2000-00002', 'BSBIO', 'S', 3333),
('2000-00002', 'BACA', '2', 2222),
('2000-00002', 'BSCS', '1', 1111),
('2000-00002', 'BASOC', '2', 4444),
('2000-00002', 'BSAP', '1', 5555),
('2000-00002', 'BSSTAT', 'S', 6666),
('2000-00002', 'BSMATH', '2', 7777),
('2000-00002', 'BSAM', '1', 8888),
('2000-00003', 'BSBIO', 'S', 2222),
('2000-00003', 'BASOC', '1', 3333),
('2000-00003', 'BSAP', '2', 4444);

-- --------------------------------------------------------

--
-- Table structure for table `available_degrees`
--

CREATE TABLE IF NOT EXISTS `available_degrees` (
  `DegreeName` varchar(30) NOT NULL,
  `DegreeAbbr` varchar(10) NOT NULL,
  `Window` int(11) NOT NULL,
  PRIMARY KEY (`DegreeName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `available_degrees`
--

INSERT INTO `available_degrees` (`DegreeName`, `DegreeAbbr`, `Window`) VALUES
('BS Computer Science', 'BSCS', 2),
('BA Communication Art', 'BACA', 4),
('BS Biology', 'BSBIO', 3),
('BA Sociology', 'BASOC', 4),
('BS Applied Physics', 'BSAP', 5),
('BS Statistics', 'BSSTAT', 2),
('BS Mathematics', 'BSMATH', 5),
('BS Applied Mathematics', 'BSAM', 5),
('BS Chemistry', 'BSCHEM', 1),
('BA Philosophy', 'BAPHILO', 4),
('MS Computer Science', 'MSCS', 2);

-- --------------------------------------------------------

--
-- Table structure for table `noncas`
--

CREATE TABLE IF NOT EXISTS `noncas` (
  `Student_Number` varchar(15) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `First_Name` varchar(30) NOT NULL,
  `Middle_Initial` varchar(5) NOT NULL,
  `Email_Address` varchar(20) NOT NULL,
  PRIMARY KEY (`Student_Number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `noncas`
--


-- --------------------------------------------------------

--
-- Table structure for table `pending_users`
--

CREATE TABLE IF NOT EXISTS `pending_users` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Role` varchar(10) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_users`
--

INSERT INTO `pending_users` (`Username`, `Password`, `Role`) VALUES
('2000-00003', '861613f5a80abdf5a15ea283daa64be3', 'alumni'),
('2008-11363', '861613f5a80abdf5a15ea283daa64be3', 'student'),
('2008-11364', '861613f5a80abdf5a15ea283daa64be3', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `purpose`
--

CREATE TABLE IF NOT EXISTS `purpose` (
  `Transaction_Number` varchar(30) NOT NULL,
  `Purpose` varchar(50) NOT NULL,
  PRIMARY KEY (`Transaction_Number`,`Purpose`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purpose`
--


-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `Student_Number` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `First_Name` varchar(30) NOT NULL,
  `Middle_Initial` varchar(5) NOT NULL,
  `Course` varchar(10) NOT NULL,
  `Home_Address` varchar(50) NOT NULL,
  `Contact_Number` varchar(20) NOT NULL,
  `Mobile_Number` varchar(20) NOT NULL,
  `Email_Address` varchar(80) NOT NULL,
  PRIMARY KEY (`Student_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_Number`, `Last_Name`, `First_Name`, `Middle_Initial`, `Course`, `Home_Address`, `Contact_Number`, `Mobile_Number`, `Email_Address`) VALUES
('2008-11363', 'Laxinaa', 'Nathaniela', 'Sa', 'BSBIO', 'Manilaa', '09090909a', '09090909a', 'nat@hazel.loversa'),
('2008-11364', 'Laxinaa', 'Nathaniela', 'Sa', 'BSBIO', 'Manilaa', '09090909a', '09090909a', 'nat@hazel.loversa'),
('2008-11369', 'Laxina', 'Nathaniel', 'S', 'BSCHEM', 'Manila', '09090909', '09090909', 'nat@hazel.lovers'),
('2008-14391', 'Honrade', 'Lambert', 'B', 'BSCS', 'Lipa City', '09057240064', '999999', 'lbhonrade@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `Transaction_Number` varchar(30) NOT NULL,
  `Date_In` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Date_Out` date NOT NULL,
  `Student_Number` varchar(10) NOT NULL,
  `Classification` varchar(20) NOT NULL,
  `Course` varchar(20) NOT NULL,
  `Service_Needed` varchar(30) NOT NULL,
  `Number_Of_Copies` int(2) NOT NULL,
  `Amount` decimal(5,0) NOT NULL,
  `Receipt_Number` varchar(20) DEFAULT NULL,
  `Status` varchar(20) NOT NULL,
  `Received_By` varchar(30) DEFAULT NULL,
  `Performed_By` int(11) DEFAULT NULL,
  PRIMARY KEY (`Transaction_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`Transaction_Number`, `Date_In`, `Date_Out`, `Student_Number`, `Classification`, `Course`, `Service_Needed`, `Number_Of_Copies`, `Amount`, `Receipt_Number`, `Status`, `Received_By`, `Performed_By`) VALUES
('CAS-OCS-03-04-2011-0001', '2011-03-04 09:22:20', '0000-00-00', '', '', '', '', 0, '0', NULL, '', NULL, NULL),
('CAS-OCS-03-04-2011-0002', '2011-03-04 09:22:20', '0000-00-00', '', '', '', '', 0, '0', NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Role` varchar(10) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `Role`) VALUES
('2000-00001', '861613f5a80abdf5a15ea283daa64be3', 'alumni'),
('2000-00002', '861613f5a80abdf5a15ea283daa64be3', 'alumni'),
('2008-11369', '861613f5a80abdf5a15ea283daa64be3', 'student'),
('2008-14391', '861613f5a80abdf5a15ea283daa64be3', 'student'),
('admin_win01', '861613f5a80abdf5a15ea283daa64be3', 'admin'),
('admin_win02', '861613f5a80abdf5a15ea283daa64be3', 'admin'),
('admin_win03', '861613f5a80abdf5a15ea283daa64be3', 'admin'),
('admin_win04', '861613f5a80abdf5a15ea283daa64be3', 'admin'),
('admin_win05', '861613f5a80abdf5a15ea283daa64be3', 'admin'),
('admin_win06', '861613f5a80abdf5a15ea283daa64be3', 'admin');
