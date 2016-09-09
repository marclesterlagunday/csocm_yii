-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2016 at 06:36 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classmanager_v3`
--
CREATE DATABASE IF NOT EXISTS `classmanager_v3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `classmanager_v3`;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `posted_by` int(5) NOT NULL,
  `define_class` int(5) NOT NULL,
  `posted_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;'),
('Instructor', '12', NULL, NULL),
('Instructor', '5', NULL, NULL),
('Instructor', '8', NULL, NULL),
('Student', '10', NULL, NULL),
('Student', '11', NULL, NULL),
('Student', '4', NULL, NULL),
('Student', '6', NULL, NULL),
('Student', '7', NULL, NULL),
('Student', '9', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
(' Auth Assignments Manager', 2, 'Manages Role Assignments. RBAM required role.', NULL, 'N;'),
('Admin', 2, 'Site Administrator', NULL, 'N;'),
('Auth Items Manager', 2, 'Manages Auth Items. RBAM required role.', NULL, 'N;'),
('Authenticated', 2, 'Default role for users that are logged in. RBAC default role.', 'return !Yii::app()->getUser()->getIsGuest();', 'N;'),
('Guest', 2, 'Default role for users that are not logged in. RBAC default role.', 'return Yii::app()->getUser()->getIsGuest();', 'N;'),
('Instructor', 2, 'School Instructor', NULL, 'N;'),
('RBAC Manager', 2, 'Manages Auth Items and Role Assignments. RBAM required role.', NULL, 'N;'),
('Student', 2, 'School Student', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('RBAC Manager', ' Auth Assignments Manager'),
('RBAC Manager', 'Auth Items Manager');

-- --------------------------------------------------------

--
-- Table structure for table `class_days`
--

CREATE TABLE `class_days` (
  `class_day_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_days`
--

INSERT INTO `class_days` (`class_day_id`, `class`, `day`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 5),
(4, 2, 1),
(5, 2, 3),
(6, 2, 5),
(7, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `class_lecture`
--

CREATE TABLE `class_lecture` (
  `class_lecture_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `lecture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_lecture`
--

INSERT INTO `class_lecture` (`class_lecture_id`, `class`, `lecture`) VALUES
(1, 2, 1),
(2, 2, 8),
(3, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `class_student`
--

CREATE TABLE `class_student` (
  `class_student_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_student`
--

INSERT INTO `class_student` (`class_student_id`, `class`, `student`) VALUES
(1, 1, 10),
(5, 2, 10),
(6, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `sy` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `instructor` int(11) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `date_created` datetime NOT NULL,
  `date_ended` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `subject`, `room`, `sy`, `semester`, `instructor`, `time_start`, `time_end`, `date_created`, `date_ended`, `created_by`) VALUES
(1, 1, 1, 3, 0, 12, '08:00:00', '12:00:00', '2016-09-09 03:22:44', '0000-00-00 00:00:00', 1),
(2, 2, 2, 3, 0, 12, '12:00:00', '09:45:00', '2016-09-09 03:42:03', '0000-00-00 00:00:00', 1),
(3, 2, 2, 3, 0, 12, '10:00:00', '11:00:00', '2016-09-09 16:06:33', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `description`) VALUES
(1, 'BSIT'),
(2, 'HRM'),
(3, 'dan');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `day_id` int(11) NOT NULL,
  `initial` varchar(2) NOT NULL,
  `description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`day_id`, `initial`, `description`) VALUES
(1, 'M', 'Mon'),
(2, 'T', 'Tue'),
(3, 'W', 'Wed'),
(4, 'TH', 'Thu'),
(5, 'F', 'Fri');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `gender_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`gender_id`, `description`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `lecture_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `saved_date` datetime NOT NULL,
  `saved_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`lecture_id`, `title`, `description`, `filename`, `saved_date`, `saved_by`) VALUES
(9, 'PhotoSynthesis', 'asdasdasd', 'PhotoSynthesis.jpg', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lib_lecture`
--

CREATE TABLE `lib_lecture` (
  `lib_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lib_lecture`
--

INSERT INTO `lib_lecture` (`lib_id`, `description`, `path`) VALUES
(1, 'LECTURE_URL', 'http://localhost:8080/lecture/'),
(2, 'LECTURE_FOLDER', 'lecture/');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `description`) VALUES
(1, 'RM 101'),
(2, 'RM 102');

-- --------------------------------------------------------

--
-- Table structure for table `schoolyears`
--

CREATE TABLE `schoolyears` (
  `sy_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolyears`
--

INSERT INTO `schoolyears` (`sy_id`, `description`) VALUES
(1, 'SY 10-11'),
(2, 'SY 11-12'),
(3, 'SY 12-13');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(1) NOT NULL,
  `description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `description`) VALUES
(1, '1st Semester'),
(2, '2nd Semester');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `description`) VALUES
(1, 'Geometry'),
(2, 'Biology'),
(3, 'Ethics');

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `user_course_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `sy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`user_course_id`, `user`, `course`, `sy`) VALUES
(1, 10, 1, 3),
(2, 11, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `profile_pic` longtext NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(128) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `contact_no` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `profile_pic`, `firstname`, `middlename`, `surname`, `age`, `gender`, `contact_no`) VALUES
(1, 'admin', '$2a$13$FkBj6Q1Uh/D.3wst3acyKOA5y0UvImYg9Muo16aFJeEI0G/qhdt8q', 'admin@admin.com', '', 'admin', 'admin', 'admin', 1, 1, ''),
(10, 'jsoriano', '$2a$13$wf0ewGKZ/68jct8bDdNDRuB2/wWwSLp0g1uoQxznvZQfH9r1.k3t.', 'sorianojhonbojrg1234@gmail.com', 'data:image/jpeg;base64,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', 'Jhon Bojrg', 'Almirez', 'Soriano', 19, 1, '09151269792'),
(11, 'dmabunga', '$2a$13$QxgG1z8/j3xNwqeJ0iKYO.INW/1uZWKQrGl8Ag3Lb.BVnhkO0GDoS', 'boey6172@gmail.com', 'data:image/jpeg;base64,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', 'Daniel Meynard', 'Ewan', 'Mabunga', 19, 2, '09123123123'),
(12, 'mstapia', '$2a$13$FkBj6Q1Uh/D.3wst3acyKOA5y0UvImYg9Muo16aFJeEI0G/qhdt8q', 'ma_mercedes_tapia@gmail.com', '', 'Maria', 'Mercedes', 'Tapia', 20, 2, '09987654321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD PRIMARY KEY (`itemname`,`userid`);

--
-- Indexes for table `authitem`
--
ALTER TABLE `authitem`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `class_days`
--
ALTER TABLE `class_days`
  ADD PRIMARY KEY (`class_day_id`);

--
-- Indexes for table `class_lecture`
--
ALTER TABLE `class_lecture`
  ADD PRIMARY KEY (`class_lecture_id`);

--
-- Indexes for table `class_student`
--
ALTER TABLE `class_student`
  ADD PRIMARY KEY (`class_student_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`lecture_id`);

--
-- Indexes for table `lib_lecture`
--
ALTER TABLE `lib_lecture`
  ADD PRIMARY KEY (`lib_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schoolyears`
--
ALTER TABLE `schoolyears`
  ADD PRIMARY KEY (`sy_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`user_course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class_days`
--
ALTER TABLE `class_days`
  MODIFY `class_day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `class_lecture`
--
ALTER TABLE `class_lecture`
  MODIFY `class_lecture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `class_student`
--
ALTER TABLE `class_student`
  MODIFY `class_student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `lecture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `lib_lecture`
--
ALTER TABLE `lib_lecture`
  MODIFY `lib_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schoolyears`
--
ALTER TABLE `schoolyears`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_courses`
--
ALTER TABLE `user_courses`
  MODIFY `user_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
