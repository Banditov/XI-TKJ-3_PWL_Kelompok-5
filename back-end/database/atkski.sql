-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2025 at 04:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atkski`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `class` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `class`) VALUES
(1, 'Christopher Vittorio Constantine', 'christopher.011@ski.sch.id', 'XI-TKJ-3');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `price` int NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `color` varchar(10) NOT NULL DEFAULT 'Black',
  `is_bwt` int NOT NULL DEFAULT '0',
  `is_first` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `product_name`, `stock`, `price`, `image`, `color`, `is_bwt`, `is_first`) VALUES
(1, 1, 'Buku Tulis Sekolah', 50, 4500, '0011', 'Blue', 0, 1),
(2, 1, 'Buku Tulis Sekolah', 30, 4500, '0012', 'Pink', 0, 0),
(3, 1, 'Buku Tulis Sekolah', 20, 4500, '0013', 'Orange', 0, 0),
(4, 2, 'Buku Tulis Sekolah Besar', 40, 6000, '0021', 'None', 0, 1),
(5, 3, 'Buku Tulis Folio', 30, 7500, '0031', 'None', 0, 1),
(6, 4, 'Pulpen Joyko JK-100', 100, 2000, '0043', 'Black', 1, 1),
(7, 4, 'Pulpen Joyko JK-100', 40, 2000, '0042', 'Red', 1, 0),
(8, 4, 'Pulpen Joyko JK-100', 50, 2000, '0041', 'Blue', 1, 0),
(9, 5, 'Pulpen Gel Joyko GP-265', 80, 2500, '0053', 'Black', 1, 1),
(10, 5, 'Pulpen Gel Joyko GP-265', 70, 2500, '0052', 'Red', 1, 0),
(11, 5, 'Pulpen Gel Joyko GP-265', 50, 2500, '0051', 'Blue', 1, 0),
(12, 6, 'Tip-ex Joyko CT-522', 50, 5000, '0062', 'Blue', 1, 1),
(13, 6, 'Tip-ex Joyko CT-522', 40, 5000, '0061', 'Red', 1, 0),
(14, 6, 'Tip-ex Joyko CT-522', 30, 5000, '0063', 'Yellow', 1, 0),
(15, 7, 'Tip-ex Joyko CT-533', 40, 9000, '0071', 'Blue', 1, 1),
(16, 7, 'Tip-ex Joyko CT-533', 20, 9000, '0072', 'Green', 1, 0),
(17, 7, 'Tip-ex Joyko CT-533', 30, 9000, '0073', 'Pink', 1, 0),
(18, 8, 'Penggaris Joyko RL-ST15 15cm', 20, 5000, '0081', 'None', 1, 1),
(19, 9, 'Penggaris Joyko RL-ST20 20cm', 10, 6000, '0091', 'None', 1, 1),
(20, 10, 'Penggaris Joyko RL-ST30 30cm', 40, 7000, '0101', 'None', 1, 1),
(21, 11, 'Pensil Joyko P-8136', 50, 1000, '0111', 'None', 1, 1),
(22, 12, 'Pensil Joyko P-88', 80, 1000, '0121', 'None', 1, 1),
(23, 13, 'Staples Joyko HD-10CL', 30, 10000, '0131', 'Blue', 0, 1),
(24, 13, 'Staples Joyko HD-10CL', 10, 10000, '0132', 'Yellow', 0, 0),
(25, 13, 'Staples Joyko HD-10CL', 20, 10000, '0133', 'Red', 0, 0),
(26, 13, 'Staples Joyko HD-10CL', 30, 10000, '0134', 'Green', 0, 0),
(27, 14, 'Staples Joyko HD-10M', 40, 8000, '0141', 'Blue', 0, 1),
(28, 14, 'Staples Joyko HD-10M', 50, 8000, '0142', 'Green', 0, 0),
(29, 14, 'Staples Joyko HD-10M', 20, 8000, '0143', 'Yellow', 0, 0),
(30, 14, 'Staples Joyko HD-10M', 10, 8000, '0144', 'Red', 0, 0),
(31, 15, 'Isi Staples Montana RS10-20', 100, 2000, '0151', 'None', 0, 1),
(32, 16, 'Penghapus Joyko EB-40', 80, 1000, '0161', 'None', 1, 1),
(33, 17, 'Penghapus Joyko EB-30', 80, 1500, '0171', 'None', 1, 1),
(35, 18, 'Buku Tulis Notebook A4 Transparan', 30, 20000, '0181', 'None', 0, 1),
(36, 19, 'Buku Tulis Folio Paperline', 20, 20000, '0191', 'None', 0, 1),
(37, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 20, 23000, '0201', 'Black', 0, 1),
(38, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 10, 23000, '0202', 'Pink', 0, 0),
(39, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 30, 23000, '0203', 'White', 0, 0),
(40, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 20, 23000, '0204', 'Blue', 0, 0),
(41, 21, 'Spidol Warna-Warni Snowman', 10, 16000, '0211', 'None', 1, 1),
(42, 22, 'Spidol Board Snowman', 60, 10000, '0221', 'None', 1, 1),
(43, 23, 'Stabilo Joyko', 30, 6000, '0232', 'Blue', 1, 1),
(44, 23, 'Stabilo Joyko', 40, 6000, '0231', 'Red', 1, 0),
(45, 23, 'Stabilo Joyko', 20, 6000, '0233', 'Green', 1, 0),
(46, 23, 'Stabilo Joyko', 20, 6000, '0234', 'Yellow', 1, 0),
(47, 24, 'Pembatas Buku Joyko IM-31', 30, 10000, '0241', 'None', 0, 1),
(48, 25, 'Sticky Notes Joyko MMS-4', 30, 11000, '0251', 'None', 0, 1),
(49, 26, 'Peraut Kenko SP-362', 40, 1000, '0261', 'Blue', 1, 1),
(50, 26, 'Peraut Kenko SP-362', 40, 1000, '0263', 'Red', 1, 0),
(51, 26, 'Peraut Kenko SP-362', 20, 1000, '0262', 'Green', 1, 0),
(52, 26, 'Peraut Kenko SP-362', 30, 1000, '0264', 'Yellow', 1, 0),
(53, 27, 'Cutter Joyko L-500', 30, 20000, '0271', 'None', 0, 1),
(54, 28, 'Gunting Joyko SC-828', 20, 6000, '0281', 'None', 0, 1),
(55, 29, 'Gunting Joyko SC-838', 20, 9000, '0291', 'None', 0, 1),
(56, 30, 'Gunting Joyko SC-848', 10, 13000, '0301', 'None', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 8000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product` (`product_id`),
  ADD KEY `fk_customer` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
