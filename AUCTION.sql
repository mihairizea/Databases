-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 14, 2016 at 09:06 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `AUCTION`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `auction_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `start_price` int(11) NOT NULL,
  `last_bid_id` int(11) NOT NULL,
  `bid_counter` int(11) DEFAULT '0',
  `closed` int(11) DEFAULT NULL,
  `loser_bid_id` int(11) DEFAULT NULL,
  `viewings` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL COMMENT 'FK'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`auction_id`, `start_time`, `end_time`, `start_price`, `last_bid_id`, `bid_counter`, `closed`, `loser_bid_id`, `viewings`, `item_id`) VALUES
(9, '2016-03-17 12:48:44', '2016-03-23 00:00:00', 50, 0, 0, NULL, NULL, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `bid_id` int(100) NOT NULL,
  `bid_value` int(100) NOT NULL,
  `bid_time` datetime NOT NULL,
  `auction_id` int(100) NOT NULL COMMENT 'FK',
  `bidder_id` int(100) DEFAULT NULL COMMENT 'FK'
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bid_id`, `bid_value`, `bid_time`, `auction_id`, `bidder_id`) VALUES
(1, 6, '2016-03-12 18:15:33', 4, 10),
(2, 4, '2016-03-12 18:20:34', 4, 10),
(3, 50, '2016-03-12 18:21:19', 4, 10),
(4, 43, '2016-03-12 18:23:28', 4, 10),
(5, 98, '2016-03-12 18:25:28', 4, 10),
(6, 54, '2016-03-12 18:26:12', 4, 10),
(7, 32, '2016-03-12 18:28:52', 4, 10),
(8, 876, '2016-03-12 18:30:01', 4, 10),
(9, 5443, '2016-03-12 18:30:17', 4, 10),
(10, 4345546, '2016-03-12 18:32:11', 4, 10),
(11, 467, '2016-03-12 18:37:59', 4, 10),
(12, 88, '2016-03-12 18:40:45', 4, 10),
(13, 24, '2016-03-12 18:43:42', 4, 10),
(14, 25, '2016-03-12 18:47:45', 4, 10),
(15, 77, '2016-03-12 18:49:34', 4, 10),
(16, 12345, '2016-03-12 18:54:57', 4, 10),
(17, 7654, '2016-03-12 20:35:06', 4, 10),
(18, 1111, '2016-03-12 20:35:56', 4, 10),
(19, 888, '2016-03-12 20:39:40', 4, 10),
(20, 33, '2016-03-12 20:40:46', 4, 10),
(21, 33, '2016-03-12 20:41:22', 4, 10),
(22, 777777, '2016-03-12 20:44:51', 4, 10),
(23, 1, '2016-03-12 20:46:42', 4, 10),
(24, 222222, '2016-03-12 20:49:42', 2, 2),
(25, 555555, '2016-03-12 20:56:10', 1, 1),
(26, 22222, '2016-03-12 20:59:38', 1, 1),
(27, 22222, '2016-03-12 21:00:24', 1, 1),
(28, 234, '2016-03-12 21:05:20', 1, 1),
(29, 11, '2016-03-12 21:06:42', 1, 1),
(30, 22, '2016-03-12 21:08:09', 1, 1),
(31, 223, '2016-03-12 21:08:48', 1, 1),
(32, 79879, '2016-03-12 21:09:38', 1, 1),
(33, 345, '2016-03-12 21:10:13', 1, 1),
(34, 456, '2016-03-12 21:11:38', 1, 1),
(35, 234, '2016-03-12 21:15:54', 1, 1),
(36, 1223, '2016-03-12 21:16:08', 1, 1),
(37, 456, '2016-03-12 21:17:58', 1, 1),
(38, 9999999, '2016-03-12 21:19:20', 1, 1),
(39, 999, '2016-03-12 21:19:51', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(100) NOT NULL,
  `item_name` varchar(10000) NOT NULL,
  `item_description` varchar(10000) NOT NULL,
  `image` varchar(10000) NOT NULL,
  `watchlist` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `user_id` int(100) NOT NULL COMMENT 'FK',
  `category_id` int(100) NOT NULL COMMENT 'FK'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_description`, `image`, `watchlist`, `views`, `user_id`, `category_id`) VALUES
(1, 'BMX', 'Cool Bike', 'http://ecx.images-amazon.com/images/I/818ivzHkpML._SL1500_.jpg', 0, 0, 1, 1),
(2, 'Mercedes Benz 220', 'Old but Gold', 'http://bestcarmag.com/sites/default/files/2917889mercedes-benz-220-s-10.jpg', 0, 0, 1, 2),
(3, 'Samsung Note 3', 'Big screen gadget', 'http://cdn2.gsmarena.com/vv/pics/samsung/samsung-galaxy-note-3-1.jpg', 0, 0, 2, 3),
(4, 'jhfsad', 'jhfsbd', 'khbdsf', 0, 0, 69, 3),
(5, 'jgvsdj', 'gvdsjhf', 'kjhfgo', 0, 0, 69, 2),
(6, 'jhbs', 'fgjdsv', 'b vd', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `cat_id` int(100) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`cat_id`, `cat_name`, `cat_description`) VALUES
(1, 'bike', 'two wheels stuff'),
(2, 'car', 'four wheels stuff'),
(3, 'phone', 'mobile stuff');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(100) NOT NULL,
  `rating_feedback` varchar(1000) NOT NULL,
  `user_id` int(100) NOT NULL COMMENT 'FK',
  `auction_id` int(100) NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `user_fname` varchar(100) NOT NULL,
  `user_lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_gender` varchar(100) NOT NULL,
  `user_age` int(100) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_payment` int(100) NOT NULL,
  `rating_id` int(100) NOT NULL COMMENT 'FK'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `username`, `password`, `user_gender`, `user_age`, `user_address`, `user_email`, `user_payment`, `rating_id`) VALUES
(1, 'sally', 'demasy', 'sady', 'test', 'female', 20, '15, queen mary street', 'sally.d@gmail.com', 1234, 1),
(2, 'thomas', 'robert', 'thor', 'work', 'male', 26, '24, king avenue', 'tony@hotmail.com', 3456, 2),
(3, 'hods', 'hods', 'lala', 'nklds', '', 0, 'hbvjsdh', 'hbsdj', 0, 0),
(4, 'nono', '', '', '', '', 0, '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `watch_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`auction_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`watch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `auction_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `bid_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `watch_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
