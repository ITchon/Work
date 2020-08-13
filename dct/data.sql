/*
 Navicat Premium Data Transfer

 Source Server         : SQL server (192.168.161.101)
 Source Server Type    : SQL Server
 Source Server Version : 14002027
 Source Host           : 192.168.161.101:1433
 Source Catalog        : webpost
 Source Schema         : dbo

 Target Server Type    : SQL Server
 Target Server Version : 14002027
 File Encoding         : 65001

 Date: 03/04/2020 11:48:22
*/


-- ----------------------------
-- Table structure for EMP_USER2
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[EMP_USER2]') AND type IN ('U'))
	DROP TABLE [dbo].[EMP_USER2]
GO

CREATE TABLE [dbo].[EMP_USER2] (
  [ID] int  IDENTITY(1,1) NOT NULL,
  [USER_ID] nvarchar(15) COLLATE Thai_CI_AS  NOT NULL,
  [PASS] nvarchar(15) COLLATE Thai_CI_AS  NULL,
  [EMAIL] nvarchar(40) COLLATE Thai_CI_AS  NULL,
  [SUP_CODE] nvarchar(6) COLLATE Thai_CI_AS  NULL,
  [AUTHORIZATION	] nvarchar(15) COLLATE Thai_CI_AS  NULL,
  [NAME] nvarchar(60) COLLATE Thai_CI_AS  NULL
)
GO

ALTER TABLE [dbo].[EMP_USER2] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Table structure for events
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[events]') AND type IN ('U'))
	DROP TABLE [dbo].[events]
GO

CREATE TABLE [dbo].[events] (
  [id] int  IDENTITY(1,1) NOT NULL,
  [title] nvarchar(255) COLLATE Thai_CI_AS  NULL,
  [start_event] datetime  NULL,
  [end_event] datetime  NULL
)
GO

ALTER TABLE [dbo].[events] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of events
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[events] ON
GO

INSERT INTO [dbo].[events] ([id], [title], [start_event], [end_event]) VALUES (N'1', N'Meeting with Mike', N'2019-11-08 12:00:00.000', N'2019-11-08 13:00:00.000'), (N'2', N'Meeting with Mike', N'2019-11-11 15:30:00.000', N'2019-11-11 16:30:00.000'), (N'3', N'Meeting with Mike', N'2020-01-08 12:00:00.000', N'2020-01-08 13:00:00.000'), (N'4', N'Meeting with Mike', N'2020-01-11 15:30:00.000', N'2020-01-11 16:30:00.000')
GO

SET IDENTITY_INSERT [dbo].[events] OFF
GO

COMMIT
GO


-- ----------------------------
-- Table structure for INFORMATION
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[INFORMATION]') AND type IN ('U'))
	DROP TABLE [dbo].[INFORMATION]
GO

CREATE TABLE [dbo].[INFORMATION] (
  [ID] int  IDENTITY(1,1) NOT NULL,
  [USER_ID] nvarchar(15) COLLATE Thai_CI_AS  NULL,
  [TOPIC] nvarchar(30) COLLATE Thai_CI_AS  NULL,
  [DETAIL] nvarchar(200) COLLATE Thai_CI_AS  NULL,
  [UPLOAD] nvarchar(100) COLLATE Thai_CI_AS  NULL,
  [STATUS] nvarchar(3) COLLATE Thai_CI_AS  NULL,
  [START_DATE] datetime  NULL,
  [END_DATE] datetime  NULL,
  [CREATE_DATE] datetime  NULL,
  [CREATE_BY] nvarchar(15) COLLATE Thai_CI_AS  NULL
)
GO

ALTER TABLE [dbo].[INFORMATION] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of INFORMATION
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[INFORMATION] ON
GO

INSERT INTO [dbo].[INFORMATION] ([ID], [USER_ID], [TOPIC], [DETAIL], [UPLOAD], [STATUS], [START_DATE], [END_DATE], [CREATE_DATE], [CREATE_BY]) VALUES (N'1', N'01802', N'OORTEST', N'เทสอะไรนะ', N'..\asset\img\8077136002.jpg', N'1', N'2019-12-02 09:33:00.000', N'2019-12-07 09:33:04.000', N'2019-12-02 09:33:10.000', N'01802'), (N'2', N'01802', N'OORTEST', N'', N'..\asset\img\8898319262.jpg', N'1', N'2019-12-02 09:33:57.000', N'2019-12-07 09:34:01.000', N'2019-12-02 09:34:08.000', N'01802'), (N'3', N'01802', N'55555', N'', N'..\asset\img\01simple.xlsx', N'1', N'2019-12-01 11:21:55.000', N'2019-12-02 11:22:01.000', N'2019-12-02 11:39:02.000', N'01802'), (N'17', N'02131', N'21321321', N'21321032194', NULL, NULL, NULL, NULL, NULL, NULL)
GO

SET IDENTITY_INSERT [dbo].[INFORMATION] OFF
GO

COMMIT
GO


-- ----------------------------
-- Table structure for SUP_CTRL
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[SUP_CTRL]') AND type IN ('U'))
	DROP TABLE [dbo].[SUP_CTRL]
GO

CREATE TABLE [dbo].[SUP_CTRL] (
  [ID] int  IDENTITY(1,1) NOT NULL,
  [SUP_CODE] nvarchar(6) COLLATE Thai_CI_AS  NOT NULL,
  [SUP_NAME] nvarchar(40) COLLATE Thai_CI_AS  NULL,
  [SUP_ANAME] nvarchar(10) COLLATE Thai_CI_AS  NULL,
  [ADDRESS_1] nvarchar(60) COLLATE Thai_CI_AS  NULL,
  [ADDRESS_2] nvarchar(60) COLLATE Thai_CI_AS  NULL,
  [ZIP_CODE] nvarchar(10) COLLATE Thai_CI_AS  NULL,
  [TEL] nvarchar(15) COLLATE Thai_CI_AS  NULL,
  [FAX] nvarchar(15) COLLATE Thai_CI_AS  NULL,
  [EMAIL] nvarchar(20) COLLATE Thai_CI_AS  NULL,
  [PU_OWN] nvarchar(7) COLLATE Thai_CI_AS  NULL,
  [PN_OWN] nvarchar(7) COLLATE Thai_CI_AS  NULL
)
GO

ALTER TABLE [dbo].[SUP_CTRL] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Table structure for sys_menu_groups
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[sys_menu_groups]') AND type IN ('U'))
	DROP TABLE [dbo].[sys_menu_groups]
GO

CREATE TABLE [dbo].[sys_menu_groups] (
  [mg_id] int  IDENTITY(1,1) NOT NULL,
  [name] varchar(50) COLLATE Thai_CI_AS  NULL,
  [icon_menu] varchar(50) COLLATE Thai_CI_AS  NULL,
  [enable] varchar(1) COLLATE Thai_CI_AS  NULL,
  [order_no] tinyint  NULL,
  [date_created] datetime  NULL
)
GO

ALTER TABLE [dbo].[sys_menu_groups] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of sys_menu_groups
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[sys_menu_groups] ON
GO

INSERT INTO [dbo].[sys_menu_groups] ([mg_id], [name], [icon_menu], [enable], [order_no], [date_created]) VALUES (N'1', N'Main', N'fa-home', N'1', N'1', N'2015-03-03 00:00:00.000'), (N'2', N'Users', N'fa-user', N'1', N'3', N'2015-03-03 00:00:00.000'), (N'3', N'Settings', N'fa-cog', N'1', N'2', N'2015-03-03 00:00:00.000'), (N'4', N'Permissions', N'fa-unlock-alt', N'1', N'5', N'2015-03-20 00:00:00.000'), (N'5', N'Groups', N'fa-group', N'1', N'4', N'2015-03-20 00:00:00.000')
GO

SET IDENTITY_INSERT [dbo].[sys_menu_groups] OFF
GO

COMMIT
GO


-- ----------------------------
-- Table structure for sys_menus
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[sys_menus]') AND type IN ('U'))
	DROP TABLE [dbo].[sys_menus]
GO

CREATE TABLE [dbo].[sys_menus] (
  [m_id] int  IDENTITY(1,1) NOT NULL,
  [mg_id] int  NULL,
  [sp_id] int  NULL,
  [name] varchar(50) COLLATE Thai_CI_AS  NULL,
  [method] varchar(40) COLLATE Thai_CI_AS  NULL,
  [link] varchar(40) COLLATE Thai_CI_AS  NULL,
  [enable] varchar(1) COLLATE Thai_CI_AS  NULL,
  [order_no] tinyint  NULL,
  [date_created] datetime  NULL
)
GO

ALTER TABLE [dbo].[sys_menus] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of sys_menus
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[sys_menus] ON
GO

INSERT INTO [dbo].[sys_menus] ([m_id], [mg_id], [sp_id], [name], [method], [link], [enable], [order_no], [date_created]) VALUES (N'1', N'3', N'1', N'Edit Profile', N'editprofile/account', N'editprofile/account', N'1', N'1', N'2015-03-20 00:00:00.000'), (N'2', N'3', N'1', N'Change Password', N'changepassword/account', N'changepassword/account', N'1', N'2', N'2015-03-20 00:00:00.000'), (N'3', N'4', N'16', N'Permission', N'permission/manage', N'permission/manage', N'1', N'1', N'2015-03-20 00:00:00.000'), (N'4', N'4', N'15', N'Permission Group', N'permissiongroup/manage', N'permissiongroup/manage', N'1', N'2', N'2015-03-20 00:00:00.000'), (N'5', N'2', N'17', N'Add User', N'user/add', N'user/add', N'1', N'1', N'2015-03-20 00:00:00.000'), (N'6', N'2', N'17', N'Manage User', N'user/manage', N'user/manage', N'1', N'2', N'2015-03-20 00:00:00.000'), (N'7', N'5', N'18', N'User Group', N'usergroup/manage', N'usergroup/manage', N'1', N'1', N'2015-03-20 00:00:00.000'), (N'8', N'1', N'19', N'Home', N'manage/home', N'manage/', N'1', N'1', N'2015-03-20 00:00:00.000')
GO

SET IDENTITY_INSERT [dbo].[sys_menus] OFF
GO

COMMIT
GO


-- ----------------------------
-- Table structure for sys_permission_groups
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[sys_permission_groups]') AND type IN ('U'))
	DROP TABLE [dbo].[sys_permission_groups]
GO

CREATE TABLE [dbo].[sys_permission_groups] (
  [spg_id] int  IDENTITY(1,1) NOT NULL,
  [name] varchar(50) COLLATE Thai_CI_AS  NULL,
  [enable] varchar(1) COLLATE Thai_CI_AS  NULL,
  [date_created] datetime  NULL,
  [delete_flag] varchar(1) COLLATE Thai_CI_AS  NULL,
  [date_deleted] datetime  NULL
)
GO

ALTER TABLE [dbo].[sys_permission_groups] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of sys_permission_groups
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[sys_permission_groups] ON
GO

INSERT INTO [dbo].[sys_permission_groups] ([spg_id], [name], [enable], [date_created], [delete_flag], [date_deleted]) VALUES (N'1', N'MANAGE PROFILE', N'1', N'2020-01-18 10:25:27.313', N'1', N'2020-01-17 16:06:54.883'), (N'2', N'MANAGE USERS', N'1', N'2020-01-17 10:02:34.120', N'1', NULL), (N'3', N'MANAGE USER GROUPS', N'1', N'2015-03-03 00:00:00.000', N'1', NULL), (N'4', N'MANAGE PERMISSION', N'1', N'2015-03-25 00:00:00.000', N'1', NULL), (N'5', N'MANAGE PERMISSION GROUPS', N'1', N'2015-03-25 00:00:00.000', N'1', NULL), (N'6', N'MANAGE BOX2', N'1', N'2020-01-15 14:10:28.817', N'1', NULL)
GO

SET IDENTITY_INSERT [dbo].[sys_permission_groups] OFF
GO

COMMIT
GO


-- ----------------------------
-- Table structure for sys_permissions
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[sys_permissions]') AND type IN ('U'))
	DROP TABLE [dbo].[sys_permissions]
GO

CREATE TABLE [dbo].[sys_permissions] (
  [sp_id] int  IDENTITY(1,1) NOT NULL,
  [spg_id] int  NULL,
  [name] varchar(50) COLLATE Thai_CI_AS  NULL,
  [controller] varchar(30) COLLATE Thai_CI_AS  NULL,
  [enable] varchar(1) COLLATE Thai_CI_AS  NULL,
  [date_created] datetime  NULL,
  [date_updated] datetime  NULL,
  [delete_flag] varchar(1) COLLATE Thai_CI_AS  NULL,
  [date_deleted] datetime  NULL
)
GO

ALTER TABLE [dbo].[sys_permissions] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of sys_permissions
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[sys_permissions] ON
GO

INSERT INTO [dbo].[sys_permissions] ([sp_id], [spg_id], [name], [controller], [enable], [date_created], [date_updated], [delete_flag], [date_deleted]) VALUES (N'1', N'1', N'EDIT PROFILE', N'editprofile/account', N'1', N'2015-03-03 00:00:00.000', N'2020-01-18 10:25:27.330', N'1', N'2020-01-17 16:06:54.883'), (N'2', N'1', N'CHANGE PASSWORD PROFILE', N'changepassword/account', N'1', N'2015-03-03 00:00:00.000', N'2020-01-18 10:25:27.330', N'1', N'2020-01-17 16:06:54.883'), (N'3', N'2', N'ADD USER', N'user/add', N'1', N'2015-03-03 00:00:00.000', N'2020-01-17 10:02:34.137', N'1', N'2020-01-17 09:28:06.447'), (N'4', N'2', N'EDIT USER', N'user/edit', N'1', N'2015-03-03 00:00:00.000', N'2020-01-17 10:02:34.137', N'1', NULL), (N'5', N'2', N'DELETE USER', N'user/delete', N'1', N'2015-03-03 00:00:00.000', N'2020-01-17 10:02:34.137', N'1', NULL), (N'6', N'4', N'ADD PERMISSION', N'permission/add', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'7', N'4', N'EDIT PERMISSION', N'permission/edit', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'8', N'4', N'DELETE PERMISSION', N'permission/delete', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'9', N'3', N'ADD USER GROUP', N'usergroup/add', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'10', N'3', N'EDIT USER GROUP', N'usergroup/edit', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'11', N'3', N'DELETE USER GROUP', N'usergroup/delete', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'12', N'5', N'ADD PERMISSION GROUP', N'permissiongroup/add', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'13', N'5', N'EDIT PERMISSION GROUP', N'permissiongroup/edit', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'14', N'5', N'DELETE PERMISSION GROUP', N'permissiongroup/delete', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'15', N'5', N'MANAGE PERMISSION GROUP', N'permissiongroup/manage', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'16', N'4', N'MANAGE PERMISSION', N'permission/manage', N'1', N'2015-03-20 00:00:00.000', NULL, N'1', NULL), (N'17', N'2', N'MANAGE USER', N'user/manage', N'1', N'2015-03-25 00:00:00.000', N'2020-01-17 10:02:34.137', N'1', NULL), (N'18', N'3', N'MANAGE USER GROUP', N'usergroup/manage', N'1', N'2015-03-25 00:00:00.000', NULL, N'1', NULL), (N'19', N'2', N'EDIT USER RULE', N'user/rule', N'1', N'2015-03-25 00:00:00.000', N'2020-01-17 10:02:34.137', N'1', NULL), (N'20', N'2', N'ENABLE USER', N'user/enable', N'1', N'2017-02-01 00:00:00.000', N'2020-01-17 10:02:34.137', N'1', NULL), (N'21', N'2', N'DISABLE USER', N'user/disable', N'1', N'2017-02-01 00:00:00.000', N'2020-01-17 10:02:34.137', N'1', NULL), (N'22', N'2', N'CHECKALL ENABLE USER', N'user/checkall_enable', N'1', N'2017-02-01 00:00:00.000', N'2020-01-17 10:02:34.137', N'1', NULL), (N'23', N'2', N'CHECKALL DISABLE USER', N'user/checkall_disable', N'1', N'2017-02-01 00:00:00.000', N'2020-01-17 10:02:34.137', N'1', NULL), (N'24', N'2', N'CHECKALL DELETE USER', N'user/checkall_delete', N'1', N'2017-02-01 00:00:00.000', N'2020-01-17 10:02:34.137', N'1', NULL)
GO

SET IDENTITY_INSERT [dbo].[sys_permissions] OFF
GO

COMMIT
GO


-- ----------------------------
-- Table structure for sys_user_groups
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[sys_user_groups]') AND type IN ('U'))
	DROP TABLE [dbo].[sys_user_groups]
GO

CREATE TABLE [dbo].[sys_user_groups] (
  [sug_id] int  IDENTITY(1,1) NOT NULL,
  [name] varchar(50) COLLATE Thai_CI_AS  NULL,
  [enable] varchar(1) COLLATE Thai_CI_AS  NULL,
  [date_created] datetime  NULL,
  [delete_flag] varchar(1) COLLATE Thai_CI_AS DEFAULT ((1)) NULL,
  [date_deleted] datetime  NULL
)
GO

ALTER TABLE [dbo].[sys_user_groups] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of sys_user_groups
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[sys_user_groups] ON
GO

INSERT INTO [dbo].[sys_user_groups] ([sug_id], [name], [enable], [date_created], [delete_flag], [date_deleted]) VALUES (N'1', N'SUPER ADMIN', N'1', N'2020-01-18 08:34:36.373', N'1', NULL), (N'2', N'ADMIN', N'1', N'2020-01-18 08:42:35.147', N'1', NULL), (N'3', N'MEMBER', N'1', N'2020-01-17 15:59:55.943', N'1', NULL), (N'4', N'MEMBER ADMIN', N'1', N'2020-01-18 08:36:07.797', N'1', N'2020-01-17 10:23:07.400'), (N'9', N'sadasd', N'1', N'2020-01-17 14:00:38.530', N'1', NULL)
GO

SET IDENTITY_INSERT [dbo].[sys_user_groups] OFF
GO

COMMIT
GO


-- ----------------------------
-- Table structure for sys_users
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[sys_users]') AND type IN ('U'))
	DROP TABLE [dbo].[sys_users]
GO

CREATE TABLE [dbo].[sys_users] (
  [su_id] int  IDENTITY(1,1) NOT NULL,
  [sug_id] int  NULL,
  [username] varchar(50) COLLATE Thai_CI_AS  NULL,
  [password] varchar(20) COLLATE Thai_CI_AS  NULL,
  [firstname] varchar(50) COLLATE Thai_CI_AS  NULL,
  [lastname] varchar(50) COLLATE Thai_CI_AS  NULL,
  [gender] varchar(10) COLLATE Thai_CI_AS  NULL,
  [email] varchar(50) COLLATE Thai_CI_AS  NULL,
  [enable] varchar(1) COLLATE Thai_CI_AS  NULL,
  [last_access] datetime  NULL,
  [date_created] datetime  NULL,
  [date_updated] datetime  NULL,
  [delete_flag] varchar(1) COLLATE Thai_CI_AS  NULL,
  [date_deleted] datetime  NULL
)
GO

ALTER TABLE [dbo].[sys_users] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of sys_users
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[sys_users] ON
GO

INSERT INTO [dbo].[sys_users] ([su_id], [sug_id], [username], [password], [firstname], [lastname], [gender], [email], [enable], [last_access], [date_created], [date_updated], [delete_flag], [date_deleted]) VALUES (N'1', N'1', N'sadmin', N'dGVhbWludw==', N'Wisitzaz', N'Thammametha', N'female', N'wisit_t@tbkk.co.th', N'1', N'2019-01-23 09:16:00.000', N'2019-01-23 09:16:00.000', N'2019-12-26 12:10:00.000', N'1', NULL), (N'4', N'1', N'golf', N'dGVhbWludw==', N'oor', N'rrr', N'male', N'oor@gmail.com', N'1', NULL, N'2019-12-19 11:15:00.000', N'2019-12-26 12:10:00.000', N'1', NULL), (N'6', N'2', N'oorza11111', N'MTIzNDU2', N'oor', N'xcvxcv', N'male', N'oor@gmail.com', N'1', NULL, N'2019-12-19 16:01:00.000', N'2019-12-26 12:08:00.000', N'1', NULL), (N'7', N'2', N'Jiew-Lek', N'dGVhbWludw==', N'Jiew', N'Lek', N'male', N'Jiew-Lek@gmail.com', N'1', NULL, N'2019-12-23 13:36:00.000', N'2019-12-23 13:36:00.000', N'1', NULL), (N'8', N'2', N'admin', N'MTEyMjMz', N'admin', N'admin', N'male', N'admin@gmail.com', N'1', NULL, N'2019-12-27 09:51:00.000', N'2019-12-27 09:51:00.000', N'1', NULL), (N'9', N'3', N'member', N'MTEyMjMz', N'member', N'member', N'male', N'member@gmail.com', N'1', NULL, N'2019-12-27 09:52:00.000', N'2019-12-27 09:52:00.000', N'1', NULL), (N'10', N'4', N'memberadmin', N'MTEyMjMz', N'member', N'admin', N'male', N'memberadmin@gmail.com', N'1', NULL, N'2019-12-27 09:52:00.000', N'2019-12-27 09:52:00.000', N'1', NULL), (N'11', N'3', N'Anada.03', N'MTEyMjMz', N'Anada', N'Singhapat', N'female', N'xajQEF@mailgator.org', N'1', NULL, N'2019-12-27 11:20:00.000', N'2019-12-27 11:20:00.000', N'1', NULL), (N'12', N'3', N'Nirawit.999', N'MTEyMjMz', N'Nirawit', N'Kaewmanee', N'male', N'DAxPHx@mailgator.org', N'1', NULL, N'2019-12-27 11:26:00.000', N'2019-12-27 11:26:00.000', N'1', NULL), (N'13', N'3', N'Yuvaves.555', N'MTEyMjMz', N'Norraworn', N'Yuvaves', N'male', N'aHMNTK@mailgator.org', N'1', NULL, N'2019-12-27 11:26:00.000', N'2019-12-27 11:26:00.000', N'1', NULL), (N'14', N'3', N'Surin', N'MTEyMjMz', N'Surin', N'Kaouthai', N'male', N'TmdBmr@mailgator.org', N'1', NULL, N'2019-12-27 11:27:00.000', N'2019-12-27 11:27:00.000', N'1', NULL), (N'15', N'3', N'Nattaworn', N'MTEyMjMz', N'Nattaworn', N'Lekcharuthas', N'male', N'SMDqBI@mailgator.org', N'0', NULL, N'2019-12-27 11:28:00.000', N'2020-01-14 10:12:00.000', N'1', NULL), (N'16', N'3', N'Kanamaru', N'4LmF4LmFLy8tLQ==', N'Kanamaru', N'Kiyokore', N'male', N'Kiyokore@gmail.com', N'1', NULL, N'2019-12-27 11:29:00.000', N'2019-12-27 11:29:00.000', N'1', NULL), (N'17', N'3', N'Willapana888', N'MTEyMjMz', N'Willapan', N'Willapan', N'male', N'Willapan888@gmail.com', N'1', NULL, N'2019-12-27 14:07:00.000', N'2019-12-27 14:07:00.000', N'1', NULL), (N'18', N'2', N'Pumpihon', N'MTEyMjMz', N'Thanwa', N'Pumpihon', N'male', N'Pumpihon@gmail.com', N'1', NULL, N'2019-12-27 14:08:00.000', N'2020-01-13 14:21:00.000', N'1', NULL), (N'19', N'3', N'Pichit999', N'MTEyMjMz', N'Thampon', N'Pichit', N'male', N'Pichit@gmail.com', N'1', NULL, N'2019-12-27 14:08:00.000', N'2019-12-27 14:08:00.000', N'1', NULL), (N'20', N'4', N'memberadmin1', N'bWVtYmVyYWRtaW4x', N'memberadmin', N'memberadmin', N'male', N'memberadmin@gmail.com', N'1', NULL, N'2020-01-17 16:02:05.710', N'2020-01-17 16:02:05.710', N'1', NULL), (N'21', N'4', N'memberadmin2', N'bWVtYmVyYWRtaW4y', N'memberadmin', N'memberadmin', N'male', N'memberadmin@gmail.com', N'1', NULL, N'2020-01-17 16:03:44.150', N'2020-01-17 16:03:44.150', N'1', NULL), (N'22', N'2', N'minmin', N'bWlubWlu', N'minmin', N'minmin', N'male', N'Surin@gmail.comadmin', N'1', NULL, N'2020-01-18 08:41:33.180', N'2020-01-18 08:41:33.180', N'1', NULL)
GO

SET IDENTITY_INSERT [dbo].[sys_users] OFF
GO

COMMIT
GO


-- ----------------------------
-- Table structure for sys_users_groups_permissions
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[sys_users_groups_permissions]') AND type IN ('U'))
	DROP TABLE [dbo].[sys_users_groups_permissions]
GO

CREATE TABLE [dbo].[sys_users_groups_permissions] (
  [sugp_id] int  IDENTITY(1,1) NOT NULL,
  [sug_id] int  NULL,
  [spg_id] int  NULL,
  [date_created] datetime  NULL
)
GO

ALTER TABLE [dbo].[sys_users_groups_permissions] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of sys_users_groups_permissions
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[sys_users_groups_permissions] ON
GO

INSERT INTO [dbo].[sys_users_groups_permissions] ([sugp_id], [sug_id], [spg_id], [date_created]) VALUES (N'0', NULL, NULL, N'1900-01-01 00:00:00.000'), (N'1019', N'3', N'1', N'2020-01-17 15:59:55.960'), (N'1050', N'1', N'1', N'2020-01-18 08:34:36.403'), (N'1051', N'1', N'2', N'2020-01-18 08:34:36.403'), (N'1052', N'1', N'3', N'2020-01-18 08:34:36.420'), (N'1053', N'1', N'4', N'2020-01-18 08:34:36.420'), (N'1054', N'1', N'5', N'2020-01-18 08:34:36.437'), (N'1055', N'1', N'6', N'2020-01-18 08:34:36.437'), (N'1058', N'4', N'1', N'2020-01-18 08:36:07.827'), (N'1066', N'2', N'2', N'2020-01-18 08:42:35.147')
GO

SET IDENTITY_INSERT [dbo].[sys_users_groups_permissions] OFF
GO

COMMIT
GO


-- ----------------------------
-- Table structure for sys_users_permissions
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[sys_users_permissions]') AND type IN ('U'))
	DROP TABLE [dbo].[sys_users_permissions]
GO

CREATE TABLE [dbo].[sys_users_permissions] (
  [sup_id] bigint  IDENTITY(1,1) NOT NULL,
  [su_id] int  NULL,
  [sp_id] int  NULL,
  [date_created] datetime  NULL
)
GO

ALTER TABLE [dbo].[sys_users_permissions] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of sys_users_permissions
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[sys_users_permissions] ON
GO

INSERT INTO [dbo].[sys_users_permissions] ([sup_id], [su_id], [sp_id], [date_created]) VALUES (N'26', N'9', N'1', N'2020-01-17 15:59:56.003'), (N'27', N'9', N'2', N'2020-01-17 15:59:56.003'), (N'28', N'11', N'1', N'2020-01-17 15:59:56.003'), (N'29', N'11', N'2', N'2020-01-17 15:59:56.003'), (N'30', N'12', N'1', N'2020-01-17 15:59:56.003'), (N'31', N'12', N'2', N'2020-01-17 15:59:56.003'), (N'32', N'13', N'1', N'2020-01-17 15:59:56.003'), (N'33', N'13', N'2', N'2020-01-17 15:59:56.003'), (N'34', N'14', N'1', N'2020-01-17 15:59:56.003'), (N'35', N'14', N'2', N'2020-01-17 15:59:56.003'), (N'36', N'15', N'1', N'2020-01-17 15:59:56.003'), (N'37', N'15', N'2', N'2020-01-17 15:59:56.003'), (N'38', N'16', N'1', N'2020-01-17 15:59:56.003'), (N'39', N'16', N'2', N'2020-01-17 15:59:56.003'), (N'40', N'17', N'1', N'2020-01-17 15:59:56.003'), (N'41', N'17', N'2', N'2020-01-17 15:59:56.003'), (N'42', N'19', N'1', N'2020-01-17 15:59:56.003'), (N'43', N'19', N'2', N'2020-01-17 15:59:56.003'), (N'376', N'1', NULL, N'2020-01-18 08:34:36.497'), (N'377', N'1', N'1', N'2020-01-18 08:34:36.497'), (N'378', N'1', N'2', N'2020-01-18 08:34:36.497'), (N'379', N'1', N'3', N'2020-01-18 08:34:36.497'), (N'380', N'1', N'4', N'2020-01-18 08:34:36.497'), (N'381', N'1', N'5', N'2020-01-18 08:34:36.497'), (N'382', N'1', N'6', N'2020-01-18 08:34:36.497'), (N'383', N'1', N'7', N'2020-01-18 08:34:36.497'), (N'384', N'1', N'8', N'2020-01-18 08:34:36.497'), (N'385', N'1', N'9', N'2020-01-18 08:34:36.497'), (N'386', N'1', N'10', N'2020-01-18 08:34:36.497'), (N'387', N'1', N'11', N'2020-01-18 08:34:36.497'), (N'388', N'1', N'12', N'2020-01-18 08:34:36.497'), (N'389', N'1', N'13', N'2020-01-18 08:34:36.497'), (N'390', N'1', N'14', N'2020-01-18 08:34:36.497'), (N'391', N'1', N'15', N'2020-01-18 08:34:36.497'), (N'392', N'1', N'16', N'2020-01-18 08:34:36.497'), (N'393', N'1', N'17', N'2020-01-18 08:34:36.497'), (N'394', N'1', N'18', N'2020-01-18 08:34:36.497'), (N'395', N'1', N'19', N'2020-01-18 08:34:36.497'), (N'396', N'1', N'20', N'2020-01-18 08:34:36.497'), (N'397', N'1', N'21', N'2020-01-18 08:34:36.497'), (N'398', N'1', N'22', N'2020-01-18 08:34:36.497'), (N'399', N'1', N'23', N'2020-01-18 08:34:36.497'), (N'400', N'1', N'24', N'2020-01-18 08:34:36.497'), (N'401', N'4', NULL, N'2020-01-18 08:34:36.497'), (N'402', N'4', N'1', N'2020-01-18 08:34:36.497'), (N'403', N'4', N'2', N'2020-01-18 08:34:36.497'), (N'404', N'4', N'3', N'2020-01-18 08:34:36.497'), (N'405', N'4', N'4', N'2020-01-18 08:34:36.497'), (N'406', N'4', N'5', N'2020-01-18 08:34:36.497'), (N'407', N'4', N'6', N'2020-01-18 08:34:36.497'), (N'408', N'4', N'7', N'2020-01-18 08:34:36.497'), (N'409', N'4', N'8', N'2020-01-18 08:34:36.497'), (N'410', N'4', N'9', N'2020-01-18 08:34:36.497'), (N'411', N'4', N'10', N'2020-01-18 08:34:36.497'), (N'412', N'4', N'11', N'2020-01-18 08:34:36.497'), (N'413', N'4', N'12', N'2020-01-18 08:34:36.497'), (N'414', N'4', N'13', N'2020-01-18 08:34:36.497'), (N'415', N'4', N'14', N'2020-01-18 08:34:36.497'), (N'416', N'4', N'15', N'2020-01-18 08:34:36.497'), (N'417', N'4', N'16', N'2020-01-18 08:34:36.497'), (N'418', N'4', N'17', N'2020-01-18 08:34:36.497'), (N'419', N'4', N'18', N'2020-01-18 08:34:36.497'), (N'420', N'4', N'19', N'2020-01-18 08:34:36.497'), (N'421', N'4', N'20', N'2020-01-18 08:34:36.497'), (N'422', N'4', N'21', N'2020-01-18 08:34:36.497'), (N'423', N'4', N'22', N'2020-01-18 08:34:36.497'), (N'424', N'4', N'23', N'2020-01-18 08:34:36.497'), (N'425', N'4', N'24', N'2020-01-18 08:34:36.497'), (N'474', N'10', N'1', N'2020-01-18 08:36:07.873'), (N'475', N'10', N'2', N'2020-01-18 08:36:07.873'), (N'476', N'20', N'1', N'2020-01-18 08:36:07.873'), (N'477', N'20', N'2', N'2020-01-18 08:36:07.873'), (N'478', N'21', N'1', N'2020-01-18 08:36:07.873'), (N'479', N'21', N'2', N'2020-01-18 08:36:07.873'), (N'716', N'6', N'3', N'2020-01-18 08:42:35.163'), (N'717', N'6', N'4', N'2020-01-18 08:42:35.163'), (N'718', N'6', N'5', N'2020-01-18 08:42:35.163'), (N'719', N'6', N'17', N'2020-01-18 08:42:35.163'), (N'720', N'6', N'19', N'2020-01-18 08:42:35.163'), (N'721', N'6', N'20', N'2020-01-18 08:42:35.163'), (N'722', N'6', N'21', N'2020-01-18 08:42:35.163'), (N'723', N'6', N'22', N'2020-01-18 08:42:35.163'), (N'724', N'6', N'23', N'2020-01-18 08:42:35.163'), (N'725', N'6', N'24', N'2020-01-18 08:42:35.163'), (N'726', N'7', N'3', N'2020-01-18 08:42:35.163'), (N'727', N'7', N'4', N'2020-01-18 08:42:35.163'), (N'728', N'7', N'5', N'2020-01-18 08:42:35.163'), (N'729', N'7', N'17', N'2020-01-18 08:42:35.163'), (N'730', N'7', N'19', N'2020-01-18 08:42:35.163'), (N'731', N'7', N'20', N'2020-01-18 08:42:35.163'), (N'732', N'7', N'21', N'2020-01-18 08:42:35.163'), (N'733', N'7', N'22', N'2020-01-18 08:42:35.163'), (N'734', N'7', N'23', N'2020-01-18 08:42:35.163'), (N'735', N'7', N'24', N'2020-01-18 08:42:35.163'), (N'736', N'8', N'3', N'2020-01-18 08:42:35.163'), (N'737', N'8', N'4', N'2020-01-18 08:42:35.163'), (N'738', N'8', N'5', N'2020-01-18 08:42:35.163'), (N'739', N'8', N'17', N'2020-01-18 08:42:35.163'), (N'740', N'8', N'19', N'2020-01-18 08:42:35.163'), (N'741', N'8', N'20', N'2020-01-18 08:42:35.163'), (N'742', N'8', N'21', N'2020-01-18 08:42:35.163'), (N'743', N'8', N'22', N'2020-01-18 08:42:35.163'), (N'744', N'8', N'23', N'2020-01-18 08:42:35.163'), (N'745', N'8', N'24', N'2020-01-18 08:42:35.163'), (N'746', N'18', N'3', N'2020-01-18 08:42:35.163'), (N'747', N'18', N'4', N'2020-01-18 08:42:35.163'), (N'748', N'18', N'5', N'2020-01-18 08:42:35.163'), (N'749', N'18', N'17', N'2020-01-18 08:42:35.163'), (N'750', N'18', N'19', N'2020-01-18 08:42:35.163'), (N'751', N'18', N'20', N'2020-01-18 08:42:35.163'), (N'752', N'18', N'21', N'2020-01-18 08:42:35.163'), (N'753', N'18', N'22', N'2020-01-18 08:42:35.163'), (N'754', N'18', N'23', N'2020-01-18 08:42:35.163'), (N'755', N'18', N'24', N'2020-01-18 08:42:35.163'), (N'756', N'22', N'3', N'2020-01-18 08:42:35.163'), (N'757', N'22', N'4', N'2020-01-18 08:42:35.163'), (N'758', N'22', N'5', N'2020-01-18 08:42:35.163'), (N'759', N'22', N'17', N'2020-01-18 08:42:35.163'), (N'760', N'22', N'19', N'2020-01-18 08:42:35.163'), (N'761', N'22', N'20', N'2020-01-18 08:42:35.163'), (N'762', N'22', N'21', N'2020-01-18 08:42:35.163'), (N'763', N'22', N'22', N'2020-01-18 08:42:35.163'), (N'764', N'22', N'23', N'2020-01-18 08:42:35.163'), (N'765', N'22', N'24', N'2020-01-18 08:42:35.163')
GO

SET IDENTITY_INSERT [dbo].[sys_users_permissions] OFF
GO

COMMIT
GO


-- ----------------------------
-- Primary Key structure for table EMP_USER2
-- ----------------------------
ALTER TABLE [dbo].[EMP_USER2] ADD CONSTRAINT [PK__EMP_USER__DD2F0298811408CF] PRIMARY KEY CLUSTERED ([ID], [USER_ID])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table events
-- ----------------------------
ALTER TABLE [dbo].[events] ADD CONSTRAINT [PK__events__3213E83F5D3E6A64] PRIMARY KEY CLUSTERED ([id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table INFORMATION
-- ----------------------------
ALTER TABLE [dbo].[INFORMATION] ADD CONSTRAINT [PK__INFORMAT__3214EC27E25788C7] PRIMARY KEY CLUSTERED ([ID])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table SUP_CTRL
-- ----------------------------
ALTER TABLE [dbo].[SUP_CTRL] ADD CONSTRAINT [PK__SUP_CTRL__9867C083A4F8DBED] PRIMARY KEY CLUSTERED ([ID], [SUP_CODE])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table sys_menu_groups
-- ----------------------------
ALTER TABLE [dbo].[sys_menu_groups] ADD CONSTRAINT [PK__sys_menu__215D963EBBDDA984] PRIMARY KEY CLUSTERED ([mg_id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table sys_menus
-- ----------------------------
ALTER TABLE [dbo].[sys_menus] ADD CONSTRAINT [PK__sys_menu__7C8D7D2953243DA4] PRIMARY KEY CLUSTERED ([m_id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table sys_permission_groups
-- ----------------------------
ALTER TABLE [dbo].[sys_permission_groups] ADD CONSTRAINT [PK__sys_perm__7D04194647CF9093] PRIMARY KEY CLUSTERED ([spg_id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table sys_permissions
-- ----------------------------
ALTER TABLE [dbo].[sys_permissions] ADD CONSTRAINT [PK__sys_perm__4C367CEEE608DEC5] PRIMARY KEY CLUSTERED ([sp_id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table sys_user_groups
-- ----------------------------
ALTER TABLE [dbo].[sys_user_groups] ADD CONSTRAINT [PK__sys_user__F40B94CFA7E41CA8] PRIMARY KEY CLUSTERED ([sug_id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table sys_users
-- ----------------------------
ALTER TABLE [dbo].[sys_users] ADD CONSTRAINT [PK__sys_user__B0196BF4FCC0BA46] PRIMARY KEY CLUSTERED ([su_id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table sys_users_groups_permissions
-- ----------------------------
ALTER TABLE [dbo].[sys_users_groups_permissions] ADD CONSTRAINT [PK__sys_user__3DAAE343E63678FD] PRIMARY KEY CLUSTERED ([sugp_id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Primary Key structure for table sys_users_permissions
-- ----------------------------
ALTER TABLE [dbo].[sys_users_permissions] ADD CONSTRAINT [PK__sys_user__FB8F785F720D2F10] PRIMARY KEY CLUSTERED ([sup_id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO

