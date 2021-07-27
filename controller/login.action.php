<?php 
include_once '../entity/User.class.php';
include_once '../entity/Diary.class.php';
include '../vendor/firebase/php-jwt/src/JWT.php';
include '../vendor/firebase/php-jwt/src/SignatureInvalidException.php';
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\JWT;
session_start();
//initialisation de la clé JWT dans la variable key
$key = "cerga";
//vérification de la présence du mot de passe
if(isset($_POST['password'])){
    //il est présent on le hache en utilisant sha1
    $cryptedPassword = sha1($_POST['password']);
}


//verification de l'existance du cookie['token'] et du POST['email'] en cas de non présence du cookie et de la présence de l'email on continue
if(!isset($_COOKIE['token']) && isset($_POST['email'])){
    //stockage de l'email dans une variable email et dans un Tableau session['email']
    $email = $_POST['email'];
    $_SESSION['mail'] = $email;
    //instanciation de l'objet user par la classe User
    $user = new User($email,$cryptedPassword);
    //stockage du prenom dans un tableau SESSION['prenom']
    $_SESSION['prenom'] = $user->get_firstName();
    //verification de l'email et du password par la méthode connect et verification du status par la methode checkstatus
    if($user->connect() && $user->checkStatus()) {
        $user->historique();
        //stocckage des données dans des variables
        $arrUser = $user->getUser();
        $statusToken = $arrUser[0]['status'];
        $emailToken = $arrUser[0]['email'];
        $nomToken = $arrUser[0]['nom'];
        $prenomToken = $arrUser[0]['prenom'];
        $_SESSION['status'] = $statusToken;
        $date = date('Y-m-d H:i:s');
        //création de la variable token (payload) JWT
        $token = [
            'user_email' => $emailToken,
            'user_name' => $nomToken,
            'user_firstName' => $prenomToken,
            'user_status' => $statusToken,
            'creation_time' => $date,
        ];
        //création du token par la methode static de la classe JWT
        $tok = JWT::encode($token,$key);
        //on set le token dans un cookie
        setcookie('token',$tok, time()+3600*24, "/");
        header('location:../views/accueil.php?check=success');
    }
    else{
        header('Location: ../index.php?erreur=1');
    }
}
//verification de l'existance du cookie['token'] s'il existe on continue
elseif (isset($_COOKIE['token'])){
    $token = $_COOKIE['token'];
    //création du tableau algo qui va permettre d'etre utiliser pour la méthode static de la classe JWT(decode)
    $algo = array("HS256");
    //si le cookie existe et que le get de l'url est retour on continue
    if($_GET['chemin'] == "retour"){
        //on supprime le cookie
        setcookie('token',$tok, time()-3600*24, "/");
        header('Location: ../index.php?');
    }
    //si le cookie existe mais que il n'y a aucun get dans l'url on continue ici 
    else{
    // on test la méthode décode de la classe JWT 
    try {
    $decode = JWT::decode($token,$key,$algo);
    }
    //si il catch une erreur on supprime le cookie et redirige vers la page d'index
    catch(SignatureInvalidException $e){
        setcookie('token',$tok, time()-3600*24, "/");
        header('Location: ../index.php?erreur=1');
    }
    //sinon on stock les claims du token dans un tableau SESSION toutes les données
    $_SESSION['mail'] = $decode->user_email;
    $_SESSION['prenom'] = $decode->user_firstName;
    $_SESSION['status'] = $decode->user_status;
    header('location:../views/accueil.php?check=success');
    }
        
}
   




?>