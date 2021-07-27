<?php
include_once "singleton.class.php";
/**
 * 
 * Instanciation de la class item social = item sociaux
 * 
 */
class socialItem
{
    private $_socialType;
    private $_other;
    private $_cafNumber; 
    private $_commentSante;
    private $_commentAdmin;
    private $_commentLogement;
    private $_commentGarde;
    private $_commentAide;
    private $_commentTransport;
    private $_commentLecture;
    private $_commentFormation;
    private $_commentLien;

    /**
     * 
     * Initialisation de la class item sociaux
     * 
     */
    public function __construct($social, $other, $numAllocataire, $commSante, $commAdmin, $commLogement, $commGarde, $commAide, $commTransport, $commLecture, $commFormation, $commLien)
    {
        $this->_socialType = $social;
        $this->_other = $other;
        $this->_cafNumber = $numAllocataire;
        $this->_commentSante = $commSante;
        $this->_commentAdmin = $commAdmin;
        $this->_commentLogement = $commLogement;
        $this->_commentGarde = $commGarde;
        $this->_commentAide = $commAide;
        $this->_commentTransport = $commTransport;
        $this->_commentLecture = $commLecture;
        $this->_commentFormation = $commFormation;
        $this->_commentLien = $commLien;
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
     * 
     * Fonction pour ajouter des item sociaux
     * 
     */
    public function addAid()
    {
        //connexion a la bdd
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //preparation de la requete d'insertion des items sociaux 
        $item = $db->prepare("INSERT INTO `item_sociaux`(`socialType`, `autre`,`comment_sante`,`comment_administratif`,`comment_logement`,`comment_garde`,`comment_aide`,`comment_transport`,`comment_lecture`,`comment_formation`,`comment_lien`,`allocataireNumber`)
        VALUES (:social, :autre, :sante, :admin, :logement, :garde, :aide, :transport, :lecture, :formation, :lien, :allocNumber)");
        //execution de cette requete en parametre les valeurs a inserer en bdd
        $reponse = $item->execute(array(
            'social'=>$this->_socialType,
            'autre'=>$this->_other,
            'sante'=>$this->_commentSante,
            'admin'=>$this->_commentAdmin,
            'logement'=>$this->_commentLogement,
            'garde'=>$this->_commentGarde,
            'aide'=>$this->_commentAide,
            'transport'=>$this->_commentTransport,
            'lecture'=>$this->_commentLecture,
            'formation'=>$this->_commentFormation,
            'lien'=>$this->_commentLien,
            'allocNumber'=>$this->_cafNumber,
        ));
        //retourne un booleen
        return $reponse;
    }
    /**
     * Get the value of _socialType
     */ 
    public function get_socialType()
    {
        return $this->_socialType;
    }

    /**
     * Set the value of _socialType
     *
     * @return  self
     */ 
    public function set_socialType($_socialType)
    {
        $this->_socialType = $_socialType;

        return $this;
    }
    /**
     * fonction de maj des items sociaux
     *
     * @param [int] $info
     * @return bool
     */
public function updateSocialItem($info){
    $dbi = Singleton::getInstance();
    $db=$dbi->getConnection();
    //requete d'affichage des items sociaux en fonction de l'Id
    $arr = $db->query("SELECT socialType, autre,`comment_sante`,`comment_administratif`,`comment_logement`,`comment_garde`,`comment_aide`,`comment_transport`,`comment_lecture`,`comment_formation`,`comment_lien` FROM item_sociaux WHERE allocataireNumber = $info");
    //retourne un tableau associatif
    $ar = $arr->fetch();
    //si le tableau n'est pas vide on set les anciennes valeurs issues de la bdd 
    if(!empty($ar)){
        $ancienSocialType = $ar[0];
        $ancienAutre = $ar[1];
        $ancienCommentSante = $ar[2];
        $ancienCommentAdmin = $ar[3];
        $ancienCommentLogement = $ar[4];
        $ancienCommentGarde = $ar[5];
        $ancienCommentAide = $ar[6];
        $ancienCommentTransport = $ar[7];
        $ancienCommentLecture = $ar[8];
        $ancienCommentFormation = $ar[9];
        $ancienCommentLien = $ar[10];
    }
    //si socialType est vide on le set a l'ancienne valeur issu de la bdd
    if($this->_socialType == ""){
        $this->_socialType= $ancienSocialType;
    }
    //meme traitement que pour socialType
    if($this->_other == ""){
        $this->_other = $ancienAutre;
    }
    //meme traitement que pour socialType
    if($this->_commentSante == ""){
        $this->_commentSante = $ancienCommentSante;
    }
    //meme traitement que pour socialType
    if($this->_commentAdmin == ""){
        $this->_commentAdmin = $ancienCommentAdmin;
    }
    //meme traitement que pour socialType
    if($this->_commentLogement == ""){
        $this->_commentLogement = $ancienCommentLogement;
    }
    //meme traitement que pour socialType
    if($this->_commentGarde == ""){
        $this->_commentGarde = $ancienCommentGarde;
    }
    //meme traitement que pour socialType
    if($this->_commentAide == ""){
        $this->_commentAide = $ancienCommentAide;
    }
    //meme traitement que pour socialType
    if($this->_commentTransport == ""){
        $this->_commentTransport = $ancienCommentTransport;
    }
    //meme traitement que pour socialType
    if($this->_commentLecture == ""){
        $this->_commentLecture = $ancienCommentLecture;
    }
    //meme traitement que pour socialType
    if($this->_commentFormation == ""){
        $this->_commentFormation = $ancienCommentFormation;
    }
    //meme traitement que pour socialType
    if($this->_commentLien == ""){
        $this->_commentLien = $ancienCommentLien;
    }
    //preparation de la requete de maj des items sociaux
    $query = $db->prepare("UPDATE item_sociaux SET socialType=:socialType,autre=:autre,comment_sante=:comSante,comment_administratif=:comAdmin,comment_logement=:comLogement,comment_garde=:comGarde,comment_aide=:comAide,comment_transport=:comTransport,comment_lecture=:comLecture,comment_formation=:comFormation,comment_lien=:comLien 
    WHERE allocataireNumber = :info");
    //execution de la requete avec en parametre un tableau contenant les valeurs a inserer en bdd
    $query->execute(array(
        'socialType' => $this->_socialType ,
        'autre'=>$this->_other ,
        'comSante' =>$this->_commentSante,
        'comAdmin' =>$this->_commentAdmin,
        'comLogement' =>$this->_commentLogement,
        'comGarde' =>$this->_commentGarde,
        'comAide' =>$this->_commentAide,
        'comTransport' =>$this->_commentTransport,
        'comLecture' =>$this->_commentLecture,
        'comFormation' =>$this->_commentFormation,
        'comLien' =>$this->_commentLien,
        'info'=>$info
    ));
}
}
?>