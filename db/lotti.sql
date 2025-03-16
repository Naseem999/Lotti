-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2021 at 07:17 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lotti`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `phone`, `pass`) VALUES
(1, 'admin', 'admin@gmail.com', '1234567890', '$2y$10$wFhE4R1AkLk9rbvFJXE/mOnDNuf1JJ/eDJTvnIZVmlaxFR0tiZ9m6');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(255) NOT NULL,
  `users_id` int(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `bid_number` int(255) NOT NULL,
  `number_bid_value` double(10,2) NOT NULL,
  `date` date NOT NULL,
  `timestamp_` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `users_id`, `user_email`, `bid_number`, `number_bid_value`, `date`, `timestamp_`) VALUES
(32, 7, 'test@gmail.com', 2, 50.00, '2021-01-31', '15:41:39'),
(33, 7, 'test@gmail.com', 2, 50.00, '2021-01-31', '15:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `id` int(255) NOT NULL,
  `winner_email` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `timestamp_` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`id`, `winner_email`, `amount`, `timestamp_`) VALUES
(8, 'test@gmail.com', 100.00, '2021-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(255) NOT NULL,
  `request_type` enum('withdraw','add') NOT NULL,
  `request_to` varchar(255) NOT NULL,
  `request_from` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `ifsc` varchar(255) NOT NULL,
  `upi` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `timestamp_` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `request_type`, `request_to`, `request_from`, `account_no`, `ifsc`, `upi`, `amount`, `status`, `timestamp_`) VALUES
(19, 'add', 'admin', '7', '93i093009', '12345KK', '', 100.00, 'Checked', '2021-02-10 23:57:06'),
(20, 'add', 'admin', '8', '93i093009', '12345KK', '', 100.00, 'Checked', '2021-02-11 15:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `balance` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `address`, `phone`, `pass`, `balance`) VALUES
(7, 'test', 'test@gmail.com', 'city-test,state-patiala,p.o-test', '1234567890', '$2y$10$WZe4Rj60jGfflgdIPjXKK.QPLnlCkknXDugH9Y5Yo7NjZUR6Tnu.m', 200.00),
(8, 'testo', 'naseem98550@gmail.com', 'Village-Dhanouri,PO-Allowal,Dist-Patiala', '123', '$2y$10$cT.78.KB2cZTJNsRlHKbR.72BRCB1wIaOqX90cUIdBxScq8eqPwBq', 100.00),
(9, 'tes', 'test98550@gmail.com', 'city-test,state-patiala,p.o-test', '7888687509', '$2y$10$dNciHCtIV00HjSC275Sse.nvBExnG.r2A9zVU2w.jEPP3eFpMrmoe', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `winlist`
--

CREATE TABLE `winlist` (
  `id` int(255) NOT NULL,
  `win_number` int(255) NOT NULL,
  `win_username` varchar(255) NOT NULL,
  `win_user_email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `winlist`
--

INSERT INTO `winlist` (`id`, `win_number`, `win_username`, `win_user_email`, `date`, `time`) VALUES
(29, 2, 'test', 'test@gmail.com', '2021-01-31', '15:43:34'),
(30, 2, 'test', 'test@gmail.com', '2021-01-31', '15:43:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `winlist`
--
ALTER TABLE `winlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `winlist`
--
ALTER TABLE `winlist`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
