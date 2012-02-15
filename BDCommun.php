<?php

class BDCommun{

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

        BDEtudiant::getConnection();
        $login = mysql_real_escape_string(htmlspecialchars($login));
        $password = sha1(mysql_real_escape_string(htmlspecialchars($password)));

        if ($login != FALSE && $password != FALSE) {

            $requete = "SELECT u.idutilisateur, u.idpromotion, p.nompromotion, u.mailutilisateur, u.passwordutilisateur, u.nomutilisateur, u.prenomutilisateur, u.numetudiant, u.admin
            FROM utilisateur u, promotion p
            WHERE u.mailutilisateur = '$login'
            AND u.passwordutilisateur = '$password'
            AND  u.idpromotion = p.idpromotion";
            try {
                $retour = mysql_query($requete);
            } catch (Exception $e) {
                
            }

            $nombreDeLignes = mysql_num_rows($retour);

            if ($nombreDeLignes > 0) {

                $modeleUtilisateur = NULL;
                while ($tableau = mysql_fetch_array($retour)) {

                    $modeleUtilisateur = new ModeleUtilisateur($tableau['idutilisateur'], $tableau['nompromotion'], $tableau['numetudiant'], $tableau['prenomutilisateur'], $tableau['nomutilisateur'], $tableau['mailutilisateur'], $tableau['admin'], $tableau['idpromotion']);
                }

                return $modeleUtilisateur;
            } else {
                return NULL;
            }
        }
    }
    public static function rechercherFicheRenseignement($id, $estUneProposition){

        BDCommun::getConnection();

        $id = mysql_real_escape_string(htmlspecialchars($id));
        $modeleFicheRenseignement = null ;

        if ($id != FALSE) {

            $requete ="";
            if ($estUneProposition){

                $requete = "SELECT id, nomoriginal, nomunique, type
                        FROM ficherenseignement
                        WHERE idproposition = ".$id;
            }else{
                $requete = "SELECT id, nomoriginal, nomunique, type
                        FROM ficherenseignement
                        WHERE idstage = ".$id;
            }

            $retour = mysql_query($requete) ;

            while ($tableau = mysql_fetch_array($retour)) {

                $modeleFicheRenseignement = new ModeleFicheRenseignement($tableau['id'], $tableau['nomoriginal'], $tableau['nomunique'], $tableau['type']);
            }

        }

        return $modeleFicheRenseignement ;
    }
    public static function rechercherFicheSujetStage($id, $estUneProposition){

        BDCommun::getConnection();

        $id = mysql_real_escape_string(htmlspecialchars($id));
        $modeleFicheSujetStage = null ;

        if ($id != FALSE) {

            $requete ="";
            if ($estUneProposition){

                $requete = "SELECT id, nomoriginal, nomunique, type
                        FROM fichesujetstage
                        WHERE idproposition = ".$id;
            }else{

                $requete = "SELECT id, nomoriginal, nomunique, type
                        FROM fichesujetstage
                        WHERE idstage = ".$id;
            }

            $retour = mysql_query($requete) ;

            while ($tableau = mysql_fetch_array($retour)) {

                $modeleFicheSujetStage = new ModeleFicheSujetStage($tableau['id'], $tableau['nomoriginal'], $tableau['nomunique'], $tableau['type']);
            }

        }

        return $modeleFicheSujetStage ;
    }

    //retourne toutes les promotions
    public static function recherchePromotion(){

        BDCommun::getConnection();
        $tabPromo = NULL ;
        $requete = "SELECT idpromotion, nompromotion, accesentreprises FROM promotion ";

        $retour = mysql_query($requete) ;

        $i = 0 ;
        while ($tableau = mysql_fetch_array($retour)) {

            $tabPromo[$i] = new ModelePromotion($tableau['idpromotion'], $tableau['nompromotion'], $tableau['accesentreprises']);
            $i++;
        }
        return $tabPromo;

    }

    public static function rechercheTechnos(){

        BDCommun::getConnection();
        $technoTab = NULL ;
        $requete = "SELECT * FROM techno";
        $retour = mysql_query($requete);
        $i=0;
        while ($tableau = mysql_fetch_array($retour)) {

            $technoTab[$i] = new ModeleTechno($tableau['id'], $tableau['nom']);
            $i++ ;
        }

        return $technoTab ;
    }
    /**
     * Permet d'obtenir la proposition $idProposition
     */
    public static function rechercherProposition($idProposition) {

        BDCommun::getConnection();

        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));
        if ($idProposition != FALSE) {
            $i = 0;
            $tabProp = null;


            $entreprise = NULL ;
            $requete = "SELECT identreprise FROM proposition WHERE idproposition='$idProposition'";
            $retour = mysql_query($requete) ;

            while ($tableau = mysql_fetch_array($retour)) {

                // si l'idEntreprise != NULL on va chercher les données de l'entreprise dans la table entreprise
                if ($tableau['identreprise'] != NULL){

                    $entreprise = BDEtudiant::rechercherEntrepriseById($tableau['identreprise']);
                    $requete = "SELECT p.idproposition, p.raisonrefus, p.dateproposition, p.sujetstagep, p.titrestagep,
                        p.titrestagep, p.technostagep, p.etat, u.nomutilisateur, u.prenomutilisateur, u.mailutilisateur, pr.nompromotion
                        FROM proposition p, utilisateur u, promotion pr
                        WHERE p.idproposition =".$idProposition."
                        AND p.idutilisateur = u.idutilisateur
                        AND u.idpromotion = pr.idpromotion";

                    $retour = mysql_query($requete) or die(mysql_error());

                    while ($tableau = mysql_fetch_array($retour)) {
                        $etudiant = new ModeleUtilisateur(null, null, null, $tableau['nomutilisateur'], $tableau['prenomutilisateur'], $tableau['mailutilisateur'], null, NULL);
                        $tabProp[$i] = new ModeleProposition($tableau['idproposition'], null, null, null,
                                $entreprise->getNom(), $tableau['dateproposition'],
                                $entreprise->getAdresse(), $entreprise->getCodePostal(),
                                $entreprise->getVille(), $entreprise->getPays(), $entreprise->getNumeroTelephone(),
                                $entreprise->getUrlSiteInternet(), $tableau['sujetstagep'], $tableau['etat'],
                                $etudiant, $tableau['nompromotion'], $tableau['titrestagep'], $tableau['technostagep'], $tableau['raisonrefus']);
                        $i++;
                    }
                }else{

                    //sinon les informations de l'entreprise sont à prendre dans la table proposition
                    $requete = "SELECT p.idproposition, p.raisonrefus, p.nomentreprisep, p.dateproposition, p.adresseentreprisep, p.villeentreprisep, p.codepostalentreprisep, p.paysentreprisep, p.numerotelephonep, p.urlsiteinternetp, p.sujetstagep, p.etat, u.nomutilisateur, u.prenomutilisateur, u.mailutilisateur, pr.nompromotion
                        FROM proposition p, utilisateur u, promotion pr
                        WHERE p.idproposition =".$idProposition."
                        AND p.idutilisateur = u.idutilisateur
                        AND u.idpromotion = pr.idpromotion";

                    $retour = mysql_query($requete) or die(mysql_error());

                    while ($tableau = mysql_fetch_array($retour)) {
                        $etudiant = new ModeleUtilisateur(null, null, null, $tableau['nomutilisateur'], $tableau['prenomutilisateur'], $tableau['mailutilisateur'], null, NULL);
                        $tabProp[$i] = new ModeleProposition($tableau['idproposition'], null, null, null, $tableau['nomentreprisep'], $tableau['dateproposition'],  $tableau['adresseentreprisep'], $tableau['codepostalentreprisep'], $tableau['villeentreprisep'], $tableau['paysentreprisep'], $tableau['numerotelephonep'], $tableau['urlsiteinternetp'], $tableau['sujetstagep'], $tableau['etat'], $etudiant, $tableau['nompromotion'], null, null, $tableau['raisonrefus']);
                        $i++;
                    }
                }
            }

            if ($i > 0) {
                return $tabProp[0];
            } else {
                return NULL;
            }
        }
        return NULL;
    }

    public static function rechercherStageByID($idstage){
        BDCommun::getConnection();
        $tabStage = null;
        $i=0;
        $requete = "SELECT s.idstage, s.identreprise, s.idproposition, s.datevalidation, s.sujetstage, s.titrestage, s.technostage, u.numetudiant, u.nomutilisateur,
            u.prenomutilisateur, u.mailutilisateur, e.nomentreprise, e.adresseentreprise,
            e.villeentreprise, e.codepostalentreprise, e.paysentreprise, e.numerotelephone,
            e.numerosiret, e.urlsiteinternet, e.statutjuridique, s.datedebut, s.datefin,
            s.datesoutenance, s.lieusoutenance, s.etatstage, s.noteobtenue, s.appreciationobtenue,
            s.remuneration, s.embauche, s.dateembauche, s.respcivil, pr.nompromotion, c.nomcontact,
            c.prenomcontact, c.mailcontact, c.fonctioncontact, c.telfixecontact, c.telmobilecontact
                    FROM entreprise e, utilisateur u, promotion pr, contact c RIGHT JOIN stage s ON c.idcontact = s.idcontact
                    WHERE s.idstage = ".$idstage."
                    AND u.idutilisateur = s.idutilisateur
                    AND u.idpromotion = pr.idpromotion
                    AND s.identreprise = e.identreprise";

        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {

            $promotion = new ModelePromotion(null, $tableau['nompromotion'], null);
            $etudiant = new ModeleUtilisateur(null, null, $tableau['numetudiant'], $tableau['prenomutilisateur'], $tableau['nomutilisateur'], $tableau['mailutilisateur'], null, NULL);
            $entreprise = new ModeleEntreprise(null, $tableau['nomentreprise'], $tableau['adresseentreprise'], $tableau['villeentreprise'], $tableau['codepostalentreprise'], $tableau['paysentreprise'], $tableau['numerotelephone'], $tableau['numerosiret'], $tableau['urlsiteinternet'], $tableau['statutjuridique']);
            $contact = new ModeleContact(null, $tableau['prenomcontact'], $tableau['nomcontact'], $tableau['fonctioncontact'], $tableau['telfixecontact'], $tableau['telmobilecontact'], $tableau['mailcontact']);
            $tabStage[$i] = new ModeleStage($tableau['idstage'], $tableau['identreprise'], null, $tableau['sujetstage'], BDCommun::dateENtoFR($tableau['datevalidation']), BDCommun::dateENtoFR($tableau['datedebut']), BDCommun::dateENtoFR($tableau['datefin']), BDCommun::dateENtoFR($tableau['datesoutenance']), $tableau['lieusoutenance'], $tableau['etatstage'], $tableau['noteobtenue'], $tableau['appreciationobtenue'], $tableau['remuneration'], $tableau['embauche'], BDCommun::dateENtoFR($tableau['dateembauche']), $etudiant, $entreprise, $contact, $promotion, $tableau['respcivil'],$tableau['titrestage'],$tableau['technostage']);
            $tabStage[$i]->setIdproposition($tableau['idproposition']);
            $i++;
        }

        return $tabStage[0];
    }

    // les dates sont "en francais" (jour/mois/annee)
    // on les transforme en annee/jour/mois pour mysql
    public static function dateFRtoEN($date){

        if ($date != "NULL" && $date != ""){
            $tab = preg_split("/-/", $date);
            $jour = $tab[0];
            $mois = $tab[1];
            $annee = $tab[2];
            $date = $annee."-".$mois."-".$jour;
            return $date ;
        }else{

            return "NULL";
        }
    }
    public static function dateENtoFR($date){

        if ($date != "NULL" && $date != ""){
            $tab = preg_split("/-/", $date);
            $jour = $tab[2];
            $mois = $tab[1];
            $annee = $tab[0];
            $date = $jour."-".$mois."-".$annee;
            return $date ;
        }else{

            return "NULL";
        }
    }


    public static function rechercheTechnosModeleByProposition($idProposition){

        BDCommun::getConnection();
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));

        if ($idProposition != FALSE ) {

            $requete = "SELECT techno.id, techno.nom FROM technoproposition, techno
                        WHERE techno.id = technoproposition.idtechno AND idproposition = ".$idProposition ;
            $retour = mysql_query($requete);
            $i=0;
            $technoTab = null ;
            while ($tableau = mysql_fetch_array($retour)) {

                $technoTab[$i] = new ModeleTechno($tableau['id'], $tableau['nom']);
                $i++ ;
            }

            return $technoTab ;
        }
        return null ;
    }
}

?>
