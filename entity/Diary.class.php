<?php
include_once "singleton.class.php";
/**
 * @author GOMES Elvis
 * 
 * Classe Diary = Agenda
 * 
 */
class Diary
{
    private $_start;
    private $_title;
    private $_end;

    /**
     * @author GOMES Elvis
     * 
     * Initialisation de la class Diary 
     * 
     */
    public function __construct($start, $title, $end)
    {
        $this->_start = $start;
        $this->_title = $title;
        $this->_end = $end;
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
     * Get the value of _typeOfAppointment
     */ 
    public function get_typeOfAppointment()
    {
        return $this->_typeOfAppointment;
    }

    /**
     * Set the value of _typeOfAppointment
     *
     * @return  self
     */ 
    public function set_typeOfAppointment($_typeOfAppointment)
    {
        $this->_typeOfAppointment = $_typeOfAppointment;

        return $this;
    }

    /**
     * Get the value of _mail
     */ 
    public function get_mail()
    {
        return $this->_mail;
    }

    /**
     * Set the value of _mail
     *
     * @return  self
     */ 
    public function set_mail($_mail)
    {
        $this->_mail = $_mail;

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
        return get_typeOfAppointment();
        echo PHP_EOL;
        return get_mail();
    }

     /**
     * @author GOMES Elvis
     * 
     * Fonction pour lire un rendez-vous dans l'agenda 
     */
    public function readDiary($email)
    {    //conexion a la bdd
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //requete d'affichage des rendez vous en fonction de l'email
        $resultat =  $db->query("SELECT * FROM agenda WHERE Email = '$email' ORDER BY id ");
        //retour d'un tableau associatif
        $ligne = $resultat->fetchall(PDO::FETCH_ASSOC);
        return $ligne;
    }
    /**
     * fonction pour ajouter un evenement a l'agenda
     */
    public function addEvent($email){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //creation de la requete d'insertion du rendez vous
        $query = "
        INSERT INTO agenda 
        (title, start, email) 
        VALUES (:title, :start_event, :email)
        ";
        //preparation de la requete
        $statement = $db->prepare($query);
        //execution de la requete avec en parmaetre un tableau qui contient les parametres de la requete
        $statement->execute(
         array(
          ':title'  => $this->_title,
          ':start_event' => $this->_start,
          ':email' => $email
         )
        );
    }
    /**
     * fonction pour éditer un évenement dans l'agenda
     */
    public function editEvent($id){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //preparation de la requete de maj des event
        $query = "
            UPDATE agenda
            SET start=:start_event
            WHERE id=:id
            ";
            $statement = $db->prepare($query);
            //execution de la requete
            $statement->execute(
            array(
            
            ':start_event' => $this->_start,
            ':id'   => $id
            )
            );
    }
    /**
     * fonction pour supprimer un évenement dans l'agenda 
     */
    public function deleteEvent($id){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //preparation et execution de la requete de suppression d'un event
        $query = "
                DELETE from agenda WHERE id=:id
                ";
                $statement = $db->prepare($query);
                $statement->execute(
                array(
                ':id' => $id
                )
                );
    }
    /**
     * fonction pour voir les rendez vous du jour
     *
     * @param [string] $email
     * @return array
     */
    public function viewTodayEvents($email){
        //set la timezone par defaut a Europe/paris
        date_default_timezone_set ('Europe/Paris');
        //creation ed la variable today
        $today = date('Y-m-d H:i:s');
        //creation de la variable demain
        $demain = date('Y-m-d', strtotime('+1 day'));
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //requete d'affichage des rdv d'aujourd'hui
        $resultat =  $db->query("SELECT * FROM agenda WHERE Email = '$email' and start >= '$today' and start < '$demain' ORDER BY start ASC ");
        //retour d'un tableau associatif
        $ligne = $resultat->fetchall(PDO::FETCH_ASSOC);
        return $ligne;
    }

    /**
     * fonction pour voir les CER 2 semaines avant la fin de contrat
     */
    public function viewCer(){
        //creation de variable today et twoweeks
            $today = date('Y-m-d');
            $twoWeeks = date('Y-m-d', strtotime('+14 days'));
            $dbi = Singleton::getInstance();
            $db=$dbi->getConnection();
            //requete d'affichage de la date de fermeture en fonction de $twoweeks
            $arr = $db->query("SELECT dateFermeture FROM accompagne WHERE dateFermeture = '$twoWeeks'");
            //retour d'un tableau associatif $tab
            $tab = $arr->fetchall(PDO::FETCH_ASSOC);
            //si $tab n'est pas vide
            if(!empty($tab)){
                //pour chaque valeur de $tab
            foreach($tab as $v ){
                //on instancie dateFermeture au valeurs de v
                $dateFermeture = $v['dateFermeture'];
            }
            //recherche du numero d'allocataire correspondant a la date de fermeture sous forme de tableau associatif
            $caf = $db->query("SELECT allocataireNumber FROM accompagne WHERE dateFermeture = '$dateFermeture'");
            $cafNum = $caf->fetchAll(PDO::FETCH_ASSOC);
            $i =0;
            //pour chaque vaeur du numero dallocataire
            foreach($cafNum as $v){
                //instanciation de tabAlloc
                $tabAlloc[$i] = $v['allocataireNumber'];
                $i++;
            }
            //creation de tab request
            $tabRequest = array();
            //pour chaque valeur de tabAlloc
            for($i = 0; $i < count($tabAlloc); $i++){
                //instanciation de tabRequest[$i]
                $tabRequest[$i] = $db->query("SELECT name,firstName,allocataireNumber FROM allocataire WHERE allocataireNumber = $tabAlloc[$i]");
                $resultat[$i] = $tabRequest[$i]->fetch();
            }
            return $resultat;
        }
    }
}