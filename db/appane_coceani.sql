-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mar 13, 2026 alle 10:56
-- Versione del server: 10.11.11-MariaDB-0+deb12u1
-- Versione PHP: 8.2.28

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
  `idutente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tadmin`
--

INSERT INTO `tadmin` (`idutente`) VALUES
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
(2, 'Acqua'),
(3, 'Uovo'),
(4, 'Sale'),
(5, 'Lievito'),
(6, 'Farina 00'),
(7, 'Farina 01');

-- --------------------------------------------------------

--
-- Struttura della tabella `tmenu`
--

CREATE TABLE `tmenu` (
  `idprodotto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `tordine`
--

CREATE TABLE `tordine` (
  `idUtente` int(11) DEFAULT NULL,
  `idProdotto` int(11) DEFAULT NULL,
  `quantita` int(11) DEFAULT NULL,
  `totale` float NOT NULL,
  `idIndirizzo` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(13, 'Pane Biango', 0.04),
(15, 'Pane Nuovo3', 0.08);

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
(2, 13),
(2, 15),
(3, 13),
(3, 15),
(4, 15);

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
  `numeroTelefonico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tutente`
--

INSERT INTO `tutente` (`idutente`, `nome`, `password`, `email`, `indirizzo`, `numeroTelefonico`) VALUES
(0, 'Signor Appane', '$2y$10$XdAqyU9gruz0zDNALOAYVeQMO.XlYTvsFTCJw2lYc6sPvXnFWRSKi', 'admin@appane.it', NULL, NULL),
(2, 'Vitalii Khodziuk', '$2y$10$USBQU/qJzH5McFbh4raYhuUEHa5Uky3D.maLAeBTMg/9KT1WIv5Xu', 'khodziuk.vitalii@volta.ts.it', NULL, NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tadmin`
--
ALTER TABLE `tadmin`
  ADD UNIQUE KEY `idutente` (`idutente`);

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
  ADD UNIQUE KEY `idprodotto` (`idprodotto`);

--
-- Indici per le tabelle `tordine`
--
ALTER TABLE `tordine`
  ADD KEY `fk_ordineutente` (`idUtente`),
  ADD KEY `fk_ordineprodotto` (`idProdotto`),
  ADD KEY `fk_ordineindirizzo` (`idIndirizzo`);

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
  ADD PRIMARY KEY (`idutente`),
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD KEY `fk_utente_indirizzo` (`indirizzo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tingrediente`
--
ALTER TABLE `tingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `tprodotto`
--
ALTER TABLE `tprodotto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `tadmin`
--
ALTER TABLE `tadmin`
  ADD CONSTRAINT `FK_admin` FOREIGN KEY (`idutente`) REFERENCES `tutente` (`idutente`);

--
-- Limiti per la tabella `tmenu`
--
ALTER TABLE `tmenu`
  ADD CONSTRAINT `FK_menuprodotto` FOREIGN KEY (`idprodotto`) REFERENCES `tprodotto` (`id`);

--
-- Limiti per la tabella `tordine`
--
ALTER TABLE `tordine`
  ADD CONSTRAINT `fk_ordineindirizzo` FOREIGN KEY (`idIndirizzo`) REFERENCES `tindirizzo` (`id`),
  ADD CONSTRAINT `fk_ordineprodotto` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`),
  ADD CONSTRAINT `fk_ordineutente` FOREIGN KEY (`idUtente`) REFERENCES `tutente` (`idutente`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;