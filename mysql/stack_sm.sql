-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2019 at 03:36 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stack_sm`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `department_name` text NOT NULL,
  `visible_for` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `department_name`, `visible_for`, `create_date`) VALUES
(1, 'Dept 1', '2,3', '2019-08-10 20:53:00'),
(2, 'Dept 2', '2,3', '2019-08-10 20:53:08'),
(3, 'Dept 3', '2,3', '2019-08-10 20:53:13'),
(4, 'Dept 4', '2,3', '2019-08-10 20:53:22'),
(5, 'Dept 5', '2,3', '2019-08-10 20:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `dept_id`, `product_name`, `create_date`) VALUES
(1, 1, 'Product 1 ', '2019-08-10 21:18:41'),
(2, 2, 'Product 2', '2019-08-10 21:20:48'),
(3, 3, 'Product 3', '2019-08-10 21:20:54'),
(4, 4, 'Product 4', '2019-08-10 21:21:00'),
(5, 5, 'Product 5', '2019-08-10 21:21:06'),
(6, 6, 'Product 6', '2019-09-08 16:26:12'),
(7, 1, 'Product 11', '2019-11-17 15:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `quantity` int(225) NOT NULL,
  `previous_quantity` int(11) NOT NULL,
  `check_val` int(1) DEFAULT 0,
  `create_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_stock`
--

INSERT INTO `product_stock` (`id`, `uid`, `product_id`, `dept_id`, `quantity`, `previous_quantity`, `check_val`, `create_date`, `updated_date`) VALUES
(1, 2, 1, 1, 10, 0, NULL, '2019-12-15 04:53:19', '0000-00-00 00:00:00'),
(2, 2, 7, 1, 100, 0, NULL, '2019-12-15 04:53:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `uid` int(16) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_role` varchar(30) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `social_type` varchar(225) NOT NULL,
  `social_id` varchar(50) NOT NULL,
  `token` varchar(1000) NOT NULL,
  `device_id` varchar(225) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`uid`, `username`, `user_role`, `password`, `email`, `phone`, `social_type`, `social_id`, `token`, `device_id`, `create_date`, `last_login_time`) VALUES
(1, 'superadmin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'vickydesai8002@gmail.com', '7889788956', '', '', '', '', '2019-08-10 11:15:44', '0000-00-00 00:00:00'),
(2, 'user1', 'user', '21232f297a57a5a743894a0e4a801fc3', '', NULL, '', '', '', '', '2019-08-10 22:06:36', '0000-00-00 00:00:00'),
(3, 'user2', 'user', '21232f297a57a5a743894a0e4a801fc3', '', NULL, '', '', '', '', '2019-08-11 22:11:29', '0000-00-00 00:00:00'),
(4, 'user3', 'user', '21232f297a57a5a743894a0e4a801fc3', '', NULL, '', '', '', '', '2019-08-11 22:11:41', '0000-00-00 00:00:00'),
(5, 'user4', 'user', '21232f297a57a5a743894a0e4a801fc3', '', NULL, '', '', '', '', '2019-08-11 22:11:52', '2019-08-11 22:11:52'),
(6, 'user5', 'user', '21232f297a57a5a743894a0e4a801fc3', '', NULL, '', '', '', '', '2019-08-11 22:12:04', '2019-08-11 22:12:04'),
(7, 'user 6', 'user', '21232f297a57a5a743894a0e4a801fc3', '', NULL, '', '', '', '', '2019-08-11 22:51:48', '2019-08-11 22:51:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_stock`
--
ALTER TABLE `product_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `uid` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
