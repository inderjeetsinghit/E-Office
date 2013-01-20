-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2012 at 07:21 AM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eoffice`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE IF NOT EXISTS `category_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `department_master`
--

CREATE TABLE IF NOT EXISTS `department_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `file_upload`
--

CREATE TABLE IF NOT EXISTS `file_upload` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `path` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `file_upload`
--

INSERT INTO `file_upload` (`id`, `path`, `user`) VALUES
(2, 'upload_dir/.1330193961l_Payroll.pdf', ''),
(3, 'upload_dir/1330194028.jpg', ''),
(4, 'upload_dir/1330314819ILLAGE_IN_BARNALA.pdf', ''),
(5, 'upload_dir/1330486697ILLAGE_IN_BARNALA.pdf', ''),
(6, 'upload_dir/1330610262l.pdf', 'admin'),
(7, 'upload_dir/1330623698ILLAGE_IN_BARNALA.pdf', 'admin'),
(8, 'upload_dir/1330623748ic_smart.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `message_efile`
--

CREATE TABLE IF NOT EXISTS `message_efile` (
  `id` int(11) NOT NULL,
  `noting_id` int(11) NOT NULL,
  `rec_ids` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `to_read` tinyint(1) NOT NULL,
  `from_read` tinyint(1) NOT NULL,
  `auto_inc` int(11) NOT NULL,
  `tag` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `date_enter` date NOT NULL,
  PRIMARY KEY (`id`,`tag`,`date_enter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message_rec`
--

CREATE TABLE IF NOT EXISTS `message_rec` (
  `id` int(11) NOT NULL,
  `to` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `rec_id` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `auto_inc` bigint(20) NOT NULL AUTO_INCREMENT,
  `to_read` tinyint(1) NOT NULL,
  `from_read` tinyint(1) NOT NULL,
  `tag` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `date_enter` date NOT NULL,
  `subject` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `type` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`auto_inc`,`tag`,`date_enter`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `message_rec`
--

INSERT INTO `message_rec` (`id`, `to`, `priority`, `rec_id`, `remarks`, `from`, `auto_inc`, `to_read`, `from_read`, `tag`, `date_enter`, `subject`, `due_date`, `type`) VALUES
(1, 'aa', 'aaa', 'aaa', 'aaaa', 'aaa', 1, 1, 1, 'ddd', '2012-02-29', 'dddd', '0000-00-00', ''),
(1, 'aa', 'ds', 'dsf', 'ds', 'dfs', 2, 1, 1, 'ds', '2012-02-29', 'sd', '0000-00-00', ''),
(1, 'aa', 'sd', 'sd', 'ds', 'ds', 3, 1, 1, 'sdsd', '2012-02-29', 'sdsd', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int(11) NOT NULL,
  `del_mode` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `rece_date` date NOT NULL,
  `letter_date` date NOT NULL,
  `diary_date` date NOT NULL,
  `file_id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `department` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subject` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`diary_date`,`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `del_mode`, `lang`, `type`, `rece_date`, `letter_date`, `diary_date`, `file_id`, `name`, `address`, `email`, `country`, `state`, `contact`, `department`, `category`, `subject`, `tag`, `user`) VALUES
(1, 'post', '', 'circular', '0000-00-00', '0000-00-00', '0000-00-00', 2, '', '', '', 0, 0, 0, 0, 0, '', 'aa', ''),
(2, 'post', '', 'circular', '0000-00-00', '0000-00-00', '0000-00-00', 2, '', '', '', 0, 0, 0, 0, 0, '', 'aa', ''),
(3, 'post', '', 'circular', '0000-00-00', '0000-00-00', '0000-00-00', 2, '', '', '', 0, 0, 0, 0, 0, '', 'aa', ''),
(4, 'post', '', 'circular', '0000-00-00', '0000-00-00', '0000-00-00', 2, '', '', '', 0, 0, 0, 0, 0, '', 'aa', ''),
(5, 'post', '', 'circular', '0000-00-00', '0000-00-00', '0000-00-00', 2, '', '', '', 0, 0, 0, 0, 0, '', 'aa', ''),
(6, 'post', '', 'circular', '0000-00-00', '0000-00-00', '0000-00-00', 2, '', '', '', 0, 0, 0, 0, 0, '', 'aa', ''),
(7, 'post', '', 'circular', '0000-00-00', '0000-00-00', '0000-00-00', 4, '', '', '', 0, 0, 0, 0, 0, '', 'aa', ''),
(8, 'post', '', 'circular', '0000-00-00', '0000-00-00', '0000-00-00', 5, '', '', '', 0, 0, 0, 0, 0, '', 'aa', ''),
(9, 'post', '', 'circular', '0000-00-00', '0000-00-00', '0000-00-00', 6, '', '', '', 0, 0, 0, 0, 0, '', 'aa', ''),
(10, 'post', '', 'circular', '0000-00-00', '0000-00-00', '0000-00-00', 9, '', '', '', 0, 0, 0, 0, 0, '', 'aa', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `state_master`
--

CREATE TABLE IF NOT EXISTS `state_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `pending` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `type`, `pending`) VALUES
(1, 'admin', '02b8884e689b824c7b43bf2d75e612f1', 'admin', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
