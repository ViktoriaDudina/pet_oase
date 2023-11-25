-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Nov 2023 um 03:22
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `be20_cr5_animal_adoption_viktoriadudina`
--
CREATE DATABASE IF NOT EXISTS `be20_cr5_animal_adoption_viktoriadudina` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `be20_cr5_animal_adoption_viktoriadudina`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `pet_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `size` varchar(40) NOT NULL,
  `age` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `breed` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `vaccinated` enum('Vaccinated','Not vaccinated') DEFAULT 'Not vaccinated',
  `status` enum('Adopted','Available') DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`pet_id`, `name`, `location`, `size`, `age`, `picture`, `breed`, `description`, `fk_user_id`, `vaccinated`, `status`) VALUES
(1, 'Jack', 'Rosenweg 15', 'Large', 2, 'jack.jpg', 'Dog', 'Playful and friendly.', NULL, 'Vaccinated', 'Available'),
(2, 'Maximus', 'Ahornplatz 36', 'Large', 8, 'maximus.jpg', 'Siberian Husky', 'Energetic and loves outdoors.', NULL, 'Not vaccinated', 'Available'),
(3, 'Luna', 'Sonnenallee 107', 'Small', 1, 'luna.jpg', 'cat', 'Affectionate and curious.', NULL, 'Not vaccinated', 'Adopted'),
(4, 'Milo', 'Rosenweg 15', 'Medium', 9, 'milo.jpg', 'cat', 'Gentle and good with kids.', NULL, 'Vaccinated', 'Available'),
(5, 'Sophie', 'Sonnenallee 107', 'Small', 2, 'sophie.jpg', 'cat', 'Smart and playful.', NULL, 'Vaccinated', 'Available'),
(6, 'Oreo', 'Ahornplatz 36', 'Medium', 5, 'oreo.jpg', 'rabbit', 'Sweet and calm personality.', NULL, 'Not vaccinated', 'Available'),
(7, 'Rocky', 'Rosenweg 15', 'Small', 3, 'rocky.jpg', 'hamster', 'Affectionate and playful.', NULL, 'Vaccinated', 'Available'),
(8, 'Bella', 'Sonnenallee 107', 'Small', 2, 'bella.jpg', 'hamster', 'Gentle and hypoallergenic.', NULL, 'Not vaccinated', 'Available'),
(9, 'Mary', 'Ahornplatz 36', 'Medium', 12, 'mary.jpg', 'parrot', 'Regal and affectionate.', NULL, 'Vaccinated', 'Available'),
(10, 'Charlie', 'Rosenweg 15', 'Medium', 6, 'charlie.jpg', 'parrot', 'Curious and playful.', NULL, 'Vaccinated', 'Available'),
(11, 'Duke', 'Sonnenallee 107', 'Large', 38, 'duke.jpg', 'turtle', 'Loyal and good-natured.', NULL, 'Vaccinated', 'Available'),
(12, 'Mia', 'Rosenweg 15', 'Small', 4, 'mia.jpg', 'turtle', 'Gentle and loving.', NULL, 'Not vaccinated', 'Available');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `adoption_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `adoption_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `fk_pet_id` int(11) DEFAULT NULL,
  `status` enum('adm','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indizes für die Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_pet_id` (`fk_pet_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT für Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `adoption_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints der Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `animals` (`pet_id`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_pet_id`) REFERENCES `animals` (`pet_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
