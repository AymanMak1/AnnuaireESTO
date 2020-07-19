-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 17, 2020 at 04:27 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annuaireesto`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `ID_ADMINISTRATEUR` int(11) NOT NULL AUTO_INCREMENT,
  `PPR_ADMINISTRATEUR` varchar(20) DEFAULT NULL,
  `NOM` varchar(55) DEFAULT NULL,
  `PRENOM` varchar(55) DEFAULT NULL,
  `DESCRIPTION` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `TELEPHONE` varchar(10) DEFAULT NULL,
  `MOTDEPASSE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_ADMINISTRATEUR`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`ID_ADMINISTRATEUR`, `PPR_ADMINISTRATEUR`, `NOM`, `PRENOM`, `DESCRIPTION`, `EMAIL`, `TELEPHONE`, `MOTDEPASSE`) VALUES
(1, '778899', 'KORIKACHE', 'Reda', 'Administrateur', 'Korikachereda@gmail.com', '648541562', 'f6ab520cdebf4664aa1ce1519d6989d43e56bb314c1a43ab9bcbe5ebbfdfbe2ce6b6c111b787b8c6631cf4972c74b4ecd56011a6d8f0df46b82d8c29ec650a11'),
(2, '1545466', 'BARKAOUI', 'Alae-Eddine ', 'Administrateur', 'a.barkaoui@ump.ac.ma', '741541521', 'f5a23da60269aae078ef0d80d5b37652be80b0ce43e2a09d31042d1076057415f33f5706601955fea36034d450f9c5a4474abfda62c3dde5d73e54ab4cbc626f'),
(3, '1172804', 'elboukhari', 'mohamed', 'Administrateur', 'elboukhari.mohamed@gmail.com', '674879594', '2e4be3a4a1a29665914696e7e19b8c55fd42681954088308ac97a234dcb425c83aad36acfa829b925aa80276d18e8cedda26c2f29513f7288a484b54c47893d3');

-- --------------------------------------------------------

--
-- Table structure for table `appartenir_enseignant`
--

DROP TABLE IF EXISTS `appartenir_enseignant`;
CREATE TABLE IF NOT EXISTS `appartenir_enseignant` (
  `ID_FILIERE` int(11) NOT NULL,
  `ID_ENSEIGNANT` int(11) NOT NULL,
  PRIMARY KEY (`ID_FILIERE`,`ID_ENSEIGNANT`),
  KEY `FK_APPARTENIR_ENSEIGNANT` (`ID_ENSEIGNANT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appartenir_enseignant`
--

INSERT INTO `appartenir_enseignant` (`ID_FILIERE`, `ID_ENSEIGNANT`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(10, 3),
(14, 2),
(14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `ID_ENSEIGNANT` int(11) NOT NULL AUTO_INCREMENT,
  `PPR_ENSEIGNANT` varchar(20) DEFAULT NULL,
  `NOM` varchar(55) DEFAULT NULL,
  `PRENOM` varchar(55) DEFAULT NULL,
  `DESCRIPTION` varchar(20) NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `TELEPHONE` varchar(10) DEFAULT NULL,
  `MOTDEPASSE` varchar(255) DEFAULT NULL,
  `CONFIRMED` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID_ENSEIGNANT`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`ID_ENSEIGNANT`, `PPR_ENSEIGNANT`, `NOM`, `PRENOM`, `DESCRIPTION`, `EMAIL`, `TELEPHONE`, `MOTDEPASSE`, `CONFIRMED`) VALUES
(1, '59264', 'ZROURI', 'Hafida', 'Enseignant', 'zrouri_GL@yahoo.fr', '600112233', 'caf75198278b6ea4f895bedae91886492c1eb7bbb5a37b099c969fdd44aa76cff94d7f8cd95a3d768c9088dfbe9d4eba6466c5fd715d19a3b51b191892ba8134', 1),
(2, '398583', 'SERGHINI', 'Hafid', 'Enseignant', 'hafid.serghini@hotmail.fr', '622334455', 'fbd96ec4cccb5a0a58534952ca7da19ddc89562ad9f5c73f160a0949dd8b05836c0cd7fbae455d64d030ff2e4db50046bcf739c40d3bf7bba908544d8c65ea79', 0),
(3, '1050958', 'KODAD', 'Mohcine', 'Enseignant', 'kodad.mohcine@gmail.com', '688994422', '928cdd81e90bcd47e429fed6131f9c06c9248e76113afee469a5608300303a2464d7e5ac20240777405fa9d077bd6583039b7c3d4e25f0d42b290fcc0e67ae76', 0),
(4, '720486', 'KASMI', 'Mohammed Amine', 'Enseignant', 'kasmi.mohammedamine@gmail.com', '648787451', '58f28468da6bb25012c4456f747cc2da08b350f6d583ad9f6c75b434bb07e93d62c10df8e008132dcf3e745ac41b72488c972822b833fb19a25a20c76dc80ae2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ID_ETUDIANT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_FILIERE` int(11) NOT NULL,
  `CNE` varchar(10) DEFAULT NULL,
  `NOM` varchar(55) DEFAULT NULL,
  `PRENOM` varchar(55) DEFAULT NULL,
  `DESCRIPTION` varchar(20) NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `TELEPHONE` varchar(10) DEFAULT NULL,
  `MOTDEPASSE` varchar(255) DEFAULT NULL,
  `CONFIRMED` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID_ETUDIANT`),
  KEY `FK_APPARTENIR_ETUDIANT` (`ID_FILIERE`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`ID_ETUDIANT`, `ID_FILIERE`, `CNE`, `NOM`, `PRENOM`, `DESCRIPTION`, `EMAIL`, `TELEPHONE`, `MOTDEPASSE`, `CONFIRMED`) VALUES
(1, 1, 'H137204761', 'MAKHOUKHI', 'Ayman', 'Etudiant', 'ayman.makhoukhi@gmail.com', '600159519', '2d298b6ad28cd9710d7d0679f2b39c300a59f8c5d81620f251700d456a2d28e79039de35a5fda00e6d68bfdf06582355f60744bd333874ef46ae04a0991c25ad', 0),
(2, 1, 'H110037497', 'EL WAHIDI EL ALAOUI', 'Nada', 'Etudiant', 'nada.ea28@gmail.com', '682398742', '64a1371146e04dfad89a09b150c8eb81bec2691002449f8a7fa5f6a67bcd0ab9939d1a137001d63116eab08755a6b10ab41c1461048430641c56f1572f1b21c8', 0),
(3, 2, 'H146584878', 'CHERCHEM', 'Yassine', 'Etudiant', 'yassine.cherchem@gmail.com', '688994455', '932055ae3f2126cebca8a2bac7a7565357d0612184689dcb049ad72cf2b478cfd279b7f125aa66e22bfce5026b5454cd832586c288df8c7b88b19054d2b59ff9', 1),
(4, 1, 'H140484848', 'JABRI', 'Mohamed', 'Etudiant', 'mjr2020@gmail.com', '682027649', '8ad9429e13295022232721d94f610e1bccb6459aa82e2352159375b68acbf519ccaea64ece2149f71c1eac4548a4451835da14d90d2531883e03bc1663fac020', 0),
(5, 8, 'H137484848', 'SALHI', 'Khaoula', 'Etudiant', 'khaoula.salhi@gmail.com', '677201700', '6b0d0ef1603de27e5c703693e7d4b3c5933f6356d0e4bc0c0ecc067aec34139944ede213c15e37c74f419da86cf909fc1b263bd663dd3432ba03720878cecd34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `ID_FILIERE` int(11) NOT NULL AUTO_INCREMENT,
  `ABR_FILIERE` varchar(4) DEFAULT NULL,
  `LIBELLE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_FILIERE`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`ID_FILIERE`, `ABR_FILIERE`, `LIBELLE`) VALUES
(1, 'DAI', 'Développeur d\'applications Informatiques'),
(2, 'ASR', 'Administrateur de Systèmes et Réseaux'),
(3, 'EII', 'Electronique et Informatique Industrielle'),
(4, 'GEER', 'Génie Electrique et Energies Renouvelables'),
(5, 'GC', 'Génie Civil '),
(6, 'MC', 'Mécatronique Industrielle'),
(7, 'TDEA', 'Technologie et Diagnostique Electronique Automobile'),
(8, 'GBA', 'Gestion des Banques et Assurances'),
(9, 'FCF', 'Finance, Comptabilité et Fiscalité'),
(10, 'IGE', 'Informatique et Gestion des Entreprises'),
(11, 'GLT', 'Gestion Logistique et Transport '),
(12, 'WM', 'Web Marketing'),
(13, 'TVSC', 'Techniques de Vente et Service Client'),
(14, 'IG', 'Informatique de Gestion'),
(15, 'GIE', 'Génie Informatique Embarquée '),
(16, 'GIM', 'Génie Industriel et Maintenance');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
