-- Update the appointments table to store patient names instead of patient IDs
ALTER TABLE `appointments`
DROP FOREIGN KEY `fk_p_id`; -- Drop the foreign key constraint first

ALTER TABLE `appointments`
CHANGE COLUMN `p_id` `patient_name` VARCHAR(100) NOT NULL;

-- Remove the status column (if still present)
ALTER TABLE `appointments`
DROP COLUMN `status`;

-- Ensure patient names in patient_records are from appointments table
ALTER TABLE `patient_records`
ADD COLUMN `patient_name` VARCHAR(100) NOT NULL AFTER `rec_id`;

UPDATE `patient_records` pr
JOIN `appointments` a ON pr.p_id = a.p_id
SET pr.patient_name = (SELECT name FROM `patients` WHERE `p_id` = a.p_id);

ALTER TABLE `patient_records`
DROP FOREIGN KEY `fk_patient_records_p_id`;

ALTER TABLE `patient_records`
DROP COLUMN `p_id`;

-- Ensure patient names in medical_info are from patient_records table
ALTER TABLE `medical_info`
ADD COLUMN `patient_name` VARCHAR(100) NOT NULL AFTER `med_id`;

UPDATE `medical_info` mi
JOIN `patient_records` pr ON mi.p_id = pr.p_id
SET mi.patient_name = pr.patient_name;

ALTER TABLE `medical_info`
DROP FOREIGN KEY `medical_info_ibfk_1`;

ALTER TABLE `medical_info`
DROP COLUMN `p_id`;






Error
SQL query: Copy Documentation


UPDATE `patient_records` pr
JOIN `appointments` a ON pr.p_id = a.p_id
SET pr.patient_name = (SELECT name FROM `patients` WHERE `p_id` = a.p_id);
MySQL said: Documentation

#1054 - Unknown column 'a.p_id' in 'on clause'