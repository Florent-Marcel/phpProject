-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 12:05 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `projetdevweb` DEFAULT CHARACTER SET utf8;
USE `projetdevweb`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projetdevweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
`idArticle` int(11) NOT NULL,
  `nom` text NOT NULL,
  `categorie` text NOT NULL,
  `prix` float NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`idArticle`, `nom`, `categorie`, `prix`, `disponible`, `stock`) VALUES
(1, 'Ordinateur', 'Informatique', 700, 1, 13),
(2, 'Ordinateur portable', 'Informatique', 600, 1, 9),
(3, 'Je suis une légende', 'Livre', 6, 1, 47),
(4, 'La couronne des 7 royaumes', 'Livre', 13, 1, 25),
(5, 'Amplificateur YAMAHA', 'Hi-fi', 150, 1, 10),
(6, 'Système "Home Theater"', 'Hi-fi', 250, 0, 0);

--
-- Triggers `articles`
--
DELIMITER //
CREATE TRIGGER `beforeUpdateArticle` BEFORE UPDATE ON `articles`
 FOR EACH ROW if new.stock <= 0 then
	set new.disponible = 0;
else
	set new.disponible = 1;
end if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `chatmessages`
--

CREATE TABLE IF NOT EXISTS `chatmessages` (
`idChatMessage` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `message` text NOT NULL,
  `dateMessage` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `chatmessages`
--

INSERT INTO `chatmessages` (`idChatMessage`, `idUtilisateur`, `message`, `dateMessage`) VALUES
(1, 16, 'Salut tout le monde', '2021-05-09 20:47:00'),
(2, 17, 'Hey', '2021-05-09 23:50:33'),
(3, 17, 'Hey', '2021-05-09 23:52:54'),
(4, 17, 'tralala', '2021-05-09 23:55:58'),
(5, 16, 'hgh', '2021-05-10 16:32:44'),
(6, 17, 'dsff', '2021-05-10 16:44:16'),
(7, 17, 'dsff', '2021-05-10 16:54:06'),
(8, 17, 'dsff', '2021-05-10 16:54:08'),
(9, 17, 'tret', '2021-05-10 18:29:59'),
(10, 17, 'dsffds', '2021-05-10 19:02:56'),
(11, 17, 'fdsf', '2021-05-10 19:03:13'),
(12, 17, 'sqd', '2021-05-10 19:05:26'),
(13, 17, 'sqd', '2021-05-10 19:06:09'),
(14, 17, 'sqd', '2021-05-10 19:06:54'),
(15, 17, 'dqsdd', '2021-05-10 19:07:34'),
(16, 17, 'dsqd', '2021-05-10 19:07:40'),
(17, 17, 'fdsf', '2021-05-10 19:08:22'),
(18, 17, 'dqsdd', '2021-05-10 19:14:54'),
(19, 17, 'fsdf', '2021-05-10 19:16:15'),
(20, 17, 'fsdf', '2021-05-10 19:20:59'),
(21, 17, 'gfg', '2021-05-10 19:21:03'),
(22, 17, 'gfg', '2021-05-10 19:21:25'),
(23, 17, 'gfg', '2021-05-10 19:21:42'),
(24, 17, 'gfg', '2021-05-10 19:25:15'),
(25, 17, 'gfg', '2021-05-10 19:25:42'),
(26, 17, 'fdsffs', '2021-05-10 19:36:27'),
(27, 17, 'fdf', '2021-05-10 19:39:08'),
(28, 17, 'Salut', '2021-05-10 19:41:23'),
(29, 17, 'hey', '2021-05-10 19:41:31'),
(30, 17, 'salut', '2021-05-10 19:41:36'),
(31, 17, 'Salut', '2021-05-10 19:44:37'),
(32, 17, 'Hey', '2021-05-10 19:44:41'),
(33, 17, 'salut', '2021-05-10 19:47:14'),
(34, 17, 'Hey', '2021-05-10 19:47:18'),
(35, 17, 'dsqd', '2021-05-10 20:31:36'),
(36, 17, 'dqsd', '2021-05-10 20:34:20'),
(37, 17, 'gfg', '2021-05-10 20:34:24'),
(38, 17, 'fdf', '2021-05-10 20:34:30'),
(39, 17, 'ds', '2021-05-10 20:36:02'),
(40, 17, 'dqsd', '2021-05-10 20:41:27'),
(41, 17, 'fdsf', '2021-05-10 20:43:21'),
(42, 17, 'Salut', '2021-05-26 22:31:25'),
(43, 17, 'fdf', '2021-05-29 00:33:05'),
(44, 17, 'dsds', '2021-05-29 00:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
`idCommentaire` int(11) NOT NULL,
  `idNews` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`idCommentaire`, `idNews`, `idUtilisateur`, `commentaire`, `dateCreation`) VALUES
(1, 1, 17, 'Super !', '2021-05-09 00:22:26'),
(2, 1, 17, 'dqsd', '2021-05-09 16:28:32'),
(3, 1, 17, 'trallala', '2021-05-09 16:30:02'),
(4, 1, 17, 'dsdsd', '2021-05-09 18:23:39'),
(5, 1, 17, 'fdf', '2021-05-10 16:39:21'),
(6, 1, 17, 'fdsff', '2021-05-10 16:39:26'),
(7, 1, 17, 'fdgdg', '2021-05-29 00:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `factures`
--

CREATE TABLE IF NOT EXISTS `factures` (
`idFacture` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `prixTotal` float NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=295 ;

--
-- Dumping data for table `factures`
--

INSERT INTO `factures` (`idFacture`, `idUtilisateur`, `prixTotal`, `dateCreation`) VALUES
(288, 17, 5189, '2021-05-26 21:34:38'),
(289, 17, 1587, '2021-05-26 22:29:59'),
(290, 17, 3300, '2021-05-26 23:08:38'),
(291, 17, 1200, '2021-05-26 23:10:11'),
(292, 17, 1200, '2021-05-26 23:10:47'),
(293, 17, 1500, '2021-05-26 23:12:14'),
(294, 17, 2857, '2021-05-29 00:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `lignesfacture`
--

CREATE TABLE IF NOT EXISTS `lignesfacture` (
`idLigne` int(11) NOT NULL,
  `idFacture` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prixLigne` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `lignesfacture`
--

INSERT INTO `lignesfacture` (`idLigne`, `idFacture`, `idArticle`, `quantite`, `prixLigne`) VALUES
(1, 288, 2, 8, 4800),
(2, 288, 3, 4, 24),
(3, 288, 4, 5, 65),
(4, 288, 5, 2, 300),
(5, 289, 1, 2, 1400),
(6, 289, 3, 4, 24),
(7, 289, 4, 1, 13),
(8, 289, 5, 1, 150),
(9, 290, 1, 4, 2800),
(10, 290, 6, 2, 500),
(11, 291, 1, 1, 700),
(12, 292, 1, 1, 700),
(13, 292, 6, 2, 500),
(14, 293, 6, 6, 1500),
(15, 294, 1, 1, 700),
(16, 294, 2, 3, 1800),
(17, 294, 3, 3, 18),
(18, 294, 4, 3, 39),
(19, 294, 5, 2, 300);

-- --------------------------------------------------------

--
-- Table structure for table `logconnexions`
--

CREATE TABLE IF NOT EXISTS `logconnexions` (
`idLogConnexion` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `dateConnexion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `logconnexions`
--

INSERT INTO `logconnexions` (`idLogConnexion`, `idUtilisateur`, `dateConnexion`) VALUES
(1, 17, '0000-00-00 00:00:00'),
(2, 17, '2021-05-08 00:00:00'),
(3, 17, '2021-05-08 22:08:46'),
(4, 17, '2021-05-08 22:54:58'),
(5, 17, '2021-05-08 23:01:00'),
(6, 17, '2021-05-08 23:02:03'),
(7, 17, '2021-05-08 23:03:31'),
(8, 17, '2021-05-08 23:04:19'),
(9, 17, '2021-05-09 16:18:59'),
(10, 17, '2021-05-09 16:19:09'),
(11, 17, '2021-05-09 16:19:48'),
(12, 17, '2021-05-09 17:48:58'),
(13, 17, '2021-05-09 17:49:36'),
(14, 17, '2021-05-09 17:49:41'),
(15, 17, '2021-05-09 17:50:15'),
(16, 17, '2021-05-09 17:50:20'),
(17, 17, '2021-05-09 17:50:34'),
(18, 17, '2021-05-09 17:56:46'),
(19, 17, '2021-05-09 18:00:00'),
(20, 17, '2021-05-09 18:04:52'),
(21, 16, '2021-05-09 18:19:56'),
(22, 16, '2021-05-09 18:19:57'),
(23, 16, '2021-05-09 18:19:57'),
(24, 16, '2021-05-09 18:19:57'),
(25, 16, '2021-05-09 18:19:57'),
(26, 16, '2021-05-09 18:19:58'),
(27, 16, '2021-05-09 18:20:17'),
(28, 16, '2021-05-09 18:20:23'),
(29, 16, '2021-05-09 18:20:23'),
(30, 17, '2021-05-09 18:23:27'),
(31, 17, '2021-05-09 18:23:33'),
(32, 17, '2021-05-09 21:02:54'),
(33, 17, '2021-05-09 23:50:28'),
(34, 17, '2021-05-09 23:59:26'),
(35, 17, '2021-05-10 16:32:02'),
(36, 16, '2021-05-10 16:32:10'),
(37, 17, '2021-05-10 16:34:25'),
(38, 17, '2021-05-10 20:09:32'),
(39, 17, '2021-05-10 20:09:50'),
(40, 17, '2021-05-10 20:30:59'),
(41, 17, '2021-05-25 23:59:07'),
(42, 17, '2021-05-26 16:33:21'),
(43, 17, '2021-05-26 16:58:37'),
(44, 17, '2021-05-26 16:58:44'),
(45, 17, '2021-05-26 16:58:49'),
(46, 17, '2021-05-26 17:18:16'),
(47, 17, '2021-05-26 19:18:44'),
(48, 17, '2021-05-26 21:13:14'),
(49, 17, '2021-05-26 22:28:19'),
(50, 17, '2021-05-29 00:31:47'),
(51, 17, '2021-05-29 00:33:58'),
(52, 17, '2021-05-30 23:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`idNews` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `titre` text NOT NULL,
  `corps` text NOT NULL,
  `dateCreation` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`idNews`, `idUtilisateur`, `titre`, `corps`, `dateCreation`) VALUES
(1, 16, 'La toute première news', 'Bienvenue sur le site, ceci est la toute première news faite lors de la création du site !', '2021-05-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
`idUtilisateur` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `adresse` text NOT NULL,
  `cp` int(11) NOT NULL,
  `dateDeNaissance` date DEFAULT NULL,
  `email` text,
  `login` text NOT NULL,
  `motDePasse` text NOT NULL,
  `avatar` text NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `indesirable` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `adresse`, `cp`, `dateDeNaissance`, `email`, `login`, `motDePasse`, `avatar`, `admin`, `dateInscription`, `indesirable`) VALUES
(16, 'Marcel', 'Florent', 'Rue tournibouge 23', 7830, '2021-05-03', 'dsf@dqsd', 'flo1', '$2y$10$wawfTrK9PDGkxLiDqaN/5ukDyZmZUW7JhJtDCNPQ2QKOj/2jhmwLi', 'images/flo1.jpeg', 0, '2021-05-03 20:39:42', 0),
(17, 'Marcel', 'Florent', 'Rue tournibouge 2', 7830, '1993-08-28', 'dqsdq@fdqdq', 'flo', '$2y$10$SMT9qQVK6oUlWopdqlRmfOu7Kod6zs52GCMzIK7r2y7MUJizxY6QS', './images/flo.jpg', 1, '2021-05-08 02:44:33', 0),
(18, 'Marcel', 'Florent', 'Rue tournibouge 23', 7830, '2021-05-05', 'marcel.florent@hotmail.com', 'Florent', '$2y$10$rCU3Ur2.R3nRqkzx0L69TuEHzDU1pekS.e1BL38RaqNJgTfBkHeKm', '', 0, '2021-05-09 17:04:41', 0),
(19, 'Marcel', 'Florent', 'Rue tournibouge 23', 7830, '2021-05-11', 'dqsdq@fdqdq', 'flo2', '$2y$10$RCuGdAW85bB7klXfd7MWtOHPYalpb99VdeIv0GzyK9bwvK6xvMDRG', '', 0, '2021-05-09 17:19:44', 0),
(20, 'Marcel', 'Florent', 'Rue tournibouge 23', 7830, '2021-04-27', 'dqsdq@fdqdq2', 'dsf23', '$2y$10$hGK2Gqcb3ZnDEX1mD1jZUuI7NMb.BFbu5vfE/UWAnYwAGUeBHyAN6', '', 0, '2021-05-09 17:28:00', 0),
(21, 'Marcel', 'Florent', 'Rue tournibouge 23', 7830, '2021-05-12', 'xeldarflo@hotmail.comf', 'flo5', '$2y$10$qXou5lgqfxAxFAawVNVjueYNr.JCFMqZ0WMOlNJKN5BB9Z.6k16MG', '', 0, '2021-05-09 17:36:08', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
 ADD PRIMARY KEY (`idArticle`);

--
-- Indexes for table `chatmessages`
--
ALTER TABLE `chatmessages`
 ADD PRIMARY KEY (`idChatMessage`), ADD KEY `indexIdUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
 ADD PRIMARY KEY (`idCommentaire`), ADD KEY `idUtilisateur` (`idUtilisateur`), ADD KEY `idNews` (`idNews`);

--
-- Indexes for table `factures`
--
ALTER TABLE `factures`
 ADD PRIMARY KEY (`idFacture`), ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `lignesfacture`
--
ALTER TABLE `lignesfacture`
 ADD PRIMARY KEY (`idLigne`), ADD KEY `idArticle` (`idArticle`), ADD KEY `idFacture` (`idFacture`);

--
-- Indexes for table `logconnexions`
--
ALTER TABLE `logconnexions`
 ADD PRIMARY KEY (`idLogConnexion`), ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`idNews`), ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
 ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `chatmessages`
--
ALTER TABLE `chatmessages`
MODIFY `idChatMessage` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
MODIFY `idCommentaire` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
MODIFY `idFacture` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=295;
--
-- AUTO_INCREMENT for table `lignesfacture`
--
ALTER TABLE `lignesfacture`
MODIFY `idLigne` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `logconnexions`
--
ALTER TABLE `logconnexions`
MODIFY `idLogConnexion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `idNews` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatmessages`
--
ALTER TABLE `chatmessages`
ADD CONSTRAINT `chatmessages_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`) ON UPDATE CASCADE;

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`) ON UPDATE CASCADE,
ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`idNews`) REFERENCES `news` (`idNews`) ON UPDATE CASCADE;

--
-- Constraints for table `factures`
--
ALTER TABLE `factures`
ADD CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`) ON UPDATE CASCADE;

--
-- Constraints for table `lignesfacture`
--
ALTER TABLE `lignesfacture`
ADD CONSTRAINT `lignesfacture_ibfk_1` FOREIGN KEY (`idArticle`) REFERENCES `articles` (`idArticle`) ON UPDATE CASCADE,
ADD CONSTRAINT `lignesfacture_ibfk_2` FOREIGN KEY (`idFacture`) REFERENCES `factures` (`idFacture`) ON UPDATE CASCADE;

--
-- Constraints for table `logconnexions`
--
ALTER TABLE `logconnexions`
ADD CONSTRAINT `logconnexions_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`) ON UPDATE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
