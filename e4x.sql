SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Database: `e4x`

-- --------------------------------------------------------
-- Table structure for table `tbl_admins`

CREATE TABLE IF NOT EXISTS `tbl_admins` (
  `Ad_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ad_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Ad_Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Last_Vist` date DEFAULT NULL,
  PRIMARY KEY (`Ad_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- Dumping data for table `tbl_admins`

INSERT INTO `tbl_admins` (`Ad_ID`, `Ad_Name`, `Ad_Password`, `Last_Vist`) VALUES
(1, 'Admin', 'Admin', '2017-12-05');

-- --------------------------------------------------------
-- Table structure for table `tbl_education`

CREATE TABLE IF NOT EXISTS `tbl_education` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PID` int(11) NOT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX` (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=139 ;

-- --------------------------------------------------------
-- Table structure for table `tbl_exam`

CREATE TABLE IF NOT EXISTS `tbl_exam` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tc_id` int(11) NOT NULL,
  `e_time` int(11) NOT NULL,
  `e_date` date NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `tc_id` (`tc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------
-- Table structure for table `tbl_mcq`

CREATE TABLE IF NOT EXISTS `tbl_mcq` (
  `Q_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Q_Title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Ch_A` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Ch_B` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Ch_C` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Ch_D` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Answer` int(11) NOT NULL,
  `Exam_ID` int(11) NOT NULL,
  `Mark` int(11) NOT NULL,
  PRIMARY KEY (`Q_ID`),
  KEY `Answer` (`Answer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------
-- Table structure for table `tbl_stdcrs`

CREATE TABLE IF NOT EXISTS `tbl_stdcrs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SEMSTER` int(11) NOT NULL,
  `STUDENT_ID` int(11) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------
-- Table structure for table `tbl_students`

CREATE TABLE IF NOT EXISTS `tbl_students` (
  `S_ID` int(11) NOT NULL AUTO_INCREMENT,
  `S_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `S_Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `S_Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `S_Assign` int(11) NOT NULL,
  `S_IsActive` tinyint(4) NOT NULL,
  PRIMARY KEY (`S_ID`),
  KEY `Index_01` (`S_Assign`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------
-- Table structure for table `tbl_student_answer`

CREATE TABLE IF NOT EXISTS `tbl_student_answer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ST_ID` int(11) NOT NULL,
  `Q_ID` int(11) NOT NULL,
  `st_ans` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ST_ID` (`ST_ID`),
  KEY `Q_ID` (`Q_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------
-- Table structure for table `tbl_teachers`

CREATE TABLE IF NOT EXISTS `tbl_teachers` (
  `T_ID` int(11) NOT NULL AUTO_INCREMENT,
  `T_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `T_Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `T_Password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `U_ID` int(11) NOT NULL,
  PRIMARY KEY (`T_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------
-- Table structure for table `tbl_teacrs`

CREATE TABLE IF NOT EXISTS `tbl_teacrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------
-- Table structure for table `tbl_torf`

CREATE TABLE IF NOT EXISTS `tbl_torf` (
  `Q_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Q_Title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Answer` tinyint(4) NOT NULL,
  `Exam_ID` int(11) NOT NULL,
  `Mark` int(11) NOT NULL,
  PRIMARY KEY (`Q_ID`),
  KEY `Exam_ID` (`Exam_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
