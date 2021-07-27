<link href="../assets/fonts/fontawesome/css/font_material.css"rel="stylesheet">
  <?php 
 /**
  * @author Clément Broucke, Mehdi Nasri
  */
  //on décode le json reçu
  $info = json_decode($_POST['info']);
  //on instancie 4 tableau ,  et 2 variable
  $arrRdv = array();
  $arrCer = array();
  $arrRdvId = array();
  $arrCerId = array();
  $j=0;
  $k=0;
  //on crée 4 tableau 2 pour les rendez-vous 2 pour les fins de cer il y a pour chaque 1 tableau contenant les id 1 contenant les descriptions
 for($i=0;$i<sizeof($info);$i++){
   if(stripos($info[$i]->event,'cer')){
     $arrCer[$j] = $info[$i]->event;
     $arrCerId[$j] = $info[$i]->ID_event;
     $j++;
   }
   else{
     $arrRdv[$k] = $info[$i]->event;
     $arrRdvId[$k] = $info[$i]->ID_event;
     $k++;
   }
 }
 ?>
 <div id="headerNotif">
  <h5 class ="h5"id="titleNotif">Rappels </h5>
  <h5 style="color:red; margin-left:250px; cursor:pointer;"id="quitter">x<h5>
</div>
<h5 class="text-center alert-info" style="">Evenements du jour </h5>

    <?php 
    //On vérifie si le tableau arrRdv n'est pas vide, si ce n'est pas le cas on fait une boucle pour afficher les données du tableau et pour donner un ID a la div
    if(!empty($arrRdv)){
      $i = sizeof($arrRdv) -1 ;
      while ($i >= 0) {
      ?>
    <div class="notification " style="display:flex;justify-content:space-between;">
     
      <p class=""><?php echo $arrRdv[$i] ?></p>
      <button title="Supprimer la notification" class="delete  bouton-effacer" style="" data-id="<?php echo $arrRdvId[$i]?>"><i class="material-icons material-icons-effacer">delete_forever</button></i>
    </div>
      <?php $i--;} 
    }
    else {?>

  

        <h6 class="h5 text-center" style="padding:10px 0px 10px 0px;">Aucun évenements aujourd'hui</h6>
    <?php }?>
   
  <h5 class="text-center alert-success" >Rappel des fins de CER </h5>

  <?php 
  //si le tableau de cer n'est pas vide
    if(!empty($arrCer)){

      for($i=0;$i<sizeof($arrCer);$i++){
        $arrDecode[$i] = $arrCer[$i];
       //on explode arrCer par rapport a une virgule
        $explode = explode(',',$arrDecode[$i]);
        //création de 2 variable qui contienne chacune une partie de CER
          $text = $explode[0];
          $text2 = $explode[1];
          //on recherche le nom en coupant la partie 1 inclus dans la variable res
          $res = substr($text,35);
          //on explode la partie res avec le point
          $resExplode2= explode('.',$res);
          //on inclut chaque partie dans une variable
          $nom = $resExplode2[0];
          $prenom = $resExplode2[1];
          //on recupere uniquement le nom ,le prenom et le numero d'allocataire
          $subNom = substr($nom,0,-9);
          $subPrenom = substr($prenom,8);
          $res2 = substr($text2, 36, 7);
          
        
      ?>
    <div class="notification" style="position:relative;">
      
      <p class=""><?php echo $arrDecode[$i]?></p>
      
          <a class="bouton-profil" title="Voir le profil" style="position:absolute; top:33px;right:50px;" href="home.php?data=<?php echo $res2?>&prenom=<?php echo $subPrenom ?>&nom=<?php echo $subNom ?>" ><i class="material-icons material-icons-profil">person</a></i>
          <button title="Supprimer la notification" style="position:absolute; bottom:0px;right:0px;"class="delete bouton-effacer" style="color:red;" data-id="<?php echo $arrCerId[$i]?>"><i class="material-icons material-icons-effacer">delete_forever</button></i>
      
      
    </div>
    <?php } 
    }
    else {?>
  
        <h6 class="h5 text-center" style="padding:10px 0px 10px 0px;">Aucune actualité à afficher</h6>
    <?php 

      }?>
 
   
    
  
  <script>
    $("#quitter").on('click',function(){
    $('#notifications').hide();
   
});
$('.delete').on('click',function(){
  var ID = $(this).data('id');
  console.log(ID);
  if(confirm("Voulez vous supprimer la notification ? ")){
    
    $(this).parent().hide();
    $.ajax('../controller/notif.action.php?chemin=supprimer&id='+ID, {
      success: function(){
      
        },
      }
    );

}
    })
  </script>