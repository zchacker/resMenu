-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 08, 2022 at 01:48 PM
-- Server version: 10.6.5-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resmenu`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customerspayments`
--

DROP TABLE IF EXISTS `customerspayments`;
CREATE TABLE IF NOT EXISTS `customerspayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceStatus` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `paymentGateway` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentId` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionStatus` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardNumber` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file_name` (`file_name`) USING HASH,
  UNIQUE KEY `hash` (`hash`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `hash`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1658789069.jpg', '0971a0da3ac8762846c488f2b1d4fe27fc45ead0b2d9c14beb54b4d556898486', '2022-07-25 19:44:29', '2022-07-25 19:44:29', NULL),
(2, '1658821049.jpg', '37e385b69193a1cb2b700517c6d43f1c94cfa9cbf586a0a3495e34f465ad550e', '2022-07-26 04:37:29', '2022-07-26 04:37:29', NULL),
(3, '1658822561.jpg', 'fbaa15cd4af18081bc3091db581bc6d20847718414f2f93d9ed569baf2d6fa60', '2022-07-26 05:02:41', '2022-07-26 05:02:41', NULL),
(4, '1659611991.png', '41bfc6b6265f8f22887880fb32a2461caf8ad0d8f860d49b5728bb7b6552c539', '2022-08-04 08:19:51', '2022-08-04 08:19:51', NULL),
(5, '1659612083.png', 'a8074bd673745c08c36b6c0f27ab4fb3494c181333924523efefa3893a0c83c7', '2022-08-04 08:21:23', '2022-08-04 08:21:23', NULL),
(6, '1659718599.jpg', '8febc4f63a8ff24c7f96663fae5dc073f13ea2442983e8d6dd47584a47eb9c29', '2022-08-05 13:56:39', '2022-08-05 13:56:39', NULL),
(7, '1659720816.jpg', '37438f6975c2c78e0b39cee4bb32108dfa2745340140365b19961da89871c471', '2022-08-05 14:33:36', '2022-08-05 14:33:36', NULL),
(8, '1659720923.jpg', '8cfd60dbb04a825e3fac4162c3f0cc77d79e318e6d8e5ed95c3fa43a7f244529', '2022-08-05 14:35:23', '2022-08-05 14:35:23', NULL),
(9, '1659722770.jpg', '3c805988154bb6489120b1ef94731763cc42548245c91544be3ab3ebb8c46d09', '2022-08-05 15:06:10', '2022-08-05 15:06:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menucategories`
--

DROP TABLE IF EXISTS `menucategories`;
CREATE TABLE IF NOT EXISTS `menucategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title_ar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menucategories`
--

INSERT INTO `menucategories` (`id`, `menu_id`, `title_ar`, `title_en`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'المشروبات', 'المشروبات', '2022-07-20 18:28:26', '2022-07-27 19:27:29', NULL),
(2, 1, 'ساندويتشات', 'ساندويتشات', '2022-07-20 18:32:52', '2022-07-23 18:08:24', NULL),
(3, 1, 'المقبلات', 'المقبلات', '2022-08-04 08:18:53', '2022-08-04 08:18:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menueitems`
--

DROP TABLE IF EXISTS `menueitems`;
CREATE TABLE IF NOT EXISTS `menueitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `offer_price` float DEFAULT 0,
  `image_file_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menueitems`
--

INSERT INTO `menueitems` (`id`, `name`, `description`, `price`, `offer_price`, `image_file_id`, `menu_id`, `menu_category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'تارت كيك 123', 'مشروب', 15, 10, 7, 1, 2, '2022-07-25 19:44:29', '2022-08-05 14:35:03', NULL),
(2, 'سلطة', 'سمك', 12, 11.9, 8, 1, 2, '2022-07-26 04:14:31', '2022-08-05 14:35:44', NULL),
(3, 'عصير تفاح', 'الصحة والعافية', 12, NULL, 2, 1, 2, '2022-07-26 04:37:29', '2022-07-26 04:37:29', NULL),
(4, 'برجر', 'وصف كامل للمنتجات الجديدة في المتجر', 12, NULL, 3, 1, 2, '2022-07-26 05:02:41', '2022-07-26 05:02:41', NULL),
(5, 'عصير برتقال', 'لذيذ', 15, NULL, 2, 1, 1, '2022-07-28 19:42:00', '2022-08-05 15:05:53', '2022-08-05 15:05:53'),
(6, 'طعمية', 'لذيذة', 2, NULL, 3, 1, 2, '2022-07-28 19:42:26', '2022-07-28 19:42:26', NULL),
(7, 'حمص', 'حمص شامي', 10, NULL, 4, 1, 3, '2022-08-04 08:19:51', '2022-08-05 15:09:17', '2022-08-05 15:09:17'),
(8, 'مقبلات للوجبات', 'هي وجبة قبل الاكل', 5, 3, 9, 1, 3, '2022-08-04 08:21:23', '2022-08-05 15:09:10', '2022-08-05 15:09:10'),
(9, 'بيتزا', 'بيتزا ايطالية', 80, 50, 4, 1, 2, '2022-08-04 08:22:09', '2022-08-05 15:03:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restrant_id` int(11) NOT NULL,
  `templete_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restrant_id` (`restrant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `restrant_id`, `templete_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
CREATE TABLE IF NOT EXISTS `orderitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `comments` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT 1,
  `payment_type` enum('cash','credit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `restrant_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymenttransactions`
--

DROP TABLE IF EXISTS `paymenttransactions`;
CREATE TABLE IF NOT EXISTS `paymenttransactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `transaction_id` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restrants`
--

DROP TABLE IF EXISTS `restrants`;
CREATE TABLE IF NOT EXISTS `restrants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_hours` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slag` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restrants`
--

INSERT INTO `restrants` (`id`, `name`, `message`, `address`, `phone`, `working_hours`, `slug`, `avatar`, `cover`, `latitude`, `longitude`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'متجر السعادة', NULL, '3402 Iban Bin Othman Bin Affan', '+966536301031', '9 ص الى 8م', 'shop-now', NULL, NULL, 24.4808085, 39.5957803, 11, '2022-07-17 09:56:52', '2022-08-04 08:18:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `balance` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `is_active`, `balance`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 'Ahmed Moahmed Adam Nagem', 'mail@mail.com', '+966536301031', '$2y$10$p7/1BWLDHljnowNkgyqrR.mI/gF/Z2.gjc63kYf1WGRb6wbwy0Ggy', 1, 0, '2022-07-17 09:56:52', '2022-07-17 09:56:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userssubscriptions`
--

DROP TABLE IF EXISTS `userssubscriptions`;
CREATE TABLE IF NOT EXISTS `userssubscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
