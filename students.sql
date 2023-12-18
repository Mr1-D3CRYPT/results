-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 05:35 PM
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
-- Database: `results`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `userid` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `math` int(11) NOT NULL,
  `english` int(11) NOT NULL,
  `biology` int(11) NOT NULL,
  `chemistry` int(11) NOT NULL,
  `physics` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `grade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`userid`, `name`, `dob`, `math`, `english`, `biology`, `chemistry`, `physics`, `total`, `percentage`, `grade`) VALUES
(101, 'Ashish Tho', '2002-03-21', 90, 98, 95, 91, 94, 468, 94, 'A'),
(102, 'Aston Varg', '2002-04-01', 85, 86, 90, 90, 89, 440, 88, 'B'),
(103, 'Bibek Tom', '2002-07-11', 79, 89, 91, 91, 91, 441, 88, 'B'),
(104, 'Hardik Pan', '2001-07-12', 45, 81, 80, 55, 70, 331, 66, 'D'),
(105, 'Krunal Pan', '2003-05-30', 75, 78, 57, 72, 71, 353, 71, 'C'),
(106, 'Sures Rain', '2002-02-01', 99, 97, 92, 98, 97, 483, 97, 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
