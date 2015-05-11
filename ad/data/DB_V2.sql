-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 01 Mai 2015 à 18:09
-- Version du serveur :  5.5.36
-- Version de PHP :  5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `artgallery`
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
  `nom_artist` varchar(512) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `prenom_artist` varchar(512) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `cv_artist` longtext CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  PRIMARY KEY (`id_artist`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `artist`
--

INSERT INTO `artist` (`id_artist`, `nom_artist`, `prenom_artist`, `cv_artist`) VALUES
(22, 'Ferdinand', 'Christian', '<p>Ceci est la description de <span style="color:#0000FF"><strong>Christian Ferdinand</strong></span></p>\r\n'),
(23, 'Menu', 'Olivier', '<p>Ceci est la description <span style="color:#FFA500"><strong>d&#39;<strong>Ol</strong></strong></span><span style="color:#FF8C00"><strong>ivier Menu</strong></span></p>\r\n'),
(24, 'Ouedraogo', 'Harouna', '<p>Ceci est la description <span style="color:#EE82EE"><strong>d&#39;Harouna Ouedraogo</strong></span></p>\r\n'),
(25, 'Carlsson', 'Marcus', '<p>Ceci est la description de <span style="color:#FF0000"><strong>Marcus Carlsson</strong></span></p>\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `email_client` varchar(255) NOT NULL,
  `comment_client` text NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE IF NOT EXISTS `contenir` (
  `id_oeuvre` int(11) NOT NULL AUTO_INCREMENT,
  `id_tag` int(11) NOT NULL,
  PRIMARY KEY (`id_oeuvre`,`id_tag`),
  KEY `FK_CONTENIR_id_tag` (`id_tag`)
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
-- Structure de la table `oeuvre`
--

CREATE TABLE IF NOT EXISTS `oeuvre` (
  `id_oeuvre` int(11) NOT NULL AUTO_INCREMENT,
  `titre_oeuvre` varchar(512) DEFAULT NULL,
  `dimensions_oeuvre` varchar(512) DEFAULT NULL,
  `prix_oeuvre` bigint(20) DEFAULT NULL,
  `description_oeuvre` longtext,
  `isprofil_oeuvre` tinyint(1) NOT NULL,
  `link_oeuvre` varchar(500) NOT NULL,
  `id_artist` int(11) NOT NULL,
  `id_technique` int(11) NOT NULL,
  PRIMARY KEY (`id_oeuvre`),
  KEY `FK_Oeuvre_id_artist` (`id_artist`),
  KEY `FK_Oeuvre_id_technique` (`id_technique`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Contenu de la table `oeuvre`
--

INSERT INTO `oeuvre` (`id_oeuvre`, `titre_oeuvre`, `dimensions_oeuvre`, `prix_oeuvre`, `description_oeuvre`, `isprofil_oeuvre`, `link_oeuvre`, `id_artist`, `id_technique`) VALUES
(87, 'peinture.jpg', '', 0, '', 0, 'artistes/Ferdinand/oeuvres/peinture.jpg', 22, 1),
(88, 'peinture6.jpg', '', 0, '', 0, 'artistes/Ferdinand/oeuvres/peinture6.jpg', 22, 1),
(89, 'peinture7.jpg', '', 0, '', 0, 'artistes/Ferdinand/oeuvres/peinture7.jpg', 22, 1),
(90, 'peinture.jpg', '', 0, '', 0, 'artistes/Ferdinand/profil/peinture.jpg', 22, 1),
(91, 'peinture4.jpg', '', 0, '', 0, 'artistes/Menu/oeuvres/peinture4.jpg', 23, 1),
(92, 'peinture5.jpg', '', 0, '', 0, 'artistes/Menu/oeuvres/peinture5.jpg', 23, 1),
(93, 'peinture6.jpg', '', 0, '', 0, 'artistes/Menu/oeuvres/peinture6.jpg', 23, 1),
(94, 'peinture6.jpg', '', 0, '', 0, 'artistes/Menu/profil/peinture6.jpg', 23, 1),
(95, 'peinture2.jpg', '', 0, '', 0, 'artistes/Ouedraogo/oeuvres/peinture2.jpg', 24, 1),
(96, 'peinture3.jpg', '', 0, '', 0, 'artistes/Ouedraogo/oeuvres/peinture3.jpg', 24, 1),
(97, 'peinture4.jpg', '', 0, '', 0, 'artistes/Ouedraogo/oeuvres/peinture4.jpg', 24, 1),
(98, 'peinture5.jpg', '', 0, '', 0, 'artistes/Ouedraogo/profil/peinture5.jpg', 24, 1),
(99, 'peinture.jpg', '', 0, '', 0, 'artistes/Carlsson/oeuvres/peinture.jpg', 25, 1),
(100, 'peinture2.jpg', '', 0, '', 0, 'artistes/Carlsson/oeuvres/peinture2.jpg', 25, 1),
(101, 'peinture5.jpg', '', 0, '', 0, 'artistes/Carlsson/oeuvres/peinture5.jpg', 25, 1),
(102, 'peinture4.jpg', '', 0, '', 0, 'artistes/Carlsson/profil/peinture4.jpg', 25, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tag` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `technique`
--

CREATE TABLE IF NOT EXISTS `technique` (
  `id_technique` int(11) NOT NULL AUTO_INCREMENT,
  `nom_technique` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id_technique`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `technique`
--

INSERT INTO `technique` (`id_technique`, `nom_technique`) VALUES
(1, 'Peinture'),
(2, 'Sculpture'),
(3, 'Photographie'),
(4, 'Installation'),
(5, 'Gravure'),
(6, 'Lithographie'),
(7, 'Reproduction');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_CONTENIR_id_oeuvre` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvre` (`id_oeuvre`),
  ADD CONSTRAINT `FK_CONTENIR_id_tag` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`);

--
-- Contraintes pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  ADD CONSTRAINT `FK_Oeuvre_id_artist` FOREIGN KEY (`id_artist`) REFERENCES `artist` (`id_artist`),
  ADD CONSTRAINT `FK_Oeuvre_id_technique` FOREIGN KEY (`id_technique`) REFERENCES `technique` (`id_technique`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
