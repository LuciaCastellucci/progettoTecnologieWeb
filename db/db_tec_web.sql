-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 30, 2022 alle 23:48
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tec_web`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `codModello` int(8) NOT NULL,
  `codTaglia` int(8) NOT NULL,
  `userCliente` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `modello`
--

CREATE TABLE `modello` (
  `codiceModello` int(8) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `altezza` varchar(100) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `immagine` varchar(100) NOT NULL,
  `prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `modello`
--

INSERT INTO `modello` (`codiceModello`, `tipo`, `altezza`, `descrizione`, `immagine`, `prezzo`) VALUES
(1, 'Dunk', 'Low', 'Black White', 'dunk_low_black_white.jpg', 150),
(2, 'Dunk', 'High', 'Aluminium', 'dunk_high_aluminium.jpg', 350),
(3, 'Jordan', 'Low', 'Goldenrod', 'dunk_low_goldenrod.jpg', 200),
(4, 'Dunk', 'High', 'University Red', 'dunk_high_university_red.jpg', 300),
(5, 'Dunk', 'Low', 'Archeo Pink', 'dunk_low_archeo_pink.jpg', 280),
(6, 'Jordan', 'Mid', 'SE Purple', 'jordan_mid_SE_purple.jpg', 260),
(7, 'Jordan', 'Low', 'Starfish', 'jordan_low_starfish.jpg', 180);

-- --------------------------------------------------------

--
-- Struttura della tabella `notifiche`
--

CREATE TABLE `notifiche` (
  `codiceNotifica` int(8) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `username` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `numOrdine` int(8) NOT NULL,
  `dataOrdine` date NOT NULL,
  `indirizzoSpedizione` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `scarpa`
--

CREATE TABLE `scarpa` (
  `codModello` int(8) NOT NULL,
  `codTaglia` int(8) NOT NULL,
  `qtaMagazzino` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `scarpe_ordinate`
--

CREATE TABLE `scarpe_ordinate` (
  `numOrdine` int(8) NOT NULL,
  `qtaOrdinata` int(8) NOT NULL,
  `codModello` int(8) NOT NULL,
  `codTaglia` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `stato`
--

CREATE TABLE `stato` (
  `statoSpedizione` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `stato`
--

INSERT INTO `stato` (`statoSpedizione`) VALUES
('In consegna'),
('In preparazione'),
('Ordinato'),
('Spedito');

-- --------------------------------------------------------

--
-- Struttura della tabella `stato_ordine`
--

CREATE TABLE `stato_ordine` (
  `stato` varchar(50) NOT NULL,
  `numOrdine` int(8) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `taglia`
--

CREATE TABLE `taglia` (
  `taglia` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `taglia`
--

INSERT INTO `taglia` (`taglia`) VALUES
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `username` varchar(150) NOT NULL,
  `pw` varchar(150) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`username`, `pw`, `nome`, `tipo`) VALUES
('admin', 'admin', 'Admin', 'admin'),
('luciaCastellucci', 'luciacaste', 'Lucia Castellucci', 'cliente'),
('riccardoCastellucci', 'richicaste', 'Riccardo Castellucci', 'cliente');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`codModello`,`codTaglia`,`userCliente`),
  ADD KEY `carrello_cliente` (`userCliente`),
  ADD KEY `carrello_taglia` (`codTaglia`);

--
-- Indici per le tabelle `modello`
--
ALTER TABLE `modello`
  ADD PRIMARY KEY (`codiceModello`);

--
-- Indici per le tabelle `notifiche`
--
ALTER TABLE `notifiche`
  ADD PRIMARY KEY (`codiceNotifica`),
  ADD KEY `notifica_utente` (`username`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`numOrdine`);

--
-- Indici per le tabelle `scarpa`
--
ALTER TABLE `scarpa`
  ADD PRIMARY KEY (`codModello`,`codTaglia`),
  ADD KEY `scarpa_taglia` (`codTaglia`);

--
-- Indici per le tabelle `scarpe_ordinate`
--
ALTER TABLE `scarpe_ordinate`
  ADD PRIMARY KEY (`numOrdine`,`codTaglia`,`codModello`) USING BTREE,
  ADD KEY `ordine_scarpa_modello` (`codModello`),
  ADD KEY `ordine_scarpa_taglia` (`codTaglia`);

--
-- Indici per le tabelle `stato`
--
ALTER TABLE `stato`
  ADD PRIMARY KEY (`statoSpedizione`);

--
-- Indici per le tabelle `stato_ordine`
--
ALTER TABLE `stato_ordine`
  ADD PRIMARY KEY (`stato`,`numOrdine`),
  ADD KEY `stato_ordine` (`numOrdine`);

--
-- Indici per le tabelle `taglia`
--
ALTER TABLE `taglia`
  ADD PRIMARY KEY (`taglia`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`username`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_cliente` FOREIGN KEY (`userCliente`) REFERENCES `utente` (`username`),
  ADD CONSTRAINT `carrello_modello` FOREIGN KEY (`codModello`) REFERENCES `scarpa` (`codModello`),
  ADD CONSTRAINT `carrello_taglia` FOREIGN KEY (`codTaglia`) REFERENCES `scarpa` (`codTaglia`);

--
-- Limiti per la tabella `notifiche`
--
ALTER TABLE `notifiche`
  ADD CONSTRAINT `notifica_utente` FOREIGN KEY (`username`) REFERENCES `utente` (`username`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`numOrdine`) REFERENCES `scarpe_ordinate` (`numOrdine`);

--
-- Limiti per la tabella `scarpa`
--
ALTER TABLE `scarpa`
  ADD CONSTRAINT `scarpa_modello` FOREIGN KEY (`codModello`) REFERENCES `modello` (`codiceModello`),
  ADD CONSTRAINT `scarpa_taglia` FOREIGN KEY (`codTaglia`) REFERENCES `taglia` (`taglia`);

--
-- Limiti per la tabella `scarpe_ordinate`
--
ALTER TABLE `scarpe_ordinate`
  ADD CONSTRAINT `ordine_numero` FOREIGN KEY (`numOrdine`) REFERENCES `ordine` (`numOrdine`),
  ADD CONSTRAINT `ordine_scarpa_modello` FOREIGN KEY (`codModello`) REFERENCES `scarpa` (`codModello`),
  ADD CONSTRAINT `ordine_scarpa_taglia` FOREIGN KEY (`codTaglia`) REFERENCES `scarpa` (`codTaglia`);

--
-- Limiti per la tabella `stato_ordine`
--
ALTER TABLE `stato_ordine`
  ADD CONSTRAINT `stato_ordine` FOREIGN KEY (`numOrdine`) REFERENCES `ordine` (`numOrdine`),
  ADD CONSTRAINT `stato_stato` FOREIGN KEY (`stato`) REFERENCES `stato` (`statoSpedizione`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
