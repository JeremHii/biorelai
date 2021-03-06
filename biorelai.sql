-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 18 nov. 2021 à 23:47
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `biorelai`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `code` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`code`, `libelle`) VALUES
(1, 'Fruit'),
(2, 'Légume');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `date` date NOT NULL,
  `semaine` int(11) NOT NULL,
  `facturesPDF` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `idUtilisateur`, `date`, `semaine`, `facturesPDF`) VALUES
(1, 2, '2021-10-14', 1, NULL),
(2, 3, '2021-10-16', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

CREATE TABLE `fonction` (
  `code` varchar(50) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fonction`
--

INSERT INTO `fonction` (`code`, `libelle`) VALUES
('ADH', 'Adhérent'),
('PRD', 'Producteur'),
('RES', 'Responsable');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `produit` int(11) NOT NULL,
  `commande` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`produit`, `commande`, `quantite`) VALUES
(1, 1, 1),
(1, 2, 1),
(4, 2, 10);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `descriptif` varchar(50) NOT NULL,
  `unite` varchar(50) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `descriptif`, `unite`, `id_utilisateur`, `categorie`) VALUES
(1, 'Carotte', 'La carotte douce', 'kg', 2, 2),
(4, 'Patate', 'La patate de fou', 'kg', 2, 2),
(7, 'Fraise', 'Les fraises sucrées', 'kg', 2, 1),
(8, 'Banane', '', 'kg', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `semaine`
--

CREATE TABLE `semaine` (
  `numero` int(11) NOT NULL,
  `dateDebutProducteur` date NOT NULL,
  `dateFinProducteur` date NOT NULL,
  `dateFinClient` date NOT NULL,
  `datevente` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `semaine`
--

INSERT INTO `semaine` (`numero`, `dateDebutProducteur`, `dateFinProducteur`, `dateFinClient`, `datevente`) VALUES
(1, '2021-10-13', '2021-10-14', '2021-10-20', '2021-10-15'),
(2, '2021-11-18', '2021-11-22', '2021-11-26', '2021-11-22');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `descriptif` text DEFAULT NULL,
  `cp` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `fonction` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `mail`, `mdp`, `adresse`, `descriptif`, `cp`, `ville`, `nom`, `prenom`, `fonction`) VALUES
(2, 'jeremy@gmail.com', 'b2882c4cc48ae096d95e23b933930a2a', 'bordeaux', 'Producteur de pommes de terre en tout genre depuis des générations.', '33000', '', 'Delmas', 'Jeremy', 'PRD'),
(3, 'pierre@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'jen sais rien', 'Le tacos', '33000', 'pessac', 'Campmas', 'Pierre', 'ADH'),
(8, 'gui@gmail.com', '202cb962ac59075b964b07152d234b70', 'rue du desespoir', 'lamort', '33700', 'Labas', 'Grandvoinet', 'Guillaume', 'RES');

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `produit` int(11) NOT NULL,
  `semaine` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` decimal(15,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`produit`, `semaine`, `quantite`, `prix`) VALUES
(1, 1, 10, '5.000'),
(1, 2, 12, '4.000'),
(4, 1, 5, '1.000'),
(4, 2, 15, '3.000'),
(7, 2, 8, '11.500'),
(8, 2, 7, '6.000');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commande_semaine_FK` (`semaine`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`produit`,`commande`),
  ADD KEY `ligne_commande_commande0_FK` (`commande`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produit_utilisateur_FK` (`id_utilisateur`),
  ADD KEY `produit_categorie_FK` (`categorie`);

--
-- Index pour la table `semaine`
--
ALTER TABLE `semaine`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_fonction_FK` (`fonction`);

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`produit`,`semaine`),
  ADD KEY `vente_semaine0_FK` (`semaine`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `semaine`
--
ALTER TABLE `semaine`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_semaine_FK` FOREIGN KEY (`semaine`) REFERENCES `semaine` (`numero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `ligne_commande_commande0_FK` FOREIGN KEY (`commande`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ligne_commande_produit_FK` FOREIGN KEY (`produit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie_FK` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_fonction_FK` FOREIGN KEY (`fonction`) REFERENCES `fonction` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `vente_produit_FK` FOREIGN KEY (`produit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vente_semaine0_FK` FOREIGN KEY (`semaine`) REFERENCES `semaine` (`numero`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
