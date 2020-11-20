-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 20, 2020 at 05:25 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
(1, 'commercial', 'NV09764', '2020-12-12', '2020-11-10', 5000.00, 6, 4700.00, 'Completed ', 'D0001'),
(2, 'NSB', '12454789', '2020-12-12', '2020-11-07', 1550.00, 4, 1430.00, 'NYC ', 'Moo3'),
(3, 'BOC', 'BO256378', '2020-12-12', '2020-11-14', 9000.00, 10, 8100.00, 'Completed ', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `type`, `name`, `address`) VALUES
('D0002', 'Daily', 'anneSS', 'katukurunda'),
('D0006', 'Daily', 'Nirmala weerasinghe', 'Unawatuna,Galle'),
('D0007', 'Daily', 'Iresha sandamali ', 'payagala'),
('D0008', 'Daily', 'Ravi fernando', 'panadura'),
('D0009', 'Daily', 'anuradha', 'pituwala'),
('D0010', 'Daily', 'harshika sammani', 'wadduwa south'),
('M0001', 'Monthly', 'Hasith Lakmal', 'panadura'),
('M0003', 'Monthly', 'Gimhani', 'pitigala,elpitiya'),
('M0010', 'Monthly', 'Chirath yapa', 'Gampola'),
('M0076', 'Monthly', 'anushka bandara', 'maharagamaaa'),
('M0077', 'Monthly', 'Hasitha', 'kalutara');

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
  `cust_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_no`, `l_date`, `amount`, `interest`, `l_method`, `total_amt`, `installment_value`, `no_of_installments`, `cust_id`) VALUES
(1, '2020-11-27', 10000.00, 7, '', 10700.00, 2000.00, 5, 'D0002'),
(2, '2020-06-28', 12000.00, 6, '', 12500.00, 1800.00, 6, 'D0001'),
(4, '2020-07-27', 25000.00, 5, '', 26250.00, 2500.00, 10, 'M0010'),
(6, '2020-07-27', 25000.00, 5, '', 26250.00, 2500.00, 10, 'M0010'),
(7, '2020-07-27', 25000.00, 5, '', 26250.00, 2500.00, 10, 'M0010'),
(10, '2020-11-02', 10000.00, 4, 'daily', 12400.00, 68.89, 6, 'D0002'),
(12, '2020-11-12', 20000.00, 5, 'declining', 25000.00, 5000.00, 5, 'M0001'),
(13, '2020-11-11', 10000.00, 7, 'daily', 13500.00, 2700.00, 5, 'D0002'),
(14, '2020-11-13', 12000.00, 5, 'monthly', 15600.00, 2600.00, 6, 'M0076'),
(15, '2020-11-15', 15000.00, 4, 'daily', 18000.00, 3600.00, 5, 'M0010');

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
  `loan_no` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_installement`
--

INSERT INTO `loan_installement` (`id`, `li_date`, `installement_amt`, `interest_amt`, `remaining_amt`, `loan_no`) VALUES
(1, '2020-11-03', 2000.00, 100.00, 8000.00, 1),
(2, '2020-11-09', 2500.00, 5.00, 7500.00, 1),
(3, '2020-11-01', 5454.00, 454.00, 45.00, 1),
(5, '2020-11-03', 5450.00, 450.00, 54.00, 1),
(7, '2020-11-13', 6000.00, 500.00, 8500.00, 2),
(8, '2020-11-15', 2000.00, 2600.00, 9800.00, 4),
(9, '0000-00-00', 40.00, 10.00, -36.00, 1),
(10, '0000-00-00', 8000.00, 10.00, 9800.00, 4),
(11, '0000-00-00', 8000.00, 10.00, 9800.00, 4),
(12, '0000-00-00', 8000.00, 10.00, 9800.00, 4),
(13, '0000-00-00', 8000.00, 10.00, 9800.00, 4),
(14, '0000-00-00', 8000.00, 10.00, 9800.00, 4),
(15, '0000-00-00', 8000.00, 10.00, 9800.00, 4);

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'user', '123');

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
  MODIFY `cheque_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_no` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `loan_installement`
--
ALTER TABLE `loan_installement`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
