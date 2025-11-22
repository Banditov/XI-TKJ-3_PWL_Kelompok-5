-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2025 at 05:02 AM
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
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `class` varchar(20) NOT NULL,
  `is_admin` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `password`, `class`, `is_admin`) VALUES
(20, 'ADMIN', 'admin@ski.sch.id', '$2y$10$UOhhSbmqHyC65.sXuWL3Q.qed3FIYLS5QF8sR5HgosZoEMWliWUl6', '-', 1),
(22, 'Christopher Vittorio Constantine', 'christopher.001@ski.sch.id', '$2y$10$TDaBF5Ec8yZ7ptyRaXF7h./PlTOP3khadlBTtO5O3WhvmKKvxURNi', 'XI-TKJ-3', 0),
(23, 'Mario Carrick', 'mario.001@ski.sch.id', '$2y$10$4fsUmfCuTshcQJJncsb/SOdZpmDp1UzyoI5XfaR/xhOnPtC0c55eu', 'XI-BID', 0),
(24, 'Winsen Chandra', 'winsen.001@ski.sch.id', '$2y$10$mD7./6RoHUBSDIHncy1ljecfOyY9RYLIvUCLa/1oOsjhFhJ3YwkL6', 'XI-AKL', 0),
(25, 'Richard Marcell', 'richard_m@ski.sch.id', '$2y$10$VQDydUl0Y3JMXPewPQkhV.3RUxG29/eAUAXKzutop/4DBtqfhPhW2', '-', 0),
(26, 'William', 'william@ski.sch.id', '$2y$10$UKTOBsqONrXdfHxKhI5niuwwHe.szockJtdsicIgyuQYRS1aFlWmy', '-', 0),
(27, 'Vinska', 'vinska@ski.sch.id', '$2y$10$KFFB/6TgUzBJ93j.DbXUfOiR58fBbCcQdSdTGZQ4dwlQAJIYmMV9a', '-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `child_category`
--

CREATE TABLE `child_category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `child_category`
--

INSERT INTO `child_category` (`id`, `name`, `parent_id`) VALUES
(1, 'Pensil', 1),
(2, 'Pen', 1),
(3, 'Penghapus', 1),
(4, 'Penggaris', 1),
(5, 'Tip-ex', 1),
(6, 'Buku Sekolah', 2),
(8, 'Kertas', 2),
(9, 'Buku', 2),
(10, 'Gunting', 3),
(11, 'Lem', 3),
(12, 'Cutter', 3),
(13, 'Sticky Notes', 3),
(14, 'Bookmark', 3),
(15, 'Folder', 4),
(16, 'Paper Clip', 4),
(17, 'Krayon', 5),
(18, 'Pensil Warna', 5),
(19, 'Spidol Warna', 5),
(20, 'Staples', 3),
(21, 'Kalkulator', 3),
(22, 'Spidol', 1),
(23, 'Stabilo', 3),
(24, 'Peraut', 1),
(25, 'Pin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int NOT NULL,
  `question` varchar(999) NOT NULL,
  `answer` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'Bagaimana cara memesan produk?', 'Anda cukup menambahkan produk ke keranjang, lalu lanjut ke halaman keranjang tersebut dan tekan \"Checkout\".'),
(2, 'Kapan pesanan bisa diambil?', 'Pesanan dapat diambil setelah Anda menerima notifikasi bahwa pesanan sudah siap. Biasanya pesanan siap dalam 1-3 hari kerja setelah pembayaran dikonfirmasi.'),
(3, 'Bagaimana cara mengetahui pesanan saya sudah siap diambil?', 'Setelah pesanan Anda diproses, kami akan mengirim notifikasi melalui email bahwa barang sudah siap diambil di tempat yang sudah ditentukan.'),
(4, 'Apakah bisa menitipkan orang lain untuk mengambil pesanan?', 'Ya, Anda bisa menitipkan orang lain untuk mengambil pesanan dengan membawa bukti pemesanan dan identitas yang jelas.'),
(5, 'Apakah semua produk tersedia secara online?', 'Ya, semua produk yang tercantum di website ini bisa dibeli secara online. Namun, ketersediaan stok dapat berubah sewaktu-waktu.'),
(6, 'Apa saja produk yang tersedia di website ini?', 'Kami menyediakan berbagai alat tulis kantor atau sekolah seperti pulpen, pensil, correction tape, serta perlengkapan kantor seperti stapler, gunting, kalkulator, dan lainnya.'),
(7, 'Bagaimana cara membayar?', 'Setelah pesanan anda sudah siap, pergi ke perpustakaan SMK Kristen Immanuel dan bayar secara langsung. Setelah dibayar, pesanan anda akan diberikan kepada anda.'),
(8, 'Berapa lama pesanan dapat disiapkan?', 'Tergantung dengan kesibukan pihak perpustakaan, pesanan dapat disiapkan di hari yang sama atau 3 hari setelah pemesanan.'),
(9, 'Apakah bisa melakukan pre-order untuk barang yang sedang habis?', 'Tidak, dikarenakan kekurangan fitur dari website ini, anda masih belum dapat melakukan pre-order untuk produk-produk yang sudah habis.'),
(10, 'Dimana saya dapat mengambil pesanan saya?', 'Setelah pesanan anda sudah siap, anda dapat mengambilnya di perpustakaan SMK Kristen Immanuel.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `customer_id` int NOT NULL,
  `total_amount` int NOT NULL,
  `order_date` date NOT NULL,
  `status` enum('Pending','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `act` enum('Not Ready','Ready','Completed','Cancelled') NOT NULL DEFAULT 'Not Ready',
  `isnt_shown` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_category`
--

CREATE TABLE `parent_category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `parent_category`
--

INSERT INTO `parent_category` (`id`, `name`) VALUES
(1, 'Alat Tulis'),
(2, 'Buku & Kertas'),
(3, 'Perlengkapan Lain'),
(4, 'Alat File'),
(5, 'Perlengkapan Seni');

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
  `category_parent_id` int NOT NULL,
  `category_id` int NOT NULL,
  `is_first` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `product_name`, `stock`, `price`, `image`, `color`, `category_parent_id`, `category_id`, `is_first`) VALUES
(1, 1, 'Buku Tulis Sekolah', 38, 4500, '0011', 'Blue', 2, 6, 1),
(2, 1, 'Buku Tulis Sekolah', 32, 4500, '0012', 'Pink', 2, 6, 0),
(3, 1, 'Buku Tulis Sekolah', 20, 4500, '0013', 'Orange', 2, 6, 0),
(4, 2, 'Buku Tulis Sekolah Besar', 40, 6000, '0021', 'None', 2, 6, 1),
(5, 3, 'Buku Tulis Folio', 29, 7500, '0031', 'None', 2, 6, 1),
(6, 4, 'Pulpen Joyko JK-100', 103, 2000, '0043', 'Black', 1, 2, 1),
(7, 4, 'Pulpen Joyko JK-100', 46, 2000, '0042', 'Red', 1, 2, 0),
(8, 4, 'Pulpen Joyko JK-100', 48, 2000, '0041', 'Blue', 1, 2, 0),
(9, 5, 'Pulpen Gel Joyko GP-265', 75, 2500, '0053', 'Black', 1, 2, 1),
(10, 5, 'Pulpen Gel Joyko GP-265', 67, 2500, '0052', 'Red', 1, 2, 0),
(11, 5, 'Pulpen Gel Joyko GP-265', 48, 2500, '0051', 'Blue', 1, 2, 0),
(12, 6, 'Tip-ex Joyko CT-522', 46, 5000, '0062', 'Blue', 1, 5, 1),
(13, 6, 'Tip-ex Joyko CT-522', 39, 5000, '0061', 'Red', 1, 5, 0),
(14, 6, 'Tip-ex Joyko CT-522', 34, 5000, '0063', 'Yellow', 1, 5, 0),
(15, 7, 'Tip-ex Joyko CT-533', 35, 9000, '0071', 'Blue', 1, 5, 1),
(16, 7, 'Tip-ex Joyko CT-533', 19, 9000, '0072', 'Green', 1, 5, 0),
(17, 7, 'Tip-ex Joyko CT-533', 28, 9000, '0073', 'Pink', 1, 5, 0),
(18, 8, 'Penggaris Joyko RL-ST15 15cm', 24, 5000, '0081', 'None', 1, 4, 1),
(19, 9, 'Penggaris Joyko RL-ST20 20cm', 12, 6000, '0091', 'None', 1, 4, 1),
(20, 10, 'Penggaris Joyko RL-ST30 30cm', 36, 7000, '0101', 'None', 1, 4, 1),
(21, 11, 'Pensil Joyko P-8136', 46, 1000, '0111', 'None', 1, 1, 1),
(22, 12, 'Pensil Joyko P-88', 78, 1000, '0121', 'None', 1, 1, 1),
(23, 13, 'Staples Joyko HD-10CL', 28, 10000, '0131', 'Blue', 3, 20, 1),
(24, 13, 'Staples Joyko HD-10CL', 7, 10000, '0132', 'Yellow', 3, 20, 0),
(25, 13, 'Staples Joyko HD-10CL', 19, 10000, '0133', 'Red', 3, 20, 0),
(26, 13, 'Staples Joyko HD-10CL', 27, 10000, '0134', 'Green', 3, 20, 0),
(27, 14, 'Staples Joyko HD-10M', 34, 8000, '0141', 'Blue', 3, 20, 1),
(28, 14, 'Staples Joyko HD-10M', 47, 8000, '0142', 'Green', 3, 20, 0),
(29, 14, 'Staples Joyko HD-10M', 18, 8000, '0143', 'Yellow', 3, 20, 0),
(30, 14, 'Staples Joyko HD-10M', 12, 8000, '0144', 'Red', 3, 20, 0),
(31, 15, 'Isi Staples Montana RS10-20', 105, 2000, '0151', 'None', 3, 20, 1),
(32, 16, 'Penghapus Joyko EB-40', 84, 1000, '0161', 'None', 1, 3, 1),
(33, 17, 'Penghapus Joyko EB-30', 77, 1500, '0171', 'None', 1, 3, 1),
(35, 18, 'Buku Tulis Notebook A4 Transparan', 29, 20000, '0181', 'None', 2, 9, 1),
(36, 19, 'Buku Tulis Folio Paperline', 19, 20000, '0191', 'None', 2, 9, 1),
(37, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 19, 23000, '0201', 'Black', 3, 21, 1),
(38, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 10, 23000, '0202', 'Pink', 3, 21, 0),
(39, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 27, 23000, '0203', 'White', 3, 21, 0),
(40, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 22, 23000, '0204', 'Blue', 3, 21, 0),
(41, 21, 'Spidol Warna-Warni Snowman', 12, 16000, '0211', 'None', 5, 19, 1),
(42, 22, 'Spidol Board Snowman', 56, 10000, '0221', 'None', 1, 22, 1),
(43, 23, 'Stabilo Joyko', 25, 6000, '0232', 'Blue', 3, 23, 1),
(44, 23, 'Stabilo Joyko', 38, 6000, '0231', 'Red', 3, 23, 0),
(45, 23, 'Stabilo Joyko', 15, 6000, '0233', 'Green', 3, 23, 0),
(46, 23, 'Stabilo Joyko', 20, 6000, '0234', 'Yellow', 3, 23, 0),
(47, 24, 'Bookmark Joyko IM-31', 29, 10000, '0241', 'None', 3, 14, 1),
(48, 25, 'Sticky Notes Joyko MMS-4', 30, 9500, '0251', 'None', 3, 13, 1),
(49, 26, 'Peraut Kenko SP-362', 33, 1000, '0261', 'Blue', 1, 24, 1),
(50, 26, 'Peraut Kenko SP-362', 40, 1000, '0263', 'Red', 1, 24, 0),
(51, 26, 'Peraut Kenko SP-362', 17, 1000, '0262', 'Green', 1, 24, 0),
(52, 26, 'Peraut Kenko SP-362', 25, 1000, '0264', 'Yellow', 1, 24, 0),
(53, 27, 'Cutter Joyko L-500', 29, 14000, '0271', 'None', 3, 12, 1),
(54, 28, 'Gunting Joyko SC-828', 23, 6000, '0281', 'None', 3, 10, 1),
(55, 29, 'Gunting Joyko SC-838', 20, 9000, '0291', 'None', 3, 10, 1),
(56, 30, 'Gunting Joyko SC-848', 14, 13000, '0301', 'None', 3, 10, 1),
(57, 31, 'Selotip Putih', 23, 10000, '0311', 'None', 3, 11, 1),
(58, 32, 'Cutter SAILORMAN', 21, 4000, '0321', 'None', 3, 12, 1),
(59, 33, 'Pulpen Hapus Gel Joyko GP-322', 47, 6000, '0331', 'None', 1, 2, 1),
(60, 34, 'Krayon Oil Joyko', 4, 30000, '0341', 'None', 5, 17, 1),
(61, 35, 'Ordner', 8, 9000, '0351', 'Black', 4, 15, 1),
(62, 35, 'Ordner', 11, 9000, '0352', 'Blue', 4, 15, 0),
(63, 35, 'Ordner', 14, 9000, '0353', 'Pink', 4, 15, 0),
(64, 36, 'Joyko Paper Clip', 32, 2500, '0361', 'None', 4, 16, 1),
(65, 37, 'Sticky Notes Joyko MMS-12', 68, 3500, '0371', 'None', 3, 13, 1),
(66, 38, 'Glue Stick Kenko 15gr', 54, 6500, '0381', 'None', 3, 11, 1),
(67, 39, 'Cutter Joyko A-300A', 23, 7000, '0391', 'None', 3, 12, 1),
(68, 40, 'Bookmark Motif Capybara', 12, 10000, '0401', 'None', 3, 14, 1),
(69, 41, 'Push Pin Odi', 26, 9000, '0411', 'None', 3, 25, 1),
(70, 42, 'Stabilo MOKA CY-566', 23, 20000, '0421', 'Purple', 3, 23, 1),
(71, 42, 'Stabilo MOKA CY-566', 20, 20000, '0422', 'Green', 3, 23, 0),
(72, 42, 'Stabilo MOKA CY-566', 18, 20000, '0423', 'Pink', 3, 23, 0),
(73, 43, 'Spidol Warna Faber-Castell', 12, 28000, '0431', 'None', 5, 19, 1),
(74, 44, 'Pensil Warna KENKO CP-12F', 7, 17500, '0441', 'None', 5, 18, 1),
(75, 45, 'Pensil Warna Faber-Castell', 5, 30000, '0451', 'None', 5, 18, 1),
(76, 46, 'Gunting Mini Joyko SC-23', 12, 17000, '0461', 'Blue', 3, 10, 1),
(77, 46, 'Gunting Mini Joyko SC-23', 10, 17000, '0462', 'White', 3, 10, 0),
(78, 46, 'Gunting Mini Joyko SC-23', 13, 17000, '0463', 'Pink', 3, 10, 0),
(79, 47, 'Peraut Deli EH515', 14, 26000, '0471', 'Blue', 1, 24, 1),
(80, 47, 'Peraut Deli EH515', 16, 26000, '0472', 'Red', 1, 24, 0),
(81, 48, 'Peraut Joyko B-24PTL', 23, 4000, '0481', 'Red', 1, 24, 1),
(82, 48, 'Peraut Joyko B-24PTL', 20, 4000, '0482', 'Blue', 1, 24, 0),
(83, 48, 'Peraut Joyko B-24PTL', 26, 4000, '0483', 'Purple', 1, 24, 0),
(84, 48, 'Peraut Joyko B-24PTL', 18, 4000, '0484', 'Green', 1, 24, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_category`
--
ALTER TABLE `child_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `fk_order_customer` (`customer_id`);

--
-- Indexes for table `parent_category`
--
ALTER TABLE `parent_category`
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
  ADD KEY `fk_customer` (`customer_id`),
  ADD KEY `fk_sales_order` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `child_category`
--
ALTER TABLE `child_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `parent_category`
--
ALTER TABLE `parent_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_customer` FOREIGN KEY (`customer_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_sales_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
