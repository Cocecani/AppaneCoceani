-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 16, 2026 alle 22:42
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appane_coceani`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tadmin`
--

CREATE TABLE `tadmin` (
  `idUtente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tadmin`
--

INSERT INTO `tadmin` (`idUtente`) VALUES
(0);

-- --------------------------------------------------------

--
-- Struttura della tabella `tindirizzo`
--

CREATE TABLE `tindirizzo` (
  `id` int(11) NOT NULL,
  `via` varchar(255) DEFAULT NULL,
  `numeroCivico` varchar(5) DEFAULT NULL,
  `CAP` char(5) DEFAULT NULL,
  `citta` varchar(255) DEFAULT NULL,
  `provincia` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tindirizzo`
--

INSERT INTO `tindirizzo` (`id`, `via`, `numeroCivico`, `CAP`, `citta`, `provincia`) VALUES
(0, 'Antonio Abetti', '11', '34170', 'Gorizia', 'GO');

-- --------------------------------------------------------

--
-- Struttura della tabella `tingrediente`
--

CREATE TABLE `tingrediente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tingrediente`
--

INSERT INTO `tingrediente` (`id`, `nome`) VALUES
(4, 'Sale'),
(5, 'Lievito'),
(6, 'Farina'),
(10, 'Acqua'),
(18, 'Zucchero'),
(19, 'Uvette'),
(20, 'Burro'),
(21, 'Olio');

-- --------------------------------------------------------

--
-- Struttura della tabella `tmenu`
--

CREATE TABLE `tmenu` (
  `idProdotto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `tordine`
--

CREATE TABLE `tordine` (
  `idUtente` int(11) NOT NULL,
  `idProdotto` int(11) NOT NULL,
  `prezzo` float NOT NULL,
  `quantita` int(11) NOT NULL,
  `sconto` float DEFAULT NULL,
  `totale` float NOT NULL,
  `idIndirizzo` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `accettato` tinyint(1) DEFAULT NULL,
  `consegnato` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tordine`
--

INSERT INTO `tordine` (`idUtente`, `idProdotto`, `prezzo`, `quantita`, `sconto`, `totale`, `idIndirizzo`, `data`, `accettato`, `consegnato`) VALUES
(2, 20, 20, 2, NULL, 40, 0, '2026-03-15 18:57:46', 1, 1),
(2, 22, 22, 3, NULL, 66, 0, '2026-03-05 18:55:31', NULL, NULL),
(2, 22, 22, 2, NULL, 44, 0, '2026-03-15 19:18:47', 1, 1),
(2, 23, 23, 2, NULL, 46, 0, '2026-03-15 19:31:00', 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tprodotto`
--

CREATE TABLE `tprodotto` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tprodotto`
--

INSERT INTO `tprodotto` (`id`, `nome`, `prezzo`) VALUES
(20, 'Pane Biango', 8),
(21, 'Pane Nuovo', 22),
(22, 'Pane Nuovo2', 11),
(23, 'Pane Nuovo3', 23);

-- --------------------------------------------------------

--
-- Struttura della tabella `tricetta`
--

CREATE TABLE `tricetta` (
  `idIngrediente` int(11) NOT NULL,
  `idProdotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tricetta`
--

INSERT INTO `tricetta` (`idIngrediente`, `idProdotto`) VALUES
(4, 20),
(5, 20),
(5, 22),
(6, 20),
(6, 22),
(10, 20),
(10, 21),
(19, 23),
(20, 21),
(20, 23),
(21, 22);

-- --------------------------------------------------------

--
-- Struttura della tabella `tutente`
--

CREATE TABLE `tutente` (
  `idutente` int(11) NOT NULL,
  `nome` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `indirizzo` int(11) DEFAULT NULL,
  `numeroTelefonico` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tutente`
--

INSERT INTO `tutente` (`idutente`, `nome`, `password`, `email`, `indirizzo`, `numeroTelefonico`) VALUES
(0, 'Vincenzo', '$2y$10$XdAqyU9gruz0zDNALOAYVeQMO.XlYTvsFTCJw2lYc6sPvXnFWRSKi', 'admin@appane.it', NULL, NULL),
(2, 'Vitalii Khodziuk', '$2y$10$USBQU/qJzH5McFbh4raYhuUEHa5Uky3D.maLAeBTMg/9KT1WIv5Xu', 'khodziuk.vitalii@volta.ts.it', NULL, '+393245820850');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tadmin`
--
ALTER TABLE `tadmin`
  ADD UNIQUE KEY `idutente` (`idUtente`);

--
-- Indici per le tabelle `tindirizzo`
--
ALTER TABLE `tindirizzo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tingrediente`
--
ALTER TABLE `tingrediente`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tmenu`
--
ALTER TABLE `tmenu`
  ADD UNIQUE KEY `idprodotto` (`idProdotto`);

--
-- Indici per le tabelle `tordine`
--
ALTER TABLE `tordine`
  ADD PRIMARY KEY (`idUtente`,`idProdotto`,`data`,`idIndirizzo`) USING BTREE,
  ADD KEY `idProdotto` (`idProdotto`),
  ADD KEY `idIndirizzo` (`idIndirizzo`);

--
-- Indici per le tabelle `tprodotto`
--
ALTER TABLE `tprodotto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nome` (`nome`);

--
-- Indici per le tabelle `tricetta`
--
ALTER TABLE `tricetta`
  ADD PRIMARY KEY (`idIngrediente`,`idProdotto`) USING BTREE,
  ADD KEY `idProdotto` (`idProdotto`);

--
-- Indici per le tabelle `tutente`
--
ALTER TABLE `tutente`
  ADD PRIMARY KEY (`idutente`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD KEY `fk_utente_indirizzo` (`indirizzo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tingrediente`
--
ALTER TABLE `tingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `tprodotto`
--
ALTER TABLE `tprodotto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `tadmin`
--
ALTER TABLE `tadmin`
  ADD CONSTRAINT `FK_admin` FOREIGN KEY (`idutente`) REFERENCES `tutente` (`idutente`),
  ADD CONSTRAINT `tadmin_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `tutente` (`idutente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `tmenu`
--
ALTER TABLE `tmenu`
  ADD CONSTRAINT `FK_menuprodotto` FOREIGN KEY (`idprodotto`) REFERENCES `tprodotto` (`id`),
  ADD CONSTRAINT `tmenu_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `tordine`
--
ALTER TABLE `tordine`
  ADD CONSTRAINT `tordine_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tordine_ibfk_2` FOREIGN KEY (`idUtente`) REFERENCES `tutente` (`idutente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tordine_ibfk_3` FOREIGN KEY (`idIndirizzo`) REFERENCES `tindirizzo` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `tricetta`
--
ALTER TABLE `tricetta`
  ADD CONSTRAINT `fk_ingrediente` FOREIGN KEY (`idIngrediente`) REFERENCES `tingrediente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ricetta` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tricetta_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `tutente`
--
ALTER TABLE `tutente`
  ADD CONSTRAINT `fk_utente_indirizzo` FOREIGN KEY (`indirizzo`) REFERENCES `tindirizzo` (`id`);

DELIMITER $$
--
-- Eventi
--
CREATE EVENT `delete_weekly_menu` ON SCHEDULE EVERY 1 WEEK STARTS '2026-03-21 00:00:00' ON COMPLETION PRESERVE ENABLE DO DELETE FROM tmenu$$

DELIMITER ;
COMMIT;