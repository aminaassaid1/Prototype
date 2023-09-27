-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2023 at 12:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prototype1`
--

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE `personne` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `CNE` varchar(11) NOT NULL,
  `Ville_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`Id`, `Nom`, `CNE`, `Ville_Id`) VALUES
(1, 'Jalil Betroji', 'G627353', 1),
(2, 'Hamid Achauo', 'G6734', 1),
(3, 'Amine Lamchatab', 'G23823', 1),
(4, 'Adnane Benasar', 'G23823', 1),
(5, 'Mohamed-Amine Bkhit', 'G9587', 1),
(6, 'Imrane Sarsri', 'G9850', 1),
(7, 'Amina Assaid', 'G984545', 1),
(8, 'Yassmine Daifane', 'G8945', 3),
(9, 'Hussein Bouik', 'G45321', 3),
(10, 'Adnane Lharrak', 'G56324', 3),
(11, 'Hamza zaani', 'G456376', 3),
(12, 'Mohamed Baqqali', 'G54356', 6),
(13, 'Soufian Boukhal', 'GA76Z76', 6),
(14, 'Mohamed Aymane', 'G765376', 5),
(15, 'Ayman Alli', '', 11),
(16, 'Khlid Reda', '', 11),
(17, 'Mohamed Ali', '', 11),
(18, 'Ayman Asri', '', 11),
(19, 'Fouad Essarje', '', 1),
(22, 'Ayman ALI', '', 19),
(23, 'mouad lhilali', '', 12),
(24, 'Salah eghla', 'P634774', 13),
(25, 'abdo asri', 'P634755', 5),
(26, 'Ayman ALI', 'P634755', 12);

-- --------------------------------------------------------

--
-- Table structure for table `ville`
--

CREATE TABLE `ville` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ville`
--

INSERT INTO `ville` (`Id`, `Nom`) VALUES
(1, 'Tetouan'),
(2, 'Tanger'),
(3, 'Casablanca'),
(4, 'Rabat'),
(5, 'Larache'),
(6, 'Khouribga'),
(7, 'El Kelaa des Sraghna'),
(8, 'Khenifra'),
(9, 'Beni Mellal'),
(10, 'Tiznit'),
(11, 'Errachidia'),
(12, 'Taroudant'),
(13, 'Ouarzazate'),
(14, 'Safi'),
(15, 'Lahraouyine'),
(16, 'Berrechid'),
(17, 'Fkih Ben Salah'),
(18, 'Taourirt'),
(19, 'Sefrou'),
(20, 'Youssoufia');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
