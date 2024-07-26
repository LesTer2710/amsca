-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 10, 2024 at 12:55 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qbot-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `userId` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `activation-credits` int NOT NULL,
  `account-type` varchar(20) NOT NULL,
  `total-balance` double NOT NULL,
  `referral-bonus` double NOT NULL,
  `task-rewards` double NOT NULL,
  `gcash` varchar(11) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`userId`, `username`, `password`, `fname`, `lname`, `activation-credits`, `account-type`, `total-balance`, `referral-bonus`, `task-rewards`, `gcash`) VALUES
('10000', 'queensbot', 'tambaloadmin', 'Mark Lester', 'Tambalo', 1000, 'admin', 0, 250, 500.11, '09293292926'),
('7796646498', 'lester', 'tambalo', 'Mark Lester', 'Tambalo', 0, '', 0, 0, 0.02, ''),
('3369317418', 'what', 'whatt', 'Mark Lester', 'Tambalo', 0, '', 0, 0, 0, ''),
('7554297952', 'heythere', 'whatt', 'Mark Lester', 'Tambalo', 0, '', 0, 0, 0, ''),
('1008074294', 'uhrrkd', 'neu', 'lke', 'feg', 0, '', 0, 0, 0, ''),
('5019938828', 'gringotts', 'helloworld', 'Margarine', 'Star', 0, '', 0, 0, 0, ''),
('2862696414', 'lestersa', 'abhsg', 'dsd', 'd', 0, '', 0, 0, 0, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
