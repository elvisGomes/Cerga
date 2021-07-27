<?php
  include_once 'singleton.class.php';
  /**
   * class BilanGeneral
   * 
   * @author Clément Broucke / Mehdi Nasri
   */
  class BilanGeneral {
    /**
     * fonction d'affichage du bilan
     *
     * @return array
     */
      function displayBilan(){
        //connexion a la bdd
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //preparation de la requete d'affichage des données du bilan_general
        $query = $db->prepare("SELECT * FROM bilan_general");
        //execution de cette requete
        $query->execute();
        //retour d'un tableau associatif
        $arr = $query->fetchall(PDO::FETCH_ASSOC);
        return $arr;      
    }
  }
?>