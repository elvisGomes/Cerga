<?php 
include_once "singleton.class.php";
/**
 * class Situation des allocataires
 * 
 * @author Clément Broucke / Mehdi Nasri
 */
 class Situation {
     private $_situation,
             $_dateDebut,
             $_dateFin,
             $_allocataireNumber,
             $_notes;
             /**
              * Undocumented function
              *
              * @param [type] $situation
              * @param [type] $dateDebut
              * @param [type] $dateFin
              * @param [type] $allocataireNumer
              * @param [type] $notes
              */
    public function __construct($situation,$dateDebut,$dateFin,$allocataireNumer,$notes){
        $this->_situation = $situation;
        $this->_dateDebut = $dateDebut;
        $this->_dateFin = $dateFin;
        $this->_allocataireNumber = $allocataireNumer;
        $this->_notes = $notes;
    }
    /**
     * fonction pour ajouter une Situation
     *
     * @return bool
     */
    public function addSituation() {
        //connexion a la bdd
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //preparation de la requete d'insertion des données dans situation
        $result = $db->prepare("INSERT INTO situation (allocataireNumber,situation,date_debut,date_fin,notes) VALUES (:allocNum,:situation,:dateDebut,:dateFin,:notes)");
        //execution de la requete en parametre un tableau contenant les données a inserer
        $result->execute(array(
            'allocNum'=> $this->_allocataireNumber,
            'situation'=> $this->_situation,
            'dateDebut'=> $this->_dateDebut,
            'dateFin' => $this->_dateFin,
            'notes' => $this->_notes
        ));
    }   
    /**
     * function pour afficher les situations 
     *
     * @return array
     */
    public function readSituation(){
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        //requete d'affichage des situations en fonction du numero d'allocataire par date_debut decroissant
        $result = $conn->query("SELECT * from situation WHERE allocataireNumber = '$this->_allocataireNumber' ORDER BY date_debut DESC");
        //retour d'un tableau associatif
        $arr = $result->fetchall(PDO::FETCH_ASSOC);
        return $arr;
    }
    /**
     * function pour modifier une situation
     *
     * @param [type] $info
     * @return 
     */
    public function updateSituation($info,$mail){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //requete d'affichage des situations en fonction de l'id
        $arr = $db->query("SELECT * FROM situation WHERE id_situation = $info ");
        $ar = $arr->fetch();
    //si le tableau $arr n'est pas vide on set les données de celui ci dans 4 variables
        if(!empty($ar)){
            $ancienneDateDebut = $ar[1];
            $ancienneDateFin = $ar[2];
            $ancienneSituation = $ar[3];
            $ancienneNotes = $ar[5];
        }
        //si date_debut est vide on le set a la valeur de la bdd
        if($this->_dateDebut == ""){
            $this->_dateDebut= $ancienneDateDebut;
        }
        //meme traitement que date_debut
        if($this->_dateFin == ""){
            $this->_dateFin= $ancienneDateFin;
        }
        //meme traitement que date_debut
        if($this->_situation== ""){
            $this->_situation = $ancienneSituation;
        }
        //meme traitement que date_debut
        if($this->_notes== ""){
            $this->_notes = $ancienneNotes;
        }
        //preparation de la requete de maj de la situation
        $query = $db->prepare("UPDATE situation SET date_debut=:dateDebut,date_fin=:dateFin,situation=:situation, notes=:notes, modifierPar=:mail WHERE id_situation =:info");
        //execution de la requete en parametre les données a inserer en bdd
        $query->execute(array(
            'dateDebut' => $this->_dateDebut,
            'dateFin'=>$this->_dateFin,
            'situation'=>$this->_situation,
            'notes'=>$this->_notes,
            'mail'=>$mail,
            'info'=>$info
        ));
    }
    /**
     * fonction d'affichage de la situation
     *
     * @param [int] $info
     * @return array
     */
    public function voirSituation($info){
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        //requete d'affichage de la situation en fonction de son ID
        $result = $conn->query("SELECT * from situation WHERE id_situation = '$info'");
        //retourne un rableau associatif
        $arr = $result->fetchall(PDO::FETCH_ASSOC);
        return $arr;
      }
     /**
      * Get the value of _situation
      */ 
     public function get_situation()
     {
          return $this->_situation;
     }

     /**
      * Set the value of _situation
      *
      * @return  self
      */ 
     public function set_situation($_situation)
     {
          $this->_situation = $_situation;

          return $this;
     }

        /**
         * Get the value of _dateDebut
        */ 
        public function get_dateDebut()
        {
                    return $this->_dateDebut;
        }

        /**
         * Set the value of _dateDebut
        *
        * @return  self
        */ 
        public function set_dateDebut($_dateDebut)
        {
                    $this->_dateDebut = $_dateDebut;

                    return $this;
        }

        /**
         * Get the value of _dateFin
        */ 
        public function get_dateFin()
        {
                    return $this->_dateFin;
        }

        /**
         * Set the value of _dateFin
        *
        * @return  self
        */ 
        public function set_dateFin($_dateFin)
        {
                    $this->_dateFin = $_dateFin;

                    return $this;
        }

        /**
         * Get the value of _allocataireNumber
        */ 
        public function get_allocataireNumber()
        {
                    return $this->_allocataireNumber;
        }

        /**
         * Set the value of _allocataireNumber
        *
        * @return  self
        */ 
        public function set_allocataireNumber($_allocataireNumber)
        {
                    $this->_allocataireNumber = $_allocataireNumber;

                    return $this;
        }

        /**
         * Get the value of _notes
        */ 
        public function get_notes()
        {
                    return $this->_notes;
        }

        /**
         * Set the value of _notes
        *
        * @return  self
        */ 
        public function set_notes($_notes)
        {
                    $this->_notes = $_notes;

                    return $this;
             }
 }
?>