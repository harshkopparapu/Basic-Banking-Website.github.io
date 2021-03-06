-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 12:51 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sbf`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(6) NOT NULL,
  `cust_name` char(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `current_balance` int(50) NOT NULL,
  `contact_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_name`, `email`, `current_balance`, `contact_no`) VALUES
(260800, 'harsh vardan', 'harsh@gmail.com', 98955, 123654789),
(260801, 'kaushik', 'kaushik@gmail.com', 10000, 25658746),
(260802, 'charan', 'charan@gmail.com', 15000, 147852369),
(260803, 'esha reddy', 'eshareddy@gmail.com', 12525, 1596234785),
(260804, 'sharmitha', 'sharmitha@gmail.com', 13722, 1632547895),
(260805, 'kavya', 'kavya@gmail.com', 14510, 1478965235),
(260806, 'ramakrishna', 'ramakrishna@gmail.com', 75700, 1236978458),
(260807, 'hemalatha', 'hemalatha@gmail.com', 55500, 1563247896),
(260808, 'vamshi', 'vamshi@gmail.com', 25000, 1236985475),
(260809, 'gowtham', 'gowtham@gmail.com', 16200, 123659844);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `date`, `sender_id`, `receiver_id`, `amount`) VALUES
(2147483647, '2021-05-03 16:20:26', 260800, 260806, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`,`cust_name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
