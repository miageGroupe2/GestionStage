-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 08 Février 2012 à 10:46
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

INSERT INTO `contact` (`idcontact`, `identreprise`, `prenomcontact`, `nomcontact`, `fonctioncontact`, `dateajout`, `datederniereactivite`, `telfixecontact`, `telmobilecontact`, `mailcontact`) VALUES
(10, 18, 'Pascal', 'Dupond', 'Architecte', '2012-02-08', '2012-02-08', '101019192', '101010101', 'dupond@pascal.fr'),
(11, 18, 'Fred', 'Durand', 'chef de projet', '2012-02-08', '2012-02-08', '1983938', '181829', 'durand@fred.fr');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`identreprise`, `nomentreprise`, `adresseentreprise`, `villeentreprise`, `codepostalentreprise`, `paysentreprise`, `numerotelephone`, `numerosiret`, `urlsiteinternet`, `statutjuridique`) VALUES
(18, 'Netlor', '3 rue de Metz', 'Nancy', '54000', 'France', '0192837437', NULL, 'netlor.fr', NULL),
(19, 'Intech', '234 rue avec un nom plutÃ´t long voir trÃ¨s long', 'Schifflange', '289383', 'Luxembourg', '92839484938', NULL, 'intech.lu', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Contenu de la table `ficherenseignement`
--

INSERT INTO `ficherenseignement` (`id`, `nomoriginal`, `nomunique`, `idproposition`, `idstage`, `type`) VALUES
(56, 'TP3.pdf', 'e74d39ad9af34902a3b5212b9b72948a', 77, 58, 'application/pdf'),
(57, 'TP2 (1).pdf.crdownload', 'c85d93c78571046c995673812d315576', 78, 0, 'application/octet-stream'),
(58, 'TP3 (1).pdf.crdownload', '5dfdbad98b4dc2e4685e47a4c2270c82', 79, 0, 'application/octet-stream'),
(59, 'installation_joomla (1).pdf', '4cdeddd1fd7b7ff917ed1341f8e1aa2c', 80, 0, 'application/pdf'),
(60, 'TP2 (3).pdf', '5d5a555a7e580e0759b7ec61ea8614fa', 81, 59, 'application/pdf');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `fichesujetstage`
--

INSERT INTO `fichesujetstage` (`id`, `nomoriginal`, `nomunique`, `idproposition`, `idstage`, `type`) VALUES
(25, 'TP2.pdf', '1d9b21b72c4b64cfbafe7b517e8e24a2', 77, 58, 'application/pdf');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `idpromotion` int(11) NOT NULL AUTO_INCREMENT,
  `nompromotion` varchar(50) DEFAULT NULL,
  `accesentreprises` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idpromotion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Contenu de la table `proposition`
--

INSERT INTO `proposition` (`idproposition`, `identreprise`, `idutilisateur`, `idstage`, `nomentreprisep`, `dateproposition`, `adresseentreprisep`, `villeentreprisep`, `codepostalentreprisep`, `paysentreprisep`, `numerotelephonep`, `urlsiteinternetp`, `sujetstagep`, `titrestagep`, `technostagep`, `raisonrefus`, `etat`) VALUES
(77, 18, 25, NULL, NULL, '2012-02-08', NULL, NULL, NULL, NULL, NULL, NULL, 'Ubuntu 12.04 â€“ DÃ©monstration dâ€™Unity 5.2 multi-Ã©cran\r\n*La derniÃ¨re version d''Unity mis Ã  disposition des testeurs de la prochaine version d''Ubuntu, la 12.04 LTS precise pangolin, ajoute le support de la gestion de plusieurs Ã©crans. Voici donc une vidÃ©o prÃ©sentant les avancÃ©es d''Unity dans ce domaine.* .Ubuntu 12.04 â€“ DÃ©monstration dâ€™Unity 5.2 multi-Ã©cran\r\n*La derniÃ¨re version d''Unity mis Ã  disposition des testeurs de la prochaine version d''Ubuntu, la 12.04 LTS precise pangolin, ajoute le support de la gestion de plusieurs Ã©crans. Voici donc une vidÃ©o prÃ©sentant les avancÃ©es d''Unity dans ce domaine.', 'Modification d''une plateforme de communication.', 'jQuery, XML.', '', 'validee'),
(80, 19, 28, NULL, NULL, '2012-02-08', NULL, NULL, NULL, NULL, NULL, NULL, ' l''objectif des Ã©diteurs de sites d''observation et d''analyse de l''activitÃ© parlementaire est d''offrir au grand public et aux mÃ©dias un accÃ¨s simplifiÃ© au fonctionnement des institutions dÃ©mocratiques. Sur la base des donnÃ©es personnelles diffusÃ©es par l''AssemblÃ©e nationale et le SÃ©nat sur leur site officiel, ils Ã©tablissent des statistiques individuelles permettant de livrer une prÃ©sentation synthÃ©tique et chiffrÃ©e de la maniÃ¨re dont les Ã©lus exercent leur mandat public. Â» ', 'DÃ©veloppement Iphone', 'Iphone', 'J''aime pas Intech', 'refusÃ©e'),
(81, 19, 28, NULL, NULL, '2012-02-08', NULL, NULL, NULL, NULL, NULL, NULL, '\r\nLa sociÃ©tÃ© productrice de cÃ¢bles vient de publier ses rÃ©sultats pour le compte de l''annÃ©e 2011. MalgrÃ© un chiffre d''affaires en hausse, Nexans fait Ã©tat d''une perte nette due Ã  la mise sous sÃ©questre\r\n\r\nLa sociÃ©tÃ© productrice de cÃ¢bles vient de publier ses rÃ©sultats pour le compte de l''annÃ©e 2011. MalgrÃ© un chiffre d''affaires en hausse, Nexans fait Ã©tat d''une perte nette due Ã  la mise sous sÃ©questre\r\n', 'Android', 'android', '', 'validee');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Contenu de la table `stage`
--

INSERT INTO `stage` (`idstage`, `identreprise`, `idcontact`, `idpromotion`, `idproposition`, `idutilisateur`, `sujetstage`, `titrestage`, `technostage`, `datevalidation`, `datedebut`, `datefin`, `datesoutenance`, `lieusoutenance`, `etatstage`, `noteobtenue`, `appreciationobtenue`, `remuneration`, `embauche`, `dateembauche`, `respcivil`) VALUES
(58, 18, 11, 2, 77, 25, 'Ubuntu 12.04 â€“ DÃ©monstration dâ€™Unity 5.2 multi-Ã©cran\r\n*La derniÃ¨re version d''Unity mis Ã  disposition des testeurs de la prochaine version d''Ubuntu, la 12.04 LTS precise pangolin, ajoute le support de la gestion de plusieurs Ã©crans. Voici donc une vidÃ©o prÃ©sentant les avancÃ©es d''Unity dans ce domaine.* .Ubuntu 12.04 â€“ DÃ©monstration dâ€™Unity 5.2 multi-Ã©cran\r\n*La derniÃ¨re version d''Unity mis Ã  disposition des testeurs de la prochaine version d''Ubuntu, la 12.04 LTS precise pangolin, ajoute le support de la gestion de plusieurs Ã©crans. Voici donc une vidÃ©o prÃ©sentant les avancÃ©es d''Unity dans ce domaine.', 'Modification d''une plateforme de communication.', 'jQuery, XML.', '2012-02-08', '2012-02-02', '2012-03-02', '2012-04-01', 'salle4', 'en cours', 4, 'NULL', '1500', NULL, '2012-02-25', NULL),
(59, 19, NULL, 3, 81, 28, '\r\nLa sociÃ©tÃ© productrice de cÃ¢bles vient de publier ses rÃ©sultats pour le compte de l''annÃ©e 2011. MalgrÃ© un chiffre d''affaires en hausse, Nexans fait Ã©tat d''une perte nette due Ã  la mise sous sÃ©questre\r\n\r\nLa sociÃ©tÃ© productrice de cÃ¢bles vient de publier ses rÃ©sultats pour le compte de l''annÃ©e 2011. MalgrÃ© un chiffre d''affaires en hausse, Nexans fait Ã©tat d''une perte nette due Ã  la mise sous sÃ©questre\r\n', 'Android', 'android', '2012-02-08', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0);

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
(77, 6),
(77, 5),
(77, 1),
(79, 2),
(80, 5),
(80, 7),
(80, 9),
(81, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `idpromotion`, `mailutilisateur`, `passwordutilisateur`, `passwordutilisateurtmp`, `nomutilisateur`, `prenomutilisateur`, `numetudiant`, `idConfirmationMail`, `admin`) VALUES
(10, 2, 'khalid.benali@loria.fr', '94ca247fff5ad413788a1c8d8c80394a246dba1c', '', 'benali', 'khalid', NULL, '', 1),
(24, 3, 'jean@loria.com', '51f8b1fa9b424745378826727452997ee2a7c3d7', '', 'Malhomme', 'Jean', NULL, '', 1),
(25, 2, 'fort0192@etudiant.univ-nancy2.fr', 'ae5a3c4fa3c5d1c2cc98e43b1899f88bce0e3569', 'ae5a3c4fa3c5d1c2cc98e43b1899f88bce0e3569', 'Fort', 'Ludovic', '34', 'd3a45626d560dc75c80a29fc9481bc77', 0),
(28, 3, 'anthony.avola@etudiant.univ-nancy2.fr', '6e1a438cfe5a6c9e2165665f8c2258849ccc43f0', '6e1a438cfe5a6c9e2165665f8c2258849ccc43f0', 'Avola', 'Anthony', '123', '3dab734b2be6b05fbe8183002ddfd431', 0);

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