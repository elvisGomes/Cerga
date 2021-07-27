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
                <link href="../assets/css/notif.css" rel="stylesheet">
                <title>details personnes</title>

               

                

</head>

<!-------------------------------------------------------------------------------------------------->
<!-- @author Marine Richini marine.richini@gmail.com-->
<body>
<?php 
/**
 * @author Clément Broucke
 */
$infos = json_decode($_POST['infos']);
$dt = DateTime::createFromFormat('Y-m-d', $infos[0]->birthDate);
$birthDate = $dt->format('d/m/Y'); 
if($infos[0]->dateTravail == null){ 
    $dateTravail = "-"; 
}
else{
    $dt2 = DateTime::createFromFormat('Y-m-d', $infos[0]->dateTravail);
    $dateTravail = $dt2->format('d/m/Y');
}
if($infos[0]->dernierContrat == null){ 
    $dernierContrat = "-"; 
}
else{
    $dt3 = DateTime::createFromFormat('Y-m-d', $infos[0]->dernierContrat);
    $dernierContrat = $dt3->format('d/m/Y');
}
if($infos[0]->dateOuverture == null){ 
    $dateOuverture = "-"; 
}
else{
    $dt4 = DateTime::createFromFormat('Y-m-d', $infos[0]->dateOuverture);
    $dateOuverture = $dt4->format('d/m/Y');
}
if($infos[0]->dateFermeture == null){ 
    $dateFermeture = "-"; 
}
else{
    $dt5 = DateTime::createFromFormat('Y-m-d', $infos[0]->dateFermeture);
    $dateFermeture = $dt5->format('d/m/Y');
}
?>

<script src="../assets/js/script.js"></script>

 
<section class="marge"> <!-- données personnelles-->

    <div class="container-fluid col-md-10 col-lg-10" style="margin-left:17%;">
   
   
    </div>
    <div class="container container-detail" >
        <div class="row">
                <div class=" col-xs-10  col-sm-10  col-md-6 col-lg-5"> 

                       <h3 class="h3Personne"> <U> <font style color = > Données personnelles </font> </U> </h3> 
                        <strong>Nom : </strong> <?php   echo  $infos[0]->name ?>  <br/>
                        <strong>Prénom : </strong> <?php   echo  $infos[0]->firstName; ?>  <br/>
                        <strong>Etat civil : </strong> <?php   echo  $infos[0]->gender; ?>  <br/>
                        <strong>N° Allocataire : </strong> <?php   echo  $infos[0]->allocataireNumber; ?>  <br/>
                        <strong>N° Référence : </strong> <?php if($infos[0]->numero_reference == null){ echo "-"; }else{echo $infos[0]->numero_reference; }  ?> <br/> <hr/>
                       
               
                       <br/></br><h3 class="h3Personne"> <U> <font style color =  > Naissance </font> </U> </h3> 
                        <strong>Date de naissance : </strong>  <?php echo $birthDate; ?>  <br/>
                        <strong>Lieu de naissance : </strong>  <?php if($infos[0]->placeOfBirth== null){ echo "-"; }else{echo $infos[0]->placeOfBirth; }  ?>    <br/>
                        <strong>Pays de naissance : </strong> <?php if($infos[0]->nativeCountry == null){ echo "-"; }else{echo $infos[0]->nativeCountry; }  ?>   <br/> <hr/>
                           
                   
                </div>       
                <div class=" col-xs-10  col-sm-10  col-md-6 col-lg-5"> 
                        <h3 class="h3Personne"> <U> <font style color => Situation actuelle </font> </U> </h3> 
                        <strong>Vous travaillez : </strong> <?php if($infos[0]->allocataireTravail == null){ echo "-"; }else{echo $infos[0]->allocataireTravail; }  ?>  <br/>
                        <strong>Si oui, depuis le : </strong> <?php echo $dateTravail  ?> <br/>
                        <strong>Nombre d'heures mensuelles : </strong><?php if($infos[0]->heureMensuelle == null){ echo "-"; }else{echo $infos[0]->heureMensuelle; }  ?>  <br/>
                        <strong>Deja travaillé(e) ? : </strong> <?php if($infos[0]->dejaTravailler == null){ echo "-"; }else{echo $infos[0]->dejaTravailler; }  ?><br/>
                        <strong>Date du dernier contrat de travail : </strong>  <?php echo $dernierContrat;  ?><br/>
                        <strong>Vous êtes : </strong> <?php if($infos[0]->statutAllocataire == null){ echo "-"; }else{echo $infos[0]->statutAllocataire; }  ?><br/>
                        <strong>Situation familiale : </strong> <?php if($infos[0]->situation_familial == null){ echo "-"; }else{echo $infos[0]->situation_familial; }  ?><br/>
                        <strong>Nombre d'enfants  : </strong> <?php if($infos[0]->nb_enfants == null){ echo "-"; }else{echo $infos[0]->nb_enfants; }  ?> <br/>
                        <strong>Reconnaisance "Travailleur handicapé" : </strong> <?php if($infos[0]->RQTH == null){ echo "-"; }else{echo $infos[0]->RQTH; }  ?> <br/>
                        <strong>Niveau d'études : </strong> <?php if($infos[0]->niveauEtude == null){ echo "-"; }else{echo $infos[0]->niveauEtude; }  ?> <br/><strong>Reconnu en France : </strong> <?php if($infos[0]->reconnuEnFrance == null){ echo "-"; }else{echo $infos[0]->reconnuEnFrance; }  ?> <br/>
                        <strong>Niveau de maîtrise du Français : </strong>  <?php if($infos[0]->maitriseFrancais == null){ echo "-"; }else{echo $infos[0]->maitriseFrancais; }  ?>  <br/>
                        <strong>Permis de conduire: </strong> <?php if($infos[0]->driverSLicense == null){ echo "-"; }else{echo $infos[0]->driverSLicense; }  ?>   <br/>
                        <strong>Couverture sociale : </strong> <?php if($infos[0]->couvertureSocial == null){ echo "-"; }else{echo $infos[0]->couvertureSocial; }  ?>  <br/>
                        <strong>Logement : </strong> <?php if($infos[0]->logement == null){ echo "-"; }else{echo $infos[0]->logement; }  ?>  <hr/>
                     
                </div>      
        
        
            
                <div class=" col-xs-10  col-sm-10  col-md-6 col-lg-5"style="margin-top:2%;"> 
                    <h3 class="h3Personne"> <U> <font style color = > Contrat d'engagement </font> </U> </h3> 
                            <strong>Accompagnement :</strong>  <?php if($infos[0]->type_d_accompagnement == null){ echo "-"; }else{echo $infos[0]->type_d_accompagnement; }  ?> <br/>
                            <strong>Date d'ouverture de l'accompagnement :</strong> <?php echo $dateOuverture; ?> <br> 
                            <strong>Date de fin de l'accompagnement :</strong> <?php echo $dateFermeture; ?> <br> 
                            <U> <strong> Items sociaux : </U></strong> <?php if($infos[0]->socialType == null){ echo "-"; }else{echo $infos[0]->socialType; } echo $infos[0]->autre    ?> <br>

                                <strong>Commentaires items sociaux :</strong>
                                <ul>
                                <?php if($infos[0]->comment_sante != ""){echo "<li>".$infos[0]->comment_sante."</li>";}
                                if($infos[0]->comment_logement != ""){echo "<li>".$infos[0]->comment_logement."</li>";}
                                if($infos[0]->comment_administratif != ""){echo "<li>".$infos[0]->comment_administratif."</li>";}
                                if($infos[0]->comment_garde != ""){echo "<li>".$infos[0]->comment_garde."</li>";}
                                if($infos[0]->comment_aide != ""){echo "<li>".$infos[0]->comment_aide."</li>";}
                                if($infos[0]->comment_transport != ""){echo "<li>".$infos[0]->comment_transport."</li>";}
                                if($infos[0]->comment_lecture != ""){echo "<li>".$infos[0]->comment_lecture."</li>";}
                                if($infos[0]->comment_formation != ""){echo "<li>".$infos[0]->comment_formation."</li>";}
                                if($infos[0]->comment_lien != ""){echo "<li>".$infos[0]->comment_lien."</li>";}?>
                                </ul>
                            <hr/> 
                   
                </div>  

                <div class=" col-xs-10  col-sm-10  col-md-6 col-lg-5" > 
                    <h3 class="h3Personne h3InformationContact"> <U> <font style color => Information de contact </font> </U> </h3> 
                    <strong>Adresse : </strong>  <?php if($infos[0]->adress == null){ echo "-"; }else{echo $infos[0]->adress; }  ?>   <br/>
                    <strong>Ville : </strong> <?php if($infos[0]->nativeCountry == null){ echo "-"; }else{echo $infos[0]->ville; }  ?>   <br/>
                    <strong>Code postal : </strong> <?php if($infos[0]->nativeCountry == null){ echo "-"; }else{echo $infos[0]->codePostal; }  ?>   <br/>     
                    <strong>E-mail :</strong>  <?php if($infos[0]->mail == null){ echo "-"; }else{echo $infos[0]->mail; }  ?>  <br/>
                    <strong>Numéro de téléphone : </strong>  <?php if($infos[0]->phoneNumber == null){ echo "-"; }else{echo $infos[0]->phoneNumber ; }   ?>  <hr/>
                    
                </div>  
        </div> 



        <div class="row modifierDetailBouton">
            <div class=" col-xs-10  col-sm-10  col-md-7 col-lg-6" style="margin-left:20%";> 
                <br/><a href="#" class ="modifierDetailPersonne"><button class="boutonDetail" type="submit">MODIFIER</button>
            </div>
        </div>   
    </div>      
  
</body>
</html>
  
  