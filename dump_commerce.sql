-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 17 juin 2022 à 00:15
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `commerce`
--
CREATE DATABASE IF NOT EXISTS `commerce` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `commerce`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Appareils photo'),
(2, 'Livres'),
(3, 'Enceintes'),
(4, 'Tablettes'),
(5, 'Console de jeux vidéos');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `code_post` varchar(5) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `mail`, `pass`, `tel`, `adresse`, `ville`, `code_post`, `token`) VALUES
(1, 'Bertrand', 'Alexandre', 'alexandre.bertrand@yahoo.fr', '$2y$10$96qXwKBMQNjppjlBrJNWXe5mJMuaPLHpqeT/YVNr3x3ye22IrLBXy', '0646463658', '45 Boulevard Paul Verley, Appt 67', 'Dunkerque', '59140', NULL),
(2, 'B', 'A', 'abc@gmail.com', '$2y$10$n4XO/VzctY8x7YaAhhmpNug.QN1HABBVnTzwDKmAaSFxM8Sey3Lcu', '0102030405', '1 Rue des Fleurs', 'Paris', '75001', NULL),
(6, 'Laborum ut modi aut ', 'Ea unde Nam consecte', 'hisi@mailinator.com', '$2y$10$myemN7QPeq8.0kPlh975oONcjJ2tXIM61fVVaK2UB6y1gCpjk3Lja', NULL, NULL, NULL, NULL, NULL),
(12, 'Ropec', 'Ropec', 'ropec@mailinator.com', '$2y$10$hZ70qeWbe6L9L7KQM3NyeOGfL59caXDD5Sjlboz9C4jpo1VfYPQ0O', '0344454648', 'Vel ut incidunt min', 'Ut id ad eum dolore', '60000', '$2y$10$zKXyBk00vGWkHwoJ5J75suTWyi.J54Mx7J5ZWsukwVtS/ePWVp4w.'),
(13, 'Reprehenderit nisi e', 'Esse quia veniam v', 'cehy@mailinator.com', '$2y$10$ARhEeAIRVB/C8UPAlLegKu7Fa0GNuX1LqyOzO9Pc2lgUmpo9iezOG', NULL, NULL, NULL, NULL, NULL),
(14, 'Veritatis consequatu', 'Amet nostrud conseq', 'qihodorysu@mailinator.com', '$2y$10$svjmODKc0tfRhK5cPhL/m.sBHqjhQKHliZ5gvQra2bd0ZUe6k9xu.', NULL, NULL, NULL, NULL, NULL),
(15, 'Quidem fugiat sunt p', 'Iusto officiis sunt ', 'bykojolo@mailinator.com', '$2y$10$rGFJum5/zdBp4/0.gg4HqOO61vQLpUaIyLhsG/iOuNfaL/e5R1/LS', NULL, NULL, NULL, NULL, NULL),
(16, 'Ea sint velit repe', 'Aspernatur deleniti ', 'nycuti@mailinator.com', '$2y$10$I6zW3zKp4pE7gQayVsZkFuqZYzYlX.DkZS5yVdxEHeMZ3IDNUDz66', NULL, NULL, NULL, NULL, NULL),
(17, 'Nisi excepteur aperi', 'Dolore eu cumque eaq', 'pixufa@mailinator.com', '$2y$10$KUgE8VkRv8rFm3w8hs5bau.nxurnnzpIqI1hGco6G5cYcdBeXnAri', NULL, NULL, NULL, NULL, NULL),
(18, 'Velit ullamco provid', 'Molestias laborum vo', 'getufafuhe@mailinator.com', '$2y$10$cHR05PDlMi9ESs243lrG8uYF0cu5XxsaafEmFCncifBPLSINuQ0sS', NULL, NULL, NULL, NULL, NULL),
(19, 'Ut exercitationem co', 'Porro nobis temporib', 'tezirype@mailinator.com', '$2y$10$pXIkqvmV1Fnp/isQmJW64exoXVtS908n6skaWfSXxXGuwDCiN72Cy', NULL, NULL, NULL, NULL, NULL),
(20, 'Occaecat tempor nequ', 'Dolorem dolore exerc', 'jedovajeme@mailinator.com', '$2y$10$KhIopWUxjFxB8N9lpfY3buQQODbZuUjNDy9xgSqVqFLGBJMntbWy.', NULL, NULL, NULL, NULL, NULL),
(21, 'Sehef', 'Hassan', 'nisexyp@mailinator.com', '$2y$10$EoZwF9J6JDLYPfBvZ.CyCeo8SzgeJILi2zhSf.7J41PZr4vaeEmGO', '0601020304', '18 Quai de la Loire', 'Orléans', '45628', NULL),
(22, 'Perferendis vero com', 'Unde suscipit possim', 'fyvevyzi@mailinator.com', '$2y$10$ipUhzRMcq0U3bIKDRPNgceh6UtowgDYzVDjriKcXSQ6j2eH8EUQK2', '0102030405', 'Non error praesentiu', 'Duis sed fugiat vol', '54152', NULL),
(23, 'Quia accusantium ips', 'Dolores corporis et ', 'bagel@mailinator.com', '$2y$10$psQ0jmS3a4.B217zSWjJWe0yFUBh7nsRIC3o3BPoT8S9uCExc6916', '0601020304', 'Harum quaerat enim a', 'Dolores autem dolor ', '65235', 'f117a2820063100f419f7e85d018a65a'),
(24, 'Recusandae Molestia', 'Corrupti aliquip au', 'wopig@mailinator.com', '$2y$10$j0nthZqHDk3y81P8thO.0OjBfjxKXMXwST.Z584Kvc3ZS2zt283yK', '0405060708', 'Eos quia quod et au', 'Ut corrupti minim n', '05725', '$2y$10$pQ6BUfJRGxzsFjZQacj9H.LqDySp5ME.LnVPtBSc7g1hlQkHNJXFu'),
(25, 'Ad voluptates minima', 'Eu atque adipisicing', 'hofube@mailinator.com', '$2y$10$OX9q1era3b7xaBAX3g/R7.wQbLvFsp8y1T0suxJBkfi2iGdYhlCsm', '0605030201', 'Cupidatat amet et d', 'Expedita eaque do au', '65000', '$2y$10$FpBVKPQc3WOYEz5PE6/SY./MSfieAKv165COfIJ.Q4mItnmGsXnS2'),
(26, 'Fugit est doloribu', 'Qui itaque vel atque', 'myxy@mailinator.com', '$2y$10$zxtb8LxqKwfZ69.eIlmRwegystv64r8.PNBZ.IV3VxEP0Kdzl6CXm', '0345464748', 'Magna ipsa fugiat e', 'Minus tenetur offici', '01100', '$2y$10$pCQ.DtyUX0MFNLLvu1asgemiX3V.WhnjkTAX170Ny89R5Dw8H63uW'),
(27, 'Quas do ea eaque con', 'In et enim sunt Nam ', 'disaloloru@mailinator.com', '$2y$10$UfvDAbKVHVFXnzMDbLlHqejhJxEdBLD.UFLNOLnzyCJqvPRYXJxpW', '0118548976', 'Ad dolores excepteur', 'Accusamus dolorem au', '67194', '$2y$10$JPIeJ8h/b3WVoIGDz.QBt.tvwIE8FUOy2Zts9riGXZr53E7ibbBeq');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `etat` varchar(50) NOT NULL,
  `mode` varchar(50) NOT NULL,
  `montant` float NOT NULL,
  `motifRetour` varchar(100) DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  `id_transporteur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `commande_client_FK` (`id_client`),
  KEY `commande_transporteur0_FK` (`id_transporteur`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `date`, `etat`, `mode`, `montant`, `motifRetour`, `id_client`, `id_transporteur`) VALUES
(1, '2029-04-22 12:40:55', 'Livrée', 'domicile', 1.07, NULL, 12, 1),
(2, '2029-04-22 13:26:54', 'Livrée', 'relais', 103.74, NULL, 12, 2),
(3, '2029-04-22 13:29:58', 'En préparation', 'bureau de poste', 15, NULL, 12, 1),
(4, '2029-04-22 16:32:30', 'Payée', 'domicile', 120, NULL, 12, 2),
(5, '2029-04-22 16:38:05', 'En préparation', 'relais', 75, NULL, 12, 1),
(6, '2029-04-22 16:50:59', 'Payée', 'domicile', 1860.79, NULL, 12, 2),
(7, '2022-04-29 17:39:35', 'Payée', 'relais', 0.95, NULL, 12, 2),
(8, '2022-04-29 18:54:38', 'Payée', 'relais', 95.18, NULL, 12, 2),
(9, '2022-04-29 22:19:42', 'Payée', 'point relais', 34.87, NULL, 13, 1),
(10, '2022-04-29 22:21:50', 'En préparation', 'domicile', 15, NULL, 13, 1),
(11, '2022-05-01 18:21:27', 'En préparation', 'domicile', 119.45, NULL, 19, 1),
(12, '2022-05-02 12:43:36', 'Payée', 'point relais', 15.98, NULL, 12, 2),
(13, '2022-05-02 13:29:45', 'Expédiée', 'point relais', 8.28, NULL, 12, 2),
(14, '2022-05-24 14:51:51', 'Payée', 'domicile', 1761.89, 'Produit(s) en panne ou endommagé(s)', 12, 1),
(15, '2022-05-24 15:34:40', 'En préparation', 'bureau de poste', 3267.8, NULL, 12, 1),
(16, '2022-05-25 13:21:48', 'Livrée', 'domicile', 3.17, NULL, 25, 1),
(17, '2022-05-25 15:18:17', 'Payée', 'domicile', 6323.96, NULL, 26, 1),
(18, '2022-05-25 16:46:02', 'Expédiée', 'point relais', 15.85, NULL, 12, 2),
(19, '2022-05-25 16:46:32', 'En préparation', 'bureau de poste', 1.9, NULL, 12, 1),
(20, '2022-05-25 16:49:15', 'En préparation', 'bureau de poste', 35.99, NULL, 12, 1),
(21, '2022-05-27 18:02:10', 'Payée', 'bureau de poste', 69.25, NULL, 12, 1),
(22, '2022-06-07 12:03:54', 'Retournée', 'bureau de poste', 15, 'Produit(s) en panne', 12, 1);

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

DROP TABLE IF EXISTS `details_commande`;
CREATE TABLE IF NOT EXISTS `details_commande` (
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `prix` float NOT NULL,
  `quantite` int(6) NOT NULL,
  PRIMARY KEY (`id_commande`,`id_produit`) USING BTREE,
  KEY `details_commande_produit0_FK` (`id_produit`),
  KEY `details_commande_commande_FK` (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `details_commande`
--

INSERT INTO `details_commande` (`id_commande`, `id_produit`, `prix`, `quantite`) VALUES
(1, 4, 1.07, 1),
(2, 4, 1.07, 57),
(2, 5, 0.95, 45),
(3, 1, 15, 1),
(4, 1, 15, 8),
(5, 1, 15, 5),
(6, 4, 3.17, 587),
(7, 5, 0.95, 1),
(8, 2, 12.99, 1),
(8, 3, 1.38, 1),
(8, 4, 3.17, 18),
(8, 5, 0.95, 25),
(9, 4, 3.17, 11),
(10, 1, 15, 1),
(11, 1, 15, 1),
(11, 2, 12.99, 1),
(11, 3, 1.38, 1),
(11, 4, 3.17, 1),
(11, 5, 0.95, 1),
(11, 6, 29.99, 1),
(11, 7, 35.99, 1),
(11, 8, 11.99, 1),
(11, 9, 7.99, 1),
(12, 9, 7.99, 2),
(13, 3, 1.38, 6),
(14, 5, 0.95, 1),
(14, 7, 35.99, 5),
(14, 8, 1580.99, 1),
(15, 4, 3.17, 5),
(15, 6, 29.99, 3),
(15, 8, 1580.99, 2),
(16, 4, 3.17, 1),
(17, 8, 1580.99, 4),
(18, 4, 3.17, 5),
(19, 5, 0.95, 2),
(20, 7, 35.99, 1),
(21, 11, 69.25, 1),
(22, 1, 15, 1);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`),
  KEY `employe_role_FK` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id`, `nom`, `prenom`, `mail`, `pass`, `id_role`, `token`) VALUES
(1, 'Bertrand', 'Alexandre', 'admin@mailinator.com', '$2y$10$/uzdLoWk3CkpcpSckGTUVe2TS87ot2yUAgFzV/CCpdpH2JiOe7eda', 1, '$2y$10$BOv0yGAbVk0.4Ynlq0nZzuvpxATqYjpJW/pZapzprqLXBkQ2cxxMS'),
(2, 'Commercial', 'Employé', 'commercial@gmail.com', '$2y$10$rkZO7izADpuT5YOO0ERLqe.K3YuMLYlqz3YB8UdC1sQZr9oxXHKiu', 3, '$2y$10$3/Lspw3A5r/6fhEb68UDLuRYflu6cfDUOvLhNJMacVYFxl8AmN7t2'),
(3, 'Magasinier', 'Employé', 'magasinier@gmail.com', '$2y$10$noZhwonKLuyaqVoAGHWo4ue8gX264rIDZlNOAYWk0HLZblrz27SAy', 2, '$2y$10$6ORCyeqiS4q7hIYoVHEe6u4ipss37XrkkiBTcnXBc84q3WqydL2YK'),
(4, 'Commandes', 'Jean', 'commandes@gmail.com', '$2y$10$lx.5o5y6jLxRCxbs1r/m.up6ParrqEyyeQb/LHfaqp5hxBLZ0b3ry', 5, '$2y$10$MOTtZGB2JsNrCuFLFQQMiOtX8GC5QV5gb8OF3cbGxWnb59rl/fLtG'),
(5, 'Errache', 'Pierre', 'drh.pierre@gmail.com', '$2y$10$nRnldk9AmGC3ojYbsMWTFOG5u2tlPp3u0QzuINR5ITjejRGhYqOae', 4, '$2y$10$2ISB3WssppvrFSA7T1Hjb.R1H6HhU9PXDw00SAF3y4RvIpX0iQYIu'),
(6, 'Martin', 'Pierre', 'pierre.martin@gmail.com', '$2y$10$3JpbqE6/4oECBQX./aNCieUSdZ7yperBnGoNMfBJ.18uQf1GRAWV2', 6, '$2y$10$jtEPbdPyU1Wlub8iREkpg.7f8SVwhaoj17ZJxCHG2w53ZEk5f77FW');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `nom`, `logo`) VALUES
(1, 'Canon', '2533b4811f85ccb2bf7a04.png'),
(2, 'Nikon', '1140f1605961c4e1c0d697.png'),
(3, 'Sony', '4c7d71b55fd679f2c88f4c.png'),
(4, 'Panasonic', 'e046a68c92af1efc150560.png'),
(5, 'JBL', '2b88a4eb177d001414f59e.png'),
(6, 'Bose', '887aca564cb51f82093512.jpg'),
(7, 'Nintendo', '540f739c11abbc927101b7.png'),
(8, 'Microsoft', 'e947eeb8a1f03b4200953d.png');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `message` text NOT NULL,
  `precedent_id` int(10) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_employe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message_client_FK` (`id_client`),
  KEY `message_employe0_FK` (`id_employe`),
  KEY `message_precedant_FK` (`precedent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `type`, `date`, `message`, `precedent_id`, `id_client`, `id_employe`) VALUES
(1, 'Suggestion', NULL, 'Bonjour', NULL, 12, NULL),
(2, 'Réclamation', NULL, 'Bonjour tout le monde', NULL, 12, NULL),
(3, 'Question', NULL, 'Que vendez-vous ?', NULL, 12, NULL),
(4, 'Question', NULL, 'efrgthryj ukyujhgn eiofeofirgzrogn  fziefjzpo fzefzkfkporjg ozifzeonfz e ezfnzfzk fz fze fianeiofznez  fizefnziof,zinf z fjkz rfezflzluiefzczaada dfcvbghnjki ', NULL, 19, NULL),
(5, 'Autre', '2022-06-02 15:11:11', 'dfghjg', NULL, 12, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `ref` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `quantite` int(5) NOT NULL,
  `prix` float(7,2) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_marque` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produit_categorie_FK` (`id_categorie`),
  KEY `produit_marque0_FK` (`id_marque`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `ref`, `description`, `quantite`, `prix`, `photo`, `id_categorie`, `id_marque`) VALUES
(1, 'Appareil photo numérique compact Canon IXUS', 'CANONIXUS', 'Appareil photo numérique de type compact.\r\n20 Mpx\r\nZoom optique x8\r\nFlash\r\nÉcran LED\r\nBatterie incluse, couleur noire uniquement', 12, 119.00, 'fe95bdc3c366455797f2a8.jpg', 1, 1),
(2, 'Appareil photo compact Canon G7X', 'CANONG7X', 'Appareil photo numérique type compact modèle G7X\r\nZoom optique x8\r\nFlash rétractable\r\nModes rafales, pro, sport et nocturne\r\nCarte SD non incluse', 4, 129.99, '913c3666207a3ee8385545.jpg', 1, 1),
(3, 'Compact Sony DSC-W800', 'SONYDSCW800', 'Appareil photo compact DSC-W800\r\nZoom x5\r\nFlash intégré\r\nMode nuit\r\nRetardateur de prise de vue', 142, 185.00, '0282fce1071f5edd5d9afc.jpg', 1, 3),
(4, 'Reflex Nikon D780', 'NIKOND780', 'Appareil photo reflex Nikon D780 vendu avec objectif', 54, 654.17, 'c6e9a450564eb50d18dbe5.jpeg', 1, 2),
(5, 'Appareil photo bridge Panasonic Lumix', 'PANALUMIX', 'Appareil photo numérique de type bridge, marque Panasonic modèle Lumix. Zoom x60', 14, 317.00, '18ead3e9fee3fd54db5dfc.jpg', 1, 4),
(6, 'Enceinte portative JBL cylindre', 'ENCJBLCYL', 'Enceinte bluetooth portative de forme cylindrique', 11, 59.99, '0b0031a865a2188a00d7b3.jpeg', 3, 5),
(7, 'Mini-enceinte Bose portative', 'ENCBOSE', 'Mini enceinte Bose portative compatible bluetooth', 5, 35.99, 'c1b9abf8e1b7c90e49db51.jpeg', 3, 6),
(8, 'Console XBOX One noire', 'XBOXONE', 'Console de salon Microsoft XBOX One de couleure noire, 500 Go de stockage', 17, 780.11, 'e5f3f7aab8f0ae46d4b73f.png', 5, 8),
(9, 'Tablette Microsoft Surface Pro 7', 'SURFPRO7', 'Tablette-PC Microsoft Surface Pro 7 avec clavier détachable et stylet.', 2, 1024.99, '605d44c24427066fa1f717.jpg', 4, 8),
(10, 'Console Nintendo Switch', 'NINSWITCH', 'Console de jeu Nintendo Switch. 3 modes de jeux possibles : portable, nomade et salon. 2 manettes rouge et bleu incluse. Station de connexion à la TV incluse avec câble HDMI.', 23, 356.58, 'b9e69834438ad685e5a103.jpg', 5, 2),
(11, 'Console Nintendo Switch Lite Turquoise', 'SWITCHLITE', 'Console portable Nintendo Switch Lite de couleur turquoise', 92, 245.89, '5c99d45890a5d9b8044b40.jpg', 5, 7);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `perm` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `nom`, `perm`) VALUES
(1, 'Super administrateur', '{\"Rôles\": \"oui\", \"Clients\": \"oui\", \"Marques\": \"oui\", \"Messages\": \"oui\", \"Produits\": \"oui\", \"Commandes\": \"oui\", \"Employés\": \"oui\", \"Catégories\": \"oui\", \"Transporteurs\": \"oui\"}'),
(2, 'Magasinier', '{\"Rôles\": \"non\", \"Clients\": \"non\", \"Marques\": \"oui\", \"Messages\": \"non\", \"Produits\": \"oui\", \"Commandes\": \"oui\", \"Employés\": \"non\", \"Catégories\": \"oui\", \"Transporteurs\": \"oui\"}'),
(3, 'Commercial', '{\"Rôles\": \"non\", \"Clients\": \"oui\", \"Marques\": \"oui\", \"Messages\": \"oui\", \"Produits\": \"oui\", \"Commandes\": \"non\", \"Employés\": \"non\", \"Catégories\": \"oui\", \"Transporteurs\": \"oui\"}'),
(4, 'DRH', '{\"Rôles\": \"oui\", \"Clients\": \"non\", \"Marques\": \"non\", \"Messages\": \"non\", \"Produits\": \"non\", \"Commandes\": \"non\", \"Employés\": \"oui\", \"Catégories\": \"non\", \"Transporteurs\": \"non\"}'),
(5, 'Préparateur de commandes', '{\"Rôles\": \"non\", \"Clients\": \"oui\", \"Marques\": \"non\", \"Messages\": \"non\", \"Produits\": \"non\", \"Commandes\": \"oui\", \"Employés\": \"non\", \"Catégories\": \"non\", \"Transporteurs\": \"oui\"}'),
(6, 'Rôle de test sans catégories', '{\"Rôles\": \"oui\", \"Clients\": \"non\", \"Marques\": \"oui\", \"Messages\": \"non\", \"Produits\": \"oui\", \"Commandes\": \"non\", \"Employés\": \"oui\", \"Catégories\": \"non\", \"Transporteurs\": \"non\"}'),
(7, 'Rôle de test avec catégories', '{\"Rôles\": \"non\", \"Clients\": \"non\", \"Marques\": \"non\", \"Messages\": \"non\", \"Produits\": \"oui\", \"Commandes\": \"non\", \"Employés\": \"non\", \"Catégories\": \"oui\", \"Transporteurs\": \"non\"}');

-- --------------------------------------------------------

--
-- Structure de la table `transporteur`
--

DROP TABLE IF EXISTS `transporteur`;
CREATE TABLE IF NOT EXISTS `transporteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `logo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `transporteur`
--

INSERT INTO `transporteur` (`id`, `nom`, `logo`) VALUES
(1, 'La Poste', '2dbe2844952c74e76c1186.png'),
(2, 'UPS', 'ab42c13fe13a39169ef085.png'),
(3, 'DPD', '4b769a290f9e57b6523816.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_client_FK` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `commande_transporteur0_FK` FOREIGN KEY (`id_transporteur`) REFERENCES `transporteur` (`id`);

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `details_commande_commande_FK` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `details_commande_produit0_FK` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_role_FK` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_client_FK` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `message_employe0_FK` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`id`),
  ADD CONSTRAINT `message_precedant_FK` FOREIGN KEY (`precedent_id`) REFERENCES `message` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie_FK` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `produit_marque0_FK` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
