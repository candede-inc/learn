-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2020 at 07:18 AM
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
-- Database: `candedenews_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `dope` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(39, 'Web Devolopment', 'Yerry', '05/08/2020'),
(40, 'Mobile Apps', 'Yerry', '05/08/2020'),
(42, 'Game Devolopment', 'yerry', '05/08/2020'),
(45, 'Business', 'Yerry', '05/08/2020'),
(57, 'Health&Fitness', '', ''),
(58, 'Mental Health', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `datetime` varchar(100) NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `comment` varchar(600) NOT NULL,
  `approvedby` varchar(50) NOT NULL,
  `status` varchar(4) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `number` varchar(15) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(15000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `number`, `category`, `author`, `image`, `post`) VALUES
(71, '2020/09/15 18:31:25', 'Sachin Gali', '09620360476', 'Web Devolopment', 'Badki', '', '                                                                                                                                                                                                                  <h2>Build Mobile Apps: Learn Flutter For Free </h2><br><hr>\r\n<iframe width=\"100%\" height=\"515\" src=\"https://www.youtube-nocookie.com/embed/x0uinJvhNxI\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\"></iframe>\r\n              <h5>Its a crash course on flutter. If you want to learn more about flutter you have to buy this course, to buy this course please scroll down and checkout :)</h5>           \r\n         <h6>All the rights of this video is owned by academind </h6>\r\n\r\n\r\n<hr><br>\r\n<div class=\"card bg-dark\">\r\n<a href=\"https://www.udemy.com/course/learn-flutter-dart-to-build-ios-android-apps/\"\r\n<img style=\"border-radius:25px;\" align=\"center\" alt=\"Flutter\" width=\"360\" height=\"245\" class=\"course-card--course-image--2sjYP course-card-link--image--13Grk\" src=\"https://img-a.udemycdn.com/course/240x135/1708340_7108_4.jpg\" srcset=\"https://img-a.udemycdn.com/course/240x135/1708340_7108_4.jpg 1x, https://img-a.udemycdn.com/course/480x270/1708340_7108_4.jpg 2x\">\r\n\r\n<h3>Flutter & Dart - The Complete Guide [2020 Edition]</h3>\r\n<p> A Complete Guide to the Flutter SDK & Flutter Framework for building native iOS and Android apps</p>\r\n</a>\r\n                  </div>\r\n                         \r\n                         \r\n                         \r\n                         \r\n                         ');

-- --------------------------------------------------------

--
-- Table structure for table `posts2`
--

CREATE TABLE `posts2` (
  `id` int(11) NOT NULL,
  `datetime` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='4';

--
-- Dumping data for table `posts2`
--

INSERT INTO `posts2` (`id`, `datetime`, `title`, `number`, `category`, `author`, `image`, `post`) VALUES
(1, 2020, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts2`
--
ALTER TABLE `posts2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `posts2`
--
ALTER TABLE `posts2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign_Relation` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
