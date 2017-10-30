-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 30 Octobre 2017 à 16:18
-- Version du serveur :  5.7.20-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `piscine`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `idContact` int(10) NOT NULL,
  `estPrincipalContact` int(10) NOT NULL,
  `nomContact` varchar(50) NOT NULL,
  `prenomContact` varchar(50) NOT NULL,
  `mailContact` varchar(50) NOT NULL,
  `rueContact` varchar(50) NOT NULL,
  `villeContact` varchar(50) NOT NULL,
  `cpContact` varchar(50) NOT NULL,
  `idEditeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE `editeur` (
  `idEditeur` int(50) NOT NULL,
  `libelleEditeur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `festival`
--

CREATE TABLE `festival` (
  `idFestival` int(50) NOT NULL,
  `anneeFestival` int(11) NOT NULL,
  `nbEmplacementTotal` int(11) NOT NULL,
  `prixEmplacementFestival` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `organisateur`
--

CREATE TABLE `organisateur` (
  `idOrganisateur` int(50) NOT NULL,
  `loginOrganisateur` varchar(100) NOT NULL,
  `motDePasseOrganisateur` varchar(100) NOT NULL,
  `nomOrganisateur` varchar(100) NOT NULL,
  `prenomOrganisateur` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `organisateur`
--

INSERT INTO `organisateur` (`idOrganisateur`, `loginOrganisateur`, `motDePasseOrganisateur`, `nomOrganisateur`, `prenomOrganisateur`) VALUES
(1, 'login', 'motdepasse', 'Test', 'Jean');

-- --------------------------------------------------------

--
-- Structure de la table `suivi`
--

CREATE TABLE `suivi` (
  `idSuivi` int(11) NOT NULL,
  `typeSuivi` varchar(100) NOT NULL,
  `dateSuivi` date NOT NULL,
  `commentaireSuivi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idContact`);

--
-- Index pour la table `editeur`
--
ALTER TABLE `editeur`
  ADD PRIMARY KEY (`idEditeur`);

--
-- Index pour la table `festival`
--
ALTER TABLE `festival`
  ADD PRIMARY KEY (`idFestival`);

--
-- Index pour la table `organisateur`
--
ALTER TABLE `organisateur`
  ADD PRIMARY KEY (`idOrganisateur`);

--
-- Index pour la table `suivi`
--
ALTER TABLE `suivi`
  ADD PRIMARY KEY (`idSuivi`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `idContact` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
  MODIFY `idEditeur` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `festival`
--
ALTER TABLE `festival`
  MODIFY `idFestival` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `organisateur`
--
ALTER TABLE `organisateur`
  MODIFY `idOrganisateur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `suivi`
--
ALTER TABLE `suivi`
  MODIFY `idSuivi` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
