-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 12, 2024 at 03:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `News`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Id` int(11) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id`, `Name`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(1, 'Technology', 'Latest in tech world', '2024-02-04 16:14:00', NULL, 1),
(2, 'Sports', 'Exciting sports updates', '2024-02-04 16:14:00', NULL, 1),
(3, 'Science', 'Scientific discoveries and news', '2024-02-04 16:14:00', NULL, 1),
(4, 'Entertainment', 'Entertainment industry buzz', '2024-02-04 16:14:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Id` int(11) NOT NULL,
  `PostId` int(11) DEFAULT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `Comment` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`Id`, `PostId`, `Name`, `Email`, `Comment`, `PostingDate`, `Status`) VALUES
(1, 1, 'John Doe', 'john@example.com', 'Great news!', '2024-02-04 16:14:00', 1),
(2, 2, 'Alice Smith', 'alice@example.com', 'Interesting article!', '2024-02-04 16:14:00', 1),
(3, 3, 'Bob Johnson', 'bob@example.com', 'Looking forward to more updates!', '2024-02-04 16:14:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `subcategory` varchar(50) DEFAULT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_approved` tinyint(1) DEFAULT 0,
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `category`, `subcategory`, `content`, `image_url`, `date_posted`, `is_approved`, `views`) VALUES
(1, 'Exciting News 1', 'Technology', 'Gadgets', 'In a highly anticipated event, tech giant InnovateCorp has unveiled its latest smartphone model, the Titan X. Packed with groundbreaking features and cutting-edge technology, the Titan X promises to redefine the smartphone experience. With its sleek design and advanced camera capabilities, users can capture stunning photos and videos in any environment. Equipped with an ultra-fast processor and immersive display, the Titan X offers seamless multitasking and an unparalleled gaming experience. Tech enthusiasts worldwide are eagerly awaiting the release of the Titan X, which is set to hit store shelves next month.', 'https://www.shutterstock.com/image-photo/gadgets-accessories-isolated-on-white-260nw-1248412693.jpg', '2024-02-02 13:31:42', 1, 0),
(2, 'Breaking News 2', 'Sports', 'Football', ' that superstar forward Alex Rodriguez has completed a historic move to rival club Manchester United for a staggering £150 million. This jaw-dropping transfer fee smashes previous records and solidifies Rodriguez\'s status as one of the most sought-after players in the world. With his exceptional talent and goal-scoring prowess, Rodriguez is poised to make an immediate impact on his new team, while fans eagerly anticipate witnessing his debut in the iconic red jersey. The ripple effects of this blockbuster transfer are sure to be felt across the football landscape, as clubs scramble to adjust their strategies in response to this game-changing move', 'https://ichef.bbci.co.uk/ace/standard/480/cpsprodpb/13990/production/_132527208_p0h8gzwd.jpg', '2024-02-02 13:31:42', 1, 0),
(3, 'Important Update 3', 'Science', 'Space', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', 'https://i0.wp.com/spacenews.com/wp-content/uploads/2024/01/rsz_1screenshot_2024-01-31_at_95949_pm.png?resize=600%2C450&ssl=1', '2024-02-02 13:31:42', 0, 0),
(4, 'Local Event 4', 'Entertainment', 'Music', 'Fans of classic rock music have reason to celebrate as the iconic band, Electric Echoes, has officially announced their highly anticipated reunion tour. After decades apart, the original members of Electric Echoes, known for their chart-topping hits and electrifying live performances, are coming together once again to rock the stage. The reunion tour, set to kick off next summer, will feature stops in major cities across the globe, giving fans everywhere the chance to experience the magic of Electric Echoes live in concert. With tickets expected to sell out fast, loyal fans are eagerly awaiting the opportunity to secure their spot at what promises to be the concert event of the year.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSMtyJ3ARofj8yjNEl1kseUmY-iB8NzStSMtw&usqp=CAU', '2024-02-02 13:31:42', 1, 0),
(5, 'New Discovery 5', 'Science', 'Biology', 'The World Health Organization (WHO) has issued a stark warning about a potential new pandemic threat emerging in Southeast Asia. According to WHO officials, a novel strain of influenza virus has been detected in the region, raising concerns about its potential to spread rapidly and cause widespread illness. With the recent memories of the COVID-19 pandemic still fresh, health authorities are closely monitoring the situation and taking proactive measures to prevent the spread of the new virus. Efforts are underway to develop vaccines and implement public health measures to mitigate the risk of a global outbreak. As the world grapples with the ongoing challenges of COVID-19, the emergence of a new pandemic threat serves as a', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBZ__tNXH1kbhUs76qgqiFbJdWop5FWBjYgA&usqp=CAU', '2024-02-02 13:31:42', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `Id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`Id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES
(1, 'About Us', 'Learn about our team', 'Welcome to our news platform. Explore the latest happenings in various categories.', '2024-02-04 16:14:00', NULL),
(2, 'Contact Us', 'Get in touch with us', 'Have any questions or feedback? Contact us here.', '2024-02-04 16:14:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `viewCounter`, `postedBy`, `lastUpdatedBy`) VALUES
(1, 'Exciting Technology News', 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in ex non orci fermentum varius eget vitae odio.', '2024-02-04 16:14:00', NULL, 1, 'exciting-technology-news', 'tech-news.jpg', 120, 'Admin', NULL),
(2, 'Thrilling Football Match', 2, 3, 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', '2024-02-04 16:14:00', NULL, 1, 'thrilling-football-match', 'football-match.jpg', 75, 'Admin', NULL),
(3, 'Space Exploration Update', 3, 6, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2024-02-04 16:14:00', NULL, 1, 'space-exploration-update', 'space.jpg', 90, 'Admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `Id` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`Id`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(1, 1, 'Gadgets', 'Latest gadgets and tech accessories', '2024-02-04 16:14:00', NULL, 1),
(2, 2, 'Football', 'Football-related updates and news', '2024-02-04 16:14:00', NULL, 1),
(3, 3, 'Space', 'News about space exploration and discoveries', '2024-02-04 16:14:00', NULL, 1),
(4, 4, 'Music', 'Latest music events and releases', '2024-02-04 16:14:00', NULL, 1),
(5, 1, 'Mobiles', 'Updates on new mobile phones and technologies', '2024-02-04 16:14:00', NULL, 1),
(6, 3, 'Biology', 'Biology-related news and discoveries', '2024-02-04 16:14:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `Role` enum('admin','subadmin','user') DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Name`, `Password`, `EmailId`, `Role`, `Date`) VALUES
(1, 'Vedant', 'Vedant', 'vedqntgohel@gmail.com', 'admin', '2024-01-31 20:42:24'),
(2, 'Dhruv', 'Dhruv', 'dhruv@gmail.com', 'user', '2024-01-31 20:42:24'),
(12, 'madam', 'madam', 'madam@gmail.com', 'user', '2024-02-12 14:04:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
