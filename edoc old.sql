-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2023 at 12:33 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@edoc.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoid` int(11) NOT NULL,
  `pid` int(10) DEFAULT NULL,
  `apponum` int(3) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `pay_status` tinyint(1) NOT NULL DEFAULT 0,
  `recommendation` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`, `status`, `pay_status`, `recommendation`) VALUES
(1, 1, 1, 1, '2022-06-03', 0, 0, 0),
(2, 3, 1, 9, '2023-02-21', 0, 0, 0),
(6, 2, 2, 9, '2023-02-21', 0, 0, 0),
(5, 2, 2, 10, '2023-02-21', 0, 0, 0),
(7, 2, 2, 1, '2023-02-21', 0, 0, 0),
(17, 1, 1, 14, '2023-04-20', 0, 1, 0),
(16, 1, 1, 15, '2023-04-20', 1, 1, 0),
(15, 1, 1, 11, '2023-04-20', 1, 1, 0),
(14, 1, 1, 13, '2023-04-20', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`id`, `name`) VALUES
(1, 'heart disease'),
(2, ' high blood pressure'),
(11, 'diabetes'),
(12, 'thyroid disorders\r\n'),
(16, 'acid reflux'),
(17, 'ulcers'),
(18, 'seizures'),
(19, 'migraines'),
(20, 'glaucoma'),
(21, 'cataracts'),
(23, 'fractures'),
(24, 'sprains'),
(27, 'sinusitis'),
(28, 'allergies');

-- --------------------------------------------------------

--
-- Table structure for table `disease_specialties`
--

CREATE TABLE `disease_specialties` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `did` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disease_specialties`
--

INSERT INTO `disease_specialties` (`id`, `sid`, `did`) VALUES
(1, 1, 1),
(2, 1, 2),
(13, 3, 11),
(14, 3, 12),
(18, 4, 16),
(19, 4, 17),
(20, 5, 18),
(21, 5, 19),
(22, 6, 20),
(23, 6, 21),
(25, 7, 23),
(26, 7, 24),
(29, 8, 27),
(30, 8, 28);

-- --------------------------------------------------------

--
-- Table structure for table `disease_symptom`
--

CREATE TABLE `disease_symptom` (
  `id` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disease_symptom`
--

INSERT INTO `disease_symptom` (`id`, `did`, `sid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 2, 9),
(10, 2, 1),
(11, 2, 7),
(12, 2, 8),
(13, 2, 5),
(14, 2, 10),
(15, 2, 11),
(16, 11, 6),
(17, 11, 10),
(18, 11, 12),
(19, 11, 13),
(20, 11, 14),
(21, 11, 15),
(22, 11, 16),
(23, 12, 17),
(24, 12, 18),
(25, 12, 19),
(26, 12, 20),
(27, 12, 21),
(28, 16, 22),
(29, 16, 23),
(30, 16, 24),
(31, 16, 25),
(32, 17, 25),
(33, 17, 5),
(34, 17, 4),
(35, 17, 26),
(36, 18, 27),
(37, 18, 19),
(38, 18, 8),
(39, 18, 28),
(40, 19, 5),
(41, 19, 9),
(42, 19, 28),
(43, 19, 29),
(44, 20, 5),
(45, 20, 9),
(46, 20, 10),
(47, 20, 30),
(48, 21, 10),
(49, 21, 31),
(50, 21, 32),
(51, 21, 33),
(52, 21, 34),
(53, 23, 35),
(54, 23, 36),
(55, 23, 37),
(56, 23, 38),
(57, 24, 39),
(58, 24, 40),
(59, 24, 41),
(60, 24, 42),
(61, 27, 44),
(62, 27, 43),
(63, 27, 24),
(64, 27, 29),
(65, 27, 45),
(66, 27, 46),
(67, 28, 40),
(68, 28, 30),
(69, 28, 8),
(70, 28, 9),
(71, 28, 48),
(72, 28, 49);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `docid` int(11) NOT NULL,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
(1, 'doctor@edoc.com', 'doctor1', '123', '000000000', '0110000000', 1),
(2, 'remoj@mailinator.com', 'doctor2', '123', 'Est incidunt re', '+1 (713) 966-10', 7),
(3, 'gozec@mailinator.com', 'doctor3', '123', 'Reiciendis omni', '+1 (733) 125-11', 8),
(6, 'rabinbasnet@gamil.com', 'doctor4', '123', 'Vel ut aut laud', '+1 (824) 405-30', 3),
(7, 'doctor6@gmail.com', 'doctor6', '123', '123456', '9861428956', 1),
(5, 'jyqawe@mailinator.com', 'doctor5', '123', 'Ad eligendi adi', '+1 (597) 265-80', 5),
(8, 'doctor7@gmail.com', 'doctor7', '123', '1234567', '9858486325', 1),
(9, 'doctor8@gmail.com', 'doctor8', '123', '12345678', '9863258789', 1),
(10, 'doctor9@gmail.com', 'doctor9', '123', '123456789', '9854785236', 3),
(11, 'doctor10@gmail.com', 'doctor10', '123', '12345678910', '9854789632', 5),
(12, 'doctor11@gmail.com', 'doctor11', '123', '1234567891011', '9841258463', 6),
(13, 'doctor12@gmail.com', 'doctor12', '123', '123456789101112', '9847853687', 3),
(14, 'doctor13@gmail.com', 'doctor13', '123', '123456789101112', '9862457863', 3),
(15, 'doctor14@gmail.com', 'doctor14', '123', '123456789101112', '9854789635', 3),
(16, 'doctor15@gmail.com', 'doctor15', '123', '123456789101112', '9864125890', 3);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `pemail` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) DEFAULT NULL,
  `pnic` varchar(15) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
(1, 'patient@edoc.com', 'patient1', '123', 'pokhara', '0000000000', '2000-01-01', '0120000000'),
(2, 'emhashenudara@gmail.com', 'patient2', '123', 'chitwan', '0110000000', '2022-06-03', '0700000000'),
(3, 'culapomoge@mailinator.com', 'patient3', 'Pa$$w0rd!', 'kathmandu', '12345659', '2009-07-09', '+1 (395) 936-13');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL,
  `docid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL,
  `fee` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`, `fee`) VALUES
(13, '2', 'Dermatology', '2023-05-10', '10:00:00', 12, 200),
(15, '3', 'Check yot thyroid and diabeties', '2023-05-15', '13:34:00', 13, 300),
(14, '2', 'Dermatology', '2023-05-11', '23:35:00', 20, 400),
(11, '1', 'Check you heart', '2023-05-10', '10:00:00', 50, 500),
(12, '1', 'check your heart', '2023-05-11', '11:00:00', 10, 800),
(16, '14', 'thyroid checkup', '2023-05-20', '10:20:00', 10, 400),
(17, '15', 'thyroid checkup', '2023-05-21', '09:17:00', 15, 500);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` int(2) NOT NULL,
  `sname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'Cardiology '),
(3, 'Endocrinology '),
(4, 'Gastroenterology '),
(5, 'Neurology '),
(6, 'Ophthalmology '),
(7, 'Orthopedics '),
(8, 'Otolaryngology ');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `name`) VALUES
(1, 'Chest pain'),
(2, 'neck pain'),
(3, 'indigestion'),
(4, 'heartburn'),
(5, 'nausea '),
(6, 'fatigue'),
(7, 'dizziness'),
(8, 'shortness of breath'),
(9, 'headaches'),
(10, 'blurred vision'),
(11, 'anxiety'),
(12, 'Urinate often'),
(13, 'very thirsty'),
(14, 'Weight loss'),
(15, 'hungry'),
(16, 'dry skin'),
(17, 'Neck Swelling'),
(18, 'fast heart rate'),
(19, 'twitching '),
(20, 'sweating'),
(21, 'loose nails'),
(22, 'cough'),
(23, 'hoarse voice'),
(24, 'bad breath'),
(25, 'bloating '),
(26, 'stomach pain'),
(27, 'Staring'),
(28, 'Loss of consciousness'),
(29, 'fever\r\n'),
(30, 'Eye redness'),
(31, 'faded color'),
(32, 'bad night vision'),
(33, 'Sensitivity to light'),
(34, 'Double vision in a single eye'),
(35, 'misshapen limb'),
(36, 'bleeding'),
(37, 'Intense pain'),
(38, 'Limited Mobility'),
(39, 'weakness '),
(40, 'swollen'),
(41, 'bruised '),
(42, 'muscle cramp'),
(43, 'sinus headache'),
(44, 'toothache'),
(45, 'blocked nose'),
(46, 'reduced sense of smell'),
(47, 'sneezing'),
(48, 'runny nose'),
(49, 'swelling tongue');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `pidx` text NOT NULL,
  `transaction_id` text NOT NULL,
  `purchase_order_id` text NOT NULL,
  `amount` text NOT NULL,
  `mobile` text NOT NULL,
  `purchase_order_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `pidx`, `transaction_id`, `purchase_order_id`, `amount`, `mobile`, `purchase_order_name`) VALUES
(1, 'bLEDsSJ5A5Sk2BwafYcN58', 'zG4CGr34rs7PKLqYSLbTsn', '15', '500', '98XXXXX000', 'Check you heart'),
(3, 'RBAEzqp2qGg7fJpBMmJqGo', '7CQucZX3pVjUYTF2Lu3sZM', '16', '300', '98XXXXX000', 'Check yot thyroid and diabeties'),
(4, 'hPYDKoyEeWp3x6HXJVSxzE', 'sRatR3wASigqKLKV9mhwd6', '17', '400', '98XXXXX000', 'Dermatology');

-- --------------------------------------------------------

--
-- Table structure for table `user_symptoms`
--

CREATE TABLE `user_symptoms` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `sid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_symptoms`
--

INSERT INTO `user_symptoms` (`id`, `pid`, `sid`) VALUES
(1, 1, '2,3,5'),
(2, 1, '1,4,6'),
(3, 1, '1,4,6'),
(4, 1, '1,4,6'),
(5, 1, '1,4,6'),
(6, 1, '1,4,6'),
(7, 1, '1,4,6'),
(8, 1, '1,4,6'),
(9, 1, '1,4,6'),
(10, 1, '1,4,6'),
(11, 1, '1,4,6'),
(12, 1, '1,4,6'),
(13, 1, '1,4,6'),
(14, 1, '1,4,6'),
(15, 1, '1,4,6'),
(16, 1, '1,4,6'),
(17, 1, '1,4,6'),
(18, 1, '1,4,6'),
(19, 1, '1,4,6'),
(20, 1, '1,4,6'),
(21, 1, '1,4,6'),
(22, 1, '1,4,6'),
(23, 1, '24,31,38,45,46,49'),
(24, 1, '24,31,38,45,46,49'),
(25, 1, '24,31,38,45,46,49'),
(26, 1, '24,31,38,45,46,49'),
(27, 1, '24,31,38,45,46,49'),
(28, 1, '24,31,38,45,46,49'),
(29, 1, '24,31,38,45,46,49'),
(30, 1, '24,31,38,45,46,49'),
(31, 1, '24,31,38,45,46,49'),
(32, 1, '24,31,38,45,46,49'),
(33, 1, '1,2,3'),
(34, 1, '1,3,4'),
(35, 1, '1,3,4'),
(36, 1, '1,3,4'),
(37, 1, '1,2,3,4,5,6,24,38,40,46'),
(38, 1, '1,2,5'),
(39, 1, '1,2,5'),
(40, 1, '1,6,16,18,20,33,40,46,49'),
(41, 1, '1,2,3'),
(42, 1, '1,2,3'),
(43, 1, '1,2'),
(44, 1, '1,2,3,4'),
(45, 1, '12,13,15,30,37'),
(46, 1, '14,15,16,17,36,44'),
(47, 1, '2,14,17');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@edoc.com', 'a'),
('doctor@edoc.com', 'd'),
('patient@edoc.com', 'p'),
('emhashenudara@gmail.com', 'p'),
('remoj@mailinator.com', 'd'),
('gozec@mailinator.com', 'd'),
('culapomoge@mailinator.com', 'p'),
('rabinbasnet@gamil.com', 'd'),
('jyqawe@mailinator.com', 'd'),
('doctor6@gmail.com', 'd'),
('doctor7@gmail.com', 'd'),
('doctor8@gmail.com', 'd'),
('doctor9@gmail.com', 'd'),
('doctor10@gmail.com', 'd'),
('doctor11@gmail.com', 'd'),
('doctor12@gmail.com', 'd'),
('doctor13@gmail.com', 'd'),
('doctor14@gmail.com', 'd'),
('doctor15@gmail.com', 'd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aemail`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appoid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `scheduleid` (`scheduleid`);

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disease_specialties`
--
ALTER TABLE `disease_specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disease_symptom`
--
ALTER TABLE `disease_symptom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`docid`),
  ADD KEY `specialties` (`specialties`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `docid` (`docid`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_symptoms`
--
ALTER TABLE `user_symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `disease_specialties`
--
ALTER TABLE `disease_specialties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `disease_symptom`
--
ALTER TABLE `disease_symptom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_symptoms`
--
ALTER TABLE `user_symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
