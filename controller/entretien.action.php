<?php 
include_once '../entity/Report.class.php';
include_once '../entity/Workshop.class.php';
include_once '../entity/Accompaniment.class.php';
include_once '../entity/Situation.class.php';

session_start();
$mail = $_SESSION['mail'];

$chemin = $_GET['chemin'];
//condition pour traiter l'ajout de rapport
 if(isset($_POST['date']) && isset($_POST['typeReport']) && isset($_POST['description']) && $chemin=="ajouterRapport") {
    //verification des champs rempli
     if(!empty($_POST['date']) && !empty($_POST['typeReport']) && !empty($_POST['description'])){
        //instanciaton de l'objet report par la classe Report
            $report = new Report($_POST['date'],$_POST['typeReport'],htmlentities($_POST['description']),$_SESSION['allocNum'.$_SESSION['cpt']],$mail);
            //application de la méthode SaveReport qui va ajouter le rapport dans la base de donnée
            $report->saveReport();
            header('location: ../views/home.php?success=ajouterRapport');
     }
     else {
        header('location: ../views/home.php?error=1');
     }
 }
//condition pour traiter editer un rapport
 elseif ($chemin =="editer"){
    //recuperation du GET cpt
    $cpt = $_GET['cpt'];
    //si le POST est Choisir le type de l'entretien le POST est changé en vide
    if($_POST['typeReport'] == "Choisir le type de l'entretien"){
       $_POST['typeReport'] = "";
    }
//instanciation de l'objet modifier par la classe Report
    $modifier = new Report($_POST['date'],$_POST['typeReport'],htmlentities($_POST['description']),"","");
    //application de la méthode editerRapport qui va permettre de mettre a jours le rapport par rapport au données envoyées
    $modifier->editerRapport($_SESSION['numeroRapport'.$cpt],$mail);
    header('location: ../views/home.php?success=editerRapport');
 }
 //condition pour traiter l'ajout d'un atelier
 elseif ($chemin =="ajouterAtelier" && isset($_POST['date']) && isset($_POST['typeAtelier']) && isset($_POST['dateParticipation'])){
    //verification des champs rempli
   if(!empty($_POST['date']) && !empty($_POST['typeAtelier']) && !empty($_POST['dateParticipation'])){
      //si la description arrive vide elle sera = a NULL
      if(empty($_POST['description'])){
         $_POST['description'] = null;
      }
      //instanciation de l'objet atelier par la classe Workshop
       $atelier = new Workshop($_POST['dateParticipation'],$_POST['date'],htmlentities($_POST['typeAtelier']),htmlentities($_POST['description']),$_SESSION['allocNum'.$_SESSION['cpt']],$mail);
       //application de la méthode saveWorkshop qui va permettre d'ajouter l'atelier a la base de donnée
       $atelier->saveWorkShop();
       header('location: ../views/home.php?success=ajoutAtelier');
      }
      else{
         header('location: ../views/home.php?error=2');
      }
 }
 //condition pour traiter l'edition d'un atelier
 elseif ($chemin =="editerAtelier"){
    //recupération de la valeur GET dans la variable cpt
   $cpt = $_GET['cpt'];
   //instanciation de l'objet modifierAtelier avec a classe Workshop
   $modifierAtelier = new Workshop($_POST['dateParticipation'],$_POST['date'],htmlentities($_POST['typeAtelier']),htmlentities($_POST['description']),"","");
   //application de la méthode editerAtelier qui va permettre de mettre un jours un atelier 
   $modifierAtelier->editerAtelier($_SESSION['numeroAtelier'.$cpt],$mail);
   header('location: ../views/home.php?success=editerAtelier');
 }

  //condition pour traiter l'ajout d'une période d'accompagnement
  elseif ($chemin =="ajouterPeriodeAccompagnement" ){
     //verification des champs rempli 
   if(!empty($_POST['dateOuverture']) && !empty($_POST['dateFermeture']) && !empty($_POST['accompagnement'])){
      //instanciation de l'objet accompaniment par la classe Accompaniment
      $accompaniment = new Accompaniment($_SESSION['allocNum'.$_SESSION['cpt']],$_SESSION['mail'],$_POST['dateOuverture'],$_POST['dateFermeture'],$_POST['accompagnement']);
      //application de la méthode addFollow qui va permettre d'ajouter une periode d'accompagnment dans la base de donnée
      $accompaniment->addFollow();
    
       header('location: ../views/home.php?success=ajouterPeriode');
      }
      else{
         header('location: ../views/home.php?error=2');
      }
   }
 //condition pour traiter l'édition d'une periode d'accompagnement
 elseif ($chemin == "modifierPeriodeAccompagnement")
 {
    //récupération des la valeur GET dans la variable cpt
   $cpt = $_GET['cpt'];
   //instanciation de l'objet modifierAccompgnement par la classe Accompaniment
   $modifierAccompagnement = new Accompaniment("","",$_POST['dateOuverture'],$_POST['dateFermeture'],$_POST['accompagnement']);
   //application de la méthode editFollow qui va permettre de mettre a jours une periode d'accompagenemnt.
   $modifierAccompagnement->editFollow($_SESSION['numeroAccompagnement'.$cpt]);
   header('location: ../views/home.php?success=modifierPeriode');
   
}
//condition pour traiter l'ajout d'une situation
 elseif ($chemin == 'ajouterSituation'){
    //verification d'entrée
    if(isset($_POST['date']) && isset($_POST['situation'])){
       //si la dateFin est vide on la converti en NUll
      if(empty($_POST['dateFin'])){
         $_POST['dateFin'] = null;
     }
     //instanciation de l'objet situation par la classe Situation
      $situation = new Situation($_POST['situation'],$_POST['date'],$_POST['dateFin'],$_SESSION['allocNum'.$_SESSION['cpt']],htmlentities($_POST['description']));
      //application de la méthode addSituation qui va permettre d'ajouter une nouvelle situation dans la base de donée
      $situation->addSituation();
      header('location: ../views/home.php?success=ajouterSituation');
    }
//condition pour traiter la modif d'une situation
    
 }
 elseif ($chemin =='modifierSituation'){
    //recupération de la valeur GET dans la variable cpt
      $cpt = $_GET['cpt'];
      //instanciation de l'objet situation par la classe Situation
      $situation = new Situation($_POST['situation'],$_POST['date'],$_POST['dateFin'],"",htmlentities($_POST['description']));
      //application de la méthode updateSituation qui va permettre d'étider une situation
      $situation->updateSituation($_SESSION['numeroSituation'.$cpt],$mail);
      
      header('location: ../views/home.php?success=modifierSituation');
}
?>