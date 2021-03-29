-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 mars 2021 à 14:17
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `qsf`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonner`
--

CREATE TABLE `abonner` (
  `CodeU` int(10) NOT NULL,
  `CodeC` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ateliers`
--

CREATE TABLE `ateliers` (
  `CodeA` int(10) NOT NULL,
  `TitreA` tinytext NOT NULL,
  `DescriptionA` tinytext NOT NULL,
  `DateDebutA` datetime NOT NULL,
  `DateFinA` datetime DEFAULT NULL,
  `LieuA` tinytext NOT NULL,
  `NombreA` int(10) NOT NULL,
  `DatePublicationA` datetime DEFAULT current_timestamp(),
  `URL` tinytext NOT NULL,
  `PlusA` tinytext DEFAULT NULL,
  `TypeA` enum('Pro','Perso','Pro et Perso') DEFAULT NULL,
  `CodeC` int(10) NOT NULL,
  `VisibiliteA` tinyint(1) DEFAULT 1,
  `MailCommence` tinyint(4) NOT NULL DEFAULT 0
) ;

-- --------------------------------------------------------

--
-- Structure de la table `besoins`
--

CREATE TABLE `besoins` (
  `CodeB` int(10) NOT NULL,
  `TitreB` tinytext NOT NULL,
  `DescriptionB` tinytext NOT NULL,
  `DateButoireB` datetime NOT NULL,
  `DatePublicationB` datetime DEFAULT current_timestamp(),
  `TypeB` enum('Pro','Perso','Pro et Perso') DEFAULT NULL,
  `CodeC` int(10) NOT NULL,
  `VisibiliteB` tinyint(1) DEFAULT 1,
  `ReponseB` int(10) DEFAULT 0,
  `Nombre` int(10) DEFAULT 1
) ;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `CodeC` int(10) NOT NULL,
  `NomC` tinytext NOT NULL,
  `DescriptionC` tinytext DEFAULT NULL,
  `PhotoC` tinytext DEFAULT NULL,
  `VisibiliteC` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compteurb`
--

CREATE TABLE `compteurb` (
  `CodeCB` int(10) NOT NULL,
  `NumOuiB` tinyint(1) DEFAULT NULL,
  `NumNonB` tinyint(1) DEFAULT NULL,
  `RaisonB` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compteurt`
--

CREATE TABLE `compteurt` (
  `CodeCT` int(10) NOT NULL,
  `NumOuiT` tinyint(1) DEFAULT NULL,
  `NumNonT` tinyint(1) DEFAULT NULL,
  `RaisonT` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `emails`
--

CREATE TABLE `emails` (
  `CodeEM` int(10) NOT NULL,
  `Provenance` int(10) NOT NULL,
  `Destinataire` int(10) NOT NULL,
  `Sujet` tinytext NOT NULL,
  `Contenu` text NOT NULL,
  `DateEvaluation` datetime NOT NULL DEFAULT current_timestamp(),
  `VisibiliteE` tinyint(1) DEFAULT 1,
  `CodeCarte` int(10) NOT NULL,
  `TypeCarte` enum('besoin','talent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evaluerb`
--

CREATE TABLE `evaluerb` (
  `NoteB` int(10) NOT NULL,
  `AvisB` text DEFAULT NULL,
  `DateEB` datetime NOT NULL DEFAULT current_timestamp(),
  `CodeU` int(10) NOT NULL,
  `CodeB` int(10) NOT NULL,
  `CodeEB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evaluert`
--

CREATE TABLE `evaluert` (
  `CodeET` int(10) NOT NULL,
  `NoteT` int(10) NOT NULL,
  `AvisT` text DEFAULT NULL,
  `DateET` datetime NOT NULL DEFAULT current_timestamp(),
  `CodeU` int(10) NOT NULL,
  `CodeT` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `Interval` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participera`
--

CREATE TABLE `participera` (
  `CodeU` int(10) NOT NULL,
  `CodeA` int(10) NOT NULL,
  `RoleA` enum('createur','participant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participerp`
--

CREATE TABLE `participerp` (
  `CodeU` int(10) NOT NULL,
  `CodeP` int(10) NOT NULL,
  `RoleP` enum('createur','participant') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `CodeP` int(10) NOT NULL,
  `TitreP` tinytext NOT NULL,
  `DescriptionP` tinytext NOT NULL,
  `LieuP` varchar(50) NOT NULL,
  `DateButoireP` datetime NOT NULL,
  `DatePublicationP` datetime DEFAULT current_timestamp(),
  `TypeP` enum('Pro','Perso','Pro et Perso') DEFAULT NULL,
  `CodeC` int(10) NOT NULL,
  `VisibiliteP` tinyint(1) DEFAULT 1,
  `MailCommence` tinyint(4) NOT NULL DEFAULT 0
) ;

-- --------------------------------------------------------

--
-- Structure de la table `proposer`
--

CREATE TABLE `proposer` (
  `CodeU` int(10) NOT NULL,
  `CodeT` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `saisir`
--

CREATE TABLE `saisir` (
  `CodeU` int(10) NOT NULL,
  `CodeB` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `slides`
--

CREATE TABLE `slides` (
  `NumSlide` enum('1','2','3','4') NOT NULL,
  `TitreS` tinytext DEFAULT NULL,
  `PhotoS` tinytext DEFAULT NULL,
  `TextS1` text DEFAULT NULL,
  `TextS2` text DEFAULT NULL,
  `TextS3` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `talents`
--

CREATE TABLE `talents` (
  `CodeT` int(10) NOT NULL,
  `TitreT` tinytext NOT NULL,
  `DescriptionT` tinytext NOT NULL,
  `DatePublicationT` datetime DEFAULT current_timestamp(),
  `TypeT` enum('Pro','Perso','Pro et Perso') DEFAULT NULL,
  `CodeC` int(10) NOT NULL,
  `VisibiliteT` tinyint(1) DEFAULT 1,
  `ReponseT` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `CodeU` int(10) NOT NULL,
  `NomU` tinytext NOT NULL,
  `PrenomU` tinytext NOT NULL,
  `Email` tinytext NOT NULL,
  `MotDePasse` tinytext NOT NULL,
  `TypeU` enum('Pro','Perso','') DEFAULT NULL,
  `RoleU` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonner`
--
ALTER TABLE `abonner`
  ADD PRIMARY KEY (`CodeU`,`CodeC`),
  ADD KEY `CodeC` (`CodeC`);

--
-- Index pour la table `ateliers`
--
ALTER TABLE `ateliers`
  ADD PRIMARY KEY (`CodeA`);

--
-- Index pour la table `besoins`
--
ALTER TABLE `besoins`
  ADD PRIMARY KEY (`CodeB`),
  ADD KEY `CodeC` (`CodeC`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CodeC`);

--
-- Index pour la table `compteurb`
--
ALTER TABLE `compteurb`
  ADD PRIMARY KEY (`CodeCB`);

--
-- Index pour la table `compteurt`
--
ALTER TABLE `compteurt`
  ADD PRIMARY KEY (`CodeCT`);

--
-- Index pour la table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`CodeEM`) USING BTREE,
  ADD KEY `Provenance` (`Provenance`),
  ADD KEY `Destinataire` (`Destinataire`);

--
-- Index pour la table `evaluerb`
--
ALTER TABLE `evaluerb`
  ADD PRIMARY KEY (`CodeEB`),
  ADD KEY `CodeB` (`CodeB`),
  ADD KEY `CodeU` (`CodeU`);

--
-- Index pour la table `evaluert`
--
ALTER TABLE `evaluert`
  ADD PRIMARY KEY (`CodeET`) USING BTREE,
  ADD KEY `CodeU` (`CodeU`),
  ADD KEY `CodeT` (`CodeT`);

--
-- Index pour la table `participera`
--
ALTER TABLE `participera`
  ADD PRIMARY KEY (`CodeU`,`CodeA`);

--
-- Index pour la table `participerp`
--
ALTER TABLE `participerp`
  ADD PRIMARY KEY (`CodeU`,`CodeP`),
  ADD KEY `CodeP` (`CodeP`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`CodeP`),
  ADD KEY `CodeC` (`CodeC`);

--
-- Index pour la table `proposer`
--
ALTER TABLE `proposer`
  ADD PRIMARY KEY (`CodeU`,`CodeT`),
  ADD KEY `CodeT` (`CodeT`);

--
-- Index pour la table `saisir`
--
ALTER TABLE `saisir`
  ADD PRIMARY KEY (`CodeU`,`CodeB`),
  ADD KEY `CodeB` (`CodeB`);

--
-- Index pour la table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`NumSlide`);

--
-- Index pour la table `talents`
--
ALTER TABLE `talents`
  ADD PRIMARY KEY (`CodeT`),
  ADD KEY `CodeC` (`CodeC`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`CodeU`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ateliers`
--
ALTER TABLE `ateliers`
  MODIFY `CodeA` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `besoins`
--
ALTER TABLE `besoins`
  MODIFY `CodeB` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `CodeC` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `compteurb`
--
ALTER TABLE `compteurb`
  MODIFY `CodeCB` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `compteurt`
--
ALTER TABLE `compteurt`
  MODIFY `CodeCT` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `emails`
--
ALTER TABLE `emails`
  MODIFY `CodeEM` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `evaluert`
--
ALTER TABLE `evaluert`
  MODIFY `CodeET` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `CodeP` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `talents`
--
ALTER TABLE `talents`
  MODIFY `CodeT` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `CodeU` int(10) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonner`
--
ALTER TABLE `abonner`
  ADD CONSTRAINT `abonner_ibfk_1` FOREIGN KEY (`CodeU`) REFERENCES `utilisateurs` (`CodeU`),
  ADD CONSTRAINT `abonner_ibfk_2` FOREIGN KEY (`CodeC`) REFERENCES `categories` (`CodeC`);

--
-- Contraintes pour la table `besoins`
--
ALTER TABLE `besoins`
  ADD CONSTRAINT `besoins_ibfk_1` FOREIGN KEY (`CodeC`) REFERENCES `categories` (`CodeC`);

--
-- Contraintes pour la table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`Provenance`) REFERENCES `utilisateurs` (`CodeU`),
  ADD CONSTRAINT `emails_ibfk_2` FOREIGN KEY (`Destinataire`) REFERENCES `utilisateurs` (`CodeU`);

--
-- Contraintes pour la table `evaluerb`
--
ALTER TABLE `evaluerb`
  ADD CONSTRAINT `evaluerb_ibfk_1` FOREIGN KEY (`CodeU`) REFERENCES `utilisateurs` (`CodeU`),
  ADD CONSTRAINT `evaluerb_ibfk_2` FOREIGN KEY (`CodeB`) REFERENCES `besoins` (`CodeB`);

--
-- Contraintes pour la table `evaluert`
--
ALTER TABLE `evaluert`
  ADD CONSTRAINT `evaluert_ibfk_1` FOREIGN KEY (`CodeU`) REFERENCES `utilisateurs` (`CodeU`),
  ADD CONSTRAINT `evaluert_ibfk_2` FOREIGN KEY (`CodeT`) REFERENCES `talents` (`CodeT`);

--
-- Contraintes pour la table `participerp`
--
ALTER TABLE `participerp`
  ADD CONSTRAINT `participerp_ibfk_1` FOREIGN KEY (`CodeU`) REFERENCES `utilisateurs` (`CodeU`),
  ADD CONSTRAINT `participerp_ibfk_2` FOREIGN KEY (`CodeP`) REFERENCES `projets` (`CodeP`);

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_ibfk_1` FOREIGN KEY (`CodeC`) REFERENCES `categories` (`CodeC`);

--
-- Contraintes pour la table `proposer`
--
ALTER TABLE `proposer`
  ADD CONSTRAINT `proposer_ibfk_1` FOREIGN KEY (`CodeU`) REFERENCES `utilisateurs` (`CodeU`),
  ADD CONSTRAINT `proposer_ibfk_2` FOREIGN KEY (`CodeT`) REFERENCES `talents` (`CodeT`);

--
-- Contraintes pour la table `saisir`
--
ALTER TABLE `saisir`
  ADD CONSTRAINT `saisir_ibfk_1` FOREIGN KEY (`CodeU`) REFERENCES `utilisateurs` (`CodeU`),
  ADD CONSTRAINT `saisir_ibfk_2` FOREIGN KEY (`CodeB`) REFERENCES `besoins` (`CodeB`);

--
-- Contraintes pour la table `talents`
--
ALTER TABLE `talents`
  ADD CONSTRAINT `talents_ibfk_1` FOREIGN KEY (`CodeC`) REFERENCES `categories` (`CodeC`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`CodeC`, `NomC`, `DescriptionC`, `PhotoC`, `VisibiliteC`) VALUES
(1, 'Sport', 'Basketball, Football,...', 'https://www.bls.gov/spotlight/2017/sports-and-exercise/images/cover_image.jpg', 1),
(2, 'Animation', 'Réunions créatives, Pitcher...', 'https://www.maxicasting.com/sites/default/files/styles/medium_article/public/field/image/Virginie_Guilhaume.jpg?itok=9llLIC0Q', 1),
(3, 'Outils métiers', '', 'https://www.cm-alsace.fr/sites/default/files/styles/header_banner/public/image/201405/page_tic.jpg?itok=mvNBiA_w', 1),
(4, 'Développement personnel', 'Yoga, méditation', 'http://mylenebeaudoin.com/wp-content/uploads/2019/04/Capture-d%C3%A9cran-2019-03-03-21.39.08-1080x675.png', 1),
(5, 'Associatif', '', 'https://i2.wp.com/www.maxmanroe.com/wp-content/uploads/2017/09/Pengertian-Struktur-Organisasi.png?w=600&ssl=1', 1),
(6, 'Covoiturage', '', 'http://www.ipj.news/enquetes/wp-content/uploads/sites/26/2019/06/illustration-covoiturage-20170827.jpg', 1),
(7, 'Bureautique', 'Word, Excel, Outlook, PowerPoint...', 'http://romualdtechnology.asso-web.com/uploaded/image/image-bureautique2-480x290.jpg', 1),
(8, 'Informatique', 'Réseaux, Site Web, Réparation PC...', 'https://www.nbs-system.com/wp-content/uploads/2018/03/180403_NBS_Attaque_protection_siteWeb-788x433.jpg', 1),
(9, 'Loisir', 'Cuisine, Bricolage, Musique, Théâtre, Cinéma, Cilture, Philatélie, généalogie...', 'https://www.lepointdufle.net/ia/sportsloisirs1.jpg', 1),
(10, 'Autres', '', 'https://www.ccilaval.qc.ca/wp-content/uploads/2017/02/Icone_Autre.jpg', 1);

--
-- Déchargement des données de la table `slides`
--

INSERT INTO `slides` (`NumSlide`, `TitreS`, `PhotoS`, `TextS1`, `TextS2`, `TextS3`) VALUES
('1', 'coucou les amies dev', 'https://r1pbk8s6fm-flywheel.netdna-ssl.com/wp-content/uploads/2018/04/map-connectivity-1200x400.jpg', 'COUP DE MAIN, COUP DE POUCE est une plateforme qui permet de partager les compétences entre collaborateurs.', 'Partageons nos talents, la solitarité c\'est aussi entre nous.', ''),
('2', 'Oui, vous avez des talents !', 'https://www.bravopromo.fr/cdn/blog/1200x400/le-green-friday-par-bravopromo-201911151231-preview.jpg', '', '', ''),
('3', 'Nouvelle du jour', 'https://gray-ktuu-prod.cdn.arcpublishing.com/resizer/gDT0TCs6HrkaegOnMo6p0ZZX694=/1200x400/smart/cloudfront-us-east-1.images.arcpublishing.com/gray/3BWLQZ7DZ5NMFF35HJEJ7KFTR4.jpg', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.Some quick example text to build on the card title and make up the bulk of the card\'s content,Some quick example text to build on the card title and make up the bulk of the card\'s content,Some quick example text to build on the card title and make up the bulk of the card\'s content,Some quick example text to build on the card title and make up the bulk of the card\'s content.', '', ''),
('4', 'Retours d\'expériences des utilisateurs', 'https://i.pinimg.com/originals/d1/a5/d3/d1a5d3d96f0862664846c7800e3c8aff.jpg', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.');