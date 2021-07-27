<?php
include_once '../entity/Diary.class.php';
include_once 'singleton.class.php';
include_once 'Event.class.php';
include_once 'User.class.php';
//instanciation de l'Event et de l'USer
$event = new Event('');
$user = new User('','');
//$arr = $event->insertEvent('stp@gmail.com');
$arrUser = $user->displayUser();
//pour chaque valeur d'arrUser
for($i = 0; $i< count($arrUser); $i++){
    //on insere les events en fonction du nombre d'utilisateur
    $event->insertEvent($arrUser[$i]["email"]);
}
//insertion des cer dans la table event
$event->insertCer();