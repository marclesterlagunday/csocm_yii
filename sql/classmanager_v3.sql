-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2016 at 05:02 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `classmanager_v3`
--
CREATE DATABASE IF NOT EXISTS `classmanager_v3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `classmanager_v3`;

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
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
('Instructor', '5', NULL, NULL),
('Student', '4', NULL, NULL),
('Student', '6', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
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

CREATE TABLE IF NOT EXISTS `authitemchild` (
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
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
`course_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `description`) VALUES
(1, 'BSIT'),
(2, 'HRM');

-- --------------------------------------------------------

--
-- Table structure for table `schoolyears`
--

CREATE TABLE IF NOT EXISTS `schoolyears` (
`sy_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolyears`
--

INSERT INTO `schoolyears` (`sy_id`, `description`) VALUES
(1, 'SY 10-11'),
(2, 'SY 11-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `profile_pic`, `firstname`, `middlename`, `surname`, `age`, `gender`, `contact_no`) VALUES
(1, 'admin', '$2a$13$FkBj6Q1Uh/D.3wst3acyKOA5y0UvImYg9Muo16aFJeEI0G/qhdt8q', 'admin@admin.com', '', 'admin', 'admin', 'admin', 1, 1, ''),
(4, 'jsoriano', '$2a$13$x4qf0obZJPqqxHw7un87ZefkDk4WtP0Lx0Mtxu5i8Yk.GQGEAAvUW', 'sorianojhonbojrg1234@gmail.com', '', 'Jhon Bojrg', 'Almirez', 'Soriano', 19, 1, '09151269792'),
(5, 'mr_bojrg', '$2a$13$8uL990HePEaooJjxdr3dpOaa/HEhpy0RHlQ8YVDhmTt1iidVjvg/K', 'sorianojhonbojrg1234@gmail.com', '', 'Mr Bojrg', 'Almirez', 'Soriano', 19, 1, '09151269792'),
(6, 'student1', '$2a$13$Qlxp3Up.tFijC/UT9rELT.tGyF.uBkoDzrE9msyWFtWDL3r.hNDx.', 'student1@gmail.com', '', 'Student', 'One', 'One', 19, 1, '09151269792');

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE IF NOT EXISTS `user_courses` (
`user_course_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `sy` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`user_course_id`, `user`, `course`, `sy`) VALUES
(2, 4, 1, 2),
(3, 6, 1, 2);

--
-- Indexes for dumped tables
--

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
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
 ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `schoolyears`
--
ALTER TABLE `schoolyears`
 ADD PRIMARY KEY (`sy_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
 ADD PRIMARY KEY (`user_course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schoolyears`
--
ALTER TABLE `schoolyears`
MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_courses`
--
ALTER TABLE `user_courses`
MODIFY `user_course_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
