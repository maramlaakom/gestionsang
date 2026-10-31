-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 31 oct. 2026 à 14:44
-- Version du serveur : 8.0.43-0ubuntu0.24.04.1
-- Version de PHP : 8.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_don_sang`
--

-- --------------------------------------------------------

--
-- Structure de la table `besoins`
--

CREATE TABLE `besoins` (
  `id_besoin` int NOT NULL,
  `groupe_sanguin` enum('A','B','AB','O') NOT NULL,
  `niveau_alerte` enum('NORMAL','URGENT','CRITIQUE') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `centres_collecte`
--

CREATE TABLE `centres_collecte` (
  `nom` varchar(1000) NOT NULL,
  `id_centre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `centres_collecte`
--

INSERT INTO `centres_collecte` (`nom`, `id_centre`) VALUES
('centre1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `donneurs`
--

CREATE TABLE `donneurs` (
  `nom_donneur` varchar(1000) NOT NULL,
  `prenom_donneur` varchar(1000) NOT NULL,
  `ville` varchar(1000) NOT NULL,
  `id_donneur` int NOT NULL,
  `cin` int NOT NULL,
  `groupe_sanguin` enum('A','B','AB','O') NOT NULL,
  `rhesus` enum('+','-') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `donneurs`
--

INSERT INTO `donneurs` (`nom_donneur`, `prenom_donneur`, `ville`, `id_donneur`, `cin`, `groupe_sanguin`, `rhesus`) VALUES
('mouhamed', 'laakom', 'Touza', 22, 222, 'AB', '+'),
('nadine', 'nnn', 'GHAR EL MELHJ', 12345, 1234566, 'A', '+'),
('mar', 'am', 'jjkk', 12346, 14076510, 'A', '+');

-- --------------------------------------------------------

--
-- Structure de la table `dons`
--

CREATE TABLE `dons` (
  `id_don` int NOT NULL,
  `statut` enum('EN STOCK','UTILISÉ','REJETÉ') NOT NULL DEFAULT 'EN STOCK',
  `id_donneur` int NOT NULL,
  `id_centre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `dons`
--

INSERT INTO `dons` (`id_don`, `statut`, `id_donneur`, `id_centre`) VALUES
(2, 'UTILISÉ', 22, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tests_don`
--

CREATE TABLE `tests_don` (
  `id_test` int NOT NULL,
  `id_don` int NOT NULL,
  `est_conforme` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tests_don`
--

INSERT INTO `tests_don` (`id_test`, `id_don`, `est_conforme`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `transfusions`
--

CREATE TABLE `transfusions` (
  `id_transfusion` int NOT NULL,
  `id_don` int NOT NULL,
  `hopital_recepteur` varchar(255) DEFAULT NULL,
  `date_transfusion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `nom` varchar(1000) NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_centre` int NOT NULL,
  `role` enum('Admin','Medecin','Secretaire') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mot_de_passe_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mot_de_passe` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`nom`, `id_utilisateur`, `id_centre`, `role`, `mot_de_passe_hash`, `mot_de_passe`) VALUES
('med', 5, 1, 'Medecin', '$2y$10$wPbInHDCVfGFhhiAZ0XD5.06TTXyQhPE7ibSSRTwj7fTm5sLf3HQi', 'm'),
('sec', 6, 1, 'Secretaire', '$2y$10$Id.m9htmMd88Z.AjkdOnG.pzGytPQklCXNV2HRM2NKBJCM4aK3h1u', 's'),
('user3', 7, 1, 'Medecin', '$2y$10$nASMYnRSgM17r0YYxkm4OOHxRoZOg5yBkyC5ZLRLxWWVm8CebcJA.', 'abc'),
('userAdmin', 8, 1, 'Admin', '$2y$10$DZcQmqtlB6N3x9Wz5Qwpu.c8Lj.ILWLghO2oGxv6kuKygs6xpN4Gi', 'admin'),
('ad', 9, 1, 'Admin', '$2y$10$6dqVFeIOlUpoaUqQm2Zz0OH1ij5snyLbja9smhiGeICvun94WS6yO', 'a');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `besoins`
--
ALTER TABLE `besoins`
  ADD PRIMARY KEY (`id_besoin`);

--
-- Index pour la table `centres_collecte`
--
ALTER TABLE `centres_collecte`
  ADD PRIMARY KEY (`id_centre`);

--
-- Index pour la table `donneurs`
--
ALTER TABLE `donneurs`
  ADD PRIMARY KEY (`id_donneur`),
  ADD UNIQUE KEY `cin` (`cin`);

--
-- Index pour la table `dons`
--
ALTER TABLE `dons`
  ADD PRIMARY KEY (`id_don`),
  ADD KEY `fk_donneur_dons` (`id_donneur`),
  ADD KEY `fk_centre_dons` (`id_centre`);

--
-- Index pour la table `tests_don`
--
ALTER TABLE `tests_don`
  ADD PRIMARY KEY (`id_test`),
  ADD UNIQUE KEY `id_don` (`id_don`);

--
-- Index pour la table `transfusions`
--
ALTER TABLE `transfusions`
  ADD PRIMARY KEY (`id_transfusion`),
  ADD UNIQUE KEY `id_don` (`id_don`),
  ADD UNIQUE KEY `id_don_2` (`id_don`),
  ADD UNIQUE KEY `id_transfusion` (`id_transfusion`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `id_centre` (`id_centre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `besoins`
--
ALTER TABLE `besoins`
  MODIFY `id_besoin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `centres_collecte`
--
ALTER TABLE `centres_collecte`
  MODIFY `id_centre` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `donneurs`
--
ALTER TABLE `donneurs`
  MODIFY `id_donneur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12347;

--
-- AUTO_INCREMENT pour la table `dons`
--
ALTER TABLE `dons`
  MODIFY `id_don` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tests_don`
--
ALTER TABLE `tests_don`
  MODIFY `id_test` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `transfusions`
--
ALTER TABLE `transfusions`
  MODIFY `id_transfusion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dons`
--
ALTER TABLE `dons`
  ADD CONSTRAINT `fk_centre_dons` FOREIGN KEY (`id_centre`) REFERENCES `centres_collecte` (`id_centre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_donneur_dons` FOREIGN KEY (`id_donneur`) REFERENCES `donneurs` (`id_donneur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tests_don`
--
ALTER TABLE `tests_don`
  ADD CONSTRAINT `tests_don_ibfk_1` FOREIGN KEY (`id_don`) REFERENCES `dons` (`id_don`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `transfusions`
--
ALTER TABLE `transfusions`
  ADD CONSTRAINT `transfusions_ibfk_1` FOREIGN KEY (`id_don`) REFERENCES `dons` (`id_don`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `id_centre` FOREIGN KEY (`id_centre`) REFERENCES `centres_collecte` (`id_centre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
