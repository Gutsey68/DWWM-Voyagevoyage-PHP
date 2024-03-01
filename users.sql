-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 01 mars 2024 à 10:10
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dwwmaprogjhb_voyvoy`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la utilisateur',
  `user_name` varchar(50) NOT NULL COMMENT 'Nom de l''utilisateur',
  `user_firstname` varchar(50) NOT NULL COMMENT 'Prénom de l''utilisateur',
  `user_pseudo` varchar(50) NOT NULL COMMENT 'Pseudo de l''utilisateur',
  `user_email` varchar(100) NOT NULL COMMENT 'Adresse e-mail de l''utilisateur',
  `user_password` varchar(255) NOT NULL COMMENT 'Mot de passe de l''utilisateur',
  `user_phone` varchar(10) NOT NULL COMMENT 'Numéro de téléphone',
  `user_regisdate` datetime NOT NULL COMMENT 'Date de creation de compte',
  `user_pp` varchar(50) NOT NULL COMMENT 'Photo de profile de l''utilisateur',
  `user_ban` tinyint(1) NOT NULL COMMENT 'Banissemet de la utilisateur',
  `user_bio` text COMMENT 'Bio de l''utilisateur',
  `user_role_id` int NOT NULL COMMENT 'Role de l''utilisateur',
  `user_role` enum('user','admin','modo','') NOT NULL DEFAULT 'user',
  `user_recocode` varchar(255) DEFAULT NULL,
  `user_recodate` datetime DEFAULT NULL,
  `user_recoexp` datetime DEFAULT NULL,
  `user_comment` text,
  `user_modo` int DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_recocode` (`user_recocode`),
  KEY `user_role_id` (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_firstname`, `user_pseudo`, `user_email`, `user_password`, `user_phone`, `user_regisdate`, `user_pp`, `user_ban`, `user_bio`, `user_role_id`, `user_role`, `user_recocode`, `user_recodate`, `user_recoexp`, `user_comment`, `user_modo`) VALUES
(1, 'HOTAK', 'Muhammad Shahid', 'HOTAK', 'me911kkhan@gmail.com', 'sqaan@123', '0782880866', '2024-01-19 10:23:07', 'profil_pic_default.webp', 0, 'bla bla bla bla vas-y. Je suis shahid et j\'aime les voyages et le code !', 3, 'user', NULL, NULL, NULL, NULL, NULL),
(2, 'DEMIR', 'Kerim', 'Kerimo68', 'Kerim.demir6838@gmail.com', 'azerty123*', '0652428289', '2024-01-19 10:29:03', 'profil_pic_default.webp', 0, 'Coucou les filles c\'est Kerim ^^\r\nAjoutez moi on peut prévoir des voyages ensemble :3', 3, 'user', NULL, NULL, NULL, NULL, NULL),
(3, 'SEYZERIAT--MEYER', 'Gauthier', 'Guts68', 'gseyzeriat1@gmail.com', '1234', '0788486497', '2024-01-19 10:31:38', 'profil_pic_default.webp', 0, 'Toujours à la recherche de nouvelles aventures', 2, 'user', NULL, NULL, NULL, NULL, NULL),
(4, 'ACHBANI', 'Sami', 'acoubidou', 'sami.achbani@ccicampus.fr', 'azerty123456', '0782858468', '2024-01-19 10:33:38', 'profil_pic_default.webp', 0, 'Vive les voitures et le voyage\r\n\r\n\r\nRoad trip lover (en dodge)', 1, 'user', NULL, NULL, NULL, NULL, NULL),
(5, 'Rochbach', 'Ludovic', 'Ludo', 'ludo68@hotmail.fr', 'azertyuiop', '0389805362', '2024-02-04 09:37:17', 'profil_pic_default.webp', 1, 'yo c\'est ludo', 4, 'user', NULL, NULL, NULL, 'j&#039;te ban batard', 13),
(13, 'Seyzeriat--Meyer', 'Gauthier', 'guts', 'gseyzeriat2@gmail.com', '$2y$10$meWdS3UM3FhZK/1s90c8ZuIvtp8aw7gPWv9asnESMS.g5sm3q4qCC', '', '2024-03-01 08:32:42', 'profil_pic_default.webp', 0, NULL, 3, 'modo', NULL, NULL, NULL, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_user_role_id` FOREIGN KEY (`user_role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
