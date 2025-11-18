-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2025 at 06:42 PM
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
  `class` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `password`, `class`) VALUES
(5, 'TEST1', 'test.001@ski.sch.id', '$2y$10$4Rr/2w9CXgNoh8Cx1oqUqOCB8hchLTNbWu6SniE.SPr6vwlzhdXmO', 'XI-TKJ-3'),
(6, 'TEST2', 'test.002@ski.sch.id', '$2y$10$YDcw8/7QekaBhjIw43CTU.j/1hH1OOMW/h8/6dnwIoRXRAmawCTcy', 'XI-TKJ-3'),
(7, 'TEST3', 'test.003@ski.sch.id', '$2y$10$VDZ39Vh.nfTVxwdkVsFVqebjPL8o1yDgO.2YbMc2IgtTsxEsqczvq', 'XI-TKJ-3'),
(9, 'TEST4', 'test.004@ski.sch.id', '$2y$10$23Q0tISwHukZsQxjlevZP.ahtmDFoXEhT5dl8iuoxBq8aBntlP1IG', 'XI-TKJ-3'),
(10, 'TEST5', 'test.005@ski.sch.id', '$2y$10$1NKAvzrQQXao9oP4Kg0vRerXWwjlo8Y1.DzJLBP6xNI3dzIN0rfe.', 'XI-TKJ-3'),
(11, 'TEST6', 'test.006@ski.sch.id', '$2y$10$dgI5nqq9ls9Sko4eqrRH0OyY/TumY1OLzGdIyZNANYOEqTCvasr2e', 'XI-TKJ-3'),
(13, 'TEST7', 'test.007@ski.sch.id', '$2y$10$fAZQBlFw1I4eqnvTEe3h6ec8G6wc20KIeWOBplvS/0rEG3hpjPN5i', 'XI-TKJ-3');

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
(1, 'Pencil', 1),
(2, 'Pen', 1),
(3, 'Eraser', 1),
(4, 'Ruler', 1),
(5, 'Correction Tape', 1),
(6, 'School Notebook', 2),
(8, 'Paper', 2),
(9, 'Books', 2),
(10, 'Scissors', 3),
(11, 'Glue', 3),
(12, 'Cutter', 3),
(13, 'Sticky Notes', 3),
(14, 'Bookmark', 3),
(15, 'Folder', 4),
(16, 'Paper Clip', 4),
(17, 'Crayons', 5),
(18, 'Coloring Pencil', 5),
(19, 'Coloring Marker', 5),
(20, 'Stapler', 3),
(21, 'Calculator', 3),
(22, 'Marker', 1),
(23, 'Highlighter', 3),
(24, 'Sharpener', 1);

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
(1, 'Bagaimana cara memesan produk?', 'Anda cukup menambahkan produk ke keranjang, lalu lanjut ke halaman keranjang tersebut dan tekan \"Proceed To Check Out.\"'),
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
(1, 'Basic Writing Tools'),
(2, 'Books & Paper'),
(3, 'Extra Supplies'),
(4, 'Filing Tools'),
(5, 'Art Supplies');

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
(1, 1, 'Buku Tulis Sekolah', 44, 4500, '0011', 'Blue', 2, 6, 1),
(2, 1, 'Buku Tulis Sekolah', 29, 4500, '0012', 'Pink', 2, 6, 0),
(3, 1, 'Buku Tulis Sekolah', 20, 4500, '0013', 'Orange', 2, 6, 0),
(4, 2, 'Buku Tulis Sekolah Besar', 38, 6000, '0021', 'None', 2, 6, 1),
(5, 3, 'Buku Tulis Folio', 29, 7500, '0031', 'None', 2, 6, 1),
(6, 4, 'Pulpen Joyko JK-100', 100, 2000, '0043', 'Black', 1, 2, 1),
(7, 4, 'Pulpen Joyko JK-100', 40, 2000, '0042', 'Red', 1, 2, 0),
(8, 4, 'Pulpen Joyko JK-100', 50, 2000, '0041', 'Blue', 1, 2, 0),
(9, 5, 'Pulpen Gel Joyko GP-265', 76, 2500, '0053', 'Black', 1, 2, 1),
(10, 5, 'Pulpen Gel Joyko GP-265', 69, 2500, '0052', 'Red', 1, 2, 0),
(11, 5, 'Pulpen Gel Joyko GP-265', 49, 2500, '0051', 'Blue', 1, 2, 0),
(12, 6, 'Tip-ex Joyko CT-522', 48, 5000, '0062', 'Blue', 1, 5, 1),
(13, 6, 'Tip-ex Joyko CT-522', 39, 5000, '0061', 'Red', 1, 5, 0),
(14, 6, 'Tip-ex Joyko CT-522', 30, 5000, '0063', 'Yellow', 1, 5, 0),
(15, 7, 'Tip-ex Joyko CT-533', 36, 9000, '0071', 'Blue', 1, 5, 1),
(16, 7, 'Tip-ex Joyko CT-533', 20, 9000, '0072', 'Green', 1, 5, 0),
(17, 7, 'Tip-ex Joyko CT-533', 29, 9000, '0073', 'Pink', 1, 5, 0),
(18, 8, 'Penggaris Joyko RL-ST15 15cm', 20, 5000, '0081', 'None', 1, 4, 1),
(19, 9, 'Penggaris Joyko RL-ST20 20cm', 10, 6000, '0091', 'None', 1, 4, 1),
(20, 10, 'Penggaris Joyko RL-ST30 30cm', 40, 7000, '0101', 'None', 1, 4, 1),
(21, 11, 'Pensil Joyko P-8136', 50, 1000, '0111', 'None', 1, 1, 1),
(22, 12, 'Pensil Joyko P-88', 80, 1000, '0121', 'None', 1, 1, 1),
(23, 13, 'Staples Joyko HD-10CL', 28, 10000, '0131', 'Blue', 3, 20, 1),
(24, 13, 'Staples Joyko HD-10CL', 10, 10000, '0132', 'Yellow', 3, 20, 0),
(25, 13, 'Staples Joyko HD-10CL', 19, 10000, '0133', 'Red', 3, 20, 0),
(26, 13, 'Staples Joyko HD-10CL', 30, 10000, '0134', 'Green', 3, 20, 0),
(27, 14, 'Staples Joyko HD-10M', 35, 8000, '0141', 'Blue', 3, 20, 1),
(28, 14, 'Staples Joyko HD-10M', 50, 8000, '0142', 'Green', 3, 20, 0),
(29, 14, 'Staples Joyko HD-10M', 20, 8000, '0143', 'Yellow', 3, 20, 0),
(30, 14, 'Staples Joyko HD-10M', 10, 8000, '0144', 'Red', 3, 20, 0),
(31, 15, 'Isi Staples Montana RS10-20', 100, 2000, '0151', 'None', 3, 20, 1),
(32, 16, 'Penghapus Joyko EB-40', 80, 1000, '0161', 'None', 1, 3, 1),
(33, 17, 'Penghapus Joyko EB-30', 79, 1500, '0171', 'None', 1, 3, 1),
(35, 18, 'Buku Tulis Notebook A4 Transparan', 29, 20000, '0181', 'None', 2, 9, 1),
(36, 19, 'Buku Tulis Folio Paperline', 20, 20000, '0191', 'None', 2, 9, 1),
(37, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 19, 23000, '0201', 'Black', 3, 21, 1),
(38, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 10, 23000, '0202', 'Pink', 3, 21, 0),
(39, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 27, 23000, '0203', 'White', 3, 21, 0),
(40, 20, 'Kalkulator Ilmiah Denix KK-82MS-D', 20, 23000, '0204', 'Blue', 3, 21, 0),
(41, 21, 'Spidol Warna-Warni Snowman', 10, 16000, '0211', 'None', 5, 19, 1),
(42, 22, 'Spidol Board Snowman', 60, 10000, '0221', 'None', 1, 22, 1),
(43, 23, 'Stabilo Joyko', 25, 6000, '0232', 'Blue', 3, 23, 1),
(44, 23, 'Stabilo Joyko', 38, 6000, '0231', 'Red', 3, 23, 0),
(45, 23, 'Stabilo Joyko', 15, 6000, '0233', 'Green', 3, 23, 0),
(46, 23, 'Stabilo Joyko', 20, 6000, '0234', 'Yellow', 3, 23, 0),
(47, 24, 'Pembatas Buku Joyko IM-31', 29, 10000, '0241', 'None', 3, 14, 1),
(48, 25, 'Sticky Notes Joyko MMS-4', 30, 11000, '0251', 'None', 3, 13, 1),
(49, 26, 'Peraut Kenko SP-362', 35, 1000, '0261', 'Blue', 1, 24, 1),
(50, 26, 'Peraut Kenko SP-362', 40, 1000, '0263', 'Red', 1, 24, 0),
(51, 26, 'Peraut Kenko SP-362', 19, 1000, '0262', 'Green', 1, 24, 0),
(52, 26, 'Peraut Kenko SP-362', 25, 1000, '0264', 'Yellow', 1, 24, 0),
(53, 27, 'Cutter Joyko L-500', 29, 20000, '0271', 'None', 3, 12, 1),
(54, 28, 'Gunting Joyko SC-828', 20, 6000, '0281', 'None', 3, 10, 1),
(55, 29, 'Gunting Joyko SC-838', 20, 9000, '0291', 'None', 3, 10, 1),
(56, 30, 'Gunting Joyko SC-848', 10, 13000, '0301', 'None', 3, 10, 1);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `child_category`
--
ALTER TABLE `child_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `parent_category`
--
ALTER TABLE `parent_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
