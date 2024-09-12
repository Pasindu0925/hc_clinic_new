-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 07:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hc_clinic_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `app_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `doc_name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`app_id`, `p_id`, `doc_name`, `date`, `time`) VALUES
(1, 1, 'Dr.Ranil Wickramasinghe', '2024-09-09', '17:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doc_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doc_id`, `username`, `name`) VALUES
(1, '[d1@gmail.com]', '[Dr.Chandana Nawaratne]'),
(2, '[d2@gmail.com]', '[Dr.Ranil Wickramasinghe]'),
(3, '[d3@gmail.com]', '[Dr.Namal Rajapaksha]'),
(4, '[d4@gmail.com]', '[Dr.Anura Kumara Dissanayake]'),
(5, '[d5@gmail.com]', '[Dr.Sajith Premadasa]');

-- --------------------------------------------------------

--
-- Table structure for table `medical_info`
--

CREATE TABLE `medical_info` (
  `med_id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `diagnosis` text NOT NULL,
  `treatment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_info`
--

INSERT INTO `medical_info` (`med_id`, `p_id`, `diagnosis`, `treatment`) VALUES
(11, 2, 'PSDOKJG', 'ASPKJF');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `p_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `med_history` text NOT NULL,
  `insurance_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`p_id`, `username`, `name`, `dob`, `address`, `phone_number`, `med_history`, `insurance_details`) VALUES
(1, 'pasindu@gmail.com', 'Pasindu Jayathunga', '2003-09-25', '38 Dematagolla, Ukuwela', 714563256, 'Hypertension, Type 2 Diabetes, Hyperlipidemia', 'Blue Cross Blue Shield'),
(2, 'oshada@gmail.com', 'Oshada Herath', '2002-03-20', '38  Mulleriyawa Angoda', 715698563, 'Chronic Back Pain, Depression', 'Tricare'),
(3, 'osanda@gmail.com', 'Osanda Bandara', '2018-06-05', '124/A Katugasthota Kandy', 775698325, 'Gestational Diabetes (Previous Pregnancy), Iron Deficiency Anemia', 'Anthem'),
(4, 'sanuka@gmail.com', 'Sanuka Alles', '2024-09-09', '28 Thawalankoya Ukuwela', 714568792, 'Depression, Anxiety, Obesity', 'Cigna');

-- --------------------------------------------------------

--
-- Table structure for table `patient_records`
--

CREATE TABLE `patient_records` (
  `rec_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `vitals` text NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_records`
--

INSERT INTO `patient_records` (`rec_id`, `p_id`, `vitals`, `notes`) VALUES
(6, 1, 'godaaaakkk', 'dem dem'),
(7, 2, ',laskf', 'askjfv');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'r1@gmail.com', 'r1', '1'),
(2, 'r2@gmail.com', 'r2', '1'),
(3, 'n1@gmail.com', 'n1', '2'),
(4, 'n2@gmail.com', 'n2', '2'),
(5, 'n3@gmail.com', 'n3', '2'),
(6, 'n4@gmail.com', 'n4', '2'),
(7, 'n5@gmail.com', 'n5', '2'),
(8, 'd1@gmail.com', 'd1', '3'),
(9, 'd2@gmail.com', 'd2', '3'),
(10, 'd3@gmail.com', 'd3', '3'),
(11, 'd4@gmail.com', 'd4', '3'),
(12, 'd5@gmail.com', 'd5', '3'),
(16, 'pasindu@gmail.com', 'pat', '4'),
(17, 'oshada@gmail.com', 'pat', '4'),
(18, 'osanda@gmail.com', 'pat', '4'),
(19, 'sanuka@gmail.com', 'pat', '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `fk_p_id` (`p_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `medical_info`
--
ALTER TABLE `medical_info`
  ADD PRIMARY KEY (`med_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `patient_records`
--
ALTER TABLE `patient_records`
  ADD PRIMARY KEY (`rec_id`),
  ADD KEY `fk_patient_records_p_id` (`p_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medical_info`
--
ALTER TABLE `medical_info`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_records`
--
ALTER TABLE `patient_records`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_p_id` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`);

--
-- Constraints for table `medical_info`
--
ALTER TABLE `medical_info`
  ADD CONSTRAINT `medical_info_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`);

--
-- Constraints for table `patient_records`
--
ALTER TABLE `patient_records`
  ADD CONSTRAINT `fk_patient_records_p_id` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



ALTER TABLE `appointments`
ADD COLUMN `status` VARCHAR(20) NOT NULL DEFAULT 'Ongoing';
