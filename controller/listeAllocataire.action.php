<?php include_once '../entity/Beneficiary.class.php';
session_start();
//instanciation de l'objet allocataire par la classe Beneficiary
$allocataire = new Beneficiary("","","","","");
//applicatin de la methode detail qui ressort tout les allocataire dans la base de donnée et stockage des données dans un tableau arr
$arr = $allocataire->detail();
$i = 0;
//Boucle qui va permettre de stocker tout les allocataire similaire dans des tableau Session
foreach($arr as $row){
    $_SESSION['birthDate' . $i] = $row['birthDate'];
    $_SESSION['name' . $i] = $row['name'];
    $_SESSION['firstName' . $i] = $row['firstName'];
    $_SESSION['allocNum' . $i] = $row['allocataireNumber'];
    $_SESSION['gender' . $i] = $row['gender'];
    $i++;
}

header("location: ../views/listeAllocataire.php?count=$i");
?>