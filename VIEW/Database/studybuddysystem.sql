-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 11:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(3, 'Faculty Electrical'),
(4, 'Faculty Industry Management');

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

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `senderID`, `receiverID`, `messageText`, `timestamp`) VALUES
(1, 3, 2, 'hai', '2024-05-26 20:16:43'),
(2, 3, 2, 'nanti study bawah nota slide madam ye sebab saya punya member pinjam', '2024-05-26 20:16:49'),
(3, 2, 3, 'hai', '2024-05-26 20:26:49'),
(4, 2, 3, 'assalmaulaiakum', '2024-05-26 20:27:01'),
(5, 3, 3, 'hai', '2024-05-26 20:28:01'),
(6, 2, 3, 'hai', '2024-05-27 07:42:39'),
(7, 3, 2, 'saya nak awak', '2024-05-27 07:55:16'),
(8, 3, 2, 'hafiz', '2024-05-27 07:56:39'),
(9, 3, 2, 'hahahahha', '2024-05-27 07:56:54'),
(10, 3, 2, 'hai', '2024-05-27 08:37:12'),
(11, 2, 3, 'saya nak awak jugak', '2024-05-28 12:16:18'),
(12, 3, 2, 'yeke awak ni nak saya', '2024-05-28 12:17:02');

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
(5, 3, 240);

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

--
-- Dumping data for table `reportissue`
--

INSERT INTO `reportissue` (`reportIssueID`, `reportBy`, `reportType`, `reportDescription`, `reportPicture`, `reportDate`, `resolveDate`, `reportStatus`) VALUES
(1, 2, 'feature', 'Add dark mode feature', 'Images/6e9e1d9bcd5ada830016e13b17e528f4.jpg', '2024-05-15 09:43:49', NULL, 'On Hold'),
(2, 3, 'bug', 'Issue with login functionality', 'Images/b515d85096c5784c193b256ff054c2bd.jpg', '2024-05-15 09:44:32', '2024-05-28 14:11:01', 'Resolved');

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

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`resourceID`, `uploadBy`, `topicResource`, `categoryResource`, `descResource`, `fileResource`, `dateResource`) VALUES
(2, 2, 'Software Quality Assurance', 'Faculty Computing', 'Chapter 3', 'Files/MY PSM SUGGESTION TOPIC.pdf', '2024-05-15'),
(4, 2, 'Software Quality Assurance', 'Faculty Mechanical', 'For test', 'Files/Resume_AfiqHasif (1).pdf', '2024-05-31'),
(5, 2, 'Chapter 1 OOP', 'Faculty Computing - Object Oriented Programming', 'Sir hafiz ', 'Files/Student Integrity Form-BCS3133.pdf', '2024-06-01');

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
(1, 'Admin', 'Images/profile3.jpg', 'Admin', 'NULL', 'admin@studybuddy.com', 'admin123', 'NULL', 'NULL', 0.00, 'Active', 'Offline', '2024-06-01', 'Active', NULL),
(2, 'Student', 'Images/profile2.jpg', 'Muhammad Hafizuddin', 'CB21159', 'hdin1464@gmail.com', 'din123', 'Software Engineering', 'Faculty Computing', 3.60, 'Active', 'Online', '2024-06-01', 'Active', 'hehehhe'),
(3, 'Student', 'Images/profile1.jpg', 'Siti NurBalqis', 'CB21152', 'sitinurbalqis1001@gmail.com', 'siti12345', 'Networking', 'Faculty Computing', 3.80, 'Active', 'Offline', '2024-06-01', 'Active', NULL),
(4, 'Student', NULL, 'Halimatul Huda', NULL, 'halimatulhuda@gmail.com', 'huda123', NULL, NULL, NULL, NULL, 'Offline', '2024-05-30', 'Active', NULL),
(9, 'Student', NULL, 'test', NULL, 'test123@gmail.com', 'abc123', NULL, NULL, NULL, NULL, 'Offline', '2024-05-30', 'Deactivate', 'Account has been deactivated by own user');

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

--
-- Dumping data for table `studygroup`
--

INSERT INTO `studygroup` (`studyGroupID`, `studyGroupName`, `studyGroupType`, `studyGroupSubject`, `studyGroupDescription`, `studyGroupTime`, `studyGroupDate`, `studyGroupPartner`, `studyGroupStatus`, `rateStatus`) VALUES
(5, 'Study Group Test', 'Zoom', 7, 'hahaha', '12:48:00', '2024-05-26', 3, 'Done', 'Undone'),
(6, 'Study Group Test3', 'Microsoft Team', 3, 'vjguvuib ', '16:02:00', '2024-05-28', 3, 'Delay', NULL),
(7, 'Study group 2', 'Microsoft Team', 8, 'qsdwcxrgbthyjmfcghfbmnim,jkmn ', '21:00:00', '2024-06-08', 2, 'Pending', NULL),
(8, 'Study Group Test 4', 'Meet Up at library', 1, 'Study until die', '23:21:00', '2024-06-20', 2, 'Pending', NULL);

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
(40, 2, 3, 4, 'Rejected');

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

--
-- Dumping data for table `studysubject`
--

INSERT INTO `studysubject` (`studySubjectID`, `subjectBy`, `subjectName`, `descriptionStudy`, `scheduleStudy`) VALUES
(1, 2, 'Object Oriented Programming', 'Study chapter 1 until chapter 5 for HOT ', '2024-05-31'),
(2, 2, 'Web Engineering', 'Study for Midterm', '2024-06-28'),
(3, 3, 'Object Oriented Programming', 'Study for HOT', '2024-05-28'),
(4, 3, 'Software Project Management', 'study', '2024-06-28'),
(6, 2, 'Software Evolution Maintenance', 'Study', '2024-06-15'),
(7, 3, 'Data Enginnering', 'Test', '2024-06-15'),
(8, 2, 'Mobile Application Development', 'Test', '2024-05-31'),
(9, 2, 'Computer Graphics', 'Study for do the final project ', '2024-06-06');

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
(20, 'Faculty Industry Management', 'Finance Management');

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
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `ratingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reportissue`
--
ALTER TABLE `reportissue`
  MODIFY `reportIssueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `resourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `studygroup`
--
ALTER TABLE `studygroup`
  MODIFY `studyGroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `studypartner`
--
ALTER TABLE `studypartner`
  MODIFY `studyPartnerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `studysubject`
--
ALTER TABLE `studysubject`
  MODIFY `studySubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
