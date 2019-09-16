-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Sep 08, 2019 at 08:03 PM
=======
-- Generation Time: Sep 02, 2019 at 11:15 PM
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `time_metrics_v2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_admins`
--

CREATE TABLE `r_admins` (
  `ADMIN_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(255) DEFAULT NULL,
  `MIDDLE_NAME` varchar(255) DEFAULT NULL,
  `LAST_NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_admins`
--

INSERT INTO `r_admins` (`ADMIN_ID`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`) VALUES
(1, 'John Edcel', '', 'Zenarosa');

-- --------------------------------------------------------

--
-- Table structure for table `r_courses`
--

CREATE TABLE `r_courses` (
  `COURSE_ID` int(11) NOT NULL,
  `COURSE_CODE` varchar(255) DEFAULT NULL,
  `COURSE_DESCRIPTION` varchar(255) DEFAULT NULL,
  `YEAR_LEVEL` int(11) DEFAULT NULL,
  `SEMESTER` varchar(255) DEFAULT NULL,
  `IS_ACTIVE` tinyint(255) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
--
-- Dumping data for table `r_courses`
--

INSERT INTO `r_courses` (`COURSE_ID`, `COURSE_CODE`, `COURSE_DESCRIPTION`, `YEAR_LEVEL`, `SEMESTER`, `IS_ACTIVE`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', 1, 'First Semester', 1);

=======
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5
-- --------------------------------------------------------

--
-- Table structure for table `r_course_subjects`
--

CREATE TABLE `r_course_subjects` (
  `COURSE_SUBJECT_ID` int(11) NOT NULL,
  `COURSE_ID` int(11) DEFAULT NULL,
  `SUBJECT_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_curriculums`
--

CREATE TABLE `r_curriculums` (
  `CURRICULUM_ID` int(11) NOT NULL,
  `SCHOOL_YEAR` varchar(255) DEFAULT NULL,
  `COURSE_ID` int(11) DEFAULT NULL,
  `IS_ACTIVE` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_instructors`
--

CREATE TABLE `r_instructors` (
  `INSTRUCTOR_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(255) DEFAULT NULL,
  `MIDDLE_NAME` varchar(255) DEFAULT NULL,
  `LAST_NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_registrars`
--

CREATE TABLE `r_registrars` (
  `REGISTRAR_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(255) DEFAULT NULL,
  `MIDDLE_NAME` varchar(255) DEFAULT NULL,
  `LAST_NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_registrars`
--

INSERT INTO `r_registrars` (`REGISTRAR_ID`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`) VALUES
(1, 'Lea Mae', 'Gonzales', 'Cervantes');

-- --------------------------------------------------------

--
-- Table structure for table `r_roles`
--

CREATE TABLE `r_roles` (
  `ROLE_ID` int(11) NOT NULL,
  `ROLE_NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_roles`
--

INSERT INTO `r_roles` (`ROLE_ID`, `ROLE_NAME`) VALUES
(1, 'Admin'),
(2, 'Registrar'),
(3, 'Faculty'),
(4, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `r_sections`
--

CREATE TABLE `r_sections` (
  `SECTION_ID` int(11) NOT NULL,
  `SECTION_NAME` varchar(255) DEFAULT NULL,
  `SLOTS` int(11) DEFAULT '0',
  `IS_ACTIVE` tinyint(255) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_subjects`
--

CREATE TABLE `r_subjects` (
  `SUBJECT_ID` int(11) NOT NULL,
  `SUBJECT_CODE` varchar(255) DEFAULT NULL,
  `SUBJECT_NAME` varchar(255) DEFAULT NULL,
  `UNITS` int(11) DEFAULT NULL,
  `LECTURE_HOURS` int(11) DEFAULT NULL,
  `LAB_HOURS` int(11) DEFAULT NULL,
  `PREREQUISITE_ID` int(11) DEFAULT NULL,
  `COST` double(10,2) DEFAULT NULL,
  `TOTAL_COST` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_users`
--

CREATE TABLE `r_users` (
  `USER_ID` int(11) NOT NULL,
  `ACCOUNT_ID` int(11) DEFAULT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `ROLE_ID` int(11) DEFAULT NULL,
  `IS_ACTIVE` tinyint(1) DEFAULT '1',
  `DATE_CREATED` datetime DEFAULT CURRENT_TIMESTAMP,
  `DATE_MODIFIED` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_users`
--

INSERT INTO `r_users` (`USER_ID`, `ACCOUNT_ID`, `USERNAME`, `PASSWORD`, `ROLE_ID`, `IS_ACTIVE`, `DATE_CREATED`, `DATE_MODIFIED`) VALUES
(1, 1, 'admin', 'admin', 1, 1, '2019-09-03 04:07:08', '2019-09-03 04:35:13'),
<<<<<<< HEAD
(3, 1, 'registrar', 'registrar', 2, 1, '2019-09-03 04:07:55', NULL),
(4, 1, 'student', 'student', 4, 1, '2019-09-09 00:44:08', NULL);
=======
(3, 1, 'registrar', 'registrar', 2, 1, '2019-09-03 04:07:55', NULL);
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5

-- --------------------------------------------------------

--
-- Table structure for table `t_applicants`
--

CREATE TABLE `t_applicants` (
  `APPLICANT_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(255) DEFAULT NULL,
  `MIDDLE_NAME` varchar(255) DEFAULT NULL,
  `LAST_NAME` varchar(255) DEFAULT NULL,
  `GENDER` varchar(255) DEFAULT NULL,
  `ADDRESS` varchar(255) DEFAULT NULL,
  `CONTACT_NUMBER` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
--
-- Dumping data for table `t_applicants`
--

INSERT INTO `t_applicants` (`APPLICANT_ID`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `GENDER`, `ADDRESS`, `CONTACT_NUMBER`, `EMAIL`) VALUES
(1, 'Rodel', 'Roa', 'Duterte', 'Male', 'Quezon City', '09187791260', 'rodel@gmail.com');

=======
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5
-- --------------------------------------------------------

--
-- Table structure for table `t_enrolled_subjects`
--

CREATE TABLE `t_enrolled_subjects` (
  `ENROLLED_SUBJECT_ID` int(11) NOT NULL,
  `ENROLLMENT_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_enrollment`
--

CREATE TABLE `t_enrollment` (
  `ENROLLMENT_ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) DEFAULT NULL,
<<<<<<< HEAD
  `COURSE_ID` int(11) NOT NULL,
=======
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5
  `SCHOOL_YEAR` varchar(255) DEFAULT NULL,
  `STATUS` varchar(255) NOT NULL DEFAULT 'NOT YET REGISTERED'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
--
-- Dumping data for table `t_enrollment`
--

INSERT INTO `t_enrollment` (`ENROLLMENT_ID`, `STUDENT_ID`, `COURSE_ID`, `SCHOOL_YEAR`, `STATUS`) VALUES
(1, 1, 1, '2019-2020', 'NOT YET REGISTERED');

=======
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5
-- --------------------------------------------------------

--
-- Table structure for table `t_students`
--

CREATE TABLE `t_students` (
  `STUDENT_ID` int(11) NOT NULL,
  `STUDENT_NUMBER` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `APPLICANT_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
<<<<<<< HEAD
-- Dumping data for table `t_students`
--

INSERT INTO `t_students` (`STUDENT_ID`, `STUDENT_NUMBER`, `APPLICANT_ID`) VALUES
(1, 0000000001, 1);

--
=======
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5
-- Indexes for dumped tables
--

--
-- Indexes for table `r_admins`
--
ALTER TABLE `r_admins`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `r_courses`
--
ALTER TABLE `r_courses`
  ADD PRIMARY KEY (`COURSE_ID`);

--
-- Indexes for table `r_course_subjects`
--
ALTER TABLE `r_course_subjects`
  ADD PRIMARY KEY (`COURSE_SUBJECT_ID`),
  ADD KEY `I_COURSE_ID` (`COURSE_ID`),
  ADD KEY `I_SUBJECT_ID` (`SUBJECT_ID`);

--
-- Indexes for table `r_curriculums`
--
ALTER TABLE `r_curriculums`
  ADD PRIMARY KEY (`CURRICULUM_ID`),
  ADD KEY `I_COURSE_ID` (`COURSE_ID`);

--
-- Indexes for table `r_instructors`
--
ALTER TABLE `r_instructors`
  ADD PRIMARY KEY (`INSTRUCTOR_ID`);

--
-- Indexes for table `r_registrars`
--
ALTER TABLE `r_registrars`
  ADD PRIMARY KEY (`REGISTRAR_ID`);

--
-- Indexes for table `r_roles`
--
ALTER TABLE `r_roles`
  ADD PRIMARY KEY (`ROLE_ID`);

--
-- Indexes for table `r_sections`
--
ALTER TABLE `r_sections`
  ADD PRIMARY KEY (`SECTION_ID`);

--
-- Indexes for table `r_subjects`
--
ALTER TABLE `r_subjects`
  ADD PRIMARY KEY (`SUBJECT_ID`),
  ADD KEY `I_PREREQUISITE_ID` (`PREREQUISITE_ID`);

--
-- Indexes for table `r_users`
--
ALTER TABLE `r_users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD KEY `I_ROLE_ID` (`ROLE_ID`),
  ADD KEY `I_STUDENT_ID` (`ACCOUNT_ID`),
  ADD KEY `I_FACULTY_ID` (`ACCOUNT_ID`),
  ADD KEY `I_REGISTRAR_ID` (`ACCOUNT_ID`);

--
-- Indexes for table `t_applicants`
--
ALTER TABLE `t_applicants`
  ADD PRIMARY KEY (`APPLICANT_ID`);

--
-- Indexes for table `t_enrolled_subjects`
--
ALTER TABLE `t_enrolled_subjects`
  ADD PRIMARY KEY (`ENROLLED_SUBJECT_ID`),
  ADD KEY `I_ENROLLMENT_ID` (`ENROLLMENT_ID`);

--
-- Indexes for table `t_enrollment`
--
ALTER TABLE `t_enrollment`
  ADD PRIMARY KEY (`ENROLLMENT_ID`),
<<<<<<< HEAD
  ADD KEY `I_ENROLLMENT_STUDENT_ID` (`STUDENT_ID`),
  ADD KEY `FK_ENROLLMENT_COURSE_ID` (`COURSE_ID`);
=======
  ADD KEY `I_ENROLLMENT_STUDENT_ID` (`STUDENT_ID`);
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5

--
-- Indexes for table `t_students`
--
ALTER TABLE `t_students`
  ADD PRIMARY KEY (`STUDENT_ID`),
  ADD KEY `I_APPLICANT_ID` (`APPLICANT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_admins`
--
ALTER TABLE `r_admins`
  MODIFY `ADMIN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `r_courses`
--
ALTER TABLE `r_courses`
<<<<<<< HEAD
  MODIFY `COURSE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `COURSE_ID` int(11) NOT NULL AUTO_INCREMENT;
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5

--
-- AUTO_INCREMENT for table `r_curriculums`
--
ALTER TABLE `r_curriculums`
  MODIFY `CURRICULUM_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_instructors`
--
ALTER TABLE `r_instructors`
  MODIFY `INSTRUCTOR_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_registrars`
--
ALTER TABLE `r_registrars`
  MODIFY `REGISTRAR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `r_roles`
--
ALTER TABLE `r_roles`
  MODIFY `ROLE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `r_sections`
--
ALTER TABLE `r_sections`
  MODIFY `SECTION_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_subjects`
--
ALTER TABLE `r_subjects`
  MODIFY `SUBJECT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_users`
--
ALTER TABLE `r_users`
<<<<<<< HEAD
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
=======
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5

--
-- AUTO_INCREMENT for table `t_applicants`
--
ALTER TABLE `t_applicants`
<<<<<<< HEAD
  MODIFY `APPLICANT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `APPLICANT_ID` int(11) NOT NULL AUTO_INCREMENT;
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5

--
-- AUTO_INCREMENT for table `t_enrolled_subjects`
--
ALTER TABLE `t_enrolled_subjects`
  MODIFY `ENROLLED_SUBJECT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_enrollment`
--
ALTER TABLE `t_enrollment`
<<<<<<< HEAD
  MODIFY `ENROLLMENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `ENROLLMENT_ID` int(11) NOT NULL AUTO_INCREMENT;
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5

--
-- AUTO_INCREMENT for table `t_students`
--
ALTER TABLE `t_students`
<<<<<<< HEAD
  MODIFY `STUDENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `STUDENT_ID` int(11) NOT NULL AUTO_INCREMENT;
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5

--
-- Constraints for dumped tables
--

--
-- Constraints for table `r_course_subjects`
--
ALTER TABLE `r_course_subjects`
  ADD CONSTRAINT `FK_COURSE_SUBJECT_ID` FOREIGN KEY (`COURSE_ID`) REFERENCES `r_courses` (`COURSE_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_SUBJECT_ID` FOREIGN KEY (`SUBJECT_ID`) REFERENCES `r_subjects` (`SUBJECT_ID`) ON DELETE CASCADE;

--
-- Constraints for table `r_curriculums`
--
ALTER TABLE `r_curriculums`
  ADD CONSTRAINT `FK_COURSE_ID` FOREIGN KEY (`COURSE_ID`) REFERENCES `r_courses` (`COURSE_ID`) ON DELETE CASCADE;

--
-- Constraints for table `r_subjects`
--
ALTER TABLE `r_subjects`
  ADD CONSTRAINT `FK_PREREQUISITE_ID` FOREIGN KEY (`PREREQUISITE_ID`) REFERENCES `r_subjects` (`SUBJECT_ID`) ON DELETE CASCADE;

--
-- Constraints for table `r_users`
--
ALTER TABLE `r_users`
  ADD CONSTRAINT `FK_ROLE_ID` FOREIGN KEY (`ROLE_ID`) REFERENCES `r_roles` (`ROLE_ID`) ON DELETE CASCADE;

--
-- Constraints for table `t_enrolled_subjects`
--
ALTER TABLE `t_enrolled_subjects`
  ADD CONSTRAINT `FK_ENROLLMENT_ID` FOREIGN KEY (`ENROLLMENT_ID`) REFERENCES `t_enrollment` (`ENROLLMENT_ID`) ON DELETE CASCADE;

--
-- Constraints for table `t_enrollment`
--
ALTER TABLE `t_enrollment`
<<<<<<< HEAD
  ADD CONSTRAINT `FK_ENROLLMENT_COURSE_ID` FOREIGN KEY (`COURSE_ID`) REFERENCES `r_courses` (`COURSE_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ENROLLMENT_STUDENT_ID` FOREIGN KEY (`STUDENT_ID`) REFERENCES `t_students` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
=======
  ADD CONSTRAINT `FK_ENROLLMENT_STUDENT_ID` FOREIGN KEY (`STUDENT_ID`) REFERENCES `t_students` (`STUDENT_ID`) ON DELETE CASCADE;
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5

--
-- Constraints for table `t_students`
--
ALTER TABLE `t_students`
  ADD CONSTRAINT `FK_APPLICANT_ID` FOREIGN KEY (`APPLICANT_ID`) REFERENCES `t_applicants` (`APPLICANT_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
