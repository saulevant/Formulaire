-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 11:05 PM
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
-- Database: `formulaire`
--

-- --------------------------------------------------------

--
-- Table structure for table `formulaires`
--

CREATE TABLE `formulaires` (
  `Form_Num` int(11) NOT NULL,
  `Copie` int(11) NOT NULL,
  `Nb_Partenaires` int(11) NOT NULL,
  `Date_Debut` date NOT NULL,
  `Date_Fin` date NOT NULL,
  `Nb_Signatures` int(11) NOT NULL,
  `Concurence` int(11) NOT NULL,
  `Etat` text NOT NULL,
  `Affirme` text NOT NULL,
  `Date` date DEFAULT NULL,
  `Avocat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formulaires`
--

INSERT INTO `formulaires` (`Form_Num`, `Copie`, `Nb_Partenaires`, `Date_Debut`, `Date_Fin`, `Nb_Signatures`, `Concurence`, `Etat`, `Affirme`, `Date`, `Avocat`) VALUES
(71, 1, 3, '2025-01-13', '2025-06-11', 2, 10, 'France', 'Lyon 3', '2025-01-13', 'Langloy');

-- --------------------------------------------------------

--
-- Table structure for table `partenaires`
--

CREATE TABLE `partenaires` (
  `Part_Num` int(11) NOT NULL,
  `Part_Nom` text NOT NULL,
  `Part_Adresse` text NOT NULL,
  `Part_Type` text NOT NULL,
  `Part_Activité` text NOT NULL,
  `Contribution` text NOT NULL,
  `Partages` text NOT NULL,
  `Form_Num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partenaires`
--

INSERT INTO `partenaires` (`Part_Num`, `Part_Nom`, `Part_Adresse`, `Part_Type`, `Part_Activité`, `Contribution`, `Partages`, `Form_Num`) VALUES
(116, 'Franck', '50 Rue Lachaise', 'BTP', 'BuiltIn', '10 000 €', '45 %', 71),
(117, 'Jane', '30 Rue Jean Moulin', 'Fitness', 'MoveIt', '10 000 €', '45 %', 71),
(118, 'Stephan', '40 bis Boulevard des Dallias', 'BTP', 'Contruct\'', '1 000 €', '10 %', 71);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `formulaires`
--
ALTER TABLE `formulaires`
  ADD PRIMARY KEY (`Form_Num`);

--
-- Indexes for table `partenaires`
--
ALTER TABLE `partenaires`
  ADD PRIMARY KEY (`Part_Num`),
  ADD KEY `Form_Num` (`Form_Num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `formulaires`
--
ALTER TABLE `formulaires`
  MODIFY `Form_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `partenaires`
--
ALTER TABLE `partenaires`
  MODIFY `Part_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `partenaires`
--
ALTER TABLE `partenaires`
  ADD CONSTRAINT `partenaires_ibfk_1` FOREIGN KEY (`Form_Num`) REFERENCES `formulaires` (`Form_Num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
