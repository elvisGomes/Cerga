<!DOCTYPE html>
<html lang ="fr">
       
<head>
                <meta charset="utf-8">
                <meta name = "viewport" content = "width=device-width, initial-scale =1.0">

                <title>AFPA</title>

                <link rel="stylesheet"type="text/css" href="../assets/css/resultatRecherchePersonne.css">
                <link href="../assets/css/notif.css" rel="stylesheet">
                <script src="../assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
                <style>
                    a
                    {
                        color: black;
                    }
                    </style>
</head>

<!-------------------------------------------------------------------------------------------------->

<body>
    <?php include 'nav.php';
    if(isset($_SESSION['cpt'])){
    unset($_SESSION['cpt']);
    }
    $cpt = 0;
    ?>
 
 <!----------------------------premier tableau------------------------------->
            <br/><br/>
 
        <div class = "container-float" style ="margin-left:5%;margin-right:70px;">
            <div class ="row">
                <div class="col-md-8 col-xs-8 col-sm-8">
                    <h2>Recherche d'allocataire</h2> <br/>
                        <p>Un allocataire a été trouvé par la recherche : <!--inserer un code php ici--><strong> <?php echo $_SESSION['info']; ?> </strong> </p> <br/>
                            
                </div>
            </div>
                <div class ="row">
                        <table class="table table-striped  table-bordered text-center" >
                            <thead>
                                <tr>
                                    <th class="tableau-rapport"><!--inserer un code php ici-->Nom</th>
                                    <th  class="suivis tableau-rapport" style="color: #43b29d;"scope="col"class="suivis" ><!--inserer un code php ici-->Date de naissance</th>
                                    <th class="tableau-rapport"><!--inserer un code php ici-->N° Allocataire</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <tr>
                                        <td ><!--inserer un code php ici--><a href="home.php" style="color:black;"> <?php echo $_SESSION['name'] . ' ' .   $_SESSION['firstName']; ?></a> </td>
                                        <td><!--inserer un code php ici--><?php $dt = DateTime::createFromFormat('Y-m-d', $_SESSION['birthDate'] );
                                                $birthDate = $dt->format('d/m/Y');
                                                echo $birthDate; ?> </td>
                                        <td> <!--inserer un code php ici--> <?php echo $_SESSION['allocNum']; ?>  </td>
                                    </tr>
                                </tbody>
                        </table>
            </div>
        </div>
        <div id ="notifications">
  
  </div>
        
        <div class="container-float" style ="margin-left:45%;">
            <div class="row">
                <div class="col-md-12">  
<!-- mettre lien page d'ajout de personne-->  <a class="nav-link" href="ajoutPersonne.php"><button type="button" class="btn btn-md btn-success" style ="background: #43b29d;"> + Ajouter un allocataire </button></a>
                </div>
            </div>
        </div>
    <br/><br/><br/>

<!----------------------------deuxieme tableau------------------------------->

        <div class = "container-float "style ="margin-left:5%;margin-right:70px;" >
            <div class ="row">
                <div class="col-md-8 col-xs-8 col-sm-8">
                    <h2 >allocataires similaires</h2><br/><!--inserer un code php ici-->
                        <p><?php echo $_GET['count'] - 1; ?> allocataires correspondent en partie aux termes de votre recherche : <!--inserer un code php ici--><strong>  <?php echo $_SESSION['info']; ?> </strong> </p> <br/>
                            <p>Résultats <?php echo $_GET['count'] - 1; ?> <!--inserer un code php ici--> </p> 
                </div>
            </div>
                <div class ="row">
                                <table class="table table-striped  table-bordered text-center" >
                                    <thead>
                                        <tr>
                                            <th class="tableau-rapport">Nom</th><!--inserer un code php ici-->
                                            <th class="tableau-rapport" style="color: #43b29d; padding: 10px 0px 10px 0px;">Date de naissance</th><!--inserer un code php ici-->
                                            <th class="tableau-rapport">N° Allocataire</th><!--inserer un code php ici-->
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <!--Boucle qui permet de créer des tableau HTML par rapport au nombre d'allocataire similaire trouvé -->
                                            <?php
                                                $i=1;
                                                
                                                while($i < $_GET['count']){
                                                    $i++;
                                               
                                            ?>
                                            <tr>
                                                <td><?php echo "<a href='home.php?count=$i' style='color:black;'>"?>  <?php echo $_SESSION['name' . $i] .' ' . $_SESSION['firstName' . $i];?> </a> </td><!--inserer un code php ici-->
                                                <td> <?php
                                                $dt = DateTime::createFromFormat('Y-m-d', $_SESSION['birthDate' . $i] );
                                                $birthDate = $dt->format('d/m/Y');
                                                echo $birthDate;?> </td><!--inserer un code php ici-->
                                                <td>  <?php echo $_SESSION['allocNum' . $i] ;?>  </td><!--inserer un code php ici-->
                                                </td>
                                            </tr>
                                                <?php  }?>
                                            
                                        </tbody>
                                </table>
                </div>
            </div>

        <div class="container-float" style ="margin-left:45%;">
            <div class="row">
                <div class="col">
                    <!-- mettre lien page d'ajout de personne-->
                    <a class="nav-link" href="ajoutPersonne.php"><button type="button" class="btn btn-md btn-success" style ="background: #43b29d;"> + Ajouter un allocataire </button></a>
                </div>
            </div>
        </div>




        <script src ="../assets/js/notif.js"></script>  
        
</body>
</html>