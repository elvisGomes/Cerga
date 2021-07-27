<!DOCTYPE html>
<html lang="fr">

<head>
    <title>AFPA</title>
       
        <link href="../assets/css/notif.css" rel="stylesheet">
        <script src="../assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
        <link rel="icon" type="image/png" href="../assets/images/afpaOnglet.png" />


</head>

<body>
    <?php include 'nav.php'?>
            <div class="col-md-8 offset-md-2 mt-5">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-help-circle auth-icon"></i>
                    </div>
                    <form action ="../controller/ajoutUser.action.php" method ="POST">
                   
                    <h3 class="mb-4">Entrez vos informations</h3>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Nom :</span>
                        </div>
                        <input type="text" class="form-control" name="nom"  required>
                       
                    </div>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Prénom:</span>
                        </div>
                        <input type="text" class="form-control" name="prenom"  required>
                       
                    </div>
                    <div class="input-group mb-3">  <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                        </div>
                        <input type="tel" class="form-control" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" name="phone" maxlength="10" required>
                       
                    </div>
                    <div class="input-group mb-3">  
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Email:</span>
                        </div>
                        <input type="email" class="form-control" name="email" required>
                       
                    </div>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Mot de passe :</span>
                        </div>
                        <input type="password" class="form-control" name="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Requis:8 caracteres 1 majuscule, 1 minuscule, 1 chiffres" required>
                       
                    </div>
                    
                    <button class="btn btn-primary mb-4 shadow-2" style="background:#43b29d; color:#FFF;">Valider</button>
                    <?php
                      
                      
                    if(isset($_GET['success'])){
                        $success = $_GET['success'];
                        if($success==2){
                            echo "<p style='color:green'>Un nouvel utilisateur a bien été enregistré</p>";
                        }
                    }
                    else if(isset($_GET['error'])){
                        $error = $_GET['error'];
                        if($error==2){
                            echo "<p style='color:red'>Le format du mot de passe n'est pas valide</p>";
                        }
                        else if($error==1){
                            echo "<p style='color:red'>L'email est déja enregistré</p>";
                        }
                    }
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->

    <div id ="notifications">
  
  </div>
    <!-- Required Js -->
    
    <script src ="../assets/js/notif.js"></script>  
</body>
</html>
