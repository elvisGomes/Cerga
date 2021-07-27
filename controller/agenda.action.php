<?php
 include_once '../entity/Diary.class.php';
 session_start();
 //Verification d'entrée
    
      //on affiche les évenements de l'agenda si le tableau get = lecture
      if($_GET['agenda'] == 'lecture'){
        //création de l'objet a partir de la classe Diary(agenda)
          $agenda = new Diary("","","");
          //appel de la fonction qui nous donne les resultats des données de la table agenda
          $arr = $agenda->readDiary($_SESSION['mail']);
          //formatage de la réponse en forma JSon pour etre lu par l'agenda qui est fais en JS.
          echo json_encode($arr);
      }
 
//on ajoute un evenement si le tableau get = ajouter
          elseif($_GET['agenda'] == 'ajouter'){
          if(isset($_POST['title']) && !empty($_POST['title'])){
            $title = htmlentities($_POST['title']);
            $date = $_POST['start'];
            $replace = str_replace("/","-",$date);
            $date = str_replace("à","",$replace);
            
       
            $vraiDate = date('Y-m-d H:i:s',strtotime($date));
            
              
              //création de l'objet a partir de la classe Diary(agenda)
              $agenda = new Diary($vraiDate,$title,"");
              //appel de la methode addEvent(ajouter un evenement)
              $agenda->addEvent($_SESSION['mail']);
              header('location: ../views/agenda.php?success=1');
              
               
          }
          else{
            header('location: ../views/agenda.php?error=1');
          }
      }

//on edit un event si le tableau GET = update
        elseif($_GET['agenda'] == 'update'){
          $date = date("Y-m-d H:i:s", strtotime($_POST['start'] . '+ 2 Hours')); 
         
              //création de l'objet a partir de la classe Diary(agenda)
              $agenda = new Diary($date,$_POST['title'],"");
              //appel de la methode editEvent(éditer un evenement)
              $agenda->editEvent($_POST['id']);
        }
        
  //on supprime un évenement dans l'agenda si le tableau GET = supp

        elseif($_GET['agenda'] == 'supp'){
          $agenda = new Diary("","","");
          $agenda->deleteEvent($_POST['id']);
        }
?>