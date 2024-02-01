-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2024 at 07:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tpra_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `commenttb_post_id` int(11) NOT NULL,
  `commenttb_user_id` int(11) NOT NULL,
  `comment_details` varchar(255) NOT NULL,
  `comment_status` int(11) NOT NULL DEFAULT 0,
  `comment_del` int(11) NOT NULL DEFAULT 0,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `like_posts`
--

CREATE TABLE `like_posts` (
  `liketb_id` int(11) NOT NULL,
  `liketb_user_id` int(11) NOT NULL,
  `liketb_post_id` int(11) NOT NULL,
  `like_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `like_status` int(11) NOT NULL COMMENT '1:like\r\n2:dislike',
  `like_del` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_details` text DEFAULT NULL,
  `post_photo` varchar(255) DEFAULT NULL,
  `post_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 : active\r\n1 : not active',
  `post_del` int(11) NOT NULL DEFAULT 0,
  `like_poststatus` varchar(100) DEFAULT 'a',
  `post_date` varchar(255) NOT NULL,
  `postdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_details`, `post_photo`, `post_status`, `post_del`, `like_poststatus`, `post_date`, `postdate`) VALUES
(1, 2, 'Test negative', 'Screenshot_20240126_115432_com.facebook.lite.jpg', 0, 0, '0', '2024-01-11', '2024-01-11 13:11:49'),
(9, 5, 'Pedri barcode ', '1701983620585.jpg', 0, 0, '0', '2024-01-21', '2024-01-21 20:06:06'),
(10, 9, 'helo', '1702886278395.jpg', 1, 0, '0', '2024-01-23', '2024-01-23 16:52:27'),
(12, 11, 'Test post for additional ', 'Screenshot_20240126_115432_com.facebook.lite.jpg', 0, 1, '0', '2024-01-26', '2024-01-26 21:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `reporttb_post_id` int(11) NOT NULL,
  `report_details` varchar(255) NOT NULL,
  `reporttb_user_id` int(11) NOT NULL,
  `report_date` varchar(255) NOT NULL,
  `report_action` int(11) NOT NULL DEFAULT 0,
  `reportdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `report_del` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saved_post`
--

CREATE TABLE `saved_post` (
  `savposttb_id` int(11) NOT NULL,
  `savposttb_user_id` int(11) NOT NULL,
  `savposttb_post_id` int(11) NOT NULL,
  `savposttb_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `savposttb_del` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 : active\r\n1 :non-active',
  `user_del` int(11) NOT NULL DEFAULT 0 COMMENT '0 : not delete\r\n1 : deleted',
  `user_image` varchar(255) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `full_name`, `email`, `address`, `department`, `phone`, `password`, `user_type`, `status`, `user_del`, `user_image`, `added_date`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'bhri', 'Managment', '0911125555', '123', 1, 0, 0, NULL, '2024-01-07 15:19:28'),
(2, 'ahmed', 'ahmed abdo ali', 'ahmed@gmail.com', 'sudan any', 'I.T', '0928999555', '123', 0, 0, 0, NULL, '2024-01-10 14:59:40'),
(5, 'osman', 'osman ', 'osman@gmail.com', 'kh', 'I.T', '59933566666', '123', 0, 0, 0, 'Screenshot_20240125_203845_com.facebook.lite.jpg', '2024-01-16 14:27:57'),
(9, 'doha', 'Yosif', 'lahstwvhu@gmail.com', 'Khartoum ', 'It', '096455418454', '123', 0, 0, 0, 'profile-6.png', '2024-01-23 16:12:27'),
(11, 'ali', 'Ali Ahmed', 'ali@gmail.com', 'bhri', 'I.T', '093285494', '123', 0, 0, 0, NULL, '2024-01-26 21:50:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `like_posts`
--
ALTER TABLE `like_posts`
  ADD PRIMARY KEY (`liketb_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `saved_post`
--
ALTER TABLE `saved_post`
  ADD PRIMARY KEY (`savposttb_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `like_posts`
--
ALTER TABLE `like_posts`
  MODIFY `liketb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `saved_post`
--
ALTER TABLE `saved_post`
  MODIFY `savposttb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
