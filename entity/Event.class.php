<?php
include_once 'singleton.class.php';
include_once 'Diary.class.php';
/**
 * class Event qui affiche les rendez vous et les fins de CER
 * 
 * @author Clement Broucke, Mehdi Nasri
 */
class Event{
    private $_id,
            $_description,
            $_status = 0;
/**
 * fonction d'initialisation de la class Event, requis uniquement la description de l'event
 *
 * @param [string] $description
 * 
 */
    public function __construct(string $description){
        $this->_description = $description;
    }
/**
 * fonction qui insere les rendez vous et les fins de CER dans la table Event
 *
 * @param [string] $email
 * @return bool
 */
    public function insertEvent($email){
        //on recupere une instance de la bdd projetafpa
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //instanciation de la class Diary
        $notif = new Diary("","","");
        //On recupere les rendez vous en cours via l'email de l'utilisateur
        $arr = $notif->viewTodayEvents($email);
        //on instancie les tableaux rdv, cer, tabDate et tabTime, ainsi que la variable j a 0
        $rdv = array();
        $tabDate = array();
        $tabTime = array();
        $j = 0 ;
        //verification si arr est vide ou null
        if(!empty($arr) || !is_null($arr)){
            //on reformate les dates des rendez vous pour recuperer l'heure uniquement
            for($i=0; $i<sizeof($arr);$i++) 
                {
                $tabDate[$i] = date_create($arr[$i]['start']);
                $tabTime[$i] = $tabDate[$i]->format('H\hi');
                }
                //formatage de la date uniquement, au format européen
            for($i=0; $i<sizeof($arr); $i++){
                $dt[$i] = DateTime::createFromFormat('Y-m-d H:i:s', $arr[$i]['start']);
                $date[$i] = $dt[$i]->format('d/m/Y');
                $rdv[$i] = $arr[$i]['title']. " le " . $date[$i] . " à <strong>".$tabTime[$i]."</strong>";
            }
            //verification si rdv est vide
            if(!empty($rdv)){
                //boucle pour inserer les rendez vous de rdv vers Event
                for($i=0;$i<sizeof($rdv);$i++){
                    //preparation de la requete
                    $query = $db->prepare("INSERT INTO event (event,status, email) VALUES (:rdv,0, :email)");
                    //execution de la requete 
                    $query->execute(array(
                        'rdv' => $rdv[$i],
                        'email'=> $email
                    ));
                }
            }
        }
        
    }

    public function insertCer(){
        //on set la timezone sur l'heure de Paris, 
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
        //on crée une variable twoweeks qui est la date d'aujourd'hui + 14 days
        $twoWeeks = strftime('%A %d %B %Y.', strtotime('+14 days'));
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //instanciation de la class Diary
        $notif = new Diary("","","");
        //on recupere les cer qui se terminent dans 2 semaines
        $arrCer = $notif->viewCer();
        $cer = array();
        $j = 0 ;
        if(!empty($arrCer) || !is_null($arrCer)){
            foreach($arrCer as $value){
                $cer[$j] = "Le <strong>CER</strong> de "."<strong>".$value['name'] ."</strong>". "." ."<strong>". $value['firstName'] .",</strong>"." N° Allocataire : "."<strong>" .$value['allocataireNumber'] ."</strong>"." se termine le " . $twoWeeks;
                $j++;
            }
            if(!empty($cer)){
                for($i=0;$i<sizeof($cer);$i++){
                    $query = $db->prepare("INSERT INTO event (event,status, email) VALUES (:cer,0, null)");
                    $query->execute(array(
                        'cer' => $cer[$i]
                    ));
                }
            }
        }
    }

    /**
     * fonction qui affiche les event 
     *
     * @return 
     * 
     */
    public function displayEvent($email){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //preparation de la requete d'affichage des events dont le status est de 0
        $query = $db->prepare("SELECT ID_event,event from event WHERE (email=:email or ISNULL(email)) and status =0 LIMIT 10");
        //on execute la requete préparé
        $query->execute(array(
            'email'=>$email

        ));
        //on fetch le resultat et on le retourne 
        $results = $query->fetchall(PDO::FETCH_ASSOC);
        return $results;
    }
/**
 * fonction de mise a jour du status 
 *
 * @param [int] $id
 * @return void
 */
    public function updateStatus(int $id){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //preparation de la requete de maj du status
        $query = $db->prepare("UPDATE event SET status=1 WHERE ID_event = :id");
        //execution de la requete
        $query->execute(array(
            'id' => $id
        ));
    }
}
?>