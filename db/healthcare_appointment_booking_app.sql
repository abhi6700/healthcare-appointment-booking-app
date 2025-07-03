-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 03, 2025 at 10:21 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthcare_appointment_booking_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `healthcare_professional_id` bigint UNSIGNED NOT NULL,
  `appointment_start_time` datetime NOT NULL,
  `appointment_end_time` datetime DEFAULT NULL,
  `status` enum('booked','completed','cancelled') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'booked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_user_id_foreign` (`user_id`),
  KEY `appointments_healthcare_professional_id_foreign` (`healthcare_professional_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `healthcare_professional_id`, `appointment_start_time`, `appointment_end_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-07-04 11:00:00', '2025-07-04 12:00:00', 'booked', '2025-07-03 06:42:30', '2025-07-03 06:42:30'),
(2, 6, 4, '2025-07-06 11:00:00', '2025-07-03 14:25:43', 'completed', '2025-07-03 08:54:26', '2025-07-03 08:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_professionals`
--

DROP TABLE IF EXISTS `healthcare_professionals`;
CREATE TABLE IF NOT EXISTS `healthcare_professionals` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `specialty` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `healthcare_professionals_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `healthcare_professionals`
--

INSERT INTO `healthcare_professionals` (`id`, `name`, `email`, `email_verified_at`, `password`, `specialty`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Priyanka Patel', 'priyankapatel@gmail.com', NULL, '$2y$12$zqFinwWigctc1qvGwI0ca.qMRVxKaSEHLi47bWP8omS3Pk0B8aaIS', 'Ortho', NULL, NULL, NULL),
(2, 'Meet Patel', 'meetpatel@gmail.com', NULL, '$2y$12$slyvDd6pUaNJpuZDm8DjJOdfcGNVTROYpk40YUDkWl57m7.J/LadK', 'ENT', NULL, NULL, NULL),
(3, 'Vaidika Patel', 'vinipatel@gmail.com', NULL, '$2y$12$GCN54EAZs3BvWr/5.x49lO1hKRSi7SkX.5yUQ3xl8FjK7ZvpmDeJ6', 'Eye Specialist', NULL, NULL, NULL),
(4, 'Kamal Patel', 'kamalpatel@gmail.com', NULL, '$2y$12$SjskaEcUAad.qu3Bu2WVzecoc71TG5BYi9Luj.Fx/dGOSp3HQ/jk.', 'General', NULL, NULL, NULL),
(5, 'Komal Patel', 'komalpatel@gmail.com', NULL, '$2y$12$GYec9BK8Y.T.KHvUj9EI.OBfhB.YVAVc9WlIYNY1tqUoWsbY3WSVy', 'Surgeons', NULL, NULL, NULL),
(6, 'Shiva Patel', 'shiva@gmail.com', NULL, '$2y$12$FZ448M2YQKoSXw9z4W/fWeRQgKgpSGdFYbD6Qup1dJh0HSWkZab8K', 'ENT', NULL, '2025-07-03 08:56:18', '2025-07-03 08:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb3_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_01_160916_create_personal_access_tokens_table', 1),
(5, '2025_07_02_061101_create_healthcare_professionals_table', 1),
(6, '2025_07_02_065914_create_appointments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '0dee5059ab830660526cdd4b1336359e62d58f6d16c057f0b59b2b745174eb05', '[\"*\"]', '2025-07-03 08:54:30', NULL, '2025-07-03 06:42:15', '2025-07-03 08:54:30'),
(2, 'App\\Models\\User', 6, 'auth_token', '650e3d79feeb1db8f3804d6e9a311297ae165cd3700c78cc56d4a675f0f0abaa', '[\"*\"]', '2025-07-03 08:55:43', NULL, '2025-07-03 08:53:47', '2025-07-03 08:55:43'),
(3, 'App\\Models\\HealthcareProfessional', 6, 'healthcare_token', 'e640f8e7eb6e6814dffffda13b8253537bab28be1f09a9e4d66bc414d61d854c', '[\"*\"]', '2025-07-03 08:57:23', NULL, '2025-07-03 08:56:29', '2025-07-03 08:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb3_unicode_ci,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abhi Patel', 'abhipatel@gmail.com', NULL, '$2y$12$3Em1wlhBNnvmrVvJF/uKTu1h/yGuNFS7oVA8czaZ4PD0enj.EsHQG', NULL, NULL, NULL),
(2, 'Bhavik Patel', 'bhavikpatel@gmail.com', NULL, '$2y$12$dba5BcIg5beIyxt7XMK4Ouf6l8PR6hkj0uKfEQP5K2qUwHpdKS83S', NULL, NULL, NULL),
(3, 'Vaishali Patel', 'vaishalipatel@gmail.com', NULL, '$2y$12$yJ2KOyUPWwg9xzTXwV7hmOu2WE5HZHx.N04Kb4GkGiBk886/gKI3.', NULL, NULL, NULL),
(4, 'Nikita Patel', 'nikitapatel@gmail.com', NULL, '$2y$12$5H3pwC4I8I05ErBPMnIsCugQ4XtlFUx3TwjVtqzYY.J7Olwu6OmU6', NULL, NULL, NULL),
(5, 'Hardik Patel', 'hardikpatel@gmail.com', NULL, '$2y$12$4VKAdSZMCmLredauKsiCAOnvmZJGWCTt0nMQqtyJ1tPFPNjzqNAPu', NULL, NULL, NULL),
(6, 'Dhara Patel', 'dharapatel@gmail.com', NULL, '$2y$12$W3WKIwGHn3HESgjum.HOIuBLyqeIx2CIeTf7m8WFvlupDFFhNsf1S', NULL, '2025-07-03 08:53:32', '2025-07-03 08:53:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
