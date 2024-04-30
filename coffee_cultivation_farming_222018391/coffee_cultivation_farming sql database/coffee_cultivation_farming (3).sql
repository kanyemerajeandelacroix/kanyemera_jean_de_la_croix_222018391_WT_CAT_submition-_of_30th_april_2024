-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 01:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee_cultivation_farming`
--

-- --------------------------------------------------------

--
-- Table structure for table `coffeevarieties`
--

CREATE TABLE `coffeevarieties` (
  `VarietyID` int(11) NOT NULL,
  `VarietyName` varchar(50) DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffeevarieties`
--

INSERT INTO `coffeevarieties` (`VarietyID`, `VarietyName`, `Description`) VALUES
(1, 'asdfghnjm', 'mnbvc'),
(24, 'one', 'two'),
(25, 'two', 'three'),
(26, 'threee', 'four'),
(27, 'akayobe', 'agatunda'),
(28, 'bobo', 'man');

-- --------------------------------------------------------

--
-- Table structure for table `farm`
--

CREATE TABLE `farm` (
  `farmid` int(11) NOT NULL,
  `Farmerid` int(11) DEFAULT NULL,
  `Farmname` varchar(30) DEFAULT NULL,
  `location` varchar(20) DEFAULT NULL,
  `sizeInAcres` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farm`
--

INSERT INTO `farm` (`farmid`, `Farmerid`, `Farmname`, `location`, `sizeInAcres`) VALUES
(16, 13, 'olive', 'og', '3456'),
(19, 13, 'kane', 'og', '3456'),
(20, 13, 'KDB', 'LONDAN', '6777'),
(21, 13, 'HALAND', 'NORWAY', '197');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `farmerid` int(11) NOT NULL,
  `firstname` varchar(34) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `contactnumber` varchar(20) DEFAULT NULL,
  `address` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`farmerid`, `firstname`, `lastname`, `contactnumber`, `address`) VALUES
(13, 'ntayo', 'niyo', '0978888', '34556');

-- --------------------------------------------------------

--
-- Table structure for table `harvest`
--

CREATE TABLE `harvest` (
  `HarvestID` int(11) NOT NULL,
  `HarvestDate` varchar(20) DEFAULT NULL,
  `QuantityHarvestest` varchar(20) DEFAULT NULL,
  `VarietyID` int(11) DEFAULT NULL,
  `farmid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harvest`
--

INSERT INTO `harvest` (`HarvestID`, `HarvestDate`, `QuantityHarvestest`, `VarietyID`, `farmid`) VALUES
(56, '4000', 'mine', 24, 19),
(57, '2024-04-27', '000998777', 24, 16);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SalesID` int(11) NOT NULL,
  `SaleDate` varchar(20) DEFAULT NULL,
  `BuyerName` varchar(20) DEFAULT NULL,
  `QuantitySold` varchar(20) DEFAULT NULL,
  `Totalprice` varchar(20) DEFAULT NULL,
  `harvestID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SalesID`, `SaleDate`, `BuyerName`, `QuantitySold`, `Totalprice`, `harvestID`) VALUES
(12, '2099', 'kaline', 'soso', '2000', 56),
(13, '2099', 'kalisa', 'soso', '2000', 56),
(14, 'thhh', 'dfg', '2345', '23456', 56);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'vanessa', 'uwase', 'uwase', 'uwaseva@gmail.com', 'o789888888', '$2y$10$Nhxq7oW.wYogoKSkYvWAh.MOr1BPVe1e84L9ZadNliOfZWPILLHeS', '2024-04-08 16:03:48', '556666', 0),
(2, 'uwase', 'vanessa', 'vava', 'uwasevanessa@gmail.com', '098754', '$2y$10$uVUX8BV/6OWDGBIjHA.w4OV3qEtWFoNIQ2m7FymNrsoTITHzg0fEi', '2024-04-08 16:12:23', '66', 0),
(3, 'karangwa', 'parfait', 'karangwa', 'karangwaparfait@gmail.com', '03456788', '$2y$10$r0lbF4FJ9GgraBcdWm6/S.X2NisSrHz/jQDD178sTS8XSJkGZXWlS', '2024-04-08 16:38:30', '67890', 0),
(4, 'kamikazi', 'sandrine', 'sando', 'kamikazisandrine@gmail.com', '9988987', '$2y$10$HDJUBpwNZcX39qZ95n41yuaz4apI5tldTJmEn7aMZ6WOCRIFa49Vi', '2024-04-08 18:10:52', '1234', 0),
(5, 'kdb', 'kdb', 'kane', 'kdb@gmail.com', '9098775322', '$2y$10$/ZTsYbl5pWw8N1nNU6v9IeXGlHi6Q11tX.oNwPj9uYXdwcHF2LxGW', '2024-04-08 18:36:49', '345', 0),
(6, 'kamikazi', 'daniela', 'kam', 'kamikazi@gmail.com', '089090909', '$2y$10$rX3aiHb978Lre9Cd5NTliee5Fnx1567vim/m.5mmqU60JD1tNepRG', '2024-04-22 16:33:26', '7890998', 0),
(7, 'kanyemera', 'jean de la croix', 'kanyemera', 'kanyemerajeandelacroix77@gmail.com', '0789847280', '$2y$10$tTxIcRGui6lhvQwepsbwkO.sYUnq69yhZlu691Bx6OFcYOmJNBi1O', '2024-04-25 19:34:03', '70', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coffeevarieties`
--
ALTER TABLE `coffeevarieties`
  ADD PRIMARY KEY (`VarietyID`);

--
-- Indexes for table `farm`
--
ALTER TABLE `farm`
  ADD PRIMARY KEY (`farmid`),
  ADD KEY `Farmerid` (`Farmerid`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`farmerid`);

--
-- Indexes for table `harvest`
--
ALTER TABLE `harvest`
  ADD PRIMARY KEY (`HarvestID`),
  ADD KEY `farmid` (`farmid`),
  ADD KEY `VarietyID` (`VarietyID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SalesID`),
  ADD KEY `harvestID` (`harvestID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coffeevarieties`
--
ALTER TABLE `coffeevarieties`
  MODIFY `VarietyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `farm`
--
ALTER TABLE `farm`
  MODIFY `farmid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `farmerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `harvest`
--
ALTER TABLE `harvest`
  MODIFY `HarvestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SalesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `farm`
--
ALTER TABLE `farm`
  ADD CONSTRAINT `farm_ibfk_1` FOREIGN KEY (`Farmerid`) REFERENCES `farmer` (`farmerid`);

--
-- Constraints for table `harvest`
--
ALTER TABLE `harvest`
  ADD CONSTRAINT `harvest_ibfk_1` FOREIGN KEY (`farmid`) REFERENCES `farm` (`farmid`),
  ADD CONSTRAINT `harvest_ibfk_2` FOREIGN KEY (`VarietyID`) REFERENCES `coffeevarieties` (`VarietyID`),
  ADD CONSTRAINT `harvest_ibfk_3` FOREIGN KEY (`farmid`) REFERENCES `farm` (`farmid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `harvest_ibfk_4` FOREIGN KEY (`VarietyID`) REFERENCES `coffeevarieties` (`VarietyID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `harvest_ibfk_5` FOREIGN KEY (`VarietyID`) REFERENCES `coffeevarieties` (`VarietyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`harvestID`) REFERENCES `harvest` (`HarvestID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
