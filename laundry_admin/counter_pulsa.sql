-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2021 at 03:19 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counter_pulsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `need_number` tinyint(1) NOT NULL DEFAULT 0,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(100) NOT NULL,
  `updated_on` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `need_number`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, 'Pulsa', 0, '2021-06-08 03:40:19', 'admin', NULL, ''),
(2, 'Paket Data', 0, '2021-06-08 03:40:19', 'admin', NULL, ''),
(3, 'Voucer', 0, '2021-06-08 03:40:19', 'admin', NULL, ''),
(4, 'aksesoris', 0, '2021-06-08 03:40:19', 'admin', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(100) NOT NULL,
  `updated_on` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id`, `name`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, 'Telkomsel', '2021-06-08 03:56:26', 'admin', NULL, ''),
(2, 'xl', '2021-06-08 03:56:26', 'admin', NULL, ''),
(3, 'im3', '2021-06-08 03:56:26', 'admin', NULL, ''),
(4, 'smartfren', '2021-06-08 03:56:26', 'admin', NULL, ''),
(5, '3', '2021-06-08 03:56:26', 'admin', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `transaction_code` varchar(50) NOT NULL,
  `payment_code` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `account_number_destination` varchar(100) NOT NULL,
  `bank_name_destination` varchar(100) NOT NULL,
  `path` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_operator` int(11) DEFAULT NULL,
  `saldo` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `path` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(100) NOT NULL,
  `updated_on` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `id_category`, `id_operator`, `saldo`, `price`, `type`, `path`, `description`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, 'Pulsa Telkomsel 10.000', 1, 1, 10000, 11000, NULL, '', 'Saldo pulsa Telkomsel 10.000', '2021-06-08 04:04:06', 'admin', NULL, ''),
(2, 'Pulas Telkomsel 20.000', 1, 1, 20000, 21000, NULL, '', 'pulsa 20000', '2021-06-08 04:04:24', 'admin', NULL, ''),
(3, 'Telkom 10 GB', 2, 1, 10, 20000, 'GB', '', 'Paket 10 gb', '2021-06-08 14:48:36', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `transaction_code` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `transaction_code`, `status`, `email`, `no_hp`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, 'TRX-20210608231856', 0, 'adatdt@gmail.com', '019829929', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0'),
(2, 'TRX-20210608232149', 0, 'adatdt@gmail.com', '019829929', '2021-06-08 16:21:49', '', '0000-00-00 00:00:00', ''),
(3, 'TRX-20210608232151', 0, 'adatdt@gmail.com', '019829929', '2021-06-08 16:21:51', '', '0000-00-00 00:00:00', ''),
(4, 'TRX-20210608232250', 0, 'adatdt@gmail.com', '0819771', '2021-06-08 16:22:50', '', '0000-00-00 00:00:00', ''),
(5, 'TRX-20210608232402', 0, 'adatdt@gmail.com', '0819771', '2021-06-08 16:24:02', '', '0000-00-00 00:00:00', ''),
(6, 'TRX-20210608232419', 0, 'adatdt@gmail.com', '098888', '2021-06-08 16:24:19', '', '0000-00-00 00:00:00', ''),
(7, 'TRX-20210609083855', 0, 'adatdt@gmail.com', '089999', '2021-06-09 01:38:55', '', '0000-00-00 00:00:00', ''),
(8, 'TRX-20210609084330', 0, 'adatdt@gmail.com', '11222', '2021-06-09 01:43:30', '', '0000-00-00 00:00:00', ''),
(9, 'TRX-20210609084413', 0, 'adatdt@gmail.com', '11222', '2021-06-09 01:44:13', '', '0000-00-00 00:00:00', ''),
(10, 'TRX-20210609084808', 0, 'adatdt@gmail.com', '8292882', '2021-06-09 01:48:08', '', '0000-00-00 00:00:00', ''),
(11, 'TRX-20210609085328', 0, 'adatdt@gmail.com', '8292882', '2021-06-09 01:53:28', '', '0000-00-00 00:00:00', ''),
(12, 'TRX-20210609090037', 0, 'adatdt@gmail.com', '11111', '2021-06-09 02:00:37', '', '0000-00-00 00:00:00', ''),
(13, 'TRX-20210609090508', 0, 'adatdt@gmail.com', '223222', '2021-06-09 02:05:08', '', '0000-00-00 00:00:00', ''),
(16, 'TRX-20210609160714', 0, 'adatdt@gmail.com', '1222222', '2021-06-09 09:07:14', '', '0000-00-00 00:00:00', ''),
(17, 'TRX-20210609161127', 0, 'adatdt@gmail.com', '1222222', '2021-06-09 09:11:27', '', '0000-00-00 00:00:00', ''),
(18, 'TRX-20210609161233', 0, 'adatdt@gmail.com', '1222222', '2021-06-09 09:12:33', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(11) NOT NULL,
  `transaction_code` varchar(50) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `transaction_code`, `id_product`, `price`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, '0', 1, 11000, '2021-06-08 16:18:56', 0, '0000-00-00 00:00:00', 0),
(2, '0', 1, 11000, '2021-06-08 16:21:49', 0, '0000-00-00 00:00:00', 0),
(3, '0', 1, 11000, '2021-06-08 16:21:51', 0, '0000-00-00 00:00:00', 0),
(4, '0', 1, 11000, '2021-06-08 16:22:50', 0, '0000-00-00 00:00:00', 0),
(5, '0', 1, 11000, '2021-06-08 16:24:02', 0, '0000-00-00 00:00:00', 0),
(6, '0', 1, 11000, '2021-06-08 16:24:19', 0, '0000-00-00 00:00:00', 0),
(7, '0', 1, 11000, '2021-06-09 01:38:55', 0, '0000-00-00 00:00:00', 0),
(8, '0', 1, 11000, '2021-06-09 01:43:30', 0, '0000-00-00 00:00:00', 0),
(9, '0', 1, 11000, '2021-06-09 01:44:13', 0, '0000-00-00 00:00:00', 0),
(10, '0', 1, 11000, '2021-06-09 01:48:08', 0, '0000-00-00 00:00:00', 0),
(11, '0', 1, 11000, '2021-06-09 01:53:28', 0, '0000-00-00 00:00:00', 0),
(12, '0', 1, 11000, '2021-06-09 02:00:37', 0, '0000-00-00 00:00:00', 0),
(13, '0', 1, 11000, '2021-06-09 02:05:08', 0, '0000-00-00 00:00:00', 0),
(16, 'TRX-20210609160714', 1, 11000, '2021-06-09 09:07:14', 0, '0000-00-00 00:00:00', 0),
(17, 'TRX-20210609161127', 1, 11000, '2021-06-09 09:11:27', 0, '0000-00-00 00:00:00', 0),
(18, 'TRX-20210609161233', 1, 11000, '2021-06-09 09:12:33', 0, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
