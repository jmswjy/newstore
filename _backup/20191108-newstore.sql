-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2019 at 03:34 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Samsung'),
(2, 'LG'),
(3, 'Sharp');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `brand_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `brand_id`, `qty`, `price`) VALUES
(1, 'TV Samsung A', NULL, 1, 10, 1000000),
(2, 'TV Samsung A1', NULL, 1, 10, 1000000),
(3, 'TV Samsung B', NULL, 1, 10, 1200000),
(4, 'TV Samsung C', NULL, 1, 10, 1300000),
(5, 'TV Samsung D', NULL, 1, 10, 1400000),
(6, 'TV Samsung E', NULL, 1, 10, 1500000),
(7, 'TV LG A', NULL, 2, 10, 1000000),
(8, 'TV LG A1', NULL, 2, 10, 1000000),
(9, 'TV LG B', NULL, 2, 10, 1200000),
(10, 'TV LG C', NULL, 2, 10, 1300000),
(11, 'TV LG D', NULL, 2, 10, 1400000),
(12, 'TV LG E', NULL, 2, 10, 1500000),
(13, 'TV Samsung F', NULL, 1, 10, 1000000),
(14, 'TV Samsung G', NULL, 1, 10, 1000000),
(15, 'TV Samsung H', NULL, 1, 10, 1200000),
(16, 'TV Samsung I', NULL, 1, 10, 1300000),
(17, 'TV Samsung J', NULL, 1, 10, 1400000),
(18, 'TV Samsung K', NULL, 1, 10, 1500000),
(19, 'TV LG F', NULL, 2, 10, 1000000),
(20, 'TV LG G', NULL, 2, 10, 1000000),
(21, 'TV LG H', NULL, 2, 10, 1200000),
(22, 'TV LG I', NULL, 2, 10, 1300000),
(23, 'TV LG J', NULL, 2, 10, 1400000),
(24, 'TV LG K', NULL, 2, 10, 1500000),
(25, 'TV Sharp A', NULL, 3, 10, 1000000),
(26, 'TV Sharp B', NULL, 3, 10, 1000000),
(27, 'TV Sharp C', NULL, 3, 10, 1200000),
(28, 'TV Sharp D', NULL, 3, 10, 1300000),
(29, 'TV Sharp E', NULL, 3, 10, 1400000),
(30, 'TV Sharp F', NULL, 3, 10, 1500000),
(31, 'TV Sharp G', NULL, 3, 10, 1000000),
(32, 'TV Sharp H', NULL, 3, 10, 1000000),
(33, 'TV Sharp I', NULL, 3, 10, 1200000),
(34, 'TV Sharp J', NULL, 3, 10, 1300000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_brand` (`brand_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
