-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2015 at 07:57 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crabtown_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `autologin`
--

CREATE TABLE IF NOT EXISTS `autologin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `public_key` varchar(32) NOT NULL,
  `private_key` varchar(32) NOT NULL,
  `created_on` datetime NOT NULL,
  `last_used_on` datetime NOT NULL,
  `last_used_ip` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  KEY `public_key` (`public_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `banned_emails`
--

CREATE TABLE IF NOT EXISTS `banned_emails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email_regex` varchar(120) NOT NULL,
  `created_on` datetime NOT NULL,
  `notes` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `crablar_archives`
--

CREATE TABLE IF NOT EXISTS `crablar_archives` (
  `edition_no` int(4) DEFAULT NULL,
  `year` int(4) NOT NULL,
  `month` varchar(9) NOT NULL,
  `pages` int(2) DEFAULT NULL,
  UNIQUE KEY `edition_no` (`edition_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crablar_archives`
--

INSERT INTO `crablar_archives` (`edition_no`, `year`, `month`, `pages`) VALUES
(1, 2014, 'jun', 3),
(2, 2015, 'jul', 6);

-- --------------------------------------------------------

--
-- Table structure for table `forced_group_ips`
--

CREATE TABLE IF NOT EXISTS `forced_group_ips` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) NOT NULL,
  `ip_low` int(10) unsigned NOT NULL,
  `ip_high` int(10) unsigned NOT NULL,
  `created_on` datetime NOT NULL,
  `notes` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip_low` (`ip_low`),
  KEY `ip_high` (`ip_high`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `group_name` varchar(32) NOT NULL,
  `permissions` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permissions`) VALUES
(1, 'standard', 1525),
(2, 'administrator', 262143);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(3, 1437235963),
(4, 1437624670),
(4, 1437624685),
(4, 1437624960),
(4, 1437625613),
(4, 1437625709),
(4, 1437626012),
(4, 1437635207),
(4, 1437712778),
(4, 1437712784),
(4, 1437751438),
(4, 1437807825),
(4, 1437823601),
(4, 1437999486),
(4, 1437999492),
(4, 1438162880),
(4, 1438247974),
(4, 1438342113);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `group_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `perm_override_remove` bigint(20) unsigned NOT NULL,
  `perm_override_add` bigint(20) unsigned NOT NULL,
  `reg_date` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `reg_ip` int(10) unsigned NOT NULL,
  `last_login_ip` int(10) unsigned NOT NULL,
  `must_validate` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- Table structure for table `user_information`
--

CREATE TABLE IF NOT EXISTS `user_information` (
  `user_id` int(11) NOT NULL,
  `occupation` text NOT NULL,
  `description` text NOT NULL,
  `colour` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
