-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2020 at 03:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `just_post`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(8) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_image`, `category_name`, `category_description`, `created`) VALUES
(1, 'img/oocp.jpg', 'Object Oriented Concepts And Programming (OOCP)', 'Object-oriented programming (OOP) is a programming paradigm based on the concept of \"objects\", which can contain data, in the form of fields (often known as attributes or properties), and code, in the form of procedures (often known as methods).', '2020-05-27 18:07:32'),
(2, 'img/datastructure.jpg', 'Data Structures', 'A data structure is a data organization&sbquo; management, and storage format that enables efficient access and modification. More precisely, the relationships among them, and the functions or operations that can be applied to the data.', '2020-05-27 18:10:04'),
(3, 'img/comporg.jpg', 'Computer Organization & Advanced Microprocessor', 'computer organization & advanced microprocessor', '2020-05-28 11:23:47'),
(4, 'img/funos.png', 'Fundamental Operating Systems', 'Flask is a micro web framework written in Python. It is classified as a microframework because it does not require particular tools or libraries.', '2020-05-28 11:24:31'),
(5, 'img/statcomp.jpg', 'Statistical Computing', 'Statistical computing is the interface between statistics and computer science. It is the area of computational science specific to the mathematical science of statistics.', '2020-06-22 23:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(8) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(8) NOT NULL,
  `comment_by` int(8) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES
(18, 'Answer1', 23, 6, '2020-06-30 13:42:19'),
(19, 'Answer to my question', 24, 6, '2020-06-30 13:47:44'),
(20, 'Aje Mean ni 2 method karayi short cut method and direct method', 25, 8, '2020-07-10 17:44:06'),
(21, 'wait hmna moklu\r\n', 26, 7, '2020-07-10 17:51:16'),
(22, 'hnnnnn\r\n', 26, 8, '2020-07-10 17:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(7) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_user_id` int(7) NOT NULL,
  `thread_category_id` int(7) NOT NULL,
  `time_stamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_user_id`, `thread_category_id`, `time_stamp`) VALUES
(23, 'Title 1', 'desc 1', 6, 1, '2020-06-30 13:42:03'),
(24, 'My Question', 'Description', 6, 2, '2020-06-30 13:47:00'),
(25, 'AAje su karayu', 'bhai me lacture me nahi tha plz koi mu je btao aaj sir ne kya karwaya', 6, 5, '2020-07-10 17:42:48'),
(26, 'problem of programme', 'badha programme mokal ana', 8, 1, '2020-07-10 17:48:44'),
(27, 'problem of programme', 'badha programme mokal ana', 8, 1, '2020-07-10 17:50:36'),
(28, 'problem of programme', 'badha programme mokal ana', 8, 1, '2020-07-10 17:51:00'),
(29, 'kjduihsa8ih8ae8ie', 'ru43ur8yt8ry89', 8, 69, '2020-07-10 17:54:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sr_no` int(8) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_bio` text DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sr_no`, `image`, `username`, `user_email`, `user_bio`, `timestamp`) VALUES
(2, '', 'Hiren Joshi', 'joshihiren688@gmail.com', NULL, '2020-06-14 22:36:58'),
(3, '', 'Krish Mehta', 'krishmehta123@gmail.com', NULL, '2020-06-15 14:30:05'),
(4, '', 'Pratham Doshi', 'pratham123@gmail.com', NULL, '2020-06-15 14:37:21'),
(5, '', 'SAVAN PATEL&#39;', 'savan5248@gmail.com', 'hello', '2020-06-23 16:17:21'),
(6, 'https://lh3.googleusercontent.com/a-/AOh14GjTTW003hnyC6flo4szf3KaGMQ9C6xWghXYQ94Ceg', 'SAVAN PATEL&#39;', 'savanpatel5248@gmail.com', NULL, '2020-06-27 19:05:48'),
(7, 'https://lh3.googleusercontent.com/a-/AOh14GipXIz6IJODsgIMcK0I0cduGIOwqpB9Rv_kOti0', 'BCA_Sem3_59_savan', 'spatel5248@gmail.com', 'testing234', '2020-06-28 00:06:55'),
(8, 'https://lh5.googleusercontent.com/-ifdpyRyT2b8/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuckuyM5ZQBpZKER0Elm94zySC5zroQ/photo.jpg', 'Hiren Joshi', 'joshihiren690@gmail.com', 'bharai gayo', '2020-07-10 17:41:06'),
(9, 'https://lh5.googleusercontent.com/-KsO_b5vlU0U/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucloJVpjYc5izYp3nhLTyqVVtVmjOQ/photo.jpg', 'BCA_Sem3_89_krish', 'mehtakrishb.1558@gmail.com', 'mehta transport vala krish bhai', '2020-07-10 18:30:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_desc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sr_no` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
