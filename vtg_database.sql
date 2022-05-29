-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2022 at 11:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vtg_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(200) NOT NULL,
  `account_id` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` int(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `has_deal` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_id`, `name`, `description`, `status`, `image`, `has_deal`) VALUES
(1, 'FKJFHGKDJ', 'VSC', 'Car Warranty', 1, '', 0),
(2, 'DFHLKDFH', 'MGT', 'Mortage', 1, '', 0),
(3, 'ASDHJKFGFG', 'POM', 'Car Warranty', 1, '', 0),
(13, 'c2gn38bzpx4', 'iQOR', 'More on nudes', 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(200) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `time_out`) VALUES
(19, 'dmi1rle2y5j', '2022-05-03', '04:57:44', '13:00:48'),
(23, 'dmi1rle2y5j', '2022-05-02', '04:57:44', '13:00:48'),
(24, 'dmi1rle2y5j', '2022-05-04', '04:57:44', '13:00:48'),
(25, 'dmi1rle2y5j', '2022-05-05', '04:57:44', '13:00:48'),
(26, 'dmi1rle2y5j', '2022-05-06', '04:57:44', '13:00:48'),
(27, 'dmi1rle2y5j', '2022-05-09', '04:57:44', '13:00:48'),
(28, 'dmi1rle2y5j', '2022-05-10', '04:57:44', '13:00:48'),
(29, 'dmi1rle2y5j', '2022-05-11', '04:57:44', '13:00:48'),
(30, 'dmi1rle2y5j', '2022-05-13', '04:57:44', '13:00:48'),
(31, 'dmi1rle2y5j', '2022-05-16', '04:57:44', '13:00:48'),
(32, 'dmi1rle2y5j', '2022-05-17', '04:57:44', '13:00:48'),
(33, 'dmi1rle2y5j', '2022-05-18', '04:57:44', '13:00:48'),
(34, 'dmi1rle2y5j', '2022-05-19', '04:57:44', '13:00:48'),
(35, 'dmi1rle2y5j', '2022-05-20', '04:57:44', '13:00:48'),
(36, 'dmi1rle2y5j', '2022-05-23', '04:57:44', '13:00:48'),
(37, 'dmi1rle2y5j', '2022-05-24', '04:57:44', '13:00:48'),
(38, 'dmi1rle2y5j', '2022-05-25', '04:57:44', '13:00:48'),
(39, 'dmi1rle2y5j', '2022-05-26', '04:57:44', '13:00:48'),
(40, 'dmi1rle2y5j', '2022-05-27', '04:57:44', '13:00:48'),
(41, 'dmi1rle2y5j', '2022-05-30', '04:57:44', '13:00:48'),
(42, 'dmi1rle2y5j', '2022-05-31', '04:57:44', '13:00:48'),
(43, '', '0000-00-00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_requests`
--

CREATE TABLE `attendance_requests` (
  `id` int(200) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `reason` varchar(200) NOT NULL,
  `status` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_requests`
--

INSERT INTO `attendance_requests` (`id`, `employee_id`, `date`, `time_in`, `time_out`, `reason`, `status`) VALUES
(16, 'KJFGLKJDG158', '2022-05-10', '06:00:00', '15:30:00', 'test', 1),
(17, 'dmi1rle2y5j', '2022-05-12', '11:03:00', '17:00:00', 'late', 1),
(18, 'dmi1rle2y5j', '2022-05-12', '11:57:00', '23:58:00', 'laters', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(200) NOT NULL,
  `deal_id` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `account_id` varchar(200) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `deal_id`, `date`, `account_id`, `employee_id`, `remarks`, `status`) VALUES
(15, 'cnxh2870tbd', '2022-04-16', 'c2gn38bzpx4', '52qcfrsgyj3', 'asdasfasfasfasfasf', 1),
(16, 'phr7zk4wv6a', '2022-04-16', 'c2gn38bzpx4', '52qcfrsgyj3', 'asfasf', 1),
(17, 'tlsg4evhy6i', '2022-04-16', 'c2gn38bzpx4', '52qcfrsgyj3', 'test 1', 1),
(18, 'penvj72d0t3', '2022-04-16', 'c2gn38bzpx4', '52qcfrsgyj3', 'qweqweqwe', 1),
(19, '0iyehazqxk3', '2022-04-16', 'c2gn38bzpx4', '52qcfrsgyj3', 'shet nakapag deal pero di legit\n', 1),
(20, 'z4ckbqt6hm2', '2022-04-16', 'c2gn38bzpx4', '52qcfrsgyj3', 'eto legit na talaga', 1),
(21, 'wg2xcjhepr6', '2022-04-16', 'ASDHJKFGFG', '52qcfrsgyj3', 'Test BBROSE my love', 1),
(22, '5pk6tohr9sa', '2022-05-12', 'DFHLKDFH', 'dmi1rle2y5j', 'YES ', 1),
(23, '83nb5tdjc7e', '2022-05-12', 'c2gn38bzpx4', 'mgkf16ywav7', 'Active', 1),
(24, '01f4rp8xsah', '2022-05-12', 'DFHLKDFH', 'dmi1rle2y5j', 'yesyes', 1),
(25, 'ei8pd1w956c', '2022-05-12', 'c2gn38bzpx4', '7whcdq3ryak', '', 0),
(26, 'nq3lbf2ovy1', '2022-05-12', 'c2gn38bzpx4', '7whcdq3ryak', 'asa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `type_id` varchar(200) NOT NULL,
  `salary_id` varchar(200) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_number` varchar(200) NOT NULL,
  `extension_number` varchar(200) NOT NULL,
  `date_added` date NOT NULL,
  `password` varchar(200) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `team_leader` tinyint(1) NOT NULL,
  `account_id` varchar(200) NOT NULL,
  `sss` varchar(200) NOT NULL,
  `philhealth` varchar(200) NOT NULL,
  `tin` varchar(200) NOT NULL,
  `pag_ibig` varchar(200) NOT NULL,
  `employee_type` int(200) NOT NULL,
  `salary` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `type_id`, `salary_id`, `firstname`, `middlename`, `lastname`, `email`, `contact_number`, `extension_number`, `date_added`, `password`, `avatar`, `team_leader`, `account_id`, `sss`, `philhealth`, `tin`, `pag_ibig`, `employee_type`, `salary`) VALUES
(1, 'KJFGLKJDG158', '1', 'FDOIAD', 'Mark Louie', 'Arancon', 'Luna', 'mark@gmail.com', '091235675687', '1001', '2022-04-16', '123123', '1.png', 1, 'ASDHJKFGFG', '54548-3211f-2321', '54548-3211f-2321PH', '54548-3211f-2321TIN', '54548-3211f-2321PI', 1, 90),
(4, 'A65S4D56A41G', '2', 'FDOIAD', 'Luffy', 'Test', 'HR', 'hr@gmail.com', '091235675687', '1004', '2022-04-16', '123123', '1.png', 0, 'ASDHJKFGFG', '54548-3211f-2321', '54548-3211f-2321PH', '54548-3211f-2321TIN', '54548-3211f-2321PI', 0, 90),
(5, '45GERLKIHE', '2', 'FDOIAD', 'Noel', 'E', 'Lanic', 'noel@gmail.com', '091235675687', '1004', '2022-04-16', '123123', '1.png', 0, 'DFHLKDFH', '54548-3211f-2321', '54548-3211f-2321PH', '54548-3211f-2321TIN', '54548-3211f-2321PI', 0, 90),
(7, '52qcfrsgyj3', '3', 'FDOIAD', 'Employee', '', 'Name', 'employee@gmail.com', '+639063276417', '12222', '0000-00-00', '123123', '1.png', 0, 'DFHLKDFH', '54548-3211f-2321', '54548-3211f-2321PH', '54548-3211f-2321TIN', '54548-3211f-2321PI', 0, 90),
(8, 'dmi1rle2y5j', '3', 'FDOIAD', 'Dummy', '', 'Employee', 'dummy@gmail.com', '+639063276417', '123', '0000-00-00', '123123', '1.png', 0, 'DFHLKDFH', '54548-3211f-2321', '54548-3211f-2321PH', '54548-3211f-2321TIN', '54548-3211f-2321PI', 0, 90);

-- --------------------------------------------------------

--
-- Table structure for table `employer_contribution`
--

CREATE TABLE `employer_contribution` (
  `id` int(200) NOT NULL,
  `sss` int(200) NOT NULL,
  `philhealth` int(200) NOT NULL,
  `hdmf` int(200) NOT NULL,
  `e_sss` int(11) NOT NULL,
  `e_ph` int(11) NOT NULL,
  `e_hdmf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employer_contribution`
--

INSERT INTO `employer_contribution` (`id`, `sss`, `philhealth`, `hdmf`, `e_sss`, `e_ph`, `e_hdmf`) VALUES
(1, 581, 100, 100, 581, 438, 100);

-- --------------------------------------------------------

--
-- Table structure for table `payslip`
--

CREATE TABLE `payslip` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `pay_run` date NOT NULL,
  `start_pay_period` date NOT NULL,
  `end_pay_period` date NOT NULL,
  `status` int(11) NOT NULL,
  `payslip_id` varchar(200) NOT NULL,
  `extension_number` varchar(200) NOT NULL,
  `account_id` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `contact_number` varchar(200) NOT NULL,
  `sss` varchar(200) NOT NULL,
  `philhealth` varchar(200) NOT NULL,
  `tin` varchar(200) NOT NULL,
  `pag_ibig` varchar(200) NOT NULL,
  `employee_type` varchar(200) NOT NULL,
  `total_working_hours` varchar(200) NOT NULL,
  `salary_per_hour` varchar(200) NOT NULL,
  `netpay` varchar(200) NOT NULL,
  `deal_count` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payslip`
--

INSERT INTO `payslip` (`id`, `employee_id`, `pay_run`, `start_pay_period`, `end_pay_period`, `status`, `payslip_id`, `extension_number`, `account_id`, `email`, `firstname`, `lastname`, `contact_number`, `sss`, `philhealth`, `tin`, `pag_ibig`, `employee_type`, `total_working_hours`, `salary_per_hour`, `netpay`, `deal_count`) VALUES
(13, 'dmi1rle2y5j', '2022-05-30', '2022-05-02', '2022-05-15', 0, '8ahcgpe7q49', '123', 'DFHLKDFH', 'dummy@gmail.com', 'Dummy', 'Employee', '+639063276417', '54548-3211f-2321', '54548-3211f-2321PH', '54548-3211f-2321TIN', '54548-3211f-2321PI', '0', '11', '90', '7200', '2');

-- --------------------------------------------------------

--
-- Table structure for table `type_employees`
--

CREATE TABLE `type_employees` (
  `id` int(200) NOT NULL,
  `type_id` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `salary` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_requests`
--
ALTER TABLE `attendance_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer_contribution`
--
ALTER TABLE `employer_contribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip`
--
ALTER TABLE `payslip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_employees`
--
ALTER TABLE `type_employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `attendance_requests`
--
ALTER TABLE `attendance_requests`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employer_contribution`
--
ALTER TABLE `employer_contribution`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payslip`
--
ALTER TABLE `payslip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `type_employees`
--
ALTER TABLE `type_employees`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
