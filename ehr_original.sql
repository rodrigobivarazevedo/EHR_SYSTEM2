-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jan-2024 às 10:38
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ehr`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `appointments`
--

CREATE TABLE `appointments` (
  `AppointmentID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `ClinicID` int(11) DEFAULT NULL,
  `TimeSlotID` int(11) DEFAULT NULL,
  `AppointmentDateTime` datetime DEFAULT NULL,
  `ConsultationType` varchar(255) DEFAULT NULL,
  `Speciality` varchar(255) DEFAULT NULL,
  `Status` varchar(20) DEFAULT 'Scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `appointmentsinfo`
--

CREATE TABLE `appointmentsinfo` (
  `consultation_type` varchar(255) DEFAULT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `clinic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `appointmentsinfo`
--

INSERT INTO `appointmentsinfo` (`consultation_type`, `speciality`, `clinic`) VALUES
('exam', 'Cardiology', 'Passau Clinic'),
('appointment', 'Endocrinology', 'Passau Clinic'),
('teleconsultation', 'Nephrology', 'Passau Clinic'),
('exam', 'Gastroenterology', 'Passau Clinic'),
('exam', 'Cardiology', 'Rottal-In Clinic'),
('appointment', 'Endocrinology', 'Rottal-In Clinic'),
('teleconsultation', 'Nephrology', 'Rottal-In Clinic'),
('exam', 'Dermatology', 'Rottal-In Clinic'),
('exam', 'Gynecology and Obstetrics', 'Eggenfelden Clinic'),
('appointment', 'Dentistry', 'Eggenfelden Clinic'),
('exam', 'Rheumatology', 'Munich Clinic'),
('appointment', 'Dentistry', 'Munich Clinic'),
('exam', 'Rheumatology', 'Mühldorf Clinic'),
('exam', 'Dermatology', 'Mühldorf Clinic'),
('teleconsultation', 'Family Medicine', 'Mühldorf Clinic'),
('exam', 'Dermatology', 'Burghausen Clinic'),
('appointment', 'Rheumatology', 'Burghausen Clinic'),
('teleconsultation', 'Gastroenterology', 'Burghausen Clinic'),
('exam', 'Rheumatology', 'Pocking Clinic'),
('exam', 'Dentistry', 'Pocking Clinic'),
('teleconsultation', 'Family Medicine', 'Pocking Clinic'),
('exam', 'Family Medicine', 'Augsburg Clinic'),
('appointment', 'Rheumatology', 'Augsburg Clinic'),
('exam', 'Gynecology and Obstetrics', 'Bayreuth Clinic'),
('teleconsultation', 'Gastroenterology', 'Bayreuth Clinic');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clinics`
--

CREATE TABLE `clinics` (
  `ClinicID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clinics`
--

INSERT INTO `clinics` (`ClinicID`, `Name`, `Location`) VALUES
(1, 'Passau Clinic', 'Innstraße 76, 94032 Passau'),
(2, 'Rottal-In Clinic', 'Am Griesberg 1, 84347 Pfarrkirchen'),
(3, 'Eggenfelden Clinic', 'Simonsöder Allee 20, 84307 Eggenfelden'),
(4, 'Munich Clinic', 'Bavariaring 46, 80336 München'),
(5, 'Mühldorf Clinic', 'Krankenhausstraße 1, 84453 Mühldorf am Inn'),
(6, 'Burghausen Clinic', 'Krankenhausstraße 3a, 84489 Burghausen'),
(7, 'Pocking Clinic', 'Berger Str. 1, 94060 Pocking'),
(8, 'Augsburg Clinic', 'Annastraße 2, 86150 Augsburg'),
(9, 'Bayreuth Clinic', 'Kurpromenade 2, 95448 Bayreuth');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clinicspecialities`
--

CREATE TABLE `clinicspecialities` (
  `ClinicID` int(11) NOT NULL,
  `SpecialityID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clinicspecialities`
--

INSERT INTO `clinicspecialities` (`ClinicID`, `SpecialityID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(3, 7),
(4, 8),
(5, 3),
(5, 4),
(5, 5),
(5, 8),
(6, 4),
(6, 5),
(6, 8),
(7, 6),
(8, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `doctorclinic`
--

CREATE TABLE `doctorclinic` (
  `DoctorID` int(11) NOT NULL,
  `ClinicID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `doctorclinic`
--

INSERT INTO `doctorclinic` (`DoctorID`, `ClinicID`) VALUES
(1, 1),
(2, 2),
(3, 1),
(4, 2),
(5, 4),
(6, 4),
(7, 6),
(8, 5),
(9, 1),
(10, 5),
(11, 5),
(12, 6),
(13, 6),
(14, 5),
(15, 7),
(16, 7),
(17, 3),
(18, 3),
(19, 8),
(20, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `doctors`
--

CREATE TABLE `doctors` (
  `DoctorID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Speciality` varchar(255) NOT NULL,
  `ContactNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `doctors`
--

INSERT INTO `doctors` (`DoctorID`, `UserID`, `FirstName`, `LastName`, `Speciality`, `ContactNumber`) VALUES
(1, NULL, 'Emily', 'Turner', 'Cardiology', NULL),
(2, NULL, 'Benjamin', 'Hayes', 'Cardiology', NULL),
(3, NULL, 'Sarah', 'Mitchell', 'Endocrinology', NULL),
(4, NULL, 'Kevin', 'Rodriguez', 'Endocrinology', NULL),
(5, NULL, 'Amanda', 'Foster', 'Rheumatology', NULL),
(6, NULL, 'Robert', 'Hughes', 'Rheumatology', NULL),
(7, NULL, 'Melissa', 'Thompson', 'Rheumatology', NULL),
(8, NULL, 'Christopher', 'Harris', 'Rheumatology', NULL),
(9, NULL, 'Jessica', 'Wong', 'Nephrology', NULL),
(10, NULL, 'Michael', 'Patel', 'Nephrology', NULL),
(11, NULL, 'Laura', 'Reynolds', 'Gastroenterology', NULL),
(12, NULL, 'Brian', 'Lewis', 'Gastroenterology', NULL),
(13, NULL, 'Rachel', 'Carter', 'Dermatology', NULL),
(14, NULL, 'Jonathan', 'Kim', 'Dermatology', NULL),
(15, NULL, 'Kimberly', 'Davis', 'Dentistry', NULL),
(16, NULL, 'Jordan', 'Carter', 'Dentistry', NULL),
(17, NULL, 'Alexandra', 'Taylor', 'Gynecology and Obstetrics', NULL),
(18, NULL, 'Samuel', 'Rodriguez', 'Gynecology and Obstetrics', NULL),
(19, NULL, 'Jennifer', 'White', 'Family Doctor', NULL),
(20, NULL, 'David', 'Johnson', 'Family Doctor', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicationprescriptions`
--

CREATE TABLE `medicationprescriptions` (
  `PrescriptionID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `MedicationName` varchar(255) DEFAULT NULL,
  `Dosage` varchar(50) DEFAULT NULL,
  `Frequency` varchar(50) DEFAULT NULL,
  `PrescriptionDate` date DEFAULT NULL,
  `Instructions` text DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patients`
--

CREATE TABLE `patients` (
  `PatientID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `ContactNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `specialities`
--

CREATE TABLE `specialities` (
  `SpecialityID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `specialities`
--

INSERT INTO `specialities` (`SpecialityID`, `Name`) VALUES
(1, 'Cardiology'),
(2, 'Endocrinology'),
(3, 'Nephrology'),
(4, 'Gastroenterology'),
(5, 'Dermatology'),
(6, 'Dentistry'),
(7, 'Gynecology and Obstetrics'),
(8, 'Rheumatology'),
(9, 'Family Doctor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `timeslots`
--

CREATE TABLE `timeslots` (
  `SlotID` int(11) NOT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `ClinicID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `AvailabilityStatus` varchar(20) DEFAULT NULL,
  `speciality` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `ContactNumber` varchar(20) NOT NULL,
  `Role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `ContactNumber`, `Role`) VALUES
(1, 'Rodrigo', '$2y$10$zwVSO4HwSMI8m/dfm0v/uOccwcoEHQ4w83gL9yI4ij1ljmWq20.Oy', 'rodrigobivarazevedo@gmail.com', '961929295', 'admin'),
(2, 'Kelly', '$2y$10$As.6lqY4hMDcEBrG.nTesecSbaHuZXcXwM2DKRKOjMGYT1QpHacV2', 'kellykhalil048@gmail.com', '941929295', 'admin'),
(3, 'Emily Turner', '$2y$10$wDCP4imP.QTLuaghIguRkeLfIS88Zjk2YoLytt8gwzEtGuKSdWcb6', 'emily.turner@gmail.com', '582726414', 'doctor'),
(4, 'Benjamin Hayes', '$2y$10$f3o9dXeIeaRaj57k.sk6Pe0N9XVrwl2UpLzJk009vQxbeWqS6IoAK', 'benjamin.hayes@gmail.com', '570024859', 'doctor'),
(5, 'Sarah Mitchell', '$2y$10$IRszc8CZC5auEuJlJpc5ne5RsC2MiBtVWh7qFa2LoEWrRf8/wIWKW', 'sarah.mitchell@gmail.com', '560213219', 'doctor'),
(6, 'Kevin Rodriguez', '$2y$10$9smPmIPT2MB76EhLej05POUEEclaGo8MksJa1XE21bRAfr4weDZ8y', 'kevin.rodriguez@gmail.com', '599986832', 'doctor'),
(7, 'Amanda Foster', '$2y$10$H0tLcW91IleMRPqborYJw.qTtdwA3kXReR3rsZCfeHK.a6su82XeW', 'amanda.foster@gmail.com', '577957680', 'doctor'),
(8, 'Robert Hughes', '$2y$10$h/qx3vRGQIq2vCLRs8k1TO.u6iBNDvRGtE/Fi9UX/hwKT62Inxuw2', 'robert.hughes@gmail.com', '564307415', 'doctor'),
(9, 'Jessica Wong', '$2y$10$/6cJDFqm.4jx2AY9yTYRgePPQt7RDXIxWMTxx.9roY95MzRkWxvQ.', 'jessica.wong@gmail.com', '566511093', 'doctor'),
(10, 'Michael Patel', '$2y$10$tkd4a/fPaFEaaAosY5Qlyuv.0Uvn.WimQNf645bd1QxKlWWZBmYBi', 'michael.patel@gmail.com', '519086303', 'doctor'),
(11, 'Laura Reynolds', '$2y$10$LMevxXFxVvozGbbIWOs/ouitRQU9TLYyJxdcjl0VBX89ZgZ6FTxo6', 'laura.reynolds@gmail.com', '573668483', 'doctor'),
(12, 'Brian Lewis', '$2y$10$gdqGiI6CwqzK4ACnnHBzYexG.T.TY3d1kvvxU2G.LskowbDkTI/I.', 'brian.lewis@gmail.com', '526462103', 'doctor'),
(13, 'Rachel Carter', '$2y$10$/EWsYgOXvQqbq9gITWCfGeDDgINxGtrPE76JGDu2fn4IO3sttNITC', 'rachel.carter@gmail.com', '528064094', 'doctor'),
(14, 'Jonathan Kim', '$2y$10$0vhLaTgZP.lAB4CphmzW3eNEyocklgKSEQEw6XIcFOtf3NurNYZTa', 'jonathan.kim@gmail.com', '527805060', 'doctor'),
(15, 'Melissa Thompson', '$2y$10$MTqPnoCuT1KSmXLcvBs6be8A.8teTQSHY/.G0AX85V9BwCareIyyK', 'melissa.thompson@gmail.com', '548060688', 'doctor'),
(16, 'Christopher Harris', '$2y$10$PqdcEPlEvVbpN.X5Pict8.b/.SNe6QAAVp8QuREq/KwPGHfaaELAG', 'christopher.harris@gmail.com', '510705975', 'doctor'),
(17, 'Kimberly Davis', '$2y$10$gcAX1G3N8GYX8E.M.xQL2.qk7/HGTC60S1OPBYVRUPkZfn8my.VUS', 'kimberly.davis@gmail.com', '538606662', 'doctor'),
(18, 'Jordan Carter', '$2y$10$t16M0g85xBwXn7XrJLVWP.1ORpH6SOsThzDov2TwXa9Hfv6334Tu6', 'jordan.carter@gmail.com', '581064857', 'doctor'),
(19, 'Alexandra Taylor', '$2y$10$iEUXWRb3lNd4KL0qV4tRL./XLdNK20IzRC8fx0fQ3Ep/M6V9Du05y', 'alexandra.taylor@gmail.com', '588277439', 'doctor'),
(20, 'Samuel Rodriguez', '$2y$10$tAYqW.SVlHRn6axko5ZqaugXrQZr8SsjwfkqQtmLbeiE5LU.c1xTC', 'samuel.rodriguez@gmail.com', '516043234', 'doctor'),
(21, 'Jennifer White', '$2y$10$1jVKnxoQlFn41V7zKf2yCOJ86RD8EoySL1ZM1e9M4dciIeLU5Y5nK', 'jennifer.white@gmail.com', '533527570', 'doctor'),
(22, 'David Johnson', '$2y$10$7lEpEer17VvgJ1QEsB9ewOh8Xac5yGYD4JGtGccO31/Q6zRX2nWze', 'david.johnson@gmail.com', '550292128', 'doctor');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `DoctorID` (`DoctorID`),
  ADD KEY `ClinicID` (`ClinicID`),
  ADD KEY `TimeSlotID` (`TimeSlotID`);

--
-- Índices para tabela `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`ClinicID`);

--
-- Índices para tabela `clinicspecialities`
--
ALTER TABLE `clinicspecialities`
  ADD PRIMARY KEY (`ClinicID`,`SpecialityID`),
  ADD KEY `SpecialityID` (`SpecialityID`);

--
-- Índices para tabela `doctorclinic`
--
ALTER TABLE `doctorclinic`
  ADD PRIMARY KEY (`DoctorID`,`ClinicID`),
  ADD KEY `ClinicID` (`ClinicID`);

--
-- Índices para tabela `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`DoctorID`),
  ADD KEY `UserID` (`UserID`);

--
-- Índices para tabela `medicationprescriptions`
--
ALTER TABLE `medicationprescriptions`
  ADD PRIMARY KEY (`PrescriptionID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DoctorID` (`DoctorID`);

--
-- Índices para tabela `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PatientID`),
  ADD KEY `UserID` (`UserID`);

--
-- Índices para tabela `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`SpecialityID`);

--
-- Índices para tabela `timeslots`
--
ALTER TABLE `timeslots`
  ADD PRIMARY KEY (`SlotID`),
  ADD KEY `DoctorID` (`DoctorID`),
  ADD KEY `ClinicID` (`ClinicID`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `ContactNumber` (`ContactNumber`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `appointments`
--
ALTER TABLE `appointments`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `doctors`
--
ALTER TABLE `doctors`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `medicationprescriptions`
--
ALTER TABLE `medicationprescriptions`
  MODIFY `PrescriptionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `specialities`
--
ALTER TABLE `specialities`
  MODIFY `SpecialityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `timeslots`
--
ALTER TABLE `timeslots`
  MODIFY `SlotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11151;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`DoctorID`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`ClinicID`) REFERENCES `clinics` (`ClinicID`),
  ADD CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`TimeSlotID`) REFERENCES `timeslots` (`SlotID`);

--
-- Limitadores para a tabela `clinicspecialities`
--
ALTER TABLE `clinicspecialities`
  ADD CONSTRAINT `clinicspecialities_ibfk_1` FOREIGN KEY (`ClinicID`) REFERENCES `clinics` (`ClinicID`),
  ADD CONSTRAINT `clinicspecialities_ibfk_2` FOREIGN KEY (`SpecialityID`) REFERENCES `specialities` (`SpecialityID`);

--
-- Limitadores para a tabela `doctorclinic`
--
ALTER TABLE `doctorclinic`
  ADD CONSTRAINT `doctorclinic_ibfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`DoctorID`),
  ADD CONSTRAINT `doctorclinic_ibfk_2` FOREIGN KEY (`ClinicID`) REFERENCES `clinics` (`ClinicID`);

--
-- Limitadores para a tabela `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Limitadores para a tabela `medicationprescriptions`
--
ALTER TABLE `medicationprescriptions`
  ADD CONSTRAINT `medicationprescriptions_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `medicationprescriptions_ibfk_2` FOREIGN KEY (`PatientID`) REFERENCES `patients` (`PatientID`),
  ADD CONSTRAINT `medicationprescriptions_ibfk_3` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`DoctorID`);

--
-- Limitadores para a tabela `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Limitadores para a tabela `timeslots`
--
ALTER TABLE `timeslots`
  ADD CONSTRAINT `timeslots_ibfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`DoctorID`),
  ADD CONSTRAINT `timeslots_ibfk_2` FOREIGN KEY (`ClinicID`) REFERENCES `clinics` (`ClinicID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
