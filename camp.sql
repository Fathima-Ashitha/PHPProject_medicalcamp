-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 03, 2025 at 07:09 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camp`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `cid` int(5) NOT NULL,
  `pid` int(5) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`cid`, `pid`, `date`, `time`) VALUES
(1, 1, '2024-11-28', '09:30:00'),
(1, 2, '2024-11-28', '10:50:00'),
(4, 2, '2025-01-03', '11:10:00'),
(4, 1, '2025-01-03', '11:20:00'),
(2, 1, '2025-01-05', '11:10:00'),
(2, 1, '2025-01-06', '11:00:00'),
(2, 2, '2025-01-05', '11:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `camps`
--

CREATE TABLE `camps` (
  `cid` int(5) NOT NULL,
  `cname` varchar(50) DEFAULT NULL,
  `loc` varchar(30) DEFAULT NULL,
  `specialisation` varchar(30) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `startt` time DEFAULT NULL,
  `endt` time DEFAULT NULL,
  `doctor` varchar(30) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `camps`
--

INSERT INTO `camps` (`cid`, `cname`, `loc`, `specialisation`, `phone`, `start`, `end`, `startt`, `endt`, `doctor`, `password`, `description`) VALUES
(1, 'KARUNYA MEDICAL CAMP', 'ALUVA', 'ENT CAMP', '1209781209', '2024-11-27', '2024-11-29', '09:00:00', '14:30:00', 'DR.SHAHANA MBBS', '1234', 'SPONSERED BY MAJ HOSPITAL,KOCHI'),
(2, 'MEGA MEDICAL CAMP', 'PERUMBAVOOR', 'CANCER CAMP', '1234567899', '2025-01-05', '2025-01-07', '11:00:00', '16:00:00', 'Dr.DEVU MBBS,MD', '0000', 'SPONSERED BY WELFARE CLUB,PERUMBAVOOR'),
(3, 'KARUNYA MEDICAL CAMP', 'ALUVA', 'DENTAL CAMP', '6665556662', '2025-01-29', '2025-01-31', '07:00:00', '14:00:00', 'DR.KALIDAS MBBS', '1111', 'SPONSERED BY MAJ HOSPITAL,KOCHI'),
(4, 'TRIBAL MEDICAL CAMP', 'LONALAVA', 'CARDIOLOGY CAMP', '0099009900', '2025-01-03', '2025-01-04', '11:00:00', '17:00:00', 'DR.SREETHUMOL MBBS', '1234', '        SPONSERED BY SWITCH INDIA'),
(5, 'DR.PAULS DENTAL CAMP', 'ALUVA', 'DENTAL CAMP', '2288771100', '2025-02-12', '2025-02-14', '16:30:00', '18:30:00', 'DR.PAULS MDS', '0000', 'SPONSERED BY DR.PAULS DENTAL CLINIC COMPANYPPADY        ');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `cid` int(5) NOT NULL,
  `pid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`cid`, `pid`, `name`, `age`, `gender`, `phone`, `address`, `email`, `password`) VALUES
(1, 1, 'anju', 30, 'female', '4433443344', 'kunnathukara', 'anju@gmail.com', '1234'),
(2, 1, 'noora', 28, 'female', '0002229999', 'paravur', 'noora@gmail.com', '1111'),
(1, 2, 'kamal', 55, 'male', '2223332223', 'Edappally', 'kamal@gmail.com', '1234'),
(4, 1, 'Ramani', 50, 'female', '1231231231', 'kozhikode', 'ramani@gmail.com', 'ramani'),
(1, 3, 'sarayu', 28, 'female', '7676767777', 'kochi', 'sarayu@gmail.com', '1234'),
(4, 2, 'achu', 20, 'female', '1199885522', 'kunnunnikara', 'achu@gmail.com', '0000'),
(4, 3, 'kunjon', 45, 'male', '1122334455', 'paravur', 'kunjon@gmail.com', '0000'),
(5, 1, 'andrea', 25, 'female', '0988966524', 'aluva', 'andrea@gmail.com', '1234'),
(1, 4, 'asiya', 20, 'female', '4727474747', 'aluva', 'asiya@gmail.com', '0000'),
(2, 2, 'angel', 25, 'female', '1144337755', 'chowara', 'angel@gmail.com', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `cid` int(5) NOT NULL,
  `sid` int(5) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`cid`, `sid`, `sname`, `email`, `password`, `phone`, `address`) VALUES
(1, 1, 'Shalini', 'shalini@gmail.com', '1234', '1234567664', 'kuttammassery'),
(1, 2, 'sulfiya', 'sulfiya@gmail.com', '1234', '2131234311', 'palarivattom'),
(4, 1, 'Mother Theresa', 'theresa@gmail.com', 'theresa', '4343434343', 'Germany'),
(2, 1, 'sherin', 'sherin@gmail.com', '0000', '6655665566', 'marampally,aluva'),
(4, 2, 'farisa', 'farisa@gmail.com', '0000', '1122996644', 'kunnunnikara'),
(5, 1, 'ajmi', 'ajmi@gmail.com', '1234', '1122112210', 'nettoor');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `cid` int(5) NOT NULL,
  `sid` int(5) NOT NULL,
  `pid` int(5) NOT NULL,
  `date` date NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`cid`, `sid`, `pid`, `date`, `result`) VALUES
(1, 1, 1, '2024-11-28', 'result1.png'),
(1, 1, 2, '2024-11-28', 'result2.png'),
(4, 2, 2, '2025-01-03', 'result3.png'),
(4, 2, 1, '2025-01-03', 'result2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `camps`
--
ALTER TABLE `camps`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD KEY `cid` (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `camps`
--
ALTER TABLE `camps`
  MODIFY `cid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `camps` (`cid`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `camps` (`cid`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `camps` (`cid`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `camps` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
