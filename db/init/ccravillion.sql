-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220331.b9ddf0b305
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2025 at 08:12 AM
-- Server version: 10.4.34-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccravillion`
--

-- --------------------------------------------------------

--
-- Table structure for table `Boardgames`
--

CREATE TABLE `Boardgames` (
  `Code` int(3) NOT NULL,
  `Game` varchar(100) NOT NULL,
  `Brand` varchar(100) NOT NULL,
  `Quantity` varchar(15) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Boardgames`
--

INSERT INTO `Boardgames` (`Code`, `Game`, `Brand`, `Quantity`, `Price`, `Rating`) VALUES
(1, 'Monopoly', 'Hasbro', '20', '14', 5),
(2, 'Clue', 'Hasbro', '17', '10', 2),
(3, 'Guess Who', 'Hasbro', '27', '30', 4),
(4, 'Connect 4', 'Hasbro', '20', '17', 4),
(5, 'Operation', 'Hasbro', '24', '15', 5),
(6, 'Twister', 'Hasbro', '26', '24', 4),
(7, 'Jenga', 'Hasbro', '22', '16', 3),
(8, 'Game of Life', 'Hasbro', '30', '25', 4),
(9, 'Deer Pong', 'Hasbro', '25', '15', 2),
(10, 'Risk', 'Hasbro', '20', '20', 5),
(11, 'Scrabble', 'Hasbro', '28', '18', 4),
(12, 'Trouble', 'Hasbro', '30', '25', 4),
(20, 'Yahtzee', 'Hasbro', '50', '15', 4);

-- --------------------------------------------------------

--
-- Table structure for table `OrderPlacement`
--

CREATE TABLE `OrderPlacement` (
  `OrderNumber` int(11) NOT NULL,
  `Code` int(3) NOT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `ShipDate` datetime DEFAULT NULL,
  `CustomerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `OrderPlacement`
--

INSERT INTO `OrderPlacement` (`OrderNumber`, `Code`, `OrderDate`, `ShipDate`, `CustomerID`) VALUES
(1, 1, '2022-06-08 20:18:35', '2022-06-06 20:18:35', 1),
(2, 7, '2022-07-06 21:16:14', '2022-07-08 21:16:14', 1),
(3, 6, '2022-07-20 21:16:14', '2022-07-26 21:16:14', 1),
(4, 5, '2022-07-01 20:18:35', '2022-07-04 20:18:35', 1),
(5, 7, '2022-07-08 21:16:14', '2022-07-11 21:16:14', 2),
(6, 10, '2022-07-05 21:16:14', '2022-07-18 21:16:14', 2),
(7, 8, '2022-08-01 21:16:14', '2022-08-02 21:16:14', 2),
(8, 2, '2022-08-01 21:16:14', '2022-08-03 21:16:14', 3),
(9, 3, '2022-08-03 21:16:14', '2022-08-06 21:16:14', 3),
(10, 4, '2022-08-04 21:16:14', '2022-08-08 21:16:14', 4),
(11, 4, '2022-08-04 21:16:14', '2022-08-08 21:16:14', 5),
(12, 4, '2022-08-04 21:16:14', '2022-08-08 21:16:14', 5),
(13, 7, '2022-07-08 21:16:14', '2022-07-11 21:16:14', 6),
(14, 10, '2022-07-05 21:16:14', '2022-07-18 21:16:14', 6),
(15, 8, '2022-08-01 21:16:14', '2022-08-02 21:16:14', 6),
(16, 5, '2022-07-01 20:18:35', '2022-07-04 20:18:35', 7),
(17, 7, '2022-07-08 21:16:14', '2022-07-11 21:16:14', 7),
(18, 1, '2022-06-08 20:18:35', '2022-06-06 20:18:35', 8),
(19, 7, '2022-07-06 21:16:14', '2022-07-08 21:16:14', 8),
(20, 6, '2022-07-20 21:16:14', '2022-07-26 21:16:14', 8),
(21, 3, '2022-08-03 21:16:14', '2022-08-06 21:16:14', 9),
(22, 7, '2022-07-08 21:16:14', '2022-07-11 21:16:14', 10),
(23, 4, '2022-08-04 21:16:14', '2022-08-08 21:16:14', 10),
(24, 10, '2022-07-05 21:16:14', '2022-07-18 21:16:14', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Boardgames`
--
ALTER TABLE `Boardgames`
  ADD PRIMARY KEY (`Code`);

--
-- Indexes for table `OrderPlacement`
--
ALTER TABLE `OrderPlacement`
  ADD PRIMARY KEY (`OrderNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Boardgames`
--
ALTER TABLE `Boardgames`
  MODIFY `Code` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `OrderPlacement`
--
ALTER TABLE `OrderPlacement`
  MODIFY `OrderNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
