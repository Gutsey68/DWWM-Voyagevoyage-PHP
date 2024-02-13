-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 13 fév. 2024 à 14:27
-- Version du serveur : 5.7.44
-- Version de PHP : 8.1.27

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
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `cat_id` int(11) NOT NULL COMMENT 'Identifiant de la categorie',
  `cat_lib` varchar(255) NOT NULL COMMENT 'Nom de la categorie',
  `cat_parent` int(11) DEFAULT NULL COMMENT 'Catégorie parente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`cat_id`, `cat_lib`, `cat_parent`) VALUES
(1, 'Escapade Urbaine', 2),
(2, 'Histoire et Culture', NULL),
(3, 'Aventure et Découverte', NULL),
(4, 'Fusion Culturelle', NULL),
(5, 'Spiritualité et Religion', NULL),
(6, 'Photographie et Créativité', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_utrip`
--

CREATE TABLE `categorie_utrip` (
  `cat_utrip_id` int(11) NOT NULL COMMENT 'Numéro de l''association catégorie utrip',
  `cat_utrip_utrip_id` int(11) NOT NULL COMMENT 'Identifiant de récit de voyage',
  `cat_utrip_cat_id` int(11) NOT NULL COMMENT 'Identifiant de la categorie'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie_utrip`
--

INSERT INTO `categorie_utrip` (`cat_utrip_id`, `cat_utrip_utrip_id`, `cat_utrip_cat_id`) VALUES
(1, 2, 1),
(3, 5, 3),
(4, 5, 5),
(5, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL COMMENT 'Identifiant de la ville',
  `city_name` varchar(255) NOT NULL COMMENT 'Nom de la ville',
  `city_country_id` int(11) NOT NULL COMMENT 'Pays de la ville'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `city_country_id`) VALUES
(2, 'Istanbul', 3),
(3, 'Moscou', 2),
(4, 'Marrakech', 4),
(5, 'New-york', 5),
(6, 'Varanasi', 6),
(8, 'Colmar', 7);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL COMMENT 'Numéro de l''association entre utrip et user',
  `com_content` text NOT NULL COMMENT 'Contenu du commentaire',
  `com_date` datetime NOT NULL COMMENT 'Date de publication du commentaire',
  `com_image` varchar(50) DEFAULT NULL COMMENT 'Image accompagnant le commentaire',
  `com_user_id` int(11) NOT NULL COMMENT 'Utilisateur qui a commenté',
  `com_utrip_id` int(11) NOT NULL COMMENT 'Récit de voyage sur lequel il a commenté'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`com_id`, `com_content`, `com_date`, `com_image`, `com_user_id`, `com_utrip_id`) VALUES
(1, 'portez ce vieux whisky au juge blond qui fume\r\nthe quick brown fox jumps over the lazy dog', '2024-01-19 13:28:58', NULL, 1, 4),
(2, 'Salut, comment vas tu acoubidou ?\r\nAs tu manger du couscous ? Lol \r\nallez c\'est l\'heure du kawa ^^', '2024-01-19 14:32:28', NULL, 2, 3),
(3, 'Trop cool ça me donne envie de découvrir ;)', '2024-01-19 13:32:37', NULL, 3, 2),
(4, 'Salut combien de mcdo as tu vu ?', '2024-01-19 13:33:56', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL COMMENT 'Identifiant du contact (formulaire)',
  `contact_mail` varchar(100) NOT NULL COMMENT 'Adresse e-mail du contact',
  `contact_name` varchar(255) NOT NULL COMMENT 'Nom du contact',
  `contact_title` varchar(255) DEFAULT NULL COMMENT 'Objet du contact',
  `contact_content` text NOT NULL COMMENT 'Contenu du message',
  `contact_date` datetime NOT NULL COMMENT 'Date du message',
  `contact_user_id` int(11) NOT NULL COMMENT 'Utilisateur qui reçoit le message'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_mail`, `contact_name`, `contact_title`, `contact_content`, `contact_date`, `contact_user_id`) VALUES
(1, 'client@exemple.fr', 'bebette', 'Message pour Kerim', 'Salut je suis une fille', '2024-01-19 13:21:55', 2);

-- --------------------------------------------------------

--
-- Structure de la table `continent`
--

CREATE TABLE `continent` (
  `cont_id` int(11) NOT NULL COMMENT 'Identifiant du continent',
  `cont_name` varchar(255) NOT NULL COMMENT 'Nom du continent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `continent`
--

INSERT INTO `continent` (`cont_id`, `cont_name`) VALUES
(1, 'Asie'),
(2, 'Europe'),
(3, 'Amerique du nord'),
(4, 'Afrique');

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL COMMENT 'Identifiant du pays',
  `country_name` varchar(255) NOT NULL COMMENT 'Nom du pays',
  `country_cont_id` int(11) NOT NULL COMMENT 'Continent du pays'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `country_cont_id`) VALUES
(2, 'Russie', 1),
(3, 'Turquie', 2),
(4, 'Maroc', 4),
(5, 'USA', 3),
(6, 'Inde', 1),
(7, 'France', 2);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `img_id` int(11) NOT NULL COMMENT 'Identifian de la image',
  `img_name` varchar(50) NOT NULL COMMENT 'Nom de l''image',
  `img_description` varchar(255) DEFAULT NULL COMMENT 'Description de l''image',
  `img_link` varchar(50) NOT NULL COMMENT 'Lien de l''image',
  `img_utrip_id` int(11) NOT NULL COMMENT 'Récit de voyage qui contient l''image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`img_id`, `img_name`, `img_description`, `img_link`, `img_utrip_id`) VALUES
(1, 'Statue de la liberté', 'Vue du ciel', 'newyork.jpg', 1),
(2, 'photo2moscou', 'test', 'moscou.jpg', 2),
(3, '', 'belle img wlh', 'marrakech.jpg', 3),
(4, 'testtt', 'test', 'istenboule.jpg', 4),
(5, 'varanasi', 'belle photo de varanasi', 'varanasi.jpg', 5),
(6, 'LE QG', 'Lieu rempli d\'histoire', 'qg.jpg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `is_located`
--

CREATE TABLE `is_located` (
  `loc_id` int(11) NOT NULL COMMENT 'Numéro de l''association utrip-city',
  `loc_city_id` int(11) NOT NULL COMMENT 'Identifiant de la ville',
  `loc_utrip_id` int(11) NOT NULL COMMENT 'Identifiant de utrip'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `is_located`
--

INSERT INTO `is_located` (`loc_id`, `loc_city_id`, `loc_utrip_id`) VALUES
(1, 3, 2),
(2, 5, 1),
(3, 4, 3),
(5, 2, 4),
(6, 6, 5),
(7, 8, 6);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL COMMENT 'Numéro de l''association entre utrip et user',
  `like_date` datetime NOT NULL COMMENT 'Date du like',
  `like_user_id` int(11) NOT NULL COMMENT 'User qui a réagit',
  `like_utrip_id` int(11) NOT NULL COMMENT 'Récit du voyage qui a une réaction'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`like_id`, `like_date`, `like_user_id`, `like_utrip_id`) VALUES
(1, '2024-01-19 14:09:44', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL COMMENT 'Identifiant du role',
  `role_name` varchar(50) NOT NULL COMMENT 'Nom du role'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'administrator'),
(2, 'moderator'),
(3, 'regestered user'),
(4, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `topic_id` int(11) NOT NULL COMMENT 'Identifiant du topic',
  `topic_title` varchar(255) NOT NULL COMMENT 'Titre du topic',
  `topic_content` text NOT NULL COMMENT 'Contenu du topic',
  `topic_date` datetime NOT NULL COMMENT 'Date de publication du topic',
  `topic_code` varchar(255) NOT NULL COMMENT 'Code de la conversation',
  `topic_user_id` int(11) NOT NULL COMMENT 'Créareur du topic'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`topic_id`, `topic_title`, `topic_content`, `topic_date`, `topic_code`, `topic_user_id`) VALUES
(1, 'L\'Antarctique', 'J\'aimerais allé en Antarctique, quel agence de voyage me conseillez vous ? Et est ce qu\'il fera froid ? Et est ce qu\'on verra des pingouins ?', '2024-01-19 13:35:11', 'mars2304agaga', 4),
(2, 'Les états unis', 'Hi, I wanted to go to the united states but I am pretty confused about the weather there, infact I have heard that there is very very cold and one more thing is it possible to rent a house for a month with tourist visa?? Thank you', '2024-01-19 13:40:16', 'mars2134agaga', 1),
(3, 'Coins a l\'abris des regards porto', 'coucou savez vous ou ne pas être déranger a porto ? ^^\r\nLol pas besoin de vous faire un dessin ;))', '2024-01-19 13:59:38', 'mars8546agaga', 2),
(4, 'Des idées de voyage pour janvier ', 'Il fait trop froid j\'ai besoin de soleil :(((((((', '2024-01-19 14:01:45', 'mars2525agaga', 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'Identifiant de la utilisateur',
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
  `user_role_id` int(11) NOT NULL COMMENT 'Role de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_firstname`, `user_pseudo`, `user_email`, `user_password`, `user_phone`, `user_regisdate`, `user_pp`, `user_ban`, `user_bio`, `user_role_id`) VALUES
(1, 'HOTAK', 'Muhammad Shahid', 'HOTAK', 'me911kkhan@gmail.com', 'sqaan@123', '0782880866', '2024-01-19 10:23:07', 'profil_pic_default', 0, 'bla bla bla bla vas-y. Je suis shahid et j\'aime les voyages et le code !', 3),
(2, 'DEMIR', 'Kerim', 'Kerimo68', 'Kerim.demir6838@gmail.com', 'azerty123*', '0652428289', '2024-01-19 10:29:03', 'profil_pic_default', 0, 'Coucou les filles c\'est Kerim ^^\r\nAjoutez moi on peut prévoir des voyages ensemble :3', 3),
(3, 'SEYZERIAT--MEYER', 'Gauthier', 'Guts68', 'gseyzeriat1@gmail.com', '1234', '0788486497', '2024-01-19 10:31:38', 'profil_pic_default', 0, 'Toujours à la recherche de nouvelles aventures', 2),
(4, 'ACHBANI', 'Sami', 'acoubidou', 'sami.achbani@ccicampus.fr', 'azerty123456', '0782858468', '2024-01-19 10:33:38', 'profil_pic_default', 0, 'Vive les voitures et le voyage\r\n\r\n\r\nRoad trip lover (en dodge)', 1),
(5, 'Rochbach', 'Ludovic', 'Ludo', 'ludo68@hotmail.fr', 'azertyuiop', '0389805362', '2024-02-04 09:37:17', '', 0, 'yo c\'est ludo', 4);

-- --------------------------------------------------------

--
-- Structure de la table `utrip`
--

CREATE TABLE `utrip` (
  `utrip_id` int(11) NOT NULL COMMENT 'Identifiant de récit e voyage',
  `utrip_name` varchar(255) NOT NULL COMMENT 'Titre du récit de voyage',
  `utrip_description` text NOT NULL COMMENT 'Contenu du récit de voyage',
  `utrip_budget` int(11) DEFAULT NULL COMMENT 'Budget estimé du voyage',
  `utrip_date` datetime NOT NULL COMMENT 'Date de publication du récit de voyage',
  `utrip_user_id` int(11) NOT NULL COMMENT 'Identifiant de l''utilisateur (auteur du récit)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utrip`
--

INSERT INTO `utrip` (`utrip_id`, `utrip_name`, `utrip_description`, `utrip_budget`, `utrip_date`, `utrip_user_id`) VALUES
(1, 'La Grosse Pomme en un Week-end : Expédition à New York', 'Bienvenue dans le cœur battant de la ville qui ne dort jamais - New York! Dans cet article, je vais partager avec vous comment vivre une expérience inoubliable en seulement trois jours dans cette métropole éblouissante. De la traversée du pont de Brooklyn au lever du soleil, à la découverte des délices culinaires de Chinatown et Little Italy, chaque moment est une aventure. Explorez Central Park en vélo, admirez les œuvres d\'art au MoMA, et ne manquez pas une comédie musicale à Broadway. Le budget de 1500 USD couvrira vos dépenses pour la nourriture, les visites touristiques et l\'hébergement confortable. Préparez-vous pour une escapade urbaine qui restera gravée dans votre mémoire!', 1500, '2024-01-19 10:39:51', 3),
(2, 'Mystères et Splendeurs de Moscou', 'Moscou, une ville où l\'histoire ancienne se mêle à l\'opulence moderne. Cet article vous emmène dans un voyage à travers les rues pavées et les places majestueuses de la capitale russe. Découvrez le Kremlin et la Place Rouge, flânez dans le parc Gorki, et émerveillez-vous devant les chefs-d\'œuvre du Tretyakov. Sans oublier les spectacles de ballet au Bolchoï. Un budget de 1000 EUR suffira pour explorer les richesses de Moscou tout en profitant d\'un hébergement agréable et d\'une cuisine locale exquise.', 3000, '2024-01-19 10:40:51', 1),
(3, 'Charme et Histoire : Une Odyssée à Marrakech', 'Plongez dans l\'exotisme de Marrakech, un mélange de culture, d\'histoire et de couleurs vibrantes. Cet article vous guide à travers les souks animés, les jardins luxuriants comme le Jardin Majorelle, et les palais historiques comme le Palais Bahia. Savourez la cuisine marocaine authentique, détendez-vous dans un hammam traditionnel et vivez l\'hospitalité légendaire des riads locaux. Avec un budget de 800 EUR, Marrakech promet une aventure inoubliable, pleine de découvertes et de détente.', 800, '2024-01-19 10:41:35', 4),
(4, 'Istanbul : Où l\'Orient Rencontre l\'Occident', 'Istanbul, une ville unique, s\'étendant sur deux continents. Cet article vous emmène dans un voyage à travers ses bazars colorés, ses mosquées impressionnantes et ses points de vue magnifiques sur le Bosphore. Visitez la basilique Sainte-Sophie, explorez le palais de Topkapi et goûtez aux délices culinaires turcs. Avec un budget de 1100 EUR, Istanbul offre une expérience riche en culture, en histoire et en saveurs, un mélange parfait de l\'orient et de l\'occident.', 1100, '2024-01-19 10:42:42', 2),
(5, 'Sur les routes d\'Inde : Aventure et spiritualité à Varanasi', 'L\'Inde, avec sa diversité époustouflante, offre une multitude d\'expériences uniques aux voyageurs en quête d\'aventure, de culture, et de spiritualité. Parmi ses joyaux, la ville de Varanasi se dresse comme une destination incontournable. Connue pour être l\'une des plus anciennes villes habitées au monde, Varanasi (également appelée Bénarès) est un mélange vibrant de chaos, de couleurs, de spiritualité et de tradition, située au bord du fleuve sacré Gange, dans le nord de l\'Inde.\r\n\r\nL\'expérience Varanasi : Entre sacré et quotidien\r\n\r\nVaranasi est le cœur battant de la spiritualité hindoue, un lieu où le divin et le terrestre se rencontrent dans un spectacle quotidien. La ville est célèbre pour ses Ghats, ces séries d\'escaliers menant au fleuve, où se déroulent les rituels de vie et de mort. Assister à l\'Aarti du Gange au coucher du soleil, une cérémonie de prières exécutée avec des lampes à huile, est une expérience transcendante, où la musique, les chants, et les danses s\'entremêlent dans une ambiance empreinte de dévotion et de mystère.\r\n\r\nExplorer l\'âme de Varanasi\r\n\r\nLa visite de Varanasi ne se limite pas à ses Ghats et temples. Se perdre dans les ruelles étroites de la vieille ville est une aventure en soi. Chaque coin de rue révèle une surprise : un marché coloré, un atelier de tissage de soie (Varanasi est renommée pour sa soie), ou encore un petit temple oublié. La cuisine de rue est un autre aspect à ne pas manquer, offrant une occasion unique de goûter aux saveurs locales authentiques, comme le chaat, les samosas, ou le célèbre dessert indien, le jalebi.\r\n\r\nQuand partir ?\r\n\r\nLa meilleure période pour visiter Varanasi est de novembre à février, lorsque le climat est plus frais et agréable. Les mois d\'été sont très chauds, et la mousson (juin à septembre) peut rendre les déplacements difficiles.\r\n\r\nEn conclusion, Varanasi est plus qu\'une destination ; c\'est une immersion dans une Inde éternelle et intemporelle, où chaque moment est une leçon de vie, de mort, et de renouveau. Un voyage à Varanasi n\'est pas seulement une aventure géographique, mais aussi un voyage intérieur, offrant à ceux qui s\'y aventurent, une perspective unique sur la vie et la spiritualité. Que vous soyez en quête de tranquillité, de réponses, ou simplement d\'aventure, Varanasi saura vous accueillir et vous transformer.', 1200, '2024-02-04 09:23:56', 3),
(6, 'Chroniques d\'une Odyssée au QG : L\'aventure insoupçonnée', 'Dans le vaste univers des expéditions humaines, peu de voyages sont aussi universellement partagés, et pourtant aussi peu discutés, que l\'odyssée périodique au QG - un sanctuaire de solitude connu du commun des mortels sous le nom de \"toilettes\". Loin d\'être une simple routine, chaque visite au QG est une aventure en soi, chargée de péripéties, d\'intrigues, et parfois même de révélations.\r\n\r\nL\'appel de la nature : Une quête commence\r\n\r\nNotre histoire commence par un appel impérieux, un signal que tous les aventuriers du quotidien connaissent bien. Ce n\'est pas une suggestion, c\'est un commandement : le QG réclame votre présence. Armé de courage et parfois d\'une lecture de choix, le voyageur s\'engage sur le chemin, prêt à affronter ce qui l\'attend.\r\n\r\nLe passage vers l\'inconnu\r\n\r\nLe trajet vers le QG est souvent court, mais chargé d\'anticipation. Dans cette traversée, le moindre retard peut transformer une expédition de routine en une course désespérée contre le temps. Arrivé à destination, le rituel peut commencer. Mais attention, car le QG, dans sa sagesse infinie, n\'accueille pas deux aventures identiques.\r\n\r\nL\'art de l\'occupation : Une stratégie de survie\r\n\r\nUne fois à l\'intérieur, l\'aventurier se trouve face à un choix : comment occuper ce temps suspendu ? Certains choisissent la contemplation, d\'autres la lecture, tandis que les plus modernes naviguent sur l\'océan sans fin du divertissement numérique. Chaque choix est un fil dans la riche tapisserie de l\'expérience au QG.\r\n\r\nDes péripéties imprévues\r\n\r\nComme toute bonne aventure, une visite au QG peut réserver son lot de surprises. De la découverte tardive d\'une pénurie de papier à l\'intrusion soudaine d\'un insecte audacieux, chaque péripétie teste la résilience et l\'ingéniosité de notre héros.\r\n\r\nLe retour triomphal\r\n\r\nFinalement, après avoir surmonté tous les obstacles, notre voyageur émerge du QG, souvent plus léger et toujours plus sage. Il retourne dans le monde avec une nouvelle appréciation pour les plaisirs simples de la vie - et parfois, une urgence renouvelée pour trouver un spray désodorisant.\r\n\r\nLoin d\'être un simple lieu de passage, le QG est un théâtre où se jouent les drames humains les plus fondamentaux, un lieu de réflexion, de révélation, et oui, parfois de désespoir. Mais plus que tout, chaque voyage au QG est un rappel que, dans ce vaste et tumultueux univers, il existe un petit coin où nous pouvons tous, en toute humilité, prendre un moment pour nous-mêmes.\r\n\r\nAinsi se conclut notre odyssée au QG, cette aventure quotidienne qui, malgré sa banalité apparente, détient le pouvoir de transformer le commun en extraordinaire.', 0, '2024-02-04 09:41:48', 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_parent` (`cat_parent`);

--
-- Index pour la table `categorie_utrip`
--
ALTER TABLE `categorie_utrip`
  ADD PRIMARY KEY (`cat_utrip_id`),
  ADD KEY `cat_utrip_id_utrip_id` (`cat_utrip_utrip_id`),
  ADD KEY `cat_utrip_id_cat_id` (`cat_utrip_cat_id`);

--
-- Index pour la table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `city_country_id` (`city_country_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `com_user_id` (`com_user_id`),
  ADD KEY `com_utrip_id` (`com_utrip_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `contact_user_id` (`contact_user_id`);

--
-- Index pour la table `continent`
--
ALTER TABLE `continent`
  ADD PRIMARY KEY (`cont_id`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`),
  ADD KEY `country_cont_id` (`country_cont_id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `img_utrip_id` (`img_utrip_id`);

--
-- Index pour la table `is_located`
--
ALTER TABLE `is_located`
  ADD PRIMARY KEY (`loc_id`),
  ADD KEY `city` (`loc_city_id`),
  ADD KEY `utrip` (`loc_utrip_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `like_user_id` (`like_user_id`),
  ADD KEY `like_utrip_id` (`like_utrip_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_user_id` (`topic_user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Index pour la table `utrip`
--
ALTER TABLE `utrip`
  ADD PRIMARY KEY (`utrip_id`),
  ADD KEY `utrip_user_id` (`utrip_user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la categorie', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `categorie_utrip`
--
ALTER TABLE `categorie_utrip`
  MODIFY `cat_utrip_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numéro de l''association catégorie utrip', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la ville', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numéro de l''association entre utrip et user', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du contact (formulaire)', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `continent`
--
ALTER TABLE `continent`
  MODIFY `cont_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du continent', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du pays', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifian de la image', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `is_located`
--
ALTER TABLE `is_located`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numéro de l''association utrip-city', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numéro de l''association entre utrip et user', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du role', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du topic', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la utilisateur', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utrip`
--
ALTER TABLE `utrip`
  MODIFY `utrip_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de récit e voyage', AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_categorie_cat_parent` FOREIGN KEY (`cat_parent`) REFERENCES `categorie` (`cat_id`);

--
-- Contraintes pour la table `categorie_utrip`
--
ALTER TABLE `categorie_utrip`
  ADD CONSTRAINT `FK_categorie_utrip_cat_utrip_id_cat_id` FOREIGN KEY (`cat_utrip_cat_id`) REFERENCES `categorie` (`cat_id`),
  ADD CONSTRAINT `FK_categorie_utrip_cat_utrip_id_utrip_id` FOREIGN KEY (`cat_utrip_utrip_id`) REFERENCES `utrip` (`utrip_id`);

--
-- Contraintes pour la table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `FK_city_city_country_id` FOREIGN KEY (`city_country_id`) REFERENCES `country` (`country_id`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_comments_com_user_id` FOREIGN KEY (`com_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_comments_com_utrip_id` FOREIGN KEY (`com_utrip_id`) REFERENCES `utrip` (`utrip_id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_contact_contact_user_id` FOREIGN KEY (`contact_user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `FK_country_country_cont_id` FOREIGN KEY (`country_cont_id`) REFERENCES `continent` (`cont_id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_image_img_utrip_id` FOREIGN KEY (`img_utrip_id`) REFERENCES `utrip` (`utrip_id`);

--
-- Contraintes pour la table `is_located`
--
ALTER TABLE `is_located`
  ADD CONSTRAINT `FK_is_located_loc_city_id` FOREIGN KEY (`loc_city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `FK_is_located_loc_utrip_id` FOREIGN KEY (`loc_utrip_id`) REFERENCES `utrip` (`utrip_id`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FK_likes_like_user_id` FOREIGN KEY (`like_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_likes_like_utrip_id` FOREIGN KEY (`like_utrip_id`) REFERENCES `utrip` (`utrip_id`);

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `FK_topic_topic_user_id` FOREIGN KEY (`topic_user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_user_role_id` FOREIGN KEY (`user_role_id`) REFERENCES `role` (`role_id`);

--
-- Contraintes pour la table `utrip`
--
ALTER TABLE `utrip`
  ADD CONSTRAINT `FK_utrip_utrip_user_id` FOREIGN KEY (`utrip_user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
