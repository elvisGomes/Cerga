
<?php
session_start();
if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
  header ("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>AFPA</title>
  <link href="../assets/css/notif.css" rel="stylesheet">
  
    <meta charset="utf-8">
    
    

</head>
<body>
  <?php $listAtelier = json_decode($_POST['infos'])?>
<script src="../assets/js/script.js"></script>
<div class = "container-fluid ">
    <div class ="row">
      <h1 class="h1" style="margin:0% 0% 0% 5%;">Liste des ateliers</h1>
    </div>
    <div class=row > 
    <div class="col-md-8 col-10 col-sm-8">
    <table class="table table-striped  table-bordered text-center" style="margin:3% 0% 0% 7%;">
      <thead>
        <tr>
        <th scope="col" class="date barre-ajouter barre-grouper" style="color: #e2793d; padding: 20px 0px 20px 0px;" >Ajouté par</th>
          <th scope="col" class="date barre-date barre-grouper" style="color: #e2793d; padding: 20px 0px 20px 0px;" >Date création</th>
          <th scope="col" class="date barre-date barre-grouper" style="color: #e2793d; padding: 20px 0px 20px 0px;" >Date participation </th>
          <th scope="col"class="suivis barre-atelier barre-grouper" style="color: #43b29d; padding: 20px 0px 20px 0px;" >Type d'atelier</th>
          <th scope="col"class="suivis tableau-rapport barre-grouper icons-3-rapport" style="color: #43b29d; padding: 20px 0px 20px 0px;"><i class="material-icons icons-3">view_column</i></th>
        </tr>
      </thead>
      <tbody>
      <?php
                                                $i=0;
                                                
                                                while($i < count($listAtelier)){
                                                  $_SESSION['numeroAtelier'.$i] = $listAtelier[$i]->numeroAtelier;
                                               
                                            ?>
                                            <tr>
                                            <td><?php echo $listAtelier[$i]->email;?> </td>
                                                <td><?php
                                                $dt = DateTime::createFromFormat('Y-m-d', $listAtelier[$i]->date );
                                                $date = $dt->format('d/m/Y');
                                                echo $date;
                                                 ?> </td><!--inserer un code php ici-->
                                                <td><?php
                                                $dt = DateTime::createFromFormat('Y-m-d', $listAtelier[$i]->dateParticipation );
                                                $dateParticipation = $dt->format('d/m/Y');
                                                echo $dateParticipation;
                                                 ?> </td><!--inserer un code php ici-->
                                                <td> <?php echo $listAtelier[$i]->typeAtelier;?> </td><!--inserer un code php ici-->
                                                
                                                <td>
                                                <a title="Voir" class ="voir" data-cpt = "<?php echo $i?>" data-target="voirAtelier" data-fichier ="Atelier"><button  class="bouton-voir" ><i class="material-icons material-icons-voir">remove_red_eye</button></i></a>
                                                <a  title="Editer" class ="editer" data-cpt = "<?php echo $i?>" data-target="Atelier"><button  class="bouton-editer" ><i class="material-icons material-icons-editer">create</button></i></a>
                                                <a  title="Effacer" href="../controller/suivis.action.php?chemin=suppAtelier&cpt=<?php echo $i;?>"> <button class="bouton-effacer"  ><i class="material-icons material-icons-effacer">delete_forever</button></i></a>
                                                </td>
                                            </tr>
              <?php  $i++; }?>
        
      </tbody>
    </table>
    </div>
    <div class = "col-md-4">
     
    </div>
  </div>
</div>
<div class="container-fluid text-center mt-2 " style ="margin-left:16%;">
    <div class="row">
        <div class="col">
        <a href="#" id ="ajoutAtelier"><button type="button" class="btn btn-md btn-success" style ="background: #43b29d;">+ Ajouter un atelier</button></a>
        </div>  
    </div>
</div>
<script>
    $('.bouton-effacer').on('click',function(e){
      if(confirm("Etes vous sûr de vouloir supprimer cet atelier?") == false){
        e.preventDefault();
      }
    })
    </script>
</body>
</html>