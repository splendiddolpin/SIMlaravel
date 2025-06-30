-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 01:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libs`
--

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

DROP TABLE IF EXISTS `publishers`;
CREATE TABLE `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Prof. Ivory Hackett', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(3, 'Carissa Torp', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(5, 'Miss Leatha Schuppe', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(7, 'Diana Klein', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(8, 'Pat Luettgen', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(9, 'Prof. Cesar Carroll PhD', '2024-12-15 21:07:43', '2024-12-15 21:07:43'),
(13, 'Serindo', '2025-01-14 08:14:18', '2025-01-14 08:14:18'),
(14, 'Gramedia', '2025-01-22 00:41:05', '2025-01-22 00:41:05'),
(15, 'Erlangga', '2025-02-05 03:53:44', '2025-02-05 03:53:44'),
(16, 'Republika', '2025-02-05 05:41:47', '2025-02-05 05:41:47'),
(17, 'Hodder & Stoughton', '2025-02-05 05:46:10', '2025-02-05 05:46:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
