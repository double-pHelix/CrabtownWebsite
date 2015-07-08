-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2015 at 09:23 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crabtowndatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `autologin`
--

CREATE TABLE IF NOT EXISTS `autologin` (
  `id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `public_key` varchar(32) NOT NULL,
  `private_key` varchar(32) NOT NULL,
  `created_on` datetime NOT NULL,
  `last_used_on` datetime NOT NULL,
  `last_used_ip` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banned_emails`
--

CREATE TABLE IF NOT EXISTS `banned_emails` (
  `id` bigint(20) unsigned NOT NULL,
  `email_regex` varchar(120) NOT NULL,
  `created_on` datetime NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forced_group_ips`
--

CREATE TABLE IF NOT EXISTS `forced_group_ips` (
  `id` bigint(20) unsigned NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `ip_low` int(10) unsigned NOT NULL,
  `ip_high` int(10) unsigned NOT NULL,
  `created_on` datetime NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `group_name` varchar(32) NOT NULL,
  `permissions` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(80) NOT NULL,
  `group_id` bigint(20) unsigned NOT NULL,
  `salt` varchar(5) NOT NULL,
  `perm_override_remove` bigint(20) unsigned NOT NULL,
  `perm_override_add` bigint(20) unsigned NOT NULL,
  `reg_date` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `reg_ip` int(10) unsigned NOT NULL,
  `last_login_ip` int(10) unsigned NOT NULL,
  `must_validate` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autologin`
--
ALTER TABLE `autologin`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `public_key` (`public_key`);

--
-- Indexes for table `banned_emails`
--
ALTER TABLE `banned_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forced_group_ips`
--
ALTER TABLE `forced_group_ips`
  ADD PRIMARY KEY (`id`), ADD KEY `ip_low` (`ip_low`), ADD KEY `ip_high` (`ip_high`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autologin`
--
ALTER TABLE `autologin`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banned_emails`
--
ALTER TABLE `banned_emails`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forced_group_ips`
--
ALTER TABLE `forced_group_ips`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;