-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 16 Avril 2015 à 21:12
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `pseudo_admin`, `password_admin`) VALUES
(1, 'Ivan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `id_artist` int(11) NOT NULL AUTO_INCREMENT,
  `nom_artist` varchar(512) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `prenom_artist` varchar(512) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `cv_artist` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `img_entete_artist` varchar(512) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id_artist`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `artist`
--

INSERT INTO `artist` (`id_artist`, `nom_artist`, `prenom_artist`, `cv_artist`, `img_entete_artist`) VALUES
(1, 'KLARMAN', 'Ivan', 'CV Ivan klarman\n\nLe Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des ', ''),
(2, 'BELLEZA', 'Valérie', 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L''avantage du Lorem Ipsum sur un texte générique comme ''Du texte. Du texte. Du texte.', ''),
(3, 'MUCK', 'Thea', 'Ceci est un cv', 'test'),
(4, 'JOLIE', 'Emilie', 'Emilie Jolie est une ...', 'img/test'),
(5, 'CHATYON', 'Richard', 'Ceci est Richard ...', 'test/img'),
(6, 'LE BEL', 'François', 'Ceci est françois ...', 'img/test'),
(7, 'YNOKAVITSKY', 'Marouane', 'Ceci est Marouane...', 'img/test'),
(8, 'BARATHEON', 'Robert', 'Roi ', 'img/test'),
(9, 'LANNISTER', 'Cerceï', 'Reine', 'img/test');

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
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `url_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id_image`, `url_image`) VALUES
(1, 'img/a.jpg'),
(2, 'test');

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
  `id_artist` int(11) NOT NULL,
  `id_technique` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  PRIMARY KEY (`id_oeuvre`),
  KEY `FK_Oeuvre_id_artist` (`id_artist`),
  KEY `FK_Oeuvre_id_technique` (`id_technique`),
  KEY `id_image` (`id_image`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `oeuvre`
--

INSERT INTO `oeuvre` (`id_oeuvre`, `titre_oeuvre`, `dimensions_oeuvre`, `prix_oeuvre`, `description_oeuvre`, `id_artist`, `id_technique`, `id_image`) VALUES
(3, 'Ma première Oeuvre', '1000x1200', 855000, 'Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. Ceci est la description. ', 1, 1, 2),
(4, 'Ma deuxième oeuvre', '1000x900', 250000, 'ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ', 2, 3, 1),
(5, 'Ma troisième oeuvre', '1000x900', 358, 'ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ', 2, 3, 1),
(6, 'Ma quatrième oeuvre', '1000x900', 877, 'ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ceci est une description... ', 2, 3, 1);

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
  ADD CONSTRAINT `FK_Oeuvre_id_image` FOREIGN KEY (`id_image`) REFERENCES `image` (`id_image`),
  ADD CONSTRAINT `FK_Oeuvre_id_technique` FOREIGN KEY (`id_technique`) REFERENCES `technique` (`id_technique`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
