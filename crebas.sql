-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 15 Février 2012 à 10:31
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `contact`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`identreprise`, `nomentreprise`, `adresseentreprise`, `villeentreprise`, `codepostalentreprise`, `paysentreprise`, `numerotelephone`, `numerosiret`, `urlsiteinternet`, `statutjuridique`) VALUES
(18, 'Netlor', '93 route de Metz', 'MAXEVILLE', '54320', 'France', '+33 3 83 67 62 89', NULL, 'netlor.fr', NULL),
(19, 'Intech', '17, 19 avenue de la Liberation', 'Schifflange', 'L-3850', 'Luxembourg', '+352 53 11 53 1', NULL, 'intech.lu', NULL),
(20, 'DevWeb Nancy', '12 avenue de Metz', 'Nancy', '54000', 'France', '0389786514', NULL, 'deveweb.fr', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ficherenseignement`
--

CREATE TABLE IF NOT EXISTS `ficherenseignement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomoriginal` varchar(300) NOT NULL,
  `nomunique` varchar(100) NOT NULL,
  `idproposition` int(11) NOT NULL,
  `idstage` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Contenu de la table `ficherenseignement`
--

INSERT INTO `ficherenseignement` (`id`, `nomoriginal`, `nomunique`, `idproposition`, `idstage`, `type`) VALUES
(69, 'ficheRenseignement.xls', '4bd44bd80806bfa1e02f622073444a8e', 90, 0, 'application/vnd.ms-excel'),
(70, 'ficheRenseignement.xls', 'fef062542c137ffb6fc1ec2e0fe2aa1c', 91, 69, 'application/vnd.ms-excel'),
(68, 'ficheRenseignement.xls', '1b22a7d36391bbdcac242ab3edfc950f', 89, 0, 'application/vnd.ms-excel');

-- --------------------------------------------------------

--
-- Structure de la table `fichesujetstage`
--

CREATE TABLE IF NOT EXISTS `fichesujetstage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomoriginal` varchar(300) NOT NULL,
  `nomunique` varchar(100) NOT NULL,
  `idproposition` int(11) NOT NULL,
  `idstage` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `fichesujetstage`
--


-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `idpromotion` int(11) NOT NULL AUTO_INCREMENT,
  `nompromotion` varchar(50) DEFAULT NULL,
  `accesentreprises` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idpromotion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`idpromotion`, `nompromotion`, `accesentreprises`) VALUES
(1, 'L3 2011-2012', 0),
(2, 'M2 SID 2011-2012', 1),
(3, 'M2 ACSI 2011-2012', 1),
(7, 'L3 2012-2013', 1),
(8, 'L3 2009-2010', 1);

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
  `titrestagep` varchar(200) NOT NULL,
  `technostagep` varchar(200) NOT NULL,
  `raisonrefus` text NOT NULL,
  `etat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idproposition`),
  KEY `fk_propoentreprise` (`identreprise`),
  KEY `fk_propositionstage2` (`idstage`),
  KEY `fk_utilisateur_proposition` (`idutilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Contenu de la table `proposition`
--

INSERT INTO `proposition` (`idproposition`, `identreprise`, `idutilisateur`, `idstage`, `nomentreprisep`, `dateproposition`, `adresseentreprisep`, `villeentreprisep`, `codepostalentreprisep`, `paysentreprisep`, `numerotelephonep`, `urlsiteinternetp`, `sujetstagep`, `titrestagep`, `technostagep`, `raisonrefus`, `etat`) VALUES
(89, 18, 25, NULL, NULL, '2012-02-15', NULL, NULL, NULL, NULL, NULL, NULL, 'DÃ©veloppement d''une plateforme de communication entre un serveur php et une application Java', 'DÃ©veloppement d''une plateforme de communication', '', '', 'en attente'),
(90, 19, 28, NULL, NULL, '2012-02-15', NULL, NULL, NULL, NULL, NULL, NULL, 'DÃ©veloppement mobile Iphone avec communication avec un serveur Java', 'DÃ©veloppement mobile Iphone', 'Objective C', '', 'en attente'),
(91, 20, 29, NULL, NULL, '2012-02-15', NULL, NULL, NULL, NULL, NULL, NULL, 'DÃ©veloppement d''un site de e-commerce', 'DÃ©veloppement Web', '', '', 'validee');

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
  `titrestage` varchar(200) NOT NULL,
  `technostage` varchar(200) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Contenu de la table `stage`
--

INSERT INTO `stage` (`idstage`, `identreprise`, `idcontact`, `idpromotion`, `idproposition`, `idutilisateur`, `sujetstage`, `titrestage`, `technostage`, `datevalidation`, `datedebut`, `datefin`, `datesoutenance`, `lieusoutenance`, `etatstage`, `noteobtenue`, `appreciationobtenue`, `remuneration`, `embauche`, `dateembauche`, `respcivil`) VALUES
(69, 20, NULL, 1, 91, 29, 'DÃ©veloppement d''un site de e-commerce', 'DÃ©veloppement Web', '', '2012-02-15', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `techno`
--

CREATE TABLE IF NOT EXISTS `techno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `techno`
--

INSERT INTO `techno` (`id`, `nom`) VALUES
(1, 'BDD'),
(2, 'Java'),
(3, 'JEE'),
(4, 'C / C ++'),
(5, 'PHP'),
(6, 'Javascript'),
(7, 'BI'),
(8, 'Audit'),
(9, 'Cobol');

-- --------------------------------------------------------

--
-- Structure de la table `technoproposition`
--

CREATE TABLE IF NOT EXISTS `technoproposition` (
  `idproposition` int(11) NOT NULL,
  `idtechno` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `technoproposition`
--

INSERT INTO `technoproposition` (`idproposition`, `idtechno`) VALUES
(91, 6),
(91, 5),
(91, 1),
(90, 2),
(90, 1),
(89, 5),
(89, 2),
(89, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `idpromotion` int(11) NOT NULL,
  `mailutilisateur` varchar(50) DEFAULT NULL,
  `passwordutilisateur` varchar(50) DEFAULT NULL,
  `passwordutilisateurtmp` varchar(50) NOT NULL,
  `nomutilisateur` varchar(50) DEFAULT NULL,
  `prenomutilisateur` varchar(50) DEFAULT NULL,
  `numetudiant` varchar(50) DEFAULT NULL,
  `idConfirmationMail` varchar(100) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idutilisateur`),
  KEY `fk_utilisateurpromotion` (`idpromotion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `idpromotion`, `mailutilisateur`, `passwordutilisateur`, `passwordutilisateurtmp`, `nomutilisateur`, `prenomutilisateur`, `numetudiant`, `idConfirmationMail`, `admin`) VALUES
(10, 2, 'khalid.benali@loria.fr', '94ca247fff5ad413788a1c8d8c80394a246dba1c', '', 'benali', 'khalid', NULL, '', 1),
(24, 1, 'jean@loria.com', '51f8b1fa9b424745378826727452997ee2a7c3d7', '', 'Malhomme', 'Jean', NULL, '', 1),
(25, 2, 'fort0192@etudiant.univ-nancy2.fr', 'ae5a3c4fa3c5d1c2cc98e43b1899f88bce0e3569', '90283840d90de49b8e7984bd99b47fee0d4bd50d', 'Fort', 'Ludovic', '34', '06feaf4cf3b15bd63d2fefd1b59b3f61', 0),
(28, 2, 'anthony.avola@etudiant.univ-nancy2.fr', '6e1a438cfe5a6c9e2165665f8c2258849ccc43f0', '6e1a438cfe5a6c9e2165665f8c2258849ccc43f0', 'Avola', 'Anthony', '123', '3dab734b2be6b05fbe8183002ddfd431', 0),
(29, 1, 'Jean.Dupond@etudiant.univ-nancy2.fr', '51f8b1fa9b424745378826727452997ee2a7c3d7', '', 'Dupond', 'Jean', '18881716', '0', NULL);

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