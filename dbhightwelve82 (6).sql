-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 05:59 PM
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
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`ID`, `Username`, `profile`, `description`, `post_image`, `date`) VALUES
(25, 'arsidevs', '../ProfileUpload/67bdeb7358092_ako.jfif', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', '[\"../post/post_67bee7afa88e33.45970626.jpg\"]', '2025-02-26 10:06:39');

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
  `Status` varchar(255) NOT NULL DEFAULT 'Active',
  `is_hidden` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`ID`, `Username`, `Email`, `Password`, `WebPosition`, `Profile`, `Status`, `is_hidden`) VALUES
(29, 'arsidevs', 'ronaldcristiandayuta@gmail.com', '$2y$10$gIj5CXLITeH4NrGlWiC2duXEdvuaQdwCIaNDox7Os/CADVkt69e0.', 'Admin', '../ProfileUpload/67bdeb7358092_ako.jfif', 'Active', 0),
(30, 'user', 'ronaldcristiandayuta27@gmail.com', '$2y$10$4kUMbxrqqSyjdmNNCVfr7OwQs.e2Nyw9efuSe8rhIj47O4JT1RVUS', 'User', '../ProfileUpload/profile_67bdf3dc36e912.41033006.jpg', 'Active', 0),
(31, 'arsi_devs', 'arsimateo@gmail.com', '$2y$10$1cyyMAGx2M1WAHUBMWHf3eyryZCRT/dQEudFoDlU0iO3p2F3nYqJK', 'Admin', '../ProfileUpload/profile_67beedca81b814.95359974.jpg', 'Active', 1),
(32, 'dayuta', 'dayutaronaldcristian_bsit@plmun.edu.ph', '$2y$10$L2po2BrpuuC/l/JtwotOy.tJA25kRlhq0KmOJoGcuQwSnBE79Ha8O', 'Admin', '../ProfileUpload/profile_67bef5dfaae6a1.09198396.jpg', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblevents`
--

CREATE TABLE `tblevents` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `post_category` varchar(255) NOT NULL,
  `priority_category` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblevents`
--

INSERT INTO `tblevents` (`id`, `event_date`, `title`, `description`, `category`, `post_category`, `priority_category`, `image`) VALUES
(13, '2025-02-23', 'test', 'test', 'events', 'both', 'less-priority', ''),
(17, '2025-02-28', 'TEST', 'TEST', 'events', 'both', 'top-priority', '../uploads/event_67bf3dd1d2c258.40884181.jpg'),
(18, '2025-02-28', 'ASD', 'ASD', 'events', 'both', 'less-priority', '../uploads/event_67bf3e1b09a665.63656694.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficers`
--

CREATE TABLE `tblofficers` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `PosDecs` text NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblofficers`
--

INSERT INTO `tblofficers` (`ID`, `Name`, `Position`, `PosDecs`, `Image`) VALUES
(10, 'Bro. Aguinaldo S. Sepnio', 'Worshipful Master', 'Worshipful Master', ''),
(12, 'Bro. Victor Roman C. Cacal', 'Senior Warden', 'Senior Warden', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblevents`
--
ALTER TABLE `tblevents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblofficers`
--
ALTER TABLE `tblofficers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblofficers`
--
ALTER TABLE `tblofficers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
