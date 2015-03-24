
CREATE DATABASE IF NOT EXISTS `todolist` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `todolist`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `dateDeNaissance` varchar(30) NOT NULL,
  `sexe` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `motDePasse` varchar(30) NOT NULL,
  `photo` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
