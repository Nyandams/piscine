-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 30 Décembre 2017 à 22:14
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
  `telephoneContact` int(50) NOT NULL,
  `rueContact` varchar(50) NOT NULL,
  `villeContact` varchar(50) NOT NULL,
  `cpContact` varchar(50) NOT NULL,
  `idEditeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`idContact`, `estPrincipalContact`, `nomContact`, `prenomContact`, `mailContact`, `telephoneContact`, `rueContact`, `villeContact`, `cpContact`, `idEditeur`) VALUES
(1, 1, 'Zizou', 'Deuhb', 'deuhb.zizou@mali.faim', 0, 'nulle part', 'brazaville', '', 1),
(2, 0, 'ioho', 'jiioj', 'iiohi', 0, 'jiojioji', 'jjiojiojio', 'jjioj', 1);

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE `editeur` (
  `idEditeur` int(50) NOT NULL,
  `libelleEditeur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `editeur`
--

INSERT INTO `editeur` (`idEditeur`, `libelleEditeur`) VALUES
(2, 'editeur2');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `idFacture` int(11) NOT NULL,
  `dateEmissionFacture` date NOT NULL,
  `datePaiementFacture` date NOT NULL,
  `idReservation` int(11) NOT NULL
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
-- Structure de la table `hebergement`
--

CREATE TABLE `hebergement` (
  `idLogement` int(11) NOT NULL,
  `idEditeur` int(11) NOT NULL,
  `nbNuitHebergement` int(11) NOT NULL,
  `nbPersonneHebergement` int(11) NOT NULL,
  `nomResponsable` varchar(50) NOT NULL,
  `prenomResponsable` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `idJeu` int(11) NOT NULL,
  `libelleJeu` varchar(50) NOT NULL,
  `nbMinJoueurJeu` int(11) NOT NULL,
  `nbMaxJoueurJeu` int(11) NOT NULL,
  `noticeJeu` varchar(10000) NOT NULL,
  `idEditeur` int(11) NOT NULL,
  `idTypeJeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `localiser`
--

CREATE TABLE `localiser` (
  `idZone` int(11) NOT NULL,
  `idReservation` int(11) NOT NULL,
  `nbEmplacement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `idLogement` int(11) NOT NULL,
  `prixNuitLogement` float NOT NULL,
  `nbMaxPlaceLogement` int(11) NOT NULL,
  `rueLogement` varchar(50) NOT NULL,
  `villeLogement` varchar(50) NOT NULL,
  `cpLogement` varchar(50) NOT NULL,
  `telLogement` int(11) NOT NULL
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
(2, 'piscine', '64f847250ae222f2fd892bc6810b294f', 'nomRandom', 'piscine'),
(5, 'aaa', '47bce5c74f589f4867dbd57e9ca9f808', 'aaa', 'aaa');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idReservation` int(11) NOT NULL,
  `prixNegociationReservation` float NOT NULL,
  `idFestival` int(11) NOT NULL,
  `idEditeur` int(11) NOT NULL
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
  `renvoiJeuReserver` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `suivi`
--

CREATE TABLE `suivi` (
  `idSuivi` int(11) NOT NULL,
  `commentaireSuivi` varchar(500) NOT NULL,
  `premierContact` date NOT NULL,
  `secondContact` date NOT NULL,
  `presenceEditeur` int(11) NOT NULL,
  `idFestival` int(11) NOT NULL
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
  `idEditeur` int(11) NOT NULL
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
-- Index pour la table `localiser`
--
ALTER TABLE `localiser`
  ADD PRIMARY KEY (`idZone`,`idReservation`);

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
  ADD PRIMARY KEY (`idSuivi`);

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
  MODIFY `idContact` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
  MODIFY `idEditeur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `idFacture` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `festival`
--
ALTER TABLE `festival`
  MODIFY `idFestival` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `idJeu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `idLogement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `organisateur`
--
ALTER TABLE `organisateur`
  MODIFY `idOrganisateur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idReservation` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `suivi`
--
ALTER TABLE `suivi`
  MODIFY `idSuivi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `typeJeu`
--
ALTER TABLE `typeJeu`
  MODIFY `idTypeJeu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `zone`
--
ALTER TABLE `zone`
  MODIFY `idZone` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
