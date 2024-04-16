-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 01, 2024 at 07:16 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bailleurs`
--

CREATE TABLE `bailleurs` (
  `id` int(11) NOT NULL,
  `biens` int(11) NOT NULL,
  `id_prestations` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bien`
--

CREATE TABLE `bien` (
  `id` int(11) NOT NULL,
  `id_bailleur` int(11) NOT NULL,
  `nom_bien` varchar(60) NOT NULL,
  `description` varchar(60) NOT NULL,
  `couchage` int(11) NOT NULL,
  `type_bien` varchar(60) NOT NULL,
  `type_location` varchar(60) NOT NULL,
  `ville` varchar(60) NOT NULL,
  `adresse` varchar(60) NOT NULL,
  `code_postale` int(11) NOT NULL,
  `prix_adulte` int(11) NOT NULL,
  `prix_enfant` int(11) NOT NULL,
  `prix_animaux` int(11) NOT NULL,
  `nb_lit` int(11) NOT NULL,
  `piscine` tinyint(1) NOT NULL,
  `note_moyenne` int(11) NOT NULL,
  `salle_eau` int(11) NOT NULL,
  `images` int(11) NOT NULL,
  `nb_chambres` int(11) NOT NULL,
  `dispo` int(11) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `id_bien` int(11) NOT NULL,
  `id_voyageur` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `contenu` varchar(120) NOT NULL,
  `date_publication` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `id_bien` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_bailleur` int(11) NOT NULL,
  `id_presations` int(11) NOT NULL,
  `prix_location` int(11) NOT NULL,
  `prix_prestations` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `id_bien` int(11) NOT NULL,
  `chemin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prestataires`
--

CREATE TABLE `prestataires` (
  `id_user` int(11) NOT NULL,
  `note_moyenne` int(11) NOT NULL,
  `id_prestations` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `id_bien` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_bailleur` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nb_animaux` int(11) NOT NULL,
  `nb_adulte` int(11) NOT NULL,
  `nb_enfant` int(11) NOT NULL,
  `statut` varchar(60) NOT NULL,
  `prix_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `naissance` date NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `role` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `voyageur`
--

CREATE TABLE `voyageur` (
  `id` int(11) NOT NULL,
  `reservations_passe` varchar(60) NOT NULL,
  `reservation_futur` int(11) NOT NULL,
  `reservation_en_cours` int(11) NOT NULL,
  `vip` int(11) NOT NULL,
  `commentaires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bailleurs`
--
ALTER TABLE `bailleurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bien`
--
ALTER TABLE `bien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prestataires`
--
ALTER TABLE `prestataires`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voyageur`
--
ALTER TABLE `voyageur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bailleurs`
--
ALTER TABLE `bailleurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bien`
--
ALTER TABLE `bien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voyageur`
--
ALTER TABLE `voyageur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
