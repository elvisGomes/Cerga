<?php 
  session_start();
  if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
    header ("Location: ../index.php");
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>AFPA</title>
    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
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

@media (min-width: 768px) {
  .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa > .badge {
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
}

    </style>
    <link href="../assets/css/jquery.ambiance.css" rel="stylesheet">
   
    <!-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <script src="../assets/js/jquery.ambiance.js"></script>
    <script src="../assets/js/bootstrap4.3.1.js" ></script>
    
    
    
</head>
<body>

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
          <a class="dropdown-item" href="bilanGeneral.php">Bilan general</a>
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
    <form class="form-inline my-2 my-lg-0" action="../controller/recherchePersonne.action.php" method ="POST">
      <input class="form-control mr-sm-2" name = "info" type="text" placeholder="Rechercher" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0"  type="submit">Rechercher</button>
    </form>
    
  </div>
</nav>
<p><noscript>
<div class="row"> 
<div class="col-md-3"></div>
      <div class="alert alert-dismissible alert-danger text-center col-md-6">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Votre module javascript est désactivé !</strong> <br> L'application ne fonctionne pas sans JavaScript. Veuillez le réactiver dans vos paramètres.
      </div>
</div>
      </noscript></p>

<!-- Modal -->



</body>
</html>
