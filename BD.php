<?php

class BD {

    private static $lien;

    public static function getConnexion() {

        if (isset(self::$lien)) {
            return self::$lien;
        } else { 
            Connexion::connect();
            return self::$lien;
        }
    }

    private static function connect() {

        self::$lien = mysql_connect("localhost", "root", "admin") or die("Erreur de connection à la BD");
        mysql_select_db("GestionStage");
    }

    public static function executeReq($r) {

        Connexion::getConnexion();
        $var = null;
        try {
            $var = mysql_query("$r");
        } catch (Exception $e) {
            echo "erreur";
        }
        return $var;
    }

    public static function estConnecte() {
        session_start();
        $connecte = false;
        if (isset($_SESSION['logge'])) {
            if ($_SESSION['logge'] == 1) {
                $connecte = true;
            }
        }
        return $connecte;
    }

    public static function seDeconnecter() {
        if (isset($_SESSION['logge'])) {
            session_destroy();
        }
    }

}

?>
