<?php
 include_once "singleton.class.php";
/**
 * class Beneficiary = allocataire 
 * 
 */
 class Beneficiary 
 {
    private $_cafNumber;
    private $_name;
    private $_firstName;
    private $_birthDate;
    private $_gender;
   /**
    * @author GOMES elvis
    * 
    * initialisation de la classe Beneficiary
    */
   public function __construct($numAllocataire, $nom, $prenom, $dateNaissance, $genre)
   {
       $this->_cafNumber = $numAllocataire;
       $this->_name = $nom;
       $this->_firstName = $prenom;
       $this->_birthDate = $dateNaissance;
       $this->_gender = $genre;
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
     * Get the value of _name
     */ 
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * Set the value of _name
     *
     * @return  self
     */ 
    public function set_name($_name)
    {
        $this->_name = $_name;

        return $this;
    }

    /**
     * Get the value of _firstName
     */ 
    public function get_firstName()
    {
        return $this->_firstName;
    }

    /**
     * Set the value of _firstName
     *
     * @return  self
     */ 
    public function set_firstName($_firstName)
    {
        $this->_firstName = $_firstName;

        return $this;
    }

    /**
     * Get the value of _birthDate
     */ 
    public function get_birthDate()
    {
        return $this->_birthDate;
    }

    /**
     * Set the value of _birthDate
     *
     * @return  self
     */ 
    public function set_birthDate($_birthDate)
    {
        $this->_birthDate = $_birthDate;

        return $this;
    }

    /**
     * Get the value of _gender
     */ 
    public function get_gender()
    {
        return $this->_gender;
    }

    /**
     * Set the value of _gender
     *
     * @return  self
     */ 
    public function set_gender($_gender)
    {
        $this->_gender = $_gender;

        return $this;
    }
    /**
     * @author GOMES Elvis
     * 
     * fonction pour afficher toute les fonctions ci-dessus
     */
    public function __toString()
    {
        return get_cafNumber();
        return get_name();
        return get_firstName();
        return get_birthDate();
        return get_gender();
    }
    /**
     * 
     * Fonction pour inscrire un allocataire
     */
    public  function signUP()
    {    
        //instance de la bdd et connection
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
       //preparation de la requete d'insertion dans la bdd
        $query = $db->prepare("INSERT INTO allocataire (allocataireNumber,name,firstName,birthDate,gender) VALUES (:cafNumber, :name, :firstName, :birthDate, :gender)");
        //execution de la requete preparé
        $reponse = $query->execute(array(
            'cafNumber'=>$this->_cafNumber,
            'name'=>$this->_name,
            'firstName'=>$this->_firstName,
            'birthDate'=>$this->_birthDate,
            'gender'=>$this->_gender,
        ));
        return $reponse;
    }
    /**
     * @author GOMES Elvis
     * 
     * fonction pour afficher les informations d'un allocataire
     * 
     */
    public function detail()
    {
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //requete d'affichage de l'allocataire
        $resultat= $db->query("SELECT * FROM `allocataire` ");
        //on retourne un tableau associatif
        $ligne = $resultat->fetchall(PDO::FETCH_ASSOC);
        return $ligne;
    }
/**
 * fonction de recherche d'allocataire
 *
 * @param [string] $info
 * @return void
 * 
 * @author Mehdi Nasri / Clément Broucke
 */
    public function recherchePersonne($info){
        //instance de la bdd
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //si on ne trouve pas dans info un espace
        if(stripos($info," ")==false){
            //requete qui recherche les allocataires selon le nom, le prenom ou la date de naissance
            $query =  $db->prepare("SELECT allocataireNumber,name,firstName,birthDate FROM allocataire WHERE  upper(name) LIKE upper(:info) OR upper(firstName) LIKE upper(:info) OR birthDate=:info");
            //execution de la requete avec en parametre $info
            $query->execute(array(
                'info'=> "%".$info."%"
            ));
            //on recupere le resultat de cette recherche dans un tableau dont on ne garde que la valeur du 1er tableau
            $ligne = $query->fetch();
            //si ligne n'est pas vide on instancie les parametres de cette instance
        if(!empty($ligne)){
            $this->_cafNumber= $ligne[0];
            $this->_name= $ligne[1];
            $this->_firstName= $ligne[2];
            $this->_birthDate= $ligne[3];
                return true;
            }
        else{
            return false;
        }
    }
    //sinon on explode en 2 tableau au niveau de l'espace qu'on instancie dans 2 variables
    else {
        $explode = explode(' ',$info);
        $nom = $explode[0];
        $prenom = $explode[1];
        ////requete qui recherche les allocataires selon le nom, le prenom, les 2 ou la date de naissance
        $query =  $db->prepare("SELECT allocataireNumber,name,firstName,birthDate FROM allocataire WHERE upper(name) LIKE upper(:nom) AND upper(firstName) LIKE upper(:prenom) OR upper(name) LIKE upper(:prenom) AND upper(firstName) LIKE upper(:nom) OR birthDate=:info");
        //execution de la requete avec en parametre $info, nom, prenommel-
        $query->execute(array(
            'nom'=> "%".$nom."%",
            'prenom'=> "%".$prenom."%",
            'info'=> "%".$info."%"
        ));
        //on recupere le resultat de cette recherche dans un tableau dont on ne garde que la valeur du 1er tableau
        $ligne = $query->fetch();

        if(!empty($ligne)){
            $this->_cafNumber= $ligne[0];
            $this->_name= $ligne[1];
            $this->_firstName= $ligne[2];
            $this->_birthDate= $ligne[3];
            $this->_gender= $ligne[4];
            return true;
        }
        else{
            return false;
        }
    }
}
    /**
     * fonction de recherche similaire
     *
     * @param [string] $info
     * @return void
     * 
     * @author Mehdi Nasri / Clément Broucke
     */
    public function rechercheSimilaire($info){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        if(stripos($info," ") == false){
            //requete qui recherche les allocataires selon le nom, le prenom ou la date de naissance
            $query =  $db->prepare("SELECT allocataireNumber,name,firstName,birthDate FROM allocataire WHERE  upper(name) LIKE upper(:info) OR upper(firstName) LIKE upper(:info) OR birthDate=:info");
            //execution de la requete avec en parametre $info
            $query->execute(array(
                'info'=> "%".$info."%"
            ));
            $ligne = $query->fetchall(PDO::FETCH_ASSOC);
            return $ligne;
        }
        else {
            $explode = explode(' ',$info);
            $nom = $explode[0];
            $prenom = $explode[1];
            $query =  $db->prepare("SELECT allocataireNumber,name,firstName,birthDate FROM allocataire WHERE upper(name) LIKE upper(:nom) AND upper(firstName) LIKE upper(:prenom) OR upper(name) LIKE upper(:prenom) AND upper(firstName) LIKE upper(:nom) OR birthDate=:info");
            //execution de la requete avec en parametre $info, nom, prenommel-
            $query->execute(array(
                'nom'=> "%".$nom."%",
                'prenom'=> "%".$prenom."%",
                'info'=> "%".$info."%"
            ));
            $ligne = $query->fetchall(PDO::FETCH_ASSOC);
            return $ligne;
        }
    }
    /**
     * fonction de mise a jour de l'allocataire
     *
     * @param [string] $info
     * @return void
     * 
     * @author Mehdi Nasri
     */
    public function updateBeneficiary($info){
        //instance de la bdd
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //requete de recherche des données de l'allocataire selon le cafNumber
        $arr = $db->query("SELECT * FROM allocataire WHERE allocataireNumber = $info ");
        //resultat mis dans un tableau
        $ar = $arr->fetch();
        //si ce tableau n'est pas vide on instancie celui ci avec les anciennes valeurs de l'allocataire
        if(!empty($ar)){
            $ancienName = $ar[1];
            $ancienFirstName = $ar[2];
            $ancienBirthDate = $ar[3];
            $ancienGender = $ar[4];
        }
        //on instancie ensuite les propriétés de l'objet a celle ci si les valeurs sont vides
        if($this->_name == ""){
            $this->_name = $ancienName;
        }
        if($this->_firstName == ""){
            $this->_firstName= $ancienFirstName;
        }
        if($this->_birthDate== ""){
            $this->_birthDate = $ancienBirthDate;
        }
        if($this->_gender== ""){
            $this->_gender = $ancienGender;
        }
        //preparation de la requete d'update des données de l'allocataire
        $query = $db->prepare("UPDATE allocataire SET name=:name,firstName=:firstName,birthDate=:birthDate, gender=:gender WHERE allocataireNumber =:info");
        //execution de la requete d'update des données de l'allocataire
        $query->execute(array(
            'name' => $this->_name,
            'firstName'=>$this->_firstName,
            'birthDate'=>$this->_birthDate,
            'gender'=>$this->_gender,
            'info'=>$info
        ));
    }
    /**
     * fonction de verification du numero d'allocataire dans le bdd
     *
     * @param [string] $info
     * @return bool
     * 
     * @author Clément Broucke
     */
    public function checkCafNumber($info){
        //instance de la bdd
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //requete de recherche des données de l'allocataire selon le cafNumber
        $query = $db->prepare("SELECT * FROM allocataire WHERE allocataireNumber = :info");
        $query->execute(array(
            'info'=> $info,
        ));
        $data = $query->fetchall(PDO::FETCH_COLUMN);
        
        //pour chaque valeur de data
        if(empty($data)){
            $return  = true;
        }
        else{
            $return = false;
        }
        //on retourne un booleen true = le numero d'allocataire a été trouvé,  false il n'a pas été trouvé
        return $return;
    }
}

