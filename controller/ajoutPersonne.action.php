<?php
include_once("../entity/AdditionalInfo.class.php");
include("../entity/Accompaniment.class.php");
include('../entity/SocialItem.class.php');
session_start();
echo $_SESSION['mail'];
//verification que les valeurs required sont bien entrés et non vide
if(!empty($_POST['name']) && isset($_POST['firstName']) && isset($_POST['birthDate']) && isset($_POST['allocataireNumber']) && is_string($_POST['name'])  && is_string($_POST['firstName']) && strlen($_POST['allocataireNumber']) == 7)
{   //verification de la maitrise du francais en fonction du nombre de reponse coché on concatenne les reponses avaant leur insertion en bdd
    if (isset($_POST['maitriseFrancais'])){
        if(sizeof($_POST['maitriseFrancais']) == 1){
            $maitrise = $_POST['maitriseFrancais'][0];
        }
        elseif (sizeof($_POST['maitriseFrancais']) == 2){
            $maitrise = $_POST['maitriseFrancais'][0] .' ' .  $_POST['maitriseFrancais'][1];
        }
        elseif (sizeof($_POST['maitriseFrancais']) == 3){
            $maitrise = $_POST['maitriseFrancais'][0] .' ' .  $_POST['maitriseFrancais'][1] .' ' .  $_POST['maitriseFrancais'][2];
        }
        
    }
    else  {
        $maitrise = "";
    }
    //verification de le presence d'item sociaux
    if(isset($_POST['itemSocial']))
    { 
        //pour chaque valeur d'item sociaux entré 
        for($i=0; $i<sizeof($_POST['itemSocial']) ; $i++){
            //concatennation de ces differentes valeurs
            $item = $item . " " . $_POST['itemSocial'][$i];
        }
    }
    //sinon on instancie item vide
    else
    {
        $item = "";
    }
    //verification du champs autre des items sociaux si il n'est pas présent on l'instancie vide
    if(isset($_POST['autre'])){
        $autre = htmlentities($_POST['autre']);
    }
    else {
        $autre = "";
    }
    //Si les commentaires d'items sociaux ne sont pas vides on leur donne les valeurs correspondante dans le form
    if(!empty($_POST['comment'])){
        $commSante = htmlentities($_POST['comment'][0]);
        $commAdmin = htmlentities($_POST['comment'][1]);
        $commLogement = htmlentities($_POST['comment'][2]);
        $commGarde = htmlentities($_POST['comment'][3]);
        $commAide = htmlentities($_POST['comment'][4]);
        $commTransport = htmlentities($_POST['comment'][5]);
        $commLecture = htmlentities($_POST['comment'][6]);
        $commFormation = htmlentities($_POST['comment'][7]);
        $commLien = htmlentities($_POST['comment'][8]);
    }
    //instanciation de la bdd
    $dbi = Singleton::getInstance();
    //connexion a la bdd
    $db=$dbi->getConnection();
    //on utilise beginTransaction pour desactiver l'autocommit des requetes
    $db->beginTransaction();
    //instanciation de la class Allocataire
    $allocataire = new Beneficiary($_POST['allocataireNumber'],$_POST['name'],$_POST['firstName'],$_POST['birthDate'],@$_POST['gender']);
    //on instancie les infos complémentaires AdditionalInfos
    $infoSupp = new AdditionalInfo(htmlentities($_POST['placeOfBirth']), htmlentities($_POST['nativeCountry']), @$_POST['permis'], 
    htmlentities($_POST['adresse']), $_POST['tel'], $_POST['mail'], $_POST['allocataireNumber'], htmlentities($_POST['IDPE']),@$_POST['rqth'], $_POST['codePostal'], htmlentities($_POST['ville']), 
    $_POST['numRef'], htmlentities($_POST['conseiller']), @$_POST['allocataireTravail'],
     @$_POST['dateTravail'], $_POST['heureMensuelle'], @$_POST['dejaTravaile'], 
     $_POST['DernierContrat'], @$_POST['allocataireEst'],htmlentities($_POST['referent']), 
     @$_POST['etude'], @$_POST['reconnu'], $maitrise,
     @$_POST['couverture'], @$_POST['logement'],$_POST['nbChild'],@$_POST['situationF'],
     htmlentities($_POST['autreStructure']), $_POST['dateOuverture']);
    //verification du champ dateOn est dateOff
    if(empty($_POST['dateOn'])){
        $_POST['dateOn'] = null;
    }
    if(empty($_POST['dateOff'])){
        $_POST['dateOff'] = null;
    }
    //instanciation de la classe Accompaniment
    $accompaniment = new Accompaniment($_POST['allocataireNumber'], $_SESSION['mail'],$_POST['dateOn'],$_POST['dateOff'],$_POST['accompagnement']);
    //instanciation de la classe socialItem
    $social = new socialItem($item,$autre, $_POST['allocataireNumber'], $commSante, $commAdmin, $commLogement, $commGarde, $commAide, $commTransport, $commLecture, $commFormation, $commLien);
    //verification de la presence ou non du numero d'allocataire saisi dans le form dans la bdd
    if($allocataire->checkCafNumber($_POST['allocataireNumber'])){
        //Vérification que les requetes d'insertion dans les tables accompaniment, socialItem, additionalInfos, et allocataire
        if($allocataire->signUP() && $infoSupp->addInfo() && $accompaniment->addFollow() && $social->addAid()){
            //Si les 3 requetes sont valides on les commit
            $db->commit();
            //redirection vers la page d'accueil en cas de succes
            header('location: ../views/accueil.php?success=2');
        }
        else {
            //sinon annulation des requetes
            $db->rollback();
            //et retour a la page ajoutPersonne
            header('location: ../views/ajoutPersonne.php?error=else');
        }
    }
    else{header('location: ../views/ajoutPersonne.php?error=cafNumber');
    }
}
else {
    header('location: ../views/ajoutPersonne.php?error=1');
}
?>