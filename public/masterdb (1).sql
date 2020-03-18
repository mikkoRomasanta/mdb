-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2020 at 12:40 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masterdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `name`) VALUES
(1, 'GSIS'),
(2, 'LDB'),
(3, 'UMDB'),
(5, 'VDB'),
(7, 'BBB');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC',
  `email` varchar(191) DEFAULT NULL,
  `role` varchar(5) NOT NULL DEFAULT 'USER',
  `status` varchar(191) NOT NULL DEFAULT 'ACTIVE',
  `bbb` tinyint(1) NOT NULL DEFAULT '0',
  `gsis` tinyint(1) NOT NULL DEFAULT '0',
  `ldb` tinyint(1) NOT NULL DEFAULT '0',
  `umdb` tinyint(1) NOT NULL DEFAULT '0',
  `vdb` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `first_name`, `last_name`, `password`, `email`, `role`, `status`, `bbb`, `gsis`, `ldb`, `umdb`, `vdb`, `created_at`, `updated_at`) VALUES
(1, '2910607', 'Mikko', 'Romasanta', '$2y$10$tZy.k438eVfRcUYP4RzMT.rc2OBcM4w2g6ZopCEA8RwKz3VAJg7uO', 'jonathanmikko.romasanta.gf@j-display.com', 'ADMIN', 'ACTIVE', 0, 1, 0, 1, 1, NULL, NULL),
(2, '2911234', 'Test', 'User', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', 'jonathanmikko.romasanta.gf@j-display.com', 'USER', 'TEMP', 0, 1, 1, 0, 1, NULL, '2020-03-09 23:07:48'),
(74, '2910677', 'Hugh', 'Janus', '$2y$10$DaWsE8ojANOMT6FD5YfctOB6bMww/ORYCZxPyaWGEOSZJytF4Y6rS', NULL, 'USER', '', 0, 1, 1, 1, 0, NULL, '2020-03-02 19:00:50'),
(75, '2918020', 'Elsie', 'Altenwerth', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 0, 1, NULL, '2020-03-01 18:26:51'),
(76, '2919216', 'Stella', 'Metz', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 1, 1, 0, 1, 0, NULL, '2020-03-01 18:33:21'),
(77, '2911646', 'Sonya', 'Weber', '$2y$10$9aiEXhov1JWaLhx3WXA07eOTy8J835rgfrApB1ZEnzG6GS65XlB/u', '', 'USER', '', 0, 0, 0, 1, 0, NULL, '2020-03-02 23:34:39'),
(78, '2914525', 'Velma', 'Hand', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 1, 0, 0, 0, NULL, NULL),
(79, '2912277', 'Brad', 'Berge', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 1, 1, 1, 1, NULL, NULL),
(80, '2917890', 'Hattie', 'Murphy', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 0, 0, NULL, NULL),
(81, '2911037', 'Chadd', 'Gleichner', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 1, 1, NULL, NULL),
(82, '2917154', 'Cyril', 'Witting', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 0, 0, NULL, NULL),
(83, '2919058', 'Autumn', '', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 0, 0, NULL, NULL),
(84, '2918786', 'Ricky', 'Dibbert', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 0, 0, NULL, NULL),
(85, '2913945', 'Geraldine', 'Fisher', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 0, 0, NULL, NULL),
(86, '2919503', 'Stanton', 'Bashirian', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 0, 0, NULL, NULL),
(87, '2915136', 'Amira', 'Langosh', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 0, 0, NULL, NULL),
(88, '2915002', 'Rozella', 'Halvorson', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 1, 0, 0, 1, NULL, NULL),
(89, '2919534', 'Skyla', 'Paucek', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 0, 0, NULL, NULL),
(90, '2913034', 'Ryder', 'Herzog', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 1, 1, 0, NULL, NULL),
(91, '2919276', 'Davin', 'Hodkiewicz', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 0, 0, 0, 0, NULL, NULL),
(92, '2916266', 'Earnestine', 'Kunze', '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC', '', 'USER', '', 0, 1, 1, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_process`
--

CREATE TABLE `employee_process` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_process`
--

INSERT INTO `employee_process` (`id`, `user_id`, `process_id`, `created_at`, `updated_at`) VALUES
(1, 1, 18, NULL, NULL),
(2, 1, 17, NULL, NULL),
(3, 2, 7, NULL, NULL),
(4, 2, 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_01_29_074000_create_employees_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('jonathanmikko.romasanta.gf@j-display.com', '$2y$10$QqlFHiDMIh4SZPJ8k7UaNuLGowuH0x8NlITAdNv0lUXNI5vU.XBtm', '2020-02-26 16:40:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dept`
--

CREATE TABLE `tbl_dept` (
  `id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `department_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dept`
--

INSERT INTO `tbl_dept` (`id`, `department_name`, `department_status`) VALUES
(1, 'ADMIN', 'ACTIVE'),
(2, 'PRODUCT QUALITY', 'ACTIVE'),
(3, 'SUPPLIERS QUALITY CONTROL', 'ACTIVE'),
(4, 'COMMON QUALITY', 'ACTIVE'),
(5, 'MANAGEMENT SYSTEM', 'ACTIVE'),
(6, 'FINANCE', 'ACTIVE'),
(7, 'HR & GS', 'ACTIVE'),
(8, 'INFORMATION TECHNOLOGY', 'ACTIVE'),
(9, 'PRODUCTION PLANNING', 'ACTIVE'),
(10, 'PRODUCTION MANAGEMENT', 'ACTIVE'),
(11, 'PRODUCTION CONTROL', 'ACTIVE'),
(12, 'PROCUREMENT', 'ACTIVE'),
(13, 'ENGINEERING CONTROL', 'ACTIVE'),
(14, 'MANUFACTURING ENGINEERING', 'ACTIVE'),
(15, 'PRODUCTION IMPROVEMENT', 'ACTIVE'),
(16, 'REWORK & MATERIAL MANAGEMENT', 'ACTIVE'),
(17, 'FABRICATION', 'ACTIVE'),
(18, 'PROCESS', 'ACTIVE'),
(19, 'PRODUCTION', 'ACTIVE'),
(20, 'MANUFACTURING MANAGEMENT & CONTROL', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_div`
--

CREATE TABLE `tbl_div` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_div`
--

INSERT INTO `tbl_div` (`id`, `division_name`, `division_status`) VALUES
(1, 'PRESIDENT', 'ACTIVE'),
(2, 'QA', 'ACTIVE'),
(4, 'CMD', 'ACTIVE'),
(5, 'PPIC', 'ACTIVE'),
(6, 'MED', 'ACTIVE'),
(7, 'PID', 'ACTIVE'),
(8, 'PED', 'ACTIVE'),
(9, 'PRODUCTION', 'ACTIVE'),
(10, 'PROCUREMENT', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proc`
--

CREATE TABLE `tbl_proc` (
  `id` int(11) NOT NULL,
  `process_name` varchar(50) NOT NULL,
  `process_status` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `division_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_proc`
--

INSERT INTO `tbl_proc` (`id`, `process_name`, `process_status`, `division_id`, `department_id`) VALUES
(1, 'OQA (BE & MDL)', 'ACTIVE', 2, 2),
(2, 'Trial Production', 'ACTIVE', 2, 2),
(3, 'IQC', 'ACTIVE', 2, 3),
(4, 'SQM (Supplier Quality Management)', 'ACTIVE', 2, 3),
(5, 'IPQC', 'ACTIVE', 2, 4),
(6, 'Customer Service', 'ACTIVE', 2, 4),
(7, 'ORT & Calibration', 'ACTIVE', 2, 4),
(8, 'QMS & Product Environment', 'ACTIVE', 2, 5),
(9, 'Training & Qualification', 'ACTIVE', 2, 5),
(10, 'COSTING & INVENTORY', 'ACTIVE', 4, 6),
(11, 'GENERAL ACCOUNTING', 'ACTIVE', 4, 6),
(12, 'FIXED ASSET MANAGEMENT', 'ACTIVE', 4, 6),
(13, 'Human Resource', 'ACTIVE', 4, 7),
(14, 'Payroll', 'ACTIVE', 4, 7),
(15, 'Clinic', 'ACTIVE', 4, 7),
(16, 'GS & Security', 'ACTIVE', 4, 7),
(17, 'Environment & Safety', 'ACTIVE', 4, 7),
(18, 'Information Technology (IT)', 'ACTIVE', 4, 8),
(19, 'PRODUCTION MANAGEMENT', 'ACTIVE', 5, 10),
(20, 'PRODUCTION PLANNING', 'ACTIVE', 5, 9),
(21, 'PACKAGING & SHIPMENT', 'ACTIVE', 5, 9),
(22, 'PRODUCTION SYSTEM', 'ACTIVE', 5, 11),
(23, 'MATERIAL WAREHOUSE', 'ACTIVE', 5, 11),
(24, 'Direct Material (MRP, Opto - Electro Componets)', 'ACTIVE', 10, 12),
(25, 'Direct Material (Mechanical Components)', 'ACTIVE', 10, 12),
(26, 'Indirect Material (General Services)', 'ACTIVE', 10, 12),
(27, 'IMPEX', 'ACTIVE', 10, 12),
(28, 'Engineering Control', 'ACTIVE', 6, 13),
(29, 'Manufacturing Engineering', 'ACTIVE', 6, 14),
(30, 'Yield Planning', 'ACTIVE', 7, 15),
(31, 'Abnormality Control', 'ACTIVE', 7, 15),
(32, 'Loss Cost control', 'ACTIVE', 7, 16),
(33, 'MDL Rework', 'ACTIVE', 7, 16),
(34, 'BE Rework', 'ACTIVE', 7, 16),
(35, 'Process and Equipment', 'ACTIVE', 8, 18),
(36, 'Inspection', 'ACTIVE', 8, 18),
(37, 'Facility and PM', 'ACTIVE', 8, 18),
(38, 'Fabrication', 'ACTIVE', 8, 17),
(39, 'Jig Control', 'ACTIVE', 8, 17),
(40, 'SCRIBING Proces (1st&2nd)', 'ACTIVE', 9, 19),
(41, 'LC INJECTION', 'ACTIVE', 9, 19),
(42, 'POLARIZER ATTACHING', 'ACTIVE', 9, 19),
(43, 'BONDING Process', 'ACTIVE', 9, 19),
(44, 'SCREENFIT Process', 'ACTIVE', 9, 19),
(45, 'ASSEMBLY Process', 'ACTIVE', 9, 19),
(46, 'INSPECTION Process (BE&MDL)', 'ACTIVE', 9, 19),
(47, 'MMC (BE & MDL)', 'ACTIVE', 9, 20),
(48, 'Prod Training', 'ACTIVE', 9, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_process`
--
ALTER TABLE `employee_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `tbl_dept`
--
ALTER TABLE `tbl_dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_div`
--
ALTER TABLE `tbl_div`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_proc`
--
ALTER TABLE `tbl_proc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `employee_process`
--
ALTER TABLE `employee_process`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_dept`
--
ALTER TABLE `tbl_dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_div`
--
ALTER TABLE `tbl_div`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_proc`
--
ALTER TABLE `tbl_proc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
