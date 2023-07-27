-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 27, 2023 at 03:56 AM
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
(60, 811284826, 17, 18, 'jhbgvcv', 'fgcvbn', '2023-07-28', '2023-07-29', 'Outside Valley', 0, '2023-07-26 08:38:50'),
(61, 805145675, 17, 22, 'asdf', 'fghj', '2023-07-28', '2023-07-28', 'Outside Valley', 0, '2023-07-26 08:59:38'),
(62, 457859538, 17, 17, 'cfghjb', 'drtyh', '2023-07-28', '2023-07-29', 'Outside Valley', 0, '2023-07-26 15:01:21'),
(63, 762654269, 33, 17, 'serdty', 'xfcghj', '2023-07-28', '2023-07-29', 'Inside Valley', 0, '2023-07-26 16:34:15'),
(64, 837248488, 18, 17, 'cfgvhb', 'drtfyghj', '2023-07-31', '2023-07-31', 'Outside Valley', 0, '2023-07-27 07:38:20');

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
(5, 'Toyota', '2023-07-17');

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
  `creationdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`vehicleid`, `vehiclename`, `brandname`, `vehicleno`, `vehicleimages`, `vehicleavailability`, `priceperday`, `mileage`, `seatcapacity`, `creationdate`) VALUES
(17, 'Hyundai i10', 'Hyundai', 'B AA 6789', 'car1.jpg', 'Available', 5000, 20, 5, '2023-07-17'),
(18, 'Suzuki Baleno', 'Maruti Suzuki', 'B AA 1267', 'car2.jpg', 'Available', 4000, 23, 5, '2023-07-17'),
(19, 'Toyota Yaris L', 'Toyota', 'B AA 2456', 'car3.jpg', 'Available', 5000, 17, 5, '2023-07-17'),
(20, 'Hyundai Santro', 'Hyundai', 'B AA 5678', 'car4.jpg', 'Available', 3000, 20, 5, '2023-07-17'),
(21, 'Maruti Suzuki Swift', 'Maruti Suzuki', 'B AA 1098', 'car5.jpg', 'Available', 5000, 22, 5, '2023-07-17'),
(22, 'Hyundai Creta', 'Hyundai', 'B AA 1234', 'car6.jpg', 'Available', 6000, 16, 5, '2023-07-17');

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
(22, 'sapana@gmail.com', '51c75fa2657936166e56d2029b9685c7', 'Sapana Chaudhary', 'female', '2001-12-23', '9842517548', 'Kathmandu', 'Shatinagar', '2023-07-05', 'user.png', ''),
(23, 'lajana@gmail.com', 'ab93037105f9728d0d1f7085263149cf', 'Lajana Singh Thakuri', 'female', '2000-07-07', '9852634145', 'Kathmandu', 'Shantinagar', '2023-07-05', 'profile-pic.jpg', 'license.jpg'),
(24, 'shilu@gmail.com', '31757ddf30604f05902037da41ca5133', 'Shilu', 'female', '2000-10-21', '9808745332', 'Kathmandu', 'Shantinagar', '2023-07-05', '11.jpeg', ''),
(25, 'rabin@gmail.com', '31029dde2976f44e327edbeef34aac01', 'Rabin Majhi', 'male', '2000-07-27', '9812304578', 'Kathmandu', 'Balaju', '2023-07-06', '3.jpeg', ''),
(26, 'puja@gmail.com', '9529e56b5a95b4bbfe5ea75068cf442a', 'Puja Prajapati', 'female', '2000-08-24', '9801256547', 'Bhaktapur', 'Lokanthali', '2023-07-06', 'profile-pic.jpg', 'license.png'),
(27, 'sangita@gmail.com', '3bc39f410deca09caf1948b99d49b0cf', 'Sangita', 'female', '2000-12-05', '9824567562', 'Kathmandu', 'Shantinagar', '2023-07-06', '', ''),
(28, 'ayush@gmail.com', '691c720c3152c8686e0ff812a767c552', 'Ayush Dhakal', 'female', '2000-12-08', '9821457896', 'Bhaktapur', 'Subarneshwor', '2023-07-07', '3.jpeg', 'license.jpg'),
(31, 'rajeev@gmail.com', 'db7bafab52014759bedbec960d00fabb', 'Rajeev Thapa', 'male', '2000-04-05', '9856324752', 'Lalitpur', 'Jhamsikhel 6', '2023-07-11', '', ''),
(32, 'vancy@gmail.com', '8901553a673df661d56dfe0bf658c432', 'Vancy', 'male', '1999-11-30', '9841152603', 'Bhaktapur', 'Suryabinayak 6', '2023-07-23', '3.jpeg', 'license.jpg'),
(33, 'prabesh@gmail.com', '00b97032d8d55e6b3e509bdd0e6bf82d', 'Prabesh Poudel', 'male', '2002-07-27', '9802365452', 'Kathmandu', 'Sorakhutte 16', '2023-07-25', '3.jpeg', 'license.jpg');

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
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `vehicleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
