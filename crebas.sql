-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 11 Janvier 2012 à 17:04
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`idcontact`, `identreprise`, `prenomcontact`, `nomcontact`, `fonctioncontact`, `dateajout`, `datederniereactivite`, `telfixecontact`, `telmobilecontact`, `mailcontact`) VALUES
(1, 2, 'Luc', 'Dubois', 'Ingénieur', '2011-10-19', '2011-10-19', '07 89 76 87 98', '03 45 21 24 56', 'dubois@gmail.fr'),
(2, 1, 'Robert', 'Graviaud', 'Chef de projet', '2011-11-24', '2011-12-14', '0383828181', '0676554433', 'robert.g@toto.fr'),
(3, 1, 'Bertrand', 'Fort', '', '2011-11-16', '2011-11-16', '', '', 'f.b@toto'),
(5, 2, 'essai', NULL, NULL, '2011-11-24', NULL, NULL, NULL, NULL),
(6, 2, 'essai2', NULL, NULL, '2011-11-24', NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`identreprise`, `nomentreprise`, `adresseentreprise`, `villeentreprise`, `codepostalentreprise`, `paysentreprise`, `numerotelephone`, `numerosiret`, `urlsiteinternet`, `statutjuridique`) VALUES
(1, 'sopra france', '22 rue Montaigne', 'paris', '75000', 'france', '0329391919', '118288383838', 'http://www.sopra.fr', 'SAS'),
(2, 'Info Sopra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'sopra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'sassopra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'netlor', '10 rue du jardin', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'netggglor', '10 rue du jardin', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'carrefour', '10 avenue de libe', 'Lyon', '287637', 'france', '86866', NULL, '', NULL),
(8, 'carrefour2', '10 avenue de libe', 'Lyon', '287637', 'france', '86866', NULL, '', NULL),
(9, 'sfeir', 'parc d''activitÃ©', 'Capellen', '123', 'Luxembourg', '86866', NULL, 'sfeir.com', NULL),
(10, 'carrefourafaef', 'libÃƒÂ©ration', 'Lyon', '287637', 'france', '86866', NULL, '', NULL),
(11, 'carrefourÃ©2222', 'lib&Atilde;&copy;ration', 'Lyon', '287637', 'france', '86866', NULL, '', NULL),
(12, 'carrefour33333', 'lib&Atilde;&copy;ration', 'Lyon', '287637', 'france', '86866', NULL, '', NULL),
(13, 'carrefour44', 'libÃ©ration', 'Lyon', '287637', 'france', '86866', NULL, '', NULL),
(14, 'carrefouretjetj', '10 avenue de libe', 'Lyon', '287637', 'france', '86866', NULL, '', NULL),
(15, 'carrefourhhhhhhhhhhhhh', '10 avenue de libÃ©ration', 'Lyon', '287637', 'france', '86866', NULL, '', NULL),
(16, 'carrefourgggggggggggggggggg', '10 avenue de libe', 'Lyon', '287637', 'france', '86866', NULL, '', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `ficherenseignement`
--

INSERT INTO `ficherenseignement` (`id`, `nomoriginal`, `nomunique`, `idproposition`, `idstage`, `type`) VALUES
(1, '/tmp/php47X1KK', '2847da20f8e2eea03f10e97af8aa6195', 0, 0, ''),
(2, 'wallpaper749120.png', 'ac72b3fcfe8e08bea865853217733cdd', 0, 0, ''),
(3, 'sid-tp2.war', '31f09fe86af52c386153fd42b17ad593', 0, 0, ''),
(4, 'favoris_19_12_11.html', 'c5a540144494e78f8cb7c0b4cb72562a', 34, 0, ''),
(5, 'toto', '97976e2fff84127d84d84fff6ff38ee6', 35, 0, ''),
(6, 'sfeir.pdf', '14e3a5074e322b29c0f673c818a592c7', 36, 0, ''),
(7, 'SujetComplet.pdf', '1eaec75b957e9edc713773f8f9b48d1e', 37, 0, 'application/pdf'),
(8, 'sfeir.pdf', '533de697497ea5e147031ac38a288921', 38, 0, 'application/pdf'),
(9, 'sfeir.pdf', 'a37bfa0d2591780565b00ab68761cdce', 39, 0, 'application/pdf');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `idpromotion` int(11) NOT NULL AUTO_INCREMENT,
  `nompromotion` varchar(50) DEFAULT NULL,
  `accesentreprises` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idpromotion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
  `titrestagep` varchar(200) NOT NULL,
  `technostagep` varchar(200) NOT NULL,
  `raisonrefus` text NOT NULL,
  `etat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idproposition`),
  KEY `fk_propoentreprise` (`identreprise`),
  KEY `fk_propositionstage2` (`idstage`),
  KEY `fk_utilisateur_proposition` (`idutilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `proposition`
--

INSERT INTO `proposition` (`idproposition`, `identreprise`, `idutilisateur`, `idstage`, `nomentreprisep`, `dateproposition`, `adresseentreprisep`, `villeentreprisep`, `codepostalentreprisep`, `paysentreprisep`, `numerotelephonep`, `urlsiteinternetp`, `sujetstagep`, `titrestagep`, `technostagep`, `raisonrefus`, `etat`) VALUES
(16, 9, 1, NULL, NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, NULL, 'essai valide 2', 'a', 'a', '', 'validee'),
(17, 1, 3, NULL, NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, NULL, 'essai laurent', 'a', 'ga', '', 'validee'),
(18, 9, 3, NULL, NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, NULL, 'vrai sujet', '11111', '22222', '', 'validee'),
(19, 14, 1, NULL, NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, NULL, 'etjte', 'jetj', 'j', '', 'validee'),
(28, 5, 3, NULL, NULL, '2012-01-11', NULL, NULL, NULL, NULL, NULL, NULL, 'php', 'php', 'php', '', 'en attente'),
(39, 9, 1, NULL, NULL, '2012-01-11', NULL, NULL, NULL, NULL, NULL, NULL, 'spring !', 'vrai stage spring', 'bah spring', '', 'en attente');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `stage`
--

INSERT INTO `stage` (`idstage`, `identreprise`, `idcontact`, `idpromotion`, `idproposition`, `idutilisateur`, `sujetstage`, `titrestage`, `technostage`, `datevalidation`, `datedebut`, `datefin`, `datesoutenance`, `lieusoutenance`, `etatstage`, `noteobtenue`, `appreciationobtenue`, `remuneration`, `embauche`, `dateembauche`, `respcivil`) VALUES
(17, 9, NULL, 2, 16, 1, 'essai valide 2', 'a', 'a', '2011-12-14', NULL, NULL, NULL, NULL, 'a valider', NULL, NULL, NULL, NULL, NULL, 0),
(18, 1, 2, 1, 17, 3, 'essai laurent', 'a', 'ga', '2011-12-14', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(19, 14, NULL, 2, 19, 1, 'etjte', 'jetj', 'j', '2012-01-11', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(20, 14, NULL, 2, 19, 1, 'etjte', 'jetj', 'j', '2012-01-11', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(21, 9, NULL, 1, 18, 3, 'vrai sujet', '11111', '22222', '2012-01-11', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `idpromotion`, `mailutilisateur`, `passwordutilisateur`, `nomutilisateur`, `prenomutilisateur`, `numetudiant`, `admin`) VALUES
(1, 2, 'ludo@gmail.com', 'ae5a3c4fa3c5d1c2cc98e43b1899f88bce0e3569', 'fort', 'ludovic', '1234567', 0),
(3, 1, 'laurent@gmail.com', 'f1b010126f61b5c59e7d5eb42c5c68f6105c5914', 'Dubois', 'Laurent', '283983', 0),
(4, 3, 'anthony.avola@gmail.com', '7a79f9450d349278985d7ff04b2bd7d48ddcf42a', 'AVOLA', 'Anthony', '27004612', 0),
(10, 2, 'khalid.benali@loria.fr', '94ca247fff5ad413788a1c8d8c80394a246dba1c', 'benali', 'khalid', NULL, 1),
(11, 1, 'jean.malhomme@loria.fr', '51f8b1fa9b424745378826727452997ee2a7c3d7', 'Malhomme', 'Jean', NULL, 1);

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