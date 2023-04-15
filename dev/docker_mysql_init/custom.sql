-- This is a custom script that should create the user for the webapp.

-- weird boilerplate stuff
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


--
-- CUSTOM ADDED, NOT BY PHPMYADMIN
--

--
-- Datenbank: `Recepie_Service`
--
CREATE DATABASE IF NOT EXISTS `Recepie_Service` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Recepie_Service`;

-- Add the user, that is used by the webapp
CREATE USER 'recipie_service'@'%' IDENTIFIED BY "example";
-- Grant it all privileges (change this for production FIXME)
GRANT ALL PRIVILEGES ON `Recepie\_Service`.* TO 'recipie_service'@'%';

-- we might need this one aswell?
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
