-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 31 Janvier 2016 à 23:10
-- Version du serveur :  5.6.24
-- Version de PHP :  5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db_starswar`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Laser', 'Laser', 'Arme à énergie laser', '2016-01-19 15:14:23', '0000-00-00 00:00:00'),
(2, 'Casque', 'Casque-de-protection-contre-les-armes-laser', 'Type de casque', '2016-01-26 21:24:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `commands`
--

CREATE TABLE IF NOT EXISTS `commands` (
  `id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned DEFAULT NULL,
  `price` decimal(7,2) NOT NULL,
  `nb_product` int(10) unsigned NOT NULL DEFAULT '0',
  `commanded_at` datetime NOT NULL,
  `status` enum('en_cours','payée','livrée') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en_cours',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `commands`
--

INSERT INTO `commands` (`id`, `customer_id`, `price`, `nb_product`, `commanded_at`, `status`, `created_at`, `updated_at`) VALUES
(58, 2, '2693.00', 6, '2016-01-28 18:23:45', 'en_cours', '2016-01-28 17:23:45', '2016-01-28 17:23:45'),
(59, 3, '513.00', 2, '2016-01-28 18:25:15', 'en_cours', '2016-01-28 17:25:15', '2016-01-28 17:25:15'),
(60, 3, '362.00', 5, '2016-01-29 12:48:26', 'en_cours', '2016-01-29 11:48:26', '2016-01-29 11:48:26'),
(61, 3, '3159.95', 7, '2016-01-29 14:15:21', 'livrée', '2016-01-29 20:43:15', '2016-01-29 13:15:21'),
(62, 1, '230.00', 1, '2016-01-29 17:10:53', 'en_cours', '2016-01-29 16:10:53', '2016-01-29 16:10:53'),
(63, 1, '157.00', 1, '2016-01-29 17:14:04', 'en_cours', '2016-01-29 16:14:04', '2016-01-29 16:14:04'),
(64, 1, '2195.16', 1, '2016-01-30 01:06:13', 'en_cours', '2016-01-30 00:06:13', '2016-01-30 00:06:13'),
(65, 3, '120.00', 1, '2016-01-31 22:57:09', 'en_cours', '2016-01-31 21:57:09', '2016-01-31 21:57:09');

-- --------------------------------------------------------

--
-- Structure de la table `command_details`
--

CREATE TABLE IF NOT EXISTS `command_details` (
  `id` int(10) unsigned NOT NULL,
  `command_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `command_details`
--

INSERT INTO `command_details` (`id`, `command_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(73, 58, 11, '423.00', 5, '2016-01-28 17:23:45', '2016-01-28 17:23:45'),
(74, 58, 9, '15.00', 2, '2016-01-28 17:23:45', '2016-01-28 17:23:45'),
(75, 58, 2, '58.00', 4, '2016-01-28 17:23:45', '2016-01-28 17:23:45'),
(76, 58, NULL, '10.00', 12, '2016-01-28 17:23:45', '2016-01-28 17:23:45'),
(77, 58, 16, '68.00', 2, '2016-01-28 17:23:45', '2016-01-28 17:23:45'),
(78, 58, 20, '60.00', 1, '2016-01-28 17:23:45', '2016-01-28 17:23:45'),
(79, 59, 11, '423.00', 1, '2016-01-28 17:25:15', '2016-01-28 17:25:15'),
(80, 59, 8, '15.00', 6, '2016-01-28 17:25:15', '2016-01-28 17:25:15'),
(81, 60, 2, '58.00', 1, '2016-01-29 11:48:26', '2016-01-29 11:48:26'),
(82, 60, 16, '68.00', 2, '2016-01-29 11:48:26', '2016-01-29 11:48:26'),
(83, 60, NULL, '10.00', 1, '2016-01-29 11:48:26', '2016-01-29 11:48:26'),
(84, 60, 12, '38.00', 1, '2016-01-29 11:48:26', '2016-01-29 11:48:26'),
(85, 60, 20, '60.00', 2, '2016-01-29 11:48:26', '2016-01-29 11:48:26'),
(86, 61, 17, '40.00', 1, '2016-01-29 13:15:21', '2016-01-29 13:15:21'),
(87, 61, 16, '68.00', 3, '2016-01-29 13:15:21', '2016-01-29 13:15:21'),
(88, 61, 9, '15.00', 1, '2016-01-29 13:15:21', '2016-01-29 13:15:21'),
(89, 61, 5, '23.00', 1, '2016-01-29 13:15:21', '2016-01-29 13:15:21'),
(90, 61, 2, '58.00', 1, '2016-01-29 13:15:21', '2016-01-29 13:15:21'),
(91, 61, 12, '38.00', 2, '2016-01-29 13:15:21', '2016-01-29 13:15:21'),
(92, 61, 10, '548.79', 5, '2016-01-29 13:15:21', '2016-01-29 13:15:21'),
(93, 62, 5, '23.00', 10, '2016-01-29 16:10:53', '2016-01-29 16:10:53'),
(94, 63, 19, '157.00', 1, '2016-01-29 16:14:04', '2016-01-29 16:14:04'),
(95, 64, 10, '548.79', 4, '2016-01-30 00:06:13', '2016-01-30 00:06:13'),
(96, 65, 20, '60.00', 2, '2016-01-31 21:57:09', '2016-01-31 21:57:09');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `number_card` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `number_command` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `address`, `number_card`, `number_command`, `created_at`, `updated_at`) VALUES
(1, 1, '4284 Koepp Divide\nNorth Emeryburgh, IN 86226', '8382239780743822', 8, '2016-01-30 00:06:13', '2016-01-30 00:06:13'),
(2, 2, '6340 Amy Valleys Suite 890\nWest Abigale, NM 21176', '1349928505785526', 11, '2016-01-28 17:23:45', '2016-01-28 17:23:45'),
(3, 3, '454 Brandon Inlet\nNorth Rosa, TX 24648', '1362116169286537', 4, '2016-01-31 21:57:09', '2016-01-31 21:57:09'),
(4, 4, '4077 Bednar Road\nGleichnerland, OR 74897', '3308923896741370', 0, '2016-01-22 09:28:28', '2016-01-19 15:14:23');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_30_100022_create_categories_table', 1),
('2015_12_30_104128_create_tags_table', 1),
('2015_12_30_110734_create_products_table', 1),
('2015_12_30_113920_create_pictures_table', 1),
('2015_12_30_115339_create_product_tag_table', 1),
('2015_12_30_133154_create_customers_table', 1),
('2016_01_18_161948_create_commands_table', 1),
('2016_01_18_164600_create_command_details_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('png','jpg','gif') COLLATE utf8_unicode_ci NOT NULL,
  `size` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `pictures`
--

INSERT INTO `pictures` (`id`, `product_id`, `uri`, `title`, `type`, `size`, `created_at`, `updated_at`) VALUES
(27, 17, 'casque commander.jpg', '', 'jpg', 24716, '2016-01-25 11:34:35', '2016-01-25 11:34:35'),
(28, 16, 'casque-dark-vador.jpg', '', 'jpg', 25585, '2016-01-25 11:35:32', '2016-01-25 11:35:32'),
(29, 12, 'double sabre.jpg', '', 'jpg', 32767, '2016-01-25 11:37:06', '2016-01-25 11:37:06'),
(30, 11, 'Lightsaber.jpg', '', 'jpg', 10199, '2016-01-25 11:42:58', '2016-01-25 11:42:58'),
(31, 10, 'Masque changeur de voix Captain Phasma de Star Wars.jpg', '', 'jpg', 32767, '2016-01-25 11:44:32', '2016-01-25 11:44:32'),
(32, 9, 'porte clef shubaka.jpg', '', 'jpg', 32767, '2016-01-25 11:46:20', '2016-01-25 11:46:20'),
(33, 8, 'porte-clé dark vador.jpg', '', 'jpg', 32767, '2016-01-25 11:48:56', '2016-01-25 11:48:56'),
(34, 6, 'Sabre laser de Rey.jpg', '', 'jpg', 16255, '2016-01-25 11:51:19', '2016-01-25 11:51:19'),
(35, 5, 'Sabre laser Kylo Ren.jpg', '', 'jpg', 19219, '2016-01-25 11:52:53', '2016-01-25 11:52:53'),
(36, 2, 'Sabre laser Kylo Ren2.jpg', '', 'jpg', 31894, '2016-01-25 11:54:07', '2016-01-25 11:54:07'),
(37, 20, 'sac à dos robot.jpg', '', 'jpg', 32767, '2016-01-25 11:56:41', '2016-01-25 11:56:41'),
(38, 19, 'star-wars-darth-vader-return-of-anakin-artfx-statue.jpg', '', 'jpg', 32767, '2016-01-25 11:58:12', '2016-01-25 11:58:12'),
(41, 24, 'nz4pSz1WEMVP.jpg', '', 'jpg', 32767, '2016-01-29 23:21:29', '2016-01-29 23:21:29'),
(42, 26, 'D11dYC2DjMHQ.jpg', '', 'jpg', 32767, '2016-01-30 19:22:14', '2016-01-30 19:22:14');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `abstract` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `quantity` smallint(5) unsigned NOT NULL,
  `status` enum('opened','closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'opened',
  `published_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `price`, `abstract`, `content`, `quantity`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(2, 1, 'Sabre laser Kylo Ren avec effet spéciaux', 'dr-julien-bartoletti-dvm', '58.00', 'sabre laser Kylo Ren avec effet spéciaux', 'Passez à l''action de Star Wars : Le Réveil de la Force en maniant notre sabre laser Kylo Ren avec des lames à poignée cruciforme, des lumières, des sons de mouvement, des bruits de combats et des effets de duel particuliers du mystérieux méchant', 159, 'opened', '2016-02-10 19:25:22', '2016-01-30 18:25:22', '2016-01-30 18:25:22'),
(5, 1, 'Sabre laser Kylo Ren', 'harmony-orn', '23.00', 'sabre laser Kylo Ren avec des lames à poignée cruciforme', 'Passez à l''action de Star Wars : Le Réveil de la Force en maniant notre sabre laser Kylo Ren avec des lames à poignée cruciforme, des lumières, des sons de mouvement, des bruits de combats et des effets de duel particuliers du mystérieux méchant', 80, 'opened', '2016-01-10 19:24:53', '2016-01-30 18:24:53', '2016-01-30 18:24:53'),
(6, 1, 'Sabre laser de Rey', 'sabre-laser-de-rey-star-wars-le-reveil-de-la-force', '43.00', 'Sabre laser de Rey, Star Wars : Le Réveil de la Force', '    Sabre laser factice\r\n    Reproduit à l''identique le sabre laser de Kylo Ren de Star Wars : Le Réveil de La Force \r\n    Bouton marche/arrêt\r\n    Appuyer sur le bouton pour activer\r\n    Bleu lumineux et incandescent\r\n    Son de démarrage de moteur\r\n    Manier la lame pour émettre des lumières et des sons de combats\r\n    Effets sonores contrôlés par capteur de mouvement\r\n    Inclut des instructions\r\n    L 85 cm environ\r\n    Requiert 3 piles AA, incluses\r\n    Produit adapté aux enfants âgés de 3 ans et +\r\n    Avertissement : ce produit n''est pas adapté aux enfants de moins de 36 mois en raison des petites pièces\r\n    Produit créé pour Disney Store', 50, 'closed', '2016-01-09 19:24:38', '2016-01-30 18:24:38', '2016-01-30 18:24:38'),
(7, 1, '1 ans d''abonnement à TV-StarWars', '1-ans-dabonnement-a-tv-starwars', '250.00', 'Un an d''abonnement pour voir tous ce qui existe en matière de Star Wars', 'Fantastique !\r\nUn an d''abonnement pour voir tous ce qui existe en matière de Star Wars', 10, 'opened', '2016-01-08 19:24:21', '2016-01-30 18:24:21', '2016-01-30 18:24:21'),
(8, 1, 'Porte-clé dark vador légo', 'porte-cle-dark-vador-lego', '15.00', 'Porte-clé dark vador légo de la marque LEGO', 'Petits et grands, vous pourrez maintenant emmener votre figurine LEGO partout avec vous et même éclairer, au besoin, les coins sombres.\r\n\r\nPratique et drôle, le LEGO Key Star Wars porte-clé et une petite lampe de poche en même temps.\r\n\r\nL''emblématique petite figurine LEGO a en effet deux petites lumières aux pieds. Son anneau permet d''y accrocher les clés ou d''accrocher la minifigurine au sac par exemple. Les bras, jambes et la tête de la minifigurine peuvent être bougés.\r\nLEGO Key Light\r\n\r\n* Porte-clé LEGO et petite lampe de poche intégrée\r\n* Bouton marche/arrêt sur le ventre de la figurine\r\n* Lumière (2 ampoules) aux pieds de la minifigurine\r\n* Fonctionne avec piles ( 2 x CR2025 3V) fournies\r\n* Taille de la figurine 7 cm', 325, 'opened', '2016-01-07 19:23:59', '2016-01-30 18:23:59', '2016-01-30 18:23:59'),
(9, 2, ' porte-clés Chewbacca ', 'porte-cles-chewbacca', '15.00', ' porte-clés Chewbacca Lego', 'Ajoutez une petite touche fun et geek à votre trousseau de clés grâce à ce porte-clés Chewbacca Lego !\r\n\r\nLe compagnon d''Han Solo est représenté avec sa fourrure hirsute et sa ceinture de munitions mais dans le plus pur style Lego Star Wars.\r\n\r\nEn plus il est équipé de 2 lampes LEDs sous ses pieds que vous pourrez allumer en pressant la poitrine de Chewie.\r\n\r\nIdée cadeau idéale et utile pour un(e) fan de Star Wars.\r\n\r\nCaractéristiques :\r\n\r\n \r\n\r\n- 2 Lampes LED intégrées\r\n\r\n- Bras et jambes articulés comme un Lego\r\n\r\n - Fonctionne avec 2 piles boutons CR2025 fournies\r\n\r\n- Licences officielles Lucasfilm et Lego\r\n\r\n- Dimensions : 7,7 cm x 4,4 cm x 1,3 cm', 200, 'opened', '2016-01-06 19:23:17', '2016-01-30 18:23:17', '2016-01-30 18:23:17'),
(10, 2, ' masque de Kylo Ren', 'masque-de-kylo-ren', '548.79', ' masque de Kylo Ren sous licence officielle Star Wars', 'Ce masque de Kylo Ren™ pour adulte est sous licence officielle Star Wars™. Ce masque en plastique rigide est de couleur noir et argent. De faux impacts sont réprésentés à l''arrière du casque. Un large filet est présent au niveau des yeux afin de voir facilement. Ce casque est fait en 2 parties, assemblées entre elle par des bandes de scratchs. Ce casque sera parfait pour compléter un costume de Kylo Ren lors d''une fête Star Wars. ', 150, 'opened', '2016-01-05 19:22:16', '2016-01-30 18:22:16', '2016-01-30 18:22:16'),
(11, 1, 'Sabre électronique de Kylo Ren', 'sabre-electronique-de-kylo-ren', '423.00', 'Sabre électronique de Kylo Ren', 'Le sabre électronique de Kylo Ren se déploie en un mouvement, sa lame est lumineuse et il fait le même bruit que les sabres laser ! En plus tu vas pouvoir attacher une dague à sa poignée !', 90, 'closed', '2016-01-04 19:21:52', '2016-01-30 18:21:52', '2016-01-30 18:21:52'),
(12, 1, 'Double sabre laser', 'stacy-gutkowski-phd', '38.00', 'Double sabre laser l''arme fatal', 'Passez du côté obscur de la Force avec ce sabre laser double et devenez un maître Sith comme Darth Maul ! Ce sabre reprend le style du sabre laser de Darth Maul, tiré de la saga Star Wars !\r\n\r\nCe sabre Sith est extensible (système téléscopique) et change de son à chaque frappe.\r\n\r\nTous les fans de la Saga star Wars apprécieront ce sabre laser double !', 120, 'opened', '2016-01-03 22:39:30', '2016-01-29 21:39:30', '2016-01-29 21:39:30'),
(16, 2, 'Casque dark vador', 'casque-dark-vador', '68.00', 'Casque de Dark Vador d`Edition Suprême', 'Fabriqué a partir d`une lourde injection modelée ABS, ce Casque de Dark Vador d`Edition Suprême est le l`ultime collection du film. Casque du film original Star Wars. Il peut être porté mais puisqu`il est fabrique a partir de plâtre original du casque de Star Wars, vous avez besoin de mesurer 6 pieds et 7 pouces de taille pour être en proportion! Il y a deux pièces qui sont attachées par Velcro, le casque lourd est fini en noir luisant.\r\n\r\nLa section du masque est noire mate avec des sections brillantes, des clous en métal, avec un grillage en métal noir vers le nez et la bouche. A l`intérieur, le masque est rembourré avec une mousse luxueuse pour un confort avec une lanière et une fermeture ajustables pour garder le masque en place. Un acrylique transparent est intégré pour les yeux ainsi que des fentes verticales vers la bouche pour vous permettre de respirer. Ce Casque de Dark Vador d`Edition Suprême fait une superbe addition pour un collectionneur de Star Wars.\r\n\r\nCaractéristiques:\r\n\r\nCasque de Dark Vador Edition Suprême.\r\n\r\nPlâtre original du casque du film de Star Wars,\r\n\r\nFabriqué à partir d`une lourde injection modelée ABS,\r\n\r\n2 pièces avec un attachement Velcro,\r\n\r\nYeux acryliques transparents,\r\n\r\nLanière et fermetures ajustables autour de la tête et tient le masque en sécurité,\r\n\r\nFentes verticales dans la bouche pour respirer,\r\n\r\nMousse luxueuse dans le masque pour un confort,\r\n\r\nGrille en métal et clous vers la bouche et le nez,\r\n\r\nTaille : 27 cm de haut, 34.5 cm de large, 34 cm de diamètre. ', 40, 'opened', '2016-01-02 22:38:58', '2016-01-29 21:38:58', '2016-01-29 21:38:58'),
(17, 2, 'Casque commander', 'casque-commander', '40.00', 'masque changeur de voix commander', 'Ce masque changeur de voix commander permet à tous les fans de Star Wars de commander des soldats des légions du Premier Ordre avec un ton autoritaire ! C''est un bon moyen d''entendre des phrases du film ou d''organiser ses propres missions.', 48, 'opened', '2016-01-01 22:38:40', '2016-01-29 21:38:40', '2016-01-29 21:38:40'),
(19, 1, 'statuette dark vador', 'bbbbbbbbbbb', '157.00', 'Figurine Dark Vador', '- Figurine Dark Vador\r\n\r\n- 3D\r\n\r\n- Dimension : 80 cm de hauteur\r\n\r\n- Ne convient pas aux enfants de moins d''un an \r\n\r\n\r\nRéférence du produit : 16881\r\n', 0, 'opened', '2016-01-22 12:58:12', '2016-01-25 11:58:12', '2016-01-25 11:58:12'),
(20, 1, 'Sac R2D2', 'sac-r2d2', '60.00', 'sac à dos', 'Sac du célèbre robot R2D2, effet assuré.', 50, 'opened', '2016-01-22 12:56:41', '2016-01-25 11:56:41', '2016-01-25 11:56:41'),
(24, 1, 'Poster Commander', 'poster', '10.00', '', '', 0, 'opened', '2016-01-30 00:23:08', '2016-01-29 23:23:08', '2016-01-29 23:23:08'),
(26, 2, 'Sac Dark Vador', 'sac-dark-vador', '85.00', 'Grand sac Dark Vador', 'Ce sac est spécialement conçu  pour contenir le casque Dark Vador grand modèle séduiera les fans de Dark Vador.\r\n', 100, 'opened', '2016-01-30 20:22:14', '2016-01-30 19:22:14', '2016-01-30 19:22:14'),
(31, 1, '1 ans d''abonnement à TV-StarWars', '1-ans-dabonnement-a-tv-starwars', '150.00', '', 'Fantastique !\r\nA ans à regarder tous les jours les fabuleux épisodes de la saga stars war !', 200, 'opened', '2016-01-31 17:51:50', '2016-01-31 16:51:50', '2016-01-31 16:51:50');

-- --------------------------------------------------------

--
-- Structure de la table `product_tag`
--

CREATE TABLE IF NOT EXISTS `product_tag` (
  `product_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `product_tag`
--

INSERT INTO `product_tag` (`product_id`, `tag_id`) VALUES
(2, 1),
(5, 1),
(6, 1),
(8, 1),
(11, 1),
(17, 1),
(24, 1),
(8, 2),
(10, 2),
(16, 2),
(26, 2),
(8, 3),
(24, 3),
(2, 4),
(5, 4),
(8, 4),
(11, 4),
(12, 4),
(17, 4),
(8, 5),
(16, 5),
(19, 5),
(8, 6),
(9, 6);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Laser', 'Laser', '2016-01-19 15:14:23', '0000-00-00 00:00:00'),
(2, 'Casque', 'Casque', '2016-01-19 15:14:23', '0000-00-00 00:00:00'),
(3, 'vaisseaux', 'vaisseaux', '2016-01-19 15:14:23', '0000-00-00 00:00:00'),
(4, 'Epée', 'Epée', '2016-01-19 15:14:23', '0000-00-00 00:00:00'),
(5, 'Dark Vador', 'Dark-Vador', '2016-01-19 15:14:23', '0000-00-00 00:00:00'),
(6, 'Shubaka', 'Shubaka', '2016-01-19 15:14:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('administrator','editor','author') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'editor',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'tony', 'tony@tony.fr', '$2y$10$O79b4tMuaiI.z9Xji//seuxRFAy9ZF5Da7fs3r9.o4saVl8ayssga', 'administrator', 'i3ZTmXheJ9TRz4AD4dawcIfeeryHFABYS8VngtvVfnvxQlluVfGq1JOzyFQ4', '2016-01-31 21:55:59', '2016-01-31 21:55:59'),
(2, 'yni', 'yni@yni.fr', '$2y$10$s6PMAYQC/rLLWdAfJ3EfYOix/fK5.rEOkFU7CoqFVvUAzAAmKIBxa', '', 'k5UK330ODl0hRSiqa3QQPmP6X1KeBDuYrTRIhnGx2lwMws0htnKGpiq31qGb', '2016-01-28 23:25:40', '2016-01-28 23:25:40'),
(3, 'antoine', 'antoine@antoine.fr', '$2y$10$a/Dk9Zav56QACOouJPTvjuqEhwB7NSJkGacmlTkbwxkvNHcU7bR6C', '', 'xHuEIhAJSkZc5RSuMQHwDqkiIr1DqIEqbXoWgkBpfeLdoeJd7vjjjVXk63pp', '2016-01-31 21:57:20', '2016-01-31 21:57:20'),
(4, 'laurent', 'laurent@laurent.fr', '$2y$10$dGup0BQkX8xcWPGCHUet3.MuBdlsoSX6TwySigOmeJCwzpBFVrCPa', '', NULL, '2016-01-19 15:14:23', '0000-00-00 00:00:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`id`), ADD KEY `commands_customer_id_foreign` (`customer_id`);

--
-- Index pour la table `command_details`
--
ALTER TABLE `command_details`
  ADD PRIMARY KEY (`id`), ADD KEY `command_details_command_id_foreign` (`command_id`), ADD KEY `command_details_product_id_foreign` (`product_id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `number_card` (`number_card`), ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`), ADD KEY `pictures_product_id_foreign` (`product_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`), ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Index pour la table `product_tag`
--
ALTER TABLE `product_tag`
  ADD UNIQUE KEY `product_tag_product_id_tag_id_unique` (`product_id`,`tag_id`), ADD KEY `product_tag_tag_id_foreign` (`tag_id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `commands`
--
ALTER TABLE `commands`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT pour la table `command_details`
--
ALTER TABLE `command_details`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commands`
--
ALTER TABLE `commands`
ADD CONSTRAINT `commands_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `command_details`
--
ALTER TABLE `command_details`
ADD CONSTRAINT `command_details_command_id_foreign` FOREIGN KEY (`command_id`) REFERENCES `commands` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `command_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `customers`
--
ALTER TABLE `customers`
ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pictures`
--
ALTER TABLE `pictures`
ADD CONSTRAINT `pictures_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `product_tag`
--
ALTER TABLE `product_tag`
ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
