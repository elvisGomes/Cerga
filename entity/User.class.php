<?php 
include_once "singleton.class.php";
/**
 * class User
 * 
 * @author Clément Broucke / Mehdi Nasri
 */
class User {
    private $_name,
            $_firstName,
            $_email,
            $_password,
            $_phone,
            $_status,
            $_role;
            /**
             * construct function
             *
             * @param [type] $email
             * @param [type] $password
             */
        public function __construct(string $email,string $password){
            $this->_email = $email;
            $this->_password = $password;
        }
        /**
         * connect function
         * permet de verfier sur l'email est le mot de passe sont bon pour se connecté
         * @return bool
         */
        public function connect(){
            //connexion a la bdd
            $dbi = Singleton::getInstance();
            $db=$dbi->getConnection();
            //requete d'affichage des données de la table utilisateur
            $resultat = $db->query('SELECT * from utilisateur');
            //cpt a 0
            $cpt=0;
            //pour chaque valeur de $resultat
            foreach($resultat as $line){
                //si l'email de l'objet ET le password sont egales a celle de la bdd on incremente cpt
            if($this->_email == $line['email'] && $this->_password == $line['password']){
                $cpt++;
                }
            }
            //si cpt = 1 on retourne true
            if ($cpt==1){
                return true;
            }
            //sinon faux
            else {
                return false;
            }
                }

                /**
                 * checkEmail function
                 *verifie si l'email est dans la base de donnée
                 * @return bool
                 */
        public function checkEmail(){
            $dbi = Singleton::getInstance();
            $db=$dbi->getConnection();
            //recuperation des email de la table utilisateur
            $resultat = $db->query('SELECT email from utilisateur');
            //instanciation de i a 0
            $i=0;
            //pour chaque valeur de resultat on les entre dans un tableau $arr
            foreach($resultat as $row){
                $i++;
                $arr[$i] = $row['email'];
            }
            //si on trouve l'adresse mail de l'instance de l'objet dans $arr on retourne vrai sinon faux
            if(in_array($this->_email,$arr)){
                return true;
            }
            else{
                return false;
            }
        }
            /**
             * changePwd function
             * changement de mot de passe
             * @param [type] $pwd
             * @return void
             */
        public function changePwd($pwd){
            $dbi = Singleton::getInstance();
            $db=$dbi->getConnection();
            //preparation de la requete de changement de mot de passe
            $req = $db->prepare('UPDATE utilisateur SET password = :nvpassword WHERE email = :email && status != 2');
            //execution de la requete avec en parametre le nouveau mot de passe et l'email
            $req->execute(array(
                'nvpassword' => $pwd,
                'email' => $this->_email
                ));
            $this->_password = $pwd;
        }
        /**
         * fonction de reset du mdp
         *
         * @param [string] $pwd
         * @param [string] $email
         * @return bool
         */
        public function resetMdp($pwd,$email){
            $dbi = Singleton::getInstance();
            $db=$dbi->getConnection();
            //preparation de la requete de changement de mot de passe
            $req = $db->prepare('UPDATE utilisateur SET password = :nvpassword WHERE email = :email && status != 2');
            //execution de la requete avec en parametre le nouveau mot de passe et l'email
            $req->execute(array(
                'nvpassword' => $pwd,
                'email' => $email
                ));
            $this->_password = $pwd;
        }
        /**
         * inscription function
         * permet d'inscrire utilisateur
         * @param [type] $name
         * @param [type] $firstName
         * @param [type] $phone
         * @param [type] $email
         * @param [type] $password
         * @return void
         */
        public function inscription($name,$firstName,$phone,$email,$password){
            $dbi = Singleton::getInstance();
            $db=$dbi->getConnection();
            //requete de creation de l'utilisateur
            $query = $db->prepare("INSERT INTO  utilisateur (email,password,nom,prenom,telephone,role,status) 
            VALUES (:email, :password , :name, :firstName , :phone, 'ADMIN',1)");
            $reponse = $query->execute(array(
                'email' => $email,
                'password' => $password,
                'name' => $name,
                'firstName' => $firstName,
                'phone' => $phone
            ));
            return $reponse;
        }

        /**
         * checkStatus function
         * permet de verifier le status de l'utilisateur (0 ou 1)
         * @return bool
         */
        public function checkStatus(){
            $dbi = Singleton::getInstance();
            $db=$dbi->getConnection();
            //requete d'affichage des status en fonction de l'email
            $resultat = $db->query("SELECT status from  utilisateur where email='$this->_email'");
            //retourne un tableau 
            $arr = $resultat->fetchall(PDO::FETCH_COLUMN);
            //si ce tableau a l'index0 est different de 0 on retourne true sinon false
            if($arr[0] != 0){
                return true;
            }
            else{
                return false;
            }
        }
            /**
             * Get the value of _email
             */ 
            public function get_email()
            {
                        return $this->_email;
            }

            /**
             * Set the value of _email
             *
             * @return  self
             */ 
            public function set_email($_email)
            {
                        $this->_email = $_email;

                        return $this;
            }

            /**
             * Get the value of _password
             */ 
            public function get_password()
            {
                        return $this->_password;
            }

            /**
             * Set the value of _password
             *
             * @return  self
             */ 
            public function set_password($_password)
            {
                        $this->_password = $_password;

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
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //requete d'affichage du prenom de l'utilisateur
        $resultat = $db->query("SELECT prenom from utilisateur where email='$this->_email'");
        //retourne un tableau
        $arr = $resultat->fetchall(PDO::FETCH_COLUMN);
        $firstname=$arr[0];
        return $this->_firstName = $firstname;
    }
/**
 * fonction d'affichage du nom et prenom de l'utilisateur
 *
 * @return void
 */
    public function getFullName()
    {
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //requete d'affichage du nom et prenom 
        $resultat = $db->query("SELECT nom,prenom from utilisateur where  nom like '" . $_POST["keyword"] . "%' ORDER BY name Limit 5");
        //retourne un tableau
        $arr = $resultat->fetchall(PDO::FETCH_COLUMN);
        $firstname=$arr[0];
        return $this->_firstName.' '.$this->_name = $firstname;
    }
    /**
     * fonction d'affichage des données de l'utilisateur en fonction de l'email
     *
     * @return void
     */
    public function getUser(){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //preparation de la requete d'affichage des events dont le status est de 0
        $query = $db->prepare("SELECT * from utilisateur WHERE email=:email and status != 0");
        //execution de la requete préparé
        $query->execute(array(
            'email'=>$this->_email,
            ));
            //on fetch le resultat et on le retourne 
            $results = $query->fetchall(PDO::FETCH_ASSOC);
            return $results;
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
     * Get the value of _phone
     */ 
    public function get_phone()
    {
                return $this->_phone;
    }

    /**
     * Set the value of _phone
     *
     * @return  self
     */ 
    public function set_phone($_phone)
    {
                $this->_phone = $_phone;

                return $this;
    }

    /**
     * Get the value of _status
     */ 
    public function get_status()
    {
                return $this->_status;
    }

    /**
     * Set the value of _status
     *
     * @return  self
     */ 
    public function set_status($_status)
    {
                $this->_status = $_status;

                return $this;
    }

    /**
     * Get the value of _role
     */ 
    public function get_role()
    {
                return $this->_role;
    }

    /**
     * Set the value of _role
     *
     * @return  self
     */ 
    public function set_role($_role)
    {
                $this->_role = $_role;

                return $this;
            }
            /**
             * fonction d'affichage de l'email de l'user actif
             *
             * @return array
             * 
             * @author Clément Broucke
             */
    public function displayUser(){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        $query = $db->prepare("SELECT DISTINCT email from utilisateur where status != 0");
        $query->execute();
        $result = $query->fetchall(PDO::FETCH_ASSOC);
        return $result;
    }

     /**
     * changePwd function
     * changement de mot de passe de l'admin
     * @param [string] $pwd
     * @return void
     */
    public function changePwdAdmin($pwd){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //preparation de la requete de maj de l'utilisateur 
        $req = $db->prepare('UPDATE utilisateur SET password = :nvpassword WHERE email = :email && status = 2');
        $req->execute(array(
            'nvpassword' => $pwd,
            'email' => $this->_email
            ));
        $this->_password = $pwd;
    }
    /**
     * fonction qui insert dans la table historique un historique de la connexion , ip/hostname/email et heure de connexion
     *
     * @return void
     * 
     */
    public function historique(){
        $dbi = Singleton::getInstance();
        $db=$dbi->getConnection();
        //date & heure locale 
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fra_fra');
        //date au format français
        $temps = date("Y-m-d H:i:s");
        //fonction de l'adresse IP
        $ip = $this->get_ip();
        $hostname = gethostbyaddr($ip);
        $email = $this->_email;

        $query = $db->prepare("INSERT INTO historique (date_connection, adresse_IP, poste, user) VALUES (:temps, :ip, :host, :email)");
        $query->execute(array(
            'temps'=>$temps,
            'ip'=> $ip,
            'host'=> $hostname,
            'email'=> $email
        ));
    }
    // Function to get the client ip address
    public function get_ip()
    {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
        $ip = $_SERVER['REMOTE_ADDR'];
        }
    return $ip;
    }
}
?>