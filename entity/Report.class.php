<?php
include_once "singleton.class.php";
class Report
{
    private $_dated;
    private $_typeReport;
    private $_description;
    private $_cafNumber;
    private $_mailUser;

    /**
     * @author GOMES Elvis
     * 
     * Initialisation de la classe Rapport
     * 
     */
    public function __construct($date, $type, $description, $allocataireNumber,$mailUser)
    {
        $this->_dated = $date;
        $this->_typeReport = $type;
        $this->_description = $description;
        $this->_cafNumber = $allocataireNumber;
        $this->_mailUser = $mailUser;
    }
    /**
     * fonction de sauvegarde du rapport
     *
     * @return void
     */
    public function saveReport(){
            //connexion a la db
            $dbi = Singleton::getInstance();
            $conn=$dbi->getConnection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //preparation de la requete d'insertion 
            $query = $conn->prepare("INSERT INTO rapport (date,typeRapport,description,allocataireNumber,email) VALUES (:date,:duration,:description,:cafNumber,:email)");
            //creation des values a inserer dans la requete
            $query->bindValue(":date", $this->_dated);
            $query->bindValue(":duration", $this->_typeReport);
            $query->bindValue(":description", $this->_description);
            $query->bindValue(":cafNumber", $this->_cafNumber);
            $query->bindValue(":email", $this->_mailUser);
            //execution de la requete
            $query->execute();
            $conn = null; // Disconnect
    }

    /**
    * Prendre les rapport dans la base de donnée
    */
   public function listReport(){
    $dbi = Singleton::getInstance();
    $conn=$dbi->getConnection();
    //affichage des rapports en fonction du numero d'allocataire
    $result = $conn->query("SELECT * from rapport WHERE allocataireNumber = '$this->_cafNumber' ORDER BY date DESC");
    //retour d'un tableau asocatif
    $arr = $result->fetchall(PDO::FETCH_ASSOC);
    return $arr;
}
    /**
     * Function voir le rapport
     * renvoie un tableau
     */
    public function voirRapport($info){
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        //fonction d'affichage du rapport en fonction du numero de rapport
        $result = $conn->query("SELECT * from rapport WHERE numeroRapport = '$info'");
        //retour d'un tableau associatif
        $arr = $result->fetchall(PDO::FETCH_ASSOC);
        return $arr;
    }
    /**
     * fonction editerRapport
     * revoie void;
     */
    public function editerRapport($info,$mail){
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        //requete de l'affichage des anciens rapport en fonction de l'id
        $ancienResult = $conn->query("SELECT * from rapport WHERE numeroRapport = '$info'");
        //retour d'un tableau associatif
        $arr = $ancienResult->fetch();
        //si le tableau $arr n'est pas vide on instancie les variables au données du tableau
        if(!empty($arr)){
            $ancienneDate=$arr[1];
            $ancienType = $arr[2];
            $ancienneDescription = $arr[3];
        }
        //si dated est vide on le set a l'ancienne valeur issu de la bdd
        if($this->_dated == ""){
            $this->_dated  = $ancienneDate;
        }
        //meme traitement que dated
        if($this->_typeReport == ""){
            $this->_typeReport = $ancienType;
        }
        //meme traitement que dated
        if($this->_description== ""){
            $this->_description = $ancienneDescription;
        }
        //preparation de la requete de maj
        $query = $conn->prepare("UPDATE rapport SET date=:date, description=:description, typeRapport=:type,modifierPar=:mail  WHERE numeroRapport =:info");
        //execution de la requete avec en parametres un tableau contenant les attributs de l'instance de l'objet
        $query->execute(array(
            'date' => $this->_dated ,
            'description'=>$this->_description,
            'type'=>$this->_typeReport,
            'mail'=>$mail,
            'info'=>$info
        ));
    }
/**
 * fonction de suppression de rapport
 *
 * @param [int] $info
 * @return void
 */
    public function supprimerRapport($info)
    {
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //requete de suppression d'un rapport en fonction du numero de rapport
        $conn->query("DELETE from rapport WHERE numeroRapport = '$info'");
    }
        /**
     * Get the value of _dated
     */ 

    public function get_dated()
    {
        return $this->_dated;
    }

    /**
     * Set the value of _dated
     *
     * @return  self
     */ 
    public function set_dated($_dated)
    {
        $this->_dated = $_dated;

        return $this;
    }

    /**
     * Get the value of _duration
     */ 
    public function get_duration()
    {
        return $this->_duration;
    }

    /**
     * Set the value of _duration
     *
     * @return  self
     */ 
    public function set_duration($_duration)
    {
        $this->_duration = $_duration;

        return $this;
    }

    /**
     * Get the value of _description
     */ 
    public function get_description()
    {
        return $this->_description;
    }

    /**
     * Set the value of _description
     *
     * @return  self
     */ 
    public function set_description($_description)
    {
        $this->_description = $_description;

        return $this;
    }

    /**
     * Get the value of _cafNumber
     */ 
    public function get_cafNumber()
    {
        return $this->_cafNumber;
    }

    /**
     * Set the value of _cafNumber
     *
     * @return  self
     */ 
    public function set_cafNumber($_cafNumber)
    {
        $this->_cafNumber = $_cafNumber;

        return $this;
    }

     /**
     * @author GOMES Elvis
     * 
     * fonction pour afficher toutes les fonctions ci-dessus
     */
    public function __toString()
    {
        return get_dated();
        echo PHP_EOL;
        return get_duration();
        echo PHP_EOL;
        return get_description();
        echo PHP_EOL;
        return get_cafNumber();
    }
    
}