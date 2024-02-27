-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 07:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siekstra`
--
CREATE DATABASE IF NOT EXISTS `siekstra` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `siekstra`;

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `absensi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ekstra_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Dikonfirmasi','Pending','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `keterangan` enum('Hadir','Ijin','Sakit','Alpha') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Alpha',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `absensi_id`, `user_id`, `ekstra_id`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 'GLS1708998550', 10, 3, 'Dikonfirmasi', 'Hadir', '2024-02-27 03:51:11', '2024-02-27 03:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `detail_absen`
--

CREATE TABLE `detail_absen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `absensi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ekstra_id` bigint(20) UNSIGNED NOT NULL,
  `kategori` enum('Pertemuan Rutin','Kegiatan','Pendaftaran') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pertemuan Rutin',
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_absen`
--

INSERT INTO `detail_absen` (`id`, `absensi_id`, `ekstra_id`, `kategori`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `waktu_mulai`, `waktu_selesai`, `created_at`, `updated_at`) VALUES
(1, 'GLS1708998550', 3, 'Pertemuan Rutin', 'Kegiatan Rutin', '2024-02-27', '2024-02-27', '08:45:00', '19:00:00', '2024-02-27 01:49:10', '2024-02-27 02:49:36'),
(2, 'MSK1709001022', 1, 'Pendaftaran', 'Pendaftaran Ekstrakurikuler Musik', '2024-02-27', '2024-02-27', '09:00:00', '21:00:00', '2024-02-27 02:30:22', '2024-02-27 02:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `detail_ekstra`
--

CREATE TABLE `detail_ekstra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ekstra` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_ekstra`
--

INSERT INTO `detail_ekstra` (`id`, `id_ekstra`, `tahun_ajaran`, `hari`, `waktu_mulai`, `waktu_selesai`, `created_at`, `updated_at`) VALUES
(1, 1, '2023/2024', 'Senin', '15:30:00', '16:45:00', '2024-02-27 01:39:56', '2024-02-27 01:39:56'),
(2, 3, '2022/2023', 'Selasa', '15:00:00', '16:45:00', '2024-02-27 01:44:17', '2024-02-27 01:44:17'),
(3, 4, '2023/2024', 'Sabtu', '09:00:00', '11:00:00', '2024-02-27 01:45:12', '2024-02-27 01:45:12'),
(4, 3, '2023/2024', 'Selasa', '15:30:00', '16:45:00', '2024-02-27 01:47:43', '2024-02-27 01:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `ekstra`
--

CREATE TABLE `ekstra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_ekstra` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ekstra` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_ekstra` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ekstra`
--

INSERT INTO `ekstra` (`id`, `kode_ekstra`, `nama_ekstra`, `deskripsi_ekstra`) VALUES
(1, 'MSK', 'Musik', 'Ekstrakurikuler Musik adalah sebuah ekstrakurikuler untuk siswa-siswi yang memiliki kecintaan dan bakat dibidang musik, baik dalam bermain alat musik maupun bernyanyi.'),
(2, 'GCR', 'Multimedia', 'Ekstrakurikuler Multimedia, lebih dikenal dengan Gandini Creative adalah sebuah wadah untuk para siswa dengan minat dan ingin mengembangkan bakatnya di bidang kreatif, seperti halnya fotografi, videografi, maupun desain grafis.'),
(3, 'GLS', 'Gerakan Literasi Sekolah', 'Gerakan Literasi Sekolah adalah sebuah ekstrakurikuler yang bergerak di bidang literasi.'),
(4, 'RBT', 'Robotik', 'Ekstrakurikuler ini adalah sebuah ekstrakurikuler bagi mereka yang memiliki minat di bidang kerobotan. Beberapa kegiatan dari ekstrakurikuler ini antara lain yaitu merakit dan memprogram robot, dan juga melakukan pada robot yang telah dibuat.'),
(5, 'FSL', 'Futsal', 'Ekstrakurikuler futsal adalah ekstrakurikuler untuk mereka yang memiliki minat di bidang permainan futsal dan ingin mengembangkan bakat mereka di bidang ini.');

-- --------------------------------------------------------

--
-- Table structure for table `ekstra_diikuti`
--

CREATE TABLE `ekstra_diikuti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ekstra_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ekstra_diikuti`
--

INSERT INTO `ekstra_diikuti` (`id`, `user_id`, `ekstra_id`, `tahun_ajaran`, `nilai`) VALUES
(1, 13, 3, '2022/2023', NULL),
(2, 5, 1, '2023/2024', NULL),
(3, 11, 4, '2023/2024', NULL),
(4, 10, 3, '2023/2024', NULL),
(5, 13, 3, '2023/2024', NULL),
(6, 4, 3, '2023/2024', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ekstra_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `absensi_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id`, `ekstra_id`, `user_id`, `absensi_id`, `judul`, `jenis_kegiatan`, `lokasi`, `tanggal`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 3, 13, 1, 'Merangkum BAB 1 Buku Non-Fiksi Pendek', 'Kegiatan', 'Perpustakaan Sekolah', '2024-02-27', 'Merangkum BAB 1 dari buku pilihan anak-anak tersebut, guna untuk meningkatkan kemampuan literasi Siswa.\r\n\r\nKegiatan ini dilaksanakan di Perpustakaan SMKN 1 Jenangan Ponorogo.', '2024-02-27 02:05:43', '2024-02-27 02:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(40, '2024_02_13_125957_add_deskripsi_to_detail_absen', 3),
(67, '2014_10_12_000000_create_users_table', 4),
(68, '2014_10_12_100000_create_password_reset_tokens_table', 4),
(69, '2019_08_19_000000_create_failed_jobs_table', 4),
(70, '2019_12_14_000001_create_personal_access_tokens_table', 4),
(71, '2024_01_26_064836_add_role_to_user_table', 4),
(72, '2024_01_29_060342_create_ekstra_table', 4),
(73, '2024_02_01_124501_create_detail_ekstra_table', 4),
(74, '2024_02_02_083704_create_ekstra_diikuti_table', 4),
(75, '2024_02_02_120056_create_pelatih_table', 4),
(76, '2024_02_02_120131_create_siswa_table', 4),
(77, '2024_02_11_061905_create_absensi_table', 4),
(78, '2024_02_12_021027_create_detail_absen_table', 4),
(79, '2024_02_12_034639_add_kode_ekstra_field_at_ekstra_table', 4),
(80, '2024_02_15_122543_add_id_ekstra_to_absensi', 4),
(81, '2024_02_15_122552_create_jurnal_table', 4),
(82, '2024_02_16_000854_add_nilai_to_ekstra_diikuti', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelatih`
--

CREATE TABLE `pelatih` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `NIP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelatih` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp_pelatih` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pelatih` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelatih`
--

INSERT INTO `pelatih` (`id`, `user_id`, `NIP`, `nama_pelatih`, `nomor_hp_pelatih`, `alamat_pelatih`, `created_at`, `updated_at`) VALUES
(1, 5, '196102021983042005', 'Tchaikovsky Hermawan', '089317493722', 'Siman, Ponorogo', '2024-02-27 00:30:13', '2024-02-27 00:30:13'),
(2, 6, '196202021983342045', 'Loid Forger', '083237849930', 'Cokromenggalan, Ponorogo', '2024-02-27 00:31:25', '2024-02-27 00:31:25'),
(3, 7, '196209181984052005', 'Suteja Teji', '083946378312', 'Kebonsari, Madiun', '2024-02-27 00:34:27', '2024-02-27 00:34:27'),
(4, 11, '-', 'Ryanto Rudi', '083299104728', 'Bungkal, Ponorogo', '2024-02-27 01:08:13', '2024-02-27 01:08:13'),
(5, 13, '-', 'Anissa Aspera', '089786756453', 'Babadan, Ponorogo', '2024-02-27 01:25:09', '2024-02-27 01:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `NIS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `user_id`, `NIS`, `nama_siswa`, `kelas`, `tahun_pelajaran`, `nomor_hp_siswa`, `alamat_siswa`, `created_at`, `updated_at`) VALUES
(1, 4, '21410/1198.065', 'Divananda Ayu Sasikirana', 'X RPL A', '2023/2024', '082143630209', 'Dolopo, Madiun', '2024-02-26 14:26:34', '2024-02-26 14:26:34'),
(2, 8, '21411/1199.065', 'Dwi Ade Lutfiansyah', 'XI RPL A', '2022/2023', '083473973221', 'Siman, Ponorogo', '2024-02-27 00:38:08', '2024-02-27 00:38:08'),
(3, 9, '21409/1197.065', 'Dirga Dhosigustanoma', 'XII RPL A', '2021/2022', '083947293103', 'Cokromenggalan, Ponorogo', '2024-02-27 00:49:16', '2024-02-27 00:49:16'),
(4, 10, '21407/1195.065', 'Dimas Adjie Wibowo', 'X RPL A', '2023/2024', '083927381294', 'Balong, Ponorogo', '2024-02-27 01:06:13', '2024-02-27 01:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Siswa','Kesiswaan','Pelatih') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Siswa',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kesiswaan', 'Kesiswaan', 'kesiswaan@gmail.com', 'Kesiswaan', NULL, '$2y$12$tRAl6jAz8rK1.6R8Eib64.L640yrHnkHg8PxbR5Rd1fLtvJJjqrH6', NULL, '2024-02-26 14:01:04', '2024-02-26 14:01:04'),
(2, 'Siswa', 'Siswa', 'siswa@gmail.com', 'Siswa', NULL, '$2y$12$9/X0vWkN2ZHMMxSyoMxcQ.Hgq.xfl2VGNW.Z5EIi.Ea3TeWd2SNwC', NULL, '2024-02-26 14:01:05', '2024-02-26 14:01:05'),
(3, 'Pelatih', 'Pelatih', 'pelatih@gmail.com', 'Pelatih', NULL, '$2y$12$vmGwzEUqwQ.LZnGPeueeDefuPxNyLBJbCZexbf9Ak4mNyq3LsAydC', NULL, '2024-02-26 14:01:05', '2024-02-26 14:01:05'),
(4, 'Divananda Ayu Sasikirana', '21410', '21410@contoh.com', 'Siswa', NULL, '$2y$12$GQ908ly2.40hy7Uthkjo7OLGa6hFME45FYBirXoYe31n1PSsI7izK', NULL, '2024-02-26 14:26:34', '2024-02-26 14:26:34'),
(5, 'Tchaikovsky Hermawan', '42005', '196102021983042005@contoh.com', 'Pelatih', NULL, '$2y$12$dcdRD2KFoCEPE7FTHdEvP.WroaVLzUp7.mW2Vmu5IhgOSwv48Daxy', NULL, '2024-02-27 00:30:13', '2024-02-27 00:30:13'),
(6, 'Loid Forger', '42025', '196202021983342045@contoh.com', 'Pelatih', NULL, '$2y$12$VdX5uG9pagdtjpjyA4AuiO9kRs9IGAVqXmJ37XCvwdFavDHACtZFC', NULL, '2024-02-27 00:31:25', '2024-02-27 00:31:25'),
(7, 'Suteja Teji', '52005', '196209181984052005@contoh.com', 'Pelatih', NULL, '$2y$12$bGoOHgUFCW4boHkPE0284uV.w7u4ftM3hMZQO/rLkhi9jWS0q4D3K', NULL, '2024-02-27 00:34:27', '2024-02-27 00:34:27'),
(8, 'Dwi Ade Lutfiansyah', '21411', '21411@contoh.com', 'Siswa', NULL, '$2y$12$ciKs2sh74AW8YnwbNVl3sulSXn.agN.ATGeAn.lky3lyX8Fie4WJy', NULL, '2024-02-27 00:38:08', '2024-02-27 00:38:08'),
(9, 'Dirga Dhosigustanoma', '21409', '21409@contoh.com', 'Siswa', NULL, '$2y$12$IYxkiqRewij/uj88rZcPV.Ew41qfFgNJ3Kcd8H8DIzDAJCgUqTc3y', NULL, '2024-02-27 00:49:16', '2024-02-27 00:49:16'),
(10, 'Dimas Adjie Wibowo', '21407', 'dma@contoh.com', 'Siswa', NULL, '$2y$12$t32Kz0TQCmws.mGd1tw9aO2tVsDuiDJObsLnGWKX7ZnEbEH4EXdt.', NULL, '2024-02-27 01:06:13', '2024-02-27 03:22:17'),
(11, 'Ryanto Rudi', '12345', '-@contoh.com', 'Pelatih', NULL, '$2y$12$d.zk1NKzPQ8lYyjYL2KpQe1Svuro42B.fDKes1weczNTGTTQDIqTW', NULL, '2024-02-27 01:08:13', '2024-02-27 01:08:13'),
(13, 'Anissa Aspera', '11223', '-@contoh.com', 'Pelatih', NULL, '$2y$12$9XoXqO3QOW155FV3Ami3o.GQGPN.XtJHq.w4Q5LDET1jVCKpdtuga', NULL, '2024-02-27 01:25:09', '2024-02-27 01:25:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_user_id_foreign` (`user_id`),
  ADD KEY `absensi_ekstra_id_foreign` (`ekstra_id`);

--
-- Indexes for table `detail_absen`
--
ALTER TABLE `detail_absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_absen_ekstra_id_foreign` (`ekstra_id`);

--
-- Indexes for table `detail_ekstra`
--
ALTER TABLE `detail_ekstra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_ekstra_id_ekstra_foreign` (`id_ekstra`);

--
-- Indexes for table `ekstra`
--
ALTER TABLE `ekstra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekstra_diikuti`
--
ALTER TABLE `ekstra_diikuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ekstra_diikuti_user_id_foreign` (`user_id`),
  ADD KEY `ekstra_diikuti_ekstra_id_foreign` (`ekstra_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurnal_ekstra_id_foreign` (`ekstra_id`),
  ADD KEY `jurnal_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelatih`
--
ALTER TABLE `pelatih`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelatih_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_absen`
--
ALTER TABLE `detail_absen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_ekstra`
--
ALTER TABLE `detail_ekstra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ekstra`
--
ALTER TABLE `ekstra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ekstra_diikuti`
--
ALTER TABLE `ekstra_diikuti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `pelatih`
--
ALTER TABLE `pelatih`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ekstra_id_foreign` FOREIGN KEY (`ekstra_id`) REFERENCES `ekstra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_absen`
--
ALTER TABLE `detail_absen`
  ADD CONSTRAINT `detail_absen_ekstra_id_foreign` FOREIGN KEY (`ekstra_id`) REFERENCES `ekstra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_ekstra`
--
ALTER TABLE `detail_ekstra`
  ADD CONSTRAINT `detail_ekstra_id_ekstra_foreign` FOREIGN KEY (`id_ekstra`) REFERENCES `ekstra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ekstra_diikuti`
--
ALTER TABLE `ekstra_diikuti`
  ADD CONSTRAINT `ekstra_diikuti_ekstra_id_foreign` FOREIGN KEY (`ekstra_id`) REFERENCES `ekstra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ekstra_diikuti_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ekstra_id_foreign` FOREIGN KEY (`ekstra_id`) REFERENCES `ekstra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurnal_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelatih`
--
ALTER TABLE `pelatih`
  ADD CONSTRAINT `pelatih_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
