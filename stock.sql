-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2018 at 09:26 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_details`
--

CREATE TABLE `category_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(120) NOT NULL,
  `category_description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_address` varchar(500) NOT NULL,
  `customer_contact1` varchar(100) NOT NULL,
  `customer_contact2` varchar(100) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `customer_name`, `customer_address`, `customer_contact1`, `customer_contact2`, `balance`) VALUES
(14, 'Bijoy', 'Kurigram', '5454561621', '54848465', 28500),
(15, 'Ripon', 'Bogra', '4492392464', '210065329', 182250),
(16, 'Rokon', 'Rajarhat', '12346262', '5168765468', 6000),
(17, 'Rakib', 'Rangpur', '365465165453', '64564525695', 0),
(18, 'Jamil', 'Durgapur', '656595265', '6248465746', 0),
(19, 'Arif Rahman', 'Dhaka', '01754585453', '01754585454', 0),
(21, 'Jamal', 'Mirzapur', '01858586233', '01858586234', 0),
(22, 'Limon', 'Dhaka', '01740014450', '01824717625', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_avail`
--

CREATE TABLE `stock_avail` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_avail`
--

INSERT INTO `stock_avail` (`id`, `name`, `quantity`) VALUES
(70, 'STV-101', 130),
(71, 'Mobile_ASUS', 475),
(72, 'w95', 88),
(73, 'dell-laptop', 63),
(74, 'Dell-Monitor505', 80),
(75, 'ASUS-PC', 45),
(76, 'CRT-107', 505),
(77, 'lenovo-809', 25),
(78, 'Hp-703', 50),
(80, 'intel-1011', 50),
(81, 'gigabyte-G95', 60),
(82, 'processor_intel_i7', 40),
(84, 'Black_cat-203', 100),
(85, 'Black_cat-209', 150),
(87, 'TV-105', 100),
(89, 'TV-101', 200),
(90, 'Ball-Pen-501', 250),
(91, 'TV-206', 0),
(92, 'Mouse-logitech', 45);

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_id` varchar(120) NOT NULL,
  `stock_name` varchar(120) NOT NULL,
  `stock_quatity` int(11) NOT NULL,
  `supplier_id` varchar(250) NOT NULL,
  `company_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `category` varchar(120) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expire_date` datetime NOT NULL,
  `uom` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `stock_id`, `stock_name`, `stock_quatity`, `supplier_id`, `company_price`, `selling_price`, `category`, `date`, `expire_date`, `uom`) VALUES
(57, 'SD1', 'STV-101', 0, 'Uk', '10000.00', '12000.00', 'SONY-TV', '2016-12-07 17:04:55', '2016-03-12 00:00:00', ''),
(58, 'SD58', 'Mobile_ASUS', 0, 'Momin', '15000.00', '16000.00', 'M-ASUS', '2016-12-07 17:58:50', '2017-12-04 00:00:00', ''),
(59, 'SD59', 'w95', 0, 'Rayhan', '11500.00', '12000.00', 'symphony', '2016-12-07 17:59:44', '2018-01-15 00:00:00', ''),
(60, 'SD60', 'dell-laptop', 0, 'Alomgir', '50000.00', '55000.00', 'Dell', '2016-12-07 18:00:36', '2020-01-30 00:00:00', ''),
(61, 'SD61', 'Dell-Monitor505', 0, 'Uk', '7000.00', '7500.00', 'Dell-monitor', '2016-12-07 18:02:26', '2021-01-02 00:00:00', ''),
(62, 'SD62', 'ASUS-PC', 0, 'Uk', '60000.00', '65000.00', 'Dextop', '2016-12-07 18:04:03', '2020-08-09 00:00:00', ''),
(63, 'SD63', 'CRT-107', 0, 'Rayhan', '4000.00', '4500.00', 'Monitor', '2016-12-07 18:05:02', '2021-10-01 00:00:00', ''),
(64, 'SD64', 'lenovo-809', 0, 'Uk', '6000.00', '6500.00', 'lenovo', '2016-12-11 09:43:46', '2022-05-15 00:00:00', ''),
(65, 'SD65', 'Hp-703', 0, 'Momin', '8000.00', '8500.00', 'HP', '2016-12-11 09:44:52', '2021-10-01 00:00:00', ''),
(67, 'SD67', 'intel-1011', 0, 'Rayhan', '15000.00', '16000.00', 'MotherBoard', '2016-12-16 20:02:35', '2019-01-01 00:00:00', ''),
(68, 'SD68', 'gigabyte-G95', 0, 'Alomgir', '5500.00', '6000.00', 'MotherBoard', '2016-12-11 09:48:26', '2022-10-21 00:00:00', ''),
(69, 'SD69', 'processor_intel_i7', 0, 'Rayhan', '25000.00', '27000.00', 'processor', '2016-12-11 09:50:50', '2019-12-01 00:00:00', ''),
(71, 'SD71', 'Black_cat-203', 0, 'Uttom Kumar', '500.00', '650.00', 'Laptop Cooler', '2016-12-17 18:03:22', '2016-12-24 00:00:00', ''),
(72, 'SD72', 'Black_cat-209', 0, 'Fahim', '600.00', '750.00', 'Laptop Cooler', '2016-12-17 17:08:43', '2016-12-24 00:00:00', ''),
(74, 'SD73', 'TV-105', 0, 'Alomgir rahman', '30000.00', '35000.00', 'TV', '2016-12-17 17:22:49', '2016-12-30 00:00:00', ''),
(76, 'SD76', 'TV-101', 0, 'Uttom', '7000.00', '8000.00', 'TV', '2016-12-17 18:03:03', '2016-12-23 00:00:00', ''),
(77, 'SD77', 'Ball-Pen-501', 0, 'Momin', '50.00', '100.00', 'Ball-pen', '2016-12-17 18:32:37', '2017-07-20 00:00:00', ''),
(78, 'SD78', 'TV-206', 0, 'Fahim', '32000.00', '40000.00', 'TV', '2016-12-17 19:36:52', '2016-12-22 00:00:00', ''),
(79, 'SD79', 'Mouse-logitech', 0, 'Uddoy', '2000.00', '2100.00', 'Mouse', '2016-12-19 14:49:08', '2016-12-23 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_entries`
--

CREATE TABLE `stock_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_id` varchar(120) NOT NULL,
  `stock_name` varchar(260) NOT NULL,
  `stock_supplier_name` varchar(200) NOT NULL,
  `category` varchar(120) NOT NULL,
  `quantity` int(11) NOT NULL,
  `company_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `opening_stock` int(11) NOT NULL,
  `closing_stock` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(120) NOT NULL,
  `type` varchar(50) NOT NULL,
  `salesid` varchar(120) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `mode` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `due` datetime NOT NULL,
  `subtotal` int(11) NOT NULL,
  `count1` int(11) NOT NULL,
  `billnumber` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_entries`
--

INSERT INTO `stock_entries` (`id`, `stock_id`, `stock_name`, `stock_supplier_name`, `category`, `quantity`, `company_price`, `selling_price`, `opening_stock`, `closing_stock`, `date`, `username`, `type`, `salesid`, `total`, `payment`, `balance`, `mode`, `description`, `due`, `subtotal`, `count1`, `billnumber`) VALUES
(280, 'SE1', 'STV-101', 'Uk ', '', 150, '10000.00', '12000.00', 138, 138, '2016-12-07 00:00:00', 'admin', 'entry', '', '1500000.00', '1500000.00', '0.00', 'cash', 'NO Pending', '2016-12-07 00:00:00', 1500000, 1, '1'),
(281, 'SA1', 'STV-101', '', '', 3, '0.00', '12000.00', 150, 147, '2016-12-07 00:00:00', 'admin', 'sales', 'SA1', '36000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '1'),
(282, 'SA1', 'STV-101', '', '', 3, '0.00', '12000.00', 147, 144, '2016-12-07 00:00:00', 'admin', 'sales', 'SA1', '36000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '1'),
(283, 'SA49', 'STV-101', '', '', 4, '0.00', '12000.00', 144, 140, '2016-12-07 00:00:00', 'admin', 'sales', 'SA49', '48000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '2'),
(284, 'SE284', 'Mobile_ASUS', 'Uk', '', 500, '15000.00', '16000.00', 0, 500, '2016-12-07 00:00:00', 'admin', 'entry', '', '7500000.00', '7500000.00', '0.00', 'cash', '', '2016-12-07 00:00:00', 7500000, 1, '12'),
(285, 'SE285', 'dell-laptop', 'Alomgir', '', 75, '50000.00', '55000.00', 0, 75, '2016-12-07 00:00:00', 'admin', 'entry', '', '3750000.00', '3750000.00', '0.00', 'cash', '', '2016-12-07 00:00:00', 3750000, 1, '45'),
(286, 'SE286', 'w95', 'Rayhan', '', 100, '11500.00', '12000.00', 0, 100, '2016-12-07 00:00:00', 'admin', 'entry', '', '1150000.00', '1150000.00', '0.00', 'cash', '', '2016-12-07 00:00:00', 1150000, 1, '45'),
(287, 'SE287', 'Dell-Monitor505', 'Momin', '', 125, '7000.00', '7500.00', 0, 125, '2016-12-07 00:00:00', 'admin', 'entry', '', '875000.00', '875000.00', '0.00', 'cash', '', '2016-12-07 00:00:00', 875000, 1, '456'),
(288, 'SE288', 'CRT-107', 'Alomgir', '', 700, '4000.00', '4500.00', 0, 700, '2016-12-07 00:00:00', 'admin', 'entry', '', '2800000.00', '2800000.00', '0.00', 'cash', '', '2016-12-07 00:00:00', 2800000, 1, '1453'),
(289, 'SE289', 'ASUS-PC', 'Rayhan', '', 55, '60000.00', '65000.00', 0, 55, '2016-12-07 00:00:00', 'admin', 'entry', '', '3300000.00', '3300000.00', '0.00', 'cash', '', '2016-12-07 00:00:00', 3300000, 1, '258'),
(290, 'SA50', 'ASUS-PC', '', '', 5, '0.00', '65000.00', 55, 50, '2016-12-07 00:00:00', 'admin', 'sales', 'SA50', '325000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '1'),
(291, 'SA51', 'Dell-Monitor505', '', '', 4, '0.00', '7500.00', 125, 121, '2016-12-07 00:00:00', 'admin', 'sales', 'SA51', '30000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '45'),
(292, 'SA52', 'CRT-107', '', '', 45, '0.00', '4500.00', 700, 655, '2016-12-07 00:00:00', 'admin', 'sales', 'SA52', '202500.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '458'),
(293, 'SA53', 'w95', '', '', 12, '0.00', '12000.00', 100, 88, '2016-12-07 00:00:00', 'admin', 'sales', 'SA53', '144000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '78'),
(294, 'SA54', 'Mobile_ASUS', '', '', 10, '0.00', '16000.00', 500, 490, '2016-11-01 00:00:00', 'admin', 'sales', 'SA54', '160000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '145'),
(295, 'SA54', 'STV-101', '', '', 2, '0.00', '12000.00', 140, 138, '2016-11-01 00:00:00', 'admin', 'sales', 'SA54', '24000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '145'),
(296, 'SA56', 'CRT-107', '', '', 55, '0.00', '4500.00', 655, 600, '2016-10-01 00:00:00', 'admin', 'sales', 'SA56', '247500.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '458'),
(297, 'SA57', 'Mobile_ASUS', '', '', 10, '0.00', '16000.00', 490, 480, '2016-09-01 00:00:00', 'admin', 'sales', 'SA57', '160000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '859'),
(298, 'SA58', 'Dell-Monitor505', '', '', 45, '0.00', '7500.00', 121, 76, '2016-08-01 00:00:00', 'admin', 'sales', 'SA58', '337500.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '485'),
(299, 'SE299', 'processor_intel_i7', 'Rayhan ', '', 40, '25000.00', '27000.00', 40, 40, '2016-12-11 00:00:00', 'admin', 'entry', '', '1000000.00', '1000000.00', '0.00', 'cash', 'No due', '2016-12-11 00:00:00', 1000000, 1, '1'),
(300, 'SE300', 'gigabyte-G95', 'Alomgir  ', '', 60, '5500.00', '6000.00', 60, 60, '2016-12-11 00:00:00', 'admin', 'entry', '', '330000.00', '330000.00', '0.00', 'cash', 'No due', '2016-12-11 00:00:00', 330000, 1, '2'),
(301, 'SE301', 'intel-1011', 'Rayhan', '', 23, '15000.00', '16000.00', 0, 23, '2016-12-11 00:00:00', 'admin', 'entry', '', '345000.00', '314022.00', '30978.00', 'cash', '', '2016-12-24 00:00:00', 345000, 1, '3'),
(303, 'SE303', 'Hp-703', 'Momin', '', 25, '8000.00', '8500.00', 0, 25, '2016-12-11 00:00:00', 'admin', 'entry', '', '200000.00', '200000.00', '0.00', 'cash', '', '2016-12-11 00:00:00', 200000, 1, '5'),
(304, 'SE304', 'lenovo-809', 'Uk', '', 25, '6000.00', '6500.00', 0, 25, '2016-12-11 00:00:00', 'admin', 'entry', '', '150000.00', '155000.00', '-5000.00', 'cash', '', '2016-12-16 00:00:00', 150000, 1, '6'),
(305, 'SE305', 'Graphics-150', 'Alomgir', '', 200, '18000.00', '19000.00', 0, 200, '2016-12-11 00:00:00', 'admin', 'entry', '', '3600000.00', '3600000.00', '0.00', 'cash', '', '2016-12-11 00:00:00', 3600000, 1, '15'),
(306, 'SA59', 'CRT-107', '', '', 150, '0.00', '4500.00', 600, 450, '2016-04-19 00:00:00', 'admin', 'sales', 'SA59', '675000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '14'),
(309, 'SA62', 'ASUS-PC', '', '', 5, '0.00', '65000.00', 50, 45, '1970-01-01 00:00:00', 'admin', 'sales', 'SA62', '325000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '16'),
(311, 'SA64', 'Mobile_ASUS', '', '', 5, '0.00', '16000.00', 480, 475, '2016-12-11 00:00:00', 'admin', 'sales', 'SA64', '80000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '123'),
(312, 'SA65', 'dell-laptop', '', '', 10, '0.00', '55000.00', 75, 65, '2016-12-13 00:00:00', 'admin', 'sales', 'SA65', '550000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '12555'),
(313, 'SA66', 'dell-laptop', '', '', 2, '0.00', '55000.00', 65, 63, '2016-12-15 00:00:00', 'admin', 'sales', 'SA66', '110000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '12'),
(314, 'SE314', 'Dell-Monitor505', 'Uk  ', '', 4, '7000.00', '7500.00', 80, 80, '2016-12-17 00:00:00', 'admin', 'entry', '', '28000.00', '23001.00', '4999.00', 'cash', 'Due', '2017-03-17 00:00:00', 28000, 1, '1'),
(315, 'SA67', 'STV-101', '', '', 8, '0.00', '12000.00', 138, 130, '2016-12-17 00:00:00', 'admin', 'sales', 'SA67', '96000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '2'),
(316, 'SE316', 'CRT-107', 'Uk', '', 55, '4000.00', '4500.00', 450, 505, '2016-12-17 00:00:00', 'admin', 'entry', '', '220000.00', '220000.00', '0.00', 'cash', '', '2016-12-17 00:00:00', 220000, 1, '4'),
(317, 'SE317', 'intel-1011', 'Alomgir ', '', 27, '15000.00', '16000.00', 50, 50, '2016-12-17 00:00:00', 'admin', 'entry', '', '405000.00', '405000.00', '0.00', 'cash', '', '2016-12-17 00:00:00', 405000, 1, '6'),
(319, 'SE319', 'Hp-703', 'Alomgir ', '', 25, '8000.00', '8500.00', 50, 50, '2016-12-18 00:00:00', 'admin', 'entry', '', '200000.00', '200000.00', '0.00', 'cash', '', '2016-12-17 00:00:00', 200000, 1, '6'),
(320, 'SE320', 'TV-105', 'Alomgir ', '', 100, '30000.00', '35000.00', 100, 100, '2016-12-17 00:00:00', 'admin', 'entry', '', '3000000.00', '3000000.00', '0.00', 'cash', '', '2016-12-17 00:00:00', 3000000, 1, '6'),
(321, 'SE321', 'Black_cat-203', 'fahim', '', 100, '500.00', '650.00', 0, 100, '2016-12-17 00:00:00', 'admin', 'entry', '', '50000.00', '50000.00', '0.00', 'cash', '', '2016-12-17 00:00:00', 50000, 1, '7'),
(322, 'SE322', 'Black_cat-209', 'Fahim', '', 150, '600.00', '750.00', 0, 150, '2016-12-17 00:00:00', 'admin', 'entry', '', '90000.00', '90000.00', '0.00', 'cash', '', '2016-12-17 00:00:00', 90000, 1, '7'),
(323, 'SE323', 'Ball-Pen-501', 'Rayhan', '', 250, '50.00', '100.00', 0, 250, '2016-12-17 00:00:00', 'admin', 'entry', '', '12500.00', '12500.00', '0.00', 'cash', '', '2016-12-17 00:00:00', 12500, 1, '56'),
(324, 'SE324', 'TV-101', 'Rohan', '', 200, '7000.00', '8000.00', 0, 200, '2016-12-17 00:00:00', 'admin', 'entry', '', '1400000.00', '1400000.00', '0.00', 'cash', '', '2016-12-17 00:00:00', 1400000, 1, '12'),
(326, 'SE326', 'Mouse-logitech', 'Emon', '', 50, '2000.00', '2200.00', 0, 50, '2016-12-17 00:00:00', 'admin', 'entry', '', '100000.00', '100000.00', '0.00', 'cash', 'No Due', '2016-12-17 00:00:00', 100000, 1, '1'),
(327, 'SA68', 'Mouse-logitech', '', '', 5, '0.00', '2200.00', 50, 45, '2016-12-17 00:00:00', 'admin', 'sales', 'SA68', '11000.00', '0.00', '0.00', '', '', '0000-00-00 00:00:00', 0, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `stock_sales`
--

CREATE TABLE `stock_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `transactionid` varchar(250) NOT NULL,
  `stock_name` varchar(200) NOT NULL,
  `category` varchar(120) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(120) NOT NULL,
  `customer_id` varchar(120) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `due` datetime NOT NULL,
  `mode` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `count1` int(11) NOT NULL,
  `billnumber` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_sales`
--

INSERT INTO `stock_sales` (`id`, `transactionid`, `stock_name`, `category`, `supplier_name`, `selling_price`, `quantity`, `amount`, `date`, `username`, `customer_id`, `subtotal`, `payment`, `balance`, `due`, `mode`, `description`, `count1`, `billnumber`) VALUES
(47, 'SA1', 'STV-101', '', '', '12000.00', '3.00', '36000.00', '2016-12-07 00:00:00', 'admin', 'Farhad', '36000.00', '36000.00', '0.00', '2016-12-07 00:00:00', 'cash', '', 1, '1'),
(48, 'SA1', 'STV-101', '', '', '12000.00', '3.00', '36000.00', '2016-12-07 00:00:00', 'admin', 'Farhad', '36000.00', '36000.00', '0.00', '2016-12-07 00:00:00', 'cash', '', 1, '1'),
(49, 'SA49', 'STV-101', '', '', '12000.00', '4.00', '48000.00', '2016-12-07 00:00:00', 'admin', 'Farhad', '48000.00', '48000.00', '0.00', '2016-12-07 00:00:00', 'cash', '', 1, '2'),
(50, 'SA50', 'ASUS-PC', '', '', '65000.00', '5.00', '325000.00', '2016-12-07 00:00:00', 'admin', 'Farhad', '325000.00', '325000.00', '0.00', '2016-12-07 00:00:00', 'cash', '', 1, '1'),
(51, 'SA51', 'Dell-Monitor505', '', '', '7500.00', '4.00', '30000.00', '2016-12-07 00:00:00', 'admin', 'Bijoy', '30000.00', '30000.00', '0.00', '2016-12-07 00:00:00', 'cash', '', 1, '45'),
(52, 'SA52', 'CRT-107', '', '', '4500.00', '45.00', '202500.00', '2016-12-07 00:00:00', 'admin', 'Ripon', '202500.00', '202500.00', '0.00', '2017-12-08 00:00:00', 'cash', '', 1, '458'),
(53, 'SA53', 'w95', '', '', '12000.00', '12.00', '12000.00', '2016-12-07 00:00:00', 'admin', 'Rokon', '12000.00', '144000.00', '0.00', '2016-12-16 00:00:00', 'cash', '', 1, '78'),
(54, 'SA54', 'Mobile_ASUS', '', '', '16000.00', '10.00', '160000.00', '2016-11-01 00:00:00', 'admin', 'Farhad', '184000.00', '184000.00', '0.00', '2016-12-07 00:00:00', 'cash', '', 1, '145'),
(55, 'SA54', 'STV-101', '', '', '12000.00', '2.00', '24000.00', '2016-11-01 00:00:00', 'admin', 'Farhad', '184000.00', '184000.00', '0.00', '2016-12-07 00:00:00', 'cash', '', 2, '145'),
(56, 'SA56', 'CRT-107', '', '', '4500.00', '55.00', '247500.00', '2016-10-01 00:00:00', 'admin', 'Rakib', '247500.00', '247500.00', '0.00', '2016-12-07 00:00:00', 'cash', '', 1, '458'),
(57, 'SA57', 'Mobile_ASUS', '', '', '16000.00', '10.00', '160000.00', '2016-09-01 00:00:00', 'admin', 'Rakib', '160000.00', '160000.00', '0.00', '2016-12-07 00:00:00', 'cash', '', 1, '859'),
(58, 'SA58', 'Dell-Monitor505', '', '', '7500.00', '45.00', '337500.00', '2016-08-01 00:00:00', 'admin', 'Bijoy', '337500.00', '337500.00', '0.00', '2016-12-07 00:00:00', 'cash', '', 1, '485'),
(59, 'SA59', 'CRT-107', '', '', '4500.00', '150.00', '675000.00', '2016-04-19 00:00:00', 'admin', 'Farhad', '675000.00', '661895.00', '13105.00', '2018-08-16 00:00:00', 'cash', 'due', 1, '14'),
(60, 'SA60', 'Graphics-150', '', '', '19000.00', '10.00', '19000.00', '2016-12-11 00:00:00', 'admin', 'Rakib', '19000.00', '190000.00', '0.00', '2016-12-11 00:00:00', 'cash', 'No due', 1, '15'),
(61, 'SA61', 'Graphics-150', '', '', '19000.00', '5.00', '95000.00', '2016-07-04 00:00:00', 'admin', 'Farhad', '95000.00', '95000.00', '0.00', '2016-12-11 00:00:00', 'cash', '', 1, '123'),
(62, 'SA62', 'ASUS-PC', '', '', '65000.00', '5.00', '325000.00', '1970-01-01 00:00:00', 'admin', 'Farhad', '325000.00', '325000.00', '0.00', '2016-12-11 00:00:00', 'cash', '', 1, '16'),
(63, 'SA63', 'Stack', '', '', '3500.00', '5.00', '175000.00', '2016-02-01 00:00:00', 'admin', 'Ripon', '175000.00', '175000.00', '0.00', '2016-12-11 00:00:00', 'cash', '', 1, '589'),
(64, 'SA64', 'Mobile_ASUS', '', '', '16000.00', '5.00', '80000.00', '2016-12-11 00:00:00', 'admin', 'Farhad', '80000.00', '80000.00', '0.00', '2019-12-11 00:00:00', 'cash', '', 1, '123'),
(65, 'SA65', 'dell-laptop', '', '', '55000.00', '10.00', '550000.00', '2016-12-13 00:00:00', 'admin', 'Farhad', '550000.00', '550000.00', '0.00', '2016-12-13 00:00:00', 'cash', 'Paid', 1, '12555'),
(66, 'SA66', 'dell-laptop', '', '', '55000.00', '2.00', '55000.00', '2016-12-15 00:00:00', 'admin', 'Farhad', '55000.00', '110000.00', '0.00', '2016-12-16 00:00:00', 'cash', 'Paid', 1, '12'),
(67, 'SA67', 'STV-101', '', '', '12000.00', '8.00', '96000.00', '2016-12-17 00:00:00', 'admin', 'Rokon', '96000.00', '91000.00', '5000.00', '2016-12-24 00:00:00', 'cash', 'Due', 1, '2'),
(68, 'SA68', 'Mouse-logitech', '', '', '2200.00', '5.00', '11000.00', '2016-12-17 00:00:00', 'admin', 'Limon', '11000.00', '11000.00', '0.00', '2017-12-17 00:00:00', 'cash', '', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `stock_user`
--

CREATE TABLE `stock_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_user`
--

INSERT INTO `stock_user` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_details`
--

CREATE TABLE `supplier_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `supplier_address` varchar(500) NOT NULL,
  `supplier_contact1` varchar(100) NOT NULL,
  `supplier_contact2` varchar(100) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_details`
--

INSERT INTO `supplier_details` (`id`, `supplier_name`, `supplier_address`, `supplier_contact1`, `supplier_contact2`, `balance`) VALUES
(9, 'Alomgir', 'Kurigram', '01745154644', '01746814492', 0),
(10, 'Momin', 'Khulna', '018884564165', '015586718374', 0),
(11, 'Rayhan', 'Brammon_baria', '01746516796', '01987647614', 35000),
(12, 'Rohan', 'Gazipur', '01996586256', '01996586250', 0),
(13, 'Fahim', 'Nator', '01879644340', '01879644344', 100),
(14, 'Haque', 'Rangpur', '01821558857', '01821558858', 0),
(16, 'Faruk', 'Dhaka', '01778962530', '01778962537', 0),
(17, 'Uttom', 'Kurigram', '01740012960', '01740015430', 5000),
(18, 'Uddoy', 'Kurigram', '01740012951', '01824717184', 0),
(19, 'Emon', 'Dhaka', '01785642359', '01923569845', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL,
  `customer` varchar(250) NOT NULL,
  `supplier` varchar(250) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `due` datetime NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rid` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `customer`, `supplier`, `subtotal`, `payment`, `balance`, `due`, `date`, `rid`) VALUES
(33, 'entry', '', '', '345000.00', '3000.00', '32000.00', '2016-12-11 00:00:00', '2016-12-15 09:14:32', 'SE301'),
(32, 'Sales', 'Farhad', '', '0.00', '1000.00', '14000.00', '2016-12-11 00:00:00', '2016-12-15 09:13:24', 'RCPT31'),
(31, 'Sales', 'Ripon', '', '0.00', '136036.00', '0.00', '2017-12-08 00:00:00', '2016-12-15 09:12:11', 'RCPT30'),
(30, 'Sales', 'Ripon', '', '0.00', '136.00', '136036.00', '2017-12-08 00:00:00', '2016-12-07 18:44:56', 'RCPT29'),
(28, 'Sales', 'Ripon', '', '0.00', '182.00', '182068.00', '2016-12-07 00:00:00', '2016-12-07 18:44:03', 'RCPT27'),
(29, 'Sales', 'Ripon', '', '0.00', '45896.00', '136172.00', '2016-12-07 00:00:00', '2016-12-07 18:44:11', 'RCPT28'),
(27, 'Sales', 'Bijoy', '', '0.00', '500.00', '0.00', '2016-12-07 00:00:00', '2016-12-07 18:43:52', 'RCPT26'),
(26, 'Sales', 'Bijoy', '', '0.00', '28000.00', '0.00', '2016-12-07 00:00:00', '2016-12-07 18:43:41', 'RCPT'),
(34, 'Sales', 'Farhad', '', '0.00', '495.00', '13505.00', '2016-12-09 00:00:00', '2016-12-16 20:47:21', 'RCPT33'),
(35, 'Sales', 'Farhad', '', '0.00', '200.00', '13305.00', '2016-12-10 00:00:00', '2016-12-16 20:47:51', 'RCPT34'),
(36, 'Sales', 'Farhad', '', '0.00', '200.00', '13105.00', '2018-08-16 00:00:00', '2016-12-16 20:49:35', 'RCPT35'),
(37, 'entry', '', '', '345000.00', '200.00', '31800.00', '2016-12-23 00:00:00', '2016-12-16 20:57:03', 'SE301'),
(38, 'entry', '', '', '150000.00', '50000.00', '-5000.00', '2016-12-16 00:00:00', '2016-12-16 20:57:23', 'SE304'),
(39, 'entry', '', '', '345000.00', '800.00', '31000.00', '2016-12-24 00:00:00', '2016-12-16 20:58:28', 'SE301'),
(40, 'entry', '', '', '28000.00', '2000.00', '6000.00', '2017-03-17 00:00:00', '2016-12-17 11:20:40', 'SE314'),
(41, 'entry', '', '', '28000.00', '1000.00', '5000.00', '2017-03-17 00:00:00', '2016-12-17 11:25:18', 'SE314'),
(42, 'Sales', 'Rokon', '', '0.00', '1000.00', '5000.00', '2016-12-24 00:00:00', '2016-12-17 11:54:00', 'RCPT41'),
(43, 'entry', '', 'Uk  ', '28000.00', '1.00', '4999.00', '2017-03-17 00:00:00', '2016-12-17 12:16:17', 'SE314'),
(44, 'entry', '', 'Rayhan', '345000.00', '22.00', '30978.00', '2016-12-24 00:00:00', '2016-12-17 12:50:56', 'SE301'),
(45, 'entry', '', 'Uttom', '45000.00', '2500.00', '2500.00', '2016-12-17 00:00:00', '2016-12-17 18:46:52', 'SE325'),
(46, 'entry', '', 'Fahim', '1000.00', '100.00', '0.00', '2016-12-20 00:00:00', '2016-12-20 04:21:20', 'SE328');

-- --------------------------------------------------------

--
-- Table structure for table `uom_details`
--

CREATE TABLE `uom_details` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(120) NOT NULL,
  `spec` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_details`
--
ALTER TABLE `category_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_avail`
--
ALTER TABLE `stock_avail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_entries`
--
ALTER TABLE `stock_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_sales`
--
ALTER TABLE `stock_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_user`
--
ALTER TABLE `stock_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_details`
--
ALTER TABLE `supplier_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uom_details`
--
ALTER TABLE `uom_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_details`
--
ALTER TABLE `category_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `stock_avail`
--
ALTER TABLE `stock_avail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `stock_entries`
--
ALTER TABLE `stock_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;
--
-- AUTO_INCREMENT for table `stock_sales`
--
ALTER TABLE `stock_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `stock_user`
--
ALTER TABLE `stock_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `supplier_details`
--
ALTER TABLE `supplier_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `uom_details`
--
ALTER TABLE `uom_details`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
