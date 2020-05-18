-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 18, 2020 at 02:27 AM
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
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, '897664-4910', 1, '2020-05-11 14:20:19', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(2, '3131323213', 1, '2020-05-11 14:21:24', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00');

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
(12, 'MSX3-4912', '1', '1', '2020-04-29 16:47:43', '2020-05-13 08:13:49', '1', NULL, 'DyFkOBZVAAAkOm_.jpg', 4),
(13, 'J109-09810', '1', '1', '2020-04-29 16:47:53', NULL, '1', NULL, 'eeee', 0),
(14, 'J145-00600', '2', '1', '2020-04-29 16:48:02', NULL, '1', NULL, 'dddd', 0),
(15, 'MF140209', '1', '1', '2020-04-29 16:48:13', '2020-05-13 08:13:51', '1', NULL, 'cccc', 0),
(16, 'J100-21860', '1', '1', '2020-04-29 16:48:22', NULL, '1', NULL, 'bbbb', 0),
(17, 'JD105-39240', '1', '1', '2020-04-29 16:50:00', NULL, '1', NULL, 'aaaaa', 0),
(18, 'J115-16410', '2', '1', '2020-04-29 16:59:22', NULL, '1', NULL, 'ffff', 0),
(27, '', '', '1', '2020-05-13 15:23:38', NULL, '1', NULL, '', 0),
(28, '', '', '1', '2020-05-13 15:23:54', NULL, '1', NULL, '', 0),
(29, '', '', '1', '2020-05-13 15:23:57', NULL, '1', NULL, '', 0);

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
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `p_id` int(11) NOT NULL,
  `p_no` varchar(24) DEFAULT NULL,
  `p_name` varchar(44) DEFAULT NULL,
  `d_id` int(11) NOT NULL,
  `p_lv` varchar(12) NOT NULL,
  `p_master` int(11) NOT NULL,
  `enable` varchar(1) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `delete_flag` varchar(1) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`p_id`, `p_no`, `p_name`, `d_id`, `p_lv`, `p_master`, `enable`, `date_created`, `date_updated`, `delete_flag`, `date_deleted`) VALUES
(1, 'AAA', '213213', 0, '2', 0, '1', '2020-05-11 15:54:19', NULL, '1', NULL),
(6, '1300A126', 'WATER PUMP ASSY', 0, '2', 0, '1', '2020-04-29 16:49:34', NULL, '1', NULL),
(7, 'J107-11820', 'COVER, WATER PUMP', 0, '2', 0, '1', '2020-04-29 16:50:53', NULL, '1', NULL),
(8, 'J107-11820-RM', 'COVER, WATER PUMP', 0, '3', 0, '1', '2020-04-29 16:51:15', NULL, '1', NULL),
(9, 'MS471104', 'BUSHING, KNOCK', 0, '2', 0, '1', '2020-04-29 16:55:31', NULL, '1', NULL),
(10, 'J109-09810', 'GASKET', 0, '2', 0, '1', '2020-04-29 16:59:39', '2020-05-13 08:15:23', '1', NULL),
(11, 'J145-00600', 'PIPE', 0, '2', 0, '1', '2020-04-30 08:43:49', NULL, '1', NULL),
(12, 'MF140209', 'BOLT', 0, '2', 0, '1', '2020-04-30 08:44:14', NULL, '1', NULL),
(13, 'J100-21860', 'WATER PUMP', 0, '2', 0, '1', '2020-04-30 08:44:41', NULL, '1', NULL),
(14, 'J105-39240', 'CASE, WATER PUMP', 0, '2', 0, '1', '2020-04-30 08:45:17', NULL, '1', NULL),
(15, '3213', '213213', 0, '2', 0, '1', '2020-05-11 15:54:37', NULL, '1', NULL),
(16, '3213', '213213', 0, '2', 0, '1', '2020-05-11 15:54:48', NULL, '1', NULL),
(17, 'BBB', 'Manage god', 0, '2', 0, '1', '2020-05-11 15:55:18', NULL, '1', NULL),
(18, 'CCC', 'Manage god', 0, '2', 0, '1', '2020-05-11 15:55:35', NULL, '1', NULL),
(26, 'DDD', 'GOD', 9, '2', 0, '1', '2020-05-13 14:02:23', NULL, '1', NULL),
(27, '1300A126', 'Manage god', 9, '1', 0, '1', '2020-05-13 14:11:37', NULL, '1', NULL),
(28, '5555', 'Manage god', 9, '2', 0, '1', '2020-05-13 14:11:57', NULL, '1', NULL),
(29, '1300A126', 'Manage god', 9, '2', 0, '1', '2020-05-13 14:15:05', NULL, '1', NULL),
(30, '1300A126', 'Manage god', 9, '3', 1, '1', '2020-05-13 14:58:38', NULL, '1', NULL),
(31, '412323', 'GOD', 9, '3', 0, '1', '2020-05-13 14:59:23', NULL, '1', NULL),
(32, '412323', 'Manage god', 9, '3', 0, '1', '2020-05-13 14:59:48', NULL, '1', NULL),
(33, '1300A126-RM', 'Water pump ', 9, '3', 6, '1', '2020-05-13 15:00:28', NULL, '1', NULL);

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
(1, 14, 9, '1', '2020-05-11 15:54:19', NULL, '1', NULL),
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
(148, 14, 9, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(149, 14, 10, '1', '2020-04-30 08:45:44', NULL, '1', NULL),
(150, 7, 10, NULL, NULL, NULL, NULL, NULL),
(151, 6, 10, '1', '2020-04-30 11:45:03', NULL, '1', NULL),
(152, 6, 12, '1', '2020-04-30 11:45:03', NULL, '1', NULL),
(153, 6, 13, '1', '2020-04-30 11:45:03', '2020-05-13 08:14:16', '1', NULL),
(154, 8, 10, '1', '2020-04-30 11:45:03', NULL, '1', NULL),
(155, 8, 12, '1', '2020-04-30 11:45:03', NULL, '1', NULL),
(156, 8, 13, '1', '2020-04-30 11:45:03', NULL, '1', NULL),
(157, 17, 1, '1', '2020-05-11 15:55:18', NULL, '1', NULL),
(158, 17, 2, '1', '2020-05-11 15:55:18', NULL, '1', NULL),
(159, 17, 10, '1', '2020-05-11 15:55:18', NULL, '1', NULL),
(160, 18, 1, '1', '2020-05-11 15:55:35', NULL, '1', NULL),
(161, 18, 2, '1', '2020-05-11 15:55:35', NULL, '1', NULL),
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
  `m_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_part`
--

INSERT INTO `sub_part` (`sub_id`, `m_id`, `s_id`) VALUES
(10, 1, 17),
(11, 17, 18),
(12, 17, 26);

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
('12', '7', '17', 'Add Sub-Part', 'part/add_sub', 'part/add_sub', '1', '2', NULL),
('13', '9', '19', 'Manage Part-Drawing', 'part_drawing/manage', 'part_drawing/manage', '1', '2', '20/3/2015 00:00:00'),
('14', '9', '19', 'Add Part-Drawing', 'part_drawing/add', 'part_drawing/add', '0', '2', '20/3/2015 00:00:00'),
('15', '2', '17', 'Rule', 'user/rule', 'user/rule', '1', '0', '20/3/2015 00:00:00'),
('16', '10', '16', 'Manage Dcn', 'dcn/manage', 'dcn/manage', '1', '1', NULL),
('17', '6', '19', 'Add Version', 'drawing/version_form', 'drawing/version_form', '0', '1', NULL),
('18', '11', '10', 'Add Bom', 'bom/add', 'bom/add', '1', '1', NULL),
('19', '11', '10', 'Manage Bom', 'bom/manage', 'bom/manage', '1', '2', NULL),
('2', '3', '1', 'Change Password', 'changepassword/account', 'changepassword/account', '1', '2', '20/3/2015 00:00:00'),
('3', '4', '16', 'Permission', 'permission/manage', 'permission/manage', '1', '1', '20/3/2015 00:00:00'),
('4', '4', '15', 'Permission Group', 'permissiongroup/manage', 'permissiongroup/manage', '1', '2', '20/3/2015 00:00:00'),
('5', '2', '17', 'Add User', 'user/add', 'user/add', '1', '1', '20/3/2015 00:00:00'),
('6', '2', '17', 'Manage User', 'user/manage', 'user/manage', '1', '2', '20/3/2015 00:00:00'),
('7', '5', '18', 'User Group', 'usergroup/manage', 'usergroup/manage', '1', '1', '20/3/2015 00:00:00'),
('8', '1', '19', 'Home', 'manage', 'manage', '1', '1', '20/3/2015 00:00:00'),
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
(11, 'BOM', NULL, '1', 10, '2020-05-13 00:00:00');

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
(6, 4, 'ADD PERMISSION', 'permission/add', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(7, 4, 'EDIT PERMISSION', 'permission/edit', '1', '2015-03-20 00:00:00', '2020-04-29 16:01:10', '1', NULL),
(8, 4, 'DELETE PERMISSION', 'permission/delete', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(9, 3, 'ADD USER GROUP', 'usergroup/add', '1', '2015-03-20 00:00:00', '2020-04-10 13:07:06', '1', NULL),
(10, 3, 'EDIT USER GROUP', 'usergroup/edit', '1', '2015-03-20 00:00:00', '2020-04-10 10:31:11', '1', NULL),
(11, 3, 'DELETE USER GROUP', 'usergroup/delete', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(12, 5, 'ADD PERMISSION GROUP', 'permissiongroup/add', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(13, 5, 'EDIT PERMISSION GROUP', 'permissiongroup/edit', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(14, 5, 'DELETE PERMISSION GROUP', 'permissiongroup/delete', '1', '2015-03-20 00:00:00', '2020-04-29 13:17:43', '1', NULL),
(15, 5, 'MANAGE PERMISSION GROUP', 'permissiongroup/manage', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(16, 4, 'MANAGE PERMISSION', 'permission/manage', '1', '2015-03-20 00:00:00', NULL, '1', NULL),
(17, 2, 'MANAGE USER', 'user/manage', '1', '2015-03-25 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(18, 3, 'MANAGE USER GROUP', 'usergroup/manage', '1', '2015-03-25 00:00:00', '2020-04-29 11:11:23', '1', NULL),
(19, 2, 'EDIT USER RULE', 'user/rule', '1', '2015-03-25 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(20, 2, 'ENABLE USER', 'user/enable', '1', '2017-02-01 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(21, 2, 'DISABLE USER', 'user/disable', '1', '2017-02-01 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(22, 2, 'CHECKALL ENABLE USER', 'user/checkall_enable', '1', '2017-02-01 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(23, 2, 'CHECKALL DISABLE USER', 'user/checkall_disable', '1', '2017-02-01 00:00:00', '2020-01-17 10:02:34', '1', NULL),
(24, 2, 'CHECKALL DELETE USER', 'user/checkall_delete', '1', '2017-02-01 00:00:00', '2020-01-17 10:02:34', '1', NULL);

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
(1, 'MANAGE PROFILE', '1', '2020-01-18 10:25:27', '1', '2020-01-17 16:06:55', '2020-04-29 11:49:09'),
(2, 'MANAGE USERS', '1', '2020-01-17 10:02:34', '1', NULL, NULL),
(3, 'MANAGE USER GROUPS', '1', '2015-03-03 00:00:00', '1', NULL, NULL),
(4, 'MANAGE PERMISSION', '1', '2015-03-25 00:00:00', '1', NULL, '2020-05-12 14:35:03'),
(5, 'MANAGE PERMISSION GROUPS', '1', '2015-03-25 00:00:00', '1', NULL, NULL),
(6, 'MANAGE BOX2', '1', '2020-01-15 14:10:29', '1', NULL, NULL);

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
(6, 3, 'wanwisa', 'YWExMjM0NTY=', 'Wanwisa', 'Punphongphaew', 'female', 'wanwisa_p@tbkk.co.th', '1', NULL, '2020-02-05 15:24:13', '2020-04-29 10:37:08', '1', NULL),
(7, 3, 'theerasak', 'YWExMjM0NTY=', 'Theerasak', 'Samranklang	', 'male', 'theerasak@tbkk.co.th', '1', NULL, '2020-02-05 15:38:42', '2020-02-05 15:38:42', '1', NULL),
(8, 3, 'pachara', 'YWExMjM0NTY=', 'Pachara', 'Manpian', 'male', 'pachara@tbkk.co.th', '1', NULL, '2020-02-05 15:39:50', '2020-02-05 15:39:50', '1', NULL),
(9, 4, 'Pitak1', 'YWExMjM0NTY=', 'Pitak', 'Puanmano', 'male', 'pitak@tbkk.co.th', '1', NULL, '2020-02-05 15:42:44', '2020-02-05 15:42:44', '1', NULL),
(10, 3, 'pittaya', 'YWExMjM0NTY=', 'Pittaya', 'Thammachoto', 'male', 'pittaya@tbkk.co.th', '1', NULL, '2020-02-05 15:43:20', '2020-02-05 15:43:20', '1', NULL),
(11, 3, 'ruangthong', 'YWExMjM0NTY=', 'Ruangthong', 'Thongyu', 'female', 'ruangthong@tbkk.co.th', '1', NULL, '2020-02-05 15:44:18', '2020-02-05 15:44:18', '1', NULL),
(12, 3, 'takashi', 'YWExMjM0NTY=', 'Takashi', 'Kageyama', 'male', 'kageyama@tbkk.co.th', '1', NULL, '2020-02-05 15:45:02', '2020-02-05 15:45:02', '0', '2020-05-12 10:37:54'),
(13, 3, 'okada1', 'YWExMjM0NTY=', 'Okada', 'Masayoshi', 'male', 'okada@tbkk.co.th', '1', NULL, '2020-02-05 15:46:07', '2020-02-05 15:46:07', '1', NULL),
(14, 2, 'chanin', 'Y2hhbmlu', 'chanin', 'chaisatain', 'male', 'Surin@gmail.comadmin', '1', NULL, '2020-02-07 14:31:00', '2020-02-07 14:31:00', '1', NULL),
(15, 2, 'mikmik', 'bWlrbWlr', 'kookmik', 'Surin', 'male', 'Surin@gmail.com', '1', NULL, '2020-02-07 14:39:40', '2020-02-07 14:39:40', '0', '2020-05-12 10:37:14'),
(16, 2, 'test01', 'dGVzdDAx', 'ronaldo', 'inw', 'male', 'Surin@gmail.com', '1', NULL, '2020-03-03 10:26:09', '2020-04-09 16:52:27', '0', '2020-04-29 10:38:35'),
(18, 2, 'hahaha', 'aGFoYWhhaGFoYQ==', 'hatari', 'adfasdnf', 'male', 'Surssssin@gmail.com', '1', NULL, '2020-03-03 10:28:13', '2020-04-08 11:32:35', '0', '2020-05-12 10:37:23'),
(19, 2, 'sfasdfasdf', 'YXNkZmFzZGY=', 'asdfasdf', 'adfasdf', 'female', 'Surin@gmail.comadmin', '1', NULL, '2020-03-03 10:48:27', '2020-03-03 10:48:27', '1', NULL),
(33, 4, 'TEST0863', 'TEST0863', 'TEST0863', 'TEST0863', 'Male', 'casterman@hotmail.com', '1', NULL, '2020-04-29 13:47:53', '2020-04-29 13:47:53', '1', NULL);

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
(1050, 1, 1, '2020-01-18 08:34:36'),
(1051, 1, 2, '2020-01-18 08:34:36'),
(1052, 1, 3, '2020-01-18 08:34:36'),
(1053, 1, 4, '2020-01-18 08:34:36'),
(1054, 1, 5, '2020-01-18 08:34:36'),
(1055, 1, 6, '2020-01-18 08:34:36'),
(1058, 4, 1, '2020-01-18 08:36:08'),
(1066, 2, 2, '2020-01-18 08:42:35');

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
(96, 14, 4, '2020-04-29 16:10:10');

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
(1, 'SUPER ADMIN', '1', '2020-01-18 08:34:36', '1', NULL, '2020-04-29 10:54:42'),
(2, 'ADMIN', '1', '2020-01-18 08:42:35', '1', NULL, NULL),
(3, 'MEMBER', '1', '2020-01-17 15:59:56', '1', NULL, NULL),
(4, 'MEMBER ADMIN', '1', '2020-01-18 08:36:08', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `v_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `version` int(50) NOT NULL,
  `enable` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `status` varchar(25) NOT NULL,
  `file_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`v_id`, `d_id`, `version`, `enable`, `date_created`, `status`, `file_name`) VALUES
(12, 12, 0, 1, '2020-05-12 12:09:14', 'disable', 'Taisoul'),
(13, 12, 1, 1, '2020-05-12 12:09:39', 'disable', 'King002'),
(14, 12, 2, 1, '2020-05-12 12:10:30', 'disable', 'Tainaja'),
(15, 12, 3, 1, '2020-05-12 12:12:15', 'disable', 'drawing_center (4).sql');

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
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dcn`
--
ALTER TABLE `dcn`
  MODIFY `dcn_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `drawing`
--
ALTER TABLE `drawing`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
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
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `su_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `version`
--
ALTER TABLE `version`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
