-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2026 at 12:05 PM
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
(1, 3, 'Lubogan', 1, '2026-04-02 04:02:08', '2026-04-02 04:02:08'),
(2, 1, 'Baliok', 1, '2026-04-02 04:02:26', '2026-04-02 04:02:26'),
(3, 3, 'Bankas Heights', 1, '2026-04-02 04:02:53', '2026-04-02 04:02:53');

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
(1, 2, 'Shekinah Berry Rosalita', 11, 'Daughter', '2014-07-26', 'Shairah Sophie Rosalita', 10, 'Daughter', '2016-02-15', 'John Virgil Rosalita', 6, 'Son', '2019-05-12', '', 0, '', '2010-02-21');

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
(1, 2, 0, 0, '');

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
(1, 2, 'Davao', 1, '2026-04-02 03:59:26', '2026-04-02 03:59:26'),
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
(1, 2, '', '', '', '', 'Cebuano');

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

CREATE TABLE `contact_information` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `fb` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`id`, `user_id`, `contact`, `fb`) VALUES
(1, 2, '09104374372', 'Prinaniel Rosalita');

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
(2, 1, '2nd District', 1, '2026-04-02 04:01:03', '2026-04-02 04:01:25'),
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
(1, 2, 'College Graduate', 'Teacher 1', 'teaching', 'TULCI');

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
(1, 2, 'Virgil Rosalita', '09096400461', 'Purok 1 Lubogan, Toril');

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
(1, 2, 'Primitivo Alferez', 'Peregrina Alferez', 'Virgil Rosalita');

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
(1, 2, '37232dd', 'kd923', '92ldl', 'ospdk32', '1567176', '', '', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `personal_information`
--

CREATE TABLE `personal_information` (
  `id` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `region` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `purok` varchar(100) NOT NULL,
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

INSERT INTO `personal_information` (`id`, `nickname`, `suffix`, `region`, `province`, `city`, `district`, `barangay`, `purok`, `zipcode`, `birthdate`, `birthplace`, `age`, `civilstatus`, `gender`, `nationality`, `country`, `religion`, `bloodtype`, `height`, `weight`, `user_id`) VALUES
(1, 'dimple', '', 'Region XI', 'Davao del Sur', 'Davao', 'Third', 'Lubogan', 'Purok 1-A', '8000', '1990-07-14', 'Bankas Heights, Toril', 35, 'Married', 'Female', 'Filipino', 'Philippines', 'Missionary Baptist', 'B+', '145', '54', 2);

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
(4, 3, 'Davao de Oro', 1, '2026-04-02 03:58:15', '2026-04-02 03:58:15'),
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
(2, 1, '1-B', 1, '2026-04-02 04:03:41', '2026-04-02 04:03:41');

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
(1, 'Region IX', '2026-04-02 03:56:03', '2026-04-02 03:56:03', 1),
(2, 'Region X', '2026-04-02 03:56:15', '2026-04-02 03:56:15', 1),
(3, 'Region XI', '2026-04-02 03:56:23', '2026-04-02 03:56:23', 1),
(4, 'Region XII', '2026-04-02 03:56:36', '2026-04-02 03:56:36', 1),
(5, 'Region XIII', '2026-04-02 03:56:50', '2026-04-02 03:56:50', 1),
(6, 'BARMM', '2026-04-02 03:57:03', '2026-04-02 03:57:03', 1);

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
(2, 'Prinaniel', 'Alferez', 'Rosalita', 'prinaniel.e.a.rosalita@gmail.com', '', '', '', '', 1, '2026-03-20 17:37:49', '2026-03-20 17:37:49');

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
(1, 2, 'member', '', '', 'nonpaying');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `community_information`
--
ALTER TABLE `community_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_information`
--
ALTER TABLE `contact_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `education_occupation`
--
ALTER TABLE `education_occupation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `family_background`
--
ALTER TABLE `family_background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `government_id`
--
ALTER TABLE `government_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_information`
--
ALTER TABLE `personal_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
