-- Create a new database
CREATE DATABASE IF NOT EXISTS `hc_clinic_new`;
USE `hc_clinic_new`;

-- Table structure for `patients`
CREATE TABLE `patients` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `med_history` text NOT NULL,
  `insurance_details` text NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `patients`
INSERT INTO `patients` (`username`, `name`, `dob`, `address`, `phone_number`, `med_history`, `insurance_details`) VALUES
('pasindu@gmail.com', 'Pasindu Jayathunga', '2003-09-25', '38 Dematagolla, Ukuwela', 714563256, 'Hypertension, Type 2 Diabetes, Hyperlipidemia', 'Blue Cross Blue Shield'),
('oshada@gmail.com', 'Oshada Herath', '2002-03-20', '38  Mulleriyawa Angoda', 715698563, 'Chronic Back Pain, Depression', 'Tricare'),
('osanda@gmail.com', 'Osanda Bandara', '2018-06-05', '124/A Katugasthota Kandy', 775698325, 'Gestational Diabetes (Previous Pregnancy), Iron Deficiency Anemia', 'Anthem'),
('sanuka@gmail.com', 'Sanuka Alles', '2024-09-09', '28 Thawalankoya Ukuwela', 714568792, 'Depression, Anxiety, Obesity', 'Cigna'),
('shehan@gmail.com', 'Shehan Herath', '2024-09-08', 'Ukuwela', 714569872, 'none', 'none');

-- Table structure for `appointments`
CREATE TABLE `appointments` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(100) NOT NULL,
  `doc_name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` enum('Ongoing','Completed') NOT NULL DEFAULT 'Ongoing',
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `appointments`
INSERT INTO `appointments` (`patient_name`, `doc_name`, `date`, `time`, `status`) VALUES
('Pasindu Jayathunga', 'Dr.Ranil Wickramasinghe', '2024-09-09', '17:24:00', 'Ongoing'),
('Oshada Herath', 'Dr.Chandana Nawaratne', '2024-09-13', '00:14:00', 'Completed'),
('Osanda Bandara', 'Dr.Chandana Nawaratne', '2024-09-24', '01:45:00', 'Ongoing');

-- Table structure for `doctors`
CREATE TABLE `doctors` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `doctors`
INSERT INTO `doctors` (`username`, `name`) VALUES
('d1@gmail.com', 'Dr.Chandana Nawaratne'),
('d2@gmail.com', 'Dr.Ranil Wickramasinghe'),
('d3@gmail.com', 'Dr.Namal Rajapaksha'),
('d4@gmail.com', 'Dr.Anura Kumara Dissanayake'),
('d5@gmail.com', 'Dr.Sajith Premadasa');

-- Table structure for `patient_records`
CREATE TABLE `patient_records` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(100) NOT NULL,
  `vitals` text NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`rec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `patient_records`
INSERT INTO `patient_records` (`patient_name`, `vitals`, `notes`) VALUES
('Pasindu Jayathunga', 'godaaaakkk', 'dem dem'),
('Oshada Herath', ',laskf', 'askjfv'),
('Pasindu Jayathunga', 'sdlkgj', 'sdlkgf'),
('Osanda Bandara', 'laskjnfc', 'aslkjnf');

-- Table structure for `medical_info`
CREATE TABLE `medical_info` (
  `med_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(100) NOT NULL,
  `diagnosis` text NOT NULL,
  `treatment` text NOT NULL,
  PRIMARY KEY (`med_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `medical_info`
INSERT INTO `medical_info` (`patient_name`, `diagnosis`, `treatment`) VALUES
('Oshada Herath', 'PSDOKJG', 'ASPKJF'),
('Osanda Bandara', '', ''),
('Sanuka Alles', '', ''),
('Osanda Bandara', ';zxlvg', ';zdslmv'),
('Shehan Herath', 'yes', 'yes');

-- Table structure for `user`
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `role` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for `user`
INSERT INTO `user` (`username`, `password`, `role`) VALUES
('r1@gmail.com', 'r1', '1'),
('r2@gmail.com', 'r2', '1'),
('n1@gmail.com', 'n1', '2'),
('n2@gmail.com', 'n2', '2'),
('n3@gmail.com', 'n3', '2'),
('n4@gmail.com', 'n4', '2'),
('n5@gmail.com', 'n5', '2'),
('d1@gmail.com', 'd1', '3'),
('d2@gmail.com', 'd2', '3'),
('d3@gmail.com', 'd3', '3'),
('d4@gmail.com', 'd4', '3'),
('d5@gmail.com', 'd5', '3'),
('pasindu@gmail.com', 'pat', '4'),
('oshada@gmail.com', 'pat', '4'),
('osanda@gmail.com', 'pat', '4'),
('sanuka@gmail.com', 'pat', '4'),
('shehan@gmail.com', 'pat', '4');

-- Indexes for tables
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`app_id`);

ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doc_id`);

ALTER TABLE `patient_records`
  ADD PRIMARY KEY (`rec_id`);

ALTER TABLE `medical_info`
  ADD PRIMARY KEY (`med_id`);

ALTER TABLE `patients`
  ADD PRIMARY KEY (`p_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for tables
ALTER TABLE `appointments`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `doctors`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `medical_info`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `patients`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `patient_records`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





Error
SQL query: Copy


-- Table structure for `patients`
CREATE TABLE `patients` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `med_history` text NOT NULL,
  `insurance_details` text NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
MySQL said: Documentation

#1050 - Table 'patients' already exists