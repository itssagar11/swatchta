-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2022 at 06:13 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swatch`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_no` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `mobile_no`, `address`) VALUES
(1, '1', 1111, '1');

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `id` int(11) NOT NULL,
  `Full_name` varchar(255) NOT NULL,
  `houseNo` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `account_no` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`id`, `Full_name`, `houseNo`, `address`, `account_no`) VALUES
(3, 'ven', 124, 'sde', 32),
(15, 'Kumar', 123, '124 Bullawala', 483806763),
(12, 'Ram', 123, '124 Bullawala', 495484814),
(14, 'Ram', 123, '124 Bullawala', 550762378),
(13, 'Ram', 123, '124 Bullawala', 580226970),
(9, 'Sagar', 124, '124 Bullawala', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `complete_service`
--

CREATE TABLE `complete_service` (
  `service_id` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lon` varchar(255) NOT NULL,
  `compete_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complete_service`
--

INSERT INTO `complete_service` (`service_id`, `image`, `address`, `lat`, `lon`, `compete_on`) VALUES
(2, '', 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', '2022-08-15 16:10:35'),
(2, '', 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', '2022-08-15 16:11:06'),
(2, 'http://localhost/swatchta/images/pic_20220815181113.jpeg', 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', '2022-08-15 16:11:13'),
(2, 'http://localhost/swatchta/images/pic_20220815181125.jpeg', 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', '2022-08-15 16:11:25'),
(2, 'http://localhost/swatchta/images/pic_20220815181236.jpeg', 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', '2022-08-15 16:12:36'),
(3, 'images/pic_20220815183523.jpeg', 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', '2022-08-15 16:35:23'),
(4, 'images/pic_20220816180746.jpeg', '', '28.9255', '78.2337', '2022-08-16 16:07:46'),
(4, 'images/pic_20220816180814.jpeg', 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', '2022-08-16 16:08:14'),
(2, 'images/pic_20220816181124.jpeg', 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', '2022-08-16 16:11:24'),
(5, 'images/pic_20220817183313.jpeg', '1, Dhanaura Rd, near Jama Masjid, Choupla, Laxmi Nagar, Gajraula, Uttar Pradesh 244235, India', '28.829', '78.2463', '2022-08-17 16:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `coupan`
--

CREATE TABLE `coupan` (
  `coupan_id` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `coins` int(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupan`
--

INSERT INTO `coupan` (`coupan_id`, `amount`, `title`, `coins`, `description`) VALUES
(2, 100, 'Water Bill', 30, 'This i swaterbbull');

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int(255) NOT NULL,
  `root` varchar(255) NOT NULL,
  `vehicle_no` int(255) NOT NULL,
  `last_latt` varchar(255) NOT NULL,
  `last_long` varchar(255) NOT NULL,
  `last_location` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lat_active_time` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `root`, `vehicle_no`, `last_latt`, `last_long`, `last_location`, `name`, `lat_active_time`) VALUES
(2, '12A ', 12, '28.829', '78.2463', '1, Dhanaura Rd, near Jama Masjid, Choupla, Laxmi Nagar, Gajraula, Uttar Pradesh 244235, India', '1', 1660755728);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(255) NOT NULL,
  `mobile_no` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(255) NOT NULL COMMENT '1 admin 2employee 3 citizen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `mobile_no`, `password`, `role`) VALUES
(1, 1111, '1111', 1),
(2, 2222, '2222', 2),
(3, 3333, '3333', 3),
(4, 123, '1', 3),
(5, 123, '1', 3),
(6, 123, '1', 3),
(7, 123, '1', 3),
(8, 123, '1', 3),
(9, 123, '1', 3),
(10, 12345, '1111', 3),
(11, 12345, '1111', 3),
(12, 12345, '1111', 3),
(13, 12345, '1111', 3),
(14, 12345, '1111', 3),
(15, 123456, '1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `refer`
--

CREATE TABLE `refer` (
  `id` int(255) NOT NULL,
  `refer_by` int(255) NOT NULL,
  `refer_to` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refer`
--

INSERT INTO `refer` (`id`, `refer_by`, `refer_to`, `date`) VALUES
(1, 3, 14, '2022-08-19 16:06:39'),
(2, 3, 15, '2022-08-19 16:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(255) NOT NULL,
  `owner` int(255) NOT NULL,
  `coupan` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `owner`, `coupan`, `code`, `date`) VALUES
(1, 3, 2, 'sQOIHdT', '2022-08-17 15:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `latt` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `allocated_to` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '-1 close 0withdw 1 new  2allocate 3accpt 4complete ',
  `citizen_id` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `contact` int(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `address`, `latt`, `lon`, `image`, `allocated_to`, `status`, `citizen_id`, `remark`, `description`, `contact`, `date`) VALUES
(2, 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', 'http://localhost/swatchta/images/pic_20220815165342.jpeg', 2, 0, 3, 'Service Completed', 'd', 23455432, '2022-08-15 14:53:48'),
(3, 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', 'images/pic_20220815183050.jpeg', 2, 4, 3, 'Service Completed', 'd', 2147483647, '2022-08-15 16:30:58'),
(4, 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', 'images/pic_20220816174250.jpeg', 2, 4, 3, 'Service Completed', 'd', 23456, '2022-08-16 15:43:00'),
(5, '1, Dhanaura Rd, near Jama Masjid, Choupla, Laxmi Nagar, Gajraula, Uttar Pradesh 244235, India', '28.829', '78.2463', 'images/pic_20220817181623.jpeg', 2, 4, 3, 'Service Completed', 'd', 1234565432, '2022-08-17 16:16:33'),
(6, '1, Dhanaura Rd, near Jama Masjid, Choupla, Laxmi Nagar, Gajraula, Uttar Pradesh 244235, India', '28.829', '78.2463', 'images/pic_20220818043042.jpeg', NULL, 0, 3, NULL, 'd', 123, '2022-08-18 02:30:50'),
(7, '1, Dhanaura Rd, near Jama Masjid, Choupla, Laxmi Nagar, Gajraula, Uttar Pradesh 244235, India', '28.829', '78.2463', 'images/pic_20220818165825.jpeg', NULL, 1, 3, NULL, 'd', 0, '2022-08-18 14:59:02'),
(8, '1, Dhanaura Rd, near Jama Masjid, Choupla, Laxmi Nagar, Gajraula, Uttar Pradesh 244235, India', '28.829', '78.2463', 'images/pic_20220818165942.jpeg', NULL, 1, 3, NULL, 'd', 0, '2022-08-18 14:59:47'),
(9, '1, Dhanaura Rd, near Jama Masjid, Choupla, Laxmi Nagar, Gajraula, Uttar Pradesh 244235, India', '28.829', '78.2463', 'images/pic_20220818165957.jpeg', NULL, 1, 3, NULL, 'd', 12331, '2022-08-18 15:00:06'),
(10, '1, Dhanaura Rd, near Jama Masjid, Choupla, Laxmi Nagar, Gajraula, Uttar Pradesh 244235, India', '28.829', '78.2463', 'images/pic_20220818170304.jpeg', 2, 2, 3, 'Allocated to employee Will we pickup soon.', 'd', 1232123, '2022-08-18 15:03:14'),
(11, '1, Dhanaura Rd, near Jama Masjid, Choupla, Laxmi Nagar, Gajraula, Uttar Pradesh 244235, India', '28.829', '78.2463', 'images/pic_20220818170517.jpeg', 2, 2, 3, 'Allocated to employee Will we pickup soon.', 'd', 123212, '2022-08-18 15:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `transection`
--

CREATE TABLE `transection` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `narration` varchar(255) NOT NULL,
  `account_no` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transection`
--

INSERT INTO `transection` (`id`, `amount`, `mode`, `narration`, `account_no`, `date`) VALUES
(1, 5, 'CREDIT', 'For Service no 2', 3, '2022-08-17 03:47:05'),
(2, 5, 'DEBIT', 'Coupan Buy', 3, '2022-08-17 15:07:49'),
(6, 5, 'CREDIT', 'For Service no 5', 3, '2022-08-17 16:33:13'),
(7, 3, 'CREDIT', 'For Refer', 3, '2022-08-19 16:06:39'),
(8, 3, 'CREDIT', 'For Refer', 3, '2022-08-19 16:12:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD KEY `id` (`id`);

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`account_no`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `complete_service`
--
ALTER TABLE `complete_service`
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `coupan`
--
ALTER TABLE `coupan`
  ADD PRIMARY KEY (`coupan_id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD KEY `id` (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refer`
--
ALTER TABLE `refer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupan` (`coupan`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `allocated_to` (`allocated_to`),
  ADD KEY `citizen_id` (`citizen_id`);

--
-- Indexes for table `transection`
--
ALTER TABLE `transection`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupan`
--
ALTER TABLE `coupan`
  MODIFY `coupan_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `refer`
--
ALTER TABLE `refer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transection`
--
ALTER TABLE `transection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`);

--
-- Constraints for table `citizen`
--
ALTER TABLE `citizen`
  ADD CONSTRAINT `citizen_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`);

--
-- Constraints for table `complete_service`
--
ALTER TABLE `complete_service`
  ADD CONSTRAINT `complete_service_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD CONSTRAINT `employee_info_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`);

--
-- Constraints for table `rewards`
--
ALTER TABLE `rewards`
  ADD CONSTRAINT `rewards_ibfk_1` FOREIGN KEY (`coupan`) REFERENCES `coupan` (`coupan_id`),
  ADD CONSTRAINT `rewards_ibfk_2` FOREIGN KEY (`owner`) REFERENCES `citizen` (`id`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`allocated_to`) REFERENCES `employee_info` (`id`),
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
