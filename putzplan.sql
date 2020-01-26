-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 26. Jan 2020 um 15:35
-- Server-Version: 5.7.28-0ubuntu0.18.04.4
-- PHP-Version: 7.2.26-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `putzplan`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `location`
--

CREATE TABLE `location` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Wert` int(11) NOT NULL,
  `User` varchar(20) NOT NULL,
  `Done` int(11) NOT NULL,
  `Beschwerde` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `location`
--

INSERT INTO `location` (`ID`, `Name`, `Wert`, `User`, `Done`, `Beschwerde`) VALUES
(1, 'Wohnzimmer', 8, 'Patrick', 1, ''),
(2, 'Kueche', 8, 'Laura', 1, ''),
(3, 'Treppenhaus', 6, 'Patrick', 1, ''),
(4, 'Geschirrtuecher', 5, 'Patrick', 1, ''),
(5, 'Toiletten', 6, 'Mayra', 1, ''),
(6, 'Muell', 5, 'Maike', 1, ''),
(7, 'Bad', 6, 'Philipp', 0, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `person`
--

CREATE TABLE `person` (
  `personid` int(8) NOT NULL,
  `name` text NOT NULL,
  `score` int(11) NOT NULL,
  `penalty` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `person`
--

INSERT INTO `person` (`personid`, `name`, `score`, `penalty`, `active`) VALUES
(1, 'Patrick', 287, 2, 1),
(2, 'Philipp', 274, 4, 1),
(3, 'Mayra', 276, 1, 1),
(4, 'Maike', 275, 1, 1),
(5, 'Laura', 274, 1, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`personid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `location`
--
ALTER TABLE `location`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
