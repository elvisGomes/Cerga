<?php
     session_start();
     if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
       header ("Location: ../index.php");
     }
     ?>
    <link href="../assets/css/notif.css" rel="stylesheet">
<div class="container-fluid">
             
             <form action="../controller/entretien.action.php?chemin=ajouterSituation" method="POST">
             <div class="col-md-6 offset-md-2">  
             <h1>Ajouter une nouvelle situation :</h1>  
             <div class="form-group">
            
                </div>
                <div class="form-group">
                <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Date de debut:</span>
                        </div>
                    <input required name="date" type="date" min="2010-09-01" max="" class="form-control" id="exampleInputDate" aria-describedby="emaiDate" placeholder="Date" min="1900-01-01" max="<?php date_default_timezone_set ('Europe/Paris'); echo date('Y-m-d'); ?>">
                </div>
                </div>
                <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Date de fin:</span>
                        </div>
                    <input  name = "dateFin" type="date" min="2010-09-01" max="" class="form-control" id="exampleInputDate" aria-describedby="emaiDate" placeholder="Date" min="1900-01-01">
                </div>
             
                     
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir une situation:</label>
                            <select required name = "situation" class="form-control" id="exampleFormControlSelect1">
                            <option value =''>Choisir une situation</option>
                            <option value="CDI et fonction publique">CDI et fonction publique</option>
                            <option value="CDD et intérims et saison">CDD et intérims et saison</option>
                            <option value="CIE en CDI">CIE en CDI</option>
                            <option value="Création ou reprise d'entreprise">Création ou reprise d'entreprise</option>
                            <option value="CIE en CDD">CIE en CDD</option>
                            <option value="Contrats aidés en CDD">Contrats aidés en CDD</option>
                            <option value="Formation qualifiante">Formation qualifiante</option>
                            <option value="Autre action insertion professionnelle">Autre action insertion professionnelle</option>
                            <option value="Droit retraite">Droit retraite</option>
                            <option value="autre SIAE">autre SIAE</option>
                            <option value="Déménagement">Déménagement</option>
                            <option value="Autre droit que RSA">Autre droit que RSA</option>
                            <option value="Problème santé">Problème santé</option>
                            <option value="Grossesse">Grossesse</option>
                            <option value="Autre sortie légitime">Autre sortie légitime</option>
                            <option value="Fin d'action">Fin d'action</option>
                            <option value="Pôle emploi">Pôle emploi</option>
                            <option value="Autre action d'insertion sociale">Autre action d'insertion sociale</option>
                            <option value="Abandon">Abandon</option>
                            
                            </select>
                      </div>
              
               
               
                <div class="form-group">
                    <label for="Textarea1"><span class="input-group-text" id="inputGroup-sizing-sm">Commentaire</span></label>
                    <textarea name = "description" class="form-control" id="exampleFormControlTextarea1" rows="12" maxlength="400"></textarea>


               <br/>
                <div class="row">
               <div class = "col-md-9 col-sm-12" >
               <a id="retourSituation"> <button type="button"   class="btn btn-dark">< retour à la liste des situations</button></a>
                
               </div><br/><br/>
               <div class = "col-md-3 col-sm-12" >
                   <button  type="submit" class="btn btn-success" style ="background: #43b29d;">Ajouter la situation</button>
              </div>
               

            </form>
             </div>
             <script>
                $('#retourSituation').on('click',function(){
                    $.ajax('../controller/suivis.action.php?chemin=listSituation', {

                    success: function(data) {
                        
                        $('#content').load('../views/bilan.php', { infos: data });
          
                    },
                    error: function() {
                        alert("L'appel na pas abouti!");
                    }
                    });
                });
            </script>