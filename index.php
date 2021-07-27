<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Afpa Project</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

    <!-- Meta -->
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../assets/images/afpaOnglet.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Datta Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, datta able, datta able bootstrap admin template, free admin theme, free dashboard template"/>
    <meta name="author" content="CodedThemes"/>

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
         
            <div class="card">
           
                <div class="card-body text-center">
                    <div class="mb-4">
                    
                        <i class="feather icon-unlock auth-icon"></i>
                    </div>
                    <form action="controller/login.action.php" method="POST">
                    <p>
                    <img style="width: 180px; height= 180px; border-radius:5px;" src="assets/images/afpaT.jpg">
                    </p>
                    <?php if(!isset($_COOKIE['token'])){?>
                    <h3 class="mb-4">Se connecter</h3>
                    <div class="input-group mb-3">
                        <input for="id_user" type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group mb-4">
                        <input for="mp_user" type="password" class="form-control" name="password" placeholder="password" required>
                    </div>
                   
                    <button  name="bouton" id="bouton" value = "bouton" class="btn btn-primary mb-4 shadow-2">connexion</button>
                    <p class="mb-2 text-muted">Mot de passe oublié ? <a href="views/resetMdp.php">Réinitialiser</a></p>
                    <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2){
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    }
                }
            
               
                

                ?>
                 <?php
                      
                                  
                      if(isset($_GET['success'])){
                          $success = $_GET['success'];
                          if($success==4){
                              echo "<p style='color:green'>L'email a bien été envoyé</p>";
                          }
                      }
                    } else {
                      ?>
                         <h3 class="mb-4">Se reconnecter</h3>
                
                    
                       
                    </div>
                    <button  name="bouton" id="bouton" value = "bouton" class="btn btn-primary mb-4 shadow-2 col-md-7 ml-auto mr-auto">Reconnexion</button>
                    <p class="mb-2 text-muted text-center">Retour a la page de  : <a href="controller/login.action.php?chemin=retour">Connexion</a></p>
                    <p class="mb-2 text-muted text-center">Mot de passe oublié ? <a href="views/resetMdp.php">Réinitialiser</a></p>
                    <?php }?>

            </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
