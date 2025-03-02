-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2025 at 06:55 AM
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
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`ID`, `Username`, `profile`, `description`, `post_image`, `date`) VALUES
(25, 'arsidevs', '../ProfileUpload/67bdeb7358092_ako.jfif', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', '[\"../post/post_67bee7afa88e33.45970626.jpg\"]', '2025-02-26 18:06:39'),
(26, 'arsidevs', '../ProfileUpload/67bdeb7358092_ako.jfif', '🕊 In Memoriam: Honoring the Life of [Member\'s Name]\r\n\r\nMarch [Date], 2025 – Downtown City\r\n\r\nWith heavy hearts, the members of High Twelve Lodge No. 82 mourn the passing of our beloved brother, [Member’s Name], who departed this life on [Date]. His unwavering dedication, service, and brotherhood have left a lasting mark on our Lodge and in the hearts of all who knew him.\r\n\r\n[Member’s Name] was a true embodiment of our Masonic values—loyal, compassionate, and always willing to extend a helping hand. His contributions to the Lodge, both in leadership and fellowship, will be cherished and remembered.\r\n\r\n“Our brotherhood has lost a remarkable soul,” said Worshipful Master [Insert Name]. “His kindness, wisdom, and commitment to our principles will never be forgotten.”\r\n\r\nA Masonic memorial service will be held on [Date] at [Time], at [Location], where we will gather to honor his life and legacy. All brethren and loved ones are invited to join us in remembering a great man and Mason.\r\n\r\nAs we grieve, let us also celebrate the impact he made and uphold the principles he lived by. Rest in peace, dear brother. Your light will continue to shine in our hearts.\r\n\r\n#InMemoriam #HighTwelveLodge82 #RestInPeace #BrotherhoodForever', '[\"../post/post_67c2c05160b680.20431287.jpg\"]', '2025-03-01 16:07:45'),
(27, 'arsidevs', '../ProfileUpload/67bdeb7358092_ako.jfif', 'test post', '[\"../post/post_67c3ded6119911.32720795.jpg\"]', '2025-03-02 12:30:14'),
(28, 'ARSIDEVS', '../ProfileUpload/67bdeb7358092_ako.jfif', 'test', '[\"../post/post_67c3f06353a773.83547748.png\"]', '2025-03-02 13:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `Username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Password` varchar(255) NOT NULL,
  `WebPosition` varchar(255) NOT NULL,
  `Profile` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Active',
  `is_hidden` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`ID`, `first_name`, `middle_name`, `last_name`, `suffix`, `Username`, `Email`, `Password`, `WebPosition`, `Profile`, `Status`, `is_hidden`) VALUES
(29, 'RONALD CRISTIAN', 'COMBATE', 'DAYUTA', 'III', 'arsidevs', 'ronaldcristiandayuta@gmail.com', '$2y$10$gIj5CXLITeH4NrGlWiC2duXEdvuaQdwCIaNDox7Os/CADVkt69e0.', 'Admin', '../ProfileUpload/67bdeb7358092_ako.jfif', 'Active', 0),
(31, 'Arsi', 'Combate', 'Mateo', 'N/A', 'arsi_devs', 'arsimateo@gmail.com', '$2y$10$1cyyMAGx2M1WAHUBMWHf3eyryZCRT/dQEudFoDlU0iO3p2F3nYqJK', 'Admin', '../ProfileUpload/profile_67beedca81b814.95359974.jpg', 'Active', 1),
(33, 'Ronald Cristian', 'Combate', 'Dayuta', 'N/A', 'user', 'ronaldcristiandayuta27@gmail.com', '$2y$10$lbKMf0CYLH2j/GIGya61W.aewWn/lM71epYqCiSThL47XA0KugPxS', 'User', '../ProfileUpload/profile_67c289b23f5d88.30588466.jpg', 'Active', 0),
(39, 'Ronald Cristian', 'Combate', 'Dayuta', 'N/A', 'arsi', 'dayutaronaldcristian_bsit@plmun.edu.ph', '$2y$10$cpQvoJ5X3YmT6GO5XGYzLuvzjeAVlblyp/o0YVyvbSbGpeUKPukWy', 'Admin', '../ProfileUpload/profile_67c3bfe1984d29.64652053.jpg', 'Active', 0);

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
(18, '2025-02-28', 'ASD', 'ASD', 'events', 'both', 'less-priority', '../uploads/event_67bf3e1b09a665.63656694.jpg'),
(21, '2025-02-27', 'dasda', 'asdasd', 'events', 'both', 'top-priority', '../uploads/event_67c01cfb33b162.75436898.jpg'),
(22, '2025-02-27', 'asdad', 'asdad', 'events', 'internal', 'top-priority', ''),
(23, '2025-02-27', 'test news', 'test news', 'news-today', 'both', 'top-priority', ''),
(24, '2025-02-27', 'test news', 'test news', 'news-today', 'both', 'top-priority', ''),
(25, '2025-02-28', 'test news', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'news-today', 'both', 'top-priority', '../uploads/event_67c11cb68ec1b0.80588051.png'),
(28, '2025-02-27', 'test meeting', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'meeting', 'both', 'top-priority', '../uploads/event_67c04385062354.29349941.jpg'),
(29, '2025-02-27', 'test meeting', 'test meeting', 'meeting', 'both', 'top-priority', '../uploads/event_67c043dea338b8.88324829.jpg'),
(30, '2025-02-28', 'test meeting', 'test meeting', 'meeting', 'internal', 'top-priority', '../uploads/event_67c04438b68a12.33716481.jpg'),
(32, '2025-02-28', 'dasdada', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors', 'events', 'both', 'top-priority', '../uploads/event_67c14343b5c911.93123156.jpg'),
(36, '2025-03-01', 'test event', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'events', 'both', 'top-priority', '../uploads/event_67c27f0d7c4394.73232540.jpg'),
(37, '2025-03-01', 'test', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'events', 'internal', 'top-priority', '../uploads/event_67c2806f9fc530.33723336.jpg'),
(38, '2025-03-01', 'Meeting', '📢 Meeting Alert! 📢\r\n\r\n🗓 Date: March 2, 2025\r\n📍 Location: XYZ Conference Hall, Manila\r\n⏰ Time: 10:00 AM - 12:00 PM\r\n🎯 Purpose: Project Planning & Progress Update\r\n\r\nLet’s collaborate, share insights, and align our goals for success! See you there! 👥✅\r\n\r\n#TeamMeeting #ProjectPlanning #Collaboration', 'meeting', 'internal', 'top-priority', '../uploads/event_67c2959cbe5bb5.08729392.png'),
(39, '2025-03-02', 'test', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'events', 'both', 'top-priority', '../uploads/event_67c2a79b30f930.28248002.png'),
(40, '2025-03-03', 'TEST', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'news-today', 'internal', 'top-priority', '../uploads/event_67c2a7d8408dd8.23607359.png'),
(41, '2025-03-04', 'Outreach Program', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'events', 'both', 'top-priority', '../uploads/event_67c2aa28be2f97.56257278.jpg'),
(42, '2025-03-02', 'Event Both Internal and External', '📅 Date: March 2, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'events', 'both', 'top-priority', '../uploads/event_67c2c4accc3a95.28780459.png');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tblofficers`
--
ALTER TABLE `tblofficers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
