-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2017 at 09:38 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_email`, `admin_pass`) VALUES
(1, 'a@gmail.com', 'admin'),
(2, 'b2gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_author` varchar(250) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_author`, `post_id`, `user_id`, `comment`, `date`) VALUES
(1, '', 23, 1, 'hey there', '2017-07-19 07:08:18'),
(2, '', 23, 1, 'hello', '2017-07-19 07:24:07'),
(3, '', 23, 1, 'hello', '2017-07-19 07:32:49'),
(4, '', 23, 1, 'hello', '2017-07-19 07:33:53'),
(5, 'admin', 23, 1, 'hey ', '2017-07-19 08:17:11'),
(6, 'admin', 23, 1, 'hello', '2017-07-19 08:17:18'),
(7, 'admin', 23, 1, 'hey', '2017-07-20 10:56:15'),
(8, 'admin', 20, 1, 'hey', '2017-07-20 12:51:17'),
(9, 'admin', 20, 1, 'hello\r\n', '2017-07-20 12:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender` varchar(250) NOT NULL,
  `receiver` varchar(250) NOT NULL,
  `msg_sub` varchar(250) NOT NULL,
  `msg_topic` text NOT NULL,
  `reply` text NOT NULL,
  `status` varchar(150) NOT NULL,
  `msg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender`, `receiver`, `msg_sub`, `msg_topic`, `reply`, `status`, `msg_date`) VALUES
(22, '1', '1', 'hello', 'g', 'jjh', 'unread', '2017-07-22'),
(23, '1', '1', 'hi', 'hey', 'no_reply', 'unread', '2017-07-22'),
(24, '1', '', 'hey', 'dd', 'no_reply', 'unread', '2017-07-22'),
(25, '1', '', 'hey', 'dd', 'no_reply', 'unread', '2017-07-22'),
(26, '1', '', 'hey', 'dd', 'no_reply', 'unread', '2017-07-22'),
(27, '1', '', 'hey', 'dd', 'no_reply', 'unread', '2017-07-22'),
(28, '1', '', 'j', 'hh', 'no_reply', 'unread', '2017-07-22'),
(29, '1', '1', 'h', 'hello', 'no_reply', 'unread', '2017-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `topic_id`, `post_title`, `post_content`, `post_date`) VALUES
(1, 1, 0, 's', 'ss', '2017-07-23 20:22:07'),
(2, 1, 1, 'baby', 'hello', '2017-07-24 07:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_title`) VALUES
(1, 'Bollywood'),
(2, 'Movies Review');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_pass` varchar(255) NOT NULL,
  `u_mail` varchar(255) NOT NULL,
  `u_country` text NOT NULL,
  `u_gender` text NOT NULL,
  `u_birthday` text NOT NULL,
  `u_image` text NOT NULL,
  `u_reg_date` text NOT NULL,
  `u_last_login` text NOT NULL,
  `status` text NOT NULL,
  `ver_code` int(100) NOT NULL,
  `posts` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `u_name`, `u_pass`, `u_mail`, `u_country`, `u_gender`, `u_birthday`, `u_image`, `u_reg_date`, `u_last_login`, `status`, `ver_code`, `posts`) VALUES
(1, 'admin', '12345678', 'abc@gmail.com', 'India', 'Male', '2017-07-04', 'tds.png', '2017-07-23 23:04:18', '2017-07-23 23:04:18', 'ok', 365006149, 'no'),
(2, 'AJAY BHAKUNI', 'admin2010', 'bhakuni.ajay6@gmail.com', 'India', 'Male', '2017-07-04', 'tds.png', '2017-07-24 12:39:15', '2017-07-24 12:39:15', 'ok', 539767312, 'no'),
(3, 'AKASH GOEL', '12345678', 'healthluv20@gmail.com', 'India', 'Male', '2017-07-19', 'tds.png', '2017-07-24 12:45:30', '2017-07-24 12:45:30', 'unverified', 1257476781, 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
