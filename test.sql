-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2015 at 02:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(8) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_unique` (`cat_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(1, 'sem 1', ''),
(2, 'sem 2', ''),
(3, 'sem 3', ''),
(4, 'sem 4', ''),
(5, 'sem 5', ''),
(6, 'sem 6', ''),
(7, 'sem 7', ''),
(8, 'sem 8', '');

-- --------------------------------------------------------

--
-- Table structure for table `fileupload`
--

CREATE TABLE IF NOT EXISTS `fileupload` (
  `file_name` varchar(100) NOT NULL,
  `tags` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`file_name`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fileupload`
--

INSERT INTO `fileupload` (`file_name`, `tags`, `user_id`) VALUES
('ajaystatesC.py', 'cd lalr', 9),
('Demons.txt', 'question answer', 2),
('MemManagement.py', 'MMU memory ', 2),
('ProcessGen.py', 'MMU', 2),
('stack_smashing.c', 'ppl, stack smashing, principles of programming language, lab 9, labs, c code', 2),
('test.txt', 'test python', 9);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(8) NOT NULL AUTO_INCREMENT,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int(8) NOT NULL,
  `post_by` int(8) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `post_topic` (`post_topic`),
  KEY `post_by` (`post_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES
(27, 'Is this subject a continuation of fafl? Please inform. If this is so, i have to give more stress on fafl.', '2015-10-08 19:34:29', 39, 5),
(36, 'can anyone tell me what is this subject about?', '2015-11-13 21:26:52', 40, 2),
(37, 'question: How does a TLB work? Is it like a cache for page tables?', '2015-11-13 21:28:07', 41, 2),
(38, 'What is a P2P network?', '2015-11-14 13:28:39', 42, 9),
(39, 'I have less knowledge about TCP, can anyone tell me where is it used? ', '2015-11-14 13:32:18', 42, 2),
(40, 'What is s router?', '2015-11-15 10:34:36', 42, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_content` text NOT NULL,
  `reply_date` date NOT NULL,
  `reply_post` int(11) NOT NULL,
  `reply_by` int(11) NOT NULL,
  PRIMARY KEY (`reply_id`),
  KEY `topic_id` (`reply_post`),
  KEY `reply_by` (`reply_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `reply_content`, `reply_date`, `reply_post`, `reply_by`) VALUES
(8, 'Yes it is. But to be frank, fafl is included in your syllabus just to give an introduction to the basics of CD. you will discover more about it in CD later on. Good Luck!', '2015-11-13', 27, 2),
(9, 'Absolutely. It works just like a cache. MMU actually searches for the page table entries in TLB first and later on TLB miss it goes for main memory. since TLB is situated within MMU itself, its faster. On a better replacement algorithm, the access time is increased by 40% on average by using TLB. Gud luck!', '2015-11-13', 37, 2),
(10, 'anyone?? plz..', '2015-11-14', 38, 9),
(11, 'for exams..', '2015-11-14', 39, 2),
(12, 'This is a reply from the instructor.', '2015-11-14', 27, 9),
(13, 'hey', '2015-11-14', 37, 9);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(8) NOT NULL AUTO_INCREMENT,
  `topic_subject` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int(8) NOT NULL,
  `topic_by` int(8) NOT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `topic_cat` (`topic_cat`),
  KEY `topic_by` (`topic_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`) VALUES
(39, 'Compiler Design', '2015-10-08 19:34:29', 1, 2),
(40, 'fafl', '2015-10-08 20:05:39', 4, 2),
(41, 'operating system', '2015-10-11 09:37:56', 1, 4),
(42, 'Computer Networks', '0000-00-00 00:00:00', 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_date` datetime NOT NULL,
  `user_level` int(8) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name_unique` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_level`) VALUES
(2, 'ajayaradhya', 'ajayaradhya', 'be.el.ajay@gmail.com', '2015-10-08 15:58:46', 1),
(4, 'arjunaradhya', 'arjunaradhya', 'bl.arjun@gmail.com', '2015-10-11 06:06:56', 0),
(5, 'dhanush', '12345678', 'ddd_dd@yahoo.in', '2015-10-13 12:39:43', 0),
(9, 'ajaykumarkk', 'ajaykumarkk', 'ajaykumarkk77@gmail.com', '2015-10-14 14:52:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `yt_video_id` varchar(100) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`yt_video_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`yt_video_id`, `topic_id`) VALUES
('9vmhcBpZDcE', 39),
('Qkwj65l_96I', 39),
('WccZQSERfCM', 39);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fileupload`
--
ALTER TABLE `fileupload`
  ADD CONSTRAINT `fileupload_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`reply_post`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`reply_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
