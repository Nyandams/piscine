-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 20 Janvier 2018 à 12:22
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
  `nomContact` varchar(50) DEFAULT NULL,
  `prenomContact` varchar(50) DEFAULT NULL,
  `mailContact` varchar(50) DEFAULT NULL,
  `telephoneContact` varchar(50) DEFAULT NULL,
  `rueContact` varchar(50) DEFAULT NULL,
  `villeContact` varchar(50) DEFAULT NULL,
  `cpContact` varchar(50) DEFAULT NULL,
  `idEditeur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE `editeur` (
  `idEditeur` int(50) NOT NULL,
  `libelleEditeur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `idFacture` int(11) NOT NULL,
  `dateEmissionFacture` date DEFAULT NULL,
  `datePaiementFacture` date DEFAULT NULL,
  `idReservation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `festival`
--

CREATE TABLE `festival` (
  `idFestival` int(50) NOT NULL,
  `anneeFestival` int(11) DEFAULT NULL,
  `nbEmplacementTotal` float DEFAULT NULL,
  `prixEmplacementFestival` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hebergement`
--

CREATE TABLE `hebergement` (
  `idLogement` int(11) NOT NULL,
  `idEditeur` int(11) NOT NULL,
  `nbNuitHebergement` int(11) DEFAULT NULL,
  `nbPersonneHebergement` int(11) DEFAULT NULL,
  `nomResponsable` varchar(50) DEFAULT NULL,
  `prenomResponsable` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `idJeu` int(11) NOT NULL,
  `libelleJeu` varchar(50) DEFAULT NULL,
  `nbMinJoueurJeu` int(11) DEFAULT NULL,
  `nbMaxJoueurJeu` int(11) DEFAULT NULL,
  `noticeJeu` varchar(10000) DEFAULT NULL,
  `idEditeur` int(11) DEFAULT NULL,
  `idTypeJeu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `idLogement` int(11) NOT NULL,
  `prixNuitLogement` float DEFAULT NULL,
  `nbMaxPlaceLogement` int(11) DEFAULT NULL,
  `rueLogement` varchar(50) DEFAULT NULL,
  `villeLogement` varchar(50) DEFAULT NULL,
  `cpLogement` varchar(50) DEFAULT NULL,
  `telLogement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `organisateur`
--

CREATE TABLE `organisateur` (
  `idOrganisateur` int(50) NOT NULL,
  `loginOrganisateur` varchar(100) NOT NULL,
  `motDePasseOrganisateur` varchar(100) NOT NULL,
  `admin` int(11) DEFAULT NULL,
  `nomOrganisateur` varchar(100) DEFAULT NULL,
  `prenomOrganisateur` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `organisateur`
--

INSERT INTO `organisateur` (`idOrganisateur`, `loginOrganisateur`, `motDePasseOrganisateur`, `admin`, `nomOrganisateur`, `prenomOrganisateur`) VALUES
(2, 'piscine', '64f847250ae222f2fd892bc6810b294f', 1, 'piscine', 'piscine'),
(4, 'visiteur', 'dcaa6e60155776107c638af755498759', 0, 'visiteur', 'visiteur');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idReservation` int(11) NOT NULL,
  `prixNegociationReservation` float NOT NULL,
  `idFestival` int(11) NOT NULL,
  `idEditeur` int(11) NOT NULL,
  `nbEmplacement` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

CREATE TABLE `reserver` (
  `idJeu` int(11) NOT NULL,
  `idReservation` int(11) NOT NULL,
  `quantiteJeuReserver` int(11) NOT NULL,
  `dotationJeuReserver` int(11) NOT NULL,
  `receptionJeuReserver` int(11) NOT NULL,
  `renvoiJeuReserver` int(11) NOT NULL,
  `idZone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `suivi`
--

CREATE TABLE `suivi` (
  `commentaireSuivi` varchar(500) NOT NULL,
  `premierContact` date DEFAULT NULL,
  `secondContact` date DEFAULT NULL,
  `presenceEditeur` int(11) DEFAULT NULL,
  `idFestival` int(11) NOT NULL,
  `idEditeur` int(11) NOT NULL,
  `logementSuivi` int(11) DEFAULT NULL,
  `reponseEditeur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `typeJeu`
--

CREATE TABLE `typeJeu` (
  `idTypeJeu` int(11) NOT NULL,
  `libelleTypeJeu` varchar(50) NOT NULL,
  `idZone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `zone`
--

CREATE TABLE `zone` (
  `idZone` int(11) NOT NULL,
  `nomZone` varchar(100) NOT NULL,
  `idFestival` int(11) NOT NULL
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
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`idFacture`);

--
-- Index pour la table `festival`
--
ALTER TABLE `festival`
  ADD PRIMARY KEY (`idFestival`);

--
-- Index pour la table `hebergement`
--
ALTER TABLE `hebergement`
  ADD PRIMARY KEY (`idLogement`,`idEditeur`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`idJeu`);

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`idLogement`);

--
-- Index pour la table `organisateur`
--
ALTER TABLE `organisateur`
  ADD PRIMARY KEY (`idOrganisateur`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idReservation`);

--
-- Index pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD PRIMARY KEY (`idJeu`,`idReservation`);

--
-- Index pour la table `suivi`
--
ALTER TABLE `suivi`
  ADD PRIMARY KEY (`idFestival`,`idEditeur`);

--
-- Index pour la table `typeJeu`
--
ALTER TABLE `typeJeu`
  ADD PRIMARY KEY (`idTypeJeu`);

--
-- Index pour la table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`idZone`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `idContact` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
  MODIFY `idEditeur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `idFacture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `festival`
--
ALTER TABLE `festival`
  MODIFY `idFestival` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `idJeu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `idLogement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `organisateur`
--
ALTER TABLE `organisateur`
  MODIFY `idOrganisateur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idReservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `typeJeu`
--
ALTER TABLE `typeJeu`
  MODIFY `idTypeJeu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `zone`
--
ALTER TABLE `zone`
  MODIFY `idZone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
