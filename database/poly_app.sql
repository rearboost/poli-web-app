-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2021 at 02:11 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poly_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cheque`
--

CREATE TABLE `cheque` (
  `cheque_id` int(7) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `cheque_no` varchar(50) NOT NULL,
  `valid_date` date NOT NULL,
  `exchange_date` date NOT NULL,
  `cheque_value` double(10,2) NOT NULL,
  `interest` int(5) NOT NULL,
  `exchange_amt` double(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `cust_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cheque`
--

INSERT INTO `cheque` (`cheque_id`, `bank`, `cheque_no`, `valid_date`, `exchange_date`, `cheque_value`, `interest`, `exchange_amt`, `status`, `cust_id`) VALUES
(1, 'commercial', 'NV09764', '2021-03-25', '2020-11-10', 5000.00, 6, 4700.00, 'NYC', 'D0001'),
(2, 'NSB', '12454789', '2020-12-12', '2020-11-07', 1550.00, 4, 1430.00, 'Completed ', 'M0003');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `contact` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `type`, `name`, `address`, `contact`) VALUES
('D0001', 'Daily', 'anneSS', 'katukurunda', '77 4567845'),
('D0006', 'Daily', 'Nirmala weerasinghe', 'Unawatuna,Galle', '71 7894562'),
('D0007', 'Daily', 'Iresha sandamali ', 'payagala', '78 1478521'),
('D0008', 'Daily', 'Ravi fernando', 'panadura', '71 7842356'),
('D0009', 'Daily', 'anuradha', 'pituwala', ''),
('D0010', 'Daily', 'harshika sammani', 'wadduwa south', ''),
('M0001', 'Monthly', 'Hasith Lakmal', 'panadura', ''),
('M0003', 'Monthly', 'Gimhani', 'pitigala,elpitiya', ''),
('M0010', 'Monthly', 'Chirath yapa', 'Gampola', ''),
('M0076', 'Monthly', 'anushka bandara', 'maharagamaaa', '');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_no` int(7) NOT NULL,
  `l_date` date NOT NULL,
  `amount` double(10,2) NOT NULL,
  `interest` int(5) NOT NULL,
  `l_method` varchar(25) NOT NULL,
  `total_amt` double(10,2) NOT NULL,
  `installment_value` double(10,2) NOT NULL,
  `no_of_installments` int(11) NOT NULL,
  `int_val` double(10,2) NOT NULL,
  `cust_id` varchar(10) NOT NULL,
  `i_date` varchar(30) NOT NULL DEFAULT '0000-00-00',
  `l_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_no`, `l_date`, `amount`, `interest`, `l_method`, `total_amt`, `installment_value`, `no_of_installments`, `int_val`, `cust_id`, `i_date`, `l_status`) VALUES
(1, '2020-12-30', 10000.00, 5, 'Daily', 12000.00, 100.00, 4, 0.00, 'D0001', '2020-12-31', 1),
(2, '2020-12-31', 15000.00, 5, 'Daily', 18750.00, 125.00, 5, 0.00, 'D0006', '2021-01-01', 1),
(3, '2020-12-12', 50000.00, 8, 'Monthly', 50000.00, 0.00, 0, 4000.00, 'M0001', '', 1),
(4, '2021-02-28', 25000.00, 6, 'Monthly', 25000.00, 0.00, 0, 1350.00, 'M0003', '', 1),
(6, '2021-03-04', 50000.00, 5, 'Monthly', 50000.00, 0.00, 0, 2500.00, 'M0010', '1970-01-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_installement`
--

CREATE TABLE `loan_installement` (
  `id` int(7) NOT NULL,
  `li_date` date NOT NULL,
  `installement_amt` double(10,2) NOT NULL,
  `interest_amt` double(10,2) NOT NULL,
  `remaining_amt` double(10,2) NOT NULL,
  `remain_int` double(10,2) NOT NULL,
  `loan_no` int(7) NOT NULL,
  `next_idate` varchar(30) NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_installement`
--

INSERT INTO `loan_installement` (`id`, `li_date`, `installement_amt`, `interest_amt`, `remaining_amt`, `remain_int`, `loan_no`, `next_idate`) VALUES
(1, '2020-12-31', 100.00, 0.00, 11900.00, 0.00, 1, '2021-01-01'),
(2, '2021-01-01', 100.00, 0.00, 11800.00, 0.00, 1, '2021-01-02'),
(3, '2021-01-02', 100.00, 0.00, 11700.00, 0.00, 1, '2021-01-03'),
(4, '2021-01-01', 125.00, 0.00, 18625.00, 0.00, 2, '2021-01-02'),
(5, '2021-03-28', 0.00, 1200.00, 25000.00, 300.00, 4, '0000-00-00'),
(6, '2021-04-28', 2500.00, 1500.00, 22500.00, 300.00, 4, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE `summary` (
  `id` int(11) NOT NULL,
  `year` varchar(500) NOT NULL,
  `month` varchar(500) NOT NULL,
  `loanAMT` decimal(18,2) NOT NULL DEFAULT '0.00',
  `debtAMT` decimal(18,2) NOT NULL DEFAULT '0.00',
  `createDate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summary`
--

INSERT INTO `summary` (`id`, `year`, `month`, `loanAMT`, `debtAMT`, `createDate`) VALUES
(1, '2021', '04', '205750.00', '5825.00', '2021-04-01'),
(2, '2021', '01', '0.00', '0.00', '2021-04-01'),
(3, '2021', '02', '0.00', '0.00', '2021-04-01'),
(4, '2021', '03', '0.00', '0.00', '2021-04-01'),
(5, '2021', '05', '0.00', '0.00', '2021-04-01'),
(6, '2021', '06', '0.00', '0.00', '2021-04-01'),
(7, '2021', '07', '0.00', '0.00', '2021-04-01'),
(8, '2021', '08', '0.00', '0.00', '2021-04-01'),
(9, '2021', '09', '0.00', '0.00', '2021-04-01'),
(10, '2021', '10', '0.00', '0.00', '2021-04-01'),
(11, '2021', '11', '0.00', '0.00', '2021-04-01'),
(12, '2021', '12', '0.00', '0.00', '2021-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cheque`
--
ALTER TABLE `cheque`
  ADD PRIMARY KEY (`cheque_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_no`);

--
-- Indexes for table `loan_installement`
--
ALTER TABLE `loan_installement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `summary`
--
ALTER TABLE `summary`
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
-- AUTO_INCREMENT for table `cheque`
--
ALTER TABLE `cheque`
  MODIFY `cheque_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_no` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `loan_installement`
--
ALTER TABLE `loan_installement`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `summary`
--
ALTER TABLE `summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
