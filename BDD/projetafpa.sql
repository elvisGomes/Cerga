-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 17 oct. 2019 à 13:57
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetafpa`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `BILAN_GENERAL`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `BILAN_GENERAL` (OUT `cptForm` INT, OUT `cptCdd` INT, OUT `cptCdi` INT, OUT `cptCieCdi` INT, OUT `cptCrea` INT, OUT `cptCieCdd` INT, OUT `cptAide` INT, OUT `cptInsert` INT, OUT `cptRetraite` INT, OUT `cptSiae` INT, OUT `cptDemenagement` INT, OUT `cptAutreRsa` INT, OUT `cptSante` INT, OUT `cptAutreSortie` INT, OUT `cptFinAction` INT, OUT `cptPole` INT, OUT `cptAutreAction` INT, OUT `cptAbandon` INT, OUT `dateMois` DATE, OUT `cptAccompagne` INT, OUT `cptEntree` INT, OUT `txOccup` INT, OUT `placeDispo` INT, OUT `totEmploiDur` INT, OUT `totEmploiTrans` INT, OUT `totSortiePos` INT, OUT `totSortieDynam` INT, OUT `totSortieLegit` INT, OUT `totSortieAutre` INT, OUT `totSortie` INT)  NO SQL
BEGIN
        SELECT count(*) INTO @cptForm FROM situation WHERE situation = "Formation qualifiante" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
        SET cptForm = @cptForm;
    
    	SELECT count(*) INTO @cptCdd FROM situation WHERE situation = "CDD et intÃ©rims et saison" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin));
    	SET cptCdd = @cptCdd;
        
        SELECT count(*) INTO @cptCdi FROM situation WHERE situation = "CDI et fonction publique" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin));
    	SET cptCdi = @cptCdi;
        
    
    	SELECT count(*) INTO @cptCieCdi FROM situation WHERE situation = "CIE en CDI" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
    	SET cptCieCdi = @cptCieCdi;
    
    	SELECT count(*) INTO @cptCrea FROM situation WHERE situation = "CrÃ©ation ou reprise d'entreprise" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
    	SET cptCrea  = @cptCrea ;
    
    	SELECT count(*) INTO @cptCieCdd FROM situation WHERE situation = "CIE en CDD" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
    	SET cptCieCdd = @cptCieCdd;
    
    	SELECT count(*) INTO @cptAide FROM situation WHERE situation = "Contrats aidÃ©s en CDD" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
    	SET cptAide  = @cptAide ;
    
    	SELECT count(*) INTO @cptInsert FROM situation WHERE situation = "Autre action insertion professionnelle" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
    	SET cptInsert = @cptInsert;
    
    	SELECT count(*) INTO @cptRetraite FROM situation WHERE situation = "Droit retraite" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
    	SET cptRetraite = @cptRetraite;
    
    	SELECT count(*) INTO @cptSiae FROM situation WHERE situation = "autre SIAE" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
    	SET cptSiae = @cptSiae;
    
    	SELECT count(*) INTO @cptDemenagement FROM situation WHERE situation = "DÃ©mÃ©nagement" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
    	SET cptDemenagement = @cptDemenagement;
    
    	SELECT count(*) INTO @cptAutreRsa FROM situation WHERE situation = "Autre droit que RSA" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
    	SET cptAutreRsa = @cptAutreRsa;
    
    	SELECT count(*) INTO @cptSante FROM situation WHERE situation = "ProblÃ¨me santÃ©" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
    	SET cptSante = @cptSante;
    
    	SELECT count(*) INTO @cptAutreSortie FROM situation WHERE situation = "Autre sortie lÃ©gitime" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
   		 SET cptAutreSortie = @cptAutreSortie;
    
        SELECT count(*) INTO @cptFinAction FROM situation WHERE situation = "Fin d'action" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
       	SET cptFinAction = @cptFinAction;

        SELECT count(*) INTO @cptPole FROM situation WHERE situation = "PÃ´le emploi" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
        SET cptPole = @cptPole;

        SELECT count(*) INTO @cptAutreAction FROM situation WHERE situation = "Autre action d'insertion sociale" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
        SET cptAutreAction = @cptAutreAction;
        
        SELECT count(*) INTO @cptAbandon FROM situation WHERE situation = "Abandon" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) ;
        SET cptAbandon = @cptAbandon;
        
    	SELECT  DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) INTO @dateMois;
    
    	SET dateMois = @dateMois;
        
   		SELECT count(*) INTO @cptEntree FROM accompagne WHERE 					dateOuverture >= dateMois and dateOuverture < CURRENT_DATE;
   		SET cptEntree = @cptEntree;
        
        SELECT count(*) INTO @cptAccompagne FROM accompagne WHERE 	dateFermeture > CURRENT_DATE;
   	SET cptAccompagne = @cptAccompagne;
    SET txOccup = (cptAccompagne * 100) / 180;
    SET placeDispo = 180 - cptAccompagne;
    SET totEmploiDur = cptCdi + cptCdd + cptCieCdi + cptCrea;
    SET totEmploiTrans = cptCieCdd + cptAide;
    SET totSortiePos = cptCdi + cptCieCdi + cptCieCdd;
    SET totSortieDynam = cptCdd + cptCrea + cptAide + cptForm + cptInsert + cptSiae + cptRetraite;
    SET totSortieLegit = cptDemenagement + cptAutreRsa + cptSante + cptAutreSortie;
    SET totSortieAutre = cptFinAction + cptPole + cptAutreAction + cptAbandon;
    SET totSortie = totSortieLegit + totSortieAutre + totSortieDynam + totSortiePos;
    
    
    INSERT INTO bilan_general (nb_sortie, total_autre_sorties, total_sortie_legit, total_sorties_dynam, total_sorties_pos,total_emploi_trans, total_emploi_dur, mois_rapport,nb_entree, accomp_mensuel, tx_occup, place_dispo, cdd_interim_saison, formation_qualif, cdi_fonction_publique, cie_en_cdi, creation_entreprise, cie_en_cdd, contrat_aides_cdd, autre_insertion_prof, droit_retraite,	autre_siae,	demenag, autre_droit_que_rsa, probleme_sante, autre_sortie_legitime, fin_action, pole_emploi, autre_action_insertion_sociale, abandon) VALUES(totSortie, totSortieAutre, totSortieLegit, totSortieDynam, totSortiePos, totEmploiTrans, totEmploiDur, dateMois, cptEntree, cptAccompagne, txOccup, placeDispo, cptCdd, cptForm, cptCdi, cptCieCdi, cptCrea, cptCieCdd, cptAide, cptInsert, cptRetraite, cptSiae, cptDemenagement, cptAutreRsa, cptSante, cptAutreSortie, cptFinAction, cptPole, cptAutreAction, cptAbandon);
    
    
 END$$

DROP PROCEDURE IF EXISTS `BILAN_GENERAL_TEST`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `BILAN_GENERAL_TEST` (OUT `cptForm` INT, OUT `cptCdd` INT, OUT `cptCdi` INT, OUT `cptCieCdi` INT, OUT `cptCrea` INT, OUT `cptCieCdd` INT, OUT `cptAide` INT, OUT `cptInsert` INT, OUT `cptRetraite` INT, OUT `cptSiae` INT, OUT `cptDemenagement` INT, OUT `cptAutreRsa` INT, OUT `cptSante` INT, OUT `cptAutreSortie` INT, OUT `cptFinAction` INT, OUT `cptPole` INT, OUT `cptAutreAction` INT, OUT `cptAbandon` INT, OUT `dateMois` DATE, OUT `cptAccompagne` INT, OUT `cptEntree` FLOAT, OUT `txOccup` INT, OUT `placeDispo` INT, OUT `totEmploiDur` INT, OUT `totEmploiTrans` INT, OUT `totSortiePos` INT, OUT `totSortieDynam` INT, OUT `totSortieLegit` INT, OUT `totSortieAutre` INT, OUT `totSortie` INT)  NO SQL
BEGIN
		SELECT  DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) INTO @dateMois;
    
    	SET dateMois = @dateMois;
        
SELECT count(*) INTO @cptForm FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "Formation qualifiante" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
        SET cptForm = @cptForm;
    
    	 SELECT count(*) INTO @cptCdd FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "CDD et intÃ©rims et saison" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptCdd = @cptCdd;
        
        SELECT count(*) INTO @cptCdi FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "CDI et fonction publique" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptCdi = @cptCdi;
        
    
    	SELECT count(*) INTO @cptCieCdi FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "CIE en CDI" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptCieCdi = @cptCieCdi;
    
    	SELECT count(*) INTO @cptCrea FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "CrÃ©ation ou reprise d'entreprise" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptCrea  = @cptCrea ;
    
    		SELECT count(*) INTO @cptCieCdd FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "CIE en CDD" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture >dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptCieCdd = @cptCieCdd;
    
    		SELECT count(*) INTO @cptAide FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "Contrats aidÃ©s en CDD" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptAide  = @cptAide ;
    
    	SELECT count(*) INTO @cptInsert FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "Autre action insertion professionnelle" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptInsert = @cptInsert;
    
    	SELECT count(*) INTO @cptRetraite FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "Droit retraite" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptRetraite = @cptRetraite;
    
    	SELECT count(*) INTO @cptSiae FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "autre SIAE" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptSiae = @cptSiae;
    
    	SELECT count(*) INTO @cptDemenagement FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "DÃ©mÃ©nagement" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptDemenagement = @cptDemenagement;
    
    	SELECT count(*) INTO @cptAutreRsa FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "Autre droit que RSA" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptAutreRsa = @cptAutreRsa;
    
    	SELECT count(*) INTO @cptSante FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "ProblÃ¨me santÃ©" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
    	SET cptSante = @cptSante;
    
    	
    	SELECT count(*) INTO @cptAutreSortie FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "Autre sortie lÃ©gitime" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
   		 SET cptAutreSortie = @cptAutreSortie;
    
        SELECT count(*) INTO @cptFinAction FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "Fin d'action" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
       	SET cptFinAction = @cptFinAction;
        
		SELECT count(*) INTO @cptPole FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "PÃ´le emploi" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
        SET cptPole = @cptPole;

        SELECT count(*) INTO @cptAutreAction FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "Autre action d'insertion sociale" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
        SET cptAutreAction = @cptAutreAction;
        
      SELECT count(*) INTO @cptAbandon FROM situation , accompagne WHERE accompagne.allocataireNumber = situation.allocataireNumber AND  situation.situation = "Abandon" AND (date_fin > CURRENT_DATE OR ISNULL(date_fin)) AND accompagne.dateOuverture IS NOT NULL AND accompagne.dateFermeture > dateMois AND `dateOuverture`< CURRENT_DATE;
        SET cptAbandon = @cptAbandon;
        
    	
        
   		SELECT count(*) INTO @cptEntree FROM accompagne WHERE 					dateOuverture >= dateMois and dateOuverture < CURRENT_DATE;
   		SET cptEntree = @cptEntree;
        
        SELECT count(*) INTO @cptAccompagne FROM accompagne WHERE 	dateFermeture > CURRENT_DATE;
   	SET cptAccompagne = @cptAccompagne;
    SET txOccup = (cptAccompagne * 100) / 180;
    SET placeDispo = 180 - cptAccompagne;
    SET totEmploiDur = cptCdi + cptCdd + cptCieCdi + cptCrea;
    SET totEmploiTrans = cptCieCdd + cptAide;
    SET totSortiePos = cptCdi + cptCieCdi + cptCieCdd;
    SET totSortieDynam = cptCdd + cptCrea + cptAide + cptForm + cptInsert + cptSiae + cptRetraite;
    SET totSortieLegit = cptDemenagement + cptAutreRsa + cptSante + cptAutreSortie;
    SET totSortieAutre = cptFinAction + cptPole + cptAutreAction + cptAbandon;
    SET totSortie = totSortieLegit + totSortieAutre + totSortieDynam + totSortiePos;
    
    
    INSERT INTO bilan_general (nb_sortie, total_autre_sorties, total_sortie_legit, total_sorties_dynam, total_sorties_pos,total_emploi_trans, total_emploi_dur, mois_rapport,nb_entree, accomp_mensuel, tx_occup, place_dispo, cdd_interim_saison, formation_qualif, cdi_fonction_publique, cie_en_cdi, creation_entreprise, cie_en_cdd, contrat_aides_cdd, autre_insertion_prof, droit_retraite,	autre_siae,	demenag, autre_droit_que_rsa, probleme_sante, autre_sortie_legitime, fin_action, pole_emploi, autre_action_insertion_sociale, abandon) VALUES(totSortie, totSortieAutre, totSortieLegit, totSortieDynam, totSortiePos, totEmploiTrans, totEmploiDur, dateMois, cptEntree, cptAccompagne, txOccup, placeDispo, cptCdd, cptForm, cptCdi, cptCieCdi, cptCrea, cptCieCdd, cptAide, cptInsert, cptRetraite, cptSiae, cptDemenagement, cptAutreRsa, cptSante, cptAutreSortie, cptFinAction, cptPole, cptAutreAction, cptAbandon);
    
    
 END$$

DROP PROCEDURE IF EXISTS `DELETE_EVENT`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_EVENT` ()  NO SQL
BEGIN 
	DELETE FROM EVENT WHERE status = 1;
END$$

DROP PROCEDURE IF EXISTS `testDate`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `testDate` (OUT `dateMois` DATE, OUT `cptAccompagne` INT, OUT `placeDispo` INT)  NO SQL
BEGIN 
	SELECT  DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) INTO @dateMois;
    
    SET dateMois = @dateMois;
    
    SELECT count(*) INTO @cptAccompagne FROM accompagne WHERE dateFermeture > CURRENT_DATE;
   SET cptAccompagne = @cptAccompagne;
   SET placeDispo = 180 - cptAccompagne ;
   
    INSERT INTO bilan_general (place_dispo) VALUES (placeDispo);
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `accompagne`
--

DROP TABLE IF EXISTS `accompagne`;
CREATE TABLE IF NOT EXISTS `accompagne` (
  `allocataireNumber` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `dateOuverture` date DEFAULT NULL,
  `dateFermeture` date DEFAULT NULL,
  `type_d_accompagnement` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `accompagne`
--

INSERT INTO `accompagne` (`allocataireNumber`, `email`, `dateOuverture`, `dateFermeture`, `type_d_accompagnement`, `ID`) VALUES
(5648948, 'kamir@gmail.com', '2019-10-02', '2019-10-29', 'Accompagnement insertion', 31);

-- --------------------------------------------------------

--
-- Structure de la table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `Email` varchar(155) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `allocataire`
--

DROP TABLE IF EXISTS `allocataire`;
CREATE TABLE IF NOT EXISTS `allocataire` (
  `allocataireNumber` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `firstName` varchar(50) COLLATE utf8_bin NOT NULL,
  `birthDate` date NOT NULL,
  `gender` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`allocataireNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `allocataire`
--

INSERT INTO `allocataire` (`allocataireNumber`, `name`, `firstName`, `birthDate`, `gender`) VALUES
(5648948, 'Smith', 'Paul', '1990-11-17', 'Monsieur');

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

DROP TABLE IF EXISTS `atelier`;
CREATE TABLE IF NOT EXISTS `atelier` (
  `numeroAtelier` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `typeAtelier` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `allocataireNumber` int(11) NOT NULL,
  `dateParticipation` date NOT NULL,
  `email` varchar(150) COLLATE utf8_bin NOT NULL,
  `modifierPar` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`numeroAtelier`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `atelier`
--

INSERT INTO `atelier` (`numeroAtelier`, `date`, `typeAtelier`, `description`, `allocataireNumber`, `dateParticipation`, `email`, `modifierPar`) VALUES
(9, '2019-10-03', 'CV', 'dsqdq', 5648948, '2019-10-27', 'kamir@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bilan_general`
--

DROP TABLE IF EXISTS `bilan_general`;
CREATE TABLE IF NOT EXISTS `bilan_general` (
  `ID_bilan` int(11) NOT NULL AUTO_INCREMENT,
  `mois_rapport` date DEFAULT NULL,
  `reporting` varchar(50) DEFAULT NULL,
  `date_premier_jour` date DEFAULT NULL,
  `nb_entree` int(11) DEFAULT NULL,
  `accomp_mensuel` int(11) DEFAULT NULL,
  `tx_occup` float DEFAULT NULL,
  `place_dispo` int(11) DEFAULT NULL,
  `nb_sortie` int(11) DEFAULT NULL,
  `cdi_fonction_publique` int(11) DEFAULT NULL,
  `cdd_interim_saison` int(11) DEFAULT NULL,
  `cie_en_cdi` int(11) DEFAULT NULL,
  `creation_entreprise` int(11) DEFAULT NULL,
  `total_emploi_dur` int(11) DEFAULT NULL,
  `cie_en_cdd` int(11) DEFAULT NULL,
  `contrat_aides_cdd` int(11) DEFAULT NULL,
  `total_emploi_trans` int(11) DEFAULT NULL,
  `formation_qualif` int(11) DEFAULT NULL,
  `autre_insertion_prof` int(11) DEFAULT NULL,
  `droit_retraite` int(11) DEFAULT NULL,
  `autre_siae` int(11) DEFAULT NULL,
  `total_sorties_pos` int(11) DEFAULT NULL,
  `total_sorties_dynam` int(11) DEFAULT NULL,
  `demenag` int(11) DEFAULT NULL,
  `autre_droit_que_rsa` int(11) DEFAULT NULL,
  `probleme_sante` int(11) DEFAULT NULL,
  `autre_sortie_legitime` int(11) DEFAULT NULL,
  `total_sortie_legit` int(11) DEFAULT NULL,
  `fin_action` int(11) DEFAULT NULL,
  `pole_emploi` int(11) DEFAULT NULL,
  `autre_action_insertion_sociale` int(11) DEFAULT NULL,
  `abandon` int(11) DEFAULT NULL,
  `total_autre_sorties` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_bilan`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bilan_general`
--

INSERT INTO `bilan_general` (`ID_bilan`, `mois_rapport`, `reporting`, `date_premier_jour`, `nb_entree`, `accomp_mensuel`, `tx_occup`, `place_dispo`, `nb_sortie`, `cdi_fonction_publique`, `cdd_interim_saison`, `cie_en_cdi`, `creation_entreprise`, `total_emploi_dur`, `cie_en_cdd`, `contrat_aides_cdd`, `total_emploi_trans`, `formation_qualif`, `autre_insertion_prof`, `droit_retraite`, `autre_siae`, `total_sorties_pos`, `total_sorties_dynam`, `demenag`, `autre_droit_que_rsa`, `probleme_sante`, `autre_sortie_legitime`, `total_sortie_legit`, `fin_action`, `pole_emploi`, `autre_action_insertion_sociale`, `abandon`, `total_autre_sorties`) VALUES
(117, '2019-09-04', NULL, NULL, 18, 18, 10, 162, 18, 1, 1, 1, 1, 4, 0, 1, 1, 1, 1, 1, 2, 2, 8, 1, 1, 1, 1, 4, 1, 1, 1, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `ID_event` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID_event`)
) ENGINE=MyISAM AUTO_INCREMENT=263 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`ID_event`, `event`, `email`, `status`) VALUES
(262, 'Le <strong>CER</strong> de <strong>Smith</strong>.<strong>Paul,</strong> NÂ° Allocataire : <strong>5648948</strong> se termine le mardi 29 octobre 2019.', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `Id_historique` int(11) NOT NULL AUTO_INCREMENT,
  `date_connection` datetime DEFAULT CURRENT_TIMESTAMP,
  `adresse_IP` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `poste` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `user` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`Id_historique`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`Id_historique`, `date_connection`, `adresse_IP`, `poste`, `user`) VALUES
(1, '2019-10-17 15:52:18', '192.168.56.1', 'STA6017747', 'kamir@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `infos_complementaires`
--

DROP TABLE IF EXISTS `infos_complementaires`;
CREATE TABLE IF NOT EXISTS `infos_complementaires` (
  `ID_INFO` int(11) NOT NULL AUTO_INCREMENT,
  `placeOfBirth` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `nativeCountry` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `driverSLicense` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `adress` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `phoneNumber` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `numero_reference` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `allocataireNumber` int(11) DEFAULT NULL,
  `IDPE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `RQTH` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `codePostal` int(11) DEFAULT NULL,
  `ville` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `reference` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `conseiller` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `allocataireTravail` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `dateTravail` date DEFAULT NULL,
  `heureMensuelle` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `dejaTravailler` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `dernierContrat` date DEFAULT NULL,
  `statutAllocataire` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `niveauEtude` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `reconnuEnFrance` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `maitriseFrancais` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `couvertureSocial` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `logement` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `nb_enfants` int(11) DEFAULT NULL,
  `situation_familial` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `autre_structure` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `date_ouverture` date DEFAULT NULL,
  PRIMARY KEY (`ID_INFO`),
  KEY `INFOS_COMPLEMENTAIRES_allocataire0_FK` (`allocataireNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `infos_complementaires`
--

INSERT INTO `infos_complementaires` (`ID_INFO`, `placeOfBirth`, `nativeCountry`, `driverSLicense`, `adress`, `phoneNumber`, `mail`, `numero_reference`, `allocataireNumber`, `IDPE`, `RQTH`, `codePostal`, `ville`, `reference`, `conseiller`, `allocataireTravail`, `dateTravail`, `heureMensuelle`, `dejaTravailler`, `dernierContrat`, `statutAllocataire`, `niveauEtude`, `reconnuEnFrance`, `maitriseFrancais`, `couvertureSocial`, `logement`, `nb_enfants`, `situation_familial`, `autre_structure`, `date_ouverture`) VALUES
(23, 'Roubaix', 'France', 'oui', '25 rue d\'alger', '0254568955', 'paul@gmail.com', '253614', 5648948, '986532Z', 'non', 59100, 'Roubaix', 'assistantesocial@mail.com', 'polemploi@pole-emploi.com', 'oui', '2019-09-04', '40', 'oui', '2019-10-03', 'Entrepreneur indÃ©pendant', 'Bac +2 (niveau III)', 'oui', 'parle lu ecrit', 'oui', 'PropriÃ©taire', 5, 'MariÃ©(e)', 'idformation@mail.com', '2019-10-14');

-- --------------------------------------------------------

--
-- Structure de la table `item_sociaux`
--

DROP TABLE IF EXISTS `item_sociaux`;
CREATE TABLE IF NOT EXISTS `item_sociaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `socialType` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `autre` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `comment_administratif` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_logement` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_garde` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_aide` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_transport` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_lecture` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_formation` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_lien` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment_sante` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `allocataireNumber` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_sociaux_allocataire0_FK` (`allocataireNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `item_sociaux`
--

INSERT INTO `item_sociaux` (`id`, `socialType`, `autre`, `comment_administratif`, `comment_logement`, `comment_garde`, `comment_aide`, `comment_transport`, `comment_lecture`, `comment_formation`, `comment_lien`, `comment_sante`, `allocataireNumber`) VALUES
(23, ' logement Lien social aide Financiere', '', 'eee', '', 'aaa', 'dsqdq', '', '', '', '', '', 5648948);

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

DROP TABLE IF EXISTS `rapport`;
CREATE TABLE IF NOT EXISTS `rapport` (
  `numeroRapport` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `typeRapport` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `allocataireNumber` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8_bin NOT NULL,
  `modifierPar` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`numeroRapport`),
  KEY `rapport_allocataire0_FK` (`allocataireNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `rapport`
--

INSERT INTO `rapport` (`numeroRapport`, `date`, `typeRapport`, `description`, `allocataireNumber`, `email`, `modifierPar`) VALUES
(9, '2019-10-01', 'Entretien tÃ©lephonique', 'dqd', 5648948, 'kamir@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `situation`
--

DROP TABLE IF EXISTS `situation`;
CREATE TABLE IF NOT EXISTS `situation` (
  `id_situation` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `situation` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `allocataireNumber` int(11) NOT NULL,
  `notes` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `modifierPar` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_situation`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `status` varchar(50) COLLATE utf8_bin NOT NULL,
  `role` varchar(50) COLLATE utf8_bin NOT NULL,
  `telephone` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email`, `nom`, `prenom`, `password`, `status`, `role`, `telephone`) VALUES
('amin@gmail.com', 'Kao', 'Amin', 'ada79b0c5c9f14fc6588d7bbf5fb281d7ab29c56', '2', 'ADMIN', '0781692255'),
('ham@gmail.com', 'Ham', 'Him', 'b75a2aef673b29fe18de67e9ad7ea0bf198554a2', '1', 'ADMIN', '0648596523'),
('kamir@gmail.com', 'Malo', 'Kamir', 'fd7608e2fe55d179e84022a04f4633a079afe623', '1', 'ADMIN', '0605032455'),
('ma@gmail.com', 'Mar', 'Magali', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', '0', 'ADMIN', '0659362158'),
('marine@gmail.com', 'Kao', 'Amin', '4b1a62d54f5d635ceffa0118244d63e07779e04a', '1', 'ADMIN', '0254568955'),
('stp@gmail.com', 'Jake', 'Mike', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1', 'ADMIN', '0645869532'),
('test@test.com', 'test', 'test', '8b0ee1ea937b258c324399e4d1e7928f8358a3b7', '1', 'ADMIN', '0789562358');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `infos_complementaires`
--
ALTER TABLE `infos_complementaires`
  ADD CONSTRAINT `INFOS_COMPLEMENTAIRES_allocataire0_FK` FOREIGN KEY (`allocataireNumber`) REFERENCES `allocataire` (`allocataireNumber`);

--
-- Contraintes pour la table `item_sociaux`
--
ALTER TABLE `item_sociaux`
  ADD CONSTRAINT `item_sociaux_allocataire0_FK` FOREIGN KEY (`allocataireNumber`) REFERENCES `allocataire` (`allocataireNumber`);

--
-- Contraintes pour la table `rapport`
--
ALTER TABLE `rapport`
  ADD CONSTRAINT `rapport_allocataire0_FK` FOREIGN KEY (`allocataireNumber`) REFERENCES `allocataire` (`allocataireNumber`);

DELIMITER $$
--
-- Évènements
--
DROP EVENT `EVENT_BILAN`$$
CREATE DEFINER=`root`@`localhost` EVENT `EVENT_BILAN` ON SCHEDULE EVERY 1 MONTH STARTS '2019-09-01 03:00:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL `BILAN_GENERAL_TEST`(@p0, @p1, @p2, @p3, @p4, @p5, @p6, @p7, @p8, @p9, @p10, @p11, @p12, @p13, @p14, @p15, @p16, @p17, @p18, @p19, @p20, @p21, @p22, @p23, @p24, @p25, @p26, @p27, @p28, @p29)$$

DROP EVENT `DELETE_EVENT`$$
CREATE DEFINER=`root`@`localhost` EVENT `DELETE_EVENT` ON SCHEDULE EVERY 1 MONTH STARTS '2019-09-01 01:00:00' ON COMPLETION PRESERVE ENABLE DO CALL `DELETE_EVENT`()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
