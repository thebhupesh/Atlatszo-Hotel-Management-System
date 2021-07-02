-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 28, 2020 at 02:01 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--
CREATE DATABASE IF NOT EXISTS `hms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `hms`;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `subject` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comment` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` varchar(6) NOT NULL,
  `dept_name` varchar(20) NOT NULL,
  `manager` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`dept_id`),
  KEY `manager` (`manager`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `manager`) VALUES
('D101', 'Management', 'admin'),
('D102', 'Front Office', NULL),
('D103', 'House Keeping', NULL),
('D104', 'Purchase and Store', NULL),
('D105', 'Room Service', NULL),
('D106', 'Security', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `emp_id` varchar(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `gender` char(6) NOT NULL,
  `age` int NOT NULL,
  `contact_no` decimal(10,0) NOT NULL,
  `doa` date NOT NULL,
  `designation` varchar(20) NOT NULL,
  `dept_id` varchar(6) NOT NULL,
  `salary` decimal(9,2) NOT NULL,
  `score` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`emp_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `name`, `gender`, `age`, `contact_no`, `doa`, `designation`, `dept_id`, `salary`, `score`) VALUES
('emp', 'Employee', 'Male', 20, '0', '2020-10-28', 'Admin', 'D101', '0.00', '0.00'),
('admin', 'Administrator', 'Male', 20, '0', '2020-10-28', 'Admin', 'D101', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `guest` varchar(6) NOT NULL,
  `D102` decimal(2,0) NOT NULL,
  `D103` decimal(2,0) NOT NULL,
  `D104` decimal(2,0) NOT NULL,
  `D105` decimal(2,0) NOT NULL,
  `D106` decimal(2,0) NOT NULL,
  `cmnt` varchar(700) DEFAULT NULL,
  PRIMARY KEY (`guest`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

DROP TABLE IF EXISTS `guest`;
CREATE TABLE IF NOT EXISTS `guest` (
  `guest_id` varchar(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contact_no` decimal(10,0) NOT NULL,
  `no_of_people` int NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `room_no` int NOT NULL,
  PRIMARY KEY (`guest_id`),
  KEY `room_no` (`room_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_id`, `name`, `contact_no`, `no_of_people`, `check_in`, `check_out`, `room_no`) VALUES
('guest', 'Guest', '0', 1, '2020-10-28', '2020-10-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `h_services`
--

DROP TABLE IF EXISTS `h_services`;
CREATE TABLE IF NOT EXISTS `h_services` (
  `h_service_id` int NOT NULL,
  `service_name` varchar(30) NOT NULL,
  `dept_id` varchar(6) NOT NULL,
  `cost` decimal(6,2) NOT NULL,
  `quantity` int NOT NULL,
  `guest_id` varchar(6) NOT NULL,
  `emp_id` varchar(6) NOT NULL,
  `total_cost` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`h_service_id`),
  KEY `dept_id` (`dept_id`),
  KEY `emp_id` (`emp_id`),
  KEY `guest_id` (`guest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_no` int NOT NULL,
  `guest_name` varchar(30) NOT NULL,
  `contact` decimal(10,0) NOT NULL,
  `amount` decimal(9,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`invoice_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_no` int NOT NULL,
  `room_type` varchar(10) NOT NULL,
  `cost` decimal(7,2) NOT NULL,
  `max_guests` int NOT NULL,
  `guest` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`room_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_no`, `room_type`, `cost`, `max_guests`, `guest`) VALUES
(0, 'Demo', '0.00', 1, 'guest'),
(101, 'Single', '1500.00', 2, NULL),
(102, 'Double', '2000.00', 3, NULL),
(103, 'Suite', '4000.00', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `r_services`
--

DROP TABLE IF EXISTS `r_services`;
CREATE TABLE IF NOT EXISTS `r_services` (
  `r_service_id` int NOT NULL,
  `service_name` varchar(30) NOT NULL,
  `dept_id` varchar(6) NOT NULL,
  `cost` decimal(6,2) NOT NULL,
  `quantity` int NOT NULL,
  `guest_id` varchar(6) NOT NULL,
  `emp_id` varchar(6) NOT NULL,
  `total_cost` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`r_service_id`),
  KEY `dept_id` (`dept_id`),
  KEY `emp_id` (`emp_id`),
  KEY `guest_id` (`guest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int NOT NULL,
  `service_type` char(2) NOT NULL,
  `service_name` varchar(20) NOT NULL,
  `dept_id` varchar(6) NOT NULL,
  `cost` int DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_type`, `service_name`, `dept_id`, `cost`) VALUES
(1, 'H', 'Spa', 'D103', 500),
(2, 'H', 'High Speed Wifi', 'D105', 100),
(3, 'H', 'Laundry', 'D103', 70),
(4, 'R', 'Extra Bed', 'D103', 500),
(5, 'R', 'Water Bottle', 'D105', 35),
(6, 'R', 'Cold Drink', 'D105', 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `user_type`) VALUES
('admin', 'admin', 'admin'),
('emp', 'emp', 'emp'),
('guest', 'guest', 'guest');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
