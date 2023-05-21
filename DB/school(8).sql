-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2019 at 10:35 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `evaluate_homework`
--

CREATE TABLE `evaluate_homework` (
  `id` int(11) NOT NULL,
  `student` varchar(100) NOT NULL,
  `homework` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_code` varchar(100) NOT NULL,
  `academic_year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluate_homework`
--

INSERT INTO `evaluate_homework` (`id`, `student`, `homework`, `status`, `created_date`, `updated_on`, `branch_code`, `academic_year`) VALUES
(1, '18/316', 1, 'InComplete', '05-03-2019 17:33:35', '2019-03-05 17:33:35', '2', '2018-2019'),
(2, '16/28', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:35', '2', '2018-2019'),
(3, '17/36', 1, 'InComplete', '05-03-2019 17:33:35', '2019-03-05 17:33:35', '2', '2018-2019'),
(4, '18/261', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:35', '2', '2018-2019'),
(5, '18/260', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:35', '2', '2018-2019'),
(6, '18/259', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:35', '2', '2018-2019'),
(7, '18/255', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:35', '2', '2018-2019'),
(8, '18/239', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(9, '18/224', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(10, '18/209', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(11, '18/195', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(12, '18/180', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(13, '18/173', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(14, '18/132', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(15, '18/131', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(16, '18/130', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(17, '18/129', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(18, '18/128', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(19, '18/127', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(20, '18/64', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(21, '18/63', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(22, '18/62', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(23, '18/61', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(24, '18/60', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(25, '18/59', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(26, '18/58', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(27, '18/57', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(28, '18/56', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(29, '18/55', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(30, '18/54', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(31, '18/52', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:36', '2', '2018-2019'),
(32, '18/51', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:37', '2', '2018-2019'),
(33, '18/50', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:37', '2', '2018-2019'),
(34, '18/49', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:37', '2', '2018-2019'),
(35, '18/48', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:37', '2', '2018-2019'),
(36, '18/47', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:37', '2', '2018-2019'),
(37, '18/46', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:37', '2', '2018-2019'),
(38, '18/53', 1, 'Complete', '05-03-2019 17:33:35', '2019-03-05 17:33:37', '2', '2018-2019');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `id` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `batch` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `exam_date` varchar(100) NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `end_time` varchar(100) NOT NULL,
  `room_no` varchar(100) NOT NULL,
  `full_marks` varchar(100) NOT NULL,
  `pass_marks` varchar(100) NOT NULL,
  `created_date` varchar(200) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_code` varchar(200) NOT NULL,
  `academic_year` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_schedule`
--

INSERT INTO `exam_schedule` (`id`, `exam`, `course`, `batch`, `subject`, `exam_date`, `start_time`, `end_time`, `room_no`, `full_marks`, `pass_marks`, `created_date`, `updated_on`, `branch_code`, `academic_year`) VALUES
(1, 5, 2, 2, 'C++', '1', '10', '11', '101', '100', '30', '06-02-2019 13:41:13', '2019-02-06 13:41:13', '2', '2018-2019'),
(2, 5, 2, 2, 'ASP.Net', '2', '10', '11', '102', '100', '20', '06-02-2019 13:41:13', '2019-02-06 13:41:13', '2', '2018-2019'),
(3, 5, 2, 2, 'Math', '3', '10', '11', '101', '100', '40', '06-02-2019 13:41:13', '2019-02-06 13:41:13', '2', '2018-2019'),
(4, 5, 2, 2, 'English', '4', '10', '11', '103', '100', '50', '06-02-2019 13:41:13', '2019-02-06 13:41:13', '2', '2018-2019'),
(5, 4, 2, 2, 'C++', '1', '2', '3', '101', '100', '40', '07-02-2019 10:55:01', '2019-02-07 10:55:01', '2', '2018-2019'),
(6, 4, 2, 2, 'ASP.Net', '2', '2', '3', '102', '100', '40', '07-02-2019 10:55:01', '2019-02-07 10:55:02', '2', '2018-2019'),
(7, 4, 2, 2, 'Math', '3', '3', '3', '103', '100', '40', '07-02-2019 10:55:01', '2019-02-07 10:55:02', '2', '2018-2019'),
(8, 4, 2, 2, 'English', '4', '2', '4', '121', '111', '23', '07-02-2019 10:55:01', '2019-02-07 10:55:02', '2', '2018-2019');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `batch` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `homework_date` varchar(100) NOT NULL,
  `date_of_submission` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `document` varchar(200) DEFAULT NULL,
  `academic_year` varchar(100) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `course`, `batch`, `subject`, `homework_date`, `date_of_submission`, `description`, `document`, `academic_year`, `created_date`, `updated_on`, `branch_code`) VALUES
(1, 2, 2, 3, '06-03-2019', '19-03-2019', 'hjil', NULL, '2018-2019', '04-03-2019 12:45:58', '2019-03-06 11:06:38', '2'),
(2, 1, 1, 8, '27-02-2019', '12-03-2019', '<span style=\"font-family: Arial;\">ghh</span>', NULL, '2018-2019', '04-03-2019 12:46:21', '2019-03-06 11:07:06', '2');

-- --------------------------------------------------------

--
-- Table structure for table `issue_item`
--

CREATE TABLE `issue_item` (
  `id` int(11) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `issue_to` varchar(100) NOT NULL,
  `issue_by` varchar(100) NOT NULL,
  `issue_date` varchar(100) NOT NULL,
  `return_date` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_item`
--

INSERT INTO `issue_item` (`id`, `user_type`, `issue_to`, `issue_by`, `issue_date`, `return_date`, `note`, `category`, `item`, `qty`, `status`, `academic_year`, `created_date`, `updated_on`, `branch_code`) VALUES
(1, 'student', '', 'Suraj', '05-04-2019', '26-03-2019', 'kugk', 1, 1, 10, 'Pending', '2018-2019', '01-03-2019 16:36:26', '2019-03-02 11:29:58', '2'),
(2, 'student', '3110', 'sharique', '14-03-2019', '19-03-2019', 'welcome', 1, 1, 20, 'pending', '2018-2019', '01-03-2019 16:37:47', '2019-03-02 11:30:12', '2'),
(3, 'employee', 'MSDEMP01', 'sharique', '26-11-2019', '11-03-2019', 'hey', 1, 1, 10, 'pending', '2018-2019', '01-03-2019 16:39:03', '2019-03-02 11:30:17', '2');

-- --------------------------------------------------------

--
-- Table structure for table `item_stock`
--

CREATE TABLE `item_stock` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `supplier` int(11) DEFAULT NULL,
  `store` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `document` varchar(200) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `academic_year` varchar(100) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_stock`
--

INSERT INTO `item_stock` (`id`, `category`, `item`, `supplier`, `store`, `qty`, `date`, `document`, `description`, `academic_year`, `created_date`, `updated_on`, `branch_code`) VALUES
(1, 1, 1, 2, 1, 25, '13-03-2019', NULL, 'hi', '2018-2019', '01-03-2019 12:29:24', '2019-03-01 12:29:24', '2'),
(2, 1, 1, 1, 1, 10, '08-03-2019', NULL, 'jh', '2018-2019', '01-03-2019 12:31:28', '2019-03-01 12:31:28', '2');

-- --------------------------------------------------------

--
-- Table structure for table `item_store`
--

CREATE TABLE `item_store` (
  `id` int(11) NOT NULL,
  `item_store_name` varchar(100) NOT NULL,
  `item_stock_code` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_store`
--

INSERT INTO `item_store` (`id`, `item_store_name`, `item_stock_code`, `description`, `academic_year`, `created_date`, `updated_on`, `branch_code`) VALUES
(1, 'abc', '34', 'hg', '2018-2019', '28-02-2019 18:13:07', '2019-02-28 18:13:07', '2');

-- --------------------------------------------------------

--
-- Table structure for table `item_supplier`
--

CREATE TABLE `item_supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_person_name` varchar(100) DEFAULT NULL,
  `contact_person_phone` varchar(100) DEFAULT NULL,
  `contact_person_email` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `academic_year` varchar(100) DEFAULT NULL,
  `created_date` varchar(100) DEFAULT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_supplier`
--

INSERT INTO `item_supplier` (`id`, `supplier_name`, `phone`, `email`, `address`, `contact_person_name`, `contact_person_phone`, `contact_person_email`, `description`, `academic_year`, `created_date`, `updated_on`, `branch_code`) VALUES
(1, 'abc', '9128727074', 'shariqueawslam12344@gmail.com', 'kanke', 'sharique', '9128727074', 'shariqueasla@gmail.com', 'welcome', '2018-2019', '01-03-2019 10:19:21', '2019-03-01 10:19:21', '2'),
(2, 'aa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-2019', '01-03-2019 10:21:20', '2019-03-01 10:21:20', '2');

-- --------------------------------------------------------

--
-- Table structure for table `mark_register`
--

CREATE TABLE `mark_register` (
  `id` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `batch` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `register_no` varchar(100) NOT NULL,
  `roll_no` varchar(100) NOT NULL,
  `student_name` int(11) NOT NULL,
  `marks` varchar(100) DEFAULT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_code` varchar(100) NOT NULL,
  `academic_year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark_register`
--

INSERT INTO `mark_register` (`id`, `exam`, `course`, `batch`, `subject`, `register_no`, `roll_no`, `student_name`, `marks`, `created_date`, `updated_date`, `branch_code`, `academic_year`) VALUES
(1, 5, 1, 1, 8, '1424', '1', 926, '100', '21-02-2019 11:39:58', '2019-02-21 13:25:16', '2', '2018-2019'),
(2, 5, 1, 1, 8, '195', '1', 927, '100', '21-02-2019 11:39:58', '2019-02-21 13:25:16', '2', '2018-2019'),
(3, 5, 1, 1, 8, '0397', '1', 928, '100', '21-02-2019 11:39:58', '2019-02-21 13:25:16', '2', '2018-2019'),
(4, 5, 1, 1, 8, '0062', '1', 929, '100', '21-02-2019 11:39:58', '2019-02-21 13:25:16', '2', '2018-2019'),
(5, 5, 1, 1, 8, '0931', '1', 930, '100', '21-02-2019 11:39:58', '2019-02-21 13:25:16', '2', '2018-2019'),
(6, 5, 1, 1, 8, '0926', '1', 931, '100', '21-02-2019 11:39:58', '2019-02-21 13:25:16', '2', '2018-2019'),
(7, 5, 1, 1, 8, '0641', '1', 932, '100', '21-02-2019 11:39:58', '2019-02-21 13:25:16', '2', '2018-2019'),
(8, 5, 1, 1, 8, '0915', '1', 933, '100', '21-02-2019 11:39:58', '2019-02-21 13:25:16', '2', '2018-2019'),
(9, 5, 1, 1, 8, '0010', '1', 934, '100', '21-02-2019 11:39:58', '2019-02-21 13:25:16', '2', '2018-2019'),
(10, 5, 1, 1, 8, '0916', '1', 935, '100', '21-02-2019 11:39:58', '2019-02-21 13:25:16', '2', '2018-2019'),
(11, 5, 1, 1, 3, '0932', '1', 886, '100', '21-02-2019 12:14:08', '2019-02-21 13:25:16', '2', '2018-2019'),
(12, 5, 1, 1, 3, '0646', '1', 887, '100', '21-02-2019 12:14:08', '2019-02-21 13:25:16', '2', '2018-2019'),
(13, 5, 1, 1, 3, '0643', '1', 888, '100', '21-02-2019 12:14:08', '2019-02-21 13:25:16', '2', '2018-2019'),
(14, 5, 1, 1, 3, '0007', '1', 889, '100', '21-02-2019 12:14:08', '2019-02-21 13:25:16', '2', '2018-2019'),
(15, 5, 1, 1, 3, '1417', '1', 890, '100', '21-02-2019 12:14:08', '2019-02-21 13:25:16', '2', '2018-2019'),
(16, 5, 1, 1, 3, '0196', '1', 891, '100', '21-02-2019 12:14:08', '2019-02-21 13:25:16', '2', '2018-2019'),
(17, 5, 1, 1, 3, '0209', '1', 892, '100', '21-02-2019 12:14:08', '2019-02-21 13:25:16', '2', '2018-2019'),
(18, 5, 1, 1, 3, '0198', '1', 893, '100', '21-02-2019 12:14:08', '2019-02-21 13:25:16', '2', '2018-2019'),
(19, 5, 1, 1, 3, '0199', '1', 894, '100', '21-02-2019 12:14:08', '2019-02-21 13:25:16', '2', '2018-2019'),
(20, 5, 1, 1, 3, '0404', '1', 895, '100', '21-02-2019 12:14:08', '2019-02-21 13:25:16', '2', '2018-2019'),
(21, 4, 2, 2, 4, '0629', '1', 981, '100', '21-02-2019 12:18:32', '2019-02-21 13:25:16', '2', '2018-2019'),
(22, 4, 2, 2, 4, '0185', '1', 982, '100', '21-02-2019 12:18:32', '2019-02-21 13:25:16', '2', '2018-2019'),
(23, 4, 2, 2, 4, '1433', '1', 983, '100', '21-02-2019 12:18:32', '2019-02-21 13:25:16', '2', '2018-2019'),
(24, 4, 2, 2, 4, '00701', '1', 984, '100', '21-02-2019 12:18:32', '2019-02-21 13:25:16', '2', '2018-2019'),
(25, 4, 2, 2, 4, '0907', '1', 985, '100', '21-02-2019 12:18:32', '2019-02-21 13:25:16', '2', '2018-2019'),
(26, 4, 2, 2, 4, '886', '1', 986, '100', '21-02-2019 12:18:32', '2019-02-21 13:25:16', '2', '2018-2019'),
(27, 4, 2, 2, 4, '1438', '1', 987, '100', '21-02-2019 12:18:32', '2019-02-21 13:25:16', '2', '2018-2019'),
(28, 4, 2, 2, 4, '900', '1', 988, '100', '21-02-2019 12:18:32', '2019-02-21 13:25:16', '2', '2018-2019'),
(29, 4, 2, 2, 4, '0888', '1', 989, '100', '21-02-2019 12:18:32', '2019-02-21 13:25:16', '2', '2018-2019'),
(30, 4, 2, 2, 4, '0190', '1', 990, '100', '21-02-2019 12:18:32', '2019-02-21 13:25:16', '2', '2018-2019'),
(31, 5, 2, 2, 3, '0629', '1', 981, '100', '21-02-2019 12:18:54', '2019-02-21 13:25:16', '2', '2018-2019'),
(32, 5, 2, 2, 3, '0185', '1', 982, '100', '21-02-2019 12:18:54', '2019-02-21 13:25:16', '2', '2018-2019'),
(33, 5, 2, 2, 3, '1433', '1', 983, '100', '21-02-2019 12:18:54', '2019-02-21 13:25:16', '2', '2018-2019'),
(34, 5, 2, 2, 3, '00701', '1', 984, '100', '21-02-2019 12:18:54', '2019-02-21 13:25:16', '2', '2018-2019'),
(35, 5, 2, 2, 3, '0907', '1', 985, '100', '21-02-2019 12:18:54', '2019-02-21 13:25:16', '2', '2018-2019'),
(36, 5, 2, 2, 3, '886', '1', 986, '100', '21-02-2019 12:18:54', '2019-02-21 13:25:16', '2', '2018-2019'),
(37, 5, 2, 2, 3, '1438', '1', 987, '100', '21-02-2019 12:18:54', '2019-02-21 13:25:16', '2', '2018-2019'),
(38, 5, 2, 2, 3, '900', '1', 988, '100', '21-02-2019 12:18:54', '2019-02-21 13:25:16', '2', '2018-2019'),
(39, 5, 2, 2, 3, '0888', '1', 989, '100', '21-02-2019 12:18:54', '2019-02-21 13:25:16', '2', '2018-2019'),
(40, 5, 2, 2, 3, '0190', '1', 990, '100', '21-02-2019 12:18:54', '2019-02-21 13:25:16', '2', '2018-2019'),
(41, 4, 2, 2, 6, '0629', '1', 981, '100', '21-02-2019 12:19:51', '2019-02-21 13:25:16', '2', '2018-2019'),
(42, 4, 2, 2, 6, '0185', '1', 982, '100', '21-02-2019 12:19:51', '2019-02-21 13:25:16', '2', '2018-2019'),
(43, 4, 2, 2, 6, '1433', '1', 983, '100', '21-02-2019 12:19:51', '2019-02-21 13:25:16', '2', '2018-2019'),
(44, 4, 2, 2, 6, '00701', '1', 984, '100', '21-02-2019 12:19:51', '2019-02-21 13:25:16', '2', '2018-2019'),
(45, 4, 2, 2, 6, '0907', '1', 985, '100', '21-02-2019 12:19:51', '2019-02-21 13:25:16', '2', '2018-2019'),
(46, 4, 2, 2, 6, '886', '1', 986, '100', '21-02-2019 12:19:51', '2019-02-21 13:25:16', '2', '2018-2019'),
(47, 4, 2, 2, 6, '1438', '1', 987, '100', '21-02-2019 12:19:51', '2019-02-21 13:25:16', '2', '2018-2019'),
(48, 4, 2, 2, 6, '900', '1', 988, '100', '21-02-2019 12:19:51', '2019-02-21 13:25:16', '2', '2018-2019'),
(49, 4, 2, 2, 6, '0888', '1', 989, '100', '21-02-2019 12:19:51', '2019-02-21 13:25:16', '2', '2018-2019'),
(50, 4, 2, 2, 6, '0190', '1', 990, '100', '21-02-2019 12:19:51', '2019-02-21 13:25:16', '2', '2018-2019');

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`id`, `category_name`, `description`, `academic_year`, `created_date`, `updated_on`, `branch_code`) VALUES
(1, 'Sports', 'good', '2018-2019', '28-02-2019 14:30:35', '2019-02-28 14:30:35', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_exam`
--

CREATE TABLE `tb_exam` (
  `id` int(11) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_exam`
--

INSERT INTO `tb_exam` (`id`, `exam_name`, `description`, `academic_year`, `created_date`, `updated_date`, `branch_code`) VALUES
(4, 'Unit-test-january', 'student capacity check', '2018-2019', '30-01-2019 17:10:24', '2019-01-30 17:10:24', '2'),
(5, 'Annual Exam', 'abc', '2018-2019', '31-01-2019 12:27:37', '2019-01-31 12:27:37', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE `tb_item` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `academic_year` varchar(100) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_code` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_item`
--

INSERT INTO `tb_item` (`id`, `item_name`, `category`, `description`, `academic_year`, `created_date`, `updated_on`, `branch_code`) VALUES
(1, 'Cricket bat', 1, 'gg', '2018-2019', '01-03-2019 11:07:50', '2019-03-01 11:07:50', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_marks_grade`
--

CREATE TABLE `tb_marks_grade` (
  `id` int(11) NOT NULL,
  `grade_name` varchar(100) NOT NULL,
  `percent_from` varchar(100) NOT NULL,
  `percent_upto` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `academic_year` varchar(200) NOT NULL,
  `created_date` varchar(200) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_marks_grade`
--

INSERT INTO `tb_marks_grade` (`id`, `grade_name`, `percent_from`, `percent_upto`, `description`, `academic_year`, `created_date`, `updated_on`, `branch_code`) VALUES
(1, 'A', 'A', '1000', '111', '2018-2019', '15-02-2019 11:39:15', '2019-02-15 11:39:15', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluate_homework`
--
ALTER TABLE `evaluate_homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_item`
--
ALTER TABLE `issue_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_stock`
--
ALTER TABLE `item_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_store`
--
ALTER TABLE `item_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_supplier`
--
ALTER TABLE `item_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mark_register`
--
ALTER TABLE `mark_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_exam`
--
ALTER TABLE `tb_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_marks_grade`
--
ALTER TABLE `tb_marks_grade`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluate_homework`
--
ALTER TABLE `evaluate_homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `issue_item`
--
ALTER TABLE `issue_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_stock`
--
ALTER TABLE `item_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_store`
--
ALTER TABLE `item_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_supplier`
--
ALTER TABLE `item_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mark_register`
--
ALTER TABLE `mark_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_exam`
--
ALTER TABLE `tb_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_marks_grade`
--
ALTER TABLE `tb_marks_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
