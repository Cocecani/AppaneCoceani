-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2026 at 05:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `tadmin`
--

CREATE TABLE `tadmin` (
  `idUtente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tadmin`
--

INSERT INTO `tadmin` (`idUtente`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `tindirizzo`
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
-- Dumping data for table `tindirizzo`
--

INSERT INTO `tindirizzo` (`id`, `via`, `numeroCivico`, `CAP`, `citta`, `provincia`) VALUES
(1, 'Antonio Abetti', '11', '34170', 'Gorizia', 'GO'),
(2, 'a', '1', '34011', 'triester', 'at');

-- --------------------------------------------------------

--
-- Table structure for table `tingrediente`
--

CREATE TABLE `tingrediente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tingrediente`
--

INSERT INTO `tingrediente` (`id`, `nome`) VALUES
(4, 'Sale'),
(5, 'Lievito'),
(6, 'Farina'),
(10, 'Acqua'),
(18, 'Zucchero'),
(19, 'Uvette'),
(20, 'Burro'),
(21, 'Olio'),
(22, 'Cioccolato'),
(23, 'Latte'),
(24, 'Uova'),
(25, 'Semola'),
(26, 'Semi di Girasole'),
(27, 'Semi di Sesamo'),
(28, 'Zucchero di Canna'),
(29, 'Pomodoro'),
(30, 'Mozzarella'),
(31, 'Origano'),
(32, 'Salsiccia'),
(33, 'Cipolla'),
(34, 'Rosmarino');

-- --------------------------------------------------------

--
-- Table structure for table `tmenu`
--

CREATE TABLE `tmenu` (
  `idProdotto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tmenu`
--

INSERT INTO `tmenu` (`idProdotto`) VALUES
(20),
(24),
(25),
(26),
(27),
(30),
(32),
(34);

-- --------------------------------------------------------

--
-- Table structure for table `tordine`
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
  `accetato` tinyint(1) DEFAULT NULL,
  `consegnato` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tprodotto`
--

CREATE TABLE `tprodotto` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tprodotto`
--

INSERT INTO `tprodotto` (`id`, `nome`, `prezzo`) VALUES
(20, 'Pane Biango', 8),
(24, 'Pane Ciock', 6.5),
(25, 'Pan Uvetta', 6.5),
(26, 'Alpha', 6.5),
(27, 'Semi Biango', 6.5),
(28, 'Biango', 6.5),
(29, 'Brown Sugar', 6.5),
(30, 'Apizzz 14', 14),
(31, 'Margherita', 14),
(32, 'Tiphel', 6.5),
(33, 'Rossalsichia', 14),
(34, 'Tina Cipollari', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tricetta`
--

CREATE TABLE `tricetta` (
  `idIngrediente` int(11) NOT NULL,
  `idProdotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tricetta`
--

INSERT INTO `tricetta` (`idIngrediente`, `idProdotto`) VALUES
(4, 20),
(4, 25),
(4, 26),
(4, 27),
(4, 28),
(4, 30),
(4, 31),
(4, 32),
(4, 33),
(4, 34),
(5, 20),
(5, 25),
(5, 26),
(5, 27),
(5, 28),
(5, 29),
(5, 30),
(5, 31),
(5, 32),
(5, 33),
(5, 34),
(6, 20),
(6, 24),
(6, 25),
(6, 26),
(6, 27),
(6, 28),
(6, 29),
(6, 30),
(6, 31),
(6, 32),
(6, 33),
(6, 34),
(10, 20),
(10, 25),
(10, 26),
(10, 27),
(10, 28),
(10, 30),
(10, 31),
(10, 32),
(10, 33),
(10, 34),
(18, 24),
(18, 25),
(19, 25),
(20, 24),
(20, 29),
(21, 30),
(21, 31),
(21, 32),
(21, 34),
(22, 24),
(23, 24),
(23, 29),
(24, 24),
(24, 29),
(25, 26),
(26, 27),
(27, 27),
(28, 29),
(29, 30),
(29, 31),
(29, 33),
(30, 30),
(30, 31),
(30, 33),
(31, 30),
(32, 33),
(33, 34),
(34, 32),
(34, 34);

-- --------------------------------------------------------

--
-- Table structure for table `tutente`
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
-- Dumping data for table `tutente`
--

INSERT INTO `tutente` (`idutente`, `nome`, `password`, `email`, `indirizzo`, `numeroTelefonico`) VALUES
(3, 'Signor Appane', '$2y$10$XdAqyU9gruz0zDNALOAYVeQMO.XlYTvsFTCJw2lYc6sPvXnFWRSKi', 'admin@appane.it', NULL, NULL),
(8, 'test', '$2y$10$qs2a8aAegyw/MXU1frumZOgsGum/4IlpwiwG679JZYgboHFqD9qHi', 'test@test.com', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tadmin`
--
ALTER TABLE `tadmin`
  ADD UNIQUE KEY `idutente` (`idUtente`);

--
-- Indexes for table `tindirizzo`
--
ALTER TABLE `tindirizzo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tingrediente`
--
ALTER TABLE `tingrediente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmenu`
--
ALTER TABLE `tmenu`
  ADD UNIQUE KEY `idprodotto` (`idProdotto`);

--
-- Indexes for table `tordine`
--
ALTER TABLE `tordine`
  ADD PRIMARY KEY (`idUtente`,`idProdotto`,`data`,`idIndirizzo`) USING BTREE,
  ADD KEY `idProdotto` (`idProdotto`),
  ADD KEY `idIndirizzo` (`idIndirizzo`);

--
-- Indexes for table `tprodotto`
--
ALTER TABLE `tprodotto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nome` (`nome`);

--
-- Indexes for table `tricetta`
--
ALTER TABLE `tricetta`
  ADD PRIMARY KEY (`idIngrediente`,`idProdotto`) USING BTREE,
  ADD KEY `idProdotto` (`idProdotto`);

--
-- Indexes for table `tutente`
--
ALTER TABLE `tutente`
  ADD PRIMARY KEY (`idutente`),
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD KEY `fk_utente_indirizzo` (`indirizzo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tindirizzo`
--
ALTER TABLE `tindirizzo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tingrediente`
--
ALTER TABLE `tingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tprodotto`
--
ALTER TABLE `tprodotto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tutente`
--
ALTER TABLE `tutente`
  MODIFY `idutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tadmin`
--
ALTER TABLE `tadmin`
  ADD CONSTRAINT `FK_admin` FOREIGN KEY (`idUtente`) REFERENCES `tutente` (`idutente`),
  ADD CONSTRAINT `tadmin_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `tutente` (`idutente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tmenu`
--
ALTER TABLE `tmenu`
  ADD CONSTRAINT `FK_menuprodotto` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`),
  ADD CONSTRAINT `tmenu_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tordine`
--
ALTER TABLE `tordine`
  ADD CONSTRAINT `tordine_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tordine_ibfk_2` FOREIGN KEY (`idUtente`) REFERENCES `tutente` (`idutente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tordine_ibfk_3` FOREIGN KEY (`idIndirizzo`) REFERENCES `tindirizzo` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tricetta`
--
ALTER TABLE `tricetta`
  ADD CONSTRAINT `fk_ingrediente` FOREIGN KEY (`idIngrediente`) REFERENCES `tingrediente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ricetta` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tricetta_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutente`
--
ALTER TABLE `tutente`
  ADD CONSTRAINT `fk_utente_indirizzo` FOREIGN KEY (`indirizzo`) REFERENCES `tindirizzo` (`id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_weekly_menu` ON SCHEDULE EVERY 1 WEEK STARTS '2026-03-21 00:00:00' ON COMPLETION PRESERVE ENABLE DO DELETE FROM tmenu$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
