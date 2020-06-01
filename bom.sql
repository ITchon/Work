-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2020 at 07:34 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drawing_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `bom`
--

CREATE TABLE `bom` (
  `b_id` int(11) NOT NULL,
  `b_master` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bom`
--

INSERT INTO `bom` (`b_id`, `b_master`, `p_id`, `date_created`, `delete_flag`, `date_deleted`) VALUES
(47, 36, 37, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(48, 36, 38, '0000-00-00 00:00:00', 1, '2020-05-27 15:20:30'),
(49, 36, 39, '0000-00-00 00:00:00', 1, '2020-05-27 16:02:39'),
(50, 36, 44, '0000-00-00 00:00:00', 0, '2020-06-01 08:15:57'),
(56, 40, 37, '2020-06-01 09:17:54', 1, '0000-00-00 00:00:00'),
(57, 40, 38, '2020-06-01 09:17:54', 1, '0000-00-00 00:00:00'),
(58, 40, 39, '2020-06-01 09:17:54', 0, '2020-06-01 14:21:18'),
(59, 40, 44, '2020-06-01 09:17:54', 0, '2020-06-01 14:12:54'),
(60, 36, 40, '2020-06-01 13:34:02', 0, '2020-06-01 14:23:16'),
(61, 36, 44, '2020-06-01 13:34:38', 0, '2020-06-01 14:23:12'),
(62, 37, 36, '2020-06-01 13:34:52', 1, '0000-00-00 00:00:00'),
(63, 37, 37, '2020-06-01 13:34:52', 1, '0000-00-00 00:00:00'),
(64, 37, 38, '2020-06-01 13:34:52', 0, '2020-06-01 13:46:15'),
(65, 37, 39, '2020-06-01 13:34:52', 0, '2020-06-01 13:46:09'),
(66, 37, 40, '2020-06-01 13:34:52', 0, '2020-06-01 13:46:05'),
(67, 37, 41, '2020-06-01 13:34:52', 0, '2020-06-01 13:38:04'),
(68, 37, 39, '2020-06-01 13:35:50', 0, '2020-06-01 13:46:00'),
(69, 41, 36, '2020-06-01 13:36:07', 1, '0000-00-00 00:00:00'),
(70, 41, 37, '2020-06-01 13:36:07', 1, '0000-00-00 00:00:00'),
(71, 41, 39, '2020-06-01 13:36:07', 1, '0000-00-00 00:00:00'),
(72, 41, 40, '2020-06-01 13:36:07', 1, '0000-00-00 00:00:00'),
(73, 37, 39, '2020-06-01 13:40:14', 0, '2020-06-01 13:45:56'),
(74, 37, 44, '2020-06-01 13:40:24', 0, '2020-06-01 13:45:50'),
(75, 37, 40, '2020-06-01 13:40:33', 0, '2020-06-01 13:45:45'),
(76, 40, 39, '2020-06-01 14:13:22', 0, '2020-06-01 14:19:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bom`
--
ALTER TABLE `bom`
  ADD PRIMARY KEY (`b_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bom`
--
ALTER TABLE `bom`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
