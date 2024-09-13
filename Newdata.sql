-- Add the patient_name column to the patient_records table
ALTER TABLE `patient_records`
ADD COLUMN `patient_name` VARCHAR(100) NOT NULL AFTER `rec_id`;

-- Update the patient_name column in patient_records from the appointments table
UPDATE `patient_records` pr
JOIN `appointments` a ON pr.p_id = (SELECT p_id FROM patients WHERE patients.name = a.patient_name)
SET pr.patient_name = a.patient_name;

-- Drop the p_id column in patient_records since it's not needed anymore
ALTER TABLE `patient_records`
DROP COLUMN `p_id`;

-- Add the patient_name column to the medical_info table
ALTER TABLE `medical_info`
ADD COLUMN `patient_name` VARCHAR(100) NOT NULL AFTER `med_id`;

-- Update the patient_name column in medical_info from the patient_records table
UPDATE `medical_info` mi
JOIN `patient_records` pr ON mi.p_id = (SELECT p_id FROM patients WHERE patients.name = pr.patient_name)
SET mi.patient_name = pr.patient_name;

-- Drop the p_id column in medical_info since it's not needed anymore
ALTER TABLE `medical_info`
DROP COLUMN `p_id`;
