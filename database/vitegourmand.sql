-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 23, 2026 at 12:44 AM
-- Server version: 8.0.44
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vitegourmand`
--

-- --------------------------------------------------------

--
-- Table structure for table `adapte`
--

CREATE TABLE `adapte` (
  `menu_id` int NOT NULL,
  `regime_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `adapte`
--

INSERT INTO `adapte` (`menu_id`, `regime_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `allergene`
--

CREATE TABLE `allergene` (
  `allergene_id` int NOT NULL,
  `libelle` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `allergene`
--

INSERT INTO `allergene` (`allergene_id`, `libelle`) VALUES
(1, 'Gluten'),
(2, 'Lactose'),
(3, 'Fruits à coque'),
(4, 'Œufs'),
(5, 'Crustacés');

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `avis_id` int NOT NULL,
  `note` varchar(80) DEFAULT NULL,
  `description` varchar(80) DEFAULT NULL,
  `statut` varchar(80) DEFAULT NULL,
  `utilisateur_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`avis_id`, `note`, `description`, `statut`, `utilisateur_id`) VALUES
(1, '5', 'Prestation exceptionnelle, tout était parfait pour notre mariage !', 'validé', 5),
(2, '4', 'Très bon rapport qualité-prix, l\'équipe était très professionnelle.', 'validé', 6),
(3, '5', 'Menu délicieux, je recommande vivement.', 'validé', 7);

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `numero_commande` varchar(80) NOT NULL,
  `date_commande` date NOT NULL,
  `date_prestation` date NOT NULL,
  `heure_livraison` varchar(80) DEFAULT NULL,
  `prix_menu` double DEFAULT NULL,
  `nombre_personne` int DEFAULT NULL,
  `prix_livraison` double DEFAULT NULL,
  `statut` varchar(80) DEFAULT NULL,
  `pret_materiel` tinyint(1) DEFAULT NULL,
  `restitution_materiel` tinyint(1) DEFAULT NULL,
  `utilisateur_id` int DEFAULT NULL,
  `menu_id` int DEFAULT NULL,
  `motif_annulation` varchar(255) DEFAULT NULL,
  `mode_contact` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`numero_commande`, `date_commande`, `date_prestation`, `heure_livraison`, `prix_menu`, `nombre_personne`, `prix_livraison`, `statut`, `pret_materiel`, `restitution_materiel`, `utilisateur_id`, `menu_id`, `motif_annulation`, `mode_contact`) VALUES
('CMD-1445', '2026-07-17', '2026-07-23', '14:00', 266, 7, 7.95, 'annulée', NULL, NULL, 1, 4, NULL, NULL),
('CMD-2026-6A5A0899456E7', '2026-07-17', '2026-07-24', '12:00', 715, 13, 12.67, 'annulée', NULL, NULL, 1, 6, NULL, NULL),
('CMD-2026-6A5A08ED8DBF6', '2026-07-17', '2026-07-24', '13:00', 108, 6, 6.18, 'en attente', NULL, NULL, 1, 5, NULL, NULL),
('CMD-2026-A1B2C3', '2026-06-01', '2026-07-15', '19:00', 700, 20, 0, 'terminée', 0, 0, 5, 1, NULL, NULL),
('CMD-2026-D4E5F6', '2026-06-10', '2026-07-20', '20:00', 315, 9, 15.9, 'accepté', 0, 0, 6, 2, NULL, NULL),
('CMD-2026-G7H8I9', '2026-06-15', '2026-08-01', '19:30', 336, 8, 0, 'en préparation', 1, 0, 7, 3, NULL, NULL),
('CMD-2026-J1K2L3', '2026-06-20', '2026-08-10', '12:00', 228, 6, 25.5, 'en attente', 0, 0, 8, 4, NULL, NULL),
('CMD-2026-M4N5O6', '2026-06-25', '2026-07-30', '18:00', 90, 5, 0, 'annulée', 0, 0, 5, 5, 'Client indisponible à la date prévue', 'téléphone'),
('CMD-2026-P7Q8R9', '2026-07-01', '2026-12-24', '19:00', 660, 12, 0, 'en cours de livraison', 0, 0, 6, 6, NULL, NULL),
('CMD-2026-S1T2U3', '2026-06-05', '2026-07-10', '19:00', 780, 12, 0, 'en attente du retour de matériel', 1, 0, 7, 6, NULL, NULL),
('CMD-9006', '2026-07-21', '2026-07-23', '13:00', 770, 14, 7.36, 'livrée', NULL, NULL, 1, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contient`
--

CREATE TABLE `contient` (
  `plat_id` int NOT NULL,
  `allergene_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contient`
--

INSERT INTO `contient` (`plat_id`, `allergene_id`) VALUES
(4, 1),
(1, 2),
(10, 2),
(4, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `historique_statut`
--

CREATE TABLE `historique_statut` (
  `id` int NOT NULL,
  `numero_commande` varchar(80) NOT NULL,
  `statut` varchar(80) NOT NULL,
  `date_modification` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `historique_statut`
--

INSERT INTO `historique_statut` (`id`, `numero_commande`, `statut`, `date_modification`) VALUES
(1, 'CMD-2026-A1B2C3', 'en attente', '2026-06-01 10:00:00'),
(2, 'CMD-2026-A1B2C3', 'accepté', '2026-06-02 09:00:00'),
(3, 'CMD-2026-A1B2C3', 'en préparation', '2026-07-14 08:00:00'),
(4, 'CMD-2026-A1B2C3', 'en cours de livraison', '2026-07-15 16:00:00'),
(5, 'CMD-2026-A1B2C3', 'terminée', '2026-07-15 20:30:00'),
(6, 'CMD-2026-D4E5F6', 'en attente', '2026-06-10 11:00:00'),
(7, 'CMD-2026-D4E5F6', 'accepté', '2026-06-11 09:30:00'),
(8, 'CMD-2026-6A5A0899456E7', 'en attente', '2026-07-17 12:48:57'),
(9, 'CMD-2026-6A5A08ED8DBF6', 'en attente', '2026-07-17 12:50:21'),
(13, 'CMD-2026-6A5A0899456E7', 'annulée', '2026-07-17 13:03:00'),
(15, 'CMD-1445', 'en attente', '2026-07-17 13:09:50'),
(20, 'CMD-1445', 'annulée', '2026-07-21 15:05:26'),
(21, 'CMD-9006', 'en attente', '2026-07-21 15:06:24'),
(22, 'CMD-9006', 'livrée', '2026-07-22 14:23:32');

-- --------------------------------------------------------

--
-- Table structure for table `horaire`
--

CREATE TABLE `horaire` (
  `horaire_id` int NOT NULL,
  `jour` varchar(80) NOT NULL,
  `heure_ouverture` varchar(80) DEFAULT NULL,
  `heure_fermeture` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `horaire`
--

INSERT INTO `horaire` (`horaire_id`, `jour`, `heure_ouverture`, `heure_fermeture`) VALUES
(1, 'Lundi', '09:00', '19:00'),
(2, 'Mardi', '09:00', '19:00'),
(3, 'Mercredi', '09:00', '19:00'),
(4, 'Jeudi', '09:00', '18:00'),
(5, 'Vendredi', '09:00', '19:00'),
(6, 'Samedi', '11:00', '17:00'),
(7, 'Dimanche', 'fermé', 'fermé');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int NOT NULL,
  `titre` varchar(80) NOT NULL,
  `nombre_personne_minimum` int DEFAULT NULL,
  `prix_par_personne` double DEFAULT NULL,
  `regime` varchar(80) DEFAULT NULL,
  `description` varchar(80) DEFAULT NULL,
  `quantite_restante` int DEFAULT NULL,
  `photo` longblob,
  `conditions` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `titre`, `nombre_personne_minimum`, `prix_par_personne`, `regime`, `description`, `quantite_restante`, `photo`, `conditions`) VALUES
(1, 'Menu Mariage Prestige', 20, 65, 'Classique', 'Un menu raffiné pour votre mariage, composé de mets d\'exception.', 15, NULL, NULL),
(2, 'Menu Anniversaire Festif', 10, 35, 'Classique', 'Un menu convivial pour célébrer un anniversaire entre proches.', 20, NULL, NULL),
(3, 'Menu Tradition Française', 8, 42, 'Classique', 'Les grands classiques de la gastronomie française.', 25, NULL, NULL),
(4, 'Menu Végétarien & Vegan Gourmand', 6, 38, 'Végétarien', 'Un menu 100% végétal, gourmand et coloré.', 18, NULL, NULL),
(5, 'Menu Enfants Gourmand', 5, 18, 'Classique', 'Un menu adapté aux enfants, simple et savoureux.', 30, NULL, NULL),
(6, 'Menu Noël & Saison Festive', 12, 55, 'Classique', 'Un menu de fêtes avec les incontournables de Noël.', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_photos`
--

CREATE TABLE `menu_photos` (
  `photo_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `photo` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expires_at`, `used`, `created_at`) VALUES
(1, 1, 'ff60abdd88f30166bab65ad264f1398228d21d0415bc0fc2641fd95beaba7b44', '2026-07-16 14:25:12', 0, '2026-07-16 15:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `plat`
--

CREATE TABLE `plat` (
  `plat_id` int NOT NULL,
  `titre_plat` varchar(80) NOT NULL,
  `photo` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `plat`
--

INSERT INTO `plat` (`plat_id`, `titre_plat`, `photo`) VALUES
(1, 'Foie gras maison', NULL),
(2, 'Saumon fumé', NULL),
(3, 'Magret de canard', NULL),
(4, 'Bûche de Noël', NULL),
(5, 'Salade de quinoa', NULL),
(6, 'Tarte aux légumes', NULL),
(7, 'Agneau pascal', NULL),
(8, 'Curry de légumes vegan', NULL),
(9, 'Verrine de saison', NULL),
(10, 'Fromage de saison', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `propose`
--

CREATE TABLE `propose` (
  `menu_id` int NOT NULL,
  `plat_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `propose`
--

INSERT INTO `propose` (`menu_id`, `plat_id`) VALUES
(1, 1),
(6, 1),
(1, 2),
(2, 2),
(1, 3),
(3, 3),
(6, 4),
(4, 5),
(4, 6),
(2, 9),
(5, 9),
(3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `propose_theme`
--

CREATE TABLE `propose_theme` (
  `menu_id` int NOT NULL,
  `theme_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `propose_theme`
--

INSERT INTO `propose_theme` (`menu_id`, `theme_id`) VALUES
(6, 1),
(3, 3),
(4, 3),
(5, 3),
(1, 4),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `regime`
--

CREATE TABLE `regime` (
  `regime_id` int NOT NULL,
  `libelle` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `regime`
--

INSERT INTO `regime` (`regime_id`, `libelle`) VALUES
(1, 'Classique'),
(2, 'Végétarien'),
(3, 'Vegan');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int NOT NULL,
  `libelle` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `libelle`) VALUES
(1, 'admin'),
(2, 'client'),
(3, 'employe');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `theme_id` int NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`theme_id`, `libelle`) VALUES
(1, 'Noël'),
(2, 'Pâques'),
(3, 'Classique'),
(4, 'Événement');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `utilisateur_id` int NOT NULL,
  `nom` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `prenom` varchar(80) NOT NULL,
  `telephone` varchar(80) DEFAULT NULL,
  `ville` varchar(80) DEFAULT NULL,
  `pays` varchar(80) DEFAULT NULL,
  `adresse_postale` varchar(80) DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `numero_rue` varchar(10) DEFAULT NULL,
  `rue` varchar(150) DEFAULT NULL,
  `adresse_complementaire` varchar(150) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `doit_changer_mdp` tinyint(1) NOT NULL DEFAULT '0',
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateur_id`, `nom`, `email`, `password`, `prenom`, `telephone`, `ville`, `pays`, `adresse_postale`, `role_id`, `numero_rue`, `rue`, `adresse_complementaire`, `actif`, `doit_changer_mdp`, `date_creation`) VALUES
(1, 'ZEMMOURY', 'ismail.zamouri3@gmail.com', '$2y$10$jHTUuOh5FKS8.H1RuizSuecT9Sd0UcF2XLmrHPpl4JJNj4FFxnLFa', 'Ismail', '0668224169', 'Marseille', NULL, '13003 Marseille', 2, NULL, NULL, NULL, 1, 0, '2026-07-17 14:08:19'),
(3, 'MARTIN', 'employe1@vitegourmand.fr', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy', 'José', '0600000002', 'Bordeaux', 'France', '15 rue Sainte-Catherine', 3, NULL, NULL, NULL, 1, 0, '2026-07-17 14:08:19'),
(4, 'BERNARD', 'employe2@vitegourmand.fr', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy', 'Lucie', '0600000003', 'Bordeaux', 'France', '22 cours de l\'Intendance', 3, NULL, NULL, NULL, 1, 0, '2026-07-17 14:08:19'),
(5, 'PETIT', 'employe.parti@vitegourmand.fr', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy', 'Marc', '0600000004', 'Bordeaux', 'France', '5 place Gambetta', 3, NULL, NULL, NULL, 0, 0, '2026-07-17 14:08:19'),
(6, 'DURAND', 'sophie.durand@test.fr', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy', 'Sophie', '0611111111', 'Bordeaux', 'France', '3 rue du Palais Gallien', 2, NULL, NULL, NULL, 1, 0, '2026-07-17 14:08:19'),
(7, 'LEROY', 'thomas.leroy@test.fr', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy', 'Thomas', '0622222222', 'Mérignac', 'France', '18 avenue de la Libération', 2, NULL, NULL, NULL, 1, 0, '2026-07-17 14:08:19'),
(8, 'MOREAU', 'camille.moreau@test.fr', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy', 'Camille', '0633333333', 'Pessac', 'France', '7 rue Jean Jaurès', 2, NULL, NULL, NULL, 1, 0, '2026-07-17 14:08:19'),
(9, 'SIMON', 'antoine.simon@test.fr', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy', 'Antoine', '0644444444', 'Marseille', 'France', '12 rue de la République', 2, NULL, NULL, NULL, 1, 0, '2026-07-17 14:08:19'),
(28, 'Zamouri', 'ismailzemmoury20@gmail.com', '$2y$10$5crr0fwop56if0fSMWM7k.ud1AcqXbTU6.D2kdULR6AFUUHSXUZ1W', 'Ismail', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, '2026-07-18 17:05:03'),
(29, 'ZEMMOURY', 'ismailzemmouryx20@gmail.com', '$2y$10$QbMdQpYKl/Du61xiAtzppO2.0aOmYnrJrecdbmpu6PFhy3DBT5q7C', 'Ismail', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 0, '2026-07-20 15:36:13'),
(61, 'Dupont', 'vitegourmand.info@gmail.com', '$2y$10$SD91QP4IDqarlcMw7sVPAOIRN.Itt/f3UL7osX133Cw193KMBvazq', 'José', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2026-07-22 22:58:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adapte`
--
ALTER TABLE `adapte`
  ADD PRIMARY KEY (`menu_id`,`regime_id`),
  ADD KEY `regime_id` (`regime_id`);

--
-- Indexes for table `allergene`
--
ALTER TABLE `allergene`
  ADD PRIMARY KEY (`allergene_id`);

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`avis_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`numero_commande`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `contient`
--
ALTER TABLE `contient`
  ADD PRIMARY KEY (`plat_id`,`allergene_id`),
  ADD KEY `allergene_id` (`allergene_id`);

--
-- Indexes for table `historique_statut`
--
ALTER TABLE `historique_statut`
  ADD PRIMARY KEY (`id`),
  ADD KEY `numero_commande` (`numero_commande`);

--
-- Indexes for table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`horaire_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menu_photos`
--
ALTER TABLE `menu_photos`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plat`
--
ALTER TABLE `plat`
  ADD PRIMARY KEY (`plat_id`);

--
-- Indexes for table `propose`
--
ALTER TABLE `propose`
  ADD PRIMARY KEY (`menu_id`,`plat_id`),
  ADD KEY `plat_id` (`plat_id`);

--
-- Indexes for table `propose_theme`
--
ALTER TABLE `propose_theme`
  ADD PRIMARY KEY (`menu_id`,`theme_id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Indexes for table `regime`
--
ALTER TABLE `regime`
  ADD PRIMARY KEY (`regime_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`theme_id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`utilisateur_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergene`
--
ALTER TABLE `allergene`
  MODIFY `allergene_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `avis_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `historique_statut`
--
ALTER TABLE `historique_statut`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `horaire_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_photos`
--
ALTER TABLE `menu_photos`
  MODIFY `photo_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plat`
--
ALTER TABLE `plat`
  MODIFY `plat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `regime`
--
ALTER TABLE `regime`
  MODIFY `regime_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `theme_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `utilisateur_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adapte`
--
ALTER TABLE `adapte`
  ADD CONSTRAINT `adapte_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`),
  ADD CONSTRAINT `adapte_ibfk_2` FOREIGN KEY (`regime_id`) REFERENCES `regime` (`regime_id`);

--
-- Constraints for table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`);

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`);

--
-- Constraints for table `contient`
--
ALTER TABLE `contient`
  ADD CONSTRAINT `contient_ibfk_1` FOREIGN KEY (`plat_id`) REFERENCES `plat` (`plat_id`),
  ADD CONSTRAINT `contient_ibfk_2` FOREIGN KEY (`allergene_id`) REFERENCES `allergene` (`allergene_id`);

--
-- Constraints for table `historique_statut`
--
ALTER TABLE `historique_statut`
  ADD CONSTRAINT `historique_statut_ibfk_1` FOREIGN KEY (`numero_commande`) REFERENCES `commande` (`numero_commande`);

--
-- Constraints for table `menu_photos`
--
ALTER TABLE `menu_photos`
  ADD CONSTRAINT `menu_photos_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE;

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE CASCADE;

--
-- Constraints for table `propose`
--
ALTER TABLE `propose`
  ADD CONSTRAINT `propose_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`),
  ADD CONSTRAINT `propose_ibfk_2` FOREIGN KEY (`plat_id`) REFERENCES `plat` (`plat_id`);

--
-- Constraints for table `propose_theme`
--
ALTER TABLE `propose_theme`
  ADD CONSTRAINT `propose_theme_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`),
  ADD CONSTRAINT `propose_theme_ibfk_2` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`theme_id`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
