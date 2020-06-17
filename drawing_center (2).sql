-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2020 at 03:19 AM
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
-- Table structure for table `bom`
--

CREATE TABLE `bom` (
  `b_id` int(11) NOT NULL,
  `b_master` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(12) NOT NULL,
  `common_part` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bom`
--

INSERT INTO `bom` (`b_id`, `b_master`, `quantity`, `unit`, `common_part`, `date_created`, `delete_flag`, `date_deleted`) VALUES
(143, 1, 3, 'pcs', 3, '2020-06-08 10:36:38', 1, '0000-00-00 00:00:00'),
(144, 6, 0, '0', 0, '2020-06-08 10:38:16', 1, '0000-00-00 00:00:00'),
(145, 6, 0, 'pcs', 0, '2020-06-09 11:36:32', 1, '0000-00-00 00:00:00'),
(146, 32, 0, 'pcs', 0, '2020-06-09 14:09:15', 1, '0000-00-00 00:00:00'),
(147, 339, 0, 'pcs', 0, '2020-06-10 15:29:01', 1, '0000-00-00 00:00:00');

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
(1, 'DCN13-007', 1, '2020-05-11 14:20:19', '2020-06-16 10:04:32', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2013\\', 'DCN13-007_130115.xdw'),
(2, '0000', 1, '2020-05-11 14:21:24', '2020-06-16 10:07:15', 1, '2020-06-16 10:07:32', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2012\\', 'DCN12-009_120123.xdw'),
(10, 'DCN18-034', 1, '2020-06-01 08:55:05', '2020-06-01 09:00:08', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2018\\', 'DCN18-034_20180508_MITSUBISHI_4N15 (SU) WATER PUMP ASSY.xdw'),
(14, 'DCN12-068', 1, '2020-06-10 09:30:08', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2012\\', 'DCN12-068_120726.xdw'),
(15, 'DCN20-034', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2020\\', 'DCN20-034_20200327_MITSUBISHI 4N15(SU) COVER, WATER PUMP.xdw'),
(16, 'DCN20-024', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2020\\', 'DCN20-024_20200309_MITSUBISHI 4N15(SU) WATER PUMP.xdw'),
(17, 'DCN20-033', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\04_DCN_design change notice(scan)\\DCN-2020\\', 'DCN20-033_20200320_MITSUBISHI 4N15(SU) CASE, WATER PUMP.xdw');

-- --------------------------------------------------------

--
-- Table structure for table `drawing`
--

CREATE TABLE `drawing` (
  `d_id` int(11) NOT NULL,
  `d_no` varchar(50) DEFAULT NULL,
  `dcn_id` varchar(40) NOT NULL,
  `enable` varchar(1) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `delete_flag` varchar(1) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `path_file` varchar(200) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `version` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drawing`
--

INSERT INTO `drawing` (`d_id`, `d_no`, `dcn_id`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`, `path_file`, `file_name`, `version`) VALUES
(1, '1300A126 V1', '16', '1', '2020-04-29 16:46:57', '2020-06-16 14:19:54', '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\01_Drawings\\A_Production Dwg', 'A_1300A126_06_20200309_WATER PUMP ASSY.xdw', 1),
(2, 'J107-11820', '16', '1', '2020-04-29 16:47:10', '2020-06-15 16:09:50', '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\01_Drawings\\A_Production Dwg', 'A_J107-11820_00_20200309_COVER ; WATER PUMP.xdw', 0),
(3, 'J107-11820-RM', '15', '1', '2020-04-29 16:47:28', '2020-06-15 13:07:44', '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\01_Drawings\\D_Supplier Dwg', 'D_J107-11820-RM_00_20200325_COVER, WATER PUMP(MST).xdw', 0),
(4, 'MSX3-4912', '14', '1', NULL, NULL, '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\02_STD_specification standard(scan)\\MITSUBISHI\\MMTh(MS)', 'MSX3-4912_04_20120725_EN_(BUSHING KNOCK).xdw', 0),
(5, 'J109-09810', '10', '1', '2020-04-29 16:47:53', NULL, '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\01_Drawings\\A_Production Dwg', 'A_J109-09810_00_20180508 GASKET_cancelled.xdw', 0),
(6, 'J145-00600', '2', '1', '2020-04-29 16:48:02', NULL, '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\01_Drawings\\A_Production Dwg', 'A_J145-00600_00_20120725_PIPE_cancelled.xdw', 0),
(7, 'MF140209', '14', '1', '2020-04-29 16:48:13', '2020-06-10 09:30:33', '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\07_DHR_Drawing history record(scan)', 'DHR-MF140209.xdw', 0),
(8, 'J100-21860', '16', '1', '2020-04-29 16:48:22', NULL, '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\01_Drawings\\A_Production Dwg', 'A_J100-21860_00_20200309_WATER PUMP.xdw', 0),
(9, 'J105-39240', '16', '1', '2020-04-29 16:50:00', NULL, '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\01_Drawings\\A_Production Dwg', 'A_J105-39240_00_20200309_CASE ; WATER PUMP.xdw', 0),
(10, 'J105-39240-RM', '17', '1', '2020-06-10 08:19:41', NULL, '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\01_Drawings\\D_Supplier Dwg', 'D_J105-39240-RM_00_20200320_CASE, WATER PUMP.xdw', 0),
(11, 'J199-20030', '2', '1', '2020-06-10 08:20:59', NULL, '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Design\\11.Dowload drawing file_TBK-Japan\\Download 2005', 'J199-20030Z30(I4 Plug).zip', 0),
(12, 'J115-16410', '2', '1', '2020-04-29 16:59:22', NULL, '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\03_POS_production order sheet(scan)\\O&S -P1', 'O&S-P1-20070830_00_070830.XDW', 0),
(13, 'J113-10500', '1', '1', '2020-06-01 11:24:44', '2020-06-09 10:23:20', '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\01_Drawings\\A_Production Dwg', '_FLANGE_cancelled.XDW', 0),
(14, 'J117-04300', '2', '1', '2020-06-10 08:21:58', NULL, '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\07_DHR_Drawing history record(scan)', 'DHR-J117-04300.xdw', 0),
(15, 'J123-13800', '2', '1', '2020-06-10 08:22:17', '2020-06-15 13:08:00', '1', NULL, '\\\\192.168.82.4\\tbkk$\\RD\\Design\\09.Customers\\MITSUBISHI\\4N15 project\\4N15\'s History by Mink\\CAD from TBK Japan\\20120720150259_4N15_2D WP\\M-4868_20120720_1', 'J123-13800_1.tif', 0),
(129, 'test1234', '1', '1', NULL, NULL, '1', NULL, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `start_event` datetime DEFAULT NULL,
  `end_event` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `color`, `start_event`, `end_event`) VALUES
(268, 'TESTWOYYYYYYY', '', '#c20309', '2020-05-19 04:00:00', '2020-05-25 14:00:00'),
(269, '', '', '#0c63ba', '2020-04-29 00:00:00', '2020-05-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gen_id` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gen_id`, `gender`) VALUES
(1, 'male'),
(2, 'female');

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `p_id` int(11) NOT NULL,
  `p_no` varchar(24) DEFAULT NULL,
  `p_name` varchar(44) DEFAULT NULL,
  `d_id` int(11) NOT NULL,
  `enable` varchar(1) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `delete_flag` varchar(1) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`p_id`, `p_no`, `p_name`, `d_id`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`) VALUES
(1, '1300A126a', 'WATER PUMP ASSY', 1, '1', '2020-04-29 16:49:34', '2020-06-16 11:54:26', '1', NULL),
(2, 'J107-11820', 'COVER, WATER PUMP', 2, '1', '2020-04-29 16:50:53', '2020-06-16 09:53:07', '1', NULL),
(3, 'J107-11820-RM', 'COVER, WATER PUMP', 3, '1', '2020-04-29 16:51:15', NULL, '1', NULL),
(4, 'MS471104', 'BUSHING, KNOCK', 4, '1', NULL, NULL, '1', NULL),
(5, 'J109-09810', 'GASKET', 5, '1', '2020-04-29 16:59:39', '2020-05-13 08:15:23', '1', NULL),
(6, 'J145-00600', 'PIPE', 6, '1', '2020-04-30 08:43:49', NULL, '1', NULL),
(7, 'MF140209', 'BOLT', 7, '1', '2020-04-30 08:44:14', NULL, '1', NULL),
(8, 'J100-21860', 'WATER PUMP', 8, '1', '2020-04-30 08:44:41', NULL, '1', NULL),
(9, 'J105-39240', 'CASE, WATER PUMP', 9, '1', '2020-04-30 08:45:17', NULL, '1', NULL),
(10, 'J105-39240-RM', 'CASE, WATER PUMP', 10, '1', NULL, NULL, '1', NULL),
(11, 'J199-20030', 'PLUG', 11, '1', NULL, NULL, '1', NULL),
(12, 'J115-16410', 'IMPELLER', 12, '1', NULL, NULL, '1', NULL),
(13, 'J113-10500', 'BEARING UNIT', 13, '1', NULL, NULL, '1', '0000-00-00 00:00:00'),
(14, 'J117-04300', 'SEAL UNIT', 14, '1', NULL, NULL, '1', NULL),
(15, 'J123-13800', 'CENTER', 15, '1', NULL, NULL, '1', NULL),
(347, 'TAISOUL145', 'TAI PUMP WATER', 1, '1', '2020-06-16 10:57:31', NULL, '1', NULL),
(348, 'TAIZONE5678', 'TAI SEAL', 1, '1', '2020-06-16 10:57:49', NULL, '1', NULL),
(349, 'KING002', 'TAI CENTER', 1, '1', '2020-06-16 10:57:54', NULL, '1', NULL),
(350, 'TAIGAMEINDY5633', 'TAI PLUG', 1, '1', '2020-06-16 10:59:50', NULL, '1', NULL),
(351, 'TAISHIDORI555', 'TAI BOLT', 129, '1', '2020-06-16 11:00:24', NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `part_drawing`
--

CREATE TABLE `part_drawing` (
  `pd_id` int(11) NOT NULL COMMENT 'part drawing',
  `p_id` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `delete_flag` varchar(1) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `part_drawing`
--

INSERT INTO `part_drawing` (`pd_id`, `p_id`, `d_id`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`) VALUES
(1, 14, 9, '1', '2020-05-11 15:54:19', NULL, '1', '2020-06-02 13:51:20'),
(130, 6, 9, '1', '2020-04-30 08:30:54', '2020-04-30 08:31:27', '1', '2020-04-30 08:31:18'),
(131, 6, 10, '1', '2020-04-30 08:30:54', '2020-05-12 14:35:49', '1', NULL),
(132, 6, 9, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(133, 6, 10, '1', '2020-04-30 08:45:44', '2020-05-12 14:35:50', '1', NULL),
(134, 7, 9, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(135, 7, 10, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(136, 8, 9, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(137, 8, 10, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(138, 9, 9, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(139, 9, 10, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(140, 10, 9, '1', '2020-04-30 08:45:44', '2020-05-12 15:26:17', '1', NULL),
(141, 10, 10, '1', '2020-04-30 08:45:44', '2020-05-12 15:26:17', '1', NULL),
(142, 11, 9, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(143, 11, 10, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(144, 12, 9, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(145, 12, 10, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(146, 13, 9, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(147, 13, 10, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(148, 14, 9, '1', '2020-04-30 08:45:44', NULL, '1', '2020-06-02 13:51:00'),
(149, 14, 10, '1', '2020-04-30 08:45:44', NULL, '1', '2020-06-02 13:50:43'),
(150, 7, 10, '1', NULL, NULL, '1', NULL),
(151, 6, 10, '1', '2020-04-30 11:45:03', NULL, '1', NULL),
(152, 6, 12, '1', '2020-04-30 11:45:03', NULL, '1', NULL),
(153, 6, 13, '1', '2020-04-30 11:45:03', '2020-06-01 12:00:35', '1', '2020-06-02 13:50:11'),
(154, 8, 10, '1', '2020-04-30 11:45:03', NULL, '1', NULL),
(155, 8, 12, '1', '2020-04-30 11:45:03', NULL, '1', NULL),
(156, 8, 13, '1', '2020-04-30 11:45:03', NULL, '1', NULL),
(157, 17, 1, '1', '2020-05-11 15:55:18', NULL, '1', NULL),
(158, 17, 2, '1', '2020-05-11 15:55:18', NULL, '1', NULL),
(159, 17, 10, '1', '2020-05-11 15:55:18', NULL, '1', NULL),
(160, 18, 1, '1', '2020-05-11 15:55:35', NULL, '0', '2020-06-02 13:49:58'),
(161, 18, 2, '1', '2020-05-11 15:55:35', NULL, '0', '2020-06-02 13:49:35'),
(162, 18, 10, '1', '2020-05-11 15:55:35', NULL, '1', NULL),
(163, 19, 9, '1', '2020-05-11 16:33:45', NULL, '1', NULL),
(164, 19, 10, '1', '2020-05-11 16:33:45', NULL, '1', NULL),
(165, 19, 11, '1', '2020-05-11 16:33:45', NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_part`
--

CREATE TABLE `sub_part` (
  `sub_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `quantity` int(12) NOT NULL,
  `unit` varchar(12) NOT NULL,
  `common_part` int(12) NOT NULL,
  `date_created` datetime NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_part`
--

INSERT INTO `sub_part` (`sub_id`, `b_id`, `m_id`, `p_id`, `quantity`, `unit`, `common_part`, `date_created`, `delete_flag`, `date_deleted`) VALUES
(458, 144, 6, 7, 0, '', 0, '2020-06-08 10:38:16', 0, '2020-06-08 10:38:19'),
(459, 144, 6, 6, 0, '', 0, '2020-06-08 10:38:38', 0, '2020-06-08 10:38:44'),
(460, 144, 6, 6, 0, '', 0, '2020-06-08 10:47:09', 0, '2020-06-08 10:47:13'),
(461, 144, 6, 7, 0, 'pcs', 0, '2020-06-08 10:47:15', 1, '0000-00-00 00:00:00'),
(462, 143, 1, 6, 5, 'pcs', 10, '2020-06-08 10:51:51', 1, '0000-00-00 00:00:00'),
(463, 143, 6, 8, 10, 'pcs', 5, '2020-06-08 10:51:58', 1, '0000-00-00 00:00:00'),
(464, 143, 8, 9, 10, 'pcs', 5, '2020-06-08 10:52:01', 1, '0000-00-00 00:00:00'),
(465, 143, 9, 7, 4, 'pcs', 0, '2020-06-08 10:54:10', 0, '2020-06-08 16:27:44'),
(466, 143, 7, 11, 5, 'pcs', 0, '2020-06-08 10:54:13', 1, '0000-00-00 00:00:00'),
(467, 143, 11, 10, 5, 'pcs', 0, '2020-06-08 10:54:17', 1, '0000-00-00 00:00:00'),
(468, 143, 10, 13, 5, 'pcs', 0, '2020-06-08 10:54:20', 1, '0000-00-00 00:00:00'),
(469, 143, 13, 14, 5, 'pcs', 0, '2020-06-08 10:54:24', 1, '0000-00-00 00:00:00'),
(470, 143, 14, 32, 10, 'pcs', 1, '2020-06-08 10:54:29', 1, '0000-00-00 00:00:00'),
(471, 143, 1, 7, 0, '', 0, '2020-06-08 16:27:51', 0, '2020-06-08 16:28:00'),
(472, 143, 1, 28, 1, 'pcs', 0, '2020-06-08 16:28:08', 0, '2020-06-09 09:03:08'),
(473, 143, 1, 30, 0, '', 0, '2020-06-08 16:28:08', 1, '0000-00-00 00:00:00'),
(474, 143, 1, 32, 0, '', 0, '2020-06-08 16:28:08', 1, '0000-00-00 00:00:00'),
(477, 143, 28, 7, 1, 'pcs', 0, '2020-06-08 16:31:10', 1, '0000-00-00 00:00:00'),
(478, 143, 28, 6, 0, '', 0, '2020-06-08 16:35:21', 1, '0000-00-00 00:00:00'),
(479, 144, 7, 10, 0, 'pcs', 0, '2020-06-08 16:54:06', 1, '0000-00-00 00:00:00'),
(480, 144, 7, 30, 0, 'pcs', 0, '2020-06-08 16:54:10', 0, '2020-06-09 09:14:20'),
(481, 144, 10, 12, 0, 'pcs', 0, '2020-06-08 16:54:14', 1, '0000-00-00 00:00:00'),
(482, 144, 30, 18, 0, 'pcs', 0, '2020-06-08 16:54:20', 0, '2020-06-09 09:13:52'),
(483, 144, 7, 18, 0, 'pcs', 0, '2020-06-08 16:54:28', 0, '2020-06-09 09:13:55'),
(484, 144, 6, 6, 0, '', 0, '2020-06-09 09:13:27', 0, '2020-06-09 09:13:44'),
(485, 144, 6, 30, 0, '', 0, '2020-06-09 09:17:46', 0, '2020-06-09 09:17:48'),
(486, 144, 6, 7, 0, '', 0, '2020-06-09 09:23:58', 1, '0000-00-00 00:00:00'),
(487, 144, 6, 8, 0, 'pcs', 0, '2020-06-09 09:52:25', 1, '0000-00-00 00:00:00'),
(488, 144, 6, 9, 0, 'pcs', 0, '2020-06-09 11:08:11', 1, '0000-00-00 00:00:00'),
(489, 144, 6, 10, 0, 'pcs', 0, '2020-06-09 11:08:11', 1, '0000-00-00 00:00:00'),
(490, 144, 6, 11, 0, 'pcs', 0, '2020-06-09 11:08:11', 1, '0000-00-00 00:00:00'),
(491, 145, 6, 7, 0, 'pcs', 0, '2020-06-09 11:36:33', 1, '0000-00-00 00:00:00'),
(492, 145, 6, 8, 0, 'pcs', 0, '2020-06-09 11:36:33', 0, '2020-06-09 11:36:36'),
(493, 145, 7, 8, 0, 'pcs', 0, '2020-06-09 11:36:41', 0, '2020-06-09 11:38:17'),
(494, 145, 6, 7, 0, 'pcs', 0, '2020-06-09 11:37:01', 0, '2020-06-09 11:38:31'),
(495, 145, 6, 9, 0, 'pcs', 0, '2020-06-09 11:37:02', 0, '2020-06-09 11:38:22'),
(496, 145, 6, 10, 0, 'pcs', 0, '2020-06-09 11:37:02', 1, '0000-00-00 00:00:00'),
(497, 145, 6, 11, 0, 'pcs', 0, '2020-06-09 11:37:02', 1, '0000-00-00 00:00:00'),
(498, 145, 11, 26, 0, 'pcs', 0, '2020-06-09 11:37:09', 1, '0000-00-00 00:00:00'),
(499, 145, 26, 10, 0, 'pcs', 0, '2020-06-09 11:37:20', 1, '0000-00-00 00:00:00'),
(500, 145, 6, 32, 0, 'pcs', 0, '2020-06-09 11:37:25', 1, '0000-00-00 00:00:00'),
(501, 145, 7, 8, 0, 'pcs', 0, '2020-06-09 11:38:27', 1, '0000-00-00 00:00:00'),
(502, 145, 6, 30, 0, 'pcs', 0, '2020-06-09 11:38:36', 1, '0000-00-00 00:00:00'),
(503, 145, 6, 30, 0, 'pcs', 0, '2020-06-09 11:38:41', 1, '0000-00-00 00:00:00'),
(504, 145, 6, 9, 0, 'pcs', 0, '2020-06-09 11:38:44', 1, '0000-00-00 00:00:00'),
(505, 143, 1, 6, 0, 'pcs', 0, '2020-06-09 13:19:32', 1, '0000-00-00 00:00:00'),
(506, 143, 1, 7, 0, 'pcs', 0, '2020-06-09 13:19:32', 1, '0000-00-00 00:00:00'),
(507, 143, 1, 8, 0, 'pcs', 0, '2020-06-09 13:19:32', 1, '0000-00-00 00:00:00'),
(508, 143, 14, 12, 0, 'pcs', 0, '2020-06-09 13:19:54', 1, '0000-00-00 00:00:00'),
(509, 143, 14, 15, 0, 'pcs', 0, '2020-06-09 13:19:54', 1, '0000-00-00 00:00:00'),
(510, 143, 14, 18, 0, 'pcs', 0, '2020-06-09 13:19:54', 1, '0000-00-00 00:00:00'),
(511, 143, 14, 33, 0, 'pcs', 0, '2020-06-09 13:19:54', 1, '0000-00-00 00:00:00'),
(512, 143, 8, 11, 0, 'pcs', 0, '2020-06-09 13:20:05', 1, '0000-00-00 00:00:00'),
(513, 143, 8, 12, 0, 'pcs', 0, '2020-06-09 13:20:05', 1, '0000-00-00 00:00:00'),
(514, 143, 8, 13, 0, 'pcs', 0, '2020-06-09 13:20:05', 1, '0000-00-00 00:00:00'),
(515, 143, 32, 15, 0, 'pcs', 0, '2020-06-09 13:46:36', 1, '0000-00-00 00:00:00'),
(516, 143, 15, 17, 0, 'pcs', 0, '2020-06-09 13:46:41', 1, '0000-00-00 00:00:00'),
(517, 143, 17, 18, 0, 'pcs', 0, '2020-06-09 13:46:47', 1, '0000-00-00 00:00:00'),
(518, 145, 6, 7, 0, 'pcs', 0, '2020-06-09 14:08:52', 1, '0000-00-00 00:00:00'),
(519, 146, 32, 9, 0, 'pcs', 0, '2020-06-09 14:09:15', 1, '0000-00-00 00:00:00'),
(520, 146, 32, 6, 0, 'pcs', 0, '2020-06-09 14:09:27', 1, '0000-00-00 00:00:00'),
(521, 146, 9, 15, 0, 'pcs', 0, '2020-06-09 14:09:34', 1, '0000-00-00 00:00:00'),
(522, 0, 3, 0, 0, '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(523, 147, 339, 3, 0, 'pcs', 0, '2020-06-10 15:29:01', 1, '0000-00-00 00:00:00'),
(524, 147, 3, 2, 0, 'pcs', 0, '2020-06-10 15:30:25', 1, '0000-00-00 00:00:00'),
(525, 147, 3, 5, 0, 'pcs', 0, '2020-06-10 15:30:31', 1, '0000-00-00 00:00:00'),
(526, 147, 3, 7, 0, 'pcs', 0, '2020-06-10 15:30:31', 1, '0000-00-00 00:00:00'),
(527, 0, 3, 123, 0, '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(528, 0, 0, 123, 0, '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(529, 0, 0, 123, 0, '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sys_menus`
--

CREATE TABLE `sys_menus` (
  `m_id` varchar(255) NOT NULL,
  `mg_id` varchar(255) DEFAULT NULL,
  `sp_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `enable` varchar(255) DEFAULT NULL,
  `order_no` varchar(255) DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_menus`
--

INSERT INTO `sys_menus` (`m_id`, `mg_id`, `sp_id`, `name`, `method`, `link`, `enable`, `order_no`, `date_created`) VALUES
('1', '3', '1', 'Edit Profile', 'editprofile/manage', 'editprofile/manage', '1', '1', '20/3/2015 00:00:00'),
('10', '7', '19', 'Add Part', 'part/add', 'part/add', '1', '1', '20/3/2015 00:00:00'),
('11', '7', '19', 'Manage Part', 'part/manage', 'part/manage', '1', '3', '20/3/2015 00:00:00'),
('12', '7', '17', 'Add Sub-Part', 'part/add_sub', 'part/add_sub', '0', '2', NULL),
('13', '9', '19', 'Manage Part-Drawing', 'part_drawing/manage', 'part_drawing/manage', '0', '0', '20/3/2015 00:00:00'),
('14', '9', '19', 'Add Part-Drawing', 'part_drawing/add', 'part_drawing/add', '0', '2', '20/3/2015 00:00:00'),
('15', '2', '17', 'Rule', 'user/rule', 'user/rule', '1', '0', '20/3/2015 00:00:00'),
('16', '10', '16', 'Manage Dcn', 'dcn/manage', 'dcn/manage', '1', '2', NULL),
('17', '6', '19', 'Add Version', 'drawing/version_form', 'drawing/version_form', '0', '2', NULL),
('18', '11', '10', 'Add Bom', 'bom/add', 'bom/add', '1', '1', NULL),
('19', '11', '10', 'Manage Bom', 'bom/manage', 'bom/manage', '1', '2', NULL),
('2', '3', '1', 'Change Password', 'changepassword/account', 'changepassword/account', '1', '2', '20/3/2015 00:00:00'),
('20', '6', '19', 'Add Version_V', 'drawing/version_form_v', 'drawing/version_form_v', '0', '3', NULL),
('21', '15', '19', 'Edit_Permission', 'permission/edit_permission', 'permission/edit_permission', '0', '3', NULL),
('22', '4', '15', 'Edit_Permission_Groups', 'permissiongroup/edit_pg', 'permissiongroup/edit_permissiongroup', '0', '4', NULL),
('23', '5', '17', 'Rlue_Group', 'usergroup/rule_ug', 'usergroup/rule_ug', '0', '3', NULL),
('24', '5', '1150', 'Edit_Group', 'usergroup/edit_ug', 'usergroup/edit_ug', '0', '4', NULL),
('25', '2', '17', 'Edit_User', 'user/edit_u', 'user/edit_u', '0', '4', NULL),
('26', '10', '1111', 'Edit_DCN', 'dcn/edit_dcn', 'dcn/edit_dcn', '1', '0', NULL),
('27', '7', '9', 'Edit_Part', 'part/edit_part', 'part/edit_part', '1', '0', NULL),
('28', '6', '1', 'Add Drawing', 'drawing/add', 'drawing/add', '1', '1', NULL),
('29', '5', '5555', 'Add Usergroup', 'usergroup/add', 'usergroup/add', '1', '1', NULL),
('3', '4', '16', 'Permission', 'permission/manage', 'permission/manage', '1', '2', '20/3/2015 00:00:00'),
('30', '4', '5555', 'Add Permission', 'permission/add', 'permission/add', '1', '1', NULL),
('31', '12', '55555', 'Add Permission Group', 'permissiongroup/add', 'permissiongroup/add', '1', '1', NULL),
('32', '10', '5555', 'Add DCN', 'dcn/add', 'dcn/add', '1', '1', NULL),
('4', '12', '5555', 'Permission Group', 'permissiongroup/manage', 'permissiongroup/manage', '1', '2', '20/3/2015 00:00:00'),
('5', '2', '17', 'Add User', 'user/add', 'user/add', '1', '1', '20/3/2015 00:00:00'),
('6', '2', '17', 'Manage User', 'user/manage', 'user/manage', '1', '2', '20/3/2015 00:00:00'),
('7', '5', '18', 'User Group', 'usergroup/manage', 'usergroup/manage', '1', '2', '20/3/2015 00:00:00'),
('8', '1', '19', 'Home', 'manage/index', 'manage/index', '1', '1', '20/3/2015 00:00:00'),
('9', '6', '19', 'Manage Drawing', 'drawing/manage', 'drawing/manage', '1', '2', '20/3/2015 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sys_menu_groups`
--

CREATE TABLE `sys_menu_groups` (
  `mg_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `icon_menu` varchar(50) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  `order_no` tinyint(4) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_menu_groups`
--

INSERT INTO `sys_menu_groups` (`mg_id`, `name`, `icon_menu`, `enable`, `order_no`, `date_created`) VALUES
(1, 'Main', 'fa-home', '1', 1, '2015-03-03 00:00:00'),
(2, 'Users', 'fa-user', '1', 3, '2015-03-03 00:00:00'),
(3, 'Settings', 'fa-cog', '1', 2, '2015-03-03 00:00:00'),
(4, 'Permissions', 'fa-unlock-alt', '1', 5, '2015-03-20 00:00:00'),
(5, 'Groups', 'fa-group', '1', 4, '2015-03-20 00:00:00'),
(6, 'Drawing', ' fa-wpforms\n', '1', 7, '2015-03-20 00:00:00'),
(7, 'Part', 'fa-cogs', '1', 8, '2015-03-20 00:00:00'),
(8, 'Task', 'fa-tasks', '1', 9, '2020-02-26 09:54:40'),
(9, 'Part-Drawing', 'fa-tasks', '0', 0, '2020-02-26 09:54:40'),
(10, 'Dcn', 'fa-clipboard', '1', 11, '2020-05-11 00:00:00'),
(11, 'BOM', NULL, '1', 12, '2020-05-13 00:00:00'),
(12, 'Permissions Group', 'fa-unlock-alt', '1', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_menu_show`
--

CREATE TABLE `sys_menu_show` (
  `sms_id` int(11) NOT NULL,
  `mg_id` int(11) NOT NULL,
  `sug_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sys_menu_show`
--

INSERT INTO `sys_menu_show` (`sms_id`, `mg_id`, `sug_id`) VALUES
(1, 1, 3),
(2, 3, 3),
(3, 6, 3),
(4, 7, 3),
(5, 9, 3),
(6, 10, 3),
(7, 11, 3),
(15, 1, 1),
(16, 2, 1),
(17, 3, 1),
(18, 4, 1),
(19, 5, 1),
(20, 6, 1),
(21, 7, 1),
(22, 8, 1),
(23, 9, 1),
(24, 10, 1),
(25, 11, 1),
(26, 1, 2),
(27, 1, 2),
(28, 1, 2),
(29, 1, 2),
(30, 1, 2),
(31, 1, 2),
(32, 1, 2),
(33, 1, 2),
(34, 1, 2),
(35, 1, 2),
(36, 1, 2),
(37, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_permissions`
--

CREATE TABLE `sys_permissions` (
  `sp_id` int(11) NOT NULL,
  `spg_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `controller` varchar(30) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `delete_flag` varchar(1) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_permissions`
--

INSERT INTO `sys_permissions` (`sp_id`, `spg_id`, `name`, `controller`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`) VALUES
(1, 1, 'EDIT PROFILE', 'editprofile/account', '1', '2015-03-03 00:00:00', '2020-04-29 11:10:27', '1', '2020-01-17 16:06:55'),
(2, 1, 'CHANGE PASSWORD PROFILE', 'changepassword/account', '1', '2015-03-03 00:00:00', '2020-04-10 10:31:07', '1', '2020-01-17 16:06:55'),
(3, 2, 'ADD USER', 'user/add', '1', '2015-03-03 00:00:00', '2020-01-17 10:02:34', '1', '2020-01-17 09:28:06'),
(4, 2, 'EDIT USER', 'user/edit_u', '1', '2015-03-03 00:00:00', '2020-04-10 10:31:08', '1', NULL),
(5, 2, 'DELETE USER', 'user/delete', '1', '2015-03-03 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(6, 4, 'ADD PERMISSION', 'permission/insert', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(7, 4, 'EDIT PERMISSION', 'permission/edit_permission', '1', '2015-03-20 00:00:00', '2020-04-29 16:01:10', '1', NULL),
(8, 4, 'DELETE PERMISSION', 'permission/deletepermission', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(9, 3, 'ADD USER GROUP', 'usergroup/insert', '1', '2015-03-20 00:00:00', '2020-04-10 13:07:06', '1', NULL),
(10, 3, 'EDIT USER GROUP', 'usergroup/edit_ug', '1', '2015-03-20 00:00:00', '2020-06-02 10:39:40', '1', NULL),
(11, 3, 'DELETE USER GROUP', 'usergroup/deletegroup', '1', '2015-03-20 00:00:00', NULL, '1', '2020-05-26 13:22:27'),
(12, 5, 'ADD PERMISSION GROUP', 'permissiongroup/insert', '1', '2015-03-20 00:00:00', '2020-06-02 11:51:02', '1', NULL),
(13, 5, 'EDIT PERMISSION GROUP', 'permissiongroup/edit_pg', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(14, 5, 'DELETE PERMISSION GROUP', 'permissiongroup/delete_pg', '1', '2015-03-20 00:00:00', '2020-04-29 13:17:43', '1', NULL),
(15, 5, 'MANAGE PERMISSION GROUP', 'permissiongroup/manage', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(16, 4, 'MANAGE PERMISSION', 'permission/manage', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(17, 2, 'MANAGE USER', 'user/manage', '1', '2015-03-25 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(18, 3, 'MANAGE USER GROUP', 'usergroup/manage', '1', '2015-03-25 00:00:00', '2020-04-29 11:11:23', '1', NULL),
(19, 4, 'EDIT USER RULE', 'user/rule', '1', '2015-03-25 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(20, 2, 'ENABLE USER', 'user/enable', '1', '2017-02-01 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(21, 2, 'DISABLE USER', 'user/disable', '1', '2017-02-01 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(22, 5, 'EDIT USERGROUP RULE', 'usergroup/rule_ug', '1', '2020-06-02 11:03:48', NULL, '1', NULL),
(23, 3, 'DISABLE USERGROUP', 'usergroup/disable', '1', '2020-06-02 11:22:59', NULL, '1', NULL),
(24, 3, 'ENABLE USERGROUP', 'usergroup/enable', '1', '2020-06-02 11:23:41', NULL, '1', NULL),
(28, 4, 'DISABLE PERMISSION', 'permission/disable', '1', '2020-06-02 11:36:27', NULL, '1', NULL),
(29, 4, 'ENABLE PERMISSION', 'permission/enable', '1', '2020-06-02 11:36:47', NULL, '1', NULL),
(31, 5, 'DISABLE PERMISSIONGROUP', 'permissiongroup/disable', '1', '2020-06-02 11:46:29', NULL, '1', NULL),
(32, 5, 'ENABLE PERMISSIONGROUP', 'permissiongroup/enable', '1', '2020-06-02 11:47:03', NULL, '1', NULL),
(33, 10, 'ADD PART', 'part/add', '1', '2020-06-02 13:04:39', NULL, '1', NULL),
(34, 10, 'MANAGE PART', 'part/manage', '1', '2020-06-02 13:09:15', NULL, '1', NULL),
(35, 10, 'ADD SUBPART', 'part/add_sub', '1', '2020-06-02 13:13:17', NULL, '1', NULL),
(36, 10, 'DISABLE PART', 'part/disable', '1', '2020-06-02 13:31:47', NULL, '1', NULL),
(37, 10, 'ENABLE PART', 'part/enable', '1', '2020-06-02 13:32:02', NULL, '1', NULL),
(38, 10, 'EDIT PART', 'part/edit_part', '1', '2020-06-02 13:32:55', NULL, '1', NULL),
(39, 10, 'DELETE PART', 'part/deletepart', '1', '2020-06-02 13:33:26', NULL, '1', NULL),
(40, 13, 'MANAGE PART-DRAWING', 'part_drawing/manage', '1', '2020-06-02 13:44:40', '2020-06-09 14:56:19', '1', NULL),
(41, 13, 'DELETE PART-DRAWING', 'part_drawing/deletePartD', '1', '2020-06-02 13:48:20', NULL, '1', NULL),
(42, 13, 'MANAGE PART-DRAWING', 'part_drawing/manage', '1', '2020-06-02 13:48:51', NULL, '1', NULL),
(43, 11, 'MANAGE DCN', 'dcn/manage', '1', '2020-06-02 13:52:30', NULL, '1', NULL),
(44, 11, 'EDIT DCN', 'dcn/edit_dcn', '1', '2020-06-02 13:58:41', NULL, '1', NULL),
(45, 11, 'DELETE DCM', 'dcn/deletedcn', '1', '2020-06-02 14:06:58', NULL, '1', NULL),
(46, 11, 'ADD DCN', 'dcn/insert', '1', '2020-06-02 14:09:26', NULL, '1', NULL),
(47, 12, 'ADD BOM', 'bom/add', '1', '2020-06-02 14:16:17', NULL, '1', NULL),
(48, 13, 'MANAGE BOM', 'bom/manage', '1', '2020-06-02 14:16:44', NULL, '1', NULL),
(49, 1, 'TTTTTTTTTTTTTTT', 'TTTTTTTTTTT', '1', '2020-06-10 14:50:58', NULL, '1', NULL),
(50, 2, 'TTTTTTTTTTTTTTTTTTTTTTTTT', 'testnaja', '1', '2020-06-10 14:56:03', NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_permission_groups`
--

CREATE TABLE `sys_permission_groups` (
  `spg_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `delete_flag` varchar(1) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_permission_groups`
--

INSERT INTO `sys_permission_groups` (`spg_id`, `name`, `enable`, `date_created`, `delete_flag`, `date_deleted`, `date_updated`) VALUES
(1, 'MANAGE PROFILE', '1', '2020-01-18 10:25:27', '1', '2020-01-17 16:06:55', '2020-06-02 12:05:14'),
(2, 'MANAGE USERS', '1', '2020-01-17 10:02:34', '1', NULL, '2020-06-09 15:03:32'),
(3, 'MANAGE USER GROUPS', '1', '2015-03-03 00:00:00', '1', NULL, NULL),
(4, 'MANAGE PERMISSION', '1', '2015-03-25 00:00:00', '1', NULL, '2020-05-12 14:35:03'),
(5, 'MANAGE PERMISSION GROUPS', '1', '2015-03-25 00:00:00', '1', NULL, '2020-06-02 12:04:39'),
(9, 'MANAGE DRAWING', '1', '2020-06-02 13:02:02', '1', NULL, NULL),
(10, 'MANAGE PART', '1', '2020-06-02 13:02:10', '1', NULL, NULL),
(11, 'MANAGE DCN', '1', '2020-06-02 13:02:24', '1', NULL, NULL),
(12, 'MANAGE PART-DRAWING', '1', '2020-06-02 13:44:17', '1', NULL, NULL),
(13, 'MANAGE BOM', '1', '2020-06-02 13:02:46', '1', NULL, NULL),
(15, 'TTTTTTTTTTTTT', '1', '2020-06-10 15:23:41', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_users`
--

CREATE TABLE `sys_users` (
  `su_id` int(11) NOT NULL,
  `sug_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  `last_access` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `delete_flag` varchar(1) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_users`
--

INSERT INTO `sys_users` (`su_id`, `sug_id`, `username`, `password`, `firstname`, `lastname`, `gender`, `email`, `enable`, `last_access`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`) VALUES
(1, 1, 'sadmin', 'dGVhbWludw==', 'Talerngsak', 'Klangsatorn', 'male', 'talerngsak@tbkk.co.th', '1', '2019-01-23 09:16:00', '2019-01-23 09:16:00', '2020-03-09 10:45:19', '1', NULL),
(2, 2, 'talerngsak', 'YWExMjM0NTY=', 'Talerngsak', 'Klangsatorn', 'male', 'talerngsak@tbkk.co.th', '1', NULL, '2020-02-05 15:20:48', '2020-04-09 16:52:29', '1', NULL),
(3, 3, 'samart', 'YWExMjM0NTY=', 'Samart', 'Thanomchart', 'male', 'samart@tbkk.co.th', '1', NULL, '2020-02-05 15:21:44', '2020-04-09 16:52:22', '0', '2020-03-03 13:34:16'),
(4, 3, 'AAAAA', 'YWExMjM0NTY=', 'Aksarapak', 'Daotaisong', 'female', 'aksarapak@tbkk.co.th', '1', NULL, '2020-02-05 15:22:19', '2020-04-29 08:59:11', '1', NULL),
(5, 3, 'sawanant', 'YWExMjM0NTY=', 'Sawanant', 'Siritipchintana', 'male', 'sawanant@tbkk.co.th', '1', NULL, '2020-02-05 15:23:29', '2020-04-08 14:46:17', '1', NULL),
(6, 1, 'TEST', 'YWExMjM0NTY=', 'TEST', 'TEST', 'female', 'TEST@tbkk.co.th', '1', NULL, '2020-02-05 15:24:13', '2020-05-27 11:39:30', '1', NULL),
(7, 3, 'theerasak', 'YWExMjM0NTY=', 'Theerasak', 'Samranklang	', 'male', 'theerasak@tbkk.co.th', '1', NULL, '2020-02-05 15:38:42', '2020-06-09 15:08:58', '1', NULL),
(8, 3, 'pachara', 'YWExMjM0NTY=', 'Pachara', 'Manpian', 'male', 'pachara@tbkk.co.th', '1', NULL, '2020-02-05 15:39:50', '2020-02-05 15:39:50', '1', NULL),
(9, 4, 'Pitak12345678910', 'YWExMjM0NTY=', 'Pitak', 'Puanmano', 'male', 'pitak@tbkk.co.th', '1', NULL, '2020-02-05 15:42:44', '2020-06-02 10:27:18', '1', NULL),
(10, 3, 'pittaya', 'YWExMjM0NTY=', 'Pittaya', 'Thammachoto', 'male', 'pittaya@tbkk.co.th', '1', NULL, '2020-02-05 15:43:20', '2020-02-05 15:43:20', '1', NULL),
(11, 3, 'ruangthong', 'YWExMjM0NTY=', 'Ruangthong', 'Thongyu', 'female', 'ruangthong@tbkk.co.th', '1', NULL, '2020-02-05 15:44:18', '2020-02-05 15:44:18', '1', NULL),
(12, 3, 'takashi', 'YWExMjM0NTY=', 'Takashi', 'Kageyama', 'male', 'kageyama@tbkk.co.th', '1', NULL, '2020-02-05 15:45:02', '2020-02-05 15:45:02', '0', '2020-05-12 10:37:54'),
(13, 3, 'okada1', 'YWExMjM0NTY=', 'Okada', 'Masayoshi', 'male', 'okada@tbkk.co.th', '1', NULL, '2020-02-05 15:46:07', '2020-02-05 15:46:07', '1', NULL),
(14, 2, 'chanin', 'Y2hhbmlu', 'chanin', 'chaisatain', 'male', 'Surin@gmail.comadmin', '1', NULL, '2020-02-07 14:31:00', '2020-02-07 14:31:00', '1', NULL),
(15, 2, 'mikmik', 'bWlrbWlr', 'kookmik', 'Surin', 'male', 'Surin@gmail.com', '1', NULL, '2020-02-07 14:39:40', '2020-02-07 14:39:40', '0', '2020-05-12 10:37:14'),
(16, 2, 'test01', 'dGVzdDAx', 'ronaldo', 'inw', 'male', 'Surin@gmail.com', '1', NULL, '2020-03-03 10:26:09', '2020-04-09 16:52:27', '0', '2020-04-29 10:38:35'),
(18, 2, 'hahaha', 'aGFoYWhhaGFoYQ==', 'hatari', 'adfasdnf', 'male', 'Surssssin@gmail.com', '1', NULL, '2020-03-03 10:28:13', '2020-04-08 11:32:35', '0', '2020-05-12 10:37:23'),
(19, 2, 'sfasdfasdf', 'YXNkZmFzZGY=', 'asdfasdf', 'adfasdf', 'female', 'Surin@gmail.comadmin', '1', NULL, '2020-03-03 10:48:27', '2020-03-03 10:48:27', '1', NULL),
(33, 4, 'TEST0863', 'TEST0863', 'TEST0863', 'TEST0863', 'male', 'casterman@hotmail.com', '1', NULL, '2020-04-29 13:47:53', '2020-04-29 13:47:53', '1', '2020-05-27 10:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `sys_users_groups_permissions`
--

CREATE TABLE `sys_users_groups_permissions` (
  `sugp_id` int(11) NOT NULL,
  `sug_id` int(11) DEFAULT NULL,
  `spg_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_users_groups_permissions`
--

INSERT INTO `sys_users_groups_permissions` (`sugp_id`, `sug_id`, `spg_id`, `date_created`) VALUES
(1019, 3, 1, '2020-01-17 15:59:56'),
(1066, 2, 2, '2020-01-18 08:42:35'),
(1071, 6, 1, '2020-05-27 08:49:15'),
(1072, 6, 2, '2020-05-27 08:49:15'),
(1073, 6, 3, '2020-05-27 08:49:15'),
(1074, 6, 4, '2020-05-27 08:49:15'),
(1075, 6, 5, '2020-05-27 08:49:15'),
(1076, 6, 6, '2020-05-27 08:49:15'),
(1082, 0, 1, '2020-06-01 13:23:14'),
(1083, 0, 2, '2020-06-01 13:23:14'),
(1086, 4, 2, '2020-06-01 13:31:34'),
(1087, 1, 1, '2020-06-02 13:05:27'),
(1088, 1, 2, '2020-06-02 13:05:27'),
(1089, 1, 3, '2020-06-02 13:05:27'),
(1090, 1, 4, '2020-06-02 13:05:27'),
(1091, 1, 5, '2020-06-02 13:05:27'),
(1092, 1, 9, '2020-06-02 13:05:27'),
(1093, 1, 10, '2020-06-02 13:05:27'),
(1094, 1, 11, '2020-06-02 13:05:27'),
(1095, 1, 12, '2020-06-02 13:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `sys_users_permissions`
--

CREATE TABLE `sys_users_permissions` (
  `sup_id` bigint(20) NOT NULL,
  `su_id` int(11) DEFAULT NULL,
  `sp_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_users_permissions`
--

INSERT INTO `sys_users_permissions` (`sup_id`, `su_id`, `sp_id`, `date_created`) VALUES
(95, 14, 1, '2020-04-29 16:10:10'),
(96, 14, 4, '2020-04-29 16:10:10'),
(170, 7, 1, '2020-06-02 09:58:24'),
(882, 1, 1, '2020-06-10 12:13:22'),
(883, 1, 2, '2020-06-10 12:13:23'),
(884, 1, 3, '2020-06-10 12:13:23'),
(885, 1, 4, '2020-06-10 12:13:23'),
(886, 1, 5, '2020-06-10 12:13:23'),
(887, 1, 6, '2020-06-10 12:13:23'),
(888, 1, 7, '2020-06-10 12:13:23'),
(889, 1, 8, '2020-06-10 12:13:23'),
(890, 1, 9, '2020-06-10 12:13:23'),
(891, 1, 10, '2020-06-10 12:13:23'),
(892, 1, 11, '2020-06-10 12:13:23'),
(893, 1, 12, '2020-06-10 12:13:23'),
(894, 1, 13, '2020-06-10 12:13:23'),
(895, 1, 14, '2020-06-10 12:13:23'),
(896, 1, 15, '2020-06-10 12:13:23'),
(897, 1, 16, '2020-06-10 12:13:23'),
(898, 1, 17, '2020-06-10 12:13:23'),
(899, 1, 18, '2020-06-10 12:13:23'),
(900, 1, 19, '2020-06-10 12:13:23'),
(901, 1, 20, '2020-06-10 12:13:23'),
(902, 1, 21, '2020-06-10 12:13:23'),
(903, 1, 22, '2020-06-10 12:13:23'),
(904, 1, 23, '2020-06-10 12:13:23'),
(905, 1, 24, '2020-06-10 12:13:23'),
(906, 1, 28, '2020-06-10 12:13:23'),
(907, 1, 29, '2020-06-10 12:13:23'),
(908, 1, 31, '2020-06-10 12:13:23'),
(909, 1, 32, '2020-06-10 12:13:23'),
(910, 1, 33, '2020-06-10 12:13:24'),
(911, 1, 34, '2020-06-10 12:13:24'),
(912, 1, 35, '2020-06-10 12:13:24'),
(913, 1, 36, '2020-06-10 12:13:24'),
(914, 1, 37, '2020-06-10 12:13:24'),
(915, 1, 38, '2020-06-10 12:13:24'),
(916, 1, 39, '2020-06-10 12:13:24'),
(917, 1, 40, '2020-06-10 12:13:24'),
(918, 1, 41, '2020-06-10 12:13:24'),
(919, 1, 42, '2020-06-10 12:13:24'),
(920, 1, 43, '2020-06-10 12:13:24'),
(921, 1, 44, '2020-06-10 12:13:24'),
(922, 1, 45, '2020-06-10 12:13:24'),
(923, 1, 46, '2020-06-10 12:13:24'),
(924, 1, 47, '2020-06-10 12:13:24'),
(925, 1, 48, '2020-06-10 12:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_groups`
--

CREATE TABLE `sys_user_groups` (
  `sug_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `delete_flag` varchar(1) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_user_groups`
--

INSERT INTO `sys_user_groups` (`sug_id`, `name`, `enable`, `date_created`, `delete_flag`, `date_deleted`, `date_updated`) VALUES
(1, 'SUPER ADMIN', '1', '2020-01-18 08:34:36', '1', NULL, '2020-06-09 15:05:10'),
(2, 'ADMIN', '1', '2020-01-18 08:42:35', '1', NULL, NULL),
(3, 'MEMBER', '1', '2020-01-17 15:59:56', '1', NULL, '2020-05-26 15:19:19'),
(4, 'MEMBER ADMIN', '1', '2020-01-18 08:36:08', '1', NULL, '2020-06-02 12:00:27');

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
  `path_file` varchar(200) NOT NULL,
  `file_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`v_id`, `d_id`, `d_no`, `dcn_id`, `version`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`, `path_file`, `file_name`) VALUES
(79, 1, '1300A126 V3', '16', 0, 0, '2020-06-16 14:19:53', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', '\\\\192.168.82.4\\tbkk$\\RD\\Drawing\\01_Drawings\\A_Production Dwg', 'A_1300A126_06_20200309_WATER PUMP ASSY.xdw');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bom`
--
ALTER TABLE `bom`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `dcn`
--
ALTER TABLE `dcn`
  ADD PRIMARY KEY (`dcn_id`);

--
-- Indexes for table `drawing`
--
ALTER TABLE `drawing`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gen_id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `part_drawing`
--
ALTER TABLE `part_drawing`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `sub_part`
--
ALTER TABLE `sub_part`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `sys_menus`
--
ALTER TABLE `sys_menus`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `sys_menu_groups`
--
ALTER TABLE `sys_menu_groups`
  ADD PRIMARY KEY (`mg_id`);

--
-- Indexes for table `sys_menu_show`
--
ALTER TABLE `sys_menu_show`
  ADD PRIMARY KEY (`sms_id`);

--
-- Indexes for table `sys_permissions`
--
ALTER TABLE `sys_permissions`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `sys_permission_groups`
--
ALTER TABLE `sys_permission_groups`
  ADD PRIMARY KEY (`spg_id`);

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`su_id`);

--
-- Indexes for table `sys_users_groups_permissions`
--
ALTER TABLE `sys_users_groups_permissions`
  ADD PRIMARY KEY (`sugp_id`);

--
-- Indexes for table `sys_users_permissions`
--
ALTER TABLE `sys_users_permissions`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `sys_user_groups`
--
ALTER TABLE `sys_user_groups`
  ADD PRIMARY KEY (`sug_id`);

--
-- Indexes for table `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bom`
--
ALTER TABLE `bom`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `dcn`
--
ALTER TABLE `dcn`
  MODIFY `dcn_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `drawing`
--
ALTER TABLE `drawing`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `part_drawing`
--
ALTER TABLE `part_drawing`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'part drawing', AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `sub_part`
--
ALTER TABLE `sub_part`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=530;

--
-- AUTO_INCREMENT for table `sys_menu_show`
--
ALTER TABLE `sys_menu_show`
  MODIFY `sms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sys_permissions`
--
ALTER TABLE `sys_permissions`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sys_permission_groups`
--
ALTER TABLE `sys_permission_groups`
  MODIFY `spg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `su_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sys_users_groups_permissions`
--
ALTER TABLE `sys_users_groups_permissions`
  MODIFY `sugp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1096;

--
-- AUTO_INCREMENT for table `sys_users_permissions`
--
ALTER TABLE `sys_users_permissions`
  MODIFY `sup_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=926;

--
-- AUTO_INCREMENT for table `sys_user_groups`
--
ALTER TABLE `sys_user_groups`
  MODIFY `sug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `version`
--
ALTER TABLE `version`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
