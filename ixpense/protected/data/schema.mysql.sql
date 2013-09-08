-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2011 at 10:07 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ixpense`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_page`
--

CREATE TABLE IF NOT EXISTS `dashboard_page` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dashboard_page`
--


-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
  `depid` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `deposit_type` varchar(30) NOT NULL,
  `amount` decimal(19,2) NOT NULL,
  `note` text,
  PRIMARY KEY (`depid`),
  KEY `deposit_type` (`deposit_type`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `deposit`
--


-- --------------------------------------------------------

--
-- Table structure for table `deposit_type`
--

CREATE TABLE IF NOT EXISTS `deposit_type` (
  `deptypID` int(11) NOT NULL AUTO_INCREMENT,
  `deptypname` varchar(30) NOT NULL,
  PRIMARY KEY (`deptypID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `deposit_type`
--

INSERT INTO `deposit_type` (`deptypID`, `deptypname`) VALUES
(1, 'Cash'),
(2, 'DD'),
(3, 'Cheque'),
(4, 'Money Transfer'),
(5, 'Salary'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `expid` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `expense_category` varchar(30) NOT NULL,
  `expense_name` varchar(40) NOT NULL,
  `expense_mode` varchar(20) DEFAULT NULL,
  `amount` decimal(19,2) NOT NULL,
  `note` text,
  PRIMARY KEY (`expid`),
  KEY `expense_category` (`expense_category`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `expense`
--


-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE IF NOT EXISTS `expense_category` (
  `expcatID` int(11) NOT NULL AUTO_INCREMENT,
  `expcatname` varchar(60) NOT NULL,
  PRIMARY KEY (`expcatID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`expcatID`, `expcatname`) VALUES
(1, 'Food'),
(2, 'House Rent'),
(3, 'Clothing'),
(4, 'Entertainment'),
(5, 'Transportation'),
(6, 'Utilities'),
(10, 'Personal Care'),
(11, 'Lend'),
(12, 'Loan Repay'),
(13, 'Miscellaneous');

-- --------------------------------------------------------

--
-- Table structure for table `expense_mode`
--

CREATE TABLE IF NOT EXISTS `expense_mode` (
  `expmodeID` bigint(20) NOT NULL AUTO_INCREMENT,
  `mode_name` varchar(20) NOT NULL,
  PRIMARY KEY (`expmodeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `expense_mode`
--

INSERT INTO `expense_mode` (`expmodeID`, `mode_name`) VALUES
(1, 'Cash'),
(2, 'Cheque'),
(3, 'Demand Draft'),
(4, 'Credit Card'),
(5, 'Debit Card'),
(6, 'Internet Banking');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `usercurrency` varchar(3) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_balance`
--

CREATE TABLE IF NOT EXISTS `user_balance` (
  `uid` bigint(20) NOT NULL,
  `balance` decimal(19,2) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_balance`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_ip`
--

CREATE TABLE IF NOT EXISTS `user_ip` (
  `ipid` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(20) DEFAULT NULL,
  `uid` bigint(20) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  PRIMARY KEY (`ipid`),
  KEY `ip_address` (`ip_address`),
  KEY `user_ipfk_1` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_ip`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_balance`
--
ALTER TABLE `user_balance`
  ADD CONSTRAINT `user_balance_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_ip`
--
ALTER TABLE `user_ip`
  ADD CONSTRAINT `user_ipfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
