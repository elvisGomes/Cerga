 <?php
 session_start();
       ?>
<!DOCTYPE html>
<html lang="fr">
<head>
        
        <link href="../assets/css/notif.css" rel="stylesheet">
        
        <title></title>
        
</head>
<body>
        <div class="container-fuild">
  
            <div class="container">
                <div class="text-center">
                   <a class="btn btn-success" title="Télécharger" href="../controller/PDF/181220_CER Version 2019.pdf" target="_blank">Afficher le CER</a><br>
                </div>
                <?php if(file_exists("../controller/CV/CV".".".$_SESSION['allocNumber'].".pdf")){ ?>
                <div class="text-center">
                    <a class="btn btn-success mt-3" title="Afficher document" href="../controller/CV/CV.<?php echo $_SESSION['allocNumber']?>.pdf" target="_blank">Consulter le CV</a>
                    <a class="btn btn-danger mt-3" id="suppCV" href="../controller/document.action.php?id=supprimerPdf">Supprimer le CV</a>
                    <?php }
                        elseif(file_exists("../controller/CV/CV".".".$_SESSION['allocNumber'].".docx")){ ?>
                            <div class="text-center">
                    <a class="btn btn-success mt-3" title="Afficher document" href="../controller/CV/CV.<?php echo $_SESSION['allocNumber']?>.docx" >Consulter le CV</a>
                    <a class="btn btn-danger mt-3" id="suppCV" href="../controller/document.action.php?id=supprimerDocx">Supprimer le CV</a>
                        
                       <?php }else{?>
                    <form method="POST" action="../controller/document.action.php" enctype="multipart/form-data" style="margin-left: 15%">
                        
                        <!-- On limite le fichier à 100Ko -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                        <label for ="divTarget" class="mt-3"><strong>Mettre le CV :</strong></label>
                        <input class="choisir-un-fichier" type="file" name="joinCV" id='divTarget' required>
                        <br>
                        <button class="envoyer-un-fichier" type="submit" name="envoyer" id="envoiCV">Envoyer le CV</button>
                    </form>
                </div>
                <?php }?>
               <script> 
                $('#suppCV').on('click',function(e){
                        if(confirm("Etes vous sûr de vouloir supprimer ce CV?") == false){
                            e.preventDefault();
                        }
                })

              
                </script>
                <script 
                
                src="../assets/js/document.js"> </script>
                
                   
               
            </div>
        </div>
</body>
</html>