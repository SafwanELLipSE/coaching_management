-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2021 at 07:45 AM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coaching_management_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_students`
--

CREATE TABLE `attendance_students` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `date` date NOT NULL,
  `status` enum('P','L','A') NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance_students`
--

INSERT INTO `attendance_students` (`id`, `student_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, '2021-09-21', 'P', '2021-09-21 06:55:10', '2021-09-21 06:55:10'),
(2, 10, '2021-09-21', 'L', '2021-09-21 06:55:10', '2021-09-21 06:55:10'),
(3, 1, '2021-09-21', 'P', '2021-09-21 07:18:10', '2021-09-21 07:18:10'),
(4, 8, '2021-09-21', 'L', '2021-09-21 07:18:22', '2021-09-21 07:18:22'),
(5, 6, '2021-09-22', 'L', '2021-09-22 04:44:01', '2021-09-22 04:44:01'),
(6, 10, '2021-09-22', 'A', '2021-09-22 04:44:02', '2021-09-22 04:44:02'),
(7, 6, '2021-09-28', 'P', '2021-09-28 04:29:02', '2021-09-28 04:29:02'),
(8, 10, '2021-09-28', 'P', '2021-09-28 04:29:03', '2021-09-28 04:29:03'),
(9, 7, '2021-09-28', 'P', '2021-09-28 04:29:16', '2021-09-28 04:29:16'),
(10, 10, '2021-09-25', 'L', '2021-09-29 09:05:29', '2021-09-29 09:06:20'),
(11, 10, '2021-09-27', 'A', '2021-09-29 09:05:29', '2021-09-29 09:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_teachers`
--

CREATE TABLE `attendance_teachers` (
  `id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `date` date NOT NULL,
  `status` enum('P','L','A') NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance_teachers`
--

INSERT INTO `attendance_teachers` (`id`, `teacher_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '2021-09-22', 'P', '2021-09-20 07:13:27', '2021-09-20 07:13:27'),
(2, 2, '2021-09-20', 'L', '2021-09-20 07:13:27', '2021-09-20 07:13:27'),
(3, 2, '2021-09-21', 'A', '2021-09-20 07:13:27', '2021-09-20 07:13:27'),
(4, 4, '2021-09-20', 'L', '2021-09-20 07:13:32', '2021-09-20 07:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int NOT NULL,
  `name` varchar(180) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `updated_at`) VALUES
(1, 'Class 1', '2021-08-30 06:37:09'),
(2, 'Class 2', '2021-08-30 06:37:19'),
(3, 'Class 3', '2021-08-30 06:37:26'),
(4, 'Class 4', '2021-08-30 06:37:32'),
(5, 'Class 5', '2021-08-30 06:37:43'),
(6, 'Class 6', '2021-08-30 06:37:51'),
(7, 'Class 7', '2021-08-30 10:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int NOT NULL,
  `class_id` int NOT NULL,
  `course_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `capacity` int NOT NULL,
  `enrolled` int NOT NULL,
  `days` text NOT NULL,
  `end_time` time NOT NULL,
  `start_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `zoom_id` varchar(20) DEFAULT NULL,
  `zoom_password` varchar(14) DEFAULT NULL,
  `zoom_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `class_id`, `course_id`, `teacher_id`, `name`, `capacity`, `enrolled`, `days`, `end_time`, `start_time`, `start_date`, `end_date`, `zoom_id`, `zoom_password`, `zoom_link`, `is_active`, `updated_at`) VALUES
(4, 3, 3, 2, 'Classroom 1', 30, 2, 'Sunday,Wednesday,Thursday', '13:30:00', '00:00:00', '2021-09-01', '2021-11-30', NULL, NULL, '', 1, '2021-09-07 04:54:26'),
(5, 7, 1, 3, 'Classroom 2', 30, 1, 'Monday,Wednesday,Saturday', '13:30:00', '00:00:00', '2021-09-01', '2021-10-31', NULL, NULL, '', 1, '2021-09-12 22:48:49'),
(6, 3, 6, 4, 'Classroom 3', 20, 2, 'Sunday,Thursday,Saturday', '13:00:00', '11:00:00', '2021-07-01', '2021-10-31', NULL, NULL, '', 1, '2021-10-28 06:08:03'),
(7, 3, 10, 1, 'Classroom 4', 20, 1, 'Sunday,Monday,Thursday,Friday', '17:00:00', '15:30:00', '2021-09-01', '2021-11-01', NULL, NULL, NULL, 1, '2021-09-13 03:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `classroom_group_chats`
--

CREATE TABLE `classroom_group_chats` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `classroom_id` int NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classroom_group_chats`
--

INSERT INTO `classroom_group_chats` (`id`, `user_id`, `classroom_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 19, 7, 'hello everyone', '2021-09-12 02:29:08', '2021-09-12 02:29:08'),
(2, 4, 7, 'hello people😇😚', '2021-09-12 02:29:29', '2021-09-12 02:29:29'),
(3, 16, 7, 'no no', '2021-09-12 04:34:03', '2021-09-12 04:34:03'),
(4, 17, 7, 'ami pari na  kisu😅', '2021-09-12 04:38:54', '2021-09-12 04:38:54'),
(5, 4, 7, 'why is ur work so low boyy!!!!😍', '2021-09-12 04:39:19', '2021-09-12 04:39:19'),
(6, 16, 7, 'no one know hoe it works🍕', '2021-09-12 04:41:41', '2021-09-12 04:41:41'),
(7, 19, 7, '🐮 i m a pig', '2021-09-12 04:41:56', '2021-09-12 04:41:56'),
(8, 4, 7, '👴 dun say such works !!!', '2021-09-12 04:42:16', '2021-09-12 04:42:16'),
(9, 17, 7, '👩‍❤️‍💋‍👩 we are in relation ship', '2021-09-12 04:42:42', '2021-09-12 04:42:42'),
(10, 1, 6, 'hello', '2021-09-22 09:29:54', '2021-09-22 09:29:54'),
(11, 1, 6, 'wefefgrgrg', '2021-09-22 10:15:54', '2021-09-22 10:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `classroom_single_chats`
--

CREATE TABLE `classroom_single_chats` (
  `id` int NOT NULL,
  `classroom_id` int NOT NULL,
  `from_user` int NOT NULL,
  `to_user` int NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classroom_students`
--

CREATE TABLE `classroom_students` (
  `id` int NOT NULL,
  `classroom_id` int NOT NULL,
  `student_id` int NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classroom_students`
--

INSERT INTO `classroom_students` (`id`, `classroom_id`, `student_id`, `is_active`, `created_at`, `updated_at`) VALUES
(15, 7, 7, 1, '2021-09-06 04:09:59', '2021-09-06 04:09:59'),
(18, 6, 6, 1, '2021-09-07 04:49:12', '2021-10-28 06:08:03'),
(19, 6, 10, 1, '2021-09-07 04:49:12', '2021-09-07 04:49:12'),
(20, 4, 1, 1, '2021-09-07 04:54:25', '2021-09-07 04:54:25'),
(21, 4, 8, 1, '2021-09-07 04:54:26', '2021-09-07 04:54:26'),
(22, 5, 2, 1, '2021-09-12 22:48:49', '2021-09-12 22:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `code` varchar(150) NOT NULL,
  `marks` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `code`, `marks`, `updated_at`) VALUES
(1, 'Bangla First Paper', 'BAN101', 100, '2021-08-30 09:05:08'),
(2, 'Bangla Second Paper', 'BAN102', 100, '2021-08-29 10:34:20'),
(3, 'English First Paper', 'ENG101', 100, '2021-08-29 10:40:21'),
(4, 'English Second Paper', 'ENG102', 100, '2021-08-29 10:40:36'),
(6, 'Information and Communication Technology', 'ICT275', 100, '2021-09-16 04:25:15'),
(7, 'Islam & Moral Education', 'IME111', 100, '2021-09-05 23:13:44'),
(8, 'Agriculture Studies', 'AS134', 100, '2021-09-05 23:14:03'),
(9, 'Home Science', 'HS151', 100, '2021-09-05 23:14:43'),
(10, 'Math', 'MAT109', 100, '2021-09-05 23:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `id` int NOT NULL,
  `classroom_id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` tinyint NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration` int NOT NULL,
  `marks` int NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `examinations`
--

INSERT INTO `examinations` (`id`, `classroom_id`, `name`, `type`, `date`, `start_time`, `end_time`, `duration`, `marks`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 5, 'Examination 1', 1, '2021-09-18', '10:30:00', '12:00:00', 90, 30, 1, '2021-09-13 23:56:09', '2021-09-13 23:56:09'),
(2, 6, 'Examination 2', 2, '2021-09-21', '11:40:00', '12:00:00', 20, 40, 1, '2021-09-13 23:56:43', '2021-10-31 11:20:19'),
(3, 6, 'System Gate Questions', 1, '2021-10-08', '10:26:00', '14:30:00', 244, 30, 1, '2021-09-30 04:26:57', '2021-09-30 04:26:57'),
(4, 6, 'Introduction to computer studies', 1, '2021-11-09', '23:00:00', '13:00:00', 600, 30, 1, '2021-10-31 11:25:40', '2021-10-31 11:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `examination_solution_mcqs`
--

CREATE TABLE `examination_solution_mcqs` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `exam_id` int NOT NULL,
  `solution` text NOT NULL,
  `obtain_mark` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `examination_solution_mcqs`
--

INSERT INTO `examination_solution_mcqs` (`id`, `student_id`, `exam_id`, `solution`, `obtain_mark`, `created_at`, `updated_at`) VALUES
(1, 6, 2, '6360,irrational number,25.5,502,1,15,2400,156,1960s,Pneumatic rubber tire,Marie Curie,1874,Play-Doh,Amanda Jones,Sir Alexander Graham Bell,1739', 32, '2021-11-02 08:37:52', '2021-11-02 08:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `examination_solution_written`
--

CREATE TABLE `examination_solution_written` (
  `id` int NOT NULL,
  `exam_id` int NOT NULL,
  `question_id` int NOT NULL,
  `student_id` int NOT NULL,
  `obtain_mark` float NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `examination_solution_written`
--

INSERT INTO `examination_solution_written` (`id`, `exam_id`, `question_id`, `student_id`, `obtain_mark`, `created_at`, `updated_at`) VALUES
(8, 3, 14, 6, 1.5, '2021-11-01 06:38:02', '2021-11-01 06:38:02'),
(9, 3, 15, 6, 2.5, '2021-11-01 06:38:02', '2021-11-01 06:38:02'),
(10, 3, 16, 6, 2.5, '2021-11-01 06:38:03', '2021-11-01 06:38:03'),
(11, 3, 17, 6, 4, '2021-11-01 06:38:03', '2021-11-01 06:38:03'),
(12, 3, 18, 6, 3.5, '2021-11-01 06:38:03', '2021-11-01 06:38:03'),
(13, 3, 19, 6, 1.5, '2021-11-01 06:38:03', '2021-11-01 06:38:03'),
(14, 3, 20, 6, 8, '2021-11-01 06:38:03', '2021-11-01 06:38:03'),
(15, 4, 29, 6, 2.5, '2021-11-01 06:49:56', '2021-11-01 06:49:56'),
(16, 4, 30, 6, 4.5, '2021-11-01 06:49:56', '2021-11-01 06:49:56'),
(17, 4, 31, 6, 3.5, '2021-11-01 06:49:56', '2021-11-01 06:49:56'),
(18, 4, 32, 6, 3, '2021-11-01 06:49:57', '2021-11-01 06:49:57'),
(19, 4, 33, 6, 2, '2021-11-01 06:49:57', '2021-11-01 06:49:57'),
(20, 4, 34, 6, 1, '2021-11-01 06:49:57', '2021-11-01 06:49:57'),
(21, 4, 35, 6, 1.5, '2021-11-01 06:49:57', '2021-11-01 06:49:57'),
(22, 4, 36, 6, 2.5, '2021-11-01 06:49:57', '2021-11-01 06:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int NOT NULL,
  `from_range` int NOT NULL,
  `to_range` int NOT NULL,
  `grade` varchar(11) NOT NULL,
  `point` float(11,2) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `from_range`, `to_range`, `grade`, `point`, `created_at`, `updated_at`) VALUES
(1, 80, 100, 'A+', 5.00, '2021-09-16 04:55:19', '2021-09-16 05:10:05'),
(2, 70, 79, 'A', 4.00, '2021-09-16 04:55:38', '2021-09-16 04:55:38'),
(3, 60, 69, 'A-', 3.50, '2021-09-16 04:56:01', '2021-09-16 04:56:01'),
(4, 50, 59, 'B', 3.00, '2021-09-16 04:56:27', '2021-09-16 04:56:27'),
(5, 40, 49, 'C', 2.00, '2021-09-16 04:56:47', '2021-09-16 04:56:47'),
(6, 33, 39, 'D', 1.00, '2021-09-16 04:56:55', '2021-09-16 05:10:18'),
(7, 0, 32, 'F', 0.00, '2021-09-16 04:57:10', '2021-09-16 04:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_09_22_192348_create_messages_table', 2),
(5, '2019_10_16_211433_create_favorites_table', 2),
(6, '2019_10_18_223259_add_avatar_to_users', 2),
(7, '2019_10_20_211056_add_messenger_color_to_users', 2),
(8, '2019_10_22_000539_add_dark_mode_to_users', 2),
(9, '2019_10_25_214038_add_active_status_to_users', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `examination_id` int NOT NULL,
  `question` text NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `type` enum('radio','select','number','text') NOT NULL,
  `number_option` int NOT NULL,
  `option_list` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `mark` int NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `examination_id`, `question`, `answer`, `type`, `number_option`, `option_list`, `mark`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'The HCF and LCM of 6, 72 and 120 is:', '6360', 'radio', 4, '8360,6340,6360,None of these', 2, 1, '2021-09-14 03:56:25', '2021-09-14 03:56:25'),
(2, 2, 'The number √3 is a/an:', 'irrational number', 'radio', 4, 'integer,rational number,irrational number,None of these', 2, 1, '2021-09-14 03:58:13', '2021-11-02 08:35:05'),
(3, 1, 'What are some poetic devices used in \"On the Grasshopper and Cricket\" by John Keats?<br>', NULL, 'text', 0, NULL, 5, 1, '2021-09-14 04:01:28', '2021-10-28 05:48:23'),
(4, 2, 'The average of first 50 natural numbers is', '25.5', 'select', 4, '25.30,25.5,25.00,12.25', 3, 1, '2021-09-16 00:23:02', '2021-09-16 00:23:02'),
(5, 2, 'What is 1004 divided by 2', '502', 'number', 0, NULL, 2, 1, '2021-09-16 00:25:26', '2021-09-16 00:25:26'),
(6, 2, 'Evaluation of 8<sup>3</sup> × 8<sup>2</sup> × 8<sup>-5</sup> is ………….', '1', 'select', 4, '1,0,8,None of these', 3, 1, '2021-09-16 00:28:00', '2021-09-16 00:28:00'),
(7, 2, 'Which of the following numbers gives 240 when added to its own square', '15', 'radio', 4, '15,16,18,20', 3, 1, '2021-09-16 00:29:32', '2021-09-16 00:29:32'),
(8, 2, '106 × 106 – 94 × 94 = ?', '2400', 'select', 4, '2004,2400,1904,1906', 2, 1, '2021-09-16 00:30:52', '2021-09-16 00:30:52'),
(9, 2, 'A clock strikes once at 1 o’clock, twice at 2 o’clock, thrice at 3 o’clock and so on. How many times will it strike in 24 hours?', '156', 'radio', 4, '78,136,156,196', 3, 1, '2021-09-16 00:34:16', '2021-09-16 00:34:16'),
(10, 1, 'To ask the Chancellor of the Duchy of Lancaster and Minister for the Cabinet Office, what&nbsp; assessment the Government has made to the potential merits of including the Covid-19&nbsp; Bereaved Families for Justice group in the Commission on Covid Commemoration.', NULL, 'text', 0, NULL, 5, 1, '2021-09-16 03:13:08', '2021-09-16 03:13:08'),
(11, 1, 'To ask the Chancellor of the Duchy of Lancaster and Minister for the Cabinet Office, what&nbsp; the youth unemployment figures are for (a) Suffolk and (b) Central Suffolk and North Ipswich constituency for each year from 2009-10 to date.', NULL, 'text', 0, NULL, 5, 1, '2021-09-16 03:13:55', '2021-09-16 03:13:55'),
(12, 1, 'o ask the Chancellor of the Duchy of Lancaster and Minister for the Cabinet Office, what his planned timescale is for a review of the postal voting system to ensure that system is fully accessible for blind and partially sighted people.', NULL, 'text', 0, NULL, 10, 1, '2021-09-16 03:15:14', '2021-09-16 03:15:14'),
(13, 1, 'To that end, the Government has introduced a number of measures to support the&nbsp; accessibility of elections in the recently introduced Elections Bill, such as removing restrictions on who can act as a companion to support voters with disabilities and placing a broader requirement for Returning Officers to consider the needs of all disabled voters when providing equipment for polling stations.', NULL, 'text', 0, NULL, 5, 1, '2021-09-16 03:16:51', '2021-09-16 03:16:51'),
(14, 3, 'Who is the Chief justice of Bangladesh  at present?', NULL, 'text', 0, NULL, 2, 1, '2021-10-03 11:25:25', '2021-10-03 11:39:21'),
(15, 3, 'The branch of medical science which is concerned with the study of disease as it affects a community of people is called', NULL, 'text', 0, NULL, 3, 1, '2021-10-03 11:25:55', '2021-10-03 11:39:37'),
(16, 3, 'Water flows through a horizontal pipe at a constant volumetric rate. At a location where the cross sectional area decreases, the velocity of the fluid', NULL, 'text', 0, NULL, 3, 1, '2021-10-03 11:26:27', '2021-10-03 11:39:48'),
(17, 3, '5abc ×2ab<sup>3</sup>c<sup>3</sup>×3ac', NULL, 'text', 0, NULL, 6, 1, '2021-10-03 11:27:18', '2021-10-03 11:39:10'),
(18, 3, 'Tk 2400×  15%', NULL, 'text', 0, NULL, 4, 1, '2021-10-03 11:27:40', '2021-10-03 11:38:36'),
(19, 3, 'Sum of interior angles of any polygon is', NULL, 'text', 0, NULL, 2, 1, '2021-10-03 11:33:12', '2021-10-03 11:38:21'),
(20, 3, 'A&nbsp; common&nbsp; goal&nbsp; of&nbsp; the&nbsp; Salt&nbsp; March&nbsp; in&nbsp; India,&nbsp; the Boxer Rebellion in China, and the Zulu resistance in southern Africa was to', NULL, 'text', 0, NULL, 10, 1, '2021-10-03 11:36:37', '2021-10-03 11:38:09'),
(21, 2, 'In which decade was the first solid state integrated circuit demonstrated?', '1950s', 'radio', 4, '1950s,1960s,1970s,1980s', 2, 1, '2021-10-31 11:03:57', '2021-10-31 11:03:57'),
(22, 2, 'What J. B. Dunlop invented?', 'Pneumatic rubber tire', 'radio', 4, 'Model airplanes,Automobile wheel rim,Rubber boot,Pneumatic rubber tire', 2, 1, '2021-10-31 11:06:40', '2021-11-01 07:33:01'),
(23, 2, 'Which scientist discovered the radioactive element radium?', 'Marie Curie', 'radio', 4, 'Isaac Newton,Albert Einstein,Benjamin Franklin,Marie Curie', 4, 1, '2021-10-31 11:10:03', '2021-10-31 11:10:03'),
(24, 2, 'When was barb wire patented?', '1874', 'radio', 4, '1895,1840,1874,1900', 3, 1, '2021-10-31 11:12:04', '2021-10-31 11:12:04'),
(25, 2, 'What plaything was invented by Joe McVicker in 1956?', 'Play-Doh', 'radio', 4, 'Silly Putty,Play-Doh,Lite-Brite,Etch-A-Sketch', 3, 1, '2021-10-31 11:14:21', '2021-11-01 07:32:26'),
(26, 2, 'Who was the first American female to patent her invention, a method of weaving straw with silk?', 'Mary Kies', 'radio', 4, 'Marjorie Joyner,Margaret Knight,Amanda Jones,Mary Kies', 2, 1, '2021-10-31 11:15:53', '2021-11-01 07:32:00'),
(27, 2, 'Who invented Gramophone?', 'Thomas Alva Edison', 'radio', 4, 'Michael Faraday,Thomas Alva Edison,Sir Alexander Graham Bell,Fahrenheit', 2, 1, '2021-10-31 11:17:23', '2021-11-01 07:30:45'),
(28, 2, 'When was the first elevator built?', '1743', 'radio', 4, '1760,1739,1743,1785', 2, 1, '2021-10-31 11:18:52', '2021-10-31 11:18:52'),
(29, 4, 'What is a default and conversion constructor?', NULL, 'text', 0, NULL, 5, 1, '2021-10-31 11:32:11', '2021-10-31 11:32:11'),
(30, 4, 'What are the advantages and disadvantages of multiple inheritance?', NULL, 'text', 0, NULL, 5, 1, '2021-10-31 11:32:37', '2021-10-31 11:32:37'),
(31, 4, 'What is an operating system? What are the popular operating systems used today?', NULL, 'text', 0, NULL, 5, 1, '2021-10-31 11:33:05', '2021-10-31 11:33:05'),
(32, 4, 'What are the primary components of a computer system?', NULL, 'text', 0, NULL, 5, 1, '2021-10-31 11:33:34', '2021-10-31 11:33:34'),
(33, 4, 'What is a class? What is a superclass?', NULL, 'text', 0, NULL, 3, 1, '2021-10-31 11:34:06', '2021-10-31 11:34:06'),
(34, 4, '<span class=\"styles-module--listItemText--2JjD8\" style=\"box-sizing: inherit; font-size: 1rem; line-height: 1.75;\">What is polymorphism?</span>', NULL, 'text', 0, NULL, 2, 1, '2021-10-31 11:34:53', '2021-10-31 11:34:53'),
(35, 4, 'What is the difference between overriding and overloading?', NULL, 'text', 0, NULL, 2, 1, '2021-10-31 11:35:12', '2021-10-31 11:35:12'),
(36, 4, 'What are the commonly used computer processors?', NULL, 'text', 0, NULL, 3, 1, '2021-10-31 11:35:50', '2021-10-31 11:35:50');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `gender` varchar(8) NOT NULL,
  `class_id` int NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `father_name` varchar(200) NOT NULL,
  `father_occupation` varchar(100) NOT NULL,
  `father_nid` varchar(30) NOT NULL,
  `mother_name` varchar(200) NOT NULL,
  `mother_occupation` varchar(100) NOT NULL,
  `mother_nid` varchar(30) NOT NULL,
  `guidance_mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `guidance_email` varchar(200) NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `gender`, `class_id`, `dob`, `address`, `image`, `father_name`, `father_occupation`, `father_nid`, `mother_name`, `mother_occupation`, `mother_nid`, `guidance_mobile`, `guidance_email`, `is_active`, `updated_at`) VALUES
(1, 8, 'Male', 3, '2000-05-01', '76, Dilkusha C/A, Dhaka', '1_p_091221.053732.37.jpg', 'Father 1', 'Govt. Service', '1234568787', 'Mother 1', 'Housewife', '4325678887', '01983837765', 'Father1@gmail.com', 1, '2021-09-11 23:37:32'),
(2, 9, 'Female', 7, '1997-05-23', '27/27, khilgaon, malibagh, 272277', '1_p_091221.053818.38.jpg', 'Father 2', 'Civil Service', '5436316677', 'Mother 2', 'Housewife', '4325675543', '01983837788', 'Father2@gmail.com', 0, '2021-09-11 23:38:18'),
(6, 15, 'Female', 3, '2000-05-28', '70/3, tipu sultan road, wari, 1203', '1_p_091221.053835.38.jpeg', 'Father 3', 'Govt. Service', '2345658888', 'Mother 3', 'Govt. Service', '8883332323', '01983837777', 'Father3@gmail.com', 1, '2021-09-11 23:38:35'),
(7, 16, 'Male', 3, '1996-08-26', 'savar bazar bus stand, savar, monsur market (lab-zone ltd.), 1379', '1_p_091221.053856.38.jpg', 'Father 4', 'Civil Service', '2345659999', 'Mother 4', 'Housewife', '4325678877', '01983837722', 'Father4@gmail.com', 1, '2021-09-11 23:38:56'),
(8, 17, 'Male', 3, '2003-07-06', '84, Kamal Ataturk Ave. (4th Fl.), Dhaka', '1_p_091221.053758.37.jpg', 'Father 5', 'Business', '5556316677', 'Mother 5', 'Civil Service', '2225678877', '01982837722', 'Father5@gmail.com', 1, '2021-09-11 23:37:58'),
(9, 18, 'Male', 3, '2004-09-14', '121/f Naya Paltan, Dhaka', '1_p_091221.053938.39.jpeg', 'Father 6', 'Govt. Service', '5555316677', 'Mother 6', 'Govt. Service', '4325775543', '01983834444', 'Father6@gmail.com', 1, '2021-09-11 23:39:38'),
(10, 19, 'Male', 3, '2012-07-17', 'eidga, coxsbazar, coxsbazar, 47044', '1_p_091221.053919.39.jpg', 'Father 7', 'Civil Service', '2345650000', 'Mother 7', 'Business', '4325671122', '01983833344', 'Father7@gmail.com', 1, '2021-09-11 23:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `course_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `student_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-09-05 10:19:33', '2021-09-05 10:20:14'),
(2, 2, 1, '2021-09-05 10:19:33', '2021-09-05 10:20:14'),
(3, 1, 3, '2021-09-05 10:20:17', '2021-09-05 10:20:50'),
(4, 1, 4, '2021-09-05 10:20:17', '2021-09-05 10:20:50'),
(5, 2, 4, '2021-09-05 10:20:58', '2021-09-05 10:21:20'),
(6, 1, 6, '2021-09-05 10:20:58', '2021-09-05 10:21:20'),
(7, 2, 2, '2021-09-05 05:08:58', '2021-09-05 05:08:58'),
(8, 2, 6, '2021-09-05 05:08:58', '2021-09-05 05:08:58'),
(9, 6, 1, '2021-09-05 23:11:06', '2021-09-05 23:11:06'),
(10, 6, 3, '2021-09-05 23:11:06', '2021-09-05 23:11:06'),
(11, 6, 6, '2021-09-05 23:11:06', '2021-09-05 23:11:06'),
(12, 7, 2, '2021-09-05 23:18:34', '2021-09-05 23:18:34'),
(13, 7, 4, '2021-09-05 23:18:35', '2021-09-05 23:18:35'),
(14, 7, 10, '2021-09-05 23:18:35', '2021-09-05 23:18:35'),
(15, 8, 3, '2021-09-05 23:21:32', '2021-09-05 23:21:32'),
(16, 8, 6, '2021-09-05 23:21:32', '2021-09-05 23:21:32'),
(17, 8, 10, '2021-09-05 23:21:32', '2021-09-05 23:21:32'),
(21, 10, 3, '2021-09-05 23:28:09', '2021-09-05 23:28:09'),
(22, 10, 6, '2021-09-05 23:28:10', '2021-09-05 23:28:10'),
(23, 10, 10, '2021-09-05 23:28:10', '2021-09-05 23:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `student_gradings`
--

CREATE TABLE `student_gradings` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `teacher_user_id` int NOT NULL,
  `grade_id` int NOT NULL,
  `obtain_marks` float NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `gender` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `national_id` varchar(30) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `subject` varchar(180) NOT NULL,
  `qualification` text NOT NULL,
  `institute` text NOT NULL,
  `experience` varchar(100) NOT NULL,
  `salary` int NOT NULL,
  `image` text NOT NULL,
  `isActive` tinyint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `gender`, `dob`, `address`, `national_id`, `designation`, `subject`, `qualification`, `institute`, `experience`, `salary`, `image`, `isActive`, `updated_at`) VALUES
(1, 4, 'Male', '1900-04-10', 'room # 106, supreme court bar association building, 1000', '12345643454', 'Senior', 'Math', 'Ms in Math', 'Dhaka University', '10', 30000, '1_p_090121.042729.27.jpg', 1, '2021-08-31 22:27:29'),
(2, 5, 'Female', '1987-08-17', '54/1/a, topkhana road, segunbagicha, 1000', '12345643423', 'Junior', 'English', 'BA in English', 'North South University', '4', 15000, '1_p_090121.042900.29.jpeg', 1, '2021-08-31 22:29:00'),
(3, 10, 'Male', '1987-06-18', 'road #4/a, satmosjid road, dhanmondi r/a, 12021', '1234567886', 'Senior', 'Bangla', 'MA in Bangla', 'Dhaka University', '5', 25000, '1_p_090521.090308.03.jpg', 1, '2021-09-05 03:03:08'),
(4, 20, 'Female', '1993-10-25', '86 Sidheswari Road, Dhaka', '1234564882', 'Senior', 'Information and Communication Technology', 'Msc in CSE', 'North South University', '3.5', 20000, '1_p_090621.053715.37.jpeg', 1, '2021-09-05 23:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_level` enum('master_admin','accounts','teacher','student') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `active_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `access_level`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `messenger_color`, `dark_mode`, `active_status`) VALUES
(1, 'John Doe', 'test@gmail.com', 'master_admin', '', NULL, '$2y$10$Rgzu6mXfN0yfXD74sh4NiOJv8w4KzvtAMzDDPsEf4POUfK/ljZ4Ty', NULL, '2021-08-29 15:12:44', '2021-08-29 15:12:44', 'avatar.png', '#2180f3', 0, 0),
(4, 'Teacher 1', 'safwanhassan13@gmail.com', 'teacher', '01943837967', NULL, '$2y$10$7ZygRs6ni4qFlB0GvGadpu9ViUICxBg.6ohT/5Hl.7q/SFB57jGKq', NULL, '2021-08-31 22:27:29', '2021-08-31 22:27:29', 'avatar.png', '#2180f3', 0, 0),
(5, 'Teacher 2', 'safwan@jhorotek.com', 'teacher', '01943837964', NULL, '$2y$10$PlC1QK/EhOOnHRWOZY5yM.Ezi0u1I1OxHcgqOrRRfQwvqXrxU1BKy', NULL, '2021-08-31 22:29:00', '2021-08-31 22:29:00', 'avatar.png', '#2180f3', 0, 0),
(8, 'Student 1', 'Student1@gmail.com', 'student', '01943837954', NULL, '$2y$10$dSMCEQH9L1W6UQra9BbsW.nmNx.iKxrHzR4u72O3BGFyDiQFVbDKe', NULL, '2021-09-04 22:44:49', '2021-09-04 22:44:49', 'avatar.png', '#2180f3', 0, 0),
(9, 'Student 2', 'Student2@gmail.com', 'student', '01943837965', NULL, '$2y$10$3SlosIyUy.BjFeH/XGD6IuqfjdEhXtgGy1mF5uuVdnXbMclLgej0G', NULL, '2021-09-04 22:52:22', '2021-09-04 22:52:22', 'avatar.png', '#2180f3', 0, 0),
(10, 'Teacher 3', 'Teacher3@gmail.com', 'teacher', '01943837932', NULL, '$2y$10$fhuiu7Dcrhv4oAhu8ut7k.orNtJvYO9fJWdnHBii9A9fBI1MVVNu.', NULL, '2021-09-05 03:03:07', '2021-09-05 03:03:07', 'avatar.png', '#2180f3', 0, 0),
(15, 'Student 3', 'Student3@gmail.com', 'student', '01943837999', NULL, '$2y$10$ZaA55gA8x4jV7V5eLPjps.7r09iHuQi4RDOW.pXpr/9EaMCRzzcjG', NULL, '2021-09-05 23:11:05', '2021-09-05 23:11:05', 'avatar.png', '#2180f3', 0, 0),
(16, 'Student 4', 'Student4@gmail.com', 'student', '01943837555', NULL, '$2y$10$vMcK/y6AS/8Frv0PqJ9UwOzXbDCXKALUqND4I5eQmP55LJZfzwhQa', NULL, '2021-09-05 23:18:34', '2021-09-05 23:18:34', 'avatar.png', '#2180f3', 0, 0),
(17, 'Student 5', 'Student5@gmail.com', 'student', '01943837222', NULL, '$2y$10$Be6zBFmGyBD.yF.kQMWzIOse9RB1eIilDEjE6oy4s8WLVOTcD2Mcu', NULL, '2021-09-05 23:21:32', '2021-09-05 23:21:32', 'avatar.png', '#2180f3', 0, 0),
(18, 'Student 6', 'Student6@gmail.com', 'student', '01943837111', NULL, '$2y$10$XHhUCQbnF1BPPMGIamHJS.ZvEmnlIU8f/EqYGUgVYsio0I4WiwPAW', NULL, '2021-09-05 23:25:35', '2021-09-05 23:25:35', 'avatar.png', '#2180f3', 0, 0),
(19, 'Student 7', 'Student7@gmail.com', 'student', '01943834444', NULL, '$2y$10$BoebJ8nc/cgL0LafoxqT7eAeU7f5OKtQuHAiOzGXMYokkSGRjDf0G', NULL, '2021-09-05 23:28:09', '2021-09-05 23:28:09', 'avatar.png', '#2180f3', 0, 0),
(20, 'Teacher 4', 'mdriham@gmail.com', 'teacher', '01943831199', NULL, '$2y$10$rDjtdewL/JlEbqS.bFwfae/WMZfpJb0hR8R.iRTUTAEM1dQlKD0QK', NULL, '2021-09-05 23:37:15', '2021-09-05 23:37:15', 'avatar.png', '#2180f3', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_students`
--
ALTER TABLE `attendance_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_teachers`
--
ALTER TABLE `attendance_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom_group_chats`
--
ALTER TABLE `classroom_group_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom_single_chats`
--
ALTER TABLE `classroom_single_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom_students`
--
ALTER TABLE `classroom_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examination_solution_mcqs`
--
ALTER TABLE `examination_solution_mcqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examination_solution_written`
--
ALTER TABLE `examination_solution_written`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_gradings`
--
ALTER TABLE `student_gradings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
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
-- AUTO_INCREMENT for table `attendance_students`
--
ALTER TABLE `attendance_students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attendance_teachers`
--
ALTER TABLE `attendance_teachers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `classroom_group_chats`
--
ALTER TABLE `classroom_group_chats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `classroom_single_chats`
--
ALTER TABLE `classroom_single_chats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classroom_students`
--
ALTER TABLE `classroom_students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `examination_solution_mcqs`
--
ALTER TABLE `examination_solution_mcqs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `examination_solution_written`
--
ALTER TABLE `examination_solution_written`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `student_gradings`
--
ALTER TABLE `student_gradings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
