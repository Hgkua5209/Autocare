-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2026 at 02:05 PM
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
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'keep fighting!', '2026-05-07 05:33:59', '2026-05-07 05:33:59'),
(2, 2, 1, 'nice tips!', '2026-05-07 05:34:21', '2026-05-07 05:34:21'),
(3, 7, 1, 'Attend', '2026-05-07 05:34:59', '2026-05-07 05:34:59'),
(4, 6, 1, 'Keep Fighting!', '2026-05-07 05:35:32', '2026-05-07 05:35:32'),
(5, 11, 1, 'setuju!', '2026-05-07 05:35:52', '2026-05-07 05:35:52'),
(6, 10, 1, 'good step!', '2026-05-07 05:36:38', '2026-05-07 05:36:38'),
(7, 4, 2, 'thank you!', '2026-05-07 05:38:13', '2026-05-07 05:38:13'),
(8, 9, 2, 'is it really work?', '2026-05-07 05:38:55', '2026-05-07 05:38:55'),
(9, 1, 2, 'stay healthy bro / sis!', '2026-05-07 05:39:52', '2026-05-07 05:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `daily_logs`
--

CREATE TABLE `daily_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `progress_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pain_level` int(11) NOT NULL,
  `fatigue_level` int(11) NOT NULL,
  `stress_level` int(11) NOT NULL,
  `symptoms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`symptoms`)),
  `sleep_hours` int(11) NOT NULL,
  `water_intake` int(11) NOT NULL,
  `activity_level` varchar(255) NOT NULL,
  `food_intake` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`food_intake`)),
  `triggers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`triggers`)),
  `took_medication` tinyint(1) NOT NULL,
  `medication_note` text DEFAULT NULL,
  `overall_condition` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_logs`
--

INSERT INTO `daily_logs` (`id`, `user_id`, `progress_id`, `pain_level`, `fatigue_level`, `stress_level`, `symptoms`, `sleep_hours`, `water_intake`, `activity_level`, `food_intake`, `triggers`, `took_medication`, `medication_note`, `overall_condition`, `created_at`, `updated_at`) VALUES
(1, 1, 18, 1, 2, 3, '[]', 3, 3, 'Low', NULL, NULL, 1, NULL, 3, '2026-04-29 01:13:39', '2026-04-29 01:13:39'),
(2, 1, 18, 1, 1, 1, '[\"fatigue\"]', 3, 1, 'Low', '\"chicken\"', '\"stress\"', 1, NULL, 3, '2026-04-29 01:13:58', '2026-04-29 01:13:58'),
(3, 1, 20, 8, 8, 8, '[\"joint_pain\",\"fatigue\"]', 4, 3, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 2, '2026-04-29 03:12:10', '2026-04-29 03:12:10'),
(4, 1, 20, 7, 7, 6, '[\"joint_pain\",\"fatigue\"]', 4, 4, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 4, '2026-04-29 03:12:47', '2026-04-29 03:12:47'),
(5, 1, 20, 6, 6, 6, '[\"joint_pain\",\"fatigue\"]', 5, 4, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 5, '2026-04-29 03:13:23', '2026-04-29 03:13:23'),
(6, 1, 20, 5, 5, 5, '[\"fatigue\"]', 5, 5, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 5, '2026-04-29 03:13:56', '2026-04-29 03:13:56'),
(7, 1, 20, 4, 4, 4, '[\"fatigue\"]', 6, 5, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 6, '2026-04-29 03:14:28', '2026-04-29 03:14:28'),
(8, 1, 20, 3, 3, 3, '[\"fatigue\"]', 7, 6, 'Moderate', '\"rice, chicken\"', '\"stress\"', 1, NULL, 8, '2026-04-29 03:15:04', '2026-04-29 03:15:04'),
(9, 1, 20, 2, 2, 2, '[]', 8, 7, 'High', '\"rice, chicken\"', NULL, 1, NULL, 10, '2026-04-29 03:15:39', '2026-04-29 03:15:39'),
(10, 1, 21, 7, 1, 4, '[\"fatigue\"]', 6, 15, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 6, '2026-04-29 05:33:23', '2026-04-29 05:33:23'),
(11, 1, 21, 5, 4, 3, '[\"joint_pain\",\"fatigue\"]', 5, 4, 'Low', NULL, '\"stress\"', 1, NULL, 4, '2026-04-29 05:34:30', '2026-04-29 05:34:30'),
(12, 1, 21, 1, 4, 9, '[\"joint_pain\",\"fatigue\"]', 1, 9, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 4, '2026-04-29 05:36:24', '2026-04-29 05:36:24'),
(13, 1, 21, 8, 5, 1, '[\"fatigue\"]', 6, 6, 'Low', '\"rice, chicken\"', NULL, 1, NULL, 4, '2026-04-29 05:38:27', '2026-04-29 05:38:27'),
(14, 1, 21, 2, 8, 5, '[\"joint_pain\",\"fatigue\"]', 4, 3, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 4, '2026-04-29 05:38:53', '2026-04-29 05:38:53'),
(15, 1, 21, 7, 10, 3, '[\"joint_pain\",\"fatigue\"]', 4, 4, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 5, '2026-04-29 05:39:10', '2026-04-29 05:39:10'),
(16, 1, 21, 7, 2, 8, '[\"fatigue\"]', 5, 7, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 9, '2026-04-29 05:39:29', '2026-04-29 05:39:29'),
(17, 1, 22, 1, 3, 5, '[\"joint_pain\",\"fatigue\"]', 3, 2, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 4, '2026-04-29 06:34:07', '2026-04-29 06:34:07'),
(18, 1, 25, 3, 4, 4, '[\"joint_pain\",\"fatigue\"]', 4, 6, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 5, '2026-05-06 19:37:54', '2026-05-06 19:37:54'),
(19, 2, 7, 6, 7, 6, '[\"joint_pain\",\"fatigue\"]', 6, 6, 'Low', '\"rice, chicken\"', NULL, 1, NULL, 6, '2026-06-02 06:27:13', '2026-06-02 06:27:13'),
(20, 2, 7, 7, 7, 7, '[\"joint_pain\",\"fatigue\"]', 7, 6, 'Low', '\"rice, chicken\"', '\"stress\"', 1, NULL, 6, '2026-06-02 06:27:40', '2026-06-02 06:27:40');

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
  `disease_category` varchar(255) NOT NULL DEFAULT 'General',
  `recommendation_type` varchar(255) NOT NULL DEFAULT 'Benefit',
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `disease_category`, `recommendation_type`, `data`, `created_at`, `updated_at`) VALUES
(14, 'Wild Caught Salmon', 'General', 'Benefit', '{\"image\":\"food-submissions\\/NQFyhCUGdqwSSxG7a9pUawCfv3tOuJ7MLtVyBTJv.jpg\",\"ingredients\":[\"salmon\"],\"nutrition\":{\"calories\":\"208\",\"protein\":\"20\",\"carbs\":\"0\",\"fat\":\"13\",\"fiber\":\"0\"},\"description\":\"Omega-3 rich protein.\",\"autoimmune_notes\":\"Reduces inflammation via omega-3.\",\"research\":{\"title\":\"Omega-3 and Autoimmune Diseases\",\"source\":\"KKM\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Omega-3 fatty acids reduce inflammation. Omega-3 fatty acids reduce inflammation.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:56:48', '2026-04-19 01:56:48'),
(15, 'Blueberries', 'General', 'Benefit', '{\"image\":\"food-submissions\\/UbTUkrb2wzqcgVaFdiIevusrX0LhyWy6bRby2Ok4.jpg\",\"ingredients\":[\"blueberries\"],\"nutrition\":{\"calories\":\"57\",\"protein\":\"1\",\"carbs\":\"14\",\"fat\":\"0.3\",\"fiber\":\"3\"},\"description\":\"Rich in antioxidants.\",\"autoimmune_notes\":\"Protects against oxidative stress.\",\"research\":{\"title\":\"Antioxidants and Immune System\",\"source\":\"WHO\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Blueberries improve immune response.Blueberries improve immune response.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:56:51', '2026-04-19 01:56:51'),
(16, 'Turmeric (with Black Pepper)', 'General', 'Benefit', '{\"image\":\"food-submissions\\/4LX66IkToHRSmSKv27Q8Gnx5tiv0kRhAUr8O8siN.jpg\",\"ingredients\":[\"turmeric\",\"black pepper\"],\"nutrition\":{\"calories\":\"30\",\"protein\":\"1\",\"carbs\":\"6\",\"fat\":\"1\",\"fiber\":\"2\"},\"description\":\"Anti-inflammatory spice.\",\"autoimmune_notes\":\"Curcumin reduces inflammation.\",\"research\":{\"title\":\"Curcumin and Inflammatory Diseases\",\"source\":\"PubMed\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Curcumin shows anti-inflammatory effects. Curcumin shows anti-inflammatory effects.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:56:54', '2026-04-19 01:56:54'),
(17, 'Bone Broth', 'General', 'Benefit', '{\"image\":\"food-submissions\\/oEZHN2H4tcw4yz6z3l2stpyrIDgeixsieukUzcq9.jpg\",\"ingredients\":[\"bone\",\"water\"],\"nutrition\":{\"calories\":\"40\",\"protein\":\"9\",\"carbs\":\"0\",\"fat\":\"1\",\"fiber\":\"0\"},\"description\":\"Supports joints and gut.\",\"autoimmune_notes\":\"Helpful but depends on tolerance.\",\"research\":{\"title\":\"Collagen and Gut Health\",\"source\":\"KKM\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Collagen supports gut lining integrity.Collagen supports gut lining integrity.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:56:56', '2026-04-19 01:56:56'),
(18, 'Extra Virgin Olive Oil', 'General', 'Benefit', '{\"image\":\"food-submissions\\/SXMkRPapyGdVG016OGNbuUAuOjXsLztu4ZwVWG77.jpg\",\"ingredients\":[\"olive oil\"],\"nutrition\":{\"calories\":\"119\",\"protein\":\"0\",\"carbs\":\"0\",\"fat\":\"14\",\"fiber\":\"0\"},\"description\":\"Healthy fats source.\",\"autoimmune_notes\":\"Reduces inflammatory response.\",\"research\":{\"title\":\"Mediterranean Diet and Inflammation\",\"source\":\"KKM\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Olive oil linked to reduced inflammation.Olive oil linked to reduced inflammation.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:56:59', '2026-04-19 01:56:59'),
(19, 'Kale', 'General', 'Benefit', '{\"image\":\"food-submissions\\/193nCbj0gBB9srn2V8sRna7ieqbaZGBpQcJWy7mb.jpg\",\"ingredients\":[\"kale\"],\"nutrition\":{\"calories\":\"49\",\"protein\":\"4\",\"carbs\":\"9\",\"fat\":\"1\",\"fiber\":\"4\"},\"description\":\"Highly nutritious leafy green.\",\"autoimmune_notes\":\"High in antioxidants.\",\"research\":{\"title\":\"Leafy Greens and Chronic Disease\",\"source\":\"KKM\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Leafy greens reduce inflammation markers. Leafy greens reduce inflammation markers.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:57:01', '2026-04-19 01:57:01'),
(20, 'Sauerkraut', 'General', 'Benefit', '{\"image\":\"food-submissions\\/7yoi4x4SxLrGUmIhNrIiYdndre8Xml4AjtQeQk6G.jpg\",\"ingredients\":[\"cabbage\",\"salt\"],\"nutrition\":{\"calories\":\"27\",\"protein\":\"1\",\"carbs\":\"6\",\"fat\":\"0.1\",\"fiber\":\"2\"},\"description\":\"Fermented probiotic food.\",\"autoimmune_notes\":\"Improves gut microbiome.\",\"research\":{\"title\":\"Probiotics and Autoimmune Health\",\"source\":\"PubMed\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Fermented foods improve gut bacteria diversity.Fermented foods improve gut bacteria diversity.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:57:03', '2026-04-19 01:57:03'),
(21, 'Sweet Potatoes', 'General', 'Benefit', '{\"image\":\"food-submissions\\/4hWXVfs6SahuTaMdImTUJNWiyeSJV5snXmuwWmI2.jpg\",\"ingredients\":[\"sweet potato\"],\"nutrition\":{\"calories\":\"90\",\"protein\":\"2\",\"carbs\":\"21\",\"fat\":\"0.1\",\"fiber\":\"3\"},\"description\":\"Rich in vitamins and fiber\",\"autoimmune_notes\":\"Good for gut and energy balance.\",\"research\":{\"title\":\"Carbohydrates and Immune Response\",\"source\":\"WHO\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Balanced carbs support stable immune activity and its super good for health and growth.\"},\"rating\":\"0.0\",\"like\":1,\"saved\":8}', '2026-04-19 01:57:05', '2026-04-27 23:31:50'),
(22, 'Broccoli', 'General', 'Benefit', '{\"image\":\"food-submissions\\/mqJux6vE177qQ0HnI2vzr3709ZSnOZjJYjsp2PqV.jpg\",\"ingredients\":[\"broccoli\"],\"nutrition\":{\"calories\":\"55\",\"protein\":\"4\",\"carbs\":\"11\",\"fat\":\"0.5\",\"fiber\":\"3\"},\"description\":\"Supports detox and immune health.\",\"autoimmune_notes\":\"Contains sulforaphane which reduces inflammation.\",\"research\":{\"title\":\"Sulforaphane Effects on Inflammation\",\"source\":\"PubMed\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Broccoli compounds reduce inflammatory pathways and good good for diet and health\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:57:07', '2026-04-19 01:57:07'),
(23, 'Organic Spinach & Berry Salad', 'General', 'Benefit', '{\"image\":\"food-submissions\\/by5FcaA6ccoBZvFJtAQCNxFm0TCk9mjBJuad8knt.jpg\",\"ingredients\":[\"spinach\",\"berries\",\"olive oil\"],\"nutrition\":{\"calories\":\"150\",\"protein\":\"2\",\"carbs\":\"20\",\"fat\":\"6\",\"fiber\":\"5\"},\"description\":\"Rich in antioxidants\",\"autoimmune_notes\":\"Helps reduce oxidative stress.\",\"research\":{\"title\":\"Antioxidants and Inflammation Reduction\",\"source\":\"PubMed\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Antioxidants reduce inflammation markers in autoimmune patients\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:57:09', '2026-04-19 01:57:09'),
(24, 'Egg Dim Sum', 'General', 'Benefit', '{\"image\":\"food-submissions\\/a2qPuLYPswmOEkggAS1HwYXEQT592nX5Og4s468h.jpg\",\"ingredients\":[\"egg\",\"flour\",\"chives\"],\"nutrition\":{\"calories\":\"220\",\"protein\":\"10\",\"carbs\":\"18\",\"fat\":\"9\",\"fiber\":\"2\"},\"description\":\"Light protein-based dish.\",\"autoimmune_notes\":\"Safe if consumed moderately.\",\"research\":{\"title\":\"Protein Intake and Immune Function\",\"source\":\"WHO\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Adequate protein supports immune system regulation.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:57:12', '2026-04-19 01:57:12'),
(25, 'Apricot Pancake', 'General', 'Benefit', '{\"image\":\"food-submissions\\/z9OowB2EJzj3OR6LQjNaYbX71kNMTY9Zuah8rFbP.webp\",\"ingredients\":[\"apricot\",\"oats\",\"egg\",\"almond milk\"],\"nutrition\":{\"calories\":\"180\",\"protein\":\"6\",\"carbs\":\"28\",\"fat\":\"9\",\"fiber\":\"2\"},\"description\":\"High fiber breakfast option for gut health.\",\"autoimmune_notes\":\"Low inflammation ingredients, easy digestion.\",\"research\":{\"title\":\"Dietary Fiber and Gut Microbiota\",\"source\":\"PubMed\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Fiber intake improves gut bacteria and reduces inflammation.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-19 01:57:14', '2026-04-19 01:57:14');

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

--
-- Dumping data for table `food_submissions`
--

INSERT INTO `food_submissions` (`id`, `user_id`, `name`, `type`, `data`, `status`, `rejection_reason`, `admin_note`, `created_at`, `updated_at`) VALUES
(11, 1, 'Haziq', 'food', '{\"image\":\"food-submissions\\/2SZoSycESlVUrU0KYMtAMrZQt7eACI0JAVxZNIbt.png\",\"ingredients\":[\"abc\"],\"nutrition\":{\"calories\":\"12\",\"protein\":\"12\",\"carbs\":\"12\",\"fat\":\"12\",\"fiber\":\"12\"},\"description\":\"a\",\"autoimmune_notes\":\"safe and sedap\",\"research\":{\"title\":\"ad\",\"source\":\"awd\",\"url\":\"https:\\/\\/malaysia.search.yahoo.com\\/search?fr=mcafee-malaysia&type=E210MY1590G0&p=meme\",\"summary\":\"asdasddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-18 23:57:17', '2026-04-19 00:14:49'),
(12, 3, 'Apricot Pancake', 'food', '{\"image\":\"food-submissions\\/z9OowB2EJzj3OR6LQjNaYbX71kNMTY9Zuah8rFbP.webp\",\"ingredients\":[\"apricot\",\"oats\",\"egg\",\"almond milk\"],\"nutrition\":{\"calories\":\"180\",\"protein\":\"6\",\"carbs\":\"28\",\"fat\":\"9\",\"fiber\":\"2\"},\"description\":\"High fiber breakfast option for gut health.\",\"autoimmune_notes\":\"Low inflammation ingredients, easy digestion.\",\"research\":{\"title\":\"Dietary Fiber and Gut Microbiota\",\"source\":\"PubMed\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Fiber intake improves gut bacteria and reduces inflammation.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 00:57:07', '2026-04-19 01:57:14'),
(13, 3, 'Egg Dim Sum', 'food', '{\"image\":\"food-submissions\\/a2qPuLYPswmOEkggAS1HwYXEQT592nX5Og4s468h.jpg\",\"ingredients\":[\"egg\",\"flour\",\"chives\"],\"nutrition\":{\"calories\":\"220\",\"protein\":\"10\",\"carbs\":\"18\",\"fat\":\"9\",\"fiber\":\"2\"},\"description\":\"Light protein-based dish.\",\"autoimmune_notes\":\"Safe if consumed moderately.\",\"research\":{\"title\":\"Protein Intake and Immune Function\",\"source\":\"WHO\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Adequate protein supports immune system regulation.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:03:13', '2026-04-19 01:57:12'),
(14, 3, 'Organic Spinach & Berry Salad', 'food', '{\"image\":\"food-submissions\\/by5FcaA6ccoBZvFJtAQCNxFm0TCk9mjBJuad8knt.jpg\",\"ingredients\":[\"spinach\",\"berries\",\"olive oil\"],\"nutrition\":{\"calories\":\"150\",\"protein\":\"2\",\"carbs\":\"20\",\"fat\":\"6\",\"fiber\":\"5\"},\"description\":\"Rich in antioxidants\",\"autoimmune_notes\":\"Helps reduce oxidative stress.\",\"research\":{\"title\":\"Antioxidants and Inflammation Reduction\",\"source\":\"PubMed\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Antioxidants reduce inflammation markers in autoimmune patients\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:06:40', '2026-04-19 01:57:09'),
(15, 3, 'Broccoli', 'food', '{\"image\":\"food-submissions\\/mqJux6vE177qQ0HnI2vzr3709ZSnOZjJYjsp2PqV.jpg\",\"ingredients\":[\"broccoli\"],\"nutrition\":{\"calories\":\"55\",\"protein\":\"4\",\"carbs\":\"11\",\"fat\":\"0.5\",\"fiber\":\"3\"},\"description\":\"Supports detox and immune health.\",\"autoimmune_notes\":\"Contains sulforaphane which reduces inflammation.\",\"research\":{\"title\":\"Sulforaphane Effects on Inflammation\",\"source\":\"PubMed\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Broccoli compounds reduce inflammatory pathways and good good for diet and health\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:12:11', '2026-04-19 01:57:07'),
(16, 3, 'Sweet Potatoes', 'food', '{\"image\":\"food-submissions\\/4hWXVfs6SahuTaMdImTUJNWiyeSJV5snXmuwWmI2.jpg\",\"ingredients\":[\"sweet potato\"],\"nutrition\":{\"calories\":\"90\",\"protein\":\"2\",\"carbs\":\"21\",\"fat\":\"0.1\",\"fiber\":\"3\"},\"description\":\"Rich in vitamins and fiber\",\"autoimmune_notes\":\"Good for gut and energy balance.\",\"research\":{\"title\":\"Carbohydrates and Immune Response\",\"source\":\"WHO\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Balanced carbs support stable immune activity and its super good for health and growth.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:19:29', '2026-04-19 01:57:05'),
(17, 3, 'Sauerkraut', 'food', '{\"image\":\"food-submissions\\/7yoi4x4SxLrGUmIhNrIiYdndre8Xml4AjtQeQk6G.jpg\",\"ingredients\":[\"cabbage\",\"salt\"],\"nutrition\":{\"calories\":\"27\",\"protein\":\"1\",\"carbs\":\"6\",\"fat\":\"0.1\",\"fiber\":\"2\"},\"description\":\"Fermented probiotic food.\",\"autoimmune_notes\":\"Improves gut microbiome.\",\"research\":{\"title\":\"Probiotics and Autoimmune Health\",\"source\":\"PubMed\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Fermented foods improve gut bacteria diversity.Fermented foods improve gut bacteria diversity.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:35:05', '2026-04-19 01:57:03'),
(18, 3, 'Kale', 'food', '{\"image\":\"food-submissions\\/193nCbj0gBB9srn2V8sRna7ieqbaZGBpQcJWy7mb.jpg\",\"ingredients\":[\"kale\"],\"nutrition\":{\"calories\":\"49\",\"protein\":\"4\",\"carbs\":\"9\",\"fat\":\"1\",\"fiber\":\"4\"},\"description\":\"Highly nutritious leafy green.\",\"autoimmune_notes\":\"High in antioxidants.\",\"research\":{\"title\":\"Leafy Greens and Chronic Disease\",\"source\":\"KKM\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Leafy greens reduce inflammation markers. Leafy greens reduce inflammation markers.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:38:27', '2026-04-19 01:57:01'),
(19, 3, 'Extra Virgin Olive Oil', 'food', '{\"image\":\"food-submissions\\/SXMkRPapyGdVG016OGNbuUAuOjXsLztu4ZwVWG77.jpg\",\"ingredients\":[\"olive oil\"],\"nutrition\":{\"calories\":\"119\",\"protein\":\"0\",\"carbs\":\"0\",\"fat\":\"14\",\"fiber\":\"0\"},\"description\":\"Healthy fats source.\",\"autoimmune_notes\":\"Reduces inflammatory response.\",\"research\":{\"title\":\"Mediterranean Diet and Inflammation\",\"source\":\"KKM\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Olive oil linked to reduced inflammation.Olive oil linked to reduced inflammation.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:41:41', '2026-04-19 01:56:59'),
(20, 3, 'Bone Broth', 'food', '{\"image\":\"food-submissions\\/oEZHN2H4tcw4yz6z3l2stpyrIDgeixsieukUzcq9.jpg\",\"ingredients\":[\"bone\",\"water\"],\"nutrition\":{\"calories\":\"40\",\"protein\":\"9\",\"carbs\":\"0\",\"fat\":\"1\",\"fiber\":\"0\"},\"description\":\"Supports joints and gut.\",\"autoimmune_notes\":\"Helpful but depends on tolerance.\",\"research\":{\"title\":\"Collagen and Gut Health\",\"source\":\"KKM\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Collagen supports gut lining integrity.Collagen supports gut lining integrity.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:45:18', '2026-04-19 01:56:56'),
(21, 3, 'Turmeric (with Black Pepper)', 'food', '{\"image\":\"food-submissions\\/4LX66IkToHRSmSKv27Q8Gnx5tiv0kRhAUr8O8siN.jpg\",\"ingredients\":[\"turmeric\",\"black pepper\"],\"nutrition\":{\"calories\":\"30\",\"protein\":\"1\",\"carbs\":\"6\",\"fat\":\"1\",\"fiber\":\"2\"},\"description\":\"Anti-inflammatory spice.\",\"autoimmune_notes\":\"Curcumin reduces inflammation.\",\"research\":{\"title\":\"Curcumin and Inflammatory Diseases\",\"source\":\"PubMed\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Curcumin shows anti-inflammatory effects. Curcumin shows anti-inflammatory effects.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:49:12', '2026-04-19 01:56:54'),
(22, 3, 'Blueberries', 'food', '{\"image\":\"food-submissions\\/UbTUkrb2wzqcgVaFdiIevusrX0LhyWy6bRby2Ok4.jpg\",\"ingredients\":[\"blueberries\"],\"nutrition\":{\"calories\":\"57\",\"protein\":\"1\",\"carbs\":\"14\",\"fat\":\"0.3\",\"fiber\":\"3\"},\"description\":\"Rich in antioxidants.\",\"autoimmune_notes\":\"Protects against oxidative stress.\",\"research\":{\"title\":\"Antioxidants and Immune System\",\"source\":\"WHO\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Blueberries improve immune response.Blueberries improve immune response.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:52:09', '2026-04-19 01:56:51'),
(23, 3, 'Wild Caught Salmon', 'food', '{\"image\":\"food-submissions\\/NQFyhCUGdqwSSxG7a9pUawCfv3tOuJ7MLtVyBTJv.jpg\",\"ingredients\":[\"salmon\"],\"nutrition\":{\"calories\":\"208\",\"protein\":\"20\",\"carbs\":\"0\",\"fat\":\"13\",\"fiber\":\"0\"},\"description\":\"Omega-3 rich protein.\",\"autoimmune_notes\":\"Reduces inflammation via omega-3.\",\"research\":{\"title\":\"Omega-3 and Autoimmune Diseases\",\"source\":\"KKM\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12171081\\/\",\"summary\":\"Omega-3 fatty acids reduce inflammation. Omega-3 fatty acids reduce inflammation.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-19 01:55:40', '2026-04-19 01:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(3, 1, 9, '2026-05-07 05:33:25', '2026-05-07 05:33:25'),
(4, 1, 10, '2026-05-07 05:33:27', '2026-05-07 05:33:27'),
(5, 1, 11, '2026-05-07 05:33:28', '2026-05-07 05:33:28'),
(6, 1, 12, '2026-05-07 05:33:29', '2026-05-07 05:33:29'),
(7, 1, 5, '2026-05-07 05:33:30', '2026-05-07 05:33:30'),
(8, 1, 6, '2026-05-07 05:33:31', '2026-05-07 05:33:31'),
(9, 1, 7, '2026-05-07 05:33:33', '2026-05-07 05:33:33'),
(10, 1, 8, '2026-05-07 05:33:34', '2026-05-07 05:33:34'),
(11, 1, 2, '2026-05-07 05:33:37', '2026-05-07 05:33:37'),
(12, 1, 1, '2026-05-07 05:33:38', '2026-05-07 05:33:38'),
(13, 1, 3, '2026-05-07 05:33:39', '2026-05-07 05:33:39'),
(14, 1, 4, '2026-05-07 05:33:42', '2026-05-07 05:33:42'),
(15, 2, 9, '2026-05-07 05:37:10', '2026-05-07 05:37:10'),
(16, 2, 10, '2026-05-07 05:37:11', '2026-05-07 05:37:11'),
(17, 2, 11, '2026-05-07 05:37:13', '2026-05-07 05:37:13'),
(18, 2, 12, '2026-05-07 05:37:14', '2026-05-07 05:37:14'),
(19, 2, 5, '2026-05-07 05:37:15', '2026-05-07 05:37:15'),
(20, 2, 6, '2026-05-07 05:37:17', '2026-05-07 05:37:17'),
(21, 2, 7, '2026-05-07 05:37:18', '2026-05-07 05:37:18'),
(22, 2, 8, '2026-05-07 05:37:19', '2026-05-07 05:37:19'),
(23, 2, 1, '2026-05-07 05:37:20', '2026-05-07 05:37:20'),
(24, 2, 2, '2026-05-07 05:37:21', '2026-05-07 05:37:21'),
(25, 2, 3, '2026-05-07 05:37:22', '2026-05-07 05:37:22'),
(26, 2, 4, '2026-05-07 05:37:24', '2026-05-07 05:37:24'),
(27, 3, 9, '2026-05-07 05:40:23', '2026-05-07 05:40:23'),
(28, 3, 10, '2026-05-07 05:40:24', '2026-05-07 05:40:24'),
(29, 3, 11, '2026-05-07 05:40:26', '2026-05-07 05:40:26'),
(30, 3, 12, '2026-05-07 05:40:27', '2026-05-07 05:40:27'),
(31, 3, 5, '2026-05-07 05:40:28', '2026-05-07 05:40:28'),
(32, 3, 6, '2026-05-07 05:40:29', '2026-05-07 05:40:29'),
(33, 3, 7, '2026-05-07 05:40:31', '2026-05-07 05:40:31'),
(34, 3, 8, '2026-05-07 05:40:32', '2026-05-07 05:40:32'),
(35, 3, 1, '2026-05-07 05:40:33', '2026-05-07 05:40:33'),
(36, 3, 2, '2026-05-07 05:40:34', '2026-05-07 05:40:34'),
(37, 3, 3, '2026-05-07 05:40:35', '2026-05-07 05:40:35'),
(38, 3, 4, '2026-05-07 05:40:36', '2026-05-07 05:40:36');

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
  `diet_description` text DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  `autoimmune_type` varchar(255) DEFAULT NULL,
  `morning_stiffness` varchar(255) DEFAULT NULL,
  `skin_symptoms` longtext DEFAULT NULL,
  `eye_symptoms` longtext DEFAULT NULL,
  `triggers` longtext DEFAULT NULL,
  `digestive_pattern` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_surveys`
--

INSERT INTO `medical_surveys` (`id`, `patient_name`, `age`, `gender`, `height_cm`, `weight_kg`, `bmi`, `main_symptoms`, `symptom_duration`, `pain_level`, `fatigue_level`, `impact_on_daily_life`, `diet_description`, `sleep_quality`, `sleep_duration`, `stress_level`, `water_consumption`, `smoking_status`, `alcohol_consumption`, `physical_activity_level`, `existing_diagnosis`, `medications`, `family_history`, `diagnosis_details`, `created_at`, `updated_at`, `autoimmune_type`, `morning_stiffness`, `skin_symptoms`, `eye_symptoms`, `triggers`, `digestive_pattern`, `user_id`) VALUES
(1, 'John Cena', 23, 'Male', 168, 78.00, 27.64, '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\",\\\"Hair Loss\\\"]\"', '1-4 weeks', 10, 10, 10, 'sadawdad', 10, 'Less than 5', 10, 1, 'Regular', 'Moderately', 'Athlete', 'no', 'no', 'no', 'no', '2026-04-27 01:57:40', '2026-04-27 01:57:40', 'Lupus', 'more_2h', '\"[\\\"butterfly_rash\\\",\\\"mouth_ulcers\\\"]\"', 'none', '\"[\\\"stress\\\",\\\"hormonal\\\"]\"', 'none', NULL),
(2, 'BtuBrader', 23, 'Male', 176, 79.00, 25.50, '\"[\\\"Fatigue\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', 'Less than 1 week', 10, 10, 10, 'asdawdasdad', 9, 'Less than 5', 10, 12, 'Occasional', 'Occasionally', 'Moderate', 'asdasd', 'asdasdas', 'dasdasda', 'sdasdasd', '2026-04-27 02:15:47', '2026-04-27 02:15:47', 'Lupus', 'less_30min', '\"[\\\"butterfly_rash\\\",\\\"none\\\"]\"', 'red_painful', '\"[\\\"food\\\",\\\"hormonal\\\"]\"', 'pain_relief', NULL),
(3, 'BtuBrader', 23, 'Male', 176, 79.00, 25.50, '\"[\\\"Fatigue\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', 'Less than 1 week', 10, 10, 10, 'asdawdasdad', 9, 'Less than 5', 10, 12, 'Occasional', 'Occasionally', 'Moderate', 'asdasd', 'asdasdas', 'dasdasda', 'sdasdasd', '2026-04-27 02:51:52', '2026-04-27 02:51:52', 'Lupus', 'less_30min', '\"[\\\"butterfly_rash\\\",\\\"none\\\"]\"', 'red_painful', '\"[\\\"food\\\",\\\"hormonal\\\"]\"', 'pain_relief', NULL),
(4, 'testing', 23, 'Male', 167, 78.00, 27.97, '\"[\\\"Joint Pain\\\",\\\"Muscle Pain\\\"]\"', 'Less than 1 week', 10, 10, 10, 'dasdawdasdasd', 10, 'Less than 5', 10, 3, 'Former smoker', 'Heavily', 'Active', 'no', 'wdad', 'adwdawd', 'adawdawd', '2026-04-27 04:46:55', '2026-04-27 04:46:55', 'Rheumatoid Arthritis', 'more_2h', '\"[\\\"butterfly_rash\\\",\\\"mouth_ulcers\\\"]\"', 'dry_eyes', '\"[\\\"stress\\\",\\\"food\\\"]\"', 'worse_food', NULL),
(5, 'a', 22, 'Male', 176, 78.00, 25.18, '\"[\\\"Joint Pain\\\",\\\"Muscle Pain\\\"]\"', 'More than 1 year', 10, 10, 10, 'kjhgashj', 1, 'Less than 5', 9, 1, 'Occasional', 'Non-drinker', 'Sedentary', 'lkuygtf', 'iuytrd', 'knjhbvg', 'mkjhgfcx', '2026-04-27 23:17:28', '2026-04-27 23:17:28', 'Psoriasis', 'less_30min', '\"[\\\"butterfly_rash\\\",\\\"mouth_ulcers\\\"]\"', 'dry_eyes', '\"[\\\"stress\\\",\\\"food\\\"]\"', 'pain_relief', NULL),
(6, 'BtuBrader', 37, 'Male', 170, 77.70, 26.89, '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\"]\"', 'Less than 1 week', 8, 8, 8, 'milk, sdfghjkl;;lkjhgfdsasdfghjklkjhgfdsasdfg', 2, 'Less than 5', 9, 3, 'Non-smoker', 'Non-drinker', 'Sedentary', 'diabetes', 'diabete medication', 'no', 'no', '2026-04-29 22:08:50', '2026-04-29 22:08:50', 'Lupus', 'none', '\"[\\\"none\\\"]\"', 'none', '\"[\\\"stress\\\"]\"', 'none', NULL),
(7, 'John Cena', 22, 'Male', 176, 78.00, 25.18, '\"[\\\"Fever\\\",\\\"Skin Rash\\\",\\\"Eye Issues\\\"]\"', 'Less than 1 week', 9, 8, 10, NULL, 2, 'Less than 5', 10, 4, 'Regular', 'Moderately', 'Light', 'no', 'no', 'no', 'no', '2026-05-05 21:34:48', '2026-05-05 21:34:48', 'Lupus', NULL, '\"[\\\"butterfly_rash\\\"]\"', 'dry_eyes', '\"[\\\"stress\\\",\\\"food\\\"]\"', NULL, NULL),
(8, 'John Cena', 23, 'Male', 178, 78.20, 24.68, '\"[\\\"Fever\\\",\\\"Skin Rash\\\",\\\"Eye Issues\\\"]\"', 'Less than 1 week', 5, 5, 5, 'milk', 5, 'Less than 5', 5, 4, 'Regular', 'Moderately', 'Light', NULL, NULL, NULL, NULL, '2026-05-05 23:17:57', '2026-05-05 23:17:57', 'Lupus', NULL, '\"[\\\"butterfly_rash\\\"]\"', 'dry_eyes', '\"[\\\"stress\\\",\\\"food\\\"]\"', NULL, NULL),
(9, 'John Cena', 23, 'Male', 174, 78.00, 25.76, '\"[\\\"Fatigue\\\",\\\"Fever\\\",\\\"Joint Pain\\\",\\\"Eye Issues\\\"]\"', '1-4 weeks', 9, 8, 10, 'milk', 2, 'Less than 5', 9, 5, 'Regular', 'Moderately', 'Light', NULL, NULL, NULL, NULL, '2026-05-05 23:31:05', '2026-05-05 23:31:05', 'Rheumatoid Arthritis', 'none', '\"[]\"', 'dry_eyes', '\"[\\\"stress\\\",\\\"food\\\",\\\"weather\\\",\\\"hormonal\\\"]\"', NULL, NULL),
(10, 'John Cena', 21, 'Male', 171, 78.80, 26.95, '\"[\\\"Fatigue\\\",\\\"Skin Rash\\\",\\\"Eye Issues\\\"]\"', 'Less than 1 week', 10, 10, 10, NULL, 1, 'Less than 5', 10, 12, 'Former smoker', 'Heavily', 'Light', 'no', 'wq', 'qw', 'qw', '2026-06-02 06:23:35', '2026-06-02 06:23:35', 'Lupus', NULL, '\"[\\\"butterfly_rash\\\"]\"', 'dry_eyes', '\"[\\\"stress\\\"]\"', NULL, NULL);

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
(8, '2026_01_04_140149_create_food_submissions_table', 1),
(9, '2026_04_16_155747_create_treatments_table', 1),
(10, '2026_04_17_061007_create_likes_table', 1),
(11, '2026_04_17_062837_create_posts_table', 2),
(12, '2026_04_17_063640_create_comments_table', 3),
(13, '2026_04_17_065135_create_saves_table', 4),
(14, '2026_04_27_084922_add_autoimmune_type_to_users_table', 5),
(15, '2026_04_27_092325_add_autoimmune_type_to_medical_surveys_table', 6),
(16, '2026_04_27_094617_add_morning_stiffness_to_medical_surveys_table', 7),
(17, '2026_04_27_095224_add_missing_fields_to_medical_surveys_table', 8),
(18, '2026_04_27_132331_add_filters_to_foods_table', 9),
(19, '2026_04_28_153435_create_daily_logs_table', 10),
(20, '2026_04_28_182910_create_progresses_table', 11),
(21, '2026_04_28_183018_create_progresses_table', 12),
(22, '2026_04_28_185711_create_progresses_table', 13),
(23, '2026_04_29_110630_add_disease_name_to_treatments_table', 14),
(24, '2026_04_29_114344_create_user_food_interactions_table', 14),
(25, '2026_05_06_053347_make_diet_description_nullable_in_medical_surveys_table', 15);

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'I was diagnosed with lupus 3 years ago and at first I felt completely lost. The fatigue was difficult to explain to people around me because physically I looked fine. Over time I learned that pacing myself and resting properly really mattered. #lupus #fatigue #selfcare', '2026-05-07 13:28:14', '2026-05-07 13:28:14'),
(2, 2, 'One thing that helped me during flare periods was tracking my stress and sleep patterns. I noticed my symptoms became worse whenever I pushed myself too hard without proper rest. #lupus #flareups #wellness', '2026-05-07 13:28:14', '2026-05-07 13:28:14'),
(3, 3, 'Today felt like a small victory because I finally managed to complete my evening walk again after weeks of low energy. Recovery is slow sometimes, but small progress still matters. #lupus #motivation #healingjourney', '2026-05-07 13:28:14', '2026-05-07 13:28:14'),
(4, 1, 'My advice for anyone struggling with autoimmune symptoms is to stop comparing your energy levels with other people. Rest is important and listening to your body is not weakness. #lupus #mentalhealth #support', '2026-05-07 13:28:14', '2026-05-07 13:28:14'),
(5, 1, 'I used to feel uncomfortable going outside during bad skin flare periods because I was worried people would stare at me. Over time I learned to focus more on healing mentally and physically at my own pace. #psoriasis #confidence #mentalwellbeing', '2026-05-07 13:28:51', '2026-05-07 13:28:51'),
(6, 2, 'Keeping my skin moisturized consistently became one of the most helpful habits in my routine. It did not change overnight, but small daily care made a noticeable difference for me. #psoriasis #skincare #selfcare', '2026-05-07 13:28:51', '2026-05-07 13:28:51'),
(7, 3, 'Stress was one of my biggest triggers during difficult periods. Taking breaks, improving my sleep schedule, and avoiding burnout helped me manage my flare-ups better. #psoriasis #stressmanagement #wellness', '2026-05-07 13:28:51', '2026-05-07 13:28:51'),
(8, 1, 'Small reminder for anyone dealing with autoimmune struggles: healing is not always fast or perfect. Celebrate small improvements and be patient with yourself during difficult days. #psoriasis #motivation #healingjourney', '2026-05-07 13:28:51', '2026-05-07 13:28:51'),
(9, 1, 'Morning stiffness used to make simple tasks feel exhausting for me. I started doing gentle stretching every morning and it slowly helped me feel more comfortable moving around. #rheumatoidarthritis #jointpain #mobility', '2026-05-07 13:29:13', '2026-05-07 13:29:13'),
(10, 2, 'I learned that balancing activity and rest was really important during my autoimmune journey. Overworking myself usually caused worse discomfort the next day. #rheumatoidarthritis #selfcare #flaremanagement', '2026-05-07 13:29:13', '2026-05-07 13:29:13'),
(11, 3, 'Sometimes autoimmune fatigue feels invisible because people cannot physically see what your body is going through. Supportive friends and online communities helped me feel less alone. #rheumatoidarthritis #fatigue #communitysupport', '2026-05-07 13:29:13', '2026-05-07 13:29:13'),
(12, 1, 'One helpful habit I developed was planning my daily tasks more slowly instead of rushing everything at once. Conserving energy became part of protecting my joints and wellbeing. #rheumatoidarthritis #wellness #dailyroutine', '2026-05-07 13:29:13', '2026-05-07 13:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `progresses`
--

CREATE TABLE `progresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progresses`
--

INSERT INTO `progresses` (`id`, `user_id`, `title`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'helloo', 0, '2026-04-28 11:13:39', '2026-04-28 13:01:20'),
(2, 2, 'baru', 0, '2026-04-28 11:47:46', '2026-04-28 13:01:20'),
(3, 2, 'lagibaru', 0, '2026-04-28 12:16:13', '2026-04-28 13:01:20'),
(4, 2, 'paling baru', 0, '2026-04-28 12:27:28', '2026-04-28 13:01:20'),
(5, 2, 'dawdawd', 0, '2026-04-28 12:30:00', '2026-04-28 13:01:20'),
(6, 2, 'baru fix', 0, '2026-04-28 12:36:29', '2026-04-28 13:01:20'),
(7, 2, 'hello', 1, '2026-04-28 13:01:20', '2026-04-28 13:01:20'),
(20, 1, 'MayTest', 0, '2026-04-29 03:11:09', '2026-05-06 19:36:38'),
(21, 1, 'Assalaumualaikum', 0, '2026-04-29 05:31:52', '2026-05-06 19:36:38'),
(22, 1, 'Waalaikumusalam', 0, '2026-04-29 06:33:45', '2026-05-06 19:36:38'),
(23, 1, 'l;etsgooo', 0, '2026-04-29 06:34:21', '2026-05-06 19:36:38'),
(24, 1, 'ghghg', 0, '2026-04-29 22:19:31', '2026-05-06 19:36:38'),
(25, 1, 'Ami', 1, '2026-05-06 19:36:38', '2026-05-06 19:36:38'),
(26, 3, 'hello', 1, '2026-05-07 05:56:47', '2026-05-07 05:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `saves`
--

CREATE TABLE `saves` (
  `save_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saves`
--

INSERT INTO `saves` (`save_id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2026-05-07 05:34:27', '2026-05-07 05:34:27'),
(2, 1, 7, '2026-05-07 05:34:40', '2026-05-07 05:34:40'),
(3, 1, 6, '2026-05-07 05:35:36', '2026-05-07 05:35:36'),
(4, 1, 11, '2026-05-07 05:35:55', '2026-05-07 05:35:55'),
(5, 1, 10, '2026-05-07 05:36:39', '2026-05-07 05:36:39'),
(6, 2, 9, '2026-05-07 05:37:52', '2026-05-07 05:37:52'),
(7, 2, 12, '2026-05-07 05:37:54', '2026-05-07 05:37:54'),
(8, 2, 7, '2026-05-07 05:37:58', '2026-05-07 05:37:58'),
(9, 2, 3, '2026-05-07 05:38:01', '2026-05-07 05:38:01'),
(10, 3, 4, '2026-05-07 05:40:38', '2026-05-07 05:40:38'),
(11, 3, 1, '2026-05-07 05:40:40', '2026-05-07 05:40:40'),
(12, 3, 8, '2026-05-07 05:40:42', '2026-05-07 05:40:42'),
(13, 3, 6, '2026-05-07 05:40:45', '2026-05-07 05:40:45'),
(14, 3, 12, '2026-05-07 05:40:48', '2026-05-07 05:40:48'),
(15, 3, 10, '2026-05-07 05:40:51', '2026-05-07 05:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `disease_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `level` varchar(255) NOT NULL,
  `research` text DEFAULT NULL,
  `steps` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `treatments`
--

INSERT INTO `treatments` (`id`, `title`, `disease_name`, `type`, `description`, `level`, `research`, `steps`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Fatigue Tracking Support', 'lupus', 'Monitoring', 'Helps users monitor daily energy levels and recognize possible fatigue patterns.', 'Easy', 'https://www.lupus.org/resources', '1. Record energy levels daily\r\n2. Track sleep quality\r\n3. Avoid excessive physical strain\r\n4. Seek professional advice if fatigue worsens', 'recommended', '2026-05-07 13:07:33', '2026-05-07 13:07:33'),
(2, 'Flare Awareness Monitoring', 'lupus', 'Monitoring', 'Supports awareness of possible symptom flare patterns for better self-management.', 'Moderate', 'https://www.niams.nih.gov/health-topics/lupus', '1. Track symptoms consistently\r\n2. Monitor environmental triggers\r\n3. Record stress levels\r\n4. Contact healthcare providers if symptoms intensify', 'emergency', '2026-05-07 13:07:33', '2026-05-07 13:07:33'),
(3, 'Hydration Support Routine', 'lupus', 'Lifestyle', 'Encourages healthy hydration habits to support general wellbeing.', 'Easy', 'https://medlineplus.gov/lupus.html', '1. Drink water regularly\r\n2. Reduce sugary beverages\r\n3. Monitor hydration levels\r\n4. Maintain balanced nutrition', 'recommended', '2026-05-07 13:07:33', '2026-05-07 13:07:33'),
(4, 'Stress Management Activities', 'lupus', 'Wellness', 'Encourages calming activities that may support emotional wellbeing.', 'Easy', 'https://www.nhs.uk/conditions/lupus', '1. Practice breathing exercises\r\n2. Maintain regular sleep habits\r\n3. Reduce unnecessary stress\r\n4. Engage in relaxing activities', 'recommended', '2026-05-07 13:07:33', '2026-05-07 13:07:33'),
(5, 'Medication Schedule Reminder', 'lupus', 'Support', 'Helps users organize prescribed medication schedules responsibly.', 'Moderate', 'https://www.mayoclinic.org/diseases-conditions/lupus', '1. Follow healthcare provider instructions\r\n2. Use reminder schedules\r\n3. Avoid missing doses\r\n4. Monitor possible side effects', 'recommended', '2026-05-07 13:07:33', '2026-05-07 13:07:33'),
(6, 'Joint Comfort Monitoring', 'lupus', 'Monitoring', 'Tracks joint discomfort and movement changes over time.', 'Moderate', 'https://www.arthritis.org/diseases/lupus', '1. Record pain intensity\r\n2. Observe movement limitations\r\n3. Avoid overexertion\r\n4. Rest when discomfort increases', 'emergency', '2026-05-07 13:07:33', '2026-05-07 13:07:33'),
(7, 'Sleep Quality Support', 'lupus', 'Lifestyle', 'Encourages healthy sleep routines that support overall recovery and wellbeing.', 'Easy', 'https://www.sleepfoundation.org', '1. Maintain consistent sleep times\r\n2. Reduce screen exposure before bed\r\n3. Create a calm sleep environment\r\n4. Avoid excessive caffeine intake', 'recommended', '2026-05-07 13:07:33', '2026-05-07 13:07:33'),
(8, 'Balanced Activity Planning', 'lupus', 'Support', 'Supports balanced daily routines to reduce excessive physical exhaustion.', 'Easy', 'https://www.cdc.gov/lupus', '1. Plan manageable activities\r\n2. Include regular rest periods\r\n3. Avoid overworking the body\r\n4. Maintain gradual movement routines', 'recommended', '2026-05-07 13:07:33', '2026-05-07 13:07:33'),
(9, 'Skin Sensitivity Awareness', 'lupus', 'Monitoring', 'Encourages users to monitor skin sensitivity and environmental exposure.', 'Moderate', 'https://www.aad.org/public/diseases/a-z/lupus-overview', '1. Monitor skin condition changes\r\n2. Limit excessive sun exposure\r\n3. Use protective clothing if necessary\r\n4. Seek medical advice for severe irritation', 'emergency', '2026-05-07 13:07:33', '2026-05-07 13:07:33'),
(10, 'General Wellness Guidance', 'lupus', 'Wellness', 'Provides general wellness reminders that support healthier daily habits.', 'Easy', 'https://www.who.int', '1. Maintain balanced nutrition\r\n2. Stay physically active within comfort limits\r\n3. Practice healthy routines\r\n4. Attend regular healthcare checkups', 'recommended', '2026-05-07 13:07:33', '2026-05-07 13:07:33'),
(11, 'Joint Mobility Monitoring', 'rheumatoid arthritis', 'Monitoring', 'Helps users monitor joint stiffness and mobility changes over time.', 'Moderate', 'https://www.arthritis.org', '1. Track stiffness duration\r\n2. Observe movement limitations\r\n3. Record daily discomfort levels\r\n4. Seek professional advice if symptoms worsen', 'emergency', '2026-05-07 13:08:09', '2026-05-07 13:08:09'),
(12, 'Low-Impact Exercise Support', 'rheumatoid arthritis', 'Lifestyle', 'Encourages gentle physical activities that support flexibility and movement.', 'Easy', 'https://www.cdc.gov/arthritis', '1. Perform light stretching\r\n2. Engage in low-impact exercises\r\n3. Avoid excessive strain\r\n4. Rest when discomfort increases', 'recommended', '2026-05-07 13:08:09', '2026-05-07 13:08:09'),
(13, 'Daily Activity Balance', 'rheumatoid arthritis', 'Support', 'Supports balanced daily routines to reduce unnecessary joint stress.', 'Easy', 'https://www.nhs.uk/conditions/rheumatoid-arthritis', '1. Schedule rest breaks\r\n2. Avoid repetitive strain\r\n3. Organize manageable tasks\r\n4. Maintain healthy movement habits', 'recommended', '2026-05-07 13:08:09', '2026-05-07 13:08:09'),
(14, 'Fatigue Awareness Tracking', 'rheumatoid arthritis', 'Monitoring', 'Helps users recognize fatigue patterns that may affect daily activities.', 'Moderate', 'https://medlineplus.gov/rheumatoidarthritis.html', '1. Monitor daily energy levels\r\n2. Track sleep quality\r\n3. Avoid overexertion\r\n4. Practice balanced rest routines', 'recommended', '2026-05-07 13:08:09', '2026-05-07 13:08:09'),
(15, 'Comfort Movement Guidance', 'rheumatoid arthritis', 'Wellness', 'Encourages gentle movement habits that support overall comfort and flexibility.', 'Easy', 'https://www.versusarthritis.org', '1. Perform gentle mobility exercises\r\n2. Avoid prolonged inactivity\r\n3. Stretch carefully\r\n4. Stop activities if discomfort increases', 'recommended', '2026-05-07 13:08:09', '2026-05-07 13:08:09'),
(16, 'Medication Routine Reminder', 'rheumatoid arthritis', 'Support', 'Helps users organize prescribed medication schedules responsibly.', 'Moderate', 'https://www.mayoclinic.org/diseases-conditions/rheumatoid-arthritis', '1. Follow healthcare provider instructions\r\n2. Use medication reminders\r\n3. Avoid skipping doses\r\n4. Monitor possible side effects', 'recommended', '2026-05-07 13:08:09', '2026-05-07 13:08:09'),
(17, 'Morning Stiffness Monitoring', 'rheumatoid arthritis', 'Monitoring', 'Tracks morning stiffness duration and possible symptom patterns.', 'Moderate', 'https://www.healthline.com/health/rheumatoid-arthritis', '1. Record stiffness duration\r\n2. Observe affected joints\r\n3. Monitor mobility improvements\r\n4. Discuss persistent symptoms with healthcare professionals', 'emergency', '2026-05-07 13:08:09', '2026-05-07 13:08:09'),
(18, 'Healthy Rest Planning', 'rheumatoid arthritis', 'Lifestyle', 'Encourages balanced rest routines that support recovery and wellbeing.', 'Easy', 'https://www.sleepfoundation.org', '1. Maintain consistent sleep schedules\r\n2. Reduce late-night screen exposure\r\n3. Create a calm rest environment\r\n4. Avoid excessive physical exhaustion', 'recommended', '2026-05-07 13:08:09', '2026-05-07 13:08:09'),
(19, 'Joint Protection Awareness', 'rheumatoid arthritis', 'Wellness', 'Promotes awareness of habits that may reduce unnecessary joint strain.', 'Easy', 'https://www.arthritis-health.com', '1. Use supportive posture\r\n2. Avoid carrying excessive weight\r\n3. Practice careful movement\r\n4. Balance activity with rest', 'recommended', '2026-05-07 13:08:09', '2026-05-07 13:08:09'),
(20, 'Inflammation Symptom Tracking', 'rheumatoid arthritis', 'Monitoring', 'Supports awareness of possible inflammation-related symptom changes.', 'High', 'https://www.webmd.com/rheumatoid-arthritis', '1. Monitor swelling changes\r\n2. Track discomfort severity\r\n3. Record physical limitations\r\n4. Seek professional support if symptoms rapidly worsen', 'emergency', '2026-05-07 13:08:09', '2026-05-07 13:08:09'),
(21, 'Skin Condition Monitoring', 'psoriasis', 'Monitoring', 'Helps users monitor skin condition changes and possible irritation patterns.', 'Moderate', 'https://www.psoriasis.org', '1. Observe skin condition daily\r\n2. Record irritation patterns\r\n3. Track possible triggers\r\n4. Seek professional advice if symptoms worsen', 'emergency', '2026-05-07 13:08:38', '2026-05-07 13:08:38'),
(22, 'Moisturizing Routine Support', 'psoriasis', 'Lifestyle', 'Encourages consistent skin hydration habits for general skin comfort.', 'Easy', 'https://www.aad.org/public/diseases/psoriasis', '1. Apply moisturizer regularly\r\n2. Avoid excessive dryness\r\n3. Use gentle skincare products\r\n4. Maintain hydration habits', 'recommended', '2026-05-07 13:08:38', '2026-05-07 13:08:38'),
(23, 'Stress Awareness Activities', 'psoriasis', 'Wellness', 'Encourages stress management practices that may support overall wellbeing.', 'Easy', 'https://www.nhs.uk/conditions/psoriasis', '1. Practice calming activities\r\n2. Maintain regular sleep habits\r\n3. Reduce unnecessary stress exposure\r\n4. Engage in relaxing routines', 'recommended', '2026-05-07 13:08:38', '2026-05-07 13:08:38'),
(24, 'Skin Trigger Tracking', 'psoriasis', 'Monitoring', 'Supports awareness of possible environmental or lifestyle-related skin triggers.', 'Moderate', 'https://www.mayoclinic.org/diseases-conditions/psoriasis', '1. Monitor food and environment changes\r\n2. Track skin reactions\r\n3. Record possible irritation triggers\r\n4. Avoid known skin irritants when possible', 'emergency', '2026-05-07 13:08:38', '2026-05-07 13:08:38'),
(25, 'Comfortable Clothing Guidance', 'psoriasis', 'Lifestyle', 'Encourages clothing choices that may reduce unnecessary skin irritation.', 'Easy', 'https://www.healthline.com/health/psoriasis', '1. Wear soft breathable fabrics\r\n2. Avoid rough materials\r\n3. Maintain clean clothing habits\r\n4. Reduce excessive skin friction', 'recommended', '2026-05-07 13:08:38', '2026-05-07 13:08:38'),
(26, 'Sleep Quality Support', 'psoriasis', 'Wellness', 'Encourages healthy sleep habits that support overall wellbeing and recovery.', 'Easy', 'https://www.sleepfoundation.org', '1. Maintain regular sleep schedules\r\n2. Reduce late-night screen exposure\r\n3. Create a calm sleep environment\r\n4. Avoid excessive caffeine intake', 'recommended', '2026-05-07 13:08:38', '2026-05-07 13:08:38'),
(27, 'Medication Reminder Support', 'psoriasis', 'Support', 'Helps users organize prescribed medication schedules responsibly.', 'Moderate', 'https://medlineplus.gov/psoriasis.html', '1. Follow healthcare provider instructions\r\n2. Use reminder schedules\r\n3. Avoid missing prescribed doses\r\n4. Monitor possible side effects', 'recommended', '2026-05-07 13:08:38', '2026-05-07 13:08:38'),
(28, 'Skin Comfort Observation', 'psoriasis', 'Monitoring', 'Tracks skin discomfort levels and possible sensitivity changes.', 'Moderate', 'https://www.webmd.com/skin-problems-and-treatments/psoriasis', '1. Observe affected skin areas\r\n2. Record discomfort intensity\r\n3. Avoid excessive scratching\r\n4. Seek professional support if severe irritation occurs', 'emergency', '2026-05-07 13:08:38', '2026-05-07 13:08:38'),
(29, 'Balanced Wellness Routine', 'psoriasis', 'Wellness', 'Supports healthy daily habits that contribute to overall wellbeing.', 'Easy', 'https://www.who.int', '1. Maintain balanced nutrition\r\n2. Stay physically active within comfort levels\r\n3. Practice stress reduction\r\n4. Attend regular healthcare checkups', 'recommended', '2026-05-07 13:08:38', '2026-05-07 13:08:38'),
(30, 'Hydration Awareness Support', 'psoriasis', 'Lifestyle', 'Encourages healthy hydration habits that support general skin wellbeing.', 'Easy', 'https://www.cdc.gov', '1. Drink water consistently\r\n2. Reduce sugary beverages\r\n3. Monitor hydration levels\r\n4. Maintain balanced daily routines', 'recommended', '2026-05-07 13:08:38', '2026-05-07 13:08:38');

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
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `autoimmune_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `autoimmune_type`) VALUES
(1, 'user1', 'user1@gmail.com', NULL, '$2y$12$6uhQ4a5Z8dPs.QQutRGrlO9fR8AL4ZHMlOy6sO7AslS08LZSQZPbe', NULL, '2026-04-16 22:24:05', '2026-04-16 22:24:05', 'user', NULL),
(2, 'user2', 'user2@gmail.com', NULL, '$2y$12$TZi3AaSo/AHjtwlCthJ2OeOUpq1zE1Ue5g2vhCgy6gABgoef8XXum', NULL, '2026-04-17 01:06:24', '2026-04-17 01:06:24', 'user', NULL),
(3, 'user3', 'user3@gmail.com', NULL, '$2y$12$uN0JITfUEZdYFC1gFR0bdeWKLGkfBnyk65EUKKidM3UnoUNDaGR1K', NULL, '2026-04-17 01:24:23', '2026-04-17 01:24:23', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_food_interactions`
--

CREATE TABLE `user_food_interactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `is_liked` tinyint(1) NOT NULL DEFAULT 0,
  `is_saved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_food_interactions`
--

INSERT INTO `user_food_interactions` (`id`, `user_id`, `food_id`, `is_liked`, `is_saved`, `created_at`, `updated_at`) VALUES
(1, 2, 14, 1, 1, '2026-04-29 18:33:32', '2026-04-29 18:34:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `progresses`
--
ALTER TABLE `progresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saves`
--
ALTER TABLE `saves`
  ADD PRIMARY KEY (`save_id`),
  ADD UNIQUE KEY `saves_user_id_post_id_unique` (`user_id`,`post_id`),
  ADD KEY `saves_post_id_foreign` (`post_id`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_food_interactions`
--
ALTER TABLE `user_food_interactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_food_interactions_user_id_food_id_unique` (`user_id`,`food_id`),
  ADD KEY `user_food_interactions_food_id_foreign` (`food_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `daily_logs`
--
ALTER TABLE `daily_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `food_submissions`
--
ALTER TABLE `food_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `medical_surveys`
--
ALTER TABLE `medical_surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `progresses`
--
ALTER TABLE `progresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `saves`
--
ALTER TABLE `saves`
  MODIFY `save_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_food_interactions`
--
ALTER TABLE `user_food_interactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `food_submissions`
--
ALTER TABLE `food_submissions`
  ADD CONSTRAINT `food_submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `saves`
--
ALTER TABLE `saves`
  ADD CONSTRAINT `saves_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_food_interactions`
--
ALTER TABLE `user_food_interactions`
  ADD CONSTRAINT `user_food_interactions_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_food_interactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
