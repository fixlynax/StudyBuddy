-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 09:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studybuddysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseID` int(11) NOT NULL,
  `courseName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `courseName`) VALUES
(1, 'Faculty Computing'),
(2, 'Faculty Mechanical'),
(3, 'Faculty Electrical');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `messageText` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `ratingID` int(11) NOT NULL,
  `studentID` int(11) DEFAULT NULL,
  `pointRating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`ratingID`, `studentID`, `pointRating`) VALUES
(5, 3, 0),
(8, 2, 0),
(9, 4, 0),
(10, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reportissue`
--

CREATE TABLE `reportissue` (
  `reportIssueID` int(11) NOT NULL,
  `reportBy` int(11) NOT NULL,
  `reportType` varchar(50) NOT NULL,
  `reportDescription` text NOT NULL,
  `reportPicture` varchar(255) NOT NULL,
  `reportDate` datetime NOT NULL,
  `resolveDate` datetime DEFAULT NULL,
  `reportStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `resourceID` int(11) NOT NULL,
  `uploadBy` int(11) DEFAULT NULL,
  `topicResource` varchar(255) DEFAULT NULL,
  `categoryResource` varchar(255) DEFAULT NULL,
  `descResource` text DEFAULT NULL,
  `fileResource` varchar(255) DEFAULT NULL,
  `dateResource` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stdID` int(11) NOT NULL,
  `userType` varchar(50) DEFAULT NULL,
  `stdPicture` varchar(255) DEFAULT NULL,
  `stdName` varchar(255) DEFAULT NULL,
  `stdMatric` varchar(255) DEFAULT NULL,
  `stdEmail` varchar(255) DEFAULT NULL,
  `stdPassword` varchar(255) DEFAULT NULL,
  `stdMajor` varchar(255) DEFAULT NULL,
  `stdCourse` varchar(255) DEFAULT NULL,
  `stdCGPA` decimal(3,2) DEFAULT NULL,
  `stdStatus` varchar(50) DEFAULT NULL,
  `stdOnline` varchar(50) DEFAULT NULL,
  `stdAccDate` date DEFAULT NULL,
  `stdStatusAcc` varchar(50) DEFAULT NULL,
  `descStatus` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stdID`, `userType`, `stdPicture`, `stdName`, `stdMatric`, `stdEmail`, `stdPassword`, `stdMajor`, `stdCourse`, `stdCGPA`, `stdStatus`, `stdOnline`, `stdAccDate`, `stdStatusAcc`, `descStatus`) VALUES
(1, 'Admin', 'Images/profile3.jpg', 'Admin', 'NULL', 'admin@studybuddy.com', 'admin123', 'NULL', 'NULL', 0.00, 'Active', 'Offline', '2024-06-07', 'Active', NULL),
(2, 'Student', 'Images/profile2.jpg', 'Muhammad Hafizuddin', 'CB21159', 'hdin1464@gmail.com', 'din123', 'Software Engineering', 'Faculty Computing', 3.60, 'Active', 'Offline', '2024-06-07', 'Active', 'hehehhe'),
(3, 'Student', 'Images/profile1.jpg', 'Siti NurBalqis', 'CB21152', 'sitinurbalqis1001@gmail.com', 'siti12345', 'Networking', 'Faculty Electrical', 3.80, 'Active', 'Offline', '2024-06-07', 'Active', NULL),
(4, 'Student', NULL, 'Halimatul Huda', NULL, 'halimatulhuda01@gmail.com', 'huda1234', NULL, NULL, NULL, NULL, 'Offline', '2024-05-30', 'Active', NULL),
(9, 'Student', NULL, 'Ahmad Sufian', NULL, 'pianburp01@gmail.com', 'pian1234', NULL, NULL, NULL, NULL, 'Offline', '2024-05-30', 'Deactivate', 'Account has been deactivated by own user'),
(10, 'Student', NULL, 'Muhammad Afiq Hasif', NULL, 'afiqhasf01@gmail.com', 'afiq1234', NULL, NULL, NULL, NULL, 'Offline', '2024-06-03', 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studygroup`
--

CREATE TABLE `studygroup` (
  `studyGroupID` int(11) NOT NULL,
  `studyGroupName` varchar(255) NOT NULL,
  `studyGroupType` varchar(255) NOT NULL,
  `studyGroupSubject` int(11) NOT NULL,
  `studyGroupDescription` text NOT NULL,
  `studyGroupTime` time NOT NULL,
  `studyGroupDate` date NOT NULL,
  `studyGroupPartner` int(11) NOT NULL,
  `studyGroupStatus` varchar(255) NOT NULL,
  `rateStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studypartner`
--

CREATE TABLE `studypartner` (
  `studyPartnerID` int(11) NOT NULL,
  `studyPartnerBy` int(11) DEFAULT NULL,
  `studyPartnerWith` int(11) NOT NULL,
  `studyPartnerSubject` int(11) DEFAULT NULL,
  `studyPartnerAction` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studypartner`
--

INSERT INTO `studypartner` (`studyPartnerID`, `studyPartnerBy`, `studyPartnerWith`, `studyPartnerSubject`, `studyPartnerAction`) VALUES
(35, 2, 3, 3, 'Accepted'),
(36, 3, 2, 1, 'Accepted'),
(37, 2, 3, 7, 'Accepted'),
(38, 3, 2, 2, 'Accepted'),
(39, 3, 2, 8, 'Accepted'),
(40, 2, 3, 4, 'Rejected'),
(41, 3, 2, 10, 'Accepted'),
(42, 2, 3, 11, 'Accepted'),
(43, 3, 2, 13, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `studysubject`
--

CREATE TABLE `studysubject` (
  `studySubjectID` int(11) NOT NULL,
  `subjectBy` int(11) DEFAULT NULL,
  `subjectName` varchar(255) DEFAULT NULL,
  `descriptionStudy` text DEFAULT NULL,
  `scheduleStudy` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectID` int(11) NOT NULL,
  `subjectMajor` varchar(255) DEFAULT NULL,
  `subjectName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectID`, `subjectMajor`, `subjectName`) VALUES
(1, 'Faculty Computing', 'Software Project Management'),
(2, 'Faculty Computing', 'Software Quality Assurance'),
(3, 'Faculty Computing', 'Software Evolution Maintenance'),
(4, 'Faculty Computing', 'Software Engineering Practice'),
(5, 'Faculty Computing', 'Object Oriented Programming'),
(6, 'Faculty Computing', 'Web Engineering'),
(7, 'Faculty Computing', 'System Analysis & Design'),
(8, 'Faculty Computing', 'Computer Graphics'),
(9, 'Faculty Computing', '3D Modeling'),
(10, 'Faculty Computing', 'Data Enginnering'),
(11, 'Faculty Computing', 'Mobile Application Development'),
(12, 'Faculty Computing', 'Machine Learning Application'),
(13, 'Faculty Computing', 'WAN Technology'),
(14, 'Faculty Computing', 'Data Communication'),
(15, 'Faculty Computing', 'Data Network Security'),
(16, 'Faculty Mechanical', 'System Heat Applied'),
(17, 'Faculty Computing', 'Formal Method'),
(18, 'Faculty Computing', 'Software engineering'),
(19, 'Faculty Electrical', 'Applied Electrical & Application'),
(20, 'Faculty Industry Management', 'Finance Management'),
(21, 'Faculty Electrical', 'Circuit Analysis 1'),
(22, 'Faculty Electrical', 'Digital Electronics'),
(23, 'Faculty Electrical', 'Measurement Technology'),
(24, 'Faculty Electrical', 'Circuit Analysis 2'),
(25, 'Faculty Electrical', 'Electrical Power Systems'),
(26, 'Faculty Electrical', 'Programmable Logic Controller'),
(27, 'Faculty Electrical', 'Maintenance Technology'),
(28, 'Faculty Electrical', 'Electro Pneumatic'),
(29, 'Faculty Electrical', 'Occupational Safety and Health');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`ratingID`);

--
-- Indexes for table `reportissue`
--
ALTER TABLE `reportissue`
  ADD PRIMARY KEY (`reportIssueID`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`resourceID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stdID`);

--
-- Indexes for table `studygroup`
--
ALTER TABLE `studygroup`
  ADD PRIMARY KEY (`studyGroupID`);

--
-- Indexes for table `studypartner`
--
ALTER TABLE `studypartner`
  ADD PRIMARY KEY (`studyPartnerID`);

--
-- Indexes for table `studysubject`
--
ALTER TABLE `studysubject`
  ADD PRIMARY KEY (`studySubjectID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `ratingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reportissue`
--
ALTER TABLE `reportissue`
  MODIFY `reportIssueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `resourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `studygroup`
--
ALTER TABLE `studygroup`
  MODIFY `studyGroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `studypartner`
--
ALTER TABLE `studypartner`
  MODIFY `studyPartnerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `studysubject`
--
ALTER TABLE `studysubject`
  MODIFY `studySubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
