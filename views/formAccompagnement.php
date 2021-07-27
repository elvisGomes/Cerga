<?php
     session_start();
     if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
       header ("Location: ../index.php");
     }
     ?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/atl.css" rel="stylesheet">
        <title></title>
        <link href="../assets/css/notif.css" rel="stylesheet">
</head>
<body>
        
        <br>
        <br>
            
             <div class="container-fluid">
            
             <form action="../controller/entretien.action.php?chemin=ajouterPeriodeAccompagnement" method="post" >
             <div class="col-md-6 offset-md-2">    
             <div class="form-group">
             <h1 class = "h1 mb-4">Créer une periode d'accompagnement :  </h1>
            
                
                <div class="form-group">
                <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Date d'ouverture:</span>
                        </div>
                    <input type="date" class="form-control" name="dateOuverture" id="dateOn" aria-describedby="emaiDate" min="1900-01-01" required>
                </div>
                <span id="entreeManquante"></span>
                </div>
                <div class="input-group input-group-sm mb-1">
                <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Date de fermeture:</span>
                        </div>
                    <input type="date" class="form-control" name="dateFermeture" id="dateOff" aria-describedby="emaiDate" min="1900-01-01" required>
              </div>
              <span id="sortieManquante"></span>
               </div>
               <div class="container">
                                <div class="col-4 clear">
                                    <label >TYPE D'ACCOMPAGNEMENT</label>
                                    <p><U> L'allocataire s'engage dans un/une : </U> </p>
                                    </div>
                                    <div class="col-8">
                                        <div>
                                            <span class="inline-choice">
                                                <input type="radio" name="accompagnement"   value="Accompagnement insertion">
                                                <label>Accompagnement insertion</label>
                                            </span>
                                                <br>
                                            <span class="inline-choice">
                                                <input type="radio" name="accompagnement"   value="Accompagnement collectif">
                                                <label>Accompagnement collectif</label>
                                            </span>
                                                <br>
                                                <span class="inline-choice">
                                                <input type="radio" name="accompagnement"    value="Accompagnement entrepreneurs et travailleurs indépendants">
                                                <label>Accompagnement entrepreneurs et travailleurs indépendants</label>
                                            </span>
                                            <br>
                                            <span class="inline-choice">
                                                <input type="radio" name="accompagnement"    value="Construction du projet professionnel">
                                                <label>Construction du projet professionnel</label>
                                            </span>
                                            <br>
                                            <span class="inline-choice">
                                                <input type="radio" name="accompagnement"   value="Remobilisation professionnel/ACI">
                                                <label>Remobilisation professionnel/ACI</label>
                                            </span>
                                            <br>
                                            <span class="inline-choice">
                                                <input type="radio" name="accompagnement"    value="Médiation direct vers l'emploi/Coaching">
                                                <label>Médiation direct vers l'emploi/Coaching</label>
                                            </span>

                                            <br/><br/>
                                        </div>
                                        
                                        
                            </div>
                            </div>
                    <button id="action" type="submit" style ="background: #43b29d;" class="btn btn-success">+ Créer une période d'accompagnement</button><br/><br/>
                    <a id="retourAccomp"> <button type="button"   class="btn btn-dark">retour</button><br/><br/></a>
                    
            </form>
           
             </div>
             <script>
                $('#retourAccomp').on('click',function(){
                    $.ajax('../controller/suivis.action.php?chemin=periodeAccompagnement', {

                        success: function(data) {
                            $('#content').load('../views/periodeAccompagnement.php', { infos: data });
                        },
                        error: function() {
                            alert("L'appel na pas abouti!");
                        }
                        });
                });
             </script>
             <script src="../assets/js/script2.js"></script>
             
</body>
</html>
