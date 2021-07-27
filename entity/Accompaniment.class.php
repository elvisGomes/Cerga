<?php 

include_once "Beneficiary.class.php";
include_once "singleton.class.php";
/**
 * @author GOMES Elvis
 * 
 * Classe Accompaniment = Accompagnement
 * 
 */
class Accompaniment
{
    private $_cafNumber;
    private $_mail;
    private $_openingDate;
    private $_closingDate;
    private $_typeOfAccompaniment;

    /**
     * @author GOMES Elvis
     * 
     * Initialisation de la class Accompaniment
     * 
     */
    public function __construct($numAllocataire, $email, $dateOn, $dateOff, $accompagnement)
    {
        $this->_cafNumber = $numAllocataire;
        $this->_mail = $email;
        $this->_openingDate = $dateOn;
        $this->_closingDate = $dateOff;
        $this->_typeOfAccompaniment = $accompagnement;
    }
    

    /**
     * Get the value of cafNumber
     */ 
    public function get_CafNumber()
    {
        return $this->_cafNumber;
    }

    /**
     * Set the value of cafNumber
     *
     * @return  self
     */ 
    public function set_CafNumber($cafNumber)
    {
        $this->_cafNumber = $cafNumber;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function get_Mail()
    {
        return $this->_mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function set_Mail($mail)
    {
        $this->_mail = $mail;

        return $this;
    }

    /**
     * Get the value of _openingDate
     */ 
    public function get_openingDate()
    {
        return $this->_openingDate;
    }

    /**
     * Set the value of _openingDate
     *
     * @return  self
     */ 
    public function set_openingDate($_openingDate)
    {
        $this->_openingDate = $_openingDate;

        return $this;
    }

    /**
     * Get the value of _closingDate
     */ 
    public function get_closingDate()
    {
        return $this->_closingDate;
    }

    /**
     * Set the value of _closingDate
     *
     * @return  self
     */ 
    public function set_closingDate($_closingDate)
    {
        $this->_closingDate = $_closingDate;

        return $this;
    }

     /**
     * Get the value of _typeOfAccompaniment
     */ 
    public function get_typeOfAccompaniment()
    {
        return $this->_typeOfAccompaniment;
    }

    /**
     * Set the value of _typeOfAccompaniment
     *
     * @return  self
     */ 
    public function set_typeOfAccompaniment($_typeOfAccompaniment)
    {
        $this->_typeOfAccompaniment = $_typeOfAccompaniment;

        return $this;
    }

    /**
     * @author GOMES Elvis
     * 
     * fonction pour afficher toutes les fonctions ci-dessus
     */
    public function __toString()
    {
        return get_CafNumber();
        echo PHP_EOL;
        return get_Mail();
        echo PHP_EOL;
        return get_openingDate();
        echo PHP_EOL;
        return get_closingDate();
        echo PHP_EOL;
        return get_typeOfAccompaniment();
    }

    /**
     * @author Groupe D
     * 
     * Fonction pour Ajouter un accompagnement 
     */

    public function addFollow()
    {   //Connexion a la bdd
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //préparation de la requete d'insertion
        $query = $db->prepare("INSERT INTO accompagne (allocataireNumber, email, dateOuverture, dateFermeture, type_d_accompagnement) 
        VALUES (:allocataireNumber,:email,:dateOuverture,:dateFermeture,:type_d_accompagnement)");
        //création du tableau contenant les parametres de la requete
        $query->bindValue(":allocataireNumber",$this->_cafNumber);
        $query->bindValue(":email",$this->_mail);
        $query->bindValue(":dateOuverture",$this->_openingDate);
        $query->bindValue(":dateFermeture",$this->_closingDate);
        $query->bindValue(":type_d_accompagnement",$this->_typeOfAccompaniment);
        //execution de la requete
        $reponse=$query->execute();
        $db= null; // Disconnect
        //retour d'un booléen 
        return $reponse;
    }


    /**
     * fonction d'affichage de l'accompagnement
     *
     * @return void
     */
    public function selectFollow()
    {
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //requete d'affichage des accompagnements
        $test = $db->query("SELECT * FROM  accompagne 
        WHERE allocataireNumber = '$this->_cafNumber' 
        ORDER BY dateOuverture ASC");
        //retour d'un tableau associatif contenant les données de l'accompagnement
        $arr = $test->fetchall(PDO::FETCH_ASSOC);
        return $arr;
    }
    /**
     * fonction d'edition des accompagnements
     *
     * @param [int] $info
     * @return void
     */
    public function editFollow($info){
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();

        //requete d'affichage de l'accompagnement en fonction de l'ID, resultats dans la variable ancienResult
        $ancienResult = $conn->query("SELECT * from accompagne WHERE ID = $info");
        //création d'un tableau contenant les anciennes données de l'accompagnement
        $arr = $ancienResult->fetch();
        //si le tableau n'est pas vide on crée 3 variables qui contienne les données de l'accompagnement actuellement dans la bdd
        if(!empty($arr)){
            $ancienneDate = $arr[2];
            $ancienType = $arr[3];
            $ancienneDescription = $arr[4];
        }
        //si openingDate est vide on set openingDate a l'ancienne valeur contenu dans la bdd
        if($this->_openingDate == ""){
            $this->_openingDate  = $ancienneDate;
        }
        //meme traitement pour closingDate
        if($this->_closingDate == ""){
            $this->_closingDate = $ancienType;
        }
        //meme traitement pour le type d'accompagnement
        if($this->_typeOfAccompaniment== ""){
            $this->_typeOfAccompaniment = $ancienneDescription;
        }
        //préparation de la nouvelle requete
        $query = $conn->prepare("UPDATE accompagne SET dateOuverture=:dateOuverture, dateFermeture =:dateFermeture, type_d_accompagnement=:description  WHERE ID =:info");
        //execution de la requete avec un tableau en parametres 
        $query->execute(array(
            'dateOuverture' => $this->_openingDate ,
            'description'=>$this->_typeOfAccompaniment,
            'dateFermeture'=>$this->_closingDate,
            'info'=>$info
        ));
    }
    /**
     * fonction de suppression d'une periode d'accompagnement
     *
     * @param [int] $info
     * @return bool
     */
    public function suppFollow($info)
    {
        $dbi = Singleton::getInstance();
        $conn=$dbi->getConnection();
        //suppression de la periode d'accompagnement correspondant a l'ID
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->query("DELETE from accompagne WHERE ID = $info");
    }      
    
}  