<?php
include_once '../entity/singleton.class.php';
$dbi = Singleton::getInstance();
$host = $dbi->getHost(); /* Host name */
$user = $dbi->getUsername(); /* User */
$password = $dbi->getPassword(); /* Password */
$dbname = $dbi->getDbname(); /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Vérifier la connexion
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}

## Lire valeur
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Affichage des lignes par page
$columnIndex = $_POST['order'][0]['column']; // Index de colonne
$columnName = $_POST['columns'][$columnIndex]['data']; // Nom de colonne
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Valeur de recherche

## recherche
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (upper(name) like upper('%".$searchValue."%') or 
        upper(firstName) like upper('%".$searchValue."%') or 
        allocataireNumber like'%".$searchValue."%' or 
        birthDate like'%".$searchValue."%'  ) ";
}

## Nombre total d'enregistrements sans filtrage
$sel = mysqli_query($con,"select count(*) as allcount from allocataire");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Nombre total d'enregistrements avec filtrage
$sel = mysqli_query($con,"select count(*) as allcount from allocataire WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from allocataire WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();
$i = 0;
while ($row = mysqli_fetch_assoc($empRecords)) {
    $dt[$i] = DateTime::createFromFormat('Y-m-d', $row['birthDate'] );
    $birthDate[$i] = $dt[$i]->format('d/m/Y');
    
    $data[] = array(           
    		"name"=>$row['name'],
            "firstName"=>$row['firstName'], 
            "allocataireNumber"=>$row['allocataireNumber'], 		
    		"birthDate"=>$birthDate[$i],
        );
        $i++;
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
