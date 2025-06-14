-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 03:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `name`, `user_id`, `created_at`) VALUES
(45, 'کار شخصی', 1, '2025-06-13 11:25:28'),
(46, 'کار دانشگاه', 1, '2025-06-13 18:43:33'),
(47, 'مغازه', 1, '2025-06-13 18:44:02'),
(48, 'کار', 9, '2025-06-13 19:16:10'),
(49, 'دانشگاه', 9, '2025-06-13 19:16:18'),
(50, 'فروشگاه', 10, '2025-06-13 19:18:19'),
(51, 'منزل', 10, '2025-06-13 19:18:27'),
(52, 'کتابخانه', 11, '2025-06-13 19:20:20'),
(53, 'دانشگاه', 11, '2025-06-13 19:20:26'),
(54, 'جهاد دانشگاهی', 11, '2025-06-13 19:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `folder_id` int(10) UNSIGNED NOT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `user_id`, `folder_id`, `is_done`, `created_at`) VALUES
(34, 'باز کردن مغازه', 9, 48, 0, '2025-06-13 19:16:33'),
(35, 'ایجاد فاکتور فروش', 9, 48, 1, '2025-06-13 19:16:43'),
(36, 'رفتن به کتابخانه', 9, 49, 0, '2025-06-13 19:16:53'),
(37, 'تدریس زبان', 9, 49, 1, '2025-06-13 19:17:04'),
(38, 'خرید لوازم منزل', 10, 50, 0, '2025-06-13 19:18:46'),
(39, 'خرید کتاب', 10, 50, 0, '2025-06-13 19:19:01'),
(40, 'تعمیر کولر', 10, 51, 0, '2025-06-13 19:19:18'),
(41, 'تدریس فیزیک', 11, 54, 0, '2025-06-13 19:20:43'),
(42, 'تدریس برنامه نویسی', 11, 54, 0, '2025-06-13 19:20:51'),
(44, 'ملاقات با هیات علمی', 11, 53, 0, '2025-06-13 19:21:34'),
(45, 'انجام پایان نامه', 11, 53, 1, '2025-06-13 19:21:50'),
(46, 'پس دادن کتاب', 11, 52, 1, '2025-06-13 19:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(9, 'hassan', 'hassan@gmail.com', '$2y$10$0TPR8UcTyjOwWAGxG1DoKu8r/6okMs4inxmjcSTELYqSkRSHUZpVe', '2025-06-13 09:41:58'),
(10, 'ali', 'ali@gmail.com', '$2y$10$wjeMh6MLzkf2W3LZA23UceSdQZ/gLhP2eBubxdOLWYHgH1Y54dudm', '2025-06-13 10:52:45'),
(11, 'admin@gmail.com', 'admin@gmail.com', '$2y$10$J3t3/ap44dlqP8x6MV/avOW3wiIcmaM0yX1Mcbu99JqevcERN1sFG', '2025-06-13 19:19:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
