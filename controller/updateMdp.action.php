<?php
session_start();
require('../entity/singleton.class.php');
require('../entity/User.class.php');
require('../entity/CommonTraitement.php');
if(isset($_POST['newpassword']) && $_POST['verifpassword']){
    //on crée une variable password qui prend la valeur de POST[password]
    $password = $_POST['newpassword'];
    //On verifie la validité du mot de passe on veut qu'il ait au minimum 1 minuscule, 1 majuscule, 1 chiffre, et supérieur a 8 chiffre
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    if($uppercase && $lowercase && $number && strlen($password) >= 8) {
        //on crypte le mot de passe en sha1
        $cryptedNewPassword = sha1($_POST['newpassword']);
        $cryptedVerifPassword = sha1($_POST['verifpassword']);
        //instanciation de User
        if($cryptedNewPassword == $cryptedVerifPassword) {
        $user = new User("","");
        //Verification d'entrée 
      
        $user->resetMdp($cryptedNewPassword,$_POST['email']);
        //redirection avec succes vers l'accueil
        header('location: ../index.php?success=1');
        }
        else{
            //redirection vers la page d'ajout avec erreur
            header('location: ../views/ajoutUser?error=2');
        }
    }
    else{
        //redirection vers la page d'ajout avec erreur
        header('location: ../views/ajoutUser?error=2');
    }
}
else{
    //redirection vers la page d'ajout avec erreur
    header('location: ../views/ajoutUser?error=2');
}
?>