-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 02 Novembre 2011 à 17:11
-- Version du serveur: 5.1.49
-- Version de PHP: 5.3.3-1ubuntu9.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `GestionStage`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `idcontact` int(11) NOT NULL AUTO_INCREMENT,
  `identreprise` int(11) NOT NULL,
  `prenomcontact` varchar(50) DEFAULT NULL,
  `nomcontact` varchar(50) DEFAULT NULL,
  `fonctioncontact` varchar(50) DEFAULT NULL,
  `dateajout` date DEFAULT NULL,
  `datederniereactivite` date DEFAULT NULL,
  `telfixecontact` varchar(50) DEFAULT NULL,
  `telmobilecontact` varchar(50) DEFAULT NULL,
  `mailcontact` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idcontact`),
  KEY `fk_entreprise_contact` (`identreprise`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`idcontact`, `identreprise`, `prenomcontact`, `nomcontact`, `fonctioncontact`, `dateajout`, `datederniereactivite`, `telfixecontact`, `telmobilecontact`, `mailcontact`) VALUES
(1, 2, 'Luc', 'Dubois', 'Ingénieur', '2011-10-19', '2011-10-19', '07 89 76 87 98', '03 45 21 24 56', 'dubois@gmail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE IF NOT EXISTS `entreprise` (
  `identreprise` int(11) NOT NULL AUTO_INCREMENT,
  `nomentreprise` varchar(50) DEFAULT NULL,
  `adresseentreprise` varchar(200) DEFAULT NULL,
  `villeentreprise` varchar(50) DEFAULT NULL,
  `codepostalentreprise` varchar(50) DEFAULT NULL,
  `paysentreprise` varchar(50) DEFAULT NULL,
  `numerotelephone` varchar(50) DEFAULT NULL,
  `numerosiret` varchar(17) DEFAULT NULL,
  `urlsiteinternet` varchar(50) DEFAULT NULL,
  `statutjuridique` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`identreprise`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`identreprise`, `nomentreprise`, `adresseentreprise`, `villeentreprise`, `codepostalentreprise`, `paysentreprise`, `numerotelephone`, `numerosiret`, `urlsiteinternet`, `statutjuridique`) VALUES
(1, 'sopra france', 'adresse sopra', 'paris', NULL, 'france', '0329391919', '118288383838', 'sopra.fr', NULL),
(2, 'Info Sopra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'sopra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'sassopra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'netlor', '10 rue du jardin', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'netggglor', '10 rue du jardin', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `idpromotion` int(11) NOT NULL,
  `nompromotion` varchar(50) DEFAULT NULL,
  `accesentreprises` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idpromotion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`idpromotion`, `nompromotion`, `accesentreprises`) VALUES
(1, 'L3 2011-2012', 0),
(2, 'M2 SID 2011-2012', 1),
(3, 'M2 ACSI 2011-2012', 1);

-- --------------------------------------------------------

--
-- Structure de la table `proposition`
--

CREATE TABLE IF NOT EXISTS `proposition` (
  `idproposition` int(11) NOT NULL AUTO_INCREMENT,
  `identreprise` int(11) DEFAULT NULL,
  `idutilisateur` int(11) NOT NULL,
  `idstage` int(11) DEFAULT NULL,
  `nomentreprisep` varchar(50) DEFAULT NULL,
  `dateproposition` date DEFAULT NULL,
  `adresseentreprisep` varchar(200) DEFAULT NULL,
  `villeentreprisep` varchar(50) DEFAULT NULL,
  `codepostalentreprisep` varchar(50) DEFAULT NULL,
  `paysentreprisep` varchar(50) DEFAULT NULL,
  `numerotelephonep` varchar(50) DEFAULT NULL,
  `urlsiteinternetp` varchar(50) DEFAULT NULL,
  `sujetstagep` text,
  `etat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idproposition`),
  KEY `fk_propoentreprise` (`identreprise`),
  KEY `fk_propositionstage2` (`idstage`),
  KEY `fk_utilisateur_proposition` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `proposition`
--


-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE IF NOT EXISTS `stage` (
  `idstage` int(11) NOT NULL AUTO_INCREMENT,
  `identreprise` int(11) DEFAULT NULL,
  `idcontact` int(11) DEFAULT NULL,
  `idpromotion` int(11) DEFAULT NULL,
  `idproposition` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `sujetstage` text,
  `datevalidation` date DEFAULT NULL,
  `datedebut` date DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `datesoutenance` date DEFAULT NULL,
  `lieusoutenance` varchar(50) DEFAULT NULL,
  `etatstage` varchar(50) DEFAULT NULL,
  `noteobtenue` smallint(6) DEFAULT NULL,
  `appreciationobtenue` text,
  `remuneration` text,
  `embauche` tinyint(1) DEFAULT NULL,
  `dateembauche` date DEFAULT NULL,
  `respcivil` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idstage`),
  KEY `fk_association_9` (`idpromotion`),
  KEY `fk_propositionstage` (`idproposition`),
  KEY `fk_stage_contact` (`idcontact`),
  KEY `fk_stage_entreprise` (`identreprise`),
  KEY `fk_utilistateur_stage` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `stage`
--


-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `idpromotion` int(11) NOT NULL,
  `mailutilisateur` varchar(50) DEFAULT NULL,
  `passwordutilisateur` varchar(50) DEFAULT NULL,
  `nomutilisateur` varchar(50) DEFAULT NULL,
  `prenomutilisateur` varchar(50) DEFAULT NULL,
  `numetudiant` varchar(50) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idutilisateur`),
  KEY `fk_utilisateurpromotion` (`idpromotion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `idpromotion`, `mailutilisateur`, `passwordutilisateur`, `nomutilisateur`, `prenomutilisateur`, `numetudiant`, `admin`) VALUES
(1, 2, 'ludo@gmail.com', 'ae5a3c4fa3c5d1c2cc98e43b1899f88bce0e3569', 'fort', 'ludovic', '1234567', 0),
(3, 1, 'laurent@gmail.com', 'f1b010126f61b5c59e7d5eb42c5c68f6105c5914', 'Dubois', 'Laurent', '283983', 0),
(10, 2, 'khalid.benali@loria.fr', '94ca247fff5ad413788a1c8d8c80394a246dba1c', 'benali', 'khalid', NULL, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_entreprise_contact` FOREIGN KEY (`identreprise`) REFERENCES `entreprise` (`identreprise`);

--
-- Contraintes pour la table `proposition`
--
ALTER TABLE `proposition`
  ADD CONSTRAINT `fk_propoentreprise` FOREIGN KEY (`identreprise`) REFERENCES `entreprise` (`identreprise`),
  ADD CONSTRAINT `fk_propositionstage2` FOREIGN KEY (`idstage`) REFERENCES `stage` (`idstage`),
  ADD CONSTRAINT `fk_utilisateur_proposition` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `fk_association_9` FOREIGN KEY (`idpromotion`) REFERENCES `promotion` (`idpromotion`),
  ADD CONSTRAINT `fk_propositionstage` FOREIGN KEY (`idproposition`) REFERENCES `proposition` (`idproposition`),
  ADD CONSTRAINT `fk_stage_contact` FOREIGN KEY (`idcontact`) REFERENCES `contact` (`idcontact`),
  ADD CONSTRAINT `fk_stage_entreprise` FOREIGN KEY (`identreprise`) REFERENCES `entreprise` (`identreprise`),
  ADD CONSTRAINT `fk_utilistateur_stage` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_utilisateurpromotion` FOREIGN KEY (`idpromotion`) REFERENCES `promotion` (`idpromotion`);