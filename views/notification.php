<?php 
/**
 * @author Clément Broucke / Mehdi Nasri
 */
include_once '../entity/singleton.class.php';
//set la timezone sur Paris
date_default_timezone_set ('Europe/Paris');
//on crée une variable today qui est la date d'aujourd'hui au format y-m-d
$today = date('Y-m-d H:i:s');
//crée une variable email qui contient la session email
$email = $_SESSION['mail'];
//connection a la bdd 
$dbi = Singleton::getInstance();
$db=$dbi->getConnection();
$resultat =  $db->query("SELECT * FROM agenda WHERE Email = '$email' and start >= '$today' ORDER BY start ASC ");
$ligne = $resultat->fetchall(PDO::FETCH_ASSOC);
//si la variable ligne n'est pas vide on instancie 2 tableau
if(!empty($ligne)){
$title = array();
$start = array();
$i = 0;
foreach($ligne as $v){
    $title[$i] = $v['title'] ;
    $start[$i] = $v['start'];
    $i ++; 
}
$title = $title[0];
$date = $start[0];

$test = explode(" ",$date);

$closestDate=$test[0];
if($closestDate == date('Y-m-d')){
  $closestDate = "Aujourd'hui";
}
else {
$dt = DateTime::createFromFormat('Y-m-d', $closestDate);
$closestDate = $dt->format('d/m/Y');
}
$time = $test[1];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <title></title>
        <script>
  
  </script>
</head>
<body >



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background:;">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel" style="color:#43b29d;">Notification</h4>
      </div>
      <div class="modal-body">
      <h4>Prochain rendez vous :</h4>
        <p> <?php echo $title . " " . $closestDate . " à " . $time;   ?>.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal" style="background:#e2793d;color:#FFF;">Fermer</button>
        
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</body>

</html>

<?php }?>