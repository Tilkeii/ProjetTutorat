-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 19 Décembre 2015 à 19:50
-- Version du serveur :  5.6.25-1~dotdeb+7.1
-- Version de PHP :  5.5.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `w4130d_tutorat`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
  `id_mat` int(4) NOT NULL DEFAULT '0',
  `id_grp` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_priv` int(4) NOT NULL DEFAULT '1',
  `id_grp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `numero_etudiant` int(8) NOT NULL DEFAULT '0',
  `id_mat` int(4) NOT NULL DEFAULT '0',
  `commentaire` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `id_mat` int(4) NOT NULL,
  `nom_mat` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`id_mat`, `nom_mat`) VALUES
(1, 'Anglais'),
(2, 'Algorithmique'),
(3, 'Architecture des systèmes info'),
(4, 'Bases de données'),
(5, 'Conception orientée objet'),
(6, 'Conception de documents'),
(7, 'Systèmes informatique'),
(8, 'Mathématiques discrètes'),
(9, 'Algèbre linéaire'),
(10, 'Expression-communication'),
(11, 'Architecture réseaux'),
(12, 'Programmation orientée objet'),
(13, 'Graphes et langages'),
(14, 'Gestion de projet'),
(15, 'Programmation web'),
(16, 'Services réseaux'),
(17, 'Probabilités et statistiques'),
(18, 'Modélisations mathématiques'),
(19, 'Droit des TIC'),
(20, 'Gestion des systèmes d informa'),
(21, 'Systèmes d exploitation'),
(22, 'Comptabilité'),
(23, 'IHM'),
(24, 'Economie'),
(25, 'Fonctionnement des organisatio'),
(26, 'Conception et développement mo'),
(27, 'Programmation répartie'),
(28, 'Administration système et rése'),
(29, 'Langue vivante 2');

-- --------------------------------------------------------

--
-- Structure de la table `needhelp`
--

CREATE TABLE IF NOT EXISTS `needhelp` (
  `numero_etudiant` int(8) NOT NULL DEFAULT '0',
  `id_mat` int(4) NOT NULL DEFAULT '0',
  `commentaire` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`numero_etudiant`,`id_mat`);

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
  MODIFY `id_mat` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id_priv` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
