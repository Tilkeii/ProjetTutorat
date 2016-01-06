-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 04 Janvier 2016 à 02:39
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
  `id_mat` int(4) NOT NULL DEFAULT '0',
  `id_grp` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id_mat`, `id_grp`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(2, 1),
(2, 5),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(5, 1),
(5, 2),
(5, 4),
(5, 5),
(5, 6),
(5, 8),
(6, 2),
(6, 3),
(6, 5),
(6, 7),
(6, 8),
(7, 2),
(7, 3),
(7, 6),
(7, 7),
(7, 8),
(8, 2),
(8, 3),
(8, 7),
(9, 3),
(9, 5),
(9, 6),
(9, 7),
(9, 8),
(10, 2),
(10, 6),
(11, 2),
(11, 6),
(12, 2),
(13, 2),
(13, 6),
(14, 2),
(14, 6),
(15, 2),
(15, 6),
(17, 6),
(18, 2),
(18, 3),
(18, 6),
(19, 2),
(19, 6),
(20, 1),
(20, 5),
(21, 1),
(22, 1),
(22, 4),
(22, 8),
(23, 1),
(23, 5),
(24, 1),
(25, 5),
(26, 5),
(27, 1),
(27, 5),
(28, 1),
(28, 5),
(29, 1),
(29, 5),
(30, 3),
(30, 7),
(31, 3),
(31, 7),
(32, 3),
(32, 7),
(33, 3),
(33, 7),
(34, 3),
(34, 7),
(35, 3),
(35, 7),
(36, 3),
(37, 3),
(37, 7),
(38, 7),
(39, 3),
(39, 7),
(40, 7),
(41, 7),
(42, 3),
(42, 7),
(43, 4),
(43, 8),
(44, 4),
(44, 8),
(45, 4),
(45, 8),
(46, 4),
(46, 8),
(47, 4),
(48, 4),
(48, 8);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
  `numero_etudiant` int(8) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `id_priv` int(4) DEFAULT NULL,
  `id_grp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`numero_etudiant`, `mdp`, `nom`, `prenom`, `age`, `email`, `id_priv`, `id_grp`) VALUES
(21301443, '6fe01f71b6e18bf858b061bfbaa89aaab88a9bbb', 'Ancestral', 'Pigeon', 21, 'eric92350@yahoo.fr', 1, 2),
(21604782, 'e7e24b5362dc0be52c67659e13dc5f3c8f972662', 'a', 'a', 20, 'a', 2, 4),
(22035514, 'e7e24b5362dc0be52c67659e13dc5f3c8f972662', 'dfd', 'qqqq', 89, 'ez', 2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
`id_grp` int(4) NOT NULL,
  `filiere` varchar(30) NOT NULL,
  `annee` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id_grp`, `filiere`, `annee`) VALUES
(1, 'GEII', 1),
(2, 'INFO', 1),
(3, 'MMI', 1),
(4, 'RT', 1),
(5, 'GEII', 2),
(6, 'INFO', 2),
(7, 'MMI', 2),
(8, 'RT', 2);

-- --------------------------------------------------------

--
-- Structure de la table `helper`
--

CREATE TABLE IF NOT EXISTS `helper` (
`id` int(11) NOT NULL,
  `numero_etudiant` int(11) NOT NULL,
  `id_mat` int(11) NOT NULL,
  `commentaire` varchar(300) DEFAULT NULL,
  `date_publication` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
`id_mat` int(4) NOT NULL,
  `nom_mat` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`id_mat`, `nom_mat`) VALUES
(1, 'Anglais'),
(2, 'Physique'),
(3, 'Expression, Communication'),
(4, 'PPP'),
(5, 'Mathematiques'),
(6, 'Economie'),
(7, 'Gestion, Gestion projet'),
(8, 'Organisation'),
(9, 'Droit'),
(10, 'Algorithmique'),
(11, 'Programmation'),
(12, 'Architecture Materielle'),
(13, 'Systèmes exploitation'),
(14, 'Reseaux'),
(15, 'Web'),
(16, 'Internet'),
(17, 'Mobilité'),
(18, 'Bases de donnees'),
(19, 'Analyse/conception et développement d applis'),
(20, 'Energie'),
(21, 'Systeme d information numerique'),
(22, 'Informatique'),
(23, 'Systemes electronique'),
(24, 'Automatisme'),
(25, 'Reseau'),
(26, 'Automatique'),
(27, 'Outils logiciels'),
(28, 'Etudes/realisation ensembles pluritechnologiques'),
(29, 'Competences projet'),
(30, 'Theories de l information et de la communication'),
(31, 'Ecritures dans les medias numeriques'),
(32, 'Esthetique et expression artistique'),
(33, 'Algorithmie et programmation'),
(34, 'Culture scientifique et traitement de l informatio'),
(35, 'Infographie'),
(36, 'Integration WEB'),
(37, 'Production audiovisuelle'),
(38, 'Developpement'),
(39, 'Services sur reseaux'),
(40, 'Programmation Objet'),
(41, 'Integration multimedia'),
(42, 'Langue vivante 2'),
(43, 'Administration et securite des reseaux'),
(44, 'Architecture de l internet'),
(45, 'Developpement/exploitation des services reseaux'),
(46, 'Telecommunications fixes et mobiles'),
(47, 'Outils pour le signal'),
(48, 'Electronique/Physique pour les telecommunications');

-- --------------------------------------------------------

--
-- Structure de la table `needhelp`
--

CREATE TABLE IF NOT EXISTS `needhelp` (
`id` int(11) NOT NULL,
  `numero_etudiant` int(11) NOT NULL,
  `id_mat` int(11) NOT NULL,
  `commentaire` varchar(300) DEFAULT NULL,
  `date_publication` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `needhelp`
--

INSERT INTO `needhelp` (`id`, `numero_etudiant`, `id_mat`, `commentaire`, `date_publication`) VALUES
(2, 22035514, 7, 'projet de gestion', '2016-01-04'),
(3, 22035514, 10, 'GARDY PLS', '2016-01-04'),
(4, 21301443, 5, 'la piquette  ', '2016-01-04'),
(5, 21604782, 14, 'on laisse couler  ', '2016-01-04'),
(6, 21604782, 13, 'Easy se', '2016-01-04'),
(7, 21301443, 15, 'je ne comprends pas le cours de hoguin', '2016-01-04'),
(8, 21301443, 39, 'texte long texte long texte long texte long texte long texte long texte long texte long texte long texte long texte long texte long ', '2016-01-04'),
(9, 22035514, 29, 'dddddddfdfdfdfdfdfddddddddddddddfdfdfdfdf', '2016-01-01'),
(10, 21604782, 10, 'bonsoir', '2016-01-02'),
(11, 21604782, 5, 'le lapin mange le loup', '2016-01-03'),
(12, 21604782, 40, 'Maître corbeau sur un arbre perché', '2016-01-04'),
(13, 21604782, 24, 'GAAAAARRRRRDY', '2016-01-03'),
(14, 21604782, 3, '32', '2016-01-04'),
(15, 21604782, 2, 'sdss', '2016-01-04');

-- --------------------------------------------------------

--
-- Structure de la table `privileges`
--

CREATE TABLE IF NOT EXISTS `privileges` (
`id_priv` int(4) NOT NULL,
  `nom_priv` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `privileges`
--

INSERT INTO `privileges` (`id_priv`, `nom_priv`) VALUES
(1, 'user'),
(2, 'admin');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
 ADD PRIMARY KEY (`id_mat`,`id_grp`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
 ADD PRIMARY KEY (`numero_etudiant`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
 ADD PRIMARY KEY (`id_grp`);

--
-- Index pour la table `helper`
--
ALTER TABLE `helper`
 ADD PRIMARY KEY (`numero_etudiant`,`id_mat`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
 ADD PRIMARY KEY (`id_mat`);

--
-- Index pour la table `needhelp`
--
ALTER TABLE `needhelp`
 ADD PRIMARY KEY (`id`), ADD KEY `fkey_etudiant` (`numero_etudiant`), ADD KEY `fkey_matiere` (`id_mat`);

--
-- Index pour la table `privileges`
--
ALTER TABLE `privileges`
 ADD PRIMARY KEY (`id_priv`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
MODIFY `id_grp` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
MODIFY `id_mat` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `needhelp`
--
ALTER TABLE `needhelp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `privileges`
--
ALTER TABLE `privileges`
MODIFY `id_priv` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `needhelp`
--
ALTER TABLE `needhelp`
ADD CONSTRAINT `fkey_etudiant` FOREIGN KEY (`numero_etudiant`) REFERENCES `etudiant` (`numero_etudiant`),
ADD CONSTRAINT `fkey_matiere` FOREIGN KEY (`id_mat`) REFERENCES `matiere` (`id_mat`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
