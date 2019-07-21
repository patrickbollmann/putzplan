-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 21. Jul 2019 um 15:32
-- Server-Version: 5.7.26-0ubuntu0.18.04.1
-- PHP-Version: 7.2.20-1+ubuntu18.04.1+deb.sury.org+1

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
-- Tabellenstruktur für Tabelle `done`
--

CREATE TABLE `done` (
  `scheduleid` int(8) NOT NULL,
  `bad` int(11) NOT NULL DEFAULT '0',
  `kueche` int(11) NOT NULL DEFAULT '0',
  `muell` int(11) NOT NULL DEFAULT '0',
  `toiletten` int(11) NOT NULL DEFAULT '0',
  `wohnzimmer` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `done`
--

INSERT INTO `done` (`scheduleid`, `bad`, `kueche`, `muell`, `toiletten`, `wohnzimmer`) VALUES
(1, 0, 0, 0, 0, 0);

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
(1, 'Patrick', 21, 0, 1),
(2, 'Philipp', 19, 0, 1),
(3, 'Mayra', 23, 0, 1),
(4, 'Maike', 23, 0, 1),
(5, 'Laura', 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(8) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wohnzimmer` int(11) NOT NULL,
  `kueche` int(11) NOT NULL,
  `Treppenhaus` int(11) NOT NULL,
  `bad` int(11) NOT NULL,
  `toiletten` int(11) NOT NULL,
  `muell` int(11) NOT NULL,
  `keller` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `date`, `wohnzimmer`, `kueche`, `Treppenhaus`, `bad`, `toiletten`, `muell`, `keller`) VALUES
(50, '2019-07-21 13:31:20', 1, 4, 2, 3, 1, 3, 4);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `done`
--
ALTER TABLE `done`
  ADD PRIMARY KEY (`scheduleid`);

--
-- Indizes für die Tabelle `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`personid`);

--
-- Indizes für die Tabelle `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
