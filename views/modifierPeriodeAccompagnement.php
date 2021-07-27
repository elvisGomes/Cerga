<?php
     session_start();
     if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
       header ("Location: ../index.php");
     }
     ?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/atl.css" rel="stylesheet">
        <title></title>
       
        <link href="../assets/css/notif.css" rel="stylesheet">
</head>
<body>
            
             <div class="container-fluid">
           
             <form action="../controller/entretien.action.php?chemin=modifierPeriodeAccompagnement&cpt=<?php echo $_GET['cpt']; ?>"  method="POST">
             <div class="col-md-6 offset-md-2">    
             <div class="form-group">
             <h1 class = "h1 mb-4">Modifier la periode d'accompagnement :  </h1>
            
                
                <div class="form-group">
                <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Date d'ouverture:</span>
                        </div>
                    <input type="date" class="form-control" id="exampleInputDate" name="dateOuverture" aria-describedby="emaiDate" min="1900-01-01" max="2049-12-12">
                </div>
                </div>
                <div class="input-group input-group-sm mb-1">
                <div class="input-group-prepend">
                            <span class="input-group-text" name="dateFermeture" id="inputGroup-sizing-sm">Date de fermeture:</span>
                        </div>
                    <input type="date" class="form-control" id="exampleInputDate" name="dateFermeture" aria-describedby="emaiDate" min="1900-01-01" max="2049-12-12">
              </div>
               </div>
                    
              
                <div class="input-group input-group-sm mb-1">
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
                
                <div class="row">
        <div class=" col-xs-10  col-sm-10  col-md-10 col-lg-5" style="margin-left:30%";> 
        <button  type="submit" class="btn btn-success" style ="background: #43b29d;">Enregistrer les modifications</button><br>
        <a id="retourAccomp"> <button type="button"   class="btn btn-dark mt-2">< retour</button><br/><br/></a>
        </div> 
  </div> 
  <div>
                    
            </form>
            
             </div>
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
</body>
</html>