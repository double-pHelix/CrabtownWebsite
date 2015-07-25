-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 25, 2015 at 09:59 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `group_id`, `password`, `salt`, `perm_override_remove`, `perm_override_add`, `reg_date`, `last_login_date`, `reg_ip`, `last_login_ip`, `must_validate`) VALUES
(4, 'Greg', 'felixphu@hotmail.com', 0, '540b4dd71c30112cf9a83f395f8f48da9d473bf2d98de24926d11a6c98e249eb7dda6989b5e8eef14b9a1cd3e2c03b238ef9843fd7bc0b0b624006f9a992fa8d', 'bea4b9cdb5eb402869b32c004c1e8ebf0e5a95ed390fefa5d5fceefe426dc1783dc6901d9d1461f15c51f90ea9734314288852a82e1076d5633879130c0f2fbf', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 'Nippy', 'MayorOfCrabtown@gmail.com', 0, '898a7c165088a047fea205ecd949e59a0e5df26d47bde6a5c89ccbcc485f41fbb04d8dbd38d6de84de471c9b2016a9643e75856068b768390f9731f6e5b9795d', 'dcdef9dae4586bf5b918dc99d7307a09f2ce612711a4d386ea634ce13ff6f635dc189942f71423ee165e5578d9880f8b0f9e88c857855f7465b7c1438d0273ea', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 'Greg3', 'adley.phu@gmail.com', 0, '079d08f1799d7e11e71fa88d09fc7c5c5c25f3ae28ab1b3c318b26358c6b30ea1e8b7be511f046269807fc6fe441198463e147bed73acc25b0a2f23cb0708876', 'efc191005c65bec3eb6e9fad7fd5957e1c6d92cee050f63130a819861b394f5757cc61c65e1a886e86f6b6f9ad894160dbc73483e64223ccdff0fc6128d41089', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
