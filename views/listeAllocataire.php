
	<!DOCTYPE html>
<html lang="fr">

<head>
    <title>AFPA</title>
    <meta charset="utf-8">
 <!-- icone onglet navidateur internet -->
 <link rel="icon" type="image/png" href="../assets/images/afpaOnglet.png" />
	
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
	<link href="../assets/css/notif.css" rel="stylesheet">

	<style>a:link {
  			color: black;
			text-decoration: none;
		}
			a:visited {
			color: black;
			text-decoration: none;
		}
	</style>

	<!-- Tableau allocataire -->
        <!-- Datatable CSS -->
		
        <link href='../assets/DataTables/datatables.min.css' rel='stylesheet' type='text/css'>
        <!-- jQuery Library -->
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <!-- Datatable JS -->
        <script src="../assets/DataTables/datatables.min.js"></script>

</head>  
<!--===============================================================================================-->

<body>
<?php 

include("nav.php");if(isset($_SESSION['cpt'])){
    unset($_SESSION['cpt']);
		}
		?>
        
	<br/><br/>
		<center><h1> Liste des allocataires</h1></center>
		<!--tableau allocataire-->
		<div class="limiter">
			<div class="container-table100">
				<div class="wrap-table100">
					<div class="table100">
						<table  id='empTable' class='display dataTable'>
							<thead>
								<tr class="table100-head">
									<th class="column1">Nom</th>
									<th class="column2">Prenom</th>
									<th class="column3">N° allocataire</th>
									<th class="column4">Date de naissance</th>
								</tr>
							</thead>

						</table>
					</div>


					<!-- Script -->
					<script>
						$(document).ready(function(){
							$('#empTable').DataTable({
								"language": {   // traduction 
									"lengthMenu": "Choisir _MENU_ nombre de lignes",
									"zeroRecords": "aucun resultat",
									"info": "Page _PAGE_ sur _PAGES_",
									"infoEmpty": "Aucun enregistrement disponible ",
									"infoFiltered": "(filtered from _MAX_ total records)",
									"search":"Recherche",
									"paginate": {
									"previous": "precedente",
									"next": "suivante"
									}
								},
								'processing': true,
								'serverSide': true,
								'serverMethod': 'post',
								'ajax': {
									'url':'ajaxfile.php'
								},

								'columns': [
									{ data: 'name' },
									{ data: 'firstName' },
									{ data: 'allocataireNumber' },                  
									{ data: 'birthDate' },
								]
							});
						});
						// pour le clic de redirection dans le tableau
						$(document).ready(function() {
							var table = $('#empTable').DataTable();

							$('#empTable tbody').on('click', 'tr', function () {
								var data = table.row( this ).data();
								
								document.location.href="home.php?data="+data['allocataireNumber']+'&prenom='+data['firstName']+"&nom="+data['name'];
							} );
						} );
						

					</script>

				</div>
			</div>
		</div>

        <div id ="notifications">
  
        </div>
		<script src ="../assets/js/notif.js"></script>  
</body>
</html>

	