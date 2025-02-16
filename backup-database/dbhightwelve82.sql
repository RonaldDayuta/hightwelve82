-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 10:36 AM
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
-- Database: `dbhightwelve82`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `WebPosition` varchar(255) NOT NULL,
  `Profile` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`ID`, `Username`, `Email`, `Password`, `WebPosition`, `Profile`, `Status`) VALUES
(8, 'GrandMaster', 'GrandMaster@gmail.com', 'Z2srK7xCAy72zT+ggHo6OA==', 'Admin', 'ProfileUpload/profile_67b13422223129.02474964.png', 'Active'),
(9, '', 'user@gmail.com', 'Z2srK7xCAy72zT+ggHo6OA==', 'User', 'img/logo.png', 'Active'),
(10, '', 'user1@gmail.com', 'Z2srK7xCAy72zT+ggHo6OA==', 'User', 'img/logo.png', 'Active'),
(11, '', 'ronaldcristiandayuta@gmail.com', 'Z2srK7xCAy72zT+ggHo6OA==', 'User', 'ProfileUpload/profile_67b19d8a190779.21481105.jpg', 'Active'),
(12, '', 'ronaldcristiandayuta@gmail.com', 'Z2srK7xCAy72zT+ggHo6OA==', 'User', 'ProfileUpload/profile_67b19d8bec74f6.48429137.jpg', 'Active'),
(13, '', 'ronaldcristiandayuta@gmail.com', 'Z2srK7xCAy72zT+ggHo6OA==', 'User', 'ProfileUpload/profile_67b19e414ffe92.23242862.jpg', 'Active'),
(14, 'arsidevs', 'ronaldcristiandayuta@gmail.com', 'Z2srK7xCAy72zT+ggHo6OA==', 'User', '../ProfileUpload/profile_67b1ac36819d51.01173379.jpg', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
