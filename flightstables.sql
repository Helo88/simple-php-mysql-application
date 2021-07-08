-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 11:31 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `flightstables`
--

CREATE TABLE `flightstables` (
  `id` int(11) UNSIGNED NOT NULL,
  `airportname` varchar(20) NOT NULL,
  `DepartDate` date NOT NULL,
  `LandingDate` date NOT NULL,
  `DepartHour` time NOT NULL,
  `LandingHour` time NOT NULL,
  `location` varchar(20) NOT NULL,
  `Destination` varchar(20) NOT NULL,
  `FirstPrices` varchar(200) NOT NULL,
  `EconomyPrices` varchar(200) NOT NULL,
  `BusinessPrices` varchar(200) NOT NULL,
  `Fseats` int(11) NOT NULL,
  `Eseats` int(11) NOT NULL,
  `Bseats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flightstables`
--

INSERT INTO `flightstables` (`id`, `airportname`, `DepartDate`, `LandingDate`, `DepartHour`, `LandingHour`, `location`, `Destination`, `FirstPrices`, `EconomyPrices`, `BusinessPrices`, `Fseats`, `Eseats`, `Bseats`) VALUES
(163, 'sd1', '2021-08-09', '2021-08-19', '03:02:11', '21:02:11', 'aswan', 'berlin', '260,890,80', '70,89,90', '160,390,870', 60, 124, 64),
(164, 'sd2', '2021-08-09', '2021-08-19', '03:02:11', '21:02:11', 'aswan', 'berlin', '260,890,80', '70,89,90', '160,390,870', 60, 124, 56),
(165, 'sd3', '2021-08-09', '2021-08-19', '03:02:11', '04:02:11', 'Cairo', 'Alex', '260,890,80', '70,89,90', '160,390,870', 45, 118, 0),
(166, 'sd3', '2021-08-09', '2021-08-19', '03:02:11', '06:02:11', 'Luxor', 'Alex', '260,890,80', '70,89,90', '160,390,870', 60, 130, 71);

--
-- Triggers `flightstables`
--
DELIMITER $$
CREATE TRIGGER `rightDepartDate` BEFORE INSERT ON `flightstables` FOR EACH ROW BEGIN          
            IF NEW.DepartDate < CURRENT_DATE  THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date isnot valid';
            END IF;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `rightLandingDate` BEFORE INSERT ON `flightstables` FOR EACH ROW BEGIN          
            IF NEW.LandingDate <= New.DepartDate  THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date isnot valid';
            END IF;
        END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flightstables`
--
ALTER TABLE `flightstables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flightstables`
--
ALTER TABLE `flightstables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
