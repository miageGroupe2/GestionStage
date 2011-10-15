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
    public static function authentification($login, $password) {

        BD::getConnection();
        $login = mysql_real_escape_string(htmlspecialchars($login));
        $password = mysql_real_escape_string(htmlspecialchars($password));

        if ($login != FALSE && $password != FALSE) {

            $requete = "SELECT login FROM Utilisateur WHERE login = '$login' AND password = '$password' ";

            try {
                $retour = mysql_query($requete);
            } catch (Exception $e) {
                echo "erreur lors de l'authentification :" . $e;
            }

            $nombreDeLignes = mysql_num_rows($retour);

            if ($nombreDeLignes > 0) {

                return TRUE;
            } else {

                return FALSE;
            }
        }
    }
    
    public static function ajouterPropositionStage($nom, $prenom, $promotion, $adresseEntreprise){
        
        
    }

}

?>
