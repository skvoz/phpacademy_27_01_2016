-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: stellash.mysql.ukraine.com.ua
-- Generation Time: Apr 12, 2016 at 06:22 PM
-- Server version: 5.6.27-75.0-log
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stellash_like`
--

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE IF NOT EXISTS `liked` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_post` tinyint(4) NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `like_type` set('l','d') DEFAULT NULL,
  `set_date` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_post` (`id_post`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `liked`
--

INSERT INTO `liked` (`id`, `id_post`, `id_user`, `like_type`, `set_date`) VALUES
(38, 7, 2, 'd', '1460474363'),
(37, 6, 2, 'l', '1460471737 WHERE l.id = S'),
(36, 8, 2, 'l', '1460474305');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `post` tinytext NOT NULL,
  `post_date` char(10) DEFAULT NULL,
  `user_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `post`, `post_date`, `user_id`) VALUES
(1, 'hello world', '2016-04-11', 1),
(2, 'hello world', '2016-04-11', 1),
(3, 'hello new world', '2016-04-11', 1),
(4, 'Привет мир', '2016-04-11', 1),
(5, 'add new', '2016-04-11', 1),
(6, 'fsdfsd', '2016-04-11', 1),
(7, 'sda', '2016-04-11', 1),
(8, 'das', '2016-04-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `pass`) VALUES
(1, 'admin', '123'),
(2, 'bob', '123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
