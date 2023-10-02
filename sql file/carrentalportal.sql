-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2023 at 03:18 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrentalportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `email`, `password`) VALUES
(1, 'mhrzashova12345@gmail.com', '94cb04d2daaa54fef37f72e5a1766815'),
(2, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `bookingnumber` bigint(12) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicleid` int(11) NOT NULL,
  `fromlocation` varchar(255) NOT NULL,
  `tolocation` varchar(255) NOT NULL,
  `pickup_date` date NOT NULL,
  `return_date` date NOT NULL,
  `triptype` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `bookingnumber`, `user_id`, `vehicleid`, `fromlocation`, `tolocation`, `pickup_date`, `return_date`, `triptype`, `status`, `creationdate`) VALUES
(77, 859149852, 17, 30, 'Kathmandu', 'Bhaktapur', '2023-08-21', '2023-08-22', 'Inside Valley', 1, '2023-08-21 13:10:37'),
(78, 254749486, 17, 31, 'Kathmandu', 'Bhaktapur', '2023-08-21', '2023-08-22', 'Inside Valley', 0, '2023-08-21 13:20:54'),
(79, 542386712, 17, 36, ' bnm', ' vb', '2023-08-21', '2023-08-22', 'Inside Valley', 0, '2023-08-21 14:04:39'),
(80, 706330980, 17, 38, 'fghb', 'drtfgh', '2023-08-21', '2023-08-22', 'Inside Valley', 0, '2023-08-21 16:17:02'),
(81, 688250266, 24, 38, 'ftgyjh', 'ftgyhj', '2023-08-22', '2023-08-23', 'Inside Valley', 0, '2023-08-22 08:12:46'),
(82, 301708393, 24, 38, 'tfgyjh', 'cbvn', '2023-08-23', '2023-08-25', 'Inside Valley', 0, '2023-08-22 08:14:12'),
(83, 348023428, 24, 38, 'drty', 'fgh', '2023-08-25', '2023-08-26', 'Inside Valley', 0, '2023-08-22 08:15:27'),
(84, 431951751, 24, 37, 'ghn', 'ghbn', '2023-08-22', '2023-08-23', 'Inside Valley', 0, '2023-08-22 08:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brandname` varchar(100) NOT NULL,
  `creationdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brandname`, `creationdate`) VALUES
(3, 'Hyundai', '2023-07-17'),
(4, 'Maruti Suzuki', '2023-07-17'),
(5, 'Toyota', '2023-07-17'),
(7, 'BMW', '2023-08-07'),
(8, 'Thar', '2023-08-09');

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `vehicleid` int(11) NOT NULL,
  `vehiclename` varchar(100) NOT NULL,
  `brandname` varchar(100) NOT NULL,
  `vehicleno` varchar(100) NOT NULL,
  `vehicleimages` text NOT NULL,
  `vehicleavailability` varchar(100) NOT NULL,
  `priceperday` int(100) NOT NULL,
  `mileage` int(100) NOT NULL,
  `seatcapacity` int(100) NOT NULL,
  `creationdate` date NOT NULL DEFAULT current_timestamp(),
  `rating` float DEFAULT 0,
  `total_ratings` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`vehicleid`, `vehiclename`, `brandname`, `vehicleno`, `vehicleimages`, `vehicleavailability`, `priceperday`, `mileage`, `seatcapacity`, `creationdate`, `rating`, `total_ratings`) VALUES
(30, 'Hyundai i10', 'Hyundai', 'Ba 12 Pa 1290', 'car1.jpg', 'Available', 3000, 20, 5, '2023-08-21', 19, 6),
(31, 'Suzuki Baleno', 'Maruti Suzuki', 'Ba 67 Pa 456', 'car2.jpg', 'Available', 4000, 23, 5, '2023-08-21', 6, 2),
(32, 'Toyota Yaris L', 'Toyota', 'Ba 89 Pa 6780', 'car3.jpg', 'Available', 5000, 17, 5, '2023-08-21', 12, 3),
(33, 'Hyundai Santro', 'Hyundai', 'B AA 5678', 'car4.jpg', 'Available', 4000, 20, 5, '2023-08-21', 6, 2),
(34, 'Maruti Suzuki Swift', 'Maruti Suzuki', 'B AA 1098', 'car5.jpg', 'Available', 5000, 22, 5, '2023-08-21', 3, 1),
(35, 'Hyundai Creta', 'Hyundai', 'B AA 1234', 'car6.jpg', 'Available', 6000, 16, 5, '2023-08-21', 15, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicleid` int(11) NOT NULL,
  `rating_value` float DEFAULT 0,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL,
  `postingdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `user_id`, `vehicleid`, `rating_value`, `comment`, `status`, `postingdate`) VALUES
(9, 17, 30, 3, '', 0, '2023-09-30 10:50:24'),
(12, 17, 32, 3, '', 0, '2023-09-30 10:50:24'),
(13, 18, 32, 4, '', 0, '2023-09-30 10:50:24'),
(14, 18, 34, 3, '', 0, '2023-09-30 10:50:24'),
(18, 18, 35, 4, 'This car is really good to ride.', 1, '2023-09-30 11:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `test_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `testimonial` mediumtext NOT NULL,
  `postingdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`test_id`, `user_id`, `testimonial`, `postingdate`, `status`) VALUES
(12, 25, 'gfjhuijk', '2023-08-01 09:32:41', 1),
(13, 24, 'fgtyhjnbhuj', '2023-08-10 03:42:26', 1),
(14, 24, 'fgtyhjnbhuj', '2023-08-10 03:45:04', 1),
(15, 24, 'fgtyhjnbhuj', '2023-08-10 03:42:46', 1),
(16, 24, 'With this modification, the status will be displayed inside each testimonial-box along with the testimonial content. ', '2023-08-01 09:32:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `birth_date` date NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `register_date` date NOT NULL DEFAULT current_timestamp(),
  `image` text NOT NULL,
  `l_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `full_name`, `gender`, `birth_date`, `phoneno`, `city`, `address`, `register_date`, `image`, `l_image`) VALUES
(17, 'shrinkhala@gmail.com', 'adf8656dbde4d3f9a2524610cd48a1c3', 'Shrinkhala Joshi', 'female', '2001-12-28', '9845652123', 'Bhaktapur', 'Radhe Radhe', '2023-07-05', '11.jpeg', 'license.jpg'),
(18, 'sanchita@gmail.com', '1428df5c7afe28f422c03da0834bebe5', 'Sanchita Shakya', 'female', '1998-08-27', '9812365412', 'Kathmandu', 'Kalanki', '2023-07-05', '4.jpeg', 'license.jpg'),
(22, 'sapana@gmail.com', '51c75fa2657936166e56d2029b9685c7', 'Sapana Chaudhary', 'female', '2001-12-23', '9842517548', 'Kathmandu', 'Shatinagar', '2023-07-05', '4.jpeg', 'license.jpg'),
(23, 'lajana@gmail.com', 'ab93037105f9728d0d1f7085263149cf', 'Lajana Singh Thakuri', 'female', '2000-07-07', '9852634145', 'Kathmandu', 'Shantinagar', '2023-07-05', 'profile-pic.jpg', 'license.jpg'),
(24, 'shilu@gmail.com', '31757ddf30604f05902037da41ca5133', 'Shilu', 'female', '2000-10-21', '9808745332', 'Kathmandu', 'Shantinagar', '2023-07-05', '11.jpeg', 'license.jpg'),
(25, 'rabin@gmail.com', '31029dde2976f44e327edbeef34aac01', 'Rabin Majhi', 'male', '2000-07-27', '9812304578', 'Kathmandu', 'Balaju', '2023-07-06', '3.jpeg', 'license.jpg'),
(26, 'puja@gmail.com', '9529e56b5a95b4bbfe5ea75068cf442a', 'Puja Prajapati', 'female', '2000-08-24', '9801256547', 'Bhaktapur', 'Lokanthali', '2023-07-06', 'profile-pic.jpg', 'license.png'),
(27, 'sangita@gmail.com', '3bc39f410deca09caf1948b99d49b0cf', 'Sangita', 'female', '2000-12-05', '9824567562', 'Kathmandu', 'Shantinagar', '2023-07-06', '4.jpeg', 'license.jpg'),
(28, 'ayush@gmail.com', '691c720c3152c8686e0ff812a767c552', 'Ayush Dhakal', 'female', '2000-12-08', '9821457896', 'Bhaktapur', 'Subarneshwor', '2023-07-07', '3.jpeg', 'license.jpg'),
(31, 'rajeev@gmail.com', 'db7bafab52014759bedbec960d00fabb', 'Rajeev Thapa', 'male', '2000-04-05', '9856324752', 'Lalitpur', 'Jhamsikhel 6', '2023-07-11', '', ''),
(32, 'vancy@gmail.com', '8901553a673df661d56dfe0bf658c432', 'Vancy', 'male', '1999-11-30', '9841152603', 'Bhaktapur', 'Suryabinayak 6', '2023-07-23', '3.jpeg', 'license.jpg'),
(33, 'prabesh@gmail.com', '00b97032d8d55e6b3e509bdd0e6bf82d', 'Prabesh Poudel', 'male', '2002-07-27', '9802365452', 'Kathmandu', 'Sorakhutte 16', '2023-07-25', '3.jpeg', 'license.jpg'),
(34, 'mhrzashova12345@gmail.com', '77af4f9a82676da9172b5178f22fe980', 'Shova Maharjan', 'female', '2000-06-21', '9808732665', 'Kathmandu', 'Phutung 6', '2023-07-28', '', ''),
(35, 'rai.alex@gmail.com', '8aca6ee7c016169d02f039beccf3c460', 'Alex Rai', 'male', '1983-06-22', '9812215487', 'Kathmandu', 'durbarmarg', '2023-08-09', 'alex.jpeg', 'license.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`vehicleid`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phoneno` (`phoneno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `vehicleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
