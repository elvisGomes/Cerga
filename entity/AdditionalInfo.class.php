<?php
include_once("Beneficiary.class.php");
include_once "singleton.class.php";
/**
 * class AdditionalInfo qui contient les données complémentaires
 */
class AdditionalInfo
{
    //Attributs
    private $_placeOfBirth;
    private $_nativeCountry;
    private $_driverLicense;
    private $_adress;
    private $_phoneNumber;
    private $_mail;
    private $_referenceNumber;
    private $_cafNumber;
    private $_IDPE;
    private $_RQTH;
    private $_codePostal;
    private $_ville;
    private $_reference;
    private $_conseiller;
    private $_allocataireTravail;
    private $_dateTravail;
    private $_heureMensuelle;
    private $_dejaTravailler;
    private $_dernierContrat;
    private $_statutAllocataire;
    private $_niveauEtude;
    private $_reconnuEnFrance;
    private $_niveauMaitrisefrancais;
    private $_couvertureSocial;
    private $_logement;
    private $_nbChild;
    private $_situationFamilial;
    private $_autreStructure;
    private $_dateOuverture;
    //Methodes
    /**
     * @author GOMES Elvis
     * 
     * Initialisation de la classe infos complementaires
     */
    public function __construct($lieu, $pays, $permis, 
    $adresse, $telephone, $mail, $numAllocataire, $IDPE, $RQTH, $codePostal, $ville, 
    $reference, $conseiller, $allocataireTravail,
     $dateTravail, $heureMensuelle, $dejaTravailler, 
     $dernierContrat, $statutAllocataire,$referent, 
     $niveauEtude, $reconnuEnFrance, $niveauMaitrisefrancais, 
     $couvertureSocial, $logement, $nbChild, $situationFamilial, $autreStructure, $dateOuverture)
    {
        $this->_placeOfBirth = $lieu;
        $this->_nativeCountry = $pays;
        $this->_driverLicense = $permis;
        $this->_adress = $adresse;
        $this->_phoneNumber = $telephone;
        $this->_mail = $mail;
        $this->_referenceNumber = $reference;
        $this->_cafNumber = $numAllocataire;
        $this->_IDPE = $IDPE;
        $this->_RQTH = $RQTH;
        $this->_codePostal = $codePostal;
        $this->_ville = $ville;
        $this->_conseiller = $conseiller;
        $this->_allocataireTravail = $allocataireTravail;
        $this->_reference = $referent;
        $this->_dateTravail = $dateTravail;
        $this->_heureMensuelle = $heureMensuelle;
        $this->_dejaTravailler = $dejaTravailler;
        $this->_dernierContrat = $dernierContrat;
        $this->_statutAllocataire = $statutAllocataire;
        $this->_niveauEtude = $niveauEtude;
        $this->_reconnuEnFrance = $reconnuEnFrance;
        $this->_niveauMaitrisefrancais = $niveauMaitrisefrancais;
        $this->_couvertureSocial = $couvertureSocial;
        $this->_logement = $logement;
        $this->_nbChild = $nbChild;
        $this->_situationFamilial = $situationFamilial;
        $this->_dateOuverture = $dateOuverture;
        $this->_autreStructure = $autreStructure;


    }

    /**
     * Get the value of _placeOfBirth
     */ 
    public function get_placeOfBirth()
    {
        return $this->_placeOfBirth;
    }

    /**
     * Set the value of _placeOfBirth
     *
     * @return  self
     */ 
    public function set_placeOfBirth($_placeOfBirth)
    {
        $this->_placeOfBirth = $_placeOfBirth;

        return $this;
    }

    /**
     * Get the value of _nativeCountry
     */ 
    public function get_nativeCountry()
    {
        return $this->_nativeCountry;
    }

    /**
     * Set the value of _nativeCountry
     *
     * @return  self
     */ 
    public function set_nativeCountry($_nativeCountry)
    {
        $this->_nativeCountry = $_nativeCountry;

        return $this;
    }

    /**
     * Get the value of _driverLicense
     */ 
    public function get_driverLicense()
    {
        return $this->_driverLicense;
    }

    /**
     * Set the value of _driverLicense
     *
     * @return  self
     */ 
    public function set_driverLicense($_driverLicense)
    {
        $this->_driverLicense = $_driverLicense;

        return $this;
    }

    /**
     * Get the value of _adress
     */ 
    public function get_adress()
    {
        return $this->_adress;
    }

    /**
     * Set the value of _adress
     *
     * @return  self
     */ 
    public function set_adress($_adress)
    {
        $this->_adress = $_adress;

        return $this;
    }

    /**
     * Get the value of _phoneNumber
     */ 
    public function get_phoneNumber()
    {
        return $this->_phoneNumber;
    }

    /**
     * Set the value of _phoneNumber
     *
     * @return  self
     */ 
    public function set_phoneNumber($_phoneNumber)
    {
        $this->_phoneNumber = $_phoneNumber;

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
     * Get the value of _referenceNumber
     */ 
    public function get_referenceNumber()
    {
        return $this->_referenceNumber;
    }

    /**
     * Set the value of _referenceNumber
     *
     * @return  self
     */ 
    public function set_referenceNumber($_referenceNumber)
    {
        $this->_referenceNumber = $_referenceNumber;

        return $this;
    }

    /**
     * @author GOMES Elvis
     * 
     * fonction pour afficher toutes les fonctions ci-dessus
     */
    public function __toString()
    {
        return get_placeOfBirth();
        echo PHP_EOL;
        return get_adress();
        echo PHP_EOL;
        return get_nativeCountry();
        echo PHP_EOL;
        return get_driverLicense();
        echo PHP_EOL;
        return get_phoneNumber();
        echo PHP_EOL;
        return get_mail();
        echo PHP_EOL;
        return get_referenceNumber();
    }

      /**
     * @author Clément Broucke / Mehdi Nasri
     * 
     * Fonction pour Ajouter des infos sur un allocataire deja inscrit 
     */
    public function addInfo()
    {              
        //connexion a la bd
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //si placeOfBirth est vide on le set null
        if($this->_placeOfBirth == ""){
            $this->_placeOfBirth = null;
        }
        //meme traitement que placeOfBirth
        if($this->_nativeCountry == ""){
            $this->_nativeCountry = null;
        }
        //meme traitement que placeOfBirth
        if($this->_driverLicense == ""){
            $this->_driverLicense = null;
        }
        //meme traitement que placeOfBirth
        if($this->_adress == ""){
            $this->_adress = null;
        }
        //meme traitement que placeOfBirth
        if($this->_phoneNumber ==""){
            $this->_phoneNumber = null;
        }
        //meme traitement que placeOfBirth
        if($this->_mail == ""){
            $this->_mail = null;
        }
        //meme traitement que placeOfBirth
        if($this->_referenceNumber == ""){
            $this->_referenceNumber = null;
        }
        //meme traitement que placeOfBirth
        if($this->_IDPE == ""){
            $this->_IDPE = null;
        }
        //meme traitement que placeOfBirth
        if($this->_RQTH == ""){
            $this->_RQTH = null;
        }
        //meme traitement que placeOfBirth
        if($this->_codePostal == ""){
            $this->_codePostal = null;
        }
        //meme traitement que placeOfBirth
        if($this->_ville == ""){
            $this->_ville = null;
        }
        //meme traitement que placeOfBirth
        if($this->_reference == ""){
            $this->_reference  = null;
        }
        //meme traitement que placeOfBirth
        if($this->_conseiller == ""){
            $this->_conseiller = null;
        }
        //meme traitement que placeOfBirth
        if($this->_allocataireTravail == ""){
            $this->_allocataireTravail = null;
        }
        //meme traitement que placeOfBirth
        if($this->_dateTravail == ""){
            $this->_dateTravail = null;
        }
        //meme traitement que placeOfBirth
        if($this->_heureMensuelle == ""){
            $this->_heureMensuelle = null;
        }
        //meme traitement que placeOfBirth
        if($this->_dejaTravailler == ""){
            $this->_dejaTravailler = null;
        }
        //meme traitement que placeOfBirth
        if($this->_dernierContrat == ""){
            $this->_dernierContrat = null;
        }
        //meme traitement que placeOfBirth
        if($this->_statutAllocataire == ""){
            $this->_statutAllocataire = null;
        }
        //meme traitement que placeOfBirth
        if($this->_niveauEtude == ""){
            $this->_niveauEtude = null;
        }
        //meme traitement que placeOfBirth
        if($this->_reconnuEnFrance == ""){
            $this->_reconnuEnFrance = null;
        }
        //meme traitement que placeOfBirth
        if($this->_niveauMaitrisefrancais == ""){
            $this->_niveauMaitrisefrancais = null;
        }
        //meme traitement que placeOfBirth
        if($this->_couvertureSocial == ""){
            $this->_couvertureSocial = null;
        }
        //meme traitement que placeOfBirth
        if($this->_logement == ""){
            $this->_logement = null;
        }
        //meme traitement que placeOfBirth
        if($this->_nbChild == ""){
            $this->_nbChild = null;
        }
        //meme traitement que placeOfBirth
        if($this->_situationFamilial == ""){
            $this->_situationFamilial = null;
        }
        //meme traitement que placeOfBirth
        if($this->_autreStructure == ""){
            $this->_autreStructure = null;
        }
        //meme traitement que placeOfBirth
        if($this->_dateOuverture == ""){
            $this->_dateOuverture = null;
        }
        //preparation de la requete d'insertion des infos complementaires
       $query = $db->prepare("INSERT INTO infos_complementaires (placeOfBirth, nativeCountry, driverSLicense, adress, 
        phoneNumber, mail, numero_reference, `IDPE`, `RQTH`, `codePostal`, `ville`, `reference`, `conseiller`, `allocataireTravail`, `dateTravail`, `heureMensuelle`, `dejaTravailler`, `dernierContrat`, `statutAllocataire`, 
        `niveauEtude`, `reconnuEnFrance`, `maitriseFrancais`, `couvertureSocial`, `logement`,`nb_enfants`,`situation_familial`, `autre_structure`, `date_ouverture`, allocataireNumber) 
        VALUES (:placeOfBirth, :nativeCountry, :driverSLicense, :adress, 
        :phoneNumber, :mail, :numero_reference, :IDPE, :RQTH, :codePostal, :ville, :reference, :conseiller, :allocataireTravail, :dateTravail, :heureMensuelle, :dejaTravailler, :dernierContrat, :statutAllocataire, 
        :niveauEtude, :reconnuEnFrance, :maitriseFrancais, :couvertureSocial, :logement, :nbChild, :situationF, :autreStructure, :dateOuverture, :allocataireNumber)");
        //execution de la requete d'insertion avec en parametres un tableau qui contient toutes les valeurs a inserer
        $reponse=$query->execute(array(
            'placeOfBirth'=>$this->_placeOfBirth,
            'nativeCountry'=>$this->_nativeCountry,
            'driverSLicense'=>$this->_driverLicense,
            'adress'=>$this->_adress,
            'phoneNumber'=>$this->_phoneNumber,
             'mail'=>$this->_mail,
             'numero_reference'=>$this->_referenceNumber,
             'IDPE'=>$this->_IDPE,
             'RQTH'=>$this->_RQTH,
             'codePostal'=>$this->_codePostal,
             'ville'=> $this->_ville,
             'reference'=>$this->_reference,
             'conseiller'=>$this->_conseiller,
             'allocataireTravail'=>$this->_allocataireTravail,
             'dateTravail'=>$this->_dateTravail,
             'heureMensuelle'=>$this->_heureMensuelle,
             'dejaTravailler'=>$this->_dejaTravailler,
             'dernierContrat'=>$this->_dernierContrat,
             'statutAllocataire'=>$this->_statutAllocataire,
             'niveauEtude'=>$this->_niveauEtude,
             'reconnuEnFrance'=>$this->_reconnuEnFrance,
             'maitriseFrancais'=>$this->_niveauMaitrisefrancais,
             'couvertureSocial'=>$this->_couvertureSocial,
             'logement'=>$this->_logement,
             'nbChild'=>$this->_nbChild,
             'situationF'=>$this->_situationFamilial,
             'autreStructure'=>$this->_autreStructure,
             'dateOuverture'=>$this->_dateOuverture,
             'allocataireNumber'=>$this->_cafNumber,
        
            
        ));
        //retourne un booleen
        return $reponse;
    }
    
    /**
     * @author GOMES Elvis
     * 
     * Fonction pour avoir les infos de bas + les complementaires
     * 
     */
    public function fullInfo()
    {
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //requete d'affichage des informations de l'allocataire, information recuperées dans les tables allocataire, infos_complementaires, accompagne, items_sociaux
        $test = $db->query("SELECT allocataire.*, infos_complementaires.*, accompagne.*,item_sociaux.* 
        FROM allocataire, infos_complementaires, accompagne, item_sociaux WHERE allocataire.allocataireNumber = '$this->_cafNumber' 
        AND allocataire.allocataireNumber = infos_complementaires.allocataireNumber 
        AND infos_complementaires.allocataireNumber = accompagne.allocataireNumber
        AND accompagne.allocataireNumber = item_sociaux.allocataireNumber ORDER BY dateOuverture DESC");
        //retourne un tableau associatif
        $arr = $test->fetchall(PDO::FETCH_ASSOC);
        return $arr;
    }

    /**
     * fonction de maj des infos de l'allocataire
     *
     * @param [int] $info
     * @return void
     */
    public function updateAllocataire($info){
    
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //on crée un tableau qui contient les données de la bdd pour ce numero d'allocataire
        $arr = $db->query("SELECT * FROM infos_complementaires WHERE allocataireNumber =$info ");
        $ar = $arr->fetch();
        //si le tableau n'est pas vide on crée des variables qui prennent les valeurs de la bdd pour ce numero d'allocataire
        if(!empty($ar)){
            $ancienLieuNaissance = $ar[1];
            $ancienPaysNaissance= $ar[2];
            $anciennePermis = $ar[3];
            $ancienneAdress = $ar[4];
            $ancienNumero= $ar[5];
            $ancienMail = $ar[6];
            $ancienNumRef = $ar[7];
            $ancienIDPE = $ar[9];
            $ancienRQTH = $ar[10];
            $ancienCodePostal= $ar[11];
            $ancienneVille = $ar[12];
            $ancienReference= $ar[13];
            $ancienConseiller= $ar[14];
            $ancienAlocTravail = $ar[15];
            $ancienneDateTravail = $ar[16];
            $ancienneHeureMensuelle= $ar[17];
            $ancienDejaTravaille = $ar[18];
            $ancienDerniercontrat = $ar[19];
            $ancienSattutAlloc= $ar[20];
            $ancienNiveauEtude = $ar[21];
            $ancienReconnuFrance = $ar[22];
            $ancienMaitriseFrancais= $ar[23];
            $anciencouvertureSocial = $ar[24];
            $ancienLogement = $ar[25];
            $ancienNbEnfants = $ar[26];
            $ancienneSituationF = $ar[27]; 
            $ancienneAutreStructure = $ar[28];
            $ancienDateOuverture = $ar[29];       
        }
        //si mail est vide on le set a la valeur du mail de la bdd pour ce numero d'allocataire
        if($this->_mail == ""){
            $this->_mail = $ancienMail;
        }
        //meme traitement que pour le mail
        if($this->_adress == ""){
            $this->_adress = $ancienneAdress;
        }
        //meme traitement que pour le mail
        if($this->_ville == ""){
            $this->_ville = $ancienneVille;
        }
        //meme traitement que pour le mail
        if($this->_placeOfBirth == ""){
            $this->_placeOfBirth = $ancienPaysNaissance;
        }
        //meme traitement que pour le mail
        if($this->_nativeCountry == ""){
            $this->_nativeCountry = $ancienLieuNaissance;
        }
        //meme traitement que pour le mail
        if($this->_phoneNumber == ""){
            $this->_phoneNumber = $ancienNumero;
        }
        //meme traitement que pour le mail
        if($this->_driverLicense == ""){
            $this->_driverLicense = $anciennePermis;
        }
        //meme traitement que pour le mail
        if($this->_referenceNumber == ""){
            $this->_referenceNumber = $ancienNumRef;
        }
        //meme traitement que pour le mail
        if($this->_IDPE == ""){
            $this->_IDPE = $ancienIDPE;
        }
        //meme traitement que pour le mail
        if($this->_RQTH == ""){
            $this->_RQTH = $ancienRQTH;
        }
        //meme traitement que pour le mail
        if($this->_codePostal == ""){
            $this->_codePostal = $ancienCodePostal;
        }
        //meme traitement que pour le mail
        if($this->_reference == ""){
            $this->_reference= $ancienReference;
        }
        //meme traitement que pour le mail
        if($this->_conseiller == ""){
            $this->_conseiller = $ancienConseiller;
        }
        //meme traitement que pour le mail
        if($this->_allocataireTravail == ""){
            $this->_allocataireTravail = $ancienAlocTravail ;
        }
        //meme traitement que pour le mail
        if($this->_dateTravail == ""){
            $this->_dateTravail = $ancienneDateTravail;
        }
        //meme traitement que pour le mail
        if($this->_heureMensuelle == ""){
            $this->_heureMensuelle = $ancienneHeureMensuelle;
        }
        //meme traitement que pour le mail
        if($this->_dejaTravailler == ""){
            $this->_dejaTravailler = $ancienDejaTravaille;
        }
        //meme traitement que pour le mail
        if($this->_dernierContrat == ""){
            $this->_dernierContrat = $ancienDerniercontrat;
        }
        //meme traitement que pour le mail
        if($this->_statutAllocataire == ""){
            $this->_statutAllocataire = $ancienSattutAlloc;
        }
        //meme traitement que pour le mail
        if($this->_niveauEtude == ""){
            $this->_niveauEtude = $ancienNiveauEtude;
        }
        //meme traitement que pour le mail
        if($this->_reconnuEnFrance == ""){
            $this->_reconnuEnFrance = $ancienReconnuFrance;
        }
        //meme traitement que pour le mail
        if($this->_niveauMaitrisefrancais == ""){
            $this->_niveauMaitrisefrancais = $ancienMaitriseFrancais;
        }
        //meme traitement que pour le mail
        if($this->_couvertureSocial == ""){
            $this->_couvertureSocial = $anciencouvertureSocial;
        }
        //meme traitement que pour le mail
        if($this->_logement == ""){
            $this->_logement= $ancienLogement;
        }
        //meme traitement que pour le mail
        if($this->_nbChild == ""){
            $this->_nbChild= $ancienNbEnfants;
        }
        //meme traitement que pour le mail
        if($this->_situationFamilial == ""){
            $this->_situationFamilial= $ancienneSituationF;
        }
        //meme traitement que pour le mail
        if($this->_autreStructure == ""){
            $this->_autreStructure= $ancienneAutreStructure;
        }
        //meme traitement que pour le mail
        if($this->_dateOuverture == ""){
            $this->_dateOuverture= $ancienDateOuverture;
        }
        //preparation de la requete de maj des infos_complementaires
        $query = $db->prepare("UPDATE infos_complementaires SET placeOfBirth=:placeOfBirth, nativeCountry=:nativeCountry,
        driverSLicense=:driverSLicense,adress=:adress,phoneNumber=:phoneNumber,mail=:mail,ville=:ville,numero_reference=:numero_reference,
        IDPE=:IDPE,RQTH=:RQTH, codePostal=:codePostal, ville=:ville, reference=:reference, conseiller=:conseiller,
         allocataireTravail=:allocataireTravail, dateTravail=:dateTravail, heureMensuelle=:heureMensuelle, dejaTravailler=:dejaTravailler,
         dernierContrat=:dernierContrat,statutAllocataire=:statutAllocataire, niveauEtude=:niveauEtude, reconnuEnFrance=:reconnuEnFrance,
          maitriseFrancais=:maitriseFrancais, couvertureSocial=:couvertureSocial,logement=:logement,nb_enfants=:nbChild,situation_familial=:situationF,
          autre_structure=:autreStructure,date_ouverture=:dateOuverture WHERE allocataireNumber = :info");
        //execution de la requete avec en parametre un tableau qui contient les attributs de l'instance d'AdditionnalInfos
        $query->execute(array(
            'placeOfBirth'=>$this->_placeOfBirth,
            'nativeCountry'=>$this->_nativeCountry,
            'driverSLicense'=>$this->_driverLicense,
            'adress'=>$this->_adress,
            'phoneNumber'=>$this->_phoneNumber,
             'mail'=>$this->_mail,
             'numero_reference'=>$this->_referenceNumber,
             'IDPE'=>$this->_IDPE,
             'RQTH'=>$this->_RQTH,
             'codePostal'=>$this->_codePostal,
             'ville'=> $this->_ville,
             'reference'=>$this->_reference,
             'conseiller'=>$this->_conseiller,
             'allocataireTravail'=>$this->_allocataireTravail,
             'dateTravail'=>$this->_dateTravail,
             'heureMensuelle'=>$this->_heureMensuelle,
             'dejaTravailler'=>$this->_dejaTravailler,
             'dernierContrat'=>$this->_dernierContrat,
             'statutAllocataire'=>$this->_statutAllocataire,
             'niveauEtude'=>$this->_niveauEtude,
             'reconnuEnFrance'=>$this->_reconnuEnFrance,
             'maitriseFrancais'=>$this->_niveauMaitrisefrancais,
             'couvertureSocial'=>$this->_couvertureSocial,
             'logement'=>$this->_logement,
             'nbChild'=>$this->_nbChild,
             'situationF'=>$this->_situationFamilial,
             'autreStructure'=>$this->_autreStructure,
             'dateOuverture'=>$this->_dateOuverture,
             'info'=>$info
        ));
    }
}
?>