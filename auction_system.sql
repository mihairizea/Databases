-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2016 at 06:03 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `auction system`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE IF NOT EXISTS `auction` (
  `auction_id` int(100) NOT NULL AUTO_INCREMENT,
  `item_id` int(100) NOT NULL,
  `start_time` datetime(6) NOT NULL,
  `end_time` datetime(6) NOT NULL,
  `start_price` decimal(65,0) NOT NULL,
  `last_bid_id` int(100) NOT NULL COMMENT 'is this redundant?',
  `user_id` int(100) NOT NULL,
  PRIMARY KEY (`auction_id`),
  KEY `item_id` (`item_id`,`start_time`,`end_time`,`start_price`,`last_bid_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `bid_id` int(100) NOT NULL AUTO_INCREMENT,
  `bid_value` int(100) NOT NULL,
  `bid_time` datetime(6) NOT NULL,
  `auction_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  PRIMARY KEY (`bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `item_description` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `item_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `image` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `category_id` int(100) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `user_id` (`user_id`,`category_id`),
  KEY `item_description` (`item_description`(255),`item_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE IF NOT EXISTS `item_category` (
  `category_id` int(100) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `category_description` varchar(100) CHARACTER SET utf8 NOT NULL,
  `parent_category_id` int(100) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`),
  KEY `category_description` (`category_description`,`parent_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `rating_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `auction_id` int(100) NOT NULL,
  `feedback` int(100) NOT NULL,
  PRIMARY KEY (`rating_id`),
  KEY `user_id` (`user_id`,`auction_id`,`feedback`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `user_id`, `auction_id`, `feedback`) VALUES
(25, 1, 20, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(6) CHARACTER SET utf8 NOT NULL,
  `age` int(3) NOT NULL,
  `payment` int(100) NOT NULL,
  `rating_id` int(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`,`email`,`password`),
  KEY `first_name` (`first_name`,`last_name`,`address`(255),`gender`,`age`,`payment`,`rating_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `first_name`, `last_name`, `address`, `email`, `password`, `gender`, `age`, `payment`, `rating_id`) VALUES
(1, 'zaeema1234', 'zaeema', 'ahmed', '98 torrington road n4', 'mihai.rizea10@yopmail.com', 'zxcvbnm', 'female', 24, 11111, 5),
(2, 'johndoe', 'John', 'Doe', 'unkown', 'unkown', 'zxcvbnm', 'male', 24, 999999, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
