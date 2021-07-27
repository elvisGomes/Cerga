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
    <link href="../assets/css/notif.css" rel="stylesheet">
   
</head>
<body>
<?php
  $listAccompagnement = json_decode($_POST['infos']);
?>    
<div class = "container-fluid ">
    <div class ="row">
      <h1 class="h1" style="margin:0% 0% 0% 5%;">Contrat d'engagement</h1>
    </div>
    <div class=row > 
    <div class="col-md-8 col-10 col-sm-8">
    <table class="table table-striped  table-bordered text-center" style="margin:3% 0% 0% 7%;">
      <thead>
        <tr>
          
          <th scope="col" class="date barre-grouper" style="color: #e2793d; padding: 20px 0px 20px 0px;" >Date d'ouverture</th>
          <th scope="col"class="suivis barre-grouper" style="color: #43b29d; padding: 20px 0px 20px 0px;">Date de fermeture</th>
          <th scope="col"class="centre barre-grouper"style="color: #e2793d; padding: 20px 0px 20px 0px;">Notes</th>
          <th scope="col"class="suivis tableau-rapport barre-grouper icons-3-rapport" style="color: #43b29d; padding: 20px 0px 20px 0px;"><i class="material-icons icons-3">view_column</i></th>
        </tr>
      </thead>
      <tbody>
        <?php
            $i = 0;
            
            while($i < count($listAccompagnement))
            {
             
            
              $_SESSION['numeroAccompagnement'.$i] = $listAccompagnement[$i]->ID;
              if(!empty($listAccompagnement[$i]->dateOuverture)){
            ?>
            <tr>
              
              <td ><?php 
              if(!empty($listAccompagnement[$i]->dateOuverture)){
              $dt = DateTime::createFromFormat('Y-m-d', $listAccompagnement[$i]->dateOuverture );
              $dateOuverture = $dt->format('d/m/Y'); 
              echo $dateOuverture;
              }
              else{
                echo  "Non renseigné";
              }
              ?></td>
              <td><?php
              if(!empty($listAccompagnement[$i]->dateFermeture)){
              $dt = DateTime::createFromFormat('Y-m-d', $listAccompagnement[$i]->dateFermeture );
              $dateFermeture = $dt->format('d/m/Y'); 
              echo $dateFermeture;
              }
              else{
                echo "Non renseigné";
              }
               ?></td>
              <td ><?php echo $listAccompagnement[$i]->type_d_accompagnement ?></td>
              <td class = "text-center">
              <a title="Editer" class="modifierAccompagnement" href="#" data-cpt="<?php echo $i ?>" data-target="Accompagnement"><button class="bouton-editer" ><i class="material-icons material-icons-editer">create</button></i></a>
              
              
            </td>
            </tr>
            <?php  }$i++; }?>
        
      </tbody>
      
    </table>
   
  </div>
</div>
<div class="container-fluid text-center mt-2 " style ="margin-left:1%;">
    <div class="row">
        <div class="col">
        <a href="#" id ="formAccompagnement"><button type="button" class="btn btn-md btn-success" style ="background: #43b29d;">+ Ajouter une periode d'accompagnement</button></a>
        </div>  
    </div>
</div>

    
</body>
</html>