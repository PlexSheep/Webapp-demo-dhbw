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
(1, 'Ramen'),
(2, 'Nudeln'),
(3, 'Süßigkeiten');

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
(4, 'Japan', 'JP'),
(5, 'Italien', 'IT');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ingredient
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
('Müll', 3, 'd71bd869f724bd9bedb65b2490e1e1ee-mehr-muell-durch-corona-sel.jpg', 'Müll findet man überall, hat aber nicht so viel Nährwert.', 'f4446ad6-dae7-11ed-89a6-0242ac150002', 1.4, 'muell'),
('Spaghetti mit Tomatensoße', 3, 'd03cefacf5fb4aae95e32a33f9e786d1-spaghetti-with-tomato-sauce.jpg', 'Die beste Form der Nudeln.', 'bd76b524-fe2e-11ed-b25f-0242c0a87005', 0, 'bd76b524-fe2e-11ed-b25f-0242c0a87005');

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
(29, 'SMITH\n', '$argon2id$v=19$m=65536,t=4,p=1$ZkRjNVJVaU83M1E1U3EuMg$ANBFNE+qN31RzlANFQGVsFoqS1LHqLJ/iNlQxt9p1YA', 'SMITH\n@test.com'),
(30, 'JOHNSON\n', '$argon2id$v=19$m=65536,t=4,p=1$ZVNpUkhoQnVWOUtKTXluLg$EzNb5ZfUmYf3mXb4G730jW+/Nsw+zSk9kB6q8H0ytfo', 'JOHNSON\n@test.com'),
(31, 'WILLIAMS\n', '$argon2id$v=19$m=65536,t=4,p=1$N3kuS1hDd3NYUksuLmVSWg$AmgT8UzXPSxbRVBlsc/nM9YFCadI2R4xovWqPpQcRQ4', 'WILLIAMS\n@test.com'),
(32, 'JONES\n', '$argon2id$v=19$m=65536,t=4,p=1$Nk1xQ3Z4cnpYSGdNZTYuMQ$aEY2SXRcZDhtfBbvRzlQcvuFBhLJaw+/GgCX1HVRvrk', 'JONES\n@test.com'),
(33, 'BROWN\n', '$argon2id$v=19$m=65536,t=4,p=1$dzJKU01ueS8vZVpFd3FiYQ$jHYyiDoo5hj7MJil3qICEg5W+mSpJLMlgtCTV8d43gc', 'BROWN\n@test.com'),
(35, 'MILLER\n', '$argon2id$v=19$m=65536,t=4,p=1$VkUvcmdTQzlXRC9xTXlmRQ$Sh7T5T54Sik+5SgDpXfla056pNErv0VVKiKb1wmxRVc', 'MILLER\n@test.com'),
(36, 'WILSON\n', '$argon2id$v=19$m=65536,t=4,p=1$NDlURFAvSzRURVQ0cGd0NA$IrrZSMngarh8ldgvrPrNqToC8KodW18iJVdrWeRf+ec', 'WILSON\n@test.com'),
(37, 'MOORE\n', '$argon2id$v=19$m=65536,t=4,p=1$RVhsaUQ2bHZWUHkxM1BHNA$lwsqaaaCaVJ8wvyoj9mSSlXVMg9aOT41WNcRHucD12w', 'MOORE\n@test.com'),
(38, 'TAYLOR\n', '$argon2id$v=19$m=65536,t=4,p=1$eXlabEVDaEkvN3gwQkIuVA$EA11LSyPJ2MxfCzC3wXAcscOcEZmyWSlz7kElb/8LDg', 'TAYLOR\n@test.com'),
(39, 'ANDERSON\n', '$argon2id$v=19$m=65536,t=4,p=1$TkR6MFFHelJhTXF2d0dORQ$MvKDcFn+o25ufFERB5Hled1y3Bp0iZuNFcSqYLUrlvQ', 'ANDERSON\n@test.com'),
(40, 'THOMAS\n', '$argon2id$v=19$m=65536,t=4,p=1$QWZBMkF1RjNXQlUuTGN4aw$atRMxU50KcB9NGgPAZ7qc9+oxwZbDKQRgGbwG7u6OSc', 'THOMAS\n@test.com'),
(41, 'JACKSON\n', '$argon2id$v=19$m=65536,t=4,p=1$ZTd0OFh1dS5sS2tBSXVFVA$LI0oQRG/c1wr6ISESKmdLqJDLX/sWaSq+dPBThcO0M8', 'JACKSON\n@test.com'),
(42, 'WHITE\n', '$argon2id$v=19$m=65536,t=4,p=1$YzdpUXdQaUc5cmN1dy83OA$m93Iat0YOXrSlsh55dbf4G0A0cuBN8nJJwJJ5CU5fls', 'WHITE\n@test.com'),
(43, 'HARRIS\n', '$argon2id$v=19$m=65536,t=4,p=1$ZFRHdGVJQ0c1QTBVenFwUQ$JCGWkhXMFkgBUNNywUGtVMJw2MsRfCC9IaWLdpqWD0M', 'HARRIS\n@test.com'),
(44, 'MARTIN\n', '$argon2id$v=19$m=65536,t=4,p=1$MVdrSGUvSHFtTmFBWElwUw$oX7yys9tIymBy9nm/c0kMZL0PWAUr+tdk/G18nev5JM', 'MARTIN\n@test.com'),
(45, 'THOMPSON\n', '$argon2id$v=19$m=65536,t=4,p=1$Unh0eDlLQjJacXRRUHpZdQ$/J5cAJvxi14oCQUsxlF0F3htUlR5ZqNdz0qPdJq+y+Y', 'THOMPSON\n@test.com'),
(46, 'GARCIA\n', '$argon2id$v=19$m=65536,t=4,p=1$LktzMWJqQi5KcVZ4Ujk4Mg$5qrLMskPmLsa+yVe2ZI65GhqX26z6dCXumSjAZbjF58', 'GARCIA\n@test.com'),
(47, 'MARTINEZ\n', '$argon2id$v=19$m=65536,t=4,p=1$Vjd1TC9YL1FQRm82UDZkUg$ZZy59CGVCTZgWrzQJGwbCkCubnZTXDoq41p/nqD3SEA', 'MARTINEZ\n@test.com'),
(48, 'ROBINSON\n', '$argon2id$v=19$m=65536,t=4,p=1$TkliQk9ESzRuT0NORS9oZA$U9D5OwdGy/Gkv8SdBT1MlUZfXU2ZIz8aP0+5hejF+yE', 'ROBINSON\n@test.com'),
(49, 'CLARK\n', '$argon2id$v=19$m=65536,t=4,p=1$eFlVbWloUWtzUE4vZ1FXLg$g8ipCQm0sA7TXFeVP87jvzIRs1bf2ypmLBrg0CTzffg', 'CLARK\n@test.com'),
(50, 'RODRIGUEZ\n', '$argon2id$v=19$m=65536,t=4,p=1$UDRXdXZqQWlyT1ZMd1VpOA$4ZxQLxD9kTh3Fi3/8+9ji8DqJS3+7boNz4ujefiiLgY', 'RODRIGUEZ\n@test.com'),
(51, 'LEWIS\n', '$argon2id$v=19$m=65536,t=4,p=1$YWRWM0xXc2F3VU1RZC9iOA$795I4E936Yfhkee7/salCVFWaZwk659hONm/GJ3o+9c', 'LEWIS\n@test.com'),
(52, 'LEE\n', '$argon2id$v=19$m=65536,t=4,p=1$anJsNTEwWGxwZ011V2R5cg$QIM3wgPc5eTBc1t9lWbIHdhsp2vGqyp/Cyzd2wPeebM', 'LEE\n@test.com'),
(53, 'WALKER\n', '$argon2id$v=19$m=65536,t=4,p=1$azdDODVBdTVqR2dMeXFpOA$n9S6WFl2vZrkCekgbTx15Q6wjScP1SkVpj4JL655sHg', 'WALKER\n@test.com'),
(54, 'HALL\n', '$argon2id$v=19$m=65536,t=4,p=1$eENMSlR4UHNkZHIzY2U1eg$9X6RkMvzBIrLuKGDS8+x1HIqhs4Eb0jO/Il2gcp8ke4', 'HALL\n@test.com'),
(55, 'ALLEN\n', '$argon2id$v=19$m=65536,t=4,p=1$T0IxSFpXYzdWR2tGTWpwYQ$UqmYulIDcUREY9pScpDGT+gX3l8AzefR3Y/3TPk8Es0', 'ALLEN\n@test.com'),
(56, 'YOUNG\n', '$argon2id$v=19$m=65536,t=4,p=1$WXppdlRjc0xISUdOeXlYNA$6FOw3BLimOeb5oRJt4jWKtVuRYcdXzOjcx7BCm67Kz8', 'YOUNG\n@test.com'),
(57, 'HERNANDEZ\n', '$argon2id$v=19$m=65536,t=4,p=1$NTN4bzJzVi9WNS5Xd0dEeA$9kM7Bv0yiDXwokGfZj5wp3YtmJp8g0eoua79yglbneA', 'HERNANDEZ\n@test.com'),
(58, 'KING\n', '$argon2id$v=19$m=65536,t=4,p=1$MFdqamtSalBOd1ZxNHg1WA$NzbmHXleVwdL524DZbdAkSfSaiQ9JWajE4BuGe/w7Kw', 'KING\n@test.com'),
(59, 'WRIGHT\n', '$argon2id$v=19$m=65536,t=4,p=1$Y1RnMlBlUEtXUmFYZkVISg$nLMJc7Dk78xSv/e7VLdHoar2LfAnUh8stPJG0JtURBA', 'WRIGHT\n@test.com'),
(60, 'LOPEZ\n', '$argon2id$v=19$m=65536,t=4,p=1$N1FOU3dXWUxVQzF4dUlEbg$JQRR+u8ibb5bqYUuD3eQ5Q6ALXXnFLqYfsCwIuPKdZM', 'LOPEZ\n@test.com'),
(61, 'HILL\n', '$argon2id$v=19$m=65536,t=4,p=1$UWpWdFN5cjU4aDBlWEVlbw$LHU1pO5wnZMige0Is2Xu2FrhqFF3/f20H7DQ4/9iEZM', 'HILL\n@test.com'),
(62, 'SCOTT\n', '$argon2id$v=19$m=65536,t=4,p=1$ZGxZV3RkNy56T0RSWkN2SQ$Bs5LD0KUZAKedmhFxzVKcJhj08xRXBHS4pIgaOmcSps', 'SCOTT\n@test.com'),
(63, 'GREEN\n', '$argon2id$v=19$m=65536,t=4,p=1$bzIxYi9CYWFWL0dpNG40Qg$mC5ucmsMPf35+dXtqA1VLNtjqApgYmW830mHuBHbVzc', 'GREEN\n@test.com'),
(64, 'ADAMS\n', '$argon2id$v=19$m=65536,t=4,p=1$eTdkQWFSMXVlRXFIbW1mbA$NZ6IHiDqCruEwLEwMlWrgEQGGIB5hKPJLiE3LvZ0vXI', 'ADAMS\n@test.com'),
(65, 'BAKER\n', '$argon2id$v=19$m=65536,t=4,p=1$OTBNbGNzVjMueG11NC9QdQ$7qPLnlRJTsCJyHSgpqBuArP+pksWBAOSmDoLHvcNhIA', 'BAKER\n@test.com'),
(66, 'GONZALEZ\n', '$argon2id$v=19$m=65536,t=4,p=1$bGdueWgvV3NySEVFdDFCbA$Ty3S5JF27jcnMKu/z7OFZang1yNsmHRvGqt25/Djv5c', 'GONZALEZ\n@test.com'),
(67, 'NELSON\n', '$argon2id$v=19$m=65536,t=4,p=1$elpJd0hvWmtkdHQycWF5Zw$4wVeTxwZ/Sh2qJ1tOU1Ft1ytSCJt+lIls4CtzFzEchM', 'NELSON\n@test.com'),
(68, 'CARTER\n', '$argon2id$v=19$m=65536,t=4,p=1$Y1VXY0tWNGVzZzFxWG05ag$YQp06J38OIrkpsgK49WISm0b+lz94x1TwAgMT69uHRM', 'CARTER\n@test.com'),
(69, 'MITCHELL\n', '$argon2id$v=19$m=65536,t=4,p=1$elRXUExHRnFEcVRacGRjTg$oGDc3+jxCmPHTwc4hmIPB0T6HWaUV7H2RnDJjcO1UPs', 'MITCHELL\n@test.com'),
(70, 'PEREZ\n', '$argon2id$v=19$m=65536,t=4,p=1$WFFVR1EyYjlValZaRU5kVQ$qcS5Y6npdv13zbAk5BOmv8mSKi6V46mJP/ZWWxSIZCA', 'PEREZ\n@test.com'),
(71, 'DAVIS\n', '$argon2id$v=19$m=65536,t=4,p=1$UjZHWjlMQnFZT05yZlFtOA$SYTLO9OJrMsuy0vWfXxYD4ZvhNMNbW1lMTROss7IBM4', 'DAVIS\n@test.com'),
(72, 'ROBERTS\n', '$argon2id$v=19$m=65536,t=4,p=1$bE1PYnZmbUVUTlhqNm50dQ$MihsxLWhIEYYEJNaLmLm4yUHtkls7uIRiopktfepbSE', 'ROBERTS\n@test.com'),
(73, 'TURNER\n', '$argon2id$v=19$m=65536,t=4,p=1$UTZlV1oxRlZwM1puSGdBcw$ngiIi8UjLcRVq4BkLABIU14Os3cI+UxqH/EJgJJ7yO0', 'TURNER\n@test.com'),
(74, 'PHILLIPS\n', '$argon2id$v=19$m=65536,t=4,p=1$ekV0bWREWWRqNWpRMVZHLg$wOFcKGzWCtucleuU3KTjOdSyN29QVQkChFyVlkm+xOE', 'PHILLIPS\n@test.com'),
(75, 'CAMPBELL\n', '$argon2id$v=19$m=65536,t=4,p=1$SnNaMWR3Q09MdVFkMnl0RQ$aAdJt2TsOgQuEcExK4hv6lsuLm6rzV9hotMqXWZFhK4', 'CAMPBELL\n@test.com'),
(76, 'PARKER\n', '$argon2id$v=19$m=65536,t=4,p=1$L3phUnA4UFI0YlpQL1hDYw$yV4S995MYSMR8eZgS/vwrX4gyoiHaXYy5atFE+GlxjE', 'PARKER\n@test.com'),
(77, 'EVANS\n', '$argon2id$v=19$m=65536,t=4,p=1$a2FIRmI2RGtCakQ3WVl5Rg$uj35m0v17iu6cmwiq/Y1m6ZeYEFvrRQSxXizeRBo5Ms', 'EVANS\n@test.com'),
(78, 'EDWARDS\n', '$argon2id$v=19$m=65536,t=4,p=1$REVLUFdPWnBveWNrOUpzcA$KfPGFO+BKpliSgJa6xDeiEv/AgagZu5UItUFE1b0C3g', 'EDWARDS\n@test.com'),
(79, 'COLLINS\n', '$argon2id$v=19$m=65536,t=4,p=1$d1FBaFplN09IQzVCVlhSZg$Gk6HkN9ZgaS/kYaWljXW/8kgonOGw8kESdbYruZ6OOA', 'COLLINS\n@test.com'),
(80, 'STEWART\n', '$argon2id$v=19$m=65536,t=4,p=1$bHJmSlB1dWhEWGhySmJabg$MhbxF71JLwlwN4joUehMI9TRc6QrbgWKLu2uhH4d0KM', 'STEWART\n@test.com'),
(81, 'SANCHEZ\n', '$argon2id$v=19$m=65536,t=4,p=1$YWtMWXdBWTIvekt4VmhrSg$MECqCgj0QR2PwcxGqCvPgwby2M7w/yIPCLxm4vw+2kQ', 'SANCHEZ\n@test.com'),
(82, 'MORRIS\n', '$argon2id$v=19$m=65536,t=4,p=1$ekRQanRZUTBJaTc0dGc0Sg$d0oN6Xj8OO0M2omXkwFvpQMqEiCkqGijKm8oNgB9LeM', 'MORRIS\n@test.com'),
(83, 'ROGERS\n', '$argon2id$v=19$m=65536,t=4,p=1$L0F3SzA1Ry5KOW1FcERLdQ$an7/gSo3MCYLzSj7hHK0z/VxJbTtzcO8s+Z2U+Oeo2A', 'ROGERS\n@test.com'),
(84, 'REED\n', '$argon2id$v=19$m=65536,t=4,p=1$UjVGT0hzb1RxSDMvdWlUeg$IoyYiihv5+T0Mp5b+8CQWo62s9OAkF0drcjs+whWTzQ', 'REED\n@test.com'),
(85, 'COOK\n', '$argon2id$v=19$m=65536,t=4,p=1$emRxaFBKQmlmaUQ0MUVwVg$MOW5pSZl2O+k0w6cDp/v7mWAhIN5RIHbs5NDeqqSI/U', 'COOK\n@test.com'),
(86, 'MORGAN\n', '$argon2id$v=19$m=65536,t=4,p=1$aTZUVXVmMG5EdkJPT0taWA$aR/JrI5M0e/iHeH6EjvIa4Wz2s7Nt/XaYbAsubhJO8Q', 'MORGAN\n@test.com'),
(87, 'BELL\n', '$argon2id$v=19$m=65536,t=4,p=1$eWcwcmptM0tYblJBVTZDeA$VdVUbfRNvgC8Wc2y7NIwMGPnqPr3nyko2+swgZaPd6E', 'BELL\n@test.com'),
(88, 'MURPHY\n', '$argon2id$v=19$m=65536,t=4,p=1$OS5tamlranlOS3JGcHouYw$OIr2khXO8OPFwJepEKOcs7ete92h8hZFvYhwfwrClzY', 'MURPHY\n@test.com'),
(89, 'BAILEY\n', '$argon2id$v=19$m=65536,t=4,p=1$N0dPR3cyQTgzSFM3cUJ5Mw$1rbiqFsx14/c5EsiD8CsXOMC3AFqVceW6LdQcObPdRY', 'BAILEY\n@test.com'),
(90, 'RIVERA\n', '$argon2id$v=19$m=65536,t=4,p=1$ejBveHJzSkx5VnZVa2FHRg$sHpccoUcUKImACSKFNQUYj1w00Lw7pE+Oyv6L/KQxps', 'RIVERA\n@test.com'),
(91, 'COOPER\n', '$argon2id$v=19$m=65536,t=4,p=1$c1BObWo1a3dDQzcxMmtuSA$msG+JzROSn9h6KEK1LMiEIZholVLLv2oGBg//a/NVnY', 'COOPER\n@test.com'),
(92, 'RICHARDSON\n', '$argon2id$v=19$m=65536,t=4,p=1$Umt2UVBuRDBzQkE5QUNBYQ$3Ayi5CiDR3ZEtMpyxpE+BvKmQbMNHrSvDCeTjQImI2M', 'RICHARDSON\n@test.com'),
(93, 'COX\n', '$argon2id$v=19$m=65536,t=4,p=1$OUI4NHVxM1JIVEFmdDJmdA$WQ/DlXRqLbernp0mVByTGx6UFXXoZXkFZsrk38sxaGM', 'COX\n@test.com'),
(94, 'HOWARD\n', '$argon2id$v=19$m=65536,t=4,p=1$VEtJcjEuczZYT0dSOGcwaA$3hO36bWTv/hvlTHLUG3Bx2fDN/R+SvIR6v5gv/DxeKE', 'HOWARD\n@test.com'),
(95, 'WARD\n', '$argon2id$v=19$m=65536,t=4,p=1$S0tGd2RPdVFOd1l5SGkuTg$a+CS/Mf/Z6TweCN5v8p4WjAlX1wX0AR1KUQ4/Z96I98', 'WARD\n@test.com'),
(96, 'TORRES\n', '$argon2id$v=19$m=65536,t=4,p=1$QnBWOWE5b3Z4QWxXVC5MNg$m5/oqB4dSt38d7YZuYvsqsW+OQCYiBnDQAv/puTCowA', 'TORRES\n@test.com'),
(97, 'PETERSON\n', '$argon2id$v=19$m=65536,t=4,p=1$RDVvbndsdWZlaDRENFZyWA$ERpJKp1UuptzJt8/2eTD5o9OhMbJ5DlkWGEhJnwi638', 'PETERSON\n@test.com'),
(98, 'GRAY\n', '$argon2id$v=19$m=65536,t=4,p=1$OHRpejc0dHhPNG1DRjd5UQ$t8mD0gDW1WiYA7SYSOfxc3TJC0srSJLTq/JmdjTy8zY', 'GRAY\n@test.com'),
(99, 'RAMIREZ\n', '$argon2id$v=19$m=65536,t=4,p=1$Sno2NmxhQmE0SG5RTlAvaQ$QcEg4dDwhu66Yoo2QQTbtDN6TOrqLq7757OfNLWjtQc', 'RAMIREZ\n@test.com'),
(100, 'JAMES\n', '$argon2id$v=19$m=65536,t=4,p=1$QjJ0aU1kZVRGcTJtSXJBLg$3KhlBh8OY00MWQFo6KitvXiGwHJPNieNC5TP1lNPGHM', 'JAMES\n@test.com'),
(101, 'WATSON\n', '$argon2id$v=19$m=65536,t=4,p=1$a1VvOUdQeDhTY0hDTENuag$8JFD5ep0Y3iHOD94Q5WF+aXxp1Y+8N2nXQKAGgZaoI0', 'WATSON\n@test.com'),
(102, 'BROOKS\n', '$argon2id$v=19$m=65536,t=4,p=1$eGlUemZURnhONWlPTkl4Vw$ryGzxtFH/WZRfUyg3ZUwqBbw/tpGO+8s+IBHZ2SAy1Q', 'BROOKS\n@test.com'),
(103, 'KELLY\n', '$argon2id$v=19$m=65536,t=4,p=1$UGhudWx5T2NkZXY1UGgzRA$x4cbbxROicU+Jos287odUhd05lE8VT5unm9z5tbi/8E', 'KELLY\n@test.com'),
(104, 'SANDERS\n', '$argon2id$v=19$m=65536,t=4,p=1$NzN2ZEFhTnE4aDFlZ0o4Yg$4OuqaARyL/gIVlyMar2+7mkmUW5cYIhKEPXVGPFWLRA', 'SANDERS\n@test.com'),
(105, 'PRICE\n', '$argon2id$v=19$m=65536,t=4,p=1$RWJ5ZHJqbmRNUmdibVdrcA$yRmP6tQiyAJviKfvJgJMJoM2X1z9CoS5CZ4YxWdpNrY', 'PRICE\n@test.com'),
(106, 'BENNETT\n', '$argon2id$v=19$m=65536,t=4,p=1$TzNWN05laHl6Sk1jTUxKUg$WFf6akgEWOVFGLBVpz1COk7Hl8uslLr3Cfp2I7U1ZAg', 'BENNETT\n@test.com'),
(107, 'WOOD\n', '$argon2id$v=19$m=65536,t=4,p=1$TFQzdFA5T3ZWakhnSDI5SQ$Y+DQ3yCizBz5PSc0sOo9IwN+KzKMVZZB7zzaiX0xLdQ', 'WOOD\n@test.com'),
(108, 'BARNES\n', '$argon2id$v=19$m=65536,t=4,p=1$VVBSRG1qQWk1cVFSeFFCdw$OSs2BSzlQWIpb9niesZvSjd8gNKbxmLf2JoJFiWAZ+A', 'BARNES\n@test.com'),
(109, 'ROSS\n', '$argon2id$v=19$m=65536,t=4,p=1$OW5ydVdjdkJHTzRzZEl6NQ$L185b/eUm1sNoCOyjVsVOhQBwW/l+QyxRl9j3ramtv8', 'ROSS\n@test.com'),
(110, 'HENDERSON\n', '$argon2id$v=19$m=65536,t=4,p=1$ODJ5cUw4Sm10WGlqd1ExSA$i1sgj9x+foccfpZBIhtWAQUg4+EnFp97zu9UywzgGBw', 'HENDERSON\n@test.com'),
(111, 'COLEMAN\n', '$argon2id$v=19$m=65536,t=4,p=1$dTBkc3dVUjk1WVc1THJhLw$yc0DfvQ2TnOMucMH+w/xkEdsnEZgESY3Shkfg1dekG8', 'COLEMAN\n@test.com'),
(112, 'JENKINS\n', '$argon2id$v=19$m=65536,t=4,p=1$NWFpTHFMREJpc0dEWkVJUA$ilcMGVFe9C+JyaqDCO3dE1qnb7oYInrrZOAKiwzpPcQ', 'JENKINS\n@test.com'),
(113, 'PERRY\n', '$argon2id$v=19$m=65536,t=4,p=1$VmxWOXVVcGRZaGdYWEM4ZQ$Lc3MwOvKYTPg87dZDCG08tWfB1rJrLUVabRk5tno0Pg', 'PERRY\n@test.com'),
(114, 'POWELL\n', '$argon2id$v=19$m=65536,t=4,p=1$WWJiQW1YLnZZNkUvMGc1bQ$RU2vLt/qMGThbk8KH/VN/XU21bJD1iHEoTh4beqQ6O8', 'POWELL\n@test.com'),
(115, 'LONG\n', '$argon2id$v=19$m=65536,t=4,p=1$bFBzNzMyMEtGT2pJemNuLg$ZA/Y4q48U4CEZnp4hdNmf7w4fkvhYS1EZy3cbDZodo8', 'LONG\n@test.com'),
(116, 'PATTERSON\n', '$argon2id$v=19$m=65536,t=4,p=1$bzhuSVIyUnZiMWFCNUFLZQ$96BMcltjqUvIKiEF510hY/OQl3tre5efW2+xpnuWRrQ', 'PATTERSON\n@test.com'),
(117, 'HUGHES\n', '$argon2id$v=19$m=65536,t=4,p=1$SnRSajJYQ1NBQmNCeldMcw$epvrbrCdb1VBf84RwXct0B8XhkvNgtZD53Ui14TRmvo', 'HUGHES\n@test.com'),
(118, 'FLORES\n', '$argon2id$v=19$m=65536,t=4,p=1$WHRnVnpkaHFsbEw3QkFjRg$huO9q8Ccn0UH6ZIvPfghyfNc6/r08YUnUrDHE+EGGOg', 'FLORES\n@test.com'),
(119, 'WASHINGTON\n', '$argon2id$v=19$m=65536,t=4,p=1$U3ltb1lkdkRtNFE2TmtHcg$02OGIKkh5NijEv0G5Fm08Vb0e1Y8MrE7nYxsyq51hJs', 'WASHINGTON\n@test.com'),
(120, 'BUTLER\n', '$argon2id$v=19$m=65536,t=4,p=1$Y3l6Z3VBckp6V3pBRUU1VA$dIfylC9/yxl3UEayB6fePRD9sdRG/hCzw6kavaZdHDQ', 'BUTLER\n@test.com'),
(121, 'SIMMONS\n', '$argon2id$v=19$m=65536,t=4,p=1$VWp1RWNTUzlJbHQ2YjB3aw$PplMXzLRt9wrTmhThD/LhtR5YRUyA9/PJzMmTOxt98E', 'SIMMONS\n@test.com'),
(122, 'FOSTER\n', '$argon2id$v=19$m=65536,t=4,p=1$NEVKU0VZcVJyWEdURWpLOA$shpTl6hxLMQduBYA98bgL+y8P4F5kNsDgsup04j+/fM', 'FOSTER\n@test.com'),
(123, 'GONZALES\n', '$argon2id$v=19$m=65536,t=4,p=1$MGF1Zld3Q2NsRWp6ekVwTA$ewb41JJz8vTI9pAs8a8xAw6I2LR5C26BkWlbcLN0M0c', 'GONZALES\n@test.com'),
(124, 'BRYANT\n', '$argon2id$v=19$m=65536,t=4,p=1$SmxoaWp2SUE4QUYuV2lhbQ$rmix125Mooc/mUi/P/DunGJ2SSpD1IzuBOJuP7BnTfA', 'BRYANT\n@test.com'),
(125, 'ALEXANDER\n', '$argon2id$v=19$m=65536,t=4,p=1$MVBKMGZiRXlwS29VTHJhUg$cQekAcB6jt2JyOxa2AD7JY0e3U9bVnvKceomOCHB7JE', 'ALEXANDER\n@test.com'),
(126, 'RUSSELL\n', '$argon2id$v=19$m=65536,t=4,p=1$MHVPQnJsY3owYTJkeWF6ZQ$UlL7wliLnZ3aI5urJ+9LVkiraD6YnTDbLu5L52Oy7b8', 'RUSSELL\n@test.com'),
(127, 'GRIFFIN\n', '$argon2id$v=19$m=65536,t=4,p=1$TjJrMkFWVDBuZGVFNU9udA$NlTSDGAH5Sa5r7MaUR7BXFs7/2YkUhVRWxP6BJ6WCqc', 'GRIFFIN\n@test.com'),
(128, 'DIAZ\n', '$argon2id$v=19$m=65536,t=4,p=1$NGh2NXFkWjlLTnI2YndGNA$axh9zpwkzNo/h7tfP2cMlOdIh6WmPo97Fwb8Xh1YYjY', 'DIAZ\n@test.com'),
(129, 'HAYES\n', '$argon2id$v=19$m=65536,t=4,p=1$OXBvblFpT2FZdkFGcTZVUw$u8zaRMSIo5pU9Ln9gulIduUY9TKt4EDIMURDqgeNdi0', 'HAYES\n@test.com'),
(130, 'MYERS\n', '$argon2id$v=19$m=65536,t=4,p=1$RC5lSWpRc2tvbVRKM2luVA$2wQGvG5uk95qvJ9J9I5/Ta65CGfSsgSfZ6+BTB2/zGo', 'MYERS\n@test.com'),
(131, 'FORD\n', '$argon2id$v=19$m=65536,t=4,p=1$azRYTHY0Q01Qc2cuTGFkag$RTwWqRsaR5s372CxH6JRgtgLkncjXwozpM15MSDIv10', 'FORD\n@test.com'),
(132, 'HAMILTON\n', '$argon2id$v=19$m=65536,t=4,p=1$V0YuQnZreUNORlJVbzg2Mg$K6mFQQ1uGSTR1derfMG5pYafzB1RPYUyYscid63+RkE', 'HAMILTON\n@test.com'),
(133, 'GRAHAM\n', '$argon2id$v=19$m=65536,t=4,p=1$ZVBmcXVXbm9ZZTA1MkljZw$C7IaFriE0gDcOx2sgeRLaYKwHqvEXubep76WotCVM+I', 'GRAHAM\n@test.com'),
(134, 'SULLIVAN\n', '$argon2id$v=19$m=65536,t=4,p=1$bnBLU3NwM1IxVTN4RDg1MQ$21FWwRMwMOwCi4SZudWWmRDEUHc5QJYqkxWi4qk+LGg', 'SULLIVAN\n@test.com'),
(135, 'WALLACE\n', '$argon2id$v=19$m=65536,t=4,p=1$YnFnRktVVVVXRU5yY25Oaw$PPrLVYbuZ1AT1IA8JVDgmWATxCO81yQpVmfFnOVaTtQ', 'WALLACE\n@test.com'),
(136, 'WOODS\n', '$argon2id$v=19$m=65536,t=4,p=1$OTE0Vy41MFFYS3NaekZodA$NY7g6tjZkUnw0d2hO9Yez8Pq+3YLPZ6sERE8hSG4Wk4', 'WOODS\n@test.com'),
(137, 'COLE\n', '$argon2id$v=19$m=65536,t=4,p=1$SjQya2dzSFdzcUV0OWRwdg$bMyumNHPR5y3rfsPD2XlumtAqyeOjRzZ3anSJP4juk4', 'COLE\n@test.com'),
(138, 'WEST\n', '$argon2id$v=19$m=65536,t=4,p=1$S29CTUxtampQWDV0VjlWag$jEAe2XwncHmllcrceok+bAuAVsQQizws3Rl9U81aRgU', 'WEST\n@test.com'),
(139, 'JORDAN\n', '$argon2id$v=19$m=65536,t=4,p=1$Q1Nra0djMjgydFRGL1NCQQ$ZVWIdX0vhaTYOdaWEBONfELCdE/DFebpvTTAUsZO97I', 'JORDAN\n@test.com'),
(140, 'OWENS\n', '$argon2id$v=19$m=65536,t=4,p=1$LmdGNklrNUNmdE1OZ0o2Qg$RK4QUv/I6cA/XEuIfYBcUyusffEI9sD2DfvRx778grw', 'OWENS\n@test.com'),
(141, 'REYNOLDS\n', '$argon2id$v=19$m=65536,t=4,p=1$VmZNUWRPZ1p0dWU5SUpOUQ$D+m208k3aTrD39J3Rt+3fdqwTrkV28QlPt6dbLrbc4k', 'REYNOLDS\n@test.com'),
(142, 'FISHER\n', '$argon2id$v=19$m=65536,t=4,p=1$OUFRLmk1eHRxNGV0Uk44Mg$sok3aa5VUm/1FGP+b38hmnsZW6CtGgIqFIuszplf+4I', 'FISHER\n@test.com'),
(143, 'ELLIS\n', '$argon2id$v=19$m=65536,t=4,p=1$UXpZMUE0NDZzcm1iYUxtSA$BBDOHvTZ8abZ8ab6Q3x8Qk+mAJf79Sr9/bSjWTV4zw8', 'ELLIS\n@test.com'),
(144, 'HARRISON\n', '$argon2id$v=19$m=65536,t=4,p=1$VVJyNWdLRkl0UzIzTXlpRQ$cew5l6+j2bP9snKm/1EKbm+PdsP/tmc8zis7H7lBjVA', 'HARRISON\n@test.com'),
(145, 'GIBSON\n', '$argon2id$v=19$m=65536,t=4,p=1$eHJzL1VEWEJ2Y1BBTEJWdg$CFl5W/amEVHswFvy/jASIQPLWFL40m1kzuE7WoU3rLI', 'GIBSON\n@test.com'),
(146, 'MCDONALD\n', '$argon2id$v=19$m=65536,t=4,p=1$QnF2dVJhcFZvZlc5MDRaMA$ahv7w/1SpAOmtiX86ivRf27mMA2+74N9yVGcGWgowtQ', 'MCDONALD\n@test.com'),
(147, 'CRUZ\n', '$argon2id$v=19$m=65536,t=4,p=1$eUlEZ1JiLjNvNmxldWxheQ$RIqg3k9sWtN2O6EaaSqEDxQl4u8RKSrAeupZvRWCgTQ', 'CRUZ\n@test.com'),
(148, 'MARSHALL\n', '$argon2id$v=19$m=65536,t=4,p=1$VU9vQVk1NGVMaElVNFhFdA$DT1V4/7sH9+rsLoPIAOTJfaoEThkAuEiIej0iLgHEhM', 'MARSHALL\n@test.com'),
(149, 'ORTIZ\n', '$argon2id$v=19$m=65536,t=4,p=1$ODMuM0dyQXNPMzBCVi8yRQ$O+dqvfEm2igOBk97Jbh4TTm6e9wFIfTTdyV+mzZfGcE', 'ORTIZ\n@test.com'),
(150, 'GOMEZ\n', '$argon2id$v=19$m=65536,t=4,p=1$dHZTLlpsVFdYM21Ldm5oMA$OVyvucGqQ7FAgT/xsFbqILzfvWGGItbYEHcVwSU/c08', 'GOMEZ\n@test.com'),
(151, 'MURRAY\n', '$argon2id$v=19$m=65536,t=4,p=1$NmR2bktpWHZORDV0VmpySQ$1KiMle7kc0mnIse7cM6orOawS4sC3u9TYmcBiVTZ4sE', 'MURRAY\n@test.com'),
(152, 'FREEMAN\n', '$argon2id$v=19$m=65536,t=4,p=1$M0E5REk0S0pqQzBnRHMweA$JqjepJKSaLPyfA41PTymClz4kBz6kFOGJlG5SgehlBg', 'FREEMAN\n@test.com'),
(153, 'WELLS\n', '$argon2id$v=19$m=65536,t=4,p=1$V1A0S0pKR2RoZ21wU2k0dw$7l4g/YE603kmhPC3nirXhS2g6EJ3oteagRB2LnXKhxE', 'WELLS\n@test.com'),
(154, 'WEBB\n', '$argon2id$v=19$m=65536,t=4,p=1$QVJ5V1VHTnoyYlVuMTNsMg$qSalwqE8/nhRM/4piMHJAh/LJDc70wnvMFzrOaVlY4I', 'WEBB\n@test.com'),
(155, 'SIMPSON\n', '$argon2id$v=19$m=65536,t=4,p=1$L25ldk5XVGR0Y05MblNmLw$Fo9yQy/sA5xxfYIrgkwbWhMrkz+tKY97pIpUm/mzq6g', 'SIMPSON\n@test.com'),
(156, 'STEVENS\n', '$argon2id$v=19$m=65536,t=4,p=1$RmJrdG0ySUxySDQvSDczaQ$O4ykL+dqKSiyQKWZj3HBql8F3RCg24meZN5TbWG+FvI', 'STEVENS\n@test.com'),
(157, 'TUCKER\n', '$argon2id$v=19$m=65536,t=4,p=1$eUIxYjAvekNSOW9HU3A1ag$RUkIyjUkfrrPhsfOzMf75ksFiYgqym5Qbwdo/AstTZw', 'TUCKER\n@test.com'),
(158, 'PORTER\n', '$argon2id$v=19$m=65536,t=4,p=1$Vmh6VC5nbmp3MUZreDhKdQ$MGUaLF+/aVBB8GPZ0UlBQGpCEFmkth5SDxj3G0MtQKM', 'PORTER\n@test.com'),
(159, 'HUNTER\n', '$argon2id$v=19$m=65536,t=4,p=1$L0wwYWhUTThaOGZwR2xONg$kMcHXnsFrZh0Knsf9DKoWe6aUNtJSoEaz/hL55k2TzM', 'HUNTER\n@test.com'),
(160, 'HICKS\n', '$argon2id$v=19$m=65536,t=4,p=1$cy9qWFBzOTA2a2EwUFVQZw$mJt9vvsqIjbbcb+u9CjN7qb10AYJzRLba1bJZtgdJiQ', 'HICKS\n@test.com'),
(161, 'CRAWFORD\n', '$argon2id$v=19$m=65536,t=4,p=1$T0VTbUhmaEMuOGhrT0MyZw$5YSM3102yqyrkvir5Pxa0rz9NWtNdEcqarX7XCYcqyI', 'CRAWFORD\n@test.com'),
(162, 'HENRY\n', '$argon2id$v=19$m=65536,t=4,p=1$NDF5U3FISDhPMVFsSFhVcg$JHwo6L5dCnMMA7gnBZDDTVgeQsT7haAD9E5lYt3RUHM', 'HENRY\n@test.com'),
(163, 'BOYD\n', '$argon2id$v=19$m=65536,t=4,p=1$a2sydzNIS3lVd1pyZWtuLg$L08YgzQhumsPKUUM4ZuZLUJtewa319Lri9UfhOEAOio', 'BOYD\n@test.com'),
(164, 'MASON\n', '$argon2id$v=19$m=65536,t=4,p=1$ZGgzWTFSRERlU29vam5VYQ$qu4B4kYiiS35o8+8wnRa7Q5LlV2NViy/TvMTEk+Ch7E', 'MASON\n@test.com'),
(165, 'MORALES\n', '$argon2id$v=19$m=65536,t=4,p=1$R1VxcWlmNnJ5TE1VQ01Fdw$Nel5oqrypn0Pt2WSdOGnbxMw6DnYymsoN4ircGz1NBE', 'MORALES\n@test.com'),
(166, 'KENNEDY\n', '$argon2id$v=19$m=65536,t=4,p=1$bTBQZDFZUGt5cjVUNkZyRQ$2Ilo8uEBTgNC7wTk6iNKDEPSE0mbX5vRZUYswwO1jPI', 'KENNEDY\n@test.com'),
(167, 'WARREN\n', '$argon2id$v=19$m=65536,t=4,p=1$Ykp0dFlHS3dSWHBaUlhJbw$SVtX8sfNvRVrfRwa8GHX74hWkehEDNqrgOi7u2Stp9E', 'WARREN\n@test.com'),
(168, 'DIXON\n', '$argon2id$v=19$m=65536,t=4,p=1$Rm9qT1NHaFo0RVlTYlNEQw$QzaOhLeHduonJMWAkrVTFbqr4g73s0vSNllAnyGkxxg', 'DIXON\n@test.com'),
(169, 'RAMOS\n', '$argon2id$v=19$m=65536,t=4,p=1$aklueVA1M3RBbmllVEk0Zw$YpHjAGYnuDklSSLxslKYoE42ICHJUjPf3DDYJnftS80', 'RAMOS\n@test.com'),
(170, 'REYES\n', '$argon2id$v=19$m=65536,t=4,p=1$amFpQ0xZWFFnN0V6ckJUQg$0F2BeJbqVMit899MpHi4bWi9ca9HyIWpbGMpxF2g54w', 'REYES\n@test.com'),
(171, 'BURNS\n', '$argon2id$v=19$m=65536,t=4,p=1$eER0NHpQOFVUdUpETDlLQg$NulkQhMwYEijTaUwcZZb/bWs9H28MC0Kvph2BngxSF8', 'BURNS\n@test.com'),
(172, 'GORDON\n', '$argon2id$v=19$m=65536,t=4,p=1$RkQxLjFBSGd2bVE3LkJTQQ$FLXrGinZBz5jBd1pcjCOyeEP9HFJ2VXA2EIsoK3uD5E', 'GORDON\n@test.com'),
(173, 'SHAW\n', '$argon2id$v=19$m=65536,t=4,p=1$SE94a0FCWDJWVUF6SzlLZA$OlNLCgHNlx8+XzHkQSYMY1ejjEcVgxum6YdZ3z0LxdU', 'SHAW\n@test.com'),
(174, 'HOLMES\n', '$argon2id$v=19$m=65536,t=4,p=1$RG1OUGpQQldTQk1BRGdjLg$967rCJuEqN3hg6u1CL24xmhRqFuEDbtNBRU0VKnw3B4', 'HOLMES\n@test.com'),
(175, 'RICE\n', '$argon2id$v=19$m=65536,t=4,p=1$TkJXeTRvZHhDalo1a3BCZQ$zs/p63VugC7DUfI+ib1DLQ+QmnHAS/xT4E4pInPXxGg', 'RICE\n@test.com'),
(176, 'ROBERTSON\n', '$argon2id$v=19$m=65536,t=4,p=1$dXVkZkhidHpzaXNlcExDRA$kO+4fsp/FPXUUI6x5Rb93+lraMHfyuKQzaW7rRIXMfI', 'ROBERTSON\n@test.com'),
(177, 'HUNT\n', '$argon2id$v=19$m=65536,t=4,p=1$NkouWmt2Tnl1R1ZoNlJ6YQ$4ei9T6xvv7zYrlt6h4se2vRwlpIHMqJ8EoMx0sPfmno', 'HUNT\n@test.com'),
(178, 'BLACK\n', '$argon2id$v=19$m=65536,t=4,p=1$S0o5M21xTjFBZDRnTzRYcA$wGFpS/nuC1rACe3TtL9BCUq3TKazPb+0dBdj5QNrHSY', 'BLACK\n@test.com'),
(179, 'DANIELS\n', '$argon2id$v=19$m=65536,t=4,p=1$Z3R2RFBWMGdNMk9tTVJGag$dtGCQrcCzb4fuEecZRB0OfgL1C/QS3b8ftYpYjk2y0w', 'DANIELS\n@test.com'),
(180, 'PALMER\n', '$argon2id$v=19$m=65536,t=4,p=1$LnlremExbHA3ZGd1VnpKQg$edwQiAuYS1FTk5dXfrSeVkjUcUf7wPkgdDVuzYgDNdQ', 'PALMER\n@test.com'),
(181, 'MILLS\n', '$argon2id$v=19$m=65536,t=4,p=1$cmtRRHQ2MEFTb0xNaVdWUA$BfDguF4brmM/ZFbxdvAasOpohKDlimjnY2EYsjKdHlA', 'MILLS\n@test.com'),
(182, 'NICHOLS\n', '$argon2id$v=19$m=65536,t=4,p=1$THFhcEJEanZmWmV4UGgucw$hrObBfeJhrU56cuZddE16Pdy2kPGKKcOKlIXXNlqkmc', 'NICHOLS\n@test.com'),
(183, 'GRANT\n', '$argon2id$v=19$m=65536,t=4,p=1$ZE1LYU9HdklYMGFNZ010MA$dXiwyd8lZjRO8A4+WUsia3Sx/hY8V+RXl6cIGUTehdg', 'GRANT\n@test.com'),
(184, 'KNIGHT\n', '$argon2id$v=19$m=65536,t=4,p=1$QllsVTdGUDJ1VWJvV0Q1QQ$FIMzWhXdT8JzbgCA3BekjfLuiXn/UfMhUS12nuh7q6k', 'KNIGHT\n@test.com');

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
-- Indizes für die Tabelle `ingredient`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `recipie_category`
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
-- AUTO_INCREMENT for table `user_pass`
--
ALTER TABLE `user_pass`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

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
