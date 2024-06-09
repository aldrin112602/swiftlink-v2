-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 03:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swiftlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middle_initial` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(500) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `valid_id` varchar(500) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user',
  `enable2FA` varchar(255) DEFAULT 'true',
  `status` varchar(255) DEFAULT 'Pending',
  `verified` varchar(255) DEFAULT 'false',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `phone`, `password`, `firstname`, `middle_initial`, `lastname`, `account_no`, `address`, `town`, `city`, `province`, `postal_code`, `valid_id`, `profile`, `role`, `enable2FA`, `status`, `verified`, `date`) VALUES
(1, 'rubayajohnemmanuel@gmail.com', '0965449477', 'John5555', 'Jey ihh', 'D', 'Rubaya', '054745002751816378821949', '184 Sapang Buli Street', 'Ithan', 'Binangonan', 'Rizal', '1940', 'uploads/6616afbe24b03-jey.png', NULL, 'lineman', 'false', 'Active', 'true', '2024-04-10 07:26:54'),
(2, 'emmanuelrubaya@gmail.com', '09652449477', 'John5555', 'Emmanuel', 'D', 'Rubaya', '265608270665835741940025', '184 Sapang Buli Street', 'Ithan', 'Binangonan', 'Rizal', '1940', 'uploads/6616bec036514-j2.jpg', NULL, 'user', 'false', 'Active', 'true', '2024-04-10 08:30:59'),
(3, 'emmanueljohnrubaya@gmail.com', '09519629526', 'John5555', 'Jem', 'D', 'Cruz', '646975440125929132284548', 'Poblacion Street', 'Pila-Pila', 'Binangonan', 'Rizal', '1940', 'uploads/6616c667abcd2-IMG_20210314_163423-removebg-preview.png', NULL, 'user', 'false', 'Active', 'true', '2024-04-10 09:03:35'),
(4, 'lesterf524@gmail.com', '09519629526', 'jeyyelll@2400', 'Jhon Lester', 'C', 'Delgado', '958504089820265537839496', 'Mabato Street', 'Pila-Pila', 'Binangonan', 'Rizal', '1940', 'uploads/6616c44828e0f-387519584_146199961906351_6139406061816624895_n-removebg-preview.png', NULL, 'user', 'false', 'Active', 'True', '2024-04-10 08:54:32'),
(5, 'johnemmanuelditablan06@gmail.com', '20965449477', 'John5555', 'Jey', 'R', 'Ditablan', '240487537997979910265071', '184 Sapang Buli Street', 'Ithan', 'Binangonan', 'Rizal', '1940', 'uploads/661787f061ccc-bill-shock.jpg', NULL, 'user', 'false', 'Active', 'true', '2024-04-10 22:49:20'),
(6, 'johnemmanuelditablan@gmail.com', '09652449477', 'John5555', 'John Emmanuel', 'R', 'Ditablan', '576681987956493900885004', '184 Sapang Buli Street', 'Ithan', 'Binangonan', 'Rizal', '1940', 'uploads/6616c2585d4da-jey.png', NULL, 'admin', 'false', 'Active', 'true', '2024-04-10 08:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `admin_log_activity`
--

CREATE TABLE `admin_log_activity` (
  `id` int(11) NOT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT 'Activity',
  `remark` varchar(1000) DEFAULT NULL,
  `level` varchar(100) DEFAULT 'Admin',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_log_activity`
--

INSERT INTO `admin_log_activity` (`id`, `account_no`, `category`, `remark`, `level`, `date`) VALUES
(1, '576681987956493900885004', 'Activity', 'Added help remarks', 'Admin', '2024-04-10 07:06:39'),
(2, '576681987956493900885004', 'Activity', 'Added help remarks', 'Admin', '2024-04-10 07:13:01'),
(3, '576681987956493900885004', 'Activity', 'Added help remarks', 'Admin', '2024-04-10 07:16:07'),
(4, '576681987956493900885004', 'Activity', 'Added help remarks', 'Admin', '2024-04-10 07:16:56'),
(5, '576681987956493900885004', 'Activity', 'Added help remarks', 'Admin', '2024-04-10 07:17:36'),
(6, '576681987956493900885004', 'Activity', 'Added help remarks', 'Admin', '2024-04-10 07:18:06'),
(7, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 07:30:28'),
(8, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 07:35:36'),
(9, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 07:36:10'),
(10, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 07:41:23'),
(11, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 07:41:48'),
(12, '576681987956493900885004', 'Activity', 'Approved payment confirmation', 'Admin', '2024-04-10 07:53:02'),
(13, '576681987956493900885004', 'Activity', 'Updated package', 'Admin', '2024-04-10 08:05:29'),
(14, '576681987956493900885004', 'Activity', 'Added customer account', 'Admin', '2024-04-10 08:30:59'),
(15, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 08:32:40'),
(16, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 08:32:49'),
(17, '576681987956493900885004', 'Activity', 'Added coverage', 'Admin', '2024-04-10 08:47:50'),
(18, '576681987956493900885004', 'Activity', 'Approved user registration', 'Admin', '2024-04-10 09:28:07'),
(19, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 10:30:43'),
(20, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 10:30:54'),
(21, '576681987956493900885004', 'Activity', 'Approved user registration', 'Admin', '2024-04-10 17:25:34'),
(22, '576681987956493900885004', 'Activity', 'Approved user registration', 'Admin', '2024-04-10 17:25:42'),
(23, '576681987956493900885004', 'Activity', 'Updated package', 'Admin', '2024-04-10 17:32:18'),
(24, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 21:23:31'),
(25, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 21:24:11'),
(26, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 21:25:37'),
(27, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 21:27:17'),
(28, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 21:27:46'),
(29, '576681987956493900885004', 'Activity', 'Approved payment confirmation', 'Admin', '2024-04-10 21:36:56'),
(30, '576681987956493900885004', 'Activity', 'Approved user registration', 'Admin', '2024-04-10 22:50:06'),
(31, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 22:56:46'),
(32, '576681987956493900885004', 'Activity', 'Updated data', 'Admin', '2024-04-10 23:06:48'),
(33, '576681987956493900885004', 'Activity', 'Approved payment confirmation', 'Admin', '2024-04-10 23:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `announcement` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `uploaded_file` varchar(1000) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coverage`
--

CREATE TABLE `coverage` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Active',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coverage`
--

INSERT INTO `coverage` (`id`, `name`, `status`, `date`) VALUES
(1, 'ITHAN', 'Active', '2024-04-10 06:57:45'),
(2, 'LIMBON-LIMBON', 'Active', '2024-04-10 06:57:45'),
(3, 'PILA-PILA', 'Active', '2024-04-10 06:57:56'),
(4, 'GUPIING', 'Active', '2024-04-10 06:57:56'),
(5, 'LUNSAD', 'Active', '2024-04-10 06:58:05'),
(6, 'KALINAWAN', 'Active', '2024-04-10 06:58:05'),
(7, 'BINANGONAN', 'Active', '2024-04-10 08:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `customer_ticket`
--

CREATE TABLE `customer_ticket` (
  `id` int(11) NOT NULL,
  `ticket_no` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `remark` varchar(500) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_ticket`
--

INSERT INTO `customer_ticket` (`id`, `ticket_no`, `account_no`, `report`, `status`, `remark`, `document`, `date`, `updated_at`) VALUES
(1, '398459736', '054745002751816378821949', 'Internet / Slow Internet', 'Closed', 'router problem', 'uploads/document_6616b453df8e5-router-issues.jpg', '2024-04-10 07:46:27', '2024-04-10 07:48:45'),
(2, '017875723', '054745002751816378821949', 'Bills / Billing has been paid but the package is still isolated', 'Pending', 'bill report', 'uploads/document_661771da70a9c-bill-shock.jpg', '2024-04-10 21:15:06', '2024-04-10 21:15:06'),
(3, '399558888', '054745002751816378821949', 'Others', 'Pending', 'sometimes, network is inaccessible', 'uploads/document_66177239299fa-images.jpg', '2024-04-10 21:16:41', '2024-04-10 21:16:41'),
(4, '300044528', '265608270665835741940025', 'Internet / Internet cannot be accessed', 'Pending', 'there is a red light in the router', 'uploads/document_661772bb02301-images.jpg', '2024-04-10 21:18:51', '2024-04-10 21:18:51'),
(5, '822450094', '265608270665835741940025', 'Bills / Can\'t pay bills', 'Pending', 'payment of bill is inaccessible', 'uploads/document_661772f0e54e8-bill-shock.jpg', '2024-04-10 21:19:44', '2024-04-10 21:19:44'),
(6, '118204656', '265608270665835741940025', 'Others', 'Pending', 'the router is restarting at random times', 'uploads/document_6617731db8629-images.jpg', '2024-04-10 21:20:29', '2024-04-10 21:20:29'),
(7, '130200874', '646975440125929132284548', 'Internet / All services (internet/tv) not working', 'Pending', 'there\'s no internet in TV', 'uploads/document_6617787b35c71-images.jpg', '2024-04-10 21:43:23', '2024-04-10 21:43:23'),
(8, '323288791', '646975440125929132284548', 'Bills / Billing has been paid but the package is still isolated', 'Pending', 'Paid the bill but still no internet connection', 'uploads/document_661778c7ca769-bill-shock.jpg', '2024-04-10 21:44:39', '2024-04-10 21:44:39'),
(9, '994243404', '240487537997979910265071', 'Others', 'Process', 'slow internet', 'uploads/document_66179306b100f-images.jpg', '2024-04-10 23:36:38', '2024-04-10 23:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `help_category`
--

CREATE TABLE `help_category` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `help_category`
--

INSERT INTO `help_category` (`id`, `type`, `remarks`, `date`) VALUES
(1, 'Internet', 'about internet', '2024-04-10 07:02:48'),
(2, 'Bills', 'bill related', '2024-04-10 07:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `help_remarks`
--

CREATE TABLE `help_remarks` (
  `id` int(11) NOT NULL,
  `help` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `help_remarks`
--

INSERT INTO `help_remarks` (`id`, `help`, `type`, `remarks`, `date`) VALUES
(1, 'Slow Internet', 'Internet', '1.	Do a test of your Internet speed.\r\n2.	How to do an internet speed test (speed test)\r\no	Turn off all connections from Wi-Fi and LAN (Computer/Laptop).\r\no	Connect the internet on 1 gadget only.\r\no	Open a website that provides a speed test and then start the speed test process. If the internet speed test results are at least more than 75% of the speed of your package, then the internet is normal.\r\n3.	If the internet speed test results are less than 75% of your package speed, then you restart the', '2024-04-10 07:06:39'),
(2, 'Internet cannot be accessed', 'Internet', 'Make sure all the conditions of the ONT modem indicator light are green.\r\n\r\nIf the Power Indicator Light is Off:\r\n1.	Make sure the ONT modem is connected to the mains or check that the adapter is connected to the mains.\r\n2.	If it doesn\'t turn on, unplug and plug the ONT modem adapter into the electrical connection.\r\n3.	Make sure the power button is ON by pressing the power button on the ONT modem.\r\n4.	If restarting the ONT modem fails, follow the next steps for further handling.\r\nIf the LOS/PON ', '2024-04-10 07:13:01'),
(3, 'All services (internet/tv) not working', 'Internet', '1.	Make sure all the conditions of the ONT modem indicator light are green.\r\n2.	Make sure the ONT modem is connected to a power supply.\r\n3.	If it is not on, do unplug the ONT modem adapter to the mains.\r\n4.	Make sure the power button is ON by pressing the power button on the ONT modem.\r\n5.	Make sure the cable behind the ONT modem is properly connected, that is\r\no	Patch cord / FO cable.\r\no	The telephone cable is connected to the ONT modem port on Phone1/Pots1.\r\no	The LAN cable from the STB is con', '2024-04-10 07:16:08'),
(4, 'Internet is intermittent', 'Internet', '1.	Restart the ONT modem by pressing the power button. Turn it off for about 30 seconds then turn it back on. \r\n2.	If restarting ONT fails, follow the next steps for further handling.', '2024-04-10 07:16:56'),
(5, 'Can\'t pay bills', 'Bills', '1.	Make sure your service number is registered.\r\n2.	Make sure the payment steps taken are in accordance with the selected payment mode.\r\n3.	Try to make payments before the due date.\r\n4.	Change to another payment mode if the existing payment mode still fails.\r\n5.	If the above method still fails, follow the next steps for further handling.', '2024-04-10 07:17:36'),
(6, 'Billing has been paid but the package is still isolated', 'Bills', '1. Make sure you have paid according to the nominal bill\r\n2. Please re-confirm your billing data\r\n3. If the above method still fails, follow the next steps for further handling.', '2024-04-10 07:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `package` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Active',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package`, `price`, `category`, `status`, `date`) VALUES
(1, 'SL LITE 15 Mbps', 699, 'Fiber', 'Active', '2024-04-10 07:00:09'),
(2, 'SL PLUS 30 Mbps', 999, 'Fiber', 'Active', '2024-04-10 07:00:09'),
(3, 'SL MEGA 45 Mbps', 1299, 'Fiber', 'Active', '2024-04-10 07:00:39'),
(4, 'SL XTRA 75 Mbps', 1499, 'Fiber', 'Active', '2024-04-10 07:00:39'),
(5, 'SL TERA 100 Mbps', 1699, 'Fiber', 'Active', '2024-04-10 07:01:06'),
(6, 'SL ULTRA 150 Mbps', 1999, 'Fiber', 'Active', '2024-04-10 07:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `payment_confirmation`
--

CREATE TABLE `payment_confirmation` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `date_payment` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_confirmation`
--

INSERT INTO `payment_confirmation` (`id`, `invoice`, `payment_method`, `date_payment`, `image_path`, `reference_number`, `status`, `date`) VALUES
(1, '148294411', 'Gcash', '2024-04-10', 'proof_of_payment/6616b593252c6-g1.jpg', NULL, 'Approved', '2024-04-10 07:51:47'),
(2, '724869248', 'Gcash', '2024-04-11', 'proof_of_payment/661776d9d7fdb-gcash receipt1.png', NULL, 'Approved', '2024-04-10 21:36:25'),
(3, '204795253', 'Gcash', '2024-04-11', 'proof_of_payment/6617776e8ab45-gcash receipt4.jpg', NULL, 'Pending', '2024-04-10 21:38:54'),
(4, '950001065', 'Gcash', '2024-04-11', 'proof_of_payment/66177a88eaa12-gcash receipt2.jpg', NULL, 'Pending', '2024-04-10 21:52:08'),
(5, '997298423', 'Gcash', '2024-04-11', 'proof_of_payment/661791fb2d0bf-gcash receipt3.jpg', NULL, 'Approved', '2024-04-10 23:32:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_log_activity`
--

CREATE TABLE `user_log_activity` (
  `id` int(11) NOT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `activity` varchar(1000) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log_activity`
--

INSERT INTO `user_log_activity` (`id`, `account_no`, `category`, `activity`, `time`) VALUES
(1, '054745002751816378821949', 'Activity', 'Added package SL LITE 15 Mbps', '2024-04-10 07:40:48'),
(2, '054745002751816378821949', 'Activity', 'Submitted a ticket - Internet / Slow Internet', '2024-04-10 07:46:27'),
(3, '265608270665835741940025', 'Activity', 'Added package SL LITE 15 Mbps', '2024-04-10 10:30:21'),
(4, '054745002751816378821949', 'Activity', 'Submitted a ticket - Bills / Billing has been paid but the package is still isolated', '2024-04-10 21:15:06'),
(5, '054745002751816378821949', 'Activity', 'Submitted a ticket - Others', '2024-04-10 21:16:41'),
(6, '265608270665835741940025', 'Activity', 'Submitted a ticket - Internet / Internet cannot be accessed', '2024-04-10 21:18:51'),
(7, '265608270665835741940025', 'Activity', 'Submitted a ticket - Bills / Can\'t pay bills', '2024-04-10 21:19:44'),
(8, '265608270665835741940025', 'Activity', 'Submitted a ticket - Others', '2024-04-10 21:20:29'),
(9, '265608270665835741940025', 'Activity', 'Added package SL LITE 15 Mbps', '2024-04-10 21:20:57'),
(10, '646975440125929132284548', 'Activity', 'Added package SL LITE 15 Mbps', '2024-04-10 21:24:03'),
(11, '646975440125929132284548', 'Activity', 'Added package SL TERA 100 Mbps', '2024-04-10 21:25:09'),
(12, '646975440125929132284548', 'Activity', 'Added package SL PLUS 30 Mbps', '2024-04-10 21:26:14'),
(13, '646975440125929132284548', 'Activity', 'Added package SL MEGA 45 Mbps', '2024-04-10 21:26:57'),
(14, '646975440125929132284548', 'Activity', 'Submitted a ticket - Internet / All services (internet/tv) not working', '2024-04-10 21:43:23'),
(15, '646975440125929132284548', 'Activity', 'Submitted a ticket - Bills / Billing has been paid but the package is still isolated', '2024-04-10 21:44:39'),
(16, '240487537997979910265071', 'Activity', 'Added package SL MEGA 45 Mbps', '2024-04-10 22:54:51'),
(17, '240487537997979910265071', 'Activity', 'Submitted a ticket - Others', '2024-04-10 23:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_package`
--

CREATE TABLE `user_package` (
  `id` int(11) NOT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `package` varchar(255) DEFAULT NULL,
  `coverage` varchar(255) DEFAULT NULL,
  `selected_date` varchar(255) DEFAULT 'N/A',
  `total` decimal(10,2) DEFAULT NULL,
  `category` varchar(255) DEFAULT 'Fiber',
  `period` varchar(255) DEFAULT NULL,
  `variant` varchar(255) DEFAULT 'false',
  `is_active` varchar(255) DEFAULT 'true',
  `due_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Unpaid',
  `process_status` varchar(255) DEFAULT 'Pending',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_package`
--

INSERT INTO `user_package` (`id`, `account_no`, `invoice`, `package`, `coverage`, `selected_date`, `total`, `category`, `period`, `variant`, `is_active`, `due_date`, `status`, `process_status`, `updated_at`, `date`) VALUES
(1, '054745002751816378821949', '582855194', 'SL ULTRA 150 Mbps', 'ITHAN', 'N/A', 1999.00, 'Fiber', 'May 2024', 'false', 'true', '10 May 2024', 'Unpaid', 'Done', '2024-04-10 07:36:10', '2024-04-10 07:26:54'),
(2, '054745002751816378821949', '148294411', 'SL LITE 15 Mbps', 'LIMBON-LIMBON', 'N/A', 699.00, 'Fiber', 'May 2024', 'false', 'true', '10 May 2024', 'Paid', 'Done', '2024-04-10 07:53:02', '2024-04-10 07:40:48'),
(3, '265608270665835741940025', '950001065', 'SL TERA 100 Mbps', 'KALINAWAN', 'N/A', 1699.00, 'Fiber', 'May 2024', 'false', 'true', '11 May 2024', 'Unpaid', 'Done', '2024-04-10 08:32:49', '2024-04-10 08:30:59'),
(4, '958504089820265537839496', '060922979', 'SL LITE 15 Mbps', 'PILA-PILA', 'N/A', 699.00, 'Fiber', 'May 2024', 'false', 'true', '10 May 2024', 'Unpaid', 'Pending', '2024-04-10 09:31:36', '2024-04-10 08:54:32'),
(5, '646975440125929132284548', '724869248', 'SL ULTRA 150 Mbps', 'PILA-PILA', 'N/A', 1999.00, 'Fiber', 'May 2024', 'false', 'true', '10 May 2024', 'Paid', 'Done', '2024-04-10 21:36:56', '2024-04-10 09:03:35'),
(6, '265608270665835741940025', '512218279', 'SL TERA 100 Mbps', 'KALINAWAN', 'N/A', 1699.00, 'Fiber', 'Jul 2024', 'true', 'true', '11 Jul 2024', 'Paid', 'Done', '2024-04-10 10:19:47', '2024-04-10 10:19:47'),
(7, '265608270665835741940025', '826809536', 'SL TERA 100 Mbps', 'KALINAWAN', 'N/A', 1699.00, 'Fiber', 'Jun 2024', 'true', 'true', '11 Jun 2024', 'Paid', 'Done', '2024-04-10 10:22:42', '2024-04-10 10:22:42'),
(8, '265608270665835741940025', '978941207', 'SL LITE 15 Mbps', 'KALINAWAN', 'N/A', 699.00, 'Fiber', 'May 2024', 'false', 'true', '11 May 2024', 'Unpaid', 'Done', '2024-04-10 10:30:54', '2024-04-10 10:30:21'),
(9, '265608270665835741940025', '157625793', 'SL LITE 15 Mbps', 'LIMBON-LIMBON', 'N/A', 699.00, 'Fiber', 'May 2024', 'false', 'true', '11 May 2024', 'Unpaid', 'Pending', '2024-04-10 21:20:57', '2024-04-10 21:20:57'),
(10, '646975440125929132284548', '927227440', 'SL LITE 15 Mbps', 'KALINAWAN', 'N/A', 699.00, 'Fiber', 'May 2024', 'false', 'true', '11 May 2024', 'Unpaid', 'Pending', '2024-04-10 21:24:03', '2024-04-10 21:24:03'),
(11, '646975440125929132284548', '204795253', 'SL TERA 100 Mbps', 'GUPIING', 'N/A', 1699.00, 'Fiber', 'May 2024', 'false', 'true', '11 May 2024', 'Unpaid', 'Done', '2024-04-10 21:27:17', '2024-04-10 21:25:09'),
(12, '646975440125929132284548', '276782044', 'SL PLUS 30 Mbps', 'LUNSAD', 'N/A', 999.00, 'Fiber', 'May 2024', 'false', 'true', '11 May 2024', 'Unpaid', 'Process', '2024-04-10 21:27:46', '2024-04-10 21:26:14'),
(13, '646975440125929132284548', '997080958', 'SL MEGA 45 Mbps', 'PILA-PILA', 'N/A', 1299.00, 'Fiber', 'May 2024', 'false', 'true', '11 May 2024', 'Unpaid', 'Pending', '2024-04-10 21:26:57', '2024-04-10 21:26:57'),
(14, '240487537997979910265071', '997298423', 'SL ULTRA 150 Mbps', 'ITHAN', 'N/A', 1999.00, 'Fiber', 'May 2024', 'false', 'true', '11 May 2024', 'Paid', 'Done', '2024-04-10 23:33:04', '2024-04-10 22:49:20'),
(15, '240487537997979910265071', '515893344', 'SL MEGA 45 Mbps', 'LIMBON-LIMBON', 'N/A', 1299.00, 'Fiber', 'May 2024', 'false', 'true', '11 May 2024', 'Unpaid', 'Pending', '2024-04-10 22:54:51', '2024-04-10 22:54:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_log_activity`
--
ALTER TABLE `admin_log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coverage`
--
ALTER TABLE `coverage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_ticket`
--
ALTER TABLE `customer_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_category`
--
ALTER TABLE `help_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_remarks`
--
ALTER TABLE `help_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_confirmation`
--
ALTER TABLE `payment_confirmation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_log_activity`
--
ALTER TABLE `user_log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_package`
--
ALTER TABLE `user_package`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `admin_log_activity`
--
ALTER TABLE `admin_log_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coverage`
--
ALTER TABLE `coverage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_ticket`
--
ALTER TABLE `customer_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `help_category`
--
ALTER TABLE `help_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `help_remarks`
--
ALTER TABLE `help_remarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_confirmation`
--
ALTER TABLE `payment_confirmation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_log_activity`
--
ALTER TABLE `user_log_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_package`
--
ALTER TABLE `user_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
