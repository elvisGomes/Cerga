<?php
     session_start();
     if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
       header ("Location: ../index.php");
     }
     ?>
<!DOCTYPE html>
<html lang="fr"> 

<head>
    <title>CerGa</title>
    <meta charset="utf-8">
 
    <script src="../assets/js/script.js"></script> 

      

</head>
<body >
  <?php 
    $listRapport = json_decode($_POST['infos']); 
  
  ?>
<div class = "container-fluid ">
    <div class ="row">
      <h1 class="h1" style="margin:0% 0% 0% 5%;">Liste des rapports</h1>
    </div>
    <div class=row > 
    <div class="col-md-8 col-10 col-sm-8">
    <table class="table table-striped text-center " style="margin:3% 0% 0% 7%;">
      <thead>
        <tr class="tableau-rapport">
          <th scope="col" class="date tableau-rapport rapport-ajout" style="color: #e2793d; padding: 20px 0px 20px 0px;" >Ajouté par</th>
          
          <th scope="col" class="date tableau-rapport rapport-date" style="color: #e2793d; padding: 20px 0px 20px 0px;" >Date</th>
          <th scope="col"class="suivis tableau-rapport type-rapport" style="color: #43b29d; padding: 20px 0px 20px 0px;">Type de rapport</th>
          <th scope="col"class="suivis tableau-rapport icons-3-rapport" style="color: #43b29d; padding: 20px 0px 20px 0px;"><i class="material-icons icons-3">view_column</i></th>
      
        </tr>
      </thead>
      <tbody>
      
          
            <?php
                                                $i=0;
                                                
                                                while($i < count($listRapport)){
                                                  $_SESSION['numeroRapport'.$i] = $listRapport[$i]->numeroRapport;
                                               
                                            ?>
                                            <tr>
                                            <td> <?php echo $listRapport[$i]->email;?> </td>
                                            
                                                <td><?php 
                                                $dt = DateTime::createFromFormat('Y-m-d', $listRapport[$i]->date);
                                                $date = $dt->format('d/m/Y'); 
                                                echo $date;
                                                ?> </td>
                                                <td> <?php echo $listRapport[$i]->typeRapport;?> </td>
                                                
                                                <td class="">
                                                <a title="Voir" class ="voir" data-cpt = "<?php echo $i?>" data-target="voir" data-fichier="Rapport"><button class="bouton-voir" style =""><i class="material-icons material-icons-voir">remove_red_eye</button></i></a>
                                                <a title="Editer" class ="editer" data-cpt = "<?php echo $i?>" data-target="Rapport"><button class="bouton-editer" style =""><i class="material-icons material-icons-editer">create</button></i></a>
                                                <a title="Effacer" href="../controller/suivis.action.php?chemin=supp&cpt=<?php echo $i;?>"> <button  class="bouton-effacer rapport" style ="" ><i class="material-icons material-icons-effacer">delete_forever</button></i></a>
                                                </td>
                                            </tr>
              <?php  $i++; }?>
          
       
      
      </tbody>
    </table>
    </div>
   
  </div>
</div>
<div class="container-fluid text-center mt-2 " style ="margin-left:16%;">
    <div class="row">
        <div class="col">
        <a href="#" id ="ajoutRapport"><button type="button" class="btn btn-md btn-success" style ="background: #43b29d;">+ Ajouter un rapport</button></a>
        </div>  
    </div>
</div>
    <script>
    $('.rapport').on('click',function(e){
      if(confirm("Etes vous sûr de vouloir supprimer ce rapport?") == false){
        e.preventDefault();
      }
    })
    </script>
</body>
</html>