DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `BILAN_GENERAL_TEST`(OUT `cptForm` INT, OUT `cptCdd` INT, OUT `cptCdi` INT, OUT `cptCieCdi` INT, OUT `cptCrea` INT, OUT `cptCieCdd` INT, OUT `cptAide` INT, OUT `cptInsert` INT, OUT `cptRetraite` INT, OUT `cptSiae` INT, OUT `cptDemenagement` INT, OUT `cptAutreRsa` INT, OUT `cptSante` INT, OUT `cptAutreSortie` INT, OUT `cptFinAction` INT, OUT `cptPole` INT, OUT `cptAutreAction` INT, OUT `cptAbandon` INT, OUT `dateMois` DATE, OUT `cptAccompagne` INT, OUT `cptEntree` FLOAT, OUT `txOccup` INT, OUT `placeDispo` INT, OUT `totEmploiDur` INT, OUT `totEmploiTrans` INT, OUT `totSortiePos` INT, OUT `totSortieDynam` INT, OUT `totSortieLegit` INT, OUT `totSortieAutre` INT, OUT `totSortie` INT)
    NO SQL
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
DELIMITER ;