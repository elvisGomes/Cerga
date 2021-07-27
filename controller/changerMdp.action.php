<?php
session_start();
require('../entity/singleton.class.php');
require('../entity/User.class.php');
require('../entity/CommonTraitement.php');

if(empty($_POST)){
    header('Location: ../index.php');
}
else{
    $IdUser = $_POST['modifIdUser'];
    //verification de l'existance du mail pour l'envoyer de mail renisialisation du mdp
    if(CommonTraitement::verifExistId($IdUser)){
        //création de l'URL
        $url = CommonTraitement::createUrl($IdUser);
        //envoie de mail avec l'url créer
        CommonTraitement::envoyerEmail($IdUser,$url);
        header('Location: ../index.php?success=4');
    }
}


 //Verification d'entrée
    if(isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['verifpassword'])){
        $newPassword = $_POST['newpassword'];
        $verifPassword = $_POST['verifpassword'];
//On verifie la validité du mot de passe on veut qu'il ait au minimum 1 minuscule, 1 majuscule, 1 chiffre, et supérieur a 8 chiffre
        $uppercaseNP = preg_match('@[A-Z]@', $newPassword);
        $lowercaseNP = preg_match('@[a-z]@', $newPassword);
        $numberNP    = preg_match('@[0-9]@', $newPassword);
//On verifie la validité du mot de passe on veut qu'il ait au minimum 1 minuscule, 1 majuscule, 1 chiffre, et supérieur a 8 chiffre
        $uppercaseVP = preg_match('@[A-Z]@', $verifPassword);
        $lowercaseVP = preg_match('@[a-z]@', $verifPassword);
        $numberVP   = preg_match('@[0-9]@', $verifPassword);
//si la verification se passe bien on crypte les password
        if($uppercaseNP && $lowercaseNP && $numberNP && strlen($newPassword) >= 8 && $uppercaseVP && $lowercaseVP && $numberVP && strlen($verifPassword) >= 8) {
            $cryptedVerifPassword = sha1($_POST['verifpassword']);
            $cryptedNewPassword = sha1($_POST['newpassword']);
            $cryptedOldpassword = sha1($_POST['oldpassword']);
    }
//sinon on redirige vers la page ChangerMdp.php avec une erreur en GET
    else{
        header('Location: ../views/changerMdp.php?erreur=1');
    }
}

else{
    header('Location: ../views/changerMdp.php?erreur=1');
}

//Recupération des données du formulaire
if(isset($_POST['email'])){
    $email = $_POST['email'];
}


//Création d'objet User
$user = new User($email, $cryptedOldpassword);

//Verification d'entrée 
if($user->connect() && $cryptedVerifPassword == $cryptedNewPassword){
    $user->changePwd($cryptedNewPassword);
    header('location: ../views/changerMdp?success=1');
}
else{
    header('Location: ../views/changerMdp.php?erreur=1');
}


?> 