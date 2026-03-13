-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2026 at 04:50 PM
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
  `idutente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(0, '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tingrediente`
--

CREATE TABLE `tingrediente` (
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tingrediente`
--

INSERT INTO `tingrediente` (`nome`) VALUES
('farina 00'),
('semi'),
('uova'),
('uvetta'),
('zucchero di canna');

-- --------------------------------------------------------

--
-- Table structure for table `tmenu`
--

CREATE TABLE `tmenu` (
  `idprodotto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tmenu`
--

INSERT INTO `tmenu` (`idprodotto`) VALUES
(1),
(4),
(6),
(7),
(9);

-- --------------------------------------------------------

--
-- Table structure for table `tordine`
--

CREATE TABLE `tordine` (
  `idUtente` int(11) DEFAULT NULL,
  `idProdotto` int(11) DEFAULT NULL,
  `quantita` int(11) DEFAULT NULL,
  `totale` float NOT NULL,
  `idIndirizzo` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tordine`
--

INSERT INTO `tordine` (`idUtente`, `idProdotto`, `quantita`, `totale`, `idIndirizzo`, `data`) VALUES
(0, 1, 3, 24, 0, '2026-03-12 20:40:47'),
(0, 4, 1, 8, 0, '2026-03-12 20:40:47'),
(0, 1, 1, 8, 0, '2026-03-12 21:21:56'),
(0, 4, 1, 8, 0, '2026-03-12 21:21:56'),
(0, 1, 1, 8, 0, '2026-03-12 21:40:35');

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
(1, 'pane Biango', 8),
(3, 'pane Negro', 8),
(4, 'pane ciock', 8),
(5, 'pan uvetta', 8),
(6, 'alpha', 8),
(7, 'semi biango', 8),
(8, 'biango', 8),
(9, 'brown sugar', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tricetta`
--

CREATE TABLE `tricetta` (
  `ingrediente` varchar(255) NOT NULL,
  `idProdotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tricetta`
--

INSERT INTO `tricetta` (`ingrediente`, `idProdotto`) VALUES
('farina 00', 1),
('uova', 1),
('farina 00', 3),
('uova', 3),
('farina 00', 4),
('uova', 4),
('farina 00', 5),
('uova', 5),
('uvetta', 5),
('farina 00', 6),
('uova', 6),
('farina 00', 7),
('uova', 7),
('semi', 7),
('farina 00', 8),
('uova', 8),
('farina 00', 9),
('uova', 9),
('zucchero di canna', 9);

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
(0, 'Testun', '$2y$10$uRVBPVNE3WMSMuPEU0nexONHpsI//.Xt2jS/497E9/OBAZGBL6CdG', 'testa@test.com', 0, 1234567890);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tadmin`
--
ALTER TABLE `tadmin`
  ADD UNIQUE KEY `idutente` (`idutente`);

--
-- Indexes for table `tindirizzo`
--
ALTER TABLE `tindirizzo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tingrediente`
--
ALTER TABLE `tingrediente`
  ADD PRIMARY KEY (`nome`);

--
-- Indexes for table `tmenu`
--
ALTER TABLE `tmenu`
  ADD UNIQUE KEY `idprodotto` (`idprodotto`);

--
-- Indexes for table `tordine`
--
ALTER TABLE `tordine`
  ADD KEY `fk_ordineutente` (`idUtente`),
  ADD KEY `fk_ordineprodotto` (`idProdotto`),
  ADD KEY `fk_ordineindirizzo` (`idIndirizzo`);

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
  ADD KEY `fk_ricetta` (`idProdotto`),
  ADD KEY `fk_ingrediente` (`ingrediente`);

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
-- AUTO_INCREMENT for table `tprodotto`
--
ALTER TABLE `tprodotto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tadmin`
--
ALTER TABLE `tadmin`
  ADD CONSTRAINT `FK_admin` FOREIGN KEY (`idutente`) REFERENCES `tutente` (`idutente`);

--
-- Constraints for table `tmenu`
--
ALTER TABLE `tmenu`
  ADD CONSTRAINT `FK_menuprodotto` FOREIGN KEY (`idprodotto`) REFERENCES `tprodotto` (`id`);

--
-- Constraints for table `tordine`
--
ALTER TABLE `tordine`
  ADD CONSTRAINT `fk_ordineindirizzo` FOREIGN KEY (`idIndirizzo`) REFERENCES `tindirizzo` (`id`),
  ADD CONSTRAINT `fk_ordineprodotto` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`),
  ADD CONSTRAINT `fk_ordineutente` FOREIGN KEY (`idUtente`) REFERENCES `tutente` (`idutente`);

--
-- Constraints for table `tricetta`
--
ALTER TABLE `tricetta`
  ADD CONSTRAINT `fk_ingrediente` FOREIGN KEY (`ingrediente`) REFERENCES `tingrediente` (`nome`),
  ADD CONSTRAINT `fk_ricetta` FOREIGN KEY (`idProdotto`) REFERENCES `tprodotto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutente`
--
ALTER TABLE `tutente`
  ADD CONSTRAINT `fk_utente_indirizzo` FOREIGN KEY (`indirizzo`) REFERENCES `tindirizzo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
