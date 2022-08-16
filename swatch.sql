-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2022 at 07:17 AM
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
  `house No` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`id`, `Full_name`, `house No`, `address`) VALUES
(3, 'ven', 124, 'sde');

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
(3, 'images/pic_20220815183523.jpeg', 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', '2022-08-15 16:35:23');

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
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `root`, `vehicle_no`, `last_latt`, `last_long`, `last_location`, `name`) VALUES
(2, '12A ', 12, '12222.3', '12332.5', 'doiwala', '1');

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
(3, 3333, '3333', 3);

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
  `status` int(11) DEFAULT NULL,
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
(2, 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', 'http://localhost/swatchta/images/pic_20220815165342.jpeg', 2, 4, 3, 'Service Completed', 'd', 23455432, '2022-08-15 14:53:48'),
(3, 'W6GM+5JC, peerzadjan, Bachhraon, Uttar Pradesh 244225, India', '28.9255', '78.2337', 'images/pic_20220815183050.jpeg', 2, 4, 3, 'Service Completed', 'd', 2147483647, '2022-08-15 16:30:58');

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
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `allocated_to` (`allocated_to`),
  ADD KEY `citizen_id` (`citizen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupan`
--
ALTER TABLE `coupan`
  MODIFY `coupan_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`allocated_to`) REFERENCES `employee_info` (`id`),
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
