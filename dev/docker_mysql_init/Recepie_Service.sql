-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Erstellungszeit: 29. Mai 2023 um 14:41
-- Server-Version: 10.11.3-MariaDB-1:10.11.3+maria~ubu2204
-- PHP-Version: 8.1.19

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
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`ID`, `name`) VALUES
(1, 'Ramen'),
(2, 'Nudeln'),
(3, 'Süßigkeiten');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `country`
--

CREATE TABLE `country` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `country`
--

INSERT INTO `country` (`ID`, `name`, `short_name`) VALUES
(3, 'Deutschland', 'DE'),
(4, 'Japan', 'JP'),
(5, 'Italien', 'IT');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ingredient`
--

CREATE TABLE `ingredient` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `ingredient`
--

INSERT INTO `ingredient` (`ID`, `name`) VALUES
(1, 'Zwiebel'),
(2, 'Wasser'),
(3, 'Müll'),
(8, 'Spaghetti Nudeln');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipie`
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
-- Daten für Tabelle `recipie`
--

INSERT INTO `recipie` (`title`, `country`, `image_path`, `description`, `id`, `score`, `slug`) VALUES
('Leitungswasser', 3, 'c3088096c996ba7286364497221155e5-1702189647_03d15f58b0_o.jpg', 'Leckeres Wasser aus der Leitung.Man öffne den Hahn und zapfe dieses exquisite Gut.', '4e605ea3-dad7-11ed-9a45-0242ac130002', 5, 'leitungswasser'),
('Zwiebelramen', 4, 'aa29a06b23357e9bb6d94bf4f11e863a-522_2PV2_Miso_Onion_Ramen_4.jpg', 'Zwiebelramen ist Ramen mit Zwiebeln.', 'd958a0b6-e446-11ed-9b5e-0242ac140005', 0, 'zwiebelramen'),
('Müll', 3, 'd71bd869f724bd9bedb65b2490e1e1ee-mehr-muell-durch-corona-sel.jpg', 'Müll findet man überall, hat aber nicht so viel Nährwert.', 'f4446ad6-dae7-11ed-89a6-0242ac150002', 1.4, 'muell'),
('Spaghetti mit Tomatensoße', 3, 'd03cefacf5fb4aae95e32a33f9e786d1-spaghetti-with-tomato-sauce.jpg', 'Die beste Form der Nudeln.', 'bd76b524-fe2e-11ed-b25f-0242c0a87005', 0, 'bd76b524-fe2e-11ed-b25f-0242c0a87005');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipie_category`
--

CREATE TABLE `recipie_category` (
  `ID` int(11) NOT NULL,
  `recipie` uuid NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `recipie_category`
--

INSERT INTO `recipie_category` (`ID`, `recipie`, `category`) VALUES
(1, 'd958a0b6-e446-11ed-9b5e-0242ac140005', 1),
(24, 'bd76b524-fe2e-11ed-b25f-0242c0a87005', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipie_country`
--

CREATE TABLE `recipie_country` (
  `ID` int(11) NOT NULL,
  `recipie` uuid NOT NULL,
  `country` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `recipie_country`
--

INSERT INTO `recipie_country` (`ID`, `recipie`, `country`) VALUES
(1, 'bd76b524-fe2e-11ed-b25f-0242c0a87005', 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipie_ingredient`
--

CREATE TABLE `recipie_ingredient` (
  `ID` int(11) NOT NULL,
  `recipie` uuid NOT NULL,
  `ingredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `recipie_ingredient`
--

INSERT INTO `recipie_ingredient` (`ID`, `recipie`, `ingredient`) VALUES
(1, '4e605ea3-dad7-11ed-9a45-0242ac130002', 1),
(2, 'f4446ad6-dae7-11ed-89a6-0242ac150002', 1),
(3, 'd958a0b6-e446-11ed-9b5e-0242ac140005', 1),
(4, 'd958a0b6-e446-11ed-9b5e-0242ac140005', 2),
(69, 'bd76b524-fe2e-11ed-b25f-0242c0a87005', 8);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipie_tag`
--

CREATE TABLE `recipie_tag` (
  `ID` int(11) NOT NULL,
  `recipie` uuid NOT NULL,
  `tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `recipie_tag`
--

INSERT INTO `recipie_tag` (`ID`, `recipie`, `tag`) VALUES
(12, 'bd76b524-fe2e-11ed-b25f-0242c0a87005', 12),
(13, 'bd76b524-fe2e-11ed-b25f-0242c0a87005', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tag`
--

CREATE TABLE `tag` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tag`
--

INSERT INTO `tag` (`ID`, `name`) VALUES
(1, 'Scharf'),
(2, 'Bitter'),
(12, 'Spaghetti');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_pass`
--

CREATE TABLE `user_pass` (
  `ID` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user_pass`
--

INSERT INTO `user_pass` (`ID`, `username`, `password`, `email`) VALUES
(1, 'admin', '$argon2id$v=19$m=65536,t=4,p=1$bDA5S0JpVU9SUVVudFJWeA$2QDi4JZ2P9I33l0F166pxRfwvkC+eV4U3J0kUmBWg8o', 'admin');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `recipie`
--
ALTER TABLE `recipie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country` (`country`);

--
-- Indizes für die Tabelle `recipie_category`
--
ALTER TABLE `recipie_category`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `recipie` (`recipie`),
  ADD KEY `category` (`category`);

--
-- Indizes für die Tabelle `recipie_country`
--
ALTER TABLE `recipie_country`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `recipie_ingredient`
--
ALTER TABLE `recipie_ingredient`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `recipie` (`recipie`),
  ADD KEY `ingredigent` (`ingredient`) USING BTREE;

--
-- Indizes für die Tabelle `recipie_tag`
--
ALTER TABLE `recipie_tag`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `user_pass`
--
ALTER TABLE `user_pass`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `country`
--
ALTER TABLE `country`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `recipie_category`
--
ALTER TABLE `recipie_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `recipie_country`
--
ALTER TABLE `recipie_country`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `recipie_ingredient`
--
ALTER TABLE `recipie_ingredient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT für Tabelle `recipie_tag`
--
ALTER TABLE `recipie_tag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `tag`
--
ALTER TABLE `tag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `user_pass`
--
ALTER TABLE `user_pass`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `recipie`
--
ALTER TABLE `recipie`
  ADD CONSTRAINT `country` FOREIGN KEY (`country`) REFERENCES `country` (`ID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
