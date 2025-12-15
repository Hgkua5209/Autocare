-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2025 at 09:15 AM
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
-- Table structure for table `medical_surveys`
--

CREATE TABLE `medical_surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `diet_description` text DEFAULT NULL,
  `main_symptoms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`main_symptoms`)),
  `symptom_duration` varchar(50) DEFAULT NULL,
  `pain_level` int(11) DEFAULT NULL,
  `fatigue_level` int(11) DEFAULT NULL,
  `impact_on_daily_life` int(11) DEFAULT NULL,
  `existing_diagnosis` varchar(500) DEFAULT NULL,
  `diagnosis_details` text DEFAULT NULL,
  `general_diet_pattern` varchar(100) DEFAULT NULL,
  `suspected_food_triggers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`suspected_food_triggers`)),
  `water_consumption` int(11) DEFAULT NULL,
  `sleep_quality` int(11) DEFAULT NULL,
  `sleep_duration` varchar(50) DEFAULT NULL,
  `stress_level` int(11) DEFAULT NULL,
  `smoking_status` varchar(50) DEFAULT NULL,
  `alcohol_consumption` varchar(50) DEFAULT NULL,
  `physical_activity_level` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `height_cm` int(11) DEFAULT NULL,
  `weight_kg` decimal(8,2) DEFAULT NULL,
  `bmi` decimal(5,2) DEFAULT NULL,
  `medications` text DEFAULT NULL,
  `family_history` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_surveys`
--

INSERT INTO `medical_surveys` (`id`, `user_id`, `diet_description`, `main_symptoms`, `symptom_duration`, `pain_level`, `fatigue_level`, `impact_on_daily_life`, `existing_diagnosis`, `diagnosis_details`, `general_diet_pattern`, `suspected_food_triggers`, `water_consumption`, `sleep_quality`, `sleep_duration`, `stress_level`, `smoking_status`, `alcohol_consumption`, `physical_activity_level`, `created_at`, `updated_at`, `patient_name`, `age`, `gender`, `height_cm`, `weight_kg`, `bmi`, `medications`, `family_history`) VALUES
(1, NULL, 'asdawdfsdfsfsdf', '\"[\\\"Fatigue\\\",\\\"Muscle Pain\\\",\\\"Brain Fog\\\"]\"', 'Less than 1 month', 7, 6, 6, '0', 'dfsdfsfsfsfsfsfsf', NULL, NULL, 3, 3, '3.0', 3, 'Regular', 'Occasionally', 'Light', '2025-12-03 21:52:37', '2025-12-03 21:52:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 'terbaik sangat', '\"[\\\"Fever\\\",\\\"Hair Loss\\\"]\"', 'More than 1 year', 5, 5, 5, '0', 'dfsdfs', NULL, NULL, 2, 2, '2.0', 2, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-03 21:59:19', '2025-12-03 21:59:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, 'terbaik sangat', '\"[\\\"Fever\\\",\\\"Hair Loss\\\"]\"', 'More than 1 year', 5, 5, 5, '0', 'dfsdfs', NULL, NULL, 2, 2, '2.0', 2, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-03 22:20:38', '2025-12-03 22:20:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 'terbaik sangat', '\"[\\\"Fever\\\",\\\"Hair Loss\\\"]\"', 'More than 1 year', 5, 5, 5, '0', 'dfsdfs', NULL, NULL, 2, 2, '2.0', 2, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-03 22:20:44', '2025-12-03 22:20:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, 'rrrrataaaaaaa', '\"[\\\"Brain Fog\\\",\\\"Digestive Issues\\\",\\\"Sleep Disturbance\\\"]\"', 'More than 1 year', 6, 6, 6, '0', 'dsfsfsdfdfs', NULL, NULL, 2, 2, '2.0', 2, 'Non-smoker', 'Occasionally', 'Light', '2025-12-03 22:23:57', '2025-12-03 22:23:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 'rrrrataaaaaaa', '\"[\\\"Brain Fog\\\",\\\"Digestive Issues\\\",\\\"Sleep Disturbance\\\"]\"', 'More than 1 year', 6, 6, 6, '0', 'dsfsfsdfdfs', NULL, NULL, 2, 2, '2.0', 2, 'Non-smoker', 'Occasionally', 'Light', '2025-12-03 22:24:42', '2025-12-03 22:24:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, 'takutttttttttttt', '\"[\\\"Joint Pain\\\",\\\"Headache\\\"]\"', 'More than 1 year', 6, 6, 6, '0', NULL, NULL, NULL, 2, 2, '2.0', 2, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-03 22:25:20', '2025-12-03 22:25:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, 'main mainnnn', '\"[\\\"Fatigue\\\",\\\"Dry Mouth\\\\\\/Eyes\\\"]\"', '3-6 months', 6, 6, 6, '0', NULL, NULL, NULL, 3, 3, '3.0', 3, 'Non-smoker', 'Occasionally', 'Light', '2025-12-03 22:35:46', '2025-12-03 22:35:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, 'main mainnnn', '\"[\\\"Fatigue\\\",\\\"Joint Pain\\\"]\"', 'More than 1 year', 6, 6, 6, '0', NULL, NULL, NULL, 3, 3, '3.0', 3, 'Occasional', 'Occasionally', 'Light', '2025-12-03 22:58:26', '2025-12-03 22:58:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 'main mainnnn', '\"[\\\"Fatigue\\\",\\\"Joint Pain\\\"]\"', 'More than 1 year', 6, 6, 6, '0', NULL, NULL, NULL, 3, 3, '3.0', 3, 'Occasional', 'Occasionally', 'Light', '2025-12-03 23:00:17', '2025-12-03 23:00:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, 'main mainnnn', '\"[\\\"Fatigue\\\",\\\"Joint Pain\\\",\\\"Brain Fog\\\",\\\"Digestive Issues\\\",\\\"Swelling\\\"]\"', 'More than 1 year', 6, 6, 6, '0', NULL, NULL, NULL, 3, 3, '3.0', 3, 'Occasional', 'Occasionally', 'Light', '2025-12-03 23:01:35', '2025-12-03 23:01:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, NULL, 'i eat on breakfast and dinner, i only eat vegetable(vegetarian, i cant eat milk and meat', '\"[\\\"Joint Pain\\\",\\\"Skin Rash\\\"]\"', '6-12 months', 3, 2, 3, 'no', 'no', NULL, NULL, 4, 2, 'Less than 5', 2, 'Non-smoker', 'Occasionally', 'Light', '2025-12-04 02:52:36', '2025-12-04 02:52:36', 'miranajwa', 20, 'Male', 176, '56.00', '18.08', 'no', 'no'),
(13, NULL, 'im only eat vegetables. no meat, no milk, no vege', '\"[\\\"Muscle Pain\\\",\\\"Fever\\\"]\"', 'Less than 1 week', 3, 5, 7, 'no', 'no', NULL, NULL, 2, 8, '6-7', 5, 'Occasional', 'Non-drinker', 'Light', '2025-12-04 04:05:47', '2025-12-04 04:05:47', 'CikinPop', 22, 'Male', 176, '74.80', '24.15', 'no', 'no'),
(14, NULL, 'cannot eat meat,milk,flour... more to vegetarian', '\"[\\\"Digestive Issues\\\"]\"', '1-4 weeks', 2, 4, 6, 'no', 'no', NULL, NULL, 9, 4, 'Less than 5', 8, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-04 04:10:07', '2025-12-04 04:10:07', 'BtuBrader', 33, 'Male', 156, '45.00', '18.49', 'no', 'no'),
(15, NULL, 'cannot eat meat,milk,flour... more to vegetarian', '\"[\\\"Digestive Issues\\\"]\"', '1-4 weeks', 2, 4, 6, 'no', 'no', NULL, NULL, 9, 4, 'Less than 5', 8, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-04 04:10:54', '2025-12-04 04:10:54', 'BtuBrader', 33, 'Male', 156, '45.00', '18.49', 'no', 'no'),
(16, NULL, 'cannot eat meat,milk,flour... more to vegetarian', '\"[\\\"Digestive Issues\\\"]\"', '1-4 weeks', 2, 4, 6, 'no', 'no', NULL, NULL, 9, 4, 'Less than 5', 8, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-04 04:15:12', '2025-12-04 04:15:12', 'BtuBrader', 33, 'Male', 156, '45.00', '18.49', 'no', 'no'),
(17, NULL, 'cannot eat meat,milk,flour... more to vegetarian', '\"[\\\"Digestive Issues\\\"]\"', '1-4 weeks', 2, 4, 6, 'no', 'no', NULL, NULL, 9, 4, 'Less than 5', 8, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-04 04:15:34', '2025-12-04 04:15:34', 'BtuBrader', 33, 'Male', 156, '45.00', '18.49', 'no', 'no'),
(18, NULL, 'cannot eat meat,milk,flour... more to vegetarian', '\"[\\\"Digestive Issues\\\"]\"', '1-4 weeks', 2, 4, 6, 'no', 'no', NULL, NULL, 9, 4, 'Less than 5', 8, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-04 04:20:43', '2025-12-04 04:20:43', 'BtuBrader', 33, 'Male', 156, '45.00', '18.49', 'no', 'no'),
(19, NULL, 'cannot eat meat,milk,flour... more to vegetarian', '\"[\\\"Digestive Issues\\\"]\"', '1-4 weeks', 2, 4, 6, 'no', 'no', NULL, NULL, 9, 4, 'Less than 5', 8, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-04 04:41:14', '2025-12-04 04:41:14', 'BtuBrader', 33, 'Male', 156, '45.00', '18.49', 'no', 'no'),
(20, NULL, 'cannot eat meat,milk,flour... more to vegetarian', '\"[\\\"Digestive Issues\\\"]\"', '1-4 weeks', 2, 4, 6, 'no', 'no', NULL, NULL, 9, 4, 'Less than 5', 8, 'Non-smoker', 'Occasionally', 'Moderate', '2025-12-04 04:46:49', '2025-12-04 04:46:49', 'BtuBrader', 33, 'Male', 156, '45.00', '18.49', 'no', 'no'),
(21, NULL, 'only eat vegetables', '\"[\\\"Skin Rash\\\",\\\"Hair Loss\\\"]\"', '1-4 weeks', 2, 3, 5, 'no', 'no', NULL, NULL, 4, 4, 'Less than 5', 8, 'Non-smoker', 'Non-drinker', 'Light', '2025-12-04 05:07:29', '2025-12-04 05:07:29', 'BtuBrader', 44, 'Male', 156, '56.00', '23.01', 'no', 'ni'),
(22, NULL, 'only eat vegetables', '\"[\\\"Muscle Pain\\\",\\\"Fever\\\"]\"', '3-6 months', 3, 5, 7, 'no', 'no', NULL, NULL, 10, 6, 'Less than 5', 9, 'Non-smoker', 'Non-drinker', 'Light', '2025-12-04 05:21:11', '2025-12-04 05:21:11', 'sdf', 23, 'Male', 123, '54.00', '35.69', 'no', 'no'),
(23, NULL, 'asdwadw', '\"[\\\"Skin Rash\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', '3-6 months', 4, 6, 8, 'no', 'no', NULL, NULL, 7, 7, '5-6', 3, 'Non-smoker', 'Occasionally', 'Light', '2025-12-04 05:25:33', '2025-12-04 05:25:33', 'BtuBrader', 30, 'Male', 180, '79.00', '24.38', 'no', 'no'),
(24, NULL, 'asdwadw', '\"[\\\"Skin Rash\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', '3-6 months', 4, 6, 8, 'no', 'no', NULL, NULL, 7, 7, '5-6', 3, 'Non-smoker', 'Occasionally', 'Light', '2025-12-04 05:32:28', '2025-12-04 05:32:28', 'BtuBrader', 30, 'Male', 180, '79.00', '24.38', 'no', 'no'),
(25, NULL, 'asdwadw', '\"[\\\"Skin Rash\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', '3-6 months', 4, 6, 8, 'no', 'no', NULL, NULL, 7, 7, '5-6', 4, 'Non-smoker', 'Occasionally', 'Light', '2025-12-04 05:47:43', '2025-12-04 05:47:43', 'BtuBrader', 30, 'Male', 180, '79.00', '24.38', 'no', 'no');

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
(5, '2025_12_04_101954_add_personal_info_to_medical_surveys_table', 2),
(6, '2025_12_04_105127_fix_medical_surveys_columns', 3),
(7, '2025_12_14_122331_add_role_to_users_table', 4);

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
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$BETVLJSAW6MQ1AQKepMri.5X9Um.dJ.rZuvnCiX0zO9Imhz8cUCjS', NULL, '2025-11-19 12:19:52', '2025-11-19 12:19:52', 'admin'),
(2, 'hadif', 'hadiffikrifirdaus@gmail.com', NULL, '$2y$12$4unly8OUDcP.x.pte6FDzOn7IbyMDKIimVGtgVcKaLUBiVOcYqmWK', NULL, '2025-12-14 04:41:32', '2025-12-14 04:41:32', 'user');

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
-- Indexes for table `medical_surveys`
--
ALTER TABLE `medical_surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `medical_surveys`
--
ALTER TABLE `medical_surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Constraints for table `medical_surveys`
--
ALTER TABLE `medical_surveys`
  ADD CONSTRAINT `medical_surveys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
