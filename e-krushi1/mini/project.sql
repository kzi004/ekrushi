-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2017 at 10:00 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `name` varchar(255) NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`name`, `id`) VALUES
('Government college of engineering jalgaon', 0),
('gcoe a', 1),
('sres kopargaon', 2);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` varchar(255) NOT NULL,
  `name` varchar(15) NOT NULL,
  `type` varchar(15) NOT NULL,
  `year` varchar(10) NOT NULL,
  `info` varchar(255) NOT NULL,
  `location` varchar(100) NOT NULL,
  `dept` varchar(15) NOT NULL,
  `clg_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `type`, `year`, `info`, `location`, `dept`, `clg_id`) VALUES
('1441031_1', 'heroin', 'stationary', 'lovely', 'lovely', './1/1441031.jpg', '', 1),
('1441031_2', 'sc', 'book', 'sy', 'dc', './1/1441031_2.jpg', '', 1),
('1441031_3', 'dcd', 'stationary', 'sy', 'scs', './1/1441031_3.jpg', '', 1),
('1441031_4', 'zingat', 'book', 'ty', '', './1/1441031_4.jpg', 'civil', 1),
('1441031_5', 'zingat', 'stationary', 'ty', 'sdvd', './1/1441031_5.jpg', 'civil', 1),
('1441031_6', 'r15', 'electronics', 'fy', 'ekdam navi top speed : 130 in jalgaon', './1/1441031_6.jpg', 'computer', 1),
('1441033_1', 'sfb', 'electronics', 'fy', 'fbfbv', './2/1441033_1.jpg', '', 2),
('1441033_2', 'tola', 'electronics', 'fy', 'tola tola', './2/1441033_2.jpg', 'electrical', 2),
('1441034_1', 'Alert', 'notes', 'be', 'Bc', './0/1441034_1.jpg', 'mech', 0),
('1441035_1', 'lovely1', 'book', 'ty', 'kjbk', './0/1441035_1.jpg', '', 0),
('1441035_2', 'csp', 'stationary', 'fy', 'advds', './0/1441035_2.jpg', '', 0),
('1441035_3', 'dfds', 'book', 'ty', 'dvsfdfbc', './0/1441035_3.jpg', '', 0),
('1441035_4', 'avc', 'book', 'sy', 'ascadc', './0/1441035_4.jpg', 'electrical', 0),
('1441035_5', 'sfs', 'null', 'y', '', './0/1441035_5.jpg', 'y', 0),
('1441035_6', 'abc', 'stationary', 'sy', 'ijwsjb', './0/1441035_6.jpg', 'computer', 0),
('1441044_1', 'R.P .JAIN', 'book', 'ty', 'please find it clear', './0/1441044_1.jpg', 'civil', 0),
('165277_1', 'Saheb', 'electronics', 'be', 'Shhsjjsn', './0/165277_1.jpg', 'mech', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `loginid` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `college` int(50) NOT NULL,
  `prn` int(255) NOT NULL,
  `items` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `lname`, `mobile`, `loginid`, `password`, `email`, `college`, `prn`, `items`) VALUES
('Kaka', 'Kaku', '6854456755', 'Raj', 'raj', 'yscsbjajabvsvsv@gmai', 0, 165277, 1),
('rohan', 'narkhede', '789789', '143', '143', '143', 1, 1441031, 6),
('NITESH', 'THORAT', '8446393433', 'nitesh', 'nitesh', 'cooldudenitesh02@gma', 2, 1441033, 2),
('Ramesh', 'Thakur', '9481499093', 'Race_rohan', 'ramesh', 'rohan.9396@gmail.com', 0, 1441034, 1),
('csp', 'csp', 'csp', 'csp', 'csp', 'cspsunny512@gmail.co', 0, 1441035, 6),
('NITESH', 'thorat1', '8806611880', 'nitesht', 'nitesht', 'cold@gmail.com', 0, 1441044, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `prn` (`prn`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `loginid` (`loginid`),
  ADD UNIQUE KEY `mobile` (`mobile`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
