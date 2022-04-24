-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2022 at 08:34 AM
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
(13, 'c2gn38bzpx4', 'TITI', 'More on nudes', 1, '', 1);

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
(15, 'cnxh2870tbd', '2022-04-16', 'c2gn38bzpx4', 'KJFGLKJDG158', 'asdasfasfasfasfasf', 0),
(16, 'phr7zk4wv6a', '2022-04-16', 'c2gn38bzpx4', 'KJFGLKJDG158', 'asfasf', 1),
(17, 'tlsg4evhy6i', '2022-04-16', 'c2gn38bzpx4', 'KJFGLKJDG158', 'test 1', 2),
(18, 'penvj72d0t3', '2022-04-16', 'c2gn38bzpx4', 'KJFGLKJDG158', 'qweqweqwe', 0),
(19, '0iyehazqxk3', '2022-04-16', 'c2gn38bzpx4', 'KJFGLKJDG158', 'shet nakapag deal pero di legit\n', 2),
(20, 'z4ckbqt6hm2', '2022-04-16', 'c2gn38bzpx4', 'KJFGLKJDG158', 'eto legit na talaga', 1),
(21, 'wg2xcjhepr6', '2022-04-16', 'ASDHJKFGFG', 'GUOSS8123', 'Test BBROSE my love', 0);

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
  `account_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `type_id`, `salary_id`, `firstname`, `middlename`, `lastname`, `email`, `contact_number`, `extension_number`, `date_added`, `password`, `avatar`, `team_leader`, `account_id`) VALUES
(1, 'KJFGLKJDG158', '1', 'FDOIAD', 'Mark Louie test', 'Arancon', 'Luna', 'mark@gmail.com', '091235675687', '1001', '2022-04-16', '123123', '1.png', 1, 'c2gn38bzpx4'),
(2, 'GUOSS8123', '3', 'FDOIAD', 'Baby Rosse Test Mahal kita bbrose', 'Baylon', 'Baylon test', 'mybaby@gmail.com', '091235675687', '1002', '2022-04-16', '123123', '1.png', 0, 'ASDHJKFGFG'),
(4, 'A65S4D56A41G', '2', 'FDOIAD', 'Loveqwe', 'Love', 'hehe', 'hr@gmail.com', '091235675687', '1004', '2022-04-16', '123123', '1.png', 0, 'ASDHJKFGFG'),
(5, '45GERLKIHE', '2', 'FDOIAD', 'Noelqwe', 'E', '', 'noel@gmail.com', '091235675687', '1004', '2022-04-16', '123123', '1.png', 0, 'DFHLKDFH'),
(6, 'FGGKJKJHDS', '1', 'FDOIAD', 'Carmela', 'E', 'Garcia', 'noel@gmail.com', '091235675687', '1005', '2022-04-16', '123123', '1.png', 0, 'DFHLKDFH'),
(7, '52qcfrsgyj3', '3', '', 'DAVE SPENCER', '', 'BACAY', 'spencerbacay@gmail.com', '', '12222', '0000-00-00', '123123', '1.png', 0, 'HKSDGJJDF'),
(8, 'dmi1rle2y5j', '', '', 'DAVE SPENCER TEST', '', 'BACAY', 'spencerbacay@gmail.com', '+639063276417', '123', '0000-00-00', '24214214124', '1.png', 0, 'c2gn38bzpx4');

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
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `type_employees`
--
ALTER TABLE `type_employees`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
