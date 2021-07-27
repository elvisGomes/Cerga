<?php
     session_start();
     if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
       header ("Location: ../index.php");
     }
     ?>
<!DOCTYPE html>
<html lang="fr">
 
    <head>
        <meta charset="utf-8">
        <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
        <title>ajout de personne</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../assets/css/historiquePersonne.css" >
    

    </head>

    <body>
        <?php $info = json_decode($_POST['info'])?>
        <div class="container rapport-entretien"> 
            <div class ="row">
                <div class ="col col-md-10 col-entretien">
                    <h1 class="h1-entretien">Atelier : </h1>
                    <h3 class="h3-entretien mt-3" >> Détails </h2>
                    <p><strong>Personne:</strong></p>
                    <p><?php echo $_SESSION['name' . $_SESSION['cpt']] .' ' . $_SESSION['firstName' . $_SESSION['cpt']]; ?></p>
                    

                    <p><strong>Date d'enregistement de l'atelier:</strong></p>
                    <p><?php echo $info[0]->date;?></p>
                    <p><strong>Date participation à l'atelier :</strong></p>
                    <p><?php echo $info[0]->dateParticipation;?></p>
                    <p><strong>Derniere modification par:</strong></p>
                    <p><?php 
                    if(empty($info[0]->modifierPar)){
                        echo "Aucune modification n'a été apportée";
                    } 
                    else{
                        echo $info[0]->modifierPar;
                    }
                         ?></p>
                    <h3 class="h3-entretien">> Données de l'atelier </h2>
                    <p><strong>Notes:</strong> </p>
                    <p><?php echo $info[0]->description ?></p>
                    <a id="retourAtelier"> <button type="button"   class="btn btn-dark">< retour à la liste des ateliers</button><br/><br/></a>
                </div>
            </div>
                
            
        </div>
            
           <script> 
                $('#retourAtelier').on('click',function(){
                    $.ajax('../controller/suivis.action.php?chemin=listeAtelier', {

                                success: function(data) {
                                    
                                    $('#content').load('../views/listeAtelier.php', { infos: data });
                                    
                                },
                                error: function() {
                                    alert("L'appel na pas abouti!");
                                }
                                });
                    });

           </script>
    
    </body>

</html>