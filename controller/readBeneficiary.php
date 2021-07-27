<?php
require_once("../entity/dbcontroller.php");
include_once '../entity/Beneficiary.class.php';
//verification d'entrée
if(!empty($_POST["keyword"])) {
    //stockage des donées POST dans une variable info
    $info = $_POST["keyword"];
    //instanciation de l'objet beneficiary par la classe Beneficiary
    $beneficiary= new Beneficiary('','','','','','');
    //stockage des donnée renvoyer par la méthode rechercheSimilaire dans un tableau result
    $result = $beneficiary->rechercheSimilaire($info);
    //si le tableau n'est pas vide on fais le traitement suivant
    if(!empty($result)) {
        //création d'une suggestion par la boucle forEach 
    ?>
    <ul id="country-list">
    <?php
    foreach($result as $allo) {
    $fullname = $allo['name']." ".$allo['firstName'];
    ?>
    <li title="<?php echo $allo['allocataireNumber'] ?>" for="alloc"><a style="color:green" href="home.php?data=<?php echo $allo['allocataireNumber'];?>&prenom=<?php echo $allo['firstName'] ?>&nom=<?php echo $allo['name'] ?>" > <?php echo $fullname; ?> </a> </li>
    <?php } ?>
    </ul>
    <?php } } ?>