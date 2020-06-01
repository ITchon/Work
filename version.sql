-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 03:21 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `v_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `d_no` varchar(50) NOT NULL,
  `dcn_id` varchar(40) NOT NULL,
  `version` int(50) NOT NULL,
  `enable` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `delete_flag` varchar(1) NOT NULL,
  `date_deleted` datetime NOT NULL,
  `file_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`v_id`, `d_id`, `d_no`, `dcn_id`, `version`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`, `file_name`) VALUES
(12, 12, 'MSX3-4912', '1', 0, 0, '2020-05-12 12:09:14', '0000-00-00 00:00:00', '1', '2020-05-26 09:26:22', 'Taisoul'),
(13, 12, 'MSX3-4912', '1', 1, 0, '2020-05-12 12:09:39', '0000-00-00 00:00:00', '1', '2020-05-26 09:27:54', 'King002'),
(14, 12, 'MSX3-4912', '1', 2, 0, '2020-05-12 12:10:30', '2020-05-26 09:15:53', '1', '0000-00-00 00:00:00', 'Tainaja'),
(15, 12, 'MSX3-4912', '1', 3, 0, '2020-05-12 12:12:15', '2020-05-26 09:15:35', '1', '0000-00-00 00:00:00', 'drawing_center (4).sql'),
(16, 12, 'MSX3-4912', '1', 4, 0, '2020-05-26 09:37:32', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 'DyFkOBZVAAAkOm_.jpg'),
(19, 12, 'MSX3-4912', '1', 5, 0, '2020-05-27 13:28:40', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 'Test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `version`
--
ALTER TABLE `version`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
