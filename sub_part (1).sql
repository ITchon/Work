-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2020 at 07:37 AM
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
-- Table structure for table `sub_part`
--

CREATE TABLE `sub_part` (
  `sub_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_part`
--

INSERT INTO `sub_part` (`sub_id`, `m_id`, `p_id`, `date_created`, `delete_flag`, `date_deleted`) VALUES
(168, 37, 40, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(169, 37, 41, '0000-00-00 00:00:00', 0, '2020-06-01 14:22:56'),
(175, 39, 40, '0000-00-00 00:00:00', 1, '2020-05-27 16:03:44'),
(177, 44, 41, '0000-00-00 00:00:00', 1, '2020-05-27 15:36:34'),
(181, 40, 44, '0000-00-00 00:00:00', 1, '2020-05-27 16:04:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sub_part`
--
ALTER TABLE `sub_part`
  ADD PRIMARY KEY (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sub_part`
--
ALTER TABLE `sub_part`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
