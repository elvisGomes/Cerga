<!DOCTYPE html>
<html lang="fr">
<head>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="../assets/images/afpaOnglet.png" />
        <link href="../assets/css/notif.css" rel="stylesheet">
        <script src="../assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
        
      
        <title>AFPA</title>
        <script>
  
  </script>

</head>
<body >
    
      <?php 
      include("nav.php");
      if(isset($_SESSION['cpt'])){
        unset($_SESSION['cpt']);
        }
      ?>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>


<?php


      include "notification.php" ;  


?>
<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../controller/readBeneficiary.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
<div id ="notifications">
  
</div>

     
      <div class="search" style="text-align : align-items: center !important;text-align: center !important;">
        <form action="../controller/recherchePersonne.action.php" method="POST">
            <input class="recherche-allocataire" type="search" name='info' id="search-box" placeholder="Recherche des allocataires, ..." style="width: 60%;">
          
            <center>
            <br>
            <a class="nav-link" ><button type="submit" class="btn bouton-recherche" style ="background: #e2793d; color: #FFF;"><i class="fa fa-search"></i> Rechercher</button>
                <br>
                <a class="" href="ajoutPersonne.php"><button type="button" class="btn btn-md btn-success mt-3 mb-3" style =""> + Ajouter un allocataire </button></a>
            
            <br>
            <p> Suggestions: <div id="suggesstion-box" ></div></p>
            <?php
                                    if(isset($_GET['error'])){
                                        $err = $_GET['error'];
                                        if($err == 2){
                                            echo "<p style='color:red'>Champ de recherche vide !</p>";
                                        }elseif($err == 1){
                                           echo "<p style='color:red'>La personne recherché n'existe pas !</p>";
                                      }
                                  }
                                    ?>
                                    </center>
            <?php
                      
                                  
                      if(isset($_GET['success'])){
                          $success = $_GET['success'];
                          if($success==2){
                              echo "<p style='color:green'>Un nouvel allocataire a bien été enregistré</p>";
                          }
                      }
                      ?>
        </form>
      </div>
      
      <script>
          if(typeof window.history.pushState == 'function') {
          window.history.pushState({}, "Hide", "accueil.php");
          }
        </script>
      
    <?php 
      if(isset($_GET['check'])){
      $success = $_GET['check'];
      if($success=='success'){
        ?>
      <script>
        $(window).on('load',function(){
        $('#myModal').modal('show');
        });
      </script>;
     
     <?php }
    }
    unset($_GET['check']);
      ?>
      <script src ="../assets/js/notif.js"></script>  
</body >
<script>
 console.log('%c Salut Moussa!', 'font-weight: bold; font-size: 50px;color: red; text-shadow: 3px 3px 0 rgb(217,31,38) , 6px 6px 0 rgb(226,91,14) , 9px 9px 0 rgb(245,221,8) , 12px 12px 0 rgb(5,148,68) , 15px 15px 0 rgb(2,135,206) , 18px 18px 0 rgb(4,77,145) , 21px 21px 0 rgb(42,21,113)');
</script>
</html>