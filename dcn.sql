-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2020 at 03:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `dcn`
--

CREATE TABLE `dcn` (
  `dcn_id` int(12) NOT NULL,
  `dcn_no` varchar(24) NOT NULL,
  `enable` int(12) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `delete_flag` int(12) NOT NULL,
  `date_deleted` datetime NOT NULL,
  `path_file` varchar(200) NOT NULL,
  `file_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dcn`
--

INSERT INTO `dcn` (`dcn_id`, `dcn_no`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`, `path_file`, `file_name`) VALUES
(1, 'DCN13-007', 1, '2020-05-11 14:20:19', '2020-06-22 14:03:06', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2013\\', 'DCN13-007_130115.xdw'),
(2, '0000', 1, '2020-05-11 14:21:24', '2020-06-16 10:07:15', 1, '2020-06-16 10:07:32', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2012\\', 'DCN12-009_120123.xdw'),
(10, 'DCN18-034', 1, '2020-06-01 08:55:05', '2020-06-01 09:00:08', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2018\\', 'DCN18-034_20180508_MITSUBISHI_4N15 (SU) WATER PUMP ASSY.xdw'),
(14, 'DCN12-068', 1, '2020-06-10 09:30:08', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2012\\', 'DCN12-068_120726.xdw'),
(15, 'DCN20-034', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2020\\', 'DCN20-034_20200327_MITSUBISHI 4N15(SU) COVER, WATER PUMP.xdw'),
(16, 'DCN20-024', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2020\\', 'DCN20-024_20200309_MITSUBISHI 4N15(SU) WATER PUMP.xdw'),
(17, 'DCN20-033', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2020\\', 'DCN20-033_20200320_MITSUBISHI 4N15(SU) CASE, WATER PUMP.xdw'),
(34, '111', 1, '2020-06-24 14:46:18', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '111', 'libsqlite3-0.zip');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dcn`
--
ALTER TABLE `dcn`
  ADD PRIMARY KEY (`dcn_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dcn`
--
ALTER TABLE `dcn`
  MODIFY `dcn_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
