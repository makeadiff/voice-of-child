-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2018 at 09:31 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_momoz`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `id` int(5) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `fName` text NOT NULL,
  `fUrl` text NOT NULL,
  `pName` text NOT NULL,
  `pUrl` text NOT NULL,
  `price` text NOT NULL,
  `bPrice` text NOT NULL,
  `bKashNumber` text NOT NULL,
  `transaction` text NOT NULL,
  `ownBKash` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`id`, `name`, `address`, `phone`, `fName`, `fUrl`, `pName`, `pUrl`, `price`, `bPrice`, `bKashNumber`, `transaction`, `ownBKash`, `comment`) VALUES
(1, 'aaaaaa', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'Fazle Rabbi Ador', 'add_info();', 'add_info();', 'add_info();', 'add_info();', 'add_info();', 'add_info();', 'add_info();', 'add_info();', 'add_info();', 'add_info();', 'add_info();', 'add_info();'),
(3, 'Fazle Rabbi Ador', 'Agargaon Taltola Govt Colony. Kollol: Ga/104', '01521101414', 'Fazle Rabbi Ador', 'https://www.facebook.com/aujisti.ador', 'Xiaomi Note 5A', 'https://www.facebook.com/aujisti.ador', '15500 Tk', '16000 Tk', '1414', '987654321', '01677577052', 'Demo Try...............');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
