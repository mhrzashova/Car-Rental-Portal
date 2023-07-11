-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2023 at 11:59 AM
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
(2, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `vehicleid` int(11) NOT NULL,
  `vehiclename` varchar(100) NOT NULL,
  `vehicleno` varchar(100) NOT NULL,
  `vehicleimages` text NOT NULL,
  `vehicleavailability` varchar(100) NOT NULL,
  `priceperday` varchar(100) NOT NULL,
  `mileage` varchar(100) NOT NULL,
  `seatcapacity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`vehicleid`, `vehiclename`, `vehicleno`, `vehicleimages`, `vehicleavailability`, `priceperday`, `mileage`, `seatcapacity`) VALUES
(9, 'Toyota', '120 Ba 1245', 'car4.jpg', 'Booked', 'Rs 5000', '22 kmpl', 5),
(10, 'Creta', 'Ba 100 Pa 4567', 'car.png', 'Available', 'Rs 5000', '22 kmpl', 5),
(11, 'Hyundai', 'Ba 101 Pa 1256', 'car5.jpg', 'Available', 'Rs 5000', '23 kmpl', 5);

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
(17, 'shrinkhala@gmail.com', 'adf8656dbde4d3f9a2524610cd48a1c3', 'Shrinkhala Joshi', 'female', '2001-12-28', '9845652123', 'Bhaktapur', 'Radhe Radhe', '2023-07-05', '2.jpeg', 'license.png'),
(18, 'sanchita@gmail.com', '1428df5c7afe28f422c03da0834bebe5', 'Sanchita Shakya', 'female', '1998-08-27', '9812365412', 'Kathmandu', 'Kalanki', '2023-07-05', '4.jpeg', ''),
(22, 'sapana@gmail.com', '51c75fa2657936166e56d2029b9685c7', 'Sapana Chaudhary', 'female', '2001-12-23', '9842517548', 'Kathmandu', 'Shatinagar', '2023-07-05', 'user.png', ''),
(23, 'lajana@gmail.com', 'ab93037105f9728d0d1f7085263149cf', 'Lajana Singh Thakuri', 'female', '2000-07-07', '9852634145', 'Kathmandu', 'Shantinagar', '2023-07-05', 'profile-pic.jpg', 'license.jpg'),
(24, 'shilu@gmail.com', '31757ddf30604f05902037da41ca5133', 'Shilu', 'female', '2000-10-21', '9808745332', 'Kathmandu', 'Shantinagar', '2023-07-05', '11.jpeg', ''),
(25, 'rabin@gmail.com', '31029dde2976f44e327edbeef34aac01', 'Rabin Majhi', 'male', '2000-07-27', '9812304578', 'Kathmandu', 'Balaju', '2023-07-06', '3.jpeg', ''),
(26, 'puja@gmail.com', '9529e56b5a95b4bbfe5ea75068cf442a', 'Puja Prajapati', 'female', '2000-08-24', '9801256547', 'Bhaktapur', 'Lokanthali', '2023-07-06', 'profile-pic.jpg', 'license.png'),
(27, 'sangita@gmail.com', '3bc39f410deca09caf1948b99d49b0cf', 'Sangita', 'female', '2000-12-05', '9824567562', 'Kathmandu', 'Shantinagar', '2023-07-06', '', ''),
(28, 'ayush@gmail.com', '691c720c3152c8686e0ff812a767c552', 'Ayush Dhakal', 'female', '2000-12-08', '9821457896', 'Bhaktapur', 'Subarneshwor', '2023-07-07', '3.jpeg', 'license.jpg'),
(31, 'rajeev@gmail.com', 'db7bafab52014759bedbec960d00fabb', 'Rajeev Thapa', 'male', '2000-04-05', '9856324752', 'Lalitpur', 'Jhamsikhel 6', '2023-07-11', '', '');

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
  MODIFY `adminid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `vehicleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
