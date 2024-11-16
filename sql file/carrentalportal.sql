-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2024 at 04:02 PM
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
(129, 204641460, 17, 33, 'Kathmandu', 'Kathmandu', '2024-11-13', '2024-11-15', 'Inside Valley', 1, '2024-11-13 08:17:49');

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
(30, 'Hyundai i10', 'Hyundai', 'Ba 12 Pa 1290', 'car1.jpg', 'Available', 120, 20, 5, '2023-08-21', 26, 8),
(31, 'Suzuki Baleno', 'Maruti Suzuki', 'Ba 67 Pa 456', 'car2.jpg', 'Available', 100, 23, 5, '2023-08-21', 6, 2),
(32, 'Toyota Yaris L', 'Toyota', 'Ba 89 Pa 6780', 'car3.jpg', 'Available', 100, 17, 5, '2023-08-21', 12, 3),
(33, 'Hyundai Santro', 'Hyundai', 'B AA 5678', 'car4.jpg', 'Booked', 90, 20, 5, '2023-08-21', 6, 2),
(34, 'Maruti Suzuki Swift', 'Maruti Suzuki', 'B AA 1098', 'car5.jpg', 'Available', 110, 22, 5, '2023-08-21', 3, 1),
(35, 'Hyundai Creta', 'Hyundai', 'B AA 1234', 'car6.jpg', 'Available', 200, 16, 5, '2023-08-21', 15, 4),
(43, 'Maruti', 'Hyundai', '1213 44 Ba', '1.jpg', 'Available', 80, 23, 6, '2024-11-13', 0, 0);

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
(18, 18, 35, 4, 'This car is really good to ride.', 1, '2023-09-30 11:55:38'),
(20, 36, 30, 4, 'yhucjdx', 0, '2023-10-07 08:45:37');

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
(15, 24, 'fgtyhjnbhuj', '2023-10-03 06:50:17', 0),
(16, 24, 'With this modification, the status will be displayed inside each testimonial-box along with the testimonial content. ', '2024-11-13 02:31:31', 0),
(17, 36, 'dtyiu', '2023-10-07 14:01:24', 0);

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
(18, 'sanchita@gmail.com', '1428df5c7afe28f422c03da0834bebe5', 'Sanchita Shakya', 'female', '1998-08-27', '9812365412', 'Kathmandu', 'Kalanki', '2023-07-05', 'logo1.jpg', 'license.jpg'),
(24, 'shilu@gmail.com', '31757ddf30604f05902037da41ca5133', 'Shilu', 'female', '2000-10-21', '9808745332', 'Kathmandu', 'Shantinagar', '2023-07-05', '11.jpeg', 'license.jpg'),
(25, 'rabin@gmail.com', '31029dde2976f44e327edbeef34aac01', 'Rabin Majhi', 'male', '2000-07-27', '9812304578', 'Kathmandu', 'Balaju', '2023-07-06', '3.jpeg', 'license.jpg'),
(34, 'mhrzashova12345@gmail.com', '77af4f9a82676da9172b5178f22fe980', 'Shova Maharjan', 'female', '2000-06-21', '9808732665', 'Kathmandu', 'Phutung 6', '2023-07-28', '', ''),
(36, 'rita@gmail.com', 'df5c7f78eeabe964d4b2362a8440dc48', 'Rita Shrestha', 'female', '2000-06-09', '9812458796', 'Kathmandu', 'Kavresthali', '2023-10-05', '9.jpeg', 'license.jpg'),
(37, 'sapana@gmail.com', '16ed75065075a236e875d3c7ddbeea30', 'Sapana ', 'female', '2000-10-18', '9845762145', 'Kathmandu', 'kamalpokhari', '2023-10-08', '', 'license.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vehicleid` (`vehicleid`);

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
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vehicleid` (`vehicleid`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `email` (`email`),
  ADD KEY `phoneno` (`phoneno`);

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
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `vehicleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`vehicleid`) REFERENCES `crud` (`vehicleid`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`vehicleid`) REFERENCES `crud` (`vehicleid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD CONSTRAINT `testimonial_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
