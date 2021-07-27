<?php
/**
 * @author Clément Broucke / Mehdi Nasri
 */
//Appelle l'autoload
require_once '../vendor/autoload.php';
include '../entity/BilanGeneral.class.php';
//instanciation de la class BilanGeneral
$bilanGeneral = new BilanGeneral();
//on récupere les données de la table bilan_general qu'on met dans un tableau $arr
$arr = $bilanGeneral->displayBilan();
//instanciation de dateReport et dt
$dateReport = array();
$dt= array();
//on change le format de la date au format europeen
for($i=0; $i<count($arr); $i++){
    $dt[$i] = DateTime::createFromFormat('Y-m-d', $arr[$i]['mois_rapport']);
    $dateReport[$i] = $dt[$i]->format('d/m/Y');
}
//Charge phpspreadsheet class en utilisant namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//Charge le format de sortie xlsx
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//Charge la class IOFactory
use PhpOffice\PhpSpreadsheet\IOFactory;

//on instancie Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
//on set la valeur de la cellule voulu

$sheet->setCellValue('A1', 'Mois de report');
$sheet->setCellValue('B1', 'Reporting Complet?');
$sheet->setCellValue('C1', 'Date du 1er jour');
$sheet->setCellValue('D1', "Nombres d'entrée");
$sheet->setCellValue('E1', 'Accomp. Mensuels');
$sheet->setCellValue('F1', 'Tx occup (%)');
$sheet->setCellValue('G1', 'Places dispo.');
$sheet->setCellValue('H1', 'Nb. de sorties');
$sheet->setCellValue('I1', 'CDI et fonction publique');
$sheet->setCellValue('J1', 'CDD, interims et saison.');
$sheet->setCellValue('K1', 'CIE en CDI');
$sheet->setCellValue('L1', 'Création reprise entrepr.');
$sheet->setCellValue('M1', 'TOTAL EMPLOI DUR.');
$sheet->setCellValue('N1', 'CDD, interims et saison.');
$sheet->setCellValue('O1', 'CIE en CDD');
$sheet->setCellValue('P1', 'Contrats aidés en CDD');
$sheet->setCellValue('Q1', 'TOTAL EMPLOI TRANS.');
$sheet->setCellValue('R1', 'Formation qualif.');
$sheet->setCellValue('S1', 'Autre action insertion prof.');
$sheet->setCellValue('T1', 'Droit retraite');
$sheet->setCellValue('U1', 'Autre SIAE');
$sheet->setCellValue('V1', 'TOTAL SORTIES POS.');
$sheet->setCellValue('W1', 'TOTALES SORTIES DYNAM.');
$sheet->setCellValue('X1', 'Déménag.');
$sheet->setCellValue('Y1', 'Autre droit que le RSA');
$sheet->setCellValue('Z1', 'Problème de santé');
$sheet->setCellValue('AA1', 'Autre sortie légitime');
$sheet->setCellValue('AB1', 'TOTAL SORTIES LEGIT.');
$sheet->setCellValue('AC1', "Fin d'action");
$sheet->setCellValue('AD1', 'Pôle Emploi');
$sheet->setCellValue('AE1', 'Autre action insertion sociale');
$sheet->setCellValue('AF1', 'Abandon');
$sheet->setCellValue('AG1', 'TOTAL AUTRES SORTIES');
$j=2;
//pour chaque ligne de la table bilan_general on les met dans une cellule du fichier excel
for($i=0; $i<count($arr); $i++){
  
    $sheet->setCellValue('A'.$j, $dateReport[$i]);
    $sheet->setCellValue('B'.$j, 'Oui');
    $sheet->setCellValue('C'.$j, $arr[$i]['date_premier_jour']);
    $sheet->setCellValue('D'.$j, $arr[$i]['nb_entree']);
    $sheet->setCellValue('E'.$j, $arr[$i]['accomp_mensuel']);
    $sheet->setCellValue('F'.$j, $arr[$i]['tx_occup']);
    $sheet->setCellValue('G'.$j, $arr[$i]['place_dispo']);
    $sheet->setCellValue('H'.$j, $arr[$i]['nb_sortie']);
    $sheet->setCellValue('I'.$j, $arr[$i]['cdi_fonction_publique']);
    $sheet->setCellValue('J'.$j, $arr[$i]['cdd_interim_saison']);
    $sheet->setCellValue('K'.$j, $arr[$i]['cie_en_cdi']);
    $sheet->setCellValue('L'.$j, $arr[$i]['creation_entreprise']);
    $sheet->setCellValue('M'.$j, $arr[$i]['total_emploi_dur']);
    $sheet->setCellValue('N'.$j, '');
    $sheet->setCellValue('O'.$j, $arr[$i]['cie_en_cdd']);
    $sheet->setCellValue('P'.$j, $arr[$i]['contrat_aides_cdd']);
    $sheet->setCellValue('Q'.$j, $arr[$i]['total_emploi_trans']);
    $sheet->setCellValue('R'.$j, $arr[$i]['formation_qualif']);
    $sheet->setCellValue('S'.$j, $arr[$i]['autre_insertion_prof']);
    $sheet->setCellValue('T'.$j, $arr[$i]['droit_retraite']);
    $sheet->setCellValue('U'.$j, $arr[$i]['autre_siae']);
    $sheet->setCellValue('V'.$j, $arr[$i]['total_sorties_pos']);
    $sheet->setCellValue('W'.$j, $arr[$i]['total_sorties_dynam']);
    $sheet->setCellValue('X'.$j, $arr[$i]['demenag']);
    $sheet->setCellValue('Y'.$j, $arr[$i]['autre_droit_que_rsa']);
    $sheet->setCellValue('Z'.$j, $arr[$i]['probleme_sante']);
    $sheet->setCellValue('AA'.$j, $arr[$i]['autre_sortie_legitime']);
    $sheet->setCellValue('AB'.$j, $arr[$i]['total_sortie_legit']);
    $sheet->setCellValue('AC'.$j, $arr[$i]['fin_action']);
    $sheet->setCellValue('AD'.$j, $arr[$i]['pole_emploi']);
    $sheet->setCellValue('AE'.$j, $arr[$i]['autre_action_insertion_sociale']);
    $sheet->setCellValue('AF'.$j, $arr[$i]['abandon']);
    $sheet->setCellValue('AG'.$j, $arr[$i]['total_autre_sorties']);
    
    $j++;
}
//Sizing des colonnes a la taille du nom de la colonne
for ($i = 'A'; $i != $sheet->getHighestColumn(); $i++) { $sheet->getColumnDimension($i)->setAutoSize(TRUE); }

//on set le header pour que le resultat soit traité au formal xlsx
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//on renomme le fichier
header('Content-Disposition: attachment;filename="bilan.xlsx"');
//crée IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//sauvegarde en php output
$writer->save('php://output');