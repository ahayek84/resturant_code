-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2017 at 07:40 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `al_watany`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `price_unit` double NOT NULL,
  `total_price` double NOT NULL,
  `payment` double NOT NULL,
  `pay_remind` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `actions_financial`
--

CREATE TABLE `actions_financial` (
  `id` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `pay_remind` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dediction_owes`
--

CREATE TABLE `dediction_owes` (
  `id` int(11) NOT NULL,
  `owe_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deposited`
--

CREATE TABLE `deposited` (
  `id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deposited`
--

INSERT INTO `deposited` (`id`, `f_name`, `m_name`, `l_name`, `phone1`, `phone2`, `address`, `note`, `created_at`) VALUES
(1, 'عدنان ', 'جمال ', 'اللوح', '0597293472', '0597293472', '0597293472', 'حبيبنا', '2017-02-11 14:32:16'),
(2, 'عدنان ', 'جمال ', 'اللوح ', '352', 'يبسسيب', '352', 'سيش', '2017-02-11 14:37:57'),
(3, 'عدنانيب ', 'يب', 'اللوح يب', '352يي', 'يبسسييييب', '352يي', 'سيش', '2017-02-11 14:39:51'),
(4, 'سشبسيشب', 'سيبربسي', 'ةنمم', 'نم', 'نمةت', 'نم', 'نم', '2017-02-11 14:40:51'),
(5, 'قبيصثبق', 'بسث', 'سثبثي', 'سبث', 'ثبث', 'سبث', 'ثيب', '2017-02-11 14:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `deposited_details`
--

CREATE TABLE `deposited_details` (
  `id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `weight` double NOT NULL,
  `count_dozens` int(11) NOT NULL,
  `main_price` double DEFAULT NULL,
  `real_price` double NOT NULL,
  `payment` double DEFAULT NULL,
  `pay_remind` double NOT NULL,
  `last_update` datetime NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deposited_dozens`
--

CREATE TABLE `deposited_dozens` (
  `id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `count_dozens` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deposited_needs`
--

CREATE TABLE `deposited_needs` (
  `id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `count_dozens` int(11) NOT NULL,
  `if_back` int(11) NOT NULL DEFAULT '0',
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deposited_payments`
--

CREATE TABLE `deposited_payments` (
  `id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `payment` double NOT NULL,
  `pay_remind` double NOT NULL,
  `main_balance` double NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emploeeys`
--

CREATE TABLE `emploeeys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `day_salary` double NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emploeeys_actions`
--

CREATE TABLE `emploeeys_actions` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date_come` datetime NOT NULL,
  `if_salary` double DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emploeeys_financial`
--

CREATE TABLE `emploeeys_financial` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `created_at` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `owes`
--

CREATE TABLE `owes` (
  `id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `jop` varchar(255) DEFAULT NULL,
  `identify_num` varchar(255) DEFAULT NULL,
  `note` text,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `owes`
--

INSERT INTO `owes` (`id`, `f_name`, `m_name`, `l_name`, `address`, `phone1`, `phone2`, `jop`, `identify_num`, `note`, `created_at`) VALUES
(1, 'عدنان ', 'جمال ', 'اللووح ', 'يسبةيسب', '2324', 'صثق43', 'سيلي', 'بيليبل', 'يبيب', '2017-02-11 14:57:18'),
(2, 'يبسلب', 'ثبلبث', 'ثيبثي', 'ثبثب', 'ثللثب', 'ثبلثب', 'ثقبث', '', '', '2017-02-11 14:57:29'),
(3, 'شسبسشي', 'يسبلسي', 'ثلبيسل', 'ثبث', 'ثيليلب', 'ثيبلثي', 'ثيبثب', '12', '', '2017-02-11 14:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `payments_owes`
--

CREATE TABLE `payments_owes` (
  `id` int(11) NOT NULL,
  `owe_id` int(11) NOT NULL,
  `payment` double NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `actions_financial`
--
ALTER TABLE `actions_financial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dediction_owes`
--
ALTER TABLE `dediction_owes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposited`
--
ALTER TABLE `deposited`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposited_details`
--
ALTER TABLE `deposited_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposited_dozens`
--
ALTER TABLE `deposited_dozens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposited_needs`
--
ALTER TABLE `deposited_needs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposited_payments`
--
ALTER TABLE `deposited_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emploeeys`
--
ALTER TABLE `emploeeys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emploeeys_actions`
--
ALTER TABLE `emploeeys_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emploeeys_financial`
--
ALTER TABLE `emploeeys_financial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owes`
--
ALTER TABLE `owes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments_owes`
--
ALTER TABLE `payments_owes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `actions_financial`
--
ALTER TABLE `actions_financial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dediction_owes`
--
ALTER TABLE `dediction_owes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deposited`
--
ALTER TABLE `deposited`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `deposited_details`
--
ALTER TABLE `deposited_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deposited_dozens`
--
ALTER TABLE `deposited_dozens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deposited_needs`
--
ALTER TABLE `deposited_needs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deposited_payments`
--
ALTER TABLE `deposited_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emploeeys`
--
ALTER TABLE `emploeeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emploeeys_actions`
--
ALTER TABLE `emploeeys_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emploeeys_financial`
--
ALTER TABLE `emploeeys_financial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `owes`
--
ALTER TABLE `owes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payments_owes`
--
ALTER TABLE `payments_owes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
