-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 28 aug 2025 om 14:29
-- Serverversie: 8.0.42
-- PHP-versie: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `speelhuys`
--
CREATE DATABASE IF NOT EXISTS `speelhuys` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `speelhuys`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `brand_logo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_logo`) VALUES
(1, 'Lego', 'lego.png'),
(2, 'Kapla', 'kaplan.png'),
(3, 'Duplo', 'duplo.png'),
(4, 'RoboTime', 'robotime.png'),
(5, 'SmartMax', 'smartmax.png'),
(6, 'Brio', 'brio.png'),
(7, 'Playmobil', 'playmobil.png'),
(8, 'MegaBloks', 'megabloks.png'),
(9, 'MegaConstrux', 'megaconstrux.png'),
(10, 'Geomag', 'geomag.png'),
(11, 'KNEX', 'knex.png'),
(12, 'GraviTrax', 'gravitrax.png'),
(13, 'Clementoni', 'clementoni.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` int NOT NULL AUTO_INCREMENT,
  `session_user_id` int NOT NULL,
  `session_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `session_start` date NOT NULL,
  `session_end` date NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sets`
--

CREATE TABLE IF NOT EXISTS `sets` (
  `set_id` int NOT NULL AUTO_INCREMENT,
  `set_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `set_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `set_brand_id` int NOT NULL,
  `set_theme_id` int DEFAULT NULL,
  `set_image` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `set_price` decimal(20,2) NOT NULL,
  `set_age` int NOT NULL,
  `set_pieces` int NOT NULL,
  `set_stock` int NOT NULL,
  PRIMARY KEY (`set_id`),
  KEY `set_brand_id` (`set_brand_id`),
  KEY `set_theme_id` (`set_theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `sets`
--

INSERT INTO `sets` (`set_id`, `set_name`, `set_description`, `set_brand_id`, `set_theme_id`, `set_image`, `set_price`, `set_age`, `set_pieces`, `set_stock`) VALUES
(1, 'Lego City Goederen Trein', 'Deze LEGO CITY goederentrein zit vol met authentieke kenmerken en functies en kan eenvoudig op afstand bediend worden. LEGO-nr. 60336', 1, 1, 'lego_city_goederentrein.png', 169.99, 7, 1153, 5),
(2, 'Lego City Monstertruckrace', 'In deze LEGO CITY monstertruckrace speelset zitten twee grappige monstertrucks en twee minifiguren van coureurs. LEGO-nr. 60397', 1, 1, 'lego_city_monstertruckrace.png', 29.99, 6, 301, 3),
(3, 'Lego City Politiespeedboot en boevenschuilplaats', 'Kinderen gaan op leuke missies om boeven te vangen met deze LEGO CITY politiespeedboot en boevenschuilplaats speelset voor kinderen van 6 jaar en ouder. LEGO-nr. 60417', 1, 1, 'lego_city_politiespeedboot.png', 29.99, 6, 311, 8),
(4, 'Kapla Bouwton', 'Maak zelf de mooiste bouwwerken met de 200 onderdelen van deze Kapla set.', 2, NULL, 'kapla_bouwton.png', 49.99, 3, 200, 10),
(5, 'Duplo Boerderijdieren', 'Met deze Duplo boerderijdieren set kunnen kinderen vanaf 2 jaar oud de leukste avonturen beleven.', 3, NULL, 'duplo_boerderijdieren.png', 49.99, 2, 74, 15),
(6, 'RoboTime 3D Puzzel - Uil', 'Deze RoboTime 3D puzzel van een uil is een leuke uitdaging voor kinderen vanaf 6 jaar.', 4, NULL, 'robotime_uil.png', 49.99, 6, 161, 5),
(7, 'SmartMax My First Safari Animals', 'Met deze SmartMax My First Safari Animals set kunnen kinderen vanaf 1 jaar oud de leukste avonturen beleven.', 5, NULL, 'smartmax_safari.png', 24.99, 1, 18, 10),
(8, 'Brio Treinbaan met boerderij', 'Deze Brio treinbaan met boerderij is een leuke set voor kinderen vanaf 3 jaar.', 6, NULL, 'brio_trein_boerderij.png', 49.99, 3, 20, 1),
(9, 'Playmobil Politiebureau', 'Met deze Playmobil politiebureau set kunnen kinderen vanaf 4 jaar oud de leukste avonturen beleven.', 7, NULL, 'playmobil_politiebureau.png', 89.99, 4, 256, 3),
(10, 'MegaBloks First Builders', 'Met deze MegaBloks First Builders set kunnen kinderen vanaf 1 jaar oud de leukste avonturen beleven.', 8, NULL, 'megabloks_firstbuilders.png', 16.95, 1, 60, 10),
(11, 'MegaConstrux Pokemon Battle', 'Met deze MegaConstrux Pokemon Battle set kunnen kinderen vanaf 6 jaar oud de leukste avonturen beleven.', 9, NULL, 'megaconstrux_pokemon.png', 21.99, 6, 79, 2),
(12, 'Geomag Mechanics Gravity', 'Met deze Geomag Mechanics Gravity set kunnen kinderen vanaf 7 jaar oud de leukste avonturen beleven.', 10, NULL, 'geomag_gravity.png', 39.99, 7, 169, 8),
(13, 'KNEX Click en Construct Value bouwset 522-delig', 'Bouw verschillende gave modellen met deze coole K’NEX Click en Construct Value bouwset. Deze set bestaat uit 522 stukken.', 11, NULL, 'knex_buildingset.png', 34.99, 7, 522, 13),
(14, 'Ravensburger GraviTrax Pro starter-set Vertical', 'Ga met de GraviTrax Vertical starterset aan de slag met het bouwen van de gaafste baan. Hij bevat alles om je allereerste baan te gaan bouwen.', 12, NULL, 'gravitrax_starter.png', 69.99, 8, 153, 14),
(15, 'Clementoni Cosmeticalaboratorium', 'Het Clementoni cosmeticalaboratorium bevat essences en natuurlijke ingrediënten om prachtige en unieke creaties te maken.', 13, NULL, 'clementoni_cosmeticalaboratorium.png', 24.99, 8, 150, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `theme_id` int NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `themes`
--

INSERT INTO `themes` (`theme_id`, `theme_name`) VALUES
(1, 'Lego City'),
(2, 'Lego Marvel'),
(3, 'Lego Friends'),
(4, 'Lego Architecture');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_firstname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `user_lastname` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `user_email` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `user_username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_role` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'standaard',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_username`, `user_password`, `user_role`) VALUES
(1, 'Joop', 'Jansen', 'joop@speelhuys.nl', 'joop', 'zu0g5dr', 'admin'),
(2, 'Ans', 'Jansen', 'ans@speelhuys.nl', 'ans', 'Z1Nm9Dj', 'admin'),
(3, 'Sophia', 'Smith', 'sophia@speelhuys.nl', 'sophia', 'sd973Es', 'employee'),
(4, 'Mia', 'Brown', 'mia@speelhuys.nl', 'noah', 'dj35dqdw', 'employee');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
