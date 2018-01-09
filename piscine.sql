-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 09 Janvier 2018 à 19:55
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

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`idContact`, `estPrincipalContact`, `nomContact`, `prenomContact`, `mailContact`, `telephoneContact`, `rueContact`, `villeContact`, `cpContact`, `idEditeur`) VALUES
(4, 0, 'Bambelle', 'Larry', 'larry.bambelle@gmail.com', '0600000000', '6 rue de la loose', 'St Etienne', '25100', 1),
(5, 1, 'Kan', 'Jerry', 'jerry.kan@hotmail.fr', '0606060606', '32 impasse de la fin', 'St Etienne', '25000', 1),
(6, 0, 'Tabac', 'Bart', 'bartaba@yahoo.fr', '0707070707', '23 rue de la ruée', 'St Etienne', '25150', 1),
(7, 0, 'Kollyck', 'Al', 'alkollyck@drunk.com', '0405256574', '25 rue du Vomitactik', 'Bordeaux', '26250', 2),
(8, 1, 'Ouzy', 'Jacques', 'jacuzzi@jazz.fr', '0467253537', '45 impasse de la plage', 'Sigean', '85420', 3),
(9, 0, 'lacour', 'Martial', 'lacourmartiale@gmail.com', '0468587456', '12 rue de la prison', 'Lille', '98600', 3),
(10, 1, 'Roïd', 'Paula', 'polaroid@photo.com', '0458236745', '26 rue de l\'ambiance', 'St jean de Cuculles', '26800', 5),
(11, 0, 'Masse', 'Sarah', 'çaramasse@gmail.com', '075823687', '32 rue de la liberté', 'Montpellier', '34000', 5),
(12, 1, 'Golo', 'Thierry', 'tirigolo@gmail.com', '0478295842', '26 rue de la pluie', 'Quimper', '8500', 1),
(13, 1, 'Ochon', 'Paul', 'polochon@hotmail.fr', '0685741258', '2 rue de la nuit', 'Grabels', '34700', 4),
(14, 1, 'Enperte', 'Mélusine', 'metlusineenperte@gmail.com', '0458696985', '20 impasse de l\'industrie', 'Perpignan', '42000', 6);

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE `editeur` (
  `idEditeur` int(50) NOT NULL,
  `libelleEditeur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `editeur`
--

INSERT INTO `editeur` (`idEditeur`, `libelleEditeur`) VALUES
(1, 'Ankama'),
(2, 'Paille éditions'),
(3, 'Asmodee'),
(4, 'Blackrock Games'),
(5, 'Funforge'),
(6, 'Iello'),
(7, 'Origames'),
(8, 'Ludonaute'),
(9, 'La Boite de Jeu');

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

--
-- Contenu de la table `facture`
--

INSERT INTO `facture` (`idFacture`, `dateEmissionFacture`, `datePaiementFacture`, `idReservation`) VALUES
(1, '2018-01-05', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `festival`
--

CREATE TABLE `festival` (
  `idFestival` int(50) NOT NULL,
  `anneeFestival` int(11) DEFAULT NULL,
  `nbEmplacementTotal` int(11) DEFAULT NULL,
  `prixEmplacementFestival` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `festival`
--

INSERT INTO `festival` (`idFestival`, `anneeFestival`, `nbEmplacementTotal`, `prixEmplacementFestival`) VALUES
(8, 2018, 250, 25);

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

--
-- Contenu de la table `jeu`
--

INSERT INTO `jeu` (`idJeu`, `libelleJeu`, `nbMinJoueurJeu`, `nbMaxJoueurJeu`, `noticeJeu`, `idEditeur`, `idTypeJeu`) VALUES
(1, 'Dofus', 1, 5, 'adaszae', 1, 0),
(2, 'jeu', 4, 10, 'non', 4, 0),
(3, 'jeu2', 1, 2, '', 4, 0),
(4, 'jgjh', 0, 0, '', 5, 0),
(5, 'lol', 0, 0, '', 1, 0);

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
  `nomOrganisateur` varchar(100) DEFAULT NULL,
  `prenomOrganisateur` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `organisateur`
--

INSERT INTO `organisateur` (`idOrganisateur`, `loginOrganisateur`, `motDePasseOrganisateur`, `nomOrganisateur`, `prenomOrganisateur`) VALUES
(2, 'piscine', '64f847250ae222f2fd892bc6810b294f', 'nomRandom', 'piscine');

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

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`idReservation`, `prixNegociationReservation`, `idFestival`, `idEditeur`, `nbEmplacement`) VALUES
(1, 100, 8, 1, NULL),
(2, 0, 8, 4, NULL),
(3, 0, 8, 5, NULL);

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

--
-- Contenu de la table `reserver`
--

INSERT INTO `reserver` (`idJeu`, `idReservation`, `quantiteJeuReserver`, `dotationJeuReserver`, `receptionJeuReserver`, `renvoiJeuReserver`, `idZone`) VALUES
(1, 1, 2, 0, 1, 0, NULL),
(3, 2, 1, 1, 0, 0, NULL),
(4, 3, 1, 1, 0, 0, NULL),
(5, 1, 1, 1, 0, 0, NULL);

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

--
-- Contenu de la table `suivi`
--

INSERT INTO `suivi` (`commentaireSuivi`, `premierContact`, `secondContact`, `presenceEditeur`, `idFestival`, `idEditeur`, `logementSuivi`, `reponseEditeur`) VALUES
('<h2>lol</h2>', '2018-01-04', '2018-01-09', 1, 8, 1, 0, NULL),
('', NULL, NULL, 0, 8, 2, 0, NULL),
('', NULL, NULL, 0, 8, 3, 0, NULL),
('', NULL, NULL, 0, 8, 4, 0, NULL),
('', NULL, NULL, 0, 8, 5, 0, NULL),
('', NULL, NULL, 0, 8, 6, 0, NULL),
('', NULL, NULL, 0, 8, 7, 0, NULL),
('', NULL, NULL, 0, 8, 8, 0, NULL),
('', NULL, NULL, 0, 8, 9, 0, NULL),
('', NULL, NULL, 0, 8, 10, 0, NULL);

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
  MODIFY `idContact` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
  MODIFY `idEditeur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `idFacture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `festival`
--
ALTER TABLE `festival`
  MODIFY `idFestival` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `idJeu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `idLogement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `organisateur`
--
ALTER TABLE `organisateur`
  MODIFY `idOrganisateur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idReservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
