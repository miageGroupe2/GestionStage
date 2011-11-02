<?php

require_once RACINE_MODELE . 'ModeleEntreprise.php';
require_once RACINE_MODELE . 'ModeleStage.php';
require_once RACINE_MODELE . 'ModeleContact.php';
require_once RACINE_MODELE . 'ModeleUtilisateur.php';
require_once RACINE_MODELE . 'ModeleProposition.php';

class BD {

    //-----------------------------------------------------------------------------------------
    // PARTIE DES ACCES BASES COMMUNS A TOUS LESUTILISATEURS
    //-----------------------------------------------------------------------------------------

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

    /**
     * Permet de vérifier que l'utilisateur existe dans la base
     * @param type $login
     * @param type $password
     * @return type un modèleUtilisateur si l'authentification est OK, NULL sinon
     */
    public static function authentification($login, $password) {

        BD::getConnection();
        $login = mysql_real_escape_string(htmlspecialchars($login));
        $password = sha1(mysql_real_escape_string(htmlspecialchars($password)));

        if ($login != FALSE && $password != FALSE) {

            $requete = "SELECT idutilisateur, nompromotion, mailutilisateur, passwordutilisateur, nomutilisateur, prenomutilisateur, numetudiant, admin FROM utilisateur, promotion WHERE mailutilisateur = '$login' AND passwordutilisateur = '$password' AND  utilisateur.idpromotion = promotion.idpromotion";
            try {
                $retour = mysql_query($requete);
            } catch (Exception $e) {
                echo "erreur lors de l'authentification :" . $e;
            }

            $nombreDeLignes = mysql_num_rows($retour);

            if ($nombreDeLignes > 0) {

                $modeleUtilisateur = NULL;
                while ($tableau = mysql_fetch_array($retour)) {

                    $modeleUtilisateur = new ModeleUtilisateur($tableau['idutilisateur'], $tableau['nompromotion'], $tableau['numetudiant'], $tableau['prenomutilisateur'], $tableau['nomutilisateur'], $tableau['mailutilisateur'], $tableau['admin']);
                }

                return $modeleUtilisateur;
            } else {
                return NULL;
            }
        }
    }

//-----------------------------------------------------------------------------------------
    // PARTIE DES ACCES BASES UTILISATEUR
    //-----------------------------------------------------------------------------------------        

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

                $tabEntreprise[$i] = new ModeleEntreprise($tableau['identreprise'], $tableau['nomentreprise'], $tableau['adresseentreprise'], $tableau['villeentreprise'], $tableau['codepostalentreprise'], $tableau['paysentreprise'], $tableau['numerotelephone'], $tableau['numerosiret'], $tableau['urlsiteinternet']);
                $i++;
            }
        }
        return $tabEntreprise;
    }

    /**
     * Permet de rechercher l'entreprise ayant l'id passé en paramètre
     * @param type $id
     */
    public static function rechercherEntrepriseById($id) {

        BD::getConnection();
        $id = mysql_real_escape_string(htmlspecialchars($id));
        $entreprise = null;

        if ($id != FALSE) {

            $requete = "SELECT identreprise, nomentreprise, adresseentreprise, villeentreprise, codepostalentreprise, paysentreprise, numerotelephone, numerosiret, urlsiteinternet FROM entreprise WHERE identreprise=" . $id;
            $retour = mysql_query($requete);

            $i = 0;
            while ($tableau = mysql_fetch_array($retour)) {

                $entreprise[$i] = new ModeleEntreprise($tableau['identreprise'], $tableau['nomentreprise'], $tableau['adresseentreprise'], $tableau['villeentreprise'], $tableau['codepostalentreprise'], $tableau['paysentreprise'], $tableau['numerotelephone'], $tableau['numerosiret'], $tableau['urlsiteinternet']);
                $i++;
            }
            if ($i > 0) {

                return $entreprise[0];
            } else {

                return NULL;
            }
        }
        return NULL;
    }

    public static function ajouterEntreprise($nom, $numRue, $ville, $codePostal, $pays, $numeroTel, $urlSiteInternet) {

        BD::getConnection();
        $nom = mysql_real_escape_string(htmlspecialchars($nom));
        $numRue = mysql_real_escape_string(htmlspecialchars($numRue));
        $ville = mysql_real_escape_string(htmlspecialchars($ville));
        $codePostal = mysql_real_escape_string(htmlspecialchars($codePostal));
        $pays = mysql_real_escape_string(htmlspecialchars($pays));
        $numeroTel = mysql_real_escape_string(htmlspecialchars($numeroTel));
        $urlSiteInternet = mysql_real_escape_string(htmlspecialchars($urlSiteInternet));

        $idEntreprise = NULL;

        // on ne teste pas le site web car il peut être null (l' utilisateur n'est pas obligé de le renseigner)
        if ($nom != FALSE && $numRue != FALSE
                && $ville != FALSE && $pays != FALSE
                && $numeroTel != FALSE) {

            $requete = "INSERT INTO entreprise (identreprise, nomentreprise, adresseentreprise, villeentreprise, codepostalentreprise, paysentreprise, numerotelephone, urlsiteinternet) 
                VALUES ('', '$nom', '$numRue', '$ville', '$codePostal',  '$pays', '$numeroTel', '$urlSiteInternet')";

            mysql_query($requete) or die(mysql_error());
            // on récupère l'id de l'entreprise que l'on vient d'insérer
            $idEntreprise = mysql_insert_id();
        }

        return $idEntreprise;
    }

    /**
     * Permet d'obtenir tous les contacts d'une entreprise 
     * @param type $idEntreprise 
     */
    public static function rechercherContactParEntreprise($idEntreprise) {

        BD::getConnection();
        $idEntreprise = mysql_real_escape_string(htmlspecialchars($idEntreprise));
        $tabContact = null;
        $i = 0;
        if ($idEntreprise != FALSE) {

            $requete = "SELECT idcontact, prenomcontact, nomcontact, fonctioncontact, 
            telfixecontact, telmobilecontact, mailcontact FROM contact WHERE identreprise = $idEntreprise ";

            $retour = mysql_query($requete);

            while ($tableau = mysql_fetch_array($retour)) {

                $tabContact[$i] = new ModeleContact($tableau['idcontact'], $tableau['prenomcontact'], $tableau['nomcontact'], $tableau['fonctioncontact'], $tableau['telfixecontact'], $tableau['telmobilecontact'], $tableau['mailcontact']);
                $i++;
            }
        }

        return $tabContact;
    }

    public static function ajouterContact($identreprise, $nom, $prenom, $fonction, $telephoneFixe, $telephoneMobile, $mail) {

        BD::getConnection();
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

    public static function ajouterPropositionStage($idEntreprise, $sujetStage) {

        BD::getConnection();

        $idEntreprise = mysql_real_escape_string(htmlspecialchars($idEntreprise));
        $sujetStage = mysql_real_escape_string(htmlspecialchars($sujetStage));

        if ($idEntreprise != FALSE && $sujetStage != FALSE) {

            $modeleUtilisateur = $_SESSION['modeleUtilisateur'];
            $idUtilisateur = $modeleUtilisateur->getId();

            //avant d'insérer une proposition on vérifie que celle-ci n'existe pas dans la base
            //(pour empêcher les doublons suite à un F5 dans le navigateur, par exemple)
            $requete = "SELECT idproposition FROM proposition WHERE idutilisateur='$idUtilisateur' AND identreprise='$idEntreprise' AND sujetstagep='$sujetStage'";
            $retour = mysql_query($requete);

            $nombreDeLignes = mysql_num_rows($retour);

            if ($nombreDeLignes == 0) {

                $requete = "INSERT into proposition (idproposition, identreprise, idutilisateur, 
                    sujetstagep, etat, dateproposition, idstage) 
                    VALUES ('', '$idEntreprise', '$idUtilisateur', '$sujetStage', 'en attente', NOW(), NULL)";

                mysql_query($requete);
            } else {

                // il y a un doublon, donc on ne fait rien
            }
        }
    }

    /**
     * return true si $nom est le nom d'une entreprise dans la base, false sinon
     * @param type $nom
     * @return type 
     */
    public static function entrepriseExistante($nom) {

        BD::getConnection();
        $nom = mysql_real_escape_string(htmlspecialchars($nom));

        if ($nom != FALSE) {

            $i = 0;

            $requete = "SELECT nomentreprise FROM entreprise WHERE nomentreprise ='" . $nom . "'";
            $retour = mysql_query($requete);

            while ($tableau = mysql_fetch_array($retour)) {

                $i++;
            }

            if ($i > 0) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * Permet d'afficher toutes les propositions de stage de l'étudiant connecté
     */
    public static function rechercherPropositionsEtudiant() {
        BD::getConnection();
        $i = 0;
        $tabProp = null;
        $idUser = $_SESSION['modeleUtilisateur']->getId();
        $requete = "SELECT p.idproposition, p.nomentreprisep, p.dateproposition, p.adresseentreprisep, p.villeentreprisep, p.codepostalentreprisep, p.paysentreprisep, p.numerotelephonep, p.urlsiteinternetp, p.sujetstagep, p.etat
                        FROM proposition p
                        WHERE p.idutilisateur = " . $idUser . ";";
        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {
            $tabProp[$i] = new ModeleProposition($tableau['idproposition'], null, null, null, $tableau['nomentreprisep'], $tableau['dateproposition'], $tableau['adresseentreprisep'], $tableau['codepostalentreprisep'], $tableau['villeentreprisep'], $tableau['paysentreprisep'], $tableau['numerotelephonep'], $tableau['urlsiteinternetp'], $tableau['sujetstagep'], $tableau['etat'], null, null);
            $i++;
        }
        return $tabProp;
    }
    
    /**
     * Permet de savoir si un étudiant à le droit d'éditer une proposition de stage
     * (c'est à dire si la proposition de stage $idProposition correspond à une de ses propositions)
     * @param type $idProposition 
     */
    public static function autorisationEditerProposition($idProposition){
        
        BD::getConnection();
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));
        
        if ($idProposition != FALSE) {
        
            $requete = "SELECT * FROM proposition WHERE idproposition='$idProposition";
        }
    }

    //-----------------------------------------------------------------------------------------
    // PARTIE DES ACCES BASES ADMIN
    //-----------------------------------------------------------------------------------------    

    /**
     * Permet d'afficher toutes les propositions de stage
     */
    public static function rechercherToutesPropositions() {
        BD::getConnection();
        $i = 0;
        $tabProp = null;
        
        $entreprise = NULL ;
        $requete = "SELECT identreprise FROM proposition";
        $retour = mysql_query($requete) ;
        
        $requete = "SELECT p.idproposition, e.nomentreprise, p.identreprise, u.idutilisateur, u.nomutilisateur, u.prenomutilisateur, pr.nompromotion 
            FROM proposition p, utilisateur u, promotion pr, entreprise e
            WHERE p.idutilisateur = u.idutilisateur
            AND pr.idpromotion = u.idpromotion
            AND p.etat = 'en attente'
            AND p.identreprise = e.identreprise";
        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {
            $etudiant = new ModeleUtilisateur($tableau['idutilisateur'], $tableau['nompromotion'], null, $tableau['prenomutilisateur'], $tableau['nomutilisateur'], null, null);
            $tabProp[$i] = new ModeleProposition($tableau['idproposition'], $tableau['identreprise'], null, null, $tableau['nomentreprise'], null, null, null, null, null, null, null, null, null, $etudiant, null);
            $i++;
        }
        return $tabProp;
    }

    /**
     * Permet d'obtenir la proposition $idProposition
     */
    public static function rechercherProposition($idProposition) {

        BD::getConnection();

        $id = mysql_real_escape_string(htmlspecialchars($id));
        if ($id != FALSE) {
            $i = 0;
            $tabProp = null;


            $entreprise = NULL ;
            $requete = "SELECT identreprise FROM proposition WHERE idproposition='$idProposition'";
            $retour = mysql_query($requete) ;
            
            while ($tableau = mysql_fetch_array($retour)) {
                
                // si l'idEntreprise != NULL on va chercher les données de l'entreprise dans la table entreprise
                if ($tableau['identreprise'] != NULL){
                    
                    $entreprise = BD::rechercherEntrepriseById($tableau['identreprise']);
                    $requete = "SELECT p.idproposition, p.dateproposition, p.sujetstagep, p.etat, u.nomutilisateur, u.prenomutilisateur, u.mailutilisateur, pr.nompromotion
                        FROM proposition p, utilisateur u, promotion pr
                        WHERE p.idproposition =".$idProposition." 
                        AND p.idutilisateur = u.idutilisateur
                        AND u.idpromotion = pr.idpromotion";
            
                    $retour = mysql_query($requete) or die(mysql_error());

                    while ($tableau = mysql_fetch_array($retour)) {
                        $etudiant = new ModeleUtilisateur(null, null, null, $tableau['nomutilisateur'], $tableau['prenomutilisateur'], $tableau['mailutilisateur'], null);
                        $tabProp[$i] = new ModeleProposition($tableau['idproposition'], null, null, null, $entreprise->getNom(), $tableau['dateproposition'],  $entreprise->getAdresse(), $entreprise->getCodePostal(), $entreprise->getVille(), $entreprise->getPays(), $entreprise->getNumeroTelephone(), $entreprise->getUrlSiteInternet(), $tableau['sujetstagep'], $tableau['etat'], $etudiant, $tableau['nompromotion']);
                        $i++;
                    }
                }else{
                    
                    //sinon les informations de l'entreprise sont à prendre dans la table proposition
                    $requete = "SELECT p.idproposition, p.nomentreprisep, p.dateproposition, p.adresseentreprisep, p.villeentreprisep, p.codepostalentreprisep, p.paysentreprisep, p.numerotelephonep, p.urlsiteinternetp, p.sujetstagep, p.etat, u.nomutilisateur, u.prenomutilisateur, u.mailutilisateur, pr.nompromotion
                        FROM proposition p, utilisateur u, promotion pr
                        WHERE p.idproposition =".$idProposition." 
                        AND p.idutilisateur = u.idutilisateur
                        AND u.idpromotion = pr.idpromotion";
            
                    $retour = mysql_query($requete) or die(mysql_error());

                    while ($tableau = mysql_fetch_array($retour)) {
                        $etudiant = new ModeleUtilisateur(null, null, null, $tableau['nomutilisateur'], $tableau['prenomutilisateur'], $tableau['mailutilisateur'], null);
                        $tabProp[$i] = new ModeleProposition($tableau['idproposition'], null, null, null, $tableau['nomentreprisep'], $tableau['dateproposition'],  $tableau['adresseentreprisep'], $tableau['codepostalentreprisep'], $tableau['villeentreprisep'], $tableau['paysentreprisep'], $tableau['numerotelephonep'], $tableau['urlsiteinternetp'], $tableau['sujetstagep'], $tableau['etat'], $etudiant, $tableau['nompromotion']);
                        $i++;
                    }
                }
            }
            
            if ($i > 0) {
                return $tabProp;
            } else {
                return NULL;
            }
        }
        return NULL;
    }

    public static function validerProposition($idProp) {
        $ok = false;
        $i = 0;
        $tabProp = null;
        BD::getConnection();
        $idProp = mysql_real_escape_string(htmlspecialchars($idProp));

        if ($idProp != FALSE) {
            
            // 1) On recupere la proposition dans la base pourextraire les infos necessaires a la creation d'un stage
            $requete = "SELECT * FROM proposition WHERE idproposition = " . $idProp . ";";
            $retour = mysql_query($requete);
            while ($tableau = mysql_fetch_array($retour)) {
                $tabProp[$i] = new ModeleProposition($tableau['idproposition'], $tableau['identreprise'], $tableau['idutilisateur'], null, $tableau['nomentreprisep'], $tableau['dateproposition'], $tableau['adresseentreprisep'], $tableau['codepostalentreprisep'], $tableau['villeentreprisep'], $tableau['paysentreprisep'], $tableau['numerotelephonep'], $tableau['urlsiteinternetp'], $tableau['sujetstagep'], $tableau['etat'], null, null);
                $i++;
            }
            $prop = $tabProp[0];

            // 2) Creation d'un stage a partir des données de la proposition
            // 2.1) On recupere le nom de la promotion de l'utilisateur
            $requete = "SELECT pr.nompromotion FROM promotion pr, utilisateur u 
                            WHERE u.idutilisateur = " . $prop->getIdUtilisateur() . "
                            AND pr.idpromotion = u.idpromotion;    
                            ";
            $retour = mysql_query($requete);
            while ($tableau = mysql_fetch_array($retour)) {
                $promo = $tableau['nompromotion'];
            }

            // 2.2) On insert le stage dans la bdd

            if ($prop->getIdEntreprise() == '') {
                $requete = "INSERT INTO stage (idstage, identreprise, idcontact, idproposition, idutilisateur,
                    sujetstage, datevalidation, datedebut, datefin, datesoutenance, lieusoutenance, etatstage, noteobtenue, 
                    appreciationobtenue, remuneration, embauche, dateembauche, respcivil, promotionstagiaire) 
                    VALUES ('', null, null, " . $prop->getIdProposition() . ", " . $prop->getIdUtilisateur() . ", '" . mysql_real_escape_string($prop->getSujet()) . "', NOW(), null, null, null, null, 'conv a signer entreprise', null, null, null, null, null, 0, '" . $promo . "')";
            } else {
                $requete = "INSERT INTO stage (idstage, identreprise, idcontact, idproposition, idutilisateur,
                    sujetstage, datevalidation, datedebut, datefin, datesoutenance, lieusoutenance, etatstage, noteobtenue, 
                    appreciationobtenue, remuneration, embauche, dateembauche, respcivil, promotionstagiaire) 
                    VALUES ('', " . $prop->getIdEntreprise() . ", null, " . $prop->getIdProposition() . ", " . $prop->getIdUtilisateur() . ", '" . mysql_real_escape_string($prop->getSujet()) . "', NOW(), null, null, null, null, 'conv a signer entreprise', null, null, null, null, null, 0, '" . $promo . "')";
            }

            if (mysql_query($requete)) {
                // 3) Modification de l'etat etat dans l'entité proposition à TRUE
                $requete = "UPDATE proposition SET etat = \"validee\" WHERE idproposition = " . $idProp . ";";
                if (mysql_query($requete)) {
                    $ok = true;
                }
            } else {
                echo "ERREUR : " . mysql_error();
            }
        }
        return $ok;
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
