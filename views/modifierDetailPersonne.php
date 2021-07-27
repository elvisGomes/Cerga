
 <?php
     session_start();
     if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
       header ("Location: ../index.php");
     }
     ?>
<!DOCTYPE html>
<html lang ="fr">
       
    <head>
                    <meta charset="utf-8">
                    <meta name = "viewport" content = "width=device-width, initial-scale =1.0">

                    <title>modification personnes</title>

                

                    <link rel="stylesheet" type="text/css" href="../assets/css/ajoutPersonne.css" >
                    <link href="../assets/css/notif.css" rel="stylesheet">
                    <link rel="stylesheet" href="../assets/css/styleRadioCheckbox.css" >

                  

    </head>

    <!-------------------------------------------------------------------------------------------------->

    <body>
        <?php 
        //stockage de la valeur Get dans une session compteur pour pouvoir afficher le bon allocataire
        if(empty($_SESSION['cpt'])){
                if( isset ($_GET['count'])){
                    $count = $_GET['count'];
                    $_SESSION['cpt'] = $count;
                }
                else {
                    $count = "";
                    $_SESSION['cpt'] = $count;
                }

        }
        $tabData = json_decode($_POST['infos']);
        $dt = DateTime::createFromFormat('Y-m-d', $tabData[0]->birthDate);
        $birthDate = $dt->format('d/m/Y'); 
        ?>


        <script src="../assets/js/script.js"></script>

        




        <div class="cadreModifDetailAlloc">
            
            <form name="afpa_person_creation" method="post" action="../controller/modifierPersonne.action.php"> 
                    <h1 class="text-center">Modifier les détails de l'allocataire</h1>
                    <div class="row">
                        <div class=" col-xs-10  col-sm-10  col-md-6 col-lg-5"> 
 
                                <details open>                                   
                                <summary>  Données personnelles</summary>
                                    <div class="inputcentrer">
                                        <strong>Nom : </strong><br/> <input type="text" name="name"  maxlength="255" pattern="[a-zA-ZÀ-ÿ ]{1,32}" title="pas de caracteres spéciaux" placeholder="<?php echo $tabData[0]->name ?>" >  
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Prénom : </strong><br/> <input type="text"  name="firstName"  maxlength="255" pattern="[a-zA-ZÀ-ÿ ]{1,32}" title="pas de caracteres spéciaux" placeholder="<?php echo $tabData[0]->firstName ?>">  
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Date de naissance : </strong><br/> <input name="birthDate" type="date" class="input datepicker" min="1900-01-01" max="<?php date_default_timezone_set ('Europe/Paris'); echo date('Y-m-d'); ?>" value="<?php echo $tabData[0]->birthDate ?>">  
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Etat civil : </strong><br/> 
                                        <p class="btn-switch">			
                                        <label for="Monsieur" class="btn-switch__label btn-switch__label_Monsieur"><span class="btn-switch__txt">Monsieur</span></label>		
                                            <input type="radio" id="Monsieur" name="gender" value="Monsieur" <?php if($tabData[0]->gender == "Monsieur"){echo 'checked';}?> class="btn-switch__radio btn-switch__radio_Monsieur" />
                                            <label for="Madame" class="btn-switch__label btn-switch__label_Madame"><span class="btn-switch__txt">Madame</span></label>
                                            <input type="radio" id="Madame" name="gender" value="Madame" <?php if($tabData[0]->gender == "Madame"){echo 'checked';}?> class="btn-switch__radio btn-switch__radio_Madame" />		
                                            
                                            							
                                        </p>
                                        <script type="text/javascript">
                                        document.addEventListener('load', function(e) {
                                        chill.checkNullValuesInChoices("afpa_person_creation[gender]");});
                                        </script>
                                        <br/>
                                                                                    <!-- -------- --> 
                                        <strong>Lieu de naissance : </strong> <br/> <input name="placeOfBirth" type="text" placeholder="<?php echo $tabData[0]->placeOfBirth ?>"> 
                                        <br/> 
                                                                                    <!-- -------- -->
                                        <strong>Pays de naissance : </strong> <br/> <input name="nativeCountry" type="text"  class="input datepicker" placeholder="<?php echo $tabData[0]->nativeCountry ?>"> 
                                        <br/> 
                                                                                    <!-- -------- -->
                                        <strong>N° de réference : </strong> <br/> <input type="number" name ="numRef"   maxlength="255" placeholder="<?php echo $tabData[0]->numero_reference ?>"> 
                                        <br/> 
                                                                                    <!-- -------- -->
                                        <strong>Identifiant Pôle Emploi : </strong> <br/> <input type="text" name="IDPE"   maxlength="255" placeholder="<?php echo $tabData[0]->IDPE ?>"> 
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Conseiller Pôle Emploi : </strong> <br/> <input type="text" name="conseiller"  maxlength="255" placeholder="<?php echo $tabData[0]->conseiller ?>"> 
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Autres structures : </strong> <br/> <input type="text" name="autreStructure" maxlength="255" placeholder="<?php echo $tabData[0]->autre_structure ?>"> 
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Référent social : </strong> <br/> <input type="text" name="referent"  maxlength="255" placeholder="<?php echo $tabData[0]->reference ?>"> 
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Permis B : </strong> 
                                        <br/> 
                                        <p class="btn-switch1">	
                                        <label for="oui-permis" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>				
                                            <input type="radio" id="oui-permis" name="permis" value="oui" <?php if($tabData[0]->driverSLicense == "oui"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-permis" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>		
                                            <input type="radio" id="non-permis" name="permis" value="non" <?php if($tabData[0]->driverSLicense == "non"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_non" />		
                                            
                                            					
                                        </p> 
                                        <br/>  
                                        <hr/>
                                    </div>  
                                </details> 
                                    
                                                                                <!-- -------- -->      
                                                                                
                                <details close>                                            
                                <summary>Information de contact </summary> 
                                    <div class="inputcentrer">       
                                        <strong>Téléphone : </strong> <br/> <input type="text" name="tel"    maxlength="255" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="<?php echo $tabData[0]->phoneNumber ?>"> 
                                        <br/>
                                                                                    <!-- -------- -->    
                                        <strong>Mail : </strong> <br/> <input type="mail" name ="mail" maxlength="255" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,4}$" placeholder="<?php echo $tabData[0]->mail ?>"> 
                                        <br/>    
                                                                                    <!-- -------- -->
                                        <strong>Adresse : </strong> <br/> <input type="text" name="adresse"   maxlength="255" placeholder="<?php echo $tabData[0]->adress ?>"> 
                                        <br/>    
                                                                                    <!-- -------- -->
                                        <strong>Ville :</strong> <br/> <input type="text" name="ville"   maxlength="255" placeholder="<?php echo $tabData[0]->ville ?>"> 
                                        <br/>    
                                                                                    <!-- -------- -->
                                        <strong>Code postal : </strong> <br/><input type="text" name="codePostal"   maxlength="5" placeholder="<?php echo $tabData[0]->codePostal ?>"> 
                                        <br/>    
                                        <hr/>
                                    </div>   

                                
                                </details> 
                                            <!-- ----------------------------------------------------------------------------------     -->

                            
                                <details close>
                                    <summary> Situation actuelle </summary> 
                                    <div class="inputcentrer">   
                                        <strong>Est ce que l'allocataire travaille ? : </strong> 
                                        <br/>
                                        <p class="btn-switch1">
                                        <label for="oui-allocataireTravail" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>
                                            <input type="radio" id="oui-allocataireTravail" name="allocataireTravail" value="oui" <?php if($tabData[0]->allocataireTravail == "oui"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-allocataireTravail" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>
                                            <input type="radio" id="non-allocataireTravail" name="allocataireTravail" value="non" <?php if($tabData[0]->allocataireTravail == "non"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_non" />		
                                            
                                            							
                                        </p>  
                                        <br/>
                                        <div id="divTravail" style="display:none;">                                           <!-- -------- -->
                                        <strong>Si oui, depuis le : </strong> <br/><input type="date" name="dateTravail"  maxlength="255" max="<?php date_default_timezone_set ('Europe/Paris'); echo date('Y-m-d'); ?>" min="1900-01-01" value="<?php echo $tabData[0]->dateTravail ?>"> 
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Nombre d'heures mensuelles : </strong> <br/><input type="text" name="heureMensuelle"   maxlength="255" placeholder="<?php echo $tabData[0]->heureMensuelle ?>">  
                                        
                                        <br/>
                                        </div>
                                                                                    <!-- -------- -->
                                        <strong>Deja travaillé(e) ? : </strong> 
                                        <br/>
                                        <p class="btn-switch1">	
                                        <label for="oui-dejaTravaile" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>				
                                            <input type="radio" id="oui-dejaTravaile" name="dejaTravaile" value="oui" <?php if($tabData[0]->dejaTravailler == "oui"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-dejaTravaile" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>	
                                            <input type="radio" id="non-dejaTravaile" name="dejaTravaile" value="non" <?php if($tabData[0]->dejaTravailler == "non"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_non" />		
                                            
                                            						
                                        </p>
                                      
                                         
                                                                                    <!-- -------- -->
                                        <div id="divAncienTravail" style="display:none;">
                                        <strong>Date du dernier contrat de travail : </strong>  <br/><input type="date" name="DernierContrat"  maxlength="255" min="1900-01-01" max="<?php date_default_timezone_set ('Europe/Paris'); echo date('Y-m-d'); ?>" value="<?php echo $tabData[0]->dernierContrat ?>">
                                        </div>
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>L'allocataire est : </strong> 
                                        <br/>
                                        <div class="radio-group"> 
                                            <input type="radio" id="option-Entrepreneur-indépendant" name="allocataireEst" value="Entrepreneur indépendant" <?php if($tabData[0]->statutAllocataire == "Entrepreneur indépendant"){echo 'checked';}?>><label for="option-Entrepreneur-indépendant">Entrepreneur indépendant</label>
                                            <input type="radio" id="option-Non-renseigner" name="allocataireEst" value="Non renseigné"><label for="option-Non-renseigner" <?php if($tabData[0]->statutAllocataire == "Non renseigné"){echo 'checked';}?>>Non renseigné</label>
                                        </div>
                                        <div class="radio-group">                                       
                                            <input type="radio" id="option-Etudiant-Stagiaire" name="allocataireEst" value="Etudiant/Stagiaire" <?php if($tabData[0]->statutAllocataire == "Etudiant/Stagiaire"){echo 'checked';}?>><label for="option-Etudiant-Stagiaire">Etudiant/Stagiaire</label>
                                            <input type="radio" id="option-formation-professionnelle" name="allocataireEst" value="En formation professionnelle" <?php if($tabData[0]->statutAllocataire == "En formation professionnelle"){echo 'checked';}?>><label for="option-formation-professionnelle">En formation professionnelle</label>
                                        </div>

                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Situation familiale : </strong> 
                                        <br/>
                                        <div class="radio-group">                                       
                                            <input type="radio" id="option-marier" name="situationF" value="Marié(e)" <?php if($tabData[0]->situation_familial == "Marié(e)"){echo 'checked';}?> ><label for="option-marier">Marié(e)</label>
                                            <input type="radio" id="option-celibataire" name="situationF" value="Célibataire" <?php if($tabData[0]->situation_familial == "Célibataire"){echo 'checked';}?>><label for="option-celibataire">Célibataire</label>
                                            <input type="radio" id="option-concubinage" name="situationF" value="Concubinage" <?php if($tabData[0]->situation_familial == "Concubinage"){echo 'checked';}?>><label for="option-concubinage">Concubinage</label>
                                        </div>
                                        <div class="radio-group">                                       
                                            <input type="radio" id="option-Veuf" name="situationF" value="Veuf/Veuve" <?php if($tabData[0]->situation_familial == "Veuf/Veuve"){echo 'checked';}?>><label for="option-Veuf">Veuf/Veuve</label>
                                            <input type="radio" id="option-Divorcer" name="situationF" value="Divorcé(e)" <?php if($tabData[0]->situation_familial == "Divorcé(e)"){echo 'checked';}?>><label for="option-Divorcer">Divorcé(e)</label>
                                            <input type="radio" id="option-Séparer" name="situationF" value="Séparé(e)" <?php if($tabData[0]->situation_familial == "Séparé(e)"){echo 'checked';}?>><label for="option-Séparer">Séparé(e)</label>
                                        </div>
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Nombre d'enfants : </strong> <br/> <input type="number"  name="nbChild" min="0" maxlength="255" placeholder="<?php echo $tabData[0]->nb_enfants ?>"> 
                                        <br/> 
                                                                                    <!-- -------- -->
                                        <strong>Reconnaissance de la qualité de travailleur handicapé : </strong> 
                                        <br/> 
                                        <p class="btn-switch1">		
                                        <label for="oui-rqth" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>			
                                            <input type="radio" id="oui-rqth" name="rqth" value="oui" <?php if($tabData[0]->RQTH == "oui"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-rqth" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>
                                            <input type="radio" id="non-rqth" name="rqth" value="non" <?php if($tabData[0]->RQTH == "non"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_non" />		
                      
                                           							
                                        </p> 
                                        <br/>
                                                                                <!-- -------- -->
                                        <strong>Niveau d'études : </strong> 
                                        <br/> 
                                        <div class="radio-group"> 
                                            <input type="radio" id="option-Non-exprimé" name="etude" value="Non exprimé" <?php if($tabData[0]->niveauEtude == "Non exprimé"){echo 'checked';}?>><label for="option-Non-exprimé">Non exprimé</label>
                                            <input type="radio" id="option-Inférieur-CAP-BEP" name="etude" value="Inférieur un CAP / BEP (niveau Vbis / VI)" <?php if($tabData[0]->niveauEtude == "Inférieur un CAP / BEP (niveau Vbis / VI)"){echo 'checked';}?>><label for="option-Inférieur-CAP-BEP">Inférieur un CAP / BEP (niveau Vbis / VI)</label>                   
                                        </div>  
                                        <div class="radio-group"> 
                                            <input type="radio" id="option-CAP-BEP" name="etude" value="CAP/BEP (niveau V)" <?php if($tabData[0]->niveauEtude == "CAP/BEP (niveau V)"){echo 'checked';}?>><label for="option-CAP-BEP">CAP/BEP (niveau V)</label>
                                            <input type="radio" id="option-Bac-Brevet-technicien" name="etude" value="Bac/Brevet de technicien(niveau IV)" <?php if($tabData[0]->niveauEtude == "Bac/Brevet de technicien(niveau IV)"){echo 'checked';}?>><label for="option-Bac-Brevet-technicien">Bac/Brevet de technicien(niveau IV)</label>
                                        </div> 
                                        <div class="radio-group">   
                                            <input type="radio" id="option-Bac+2" name="etude" value="Bac +2 (niveau III)" <?php if($tabData[0]->niveauEtude == "Bac +2 (niveau III)"){echo 'checked';}?>><label for="option-Bac+2">Bac +2 (niveau III)</label>                              
                                            <input type="radio" id="option-Enseignement-supérieur" name="etude" value="Enseignement supérieur (niveau I, II)" <?php if($tabData[0]->niveauEtude == "Enseignement supérieur (niveau I, II)"){echo 'checked';}?>><label for="option-Enseignement-supérieur">Enseignement supérieur (niveau I, II)</label>                  
                                        </div> 
                                        <br/>
                                                                                <!-- -------- -->
                                        <strong>Reconnu en France ?: </strong>  
                                        <br/>
                                        <p class="btn-switch1">				
                                        <label for="oui-reconnu" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>	
                                            <input type="radio" id="oui-reconnu" name="reconnu" value="oui" <?php if($tabData[0]->reconnuEnFrance == "oui"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-reconnu" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>		
                                            <input type="radio" id="non-reconnu" name="reconnu" value="non" <?php if($tabData[0]->reconnuEnFrance == "non"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_non" />		
                                            
                                           					
                                        </p>  
                                        <br/>
                                                                                <!-- -------- -->
                                        <strong>Niveau de maîtrise du Français : </strong>  
                                        <br/> 
                                        <input type="checkbox" name="maitriseFrancais[]" value="parle" <?php if(stripos($tabData[0]->maitriseFrancais, "parle") !== false){echo 'checked';}?>> Parlé<br>
                                        <input type="checkbox" name="maitriseFrancais[]" value="lu" <?php if(stripos($tabData[0]->maitriseFrancais, "lu") !== false){echo 'checked';}?>> Lu <br>
                                        <input type="checkbox" name="maitriseFrancais[]" value="ecrit" <?php if(stripos($tabData[0]->maitriseFrancais, "ecrit") !== false){echo 'checked';}?> > Ecrit<br>  
                                        <br/>
                                                                                        <!-- -------- -->
                                        <strong>Couverture Social ? (y compris CMU, CMU-c, mutuelleprivée) : </strong> 
                                        <br/>
                                        <p class="btn-switch1">	
                                        <label for="oui-couverture" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>				
                                            <input type="radio" id="oui-couverture" name="couverture" value="oui" <?php if($tabData[0]->couvertureSocial == "oui"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-couverture" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>
                                            <input type="radio" id="non-couverture" name="couverture" value="non" <?php if($tabData[0]->couvertureSocial == "non"){echo 'checked';}?> class="btn-switch1__radio btn-switch1__radio_non" />		
                                            
                                            							
                                        </p>  
                                       
                                                                                <!-- -------- -->
                                        <strong>Logement : </strong> 
                                        <br/>
                                        <div class="radio-group">                                       
                                            <input type="radio" id="option-Propriétaire" name="logement" value="Propriétaire" <?php if($tabData[0]->logement == "Propriétaire"){echo 'checked';}?>><label for="option-Propriétaire">Propriétaire</label>
                                            <input type="radio" id="option-Locataire" name="logement" value="Locataire" <?php if($tabData[0]->logement == "Locataire"){echo 'checked';}?>><label for="option-Locataire">Locataire</label>
                                        </div>
                                        
                                        <div class="radio-group">
                                        <input type="radio" id="option-Heberger" name="logement" value="Hebergé en famille ou chez un tiers" <?php if($tabData[0]->logement == "Hebergé en famille ou chez un tiers"){echo 'checked';}?>><label for="option-Heberger">Hebergé en famille ou chez un tiers</label>
                                        </div>  
                                     
                                        <div class="radio-group">  
                                            <input type="radio" id="option-Sans-domicile-fixe" name="logement" value="Sans domicile fixe" <?php if($tabData[0]->logement == "Sans domicile fixe"){echo 'checked';}?>><label for="option-Sans-domicile-fixe">Sans domicile fixe</label>
                                            <input type="radio" id="option-structure-hebergement" name="logement" value="En structure d'hebergement" <?php if($tabData[0]->logement == "En structure d'hebergement"){echo 'checked';}?>><label for="option-structure-hebergement">En structure d'hebergement</label>
                                        </div>  
                                        <br/>  
                                            <hr/> 
                                    </div>                                      
                                </details>                                       

                                                                    <!-- -------- -->
                            
                                    <!-- ----------------------------------------------------------------------------------     -->
                            

                        
                                <details close>
                                    <summary>Contrat d'engagement</summary>
                                    <div class="inputcentrer">                          
                                        <strong> Item sociaux</strong>                                   
                                            
                                               
                                        <br>
                                        <ul class="ks-cboxtags">
                                        <li><input id="sante" data-target = "sante" class="item" type="checkbox" name="itemSocial[]" value="sante" <?php if(stripos($tabData[0]->socialType, "sante") !== false){echo 'checked';}?>><label for="sante">Santé</label><br></li>
                                        <input id="santeComm" class="comm" name="comment[]"  type="text" style="display: none" placeholder="<?php if($tabData[0]->comment_sante != ""){echo $tabData[0]->comment_sante;}?>" maxlength="255">

                                        <li><input id="logement"  data-target = "logement" class="item" type="checkbox" name="itemSocial[]" value="logement" <?php if(stripos($tabData[0]->socialType, "logement") !== false){echo 'checked';}?>><label for="logement"> Logement</label><br></li>
                                        <input id="logementComm" class="comm" name="comment[]" type="text" style="display: none" placeholder="<?php if($tabData[0]->comment_logement != ""){echo $tabData[0]->comment_logement;}?>" maxlength="255">

                                        <li><input id="formation"  data-target = "formation" class="item" type="checkbox" name="itemSocial[]" value="Formation" <?php if(stripos($tabData[0]->socialType, "formation") !== false){echo 'checked';}?>><label for="formation"> Formation </label><br></li>
                                        <input id="formationComm" class="comm" name="comment[]" type="text" style="display: none" placeholder="<?php if($tabData[0]->comment_formation != ""){echo $tabData[0]->comment_formation;}?>" maxlength="255">

                                        <li><input id="lien"  data-target = "lien" class="item" type="checkbox" name="itemSocial[]" value="Lien social" <?php if(stripos($tabData[0]->socialType, "lien") !== false){echo 'checked';}?>><label for="lien"> Lien social</label><br></li>
                                        <input id="lienComm" class="comm" name="comment[]" type="text" style="display: none" placeholder="<?php if($tabData[0]->comment_lien != ""){echo $tabData[0]->comment_lien;}?>" maxlength="255">

                                        <li><input id="aide" data-target = "aide" class="item" type="checkbox" name="itemSocial[]" value="aide Financiere" <?php if(stripos($tabData[0]->socialType, "aide") !== false){echo 'checked';}?>><label for="aide"> Aide financière </label><br></li>
                                        <input id="aideComm" class="comm" name="comment[]" type="text" style="display: none" placeholder="<?php if($tabData[0]->comment_aide != ""){echo $tabData[0]->comment_aide;}?>" maxlength="255">

                                        <li><input id="transport"  data-target = "transport" class="item" type="checkbox" name="itemSocial[]" value="Mobilité/Transport" <?php if(stripos($tabData[0]->socialType, "transport") !== false){echo 'checked';}?>><label for="transport"> Mobilité/Transport</label><br></li>
                                        <input id="transportComm" class="comm" name="comment[]" type="text" style="display: none" placeholder="<?php if($tabData[0]->comment_transport != ""){echo $tabData[0]->comment_transport;}?>" maxlength="255">

                                        <li><input id="administrative" data-target = "administrative" class="item" type="checkbox" name="itemSocial[]" value="Démarche et formalités administratives" <?php if(stripos($tabData[0]->socialType, "démarche") !== false){echo 'checked';}?>><label for="administrative">Démarche et formalités administratives</label><br></li>
                                        <input id="administrativeComm" class="comm" name="comment[]"type="text" style="display: none" placeholder="<?php if($tabData[0]->comment_administratif != ""){echo $tabData[0]->comment_administratif;}?>" maxlength="255">

                                        <li><input id="garde" data-target = "garde" class="item" type="checkbox" name="itemSocial[]" value="garde Enfant" <?php if(stripos($tabData[0]->socialType, "garde") !== false){echo 'checked';}?>><label for="garde"> Garde d'enfant ou d'un tiers/parentalité</label><br></li>
                                        <input id="gardeComm" class="comm" name="comment[]" type="text" style="display: none" placeholder="<?php if($tabData[0]->comment_garde != ""){echo $tabData[0]->comment_garde;}?>" maxlength="255">   
                                                                             
                                        <li><input id="lecture" data-target = "lecture" class="item" type="checkbox" name="itemSocial[]" value="Lecture, écriture et compréhension du français" <?php if(stripos($tabData[0]->socialType, "lecture") !== false){echo 'checked';}?>><label for="lecture">Lecture, écriture et compréhension du français</label><br></li>
                                        <input id="lectureComm" class="comm" name="comment[]" type="text" style="display: none" placeholder="<?php if($tabData[0]->comment_lecture != ""){echo $tabData[0]->comment_lecture;}?>" maxlength="255">

                                        <li><input id="autre"  data-target = "autre" class="item" type="checkbox" name="autre" value="" ><label for="autre">autre</label><br></li>
                                        <input id="autreComm" class="comm" name="autre" type="text" style="display: none">
                                        <hr/> 
                                                
                                        </ul>  
                                                                                        <!-- -------- -->
                                            <strong>Date d'ouverture du dossier: </strong><br/> <input name="dateOuverture" type="date" class="input datepicker" min="1900-01-01" max="<?php date_default_timezone_set ('Europe/Paris'); echo date('Y-m-d'); ?>" value="<?php echo $tabData[0]->date_ouverture ?>">  
                                                <br/>
                                            <br/>
                                            <hr/> 
                                    </div>                          
                                </details>
                                                    <!-- ----------------------------------------------------------------------------------     --> 
                        </div>            
                    </div> 
                    <div class="row modifierDetailBouton">
                        <div class=" col-xs-10  col-sm-10  col-md-7 col-lg-6" style="margin-left:20%";> 

                            <input type="hidden"value="not_reviewed">
                            <input type="hidden" value="9">
                            <input type="hidden" value="2Tj6RKhMamw4HkFANJUNrFqbz054Y7wcluSG85QJQ_k">
                                <?php
                                    if(isset($_GET['error'])){
                                    $err = $_GET['error'];
                                    if($err==1 || $err==1){
                                    echo "<p style='color:red'>L'allocataire n'a pas pu etre enregistrer</p>";
                                    }
                                    }
                                ?>
                            <center><button id="action" class="sc-button green" type="submit" alt="add a person"><i class="fa fa-plus"></i> Modifier allocataire</button>
                            </center>
                        </div>   
                    </div>

            </form>
        </div>           
                <script type="text/javascript">
                    function HtmlEdit() {
                    $('.editable').click(function() {

                        $(this).keydown(function() {
                            if (event.keyCode == 13) {
                            return false;

                            }
                        })

                        $(this).keyup(function() {
                            if (event.keyCode == 13) {
                            $('.editable').blur();

                            }
                        })

                        $(this).find('.editable').blur(function() {
                            alert('it works');
                            })
                        })
                    }
                </script>
                <script src="../assets/js/script2.js"></script>
    </body>
</html>