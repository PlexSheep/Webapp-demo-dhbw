-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 17, 2023 at 02:09 PM
-- Server version: 10.11.2-MariaDB-1:10.11.2+maria~ubu2204
-- PHP Version: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Recepie_Service`
--
CREATE DATABASE IF NOT EXISTS `Recepie_Service` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Recepie_Service`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `name`) VALUES
(1, 'Ramen');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`ID`, `name`, `short_name`) VALUES
(3, 'Deutschland', 'DE'),
(4, 'Japan', 'JP');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ID`, `name`, `description`) VALUES
(1, 'Zwiebel', 'Zwiebel'),
(2, 'Wasser', ''),
(3, 'Müll', '');

-- --------------------------------------------------------

--
-- Table structure for table `recipie`
--

CREATE TABLE `recipie` (
  `title` varchar(40) DEFAULT NULL COMMENT 'title of the recipe',
  `country` int(11) DEFAULT NULL COMMENT 'id of the correspondin country',
  `image_path` varchar(64) DEFAULT NULL COMMENT 'name of the image should be a md5 hex name, we dont keep the original name',
  `description` text DEFAULT NULL COMMENT 'description',
  `id` uuid NOT NULL DEFAULT uuid() COMMENT 'primary key',
  `score` float UNSIGNED NOT NULL DEFAULT 0 COMMENT '"Nutriscore", score of the recipe',
  `slug` varchar(40) NOT NULL DEFAULT uuid() COMMENT 'referer for the detail.php view'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='stores the recipies';

--
-- Dumping data for table `recipie`
--

INSERT INTO `recipie` (`title`, `country`, `image_path`, `description`, `id`, `score`, `slug`) VALUES
('Leitungswasser', 3, 'c3088096c996ba7286364497221155e5-1702189647_03d15f58b0_o.jpg', 'Leckeres Wasser aus der Leitung.Man öffne den Hahn und zapfe dieses exquisite Gut.', '4e605ea3-dad7-11ed-9a45-0242ac130002', 5, 'leitungswasser'),
('Zwiebelramen', 4, 'aa29a06b23357e9bb6d94bf4f11e863a-522_2PV2_Miso_Onion_Ramen_4.jpg', 'Zwiebelramen ist Ramen mit Zwiebeln.', 'd958a0b6-e446-11ed-9b5e-0242ac140005', 0, 'zwiebelramen'),
('Müll', 3, 'd71bd869f724bd9bedb65b2490e1e1ee-mehr-muell-durch-corona-sel.jpg', 'Müll findet man überall, hat aber nicht so viel Nährwert.', 'f4446ad6-dae7-11ed-89a6-0242ac150002', 1.4, 'muell');

-- --------------------------------------------------------

--
-- Table structure for table `recipie_category`
--

CREATE TABLE `recipie_category` (
  `ID` int(11) NOT NULL,
  `recipie` uuid NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipie_category`
--

INSERT INTO `recipie_category` (`ID`, `recipie`, `category`) VALUES
(1, 'd958a0b6-e446-11ed-9b5e-0242ac140005', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recipie_ingredient`
--

CREATE TABLE `recipie_ingredient` (
  `ID` int(11) NOT NULL,
  `recipie` uuid NOT NULL,
  `ingredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipie_ingredient`
--

INSERT INTO `recipie_ingredient` (`ID`, `recipie`, `ingredient`) VALUES
(1, '4e605ea3-dad7-11ed-9a45-0242ac130002', 1),
(2, 'f4446ad6-dae7-11ed-89a6-0242ac150002', 1),
(3, 'd958a0b6-e446-11ed-9b5e-0242ac140005', 1),
(4, 'd958a0b6-e446-11ed-9b5e-0242ac140005', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_pass`
--

CREATE TABLE `user_pass` (
  `ID` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_pass`
--

INSERT INTO `user_pass` (`ID`, `username`, `password`, `email`) VALUES
(1, 'admin', '$argon2id$v=19$m=65536,t=4,p=1$bDA5S0JpVU9SUVVudFJWeA$2QDi4JZ2P9I33l0F166pxRfwvkC+eV4U3J0kUmBWg8o', 'admin@adm.de'),
(10, 'test', '$argon2id$v=19$m=65536,t=4,p=1$Y211TmtmQW5xTGpiYXJ4NQ$5IL/WDyfETFvWEYLaSH7+qumSKxwXr/OnfPZ99qYtZo', 'test@t.de');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `recipie`
--
ALTER TABLE `recipie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country` (`country`);

--
-- Indexes for table `recipie_category`
--
ALTER TABLE `recipie_category`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `recipie` (`recipie`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `recipie_ingredient`
--
ALTER TABLE `recipie_ingredient`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `recipie` (`recipie`),
  ADD KEY `ingredient` (`ingredient`) USING BTREE;

--
-- Indexes for table `user_pass`
--
ALTER TABLE `user_pass`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recipie_category`
--
ALTER TABLE `recipie_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipie_ingredient`
--
ALTER TABLE `recipie_ingredient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_pass`
--
ALTER TABLE `user_pass`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipie`
--
ALTER TABLE `recipie`
  ADD CONSTRAINT `country` FOREIGN KEY (`country`) REFERENCES `country` (`ID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
