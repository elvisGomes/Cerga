<?php
include_once '../entity/singleton.class.php';
include_once '../entity/User.class.php';

$email = 'amin@gmail.com';
$password = 'CeRgAd2Wm';
//crypte le password 
$cryptedPassword = sha1($password);
//instanciation de l'objet superAdmin par la classe User
$superAdmin = new User ($email, "");
//application de la méthode changePwdAdmin qui reset le password du super ADMIN
$superAdmin->changePwdAdmin($cryptedPassword);
?>