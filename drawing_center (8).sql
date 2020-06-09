-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2020 at 06:53 AM
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
(145, 6, 0, 'pcs', 0, '2020-06-09 11:36:32', 1, '0000-00-00 00:00:00');

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
  `date_deleted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dcn`
--

INSERT INTO `dcn` (`dcn_id`, `dcn_no`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`) VALUES
(1, '897664-4910', 1, '2020-05-11 14:20:19', '2020-06-01 09:11:28', 1, '0000-00-00 00:00:00'),
(2, '3131323213', 1, '2020-05-11 14:21:24', '2020-06-01 08:30:54', 1, '0000-00-00 00:00:00'),
(10, '010101', 1, '2020-06-01 08:55:05', '2020-06-01 09:00:08', 1, '0000-00-00 00:00:00');

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
  `file_name` varchar(100) NOT NULL,
  `version` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drawing`
--

INSERT INTO `drawing` (`d_id`, `d_no`, `dcn_id`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`, `file_name`, `version`) VALUES
(9, '1300A126', '1', '1', '2020-04-29 16:46:57', NULL, '1', NULL, 'test', 0),
(10, 'J107-11820', '2', '1', '2020-04-29 16:47:10', NULL, '1', NULL, 'asd', 0),
(11, 'J107-11820-RM', '1', '1', '2020-04-29 16:47:28', NULL, '1', NULL, 'zxc', 0),
(12, 'MSX3-4912-RM', '897664-4910', '1', '2020-04-29 16:47:43', '2020-06-09 11:51:24', '1', '2020-05-26 09:23:31', 'King002', 2),
(13, 'J109-09810', '1', '1', '2020-04-29 16:47:53', '2020-06-09 12:10:07', '1', NULL, 'eeee', 0),
(14, 'J145-00600', '2', '1', '2020-04-29 16:48:02', NULL, '1', NULL, 'dddd', 0),
(15, 'MF140209', '1', '1', '2020-04-29 16:48:13', '2020-06-09 12:09:55', '1', NULL, 'cccc', 0),
(16, 'J100-21860', '1', '1', '2020-04-29 16:48:22', NULL, '1', NULL, 'bbbb', 0),
(17, 'JD105-39240', '1', '1', '2020-04-29 16:50:00', '2020-06-09 12:10:00', '1', NULL, 'aaaaa', 0),
(18, 'J115-16410', '2', '1', '2020-04-29 16:59:22', '2020-06-09 12:12:52', '1', NULL, 'ffff', 0),
(46, 'TEST02', '1', '1', '2020-06-01 11:24:44', '2020-06-09 11:51:58', '1', NULL, 'drawing_centereditdashboard.sql', 3);

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
(1, 'AAA', '213213', 10, '1', '2020-05-11 15:54:19', '2020-06-02 09:14:09', '1', NULL),
(6, '1300A126', 'WATER PUMP ASSY', 9, '1', '2020-04-29 16:49:34', '2020-06-02 14:48:45', '1', NULL),
(7, 'J107-11820', 'COVER, WATER PUMP', 9, '1', '2020-04-29 16:50:53', '2020-06-02 09:14:25', '1', NULL),
(8, 'J107-11820-RM', 'COVER, WATER PUMP', 10, '1', '2020-04-29 16:51:15', NULL, '1', NULL),
(9, 'MS471104 ', 'BUSHING, KNOCK', 9, '1', '2020-04-29 16:55:31', '2020-06-02 13:32:30', '1', NULL),
(10, 'J109-09810', 'GASKET', 9, '1', '2020-04-29 16:59:39', '2020-05-13 08:15:23', '1', NULL),
(11, 'J145-00600', 'PIPE', 9, '1', '2020-04-30 08:43:49', NULL, '1', NULL),
(12, 'MF140209', 'BOLT', 9, '1', '2020-04-30 08:44:14', NULL, '1', NULL),
(13, 'J100-21860', 'WATER PUMP', 9, '1', '2020-04-30 08:44:41', NULL, '1', NULL),
(14, 'J105-39240', 'CASE, WATER PUMP', 9, '1', '2020-04-30 08:45:17', NULL, '1', NULL),
(15, '3213', '213213', 9, '1', '2020-05-11 15:54:37', NULL, '1', NULL),
(17, 'BBB', 'Manage god', 9, '1', '2020-05-11 15:55:18', NULL, '1', NULL),
(18, 'CCC', 'Manage god', 9, '1', '2020-05-11 15:55:35', NULL, '1', NULL),
(26, 'DDD', 'GOD', 9, '1', '2020-05-13 14:02:23', '2020-06-02 08:37:54', '1', NULL),
(28, '5555', 'Manage god', 9, '1', '2020-05-13 14:11:57', NULL, '1', NULL),
(30, '1300A126', 'Manage god', 9, '1', '2020-05-13 14:58:38', NULL, '1', NULL),
(32, '412323', 'Manage god', 9, '1', '2020-05-13 14:59:48', NULL, '1', NULL),
(33, '1300A126-RM', 'Water pump ', 9, '1', '2020-05-13 15:00:28', NULL, '1', NULL);

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
(517, 143, 17, 18, 0, 'pcs', 0, '2020-06-09 13:46:47', 1, '0000-00-00 00:00:00');

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
('12', '11', '17', 'Add Sub-Part', 'part/add_sub', 'part/add_sub', '0', '0', NULL),
('13', '9', '19', 'Manage Part-Drawing', 'part_drawing/manage', 'part_drawing/manage', '1', '2', '20/3/2015 00:00:00'),
('14', '9', '19', 'Add Part-Drawing', 'part_drawing/add', 'part_drawing/add', '0', '2', '20/3/2015 00:00:00'),
('15', '2', '17', 'Rule', 'user/rule', 'user/rule', '1', '0', '20/3/2015 00:00:00'),
('16', '10', '16', 'Manage Dcn', 'dcn/manage', 'dcn/manage', '1', '1', NULL),
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
('28', '11', '17', '', 'bom/edit_part', 'bom/edit_part', '0', '0', NULL),
('29', '11', '17', '', 'bom/edit_bom', 'bom/edit_bom', '0', '0', NULL),
('3', '4', '16', 'Permission', 'permission/manage', 'permission/manage', '1', '1', '20/3/2015 00:00:00'),
('4', '4', '15', 'Permission Group', 'permissiongroup/manage', 'permissiongroup/manage', '1', '2', '20/3/2015 00:00:00'),
('5', '2', '17', 'Add User', 'user/add', 'user/add', '1', '1', '20/3/2015 00:00:00'),
('6', '2', '17', 'Manage User', 'user/manage', 'user/manage', '1', '2', '20/3/2015 00:00:00'),
('7', '5', '18', 'Manege Usergroup', 'usergroup/manage', 'usergroup/manage', '1', '1', '20/3/2015 00:00:00'),
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
(6, 'Drawing', ' fa-wpforms\n', '1', 6, '2015-03-20 00:00:00'),
(7, 'Part', 'fa-cogs', '1', 7, '2015-03-20 00:00:00'),
(8, 'Task', 'fa-tasks', '1', 8, '2020-02-26 09:54:40'),
(9, 'Part-Drawing', 'fa-tasks', '1', 8, '2020-02-26 09:54:40'),
(10, 'Dcn', 'fa-clipboard', '1', 9, '2020-05-11 00:00:00'),
(11, 'BOM', 'fa-sitemap ', '1', 10, '2020-05-13 00:00:00');

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
(4, 2, 'EDIT USER', 'user/edit', '1', '2015-03-03 00:00:00', '2020-04-10 10:31:08', '1', NULL),
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
(37, 10, 'ENABLE PART', 'part/enable', '1', '2020-06-02 13:32:02', '2020-06-09 12:18:23', '1', NULL),
(38, 10, 'EDIT PART', 'part/edit_part', '1', '2020-06-02 13:32:55', NULL, '1', NULL),
(39, 10, 'DELETE PART', 'part/deletepart', '1', '2020-06-02 13:33:26', NULL, '1', NULL),
(40, 13, 'MANAGE PART-DRAWING', 'part_drawing/manage', '1', '2020-06-02 13:44:40', '2020-06-09 13:28:13', '1', NULL),
(41, 13, 'DELETE PART-DRAWING', 'part_drawing/deletePartD', '1', '2020-06-02 13:48:20', NULL, '1', NULL),
(42, 13, 'MANAGE PART-DRAWING', 'part_drawing/manage', '1', '2020-06-02 13:48:51', NULL, '1', NULL),
(43, 11, 'MANAGE DCN', 'dcn/manage', '1', '2020-06-02 13:52:30', NULL, '1', NULL),
(44, 11, 'EDIT DCN', 'dcn/edit_dcn', '1', '2020-06-02 13:58:41', NULL, '1', NULL),
(45, 11, 'DELETE DCM', 'dcn/deletedcn', '1', '2020-06-02 14:06:58', NULL, '1', NULL),
(46, 11, 'ADD DCN', 'dcn/insert', '1', '2020-06-02 14:09:26', NULL, '1', NULL),
(47, 12, 'ADD BOM', 'bom/add', '1', '2020-06-02 14:16:17', NULL, '1', NULL),
(48, 13, 'MANAGE BOM', 'bom/manage', '1', '2020-06-02 14:16:44', NULL, '1', NULL);

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
(2, 'MANAGE USERS', '1', '2020-01-17 10:02:34', '1', NULL, NULL),
(3, 'MANAGE USER GROUPS', '1', '2015-03-03 00:00:00', '1', NULL, NULL),
(4, 'MANAGE PERMISSION', '1', '2015-03-25 00:00:00', '1', NULL, '2020-05-12 14:35:03'),
(5, 'MANAGE PERMISSION GROUPS', '1', '2015-03-25 00:00:00', '1', NULL, '2020-06-02 12:04:39'),
(9, 'MANAGE DRAWING', '1', '2020-06-02 13:02:02', '1', NULL, NULL),
(10, 'MANAGE PART', '1', '2020-06-02 13:02:10', '1', NULL, NULL),
(11, 'MANAGE DCN', '1', '2020-06-02 13:02:24', '1', NULL, NULL),
(12, 'MANAGE PART-DRAWING', '1', '2020-06-02 13:44:17', '1', NULL, NULL),
(13, 'MANAGE BOM', '1', '2020-06-02 13:02:46', '1', NULL, NULL);

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
(7, 3, 'theerasak', 'YWExMjM0NTY=', 'Theerasak', 'Samranklang	', 'male', 'theerasak@tbkk.co.th', '1', NULL, '2020-02-05 15:38:42', '2020-06-02 10:39:33', '1', NULL),
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
(753, 1, 1, '2020-06-02 14:09:57'),
(754, 1, 2, '2020-06-02 14:09:57'),
(755, 1, 3, '2020-06-02 14:09:57'),
(756, 1, 4, '2020-06-02 14:09:57'),
(757, 1, 5, '2020-06-02 14:09:57'),
(758, 1, 6, '2020-06-02 14:09:57'),
(759, 1, 7, '2020-06-02 14:09:57'),
(760, 1, 8, '2020-06-02 14:09:57'),
(761, 1, 9, '2020-06-02 14:09:57'),
(762, 1, 10, '2020-06-02 14:09:57'),
(763, 1, 11, '2020-06-02 14:09:57'),
(764, 1, 12, '2020-06-02 14:09:57'),
(765, 1, 13, '2020-06-02 14:09:57'),
(766, 1, 14, '2020-06-02 14:09:57'),
(767, 1, 15, '2020-06-02 14:09:57'),
(768, 1, 16, '2020-06-02 14:09:57'),
(769, 1, 17, '2020-06-02 14:09:57'),
(770, 1, 18, '2020-06-02 14:09:57'),
(771, 1, 19, '2020-06-02 14:09:57'),
(772, 1, 20, '2020-06-02 14:09:57'),
(773, 1, 21, '2020-06-02 14:09:57'),
(774, 1, 22, '2020-06-02 14:09:57'),
(775, 1, 23, '2020-06-02 14:09:57'),
(776, 1, 24, '2020-06-02 14:09:57'),
(777, 1, 28, '2020-06-02 14:09:57'),
(778, 1, 29, '2020-06-02 14:09:57'),
(779, 1, 31, '2020-06-02 14:09:57'),
(780, 1, 32, '2020-06-02 14:09:57'),
(781, 1, 33, '2020-06-02 14:09:57'),
(782, 1, 34, '2020-06-02 14:09:57'),
(783, 1, 35, '2020-06-02 14:09:57'),
(784, 1, 36, '2020-06-02 14:09:57'),
(785, 1, 37, '2020-06-02 14:09:57'),
(786, 1, 38, '2020-06-02 14:09:57'),
(787, 1, 39, '2020-06-02 14:09:57'),
(788, 1, 40, '2020-06-02 14:09:57'),
(789, 1, 41, '2020-06-02 14:09:57'),
(790, 1, 42, '2020-06-02 14:09:57'),
(791, 1, 43, '2020-06-02 14:09:57'),
(792, 1, 44, '2020-06-02 14:09:57'),
(793, 1, 45, '2020-06-02 14:09:57'),
(794, 1, 46, '2020-06-02 14:09:57');

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
(1, 'SUPER ADMIN', '1', '2020-01-18 08:34:36', '1', NULL, '2020-06-01 13:17:07'),
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
  `file_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`v_id`, `d_id`, `d_no`, `dcn_id`, `version`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`, `file_name`) VALUES
(12, 12, 'MSX3-4912', '1', 0, 0, '2020-05-12 12:09:14', '0000-00-00 00:00:00', '1', '2020-05-26 09:26:22', 'Taisoul'),
(13, 12, 'MSX3-4912', '1', 1, 1, '2020-05-12 12:09:39', '2020-06-09 11:51:02', '1', '2020-05-26 09:27:54', 'King002'),
(14, 12, 'MSX3-4912', '1', 2, 0, '2020-05-12 12:10:30', '2020-05-26 09:15:53', '1', '0000-00-00 00:00:00', 'Tainaja'),
(15, 12, 'MSX3-4912', '1', 3, 0, '2020-05-12 12:12:15', '2020-05-26 09:15:35', '1', '0000-00-00 00:00:00', 'drawing_center (4).sql'),
(16, 12, 'MSX3-4912', '1', 4, 0, '2020-05-26 09:37:32', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 'DyFkOBZVAAAkOm_.jpg'),
(19, 12, 'MSX3-4912', '1', 5, 0, '2020-05-27 13:28:40', '2020-06-01 09:11:49', '1', '0000-00-00 00:00:00', 'Test'),
(20, 12, 'MSX3-4912', '1', 6, 0, '2020-06-01 09:34:57', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 'aaaa'),
(50, 46, 'TEST', '2', 0, 0, '2020-06-01 11:24:57', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 'drawing_centereditdashboard.sql'),
(51, 46, 'TEST01', '1', 1, 0, '2020-06-01 11:25:12', '2020-06-09 12:10:24', '1', '0000-00-00 00:00:00', 'drawing_centereditdashboard.sql'),
(52, 12, 'MSX3-4912', '1', 1, 0, '2020-06-09 11:51:23', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', ''),
(53, 46, 'TEST02', '10', 2, 0, '2020-06-09 11:51:58', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 'drawing_centereditdashboard.sql');

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
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `dcn`
--
ALTER TABLE `dcn`
  MODIFY `dcn_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `drawing`
--
ALTER TABLE `drawing`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `part_drawing`
--
ALTER TABLE `part_drawing`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'part drawing', AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `sub_part`
--
ALTER TABLE `sub_part`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=518;
--
-- AUTO_INCREMENT for table `sys_permissions`
--
ALTER TABLE `sys_permissions`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `sys_permission_groups`
--
ALTER TABLE `sys_permission_groups`
  MODIFY `spg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
  MODIFY `sup_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=795;
--
-- AUTO_INCREMENT for table `sys_user_groups`
--
ALTER TABLE `sys_user_groups`
  MODIFY `sug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `version`
--
ALTER TABLE `version`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
