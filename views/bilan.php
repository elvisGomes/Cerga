<?php session_start();
$info = json_decode($_POST['infos']); 

     if (!(isset($_SESSION['mail']) && $_SESSION['mail'] != '') && !(isset($_SESSION['password']) && $_SESSION['password'] != '')) {
       header ("Location: ../index.php");
     }
     ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>AFPA</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../assets/js/script.js"></script>
    <link href="../assets/css/notif.css" rel="stylesheet">
    
    

</head>
<body>
<div class = "container-fluid ">
<div class ="row">
      <h3 class="h3" style="margin:0% 0% 0% 5%;">Période d'accompagnement du : 20 septembre 2019 au 20 decembre 2019
      </h3>
    </div>
    <div class=row > 
    <div class="col-md-11 col-10 col-sm-8">
    
    <table class="table table-striped  table-bordered text-center " style="margin:3% 0% 0% 4%;">
      <thead>
      <tr >
         
         <th scope="col" class="situation tableau-situation tableau-actuelle" colspan="5" style=" padding: 10px 0px 10px 0px;" >SITUATION ACTUELLE : </th>
         
       </tr>
        <tr>
         
          <th scope="col" class="date tableau-rapport" style="color: #e2793d; padding: 10px 0px 10px 0px;" >Date</th>
          <th scope="col"class="suivis tableau-rapport" style="color: #43b29d; padding: 10px 0px 10px 0px;">Date de fin</th>
          <th scope="col" class="date tableau-rapport" style="color: #e2793d; padding: 10px 0px 10px 0px;" >Situation professionnelle / personnelle</th>
     
          <th scope="col"class="suivis tableau-rapport icons-3-rapport" style="color: #43b29d; padding: 10px 0px 10px 0px;"><i class="material-icons icons-3">view_column</i></th>
      
        </tr>
      </thead>
      <tbody>
      
          
        
                                          <?php if(!empty($info)){
                                            $j = 0;
                                            $_SESSION['numeroSituation' . $j] = $info[0]->id_situation; 
                                            ?> 
                                            
                                            <tr>
                                            <td><?php
                                                $dt = DateTime::createFromFormat('Y-m-d', $info[0]->date_debut );
                                                $dateDebut = $dt->format('d/m/Y');
                                                echo $dateDebut;
                                                 ?></td>
                                                <td><?php
                                                if(empty($info[0]->date_fin)){
                                                  $dateFin = "";
                                                } 
                                                else {
                                                  $dt2 = DateTime::createFromFormat('Y-m-d', $info[0]->date_fin );
                                                  $dateFin = $dt2->format('d/m/Y');
                                                }
                                                echo $dateFin;
                                                ?></td>
                                                <td>
                                                <?php echo $info[0]->situation;?>
                                                </td>
                                               
                                                
                                                <td> <a title="Voir" class ="voir" data-cpt = "<?php echo $j?>" data-target="voirSituation" data-fichier="Situation"><button class="bouton-voir" style =""><i class="material-icons material-icons-voir">remove_red_eye</button></i></a>
                                                <a class ="editer" data-cpt = "0" data-target="Bilan"><button class="bouton-editer" ><i class="material-icons material-icons-editer">create</button></i></a></td>
                                            </tr>
           
                                          <?php }?>
       
      
      </tbody>
    </table>
    </div>
   
  </div>
</div>

    <div class="row">
        <div class="col">
        <a href="#" class="addSituation"><button type="button" class="btn btn-md btn-success mt-3" style =" background: #43b29d; margin-left:80%;">+ Ajouter une situation</button></a>
        </div>  
    </div>
    
    <div class=row > 
    <div class="col-md-9 col-10 col-sm-8">
    
    <table class="table table-striped  table-bordered text-center" style="margin:3% 0% 0% 7%;">
      <thead>
      <tr >
         
         <th scope="col" class="situation tableau-situation tableau-precedent" colspan="5" style=" padding: 10px 0px 10px 0px; " >SITUATION PRECEDENTES : </th>
         
       </tr>
        <tr>
         
          <th scope="col" class="date tableau-rapport" style="color: #e2793d; padding: 10px 0px 10px 0px;" >Date</th>
          <th scope="col"class="suivis tableau-rapport" style="color: #43b29d; padding: 10px 0px 10px 0px;">Date de fin</th>
          <th scope="col" class="date tableau-rapport" style="color: #e2793d; padding: 10px 0px 10px 0px;" >Situation professionnelle / personnelle</th>

          <th scope="col"class="suivis tableau-rapport icons-3-rapport" style="color: #43b29d; padding: 10px 0px 10px 0px;"><i class="material-icons icons-3">view_column</i></th>
      
        </tr>
      </thead>
      <tbody>
      
          
        <?php 
          $i = 1;
          while($i < count($info)){
            $_SESSION['numeroSituation'.$i] = $info[$i]->id_situation;
          
        ?>
                                             
                                             <tr>
                                                <td><?php
                                                $dt = DateTime::createFromFormat('Y-m-d', $info[$i]->date_debut );
                                                $dateDebut = $dt->format('d/m/Y');
                                                echo $dateDebut;
                                                 ?></td>
                                                <td><?php
                                                if(empty($info[$i]->date_fin)){
                                                  $dateFin = "";
                                                } 
                                                else {
                                                  $dt2 = DateTime::createFromFormat('Y-m-d', $info[$i]->date_fin );
                                                  $dateFin = $dt2->format('d/m/Y');
                                                }
                                                  echo $dateFin;
                                                ?></td>
                                                
                                                <td>
                                                <?php echo $info[$i]->situation;?>
                                                </td>
                                               
                                                <td> <a title="Voir" class ="voir" data-cpt = "<?php echo $i?>" data-target="voirSituation" data-fichier="Situation"><button class="bouton-voir" style =""><i class="material-icons material-icons-voir">remove_red_eye</button></i></a>
                                                <a title="Editer" class ="editer" data-cpt = "<?php echo $i?>" data-target="Bilan"><button class="bouton-editer" style =""><i class="material-icons material-icons-editer">create</button></i></a></td>
                                            </tr>
           
           
          <?php $i++;}?>
       
      
      </tbody>
    </table>
    
   
  </div>
</div>

</div>
</body>
<script>
$(".addSituation").click(function() { 
    $('#content').load('../views/ajoutSituation.php');
});
$(".editer").on('click',function(){

})
</script>
</html>
