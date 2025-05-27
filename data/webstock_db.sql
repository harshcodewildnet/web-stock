-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 02:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gd_internal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `email`, `password`) VALUES
(1, 'admin@wildnet.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `filename`, `added`) VALUES
(1, 'sample.xlsx', '2025-05-05 11:39:12'),
(2, 'sample1.xlsx', '2025-05-05 12:16:06'),
(3, 'sample2.xlsx', '2025-05-05 12:16:14'),
(4, 'sample3.xlsx', '2025-05-05 12:16:50'),
(5, 'sample5.xlsx', '2025-05-05 12:24:38'),
(6, 'sampleNEW.xlsx', '2025-05-08 09:58:01'),
(7, 'template.csv', '2025-05-13 07:06:17'),
(8, 'template (8).csv', '2025-05-13 07:07:42'),
(9, 'sample_data (2).csv', '2025-05-13 07:13:19'),
(10, 'template4.csv', '2025-05-15 05:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(8) NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT 'user',
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `role`, `status`) VALUES
(1, 'admin', 'admin@wildnet.com', '$2y$10$owK05a2B9rzF6JWMGdqgeO2JuUYFz/JNH85jLtLxwUpkWlIz/.RYW', 'admin', 1),
(17, 'Amit', 'user@wildnet.com', '$2y$10$KiDHfXwTnsGk9e1M5OzbZ.cEK6x52xSRvfrPzeMEjrJj5/2KQ3l3a', 'user', 0),
(21, 'Harsh', 'harsh@wnet.com', '$2y$10$lUHAtLof5F/U/5IDp.5cFeWfas1yM2W4c5E/d6I9n2boYJmckqPKK', 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_backup`
--

CREATE TABLE `user_backup` (
  `user_id` int(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_backup`
--

INSERT INTO `user_backup` (`user_id`, `email`, `password`, `role`, `status`) VALUES
(3, 'admin@wildnet.com', '$2y$10$owK05a2B9rzF6JWMGdqgeO2JuUYFz/JNH85jLtLxwUpkWlIz/.RYW', 'admin', 1),
(4, 'user@wildnet.com', '$2y$10$MsqU7fBn72Zl.xAeoyfBR.e5Hu1/06iojPhvHdXIcSFgvQw4hZ.hu', 'user', 0),
(5, 'user4@wildnet.com', '$2y$10$VxOXSFlaveaxKdTpMTZRee2PQiQdx/kXkGD6A5xxde5JcPUs8P4IS', 'user', 1),
(6, 'user1@wildnet.com', '$2y$10$gdrlhIQ9qnkezyDc7R5b..kGZD7zGdXDo37R/PyFkOA3Ig4GXUYIG', 'user', 0),
(8, 'user2@wildnet.com', '$2y$10$6RsTrLrupBo9fArTrjmsJO1SqXwBnnfSMF4mgp8QOKR3W98z4MA06', 'user', 1),
(9, 'user3@wildnet.com', '$2y$10$ueN5HKSSVRE6QskxeMhpleRwqPN.JcQUh3OShzu1aSYs2sV21wwli', 'user', 0),
(10, 'user5@wildnet.com', '$2y$10$3IzEXTFO3NLk2L3Smzi0gufGQaDbeJEjLnRGjf/d2sB4P2t9sCe4.', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `live_url` varchar(255) NOT NULL DEFAULT '-',
  `currency` varchar(10) DEFAULT 'USD',
  `price` decimal(10,2) DEFAULT NULL,
  `client_name` varchar(100) DEFAULT 'General',
  `blogger_name` varchar(100) DEFAULT NULL,
  `blogger_email` varchar(150) DEFAULT NULL,
  `blogger_mobile` varchar(20) DEFAULT NULL,
  `spam_score` decimal(5,2) DEFAULT NULL,
  `dr` decimal(5,2) DEFAULT NULL,
  `traffic` int(11) DEFAULT NULL,
  `da` int(11) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `added_by` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `category`, `url`, `live_url`, `currency`, `price`, `client_name`, `blogger_name`, `blogger_email`, `blogger_mobile`, `spam_score`, `dr`, `traffic`, `da`, `location`, `mode`, `added_by`, `status`, `approved`, `date_added`) VALUES
(1, 'Technology', 'techie.com', '-', 'USD', 220.00, 'Steve Williams', 'Steve Williams', 'steve@xyz.com', '9999999999', 12.50, 45.60, 5000, 33, 'United States', 'Manual', 'Admin', 'Active', 0, '2025-03-13'),
(2, 'Travel', 'travelnow.com', '-', 'USD', 180.00, 'TripCorp Ltd.', 'Anna Smith', 'anna@trip.com', '8888888888', 9.30, 35.40, 4200, 27, 'United Kingdom', 'CSV Upload', 'Execution', 'Active', 0, '2025-03-23'),
(3, 'Finance', 'finvest.com', '-', 'USD', 200.00, 'Finvest LLC', 'David Moore', 'david@finvest.com', '7777777777', 20.10, 38.90, 3000, 31, 'Canada', 'Manual', 'Admin', 'Under Review', 1, '2025-03-25'),
(4, 'Lifestyle', 'mynest.com', '-', 'USD', 250.00, 'Home Living Inc.', 'Julia Green', 'julia@mynest.com', '6666666666', 15.00, 40.00, 5500, 36, 'Australia', 'Manual', 'Execution', 'Draft', 1, '2025-03-31'),
(5, 'News & Politics', 'globalnews.com', '-', 'USD', 280.00, 'ABC Media', 'Hans Richter', 'hans@global.com', '5555555555', 18.70, 49.20, 6200, 40, 'Germany', 'API', 'Execution', 'Blocked', 1, '2025-03-18'),
(6, 'Technology', 'techsphere.com', '-', 'USD', 275.00, 'Innova Solutions', 'Alice Johnson', 'alice@innova.com', '9999991111', 15.25, 47.30, 8200, 35, 'United States', 'Manual', 'Admin', 'Active', 1, '2025-04-06'),
(7, 'Finance', 'moneywise.org', '-', 'USD', 340.00, 'Wise Capital Inc.', 'Daniel Moore', 'daniel@wise.com', '8888882222', 9.60, 42.00, 9000, 40, 'United Kingdom', 'CSV Upload', 'Execution', 'Active', 1, '2025-03-21'),
(8, 'Travel', 'globetrekker.net', '-', 'USD', 199.99, 'Trek Global', 'Sophie Lee', 'sophie@trek.com', '7777773333', 22.70, 34.80, 6700, 31, 'Canada', 'Manual', 'Execution', 'Under Review', 1, '2025-04-20'),
(9, 'Education', 'learnsmart.edu', '-', 'USD', 150.00, 'Smart Learn', 'Mark Thomas', 'mark@smart.edu', '6666664444', 18.30, 38.40, 5000, 29, 'India', 'API', 'Execution', 'Draft', 1, '2025-02-28'),
(10, 'Gaming', 'gamelounge.io', '-', 'USD', 420.50, 'Pixel Arcade', 'Nina Patel', 'nina@games.io', '5555555555', 5.75, 52.60, 11200, 43, 'Germany', 'Manual', 'Execution', 'Blocked', 1, '2025-03-11'),
(11, 'Health & Fitness', 'fitlifezone.com', '-', 'USD', 320.00, 'HealthCore Inc.', 'Oscar Bell', 'oscar@fitlife.com', '4444446666', 12.50, 41.20, 9500, 37, 'Australia', 'CSV Upload', 'Execution', 'Active', 0, '2025-04-28'),
(12, 'Fashion', 'styletrendz.com', '-', 'USD', 260.00, 'Trendy Styles', 'Emma Stone', 'emma@style.com', '3333337777', 28.90, 36.90, 7300, 33, 'France', 'Manual', 'Admin', 'Active', 0, '2025-03-01'),
(13, 'News & Politics', 'truthdaily.net', '-', 'USD', 390.00, 'Daily Bulletin', 'Harry White', 'harry@truth.net', '2222228888', 44.20, 50.00, 10500, 45, 'Philippines', 'API', 'Execution', 'Blocked', 1, '2025-03-25'),
(15, 'Business & Marketing', 'bizboost.com', '-', 'USD', 350.00, 'Boost Media', 'George Smith', 'george@boost.com', '0000001111', 19.45, 46.70, 9800, 39, 'Brazil', 'CSV Upload', 'Execution', 'Active', 0, '2025-03-10'),
(16, 'Lifestyle', 'urbanzenlife.com', '-', 'USD', 270.00, 'Urban Living Co.', 'Tina Hart', 'tina@urbanzen.com', '1212121212', 13.80, 35.50, 7400, 32, 'United States', 'Manual', 'Execution', 'Active', 1, '2025-04-02'),
(17, 'Entertainment', 'flickfans.com', '-', 'USD', 410.00, 'CineWorld Inc.', 'Luke Adams', 'luke@flick.com', '9898989898', 21.70, 49.00, 8700, 38, 'United Kingdom', 'CSV Upload', 'Execution', 'Active', 0, '2025-03-08'),
(18, 'DIY & Home', 'builditbetter.com', '-', 'USD', 295.00, 'FixIt Bros.', 'Carol Davis', 'carol@buildit.com', '2323232323', 11.00, 42.20, 6200, 34, 'Canada', 'API', 'Admin', 'Under Review', 1, '2025-03-16'),
(19, 'Technology', 'codegear.dev', '-', 'USD', 300.00, 'CodeGear Inc.', 'Tom Rogers', 'tom@codegear.dev', '3434343434', 8.90, 47.50, 8800, 36, 'Germany', 'Manual', 'Admin', 'Active', 0, '2025-04-18'),
(20, 'Finance', 'smartinvest.io', '-', 'USD', 265.00, 'SmartInvest Group', 'Sara Liu', 'sara@smartinvest.io', '4545454545', 25.00, 39.30, 7000, 30, 'Australia', 'Manual', 'Execution', 'Inactive', 1, '2025-03-05'),
(21, 'Travel', 'wanderhub.org', '-', 'USD', 240.00, 'Wander Co.', 'Ben Parker', 'ben@wander.org', '5656565656', 10.50, 40.80, 8100, 35, 'India', 'CSV Upload', 'Execution', 'Draft', 1, '2025-03-21'),
(22, 'Education', 'eduinspire.net', '-', 'USD', 185.00, 'Inspire Learning', 'Zoe Wright', 'zoe@eduinspire.net', '6767676767', 7.80, 37.00, 6000, 29, 'Philippines', 'API', 'Execution', 'Active', 0, '2025-03-18'),
(23, 'Health & Fitness', 'wellzenhealth.com', '-', 'USD', 305.00, 'WellZen Group', 'Liam Cole', 'liam@wellzen.com', '7878787878', 14.40, 43.00, 9400, 38, 'United Kingdom', 'CSV Upload', 'Execution', 'Active', 1, '2025-03-16'),
(24, 'Fashion', 'runwaymix.com', '-', 'USD', 330.00, 'Mix Couture', 'Grace Hill', 'grace@runwaymix.com', '8989898989', 18.90, 44.50, 7700, 33, 'France', 'CSV Upload', 'Execution', 'Active', 0, '2025-04-10'),
(25, 'News & Politics', 'factfocus.org', '-', 'USD', 370.00, 'Focus Media Ltd.', 'Jack Green', 'jack@factfocus.org', '9090909090', 27.20, 48.30, 10100, 40, 'United States', 'API', 'Admin', 'Blocked', 1, '2025-04-08'),
(26, 'Gaming', 'pixelarena.gg', '-', 'USD', 425.00, 'Arena Pixels', 'Olivia King', 'olivia@arena.gg', '2121212121', 16.70, 53.80, 11900, 42, 'India', 'Manual', 'Execution', 'Under Review', 0, '2025-03-15'),
(28, 'DIY & Home', 'harshblog.com', '-', 'USD', 120.00, 'Harsh', 'Harsh Blogger', 'harbshblog@gmail.com', '7777777777', 20.10, 38.00, 3000, 31, 'Australia', 'API', 'Execution', 'Active', 1, '2025-03-03'),
(29, 'Travel', 'bhagwati.co', '-', 'INR', 2300.00, 'Bhagwati Enterprises', 'Rishi Nagar', 'rishi.nagar@bhagwati.com', '7878676767', 19.12, 37.00, 2800, 31, 'India', 'CSV Upload', 'Execution', 'Inactive', 1, '2025-04-08'),
(30, 'Technology', 'digiv.com', '-', 'USD', 120.00, 'Digitalk Ventures', 'David Moore', 'david@digiv.com', '7777777777', 19.12, 37.00, 3000, 31, 'United States', 'CSV Upload', 'Execution', 'Active', 1, '2025-04-18'),
(32, 'Finance', 'harshblog.com', '-', 'EUR', 120.00, 'Digitalk Ventures', 'David Moore', 'harbshblog@gmail.com', '7878676767', 19.12, 37.00, 3000, 31, 'United Kingdom', 'Manual', 'Admin', 'Active', 0, '2025-05-05'),
(33, 'Technology', 'digiv.com', '-', 'AUD', 140.00, 'Finvest LLC', 'David Moore', 'david@finvest.com', '7777777777', 20.10, 38.00, 3000, 31, 'Australia', 'API', 'Execution', 'Inactive', 0, '2025-05-05'),
(34, 'Finance', 'wqewq.asd', '-', 'USD', 200.00, 'Digitalk Ventures', 'David Moore', 'harbshblog@gmail.com', '', 20.10, 38.00, 2800, 31, 'Norway', '', 'Execution', '', 0, '2025-05-06'),
(37, 'Food & Recipes', 'cookitfresh.com', '-', 'USD', 180.00, 'Yummy Foods', 'Linda Kim', 'linda@cook.com', '1111119999', 6.30, 33.00, 5800, 28, 'Brazil', 'Manual', 'Admin', 'Draft', 0, '2025-05-07'),
(38, 'Lifestyle', 'wqewq.asd', '-', 'GBP', 200.00, 'Digitalk Ventures', 'Anna Smith', 'david@digiv.com', '', 20.10, 35.00, 2800, 27, 'Norway', 'CSV Upload', 'Admin', '', 0, '2025-05-07'),
(39, 'Travel', 'finvest.com', '-', 'JPY', 200.00, 'TripCorp Ltd', 'Anna Smith', 'linda@cook.com', '8888882222', 19.12, 43.00, 2800, 28, 'Sweden', 'CSV Upload', 'Admin', 'Blocked', 0, '2025-05-07'),
(41, 'News & Politics', 'finvest.com', '-', 'JPY', 140.00, 'TripCorp Ltd', 'Linda Kim', 'lindacooper@cook.com', '8888888888', 14.40, 35.00, 3000, 38, 'Hong Kong', 'Manual', 'Admin', 'Blocked', 0, '2025-05-07'),
(42, 'Lifestyle', 'finvest.com', '-', 'GBP', 140.00, 'TripCorp Ltd', 'Anna Smith', 'david@digiv.com', '7878676767', 14.40, 43.00, 4200, 28, 'Norway', 'Manual', 'Admin', 'Under Review', 0, '2025-05-07'),
(47, 'Technology', 'https://example.com', '-', 'USD', 100.00, 'Client A', 'John Doe', 'john@example.com', '1234567890', 1.20, 50.00, 5000, 40, 'United States', 'Online', 'Admin', 'Active', 1, '2025-05-09'),
(56, 'Technology', 'https://example2.com', '-', 'USD', 100.00, 'Client A', 'John Doe', 'john@example.com', '1234567890', 1.20, 50.00, 5000, 40, 'United States', 'Online', 'Admin', 'Active', 1, '2025-05-12'),
(57, 'News & Politics', 'https://example.com', '-', '', 200.00, 'JD Vance', 'Alpert Richard', 'grace@runwaymix.com', '8787878789', 14.40, 37.00, 2800, 42, 'United Arab Emirates', 'CSV Upload', 'Admin', 'Active', 1, '2025-05-12'),
(58, 'News & Politics', 'https://example.com200', '-', '', 200.00, 'JD Vance', 'Alpert Richard', 'grace@runwaymix.com', '8787878789', 14.40, 37.00, 2800, 42, 'United Arab Emirates', 'CSV Upload', 'Admin', 'Active', 1, '2025-05-12'),
(60, 'News & Politics', 'https://example2.com', '-', '', 200.00, 'JD Vance', 'Alpert Richard', 'grace@runwaymix.com', '8787878789', 14.40, 37.00, 2800, 42, 'United Arab Emirates', 'CSV Upload', 'Admin', 'Active', 1, '2025-05-13'),
(61, 'Lifestyle', 'tripcorp.com/blog', '-', 'JPY', 180.00, 'TripCorp Ltd', 'Anna Smith', 'anna@trip.com', '8888888888', 14.40, 35.00, 4200, 38, 'Singapore', 'Manual', 'Admin', 'Under Review', 0, '2025-05-13'),
(63, 'News & Politics', 'https://example3.com', '-', '', 200.00, 'JD Vance', 'Alpert Richard', 'grace@runwaymix.com', '8787878789', 14.40, 37.00, 2800, 42, 'United Arab Emirates', 'CSV Upload', 'Admin', 'Active', 1, '2025-05-13'),
(64, 'Fashion', 'https://www.amberjones.co', '-', 'INR', 286.00, 'John Rasmussen', 'Amber Jones', 'michellehays@hotmail.com', '7212118356', 11.00, 36.00, 1979, 35, 'United Kingdom', 'Manual Entry', 'Execution', 'Active', 1, '2025-05-13'),
(65, 'Technology', 'https://www.raymondmitch.net', '-', 'AED', 131.00, 'Paul Smith', 'Raymond Mitchell', 'rebeccawilliams@howard.com', '3061182744', 19.60, 46.00, 3065, 17, 'Germany', 'Manual Entry', 'Admin', 'Active', 1, '2025-05-13'),
(66, 'Fashion', 'https://www.johnlong.com', '-', 'GBP', 320.00, 'Natalie Wiley', 'John Long', 'wtorres@gmail.com', '4302465023', 9.60, 44.00, 1456, 25, 'United Kingdom', 'CSV Upload', 'Execution', 'Inactive', 1, '2025-05-13'),
(67, 'Fashion', 'https://www.anthonyjames.net', '-', 'USD', 74.00, 'Steven Dunn', 'Anthony James', 'briangonzales@gmail.com', '4000592370', 9.30, 14.00, 6017, 29, 'United Kingdom', 'CSV Upload', 'Admin', 'Inactive', 0, '2025-05-13'),
(68, 'Education', 'https://www.chloefoster.net', '-', 'INR', 434.00, 'Sara Davis', 'Chloe Foster', 'kevin20@hotmail.com', '6146742988', 9.30, 26.00, 5215, 44, 'India', 'CSV Upload', 'Execution', 'Active', 0, '2025-05-13'),
(69, 'Technology', 'https://www.robertschnei.co', '-', 'INR', 293.00, 'Jonathan Martinez', 'Robert Schneider', 'torreschristine@chapman.net', '7215371208', 19.00, 45.00, 6631, 48, 'United States', 'CSV Upload', 'Execution', 'Inactive', 1, '2025-05-13'),
(70, 'Fashion', 'https://www.kristindicke.org', '-', 'EUR', 384.00, 'Ashley Estrada', 'Kristin Dickerson', 'nicholasjackson@yahoo.com', '2504809878', 19.10, 43.00, 1275, 40, 'United Arab Emirates', 'Manual Entry', 'Admin', 'Active', 1, '2025-05-13'),
(71, 'News & Politics', 'https://www.brianjordan.in', '-', 'EUR', 297.00, 'Courtney Paul', 'Brian Jordan', 'shanepeters@yahoo.com', '8303336479', 15.60, 35.00, 3798, 41, 'India', 'Manual Entry', 'Execution', 'Active', 1, '2025-05-13'),
(72, 'Travel', 'https://www.petercain.com', '-', 'EUR', 411.00, 'Logan Nelson', 'Peter Cain', 'bennettellen@yahoo.com', '0765135259', 18.70, 54.00, 1799, 56, 'United States', 'CSV Upload', 'Execution', 'Inactive', 1, '2025-05-13'),
(73, 'Technology', 'https://www.susanyu.org', '-', 'GBP', 459.00, 'David Schmidt', 'Susan Yu', 'nathanlopez@knight.com', '5310224946', 10.90, 69.00, 4758, 36, 'United Arab Emirates', 'CSV Upload', 'Admin', 'Inactive', 1, '2025-05-13'),
(74, 'News & Politics', 'https://example3.com', '-', '', 200.00, 'JD Vance', 'Alpert Richard', 'grace1@runwaymix.com', '8787878789', 14.40, 37.00, 2800, 42, 'United Arab Emirates', 'CSV Upload', 'Admin', 'Active', 1, '2025-05-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_backup`
--
ALTER TABLE `user_backup`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_entry` (`url`,`client_name`,`blogger_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_backup`
--
ALTER TABLE `user_backup`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
