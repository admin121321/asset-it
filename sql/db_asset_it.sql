-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2023 at 02:14 AM
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
-- Database: `db_asset_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `aksesoris_device`
--

CREATE TABLE `aksesoris_device` (
  `id` bigint NOT NULL,
  `sn_aksesoris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_aksesoris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_aksesoris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_aksesoris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `garansi_aksesoris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_aksesoris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_aksesoris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aksesoris_device`
--

INSERT INTO `aksesoris_device` (`id`, `sn_aksesoris`, `brand_aksesoris`, `model_aksesoris`, `type_aksesoris`, `garansi_aksesoris`, `tahun_anggaran`, `harga_aksesoris`, `stok`, `foto_aksesoris`, `created_at`, `updated_at`) VALUES
(1232, '1232', 'Logitech', 'FAs22', 'Keyboard', '2023-05-14', '2023-05-14', '1', '0', '20230513173819.jpg', '2023-05-13 10:38:19', '2023-05-16 21:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `aksesoris_pengguna`
--

CREATE TABLE `aksesoris_pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `desktop_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aksesoris_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aksesoris_pengguna`
--

INSERT INTO `aksesoris_pengguna` (`id`, `desktop_id`, `aksesoris_id`, `qty`, `created_at`, `updated_at`) VALUES
(4, '21345523213', '1232', '1', '2023-05-16 21:51:09', '2023-05-16 21:51:09');

--
-- Triggers `aksesoris_pengguna`
--
DELIMITER $$
CREATE TRIGGER `aksesoris_keluar` AFTER DELETE ON `aksesoris_pengguna` FOR EACH ROW BEGIN

   UPDATE aksesoris_device SET stok = stok + OLD.qty

   WHERE id = OLD.aksesoris_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `desktop_device`
--

CREATE TABLE `desktop_device` (
  `id` bigint NOT NULL,
  `sn_desktop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_desktop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_desktop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_desktop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `garansi_desktop` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_desktop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ram_desktop` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hardisk_desktop` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processor_desktop` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_desktop` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_desktop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_desktop` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desktop_device`
--

INSERT INTO `desktop_device` (`id`, `sn_desktop`, `brand_desktop`, `model_desktop`, `type_desktop`, `garansi_desktop`, `tahun_anggaran`, `harga_desktop`, `ram_desktop`, `hardisk_desktop`, `processor_desktop`, `core_desktop`, `stok`, `foto_desktop`, `deskripsi_desktop`, `created_at`, `updated_at`) VALUES
(123123123, '123123123', 'HP', 'Pavilon 277', 'LAPTOP', '2019', '2023-05-09', '20000000', '16 GB', '500 GB', 'Intel', 'i7', '0', '20230516042131.jpg', 'Laptop', '2023-05-15 21:21:31', '2023-05-16 19:49:05'),
(21345523213, '21345523213', 'Dell', 'Latitude 534700', 'KOMPUTER', '2019', '2023-05-15', '20000000', '8 GB', '500 GB', 'Intel', 'i7', '1', '20230516042014.jpg', 'Full OS', '2023-05-15 21:18:38', '2023-05-16 19:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `desktop_pengguna`
--

CREATE TABLE `desktop_pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desktop_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desktop_pengguna`
--

INSERT INTO `desktop_pengguna` (`id`, `user_id`, `desktop_id`, `qty`, `created_at`, `updated_at`) VALUES
(4, '2', '123123123', '1', '2023-05-16 00:50:36', '2023-05-16 00:50:36');

--
-- Triggers `desktop_pengguna`
--
DELIMITER $$
CREATE TRIGGER `desktop_keluar` AFTER DELETE ON `desktop_pengguna` FOR EACH ROW BEGIN

   UPDATE desktop_device SET stok = stok + OLD.qty

   WHERE id = OLD.desktop_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lisensi_pengguna`
--

CREATE TABLE `lisensi_pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `desktop_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lisensi_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lisensi_pengguna`
--

INSERT INTO `lisensi_pengguna` (`id`, `desktop_id`, `lisensi_id`, `qty`, `created_at`, `updated_at`) VALUES
(6, '1234', '12321', '1', '2023-05-13 18:53:37', '2023-05-13 18:53:37'),
(7, '123123123', '12321', '1', '2023-05-16 21:50:53', '2023-05-16 21:50:53');

--
-- Triggers `lisensi_pengguna`
--
DELIMITER $$
CREATE TRIGGER `lisensi_keluar` AFTER DELETE ON `lisensi_pengguna` FOR EACH ROW BEGIN

   UPDATE lisensi_software SET stok = stok + OLD.qty

   WHERE id = OLD.lisensi_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `lisensi_software`
--

CREATE TABLE `lisensi_software` (
  `id` bigint UNSIGNED NOT NULL,
  `sn_lisensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_lisensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_lisensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_lisensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_lisensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_lisensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_os` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_lisensi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lisensi_software`
--

INSERT INTO `lisensi_software` (`id`, `sn_lisensi`, `brand_lisensi`, `model_lisensi`, `type_lisensi`, `tahun_anggaran`, `harga_lisensi`, `key_lisensi`, `core_os`, `stok`, `foto_lisensi`, `created_at`, `updated_at`) VALUES
(12321, '12321', 'Adobe', 'Reader', 'Aplikasi', '2023-05-13', '20000000', '3Frde32e32qe', '2', '0', '20230513010310.jpg', '2023-05-12 18:03:10', '2023-05-16 21:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` bigint UNSIGNED NOT NULL,
  `gambar_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2019_08_19_000000_create_failed_jobs_table', 1),
(13, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(14, '2023_05_04_124308_create_logos_table', 1),
(15, '2023_05_04_124927_create_printer_devices_table', 1),
(16, '2023_05_04_125039_create_printer_pengguna_table', 1),
(17, '2023_05_12_144259_create_lisensi_software_table', 2),
(18, '2023_05_12_144314_create_lisensi_pengguna_table', 2),
(19, '2023_05_13_015601_create_desktop_device_table', 3),
(20, '2023_05_13_015612_create_desktop_pengguna_table', 3),
(21, '2023_05_13_165441_create_aksesoris_device_table', 4),
(22, '2023_05_13_165449_create_aksesoris_pengguna_table', 4),
(23, '2023_05_14_024750_create_ssid_wifi_table', 5),
(24, '2023_05_15_034722_create_network_device_table', 6),
(25, '2023_05_15_034728_create_network_pengguna_table', 6),
(26, '2023_05_15_035419_create_network_akses_table', 6),
(27, '2023_05_15_034728_create_network_lokasi_table', 7),
(28, '2023_05_17_040542_create_server_spek_table', 8),
(29, '2023_05_17_040556_create_server_akun_table', 8),
(30, '2023_05_17_040602_create_server_device_table', 8),
(31, '2023_05_25_070138_create_server_pengunaan', 9);

-- --------------------------------------------------------

--
-- Table structure for table `network_akses`
--

CREATE TABLE `network_akses` (
  `id` bigint UNSIGNED NOT NULL,
  `network_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_akses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `akun_akses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_akses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `network_akses`
--

INSERT INTO `network_akses` (`id`, `network_id`, `ip_akses`, `akun_akses`, `password_akses`, `created_at`, `updated_at`) VALUES
(3, '123', '192.168.1.1', 'admin', 'admin', '2023-05-14 23:40:55', '2023-05-15 00:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `network_device`
--

CREATE TABLE `network_device` (
  `id` bigint NOT NULL,
  `sn_network` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_network` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_network` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_network` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port_network` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `garansi_network` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_network` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_network` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `network_device`
--

INSERT INTO `network_device` (`id`, `sn_network`, `brand_network`, `model_network`, `type_network`, `port_network`, `garansi_network`, `tahun_anggaran`, `harga_network`, `stok`, `foto_network`, `created_at`, `updated_at`) VALUES
(123, '123', 'Cisco', 'CR31', 'Router Managed', '24', '213', '2023-05-15', '123', '0', '20230515044130.jpg', '2023-05-14 21:41:30', '2023-05-15 19:19:05'),
(1234, '1234', 'Mikrotik', 'M4325', 'Router Managed', '24', '12', '2023-05-15', '123213', '1', '20230515044320.png', '2023-05-14 21:40:45', '2023-05-15 18:58:43');

-- --------------------------------------------------------

--
-- Table structure for table `network_lokasi`
--

CREATE TABLE `network_lokasi` (
  `id` bigint UNSIGNED NOT NULL,
  `network_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `network_lokasi`
--

INSERT INTO `network_lokasi` (`id`, `network_id`, `lokasi`, `qty`, `created_at`, `updated_at`) VALUES
(5, '123', 'Lantai 1', '1', '2023-05-15 19:19:05', '2023-05-15 19:19:05');

--
-- Triggers `network_lokasi`
--
DELIMITER $$
CREATE TRIGGER `network_keluar` AFTER DELETE ON `network_lokasi` FOR EACH ROW BEGIN

   UPDATE network_device SET stok = stok + OLD.qty

   WHERE id = OLD.network_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `printer_devices`
--

CREATE TABLE `printer_devices` (
  `id` bigint UNSIGNED NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_printer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_printer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_printer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_printer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_printer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `printer_devices`
--

INSERT INTO `printer_devices` (`id`, `serial_number`, `brand_printer`, `model_printer`, `type_printer`, `tahun_anggaran`, `harga_printer`, `stok`, `foto_printer`, `created_at`, `updated_at`) VALUES
(12345, '12345', 'KONIKA', 'MINOLTA', 'SCAN & PRINTER', '2023-05-04', '1', '0', '20230511032226.jpg', '2023-05-10 20:22:26', '2023-05-11 03:45:39'),
(123456, '123456', 'HP', 'PageWide 4770 DW', 'SCAN & PRINTER', '2023-05-11', '2000000', '0', '20230511014815.jpg', '2023-05-10 18:48:15', '2023-05-11 03:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `printer_pengguna`
--

CREATE TABLE `printer_pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `printer_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `printer_pengguna`
--

INSERT INTO `printer_pengguna` (`id`, `user_id`, `printer_id`, `qty`, `created_at`, `updated_at`) VALUES
(22, '2', '123456', '1', '2023-05-11 03:43:18', '2023-05-11 03:43:18'),
(23, '1', '12345', '1', '2023-05-11 03:45:39', '2023-05-12 00:19:19');

--
-- Triggers `printer_pengguna`
--
DELIMITER $$
CREATE TRIGGER `printer_keluar` AFTER DELETE ON `printer_pengguna` FOR EACH ROW BEGIN

   UPDATE printer_devices SET stok = stok + OLD.qty

   WHERE id = OLD.printer_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rak_server`
--

CREATE TABLE `rak_server` (
  `id` bigint UNSIGNED NOT NULL,
  `brand_rak` varchar(50) NOT NULL,
  `type_rak` varchar(50) NOT NULL,
  `kode_rak` varchar(50) NOT NULL,
  `dimensi_rak` varchar(50) NOT NULL,
  `ukuran_u_rak` varchar(50) NOT NULL,
  `sisa_u` int NOT NULL,
  `tahun_anggaran` date NOT NULL,
  `harga_rak` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto_rak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rak_server`
--

INSERT INTO `rak_server` (`id`, `brand_rak`, `type_rak`, `kode_rak`, `dimensi_rak`, `ukuran_u_rak`, `sisa_u`, `tahun_anggaran`, `harga_rak`, `deskripsi`, `foto_rak`, `created_at`, `updated_at`) VALUES
(3, 'RAKCOM', 'MOUNTED', 'F4451DEED', '324234234', '42', 38, '2023-06-21', '21111111111', 'Ok', '20230621021047.png', '2023-06-20 19:10:47', '2023-06-20 19:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `rak_server_lokasi`
--

CREATE TABLE `rak_server_lokasi` (
  `id` bigint UNSIGNED NOT NULL,
  `rak_id` bigint NOT NULL,
  `nama_lokasi_rak` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rak_server_lokasi`
--

INSERT INTO `rak_server_lokasi` (`id`, `rak_id`, `nama_lokasi_rak`, `created_at`, `updated_at`) VALUES
(2, 2, 'DC Depok', '2023-06-05 00:29:59', '2023-06-05 00:29:59'),
(3, 3, 'DC Depok', '2023-06-20 19:13:27', '2023-06-20 19:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `rak_server_pengguna`
--

CREATE TABLE `rak_server_pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `server_id` int NOT NULL,
  `rak_id` int NOT NULL,
  `penggunaan_u` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rak_server_pengguna`
--

INSERT INTO `rak_server_pengguna` (`id`, `server_id`, `rak_id`, `penggunaan_u`, `created_at`, `updated_at`) VALUES
(3, 21, 3, 4, '2023-06-20 19:13:41', '2023-06-20 19:13:41');

--
-- Triggers `rak_server_pengguna`
--
DELIMITER $$
CREATE TRIGGER `rak_keluar` AFTER DELETE ON `rak_server_pengguna` FOR EACH ROW BEGIN

   UPDATE rak_server SET sisa_u = sisa_u + OLD.penggunaan_u

   WHERE id = OLD.rak_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `server_akun`
--

CREATE TABLE `server_akun` (
  `id` bigint UNSIGNED NOT NULL,
  `server_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akun_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan_akses_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `server_akun`
--

INSERT INTO `server_akun` (`id`, `server_id`, `akun_server`, `password_server`, `tujuan_akses_server`, `created_at`, `updated_at`) VALUES
(5, '21', 'admin', 'admin123', 'Untuk Akses Management', '2023-06-04 19:48:43', '2023-06-04 19:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `server_device`
--

CREATE TABLE `server_device` (
  `id` bigint UNSIGNED NOT NULL,
  `sn_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `garansi_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `server_device`
--

INSERT INTO `server_device` (`id`, `sn_server`, `brand_server`, `model_server`, `type_server`, `garansi_server`, `support_server`, `tahun_anggaran`, `harga_server`, `stok`, `foto_server`, `created_at`, `updated_at`) VALUES
(21, 'MK-4EQW4', 'FUJITSU', 'RX 4770 M4', 'FISIK', '2023-05-26', '2023-05-26', '2023-05-26', '2000000000000000000000', '1', '20230526020436.PNG', '2023-05-25 19:04:36', '2023-06-04 19:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `server_penggunaan`
--

CREATE TABLE `server_penggunaan` (
  `id` bigint NOT NULL,
  `hostname_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port_akses_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_management_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `php_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `db_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `server_penggunaan`
--

INSERT INTO `server_penggunaan` (`id`, `hostname_server`, `url_server`, `port_akses_server`, `ip_address_server`, `ip_management_server`, `web_server`, `php_server`, `db_server`, `application_server`, `deskripsi_server`, `created_at`, `updated_at`) VALUES
(21, 'app-server', 'https://app-kom.com', '80', '192.168.1.1', '192.168.1.10', 'Nginx V.2', '8', 'MariaDB 8', 'app-kom', 'Ok', '2023-05-25 19:04:36', '2023-06-04 19:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `server_spek`
--

CREATE TABLE `server_spek` (
  `id` bigint NOT NULL,
  `ram_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hardisk_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processor_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `os_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `server_spek`
--

INSERT INTO `server_spek` (`id`, `ram_server`, `hardisk_server`, `processor_server`, `core_server`, `os_server`, `created_at`, `updated_at`) VALUES
(21, '32 GB', '2 TB', 'INTEL XEON', '32', 'CENTOS 8', '2023-05-25 19:04:36', '2023-06-04 19:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `ssid_wifi`
--

CREATE TABLE `ssid_wifi` (
  `id` bigint UNSIGNED NOT NULL,
  `ssid_name` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_segment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_ssid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_ssid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_lama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_baru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ssid_wifi`
--

INSERT INTO `ssid_wifi` (`id`, `ssid_name`, `ip_segment`, `provider`, `user_ssid`, `lokasi_ssid`, `password_lama`, `password_baru`, `created_at`, `updated_at`) VALUES
(5, 'Wifi_Ku', '213dasda', '123', '123', '123', '123', '123', '2023-05-14 20:19:53', '2023-05-14 20:40:50'),
(11, 'Wifi_Ku_j', '2131', '123', '213', '123', '213', '123', '2023-05-14 20:39:51', '2023-05-14 20:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level_login`, `card_id`, `divisi_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'admin@asset-it.com', NULL, '$2y$10$c39U00KR/YYp51FxSmaU/Ovkfds6SYShRvoa3Xa2kN2PtbANWvn6m', '1', '12345', '1', NULL, '2023-05-10 18:44:35', '2023-05-10 18:44:35'),
(2, 'user', 'user@asset-it.com', NULL, '$2y$10$r76Y.wf5hdTwZrDZpGMJg.bGhJEDErZuRMaR9AGNbgZAqohgBoBFy', '0', '123123213', '1', NULL, '2023-05-10 19:32:31', '2023-05-10 19:32:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aksesoris_device`
--
ALTER TABLE `aksesoris_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aksesoris_pengguna`
--
ALTER TABLE `aksesoris_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desktop_device`
--
ALTER TABLE `desktop_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desktop_pengguna`
--
ALTER TABLE `desktop_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lisensi_pengguna`
--
ALTER TABLE `lisensi_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lisensi_software`
--
ALTER TABLE `lisensi_software`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `network_akses`
--
ALTER TABLE `network_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `network_device`
--
ALTER TABLE `network_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `network_lokasi`
--
ALTER TABLE `network_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `printer_devices`
--
ALTER TABLE `printer_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `printer_pengguna`
--
ALTER TABLE `printer_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rak_server`
--
ALTER TABLE `rak_server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rak_server_lokasi`
--
ALTER TABLE `rak_server_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rak_server_pengguna`
--
ALTER TABLE `rak_server_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server_akun`
--
ALTER TABLE `server_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server_device`
--
ALTER TABLE `server_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server_penggunaan`
--
ALTER TABLE `server_penggunaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server_spek`
--
ALTER TABLE `server_spek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ssid_wifi`
--
ALTER TABLE `ssid_wifi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aksesoris_pengguna`
--
ALTER TABLE `aksesoris_pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `desktop_pengguna`
--
ALTER TABLE `desktop_pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lisensi_pengguna`
--
ALTER TABLE `lisensi_pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `network_akses`
--
ALTER TABLE `network_akses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `network_lokasi`
--
ALTER TABLE `network_lokasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `printer_devices`
--
ALTER TABLE `printer_devices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;

--
-- AUTO_INCREMENT for table `printer_pengguna`
--
ALTER TABLE `printer_pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `rak_server`
--
ALTER TABLE `rak_server`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rak_server_lokasi`
--
ALTER TABLE `rak_server_lokasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rak_server_pengguna`
--
ALTER TABLE `rak_server_pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `server_akun`
--
ALTER TABLE `server_akun`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `server_device`
--
ALTER TABLE `server_device`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ssid_wifi`
--
ALTER TABLE `ssid_wifi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
