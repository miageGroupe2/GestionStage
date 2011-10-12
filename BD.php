<?php

class BD {

    private static $connection;

    private static function getConnection() {

        if (isset(self::$connection)) {
            return self::$connection;
        } else { 
            self::$connection = mysql_connect("localhost", "root", "admin") or die("Erreur de connection à la BD");
            mysql_select_db("GestionStage");
            return self::$connection;
        }
    }

    
    
//    public static function executeReq($r) {
//
//        Connexion::getConnexion();
//        $var = null;
//        try {
//            $var = mysql_query("$r");
//        } catch (Exception $e) {
//            echo "erreur";
//        }
//        return $var;
//    }
//
//    public static function estConnecte() {
//        session_start();
//        $connecte = false;
//        if (isset($_SESSION['logge'])) {
//            if ($_SESSION['logge'] == 1) {
//                $connecte = true;
//            }
//        }
//        return $connecte;
//    }
//
//    public static function seDeconnecter() {
//        if (isset($_SESSION['logge'])) {
//            session_destroy();
//        }
//    }
    
    /**
     * Permet de vérifier que l'utilisateur existe dans la base
     * @param type $login
     * @param type $password
     * @return type TRUE si le couple login/password est correct, false sinon
     */
    public static function authentification($login, $password){
        
        BD::getConnection();
        $login = mysql_real_escape_string($login);
        $password = mysql_real_escape_string($password);
        
        if ($login != FALSE && $password != FALSE){
            
            $requete = "SELECT login FROM Utilisateur WHERE login = '$login' AND password = '$password' ";
            
            try{
                $retour = mysql_query($requete);
                
            }catch (Exception $e){
                echo "erreur :".$e ;
            }
            
            
            
           $nombreDeLignes = mysql_num_rows($retour);
            
            if ($nombreDeLignes > 0){
                
                return TRUE ;
            }else{
                
                return FALSE ;
            }
        }
    }

}

?>
