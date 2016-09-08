-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2016 at 10:15 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `expenses` int(11) NOT NULL,
  `reason_for_expenditure` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `exp_date`, `expenses`, `reason_for_expenditure`) VALUES
(1, '2015-11-21', 5000, 'Bought candles, serviet and sugar'),
(5, '2015-11-22', 6000, 'yo update the stock'),
(6, '2016-01-21', 2500, 'Test'),
(7, '2016-01-22', 1200, 'ABCD'),
(8, '2016-02-15', 6000, 'A new expenditure'),
(9, '2016-02-17', 2000, 'update stock'),
(10, '2016-02-23', 5000, 'test'),
(11, '2016-02-26', 1000, 'test expense');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `noinstock` int(11) NOT NULL,
  `priceperunit` int(11) NOT NULL,
  `update_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `noinstock`, `priceperunit`, `update_date`, `status`) VALUES
(1, 'Delmonte', 4, 300, '2016-02-24', 0),
(2, 'Afya ', 0, 250, '2016-02-25', 1),
(3, 'Ciroc Vodka', 7, 3000, '2016-01-13', 1),
(4, 'Johnie Walker Red Label', 7, 4000, '2016-02-26', 1),
(5, 'Best Whiskey 750ml', 15, 1000, '0000-00-00', 1),
(7, 'Red Bull Energy Drink', 20, 150, '0000-00-00', 1),
(9, 'Daima Milk', 10, 100, '0000-00-00', 1),
(10, 'Yoghurt ', 9, 150, '2016-01-22', 1),
(11, 'Mineral Water', 24, 100, '0000-00-00', 1),
(12, 'Guarana', 23, 150, '2016-02-24', 0),
(13, 'Coca-Cola', 48, 100, '0000-00-00', 1),
(14, 'Pepsi', 15, 200, '2016-02-26', 1),
(15, 'Cellar Cask (750ml)', 10, 1200, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `pid` int(11) NOT NULL,
  `noinstock` int(11) NOT NULL,
  `addstock` int(11) NOT NULL,
  `totalinstock` int(11) NOT NULL,
  `closingstock` int(12) NOT NULL,
  `sales` int(11) NOT NULL,
  `priceperunit` int(11) NOT NULL,
  `totalsales` int(11) NOT NULL,
  `remarks` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `date`, `pid`, `noinstock`, `addstock`, `totalinstock`, `closingstock`, `sales`, `priceperunit`, `totalsales`, `remarks`) VALUES
(1, '2015-12-03', 0, 25, 12, 37, 11, 26, 250, 6500, 'good'),
(2, '2015-12-03', 0, 30, 12, 42, 4, 38, 250, 9500, 'average'),
(3, '2015-12-03', 0, 20, 12, 32, 11, 21, 3000, 63000, 'poor'),
(4, '2015-12-03', 0, 30, 14, 44, 5, 39, 250, 9750, 'average'),
(5, '2016-01-13', 0, 25, 12, 37, 10, 27, 250, 6750, 'good'),
(6, '2016-01-13', 2, 30, 1, 31, 7, 23, 250, 5750, 'good'),
(7, '2016-01-13', 3, 20, 4, 24, 7, 17, 3000, 51000, 'good'),
(8, '2016-01-13', 1, 25, 12, 37, 6, 31, 250, 7750, 'good'),
(9, '2016-01-13', 1, 6, 12, 18, 12, 6, 250, 1500, 'good'),
(10, '2016-01-13', 4, 25, 9, 34, 7, 27, 3000, 81000, 'good'),
(11, '2016-01-13', 4, 7, 8, 15, 3, 12, 3000, 36000, 'good'),
(12, '2016-01-13', 4, 3, 9, 12, 7, 5, 3000, 15000, 'good'),
(13, '2016-01-19', 1, 12, 12, 24, 7, 17, 250, 4250, 'good'),
(14, '2016-01-21', 1, 7, 3, 10, 4, 6, 250, 1500, 'good'),
(15, '2016-01-22', 10, 12, 3, 15, 7, 8, 150, 1200, 'good'),
(16, '2016-02-07', 1, 4, 10, 14, 5, 9, 300, 2700, 'good'),
(17, '2016-02-11', 4, 7, 12, 19, 7, 12, 3000, 36000, 'good'),
(18, '2016-02-17', 1, 5, 4, 9, 2, 7, 300, 2100, 'good'),
(19, '2016-02-17', 1, 2, 7, 9, 3, 6, 300, 1800, 'good'),
(20, '2016-02-21', 1, 3, 10, 13, 5, 8, 300, 2400, 'good'),
(21, '2016-02-23', 1, 10, 12, 22, 7, 15, 300, 4500, 'average'),
(22, '2016-02-23', 2, 7, 3, 10, 5, 5, 250, 1250, 'good'),
(23, '2016-02-24', 1, 7, 1, 8, 4, 4, 300, 1200, 'good'),
(24, '2016-02-24', 12, 24, 1, 25, 23, 2, 150, 300, 'good'),
(25, '2016-02-25', 2, 5, 0, 5, 0, 5, 250, 1250, 'good'),
(26, '2016-02-26', 4, 22, 0, 22, 14, 8, 4000, 32000, 'good'),
(27, '2016-02-26', 4, 14, 10, 24, 7, 17, 4000, 68000, 'good'),
(28, '2016-02-26', 14, 23, 0, 23, 15, 8, 200, 1600, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `pname` varchar(255) NOT NULL,
  `noinstock` int(11) NOT NULL,
  `priceperunit` int(11) NOT NULL,
  `updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`pname`, `noinstock`, `priceperunit`, `updated`) VALUES
('1', 25, 250, '2015-11-22'),
('3', 4, 3000, '2015-11-22'),
('{{ 1 }}', 0, 0, '2015-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `user_level` int(2) NOT NULL DEFAULT '1',
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fname`, `lname`, `gender`, `phone`, `username`, `password`, `user_level`, `created_date`) VALUES
(1, 'Allan', 'Otieno', 'Male', '0717295800', 'admin', '47e8995ef779f13220865c4d655af425', 0, '2016-02-12'),
(2, 'Solomon', 'Mwanga', 'Male', '0702276669', 'solomon', 'bbdd0e294fd183663ccadb3d3f94dca1', 1, '2016-02-22'),
(3, 'Winnie', 'Abuor', 'Female', '0700125125', 'winnie', 'da4c5332661cad24dc34553651312cda', 1, '2016-02-22'),
(5, 'Henry', 'Abiero', 'Male', '0715404015', 'henry', '027e4180beedb29744413a7ea6b84a42', 1, '2016-02-22'),
(7, 'Barbra', 'Dhoye', 'Female', '0703943190', 'Barbra', '2750fe794380945e97027fff8269729d', 1, '2016-02-23'),
(8, 'Kevin', 'KU', 'Male', '0700125126', 'kevoh', '75847bbdc9805ad52666d3639cc54475', 1, '2016-02-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
