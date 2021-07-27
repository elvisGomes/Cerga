<?php
//@author Clément Broucke / Mehdi Nasri
session_start();
//tableau qui contient les types de fichier accepté (pdf et docx)
$typeContent = array(
    'application/pdf', 
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
);
//si un ID est envoyé en get
if(isset($_GET['id'])){
    //et que cet id est supprimerPdf
    if($_GET['id'] == "supprimerPdf"){
        //suppression du cv correspondant a la session allocataire 
    unlink("CV/CV".".".$_SESSION['allocNum'].".pdf");
    //et redirection vers la page document
    header('location: ../views/home.php?success=suppDoc');
    }
    //meme traitement pour le format docx
    elseif($_GET['id'] == "supprimerDocx"){
        unlink("CV/CV".".".$_SESSION['allocNum'].".docx");
        header('location: ../views/home.php?success=suppDoc');
        }
}
//sinon
else{
    //sijoinCV est set et non vide
        if(isset($_FILES['joinCV']) && !empty($_FILES['joinCV']))
        {
            //on instancie file au numero d'allocataire de la session
            $filename = $_SESSION['allocNumber'];
            //on explode le nom du fichier au niveau du point
            $name = explode(".",$_FILES['joinCV']['name']);
            //instanciation de i au nombre de name explode 
            $i= count($name) -1;
            $named=$name[$i];
            //instanciation de dossier qui est le nom du répértoire CV
            $dossier = 'CV/';
            //changement du nom du fichier a CV
            $fichier = basename("CV.".$filename.".".$named);
            // taille maximum (en octets)
            $taille_maxi = 4000000;
            //Taille du fichier
            $taille = filesize($_FILES['joinCV']['tmp_name']);
            //Ensuite on teste
            //Début des vérifications de sécurité...
            //verification de la taille du fichier
            if($taille>$taille_maxi)
            {
                echo "<script type='text/javascript'>document.location.replace('../views/home.php?fichier=error')
                    alert('Le fichier est trop lourd!');
                        </script>";
                        $erreur='taille';
            }
            //verification du mime type du fichier
            if(!in_array(mime_content_type($_FILES['joinCV']['tmp_name']), $typeContent)){
            
                        $erreur='format';
                        header('location: ../views/home.php?fichier=error');
            }
            if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
                //On formate le nom du fichier ici...
                $fichier = strtr($fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                //On remplace les lettres accentutées par les non accentuées dans $fichier.
                //Et on récupère le résultat dans fichier
                //En dessous, il y a l'expression régulière qui remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre
                //dans $fichier par un tiret "-" et qui place le résultat dans $fichier.

                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

                if(move_uploaded_file($_FILES['joinCV']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    header('location: ../views/home.php?fichier=success');
                }
                else //Sinon (la fonction renvoie FALSE).
                {
                    header('location: ../views/home.php?fichier=error');
                }
            }
            else
            {
    
                header('location: ../views/home.php?fichier=error');
            }
        }
}
?>