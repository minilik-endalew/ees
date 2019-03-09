-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2014 at 06:20 AM
-- Server version: 5.5.34
-- PHP Version: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
CREATE Database `aau_pgees`;
USE `aau_pgees`;
--

-- --------------------------------------------------------

--
-- Table structure for table `choice`
--

CREATE TABLE IF NOT EXISTS `choice` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Question` int(11) NOT NULL,
  `Choice_label` enum('A','B','C','D','E','F','H','I') NOT NULL,
  `Choice` text NOT NULL,
  `Answer` enum('Yes','No') NOT NULL,
  `Type` enum('Multiple','Unique') NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Question` (`Question`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=152 ;

--
-- Dumping data for table `choice`
--

INSERT INTO `choice` (`ID`, `Question`, `Choice_label`, `Choice`, `Answer`, `Type`) VALUES
(9, 4, 'A', 'mustn''t have ', 'No', 'Unique'),
(10, 4, 'B', 'wasn''t have ', 'No', 'Unique'),
(11, 4, 'C', 'can''t have ', 'Yes', 'Unique'),
(12, 9, 'A', 'Everybody ', '', 'Unique'),
(13, 9, 'B', 'Anybody ', '', 'Unique'),
(14, 9, 'C', 'Anyone ', '', 'Unique'),
(15, 10, 'A', 'fixed my computer ', '', 'Unique'),
(16, 10, 'B', 'my computer fixed', '', 'Unique'),
(17, 10, 'C', 'my computer fix ', '', 'Unique'),
(21, 12, 'A', '4', 'Yes', 'Unique'),
(22, 12, 'B', '5', 'No', 'Unique'),
(23, 12, 'C', '6', 'No', 'Unique'),
(24, 12, 'D', '7', 'No', 'Unique'),
(25, 12, 'E', '8', 'No', 'Unique'),
(26, 13, 'A', 'ac', 'Yes', 'Unique'),
(27, 13, 'B', 'bc', 'No', 'Unique'),
(28, 13, 'C', 'cc', 'No', 'Unique'),
(29, 14, 'A', 'aa', 'Yes', 'Unique'),
(30, 14, 'B', 'bb', 'No', 'Unique'),
(31, 14, 'C', 'cc', 'No', 'Unique'),
(32, 15, 'A', 'themself ', 'Yes', 'Unique'),
(33, 15, 'B', 'themselves', 'No', 'Unique'),
(34, 15, 'C', 'theirselves ', 'No', 'Unique'),
(35, 16, 'A', 'aa', 'Yes', 'Unique'),
(36, 16, 'B', 'bb', 'No', 'Unique'),
(37, 16, 'C', 'cc', 'No', 'Unique'),
(38, 17, 'A', 'choice 1', 'No', 'Unique'),
(39, 17, 'B', 'chioice 2', 'No', 'Unique'),
(40, 17, 'C', 'chioice 3', 'No', 'Unique'),
(41, 17, 'D', 'choice 4', 'Yes', 'Unique'),
(42, 17, 'E', 'choice 5', 'No', 'Unique'),
(43, 18, 'A', 'one', 'No', 'Unique'),
(44, 18, 'B', 'two', 'No', 'Unique'),
(45, 18, 'C', 'three', 'No', 'Unique'),
(46, 18, 'D', 'four', 'Yes', 'Unique'),
(47, 19, 'A', 'one', 'Yes', 'Unique'),
(48, 19, 'B', 'two', 'Yes', 'Unique'),
(49, 19, 'C', 'three', 'Yes', 'Unique'),
(50, 19, 'D', 'four', 'No', 'Unique'),
(51, 20, 'A', 'aa', 'No', 'Unique'),
(52, 20, 'B', 'cc', 'No', 'Unique'),
(53, 20, 'C', 'vvv', 'Yes', 'Unique'),
(54, 20, 'D', 'rr', 'No', 'Unique'),
(55, 21, 'A', 'pp', 'No', 'Unique'),
(56, 21, 'B', 'iiii', 'No', 'Unique'),
(57, 21, 'C', 'uuu', 'No', 'Unique'),
(58, 21, 'D', 'yyyy', 'Yes', 'Unique'),
(59, 22, 'A', 'www', 'No', 'Unique'),
(60, 22, 'B', 'eee', 'No', 'Unique'),
(61, 22, 'C', 'ttt', 'Yes', 'Unique'),
(62, 22, 'D', '3ee', 'No', 'Unique'),
(63, 23, 'A', 'kkk', 'No', 'Unique'),
(64, 23, 'B', 'mmmm', 'Yes', 'Unique'),
(65, 23, 'C', 'uuuu', 'No', 'Unique'),
(66, 23, 'D', 'hhhh', 'Yes', 'Unique'),
(92, 2, 'A', 'which', 'No', 'Unique'),
(93, 2, 'B', 'that', 'Yes', 'Unique'),
(94, 2, 'C', 'who', 'No', 'Unique'),
(101, 26, 'A', 'this', 'No', 'Unique'),
(102, 26, 'B', 'that', 'Yes', 'Unique'),
(103, 26, 'C', 'their', 'No', 'Unique'),
(111, 50, 'A', 'true', 'Yes', 'Unique'),
(112, 50, 'B', 'false', 'No', 'Unique'),
(113, 50, 'C', 'ture or false', 'No', 'Unique'),
(114, 51, 'A', 'true', 'Yes', 'Unique'),
(115, 51, 'B', 'false', 'No', 'Unique'),
(116, 61, 'A', '-3', 'No', 'Unique'),
(117, 61, 'B', '2', 'No', 'Unique'),
(118, 61, 'C', '3', 'Yes', 'Unique'),
(119, 61, 'D', '-2', 'No', 'Unique'),
(120, 63, 'A', 'choice 1', 'No', 'Unique'),
(121, 63, 'B', 'choice 2', 'No', 'Unique'),
(122, 63, 'C', 'choice 3', 'Yes', 'Unique'),
(123, 63, 'D', 'choice 4', 'No', 'Unique'),
(129, 74, 'A', 'mircha 1', 'No', 'Unique'),
(130, 85, 'A', 'yiyo', 'Yes', 'Unique'),
(131, 86, 'A', 'rt', 'No', 'Unique'),
(132, 86, 'B', 'uh', 'Yes', 'Unique'),
(133, 87, 'A', 'gh', 'No', 'Unique'),
(134, 87, 'B', 'j', 'No', 'Unique'),
(135, 92, 'A', 'sdf', 'No', 'Unique'),
(136, 93, 'A', 'ww', 'No', 'Unique'),
(137, 93, 'B', 'ee', 'Yes', 'Unique'),
(138, 93, 'C', 'qq', 'No', 'Unique'),
(142, 95, 'A', 'sdf', 'No', 'Unique'),
(143, 11, 'A', 'here 1', 'No', 'Unique'),
(144, 11, 'B', 'where 1', 'Yes', 'Unique'),
(145, 11, 'C', 'There 1', 'No', 'Unique'),
(147, 1, 'A', 'go', 'No', 'Unique'),
(148, 1, 'B', 'went', 'Yes', 'Unique'),
(149, 1, 'C', 'goes', 'No', 'Unique'),
(150, 1, 'D', 'going', 'No', 'Unique'),
(151, 1, 'E', 'A and D', 'No', 'Unique');

-- --------------------------------------------------------

--
-- Table structure for table `examinee`
--

CREATE TABLE IF NOT EXISTS `examinee` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(100) NOT NULL,
  `Middle_Name` varchar(100) NOT NULL,
  `Last_Name` varchar(100) NOT NULL,
  `Sex` enum('Male','Female') NOT NULL,
  `Enrollment_Level` enum('Doctoral','Masters','Bachelors') NOT NULL,
  `E-mail` varchar(64) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Telephone` varchar(50) NOT NULL,
  `Academic_Year` year(4) NOT NULL,
  `Study_Subject` int(11) NOT NULL,
  `Confirmation_Code` varchar(50) NOT NULL,
  `Approved` enum('Yes','No') NOT NULL,
  `Exam` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Remark` text NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UserID` (`UserID`),
  KEY `Study_Subject` (`Study_Subject`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `examinee`
--

INSERT INTO `examinee` (`ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Sex`, `Enrollment_Level`, `E-mail`, `Password`, `Country`, `City`, `Telephone`, `Academic_Year`, `Study_Subject`, `Confirmation_Code`, `Approved`, `Exam`, `UserID`, `Remark`) VALUES
(1, 'Melaku', 'Tezera', 'Tomas', 'Male', 'Masters', 'melakuT@gmail.com', 'ffa0eddc7f349bde8b539b289ef2b04f', 'Ethiopia', 'Addis Ababa', '0911447852', 2014, 2, '', 'Yes', 1, NULL, ''),
(2, 'Lemlem', 'Hagos', 'Yihdego', 'Female', 'Doctoral', 'lemlem@gmail.com', 'aaf682be602c49a0c3fed2bece71fc39', 'Ethiopia', 'Addis Ababa', '0911223366', 2014, 1, '91d9c49d5e0c3c877b2f45002c780b91', 'No', 0, NULL, ''),
(3, 'tolosa', 'gemechis', 'gurmessa', 'Male', 'Masters', 'tola@yahoo.com', 'ad50ce09d2cae59102a31c1e6034fcb9', 'Ethiopia', 'Wollega', '0956231478', 2014, 1, '3ae292bf621a870b3b7480eea233737c', 'No', 0, NULL, ''),
(4, 'debesay', 'tekie', 'hagos', 'Male', 'Masters', 'debesay@yahoo.com', 'c5aefea68f20755f469c77a7e2717cbf', 'Ethiopia', 'Mekele', '01124587844', 2014, 1, '9c0fc4cee1cafa20d7af07820306e1d2', 'Yes', 1, NULL, ''),
(5, 'Zinash', 'Teklu', 'Tekola', 'Female', 'Masters', 'zin@yahoo.com', '7b8a5495fb3fab72e421fa5f1e80bb95', 'Ethiopia', 'Sekota', '0117565421', 2014, 1, 'c46c8e976294a5384dc605282897cd9c', 'No', 0, 6, ''),
(6, 'Munir', 'Jemal', 'Mussa', 'Male', 'Masters', 'munir@yahoo.com', 'ec83c3ce4c0288ad7868947965b8847c', 'Ethiopia', '', '0113565648', 2014, 1, 'b84cfd63a4f23bc5be39878a1b42c14b', 'Yes', 1, 7, '');

-- --------------------------------------------------------

--
-- Table structure for table `exam_plan`
--

CREATE TABLE IF NOT EXISTS `exam_plan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Exam_name` varchar(200) NOT NULL,
  `Question_Type` enum('English','Analytic','Mixed') NOT NULL,
  `Amount` int(11) NOT NULL,
  `Questions` text NOT NULL,
  `Time_for_single_question_in_minutes` int(11) NOT NULL,
  `Time_for_the_whole_exam` int(11) NOT NULL,
  `One_questioin_at_a_time` enum('Yes','No') NOT NULL,
  `Exam_Date` date NOT NULL,
  `Active` enum('Yes','No') NOT NULL DEFAULT 'No',
  `Remark` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Question_Type` (`Question_Type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `exam_plan`
--

INSERT INTO `exam_plan` (`ID`, `Exam_name`, `Question_Type`, `Amount`, `Questions`, `Time_for_single_question_in_minutes`, `Time_for_the_whole_exam`, `One_questioin_at_a_time`, `Exam_Date`, `Active`, `Remark`) VALUES
(1, 'Exam 1', 'English', 0, '18,19,20,21,22,23,26,', 0, 0, 'Yes', '0000-00-00', 'Yes', 'remark'),
(2, '', 'English', 0, '', 0, 0, '', '0000-00-00', 'Yes', ''),
(3, 'dfg', 'English', 0, '1,', 0, 0, 'Yes', '0000-00-00', 'Yes', 'fgd'),
(4, 'hhh', 'English', 0, '14,15,', 0, 0, 'Yes', '0000-00-00', 'Yes', 'bbb'),
(5, '', 'English', 5, '1,2,4,14,15,', 2, 45, 'No', '0000-00-00', 'Yes', 'remark'),
(6, 'Exam final', 'English', 5, '1,2,15,16,17,', 2, 45, 'Yes', '0000-00-00', 'Yes', 'Remark'),
(7, 'test k', 'Analytic', 6, '12,', 1, 11, 'No', '0000-00-00', 'Yes', 'only'),
(8, 'Analytic exam for computer science', 'Analytic', 5, '12,61,', 5, 50, 'Yes', '0000-00-00', 'Yes', ''),
(9, 'For 2014 Entrance', 'Mixed', 7, '1,2,4,9,12,15,61,', 2, 45, 'Yes', '0000-00-00', '', ''),
(10, 'ExamNameForDemo', 'Mixed', 10, '1,2,4,9,10,11,12,13,15,16,', 1, 50, 'Yes', '0000-00-00', '', 'test remark');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` enum('English','Analytic') NOT NULL,
  `Question` text NOT NULL,
  `Instructor` int(11) NOT NULL,
  `Remark` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Type` (`Type`),
  KEY `Instructor` (`Instructor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`ID`, `Type`, `Question`, `Instructor`, `Remark`) VALUES
(1, 'English', 'Abebe _____ to school everyday this is modified', 2, ''),
(2, 'English', 'Argentina, ________ is well-known for its mountains, is a very popular with ski-tourists.', 2, ''),
(4, 'English', 'He ________ gone to work yesterday. John was there all day and nobody saw him.', 2, ''),
(9, 'English', '_________ was at the party last night.', 2, ''),
(10, 'English', 'I must get _________ - I can''t use the internet at all.', 2, ''),
(11, 'English', 'test question 1', 2, ''),
(12, 'Analytic', '2x + 12 = 24, x=', 2, ''),
(13, 'English', 'asefr', 2, ''),
(14, 'English', 'szdf', 2, ''),
(15, 'English', 'The boys hurt ________ playing football in the park', 2, ''),
(16, 'English', 'sample', 2, ''),
(17, 'English', 'final question', 2, ''),
(18, 'English', 'test is a test question', 2, ''),
(19, 'English', 'test final', 2, ''),
(20, 'English', 'test', 2, ''),
(21, 'English', 'test question', 2, ''),
(22, 'English', 'test', 2, ''),
(23, 'English', 'this should be final', 2, ''),
(26, 'English', 'the car the mekina the coffee the bunna', 3, ''),
(50, 'English', 'this', 2, ''),
(51, 'English', 'final test', 2, ''),
(61, 'Analytic', 'Find the next number in the sequence: 48,-24,12,-6,?', 2, ''),
(63, 'English', 'this is a test question ______', 2, ''),
(74, 'English', 'another sample', 2, ''),
(85, 'English', 'ewewe', 2, ''),
(86, 'English', 'rty', 2, ''),
(87, 'English', 'uyuyu', 2, ''),
(91, 'English', 'sdf', 0, ''),
(92, 'English', 'sdf', 2, ''),
(93, 'English', 'cv', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Let_examinee_change_answer` enum('Yes','No') NOT NULL,
  `supervisor_can_delete_questioin` enum('Yes','No') NOT NULL,
  `System_auto_stop_exam_by_countdown` enum('Yes','No') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `study_subject`
--

CREATE TABLE IF NOT EXISTS `study_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `study_subject`
--

INSERT INTO `study_subject` (`ID`, `Subject`) VALUES
(1, 'Information Science'),
(2, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(100) NOT NULL,
  `Middle_Name` varchar(100) NOT NULL,
  `Last_Name` varchar(100) NOT NULL,
  `Roll` enum('Administrator','Instructor','Inspector','Examinee') NOT NULL,
  `Email` varchar(70) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Active` enum('Yes','No') NOT NULL,
  `Remark` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Roll`, `Email`, `User_Name`, `Password`, `Active`, `Remark`) VALUES
(1, 'Minilik', 'Tesfaye', 'Endalew', 'Administrator', '', 'millo', 'e8807c7ff903b7a584c7856863624d7d', 'Yes', ''),
(2, 'instFN', 'instMN', 'instLN', 'Instructor', '', 'inst', '183224d27b72b647391e179fa311b891', 'Yes', ''),
(3, 'Tewodros', 'Belay', 'Aligaz', 'Instructor', 'tola@yahoo.com', 'teddy', '962b2d2b8e72dc6771bca613d49b46fb', 'Yes', 'Found cheating '),
(4, 'tolosa', 'gemechis', 'gurmessa', 'Examinee', 'tola@yahoo.com', 'tola@yahoo.com', 'ad50ce09d2cae59102a31c1e6034fcb9', 'No', ''),
(5, 'debesay', 'tekie', 'hagos', 'Examinee', 'debesay@yahoo.com', 'debesay@yahoo.com', 'c5aefea68f20755f469c77a7e2717cbf', 'Yes', ''),
(6, 'Zinash', 'Teklu', 'Tekola', 'Examinee', 'zin@yahoo.com', 'zin@yahoo.com', '7b8a5495fb3fab72e421fa5f1e80bb95', 'No', ''),
(7, 'Munir', 'Jemal', 'Mussa', 'Examinee', 'munir@yahoo.com', 'munir@yahoo.com', 'ec83c3ce4c0288ad7868947965b8847c', 'Yes', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
