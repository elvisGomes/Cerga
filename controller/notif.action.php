<?php 
/**
 * @author Clément Broucke, Mehdi Nasri
 */
include_once '../entity/Event.class.php';
//demarrage de la session
session_start();
$mail = $_SESSION['mail'];
//Si le chemin est = a afficher
if ($_GET['chemin'] == 'afficher'){
    //on instancie Event
    $notif = new Event("");
    //on crée un tableau qui contient les données de la table Event 
    $arr = $notif->displayEvent($mail);
    //envoie des données au format JSON
    echo json_encode($arr);
    }
//Si le chemin est =  a supprimer
elseif($_GET['chemin'] == 'supprimer'){
    //instanciation de Event
    $notif = new Event("");
    //on update le status en fonction de l'ID renvoyé
    $arr = $notif->updateStatus($_GET['id']);
    }

?>