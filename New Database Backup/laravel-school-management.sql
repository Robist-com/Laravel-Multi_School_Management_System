-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 06:32 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-school-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `academics`
--

CREATE TABLE `academics` (
  `academic_id` int(10) UNSIGNED NOT NULL,
  `academic_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academics`
--

INSERT INTO `academics` (`academic_id`, `academic_year`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2020', '2020-04-06 01:30:53', '2020-04-06 01:30:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fisrtname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dateregistered` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `class_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` int(10) UNSIGNED NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `first_name`, `last_name`, `father_name`, `father_phone`, `mother_name`, `gender`, `email`, `dob`, `phone`, `address`, `current_address`, `nationality`, `passport`, `status`, `dateregistered`, `user_id`, `semester_id`, `degree_id`, `class_code`, `batch_id`, `faculty_id`, `department_id`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Alagie', 'Singhateh', 'Lamin marong', '+220 98359868', 'Fatou marong', '0', '3939919@gmail.com', '2020-04-15', '+220 3939919', 'latrikunda sabiji', 'ciputat', 'Gambian', 'pc 070901', 1, '2020-04-05', 1, 7, 2, 'IS001-Class-A', 5, 1, 2, '1582554724.jpg', NULL, '2020-04-06 02:48:03', '2020-04-06 05:10:40'),
(2, 'Binta', 'hydara', 'Lamin marong', '+220 98359868', 'Fatou marong', '1', 'binta@gmail.com', '2015-06-30', '+220 3939919', 'bundung', 'united Kingdom', 'Gambian', 'pc 070901', 1, '2020-04-05', 1, 7, 2, 'IS001-Class-A', 5, 1, 2, '1583171544.jpg', NULL, '2020-04-06 05:13:46', '2020-04-06 05:14:11'),
(3, 'Yahya', 'jammeh', 'kebba jaammeh', '7943887547959', 'mariama jammeh', '0', 'yahya@gmail.com', '2020-05-19', '485494865698', 'fajikunda kunda', 'eg', 'Gambian', '4989454968', 1, '2020-05-23', 1, 7, 2, 'IS001-Class-A', 5, 1, 2, '1582114161.jpg', NULL, '2020-05-23 16:27:06', '2020-07-01 00:02:04'),
(5, 'Ebrima', 'jatta', 'Malik Jatta', '328347435845', 'Oumie Jatta', '0', 'ebrima@gmail.com', '2005-06-22', '081290348083', 'mahad uin', 'mahad uin', 'Gambian', 'pc000094', 1, '2020-07-11', 1, 7, 2, 'C-B-0002', 5, 1, 2, '1594445962.PNG', NULL, '2020-07-10 22:39:22', '2020-07-13 02:36:17'),
(6, 'Ebrima', 'Singhateh', 'Malik Jatta', '081290348080', 'Oumie Jatta', '0', 'eboy@gmail.com', '2020-07-28', '081290348080', 'mahad uin', 'mahad uin', 'Gambian', 'pc000092', 1, '2020-07-19', 1, 9, 4, 'C-B-0002', 5, 1, 2, '1595173570.png', NULL, '2020-07-19 08:46:10', '2020-07-20 13:00:08'),
(7, 'Omar', 'Samba', 'Malik Jatta', '081290348080', 'Oumie Jatta', '0', 'omar@gmail.com', '2020-07-30', '081290348080', 'mahad uin', 'mahad uin', 'Gambian', 'pc000092', 1, '2020-07-19', 1, 7, 2, 'IS001-Class-A', 5, 1, 2, '1595183307.jpg', NULL, '2020-07-19 11:28:27', '2020-07-20 13:00:09'),
(10, 'fatoumata', 'sallah', 'Malik Jatta', '081290348080', 'Oumie Jatta', '0', 'fatoumata@gmail.com', '2020-07-15', '081290348080', 'Latrikunda sabiji', 'Serekunda', 'Gambian', 'pc000092', 1, '2020-07-20', 1, 7, 2, 'IS001-Class-A', 5, 1, 2, '1595248620.jpg', NULL, '2020-07-20 05:37:00', '2020-07-20 13:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `attendance_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `attendance_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edit_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `attendance_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`attendance_id`, `student_id`, `class_id`, `course_id`, `teacher_id`, `semester_id`, `attendance_date`, `edit_date`, `day`, `month`, `year`, `attendance_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'IS001-Class-A', 1, 1, 7, '12-07-2020', '12-07-2020', 'Sunday', 'July', 2020, 'present', NULL, NULL, '2020-07-12 03:10:17'),
(2, 2, 'IS001-Class-A', 1, 1, 7, '12-07-2020', '12-07-2020', 'Sunday', 'July', 2020, 'present', NULL, NULL, '2020-07-12 03:10:17'),
(3, 3, 'IS001-Class-A', 1, 1, 7, '12-07-2020', '12-07-2020', 'Sunday', 'July', 2020, 'present', NULL, NULL, '2020-07-12 03:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch` int(11) NOT NULL,
  `is_current_batch` tinyint(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `batch`, `is_current_batch`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2016, 0, NULL, '2020-04-05 22:10:52', '2020-04-05 22:10:52'),
(2, 2017, 0, NULL, '2020-04-05 22:11:11', '2020-04-05 22:11:11'),
(3, 2018, 0, NULL, '2020-04-05 22:11:32', '2020-04-05 22:11:32'),
(4, 2019, 0, NULL, '2020-04-05 22:11:56', '2020-04-05 22:11:56'),
(5, 2020, 1, NULL, '2020-04-05 22:12:15', '2020-04-05 22:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `class_code`, `department_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Class A', 'IS001-Class-A', 2, 'on', NULL, '2020-04-05 22:10:09', '2020-07-05 10:20:23'),
(3, 'Class B', 'C-B-0002', 2, 'on', NULL, '2020-07-05 09:55:42', '2020-07-05 09:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `class_assignings`
--

CREATE TABLE `class_assignings` (
  `class_assign_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `time_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_rooms`
--

CREATE TABLE `class_rooms` (
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `classroom_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classroom_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classroom_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `classroom_status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_rooms`
--

INSERT INTO `class_rooms` (`classroom_id`, `classroom_name`, `classroom_code`, `classroom_description`, `classroom_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Room 1', 'RM-0001', 'this is for room 1 first floor', 1, NULL, '2020-04-06 01:28:02', '2020-04-06 01:28:02'),
(2, 'Room 2', 'RM-0002', 'this is for room 2 first floor', 1, NULL, '2020-04-06 01:28:51', '2020-04-06 01:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule`
--

CREATE TABLE `class_schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `class_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `time_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `schedule_status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_schedule`
--

INSERT INTO `class_schedule` (`id`, `course_id`, `class_id`, `level_id`, `shift_id`, `classroom_id`, `batch_id`, `day_id`, `time_id`, `semester_id`, `degree_id`, `faculty_id`, `department_id`, `teacher_id`, `start_date`, `end_date`, `schedule_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'IS001-Class-A', '2', 1, 1, 5, 1, 2, 7, 2, 1, 2, 1, '2020-04-06', '2020-11-25', 1, NULL, '2020-04-06 19:27:13', '2020-07-06 23:08:33'),
(2, 4, 'C-B-0002', NULL, 1, 1, 5, 1, 2, 8, 3, 1, 2, 1, '2020-07-07', '2020-07-14', 1, NULL, '2020-07-06 10:26:01', '2020-07-06 23:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `user_one`, `user_two`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 0, NULL, NULL),
(2, 1, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gradeSystem` int(11) NOT NULL,
  `totalfull` int(11) NOT NULL,
  `totalpass` int(11) NOT NULL,
  `wfull` int(11) NOT NULL,
  `wpass` int(11) NOT NULL,
  `mfull` int(11) NOT NULL,
  `mpass` int(11) NOT NULL,
  `sfull` int(11) NOT NULL,
  `spass` int(11) NOT NULL,
  `pfull` int(11) DEFAULT NULL,
  `ppass` int(11) NOT NULL,
  `describtion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `class`, `department`, `semester`, `gradeSystem`, `totalfull`, `totalpass`, `wfull`, `wpass`, `mfull`, `mpass`, `sfull`, `spass`, `pfull`, `ppass`, `describtion`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Arts and Craft', 'Arts-001', 'IS001-Class-A', '2', 'N/A', 2, 100, 70, 20, 15, 25, 20, 30, 25, 20, 15, 'this is for arts and craft', 1, NULL, '2020-07-04 04:38:47', '2020-07-08 01:51:13'),
(2, 'Commerce', 'CMR-001', 'IT001-Class-A', '1', 'N/A', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'this is commerce course', 1, NULL, '2020-07-04 21:41:59', '2020-07-06 21:27:54'),
(3, 'Science', 'SC-001', 'C-B-0002', '2', 'N/A', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'this si science', 1, NULL, '2020-07-04 21:42:36', '2020-07-05 10:24:24'),
(4, 'Science 1', 'Sci-001', 'C-B-0002', '2', 'N/A', 1, 100, 80, 50, 35, 15, 10, 15, 10, 20, 15, 'this is a science', 1, NULL, '2020-07-05 09:58:47', '2020-07-08 01:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `day_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`day_id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Monday', NULL, '2020-04-06 00:26:22', '2020-04-06 00:26:22'),
(2, 'Tuesday', NULL, '2020-04-06 00:28:26', '2020-04-06 00:28:26'),
(3, 'Wednesday', NULL, '2020-04-06 00:30:01', '2020-04-06 00:30:01'),
(4, 'Thursday', NULL, '2020-04-06 00:30:34', '2020-04-06 00:30:34'),
(5, 'Friday', NULL, '2020-04-06 00:31:03', '2020-04-06 00:31:03'),
(6, 'Saturday', NULL, '2020-04-06 00:31:45', '2020-04-06 00:31:45'),
(7, 'Sunday', NULL, '2020-04-06 00:32:16', '2020-04-06 00:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `degree_id` bigint(20) UNSIGNED NOT NULL,
  `degree_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `faculty_id`, `department_name`, `department_code`, `department_description`, `department_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Information Technology', 'IT', 'this is for IT department', 1, NULL, '2020-04-05 22:06:01', '2020-07-06 23:26:40'),
(2, 1, 'Information System', 'IS', 'This is for IS department', 1, NULL, '2020-04-05 22:06:52', '2020-04-05 22:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `e_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `session`, `class_id`, `department_id`, `type`, `e_date`, `created_at`, `updated_at`) VALUES
(1, '2020', '1', '1', '1st Term Exam', '2020-07-08', '2020-07-07 09:22:53', '2020-07-07 09:22:53'),
(2, '2020', '2', '2', '1st Term Exam', '2020-08-21', '2020-07-07 09:23:06', '2020-07-07 09:23:06'),
(3, '2020', '3', '2', '1st Term Exam', '2020-08-21', '2020-07-07 09:23:06', '2020-07-07 09:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `faculty_id` bigint(20) UNSIGNED NOT NULL,
  `faculty_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `faculty_name`, `faculty_code`, `faculty_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Faculty of Science and Technology', 'FST', 1, NULL, '2020-04-05 22:03:38', '2020-07-06 23:29:29'),
(2, 'Faculty of Social and Politics', 'SP', 1, NULL, '2020-04-05 22:04:56', '2020-04-05 22:04:56');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_structures`
--

CREATE TABLE `fee_structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `admissionFee` float(8,2) DEFAULT NULL,
  `semesterFee` float(8,2) NOT NULL,
  `fee_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` float(8,2) NOT NULL DEFAULT 0.00,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_structures`
--

INSERT INTO `fee_structures` (`id`, `semester_id`, `degree_id`, `faculty_id`, `department_id`, `admissionFee`, `semesterFee`, `fee_type`, `total_amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 7, 2, 1, 2, 50.00, 3000.00, 'Schoo Fee', 3050.00, NULL, '2020-04-06 03:24:16', '2020-07-06 09:44:17'),
(2, 7, 2, 1, 2, NULL, 1000.00, 'Exam Fee', 0.00, NULL, '2020-07-16 14:16:26', '2020-07-16 14:16:26'),
(3, 7, 2, 1, 2, NULL, 150.00, 'First Term', 0.00, NULL, '2020-07-16 14:27:30', '2020-07-16 14:27:30'),
(4, 7, 2, 1, 2, NULL, 100.00, 'Second Term', 0.00, NULL, '2020-07-16 14:27:58', '2020-07-16 14:27:58'),
(5, 7, 2, 1, 2, NULL, 75.00, 'Third Term', 0.00, NULL, '2020-07-16 14:28:29', '2020-07-16 14:28:29');

-- --------------------------------------------------------

--
-- Table structure for table `gpa`
--

CREATE TABLE `gpa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `for` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gpa` double(8,2) NOT NULL,
  `markfrom` int(11) NOT NULL,
  `markto` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gpa`
--

INSERT INTO `gpa` (`id`, `for`, `grade`, `gpa`, `markfrom`, `markto`, `created_at`, `updated_at`) VALUES
(1, '1', 'A+', 4.00, 85, 100, '2020-04-05 22:22:52', '2020-07-08 04:14:40'),
(2, '3', 'A', 3.50, 75, 85, '2020-04-05 22:23:40', '2020-07-08 04:14:27'),
(3, '2', 'B', 3.00, 60, 74, '2020-07-08 04:22:14', '2020-07-08 04:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `homeworks`
--

CREATE TABLE `homeworks` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homeworks`
--

INSERT INTO `homeworks` (`id`, `teacher_id`, `class_code`, `subject_id`, `semester_id`, `body`, `file`, `start_date`, `end_date`, `status`, `created_at`, `deleted_at`, `updated_at`) VALUES
(4, 1, 'IT001-Class-A', 4, 7, 'Home work    for department', '8440.pdf', '2020-07-17', '2020-07-18', 1, '2020-07-11 06:37:32', NULL, '2020-07-11 06:37:32'),
(5, 1, 'IS001-Class-A', 1, 7, 'TEST NEW HOMEWORK', '5581.pdf', '2020-07-25', '2020-08-01', 1, '2020-07-11 14:08:42', NULL, '2020-07-11 14:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `inboxes`
--

CREATE TABLE `inboxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `flag` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'New',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inboxes`
--

INSERT INTO `inboxes` (`id`, `user_id`, `subject`, `message`, `status`, `flag`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1', 'test', 'hello sir how are you doing', 0, 'Read', NULL, NULL, '2020-05-22 05:03:25'),
(2, '4', 'sir, school fee', 'this message to let you know about your school fees', 0, 'Read', NULL, '2020-05-22 18:31:23', '2020-05-23 04:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `establish` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`id`, `name`, `establish`, `email`, `web`, `phoneNo`, `address`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Latrikunda Upper Basic School', '1967', 'latrikunda_ubs@gmail.com', 'latrikundaupbs.com', '+223239046565', 'Latrikunda Upper Basic School', '4773.jpg', '2020-07-12 15:36:33', '2020-07-12 15:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `grade_id` int(10) UNSIGNED NOT NULL,
  `level_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT 'off',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level`, `course_id`, `grade_id`, `level_description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Intermediate', 1, 1, 'this is', 'on', NULL, '2020-07-04 21:35:34', '2020-07-04 23:28:50'),
(2, 'Junior', 1, 7, 'this is for junior high courses', 'on', NULL, '2020-07-04 21:43:12', '2020-07-04 23:28:36'),
(3, 'Junior', 2, 8, 'this is for junior high courses', 'on', NULL, '2020-07-04 21:43:12', '2020-07-04 23:19:21'),
(4, 'Junior', 3, 9, 'this is for junior high courses', 'on', NULL, '2020-07-04 21:43:12', '2020-07-04 23:19:40'),
(5, 'Senior', 1, 10, 'this is for senor high courses', 'on', NULL, '2020-07-04 23:18:17', '2020-07-04 23:25:05'),
(6, 'Senior', 2, 11, 'this is for senor high courses', 'on', NULL, '2020-07-04 23:18:17', '2020-07-04 23:28:51'),
(7, 'Senior', 3, 12, 'this is for senor high courses', 'off', NULL, '2020-07-04 23:18:17', '2020-07-04 23:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roll_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `written` int(11) NOT NULL,
  `mcq` int(11) NOT NULL,
  `practical` int(11) NOT NULL,
  `ca` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `grade` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `point` decimal(3,2) DEFAULT NULL,
  `Absent` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `class`, `department`, `shift`, `session`, `roll_no`, `exam`, `subject`, `written`, `mcq`, `practical`, `ca`, `total`, `grade`, `point`, `Absent`, `created_at`, `updated_at`) VALUES
(1, 'IS001-Class-A', '2', 'Morning', '5', '1116093000111', '2', 'Arts-001', 20, 20, 20, 20, 80, 'A+', '4.00', 'No', '2020-07-08 12:09:05', '2020-07-08 12:09:05'),
(2, 'IS001-Class-A', '2', 'Morning', '5', '1116093000112', '2', 'Arts-001', 20, 15, 20, 15, 70, 'A', '3.50', 'No', '2020-07-08 12:09:05', '2020-07-08 12:09:05'),
(3, 'IS001-Class-A', '2', 'Morning', '5', '1116093000113', '2', 'Arts-001', 15, 20, 12, 20, 67, 'B', '3.00', 'No', '2020-07-08 12:09:05', '2020-07-08 12:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `meritlist`
--

CREATE TABLE `meritlist` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(50) NOT NULL,
  `exam` varchar(50) NOT NULL,
  `class` varchar(15) NOT NULL,
  `department_id` int(11) NOT NULL,
  `batch` varchar(15) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `point` decimal(18,2) NOT NULL,
  `totalNo` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meritlist`
--

INSERT INTO `meritlist` (`id`, `roll_no`, `exam`, `class`, `department_id`, `batch`, `grade`, `point`, `totalNo`, `created_at`, `updated_at`) VALUES
(1, '1116093000111', '2', 'IS001-Class-A', 2, '5', '4', '4.00', '80.00', '2020-07-08 12:10:46', '2020-07-08 12:10:46'),
(2, '1116093000112', '2', 'IS001-Class-A', 2, '5', '3.5', '3.50', '70.00', '2020-07-08 12:10:46', '2020-07-08 12:10:46'),
(3, '1116093000113', '2', 'IS001-Class-A', 2, '5', '3', '3.00', '67.00', '2020-07-08 12:10:46', '2020-07-08 12:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_from`, `user_to`, `conversation_id`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 'hello sir,', 1, NULL, NULL),
(2, 1, 4, 2, 'i want to ask about the progress of  my skripsi', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_07_08_144003_createTableSubject', 1),
(4, '2015_07_11_181156_createTableGPA', 1),
(5, '2015_07_11_233620_createTableMarks', 1),
(6, '2016_03_24_124531_createTableInstitute', 1),
(7, '2018_01_15_042012_create_exam_table', 1),
(8, '2019_03_11_083437_create_questions_table', 1),
(9, '2019_03_11_111154_add_quize_name_questions_table', 1),
(10, '2019_03_12_061337_create_question_temps_table', 1),
(11, '2019_09_09_082737_create_students_table', 1),
(12, '2019_09_17_162658_create_admins_table', 1),
(13, '2019_09_17_174817_create_roles_table', 1),
(14, '2019_09_18_172432_create_batches_table', 1),
(15, '2019_09_18_172600_create_courses_table', 1),
(16, '2019_09_18_173054_create_classes_table', 1),
(17, '2019_09_18_173111_create_fees_table', 1),
(18, '2019_09_18_173201_create_fee_structures_table', 1),
(19, '2019_09_18_173324_create_faculties_table', 1),
(20, '2019_09_18_200410_create_admissions_table', 1),
(21, '2019_09_18_201037_create_salaries_table', 1),
(22, '2019_09_18_203553_create_attendances_table', 1),
(23, '2019_09_18_210712_create_class_assignings_table', 1),
(24, '2019_09_18_211228_create_days_table', 1),
(25, '2019_09_22_181701_shifts_table', 1),
(26, '2019_09_22_182447_semesters_table', 1),
(27, '2019_09_22_183149_times_table', 1),
(28, '2019_09_23_133215_levels_table', 1),
(29, '2019_09_24_023746_create_teachers_table', 1),
(30, '2019_10_01_031326_create_transactions_table', 1),
(31, '2019_10_01_122855_create_class_rooms_table', 1),
(32, '2019_10_25_152724_create_academics_table', 1),
(33, '2019_11_11_081929_create_class_schedule_table', 1),
(34, '2019_12_09_053922_create_cache_table', 1),
(35, '2019_12_12_134032_create_statuses', 1),
(36, '2019_12_20_154530_departments', 1),
(37, '2019_12_21_040545_rolls', 1),
(38, '2019_12_28_083222_table_verification_codes', 1),
(39, '2020_01_31_184747_inboxes', 1),
(40, '2020_02_13_073944_create_semester_details_table', 1),
(41, '2020_02_13_113822_create_invoice_details_table', 1),
(42, '2020_02_13_114146_create_invoices_table', 1),
(43, '2020_02_13_131006_create_student_fees_table', 1),
(44, '2020_02_15_215724_create_semester_subjects_table', 1),
(45, '2020_04_05_183347_create_degrees_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `type`, `body`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'UTS', 'this is for notice', '0000-00-00', '0000-00-00', 0, '2020-05-23 12:26:41', '2020-05-23 12:26:41'),
(2, 'UTS', 'this is for notice', '0000-00-00', '0000-00-00', 0, '2020-05-23 12:29:34', '2020-05-23 12:29:34'),
(3, 'School Fee', 'this is for school fee, please contact the admsitration after paying the fee at the bank by sending the recipt', '2020-05-14', '2020-05-05', 1, '2020-05-23 13:09:37', '2020-05-23 13:09:37'),
(4, 'Test', 'Hello Stuents', '2020-07-29', '2020-07-29', 1, '2020-07-09 03:25:30', '2020-07-09 03:25:30'),
(5, 'ala', 'hey', '2020-07-17', '2020-07-28', 0, '2020-07-09 03:25:54', '2020-07-09 03:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promote_students`
--

CREATE TABLE `promote_students` (
  `id` int(11) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `grade_id` int(10) UNSIGNED NOT NULL,
  `class_code` varchar(200) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'current',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promote_students`
--

INSERT INTO `promote_students` (`id`, `student_id`, `grade_id`, `class_code`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 1, 7, 'IS001-Class-A', 'previous', '2020-07-21 15:01:47', NULL, NULL),
(13, 2, 7, 'IS001-Class-A', 'previous', '2020-07-21 15:01:47', NULL, NULL),
(14, 3, 7, 'IS001-Class-A', 'previous', '2020-07-21 15:01:47', NULL, NULL),
(15, 7, 7, 'IS001-Class-A', 'previous', '2020-07-21 15:01:47', NULL, NULL),
(16, 10, 7, 'IS001-Class-A', 'previous', '2020-07-21 15:01:47', NULL, NULL),
(17, 1, 8, 'IS001-Class-A', 'previous', '2020-07-21 15:41:09', NULL, NULL),
(18, 2, 8, 'IS001-Class-A', 'previous', '2020-07-21 15:41:09', NULL, NULL),
(19, 3, 8, 'IS001-Class-A', 'previous', '2020-07-21 15:41:09', NULL, NULL),
(20, 7, 8, 'IS001-Class-A', 'previous', '2020-07-21 15:41:09', NULL, NULL),
(21, 10, 8, 'IS001-Class-A', 'previous', '2020-07-21 15:41:09', NULL, NULL),
(22, 1, 9, 'IS001-Class-A', 'current', '2020-07-21 15:41:09', NULL, NULL),
(23, 2, 9, 'IS001-Class-A', 'current', '2020-07-21 15:41:09', NULL, NULL),
(24, 3, 9, 'IS001-Class-A', 'current', '2020-07-21 15:41:09', NULL, NULL),
(25, 7, 9, 'IS001-Class-A', 'current', '2020-07-21 15:41:09', NULL, NULL),
(26, 10, 9, 'IS001-Class-A', 'current', '2020-07-21 15:41:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `chapter` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_type` int(11) NOT NULL,
  `choices` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 1,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quize_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `class_code`, `course_id`, `chapter`, `session`, `question_name`, `question_type`, `choices`, `answer`, `points`, `type`, `level`, `logo`, `created_at`, `updated_at`, `quize_name`) VALUES
(1, 'IS001-Class-A', 1, 'First Term', '2020', 'What is the meaning of PHP?', 1, '', 'write correct answer', 3, NULL, 'simple', NULL, '2020-04-28 05:23:30', '2020-04-28 05:23:30', 'Final Exam');

-- --------------------------------------------------------

--
-- Table structure for table `question_temps`
--

CREATE TABLE `question_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `chapter` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quize_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_type` int(11) NOT NULL,
  `choices` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 1,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, '2020-07-23 06:51:19', '2020-07-29 06:51:19'),
(2, 'Teacher', NULL, '2020-07-30 06:51:19', '2020-07-27 06:51:19'),
(3, 'Student', NULL, '2020-07-29 06:52:07', '2020-07-28 06:52:07'),
(4, 'Parent', NULL, '2020-07-27 06:52:26', '2020-07-20 06:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `rolls`
--

CREATE TABLE `rolls` (
  `roll_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `isonline` int(11) NOT NULL DEFAULT 0,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rolls`
--

INSERT INTO `rolls` (`roll_id`, `student_id`, `semester_id`, `username`, `password`, `login_time`, `logout_time`, `isonline`, `ip_address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '1116093000111', '1116093000111', '2020-10-31 19:02:46', '2020-07-16 06:11:22', 1, '127.0.0.1', NULL, NULL, '2020-10-31 12:02:46'),
(2, 2, 7, '1116093000112', '1116093000112', '2020-07-11 21:32:37', '2020-07-11 21:34:33', 0, '127.0.0.1', NULL, NULL, '2020-07-11 14:34:33'),
(3, 3, 7, '1116093000113', '1116093000113', '2020-07-11 21:34:51', '2020-07-11 21:43:47', 0, '127.0.0.1', NULL, NULL, '2020-07-11 14:43:47'),
(4, 5, 7, '1116093000114', '1116093000114', '2020-07-11 21:44:24', '2020-07-11 20:07:41', 0, '127.0.0.1', NULL, NULL, '2020-07-11 14:44:24'),
(5, 6, 9, '1116093000116', '1116093000116', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(6, 7, 7, '1116093000117', '1116093000117', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(8, 10, 7, '1116093000118', '1116093000118', NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `salary_id` bigint(20) UNSIGNED NOT NULL,
  `salary_type` double(8,2) NOT NULL,
  `paid_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester_duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_name`, `semester_code`, `semester_duration`, `semester_description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Grade 1', 'GRD-1', '6 months', 'this is for grade 1', 'off', NULL, '2020-04-06 02:09:15', '2020-07-04 21:08:05'),
(2, 'Grade 2', 'GRD-2', '6 months', 'this one is for grade 2', 'off', NULL, '2020-07-04 05:31:22', '2020-07-04 21:06:57'),
(3, 'Grade 3', 'GRD-3', '6 months', 'this is for grade 3', 'off', NULL, '2020-07-04 05:33:28', '2020-07-04 21:07:07'),
(4, 'Grade 4', 'GRD-4', '6 months', 'this for grade 4', 'off', NULL, '2020-07-04 05:33:59', '2020-07-04 21:07:16'),
(5, 'Grade 5', 'GRD-5', '6 months', 'this is for grade 5', 'off', NULL, '2020-07-04 05:34:26', '2020-07-04 21:07:23'),
(6, 'Grade 6', 'GRD-6', '6 months', 'this is for grade 6', 'off', NULL, '2020-07-04 05:36:23', '2020-07-04 21:07:31'),
(7, 'Grade 7', 'GRD-7', '6 months', 'this is for grade 7', 'on', NULL, '2020-07-04 05:36:37', '2020-07-04 07:33:23'),
(8, 'Grade 8', 'GRD-8', '6 months', 'this is for grade 8', 'on', NULL, '2020-07-04 05:36:51', '2020-07-04 07:37:40'),
(9, 'Grade 9', 'GRD-9', '6 months', 'this is for grade 9', 'on', NULL, '2020-07-04 05:37:09', '2020-07-04 07:39:46'),
(10, 'Grade 10', 'GRD-10', '6 months', 'this is for grade 10', 'on', NULL, '2020-07-04 05:38:16', '2020-07-04 07:40:09'),
(11, 'Grade 11', 'GRD-11', '6 months', 'this is for grade 11', 'on', NULL, '2020-07-04 05:38:35', '2020-07-04 07:40:29'),
(12, 'Grade 12', 'GRD-12', '6 months', 'this is for grade 12', 'on', NULL, '2020-07-04 05:38:51', '2020-07-04 07:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `semester_details`
--

CREATE TABLE `semester_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_id` int(11) NOT NULL,
  `course_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_subjects`
--

CREATE TABLE `semester_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `shift` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`shift_id`, `shift`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Morning', NULL, '2020-04-06 00:33:18', '2020-04-06 00:33:18'),
(2, 'Afternoon', NULL, '2020-04-06 00:34:04', '2020-04-06 00:34:04'),
(3, 'Evening', '2020-04-06 01:17:17', '2020-04-06 00:34:52', '2020-04-06 01:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_upload_homeworks`
--

CREATE TABLE `student_upload_homeworks` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `homework_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_upload_homeworks`
--

INSERT INTO `student_upload_homeworks` (`id`, `teacher_id`, `student_id`, `class_code`, `semester_id`, `subject_id`, `homework_id`, `status`, `created_at`, `updated_at`, `file`) VALUES
(1, 1, 1, 'IS001-Class-A', 7, 1, 5, 1, '2020-07-11 14:09:27', '2020-07-11 14:09:27', '7644.pdf'),
(2, 1, 2, 'IS001-Class-A', 7, 1, 5, 1, '2020-07-11 14:32:57', '2020-07-11 14:32:57', '6919.pdf'),
(3, 1, 3, 'IS001-Class-A', 7, 1, 5, 1, '2020-07-11 14:35:21', '2020-07-11 14:35:21', '1231.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stdgroup` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subgroup` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gradeSystem` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalfull` int(11) NOT NULL DEFAULT 0,
  `totalpass` int(11) NOT NULL DEFAULT 0,
  `wfull` int(11) NOT NULL DEFAULT 0,
  `wpass` int(11) NOT NULL DEFAULT 0,
  `mfull` int(11) NOT NULL DEFAULT 0,
  `mpass` int(11) NOT NULL DEFAULT 0,
  `sfull` int(11) NOT NULL DEFAULT 0,
  `spass` int(11) NOT NULL DEFAULT 0,
  `pfull` int(11) NOT NULL DEFAULT 0,
  `ppass` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `roll_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` int(11) NOT NULL DEFAULT 0,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateregistered` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `semester_id` int(10) UNSIGNED NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `roll_no`, `first_name`, `last_name`, `gender`, `marital_status`, `email`, `dob`, `phone`, `address`, `nationality`, `passport`, `status`, `dateregistered`, `user_id`, `semester_id`, `faculty_id`, `department_id`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2226093000111', 'Alagie', 'Sillah', '0', 0, 'sillah@gmail.com', '2020-04-08', '+220 3939919', 'Latrikunda sabiji', 'Gambian', 'pc 070901', '1', '2020-04-06', 1, 0, 1, 2, '3744.jpg', NULL, '2020-04-06 18:11:09', '2020-06-30 21:08:16'),
(2, '2226093000112', 'Omar', 'Samba', '0', 0, 'samba@gmail.com', '2020-04-08', '+220 3939919', 'Faji kunda', 'Gambian', 'pc 070901', '1', '2020-04-06', 1, 0, 1, 1, '4384.jpg', NULL, '2020-04-06 18:37:21', '2020-07-07 04:41:03'),
(3, '2226093000113', 'Wan', 'jaata', '0', 0, 'jatta@gmail.com', '2020-04-30', '+220 3939919', 'willingara', 'Gambian', 'pc 070901', '1', '2020-04-06', 1, 0, 1, 2, '9997.jpg', NULL, '2020-04-06 18:40:24', '2020-07-21 10:52:35'),
(11, '2226093000114', 'Kemo', 'danso', '0', 0, 'danso@gmail.com', '2020-04-26', '+220 3939919', 'bundung', 'Gambian', 'pc 070901', '0', '2020-04-06', 1, 0, 1, 1, 'profile.jpg', NULL, '2020-04-06 18:51:05', '2020-04-06 18:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `time_id` bigint(20) UNSIGNED NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `times`
--

INSERT INTO `times` (`time_id`, `time`, `shift_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, '07:30 am', 1, NULL, '2020-04-06 01:25:09', '2020-04-06 01:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 4,
  `teacher_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_online` tinyint(4) NOT NULL DEFAULT 0,
  `ip_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `teacher_id`, `email_verified_at`, `password`, `is_online`, `ip_address`, `login_time`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Alagie Singhateh', '3939919@gmail.com', 1, 0, NULL, '$2y$10$g4di2vx/ZwwLQjP3wus55ewWu5LkIvdHXprwkdKQEm7Ke5nfio40m', 0, NULL, NULL, 'oFwSGhWPWzTHZdc1yNMwMHYoWXr0GXPWj639HB7bWXth50ZWjeRc82zKzqQz', NULL, '2020-04-05 21:53:46', '2020-06-30 23:53:53'),
(4, 'Alagie Sillah', 'sillah@gmail.com', 2, 1, NULL, '$2y$10$g4di2vx/ZwwLQjP3wus55ewWu5LkIvdHXprwkdKQEm7Ke5nfio40m', 0, NULL, NULL, '94WyxfzD6R12sOx76ArmoUlco0tig3W6DfQuV6ZltbgGRYhGloeJH7H1RD7U', NULL, '2020-04-06 18:11:10', '2020-07-20 13:42:32'),
(5, 'Omar Samba', 'samba@gmail.com', 2, 2, NULL, '$2y$10$ipOV8SV8zZtc1ydoaikxpec4B3wTAgP7qC6QPvmxImIRIpMn.YyJC', 0, NULL, NULL, NULL, '2020-07-21 07:10:54', '2020-04-06 18:37:22', '2020-07-21 07:10:54'),
(6, 'Wan jaata', 'jatta@gmail.com', 2, 3, NULL, '$2y$10$KMYzvfHxvLAk8nvj8XVI0OOnYIUeuQqFau4FxSZcUWQAEXl9pymXe', 0, NULL, NULL, NULL, NULL, '2020-04-06 18:40:25', '2020-04-06 18:40:25'),
(7, 'Kemo danso', 'danso@gmail.com', 2, 11, NULL, '$2y$10$BS/sw8DgFqNmRWyD4eJI4OZjXQ9wIIqDt9JEnQyWx6mH6apG9okx6', 0, NULL, NULL, NULL, NULL, '2020-04-06 18:51:06', '2020-04-06 18:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `verificationcodes`
--

CREATE TABLE `verificationcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academics`
--
ALTER TABLE `academics`
  ADD PRIMARY KEY (`academic_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admissions_email_unique` (`email`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD UNIQUE KEY `cache_key_unique` (`key`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_assignings`
--
ALTER TABLE `class_assignings`
  ADD PRIMARY KEY (`class_assign_id`);

--
-- Indexes for table `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD PRIMARY KEY (`classroom_id`);

--
-- Indexes for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`degree_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_structures`
--
ALTER TABLE `fee_structures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gpa`
--
ALTER TABLE `gpa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inboxes`
--
ALTER TABLE `inboxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meritlist`
--
ALTER TABLE `meritlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `promote_students`
--
ALTER TABLE `promote_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_temps`
--
ALTER TABLE `question_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolls`
--
ALTER TABLE `rolls`
  ADD PRIMARY KEY (`roll_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester_details`
--
ALTER TABLE `semester_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester_subjects`
--
ALTER TABLE `semester_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_upload_homeworks`
--
ALTER TABLE `student_upload_homeworks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verificationcodes`
--
ALTER TABLE `verificationcodes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `verificationcodes_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academics`
--
ALTER TABLE `academics`
  MODIFY `academic_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `attendance_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_assignings`
--
ALTER TABLE `class_assignings`
  MODIFY `class_assign_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_rooms`
--
ALTER TABLE `class_rooms`
  MODIFY `classroom_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `day_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `degrees`
--
ALTER TABLE `degrees`
  MODIFY `degree_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `faculty_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_structures`
--
ALTER TABLE `fee_structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gpa`
--
ALTER TABLE `gpa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inboxes`
--
ALTER TABLE `inboxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meritlist`
--
ALTER TABLE `meritlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `promote_students`
--
ALTER TABLE `promote_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `question_temps`
--
ALTER TABLE `question_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rolls`
--
ALTER TABLE `rolls`
  MODIFY `roll_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `salary_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `semester_details`
--
ALTER TABLE `semester_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester_subjects`
--
ALTER TABLE `semester_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `shift_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_upload_homeworks`
--
ALTER TABLE `student_upload_homeworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `time_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `verificationcodes`
--
ALTER TABLE `verificationcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
