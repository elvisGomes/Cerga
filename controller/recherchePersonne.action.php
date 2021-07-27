<?php 
include_once '../entity/Beneficiary.class.php';
session_start();
//instanciation de l'objet allocataire
$allocataire = new Beneficiary("","","","","");
//test d'entrée
if($allocataire->recherchePersonne($_POST['info']) == false) {
    //redirection vers l'accueil si erreur
    header('location: ../views/accueil.php?error=1');
}
if(empty($_POST['info']) || !isset($_POST['info'])){
    //redirection vers l'accueil si erreur
    header('location: ../views/accueil.php?error=2');
}

elseif(isset($_POST['info']) && !empty($_POST['info']) && $allocataire->recherchePersonne($_POST['info'])){
    
$_SESSION['info'] = $_POST['info'];
//appel de la methode pour mettre en place la requete SQL
$allocataire->recherchePersonne($_SESSION['info']);
//stockage des information envoyer par la requete dans des tableaux Session
$_SESSION['birthDate'] = $allocataire->get_birthDate();
$_SESSION['name'] = $allocataire->get_name();
$_SESSION['firstName'] = $allocataire->get_firstName();
$_SESSION['allocNum'] = $allocataire->get_cafNumber();
//Appel de la methode pour rechercher les allocataire similaire avec requete SQl
$arr = $allocataire->rechercheSimilaire($_POST['info']);
$i = 0;
//Boucle qui va permettre de stocker tout les allocataire similaire dans des tableau Session
foreach($arr as $row){
    $i++;
    $_SESSION['birthDate' . $i] = $row['birthDate'];
    $_SESSION['name' . $i] = $row['name'];
    $_SESSION['firstName' . $i] = $row['firstName'];
    $_SESSION['allocNum' . $i] = $row['allocataireNumber'];
}

//Redirection vers la page de resultat des recherche d'allocataire si tout est ok 
header("location: ../views/resultatRecherchePersonne.php?count=$i");
}

?>