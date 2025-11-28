-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Nov 2025 pada 09.03
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry_akmal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
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
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Kasim', '07898967', 'tes', '2025-11-28 07:37:23', NULL),
(2, 'Jaka', '13213213', 'tes', '2025-11-28 07:37:31', NULL),
(3, 'Sunandar', '6456456546', 'tes', '2025-11-28 07:37:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2025-11-25 00:48:24', '2025-11-25 01:57:36'),
(2, 'Operator', '2025-11-24 04:51:46', NULL),
(3, 'Pimpinan', '2025-11-24 04:51:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_menus`
--

CREATE TABLE `level_menus` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `level_menus`
--

INSERT INTO `level_menus` (`id`, `id_level`, `id_menu`, `create_at`, `update_at`) VALUES
(12, 1, 8, '2025-11-28 07:37:04', NULL),
(13, 1, 7, '2025-11-28 07:37:04', NULL),
(14, 1, 6, '2025-11-28 07:37:04', NULL),
(15, 1, 5, '2025-11-28 07:37:04', NULL),
(16, 1, 4, '2025-11-28 07:37:04', NULL),
(17, 1, 3, '2025-11-28 07:37:04', NULL),
(18, 1, 2, '2025-11-28 07:37:04', NULL),
(19, 1, 1, '2025-11-28 07:37:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
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
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `name`, `icon`, `link`, `order`, `create_at`, `update_at`) VALUES
(1, 'Level', 'bi bi-bar-chart', 'level', 4, '2025-11-28 07:16:48', '2025-11-28 07:34:53'),
(2, 'User', 'bi bi-people', 'user', 5, '2025-11-28 07:26:21', '2025-11-28 07:34:56'),
(3, 'Customer', 'bi bi-book', 'customer', 2, '2025-11-28 07:34:34', NULL),
(4, 'Service', 'bi bi-book', 'service', 3, '2025-11-28 07:34:34', NULL),
(5, 'Dashboard', 'bi bi-book', 'dashboard', 1, '2025-11-28 07:35:40', NULL),
(6, 'Tax', 'bi bi-book', 'tax', 6, '2025-11-28 07:35:40', NULL),
(7, 'Order', 'bi bi-book', 'order', 8, '2025-11-28 07:36:00', NULL),
(8, 'Menu', 'bi bi-book', 'menu', 7, '2025-11-28 07:36:37', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
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
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cuci Gosok', 10000, 'tes', '2025-11-28 07:38:01', NULL),
(2, 'Cuci Gosok Setrika', 15000, 'tes', '2025-11-28 07:38:16', NULL),
(3, 'Gosok ', 5000, 'tes', '2025-11-28 07:38:35', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `taxs`
--

CREATE TABLE `taxs` (
  `id` int(11) NOT NULL,
  `percent` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `taxs`
--

INSERT INTO `taxs` (`id`, `percent`, `is_active`, `create_at`, `update_at`) VALUES
(1, 5, 1, '2025-11-28 07:38:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_orders`
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trans_orders`
--

INSERT INTO `trans_orders` (`id`, `id_customer`, `order_code`, `order_end_date`, `order_status`, `order_pay`, `order_change`, `order_tax`, `order_total`, `created_at`, `update_at`) VALUES
(1, 1, 'ORD-2811250001', '2025-11-28', 1, 32000, 500, 1500, 31500, '2025-11-28 08:01:44', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_order_details`
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
-- Dumping data untuk tabel `trans_order_details`
--

INSERT INTO `trans_order_details` (`id`, `id_order`, `id_service`, `qty`, `price`, `subtotal`, `notes`, `created_at`, `update_at`) VALUES
(1, 1, 1, 1.00, 10000, 10000, '', '2025-11-28 08:01:44', NULL),
(2, 1, 2, 1.00, 15000, 15000, '', '2025-11-28 08:01:44', NULL),
(3, 1, 3, 1.00, 5000, 5000, '', '2025-11-28 08:01:44', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_level`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-11-28 07:03:45', NULL),
(2, 2, 'Operator', 'operator@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-11-28 07:29:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level_menus`
--
ALTER TABLE `level_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `taxs`
--
ALTER TABLE `taxs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trans_orders`
--
ALTER TABLE `trans_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trans_order_details`
--
ALTER TABLE `trans_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_level` (`id_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `level_menus`
--
ALTER TABLE `level_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `taxs`
--
ALTER TABLE `taxs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `trans_orders`
--
ALTER TABLE `trans_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `trans_order_details`
--
ALTER TABLE `trans_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_id_level` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
