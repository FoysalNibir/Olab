-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2018 at 09:25 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diagnostics`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'haematology', '2018-03-10 16:59:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon` varchar(20) NOT NULL,
  `discount` int(11) NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon`, `discount`, `end_date`, `created_at`, `updated_at`) VALUES
(3, 'Eid', 200, '2018-05-11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'May day', 50, '2018-05-04', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Adha', 200, '2018-05-12', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `self` tinyint(4) NOT NULL,
  `patient` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total` int(11) NOT NULL,
  `collection_date` date NOT NULL,
  `collection_time` time NOT NULL,
  `report_date` date NOT NULL,
  `report_time` time NOT NULL,
  `lab_reference` varchar(500) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT '0',
  `operation_user` int(11) NOT NULL,
  `field_collect_user` int(11) NOT NULL,
  `field_submit_user` int(11) NOT NULL,
  `report_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `self`, `patient`, `age`, `sex`, `user_id`, `status`, `phone`, `address`, `total`, `collection_date`, `collection_time`, `report_date`, `report_time`, `lab_reference`, `discount`, `operation_user`, `field_collect_user`, `field_submit_user`, `report_user`, `created_at`, `updated_at`) VALUES
(1, 0, 'Zahan', 40, 'male', 3, 'collected', '01758382828', 'Dhaka', 0, '2018-04-27', '11:00:00', '0000-00-00', '00:00:00', '', 0, 2, 2, 0, 0, '2018-05-02 11:20:14', '2018-05-02 05:20:14'),
(2, 1, 'Foysal', 24, 'male', 4, 'operation', '01834220061', 'dhaka', -50, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 0, 0, 0, 0, '2018-05-02 09:56:12', '2018-05-02 03:56:12'),
(3, 1, 'Foysal', 24, 'male', 4, 'deliverred', '01834220061', 'dhaka', 0, '2018-05-02', '01:01:00', '2018-05-02', '01:00:00', '12', 0, 2, 2, 2, 2, '2018-05-02 11:20:48', '2018-05-02 05:20:48'),
(4, 1, 'Foysal', 24, 'male', 4, 'field', '01834220061', 'dhaka', 0, '2018-05-03', '01:11:00', '0000-00-00', '00:00:00', '', 0, 2, 0, 0, 0, '2018-05-02 11:19:14', '2018-05-02 05:19:14'),
(5, 1, 'Foysal', 24, 'male', 4, 'call_missed', '01834220061', 'dhaka', 0, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 2, 0, 0, 0, '2018-05-02 11:19:19', '2018-05-02 05:19:19'),
(6, 1, 'Foysal', 24, 'male', 4, 'operation', '01834220061', 'dhaka', 0, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 0, 0, 0, 0, '2018-05-02 04:05:07', '2018-05-02 04:05:07'),
(7, 1, 'Foysal', 24, 'male', 4, 'call_missed', '01834220061', 'dhaka', 0, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 2, 0, 0, 0, '2018-05-02 11:19:44', '2018-05-02 05:19:44'),
(8, 1, 'Foysal', 24, 'male', 4, 'operation', '01834220061', 'dhaka', 550, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 0, 0, 0, 0, '2018-05-02 10:06:42', '2018-05-02 04:06:42'),
(9, 1, 'Foysal', 24, 'male', 4, 'operation', '01834220061', 'dhaka', 1050, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 0, 0, 0, 0, '2018-05-02 10:24:00', '2018-05-02 04:24:00'),
(10, 1, 'zahan', 5, 'male', 2, 'operation', '01704961566', 'house 35 , road 7 banani dhaka', 1100, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 0, 0, 0, 0, '2018-05-02 04:52:12', '2018-05-02 04:52:12'),
(11, 1, 'zahan', 5, 'male', 2, 'operation', '01704961566', 'house 35 , road 7 banani dhaka', 900, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 200, 0, 0, 0, 0, '2018-05-02 04:53:35', '2018-05-02 04:53:35'),
(12, 1, 'Foysal Nibir', 24, 'male', 3, 'operation', '01758382828', 'Dhaka', 1100, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 0, 0, 0, 0, '2018-05-02 06:07:36', '2018-05-02 06:07:36'),
(13, 1, 'luna', 34, 'female', 6, 'operation', '01714606599', 'Dhaka', 900, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 200, 0, 0, 0, 0, '2018-05-06 03:10:00', '2018-05-06 03:10:00'),
(14, 0, 'ASD', 34, 'male', 3, 'operation', '01758382828', 'Dhaka', 900, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 200, 0, 0, 0, 0, '2018-05-10 03:02:03', '2018-05-10 03:02:03'),
(15, 0, 'sxa', 32, 'male', 3, 'operation', '01758382828', 'Dhaka', 1100, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 0, 0, 0, 0, '2018-05-10 03:04:03', '2018-05-10 03:04:03'),
(16, 0, 'bal', 44, 'male', 4, 'operation', '01711111111', 'bogura', 400, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 200, 0, 0, 0, 0, '2018-05-10 03:25:22', '2018-05-10 03:25:22'),
(17, 0, 'bal', 44, 'male', 4, 'operation', '01711111111', 'bogura', 600, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 0, 0, 0, 0, '2018-05-10 03:48:39', '2018-05-10 03:48:39'),
(18, 1, 'Foysal Nibir', 24, 'male', 3, 'operation', '01758382828', 'Dhaka', 1100, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 0, 0, 0, 0, 0, '2018-05-16 00:59:08', '2018-05-16 00:59:08'),
(19, 1, 'luna', 34, 'female', 6, 'field', '01714606599', 'Dhaka', 1100, '2018-05-26', '22:55:00', '0000-00-00', '00:00:00', '', 200, 2, 0, 0, 0, '2018-05-27 03:59:35', '2018-05-26 21:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_test`
--

CREATE TABLE `order_test` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `lab_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_report` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_test`
--

INSERT INTO `order_test` (`id`, `order_id`, `test_id`, `lab_entry`, `lab_report`, `created_at`, `updated_at`) VALUES
(10, 14, 1, '2018-03-29 08:35:25', '0000-00-00 00:00:00', '2018-03-29 02:35:25', '2018-03-29 02:35:25'),
(11, 14, 2, '2018-03-29 08:35:25', '0000-00-00 00:00:00', '2018-03-29 02:35:25', '2018-03-29 02:35:25'),
(12, 15, 1, '2018-04-01 11:33:00', '0000-00-00 00:00:00', '2018-04-01 05:33:00', '2018-04-01 05:33:00'),
(13, 15, 2, '2018-04-01 11:33:00', '0000-00-00 00:00:00', '2018-04-01 05:33:00', '2018-04-01 05:33:00'),
(14, 16, 2, '2018-04-01 11:34:29', '0000-00-00 00:00:00', '2018-04-01 05:34:29', '2018-04-01 05:34:29'),
(15, 17, 2, '2018-04-01 11:34:37', '0000-00-00 00:00:00', '2018-04-01 05:34:37', '2018-04-01 05:34:37'),
(16, 18, 2, '2018-04-01 11:34:45', '0000-00-00 00:00:00', '2018-04-01 05:34:45', '2018-04-01 05:34:45'),
(17, 19, 1, '2018-04-19 08:45:20', '0000-00-00 00:00:00', '2018-04-19 02:45:20', '2018-04-19 02:45:20'),
(18, 19, 2, '2018-04-19 08:45:21', '0000-00-00 00:00:00', '2018-04-19 02:45:21', '2018-04-19 02:45:21'),
(19, 20, 1, '2018-04-23 08:46:08', '0000-00-00 00:00:00', '2018-04-23 02:46:08', '2018-04-23 02:46:08'),
(20, 20, 2, '2018-04-23 08:46:08', '0000-00-00 00:00:00', '2018-04-23 02:46:08', '2018-04-23 02:46:08'),
(21, 21, 1, '2018-04-23 08:46:48', '0000-00-00 00:00:00', '2018-04-23 02:46:48', '2018-04-23 02:46:48'),
(22, 22, 1, '2018-04-23 09:59:19', '0000-00-00 00:00:00', '2018-04-23 03:59:19', '2018-04-23 03:59:19'),
(23, 23, 2, '2018-04-23 10:00:52', '0000-00-00 00:00:00', '2018-04-23 04:00:52', '2018-04-23 04:00:52'),
(24, 24, 1, '2018-04-24 05:56:45', '0000-00-00 00:00:00', '2018-04-23 23:56:45', '2018-04-23 23:56:45'),
(25, 25, 2, '2018-04-24 05:58:46', '0000-00-00 00:00:00', '2018-04-23 23:58:46', '2018-04-23 23:58:46'),
(26, 26, 1, '2018-04-24 09:27:06', '0000-00-00 00:00:00', '2018-04-24 09:27:06', '0000-00-00 00:00:00'),
(27, 26, 2, '2018-04-24 09:27:06', '0000-00-00 00:00:00', '2018-04-24 09:27:06', '0000-00-00 00:00:00'),
(28, 27, 1, '2018-04-24 09:28:59', '0000-00-00 00:00:00', '2018-04-24 09:28:59', '0000-00-00 00:00:00'),
(29, 27, 2, '2018-04-24 09:28:59', '0000-00-00 00:00:00', '2018-04-24 09:28:59', '0000-00-00 00:00:00'),
(30, 28, 1, '2018-04-24 09:34:51', '0000-00-00 00:00:00', '2018-04-24 09:34:51', '0000-00-00 00:00:00'),
(31, 28, 2, '2018-04-24 09:34:51', '0000-00-00 00:00:00', '2018-04-24 09:34:51', '0000-00-00 00:00:00'),
(32, 29, 2, '2018-04-24 10:50:37', '0000-00-00 00:00:00', '2018-04-24 10:50:37', '0000-00-00 00:00:00'),
(33, 30, 1, '2018-04-25 07:27:33', '0000-00-00 00:00:00', '2018-04-25 07:27:33', '0000-00-00 00:00:00'),
(34, 31, 1, '2018-04-25 07:30:05', '0000-00-00 00:00:00', '2018-04-25 07:30:05', '0000-00-00 00:00:00'),
(35, 31, 2, '2018-04-25 07:30:05', '0000-00-00 00:00:00', '2018-04-25 07:30:05', '0000-00-00 00:00:00'),
(36, 1, 1, '2018-04-26 10:59:19', '0000-00-00 00:00:00', '2018-04-26 10:59:19', '0000-00-00 00:00:00'),
(37, 1, 2, '2018-04-26 10:59:19', '0000-00-00 00:00:00', '2018-04-26 10:59:19', '0000-00-00 00:00:00'),
(38, 2, 1, '2018-05-02 09:56:12', '0000-00-00 00:00:00', '2018-05-02 09:56:12', '0000-00-00 00:00:00'),
(39, 3, 1, '2018-05-02 10:01:54', '0000-00-00 00:00:00', '2018-05-02 10:01:54', '0000-00-00 00:00:00'),
(40, 4, 1, '2018-05-02 10:03:37', '0000-00-00 00:00:00', '2018-05-02 10:03:37', '0000-00-00 00:00:00'),
(41, 5, 1, '2018-05-02 10:04:27', '0000-00-00 00:00:00', '2018-05-02 10:04:27', '0000-00-00 00:00:00'),
(42, 6, 1, '2018-05-02 10:05:07', '0000-00-00 00:00:00', '2018-05-02 10:05:07', '0000-00-00 00:00:00'),
(43, 7, 1, '2018-05-02 10:06:33', '0000-00-00 00:00:00', '2018-05-02 10:06:33', '0000-00-00 00:00:00'),
(44, 8, 1, '2018-05-02 10:06:42', '0000-00-00 00:00:00', '2018-05-02 10:06:42', '0000-00-00 00:00:00'),
(45, 9, 1, '2018-05-02 10:24:00', '0000-00-00 00:00:00', '2018-05-02 10:24:00', '0000-00-00 00:00:00'),
(46, 9, 2, '2018-05-02 10:24:00', '0000-00-00 00:00:00', '2018-05-02 10:24:00', '0000-00-00 00:00:00'),
(47, 10, 1, '2018-05-02 10:52:12', '0000-00-00 00:00:00', '2018-05-02 10:52:12', '0000-00-00 00:00:00'),
(48, 10, 2, '2018-05-02 10:52:12', '0000-00-00 00:00:00', '2018-05-02 10:52:12', '0000-00-00 00:00:00'),
(49, 11, 1, '2018-05-02 10:53:35', '0000-00-00 00:00:00', '2018-05-02 10:53:35', '0000-00-00 00:00:00'),
(50, 11, 2, '2018-05-02 10:53:35', '0000-00-00 00:00:00', '2018-05-02 10:53:35', '0000-00-00 00:00:00'),
(51, 12, 1, '2018-05-02 12:07:36', '0000-00-00 00:00:00', '2018-05-02 12:07:36', '0000-00-00 00:00:00'),
(52, 12, 2, '2018-05-02 12:07:36', '0000-00-00 00:00:00', '2018-05-02 12:07:36', '0000-00-00 00:00:00'),
(53, 13, 1, '2018-05-06 09:10:00', '0000-00-00 00:00:00', '2018-05-06 09:10:00', '0000-00-00 00:00:00'),
(54, 13, 2, '2018-05-06 09:10:00', '0000-00-00 00:00:00', '2018-05-06 09:10:00', '0000-00-00 00:00:00'),
(55, 14, 1, '2018-05-10 09:02:03', '0000-00-00 00:00:00', '2018-05-10 09:02:03', '0000-00-00 00:00:00'),
(56, 14, 2, '2018-05-10 09:02:03', '0000-00-00 00:00:00', '2018-05-10 09:02:03', '0000-00-00 00:00:00'),
(57, 15, 1, '2018-05-10 09:04:03', '0000-00-00 00:00:00', '2018-05-10 09:04:03', '0000-00-00 00:00:00'),
(58, 15, 2, '2018-05-10 09:04:03', '0000-00-00 00:00:00', '2018-05-10 09:04:03', '0000-00-00 00:00:00'),
(59, 16, 1, '2018-05-10 09:25:22', '0000-00-00 00:00:00', '2018-05-10 09:25:22', '0000-00-00 00:00:00'),
(60, 17, 1, '2018-05-10 09:48:40', '0000-00-00 00:00:00', '2018-05-10 09:48:40', '0000-00-00 00:00:00'),
(61, 18, 1, '2018-05-16 06:59:08', '0000-00-00 00:00:00', '2018-05-16 06:59:08', '0000-00-00 00:00:00'),
(62, 18, 2, '2018-05-16 06:59:08', '0000-00-00 00:00:00', '2018-05-16 06:59:08', '0000-00-00 00:00:00'),
(63, 19, 1, '2018-05-27 03:57:16', '0000-00-00 00:00:00', '2018-05-27 03:57:16', '0000-00-00 00:00:00'),
(64, 19, 2, '2018-05-27 03:57:16', '0000-00-00 00:00:00', '2018-05-27 03:57:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `test` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test`, `price`, `active`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'CBC', 600, 1, 1, '2018-05-01 11:37:01', '2018-05-01 05:37:01'),
(2, 'ESR', 500, 1, 1, '2018-04-26 12:07:22', '2018-04-26 06:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `email` varchar(500) NOT NULL DEFAULT '',
  `address` varchar(500) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `isactive` tinyint(4) NOT NULL DEFAULT '0',
  `ban` tinyint(4) NOT NULL DEFAULT '0',
  `coupon_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `password`, `remember_token`, `age`, `sex`, `email`, `address`, `blood_group`, `isactive`, `ban`, `coupon_id`, `created_at`, `updated_at`) VALUES
(2, 'zahan', '01704961566', '$2y$10$vvYoBxRV9DZu.1MRFJZcRuA4VgkavG7wX3lKcGwY5D29MCrTf2/1y', '0PoZXBFc7X9WSkj2ev9KQwSDbpVXC2IC6YnucZSTG5TYzoucsWanUl8Ogi36', 5, 'male', 'safallwa@gmail.com', 'house 35 , road 7 banani dhaka', 'B+', 1, 0, 5, '2018-06-12 04:32:43', '2018-06-11 22:32:43'),
(3, 'Foysal Nibir', '01758382828', '$2y$10$6ZJnErGEZXwT0ecY.jLBZe0LZ8Pm8m7JdjQACl9cQSlZNhBobfSwe', 'MxRTda2nYUwo3P3duF8fueqG0Arj2TU84DUCd4TbuXxaCoPZqR1xgQOHHkXP', 24, 'male', 'nibir2k12@live.com', 'Dhaka', 'AB+', 1, 0, 0, '2018-05-21 16:37:57', '2018-05-21 10:37:57'),
(4, 'Foysal', '01834220061', '$2y$10$G.klbo/WHfsxvaQaVhNgquNNvotQOvnnjDuVJsq4VTFt4f6ku3b1W', 'Da2bu1qso6XUjwqHKGHffKKhcFvJCKpMnm0KkvGpo6gC5Z2lvOSaHvMQ75lo', 24, 'male', 'nibir2k12@live.com', 'dhaka', 'AB+', 1, 0, 3, '2018-05-16 09:05:44', '2018-05-16 03:05:44'),
(5, 'Nibir', '01712853334', '$2y$10$UqdCyKJaofkSdqPlydrNvOwDPiuluUBSFJyf9zLHzWYGypcakKpnm', '', 20, 'male', 'foysal@gmail.com', 'Dhaka', 'AB+', 1, 0, 0, '2018-05-02 06:00:25', '2018-05-02 06:00:25'),
(6, 'luna', '01714606599', '$2y$10$NrmCiJCbgxK1XOxRdkiodeubOy45Q0MhwCwOlIo2RfEScAyIniFWu', 'Ef1DtYCqIbGIW0EtsolAhoI6TdDXRVwMQZlFTLNP7YsrMuH4BAY4tRKfyaru', 34, 'female', 'hello@gmail.com', 'Dhaka', 'B+', 1, 0, 3, '2018-05-27 03:58:00', '2018-05-26 21:58:00'),
(7, 'foysal', '01742406525', '$2y$10$eBI68LKEG/lQTzA.bhoO4umXRRZyRDTsF0ygN0ea.IdauIzKI.Tpu', '', 0, '', '', '', '', 0, 0, 0, '2018-05-06 05:58:49', '2018-05-06 05:58:49'),
(8, 'foysal', '01742406555', '$2y$10$LgrbUkfke6CxmD4bSgPyqOA/lnn7VPlcAhFoe9y19rEO7T.E/V8CW', '', 0, '', '', '', '', 0, 0, 0, '2018-05-06 05:59:33', '2018-05-06 05:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `usertokens`
--

CREATE TABLE `usertokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `usertoken` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertokens`
--

INSERT INTO `usertokens` (`id`, `user_id`, `usertoken`, `created_at`, `updated_at`) VALUES
(1, 4, '1', '2018-05-06 10:18:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int(11) NOT NULL,
  `type` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'client', '2018-03-11 10:53:27', '0000-00-00 00:00:00'),
(2, 'operation', '2018-03-10 12:19:44', '0000-00-00 00:00:00'),
(3, 'field', '2018-03-10 12:19:51', '0000-00-00 00:00:00'),
(4, 'report', '2018-03-11 09:14:01', '0000-00-00 00:00:00'),
(5, 'admin', '2018-03-10 12:20:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `type` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'client', '2018-03-11 10:53:27', '0000-00-00 00:00:00'),
(2, 'operation', '2018-03-10 12:19:44', '0000-00-00 00:00:00'),
(3, 'field', '2018-03-10 12:19:51', '0000-00-00 00:00:00'),
(4, 'report', '2018-03-11 09:14:01', '0000-00-00 00:00:00'),
(5, 'admin', '2018-03-10 12:20:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_user_type`
--

CREATE TABLE `user_user_type` (
  `id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_user_type`
--

INSERT INTO `user_user_type` (`id`, `user_type_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 3, 2, '2018-03-10 15:21:00', '0000-00-00 00:00:00'),
(5, 5, 2, '2018-04-01 14:36:16', '0000-00-00 00:00:00'),
(6, 1, 6, '2018-04-03 03:42:35', '2018-04-03 03:42:35'),
(7, 1, 7, '2018-04-23 22:51:14', '2018-04-23 22:51:14'),
(8, 2, 8, '2018-04-24 10:25:30', '0000-00-00 00:00:00'),
(9, 1, 9, '2018-04-25 07:12:17', '0000-00-00 00:00:00'),
(10, 1, 10, '2018-04-25 07:24:22', '0000-00-00 00:00:00'),
(11, 4, 2, '2018-04-25 08:09:00', '0000-00-00 00:00:00'),
(15, 2, 2, '2018-04-25 08:23:03', '0000-00-00 00:00:00'),
(16, 1, 3, '2018-04-26 10:58:00', '0000-00-00 00:00:00'),
(17, 1, 4, '2018-05-02 07:13:53', '0000-00-00 00:00:00'),
(18, 1, 2, '2018-05-02 11:56:33', '0000-00-00 00:00:00'),
(19, 1, 5, '2018-05-02 12:00:25', '0000-00-00 00:00:00'),
(20, 2, 5, '2018-05-02 12:00:25', '0000-00-00 00:00:00'),
(21, 1, 6, '2018-05-06 07:19:33', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupon` (`coupon`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_test`
--
ALTER TABLE `order_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_phone_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertokens`
--
ALTER TABLE `usertokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `user_token` (`usertoken`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_user_type`
--
ALTER TABLE `user_user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_test`
--
ALTER TABLE `order_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usertokens`
--
ALTER TABLE `usertokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_user_type`
--
ALTER TABLE `user_user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
