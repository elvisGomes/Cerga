<!DOCTYPE html>
<html lang="fr">

<head>
    <title>AFPA - Reset password</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <script src="../assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <link rel="icon" type="image/png" href="../assets/images/afpaOnglet.png" />
        <link href="../assets/css/notif.css" rel="stylesheet">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        @import "../assets/fonts/fontawesome/css/fontawesome-all.min.css";</style>

    <!-- Favicon icon -->
   

</head> 

<body>

    
            <div class=" col-md-8 offset-md-2 " style="margin-top: 8%;">
                <div class="card-body text-center">
                    
                    <form action ="../controller/updateMdp.action.php" method ="POST">
                    
                    <h2 class="mb-5">Entrez vos informations :</h2>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Email:</span>
                        </div>
                        <input type="email" class="form-control" name="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email'];} ?>"required>
                       
                    </div>
                    <div class="input-group mb-3">  
                    <!-- <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Ancien mot de passe :</span>
                        </div>
                        <input type="password" class="form-control" name="oldpassword"  required>
                       
                    </div> -->
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Nouveau mot de passe :</span>
                        </div>
                        <input id="newPassword" type="password" class="form-control" name="newpassword" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Requis:8 caracteres 1 majuscule, 1 minuscule, 1 chiffres" required>
                       
                    </div>
                    <br><span class="mb-3" id="verifPassword"></span><br>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Verification du mot de passe :</span>
                        </div>
                        <input id="verifNewPassword" type="password" class="form-control" name="verifpassword" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Requis:8 caracteres 1 majuscule, 1 minuscule, 1 chiffres" required>
                       
                    </div>
                    
                    <button class="btn mt-3 mb-4 shadow-2" style="background:#43b29d; color:#FFF;">Changer le mot de passe</button>
                    <?php
                      
                      if(isset($_GET['erreur'])){
                          $err = $_GET['erreur'];
                          if($err==1 || $err==2){
                              echo "<p style='color:red'>Email ou mot de passe incorrect</p>";
                          }
                      }
                      if(isset($_GET['success'])){
                        $success = $_GET['success'];
                        if($success==1){
                            echo "<p style='color:green'>Votre nouveau mot de passe a bien été enregistré</p>";
                        }
                    }
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Required Js -->
    
    <script src ="../assets/js/notif.js"></script> 
    <script src ="../assets/js/script3.js"></script>
</body>
</html> 
