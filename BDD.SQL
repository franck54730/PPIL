-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 26 Mai 2015 à 14:14
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ppil`
--

-- --------------------------------------------------------

--
-- Structure de la table `associations`
--

CREATE TABLE IF NOT EXISTS `associations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `id_todo_lists` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_users` (`id_users`),
  KEY `id_todo_lists` (`id_todo_lists`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `associations`
--

INSERT INTO `associations` (`id`, `id_users`, `id_todo_lists`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `checked` tinyint(1) NOT NULL,
  `id_todo_lists` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_todo_lists` (`id_todo_lists`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `items`
--

INSERT INTO `items` (`id`, `nom`, `checked`, `id_todo_lists`) VALUES
(1, 'Patates', 0, 1),
(2, 'Choux', 0, 1),
(3, 'Pizza', 0, 1),
(4, 'pizza', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_todolist` int(11) NOT NULL,
  `texte` varchar(1000) NOT NULL,
  `consulte` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `id_utilisateur`, `id_todolist`, `texte`, `consulte`) VALUES
(1, 1, 2, 'L''item "pizza" de la liste liste aure a &eacute;t&eacute; s&eacute;l&eacute;ctionn&eacute par Aurelien ANDRE.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `notifier`
--

CREATE TABLE IF NOT EXISTS `notifier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_notifications` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_todo_lists` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_notifications` (`id_notifications`),
  KEY `id_users` (`id_users`),
  KEY `id_todo_lists` (`id_todo_lists`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `todo_lists`
--

CREATE TABLE IF NOT EXISTS `todo_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `date` date DEFAULT NULL,
  `frequence` int(11) DEFAULT NULL,
  `unite_frequence` int(11) DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `todo_lists`
--

INSERT INTO `todo_lists` (`id`, `nom`, `date`, `frequence`, `unite_frequence`, `date_fin`) VALUES
(1, 'Courses', '2024-04-02', NULL, NULL, NULL),
(2, 'liste aure', '2031-04-03', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `sexe` char(1) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `id_facebook` varchar(32) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `date_de_naissance`, `sexe`, `mail`, `mot_de_passe`, `photo`, `id_facebook`) VALUES
(1, 'Delavelle', 'Thibault', '2015-05-26', 'M', 'spider-rider@live.fr', '6fbd3e4130882a697903d1a4890b6f9f', '/img/avatars/1/1.jpg', '10204224064106414'),
(2, 'ANDRE', 'Aurelien', '2015-05-26', 'M', 'aurebde@zjefddgsvf.fr', '461737b5273ab00b852f724a9307fff9', '', '795769890518321'),
(3, 'ANDRE', 'Aurelien', '1991-09-18', 'M', 'aurel.andre@yahoo.fr', '18a552442e98e0dea5101c2217168b10', '/img/avatars/1/3.jpg', '795769890518321'),
(4, 'JEANNEROT', 'Adrien', '1993-09-10', 'M', 'adrien@hotmail.fr', '526cc84a9293cd2db31950438a5fd35e', '/img/avatars/1/4.jpg', '10206598752838181'),
(5, 'Ahmed', 'Ahmed', '2015-05-26', 'M', 'ahmed@ahmed.fr', '27276599bbc2f8f7a9b2e88f34bd7505', '', '10153296707028890');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `associations`
--
ALTER TABLE `associations`
  ADD CONSTRAINT `associations_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `associations_ibfk_2` FOREIGN KEY (`id_todo_lists`) REFERENCES `todo_lists` (`id`);

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`id_todo_lists`) REFERENCES `todo_lists` (`id`);

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `notifier`
--
ALTER TABLE `notifier`
  ADD CONSTRAINT `notifier_ibfk_1` FOREIGN KEY (`id_notifications`) REFERENCES `notifications` (`id`),
  ADD CONSTRAINT `notifier_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifier_ibfk_3` FOREIGN KEY (`id_todo_lists`) REFERENCES `todo_lists` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
