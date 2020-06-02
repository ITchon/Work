-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2020 at 07:37 AM
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
  `b_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_part`
--

INSERT INTO `sub_part` (`sub_id`, `b_id`, `m_id`, `p_id`, `date_created`, `delete_flag`, `date_deleted`) VALUES
(329, 117, 50, 48, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(330, 117, 48, 49, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(331, 119, 50, 49, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(333, 119, 50, 51, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(334, 120, 48, 51, '0000-00-00 00:00:00', 0, '2020-06-02 14:17:51'),
(335, 120, 48, 52, '0000-00-00 00:00:00', 0, '2020-06-02 14:17:51'),
(342, 120, 48, 51, '0000-00-00 00:00:00', 0, '2020-06-02 14:17:51'),
(343, 120, 51, 49, '0000-00-00 00:00:00', 0, '2020-06-02 14:17:51'),
(344, 120, 52, 54, '0000-00-00 00:00:00', 0, '2020-06-02 14:17:51'),
(345, 120, 49, 54, '0000-00-00 00:00:00', 0, '2020-06-02 14:17:51'),
(346, 117, 50, 48, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(347, 117, 50, 49, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(348, 117, 50, 51, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(349, 117, 50, 52, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(350, 117, 50, 51, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(351, 117, 50, 54, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(352, 117, 50, 50, '0000-00-00 00:00:00', 0, '2020-06-02 13:47:27'),
(353, 117, 50, 49, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(354, 123, 52, 49, '0000-00-00 00:00:00', 0, '2020-06-02 14:34:18'),
(355, 123, 52, 50, '0000-00-00 00:00:00', 0, '2020-06-02 14:34:22'),
(356, 123, 52, 51, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(357, 123, 52, 49, '0000-00-00 00:00:00', 0, '2020-06-02 13:48:12'),
(358, 123, 52, 50, '0000-00-00 00:00:00', 0, '2020-06-02 13:48:14'),
(359, 123, 52, 51, '0000-00-00 00:00:00', 0, '2020-06-02 13:48:16'),
(360, 123, 49, 52, '0000-00-00 00:00:00', 0, '2020-06-02 14:22:49');

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
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
