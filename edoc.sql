-- eDoc: doctor appointment system - database schema and sample data.
-- Sample accounts (for local testing only):
--   Admin:   admin@edoc.com    / Admin@123
--   Doctor:  doctor@edoc.com   / Doctor@123
--   Patient: patient@edoc.com  / Patient@123
-- All personal details below are fictional. Passwords are stored as password_hash() values.

CREATE DATABASE IF NOT EXISTS `edoc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `edoc`;

SET NAMES utf8mb4;
SET time_zone = "+00:00";

CREATE TABLE `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aemail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `doctor` (
  `docid` int(11) NOT NULL AUTO_INCREMENT,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL,
  PRIMARY KEY (`docid`),
  KEY `specialties` (`specialties`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=332215;

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pemail` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) DEFAULT NULL,
  `pnic` varchar(15) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12347;

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL AUTO_INCREMENT,
  `docid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL,
  PRIMARY KEY (`scheduleid`),
  KEY `docid` (`docid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=19;

CREATE TABLE `appointment` (
  `appoid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(10) DEFAULT NULL,
  `apponum` int(3) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL,
  PRIMARY KEY (`appoid`),
  KEY `pid` (`pid`),
  KEY `scheduleid` (`scheduleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5;

CREATE TABLE `specialties` (
  `id` int(2) NOT NULL,
  `sname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data
INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@edoc.com', '$2y$10$RRDxTbxSQrgQ1E..GUENNu4Ln/ci2OxtkuBqUXBnOixqPg3zRXeie');

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
(332212, 'doctor@edoc.com', 'Test Doctor', '$2y$10$g7Kuyg6uxvFUjyTTkC4JlOP5gfqE9dBPVSze/iXnAciRIGW.5NdPy', '000000001', '9000000001', 16),
(332213, 'doctor2@edoc.com', 'Second Doctor', '$2y$10$g7Kuyg6uxvFUjyTTkC4JlOP5gfqE9dBPVSze/iXnAciRIGW.5NdPy', '000000002', '9000000002', 11),
(332214, 'doctor3@edoc.com', 'Third Doctor', '$2y$10$g7Kuyg6uxvFUjyTTkC4JlOP5gfqE9dBPVSze/iXnAciRIGW.5NdPy', '000000003', '9000000003', 47);

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
(12346, 'patient@edoc.com', 'Test Patient', '$2y$10$559BETsZ53zyE.WvHqgBBOz5h7TiSJ2Cwxwaps3gxYDPqYBwuGix6', 'Sample Street 1, Sample City', '000000004', '2000-01-01', '9000000004');

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`) VALUES
(14, '332212', 'Wednesday clinic', '2030-03-08', '08:00:00', 20),
(13, '332212', 'Tuesday clinic', '2030-03-07', '09:30:00', 15),
(12, '332212', 'Monday clinic', '2030-03-06', '09:00:00', 10),
(15, '332213', 'Tuesday clinic', '2030-03-09', '10:00:00', 25),
(16, '332213', 'Friday clinic', '2030-03-10', '10:30:00', 10),
(17, '332213', 'Saturday clinic', '2030-03-11', '10:00:00', 15),
(18, '332212', 'Sample session', '2030-06-27', '10:00:00', 10);

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`) VALUES
(1, 12346, 1, 2, '2030-03-01'),
(2, 12346, 1, 10, '2030-02-27');

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@edoc.com', 'a'),
('doctor@edoc.com', 'd'),
('doctor2@edoc.com', 'd'),
('doctor3@edoc.com', 'd'),
('patient@edoc.com', 'p');

-- Specialties (public reference list)
INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'Accident and emergency medicine'),
(2, 'Allergology'),
(3, 'Anaesthetics'),
(4, 'Biological hematology'),
(5, 'Cardiology'),
(6, 'Child psychiatry'),
(7, 'Clinical biology'),
(8, 'Clinical chemistry'),
(9, 'Clinical neurophysiology'),
(10, 'Clinical radiology'),
(11, 'Dental, oral and maxillo-facial surgery'),
(12, 'Dermato-venerology'),
(13, 'Dermatology'),
(14, 'Endocrinology'),
(15, 'Gastro-enterologic surgery'),
(16, 'Gastroenterology'),
(17, 'General hematology'),
(18, 'General Practice'),
(19, 'General surgery'),
(20, 'Geriatrics'),
(21, 'Immunology'),
(22, 'Infectious diseases'),
(23, 'Internal medicine'),
(24, 'Laboratory medicine'),
(25, 'Maxillo-facial surgery'),
(26, 'Microbiology'),
(27, 'Nephrology'),
(28, 'Neuro-psychiatry'),
(29, 'Neurology'),
(30, 'Neurosurgery'),
(31, 'Nuclear medicine'),
(32, 'Obstetrics and gynecology'),
(33, 'Occupational medicine'),
(34, 'Ophthalmology'),
(35, 'Orthopaedics'),
(36, 'Otorhinolaryngology'),
(37, 'Paediatric surgery'),
(38, 'Paediatrics'),
(39, 'Pathology'),
(40, 'Pharmacology'),
(41, 'Physical medicine and rehabilitation'),
(42, 'Plastic surgery'),
(43, 'Podiatric Medicine'),
(44, 'Podiatric Surgery'),
(45, 'Psychiatry'),
(46, 'Public health and Preventive Medicine'),
(47, 'Radiology'),
(48, 'Radiotherapy'),
(49, 'Respiratory medicine'),
(50, 'Rheumatology'),
(51, 'Stomatology'),
(52, 'Thoracic surgery'),
(53, 'Tropical medicine'),
(54, 'Urology'),
(55, 'Vascular surgery'),
(56, 'Venereology');
