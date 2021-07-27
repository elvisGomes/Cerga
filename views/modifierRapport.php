<?php
     session_start();
     if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
       header ("Location: ../index.php");
     }
     $tabRapport = json_decode($_POST['info']);
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
       
       
        <br>
        <br>
        
             <div class="container-fluid">
             
             <form action="../controller/entretien.action.php?chemin=editer&cpt=<?php echo $_GET['cpt']; ?>"  method="POST">
             <div class="col-md-6 offset-md-2">   
             <h1>Modifier le rapport:</h1> 
             <div class="form-group">
             
                </div>
                <div class="form-group">
                <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Date de la modification:</span>
                        </div>
                    <input type="date" name = "date" class="form-control" id="exampleInputDate" aria-describedby="emaiDate" min="1900-01-01" value="<?php echo $tabRapport[0]->date; ?>">
                </div>
                </div>
                <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Type d'entretien :</span>
                        </div>
                <select class="form-control" name="typeReport">
                    <option value="<?php echo $tabRapport[0]->typeRapport ?>"><?php echo $tabRapport[0]->typeRapport ?></option>
                    <?php if(stripos($tabRapport[0]->typeRapport, "email") == false){ ?>
                    <option value="Entretien par email">Entretien par email</option>
                    <?php } if(stripos($tabRapport[0]->typeRapport, "telephonique") == false){ ?>
                    <option value="Entretien telephonique">Entretien telephonique</option>
                    <?php } if(stripos($tabRapport[0]->typeRapport, "physique") == false){ ?>
                    <option value="Entretien physique">Entretien physique</option>
                    <?php } ?>
                </select>
                </div>
                
                
                <div>
                <div class="input-group input-group-sm mb-1">
                </div>
                <div class="form-group">
                    <label for="Textarea1"><span class="input-group-text" id="inputGroup-sizing-sm">Description</span></label>
                    <textarea name = "description" class="form-control" id="exampleFormControlTextarea1" rows="5" maxlength="350"><?php echo $tabRapport[0]->description; ?></textarea>
                </div>
                     <button type="submit" class="btn btn-success" style ="background: #43b29d;">Enregistrer les modifications</button><br>
                     <a id="retourRapport"> <button type="button"   class="btn btn-dark mt-2">< retour à la liste des rapports</button><br/><br/></a>
                     <div>
                        
                    </div>
            </form>

             </div>
             <script>
                $('#retourRapport').on('click',function(){
                    $.ajax('../controller/suivis.action.php?chemin=suivis', {

                            success: function(data) {
                            
                                $('#content').load('../views/suivis.php', { infos: data });
                               
                            },
                            error: function() {
                                alert("L'appel na pas abouti!");
                            }
                            });
                });
             </script>
</body>
</html>
