<?php
include_once "../entity/AdditionalInfo.class.php";
include_once "../entity/Beneficiary.class.php";
include_once "../entity/SocialItem.class.php";
session_start();

    //verification d'entrée
    if (isset($_POST['maitriseFrancais'])){
        //si la taille du tableau de POST['maitriseFrancais'] == 1 on continue ici 
        if(sizeof($_POST['maitriseFrancais']) == 1){
            //concatenation du POST dans une variable maitrise
            $maitrise = $_POST['maitriseFrancais'][0];
        }
        //si la taille du tableau de POST['maitriseFrancais'] == 2 on continue ici 
        elseif (sizeof($_POST['maitriseFrancais']) == 2){
            //concatenation des POST dans une variable maitrise
            $maitrise = $_POST['maitriseFrancais'][0] .' ' .  $_POST['maitriseFrancais'][1];
        }
        //si la taille du tableau de POST['maitriseFrancais'] == 3 on continue ici 
        elseif (sizeof($_POST['maitriseFrancais']) == 3){
            //concatenation des POST dans une variable maitrise
            $maitrise = $_POST['maitriseFrancais'][0] .' ' .  $_POST['maitriseFrancais'][1] .' ' .  $_POST['maitriseFrancais'][2];
        }
        
    }
    else  {
        //si il n'y a rien d'envoyer la variable maitrise est initialiser a vide
        $maitrise = "";
    }

    //verification de l'existance du tableau POST['itemSocial'] si oui on continue ici
    if(isset($_POST['itemSocial']))
        {
            // boucle qui permet de concatener tout les POST['itemSocial'] dans une varibale item
            for($i=0; $i<sizeof($_POST['itemSocial']) ; $i++){
                $item = $item . " " . $_POST['itemSocial'][$i];
            }
            
        }
        //si le tableau POST['item'] n'existe pas on initialise la varibale item vide
    else
        {
            $item = "";
        }
        //verification de l'existance du tableau POST['autre'] si oui on continue ici
    if(isset($_POST['autre'])){
        //stockage du POST dans la variable autre
            $autre = htmlentities($_POST['autre']);
        }
    else {
        //s'il n'existe pas on initialise la variable autre a vide
            $autre = "";
        }
    //verification si le tableau POST['comment'] est vide s'il ne l'est pas on continue ici
    if(!empty($_POST['comment'])){
        //stockage des données du tableau dans des variable
        $commSante = htmlentities($_POST['comment'][0]);
        $commAdmin = htmlentities($_POST['comment'][1]);
        $commLogement = htmlentities($_POST['comment'][2]);
        $commGarde = htmlentities($_POST['comment'][3]);
        $commAide = htmlentities($_POST['comment'][4]);
        $commTransport = htmlentities($_POST['comment'][5]);
        $commLecture = htmlentities($_POST['comment'][6]);
        $commFormation = htmlentities($_POST['comment'][7]);
        $commLien =htmlentities($_POST['comment'][8]);
    }
    //verif des l'existance et si le tableau POST['name'] n'est pas vide 
if(isset($_POST['name']) && !empty($_POST['name'])){
    //stockage du POST dans une SESSION
    $_SESSION['name'] = $_POST['name'];
}
//verif des l'existance et si le tableau POST['firstName'] n'est pas vide 
if(isset($_POST['firstName']) && !empty($_POST['firstName'])){
    //stockage du POST dans une SESSION
    $_SESSION['firstName'] = $_POST['firstName'];
}
//instanciation de l'objet infoSupp par la classe AdditionalInfo
$infoSupp = new AdditionalInfo(htmlentities($_POST['placeOfBirth']), htmlentities($_POST['nativeCountry']), @$_POST['permis'], 
htmlentities($_POST['adresse']), $_POST['tel'], $_POST['mail'],"", htmlentities($_POST['IDPE']),@$_POST['rqth'], $_POST['codePostal'], htmlentities($_POST['ville']), 
    $_POST['numRef'], $_POST['conseiller'], @$_POST['allocataireTravail'],
     @$_POST['dateTravail'], $_POST['heureMensuelle'], @$_POST['dejaTravaile'], 
     $_POST['DernierContrat'], @$_POST['allocataireEst'],htmlentities($_POST['referent']), 
     @$_POST['etude'], @$_POST['reconnu'], $maitrise,
     @$_POST['couverture'], @$_POST['logement'],$_POST['nbChild'],@$_POST['situationF'], htmlentities($_POST['autreStructure']), $_POST['dateOuverture']);
//instanciation de l'objet allocataire par la classe Beneficiary
$allocataire = new Beneficiary("",$_POST['name'],$_POST['firstName'],$_POST['birthDate'],@$_POST['gender']);
//instanciation de l'objet social par la classe socialItem
$social = new socialItem($item,$autre, "", $commSante, $commAdmin, $commLogement, $commGarde, $commAide, $commTransport, $commLecture, $commFormation, $commLien);
//application de chaque methode qui permette d'editer les information de l'allocataire
$infoSupp->updateAllocataire($_SESSION['allocNumber']);
$allocataire->updateBeneficiary($_SESSION['allocNumber']);
$social->updateSocialItem($_SESSION['allocNumber']);
header('location: ../views/home.php?succes=3');

?>