-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 17 oct. 2021 à 19:17
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jobboard`
--

-- --------------------------------------------------------

--
-- Structure de la table `advertisements`
--

DROP TABLE IF EXISTS `advertisements`;
CREATE TABLE IF NOT EXISTS `advertisements` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `wage` int UNSIGNED DEFAULT NULL,
  `workingHours` int UNSIGNED DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `companie_id` int UNSIGNED NOT NULL,
  `img_url` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `advertisements`
--

INSERT INTO `advertisements` (`id`, `name`, `date`, `description`, `wage`, `workingHours`, `position`, `user_id`, `companie_id`, `img_url`) VALUES
(1, 'Test', NULL, 'test', 130, 35, 'CIO', '', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` mediumtext,
  `img_url` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `companies`
--

INSERT INTO `companies` (`id`, `name`, `description`, `img_url`) VALUES
(2, 'Comp2', 'This is Comp2', '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` int DEFAULT NULL,
  `companie_id` int UNSIGNED DEFAULT NULL,
  `img_url` mediumtext NOT NULL,
  `name_com` varchar(255) NOT NULL,
  `description_com` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`uid`, `name`, `password`, `phone`, `email`, `status`, `companie_id`, `img_url`, `name_com`, `description_com`) VALUES
(8, 'test', '098f6bcd4621d373cade4e832627b4f6', '0645417200', 'test@test', 1, NULL, '', '', ''),
(11, 'admin', '21232f297a57a5a743894a0e4a801fc3', '0645417200', 'enzo.brunet@epitech.eu', 1, NULL, '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
