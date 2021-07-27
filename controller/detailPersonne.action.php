<?php 
include_once '../entity/Beneficiary.class.php';
include_once '../entity/AdditionalInfo.class.php';
include_once '../entity/Accompaniment.class.php';
session_start();
//on verifie si un CPT existe sinon on le met vide
if(empty($_SESSION['cpt'])){
    $_SESSION['cpt'] = "";
}
//implementation de la variable cafNumber avec les sessions
$cafNumber = $_SESSION['allocNum'.$_SESSION['cpt']];

//instanciation de l'objet fullInfo a partir de la class AdditionalInfo 
$fullInfo = new AdditionalInfo("","","","","","",$cafNumber,"","","","","","","","","","","","","","","","","","","","","","");
//application de la methode fllInfo qui va nous afficher toutes les informations sur l'allocataire
$arr = $fullInfo->fullInfo();

//envoie des données en format JSON
echo json_encode($arr);



?>