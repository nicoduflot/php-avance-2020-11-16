-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 20 nov. 2020 à 13:25
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `php-avance`
--

-- --------------------------------------------------------

--
-- Structure de la table `arme`
--

DROP TABLE IF EXISTS `arme`;
CREATE TABLE IF NOT EXISTS `arme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `niveau_degats` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `arme`
--

INSERT INTO `arme` (`id`, `nom`, `niveau_degats`) VALUES
(1, 'Mains nues', 1),
(2, 'Poignard', 1),
(3, 'Hache à trois mains', 3),
(4, 'Epée en fer', 1),
(5, 'Epée en acier', 2),
(6, 'Double mortensen', 3),
(7, 'Epée en acier', 2),
(8, 'Epée en acier', 3),
(9, 'Epée en acier', 9);

-- --------------------------------------------------------

--
-- Structure de la table `classe_personnage`
--

DROP TABLE IF EXISTS `classe_personnage`;
CREATE TABLE IF NOT EXISTS `classe_personnage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classe_personnage`
--

INSERT INTO `classe_personnage` (`id`, `nom`) VALUES
(1, 'Personnage'),
(2, 'Mage'),
(3, 'Guerrier');

-- --------------------------------------------------------

--
-- Structure de la table `jeux_video`
--

DROP TABLE IF EXISTS `jeux_video`;
CREATE TABLE IF NOT EXISTS `jeux_video` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `possesseur` varchar(255) NOT NULL,
  `console` varchar(255) NOT NULL,
  `prix` double NOT NULL DEFAULT '0',
  `nbre_joueurs_max` int(11) NOT NULL DEFAULT '0',
  `commentaires` text NOT NULL,
  `date_ajout` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modif` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `ID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jeux_video`
--

INSERT INTO `jeux_video` (`ID`, `nom`, `possesseur`, `console`, `prix`, `nbre_joueurs_max`, `commentaires`, `date_ajout`, `date_modif`) VALUES
(1, 'Super Mario Bros', 'Florent', 'NES', 4, 1, 'Un jeu d\'anthologie !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(2, 'Sonic', 'Patrick', 'Megadrive', 2, 1, 'Pour moi, le meilleur jeu du monde !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(3, 'Zelda : ocarina of time', 'Florent', 'Nintendo 64', 15, 1, 'Un jeu grand, beau et complet comme on en voit rarement de nos jours', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(4, 'Mario Kart 64', 'Florent', 'Nintendo 64', 25, 4, 'Un excellent jeu de kart !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(5, 'Super Smash Bros Melee', 'Michel', 'GameCube', 55, 4, 'Un jeu de baston délirant !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(6, 'Dead or Alive', 'Patrick', 'Xbox', 60, 4, 'Le plus beau jeu de baston jamais créé', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(7, 'Dead or Alive Xtreme Beach Volley Ball', 'Patrick', 'Xbox', 60, 4, 'Un jeu de beach volley de toute beauté o_O', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(8, 'Enter the Matrix', 'Michel', 'PC', 45, 1, 'Plutôt bof comme jeu, mais ça complète bien le film', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(9, 'Max Payne 2', 'Michel', 'PC', 50, 1, 'Très réaliste, une sorte de film noir sur fond d\'histoire d\'amour. A essayer !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(10, 'Yoshi\'s Island', 'Florent', 'SuperNES', 6, 1, 'Le paradis des Yoshis :o)', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(11, 'Commandos 3', 'Florent', 'PC', 44, 12, 'Un bon jeu d\'action où on dirige un commando pendant la 2ème guerre mondiale !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(12, 'Final Fantasy X', 'Patrick', 'PS2', 40, 1, 'Encore un Final Fantasy mais celui la est encore plus beau !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(13, 'Pokemon Rubis', 'Florent', 'GBA', 44, 4, 'Pika-Pika-chu !!!', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(14, 'Starcraft', 'Michel', 'PC', 19, 8, 'Le meilleur jeux pc de tout les temps !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(15, 'Grand Theft Auto 3', 'Michel', 'PS2', 30, 1, 'Comme dans les autres Gta on ecrase tout le monde :) .', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(16, 'Homeworld 2', 'Michel', 'PC', 45, 6, 'Superbe ! o_O', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(17, 'Aladin', 'Patrick', 'SuperNES', 10, 1, 'Comme le dessin Animé !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(18, 'Super Mario Bros 3', 'Michel', 'SuperNES', 10, 2, 'Le meilleur Mario selon moi.', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(19, 'SSX 3', 'Florent', 'Xbox', 56, 2, 'Un très bon jeu de snow !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(20, 'Star Wars : Jedi outcast', 'Patrick', 'Xbox', 33, 1, 'Encore un jeu sur star-wars où on se prend pour Luke Skywalker !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(22, 'Time Crisis 3', 'Florent', 'PS2', 40, 1, 'Un troisième volet efficace mais pas vraiment surprenant', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(23, 'X-FILES', 'Patrick', 'PS', 25, 1, 'Un jeu censé ressembler a la série mais assez raté ...', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(24, 'Soul Calibur 2', 'Patrick', 'Xbox', 54, 1, 'Un jeu bien axé sur le combat', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(25, 'Diablo', 'Florent', 'PS', 20, 1, 'Comme sur PC mais la c\'est sur un ecran de télé :) !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(26, 'Street Fighter 2', 'Patrick', 'Megadrive', 10, 2, 'Le célèbre jeu de combat !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(27, 'Gundam Battle Assault 2', 'Florent', 'PS', 29, 1, 'Jeu japonais dont le gameplay est un peu limité. Peu de robots malheureusement', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(28, 'Spider-Man', 'Florent', 'Megadrive', 15, 1, 'Vivez l\'aventure de l\'homme araignée', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(29, 'Midtown Madness 3', 'Michel', 'Xbox', 59, 6, 'Dans la suite des autres versions de Midtown Madness', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(30, 'Tetris', 'Florent', 'Gameboy', 5, 1, 'Qui ne connait pas ? ', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(31, 'The Rocketeer', 'Michel', 'NES', 2, 1, 'Un super un film et un jeu de m*rde ...', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(32, 'Pro Evolution Soccer 3', 'Patrick', 'PS2', 59, 2, 'Un petit jeu de foot sur PS2', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(33, 'Ice Hockey', 'Michel', 'NES', 7, 2, 'Jamais joué mais a mon avis ca parle de hockey sur glace ... =)', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(34, 'Sydney 2000', 'Florent', 'Dreamcast', 15, 2, 'Les JO de Sydney dans votre salon !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(35, 'NBA 2k', 'Patrick', 'Dreamcast', 12, 2, 'A votre avis :p ?', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(36, 'Aliens Versus Predator : Extinction', 'Michel', 'PS2', 20, 2, 'Un shoot\'em up pour pc', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(37, 'Crazy Taxi', 'Florent', 'Dreamcast', 11, 1, 'Conduite de taxi en folie !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(38, 'Le Maillon Faible', 'Mathieu', 'PS2', 10, 1, 'Le jeu de l\'émission', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(39, 'FIFA 64', 'Michel', 'Nintendo 64', 25, 2, 'Le premier jeu de foot sur la N64 =) !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(40, 'Qui Veut Gagner Des Millions', 'Florent', 'PS2', 10, 1, 'Le jeu de l\'émission', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(41, 'Monopoly', 'Sebastien', 'Nintendo 64', 21, 4, 'Bheuuu le monopoly sur N64 !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(42, 'Taxi 3', 'Corentin', 'PS2', 19, 4, 'Un jeu de voiture sur le film', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(43, 'Indiana Jones Et Le Tombeau De L\'Empereur', 'Florent', 'PS2', 25, 1, 'Notre aventurier préféré est de retour !!!', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(44, 'F-ZERO', 'Mathieu', 'GBA', 25, 4, 'Un super jeu de course futuriste !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(45, 'Harry Potter Et La Chambre Des Secrets', 'Mathieu', 'Xbox', 30, 1, 'Abracadabra !! Le célebre magicien est de retour !', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(46, 'Half-Life', 'Corentin', 'PC', 15, 32, 'L\'autre meilleur jeu de tout les temps (surtout ses mods).', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(47, 'Myst III Exile', 'Sébastien', 'Xbox', 49, 1, 'Un jeu de réflexion', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(48, 'Wario World', 'Sebastien', 'Gamecube', 40, 4, 'Wario vs Mario ! Qui gagnera ! ?', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(49, 'Rollercoaster Tycoon', 'Florent', 'Xbox', 29, 1, 'Jeu de gestion d\'un parc d\'attraction', '2020-11-19 10:24:00', '2020-11-19 10:24:00'),
(50, 'Splinter Cell', 'Patrick', 'Xbox', 53, 1, 'Jeu magnifique !', '2020-11-19 10:24:00', '2020-11-19 10:24:00');

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

DROP TABLE IF EXISTS `localisation`;
CREATE TABLE IF NOT EXISTS `localisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `localisation`
--

INSERT INTO `localisation` (`id`, `nom`) VALUES
(1, 'Entrée du Donjon');

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

DROP TABLE IF EXISTS `personnage`;
CREATE TABLE IF NOT EXISTS `personnage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_classe` int(11) DEFAULT NULL,
  `strength` int(11) NOT NULL,
  `vigueur` int(11) NOT NULL,
  `max_degats` int(11) NOT NULL,
  `id_localisation` int(11) NOT NULL DEFAULT '1',
  `experience` int(11) NOT NULL DEFAULT '0',
  `degats` int(11) NOT NULL DEFAULT '0',
  `id_arme` int(11) NOT NULL DEFAULT '1',
  `bonus_degats` int(11) NOT NULL,
  `mana` int(11) NOT NULL,
  `furie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personnage`
--

INSERT INTO `personnage` (`id`, `uniqueid`, `nom`, `id_classe`, `strength`, `vigueur`, `max_degats`, `id_localisation`, `experience`, `degats`, `id_arme`, `bonus_degats`, `mana`, `furie`) VALUES
(1, '1605798293Aladin', 'Aladin', 1, 39, 39, 104, 1, 0, 0, 2, 39, 35, 20),
(2, '1605800515Rugor', 'Rugor', 1, 34, 34, 156, 1, 0, 0, 3, 7, 20, 17),
(3, '1605801070Cold WInter', 'Cold WInter', 1, 33, 33, 115, 1, 0, 0, 4, 7, 29, 17),
(4, '1605801121Adams', 'Adams', 1, 27, 27, 157, 1, 0, 0, 4, 6, 28, 14),
(5, '1605802130Herbert', 'Herbert', 2, 23, 23, 194, 1, 0, 0, 2, 5, 15, 12),
(6, '1605802614Micha', 'Micha', 3, 39, 39, 163, 1, 0, 0, 5, 8, 12, 20),
(7, '1605859662Rudolf', 'Rudolf', 3, 37, 37, 152, 1, 0, 0, 6, 8, 30, 19);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
