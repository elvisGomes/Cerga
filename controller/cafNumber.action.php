<?php
//@author: Clément Broucke 
include '../entity/Beneficiary.class.php';

//instanciation d'allocataire
$alloc = new Beneficiary('', '', '', '', '');
//verification de l'existence du numero d'allocataire envoyé en GET dans la BDD
if(ctype_digit($_GET['cafNumber'])) {
    if($alloc->checkCafNumber($_GET['cafNumber']) == false ){
        //Si il existe on renvoit error
        $data = "error";
    }
    else{
        //sinon on renvoit success
        $data = "success";
    }
}
else if(!ctype_digit($_GET['cafNumber'])){
    //sinon on renvoit success
    $data = "errorLettre";
}

//echo du resultat
echo $data;

?>