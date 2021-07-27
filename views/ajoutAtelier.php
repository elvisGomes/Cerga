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
     

       
             <div class="container-fluid">
             
             <form action="../controller/entretien.action.php?chemin=ajouterAtelier" method="POST">
             <div class="col-md-6 offset-md-2"> 
             <h1>Ajouter un nouvel l'atelier :</h1>     
             <div class="form-group">
            
                </div>
                <div class="form-group">
                <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Date d'enregistrement de l'atelier:</span>
                        </div>
                    <input name="date" type="date" class="form-control" id="exampleInputDate" aria-describedby="emaiDate" min="1900-01-01" max="<?php date_default_timezone_set ('Europe/Paris'); echo date('Y-m-d'); ?>" required>
                </div>
                </div>
                <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Date de participation a l'atelier:</span>
                        </div>
                    <input name = "dateParticipation" type="date" class="form-control" id="exampleInputDate" aria-describedby="emaiDate" min="1900-01-01" required>
                </div>
                <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Type d'atelier:</span>
                        </div>
                    <input name = "typeAtelier" type="text" class="form-control" required>
                </div>
               
               
                <div class="form-group">
                    <label for="Textarea1"><span class="input-group-text" id="inputGroup-sizing-sm">Description</span></label>
                    <textarea name = "description" class="form-control" id="exampleFormControlTextarea1" rows="12" maxlength="400"></textarea>


               <br/>
                <div class="row">
               <div class = "col-md-9 col-sm-12" >
               <button   type="submit" class="btn btn-success" style ="background: #43b29d;">+ Ajouter le nouvel atelier</button>
                
                
               </div><br/><br/>
               <div class = "col-md-3 col-sm-12" >
                 
              </div>
               

            </form>
            
             </div>
             <a id="retourAtelier" > <button  type="button" class="btn btn-dark" style =" ">< Retour à la liste des ateliers</button></a>
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
                })
             </script>
</body>
</html>
