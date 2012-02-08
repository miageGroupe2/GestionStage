<?php

require_once RACINE_MODELE . 'ModeleEntreprise.php';
require_once RACINE_MODELE . 'ModeleStage.php';
require_once RACINE_MODELE . 'ModeleContact.php';
require_once RACINE_MODELE . 'ModeleUtilisateur.php';
require_once RACINE_MODELE . 'ModeleProposition.php';
require_once RACINE_MODELE . 'ModelePromotion.php';
require_once RACINE_MODELE . 'ModeleFicheRenseignement.php';
require_once RACINE_MODELE . 'ModeleFicheSujetStage.php';
require_once RACINE_MODELE . 'ModeleTechno.php';

class BDResponsable {

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


    public static function modifierDonneesStage() {

        BDResponsable::getConnection();
        $idStage = mysql_real_escape_string(htmlspecialchars($_GET['idstage']));
        $etatstage = mysql_real_escape_string(htmlspecialchars($_POST['etatstage']));
        if($etatstage == NULL){
            $etatstage = "NULL";
        }
        $respcivile = mysql_real_escape_string(htmlspecialchars($_POST['respcivil']));
        if($respcivile == NULL){
            $respcivile = "NULL";
        }
        $datedeb = mysql_real_escape_string(htmlspecialchars($_POST['datedeb']));
        if($datedeb == NULL){
            $datedeb = "NULL";
        }
        $datefin = mysql_real_escape_string(htmlspecialchars($_POST['datefin']));
        if($datefin == NULL){
            $datefin = "NULL";
        }
        $datesoutenance = mysql_real_escape_string(htmlspecialchars($_POST['datesoutenance']));
        if($datesoutenance == NULL){
            $datesoutenance = "NULL";
        }
        $lieusoutenance = mysql_real_escape_string(htmlspecialchars($_POST['lieusoutenance']));
        if($lieusoutenance == NULL){
            $lieusoutenance = "NULL";
        }
        $noteobtenue = mysql_real_escape_string(htmlspecialchars($_POST['noteobtenue']));
        if($noteobtenue == NULL){
            $noteobtenue = "NULL";
        }
        $appreciationobtenue = mysql_real_escape_string(htmlspecialchars($_POST['appreciationobtenue']));
        if($appreciationobtenue == NULL){
            $appreciationobtenue = "NULL";
        }
        $remuneration = mysql_real_escape_string(htmlspecialchars($_POST['remuneration']));
        if($remuneration == NULL){
            $remuneration = "NULL";
        }
        $embauche = mysql_real_escape_string(htmlspecialchars($_POST['embauche']));
        if($embauche == NULL){
            $embauche = "NULL";
        }
        $dateembauche = mysql_real_escape_string(htmlspecialchars($_POST['dateembauche']));
        if($dateembauche == NULL){
            $dateembauche = "NULL";
        }

        $datedeb = BDResponsable::dateFRtoEN($datedeb);
        $dateembauche = BDResponsable::dateFRtoEN($dateembauche);
        $datefin = BDResponsable::dateFRtoEN($datefin);
        $datesoutenance = BDResponsable::dateFRtoEN($datesoutenance);


        $requete = "UPDATE stage SET etatstage = \"$etatstage\", respcivil = $respcivile, datedebut = '$datedeb',
        datefin = '$datefin', datesoutenance = '$datesoutenance', lieusoutenance = \"$lieusoutenance\",
        noteobtenue = \"$noteobtenue\", appreciationobtenue = \"$appreciationobtenue\",
        remuneration = $remuneration, embauche = $embauche, dateembauche = '$dateembauche'
        WHERE idstage = $idStage";

echo $requete ;
        if(mysql_query($requete)){
            return true;
        }else{
            echo mysql_error();
            return false;
        }

    }
    /**
     * Permet d'afficher toutes les propositions de stage
     */
    public static function rechercherToutesPropositions() {
        BDResponsable::getConnection();
        $i = 0;
        $tabProp = null;

        $modeleUtilisateur = $_SESSION['modeleUtilisateur'];
        $idUtilisateur = $modeleUtilisateur->getId();


        $requete = "SELECT p.idproposition, e.nomentreprise, e.villeentreprise, e.paysentreprise,
            p.identreprise, p.titrestagep, u.idutilisateur,
            u.nomutilisateur, u.prenomutilisateur, pr.nompromotion
            FROM proposition p, utilisateur u, promotion pr, entreprise e
            WHERE p.idutilisateur = u.idutilisateur
            AND pr.idpromotion = u.idpromotion
            AND p.etat = 'en attente'
            AND p.identreprise = e.identreprise
            AND pr.idpromotion = (
                        SELECT idpromotion
                        FROM utilisateur
                        WHERE idutilisateur = ".$idUtilisateur."
            ) ";

        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {
            $etudiant = new ModeleUtilisateur($tableau['idutilisateur'], $tableau['nompromotion'], null, $tableau['prenomutilisateur'], $tableau['nomutilisateur'], null, null, NULL);
            $tabProp[$i] = new ModeleProposition($tableau['idproposition'], $tableau['identreprise'], null, null, $tableau['nomentreprise'], null, null, null, $tableau['villeentreprise'], $tableau['paysentreprise'], null, null, null, null, $etudiant, null, $tableau['titrestagep'], null, null);
            $i++;
        }
        return $tabProp;
    }
    

    

    public static function rechercheTechnoByProposition($idProposition){

        BDResponsable::getConnection();
        $technoTab = NULL ;
        $requete = "SELECT * FROM technoproposition, techno WHERE technoproposition.idtechno=techno.id AND  idproposition = ".$idProposition;

        $retour = mysql_query($requete);
        $i=0;
        while ($tableau = mysql_fetch_array($retour)) {

            $technoTab[$i] = new ModeleTechno($tableau['id'], $tableau['nom']);
            $i++ ;
        }

        return $technoTab ;
    }
    
    public static function refuserProposition($idProp, $raisonrefus) {

        BDResponsable::getConnection();
        $idProp = mysql_real_escape_string(htmlspecialchars($idProp));
        $raisonrefus = mysql_real_escape_string(htmlspecialchars($raisonrefus));

        if ($idProp != FALSE ) {

            $requete = "UPDATE proposition SET raisonrefus='".$raisonrefus."', etat='refusée'
                WHERE idproposition=".$idProp;

            mysql_query($requete);
        }

    }
    public static function validerProposition($idProp) {
        $i = 0;
        $tabProp = null;
        BDResponsable::getConnection();
        $idProp = mysql_real_escape_string(htmlspecialchars($idProp));

        if ($idProp != FALSE) {

            // 1) On recupere la proposition dans la base pour extraire les infos necessaires a la creation d'un stage

            $requete = "SELECT * FROM proposition, utilisateur WHERE idproposition = " . $idProp . " AND proposition.idutilisateur = utilisateur.idutilisateur";

            $retour = mysql_query($requete);
            while ($tableau = mysql_fetch_array($retour)) {
                $tabProp[$i] = new ModeleProposition($tableau['idproposition'], $tableau['identreprise'], $tableau['idutilisateur'], null, $tableau['nomentreprisep'], $tableau['dateproposition'], $tableau['adresseentreprisep'], $tableau['codepostalentreprisep'], $tableau['villeentreprisep'], $tableau['paysentreprisep'], $tableau['numerotelephonep'], $tableau['urlsiteinternetp'], $tableau['sujetstagep'], $tableau['etat'], null, $tableau['idpromotion'], $tableau['titrestagep'], $tableau['technostagep'], null);
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
                    sujetstage, titrestage, technostage, datevalidation, datedebut, datefin, datesoutenance, lieusoutenance, etatstage, noteobtenue,
                    appreciationobtenue, remuneration, embauche, dateembauche, respcivil)
                    VALUES ('', null, null, " . $prop->getIdProposition() . ", " . $prop->getIdUtilisateur() . ", '" . mysql_real_escape_string($prop->getSujet()) . "', '" .mysql_real_escape_string($prop->getTitreStage()). ", '" .mysql_real_escape_string($prop->getTechnoStage()). "', NOW(), null, null, null, null, 'en cours', null, null, null, null, null, 0)";


                //pas encore utilisé(modif demandé par jean malhomme
            } else {

                $requete = "INSERT INTO stage (idstage, identreprise, idcontact, idproposition, idutilisateur,
                    sujetstage, titrestage, technostage, datevalidation, datedebut, datefin, datesoutenance, lieusoutenance, etatstage, noteobtenue,
                    appreciationobtenue, remuneration, embauche, dateembauche, respcivil, idpromotion)
                    VALUES ('', " . $prop->getIdEntreprise() . ", null, " . $prop->getIdProposition() . ", " . $prop->getIdUtilisateur() . ", '" . mysql_real_escape_string($prop->getSujet()) . "', '" .mysql_real_escape_string($prop->getTitreStage()). "', '" .mysql_real_escape_string($prop->getTechnoStage()). "', NOW(), null, null, null, null, 'en cours', null, null, null, null, null, 0, ".$prop->getPromotionEtudiant().")";

            }

            mysql_query($requete);
                // 3) Modification de l'etat etat dans l'entité proposition à TRUE
                $requete = "UPDATE proposition SET etat = \"validee\" WHERE idproposition = " . $idProp . ";";
                mysql_query($requete);


                //modif dans les tables de fichiers

                $requete = "SELECT * FROM stage WHERE idproposition  = " . $idProp . ";";

                $retour = mysql_query($requete);
                $idStage = 0 ;
                while ($tableau = mysql_fetch_array($retour)) {

                    $idStage = $tableau['idstage'];
                }

                $requete = "UPDATE ficherenseignement SET idstage = ".$idStage." WHERE idproposition = " . $idProp . ";";
                mysql_query($requete);

                $requete = "UPDATE fichesujetstage SET idstage = ".$idStage." WHERE idproposition = " . $idProp . ";";
                mysql_query($requete);

        }
    }
    public static function rechercherStage(){
        BDResponsable::getConnection();
        $tabStage = null;
        $i=0;
        $requete = "SELECT s.idstage, s.etatstage, s.datevalidation, s.titrestage, u.nomutilisateur,
                    u.prenomutilisateur, e.nomentreprise, e.paysentreprise,
                    e.villeentreprise, s.noteobtenue, pr.nompromotion
                    FROM stage s, entreprise e, utilisateur u, promotion pr
                    WHERE u.idutilisateur = s.idutilisateur
                    AND u.idpromotion = pr.idpromotion
                    AND s.identreprise = e.identreprise

        ";
        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {

            $promotion = new ModelePromotion(null, $tableau['nompromotion'], null);
            $etudiant = new ModeleUtilisateur(null, null, null, $tableau['prenomutilisateur'], $tableau['nomutilisateur'], null, null, NULL);
            $entreprise = new ModeleEntreprise(null, $tableau['nomentreprise'], null, $tableau['villeentreprise'], null,  $tableau['paysentreprise'], null, null, null, null);
            $tabStage[$i] = new ModeleStage($tableau['idstage'], null, null, null, $tableau['datevalidation'], null, null, null, null, $tableau['etatstage'], $tableau['noteobtenue'], null, null, null, null, $etudiant, $entreprise, null, $promotion,null, $tableau['titrestage'], null);
            $i++;

        }

        return $tabStage;
    }
    public static function rechercherStageByPromoByTechno($idPromotion, $tabTechno){

        BDResponsable::getConnection();
        $tabStage = null;
        $i=0;
        $requete = "SELECT s.idstage, s.idproposition, s.etatstage, s.datevalidation, s.titrestage, u.nomutilisateur,
                    u.prenomutilisateur, e.nomentreprise, e.paysentreprise,
                    e.villeentreprise, s.noteobtenue, pr.nompromotion
                    FROM stage s, entreprise e, utilisateur u, promotion pr
                    WHERE u.idutilisateur = s.idutilisateur
                    AND u.idpromotion = pr.idpromotion
                    AND s.identreprise = e.identreprise
        ";
        if ($idPromotion != null){

            $requete .= " AND pr.idpromotion = $idPromotion";
        }


        if ( $tabTechno != null){
            //bon courage ... !
            $requete = "SELECT s.idstage, s.idproposition, s.etatstage, s.datevalidation, s.titrestage, u.nomutilisateur,
                    u.prenomutilisateur, e.nomentreprise, e.paysentreprise,
                    e.villeentreprise, s.noteobtenue, pr.nompromotion
                    FROM stage s, entreprise e, utilisateur u, promotion pr, technoproposition tp
                    WHERE u.idutilisateur = s.idutilisateur
                    AND u.idpromotion = pr.idpromotion
                    AND s.identreprise = e.identreprise
                    AND tp.idproposition = s.idproposition
                    AND tp.idtechno =" .$tabTechno[0];
            $i=0 ;
            foreach ($tabTechno as $techno) {

                $requete .= "
                        AND s.idstage in (
                    SELECT s.idstage
                    FROM stage s, entreprise e, utilisateur u, promotion pr, technoproposition tp
                    WHERE u.idutilisateur = s.idutilisateur
                    AND u.idpromotion = pr.idpromotion
                    AND s.identreprise = e.identreprise
                    AND tp.idproposition = s.idproposition
                    AND tp.idtechno = ".$techno ;

                    $i ++ ;

            }
            while ($i!= 0){
                $requete .= ")";
                $i-- ;
            }
            if ($idPromotion != null){

                $requete .= " AND pr.idpromotion = $idPromotion";
            }
        }

        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {

            $promotion = new ModelePromotion(null, $tableau['nompromotion'], null);
            $etudiant = new ModeleUtilisateur(null, null, null, $tableau['prenomutilisateur'], $tableau['nomutilisateur'], null, null, NULL);
            $entreprise = new ModeleEntreprise(null, $tableau['nomentreprise'], null, $tableau['villeentreprise'], null,  $tableau['paysentreprise'], null, null, null, null);
            $tabStage[$i] = new ModeleStage($tableau['idstage'], null, null, null, $tableau['datevalidation'], null, null, null, null, $tableau['etatstage'], $tableau['noteobtenue'], null, null, null, null, $etudiant, $entreprise, null, $promotion,null, $tableau['titrestage'], null);
            $i++;

        }

        return $tabStage;
    }
    
    
    public static function rechercherStageAnneeCourante($promotion){
        BDResponsable::getConnection();
        $tabStage = null;
        $i=0;

        $dateDuJour = date("Y/m/d");
        $mois = date("m");
        $annee = date("Y");

        $requete = "SELECT s.idstage, s.etatstage, s.datevalidation, u.nomutilisateur,
                    u.prenomutilisateur, e.nomentreprise, e.villeentreprise, e.paysentreprise,
                    s.titrestage, pr.nompromotion
                    FROM stage s, entreprise e, utilisateur u, promotion pr
                    WHERE u.idutilisateur = s.idutilisateur
                    AND u.idpromotion = pr.idpromotion
                    AND u.idpromotion = $promotion
                    AND s.identreprise = e.identreprise";

        if ($mois > 9){

            $requete .= " AND datevalidation > DATE('".$annee."-09-01')";
        }else{
            $requete .= " AND datevalidation > DATE('".($annee-1)."-09-01')";
        }

        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {

            $promotion = new ModelePromotion(null, $tableau['nompromotion'], null);
            $etudiant = new ModeleUtilisateur(null, null, null, $tableau['prenomutilisateur'], $tableau['nomutilisateur'], null, null, NULL);
            $entreprise = new ModeleEntreprise(null, $tableau['nomentreprise'], null, $tableau['villeentreprise'], null, $tableau['paysentreprise'], null, null, null, null);
            $tabStage[$i] = new ModeleStage($tableau['idstage'], null, null, null, $tableau['datevalidation'], null, null, null, null, $tableau['etatstage'], null, null, null, null, null, $etudiant, $entreprise, null, $promotion,null, $tableau['titrestage'], null);
            $i++;

        }

        return $tabStage;
    }
    
    // permet de retourner la liste des admin
    public static function rechercheListeAdmin(){

        BDResponsable::getConnection();
        $tabAdmin = NULL ;
        $requete = "SELECT idutilisateur, nompromotion, mailutilisateur, nomutilisateur, prenomutilisateur, admin
            FROM utilisateur, promotion
            WHERE utilisateur.idpromotion = promotion.idpromotion
            AND  admin='1'";

        $retour = mysql_query($requete) ;

        $i = 0 ;
        while ($tableau = mysql_fetch_array($retour)) {

            $tabAdmin[$i] = new ModeleUtilisateur($tableau['idutilisateur'], $tableau['nompromotion'], null, $tableau['prenomutilisateur'], $tableau['nomutilisateur'], $tableau['mailutilisateur'], $tableau['admin'], NULL);
            $i++;
        }
        return $tabAdmin;
    }
    public static function ajouterAdmin($nom, $prenom, $mail, $mdp, $idPromotion) {

        BDResponsable::getConnection();
        $nom = mysql_real_escape_string(htmlspecialchars($nom));
        $prenom = mysql_real_escape_string(htmlspecialchars($prenom));
        $mail = mysql_real_escape_string(htmlspecialchars($mail));
        $mdp = mysql_real_escape_string(htmlspecialchars($mdp));
        $idPromotion = mysql_real_escape_string(htmlspecialchars($idPromotion));

        if ($nom != FALSE && $prenom != FALSE
                && $mail != FALSE
                && $idPromotion != FALSE
                && $mdp != FALSE) {


            $requete = "INSERT INTO utilisateur (idpromotion, prenomutilisateur, nomutilisateur, mailutilisateur,
                passwordutilisateur, admin)
                VALUES ('$idPromotion','$prenom', '$nom', '$mail', '".sha1($mdp)."', '1')";

            mysql_query($requete);
        }
    }
    public static function getAdminById($idUtilisateur) {

        BDResponsable::getConnection();
        $idUtilisateur = mysql_real_escape_string(htmlspecialchars($idUtilisateur));

        if ($idUtilisateur != FALSE ) {

            $requete = "SELECT idutilisateur, utilisateur.idpromotion, nompromotion, mailutilisateur, passwordutilisateur, nomutilisateur, prenomutilisateur FROM utilisateur, promotion WHERE utilisateur.idpromotion = promotion.idpromotion AND admin= '1' AND idutilisateur = '$idUtilisateur'";
            try {
                $retour = mysql_query($requete);
            } catch (Exception $e) {
                echo "erreur lors de l'authentification :" . $e;
            }

            $modeleUtilisateur = NULL;
            while ($tableau = mysql_fetch_array($retour)) {

                $modeleUtilisateur = new ModeleUtilisateur($tableau['idutilisateur'], $tableau['nompromotion'], NULL, $tableau['prenomutilisateur'], $tableau['nomutilisateur'], $tableau['mailutilisateur'], 1, $tableau['idpromotion']);
            }

            return $modeleUtilisateur;
        }

        return NULL ;
    }

    public static function modifierAdmin($idUtilisateur, $nom, $prenom, $mail, $mdp, $idPromotion) {

        BDResponsable::getConnection();
        $idUtilisateur = mysql_real_escape_string(htmlspecialchars($idUtilisateur));
        $nom = mysql_real_escape_string(htmlspecialchars($nom));
        $prenom = mysql_real_escape_string(htmlspecialchars($prenom));
        $mail = mysql_real_escape_string(htmlspecialchars($mail));
        $mdp = mysql_real_escape_string(htmlspecialchars($mdp));
        $idPromotion = mysql_real_escape_string(htmlspecialchars($idPromotion));

        if ($idUtilisateur != FALSE && $nom != FALSE && $prenom != FALSE
                && $mail != FALSE
                && $idPromotion != FALSE
                && $mdp != FALSE) {


            $requete = "UPDATE utilisateur SET nomutilisateur = '$nom',
                                            prenomutilisateur = '$prenom',
                                            mailutilisateur = '$mail',
                                            idpromotion = '$idPromotion',
                                            passwordutilisateur = '".sha1($mdp)."'
                                            WHERE idutilisateur ='".$idUtilisateur."'";


            mysql_query($requete);
        }
    }
    public static function supprimerAdmin($idUtilisateur) {

        BDResponsable::getConnection();
        $idUtilisateur = mysql_real_escape_string(htmlspecialchars($idUtilisateur));

        if ($idUtilisateur != FALSE) {

            $requete = "SELECT count(*) as count FROM `utilisateur` WHERE admin = '1'";

            $retour = mysql_query($requete);

            while ($tableau = mysql_fetch_array($retour)) {

                if ($tableau['count'] < 2){
                    //on ne peut pas supprimer le dernier admin
                    return ;
                }
            }

            $requete = "DELETE FROM utilisateur WHERE idutilisateur='$idUtilisateur'";
            mysql_query($requete);
        }
    }

    public static function ajouterPromotion($promo){

        BDResponsable::getConnection();
        $promo = mysql_real_escape_string(htmlspecialchars($promo));

        if ($promo != FALSE ) {

            $requete = "INSERT INTO promotion (nompromotion, accesentreprises)
                VALUES ('$promo', '1')";

            mysql_query($requete);
        }
    }

    public static function supprimerPromotion($idPromo){

        BDResponsable::getConnection();
        $idPromo = mysql_real_escape_string(htmlspecialchars($idPromo));

        if ($idPromo != FALSE ) {

            $requete = "DELETE FROM promotion WHERE idpromotion='$idPromo'";

            mysql_query($requete);
        }
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
    
}
?>
