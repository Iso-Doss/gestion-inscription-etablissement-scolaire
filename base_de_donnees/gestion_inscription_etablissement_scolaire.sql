-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 06 mars 2026 à 19:55
-- Version du serveur : 8.0.44
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_inscription_etablissement_scolaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `filieres`
--

CREATE TABLE `filieres` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `montant_scolarite` int NOT NULL,
  `description` text,
  `activer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifier_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `supprimer_le` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `filieres`
--

INSERT INTO `filieres` (`id`, `nom`, `montant_scolarite`, `description`, `activer_le`, `creer_le`, `modifier_le`, `supprimer_le`) VALUES
(4, 'Création de site internet', 200000, 'Création de site internetssss', '2026-02-25 18:42:56', '2026-02-25 18:42:56', '2026-02-25 18:42:56', NULL),
(5, 'Audiovisuel Modifier', 50000, 'Audiovisuel', '2026-02-25 18:46:13', '2026-02-25 18:46:13', '2026-02-25 18:46:13', NULL),
(6, 'Peinture', 2000000, 'Peinture', '2026-02-25 18:46:38', '2026-02-25 18:46:38', '2026-02-25 18:46:38', NULL),
(7, 'Création de site internet et marketing digital', 250000, 'Voici la description de la formation \"Création de site internet et marketing digital\"', '2026-02-25 19:06:37', '2026-02-25 19:06:37', '2026-02-25 19:06:37', NULL),
(8, 'Haute couture et modélisme 1', 200000, 'Description  de la formation Haute couture et modélisme', '2026-03-04 18:06:49', '2026-03-04 18:06:49', '2026-03-04 18:06:49', NULL),
(9, 'Haute couture et modélisme 2', 200000, 'Description  de la formation Haute couture et modélisme', '2026-03-04 18:06:49', '2026-03-04 18:06:49', '2026-03-04 18:06:49', NULL),
(10, 'Haute couture et modélisme 3', 200000, 'Description  de la formation Haute couture et modélisme', '2026-03-04 18:06:49', '2026-03-04 18:06:49', '2026-03-04 18:06:49', NULL),
(11, 'Haute couture et modélisme 4', 200000, 'Description  de la formation Haute couture et modélisme', '2026-03-04 18:06:49', '2026-03-04 18:06:49', '2026-03-04 18:06:49', NULL),
(12, 'Haute couture et modélisme 5', 200000, 'Description  de la formation Haute couture et modélisme', '2026-03-04 18:06:49', '2026-03-04 18:06:49', '2026-03-04 18:06:49', NULL),
(13, 'Haute couture et modélisme 16', 200000, 'Description  de la formation Haute couture et modélisme', '2026-03-04 18:06:49', '2026-03-04 18:06:49', '2026-03-04 18:06:49', NULL),
(14, 'Haute couture et modélisme 17', 200000, 'Description  de la formation Haute couture et modélisme', '2026-03-04 18:06:49', '2026-03-04 18:06:49', '2026-03-04 18:06:49', NULL),
(15, 'Haute couture et modélisme 18', 200000, 'Description  de la formation Haute couture et modélisme', '2026-03-04 18:06:49', '2026-03-04 18:06:49', '2026-03-04 18:06:49', NULL),
(16, 'Haute couture et modélisme 19', 200000, 'Description  de la formation Haute couture et modélisme', '2026-03-04 18:06:49', '2026-03-04 18:06:49', '2026-03-04 18:06:49', NULL),
(17, 'Haute couture et modélisme 20', 200000, 'Description  de la formation Haute couture et modélisme', '2026-03-04 18:06:49', '2026-03-04 18:06:49', '2026-03-04 18:06:49', NULL),
(18, 'Esthétique', 200000, 'Esthétique', '2026-03-06 19:48:02', '2026-03-06 19:48:02', '2026-03-06 19:48:02', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenoms` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `creer_le` timestamp NOT NULL,
  `mise_a_jour_le` timestamp NOT NULL,
  `supprimer_le` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenoms`, `email`, `mot_de_passe`, `creer_le`, `mise_a_jour_le`, `supprimer_le`) VALUES
(1, 'DOSSOU', 'Israel', 'israel@gmail.com', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', '2026-03-06 19:24:05', '2026-03-06 19:24:05', '2026-03-06 19:24:05');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `filieres`
--
ALTER TABLE `filieres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `filieres`
--
ALTER TABLE `filieres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
