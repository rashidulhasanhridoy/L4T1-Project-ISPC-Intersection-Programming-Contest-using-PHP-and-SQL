-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2020 at 08:06 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ispc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE `admininfo` (
  `Name` varchar(100) NOT NULL,
  `ID` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `JoinDate` varchar(100) NOT NULL,
  `Request` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`Name`, `ID`, `UserName`, `Gender`, `Email`, `PhoneNumber`, `Password`, `JoinDate`, `Request`) VALUES
('Md. Tarek Habib', '7834004', 'tarek', 'Male', 'tarek.cse@gmail.com', '01743123451', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '1'),
('SAH', '7834000', 'sah', 'Male', 'sah@diu.edu.bd', '01743123434', '827ccb0eea8a706c4c34a16891f84e7b', '03/21/2020', '1'),
('Nurul Kabair', '78340006', 'nurul', 'Male', 'nurul.cse@diu.edu.bd', '01743123412', '827ccb0eea8a706c4c34a16891f84e7b', '03/22/2020', '1'),
('Sajal Rahman', '783400045', 'sajal', 'Male', 'sajal.cse@diu.edu.bd', '01521332211', '81dc9bdb52d04dc20036dbd8313ed055', '03/22/2020', '0'),
('Arman Rahman', '76541234', 'arman', 'Male', 'arman@diu.edu.bd', '01612121313', '827ccb0eea8a706c4c34a16891f84e7b', '03/22/2020', '1');

-- --------------------------------------------------------

--
-- Table structure for table `advisorinfo`
--

CREATE TABLE `advisorinfo` (
  `Name` varchar(110) NOT NULL,
  `ID` varchar(110) NOT NULL,
  `UserName` varchar(110) NOT NULL,
  `Gender` varchar(110) NOT NULL,
  `Email` varchar(110) NOT NULL,
  `PhoneNumber` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `JoinDate` varchar(100) NOT NULL,
  `Request` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advisorinfo`
--

INSERT INTO `advisorinfo` (`Name`, `ID`, `UserName`, `Gender`, `Email`, `PhoneNumber`, `Password`, `JoinDate`, `Request`) VALUES
('Saiful Islam', '7834001', 'saiful', 'Male', 'saiful.cse@diu.edu.bd', '01301121212', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '1'),
('Tushar Hasan', '7834002', 'tushar', 'Male', 'tushar.cse@diu.edu.bd', '01743123451', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '1'),
('Fahad Rahman', '7834003', 'faisal', 'Male', 'faisal.cse@diu.edu.bd', '01977230000', '827ccb0eea8a706c4c34a16891f84e7b', '03/21/2020', '1'),
('Sharmin Jahan', '65001234', 'sharmin', 'Female', 'sharmin.cse@diu.edu.bd', '01521334465', '81dc9bdb52d04dc20036dbd8313ed055', '03/22/2020', '1');

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `Name` varchar(100) NOT NULL,
  `ID` varchar(100) NOT NULL,
  `Semester` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `Fee` varchar(100) NOT NULL,
  `Access` varchar(100) NOT NULL,
  `CreateDate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`Name`, `ID`, `Semester`, `Date`, `Fee`, `Access`, `CreateDate`) VALUES
('ISPC Spring 2020', '20201', 'Spring2020', '26/04/2020', '200', '1', '03/22/2020');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `UserName` varchar(100) NOT NULL,
  `L1` varchar(100) NOT NULL,
  `L2` varchar(100) NOT NULL,
  `L3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`UserName`, `L1`, `L2`, `L3`) VALUES
('hridoy', 'C#', 'C++', 'PHP'),
('monisha', 'Java', 'C++', 'C#'),
('malek', 'C', 'PHP', 'Java'),
('alkuma', 'C', 'PHP', 'Java');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `Name` varchar(100) NOT NULL,
  `ID` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Batch` varchar(100) NOT NULL,
  `Section1` varchar(100) NOT NULL,
  `Section2` varchar(100) NOT NULL,
  `Section3` varchar(100) NOT NULL,
  `Section4` varchar(100) NOT NULL,
  `Section5` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`Name`, `ID`, `UserName`, `Batch`, `Section1`, `Section2`, `Section3`, `Section4`, `Section5`) VALUES
('Saiful Islam', '7834001', 'saiful', '49', 'A', 'B', 'C', 'D', 'E'),
('Tushar Hasan', '7834002', 'tushar', '48', 'F', 'G', 'H', 'I', 'G'),
('Fahad Rahman', '7834003', 'faisal', '46', 'A', 'B', 'C', 'D', 'E'),
('Sharmin Jahan', '65001234', 'sharmin', '46', 'F', 'G', 'H', 'I', 'J');

-- --------------------------------------------------------

--
-- Table structure for table `studentinfo`
--

CREATE TABLE `studentinfo` (
  `ID` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(100) NOT NULL,
  `Batch` varchar(100) NOT NULL,
  `Section` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `JoinDate` varchar(100) NOT NULL,
  `Request` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentinfo`
--

INSERT INTO `studentinfo` (`ID`, `Name`, `Gender`, `UserName`, `Email`, `PhoneNumber`, `Batch`, `Section`, `Password`, `JoinDate`, `Request`) VALUES
('171-15-8596', 'Rashidul Hasan Hridoy', 'Male', 'hridoy', 'rashidul15-8596@diu.edu.bd', '01714969317', '46', 'E', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '1'),
('171-15-8597', 'Mudakherunnessa Monisha', 'Female', 'monisha', 'mudakherunnessa15-8597@diu.edu.bd', '01521305101', '46', 'E', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '1'),
('171-15-8752', 'Md. Addul Malek', 'Male', 'malek', 'malek8752@diu.edu.bd', '01521305102', '46', 'E', '827ccb0eea8a706c4c34a16891f84e7b', '03/21/2020', '1'),
('171-15-8582', 'Alkuma Akther', 'Female', 'alkuma', 'alkuma15-8582@diu.edu.bd', '01521305103', '46', 'E', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '1'),
('181-15-8899', 'Mufi Ahamed', 'Male', 'mufi', 'mufi15-8899@gmail.com', '01521305105', '49', 'D', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '0'),
('181-15-8452', 'Asif Riad', 'Male', 'asif', 'asif15-8452@diu.edu.bd', '01714969319', '49', 'D', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '1'),
('191-15-8765', 'Arafat Raihan', 'Male', 'arafat', 'arafat15-8765@diu.edu.bd', '01714969313', '48', 'F', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '0'),
('191-15-8531', 'Raihan Karim', 'Male', 'raihan', 'raihan15-8531@diu.edu.bd', '01521305109', '48', 'F', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '1'),
('171-15-8877', 'Maisha Rahman', 'Female', 'maisha', 'maisha15-8877@diu.edu.bd', '01714969322', '46', 'A', '81dc9bdb52d04dc20036dbd8313ed055', '03/21/2020', '1');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `TeamName` varchar(110) NOT NULL,
  `TeamID` varchar(110) NOT NULL,
  `Member1` varchar(110) NOT NULL,
  `ID1` varchar(100) NOT NULL,
  `UserName1` varchar(110) NOT NULL,
  `Member2` varchar(110) NOT NULL,
  `ID2` varchar(100) NOT NULL,
  `UserName2` varchar(110) NOT NULL,
  `Batch` varchar(110) NOT NULL,
  `Section` varchar(110) NOT NULL,
  `CreatingDate` varchar(110) NOT NULL,
  `Request` varchar(10) NOT NULL,
  `Approve` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`TeamName`, `TeamID`, `Member1`, `ID1`, `UserName1`, `Member2`, `ID2`, `UserName2`, `Batch`, `Section`, `CreatingDate`, `Request`, `Approve`) VALUES
('Six', '1761917695', 'Rashidul Hasan Hridoy', '171-15-8596', 'hridoy', 'Mudakherunnessa Monisha', '171-15-8597', 'monisha', '46', 'E', '03/22/2020', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `UserName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`UserName`, `Email`, `ID`) VALUES
('hridoy', 'rashidul15-8596@diu.edu.bd', '171-15-8596'),
('monisha', 'mudakherunnessa15-8597@diu.edu.bd', '171-15-8597'),
('malek', 'malek8752@diu.edu.bd', '171-15-8752'),
('alkuma', 'alkuma15-8582@diu.edu.bd', '171-15-8582'),
('mufi', 'mufi15-8899@gmail.com', '181-15-8899'),
('asif', 'asif15-8452@diu.edu.bd', '181-15-8452'),
('arafat', 'arafat15-8765@diu.edu.bd', '191-15-8765'),
('raihan', 'raihan15-8531@diu.edu.bd', '191-15-8531'),
('maisha', 'maisha15-8877@diu.edu.bd', '171-15-8877'),
('saiful', 'saiful.cse@diu.edu.bd', '7834001'),
('tushar', 'tushar.cse@diu.edu.bd', '7834002'),
('faisal', 'faisal.cse@diu.edu.bd', '7834003'),
('tarek', 'tarek.cse@gmail.com', '7834004'),
('sah', 'sah@diu.edu.bd', '7834000'),
('nurul', 'nurul.cse@gmail.com', '78340006'),
('sajal', 'sajal.cse@diu.edu.bd', '783400045'),
('arman', 'arman@gmail.com', '76541234'),
('sharmin', 'sharmin.cse@diu.edu.bd', '65001234');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
