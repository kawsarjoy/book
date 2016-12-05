-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2016 at 08:53 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comicbook_fansite`
--

-- --------------------------------------------------------

--
-- Table structure for table `comic_character`
--

CREATE TABLE `comic_character` (
  `character_id` int(10) UNSIGNED NOT NULL,
  `alias` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `real_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lair_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `alignment` enum('good','evil') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'good'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comic_character_power`
--

CREATE TABLE `comic_character_power` (
  `character_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `power_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comic_lair`
--

CREATE TABLE `comic_lair` (
  `lair_id` int(10) UNSIGNED NOT NULL,
  `zipcode_id` char(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '00000',
  `address` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comic_power`
--

CREATE TABLE `comic_power` (
  `power_id` int(10) UNSIGNED NOT NULL,
  `power` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comic_power`
--

INSERT INTO `comic_power` (`power_id`, `power`) VALUES
(1, 'invisibility'),
(2, 'speed'),
(3, 'fly'),
(4, 'jump'),
(5, 'climb'),
(6, 'carate'),
(7, 'hammer'),
(8, 'flexibility'),
(9, 'humar'),
(10, 'fedfe'),
(11, 'fdsfsadf'),
(12, 'dffvdfvds'),
(13, 'vdsvdsf'),
(14, 'dfdsfds'),
(15, 'dfsdf'),
(16, 'fdsfae'),
(17, 'fsfasf'),
(18, 'safas'),
(19, 'dfasf'),
(20, 'fsadfsf'),
(21, 'fsafasf'),
(22, 'fasdfasf'),
(23, 'asfasf'),
(24, 'fasfs'),
(25, 'fasfas'),
(26, 'fasfs'),
(27, 'afasfasf'),
(28, 'dsfadf'),
(29, 'dfdsfasdf'),
(30, 'safsafas'),
(31, 'dsfadsfadsf'),
(32, 'dsfadsfd'),
(33, 'fdasfdasf'),
(34, 'fdsafas'),
(35, 'fdsafdas'),
(36, 'fsafasf'),
(37, 'fsdasfads'),
(38, 'fasfsf'),
(39, 'fasdfas'),
(40, 'fsdfdasf'),
(41, 'fasfsd');

-- --------------------------------------------------------

--
-- Table structure for table `comic_rivalry`
--

CREATE TABLE `comic_rivalry` (
  `hero_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `villain_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comic_zipcode`
--

CREATE TABLE `comic_zipcode` (
  `zipcode_id` char(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '00000',
  `city` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `state` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comic_zipcode`
--

INSERT INTO `comic_zipcode` (`zipcode_id`, `city`, `state`) VALUES
('fdsaf', 'fdsfsdfdsa', 'fs');

-- --------------------------------------------------------

--
-- Table structure for table `site_user`
--

CREATE TABLE `site_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(41) COLLATE utf8_unicode_ci NOT NULL,
  `admin_level` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_user`
--

INSERT INTO `site_user` (`user_id`, `username`, `password`, `admin_level`) VALUES
(1, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 1),
(2, 'user', '*D5D9F81F5542DE067FFF5FF7A4CA4BDD322C578F', 0),
(9, 'kawsar', '12345', 0),
(8, 'kawsar.diu', '12345', 0),
(10, 'kawsar.joy', '12345', 0),
(11, 'joy', '12345', 0),
(12, 'refat', '*00A51F3F48415C7D4E8908980D443C29C69B60C9', 0),
(13, 'sapo', '*00A51F3F48415C7D4E8908980D443C29C69B60C9', 0),
(14, 'utpal', '*00A51F3F48415C7D4E8908980D443C29C69B60C9', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_user_info`
--

CREATE TABLE `site_user_info` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hobbies` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_user_info`
--

INSERT INTO `site_user_info` (`user_id`, `first_name`, `last_name`, `email`, `city`, `state`, `hobbies`) VALUES
(1, '<br /><b>Notice</b>:', 'ADMIN', 'admin@gmail.com', 'Comilla', 'Ch', ''),
(2, 'SUPER', 'user', 'user@gmail.com', NULL, NULL, NULL),
(8, 'Mohammd Abu', 'Kawsar', 'kawsarjoydiu@gmail.c', 'Dhaka', 'Dh', 'Conputers, Exercise, Internet, Reading, Traveling, Other than listed'),
(9, 'Mohammd Abu', 'Kawsar', 'kawsarjoydiu@gmail.c', 'Comilla', 'Ch', 'Conputers, Exercise, Internet, Reading, Traveling, Other than listed'),
(10, 'Mohammd Abu', 'Kawsar', 'kawsarjoydiu@gmail.c', 'Feni', 'Ch', 'Conputers, Dancing, Exercise, Flying, Internet, Reading, Other than listed'),
(11, 'Mohammd Abu', 'Kawsar', 'kawsarjoydiu@gmail.com', 'Noakhli', 'Ch', 'Conputers, Dancing, Exercise, Flying, Golfimg, Hunting, Internet, Reading, Traveling, Other than listed'),
(12, 'Mohammd Abu', 'Kawsar', 'kawsarjoydiu@gmail.com', 'B-baria', 'Ch', 'Conputers, Dancing, Exercise, Flying, Internet, Reading, Traveling, Other than listed'),
(13, 'Mohammd Abu', 'Kawsar', 'dsfdsfs', 'fdsfsdfdsa', 'df', 'Exercise'),
(14, 'Mohammd Abu', 'Kawsar', 'kawsarjoydiu@gmail.com', 'fdsfsdfdsa', 'fs', 'Dancing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comic_character`
--
ALTER TABLE `comic_character`
  ADD PRIMARY KEY (`character_id`);

--
-- Indexes for table `comic_character_power`
--
ALTER TABLE `comic_character_power`
  ADD PRIMARY KEY (`character_id`,`power_id`);

--
-- Indexes for table `comic_lair`
--
ALTER TABLE `comic_lair`
  ADD PRIMARY KEY (`lair_id`);

--
-- Indexes for table `comic_power`
--
ALTER TABLE `comic_power`
  ADD PRIMARY KEY (`power_id`);

--
-- Indexes for table `comic_rivalry`
--
ALTER TABLE `comic_rivalry`
  ADD PRIMARY KEY (`hero_id`,`villain_id`);

--
-- Indexes for table `comic_zipcode`
--
ALTER TABLE `comic_zipcode`
  ADD PRIMARY KEY (`zipcode_id`);

--
-- Indexes for table `site_user`
--
ALTER TABLE `site_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `site_user_info`
--
ALTER TABLE `site_user_info`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comic_character`
--
ALTER TABLE `comic_character`
  MODIFY `character_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comic_lair`
--
ALTER TABLE `comic_lair`
  MODIFY `lair_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comic_power`
--
ALTER TABLE `comic_power`
  MODIFY `power_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `site_user`
--
ALTER TABLE `site_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
