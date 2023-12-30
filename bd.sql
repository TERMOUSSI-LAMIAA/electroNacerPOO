-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 30 déc. 2023 à 20:55
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `electronacerpoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `name` varchar(255) NOT NULL,
  `descrt` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `isHide` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`name`, `descrt`, `img`, `isHide`) VALUES
('Accessoires', 'Description d\'accessoires categorie', 'assets/catgImages/Accessoire_img1.png', 0),
('Afficheur', 'The term \"Afficheur\" typically refers to a display or visual output device. In the context of electronics and technology, an \"afficheur\" is often associated with various types of display technologies used to present information or data visually. This can include LED displays, LCD screens, OLED panels, and other visual output components.', 'assets/catgImages/Afficheur_img1.png', 0),
('Batterie', 'A battery is a device that stores energy in a chemical form and converts it into electrical energy when needed. It is composed of electrochemical cells that enable the transfer of electrons between reactive materials.', 'assets/catgImages/Batterie_img1.png', 0),
('Capteur', 'Description de la categorie Accessoire.', 'assets/catgImages/Capteur_img1.png', 0),
('Composants', 'La catégorie \"Composants Électroniques\" se réfère à une classification de produits dans le domaine de l\'électronique. Cette catégorie englobe une variété de composants individuels utilisés dans la conception, la fabrication et la maintenance de circuits électroniques.', 'assets/catgImages/composant_img1.png', 0),
('Diode', 'The \"Diode\" category encompasses a variety of fundamental electronic components used in electronic circuits. A diode is a semiconductor device that allows the passage of electric current in one direction while blocking it in the opposite direction.', 'assets/catgImages/Diode_img1.png', 0),
('Robot', 'The \"Robots\" category offers a variety of intelligent mechanical creations designed to simplify daily life, stimulate curiosity, and push the boundaries of innovation. These robots, ranging from educational toys to sophisticated automatons.', 'assets/catgImages/Robot_img1.png', 0);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`full_name`, `username`, `email`, `password`, `adresse`, `ville`, `phone`) VALUES
('Jalal Jalil', 'jalal2005', 'jalal@gmail.com', '$2y$10$nes5apdFHUJoIkMrvww.COKPbKxBufzNGo0i7KT64KUgNAzkFVznW', '01 Safi Maroc', 'Safi', '+21242653022'),
('Othmane Laksoumi', 'laksoumi99', 'laksoumi.ot@gmail.com', '123456', '01 safi maroc', 'Safi', '+212642653021'),
('Ahmed lali', 'lali2001', 'ahmed@gmail.com', '123456789', '01 Safi Maroc', 'Safi', '+212642653020'),
('fullname71', 'us1', 'email@gmil.com', 'passss1', 'adr1', 'vil1', '0652124587');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `command_id` int(11) NOT NULL,
  `client_username` varchar(255) NOT NULL,
  `createDate` datetime NOT NULL DEFAULT current_timestamp(),
  `envoiDate` date NOT NULL DEFAULT current_timestamp(),
  `livraisonDate` date NOT NULL DEFAULT current_timestamp(),
  `totalPrice` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `linecommand`
--

CREATE TABLE `linecommand` (
  `command_id` int(11) NOT NULL,
  `product_ref` int(5) UNSIGNED ZEROFILL NOT NULL,
  `qnt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `client_username` varchar(255) NOT NULL,
  `product_ref` int(5) UNSIGNED ZEROFILL NOT NULL,
  `qnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`client_username`, `product_ref`, `qnt`) VALUES
('jalal2005', 00001, 7),
('jalal2005', 00002, 1),
('jalal2005', 00004, 4),
('laksoumi99', 00001, 7);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `reference` int(5) UNSIGNED ZEROFILL NOT NULL,
  `etiquette` varchar(50) NOT NULL,
  `descpt` text NOT NULL,
  `codeBarres` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `prixAchat` decimal(5,2) NOT NULL,
  `prixFinal` decimal(5,2) NOT NULL,
  `prixOffre` decimal(5,2) NOT NULL,
  `qntMin` int(11) NOT NULL,
  `qntStock` int(11) NOT NULL,
  `catg` varchar(255) NOT NULL,
  `isHide` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`reference`, `etiquette`, `descpt`, `codeBarres`, `img`, `prixAchat`, `prixFinal`, `prixOffre`, `qntMin`, `qntStock`, `catg`, `isHide`) VALUES
(00001, 'Afficheur Oled 0.91 I2C pour Arduino', 'Module afficheur monochrome OLED 0,91” 128 x 32 pixels basé sur un circuit SSD1306. Ce module communique avec un microcontrôleur de type Arduino ou compatible via le bus I2C.', 'aff00004', 'assets/images/Afficheur_img4.png', 30.00, 50.00, 40.00, 55, 75, 'Afficheur', 0),
(00002, 'Afficheur TFT LCD TACTILE 3.5', 'Afficheur TFT LCD TACTILE 3.5 pour Raspberry Pi.', 'aff00005', 'assets/images/Afficheur_img5.png', 200.00, 285.00, 285.00, 60, 57, 'Afficheur', 0),
(00003, 'Capteur Optical Reflection', 'Capteur Optical Reflection TCRT5000 pour Arduino.', 'composant000002', 'assets/images/composant_img2.png', 6.50, 10.00, 10.00, 80, 88, 'Composants', 0),
(00004, 'bouton poussoire', 'Poussoir subminiature à faible course pour circuit imprimé.', 'composant00001', 'assets/images/composant_img1.png', 1.50, 3.00, 3.00, 100, 98, 'Composants', 0),
(00006, 'Afficheur LCD 1602', 'Afficheur économique alphanumérique 2 x 16 caractères avec rétroéclairage bleu.', 'aff00001', 'assets/images/Afficheur_img1.png', 25.00, 35.00, 35.00, 40, 33, 'Afficheur', 0),
(00007, 'Afficheur 9 Segment cathode commun 3 bits', 'Afficheur 7 Segment cathode commun 3 bits', 'aff00002', 'assets/images/Afficheur_img2.png', 15.00, 25.00, 25.00, 20, 31, 'Afficheur', 0),
(00010, 'Kit bras Robotique Arduino', 'Kit de bras robotique idéal pour les étudiants, les collégiens, les amateurs de bricolage, etc.', 'robot00001', 'assets/images/Robot_img1.png', 350.00, 489.00, 489.00, 5, 7, 'Robot', 0),
(00011, 'Robot– Téléguide Bluetooth', 'Kit de bras robotique idéal pour les étudiants, les collégiens, les amateurs de bricolage, etc.', 'robot00002', 'assets/images/Robot_img2.png', 490.00, 649.00, 649.00, 3, 5, 'Robot', 0),
(00012, 'Diode 1N40001', '0.5', 'diode000001', 'assets/images/Diode_img1.png', 0.20, 0.50, 0.50, 500, 700, 'Diode', 0),
(00013, 'diode zener', 'diode zener', 'diode000002', 'assets/images/Diode_img2.png', 0.50, 0.50, 0.50, 500, 499, 'Diode', 0),
(00015, 'Module Charge Décharge 3.7V 9V 5V 2AA', 'Tension d’entrée: DC4.5-8V, Tension de sortie: 4.3-27V ((boost rotatif dans le sens antihoraire du positionneur).', 'batterie000001', 'assets/images/Batterie_img1.png', 30.00, 55.00, 50.00, 50, 73, 'Batterie', 0),
(00021, 'Pile lithium rechargeable 18650 3.7V', 'Batterie lithium rechargeable 18650 3.7V', 'batterie000002', 'assets/images/Batterie_img2.png', 17.00, 30.00, 30.00, 50, 53, 'Batterie', 0),
(00023, 'support pour 1 piles 18650', 'support pour 1 piles 18650', 'batterie000003', 'assets/images/Batterie_img3.png', 13.00, 20.00, 20.00, 50, 59, 'Batterie', 0),
(00025, 'Capteur effet Hall', 'Capteur effet Hall Pour Arduino KY-024', 'capteur000001', 'assets/images/Capteur_img1.png', 19.00, 30.00, 30.00, 80, 84, 'Capteur', 0),
(00026, 'Carte mémoire 16 GB Class 10', 'Carte mémoire 16 GB Class 10.', 'acc000001', 'assets/images/Accessoire_img1.png', 80.00, 110.00, 120.00, 400, 410, 'Accessoires', 0),
(00029, 'Carte mémoire 32 GB Class 10', 'Carte mémoire 32 GB Class 10.', 'acc000002', 'assets/images/Accessoire_img2.png', 115.00, 150.00, 150.00, 400, 388, 'Accessoires', 0),
(00041, 'produit1', 'desc1', '8565265', 'img1/', 200.00, 400.00, 300.00, 5, 90, 'Robot', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`email`, `username`, `pass`, `state`, `role`) VALUES
('a@a.a', 'Ahmed_89', '0123456', 1, 0),
('b@b.b', 'hamza45', '123456789', 1, 0),
('c@c.com', 'Hassan885', '147852', 1, 0),
('ddd@ds.k', 'laksoumi', '144', 0, 0),
('e@e.com', 'emad', '00123', 1, 0),
('email@', 'user1111', 'pas1', 1, 0),
('hamid@gmail.com', 'hamid445', 'hamid', 0, 0),
('khalid@gmail.youcode', 'khalidd', 'khalid', 1, 1),
('laksoumi.ot@gmail.com', 'laksoumi99', '$2y$10$nes5apdFHUJoIkMrvww.COKPbKxBufzNGo0i7KT64KUgNAzkFVznW', 1, 1),
('sslaksoumi@gmail.com', 'Othmane99', '123456789//', 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`name`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`username`,`email`,`password`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`command_id`),
  ADD KEY `fk_client` (`client_username`);

--
-- Index pour la table `linecommand`
--
ALTER TABLE `linecommand`
  ADD PRIMARY KEY (`command_id`,`product_ref`),
  ADD KEY `fk_product_ref` (`product_ref`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`client_username`,`product_ref`),
  ADD KEY `panier_product_fk` (`product_ref`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`reference`,`codeBarres`),
  ADD UNIQUE KEY `etiquette` (`etiquette`),
  ADD UNIQUE KEY `img` (`img`),
  ADD KEY `fk_catg` (`catg`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `pass` (`pass`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `command_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `reference` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`client_username`) REFERENCES `clients` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `linecommand`
--
ALTER TABLE `linecommand`
  ADD CONSTRAINT `fk_command_id` FOREIGN KEY (`command_id`) REFERENCES `commande` (`command_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_ref` FOREIGN KEY (`product_ref`) REFERENCES `products` (`reference`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_clinet_fk` FOREIGN KEY (`client_username`) REFERENCES `clients` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `panier_product_fk` FOREIGN KEY (`product_ref`) REFERENCES `products` (`reference`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_catg` FOREIGN KEY (`catg`) REFERENCES `categories` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
