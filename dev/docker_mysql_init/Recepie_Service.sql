-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Erstellungszeit: 14. Apr 2023 um 17:42
-- Server-Version: 10.11.2-MariaDB-1:10.11.2+maria~ubu2204
-- PHP-Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `Recepie_Service`
--
CREATE DATABASE IF NOT EXISTS `Recepie_Service` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Recepie_Service`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `countries`
--

INSERT INTO `countries` (`ID`, `name`, `short_name`) VALUES
(3, 'Deutschland', 'DE'),
(4, 'Japan', 'JP');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipies`
--

CREATE TABLE `recipies` (
  `title` varchar(40) DEFAULT NULL COMMENT 'title of the recipe',
  `country` int(11) DEFAULT NULL COMMENT 'id of the correspondin country',
  `image_path` varchar(32) DEFAULT NULL COMMENT 'name of the image should be a md5 hex name, we dont keep the original name',
  `description` text DEFAULT NULL COMMENT 'description',
  `id` uuid NOT NULL DEFAULT uuid() COMMENT 'primary key',
  `slug` varchar(40) DEFAULT uuid() COMMENT 'url for the detail page',
  `score` float UNSIGNED NOT NULL DEFAULT 0 COMMENT '"Nutriscore", score of the recipe'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='stores the recipies';

--
-- Daten für Tabelle `recipies`
--

INSERT INTO `recipies` (`title`, `country`, `image_path`, `description`, `id`, `slug`, `score`) VALUES
('Leitungswasser', 3, NULL, 'Leckeres Wasser aus der Leitung.\\n\\nMan öffne den Hahn und zapfe dieses exquisite Gut.', '4e605ea3-dad7-11ed-9a45-0242ac130002', '182e828c-dae9-11ed-89a6-0242ac150002', 0),
('Müll', 3, NULL, 'Müll findet man überall, hat aber nicht so viel Nährwert.', 'f4446ad6-dae7-11ed-89a6-0242ac150002', '182e82ed-dae9-11ed-89a6-0242ac150002', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_pass`
--

CREATE TABLE `user_pass` (
  `ID` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user_pass`
--

INSERT INTO `user_pass` (`ID`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `recipies`
--
ALTER TABLE `recipies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country` (`country`);

--
-- Indizes für die Tabelle `user_pass`
--
ALTER TABLE `user_pass`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `countries`
--
ALTER TABLE `countries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `user_pass`
--
ALTER TABLE `user_pass`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `recipies`
--
ALTER TABLE `recipies`
  ADD CONSTRAINT `country` FOREIGN KEY (`country`) REFERENCES `countries` (`ID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
