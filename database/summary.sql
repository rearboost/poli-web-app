-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 24, 2020 at 04:41 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET time_zone
= "+00:00";

--
-- Database: `poly_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE `summary`
(
  `id` int
(11) NOT NULL,
  `year` varchar
(500) NOT NULL,
  `month` varchar
(500) NOT NULL,
  `loanAMT` decimal
(18,2) NOT NULL DEFAULT '0.00',
  `debtAMT` decimal
(18,2) NOT NULL DEFAULT '0.00',
  `createDate` varchar
(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `summary`
--

INSERT INTO `summary` (`
id`,
`year
`, `month`, `loanAMT`, `debtAMT`, `createDate`) VALUES
(1, '2020', '11', '0.00', '25000.00', '2020-11-24'),
(2, '2020', '01', '0.00', '0.00', '2020-11-24'),
(3, '2020', '02', '0.00', '0.00', '2020-11-24'),
(4, '2020', '03', '0.00', '0.00', '2020-11-24'),
(5, '2020', '04', '0.00', '0.00', '2020-11-24'),
(6, '2020', '05', '0.00', '0.00', '2020-11-24'),
(7, '2020', '06', '0.00', '0.00', '2020-11-24'),
(8, '2020', '07', '0.00', '0.00', '2020-11-24'),
(9, '2020', '08', '0.00', '0.00', '2020-11-24'),
(10, '2020', '09', '0.00', '0.00', '2020-11-24'),
(11, '2020', '10', '0.00', '0.00', '2020-11-24'),
(12, '2020', '12', '0.00', '0.00', '2020-11-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `summary`
--
ALTER TABLE `summary`
ADD PRIMARY KEY
(`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `summary`
--
ALTER TABLE `summary`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
