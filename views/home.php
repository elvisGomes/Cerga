<!DOCTYPE html>
<html lang ="fr">

<?php 
  session_start();
  if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
    header ("Location: ../index.php");
  }
?>

<head>
                <meta charset="utf-8">
                <meta name = "viewport" content = "width=device-width, initial-scale =1.0">
             
                <title>AFPA</title>
 
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/images/afpaOnglet.png" />
    <link href="../assets/css/jquery.ambiance.css" rel="stylesheet">   
    <script src="../assets/js/jquery-2.1.1.min.js"></script>
    <script src="../assets/js/jquery.ambiance.js"></script>
    <script src="../assets/js/bootstrap4.3.1.js" ></script>
    <script type="text/javascript" src="../assets/js/script.js"></script>
    <link href="../assets/css/notif.css" rel="stylesheet">
<style> 


section #navbarColor
{
    background-color: #43b29d;
    height: 55px;
}

section #navbarColor li
{
    float: left;
    width: 33%;
    height: 45%;
    left: 0;
    background-color: #43b29d;
    text-align: center;
    color: white;
    line-height: 38px;
    list-style: none;
    /* enlever les puces*/
    font-size: 102%;
    padding-top: 7px;
}
</style>

   

    <style type="text/css">
        @import "../assets/fonts/fontawesome/css/fontawesome-all.min.css";

.navbar-icon-top .navbar-nav .nav-link > .fa {
  position: relative;
  width: 36px;
  font-size: 24px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
  font-size: 0.75rem;
  position: absolute;
  right: 0;
  font-family: sans-serif;
}

.navbar-icon-top .navbar-nav .nav-link > .fa {
  top: 3px;
  line-height: 12px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
  top: -10px;
}

@media (min-width: 576px) {
  .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
}



@media (min-width: 992px) {
  .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
}

@media (min-width: 1200px) {
  .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
  #navRight
  {
    display: none;
  }
}

    </style>
    
</head>
<body onload="test(); init();">

<?php ;
//stockage de la valeur Get dans une session compteur pour pouvoir afficher le bon allocataire
if(isset($_GET['data'])){
  if(!isset($_SESSION['cpt'])){
    $_SESSION['cpt'] ="";
  }
  $_SESSION['allocNum'] = $_GET['data'];
  $_SESSION['allocNumber'] = $_SESSION['allocNum'];
  $_SESSION['firstName'] = $_GET['prenom'];
  $_SESSION['name'] = $_GET['nom']; 
}
elseif(empty($_SESSION['cpt'])){
        if( isset ($_GET['count'])){
            $count = $_GET['count'];
            $_SESSION['cpt'] = $count;
        }
        else {
            $count = "";
            $_SESSION['cpt'] = $count;
        }
        $_SESSION['allocNumber'] =  $_SESSION['allocNum' . $_SESSION['cpt']];
}
?>



<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand"><img style="width: 100px; height= 100px; border-radius:5px;" src="../assets/images/afpaT.jpg"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="accueil.php">
          <i class="fa fa-home"></i>
          Accueil
          <span class="sr-only">(current)</span>
          </a>
      </li>
    
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-envelope">
          </i>
          Section
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="agenda.php">Agenda</a>
          <a class="dropdown-item" href="../controller/listeAllocataire.action.php">Liste allocataires</a>
          <a class="dropdown-item" href="ajoutPersonne.php">Ajout d'un allocataire</a>
          <a class="dropdown-item" href="bilanGeneral.php">Bilan General</a>  
          <!-- A vertical navbar -->
          <!-- <div id="navRight">
                <a class="dropdown-item"  data-target="DetailPersonne" href="#">Détails de l'allocataire</a>
            
                <a class="dropdown-item"  data-target="suivis" href="#" >Rapports</a>
            
                <a class="dropdown-item"   data-target="periodeAccompagnement" href="#">Contrat d'engagement</a>
            
                <a class="dropdown-item"  data-target="listeAtelier"href="#" >Ateliers</a>
          
                <a class="dropdown-item"  data-target="document" href="#">Documents</a>
            
                <a class="dropdown-item"  data-target="bilan" href="#">Situation</a>
          </div>   -->
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ">
    <li class="nav-item active">
        <a class="nav-link">
          <i class=></i>
          <h4>Bienvenue</h4> <?php echo $_SESSION['prenom']; ?>
          <span class="sr-only">(current)</span>
          </a>
      </li>
    <li class="nav-item" id="notif">
        <a class="nav-link" href="#">
          <i class="fa fa-bell">
            <span id="cloche" class="badge badge-info"><?php ?></span>
          </i>
          Rappel
        </a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-cog"></i>
          Paramètres
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="changerMdp.php">Changement de mot de passe</a>
          <a class="dropdown-item" href="ajoutUser.php">Inscription</a>
          
        </div>
      </li>
      

      <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="fa fa-power-off">
            </i>
          Se déconnecter
        </a>
        
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="../controller/recherchePersonne.action.php" method="POST">
      <input class="form-control mr-sm-2" name = "info" type="text" placeholder="Rechercher" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0"  type="submit">Rechercher</button>
    </form>
    
  </div>
</nav>


<div id ="notifications">
  
</div>


<div class="container-float">
            <div class="row">
                <div class="  col-xs-12  col-sm-12 col-md-12 col-lg-12 "> 
                    <!-----premiere barre verte--> 
                    <section>
                            <div id = "navbarColor">
                                <ul>
                                    <li>
                                        <strong> Nom : </strong><?php  ; echo  $_SESSION['name' . $_SESSION['cpt']]; ?> <!--ici il faudra inserer un code php--> 
                                    </li>
                                    <li>
                                        <strong> Prénom : </strong> <?php  ; echo  $_SESSION['firstName' . $_SESSION['cpt']]; ?><!--ici il faudra inserer un code php--> 
                                    </li>
                                    <li>
                                         <strong>N°Allocataire :</strong> <?php  ; echo  $_SESSION['allocNumber']; ?> <!--ici il faudra inserer un code php--> 
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>  
                </div> 
            </div>      <br/> <br/>
            <p><noscript>
<div class="row"> 
<div class="col-md-3"></div>
      <div class="alert alert-dismissible alert-danger text-center col-md-6">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Votre module javascript est désactivé !</strong> <br> L'application ne fonctionne pas sans JavaScript. Veuillez le réactiver dans vos paramètres.
      </div>
</div>
      </noscript></p>
        <style type="text/css">
        .bg-light
        {
            background-color: #43b29d!important;
        }
        .rightLink
        {
            color: white!important;
        }
      
       
        @media (max-width: 800px)
        {
            #navRight1
            {
               display: none;
            }
        }
        </style>

        <div id="navRight1">
          <!-- A vertical navbar -->
          <nav class="navbar bg-light float-right" style="background-color:transparent !important ;">

          <!-- Links -->
          <ul  class="navbar-nav pr-3" >
              <li class="nav-item ">
                  <a class="nav-link rightLink right1 pr-5"  id="detail" data-target="DetailPersonne" href="#">DÉTAILS DE L'ALLOCATAIRE</a>
              </li>     
              <li class="nav-item">
                  <a class="nav-link rightLink right2 pr-5"  data-target="suivis" href="#" >RAPPORTS</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link rightLink right3 pr-5"   data-target="periodeAccompagnement" href="#">CONTRAT D'ENGAGEMENT</a>
              </li>
            <li>
                  <a class="nav-link rightLink right4 pr-5"  data-target="listeAtelier"href="#" >ATELIERS</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link rightLink right5 pr-5"  data-target="document" href="#">DOCUMENTS</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link rightLink right6 pr-5"  data-target="bilan" href="#">SITUATION</a>
              </li>
          </ul>
          </nav>
        </div>
        
        
     
        
    <div id="content">
     
    </div>
        <script src ="../assets/js/notif.js"></script>
    
    </body>
  
    </html>