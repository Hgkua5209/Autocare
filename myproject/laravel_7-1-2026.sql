-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2026 at 10:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `data`, `created_at`, `updated_at`) VALUES
(1, 'Apricot Pancake', '{\"image\":\"images\\/foods\\/apricot-pancake.jpg\",\"rating\":4,\"like\":120,\"saved\":56,\"ingredient\":[\"Apricot\",\"Egg\",\"Milk\"],\"description\":\"Autoimmune friendly pancake\",\"nutrition\":{\"calories\":\"320 kcal\",\"protein\":\"12 g\",\"carbs\":\"40 g\",\"fat\":\"10 g\"}}', '2026-01-07 01:11:27', '2026-01-07 01:11:27'),
(2, 'Egg Dim Sum', '{\"image\":\"images\\/foods\\/Egg-Dim-Sum.jpg\",\"rating\":4.5,\"like\":98,\"saved\":40,\"ingredient\":[\"Egg\",\"Rice Flour\",\"Vegetables\"],\"description\":\"Light and gut-friendly dim sum\",\"nutrition\":{\"calories\":\"180 kcal\",\"protein\":\"9 g\",\"carbs\":\"22 g\",\"fat\":\"6 g\"}}', '2026-01-07 01:11:27', '2026-01-07 01:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `food_submissions`
--

CREATE TABLE `food_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `rejection_reason` text DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_surveys`
--

CREATE TABLE `medical_surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `height_cm` int(11) NOT NULL,
  `weight_kg` decimal(8,2) NOT NULL,
  `bmi` decimal(8,2) NOT NULL,
  `main_symptoms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`main_symptoms`)),
  `symptom_duration` varchar(255) NOT NULL,
  `pain_level` int(11) NOT NULL,
  `fatigue_level` int(11) NOT NULL,
  `impact_on_daily_life` int(11) NOT NULL,
  `diet_description` text NOT NULL,
  `sleep_quality` int(11) NOT NULL,
  `sleep_duration` varchar(255) NOT NULL,
  `stress_level` int(11) NOT NULL,
  `water_consumption` int(11) NOT NULL,
  `smoking_status` varchar(255) NOT NULL,
  `alcohol_consumption` varchar(255) NOT NULL,
  `physical_activity_level` varchar(255) NOT NULL,
  `existing_diagnosis` text DEFAULT NULL,
  `medications` text DEFAULT NULL,
  `family_history` text DEFAULT NULL,
  `diagnosis_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_surveys`
--

INSERT INTO `medical_surveys` (`id`, `patient_name`, `age`, `gender`, `height_cm`, `weight_kg`, `bmi`, `main_symptoms`, `symptom_duration`, `pain_level`, `fatigue_level`, `impact_on_daily_life`, `diet_description`, `sleep_quality`, `sleep_duration`, `stress_level`, `water_consumption`, `smoking_status`, `alcohol_consumption`, `physical_activity_level`, `existing_diagnosis`, `medications`, `family_history`, `diagnosis_details`, `created_at`, `updated_at`) VALUES
(1, 'Haziq', 22, 'Male', 175, '80.00', '26.12', '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\",\\\"Brain Fog\\\"]\"', 'Less than 1 week', 8, 10, 10, 'I try to eat a balanced meal most days, usually consisting of chicken, rice, and some broccoli. I eat out on weekends but attempt to stay nutritious during the work week. I could probably add more organic produce to my routine.', 8, '7-8', 4, 8, 'Non-smoker', 'Non-drinker', 'Moderate', 'Diabetes', 'Insulin', 'No', 'No', '2026-01-07 01:15:55', '2026-01-07 01:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_12_04_101954_add_personal_info_to_medical_surveys_table', 1),
(6, '2025_12_14_122331_add_role_to_users_table', 1),
(7, '2025_12_22_120340_create_foods_table', 1),
(8, '2026_01_04_140149_create_food_submissions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$ouzJ0rFogxMi0hlf4pqm8eJNTvmKI50Ls5JODfT6IKE5xa08igsLq', NULL, '2026-01-07 01:12:13', '2026-01-07 01:12:13', 'admin'),
(2, 'hadif', 'hadiffikrifirdaus@gmail.com', NULL, '$2y$12$Ef3JLff3ME1a2iPYuNPRseu8HIpYed50zYxnoXxuN/n9lBacGa0ty', NULL, '2026-01-07 01:12:29', '2026-01-07 01:12:29', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_submissions`
--
ALTER TABLE `food_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_submissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `medical_surveys`
--
ALTER TABLE `medical_surveys`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food_submissions`
--
ALTER TABLE `food_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_surveys`
--
ALTER TABLE `medical_surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_submissions`
--
ALTER TABLE `food_submissions`
  ADD CONSTRAINT `food_submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
