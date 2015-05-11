-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 05 Mai 2015 à 23:05
-- Version du serveur :  5.5.36
-- Version de PHP :  5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gallery`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo_admin` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password_admin` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `pseudo_admin`, `password_admin`) VALUES
(1, 'Ivan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(2, 'Thea', 'ca0327333e7cba1d58261b58c3bed59f09ca9664');

-- --------------------------------------------------------

--
-- Structure de la table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `id_artist` int(11) NOT NULL AUTO_INCREMENT,
  `nom_artist` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_artist`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `artistdetail`
--

CREATE TABLE IF NOT EXISTS `artistdetail` (
  `id_lang` int(11) NOT NULL AUTO_INCREMENT,
  `id_artist` int(11) NOT NULL,
  `description_artist` longtext,
  PRIMARY KEY (`id_lang`,`id_artist`),
  KEY `FK_ArtistDetail_id_artist` (`id_artist`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(100) DEFAULT NULL,
  `mail_client` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_ent` int(11) NOT NULL,
  `name_ent` varchar(255) NOT NULL,
  `email_ent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `galerie`
--

CREATE TABLE IF NOT EXISTS `galerie` (
  `id_gal` int(11) NOT NULL AUTO_INCREMENT,
  `nom_gerante` varchar(100) NOT NULL,
  `tel` varchar(512) NOT NULL,
  `cp_siege` varchar(10) NOT NULL,
  `ville_siege` varchar(100) NOT NULL,
  `rue_siege` varchar(200) NOT NULL,
  `cp_filiale` varchar(10) NOT NULL,
  `rue_filiale` varchar(200) NOT NULL,
  `ville_filiale` varchar(200) NOT NULL,
  PRIMARY KEY (`id_gal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

CREATE TABLE IF NOT EXISTS `langue` (
  `id_lang` int(11) NOT NULL AUTO_INCREMENT,
  `nom_lang` varchar(120) DEFAULT NULL,
  `ext_lang` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `langue`
--

INSERT INTO `langue` (`id_lang`, `nom_lang`, `ext_lang`) VALUES
(1, 'Français', 'FR'),
(2, 'Anglais', 'EN'),
(3, 'Néerlandais', 'NE');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `date_news` date DEFAULT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `newsdetails`
--

CREATE TABLE IF NOT EXISTS `newsdetails` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `id_lang` int(11) NOT NULL,
  `nom_news` varchar(200) DEFAULT NULL,
  `description_news` longtext,
  PRIMARY KEY (`id_news`,`id_lang`),
  KEY `FK_NewsDetails_id_lang` (`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre`
--

CREATE TABLE IF NOT EXISTS `oeuvre` (
  `id_oeuvre` int(11) NOT NULL AUTO_INCREMENT,
  `prix_oeuvre` varchar(100) DEFAULT NULL,
  `dimension_oeuvre` varchar(100) DEFAULT NULL,
  `isProfil_oeuvre` tinyint(1) DEFAULT NULL,
  `id_artist` int(11) NOT NULL,
  `id_technique` int(11) NOT NULL,
  PRIMARY KEY (`id_oeuvre`),
  KEY `FK_Oeuvre_id_artist` (`id_artist`),
  KEY `FK_Oeuvre_id_technique` (`id_technique`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvredetail`
--

CREATE TABLE IF NOT EXISTS `oeuvredetail` (
  `id_lang` int(11) NOT NULL AUTO_INCREMENT,
  `id_oeuvre` int(11) NOT NULL,
  `nom_oeuvre` varchar(550) DEFAULT NULL,
  `description_oeuvre` longtext,
  PRIMARY KEY (`id_lang`,`id_oeuvre`),
  KEY `FK_OeuvreDetail_id_oeuvre` (`id_oeuvre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `technique`
--

CREATE TABLE IF NOT EXISTS `technique` (
  `id_technique` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_technique` varchar(50) NOT NULL,
  PRIMARY KEY (`id_technique`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `technique`
--

INSERT INTO `technique` (`id_technique`, `libelle_technique`) VALUES
(1, 'Peinture'),
(2, 'Gravure'),
(3, 'Photographie'),
(4, 'Lithographie'),
(5, 'Installation'),
(6, 'Reproduction'),
(7, 'Sculpture');

-- --------------------------------------------------------

--
-- Structure de la table `techniquedetail`
--

CREATE TABLE IF NOT EXISTS `techniquedetail` (
  `id_technique` int(11) NOT NULL AUTO_INCREMENT,
  `id_lang` int(11) NOT NULL,
  `nom_technique` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_technique`,`id_lang`),
  KEY `FK_TechniqueDetail_id_lang` (`id_lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `techniquedetail`
--

INSERT INTO `techniquedetail` (`id_technique`, `id_lang`, `nom_technique`) VALUES
(1, 1, 'Peinture'),
(1, 2, 'Painting'),
(1, 3, 'Schilderij'),
(2, 1, 'Gravure'),
(2, 2, 'Engraving'),
(2, 3, 'Gravure'),
(3, 1, 'Photographie'),
(3, 2, 'Photography'),
(3, 3, 'Fotografie'),
(4, 1, 'Lithographie'),
(4, 2, 'Lithography'),
(4, 3, 'Lithografie'),
(5, 1, 'Installation'),
(5, 2, 'Installation'),
(5, 3, 'Installatie'),
(6, 1, 'Reproduction'),
(6, 2, 'Reproduction'),
(6, 3, 'Weergave'),
(7, 1, 'Sculpture'),
(7, 2, 'Sculpture'),
(7, 3, 'Beeldhouwkunst');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `artistdetail`
--
ALTER TABLE `artistdetail`
  ADD CONSTRAINT `FK_ArtistDetail_id_artist` FOREIGN KEY (`id_artist`) REFERENCES `artist` (`id_artist`),
  ADD CONSTRAINT `FK_ArtistDetail_id_lang` FOREIGN KEY (`id_lang`) REFERENCES `langue` (`id_lang`);

--
-- Contraintes pour la table `newsdetails`
--
ALTER TABLE `newsdetails`
  ADD CONSTRAINT `FK_NewsDetails_id_lang` FOREIGN KEY (`id_lang`) REFERENCES `langue` (`id_lang`),
  ADD CONSTRAINT `FK_NewsDetails_id_news` FOREIGN KEY (`id_news`) REFERENCES `news` (`id_news`);

--
-- Contraintes pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  ADD CONSTRAINT `FK_Oeuvre_id_technique` FOREIGN KEY (`id_technique`) REFERENCES `technique` (`id_technique`),
  ADD CONSTRAINT `FK_Oeuvre_id_artist` FOREIGN KEY (`id_artist`) REFERENCES `artist` (`id_artist`);

--
-- Contraintes pour la table `oeuvredetail`
--
ALTER TABLE `oeuvredetail`
  ADD CONSTRAINT `FK_OeuvreDetail_id_oeuvre` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvre` (`id_oeuvre`),
  ADD CONSTRAINT `FK_OeuvreDetail_id_lang` FOREIGN KEY (`id_lang`) REFERENCES `langue` (`id_lang`);

--
-- Contraintes pour la table `techniquedetail`
--
ALTER TABLE `techniquedetail`
  ADD CONSTRAINT `FK_TechniqueDetail_id_lang` FOREIGN KEY (`id_lang`) REFERENCES `langue` (`id_lang`),
  ADD CONSTRAINT `FK_TechniqueDetail_id_technique` FOREIGN KEY (`id_technique`) REFERENCES `technique` (`id_technique`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
