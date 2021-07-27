
<!DOCTYPE html>
<html lang="fr">
 
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>AFPA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../assets/images/afpaOnglet.png" />
        <link rel="stylesheet" type="text/css" href="../assets/css/ajoutPersonne.css" >
        <link href="../assets/css/notif.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/styleRadioCheckbox.css" >
   <script src="../assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>


<body>
<?php include_once "nav.php"; ?>
<div class="cadreModifDetailAlloc">  
    
                            <form name="afpa_person_creation" method="post" action="../controller/ajoutPersonne.action.php">
                            <p style="color: red"><strong>Les champs avec <span class="obligatoire">*</span> sont obligatoires.</strong></p>

                            <h1 class="text-center" >Ajout d'un allocataire</h1>

                            <div class="row">
                        <div class=" col-xs-10  col-sm-10  col-md-6 col-lg-5"> 
 
                                <details open>                                   
                                <summary>  Données personnelles</summary> 
                                    <div class="inputcentrer">
                                        <strong >Nom :<span class="obligatoire"> *</span></strong><br/> <input  type="text"  name="name" required="required" maxlength="45" pattern="[a-zA-ZÀ-ÿ ]{2,32}" 
                                        title="Pas de caractères spéciaux , entre 2 et 32 caractères." placeholder="Nom">  
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Prénom : <span class="obligatoire"> *</span></strong><br/> <input type="text"  name="firstName" required="required" maxlength="45" pattern="[a-zA-ZÀ-ÿ ]{2,32}" 
                                        title="Pas de caractères spéciaux , entre 2 et 32 caractères." placeholder="Prénom">  
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Date de naissance : <span class="obligatoire"> *</span></strong><br/> <input name="birthDate"  type="date"  class="input datepicker" required="required" min="1900-01-01" 
                                        max="<?php date_default_timezone_set('Europe/Paris');setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');$majeur = date('Y-m-d', strtotime('- 18 years')); echo $majeur; ?>"> 
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>N°Allocataire : <span class="obligatoire"> *</span></strong><br/> <input id="cafNumber" name="allocataireNumber" type="text" 
                                        required="required" maxlength="7" pattern="[0-9]{7}" title="7 Chiffres requis !" placeholder="7 chiffres"> 
                                        <br/>
                                        <span id="cafNumberVerif"></span><br>
                                                                                    <!-- -------- -->
                                        <strong>Etat civil : </strong><br/> 
                                        <p class="btn-switch">
                                        <label for="Monsieur" class="btn-switch__label btn-switch__label_Monsieur"><span class="btn-switch__txt">Monsieur</span></label>					
                                            <input type="radio" id="Monsieur" name="gender" value="Monsieur"  class="btn-switch__radio btn-switch__radio_Monsieur"/>
                                            <label for="Madame" class="btn-switch__label btn-switch__label_Madame"><span class="btn-switch__txt">Madame</span></label>		
                                            <input type="radio" id="Madame" name="gender" value="Madame"  class="btn-switch__radio btn-switch__radio_Madame" />		
                                            
                                            					
                                        </p>
                                        <script type="text/javascript">
                                        document.addEventListener('load', function(e) {
                                        chill.checkNullValuesInChoices("afpa_person_creation[gender]");});
                                        </script>
                                        <br/>
                                                                                    <!-- -------- --> 
                                        <strong><span class="titreAllocataire">Ville de naissance : </span></strong> <br/> <input name="placeOfBirth" type="text" maxlength="45" placeholder="Ville de naissance"> 
                                        <br/> 
                                                                                    <!-- -------- -->
                                        <strong>Pays de naissance : </strong> <br/> <input name="nativeCountry" type="text"  class="input datepicker" maxlength="45" placeholder="Pays de Naissance"> 
                                        <br/> 
                                                                                    <!-- -------- -->
                                        <strong>N° de réference : </strong> <br/> <input type="number" name ="numRef" pattern="[0-9]" maxlength="20" placeholder="Uniquement des chiffres"> 
                                        <br/> 
                                                                                    <!-- -------- -->
                                        <strong>Identifiant Pôle Emploi : </strong> <br/> <input type="text" name="IDPE" maxlength="20" placeholder="Uniquement des chiffres et 1 lettre">
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Conseiller Pôle Emploi : </strong> <br/> <input type="text" name="conseiller" maxlength="45" placeholder="Conseiller pole emploi">
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Autres structures : </strong> <br/> <input type="text" name="autreStructure" maxlength="45" placeholder="Autres structures" >
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Référent social : </strong> <br/> <input type="text" name="referent" maxlength="45" title="Pas de caractères spéciaux !" placeholder="Referent social"> 
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Permis B : </strong> 
                                        <br/> 
                                        <p class="btn-switch1">		
                                        <label for="oui-permis" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>			
                                            <input type="radio" id="oui-permis" name="permis" value="oui" class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-permis" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>	
                                            <input type="radio" id="non-permis" name="permis" value="non" class="btn-switch1__radio btn-switch1__radio_non" />		
                                            
                                          						
                                        </p> 
                                        <br/>  
                                        <hr/>
                                    </div>  
                                </details> 
                                    
                                                                                <!-- -------- -->      
                                                                                
                                <details close>                                            
                                <summary>Information de contact </summary> 
                                    <div class="inputcentrer">       
                                        <strong>Téléphone : </strong> <br/> <input type="text" name="tel" maxlength="255" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="Numero de telephone"> 
                                        <br/>
                                                                                    <!-- -------- -->    
                                        <strong>Mail : </strong> <br/> <input type="mail" name ="mail" maxlength="255" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,4}$" placeholder="Adresse mail"> 
                                        <br/>    
                                                                                    <!-- -------- -->
                                        <strong>Adresse : </strong> <br/> <input type="text" name="adresse" maxlength="255" placeholder="Adresse"> 
                                        <br/>    
                                                                                    <!-- -------- -->
                                        <strong>Ville :</strong> <br/> <input type="text" name="ville" maxlength="255" placeholder="Ville"> 
                                        <br/>    
                                                                                    <!-- -------- -->
                                        <strong>Code postal : </strong> <br/><input type="number" name="codePostal" maxlength="5" placeholder="5 chiffres">
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
                                            <input type="radio" id="oui-allocataireTravail" name="allocataireTravail" value="oui" class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-allocataireTravail" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>
                                            <input type="radio" id="non-allocataireTravail" name="allocataireTravail" value="non" class="btn-switch1__radio btn-switch1__radio_non" />		
                                            
                                            							
                                        </p>  
                                        <br/>
                                                                                    <!-- -------- -->
                                        <div id="divTravail" style="display:none">                                              
                                        <strong>Si oui, depuis le : </strong> <br/><input type="date" name="dateTravail" maxlength="255" min="1900-01-01" max="<?php date_default_timezone_set ('Europe/Paris'); echo date('Y-m-d'); ?>"> 
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Nombre d'heures mensuelles : </strong> <br/><input type="text" name="heureMensuelle" maxlength="255" placeholder="Nombre d'heures mensuelles">  
                                        <br/>
                                        </div>
                                                                                    <!-- -------- -->
                                        <strong>Deja travaillé(e) ? : </strong> 
                                        <br/>
                                        <p class="btn-switch1">					
                                        <label for="oui-dejaTravaile" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>
                                            <input type="radio" id="oui-dejaTravaile" name="dejaTravaile" value="oui" class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-dejaTravaile" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>	
                                            <input type="radio" id="non-dejaTravaile" name="dejaTravaile" value="non" class="btn-switch1__radio btn-switch1__radio_non" />		
                                           
                                          						
                                        </p>
                                        <br/>
                                                                                    <!-- -------- -->
                                        <div id="divAncienTravail" style="display:none">
                                        <strong>Date du dernier contrat de travail : </strong>  <br/><input type="date" name="DernierContrat"  maxlength="255" min="1900-01-01" max="<?php date_default_timezone_set ('Europe/Paris'); echo date('Y-m-d'); ?>">
                                        </div>
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>L'allocataire est : </strong> 
                                        <br/>
                                        <div class="radio-group"> 
                                            <input type="radio" id="option-Entrepreneur-indépendant" name="allocataireEst" value="Entrepreneur indépendant"><label for="option-Entrepreneur-indépendant">Entrepreneur indépendant</label>
                                            <input type="radio" id="option-Non-renseigner" name="allocataireEst" value="Non renseigné"><label for="option-Non-renseigner" >Non renseigné</label>
                                        </div>
                                        <div class="radio-group">                                       
                                            <input type="radio" id="option-Etudiant-Stagiaire" name="allocataireEst" value="Etudiant/Stagiaire"><label for="option-Etudiant-Stagiaire">Etudiant/Stagiaire</label>
                                            <input type="radio" id="option-formation-professionnelle" name="allocataireEst" value="En formation professionnelle"><label for="option-formation-professionnelle">En formation professionnelle</label>
                                        </div>

                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Situation familiale : </strong> 
                                        <br/>
                                        <div class="radio-group">                                       
                                            <input type="radio" id="option-marier" name="situationF" value="Marié(e)"><label for="option-marier">Marié(e)</label>
                                            <input type="radio" id="option-celibataire" name="situationF" value="Célibataire"><label for="option-celibataire">Célibataire</label>
                                            <input type="radio" id="option-concubinage" name="situationF" value="Concubinage"><label for="option-concubinage">Concubinage</label>
                                        </div>
                                        <div class="radio-group">                                       
                                            <input type="radio" id="option-Veuf" name="situationF" value="Veuf/Veuve"><label for="option-Veuf">Veuf/Veuve</label>
                                            <input type="radio" id="option-Divorcer" name="situationF" value="Divorcé(e)"><label for="option-Divorcer">Divorcé(e)</label>
                                            <input type="radio" id="option-Séparer" name="situationF" value="Séparé(e)"><label for="option-Séparer">Séparé(e)</label>
                                        </div>
                                        <br/>
                                                                                    <!-- -------- -->
                                        <strong>Nombre d'enfants : </strong> <br/> <input type="number"  name="nbChild" min="0" maxlength="255" placeholder="Nombre d'enfants"> 
                                        <br/> 
                                                                                    <!-- -------- -->
                                        <strong>Reconnaissance de la qualité de travailleur handicapé : </strong> 
                                        <br/> 
                                        <p class="btn-switch1">		
                                        <label for="oui-rqth" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>			
                                            <input type="radio" id="oui-rqth" name="rqth" value="oui" class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-rqth" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>	
                                            <input type="radio" id="non-rqth" name="rqth" value="non" class="btn-switch1__radio btn-switch1__radio_non" />		
                                            
                                         						
                                        </p> 
                                        <br/>
                                                                                <!-- -------- -->
                                        <strong>Niveau d'études : </strong> 
                                        <br/> 
                                        <div class="radio-group"> 
                                            <input type="radio" id="option-Non-exprimé" name="etude" value="Non exprimé" ><label for="option-Non-exprimé">Non exprimé</label>
                                            <input type="radio" id="option-Inférieur-CAP-BEP" name="etude" value="Inférieur un CAP / BEP (niveau Vbis / VI)" ><label for="option-Inférieur-CAP-BEP">Inférieur un CAP / BEP (niveau Vbis / VI)</label>                   
                                        </div>  
                                        <div class="radio-group"> 
                                            <input type="radio" id="option-CAP-BEP" name="etude" value="CAP/BEP (niveau V)" ><label for="option-CAP-BEP">CAP/BEP (niveau V)</label>
                                            <input type="radio" id="option-Bac-Brevet-technicien" name="etude" value="Bac/Brevet de technicien(niveau IV)" ><label for="option-Bac-Brevet-technicien">Bac/Brevet de technicien(niveau IV)</label>
                                        </div> 
                                        <div class="radio-group">   
                                            <input type="radio" id="option-Bac+2" name="etude" value="Bac +2 (niveau III)"><label for="option-Bac+2">Bac +2 (niveau III)</label>                              
                                            <input type="radio" id="option-Enseignement-supérieur" name="etude" value="Enseignement supérieur (niveau I, II)"><label for="option-Enseignement-supérieur">Enseignement supérieur (niveau I, II)</label>                  
                                        </div> 
                                        <br/>
                                                                                <!-- -------- -->
                                        <strong>Reconnu en France ?: </strong>  
                                        <br/>
                                        <p class="btn-switch1">	
                                        <label for="oui-reconnu" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>				
                                            <input type="radio" id="oui-reconnu" name="reconnu" value="oui" class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-reconnu" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>	
                                            <input type="radio" id="non-reconnu" name="reconnu" value="non" class="btn-switch1__radio btn-switch1__radio_non" />		
                                            
                                            						
                                        </p>  
                                        <br/>
                                                                                <!-- -------- -->
                                        <strong>Niveau de maîtrise du Français : </strong>  
                                        <br/> 
                                        <input type="checkbox" name="maitriseFrancais[]" value="parle"> Parlé<br>
                                        <input type="checkbox" name="maitriseFrancais[]" value="lu"> Lu <br>
                                        <input type="checkbox" name="maitriseFrancais[]" value="ecrit"> Ecrit<br>  
                                        <br/>
                                                                                        <!-- -------- -->
                                        <strong>Couverture Social ? (y compris CMU, CMU-c, mutuelleprivée) : </strong> 
                                        <br/>
                                        <p class="btn-switch1">	
                                        <label for="oui-couverture" class="btn-switch1__label btn-switch1__label_oui"><span class="btn-switch1__txt">oui</span></label>				
                                            <input type="radio" id="oui-couverture" name="couverture" value="oui" class="btn-switch1__radio btn-switch1__radio_oui" />
                                            <label for="non-couverture" class="btn-switch1__label btn-switch1__label_non"><span class="btn-switch1__txt">non</span></label>
                                            <input type="radio" id="non-couverture" name="couverture" value="non" class="btn-switch1__radio btn-switch1__radio_non" />		
                                            
                                            							
                                        </p>  
                                        <br/>
                                                                                <!-- -------- -->
                                        <strong>Logement : </strong> 
                                        <br/>
                                        <div class="radio-group">                                       
                                            <input type="radio" id="option-Propriétaire" name="logement" value="Propriétaire"><label for="option-Propriétaire">Propriétaire</label>
                                            <input type="radio" id="option-Locataire" name="logement" value="Locataire"><label for="option-Locataire">Locataire</label>
                                        </div>
                                        
                                        <div class="radio-group">
                                        <input type="radio" id="option-Heberger" name="logement" value="Hebergé en famille ou chez un tiers"><label for="option-Heberger">Hebergé en famille ou chez un tiers</label>
                                        </div>  
                                        
                                        <div class="radio-group">  
                                            <input type="radio" id="option-Sans-domicile-fixe" name="logement" value="Sans domicile fixe"><label for="option-Sans-domicile-fixe">Sans domicile fixe</label>
                                            <input type="radio" id="option-structure-hebergement" name="logement" value="En structure d'hebergement"><label for="option-structure-hebergement">En structure d'hebergement</label>
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
                                        <strong> Item sociaux </strong>                                   
                                            
                                               
                                        <br>
                                        <ul class="ks-cboxtags">


                                        <li><input id="sante" data-target = "sante" class="item" type="checkbox" name="itemSocial[]" value="sante" ><label for="sante">Santé</label><br></li>
                                        <input id="santeComm" class="comm" name="comment[]"  type="text" style="display: none" maxlength="255">

                                        <li><input id="logement"  data-target = "logement" class="item" type="checkbox" name="itemSocial[]" value="logement"><label for="logement"> Logement</label><br></li>
                                        <input id="logementComm" class="comm" name="comment[]" type="text" style="display: none" maxlength="255">

                                        <li><input id="formation"  data-target = "formation" class="item" type="checkbox" name="itemSocial[]" value="Formation" ><label for="formation"> Formation </label><br></li>
                                        <input id="formationComm" class="comm" name="comment[]" type="text" style="display: none" maxlength="255">

                                        <li><input id="lien"  data-target = "lien" class="item" type="checkbox" name="itemSocial[]" value="Lien social" ><label for="lien"> Lien social</label><br></li>
                                        <input id="lienComm" class="comm" name="comment[]" type="text" style="display: none" maxlength="255">

                                        <li><input id="aide" data-target = "aide" class="item" type="checkbox" name="itemSocial[]" value="aide Financiere" ><label for="aide"> Aide financière </label><br></li>
                                        <input id="aideComm" class="comm" name="comment[]" type="text" style="display: none" maxlength="255">

                                        <li><input id="transport"  data-target = "transport" class="item" type="checkbox" name="itemSocial[]" value="Mobilité/Transport"><label for="transport"> Mobilité/Transport</label><br></li>
                                        <input id="transportComm" class="comm" name="comment[]" type="text" style="display: none" maxlength="255">

                                        <li><input id="administrative" data-target = "administrative" class="item" type="checkbox" name="itemSocial[]" value="Démarche et formalités administratives" ><label for="administrative">Démarche et formalités administratives</label><br></li>
                                        <input id="administrativeComm" class="comm" name="comment[]"type="text" style="display: none" maxlength="255">

                                        <li><input id="garde" data-target = "garde" class="item" type="checkbox" name="itemSocial[]" value="garde Enfant"><label for="garde"> Garde d'enfant ou d'un tiers/parentalité</label><br></li>
                                        <input id="gardeComm" class="comm" name="comment[]" type="text" style="display: none" maxlength="255">

                                        <li><input id="lecture" data-target = "lecture" class="item" type="checkbox" name="itemSocial[]" value="Lecture, écriture et compréhension du français" ><label for="lecture">Lecture, écriture et compréhension du français</label><br></li>
                                        <input id="lectureComm" class="comm" name="comment[]" type="text" style="display: none" maxlength="255">

                                        <li><input id="autre"  data-target = "autre" class="item" type="checkbox" name="autre" value="" ><label for="autre">autre</label><br></li>
                                        <input id="autreComm" class="comm" name="autre" type="text" style="display: none"> <hr/>

                                        </ul>  

                                        <strong>L'allocataire s'engage dans un/une : </strong> 
                                        <br/>
                                        <div class="radio-group">
                                            <input type="radio" id="option-Accompagnement-insertion" name="accompagnement" value="Accompagnement insertion"><label for="option-Accompagnement-insertion">Accompagnement insertion</label>
                                            </div>
                                       
                                        <div class="radio-group">
                                            <input type="radio" id="option-Accompagnement-collectif" name="accompagnement" value="Accompagnement collectif"><label for="option-Accompagnement-collectif">Accompagnement collectif</label>
                                        </div>
                                        

                                        <div class="radio-group">
                                            <input type="radio" id="option-Remobilisation-professionnel-ACI" name="accompagnement" value="Remobilisation professionnel/ACI"><label for="option-Remobilisation-professionnel-ACI">Remobilisation professionnel/ACI</label>
                                        </div>  
                                        
                                                                                <div class="radio-group">  
                                            <input type="radio" id="option-Construction-projet-professionnel" name="accompagnement" value="Construction du projet professionnel"><label for="option-Construction-projet-professionnel">Construction du projet professionnel</label>
                                            </div>
                                     
                                        <div class="radio-group">
                                        <input type="radio" id="option-Médiation-direct-emploi-Coaching" name="accompagnement" value="Médiation direct vers l'emploi/Coaching"><label for="option-Médiation-direct-emploi-Coaching">Médiation direct vers l'emploi/Coaching</label>
                                        </div>  
                                       
                                        <div class="radio-group">
                                        <input type="radio" id="option-Accompagnement-entrepreneurs-travailleurs-indépendants" name="accompagnement" value="Accompagnement entrepreneurs et travailleurs indépendants"><label for="option-Accompagnement-entrepreneurs-travailleurs-indépendants">Accompagnement entrepreneurs et travailleurs indépendants</label>
                                        </div>
                                       
                                        <br/>
                                                                                        <!-- -------- -->
                                             
                                                
                                                                                        <!-- -------- -->   
                                            <strong>Date d'ouverture d'accompagnement: </strong><br/> <input id="dateOn" type="date" name="dateOn" min="1900-01-01"> 
                                                <br/>
                                                <span id="entreeManquante"></span>
                                                <br/>
                                                                                        <!-- -------- -->    
                                            <strong>Date de fin d'accompagnement : </strong><br/> <input id="dateOff" type="date" name="dateOff" > 
                                                <br/>
                                                <span id="sortieManquante"></span>
                                                                                        <!-- -------- -->
                                            <br/>
                                            <hr/> 
                                            <strong>Date d'ouverture du dossier: </strong><br/> <input type="date" name="dateOuverture" max="<?php echo date('Y-m-d') ?>" min="1900-01-01" max="<?php date_default_timezone_set ('Europe/Paris'); echo date('Y-m-d'); ?>">
                                    </div>                          
                                </details>
                                                    <!-- ----------------------------------------------------------------------------------     --> 
                        </div>            
                    </div> 












                                <input type="hidden"value="not_reviewed">
                                <input type="hidden" value="9">
                                <input type="hidden" value="2Tj6RKhMamw4HkFANJUNrFqbz054Y7wcluSG85QJQ_k">
                                <?php
                                    if(isset($_GET['error'])){
                                        $err = $_GET['error'];
                                        if($err==1 || $err==1){
                                            echo "<p style='color:red'>L'allocataire n'a pas pu etre enregistré</p>";
                                        }
                                    }
                                    ?>
                                <center><button id="action" class="sc-button green mt-3" type="submit" alt="add a person"><i class="fa fa-plus "></i> Ajouter l'allocataire</button>
                                  </center>
                    </form>
          
            <script>
                var element = document.getElementById('autre');
                var input = document.createElement('input');
                var elt = document.getElementById("checkbox");
                input.setAttribute('type','text');
                element.addEventListener("change",function(){
                if(elt.querySelectorAll(":checked"))
                {
                    input.style.display = "inline";
                    console.log('hey');
                }
            }, false);
            </script>
        </div>
     </div>

     <div id ="notifications">
  
  </div>
    <!-- Required Js -->
    
    <script src ="../assets/js/notif.js"></script>  
    <script src="../assets/js/script2.js"></script>
</body>
</html>
