<?php
 include_once '../entity/User.class.php';
 //Verification d'entrée
 if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])){
    //on crée une variable password qui prend la valeur de POST[password]
    $password = $_POST['password'];
    //On verifie la validité du mot de passe on veut qu'il ait au minimum 1 minuscule, 1 majuscule, 1 chiffre, et supérieur a 8 chiffre
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    if($uppercase && $lowercase && $number && strlen($password) >= 8) {
        //on crypte le password en utilisant la methode sha1
        $cryptedPassword = sha1($password);
        //création d'objet User
        $user = new User("","");
        //Methode d'inscription
        if($user->inscription(htmlentities($_POST['nom']),htmlentities($_POST['prenom']),$_POST['phone'],$_POST['email'],$cryptedPassword)){
            //redirection vers la page d'ajout avec succes
            header('location: ../views/ajoutUser.php?success=2');
            }
        else{
            //redirection vers la page d'ajout avec erreur
            header('location: ../views/ajoutUser.php?error=1');
            }
        }
    }
    else{
        //redirection vers la page d'ajout avec erreur
        header('location: ../views/ajoutUser.php?error=2');
    }

?>