-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 21 Mars 2016 à 09:20
-- Version du serveur :  5.6.29-1~dotdeb+7.1
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
-- Structure de la table `aide`
--

CREATE TABLE IF NOT EXISTS `aide` (
  `id` int(11) NOT NULL,
  `numero_etudiant` int(8) NOT NULL,
  `id_needhelp` int(11) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `aide`
--

INSERT INTO `aide` (`id`, `numero_etudiant`, `id_needhelp`, `etat`) VALUES
(3, 21400499, 5, 0),
(4, 21400006, 7, 0),
(6, 21400641, 12, 0);

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
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
  `id` int(11) NOT NULL,
  `titre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id`, `titre`) VALUES
(0, 'Non traité'),
(1, 'En cours de traitement'),
(2, 'Traité');

-- --------------------------------------------------------

--
-- Structure de la table `etat_aide`
--

CREATE TABLE IF NOT EXISTS `etat_aide` (
  `id` int(11) NOT NULL,
  `titre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat_aide`
--

INSERT INTO `etat_aide` (`id`, `titre`) VALUES
(0, 'En attente'),
(1, 'Refusé');

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
  `id_priv` int(4) DEFAULT '1',
  `id_grp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`numero_etudiant`, `mdp`, `nom`, `prenom`, `age`, `email`, `id_priv`, `id_grp`) VALUES
(12345677, 'cbb7353e6d953ef360baf960c122346276c6e320', 'LEPONGE', 'BOB', NULL, 'david.auger@uvsq.fr', 1, 2),
(21200200, 'a3b47fe3de869322953c70dab822a3d9359e492f', 'test', 'test', NULL, 'vdo.temp@laposte.net', 2, 6),
(21400006, 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'Beudard', 'Quentin', NULL, 'a.b@gmail.com', 1, 6),
(21400036, 'af9ddc62221cf2e0f00964ba89454de1f5c0ef9a', 'MANIOC', 'Nicolas', NULL, 'nounours.97178@gmail.com', 1, 2),
(21400046, '611206f77d4d17ba98b51ccf41c4575ea9bb85f2', 'arnaud', 'arnaud', NULL, 'arnaud-627@hotmail.fr', 1, 6),
(21400307, '940c0f26fd5a30775bb1cbd1f6840398d39bb813', 'hassan', 'naiyash', NULL, 'nuhs_786@hotmail.fr', 1, 6),
(21400499, '9ef3349bfd6d4524cd58c8f84fbf0f3aee04794d', 'Ahmed', 'Sahim', NULL, 'sahimfingerstyle@gmail.com', 1, 6),
(21400525, '9e73a799b996660e569253aac43ad86f4db39f4b', 'Ausseil', 'Julie', NULL, 'jausseil11@gmail.com', 1, 6),
(21400592, '862488148f9cfff04d95dfc8aa819041bde9b871', 'Siraudin', 'Xavier', NULL, 'xavier.siraudin@gmail.com', 1, 6),
(21400641, 'a3b47fe3de869322953c70dab822a3d9359e492f', 'Doisneau', 'Vincent', NULL, 'vincent.doisneau@outlook.com', 2, 6),
(21400878, 'e0b1a60e3b646ec423d8dffea4a626e26431043b', 'boisuboisu', 'adrien', NULL, 'adrienboisumeau@yahoo.fr', 1, 6),
(21401059, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Gouarin', 'Florian', NULL, 'florian@gouarin.info', 2, 6),
(21401071, 'cf7453ffd7d6f902515fe2ce72e4eed73a9d0c91', 'BOULEOUD', 'Samyh', NULL, 'bouleoud.samyh@hotmail.fr', 1, 6),
(21401303, '9cf95dacd226dcf43da376cdb6cbba7035218921', 'JAU', 'Lilian', NULL, 'lilian.jau@cegetel.net', 1, 6),
(21401537, 'f995ff5581e98c7535104819c740a53db3071d92', 'Sago', 'Aim', NULL, 'aim.sago@yahoo.com', 1, 6),
(21401575, '0b617f94a0ac29068794681c8b123df9016c524a', 'BONNET', 'Loic', NULL, 'bonnetloic.lb@gmail.com', 1, 6),
(21404197, '2c3923788a3fcea36b92005ebfde84fef29dcec9', 'martinez', 'louis', NULL, 'md.louix@gmail.com', 2, 6),
(21407826, '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Rochet', 'Alban', NULL, 'albanrochet@gmail.com', 1, 6),
(21500363, 'c6c4940b323ff81c66e02a02e0281c370c535008', 'Dinis', 'Julien', NULL, 'VGZEdits@gmail.com', 1, 2),
(21500370, '0b71cb9efb5446e6b443a006bfa50a1a9cb7c116', 'Bisson', 'Nicolas', NULL, 'bissonnico@hotmail.fr', 1, 2),
(21500875, 'c581c556b1aef939ba11d93c153383fb4638d67d', 'BOULLET', 'Nicolas', NULL, 'boullet.nicolas@gmail.com', 1, 2),
(21501294, 'dc316b2d9d7e725231b66ac6d306fa8633486857', 'Pereira', 'Laura', NULL, 'lauraveloso11@gmail.com', 1, 2),
(21501454, 'd89dcc09e30460a120604606beb637b075b06e0b', 'Tran', 'Octavia', NULL, 'flavia.thuy@gmail.com', 1, 2),
(21503798, '28186fb590c64d652093bf34a8584df1af3bd696', 'Miel', 'Sonny ', NULL, 'sonnymt@hotmail.com', 1, 2),
(21506618, '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', 'Hanna', 'Mathias', NULL, 'mathias.hanna@me.com', 1, 2),
(78945612, '5af9c3959a9bd7b25614beea8954059e8eb478a1', 'rf', 'rf', NULL, 'rf@gmail.com', 1, 6);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

CREATE TABLE IF NOT EXISTS `infos` (
  `anneeEnCours` int(11) NOT NULL,
  `anneeSuivante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `infos`
--

INSERT INTO `infos` (`anneeEnCours`, `anneeSuivante`) VALUES
(2015, 2016);

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
  `date_publication` date NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `needhelp`
--

INSERT INTO `needhelp` (`id`, `numero_etudiant`, `id_mat`, `commentaire`, `date_publication`, `etat`) VALUES
(1, 21404197, 2, 'PLS commencer a poster des demandes', '2016-03-12', 0),
(5, 21401303, 4, 'Aidez moi vous êtes mon dernier espoir...', '2016-03-15', 1),
(7, 21401575, 15, 'Comment on fait pour créer un fichier XML en PHP svp, c''est pour un TP', '2016-03-17', 1),
(12, 21200200, 1, 'test', '2016-03-20', 1);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `titre` varchar(50) NOT NULL,
  `contenu` varchar(300) NOT NULL,
  `datePublication` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`titre`, `contenu`, `datePublication`) VALUES
('Update', 'Merci à ceux qui se sont inscrits dernièrement : cela nous a permis de voir des bugs que nous sommes en train de corriger. Vous retrouverez ici sur ce nouvel ajout les dernières nouvelles concernant le site.', '2016-03-20');

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
-- Index pour la table `aide`
--
ALTER TABLE `aide`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_needhelp` (`id_needhelp`), ADD KEY `fk_etudiant` (`numero_etudiant`), ADD KEY `fk_etat_aide` (`etat`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_mat`,`id_grp`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat_aide`
--
ALTER TABLE `etat_aide`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`), ADD KEY `fkey_etudiant` (`numero_etudiant`), ADD KEY `fkey_matiere` (`id_mat`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_mat`);

--
-- Index pour la table `needhelp`
--
ALTER TABLE `needhelp`
  ADD PRIMARY KEY (`id`), ADD KEY `fkey_etudiant` (`numero_etudiant`), ADD KEY `fkey_matiere` (`id_mat`), ADD KEY `fk_etat` (`etat`);

--
-- Index pour la table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id_priv`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `aide`
--
ALTER TABLE `aide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_grp` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `helper`
--
ALTER TABLE `helper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_mat` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `needhelp`
--
ALTER TABLE `needhelp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id_priv` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `aide`
--
ALTER TABLE `aide`
ADD CONSTRAINT `fk_etat_aide` FOREIGN KEY (`etat`) REFERENCES `etat_aide` (`id`),
ADD CONSTRAINT `fk_etudiant` FOREIGN KEY (`numero_etudiant`) REFERENCES `etudiant` (`numero_etudiant`),
ADD CONSTRAINT `fk_needhelp` FOREIGN KEY (`id_needhelp`) REFERENCES `needhelp` (`id`);

--
-- Contraintes pour la table `needhelp`
--
ALTER TABLE `needhelp`
ADD CONSTRAINT `fk_etat` FOREIGN KEY (`etat`) REFERENCES `etat` (`id`),
ADD CONSTRAINT `fkey_etudiant` FOREIGN KEY (`numero_etudiant`) REFERENCES `etudiant` (`numero_etudiant`),
ADD CONSTRAINT `fkey_matiere` FOREIGN KEY (`id_mat`) REFERENCES `matiere` (`id_mat`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
