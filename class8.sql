-- phpMyAdmin SQL Dump
-- version 4.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2015 at 09:59 AM
-- Server version: 10.0.14-MariaDB-log
-- PHP Version: 5.6.99-hhvm

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `class8`
--

-- --------------------------------------------------------

--
-- Table structure for table `class8_activities`
--

CREATE TABLE IF NOT EXISTS `class8_activities` (
  `activity_id` bigint(20) NOT NULL,
  `activity_name` varchar(32) NOT NULL,
  `activity_create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activity_sponsor` varchar(16) NOT NULL,
  `activity_start_time` datetime NOT NULL,
  `activity_end_time` datetime NOT NULL,
  `activity_place` varchar(128) NOT NULL,
  `activity_detail` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class8_activity_attendance`
--

CREATE TABLE IF NOT EXISTS `class8_activity_attendance` (
  `activity_id` bigint(20) NOT NULL,
  `username` varchar(16) NOT NULL,
  `is_attend` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class8_classmates`
--

CREATE TABLE IF NOT EXISTS `class8_classmates` (
  `username` varchar(8) NOT NULL,
  `birthday` date NOT NULL,
  `country` varchar(16) NOT NULL,
  `city` varchar(16) NOT NULL,
  `company` varchar(64) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `qq` varchar(12) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class8_email_validation`
--

CREATE TABLE IF NOT EXISTS `class8_email_validation` (
  `email` varchar(64) NOT NULL,
  `keycode` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class8_users`
--

CREATE TABLE IF NOT EXISTS `class8_users` (
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `remember_token` varchar(60) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class8_votes`
--

CREATE TABLE IF NOT EXISTS `class8_votes` (
  `vote_id` bigint(20) NOT NULL,
  `vote_name` varchar(32) NOT NULL,
  `vote_sponsor` varchar(16) NOT NULL,
  `vote_create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vote_end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vote_is_multiple` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class8_vote_options`
--

CREATE TABLE IF NOT EXISTS `class8_vote_options` (
  `option_id` bigint(20) NOT NULL,
  `vote_id` int(11) NOT NULL,
  `option_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class8_activities`
--
ALTER TABLE `class8_activities`
  ADD PRIMARY KEY (`activity_id`), ADD UNIQUE KEY `id` (`activity_id`);

--
-- Indexes for table `class8_activity_attendance`
--
ALTER TABLE `class8_activity_attendance`
  ADD PRIMARY KEY (`activity_id`,`username`), ADD KEY `username` (`username`);

--
-- Indexes for table `class8_classmates`
--
ALTER TABLE `class8_classmates`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `class8_email_validation`
--
ALTER TABLE `class8_email_validation`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `class8_users`
--
ALTER TABLE `class8_users`
  ADD PRIMARY KEY (`username`), ADD KEY `email` (`email`);

--
-- Indexes for table `class8_votes`
--
ALTER TABLE `class8_votes`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indexes for table `class8_vote_options`
--
ALTER TABLE `class8_vote_options`
  ADD PRIMARY KEY (`option_id`), ADD KEY `vote_id` (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class8_activities`
--
ALTER TABLE `class8_activities`
  MODIFY `activity_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `class8_votes`
--
ALTER TABLE `class8_votes`
  MODIFY `vote_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class8_vote_options`
--
ALTER TABLE `class8_vote_options`
  MODIFY `option_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `class8_activity_attendance`
--
ALTER TABLE `class8_activity_attendance`
ADD CONSTRAINT `class8_activity_attendance_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `class8_activities` (`activity_id`),
ADD CONSTRAINT `class8_activity_attendance_ibfk_2` FOREIGN KEY (`username`) REFERENCES `class8_users` (`username`);

--
-- Constraints for table `class8_classmates`
--
ALTER TABLE `class8_classmates`
ADD CONSTRAINT `class8_classmates_ibfk_1` FOREIGN KEY (`username`) REFERENCES `class8_users` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
