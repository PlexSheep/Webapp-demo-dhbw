-- Adminer 4.8.1 MySQL 5.5.5-10.11.2-MariaDB-1:10.11.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `foo`;
CREATE TABLE `foo` (
  `id` int(11) NOT NULL,
  `bar` varchar(20) NOT NULL,
  `qux` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `foo` (`id`, `bar`, `qux`) VALUES
(1,	'323qedas',	111);

-- 2023-04-12 14:06:58

