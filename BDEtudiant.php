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


class BDEtudiant {


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
                echo "erreur lors de l'authentification :" . $e;
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

    public static function rechercheTechnosByProposition($idProposition){

        BDEtudiant::getConnection();
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));

        if ($idProposition != FALSE ) {

            $requete = "SELECT idtechno FROM technoproposition WHERE idproposition = ".$idProposition;
            $retour = mysql_query($requete);
            $i=0;
            $technoTab = null ;
            while ($tableau = mysql_fetch_array($retour)) {

                $technoTab[$i] = $tableau['idtechno'];
                $i++ ;
            }

            return $technoTab ;
        }
        return null ;
    }
    
    

    

    public static function confirmationInscription($id){
        
        BDEtudiant::getConnection();
        $id = mysql_real_escape_string(htmlspecialchars($id));

        if ($id != FALSE ){

            $requete = "SELECT passwordutilisateurtmp FROM utilisateur WHERE idConfirmationMail='".$id."'";
            $retour = mysql_query($requete);
            while ($tableau = mysql_fetch_array($retour)) {

                $passwordTmp = $tableau['passwordutilisateurtmp'];

                $requete = "UPDATE utilisateur SET passwordutilisateur = '".$passwordTmp."' WHERE idConfirmationMail='".$id."'";
                mysql_query($requete);
            }
        }
    }
    public static function inscriptionEtudiant($mail, $numetudiant, $password, $nom, $prenom, $idPromotion){

        BDEtudiant::getConnection();
        $mail = mysql_real_escape_string(htmlspecialchars($mail));
        $password = mysql_real_escape_string(htmlspecialchars($password));
        $numetudiant = mysql_real_escape_string(htmlspecialchars($numetudiant));
        $nom = mysql_real_escape_string(htmlspecialchars($nom));
        $prenom= mysql_real_escape_string(htmlspecialchars($prenom));
        $idPromotion = mysql_real_escape_string(htmlspecialchars($idPromotion));


        if ($mail != FALSE && $password != FALSE && $numetudiant != FALSE
            && $nom != FALSE && $prenom != FALSE && $idPromotion != FALSE ) {

            $mail .= "@etudiant.univ-nancy2.fr";

            $idUnique = md5(uniqid(rand(), true)) ;

            // check if exist

            $requete = "SELECT mailutilisateur FROM utilisateur WHERE mailutilisateur = '".$mail."'";
            $retour = mysql_query($requete);

            $existeDeja = FALSE ;
            while ($tableau = mysql_fetch_array($retour)) {

                $existeDeja = TRUE ;
            }

            if (!$existeDeja){

                $requete = "INSERT INTO utilisateur (idpromotion, prenomutilisateur, nomutilisateur, mailutilisateur,
                passwordutilisateurtmp, admin, idConfirmationMail)
                VALUES ('$idPromotion','$prenom', '$nom', '$mail', '".sha1($password)."', '0', '".$idUnique."')";


                mysql_query($requete);
            }else{

                $requete = "UPDATE utilisateur SET idConfirmationMail = '".$idUnique."', passwordutilisateurtmp = '".sha1($password)."' WHERE mailutilisateur='".$mail."'" ;
                mysql_query($requete);
            }

            $requete = "SELECT idConfirmationMail FROM utilisateur WHERE mailutilisateur = '".$mail."'";
            $retour = mysql_query($requete);

            while ($tableau = mysql_fetch_array($retour)) {

                return $tableau['idConfirmationMail'];
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

        BDEtudiant::getConnection();
        $nom = mysql_real_escape_string(htmlspecialchars($nom));
        $tabEntreprise = null;

        if ($nom != FALSE) {

            $requete = "SELECT * FROM `entreprise` WHERE nomentreprise LIKE '%$nom%'";

            $retour = mysql_query($requete);

            $i = 0;
            while ($tableau = mysql_fetch_array($retour)) {

                $tabEntreprise[$i] = new ModeleEntreprise($tableau['identreprise'], $tableau['nomentreprise'], $tableau['adresseentreprise'], $tableau['villeentreprise'], $tableau['codepostalentreprise'], $tableau['paysentreprise'], $tableau['numerotelephone'], $tableau['numerosiret'], $tableau['urlsiteinternet'], null);
                $i++;
            }
        }
        return $tabEntreprise;
    }

    public static function ajouterFicheSujetStage($nomOriginal, $type, $nomUnique) {

        BDEtudiant::getConnection();
        $nomOriginal = mysql_real_escape_string(htmlspecialchars($nomOriginal));
        $nomUnique = mysql_real_escape_string(htmlspecialchars($nomUnique));
        $idFiche = 0 ;

        if ($nomOriginal != FALSE && $nomUnique != FALSE) {

            $requete = "INSERT INTO fichesujetstage (nomoriginal, nomunique, type) VALUES ('".$nomOriginal."','".$nomUnique."','".$type."')";
            
            mysql_query($requete);
            $requete = "SELECT id FROM fichesujetstage WHERE nomunique ='".$nomUnique."'";
            $retour = mysql_query($requete);

            while ($tableau = mysql_fetch_array($retour)) {
                $idFiche = $tableau['id'];
            }
        }

        return $idFiche;
    }

    public static function ajouterFicheRenseignement($nomOriginal, $type, $nomUnique) {

        BDEtudiant::getConnection();
        $nomOriginal = mysql_real_escape_string(htmlspecialchars($nomOriginal));
        $nomUnique = mysql_real_escape_string(htmlspecialchars($nomUnique));
        $idFiche = 0 ;

        if ($nomOriginal != FALSE && $nomUnique != FALSE) {

            $requete = "INSERT INTO ficherenseignement (nomoriginal, nomunique, type) VALUES ('".$nomOriginal."','".$nomUnique."','".$type."')";
            
            mysql_query($requete);
            
            $requete = "SELECT id FROM ficherenseignement WHERE nomunique ='".$nomUnique."'";
            
            $retour = mysql_query($requete);
            
            while ($tableau = mysql_fetch_array($retour)) {
                $idFiche = $tableau['id'];
            }
        }

        return $idFiche;
    }
    public static function modifierFicheRenseignement($nomOriginal, $type, $nomUnique, $idProposition) {

        BDEtudiant::getConnection();
        $nomOriginal = mysql_real_escape_string(htmlspecialchars($nomOriginal));
        $nomUnique = mysql_real_escape_string(htmlspecialchars($nomUnique));
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));

        if ($nomOriginal != FALSE && $nomUnique != FALSE && $idProposition != FALSE) {

            $requete = "UPDATE ficherenseignement SET nomoriginal = '".$nomOriginal."', nomunique = '".$nomUnique."', type = '".$type."' WHERE idproposition=".$idProposition;
            mysql_query($requete);


        }
    }

    public static function modifierFicheSujetStage($nomOriginal, $type, $nomUnique, $idProposition) {

        BDEtudiant::getConnection();
        $nomOriginal = mysql_real_escape_string(htmlspecialchars($nomOriginal));
        $nomUnique = mysql_real_escape_string(htmlspecialchars($nomUnique));
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));

        if ($nomOriginal != FALSE && $nomUnique != FALSE && $idProposition != FALSE) {

            $requete = "SELECT * FROM fichesujetstage WHERE idproposition=".$idProposition;
            $retour = mysql_query($requete);
            $i = 0 ;
            while ($tableau = mysql_fetch_array($retour)) {

                $i ++ ;
                break ;
            }
            if($i == 0){

                $requete = "INSERT INTO fichesujetstage (nomoriginal, nomunique, type, idproposition) VALUES ('".$nomOriginal."','".$nomUnique."','".$type."','".$idProposition."')";

            }else{

                $requete = "UPDATE fichesujetstage SET nomoriginal = '".$nomOriginal."', nomunique = '".$nomUnique."', type = '".$type."' WHERE idproposition=".$idProposition;
            }
            mysql_query($requete);

        }
    }

    /**
     * Permet de rechercher l'entreprise ayant l'id passé en paramètre
     * @param type $id
     */
    public static function rechercherEntrepriseById($id) {

        BDEtudiant::getConnection();
        $id = mysql_real_escape_string(htmlspecialchars($id));
        $entreprise = null;

        if ($id != FALSE) {

            $requete = "SELECT identreprise, nomentreprise, adresseentreprise, villeentreprise, codepostalentreprise, paysentreprise, numerotelephone, numerosiret, urlsiteinternet FROM entreprise WHERE identreprise=" . $id;
            $retour = mysql_query($requete);

            $i = 0;
            while ($tableau = mysql_fetch_array($retour)) {

                $entreprise[$i] = new ModeleEntreprise($tableau['identreprise'], $tableau['nomentreprise'], $tableau['adresseentreprise'], $tableau['villeentreprise'], $tableau['codepostalentreprise'], $tableau['paysentreprise'], $tableau['numerotelephone'], $tableau['numerosiret'], $tableau['urlsiteinternet'], null);
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

        
        BDEtudiant::getConnection();
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

        BDEtudiant::getConnection();
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
    public static function modifierContactDansStage($idContact,$idStage, $idUtilisateur){
        
        BDEtudiant::getConnection();
        $idContact = mysql_real_escape_string(htmlspecialchars($idContact));
        $idStage = mysql_real_escape_string(htmlspecialchars($idStage));
        $idUtilisateur = mysql_real_escape_string(htmlspecialchars($idUtilisateur));
        
        if ($idContact != FALSE && $idStage != FALSE
                && $idUtilisateur != FALSE ) {

            //on vérifie qu'on modifie un stage appartenant à l'utilisateur
            $requete = "SELECT idutilisateur, idstage FROM stage WHERE idutilisateur='$idUtilisateur' AND idstage='$idStage'";
            $retour = mysql_query($requete);

            while ($tableau = mysql_fetch_array($retour)) {

                $requete = "UPDATE stage SET idcontact = '$idContact' WHERE idstage='$idStage'";
                mysql_query($requete);
                $requete = "UPDATE contact SET datederniereactivite = NOW() WHERE idcontact='$idContact'";
                mysql_query($requete);

            }
        }
    }

    public static function ajouterContact($identreprise, $nom, $prenom, $fonction, $telephoneFixe, $telephoneMobile, $mail) {

        BDEtudiant::getConnection();
        $idEntreprise = mysql_real_escape_string(htmlspecialchars($identreprise));
        $nom = mysql_real_escape_string(htmlspecialchars($nom));
        $prenom = mysql_real_escape_string(htmlspecialchars($prenom));        
        $mail = mysql_real_escape_string(htmlspecialchars($mail));

        if ($idEntreprise != FALSE && $nom != FALSE
                && $prenom != FALSE 
                && $mail != FALSE) {


            $requete = "INSERT INTO contact (identreprise, prenomcontact, nomcontact, fonctioncontact,
                dateajout, datederniereactivite, telfixecontact, telmobilecontact, mailcontact) 
                VALUES ('$idEntreprise', '$prenom', '$nom', '$fonction', NOW(), NOW(), '$telephoneFixe', '$telephoneMobile', '$mail')";

            mysql_query($requete);
            $id = mysql_insert_id();
            return $id ;
        }else{
            
            return -1;
        }
    }
    
    
    
    
    
    public static function supprimerTechnoProposition($idProposition){

        BDEtudiant::getConnection();
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));

        if ($idProposition != FALSE){

            
            $requete = "DELETE FROM technoproposition WHERE idproposition = ".$idProposition;
            mysql_query($requete);
        }

        
    }

    public static function ajouterTechnoProposition($idProposition, $idtechno){

        BDEtudiant::getConnection();

        $requete = "INSERT INTO technoproposition(idproposition, idtechno) VALUES(".$idProposition.",". $idtechno.")";
        mysql_query($requete);
    }

    public static function ajouterPropositionStage($idEntreprise, $sujetStage, $titreStage, $technoStage, $idFiche, $idFicheSujet) {

        BDEtudiant::getConnection();

        $idEntreprise = mysql_real_escape_string(htmlspecialchars($idEntreprise));
        $sujetStage = mysql_real_escape_string(htmlspecialchars($sujetStage));
        $titreStage = mysql_real_escape_string(htmlspecialchars($titreStage));
        $idproposition = 0 ;

        if ($idEntreprise != FALSE && $sujetStage != FALSE
                && $titreStage != FALSE ) {

            $modeleUtilisateur = $_SESSION['modeleUtilisateur'];
            $idUtilisateur = $modeleUtilisateur->getId();

            //avant d'insérer une proposition on vérifie que celle-ci n'existe pas dans la base
            //(pour empêcher les doublons suite à un F5 dans le navigateur, par exemple)
            $requete = "SELECT idproposition FROM proposition WHERE idutilisateur='$idUtilisateur' AND identreprise='$idEntreprise' AND sujetstagep='$sujetStage'";
            
            $retour = mysql_query($requete);

            $nombreDeLignes = mysql_num_rows($retour);

            if ($nombreDeLignes == 0) {

                $requete = "INSERT into proposition (idproposition, identreprise, idutilisateur, 
                    sujetstagep, titrestagep, technostagep, etat, dateproposition, idstage) 
                    VALUES ('', '$idEntreprise', '$idUtilisateur', '$sujetStage','$titreStage','$technoStage', 'en attente', NOW(), NULL)";


                mysql_query($requete);
                
                $idproposition = mysql_insert_id();
                $requete = "UPDATE ficherenseignement SET idproposition=".$idproposition." WHERE id=".$idFiche;
                mysql_query($requete);
                if ($idFicheSujet != NULL){
                
                    $requete = "UPDATE fichesujetstage SET idproposition=".$idproposition." WHERE id=".$idFicheSujet;
                    mysql_query($requete);
                }
            } else {

                // il y a un doublon, donc on ne fait rien
            }
        }
        return $idproposition;
    }

    /**
     * return true si $nom est le nom d'une entreprise dans la base, false sinon
     * @param type $nom
     * @return type 
     */
    public static function entrepriseExistante($nom) {

        BDEtudiant::getConnection();
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
        
        BDEtudiant::getConnection();
        $i = 0;
        $tabProp = null;
        $idUser = $_SESSION['modeleUtilisateur']->getId();
        $requete = "SELECT p.idproposition, p.raisonrefus, e.nomentreprise, p.dateproposition, e.adresseentreprise, e.villeentreprise, e.codepostalentreprise, e.paysentreprise, e.numerotelephone, e.urlsiteinternet, p.titrestagep, p.etat
                        FROM proposition p, entreprise e
                        WHERE p.idutilisateur = '$idUser'
                        AND p.identreprise = e.identreprise
                        AND p.etat!='validee'";
        
        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {
            $tabProp[$i] = new ModeleProposition($tableau['idproposition'], null, null, null, $tableau['nomentreprise'], $tableau['dateproposition'], $tableau['adresseentreprise'], $tableau['codepostalentreprise'], $tableau['villeentreprise'], $tableau['paysentreprise'], $tableau['numerotelephone'], $tableau['urlsiteinternet'], null, $tableau['etat'], null, null, $tableau['titrestagep'], null, $tableau['raisonrefus']);
            $i++;
        }
        return $tabProp;
    }
    
    /**
     * Permet de savoir si un étudiant à le droit d'éditer une proposition de stage
     * (c'est à dire si la proposition de stage $idProposition correspond à une de ses propositions)
     * @param type $idProposition 
     */
    public static function autorisationEditerProposition($idProposition, $idUtilisateur){
        
        BDEtudiant::getConnection();
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));
        
        
        if ($idProposition != FALSE) {
        
            $requete = "SELECT * FROM proposition WHERE idproposition='$idProposition' AND idutilisateur='$idUtilisateur'";
            $retour = mysql_query($requete);
            $nombreDeLignes = mysql_num_rows($retour);

            if ($nombreDeLignes > 0) {
                
                return TRUE ;
            }else{
                
                return FALSE ;
            }
        }else{
            
            return FALSE ;
        }
    }
    
    public static function supprimerProposition ($idProposition){
        
        BDEtudiant::getConnection();
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));
        
        if ($idProposition != FALSE) {
            
            
            $requete = "DELETE FROM proposition WHERE idproposition='$idProposition'";
            mysql_query($requete);
        }
    }
    
    public static function editerPropositionStage($idProposition, $sujetStage, $titreStage, $technoStage){
    
        BDEtudiant::getConnection();
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));
        $sujetStage = mysql_real_escape_string(htmlspecialchars($sujetStage));
        $titreStage = mysql_real_escape_string(htmlspecialchars($titreStage));
        $technoStage = mysql_real_escape_string(htmlspecialchars($technoStage));
        
        if ($idProposition != FALSE && $sujetStage != FALSE
         && $titreStage != FALSE && $technoStage != FALSE) {
            
            $requete = "UPDATE proposition SET sujetstagep = '$sujetStage', titrestagep = '$titreStage', technostagep = '$technoStage' WHERE idproposition = '$idProposition'";
            
            mysql_query($requete);
        }
    }
    
    /**ajout
     *Permet de recherche le stage d'un étudiant identifié par son id
     * @param type $idUtilisateur 
     */
    public static function rechercherStageEtudiant($idUtilisateur){
        
        BDEtudiant::getConnection();
        
        $stage = null;
        $requete = "SELECT stage.idstage, stage.identreprise, stage.idcontact,
                    stage.sujetstage, stage.datedebut, stage.datefin, stage.datesoutenance,
                    stage.idproposition, stage.remuneration, stage.lieusoutenance, stage.etatstage,
                    stage.respcivil, entreprise.nomentreprise, stage.titrestage, stage.technostage,
                    contact.prenomcontact, contact.nomcontact
                    FROM contact RIGHT JOIN stage ON contact.idcontact = stage.idcontact, 
                    entreprise, utilisateur
                    WHERE stage.identreprise = entreprise.identreprise
                    AND stage.idutilisateur = utilisateur.idutilisateur
                    AND stage.etatstage = 'en cours'
                    AND utilisateur.idutilisateur = '$idUtilisateur'
                    
        ";

        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {
            
            $contact = new ModeleContact(null, $tableau['prenomcontact'], $tableau['nomcontact'], null, null, null, null);
            $entreprise = new ModeleEntreprise(null, $tableau['nomentreprise'], null, null, null, null, null, null, null, null);
            $stage = new ModeleStage($tableau['idstage'], $tableau['identreprise'], $tableau['idcontact'], $tableau['sujetstage'], null, $tableau['datedebut'], $tableau['datefin'], null, null, $tableau['etatstage'], null, null, $tableau['remuneration'], null, null, null, $entreprise, $contact, null, $tableau['respcivil'], $tableau['titrestage'], $tableau['technostage']);
            $stage->setIdproposition($tableau['idproposition']);
        }
        
        return $stage;
    }
    
    public static function rechercherIdStageEtudiant($idUtilisateur, $idPromotion){
        BDEtudiant::getConnection();
        
        $stage = null;
        $requete = "SELECT s.idstage
                    FROM stage s, utilisateur u
                    WHERE s.idutilisateur = '$idUtilisateur'
                    AND s.idpromotion = '$idPromotion'
        ";

        $retour = mysql_query($requete) or die(mysql_error());

        while ($tableau = mysql_fetch_array($retour)) {
            $stage = new ModeleStage($tableau['idstage'], null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }
        
        return $stage;
    }

    public static function modifierPromotionEtudiant($idPromo){

        BDEtudiant::getConnection();
        $idPromo = mysql_real_escape_string(htmlspecialchars($idPromo));

        if ($idPromo != FALSE ) {

            $requete = "SELECT idpromotion FROM promotion WHERE idpromotion =".$idPromo;
            $retour = mysql_query($requete);
            while ($tableau = mysql_fetch_array($retour)) {

                $requete = "UPDATE utilisateur SET idpromotion = ".$idPromo." WHERE idutilisateur= ".$_SESSION['modeleUtilisateur']->getId();
                mysql_query($requete);
                BDEtudiant::rechargerSessionUtilisateur();
            }
        }
    }

    private static function rechargerSessionUtilisateur(){

        $requete = "SELECT u.idutilisateur, u.idpromotion, p.nompromotion, u.mailutilisateur, u.passwordutilisateur, u.nomutilisateur, u.prenomutilisateur, u.numetudiant, u.admin
            FROM utilisateur u, promotion p
            WHERE u.idutilisateur = ".$_SESSION['modeleUtilisateur']->getId()."
            AND  u.idpromotion = p.idpromotion";

        $retour = mysql_query($requete);
        while ($tableau = mysql_fetch_array($retour)) {

            $modeleUtilisateur = new ModeleUtilisateur($tableau['idutilisateur'], $tableau['nompromotion'], $tableau['numetudiant'], $tableau['prenomutilisateur'], $tableau['nomutilisateur'], $tableau['mailutilisateur'], $tableau['admin'], $tableau['idpromotion']);
            $_SESSION['modeleUtilisateur'] = $modeleUtilisateur;
        }
    }

    public static function changerMdpEtudiant($ancien, $nouveau){

        BDEtudiant::getConnection();
        $ancien = mysql_real_escape_string(htmlspecialchars($ancien));
        $nouveau = mysql_real_escape_string(htmlspecialchars($nouveau));

        if ($ancien != FALSE && $nouveau != FALSE ) {

            $requete = "SELECT passwordutilisateur FROM utilisateur WHERE passwordutilisateur = '".sha1($ancien)."'";
            $retour = mysql_query($requete);

            while ($tableau = mysql_fetch_array($retour)) {

                $requete = "UPDATE utilisateur SET passwordutilisateur = '".sha1($nouveau)."' WHERE idutilisateur = ".$_SESSION['modeleUtilisateur']->getId();
                $retour = mysql_query($requete);
                return "Changement de mot de passe effectu&eacute;";
            }
            return "Mauvais mot de passe";
        }
    }

    public static function changerNumEtudiant($numEtudiant){

        BDEtudiant::getConnection();
        $numEtudiant = mysql_real_escape_string(htmlspecialchars($numEtudiant));

        if ($numEtudiant != FALSE ) {

            $requete = "UPDATE utilisateur SET numetudiant = '".$numEtudiant."' WHERE idutilisateur = ".$_SESSION['modeleUtilisateur']->getId();
            mysql_query($requete);   
            BDEtudiant::rechargerSessionUtilisateur();
        }
    }
        
    public static function modifierDonneesStageEtudiant() {
        
        BDEtudiant::getConnection();
        $idStage = mysql_real_escape_string(htmlspecialchars($_GET['idstage']));
        
        $datedeb = mysql_real_escape_string(htmlspecialchars($_POST['datedeb']));
        if($datedeb == NULL){
            $datedeb = "NULL";
        }
        $datefin = mysql_real_escape_string(htmlspecialchars($_POST['datefin']));
        if($datefin == NULL){
            $datefin = "NULL";
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
        
        $datedeb = BDEtudiant::dateFRtoEN($datedeb);
        $dateembauche = BDEtudiant::dateFRtoEN($dateembauche);
        $datefin = BDEtudiant::dateFRtoEN($datefin);
        
        
        $requete = "UPDATE stage SET datedebut = '$datedeb', 
        datefin = '$datefin', remuneration = $remuneration, embauche = $embauche, dateembauche = '$dateembauche'
        WHERE idstage = $idStage";
        
        
        if(mysql_query($requete)){
            return true;
        }else{
            echo mysql_error();
            return false;
        }
        
    }    
    
    
    /**
     * Permet de valider un stage, c'est à dire de passer son état à "validé"
     * @param type $idStage 
     */
    public static function validerStage($idStage) {

        BDEtudiant::getConnection();
        $idStage = mysql_real_escape_string(htmlspecialchars($idStage));

        if ($idStage != FALSE) {

            $requete = "UPDATE stage SET etatstage = 'valide' WHERE idstage = '$idStage'";
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
