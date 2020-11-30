-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2020 at 02:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bacs`
--

-- --------------------------------------------------------

--
-- Table structure for table `import_ll`
--

CREATE TABLE `import_ll` (
  `id` int(255) NOT NULL,
  `document_location` varchar(255) NOT NULL,
  `document_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_comments`
--

CREATE TABLE `user_comments` (
  `id` int(255) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `commentfield` varchar(255) NOT NULL,
  `commentby` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `ll`
--

CREATE TABLE `ll` (
  `document_no` varchar(255) NOT NULL COMMENT 'primary key',
  `ref_no` varchar(255) NOT NULL COMMENT 'imported_original_ll_no',
  `delivery_team` varchar(255) NOT NULL COMMENT 'delivery_team',
  `location` varchar(255) NOT NULL COMMENT 'location',
  `date_issued` varchar(255) NOT NULL COMMENT 'date_issued',
  `ll_title` varchar(255) NOT NULL COMMENT 'll_title',
  `ll_description` varchar(255) NOT NULL COMMENT 'll_description',
  `causes_findings` varchar(255) NOT NULL COMMENT 'causes_findings',
  `corrective_actions` varchar(255) NOT NULL COMMENT 'corrective_actions',
  `before_attachment` varchar(255) NOT NULL COMMENT 'before_photo_attachment',
  `after_attachment` varchar(255) NOT NULL COMMENT 'after_photo_attachment',
  `submitted_by` varchar(255) NOT NULL COMMENT 'submitted_by',
  `document_status` varchar(255) NOT NULL COMMENT 'document_status',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='datatable demo table';

-- --------------------------------------------------------
--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_hint` varchar(255) NOT NULL,
  `employeename` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `delivery_team` varchar(255) NOT NULL,
  `functional_group` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` text NOT NULL,
  `additional_details` varchar(255) NOT NULL,
  `account_status` text NOT NULL,
  `disable_comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `password_hint`, `employeename`, `employee_id`, `position`, `delivery_team`, `functional_group`, `email`, `user_type`, `additional_details`, `account_status`, `disable_comment`) VALUES
('superadmin', '1234', '2333', 'admin', '0', 'admin', 'admin', 'test', 'bacsquality@gmail.com', 'admin', '', 'Enabled', ''),


--
-- Indexes for table `import_ll`
--
ALTER TABLE `import_ll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_comments`
--
ALTER TABLE `user_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ll`
--
ALTER TABLE `ll`
  ADD PRIMARY KEY (`document_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for table `import_ll`
--
ALTER TABLE `import_ll`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `user_comments`
--
ALTER TABLE `user_comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;