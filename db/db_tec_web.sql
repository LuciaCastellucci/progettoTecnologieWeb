-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 11, 2022 alle 18:30
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
  `codiceCarrello` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`codiceCarrello`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22);

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
  `prezzo` int(8) NOT NULL
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
(7, 'Jordan', 'Low', 'Starfish', 'jordan_low_starfish.jpg', 180),
(8, 'Dunk', 'Low', 'Coast UCLA', 'dunk_low_coast_UCLA.jpg', 200),
(9, 'Dunk', 'High', 'Siracuse', 'dunk_high_siracuse.jpg', 300),
(10, 'Dunk', 'High', 'Game Royal', 'dunk_high_game_royal.jpg', 350),
(11, 'Dunk', 'High', 'Black White', 'dunk_high_black white.jpg', 180),
(12, 'Dunk', 'High', 'OG Seafoam', 'dunk_high_OG_seafoam.jpg', 260),
(13, 'Dunk', 'Low', 'Next Nature Pink Coral', 'dunk_low_next_nature_pink_coral.jpg', 270),
(14, 'Jordan', 'High', 'Fearless UNC', 'jordan_high_fearless_UNC.jpg', 215),
(15, 'Jordan', 'High', 'OG Bordeaux', 'jordan_high_OG_bordeaux.jpg', 265),
(16, 'Jordan', 'High', 'Shadow', 'jordan_high_shadow.jpg', 290),
(17, 'Jodan', 'High', 'Silver Toe Metallic Silver', 'jordan_high_silver_toe_metallic_silver.jpg', 320),
(18, 'Jordan', 'High', 'White University Blue', 'jordan_high_white_university_blue.jpg', 325),
(19, 'Jordan', 'Low', 'Green Toe', 'jordan_low_green_toe.jpg', 170),
(20, 'Jordan', 'Low', 'UNC', 'jordan_low_UNC.jpg', 205),
(21, 'Jordan', 'Mid', 'Dia de Los Muertos', 'jordan_mid_dia_de_los_muertos.jpg', 425),
(22, 'Jordan', 'Mid', 'Kentucky', 'jordan_mid_kentucky.jpg', 290),
(23, 'Jordan', 'Mid', 'Light Violet', 'jordan_mid_light_violet.jpg', 315),
(24, 'Jordan', 'Mid', 'Purple Aqua', 'jordan_mid_purple_aqua.jpg', 370),
(25, 'Jordan', 'Mid', 'Smoke Grey', 'jordan_mid_smoke_grey.jpg', 345),
(26, 'Jordan', 'High', 'University Gold', 'jordan_high_university_gold.jpg', 320);

-- --------------------------------------------------------

--
-- Struttura della tabella `notifiche`
--

CREATE TABLE `notifiche` (
  `codiceNotifica` int(8) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `dataNotifica` varchar(100) NOT NULL,
  `visto` varchar(3) NOT NULL,
  `usernameUtente` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `notifiche`
--

INSERT INTO `notifiche` (`codiceNotifica`, `titolo`, `descrizione`, `dataNotifica`, `visto`, `usernameUtente`) VALUES
(28, 'Ordine ricevuto', 'Hai ricevuto un nuovo ordine', '09/02/2022 17:38:03', 'si', 'admin'),
(29, 'Ordine ricevuto', 'Hai ricevuto un nuovo ordine', '09/02/2022 17:46:06', 'si', 'admin'),
(30, 'Ordine ricevuto', 'Hai ricevuto un nuovo ordine', '09/02/2022 17:50:10', 'si', 'admin'),
(31, 'Ordine ricevuto', 'Hai ricevuto un nuovo ordine', '09/02/2022 17:53:35', 'si', 'admin'),
(32, 'Ordine ricevuto', 'Hai ricevuto un nuovo ordine', '09/02/2022 17:55:04', 'si', 'admin'),
(33, 'Ordine in preparazione', 'Il tuo ordine numero 1 è stato confermato ed è in fase di preparazione!', '09/02/2022 18:48:22', 'si', 'luciaCastellucci'),
(34, 'Ordine in preparazione', 'Il tuo ordine numero 5 è stato confermato ed è in fase di preparazione!', '09/02/2022 19:04:58', 'si', 'paoloManfredi'),
(35, 'Ordine spedito', 'Il tuo ordine numero 1 è stato spedito dal fornitore!', '09/02/2022 19:09:30', 'si', 'luciaCastellucci'),
(36, 'Ordine spedito', 'Il tuo ordine numero 1 è stato spedito dal fornitore!', '09/02/2022 19:10:42', 'si', 'luciaCastellucci'),
(37, 'Ordine in preparazione', 'Il tuo ordine numero 3 è stato confermato ed è in fase di preparazione!', '09/02/2022 19:29:42', 'si', 'luciaCastellucci'),
(38, 'Ordine in preparazione', 'Il tuo ordine numero 2 è stato confermato ed è in fase di preparazione!', '09/02/2022 19:29:45', 'si', 'luciaCastellucci'),
(39, 'Ordine spedito', 'Il tuo ordine numero 2 è stato spedito dal fornitore!', '09/02/2022 19:29:51', 'si', 'luciaCastellucci'),
(40, 'Ordine ricevuto', 'Hai ricevuto un nuovo ordine', '09/02/2022 20:59:58', 'si', 'admin'),
(41, 'Ordine in preparazione', 'Il tuo ordine numero 6 è stato confermato ed è in fase di preparazione!', '09/02/2022 21:01:24', 'si', 'riccardoCastellucci'),
(42, 'Ordine spedito', 'Il tuo ordine numero 5 è stato spedito dal fornitore!', '11/02/2022 13:00:50', 'si', 'paoloManfredi'),
(43, 'Ordine ricevuto', 'Hai ricevuto un nuovo ordine', '11/02/2022 15:31:06', 'si', 'admin'),
(45, 'Ordine ricevuto', 'Hai ricevuto un nuovo ordine', '11/02/2022 15:32:51', 'si', 'admin'),
(46, 'Ordine ricevuto', 'Hai ricevuto un nuovo ordine', '11/02/2022 15:51:21', 'si', 'admin'),
(47, 'Articolo in esaurimento', 'Rifornisci il prodotto Nike Dunk High Black White nella taglia 35! Ne sono rimasti solo 4 pezzi!', '11/02/2022 15:51:21', 'si', 'admin');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `numeroOrdine` int(8) NOT NULL,
  `dataOrdine` varchar(50) NOT NULL,
  `recapito` varchar(100) NOT NULL,
  `indirizzoSpedizione` varchar(100) NOT NULL,
  `cittàSpedizione` varchar(100) NOT NULL,
  `CAP` varchar(10) NOT NULL,
  `codiCarrello` int(8) NOT NULL,
  `codiCliente` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`numeroOrdine`, `dataOrdine`, `recapito`, `indirizzoSpedizione`, `cittàSpedizione`, `CAP`, `codiCarrello`, `codiCliente`) VALUES
(1, '09/02/2022 17:38:03', 'Castellucci Sanzani', 'Viale Domenico Bolognesi, 31', 'Forlì', '47121', 3, 'luciaCastellucci'),
(2, '09/02/2022 17:46:06', 'Casadei Castellucci', 'Via Francesco Baracca 16', 'Forlì', '47121', 4, 'luciaCastellucci'),
(3, '09/02/2022 17:50:10', 'Francesca Sanzani', 'Viale Domenico Bolognesi, 31', 'Forlì', '47121', 6, 'luciaCastellucci'),
(4, '09/02/2022 17:53:35', '', 'Viale Domenico Bolognesi, 31', 'Forlì', '47121', 7, 'luciaCastellucci'),
(5, '09/02/2022 17:55:04', '', 'Via del Bosco, 40', 'Forlì', '47122', 2, 'paoloManfredi'),
(6, '09/02/2022 20:59:58', 'luci', 'Viale Domenico Bolognesi, 31', 'Forlì', '47121', 1, 'riccardoCastellucci'),
(7, '11/02/2022 15:31:06', 'Paolo', 'Via del Bosco, 40', 'Forlì', '47122', 16, 'paoloManfredi'),
(8, '11/02/2022 15:32:51', 'Federico', 'Via Francesco Baracca 16', 'Forlì', '47122', 18, 'federicoManfredi'),
(9, '11/02/2022 15:51:21', 'Andrea', 'Via del Bosco, 40', 'Forlì', '47122', 19, 'federicoManfredi');

-- --------------------------------------------------------

--
-- Struttura della tabella `scarpa`
--

CREATE TABLE `scarpa` (
  `codModello` int(8) NOT NULL,
  `codTaglia` int(8) NOT NULL,
  `qtaMagazzino` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `scarpa`
--

INSERT INTO `scarpa` (`codModello`, `codTaglia`, `qtaMagazzino`) VALUES
(1, 35, 0),
(1, 36, 10),
(1, 37, 0),
(1, 38, 10),
(1, 39, 10),
(1, 40, 0),
(1, 41, 0),
(2, 35, 10),
(2, 38, 0),
(2, 39, 15),
(2, 40, 10),
(2, 41, 10),
(2, 45, 13),
(3, 37, 15),
(3, 38, 10),
(4, 40, 0),
(4, 41, 0),
(4, 42, 0),
(4, 43, 0),
(5, 35, 10),
(5, 38, 14),
(5, 39, 20),
(6, 36, 0),
(6, 37, 0),
(7, 42, 9),
(7, 43, 12),
(7, 44, 14),
(7, 45, 16),
(8, 35, 8),
(8, 36, 10),
(8, 37, 15),
(8, 38, 10),
(8, 39, 15),
(9, 41, 10),
(9, 42, 10),
(9, 43, 10),
(9, 44, 13),
(9, 45, 15),
(10, 38, 10),
(10, 39, 14),
(10, 40, 17),
(10, 41, 10),
(10, 42, 11),
(11, 35, 4),
(11, 36, 10),
(12, 35, 10),
(12, 37, 10),
(12, 38, 8),
(13, 37, 10),
(13, 38, 15),
(13, 39, 8),
(14, 41, 9),
(14, 42, 11),
(14, 43, 12),
(14, 44, 21),
(15, 35, 25),
(15, 39, 19),
(16, 37, 10),
(16, 41, 15),
(16, 43, 16),
(16, 45, 11),
(17, 37, 10),
(17, 38, 11),
(17, 39, 12),
(17, 40, 10),
(18, 35, 17),
(18, 36, 18),
(19, 37, 9),
(19, 38, 8),
(19, 39, 10),
(20, 41, 11),
(20, 42, 15),
(20, 43, 19),
(21, 37, 20),
(21, 38, 21),
(21, 42, 10),
(22, 37, 10),
(22, 38, 7),
(22, 43, 11),
(22, 44, 15),
(23, 37, 10),
(23, 39, 18),
(23, 41, 10),
(24, 42, 11),
(24, 43, 10),
(24, 44, 12),
(25, 37, 10),
(25, 38, 8),
(25, 42, 7),
(25, 43, 10),
(26, 38, 10),
(26, 39, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `scarpe_carrello`
--

CREATE TABLE `scarpe_carrello` (
  `codCarrello` int(8) NOT NULL,
  `codModello` int(8) NOT NULL,
  `codTaglia` int(8) NOT NULL,
  `qtaCarrello` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `scarpe_carrello`
--

INSERT INTO `scarpe_carrello` (`codCarrello`, `codModello`, `codTaglia`, `qtaCarrello`) VALUES
(1, 4, 40, 1),
(2, 10, 39, 1),
(3, 2, 38, 2),
(3, 7, 42, 1),
(4, 25, 42, 1),
(6, 2, 38, 1),
(7, 5, 38, 1),
(16, 6, 36, 1),
(16, 9, 43, 1),
(18, 2, 45, 1),
(19, 11, 35, 3);

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
  `dataStato` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `stato_ordine`
--

INSERT INTO `stato_ordine` (`stato`, `numOrdine`, `dataStato`) VALUES
('In preparazione', 1, 1644428902),
('In preparazione', 2, 1644431385),
('In preparazione', 3, 1644431382),
('In preparazione', 5, 1644429898),
('In preparazione', 6, 1644436884),
('Ordinato', 1, 1644424683),
('Ordinato', 2, 1644425166),
('Ordinato', 3, 1644425410),
('Ordinato', 4, 1644425615),
('Ordinato', 5, 1644425704),
('Ordinato', 6, 1644436798),
('Ordinato', 7, 1644589866),
('Ordinato', 8, 1644589971),
('Ordinato', 9, 1644591081),
('Spedito', 1, 1644430170),
('Spedito', 2, 1644431391),
('Spedito', 5, 1644580850);

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
  `tipo` varchar(8) NOT NULL,
  `codeCarrello` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`username`, `pw`, `nome`, `tipo`, `codeCarrello`) VALUES
('admin', 'admin', 'Admin', 'admin', NULL),
('andreaManfredi', 'andreamanfre', 'Andrea Manfredi', 'cliente', NULL),
('federicoManfredi', 'fedemanfre', 'Federico Manfredi', 'cliente', 20),
('francescaSanzani', 'francisanza', 'Francesca Sanzani', 'cliente', NULL),
('gianlucaCastellucci', 'gianlucacaste', 'Gianluca Castellucci', 'cliente', NULL),
('luciaCastellucci', 'luciacaste', 'Lucia Castellucci', 'cliente', 22),
('paoloManfredi', 'paolomanfre', 'Paolo Manfredi', 'cliente', 17),
('riccardoCastellucci', 'richicaste', 'Riccardo Castellucci', 'cliente', 13);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`codiceCarrello`);

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
  ADD KEY `notifica_utente` (`usernameUtente`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`numeroOrdine`),
  ADD KEY `carrello_ordine` (`codiCarrello`),
  ADD KEY `cliente_ordine` (`codiCliente`);

--
-- Indici per le tabelle `scarpa`
--
ALTER TABLE `scarpa`
  ADD PRIMARY KEY (`codModello`,`codTaglia`),
  ADD KEY `scarpa_taglia` (`codTaglia`);

--
-- Indici per le tabelle `scarpe_carrello`
--
ALTER TABLE `scarpe_carrello`
  ADD PRIMARY KEY (`codCarrello`,`codModello`,`codTaglia`),
  ADD KEY `modello_scarpa_carrello` (`codModello`),
  ADD KEY `modello_taglia_carrello` (`codTaglia`);

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
  ADD PRIMARY KEY (`username`),
  ADD KEY `utente_carrello` (`codeCarrello`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `notifiche`
--
ALTER TABLE `notifiche`
  MODIFY `codiceNotifica` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `numeroOrdine` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `notifiche`
--
ALTER TABLE `notifiche`
  ADD CONSTRAINT `notifica_utente` FOREIGN KEY (`usernameUtente`) REFERENCES `utente` (`username`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `carrello_ordine` FOREIGN KEY (`codiCarrello`) REFERENCES `carrello` (`codiceCarrello`),
  ADD CONSTRAINT `cliente_ordine` FOREIGN KEY (`codiCliente`) REFERENCES `utente` (`username`);

--
-- Limiti per la tabella `scarpa`
--
ALTER TABLE `scarpa`
  ADD CONSTRAINT `scarpa_modello` FOREIGN KEY (`codModello`) REFERENCES `modello` (`codiceModello`),
  ADD CONSTRAINT `scarpa_taglia` FOREIGN KEY (`codTaglia`) REFERENCES `taglia` (`taglia`);

--
-- Limiti per la tabella `scarpe_carrello`
--
ALTER TABLE `scarpe_carrello`
  ADD CONSTRAINT `carrello_scarpe` FOREIGN KEY (`codCarrello`) REFERENCES `carrello` (`codiceCarrello`),
  ADD CONSTRAINT `modello_scarpa_carrello` FOREIGN KEY (`codModello`) REFERENCES `scarpa` (`codModello`),
  ADD CONSTRAINT `modello_taglia_carrello` FOREIGN KEY (`codTaglia`) REFERENCES `scarpa` (`codTaglia`);

--
-- Limiti per la tabella `stato_ordine`
--
ALTER TABLE `stato_ordine`
  ADD CONSTRAINT `stato_ordine` FOREIGN KEY (`numOrdine`) REFERENCES `ordine` (`numeroOrdine`),
  ADD CONSTRAINT `stato_stato` FOREIGN KEY (`stato`) REFERENCES `stato` (`statoSpedizione`);

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_carrello` FOREIGN KEY (`codeCarrello`) REFERENCES `carrello` (`codiceCarrello`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
