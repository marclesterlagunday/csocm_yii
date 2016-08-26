-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2016 at 08:02 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classmanagerv2`
--
CREATE DATABASE IF NOT EXISTS `classmanagerv2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `classmanagerv2`;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` char(16) NOT NULL,
  `message` text NOT NULL,
  `posted_by` char(16) NOT NULL,
  `defined_class` char(16) NOT NULL,
  `posted_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `announcement`
--
DELIMITER $$
CREATE TRIGGER `announcement_generate_id` BEFORE INSERT ON `announcement` FOR EACH ROW BEGIN
 SET new.announcement_id := UUID();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` char(16) NOT NULL,
  `id_no` int(11) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `instructors`
--
DELIMITER $$
CREATE TRIGGER `instructors_generate_id` BEFORE INSERT ON `instructors` FOR EACH ROW BEGIN
 SET new.instructor_id := UUID();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` char(16) NOT NULL,
  `id_no` varchar(128) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `course` int(1) NOT NULL,
  `year` int(1) NOT NULL,
  `cellphone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `student_generate_id` BEFORE INSERT ON `students` FOR EACH ROW BEGIN
 SET new.student_id := UUID();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` char(16) NOT NULL,
  `subject_code` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `subjects`
--
DELIMITER $$
CREATE TRIGGER `subjects_generate_id` BEFORE INSERT ON `subjects` FOR EACH ROW BEGIN
 SET new.subject_id := UUID();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` char(16) NOT NULL,
  `usesname` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `users_generate_id` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
 SET new.user_id := UUID();
END
$$
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
