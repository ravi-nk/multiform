-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2021 at 03:09 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multiform`
--

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `pdf` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `first_name`, `last_name`, `password`, `pdf`, `email`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Ravi', 'Kumar', '1234', 'C:fakepathlaravel-interview-questions.pdf', 'ravichoudhary33366@gmail.com', 'male', '2021-01-28 13:50:49', '2021-01-28 13:50:49'),
(2, 'Ravi', 'Kumar', '1234', 'C:fakepathlaravel-interview-questions.pdf', 'ravichoudhary33366@gmail.com', 'male', '2021-01-28 14:01:41', '2021-01-28 14:01:41'),
(3, 'Ravi', 'Kumar', '1234', 'C:fakepathlaravel-interview-questions.pdf', 'ravichoudhary33366@gmail.com', 'male', '2021-01-28 14:05:40', '2021-01-28 14:05:40'),
(4, 'Ravi', 'Kumar', '1234', 'C:fakepathlaravel-interview-questions.pdf', 'ravichoudhary33366@gmail.com', 'male', '2021-01-28 14:08:03', '2021-01-28 14:08:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
