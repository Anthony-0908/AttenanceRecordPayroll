-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 12:29 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employeeandpayroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password'),
(2, 'admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `attendance_date` date NOT NULL DEFAULT current_timestamp(),
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `hours` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `emp_id`, `full_name`, `attendance_date`, `time_in`, `time_out`, `hours`) VALUES
(1, 'GH101', 'yu ,tony', '2022-11-25', '10:46:03', '21:00:00', 10.216666666667),
(2, 'GH101', 'yu, tony', '2022-11-11', '19:20:21', '20:19:21', 2),
(3, 'GH101', 'yu, tony', '2022-10-01', '19:20:21', '20:19:21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `id` int(11) NOT NULL,
  `Emp_id` varchar(9) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Position` varchar(10) NOT NULL,
  `Firstname` varchar(20) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `hour_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_tbl`
--

INSERT INTO `employee_tbl` (`id`, `Emp_id`, `Password`, `Position`, `Firstname`, `Lastname`, `hour_rate`) VALUES
(1, 'GH101', '$2y$10$IeZz4qGnXPURyW.eAgWmleAv8h22RkDWV5WozJnT0s5y8Mm3G3EGq', 'Guard Hous', 'tony', 'yu ', 80.65),
(2, 'GH102', '$2y$10$KL3j5jZb4Ytx4PTuGlTZNuv.dQOSpCWRpdQvrYcb9FlJ28qIRyXB6', 'Guard Hous', 'yu', 'yo', 70.5),
(4, 'GH103', '$2y$10$Y08S2bi8V2oqe.yzcymCV.Z8AfClSv5k0K.O6BKily1SvuY6fdjrq', 'Guard Hous', 'Tony', 'Rosales', 80),
(5, 'GH104', '$2y$10$NKpQLptE9KBeV0VZIMECfuHUh0nLmlqyaPMEZtIsyL0mUdAVxfJ8e', 'Guard Hous', 'Anth', 'yu', 90);

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(25) NOT NULL,
  `overtime` time NOT NULL,
  `hrs_worked` double NOT NULL,
  `DateWorkedOvertime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id`, `emp_id`, `overtime`, `hrs_worked`, `DateWorkedOvertime`) VALUES
(1, 'GH101', '21:00:00', 2, '2022-11-25'),
(2, 'GH101', '03:54:05', 3, '2022-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(9) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `total_hrs` double NOT NULL,
  `overtime_pay` double NOT NULL,
  `date_to` date NOT NULL,
  `date_from` date NOT NULL,
  `payroll_number` varchar(20) NOT NULL,
  `salary` varchar(20) NOT NULL,
  `SSS` varchar(20) NOT NULL,
  `pagibig` varchar(20) NOT NULL,
  `philhealth` varchar(20) NOT NULL,
  `taxes` int(12) NOT NULL,
  `net_pay` varchar(20) NOT NULL,
  `DateTimeCreated` date NOT NULL,
  `DateTimeUpdated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `emp_id`, `full_name`, `total_hrs`, `overtime_pay`, `date_to`, `date_from`, `payroll_number`, `salary`, `SSS`, `pagibig`, `philhealth`, `taxes`, `net_pay`, `DateTimeCreated`, `DateTimeUpdated`) VALUES
(11, 'GH101', 'yu ,tony', 12.22, 40.33, '2022-11-27', '2022-11-12', '2022112795', '1,025.60', '41.02', '10.26', '41.02', 0, '933.30', '2022-11-27', '2022-11-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Emp_id` (`Emp_id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_tbl` (`Emp_id`);

--
-- Constraints for table `overtime`
--
ALTER TABLE `overtime`
  ADD CONSTRAINT `overtime_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_tbl` (`Emp_id`);

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_tbl` (`Emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
