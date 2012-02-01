-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 01 Février 2012 à 09:23
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`idcontact`, `identreprise`, `prenomcontact`, `nomcontact`, `fonctioncontact`, `dateajout`, `datederniereactivite`, `telfixecontact`, `telmobilecontact`, `mailcontact`) VALUES
(1, 2, 'Luc', 'Dubois', 'Ingénieur', '2011-10-19', '2011-10-19', '07 89 76 87 98', '03 45 21 24 56', 'dubois@gmail.fr'),
(2, 1, 'Robert', 'Graviaud', 'Chef de projet', '2011-11-24', '2011-12-14', '0383828181', '0676554433', 'robert.g@toto.fr'),
(3, 1, 'Bertrand', 'Fort', '', '2011-11-16', '2011-11-16', '', '', 'f.b@toto'),
(5, 2, 'essai', NULL, NULL, '2011-11-24', NULL, NULL, NULL, NULL),
(6, 2, 'essai2', NULL, NULL, '2011-11-24', NULL, NULL, NULL, NULL),
(7, 5, 'Bertrand', 'Fort', '', '2012-01-25', '2012-01-25', '', '', 'gaeg@gg.fr'),
(8, 5, 'uldo', 'Fort', '', '2012-01-25', '2012-01-25', '', '', 'ntehet@.gt'),
(9, 9, 'ggggggggg', 'ggggggt', '', '2012-01-25', '2012-01-25', '', '', 'gzrrz@gz.gt');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `ficherenseignement`
--

INSERT INTO `ficherenseignement` (`id`, `nomoriginal`, `nomunique`, `idproposition`, `idstage`, `type`) VALUES
(41, '1erExemple.FDM', '47512482ea84cd9c4f60bcd1cd6441b6', 0, 0, 'application/octet-stream'),
(40, '1erExemple.FDM', 'd202d8d0a5138e1118f5fb2630235f00', 0, 0, 'application/octet-stream'),
(39, '1erExemple.FDM', '2cf0a5a01bb4a88451ae251ee441b2fd', 0, 0, 'application/octet-stream'),
(38, '1erExemple.FDM', '379908638b6efd211bdea872ee7e72e0', 0, 0, 'application/octet-stream'),
(37, '1erExemple.FDM', 'f241235db382a3fff6cbe01bc098d1a9', 0, 0, 'application/octet-stream'),
(36, '1erExemple.FDM', '98ebc644ae5f3b496d8b1808288e4861', 70, 0, 'application/octet-stream'),
(35, 'ExemplesBL.zip', '0fc1a3b58d28f7141d151fd74827d929', 69, 54, 'application/zip'),
(34, 'dm_sid-x6.pdf', 'fc67315984c699e1e6cd3beab06f9f22', 68, 0, 'application/pdf'),
(33, 'dm_sid-x6.pdf', '120f858bd09c77bc19d7e3898b0aca8e', 0, 0, 'application/pdf'),
(32, 'dm_sid-x6.pdf', 'a90f5385a4ca2a8329652e1a0b9ae0bf', 67, 0, 'application/pdf'),
(31, 'dm_sid-x6.pdf', 'a3fd0b4782082686d98e0a4bbf9c70ee', 0, 0, 'application/pdf'),
(30, 'dm_sid-x6.pdf', '1e989555129284713e684818a8ea48de', 66, 0, 'application/pdf'),
(29, 'dm_sid-x6.pdf', 'a12cffe7fd191446c02bba829156f7d8', 0, 0, 'application/pdf'),
(28, 'dm_sid-x6.pdf', 'd567ece5d49725f8401f2845bd13d1bf', 0, 0, 'application/pdf'),
(27, 'dm_sid-x6.pdf', '07258b0376f6ba9a54889e915496c7e2', 0, 0, 'application/pdf'),
(26, 'dm_sid-x6.pdf', '3ce40aff57c7da21afd7d28bf05691aa', 65, 0, 'application/pdf'),
(25, 'dm_sid-x6.pdf', 'aeab0418cc8ee8661d3e7b3f8f19c831', 64, 0, 'application/pdf'),
(23, 'dm_sid-x6.pdf', 'ed691d4a8fc2af1c68b90821d5c5977f', 63, 52, 'application/pdf'),
(42, '1erExemple.FDM', 'dab0d7ad62bcd41c94bb16d196a16df5', 0, 0, 'application/octet-stream'),
(43, '1erExemple.FDM', 'ae6818654325efbf28cf3cac7b7d90ff', 0, 0, 'application/octet-stream'),
(44, '1erExemple.FDM', '6e9d70ed8411bd55d78914086bff4f75', 0, 0, 'application/octet-stream'),
(45, '1erExemple.FDM', 'b17fd35c7a99e92df666e99eb8fda7b4', 0, 0, 'application/octet-stream'),
(46, '1erExemple.FDM', '302644ebcb3096e536450904f0b84816', 0, 0, 'application/octet-stream'),
(47, '1erExemple.FDM', '340ec1f4100f7c7503adcdf8413c76e6', 0, 0, 'application/octet-stream'),
(48, '1erExemple.FDM', '87c1d562909ad0e2a7ffaf84b5f3588b', 0, 0, 'application/octet-stream'),
(49, '1erExemple.FDM', '51e4bb851b18c5cb688100c88bde1314', 71, 0, 'application/octet-stream'),
(50, 'jeuDeDataSipina.ods', '71b2dc0fa851a2da3a133e721492cedb', 72, 0, 'application/vnd.oasis.opendocument.spreadsheet'),
(51, 'jeuDeDataSipina.txt', '1c3996cb6359e9c29e9078fbc49e91dd', 73, 0, 'text/plain');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `fichesujetstage`
--

INSERT INTO `fichesujetstage` (`id`, `nomoriginal`, `nomunique`, `idproposition`, `idstage`, `type`) VALUES
(10, '11-12-EdT-SID.pdf', 'dd734b21213a5b98c2448f65a19456d7', 40, 0, 'application/pdf'),
(11, 'lettre_de_motivation_master2.odt', '7fde7a76d85d6610af8a369c6b008964', 41, 0, 'application/vnd.oasis.opendocument.text'),
(12, 'lettre_de_motivation_master2.odt', 'cda6ac10fcfb2c8a4cd867085b2c306d', 0, 0, 'application/vnd.oasis.opendocument.text'),
(13, 'CoursQuonVaDonner', 'b8674050700725c2ce529f5f3fb16939', 42, 0, 'application/octet-stream'),
(14, 'lettre_de_motivation_master2.pdf', 'd5b710e4e6924bdfe2eb9308befbdf1c', 43, 0, 'application/pdf'),
(15, 'lettre_de_motivation_master2.odt', 'd59976a4b2398d7c6017fa981fb4a68c', 44, 0, 'application/vnd.oasis.opendocument.text'),
(16, '11-12-EdT-SID.pdf', 'b3f00d92f6ea949436273349de8f18e2', 45, 0, 'application/pdf'),
(17, '11-12-EdT-SID.pdf', 'fddfdfaa88c23caddebb8fdb8e892a07', 46, 0, 'application/pdf'),
(18, 'nouveau fichier', '01e8d6e28092e57c988cb67bdf5758fb', 47, 29, 'application/octet-stream'),
(19, 'attrib_credit_infos.txt', '07f8278a2cf7b0ecef01c9fbc4c0c675', 48, 31, 'text/plain'),
(20, 'jeuDeDataSipina.txt', 'bc15eabdf6c9a8877564005cf8a836c3', 49, 33, 'text/plain'),
(21, '11-12-EdT-SID.pdf', '5b84ecaa05a86385b41713715cb30d3a', 50, 35, 'application/pdf'),
(22, 'attrib_credit.txt', '6531963846ecf324d9a58a00dac34e4b', 52, 37, 'text/plain'),
(23, 'dm_sid-x6.pdf', '694d8fb7edbc19a1bbeb50d9acd425c3', 69, 54, 'application/pdf');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `idpromotion` int(11) NOT NULL AUTO_INCREMENT,
  `nompromotion` varchar(50) DEFAULT NULL,
  `accesentreprises` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idpromotion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`idpromotion`, `nompromotion`, `accesentreprises`) VALUES
(1, 'L3 2011-2012', 0),
(2, 'M2 SID 2011-2012', 1),
(3, 'M2 ACSI 2011-2012', 1),
(4, 'L3 2010-2011', 1),
(5, 'M2 SID 2010-2011', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Contenu de la table `proposition`
--

INSERT INTO `proposition` (`idproposition`, `identreprise`, `idutilisateur`, `idstage`, `nomentreprisep`, `dateproposition`, `adresseentreprisep`, `villeentreprisep`, `codepostalentreprisep`, `paysentreprisep`, `numerotelephonep`, `urlsiteinternetp`, `sujetstagep`, `titrestagep`, `technostagep`, `raisonrefus`, `etat`) VALUES
(16, 9, 1, NULL, NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, NULL, 'essai valide 2', 'a', 'a', '', 'validee'),
(17, 1, 3, NULL, NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, NULL, 'essai laurent', 'a', 'ga', '', 'validee'),
(18, 9, 3, NULL, NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, NULL, 'vrai sujet', '11111', '22222', '', 'validee'),
(19, 14, 1, NULL, NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, NULL, 'etjte', 'jetj', 'j', '', 'validee'),
(28, 5, 3, NULL, NULL, '2012-01-11', NULL, NULL, NULL, NULL, NULL, NULL, 'php', 'php', 'php', '', 'en attente'),
(46, 5, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'aera', 'aerar', 'aeraer', '', 'validee'),
(47, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'ffffffffff', 'fffffffff', 'fffffffffff', '', 'validee'),
(48, 7, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'mmmmmmm', 'mmmmmmm', 'mmmmmm', '', 'validee'),
(49, 5, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'brz', 'bz', 'zbr', '', 'validee'),
(50, 5, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'hhhhhhhh', 'hhhhhhhhh', 'hhhhhhhhhh', '', 'validee'),
(51, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'a', 'aefae', 'a', '', 'en attente'),
(52, 7, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'gb', 'gb', 'gb', '', 'validee'),
(53, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'j', 'j', 'j', '', 'validee'),
(54, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'rf', 'rf', 'rf', '', 'validee'),
(55, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'pp', 'pp', 'pp', '', 'validee'),
(56, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'yy', 'yy', 'yy', '', 'validee'),
(57, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'er', 'er', 'er', '', 'validee'),
(58, 6, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, ',,', ',,', ',,', '', 'validee'),
(59, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'df', 'df', 'df', '', 'validee'),
(60, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'gg', 'gg', 'gg', '', 'en attente'),
(61, 5, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'ff', 'fff', 'ff', '', 'en attente'),
(62, 5, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'f', 'f', 'f', '', 'en attente'),
(63, 5, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'jk', 'jk', 'jk', '', 'validee'),
(64, 5, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'ert', 'ert', 'ert', '', 'en attente'),
(65, 5, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'dfff', 'dfff', 'dfff', '', 'en attente'),
(66, 5, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'h', 'h', 'h', '', 'en attente'),
(67, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'h', 'h', 'h', '', 'en attente'),
(68, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'm', 'm', 'm', '', 'en attente'),
(69, 5, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'uuuuuuuu', 'uuuuuuu', 'uuuuuuu', '', 'validee'),
(70, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'rzg', 'zgrz', 'g', '', 'en attente'),
(71, 1, 1, NULL, NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, NULL, 'afae', 'afe', '', '', 'en attente'),
(72, 5, 1, NULL, NULL, '2012-02-01', NULL, NULL, NULL, NULL, NULL, NULL, 'ggggggggggggggggggggg', 'ggggggggggggggggggg', 'spring', '', 'en attente'),
(73, 1, 1, NULL, NULL, '2012-02-01', NULL, NULL, NULL, NULL, NULL, NULL, 'ffffffffffffff', 'fffffffffffffffffffff', 'spring, hibernate, ajfiaeg, aegag ,aegeag aega elgnaen gag,zg zrg zh rzhz httzh  zrhtze', '', 'en attente');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Contenu de la table `stage`
--

INSERT INTO `stage` (`idstage`, `identreprise`, `idcontact`, `idpromotion`, `idproposition`, `idutilisateur`, `sujetstage`, `titrestage`, `technostage`, `datevalidation`, `datedebut`, `datefin`, `datesoutenance`, `lieusoutenance`, `etatstage`, `noteobtenue`, `appreciationobtenue`, `remuneration`, `embauche`, `dateembauche`, `respcivil`) VALUES
(17, 9, NULL, 2, 16, 1, 'essai valide 2', 'a', 'a', '2011-12-14', NULL, NULL, NULL, NULL, 'a valider', NULL, NULL, NULL, NULL, NULL, 0),
(18, 1, 2, 1, 17, 3, 'essai laurent', 'a', 'ga', '2011-12-14', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(19, 14, NULL, 2, 19, 1, 'etjte', 'jetj', 'j', '2012-01-11', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(20, 14, NULL, 2, 19, 1, 'etjte', 'jetj', 'j', '2012-01-11', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(21, 9, 9, 1, 18, 3, 'vrai sujet', '11111', '22222', '2012-01-11', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(22, 5, NULL, 2, 46, 1, 'aera', 'aerar', 'aeraer', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(23, 5, NULL, 2, 46, 1, 'aera', 'aerar', 'aeraer', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(24, 1, NULL, 2, 47, 1, 'ffffffffff', 'fffffffff', 'fffffffffff', '2011-03-07', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(25, 1, NULL, 2, 47, 1, 'ffffffffff', 'fffffffff', 'fffffffffff', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(26, 1, NULL, 2, 47, 1, 'ffffffffff', 'fffffffff', 'fffffffffff', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(27, 1, NULL, 2, 47, 1, 'ffffffffff', 'fffffffff', 'fffffffffff', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(28, 1, NULL, 2, 47, 1, 'ffffffffff', 'fffffffff', 'fffffffffff', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(29, 1, NULL, 2, 47, 1, 'ffffffffff', 'fffffffff', 'fffffffffff', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(30, 7, NULL, 2, 48, 1, 'mmmmmmm', 'mmmmmmm', 'mmmmmm', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(31, 7, NULL, 2, 48, 1, 'mmmmmmm', 'mmmmmmm', 'mmmmmm', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(32, 5, NULL, 2, 49, 1, 'brz', 'bz', 'zbr', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(33, 5, NULL, 2, 49, 1, 'brz', 'bz', 'zbr', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(34, 5, NULL, 2, 50, 1, 'hhhhhhhh', 'hhhhhhhhh', 'hhhhhhhhhh', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(35, 5, NULL, 2, 50, 1, 'hhhhhhhh', 'hhhhhhhhh', 'hhhhhhhhhh', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(36, 7, NULL, 2, 52, 1, 'gb', 'gb', 'gb', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(37, 7, NULL, 2, 52, 1, 'gb', 'gb', 'gb', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(38, 7, NULL, 2, 52, 1, 'gb', 'gb', 'gb', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(39, 1, NULL, 2, 53, 1, 'j', 'j', 'j', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(40, 1, NULL, 2, 53, 1, 'j', 'j', 'j', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(41, 1, NULL, 2, 54, 1, 'rf', 'rf', 'rf', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(42, 1, NULL, 2, 54, 1, 'rf', 'rf', 'rf', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(43, 1, NULL, 2, 55, 1, 'pp', 'pp', 'pp', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(44, 1, NULL, 2, 55, 1, 'pp', 'pp', 'pp', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(45, 1, NULL, 2, 56, 1, 'yy', 'yy', 'yy', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(46, 1, NULL, 2, 55, 1, 'pp', 'pp', 'pp', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(47, 1, NULL, 2, 55, 1, 'pp', 'pp', 'pp', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(48, 1, NULL, 2, 57, 1, 'er', 'er', 'er', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(49, 1, NULL, 2, 57, 1, 'er', 'er', 'er', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(50, 6, NULL, 2, 58, 1, ',,', ',,', ',,', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(51, 1, NULL, 2, 59, 1, 'df', 'df', 'df', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(52, 5, NULL, 2, 63, 1, 'jk', 'jk', 'jk', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(53, 5, 8, 2, 69, 1, 'uuuuuuuu', 'uuuuuuu', 'uuuuuuu', '2012-01-25', NULL, NULL, NULL, NULL, 'en cours', NULL, NULL, NULL, NULL, NULL, 0),
(54, 5, NULL, 2, 69, 1, 'uuuuuuuu', 'uuuuuuu', 'uuuuuuu', '2012-01-25', '2012-01-05', '2012-01-06', '0000-00-00', 'NULL', 'valide', 0, 'bien', NULL, NULL, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `techno`
--

CREATE TABLE IF NOT EXISTS `techno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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
(8, 'Audit');

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
(0, 4),
(0, 5),
(0, 4),
(0, 5),
(0, 4),
(0, 5),
(0, 1),
(0, 8),
(71, 1),
(71, 8),
(72, 1),
(72, 3),
(73, 1),
(73, 2),
(73, 5),
(73, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `idpromotion`, `mailutilisateur`, `passwordutilisateur`, `passwordutilisateurtmp`, `nomutilisateur`, `prenomutilisateur`, `numetudiant`, `idConfirmationMail`, `admin`) VALUES
(1, 2, 'ludo@gmail.com', 'ae5a3c4fa3c5d1c2cc98e43b1899f88bce0e3569', '', 'fort', 'ludovic', '22222222222', '', 0),
(3, 1, 'laurent@gmail.com', 'f1b010126f61b5c59e7d5eb42c5c68f6105c5914', '', 'Dubois', 'Laurent', '283983', '', 0),
(4, 3, 'anthony.avola@gmail.com', '7a79f9450d349278985d7ff04b2bd7d48ddcf42a', '', 'AVOLA', 'Anthony', '27004612', '', 0),
(10, 2, 'khalid.benali@loria.fr', '94ca247fff5ad413788a1c8d8c80394a246dba1c', '', 'benali', 'khalid', NULL, '', 1),
(11, 1, 'jean.malhomme@loria.fr', '51f8b1fa9b424745378826727452997ee2a7c3d7', '', 'Malhomme', 'Jean', NULL, '', 1),
(20, 2, 'fort0192@etudiant.univ-nancy2.fr', '146473bcb6ff4a8b8b564d04e59c99d8296501cb', '146473bcb6ff4a8b8b564d04e59c99d8296501cb', 'fort', 'ludovic', NULL, '83de63f05ecb1762271239084cbfc9b3', 0),
(21, 2, 'anthony.avola@etudiant.univ-nancy2.fr', NULL, '6e1a438cfe5a6c9e2165665f8c2258849ccc43f0', 'Antony', 'Avola', NULL, '715673ae886620da633e93f3f94c091c', 0);

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