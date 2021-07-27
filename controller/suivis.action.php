<?php

include_once '../entity/Report.class.php';
include_once '../entity/Workshop.class.php';
include_once '../entity/Accompaniment.class.php';
include_once '../entity/Situation.class.php';
session_start();
//stockage du get dans une variable
$chemin = $_GET['chemin'];

//condition si l'on viens de la page suvis
if($chemin == "suivis"){
//création de l'objet list
$list = new Report("","","",$_SESSION['allocNumber'],"");
//appel de la méthode pour recuprer les infos de la base de donnée et création du tableau arr 
$arr = $list->listReport();
//envoie des données en format JSON
echo json_encode($arr);
}


//condition si l'on viens du bouton voir
elseif ($chemin == "voir"){
   //recuperation du GET cpt dans une variable cpt
    $cpt = $_GET['cpt'];
    //instanciation de l'objet voir par la classe Report
    $voir = new Report("","","","","");
    //stockage des données dans un tableau arr par la methode voirRapport qui permet de ressortir les rapports de la base de donnée par rapport a un numero de rapport
    $arr = $voir->voirRapport($_SESSION['numeroRapport'.$cpt]);
    //envoie des donnée en format JSON
    echo json_encode($arr);
}
elseif ($chemin == "supp"){
      //recuperation du GET cpt dans une variable cpt
   $cpt = $_GET['cpt'];
   //instanciation de l'objet suppr par la classe Report
   $suppr = new Report("","","","","");
   //appel de la méthode supprimerRapport qui va supprimer le rapport avec le numéroRapport envoyé
   $suppr->supprimerRapport($_SESSION['numeroRapport'.$cpt]);
   header('location: ../views/home.php');
   
}
//condition pour traiter la page liste Atelier
elseif ($chemin == 'listeAtelier'){
   //instanciation de l'objet listeAtelier par la classe Workshop
   $listeAtelier = new Workshop("","","","",$_SESSION['allocNumber'],"");
   //stockage des données dans un tableau arr par la méthode workShopList qui va ressortir tout les atelier dans la base de donnée qui a cette SESSION['allocNumber']
   $arr = $listeAtelier->workShopList();
      //envoie des donnée en format JSON
   echo json_encode($arr);
}

//condition pour traiter la page resumerAtelier 
 else if($chemin == 'voirAtelier'){
       //recuperation du GET cpt dans une variable cpt
    $cpt = $_GET['cpt'];
     //instanciation de l'objet voir par la classe Workshop
    $voir = new Workshop("","","","","","");
    //stockage des données dans un tableau arr par la méthode voirAtelier qui va ressortir l'atelier specifique par rapport au numeroAtelier 
    $arr = $voir->voirAtelier($_SESSION['numeroAtelier'.$cpt]);
       //envoie des donnée en format JSON
    echo json_encode($arr);
 }
 elseif ($chemin == "suppAtelier"){
       //recuperation du GET cpt dans une variable cpt
   $cpt = $_GET['cpt'];
   //instanciation de l'objet suppr par la classe Workshop
   $suppr = new Workshop("","","","","","");
   //appel de la méthode supprmierAtelier qui va supprimer un atelier par rapport au numeroAtelier envoyé
   $suppr->supprimerAtelier($_SESSION['numeroAtelier'.$cpt]);
   header('location: ../views/home.php');
   
}


//condition pour traiter la page periodeAccompagnement
elseif ($chemin == 'periodeAccompagnement')
{ 
   //instanciation de l'objet acco par la classe Accompaniment
   $acco = new Accompaniment($_SESSION['allocNumber'],"","","","");
   //stockage des données dans un tableau arr par la méthode selectFollow qui va ressortir toutes les periode d'accomagnement de la base de donnée qui a cette SESSION['allocNumber']
   $arr = $acco->selectFollow();
      //envoie des donnée en format JSON
   echo json_encode($arr);
}
 //condition pour supp l'accompagnement
 elseif ($chemin == "suppAccompagnement"){
       //recuperation du GET cpt dans une variable cpt
   $cpt = $_GET['cpt'];
    //instanciation de l'objet suppr par la classe Accompaniment
   $suppr = new Accompaniment("","","","","");
   //application de la méthode suppFollow qui va supprimer la periode d'accompagmenet par rapport au numeroAccompagnement envoyé
   $suppr->suppFollow($_SESSION['numeroAccompagnement'.$cpt]);
   header('location: ../views/home.php');
   
}
elseif($chemin =="listSituation"){
    //instanciation de l'objet situation par la classe Situation
   $situation = new Situation("","","",$_SESSION['allocNumber'],"");
   //stockage des données dans un tableau arr par la méthode readSituation qui va ressortir toutes les situation de la base de donnée qui a cette SESSION['allocNumber']
   $arr = $situation->readSituation();
   //envoie des donnée en format JSON
   echo json_encode($arr);
}
elseif($chemin =="voirSituation"){
      //recuperation du GET cpt dans une variable cpt
   $cpt = $_GET['cpt'];
    //instanciation de l'objet situation par la classe Situation
   $situation = new Situation("","","","","");
   //stockage des données dans un tableau arr par la méthode voirSituation qui va ressortir la situation specifique au numeroSituation envoyé
   $arr = $situation->voirSituation($_SESSION['numeroSituation' . $cpt]);
   //envoie des donnée en format JSON
   echo json_encode($arr);
}

elseif($chemin =="Rapport"){
      //recuperation du GET cpt dans une variable cpt
   $cpt = $_GET['cpt'];
    //instanciation de l'objet voir par la classe Report
    $voir = new Report("","","","","");
    //stockage des données dans un tableau arr par la méthode voirRapport qui va ressortir la situation specifique au numeroRapport envoyé
    $arr = $voir->voirRapport($_SESSION['numeroRapport'.$cpt]);
       //envoie des donnée en format JSON
    echo json_encode($arr);
}

elseif($chemin =="Atelier"){
      //recuperation du GET cpt dans une variable cpt
   $cpt = $_GET['cpt'];
    //instanciation de l'objet voir par la classe Workshop
    $voir = new Workshop("","","","","","");
    //stockage des données dans un tableau arr par la méthode voirAtelier qui va ressortir la situation specifique au numeroAtelier envoyé
    $arr = $voir->voirAtelier($_SESSION['numeroAtelier'.$cpt]);
       //envoie des donnée en format JSON
    echo json_encode($arr);
}

elseif($chemin =="Bilan"){
      //recuperation du GET cpt dans une variable cpt
   $cpt = $_GET['cpt'];
    //instanciation de l'objet situation par la classe Situation
   $situation = new Situation("","","","","");
     //stockage des données dans un tableau arr par la méthode voirSituation qui va ressortir la situation specifique au numeroSituation envoyé
   $arr = $situation->voirSituation($_SESSION['numeroSituation' . $cpt]);
   //envoie des donnée en format JSON
   echo json_encode($arr);
}

?>