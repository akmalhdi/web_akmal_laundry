-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2025 at 10:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Kasim', '07898967', 'tes', '2025-11-24 07:03:36', NULL),
(3, 'Jaka', '6456456546', 'tes1', '2025-11-24 07:32:07', NULL),
(4, 'Sunandar', '13213213', 'tesssxs', '2025-11-24 07:32:21', '2025-11-27 02:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2025-11-25 00:48:24', '2025-11-25 01:57:36'),
(2, 'Operator', '2025-11-24 04:51:46', NULL),
(3, 'Pimpinan', '2025-11-24 04:51:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `level_menus`
--

CREATE TABLE `level_menus` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level_menus`
--

INSERT INTO `level_menus` (`id`, `id_level`, `id_menu`, `create_at`, `update_at`) VALUES
(80, 1, 15, '2025-11-29 14:59:32', NULL),
(81, 1, 14, '2025-11-29 14:59:32', NULL),
(82, 1, 13, '2025-11-29 14:59:32', NULL),
(83, 1, 12, '2025-11-29 14:59:32', NULL),
(84, 1, 11, '2025-11-29 14:59:32', NULL),
(85, 1, 4, '2025-11-29 14:59:32', NULL),
(86, 1, 3, '2025-11-29 14:59:32', NULL),
(87, 1, 2, '2025-11-29 14:59:32', NULL),
(88, 1, 1, '2025-11-29 14:59:32', NULL),
(91, 2, 14, '2025-11-30 02:41:29', NULL),
(92, 2, 12, '2025-11-30 02:41:29', NULL),
(93, 2, 4, '2025-11-30 02:41:29', NULL),
(96, 3, 15, '2025-11-30 02:42:26', NULL),
(97, 3, 12, '2025-11-30 02:42:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `link` varchar(30) NOT NULL,
  `order` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `icon`, `link`, `order`, `create_at`, `update_at`) VALUES
(1, 'User', 'bi bi-people', 'user', 6, '2025-11-25 01:49:22', '2025-11-25 07:40:55'),
(2, 'Level', 'bi bi-bar-chart-line', 'level', 5, '2025-11-25 02:28:12', '2025-11-25 07:40:27'),
(3, 'Service', 'bi bi-wrench-adjustable', 'service', 3, '2025-11-25 02:31:53', '2025-11-26 06:54:07'),
(4, 'Customer', 'bi bi-person-vcard', 'customer', 2, '2025-11-25 02:33:02', '2025-11-25 07:40:34'),
(11, 'Menu', 'bi bi-menu-button', 'menu', 4, '2025-11-25 03:49:27', '2025-11-25 07:40:43'),
(12, 'Dashboard', 'bi bi-grid', 'dashboard', 1, '2025-11-25 04:15:51', '2025-11-25 07:40:02'),
(13, 'Tax', 'bi bi-percent', 'tax', 7, '2025-11-26 01:34:14', '2025-11-26 01:34:59'),
(14, 'Order', 'bi bi-basket2', 'order', 8, '2025-11-26 06:51:17', '2025-11-26 06:53:13'),
(15, 'Report', 'bi bi-book', 'report', 9, '2025-11-29 14:59:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Wash Only', 10000, 'tesssss\r\n', '2025-11-27 02:50:13', '2025-11-27 04:10:01'),
(2, 'wash washing', 15000, 'testesting', '2025-11-27 02:50:33', '2025-11-27 04:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `taxs`
--

CREATE TABLE `taxs` (
  `id` int(11) NOT NULL,
  `percent` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taxs`
--

INSERT INTO `taxs` (`id`, `percent`, `is_active`, `create_at`, `update_at`) VALUES
(1, 15, 0, '2025-11-26 01:47:27', '2025-11-26 01:48:10'),
(2, 10, 1, '2025-11-26 01:48:22', '2025-11-29 14:16:38'),
(3, 20, 0, '2025-11-26 01:48:29', '2025-11-29 14:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `trans_orders`
--

CREATE TABLE `trans_orders` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `order_code` varchar(20) NOT NULL,
  `order_end_date` date NOT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 0,
  `order_pay` int(11) NOT NULL,
  `order_change` int(11) NOT NULL,
  `order_tax` int(11) NOT NULL,
  `order_total` int(11) NOT NULL,
  `active_tax` int(11) NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_orders`
--

INSERT INTO `trans_orders` (`id`, `id_customer`, `order_code`, `order_end_date`, `order_status`, `order_pay`, `order_change`, `order_tax`, `order_total`, `active_tax`, `notes`, `created_at`, `update_at`) VALUES
(1, 1, 'ORD-2911250001', '2025-11-29', 0, 50000, 6000, 4000, 44000, 10, '', '2025-11-29 15:35:16', '2025-11-29 15:35:37'),
(2, 3, 'ORD-2911250002', '2025-11-29', 0, 100000, 3750, 8750, 96250, 10, '', '2025-11-29 15:36:35', '2025-11-29 15:53:17'),
(3, 1, 'ORD-2911250010', '2025-11-29', 1, 50000, 11500, 3500, 38500, 10, '', '2025-11-29 15:55:03', NULL),
(4, 1, 'ORD-3011250004', '2025-12-02', 1, 120000, 10000, 10000, 110000, 10, 'notes', '2025-11-30 08:53:08', NULL),
(5, 4, 'ORD-3011250005', '2025-12-02', 0, 60000, 5000, 5000, 55000, 10, 'nanti diambil tanggal 2 ya', '2025-11-30 08:57:35', '2025-11-30 08:59:15');

-- --------------------------------------------------------

--
-- Table structure for table `trans_order_details`
--

CREATE TABLE `trans_order_details` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order_details`
--

INSERT INTO `trans_order_details` (`id`, `id_order`, `id_service`, `qty`, `price`, `subtotal`, `notes`, `created_at`, `update_at`) VALUES
(1, 1, 1, 1.00, 10000, 10000, '', '2025-11-29 15:35:16', NULL),
(2, 1, 2, 2.00, 15000, 30000, '', '2025-11-29 15:35:16', NULL),
(3, 2, 1, 0.50, 10000, 5000, '', '2025-11-29 15:36:35', NULL),
(4, 2, 2, 5.50, 15000, 82500, '', '2025-11-29 15:36:35', NULL),
(5, 3, 1, 0.50, 10000, 5000, 'tess', '2025-11-29 15:55:03', NULL),
(6, 3, 2, 2.00, 15000, 30000, 'tess', '2025-11-29 15:55:03', NULL),
(7, 4, 1, 10.00, 10000, 100000, '', '2025-11-30 08:53:08', NULL),
(8, 5, 1, 5.00, 10000, 50000, '', '2025-11-30 08:57:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_level`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-11-24 02:57:08', '2025-11-25 00:58:25'),
(2, 2, 'Operator', 'operator@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-11-24 03:00:28', '2025-11-25 00:48:53'),
(3, 3, 'Pimpinan', 'pimpinan@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-11-24 03:00:28', '2025-11-25 00:58:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_menus`
--
ALTER TABLE `level_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxs`
--
ALTER TABLE `taxs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_orders`
--
ALTER TABLE `trans_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_order_details`
--
ALTER TABLE `trans_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `level_menus`
--
ALTER TABLE `level_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `taxs`
--
ALTER TABLE `taxs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trans_orders`
--
ALTER TABLE `trans_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trans_order_details`
--
ALTER TABLE `trans_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_id_level` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
