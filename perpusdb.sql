-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2025 at 08:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpusdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `nim`, `jurusan`, `no_telepon`, `created_at`) VALUES
(1, 'Budi Santoso', '12345678', 'Teknik Informatika', NULL, NULL),
(2, 'Citra Lestari', '87654321', 'Sistem Informasi', '11', NULL),
(5, '1', '1', '1', '1', NULL),
(6, '2', '2', '2', '2', NULL),
(7, '3', '3', '3', '3', NULL),
(8, '4', '4', '4', '4', NULL),
(9, '5', '5', '5', '5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `sampul` varchar(255) DEFAULT 'default.jpg',
  `file_buku` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `sinopsis`, `sampul`, `file_buku`, `created_at`, `updated_at`) VALUES
(11, 'Test_01', 'Test', '', '0000', '', '1753447897_29566e571655b1469e2c.png', '1753447897_1a1fccf6a3d3900d3be4.pdf', '2025-07-25 12:51:37', '2025-07-25 12:51:37'),
(12, 'Test_02', 'Test_02', '', '0000', '', '1753449687_cd15079c7044d70fb65a.png', '1753449687_9962f5486b5af2a47a34.pdf', '2025-07-25 13:21:27', '2025-07-25 13:21:27'),
(13, 'Test_03', 'Test_03', '', '0000', '', '1753449719_c32c96a7ea7ed4cbe246.png', '1753449719_ef0750baef16d24f5779.pdf', '2025-07-25 13:21:59', '2025-07-25 13:21:59'),
(14, 'Test_04', 'Test_04', '', '0000', '', '1753449741_08265efb3b81e6ab1d22.png', '1753449741_7b03f19067dd0d6fb6e9.docx', '2025-07-25 13:22:21', '2025-07-25 13:22:21'),
(15, 'Test_05', 'Test_05', '', '0000', '', '1753449755_07b2dc0451ec50f9299c.png', '1753449755_6578a8872d04fca768af.docx', '2025-07-25 13:22:35', '2025-07-25 13:22:35'),
(16, 'Test_06', 'Test_06', '', '0000', '', '1753449783_805c1a3f74a91fd28b8b.png', '1753449783_a3705250f9714d3be2cf.pdf', '2025-07-25 13:23:03', '2025-07-25 13:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) UNSIGNED NOT NULL,
  `book_id` int(11) UNSIGNED NOT NULL,
  `anggota_id` int(11) UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_harus_kembali` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') NOT NULL DEFAULT 'dipinjam',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `book_id`, `anggota_id`, `tanggal_pinjam`, `tanggal_harus_kembali`, `tanggal_kembali`, `status`, `created_at`) VALUES
(5, 11, 1, '2025-07-01', '2025-07-08', '2025-07-26', 'dikembalikan', NULL),
(6, 15, 6, '2025-07-26', '2025-08-02', NULL, 'dipinjam', NULL),
(7, 11, 2, '2025-07-04', '2025-07-11', NULL, 'dipinjam', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas') NOT NULL DEFAULT 'petugas',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'Admin Perpustakaan', 'admin@perpus.com', '$2y$10$GpdZRCiasoaaKvQu9KQxJelRt60DbAzJzclKK2dHlkUmjsfrwAJt.', 'petugas', NULL),
(3, 'test', 'test@test.com', '$2y$10$KXPyqo.7LCXuyHT7jGof/ulrzqWwyLjY1aLAH/FlifMyVBJGTtRn2', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `anggota_id` (`anggota_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
