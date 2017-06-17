-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2017 at 09:54 AM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vote`
--

-- --------------------------------------------------------

--
-- Table structure for table `contestants`
--

CREATE TABLE `contestants` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contestants`
--

INSERT INTO `contestants` (`id`, `user_id`, `position_id`, `active`) VALUES
(32, 17, 1, 1),
(34, 18, 2, 1),
(35, 19, 3, 1),
(36, 20, 1, 1),
(37, 21, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `user_id`, `position_id`, `contestant_id`, `created_at`) VALUES
(10, 17, 1, 32, '2017-06-16 07:01:18'),
(11, 17, 2, 34, '2017-06-16 07:01:18'),
(12, 17, 3, 35, '2017-06-16 07:01:18'),
(13, 20, 1, 36, '2017-06-16 07:32:10'),
(14, 20, 2, 34, '2017-06-16 07:32:10'),
(15, 20, 3, 35, '2017-06-16 07:32:10'),
(16, 18, 1, 32, '2017-06-16 07:34:39'),
(17, 18, 2, 34, '2017-06-16 07:34:39'),
(18, 18, 3, 35, '2017-06-16 07:34:39'),
(19, 21, 1, 32, '2017-06-16 07:39:17'),
(20, 21, 2, 34, '2017-06-16 07:39:18'),
(21, 21, 3, 35, '2017-06-16 07:39:18'),
(22, 21, 4, 37, '2017-06-16 07:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(1, 'President'),
(2, 'Vice - President'),
(3, 'Sec - General'),
(4, 'Academic Affairs');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voted` tinyint(1) NOT NULL DEFAULT '0',
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `email`, `password`, `voted`, `registered_at`, `role`) VALUES
(17, 'Muthami Geoffrey', '0716028726', '393 Ongata Rongai', 'ggeovry1@gmail.com', '$2y$10$LTFy1dhjl8In8EQFMQegruSBOr5pIb2.zdNb5JIvxtkjc/p37duH.', 1, '2017-06-16 07:40:28', 'admin'),
(18, 'Shera Shera', '0716028700', '292 Kangudo Machakos', 'shera@mail.com', '$2y$10$/.YmTcBuaE2zIOUjAXai3u0arfBi/yiB2zlLd7RiPZ9dKhmyzqe2S', 1, '2017-06-16 07:34:39', 'admin'),
(19, 'Daisy Macharia', '0790527265', '1234 Ruai', 'daisy@mail.com', '$2y$10$X17o8wDa7COPkUdNgQOaBOcRDjTPSlE9P/KutkMcfHwUCpfYO1xBm', 0, '2017-06-16 07:38:42', 'user'),
(20, 'John Doe', '0716028700', '393 Ongata Rongai', 'johndoe@mail.com', '$2y$10$4vxKkaN0JVbQr2CZtOK6nuBS4PXpP9QnPnsdDMC1JRV78nVBX476i', 1, '2017-06-16 07:32:10', 'user'),
(21, 'Ashley Juliet', '0838344444', '292 Makueni Machakos', 'ashley@mail.com', '$2y$10$46AuKz5wED0MinYVAFmGSu9rer8A2yKSks1AIMOpbZdC3.MtrETxW', 1, '2017-06-16 07:39:18', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contestants`
--
ALTER TABLE `contestants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contestants`
--
ALTER TABLE `contestants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
