<?php
/**
 * class commonTraitement
 */
final class CommonTraitement{
    /**
     * fonction de verification de l'existence de l'id de l'utilisateur
     *
     * @param [int] $IdUser
     * @return bool
     */
    public static function verifExistId($IdUser){
        //connexion a la bdd
        $dbi = Singleton::getInstance();
        $connexion=$dbi->getConnection();
        //requete d'affichage de l'utilisateur en fonction de l'id
        $sql="SELECT * from utilisateur where email like '".$IdUser."'";
        $req=$connexion->query($sql);
        $resultat=$req->fetch();
        //is resultat n'existe pas renvoi d'une erreur utilisateur inconnu
        if(!$resultat){
            $_GET['erreur']='Utilisateur inconnu.';
            header('Location: ../Views/resetMdp.php?erreur=4');
        }
        else{
            return true;
        }
    }
/**
 * fonction de création de l'url
 *
 * @param [int] $IdUser
 * @return string
 */
    public static function createUrl($IdUser){
        $dbi = Singleton::getInstance();
        $connexion=$dbi->getConnection();
        //instanciation de $i a 0 et str a vide
        $i=0;
        $str='';
        //tant que i est inferieur a 20
        while($i<20){
            //$a sera egale a 1 ou 0
            $a=rand(0,1);
            //si a = 1
            if($a==1){
                //b= a un chiffre random compris entre 65 et 90
                $b=rand(65,90);
            }
            //sinon b = un chiffre random compris entre 97 et 122
            else{
                $b=rand(97,122);
            }
            //str = a un character specifique dependant de la valeur de b
            $str.=chr($b);
            //incrementation de i
            $i++;
        }
        $sql='UPDATE utilisateur set changeMdp="'.$str.'" where email like "'.$IdUser.'"';
        $req=$connexion->query($sql);
        $url= "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $url=substr_replace($url,'Views/updateMdp.ph',-32,-1).'?email='.$IdUser;
        
        return $url;
        }
        public static function envoyerEmail($IdUser,$url){
            $dbi = Singleton::getInstance();
            $connexion=$dbi->getConnection();
            $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
            
            $destinataires=$IdUser;
            
            $Sujet="mot de passe oublié";
            
            // type de contenu HTML
            $entetes = "Content-type: text/html; charset=utf-8\n";
            
            $message = '<p>Bonjour <p><br>
            
            <p>Nous avons recu une demande de modification de mot de passe pour le compte associé à cette adresse mail. Veuillez cliquer sur le lien ci dessous:</p>
            
            <a href="'.$url.'">'.$url.'</a>
            
            <p>Si vous n\'êtes pas à l\'origine de cette demande, ignorez cet e-mail, la sécurité de votre compte est préservée.<br><br>
            
            A très bientot sur CerGa.</p>';
            
            mail($destinataires, $Sujet, $message, $entetes, $headers);
            
        }
        public static function verifDemandeModif($IdUser){
            $dbi = Singleton::getInstance();
            $connexion=$dbi->getConnection();
            $sql="SELECT * from utilisateur where changeMdp like '".$IdUser."'";
            $req=$connexion->query($sql);
            $resultat=$req->fetch();
            if(!$resultat){
                $_SESSION['erreur']='Demande de modification inexistante.';
                header('Location: ../index.php');
            }
            else{
                return true; 
            }
        }

        public static function recupId($IdUser){
            $dbi = Singleton::getInstance();
            $connexion=$dbi->getConnection();
            $sql='SELECT email from utilisateur where changeMdp like "'.$IdUser.'"';
            $req=$connexion->query($sql);
            $resultat=$req->fetch();
            return $resultat['email'];
        }

        public static function updateMdp($idUser,$mdpUser,$cMdp){
            $dbi = DbSingleton::getInstance();
            $connexion=$dbi->getConnection();
                    
            $sql3="SELECT * from utilisateur where email='$idUser'";
            $req3=$connexion->prepare($sql3);
            $reponse3=$req3->execute(array('idUser'=>$idUser));
            //pointer sur la première colonne 
            $resultat= $req3 ->fetch();
            if(!$resultat){
                //Affichage d'un message d'erreur si l'identifiant ou le motPasse est incorrecte
                $_SESSION['erreur']='impossible de mettre à jour un utilisateur inconnu !!';
                header('Location: ../index.php');
            }else{
                if($mdpUser==$cMdp){
                    $sql="UPDATE utilisateur SET password='$mdpUser' WHERE email='$idUser'";
                    $req=$connexion->prepare($sql);
                    //execution de la rqt avec eregistrement de resulat de la variable $reponse
                    $reponse=$req->execute(array('idUser'=>$idUser,'mdpUser'=>$mdpUser));
                    if(!$reponse){
                        $_SESSION['erreur']='Mot de passe invalide';
                        header('Location: ../view/updateMdp.php');
                    }else{
                        self::resetModifMdp($idUser);
                        $_SESSION['success']='Modification effectuée, vous pouvez vous connecter';
                        header('Location: ../index.php');   
                    }
                }
                else{
                    $_SESSION['erreur']='Champs de vérification différent du champ de mot de passe.';
                    header('Location: ../view/updateMdp.php?id='.$idUser);
                }
            }
        }
    
    
}
?>