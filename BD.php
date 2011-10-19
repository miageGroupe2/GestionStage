<?php

require_once RACINE_MODELE . 'ModeleEntreprise.php';
require_once RACINE_MODELE . 'ModeleStage.php';
require_once RACINE_MODELE . 'ModeleContact.php';

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

            $requete = "SELECT login FROM utilisateur WHERE login = '$login' AND password = '$password' ";

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

    /**
     * Permet de rechercher toutes les entreprises ayant le pattern $nom dans 
     * leur nom
     * @param type $nom 
     */
    public static function rechercherEntreprise($nom) {

        BD::getConnection();
        $nom = mysql_real_escape_string(htmlspecialchars($nom));
        $tabEntreprise = null;

        if ($nom != FALSE) {

            $requete = "SELECT * FROM `entreprise` WHERE nomentreprise LIKE '%$nom%'";
            $retour = mysql_query($requete);

            $i = 0;
            while ($tableau = mysql_fetch_array($retour)) {

                $tabEntreprise[$i] = new ModeleEntreprise($tableau['identreprise'], $tableau['nomentreprise'], $tableau['adresseentreprise'], $tableau['villeentreprise'], $tableau['paysentreprise'], $tableau['numerotelephone'], $tableau['numerosiret'], $tableau['urlsiteinternet']);
                $i++;
            }
        }
        return $tabEntreprise;
    }

    public static function ajouterEntreprise($nom, $adresse, $ville, $pays, $numeroTel, $numeroSiret, $urlSiteInternet) {

        BD::getConnection();
        $nom = mysql_real_escape_string(htmlspecialchars($nom));
        $adresse = mysql_real_escape_string(htmlspecialchars($adresse));
        $ville = mysql_real_escape_string(htmlspecialchars($ville));
        $pays = mysql_real_escape_string(htmlspecialchars($pays));
        $numeroTel = mysql_real_escape_string(htmlspecialchars($numeroTel));
        $numeroSiret = mysql_real_escape_string(htmlspecialchars($numeroSiret));
        $urlSiteInternet = mysql_real_escape_string(htmlspecialchars($urlSiteInternet));

        if ($nom != FALSE && $adresse != FALSE
                && $ville != FALSE && $pays != FALSE
                && $numeroTel != FALSE && $numeroSiret != FALSE
                && $urlSiteInternet != FALSE) {

            $requete = "INSERT INTO entreprise (nomentreprise, adresseentreprise, villeentreprise, paysentreprise, numerotelephone, numerosiret, urlsiteinternet) 
                VALUES ('$nom', '$adresse', '$ville', '$pays', '$numeroTel', '$numeroSiret, '$urlSiteInternet')";

            mysql_query($requete);
        }
    }

    /**
     * Permet d'obtenir tous les contacts d'une entreprise 
     * @param type $idEntreprise 
     */
    public static function rechercherContactParEntreprise($idEntreprise) {

        BD::getConnection();
        $idEntreprise = mysql_real_escape_string(htmlspecialchars($idEntreprise));
        $tabContact = null;
        $i = 0 ;
        if ($idEntreprise != FALSE) {

            $requete = "SELECT idcontact, prenomcontact, nomcontact, fonctioncontact, 
            telephonefixecontact, telmobilecontact, mailcontact FROM contact WHERE identreprise = $idEntreprise ";
            
            $retour = mysql_query($requete);
            
            while ($tableau = mysql_fetch_array($retour)) {

                $tabContact[$i] = new ModeleContact($tableau['idcontact'], $tableau['prenomcontact'], $tableau['nomcontact'], $tableau['fonctioncontact'], $tableau['telephonefixecontact'], $tableau['telmobilecontact'], $tableau['mailcontact']);
                $i++;
            }
        }

        return $tabContact;
    }

    public static function ajouterContact($identreprise, $nom, $prenom, $fonction, $telephoneFixe, $telephoneMobile, $mail) {

        $idEntreprise = mysql_real_escape_string(htmlspecialchars($idEntreprise));
        $nom = mysql_real_escape_string(htmlspecialchars($nom));
        $prenom = mysql_real_escape_string(htmlspecialchars($prenom));
        $fonction = mysql_real_escape_string(htmlspecialchars($fonction));
        $telephoneFixe = mysql_real_escape_string(htmlspecialchars($telephoneFixe));
        $telephoneMobile = mysql_real_escape_string(htmlspecialchars($telephoneMobile));
        $mail = mysql_real_escape_string(htmlspecialchars($mail));

        if ($idEntreprise != FALSE && $nom != FALSE
                && $prenom != FALSE && $fonction != FALSE
                && $telephoneFixe != FALSE && $telephoneMobile != FALSE
                && $mail != FALSE) {


            $requete = "INSERT INTO contact (identreprise, prenomcontact, nomcontact, fonctioncontact,
                dateajout, datederniereactivite, telephonefixecontact, telmobilecontact, mailcontact) 
                VALUES ('$idEntreprise', '$prenom', '$nom', '$fonction', 'CURDATE()', 'CURDATE()', '$telephoneFixe', '$telephoneMobile', '$mail')";

            mysql_query($requete);
        }
    }

    public static function ajouterPropositionStage($nom, $prenom, $promotion, $sujet) {
        
    }

    /**
     * Permet d'afficher toutes les propositions de stage
     */
    public static function recherherToutesPropositions() {
        BD::getConnection();
        $i=0;
        $tabStage = null;
        $requete = "SELECT stage.idstage, entreprise.nomentreprise, stage.identreprise, stage.nometudiant, stage.prenometudiant, entreprise.nomentreprise FROM stage, entreprise  WHERE stage.identreprise = entreprise.identreprise";
        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {
            $tabStage[$i] = new ModeleStage($tableau['idstage'], $tableau['identreprise'],  $tableau['nomentreprise'], null, $tableau['nometudiant'], $tableau['prenometudiant'], null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            $i++;
        }
        return $tabStage;
    }

        /**
     * Permet d'afficher toutes les propositions de stage
     */
    public static function rechercherProposition($id) {
        BD::getConnection();
        $i=0;
        $tabStage = null;
        $requete = "SELECT stage.idstage, stage.identreprise, entreprise.nomentreprise, stage.idcontact, stage.nometudiant, stage.prenometudiant, stage.promotion, stage.datedeproposition, stage.sujetstage, stage.datevalidation, stage.datedebut, stage.datefin, stage.datesoutenance, stage.lieusoutenance, stage.etatstage, stage.noteobtenue, stage.appreciationobtenue, stage.remuneration, stage.embauche, stage.dateembauche FROM stage, entreprise  WHERE stage.identreprise = entreprise.identreprise AND stage.idstage = ".$id;
        $retour = mysql_query($requete) or die(mysql_error());
        
        while ($tableau = mysql_fetch_array($retour)) {
            $tabStage[$i] = new ModeleStage($tableau['idstage'], $tableau['identreprise'],  $tableau['nomentreprise'], $tableau['idcontact'], $tableau['nometudiant'], $tableau['prenometudiant'], $tableau['promotion'], $tableau['datedeproposition'], $tableau['sujetstage'], $tableau['datevalidation'], $tableau['datedebut'], $tableau['datefin'], $tableau['datesoutenance'], $tableau['lieusoutenance'], $tableau['etatstage'], $tableau['noteobtenue'], $tableau['appreciationobtenue'], $tableau['remuneration'], $tableau['embauche'], $tableau['dateembauche']);
            $i++;
        }

        return $tabStage;
    }
    
    /**
     * Permet de valider un stage, c'est à dire de passer son état à "validé"
     * @param type $idStage 
     */
    public static function validerStage($idStage) {

        BD::getConnection();
        $idStage = mysql_real_escape_string(htmlspecialchars($idStage));

        if ($idStage != FALSE) {

            $requete = "UPDATE stage SET etatstage = 'valide' WHERE idstage = '$idStage'";
            mysql_query($requete);
        }
    }

}

?>
