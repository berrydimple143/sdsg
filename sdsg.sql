-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2026 at 07:56 AM
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
-- Database: `sdsg`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `district_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Lubogan', 1, '2026-04-02 04:02:08', '2026-04-07 08:40:18'),
(2, 1, 'Baliok', 1, '2026-04-02 04:02:26', '2026-04-08 01:38:34'),
(3, 3, 'Bankas Heights', 1, '2026-04-02 04:02:53', '2026-04-02 06:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `benname1` varchar(100) NOT NULL,
  `benage1` int(3) NOT NULL,
  `benrelationship1` varchar(20) NOT NULL,
  `benbirthdate1` date NOT NULL,
  `benname2` varchar(100) NOT NULL,
  `benage2` int(3) NOT NULL,
  `benrelationship2` varchar(20) NOT NULL,
  `benbirthdate2` date NOT NULL,
  `benname3` varchar(100) NOT NULL,
  `benage3` int(3) NOT NULL,
  `benrelationship3` varchar(20) NOT NULL,
  `benbirthdate3` date NOT NULL,
  `benname4` varchar(100) NOT NULL,
  `benage4` int(3) NOT NULL,
  `benrelationship4` varchar(20) NOT NULL,
  `benbirthdate4` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `user_id`, `benname1`, `benage1`, `benrelationship1`, `benbirthdate1`, `benname2`, `benage2`, `benrelationship2`, `benbirthdate2`, `benname3`, `benage3`, `benrelationship3`, `benbirthdate3`, `benname4`, `benage4`, `benrelationship4`, `benbirthdate4`) VALUES
(1, 2, 'Shekinah Berry Rosalita', 11, 'Daughter', '2014-07-26', 'Shairah Sophie Rosalita', 10, 'Daughter', '2016-02-15', 'John Virgil Rosalita', 6, 'Son', '2019-05-12', '', 0, '', '2010-02-21'),
(2, 3, 'Primitivo Alferez, Jr.', 60, 'Father', '1969-07-20', 'Peregrina E. Alferez', 58, 'Mother', '1972-05-16', '', 0, '', '2010-02-21', '', 0, '', '2010-02-21'),
(3, 4, 'Charles Rosalita', 18, 'Son', '2010-02-21', 'Saicha Chenyll Rosalita', 16, 'Daughter', '2010-02-21', 'Prince Jasper Rosalita', 12, 'Son', '2010-02-21', '', 0, '', '2010-02-21'),
(4, 5, 'Blake Rosalita', 2, 'Son', '2024-04-05', 'Beah Mae Rosalita', 6, 'Daughter', '2019-11-27', 'Breena S. Rosalita', 11, 'Daughter', '2014-03-03', '', 0, '', '2010-02-21'),
(5, 6, 'Bernice Sofia M. Rosalita', 4, 'Daughter', '2010-02-21', '', 0, '', '2010-02-21', '', 0, '', '2010-02-21', '', 0, '', '2010-02-21'),
(6, 17, '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01'),
(7, 18, 'Hello', 2, 'Daughter', '2026-04-16', 'Hi', 4, 'Daughter', '2026-04-16', 'Some', 6, 'Son', '2026-04-18', '', 0, '', '1970-01-01'),
(8, 19, '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01'),
(9, 20, '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01'),
(10, 21, '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01'),
(11, 22, '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01'),
(12, 23, '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01', '', 0, '', '1970-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `insurance` int(4) NOT NULL,
  `burial` int(4) NOT NULL,
  `courseToAvail` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `benefits`
--

INSERT INTO `benefits` (`id`, `user_id`, `insurance`, `burial`, `courseToAvail`) VALUES
(1, 2, 0, 0, ''),
(2, 3, 50, 50, 'Bachelor of Arts in Accountancy'),
(3, 4, 50, 50, 'Automotive'),
(4, 5, 50, 50, 'Bachelor of Science in Criminology'),
(5, 6, 50, 50, 'Bachelor of Science in Computer Science'),
(6, 17, 50, 50, ''),
(7, 18, 50, 50, 'BS Computer Science'),
(8, 19, 50, 50, 'Bachelor of Criminology'),
(9, 20, 50, 50, ''),
(10, 21, 50, 50, ''),
(11, 22, 50, 50, ''),
(12, 23, 50, 50, '');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `province_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Davao', 1, '2026-04-02 03:59:26', '2026-04-02 06:45:55'),
(2, 2, 'Digos', 1, '2026-04-02 03:59:48', '2026-04-02 03:59:48'),
(3, 2, 'Sta. Cruz', 1, '2026-04-02 04:00:08', '2026-04-02 04:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `community_information`
--

CREATE TABLE `community_information` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chairman` varchar(100) NOT NULL,
  `area` varchar(254) NOT NULL,
  `mcnumber` varchar(50) NOT NULL,
  `classification` varchar(100) NOT NULL,
  `tribe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_information`
--

INSERT INTO `community_information` (`id`, `user_id`, `chairman`, `area`, `mcnumber`, `classification`, `tribe`) VALUES
(1, 2, '', '', '', '', 'Cebuano'),
(2, 3, 'Virgil Rosalita', '', '', 'IP&#039;s', 'Muslim'),
(3, 4, 'Virgil Rosalita', 'Lubogan, Toril', '93923478', '4P&#039;s', 'Muslim'),
(4, 5, 'Virgil Rosalita', 'Lubogan', '93283', '4P&#039;s', 'Cebuano'),
(5, 6, 'Virgil Rosalita', 'Lubogan, Toril', '3920938', 'IP&#039;s', 'Muslim'),
(6, 17, '', '', '', '', ''),
(7, 18, 'Virgil Rosalita', '', '', 'IP&#039;s', 'Muslim'),
(8, 19, '', '', '', '', ''),
(9, 20, '', '', '', '4P&#039;s', 'Cebuano'),
(10, 21, '', '', '', '4P&#039;s', 'Muslim'),
(11, 22, '', '', '', '', 'Muslim'),
(12, 23, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

CREATE TABLE `contact_information` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `fb` varchar(254) NOT NULL,
  `photo` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`id`, `user_id`, `contact`, `fb`, `photo`) VALUES
(1, 2, '09104374372', 'Prinaniel Rosalita', ''),
(2, 3, '092304234884', 'Prine Alferez', ''),
(3, 4, '09342384923', 'Benny Rosalita', ''),
(4, 5, '0923482839', 'Benjie Rosalita', ''),
(5, 6, '0934884893', 'Bernie Rosalita', ''),
(6, 17, '', '', ''),
(7, 18, '03942383', 'Kinah Rosalita', ''),
(8, 19, '', '', ''),
(9, 20, '0938392833', '', 'John VJ-Rosalita-2026-3-12-15-3-27.png'),
(10, 21, '', '', 'Sidison-Tecson-2026-3-14-15-25-55.png'),
(11, 22, '', '', '--2026-3-14-15-37-29.png'),
(12, 23, '', '', 'zx-xx-2026-3-15-0-8-35.png');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `city_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1st District', 1, '2026-04-02 04:00:51', '2026-04-02 04:01:16'),
(2, 1, '2nd District', 1, '2026-04-02 04:01:03', '2026-04-02 06:46:46'),
(3, 1, '3rd District', 1, '2026-04-02 04:01:36', '2026-04-02 04:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `education_occupation`
--

CREATE TABLE `education_occupation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `education` varchar(254) NOT NULL,
  `position` varchar(254) NOT NULL,
  `skill` varchar(254) NOT NULL,
  `organization` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_occupation`
--

INSERT INTO `education_occupation` (`id`, `user_id`, `education`, `position`, `skill`, `organization`) VALUES
(1, 2, 'College Graduate', 'Teacher 1', 'teaching', 'TULCI'),
(2, 3, 'College Graduate', 'Senior Bank Teller', 'Bookkeeping', 'EastWest Bank, Toril Branch'),
(3, 4, 'High School Graduate', 'Welder', 'welding, auto repair', 'Freelancer'),
(4, 5, 'Vocational', 'Welder', 'welding, landscaping', 'BF Industries, Inc.'),
(5, 6, 'College Graduate', 'Vet. Doctor', 'farming, injecting', 'TheBerns Animal Clinic'),
(6, 17, '', '', '', ''),
(7, 18, 'High School Graduate', 'Nothing', 'computer', 'Freelancer'),
(8, 19, 'College Graduate', '', '', ''),
(9, 20, 'High School Graduate', 'Technician 1', 'electronics', 'Globe'),
(10, 21, 'Vocational', '', '', ''),
(11, 22, 'College Graduate', 'Teacher 1', 'teaching', 'DepEd Cebu'),
(12, 23, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contact`
--

CREATE TABLE `emergency_contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contactname` varchar(100) NOT NULL,
  `contactnumber` varchar(20) NOT NULL,
  `contactaddress` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_contact`
--

INSERT INTO `emergency_contact` (`id`, `user_id`, `contactname`, `contactnumber`, `contactaddress`) VALUES
(1, 2, 'Virgil Rosalita', '09096400461', 'Purok 1 Lubogan, Toril'),
(2, 3, 'Peregrina Alferez', '09342348923', 'Bankas Heights, Toril, Davao City'),
(3, 4, 'Michelle Rosalita', '0934238293', 'Purok 1-A Lubogan, Toril, Davao City'),
(4, 5, 'Leah Mae S. Rosalita', '093248239', 'Lubogan, Toril'),
(5, 6, 'Bernadine M. Rosalita', '039428302i', 'Puan, Davao City'),
(6, 17, '', '', ''),
(7, 18, 'Virgil Rosalita', '09342388', 'Lubogan, Toril'),
(8, 19, '', '', ''),
(9, 20, 'Shane Tecson', '09342838', 'Lapu-lapu City, Cebu'),
(10, 21, '', '', ''),
(11, 22, '', '', ''),
(12, 23, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `family_background`
--

CREATE TABLE `family_background` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `father` varchar(100) NOT NULL,
  `mother` varchar(100) NOT NULL,
  `spouse` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family_background`
--

INSERT INTO `family_background` (`id`, `user_id`, `father`, `mother`, `spouse`) VALUES
(1, 2, 'Primitivo Alferez', 'Peregrina Alferez', 'Virgil Rosalita'),
(2, 3, 'Primitivo L. Alferez, Jr.', 'Peregrina E. Alferez', 'N/A'),
(3, 4, 'Benjamin Rosalita', 'Virginia T. Rosalita', 'Michelle C. Rosalita'),
(4, 5, 'Benjamin Rosalita', 'Virginia T. Rosalita', 'Leah Mae S. Rosalita'),
(5, 6, 'Benjamin Rosalita', 'Virginia Rosalita', 'Bernadine M. Rosalita'),
(6, 17, '', '', ''),
(7, 18, 'Virgil Rosalita', 'Prinaniel A. Rosalita', 'N/A'),
(8, 19, '', '', ''),
(9, 20, 'Isidro Tecson', 'Florita Diaz Tecson', 'Shane Tecson'),
(10, 21, '', '', ''),
(11, 22, '', '', ''),
(12, 23, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `government_id`
--

CREATE TABLE `government_id` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sss` varchar(20) NOT NULL,
  `philhealth` varchar(20) NOT NULL,
  `voter` varchar(20) NOT NULL,
  `passport` varchar(30) NOT NULL,
  `profid` varchar(20) NOT NULL,
  `pagibig` varchar(20) NOT NULL,
  `license` varchar(20) NOT NULL,
  `senior` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `government_id`
--

INSERT INTO `government_id` (`id`, `user_id`, `sss`, `philhealth`, `voter`, `passport`, `profid`, `pagibig`, `license`, `senior`) VALUES
(1, 2, '37232dd', 'kd923', '92ldl', 'ospdk32', '1567176', '', '', ''),
(2, 3, '234234', '432', '343423', '4234', '5234234', '3425234', '4234234', '634545'),
(3, 4, '3423424', '52342', '2344', '', '334234', '324', '34234', ''),
(4, 5, '092393938', '0394238383', '3304-B', '', '', '', 'L02-132820', ''),
(5, 6, '039484848', '03939338', '3304-B', '393293', '3729393', '03482732', 'L01-201483822', ''),
(6, 17, '', '', '', '', '', '', '', ''),
(7, 18, '', '', '', '', '', '', '', ''),
(8, 19, '', '', '', '', '', '', '', ''),
(9, 20, '', '', '', '', '', '', '', ''),
(10, 21, '', '', '', '', '', '', '', ''),
(11, 22, '', '', '', '', '', '', '', ''),
(12, 23, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 6, 100, '2026-04-08 03:52:18', '2026-04-08 03:52:18'),
(2, 3, 100, '2026-04-08 03:53:11', '2026-04-08 03:53:11'),
(3, 2, 100, '2026-04-08 03:54:29', '2026-04-08 03:54:29'),
(4, 3, 100, '2026-04-18 02:55:04', '2026-04-18 02:55:04'),
(6, 4, 100, '2026-04-08 03:58:07', '2026-04-08 03:58:07'),
(7, 2, 100, '2026-04-09 02:23:00', '2026-04-09 02:23:00'),
(9, 4, 100, '2026-04-08 04:05:11', '2026-04-08 04:05:11'),
(10, 6, 100, '2026-04-08 04:09:57', '2026-04-08 04:09:57'),
(12, 5, 100, '2026-04-04 02:14:21', '2026-04-04 02:14:21'),
(14, 19, 150, '2026-04-08 04:32:19', '2026-04-09 21:39:43'),
(15, 18, 110, '2026-04-08 06:10:33', '2026-04-13 09:29:09'),
(16, 17, 100, '2026-04-08 06:10:46', '2026-04-08 06:10:46'),
(17, 17, 100, '2026-04-08 06:15:16', '2026-04-08 06:15:16'),
(20, 6, 100, '2026-04-08 07:15:39', '2026-04-08 07:15:39'),
(23, 18, 100, '2026-04-08 07:25:44', '2026-04-08 07:25:44'),
(24, 18, 100, '2026-03-18 10:29:26', '2026-03-18 10:29:26'),
(26, 19, 180, '2026-04-10 03:48:52', '2026-04-09 21:41:50'),
(27, 19, 115.65, '2026-04-30 03:49:42', '2026-04-09 23:52:07'),
(28, 5, 100, '2024-07-10 03:55:30', '2024-07-10 03:55:30'),
(29, 4, 100, '2026-04-10 03:57:50', '2026-04-10 03:57:50'),
(30, 19, 190, '2026-04-29 04:59:13', '2026-04-29 04:59:13'),
(31, 19, 150, '2026-05-13 06:40:02', '2026-05-13 06:40:02'),
(32, 19, 250, '2026-04-10 06:43:28', '2026-04-10 06:43:28'),
(33, 19, 100, '2026-05-16 06:43:41', '2026-04-10 00:05:27'),
(34, 22, 150, '2026-04-14 08:42:20', '2026-04-14 01:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `personal_information`
--

CREATE TABLE `personal_information` (
  `id` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `region_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `purok_id` int(11) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(254) NOT NULL,
  `age` int(3) NOT NULL,
  `civilstatus` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `country` varchar(30) NOT NULL,
  `religion` varchar(200) NOT NULL,
  `bloodtype` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_information`
--

INSERT INTO `personal_information` (`id`, `nickname`, `suffix`, `region_id`, `province_id`, `city_id`, `district_id`, `barangay_id`, `purok_id`, `zipcode`, `birthdate`, `birthplace`, `age`, `civilstatus`, `gender`, `nationality`, `country`, `religion`, `bloodtype`, `height`, `weight`, `user_id`) VALUES
(1, 'dimple', '', 3, 2, 1, 3, 1, 1, '8000', '1990-07-14', 'Bankas Heights, Toril', 35, 'Married', 'Female', 'Filipino', 'Philippines', 'Missionary Baptist', 'B+', '145', '54', 2),
(2, 'Gang2x', '', 3, 2, 1, 3, 1, 1, '8000', '1995-05-07', 'Bankas Heights', 31, 'Single', 'Female', 'Filipino', 'Philippines', 'Missionary Baptist', 'A+', '140', '45', 3),
(3, 'Kiboy', 'Jr.', 3, 2, 1, 3, 1, 1, '8000', '1983-04-23', 'Lubogan, Toril, Davao City', 43, 'Married', 'Male', 'Filipino', 'Philippines', 'Baptist', 'O+', '155', '58', 4),
(4, 'Benj', 'Sr.', 3, 2, 1, 3, 1, 1, '8000', '1980-08-18', 'Lubogan, Toril', 45, 'Married', 'Male', 'Filipino', 'Philippines', 'Baptist', 'B+', '160', '64', 5),
(5, 'Ekoy', 'Sr.', 3, 2, 1, 3, 1, 1, '8000', '1990-07-14', 'Lubogan, Toril', 35, 'Married', 'Male', 'Filipino', 'Philippines', 'Baptist', 'O+', '157', '65', 6),
(6, '', '1', 1, 1, 1, 1, 1, 1, '', '1970-01-01', '', 44, 'Married', 'Male', '', '', '', '', '', '', 17),
(7, 'Kinah', '', 3, 2, 1, 3, 1, 1, '8000', '2026-04-21', 'Lubogan', 11, 'Single', 'Female', 'Filipino', 'Philippines', 'Missionary Baptist', 'O+', '122', '33', 18),
(8, 'Jeff', 'Sr.', 3, 2, 1, 3, 1, 1, '8000', '2023-10-11', 'Lubogan', 34, 'Married', 'Male', 'Filipino', 'Philippines', 'Missionary Baptist', 'AB+', '134', '34', 19),
(9, 'Dodot', 'Sr.', 3, 2, 1, 3, 1, 1, '8000', '1982-02-21', 'Lubogan, Toril', 42, 'Married', 'Male', 'Filipino', 'Philippines', 'Roman Catholic', 'O+', '165', '65', 20),
(10, 'Dison', 'Jr.', 3, 2, 1, 3, 1, 1, '8000', '1994-02-16', '', 38, 'Married', 'Male', 'Filipino', 'Philippines', '', 'AB+', '', '', 21),
(11, 'Bayot', 'Jr.', 3, 2, 1, 3, 1, 1, '8000', '2026-04-16', '', 41, 'Single', 'Male', 'Filipino', 'Philippines', '', 'AB+', '', '', 22),
(12, '', '', 3, 2, 1, 3, 1, 1, '8000', '2026-04-06', '', 0, 'Married', 'Male', 'Filipino', 'Philippines', '', 'O-', '', '', 23);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `region_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Davao del Norte', 1, '2026-04-02 03:57:25', '2026-04-02 03:57:25'),
(2, 3, 'Davao del Sur', 1, '2026-04-02 03:57:46', '2026-04-02 03:57:46'),
(3, 3, 'Davao Oriental', 1, '2026-04-02 03:57:55', '2026-04-02 03:57:55'),
(4, 3, 'Davao de Oro', 1, '2026-04-02 03:58:15', '2026-04-02 06:45:00'),
(5, 3, 'Davao Occidental', 1, '2026-04-02 03:58:31', '2026-04-02 03:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `puroks`
--

CREATE TABLE `puroks` (
  `id` int(11) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `puroks`
--

INSERT INTO `puroks` (`id`, `barangay_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1-A', 1, '2026-04-02 04:03:27', '2026-04-02 04:03:27'),
(2, 1, '1-B', 1, '2026-04-02 04:03:41', '2026-04-02 06:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Region IX', '2026-04-02 03:56:03', '2026-04-13 16:01:57', 1),
(2, 'Region X', '2026-04-02 03:56:15', '2026-04-02 03:56:15', 1),
(3, 'Region XI', '2026-04-02 03:56:23', '2026-04-02 03:56:23', 1),
(4, 'Region XII', '2026-04-02 03:56:36', '2026-04-02 06:43:46', 1),
(5, 'Region XIII', '2026-04-02 03:56:50', '2026-04-02 06:43:30', 1),
(6, 'BARMM', '2026-04-02 03:57:03', '2026-04-10 02:21:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(254) NOT NULL,
  `middlename` varchar(254) NOT NULL,
  `lastname` varchar(254) NOT NULL,
  `email` varchar(254) NOT NULL,
  `username` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `username`, `password`, `phone`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Virgil', 'Tecson', 'Rosalita', 'shekinahberry143@gmail.com', 'berrydimple', '$2y$10$SR4hAD/ePjWHxtuq7My7b.jadSE18LzThTh3CePNccj30a2Zxkb2q', '2253844', '09096400461', 1, '2026-03-20 01:27:17', '2026-03-20 01:27:17'),
(2, 'Prinaniel', 'Alferez', 'Rosalita', 'prinaniel.e.a.rosalita@gmail.com', '', '', '', '', 1, '2026-03-20 17:37:49', '2026-04-08 04:11:07'),
(3, 'Prine', 'Erediano', 'Alferez', 'prine.e.alferez@gmail.com', '', '', '', '', 1, '2026-04-07 07:48:37', '2026-04-08 03:15:09'),
(4, 'Benny', 'Tecson', 'Rosalita', 'benros@gmail.com', '', '', '', '', 1, '2026-04-07 07:58:44', '2026-04-10 03:57:50'),
(5, 'Benjie', 'Tecson', 'Rosalita', 'benrossa@gmail.com', '', '', '', '', 1, '2026-04-07 08:16:58', '2026-04-10 03:30:26'),
(6, 'Bernie', 'Tecson', 'Rosalita', 'bernros@gmail.com', '', '', '', '', 1, '2026-04-07 08:23:09', '2026-04-10 03:40:51'),
(7, 'Vdks', '', 'Rosalita', '', '', '', '', '', 1, '2026-04-07 21:53:19', '2026-04-07 21:53:19'),
(8, 'Vdks', '', 'Rosalita', '', '', '', '', '', 1, '2026-04-07 21:57:59', '2026-04-07 21:57:59'),
(9, 'Vdks', '', 'Rosalita', '', '', '', '', '', 1, '2026-04-07 21:59:37', '2026-04-07 21:59:37'),
(10, 'John Jacob', 'Alferez', 'Rosalita', 'jj@gmail.com', '', '', '', '', 1, '2026-04-07 22:03:33', '2026-04-07 22:03:33'),
(11, 'John Jacob', 'Alferez', 'Rosalita', 'jj@gmail.com', '', '', '', '', 1, '2026-04-07 22:03:57', '2026-04-07 22:03:57'),
(12, 'John Jacob', 'Alferez', 'Rosalita', 'jj@gmail.com', '', '', '', '', 1, '2026-04-07 22:04:45', '2026-04-07 22:04:45'),
(13, 'Vdks', '', 'Rosalita', '', '', '', '', '', 1, '2026-04-07 22:06:22', '2026-04-07 22:06:22'),
(14, 'Shekinah Berry', 'Alferez', 'Rosalita', 'shekinahberry@gmail.com', '', '', '', '', 1, '2026-04-07 22:13:29', '2026-04-07 22:13:29'),
(15, 'Shekinah Berry', 'Alferez', 'Rosalita', 'shekinahberry@gmail.com', '', '', '', '', 1, '2026-04-07 22:13:40', '2026-04-07 22:13:40'),
(16, 'Shekinah Berry sdfadf', 'Alferez', 'Rosalita', 'shekinahberry@gmail.com', '', '', '', '', 1, '2026-04-07 22:23:28', '2026-04-07 22:23:28'),
(17, 'Vdkxcvxcs', '', 'Rosalita', '', '', '', '', '', 1, '2026-04-07 22:25:31', '2026-04-10 03:40:36'),
(18, 'Shekinah Berry sdfadf', 'Alferez', 'Rosalita', 'shekinahberry@gmail.com', '', '', '', '', 1, '2026-04-07 22:26:16', '2026-04-11 03:53:48'),
(19, 'Jeffrey', 'Anuta', 'Egloso', '', '', '', '', '', 1, '2026-04-07 22:29:48', '2026-04-12 06:47:02'),
(20, 'Shedron', 'Diaz', 'Tecson', '', '', '', '', '', 1, '2026-04-14 01:17:50', '2026-04-14 01:17:50'),
(21, 'Sidison', 'Diaz', 'Tecson', '', '', '', '', '', 1, '2026-04-14 01:26:19', '2026-04-14 01:26:19'),
(22, 'Cedric', 'Diaz', 'Tecson', '', '', '', '', '', 1, '2026-04-14 01:39:27', '2026-04-14 08:42:20'),
(23, 'zx', '', 'xx', '', '', '', '', '', 1, '2026-04-14 10:09:33', '2026-04-14 10:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mtype` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `classification` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_id`, `mtype`, `position`, `designation`, `classification`) VALUES
(1, 2, 'member', '', '', 'paying'),
(2, 3, 'member', '', '', 'paying'),
(3, 4, 'member', '', '', 'paying'),
(4, 5, 'member', '', '', 'paying'),
(5, 6, 'member', '', '', 'paying'),
(6, 17, 'member', '', '', 'paying'),
(7, 18, 'member', '', '', 'paying'),
(8, 19, 'member', '', '', 'paying'),
(9, 20, 'member', '', '', 'paying'),
(10, 21, 'member', '', '', 'paying'),
(11, 22, 'member', '', '', 'paying'),
(12, 23, 'member', '', '', 'paying');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_information`
--
ALTER TABLE `community_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_information`
--
ALTER TABLE `contact_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_occupation`
--
ALTER TABLE `education_occupation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_background`
--
ALTER TABLE `family_background`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `government_id`
--
ALTER TABLE `government_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_information`
--
ALTER TABLE `personal_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `puroks`
--
ALTER TABLE `puroks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `community_information`
--
ALTER TABLE `community_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_information`
--
ALTER TABLE `contact_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `education_occupation`
--
ALTER TABLE `education_occupation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `family_background`
--
ALTER TABLE `family_background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `government_id`
--
ALTER TABLE `government_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `personal_information`
--
ALTER TABLE `personal_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `puroks`
--
ALTER TABLE `puroks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
