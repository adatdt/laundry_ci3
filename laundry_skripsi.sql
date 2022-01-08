-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2021 at 11:54 AM
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
(1, 'Telkomsel', '2021-06-26 16:30:49', '', NULL, ''),
(2, '3', '2021-06-26 16:30:49', '', NULL, ''),
(3, 'im3', '2021-06-26 16:30:49', '', NULL, ''),
(4, 'smartfren', '2021-06-08 03:56:26', 'admin', NULL, ''),
(5, 'XL', '2021-06-26 16:31:50', 'admin', NULL, '');

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

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `transaction_code`, `payment_code`, `amount`, `bank_name`, `account_name`, `account_number`, `account_number_destination`, `bank_name_destination`, `path`, `created_on`, `created_by`) VALUES
(3, 'TRX-20210619095714', 'PYM-20210619095828', 1221111, 'ovo', 'abdi', '3090191', '0899009888', 'OVO', './uploads/img-20210619095828.png', '2021-06-19 02:58:28', ''),
(4, 'TRX-20210619114236', 'PYM-20210619205953', 220000, 'BNI', 'abdi', '3090191', '082678888', 'BNI', './uploads/img-20210619205953.png', '2021-06-19 13:59:53', ''),
(5, 'TRX-20210619231308', 'PYM-20210619231414', 210000, 'BNI', 'abdi', '3090191', '082678888', 'BNI', './counter_pulsa/uploads/img-20210619231414.png', '2021-06-19 16:14:14', ''),
(6, 'TRX-20210619231503', 'PYM-20210619231600', 1221111, 'BNI', 'abdi', '3090191', '082678888', 'BNI', './counter_pulsa_admin/uploads/img-20210619231600.png', '2021-06-19 16:16:00', ''),
(7, 'TRX-20210619231853', 'PYM-20210619231947', 1221111, 'BNI', 'abdi', '3090191', '082678888', 'BNI', './uploads/img-20210619231947.png', '2021-06-19 16:19:47', '');

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
(2, 'Pulas Telkomsel 20.000', 1, 1, 20000, 21000, NULL, '', 'pulsa 20000', '2021-06-08 04:04:24', 'admin', NULL, ''),
(3, 'Telkom 10 GB', 2, 1, 10, 20000, 'GB', '', 'Paket 10 gb', '2021-06-08 14:48:36', '', NULL, ''),
(4, 'Pulsa 3 50.000', 1, 5, 500000, 550000, '', '', 'Pulsa 3 sebesar 50.000 , bonus bicara sesama 3', '2021-06-26 16:27:04', 'admin', '2021-06-26 16:27:04', 'admin');

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
(19, 'TRX-20210619095714', 2, 'adatdt@gmail.com', '0899988772', '2021-06-19 04:02:51', '', '2021-06-19 11:02:51', 'admin'),
(20, 'TRX-20210619114236', 2, 'adatdt@gmail.com', '5666666', '2021-06-19 14:00:26', '', '2021-06-19 21:00:26', 'admin'),
(22, 'TRX-20210619231308', 2, 'adatdt@gmail.com', '09888', '2021-06-19 16:18:30', '', '2021-06-19 23:18:30', 'admin'),
(23, 'TRX-20210619231503', 2, 'adatdt@gmail.com', '2221111', '2021-06-19 16:18:32', '', '2021-06-19 23:18:32', 'admin'),
(24, 'TRX-20210619231853', 1, 'adatdt@gmail.com', '0910111', '2021-06-19 16:19:48', '', '2021-06-19 23:19:47', '');

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
(19, 'TRX-20210619095714', 2, 21000, '2021-06-19 02:57:14', 0, '0000-00-00 00:00:00', 0),
(20, 'TRX-20210619114236', 3, 20000, '2021-06-19 04:42:36', 0, '0000-00-00 00:00:00', 0),
(22, 'TRX-20210619231308', 2, 21000, '2021-06-19 16:13:08', 0, '0000-00-00 00:00:00', 0),
(23, 'TRX-20210619231503', 3, 20000, '2021-06-19 16:15:03', 0, '0000-00-00 00:00:00', 0),
(24, 'TRX-20210619231853', 1, 11000, '2021-06-19 16:18:53', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `address` varchar(250) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `id_group` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `address`, `no_hp`, `id_group`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin1', 'bekasi', '089999', 1, '2021-06-27 03:12:21', 'admin', '2021-06-27 10:12:21', 'admin');

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
