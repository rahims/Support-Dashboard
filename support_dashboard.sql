-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 17, 2010 at 04:35 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `support_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `calls_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `calls_twilio_sid` varchar(34) NOT NULL,
  `calls_from` varchar(10) CHARACTER SET ascii NOT NULL,
  `calls_location` varchar(255) NOT NULL,
  `calls_start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `calls_duration` int(10) unsigned NOT NULL COMMENT 'Expressed in seconds',
  PRIMARY KEY (`calls_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
