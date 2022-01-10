-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 10 jan. 2022 à 21:01
-- Version du serveur :  10.5.12-MariaDB
-- Version de PHP : 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id18254786_pw_devoir`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `id_cate` int(11) DEFAULT NULL,
  `titre_art` varchar(255) DEFAULT NULL,
  `slug_art` varchar(255) NOT NULL,
  `description_art` text DEFAULT NULL,
  `lien_affiliation_art` varchar(255) DEFAULT NULL,
  `image_art` varchar(255) NOT NULL,
  `date_art` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `id_cate`, `titre_art`, `slug_art`, `description_art`, `lien_affiliation_art`, `image_art`, `date_art`) VALUES
(1, 1, 'Casque Bluetooth Soundcore', 'casque-bluetooth-soundcore', 'Un Son Incroyable qui a Déjà Conquis Plus de 20 Millions de Personnes\r\nMusique Haute Résolution : Entendez chaque détail de vos chansons préférées', 'https://amzn.to/3HR2JVW', './uploads/accessoir3.jpg', '2022-01-10 12:32:39'),
(2, 2, 'TECLAST F15S Ordinateur Portable', 'teclast-f15s-ordinateur-portable', 'ULTRA MINCE ET LÉGER - Seulement 1,8 kg, écran IPS Full HD 15,6 pouces, une épaisseur ultra fine', 'https://amzn.to/3HR4hiB', './uploads/pc2.jpg', '2022-01-10 15:10:28');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom_cate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom_cate`) VALUES
(1, 'Accessoires'),
(2, 'Ordinateur Portable');

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `connexion` datetime NOT NULL DEFAULT current_timestamp(),
  `deconnexion` datetime NOT NULL DEFAULT current_timestamp(),
  `adressIp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `etat` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `password`, `email`, `role`, `etat`) VALUES
(1, 'superadmin', '$2y$10$jE.ptx1/p8u02OyVw73fqOKSeWzJc9NI/Mzc/lYsym9yqT3b.HCQy', 'admin2@gmail.comnnn', '2', 1),
(2, 'admin2', '$2y$10$kdoGB.98CTlvBUb.2.S73.qgk1UXUb5v9gZP8jC1hjw5atQ6CuKai', 'cr@gmail.com', '1', 1),
(3, 'admin3', '$2y$10$8FQNIb3akrNKrNF5uYIm4O1.M0bxi49HAX9eJIqya.4yTz1Qmnxuu', 'ks@gmail.com', '1', 0),
(4, 'admin', '$2y$10$d3HhlTdX3c6lBUXzr4vQZe0LSIAH4E6pymvNx2GKdufTkIXz7LupG', 'admin@gmail.com', '2', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug_art` (`slug_art`),
  ADD KEY `id_cate` (`id_cate`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_categorie` FOREIGN KEY (`id_cate`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
