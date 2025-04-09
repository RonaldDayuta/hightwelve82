-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 01:24 PM
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
  `post_image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`ID`, `Username`, `profile`, `description`, `post_image`, `date`) VALUES
(58, 'ADMIN', '../ProfileUpload/67bd8d3fab799_Lodge Logo.png', 'Admin', '[\"../post/post_67c402aa5ad5b1.19199522.png\"]', '2025-03-02 07:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(255) NOT NULL,
  `id2` int(255) NOT NULL DEFAULT 0,
  `foldername` varchar(255) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `id2`, `foldername`, `dateadded`) VALUES
(2295210, 0, 'Mar 2025', '2025-04-08 07:57:22'),
(10523743, 0, 'Apr 2025', '2025-04-08 19:17:34'),
(10555320, 0, 'Jan 2025', '2025-04-08 19:17:36'),
(10571057, 0, 'May 2025', '2025-04-08 19:17:39'),
(10607937, 0, 'June 2025', '2025-04-08 19:17:41'),
(11208719, 0, 'Jul 2025', '2025-04-08 19:18:53'),
(11369709, 0, 'Aug 2025', '2025-04-08 19:19:04'),
(11469229, 0, 'Sep 2025', '2025-04-08 19:19:13'),
(11662856, 0, 'Oct 2025', '2025-04-08 19:19:33'),
(11764362, 0, 'Nov 2025', '2025-04-08 19:19:40'),
(11821241, 0, 'Dec 2025', '2025-04-08 19:19:48'),
(51984640, 0, 'Feb 2025', '2025-04-08 06:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `pdffile`
--

CREATE TABLE `pdffile` (
  `folderid` varchar(255) NOT NULL,
  `fileid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `Username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Password` varchar(255) NOT NULL,
  `WebPosition` varchar(255) NOT NULL,
  `Profile` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Active',
  `is_hidden` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`ID`, `first_name`, `middle_name`, `last_name`, `suffix`, `Username`, `Email`, `Password`, `WebPosition`, `Profile`, `Status`, `is_hidden`) VALUES
(37, 'Admin', 'A', 'Admin', 'N/A', 'Admin', 'christiandumangas15@gmail.com', '$2y$10$OfJMnkTaHpkcV4zVOp1TKeiZp7gBH7oYGrYBzs1EZAMJZ6vNONJvO', 'Admin', '../ProfileUpload/67bd8d3fab799_Lodge Logo.png', 'Active', 0);

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
(138, '2025-02-28', 'Event', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'events', 'both', 'top-priority', '../uploads/event_67c1479dde1b90.37637043.jpg'),
(139, '2025-02-28', 'News', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'news-today', 'both', 'top-priority', '../uploads/event_67c1450591bb16.38735783.jpg'),
(140, '2025-02-28', 'Meeting', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'meeting', 'both', 'top-priority', '../uploads/event_67c145704a3009.35562047.jpg'),
(141, '2025-02-28', 'Activities', '📅 Date: February 28, 2025\r\n📍 Location: [Venue/Community Name]\r\n⏰ Time: [Start Time – End Time]\r\n\r\nWe are thrilled to share that our Outreach Program held on February 28, 2025, was a great success! 🎉 Through the collective efforts of our volunteers and donors, we were able to extend support to [beneficiaries], providing [e.g., food, school supplies, medical assistance, educational activities].\r\n\r\n🤝 Thank You!\r\nA heartfelt thank you to everyone who participated, donated, and supported this initiative. Your kindness and generosity made a meaningful impact on the lives of those in need.\r\n\r\nLet’s continue working together to create positive change! Stay tuned for our next outreach activity.\r\n\r\n#OutreachProgram #CommunityService #MakingADifference #ThankYou', 'activities', 'both', 'top-priority', '../uploads/event_67c1458bad7ce9.57515829.jpg'),
(154, '2025-03-03', 'asdf', 'asdfasdf\r\nasdfasdffadfasdfasdfasdfasdf\r\nasdfasdffasdf\r\nasdfasdf\r\nasdfasdfasdf\r\nasdfasdf\r\nasdfasdf\r\nasdff\r\nasfasdffasdf\r\nasdfa\r\nsdf\r\nasdfasdf', 'news-today', 'both', 'top-priority', '../uploads/event_67c5089b179f40.31288333.png'),
(155, '2025-03-03', 'asdfasdf', '📰 High Twelve Lodge No. 82 Gears Up for Grand Anniversary Celebration 🎉\r\n\r\nMarch 2, 2025 – Downtown City\r\n\r\nHigh Twelve Lodge No. 82 held a crucial meeting at the Grand Masonic Hall in Downtown City, setting the stage for its much-anticipated anniversary celebration. Members gathered to discuss event preparations, ensuring that this milestone will be a memorable occasion.\r\n\r\nLodge leaders outlined key plans, including the venue selection, guest invitations, and a lineup of special activities to honor the Lodge’s rich history and contributions. The budget and logistics were also reviewed, with committees assigned to handle various aspects of the celebration.\r\n\r\n“We are excited to celebrate another year of brotherhood, service, and tradition,” said Worshipful Master [Insert Name]. “This event will be a testament to the dedication and unity of our members.”\r\n\r\nThe meeting concluded with an open forum, allowing members to share their ideas and suggestions for the big day. With strong enthusiasm and teamwork, High Twelve Lodge No. 82 is set to mark its anniversary with a grand and meaningful event.\r\n\r\nStay tuned for more updates as the celebration approaches! 🎊', 'events', 'both', 'top-priority', '../uploads/event_67c52938741d52.57106036.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficers`
--

CREATE TABLE `tblofficers` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `PosDecs` text NOT NULL,
  `PositionNumber` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblofficers`
--

INSERT INTO `tblofficers` (`ID`, `Name`, `Position`, `PosDecs`, `PositionNumber`, `Image`) VALUES
(64, 'Bro. Victor Roman C. Cacal', 'Senior Warden', 'Senior Warden', 2, '../Officerimage/officer_67f28219df0999.77379758.png'),
(65, 'Bro. Faustino B. Austria Jr.', 'Junior Warden', 'Junior Warden\r\n', 3, '../Officerimage/officer_67f284b51e8249.88557795.png'),
(70, 'Bro. Aguinaldo S. Sepnio', 'Worshipful Master', 'Worshipful Master', 1, '../Officerimage/officer_67f457ec3fff68.72473908.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdffile`
--
ALTER TABLE `pdffile`
  ADD PRIMARY KEY (`fileid`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `tblofficers`
--
ALTER TABLE `tblofficers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
