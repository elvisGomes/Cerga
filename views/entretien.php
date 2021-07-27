<?php
session_start();
if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/atl.css" rel="stylesheet">
    <title></title>
   
</head>

<body>



    <div class="container-fluid">

        <form action="../controller/entretien.action.php?chemin=ajouterRapport" method="POST">
            <div class="col-md-6 offset-md-2">
                <h1>Ajouter un rapport :</h1>
                <div class="form-group">

                </div>
                <div class="form-group">
                    <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Date :</span>
                        </div>
                        <input name="date" type="date" class="form-control" id="exampleInputDate" aria-describedby="emaiDate" min="1900-01-01" max="<?php date_default_timezone_set('Europe/Paris');
                                                                                                                                                                    echo date('Y-m-d'); ?>" required >





                    </div>
                </div>
                <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Type d'entretien :</span>
                    </div>
                    <select class="form-control" name="typeReport" required="required">
                        <option value="">Choisir le type d'entretien :</option>
                        <option value="Entretien par mail">Entretien par email</option>
                        <option value="Entretien télephonique">Entretien Telephonique</option>
                        <option value="Entretien physique">Entretien physique</option>
                    </select>

                </div>

                <div>
                
                <div class="form-group">
                    <label for="Textarea1"><span class="input-group-text" id="inputGroup-sizing-sm">Description</span></label>
                     <textarea required="required" name = "description"class="form-control" id="exampleFormControlTextarea1" rows="5" maxlength="350"></textarea> 
                     
                    <br>
                </div><div class="row">
                <button type="submit" class="btn btn-success" style ="background: #43b29d;">Envoyer</button>
              <div class = "col-md-10 col-xs-12" >
                 
              </div>
              <button  id="retourListe" class="btn btn-dark mt-2" style =" "><a href="#" style="color : white;">< Retour à la liste des rapports</button>
                                    <?php
                                        if(isset($_GET['error'])){
                                            $err = $_GET['error'];
                                            if($err=='1'){
                                                echo "<p style='color:red'>Tout les champs ne sont pas remplis!</p>";
                                                unset($_GET['error']);
                                            }
                                        }
                                        
                      
                      
                                        elseif(isset($_GET['success'])){
                                          $success = $_GET['success'];
                                          if($success==1){
                                              echo "<p style='color:green'>Le rapport a bien été envoyer !</p>";
                                          }
                                      }
                                      
                                    ?>
              </div>
            </form>
             </div>
            <script>
                $('#retourListe').on('click',function(){
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
