<?php
include_once "singleton.class.php";
/**
 * 
 * Class Worhshop = Atelier
 * 
 */
class Workshop
{
    private $_participateDated;
    private $_dated;
    private $_typeWorkShop;
    private $_description;
    private $_cafNumber;
    private $_mailUser;

    /**
     * @author GOMES Elvis
     * 
     * Initialisation de la classe Atelier
     * 
     */
    public function __construct($participateDated, $date, $type, $description,$cafNumber,$mailUser)
    {
        $this->_participateDated = $participateDated;
        $this->_dated = $date;
        $this->_typeWorkShop = $type;
        $this->_description = $description;
        $this->_cafNumber = $cafNumber;
        $this->_mailUser = $mailUser;
    }
    /**
     * fonction pour ajouter un atelier
     * renvoi void
     */
    public function saveWorkShop(){
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //preparation de la requete d'insertion de l'atelier
        $query = $conn->prepare("INSERT INTO atelier (date,typeAtelier,description,allocataireNumber,dateParticipation,email) VALUES (:date,:type,:description,:cafNumber,:dateParticipation,:email)");
        //creation d'un tableau avec les valeur a inserer
        $query->bindValue(":date", $this->_dated);
        $query->bindValue(":type", $this->_typeWorkShop);
        $query->bindValue(":description", $this->_description);
        $query->bindValue(":cafNumber", $this->_cafNumber);
        $query->bindValue(":dateParticipation", $this->_participateDated);
        $query->bindValue(":email", $this->_mailUser);
        //execution de la requete
        $query->execute();
        $conn = null; // Disconnect
    }

    /**
     * function pour lister les ateliers
     * retourne un tableau
     */
     public function workShopList(){
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        //requete d'affichage des atelier en fonction du numero d'allocataire
        $result = $conn->query("SELECT * from atelier WHERE allocataireNumber = '$this->_cafNumber' ORDER BY date DESC");
        //retourne un tableau associatif
        $arr = $result->fetchall(PDO::FETCH_ASSOC);
        return $arr;
     }
     /**
      * fonction pour voir le rapport
      * retourne un tableau
      */
      public function voirAtelier($info){
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        //requete d'affichage des ateliers en fonction de l'ID
        $result = $conn->query("SELECT * from atelier WHERE numeroAtelier = '$info'");
        //retourne un tableau associatif
        $arr = $result->fetchall(PDO::FETCH_ASSOC);
        return $arr;
      }
      /**
       * fonction pour modifer atelier
       * retourne void
       */
      public function editerAtelier($info,$mail){ 
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        //requete d'affichage des ateliers en fonction de l'ID
        $ancienResult = $conn->query("SELECT * from atelier WHERE numeroAtelier = '$info'");
        //$ancienResult dnas $arr
        $arr = $ancienResult->fetch();
        //si $arr n'est pas vide on set les données de la bdd dans 4 variables
        if(!empty($arr)){
            $ancienneDate=$arr[1];
            $ancienType = $arr[2];
            $ancienneDescription = $arr[3];
            $ancienneParticipation = $arr[5];
        }
        //si dated est vide on le set a la value actuelle dans la bdd
        if($this->_dated == ""){
            $this->_dated  = $ancienneDate;
        }
        //meme traitement que pour dated
        if($this->_typeWorkShop == ""){
            $this->_typeWorkShop = $ancienType;
        }
        //meme traitement que pour dated
        if($this->_description== ""){
            $this->_description = $ancienneDescription;
        }
        //meme traitement que pour dated
        if($this->_participateDated==""){
            $this->_participateDated = $ancienneParticipation;
        }
        //preparation de la requete de maj de l'atelier 
        $query = $conn->prepare("UPDATE atelier SET date=:date, description=:description,dateParticipation=:participe, typeAtelier=:type, modifierPar=:mail WHERE numeroAtelier =:info");
        //execution de la requete 
        $query->execute(array(
            'date' => $this->_dated ,
            'description'=>$this->_description,
            'type'=>$this->_typeWorkShop,
            'participe'=>$this->_participateDated,
            'mail'=>$mail,
            'info'=>$info
        ));
      }
/**
 * fonction de suppression d'un atelier
 *
 * @param [int] $info
 * @return bool
 */
      public function supprimerAtelier($info)
    {
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //requete de suppression de l'atelier en fonction de son ID
        $conn->query("DELETE from atelier WHERE numeroAtelier = '$info'");
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
    }
}