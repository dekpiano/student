-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2025 at 02:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skjacth_academic`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_clubs`
--

CREATE TABLE `tb_clubs` (
  `club_id` int(11) NOT NULL COMMENT 'รหัสชุมนุม ',
  `club_name` varchar(100) NOT NULL COMMENT 'ชื่อชุมนุม',
  `club_description` text DEFAULT NULL COMMENT 'รายละเอียดชุมนุม',
  `club_faculty_advisor` varchar(100) DEFAULT NULL COMMENT 'อาจารย์ที่ปรึกษา',
  `club_established_date` date DEFAULT NULL COMMENT 'วันที่สร้างชุมนุม',
  `club_year` varchar(4) NOT NULL COMMENT 'ปีการศึกษา',
  `club_trem` varchar(1) NOT NULL COMMENT 'เทอมที่',
  `club_max_participants` int(11) NOT NULL COMMENT 'จำนวนผู้เข้าร่วมสูงสุด',
  `club_status` enum('open','close') DEFAULT 'open' COMMENT 'เปิดปิดชุมนุม',
  `club_level` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_clubs`
--

INSERT INTO `tb_clubs` (`club_id`, `club_name`, `club_description`, `club_faculty_advisor`, `club_established_date`, `club_year`, `club_trem`, `club_max_participants`, `club_status`, `club_level`) VALUES
(7, 'คอมพิวเตอร์', 'โย่ว ๆ', 'pers_004|pers_021', '2024-11-18', '2568', '1', 20, 'open', 'ม.ปลาย'),
(9, 'ภาษาไทย', 'เดินจับโปเกมอน', 'pers_007|pers_016', '2024-11-21', '2568', '1', 5, 'open', NULL),
(10, 'คอมพิวเตอร์22', 'aasd', 'pers_006|pers_008', '2024-11-21', '2567', '1', 23, 'open', NULL),
(11, 'ภาษาไทย', 'ทำงาน', 'pers_004', '2024-11-22', '2567', '1', 10, 'open', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_club_activities`
--

CREATE TABLE `tb_club_activities` (
  `act_id` int(11) NOT NULL COMMENT 'รหัสกิจกรรม',
  `act_name` varchar(100) NOT NULL COMMENT 'ชื่อกิจกรรม',
  `act_date` date NOT NULL COMMENT 'วันที่จัดกิจกรรม',
  `act_location` varchar(100) DEFAULT NULL COMMENT 'สถานที่จัดกิจกรรม',
  `act_description` text DEFAULT NULL COMMENT 'รายละเอียดกิจกรรม',
  `act_club_id` int(11) DEFAULT NULL COMMENT 'รหัสชุมนุม',
  `act_start_time` time DEFAULT NULL COMMENT 'เวลาเริ่มกิจกรรม',
  `act_end_time` time DEFAULT NULL COMMENT 'เวลาสิ้นสุดกิจกรรม',
  `act_number_of_periods` int(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_club_activities`
--

INSERT INTO `tb_club_activities` (`act_id`, `act_name`, `act_date`, `act_location`, `act_description`, `act_club_id`, `act_start_time`, `act_end_time`, `act_number_of_periods`) VALUES
(1, 'เล่นเกมส์ นอนหลับ', '2025-11-11', 'ห้องคอม', 'นอนเล่น', 7, '16:25:00', '16:25:00', 2),
(2, 'เล่นเกมส์2', '2025-11-12', 'ห้องคอม', '', 7, '00:59:00', '08:02:00', 2),
(3, 'เล่นเกมส์3', '2025-11-13', 'ห้องคอม', '', 7, '02:00:00', '09:03:00', 2),
(4, 'เล่นเกมส์4', '2025-11-14', 'ห้องคอม', '', 7, '00:00:00', '09:03:00', 4),
(5, 'เล่นเกมส์5', '2025-12-02', 'ห้องคอม', '', 7, '01:00:00', '10:03:00', 1),
(6, 'เล่นเกมส์6', '2025-12-06', 'ห้องคอม', '123', 7, '11:00:00', '09:03:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_club_members`
--

CREATE TABLE `tb_club_members` (
  `member_id` int(11) NOT NULL COMMENT 'รหัสสมาชิก',
  `member_student_id` int(11) DEFAULT NULL COMMENT 'รหัสนักเรียน',
  `member_club_id` int(11) DEFAULT NULL COMMENT 'รหัสชุมนุม',
  `member_join_date` date DEFAULT NULL COMMENT 'วันที่เข้าชุมนุม',
  `member_role` enum('Member','Leader') DEFAULT 'Member' COMMENT 'บทบาทในชุมนุม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_club_members`
--

INSERT INTO `tb_club_members` (`member_id`, `member_student_id`, `member_club_id`, `member_join_date`, `member_role`) VALUES
(24, 4093, 9, '2025-11-10', 'Member'),
(25, 4094, 9, '2025-11-10', 'Member'),
(26, 4095, 9, '2025-11-10', 'Member'),
(27, 4125, 7, '2025-11-11', 'Leader'),
(28, 4105, 7, '2025-11-11', 'Member'),
(29, 4115, 7, '2025-11-11', 'Member'),
(30, 4117, 7, '2025-11-11', 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `tb_club_objectives`
--

CREATE TABLE `tb_club_objectives` (
  `objective_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `objective_name` varchar(255) NOT NULL,
  `objective_description` text DEFAULT NULL,
  `objective_order` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_club_objectives`
--

INSERT INTO `tb_club_objectives` (`objective_id`, `club_id`, `objective_name`, `objective_description`, `objective_order`, `created_by`, `created_at`) VALUES
(1, 7, '1.ได้เรียนรู้ประวัติและความเป็นมาของกีฬาอีสปอร์ต', '', 1, 'pers_021', '2025-11-11 09:47:23'),
(2, 7, '2. สามารถพัฒนากระบวนการคิดวางแผน ทักษะการทํางานเปนทีมและการสื่อสารเพื่อการประสานงาน', '', 2, 'pers_021', '2025-11-11 09:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `tb_club_onoff`
--

CREATE TABLE `tb_club_onoff` (
  `c_onoff_id` int(11) NOT NULL,
  `c_onoff_year` varchar(9) NOT NULL,
  `c_onoff_term` int(1) NOT NULL,
  `c_onoff_regisstart` datetime NOT NULL,
  `c_onoff_regisend` datetime NOT NULL,
  `c_onoff_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_club_onoff`
--

INSERT INTO `tb_club_onoff` (`c_onoff_id`, `c_onoff_year`, `c_onoff_term`, `c_onoff_regisstart`, `c_onoff_regisend`, `c_onoff_created_at`) VALUES
(1, '2568', 1, '2025-11-10 15:00:00', '2025-11-11 15:00:00', '2024-11-23 04:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_club_record_activity`
--

CREATE TABLE `tb_club_record_activity` (
  `tcra_id` int(11) NOT NULL COMMENT 'รหัสผู้เข้าร่วม',
  `tcra_club_id` int(11) DEFAULT NULL COMMENT 'รหัสชุมนุม',
  `tcra_teac_id` varchar(10) NOT NULL COMMENT 'ครูประเมิน',
  `trca_schedule_id` int(5) NOT NULL,
  `tcra_ma` text NOT NULL COMMENT 'มา',
  `tcra_khad` text NOT NULL COMMENT 'ขาด',
  `tcra_rapwy` text NOT NULL COMMENT 'ลาป่วย',
  `tcra_rakic` text NOT NULL COMMENT 'ลากิจ',
  `tcra_kickrrm` text NOT NULL COMMENT 'กิจกรรม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_club_record_activity`
--

INSERT INTO `tb_club_record_activity` (`tcra_id`, `tcra_club_id`, `tcra_teac_id`, `trca_schedule_id`, `tcra_ma`, `tcra_khad`, `tcra_rapwy`, `tcra_rakic`, `tcra_kickrrm`) VALUES
(2, 7, 'pers_021', 1, '4105,4117', '4115,4125', '', '', ''),
(3, 7, 'pers_021', 2, '4105,4115,4117,4125', '', '', '', ''),
(4, 7, 'pers_021', 3, '4105,4115,4117,4125', '', '', '', ''),
(5, 7, 'pers_021', 4, '4105,4125', '4117', '4115', '', ''),
(6, 7, 'pers_021', 5, '4105,4125', '4115', '4117', '', ''),
(7, 7, 'pers_021', 6, '4105,4115,4117,4125', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_club_settings_schedule`
--

CREATE TABLE `tb_club_settings_schedule` (
  `tcs_schedule_id` int(11) NOT NULL COMMENT 'รหัสการกำหนด',
  `tcs_academic_year` varchar(9) NOT NULL COMMENT 'ปีการศึกษา ',
  `tcs_academic_trem` int(1) NOT NULL DEFAULT 1 COMMENT 'ภาคเรียน',
  `tcs_start_date` date NOT NULL COMMENT 'วันที่เริ่มต้นเรียน',
  `tcs_week_number` int(11) NOT NULL COMMENT 'สัปดาห์ที่',
  `tcs_week_status` enum('เปิด','ปิด') NOT NULL COMMENT 'สถานะเปิดปิด',
  `tcs_created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่สร้าง',
  `tcs_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'วันที่แก้ไข'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_club_settings_schedule`
--

INSERT INTO `tb_club_settings_schedule` (`tcs_schedule_id`, `tcs_academic_year`, `tcs_academic_trem`, `tcs_start_date`, `tcs_week_number`, `tcs_week_status`, `tcs_created_at`, `tcs_updated_at`) VALUES
(1, '2568', 1, '2025-11-11', 1, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:39'),
(2, '2568', 1, '2025-11-12', 2, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:43'),
(3, '2568', 1, '2025-11-13', 3, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:48'),
(4, '2568', 1, '2025-11-14', 4, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:53'),
(5, '2568', 1, '2025-12-02', 5, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 10:33:53'),
(6, '2568', 1, '2025-12-06', 6, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 10:34:04'),
(7, '2568', 1, '0000-00-00', 7, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(8, '2568', 1, '0000-00-00', 8, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(9, '2568', 1, '0000-00-00', 9, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(10, '2568', 1, '0000-00-00', 10, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(11, '2568', 1, '0000-00-00', 11, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(12, '2568', 1, '0000-00-00', 12, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(13, '2568', 1, '0000-00-00', 13, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(14, '2568', 1, '0000-00-00', 14, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(15, '2568', 1, '0000-00-00', 15, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(16, '2568', 1, '0000-00-00', 16, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(17, '2568', 1, '0000-00-00', 17, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(18, '2568', 1, '0000-00-00', 18, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(19, '2568', 1, '0000-00-00', 19, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21'),
(20, '2568', 1, '0000-00-00', 20, 'เปิด', '2025-11-11 05:59:21', '2025-11-11 05:59:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_club_student_progress`
--

CREATE TABLE `tb_club_student_progress` (
  `progress_id` int(11) NOT NULL,
  `objective_id` int(11) NOT NULL,
  `student_id` varchar(17) NOT NULL,
  `club_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Not Passed, 1 = Passed',
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_club_student_progress`
--

INSERT INTO `tb_club_student_progress` (`progress_id`, `objective_id`, `student_id`, `club_id`, `status`, `updated_by`, `updated_at`) VALUES
(1, 1, '4105', 7, 1, 'pers_021', '2025-11-11 09:53:10'),
(2, 2, '4105', 7, 1, 'pers_021', '2025-11-11 09:53:10'),
(3, 1, '4115', 7, 1, 'pers_021', '2025-11-11 09:53:40'),
(4, 2, '4115', 7, 0, 'pers_021', '2025-11-11 09:53:10'),
(5, 1, '4117', 7, 0, 'pers_021', '2025-11-11 09:53:10'),
(6, 2, '4117', 7, 1, 'pers_021', '2025-11-11 09:53:40'),
(7, 1, '4125', 7, 1, 'pers_021', '2025-11-11 10:21:17'),
(8, 2, '4125', 7, 0, 'pers_021', '2025-11-11 09:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_club_student_summary`
--

CREATE TABLE `tb_club_student_summary` (
  `summary_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `student_id` varchar(17) NOT NULL,
  `academic_year` varchar(4) NOT NULL,
  `academic_term` int(1) NOT NULL,
  `objective_result` varchar(20) DEFAULT NULL COMMENT 'e.g., ผ่าน, ไม่ผ่าน',
  `result_level` varchar(20) DEFAULT NULL,
  `activity_notes` text DEFAULT NULL,
  `correction_notes` text DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_clubs`
--
ALTER TABLE `tb_clubs`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `tb_club_activities`
--
ALTER TABLE `tb_club_activities`
  ADD PRIMARY KEY (`act_id`),
  ADD KEY `act_club_id` (`act_club_id`);

--
-- Indexes for table `tb_club_members`
--
ALTER TABLE `tb_club_members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tb_club_objectives`
--
ALTER TABLE `tb_club_objectives`
  ADD PRIMARY KEY (`objective_id`),
  ADD KEY `idx_club` (`club_id`);

--
-- Indexes for table `tb_club_onoff`
--
ALTER TABLE `tb_club_onoff`
  ADD PRIMARY KEY (`c_onoff_id`);

--
-- Indexes for table `tb_club_record_activity`
--
ALTER TABLE `tb_club_record_activity`
  ADD PRIMARY KEY (`tcra_id`);

--
-- Indexes for table `tb_club_settings_schedule`
--
ALTER TABLE `tb_club_settings_schedule`
  ADD PRIMARY KEY (`tcs_schedule_id`);

--
-- Indexes for table `tb_club_student_progress`
--
ALTER TABLE `tb_club_student_progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD UNIQUE KEY `idx_student_objective` (`student_id`,`objective_id`);

--
-- Indexes for table `tb_club_student_summary`
--
ALTER TABLE `tb_club_student_summary`
  ADD PRIMARY KEY (`summary_id`),
  ADD UNIQUE KEY `idx_club_student_term` (`club_id`,`student_id`,`academic_year`,`academic_term`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_clubs`
--
ALTER TABLE `tb_clubs`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสชุมนุม ', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_club_activities`
--
ALTER TABLE `tb_club_activities`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกิจกรรม', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_club_members`
--
ALTER TABLE `tb_club_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสมาชิก', AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_club_objectives`
--
ALTER TABLE `tb_club_objectives`
  MODIFY `objective_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_club_onoff`
--
ALTER TABLE `tb_club_onoff`
  MODIFY `c_onoff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_club_record_activity`
--
ALTER TABLE `tb_club_record_activity`
  MODIFY `tcra_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้เข้าร่วม', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_club_settings_schedule`
--
ALTER TABLE `tb_club_settings_schedule`
  MODIFY `tcs_schedule_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการกำหนด', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_club_student_progress`
--
ALTER TABLE `tb_club_student_progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_club_student_summary`
--
ALTER TABLE `tb_club_student_summary`
  MODIFY `summary_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
