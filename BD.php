<?php

require_once RACINE_MODELE . 'ModeleEntreprise.php';
require_once RACINE_MODELE . 'ModeleStage.php';
require_once RACINE_MODELE . 'ModeleContact.php';
require_once RACINE_MODELE . 'ModeleUtilisateur.php';
require_once RACINE_MODELE . 'ModeleProposition.php';
require_once RACINE_MODELE . 'ModelePromotion.php';
require_once RACINE_MODELE . 'ModeleFicheRenseignement.php';
require_once RACINE_MODELE . 'ModeleFicheSujetStage.php';

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

    public static function confirmationInscription($id){
        
        BD::getConnection();
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

        BD::getConnection();
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

        BD::getConnection();
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

        BD::getConnection();
        $nomOriginal = mysql_real_escape_string(htmlspecialchars($nomOriginal));
        $nomUnique = mysql_real_escape_string(htmlspecialchars($nomUnique));
        $idFiche = 0 ;

        if ($nomOriginal != FALSE && $nomUnique != FALSE) {

            $requete = "INSERT INTO fichesujetstage (nomoriginal, nomunique, type) VALUES ('".$nomOriginal."','".$nomUnique."','".$type."')";
            echo $requete;
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

        BD::getConnection();
        $nomOriginal = mysql_real_escape_string(htmlspecialchars($nomOriginal));
        $nomUnique = mysql_real_escape_string(htmlspecialchars($nomUnique));
        $idFiche = 0 ;

        if ($nomOriginal != FALSE && $nomUnique != FALSE) {

            $requete = "INSERT INTO ficherenseignement (nomoriginal, nomunique, type) VALUES ('".$nomOriginal."','".$nomUnique."','".$type."')";
            echo $requete ;
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

        BD::getConnection();
        $nomOriginal = mysql_real_escape_string(htmlspecialchars($nomOriginal));
        $nomUnique = mysql_real_escape_string(htmlspecialchars($nomUnique));
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));

        if ($nomOriginal != FALSE && $nomUnique != FALSE && $idProposition != FALSE) {

            $requete = "UPDATE ficherenseignement SET nomoriginal = '".$nomOriginal."', nomunique = '".$nomUnique."', type = '".$type."' WHERE idproposition=".$idProposition;
            mysql_query($requete);


        }
    }

    public static function modifierFicheSujetStage($nomOriginal, $type, $nomUnique, $idProposition) {

        BD::getConnection();
        $nomOriginal = mysql_real_escape_string(htmlspecialchars($nomOriginal));
        $nomUnique = mysql_real_escape_string(htmlspecialchars($nomUnique));
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));

        if ($nomOriginal != FALSE && $nomUnique != FALSE && $idProposition != FALSE) {

            $requete = "UPDATE fichesujetstage SET nomoriginal = '".$nomOriginal."', nomunique = '".$nomUnique."', type = '".$type."' WHERE idproposition=".$idProposition;
            mysql_query($requete);


        }
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
    public static function modifierContactDansStage($idContact,$idStage, $idUtilisateur){
        
        BD::getConnection();
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

        BD::getConnection();
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
    
    public static function ajouterAdmin($nom, $prenom, $mail, $mdp, $idPromotion) {

        BD::getConnection();
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
    
    public static function modifierAdmin($idUtilisateur, $nom, $prenom, $mail, $mdp, $idPromotion) {

        BD::getConnection();
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

        BD::getConnection();
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

    public static function ajouterPropositionStage($idEntreprise, $sujetStage, $titreStage, $technoStage, $idFiche, $idFicheSujet) {

        BD::getConnection();

        $idEntreprise = mysql_real_escape_string(htmlspecialchars($idEntreprise));
        $sujetStage = mysql_real_escape_string(htmlspecialchars($sujetStage));
        $titreStage = mysql_real_escape_string(htmlspecialchars($titreStage));
        $technoStage = mysql_real_escape_string(htmlspecialchars($technoStage));

        if ($idEntreprise != FALSE && $sujetStage != FALSE 
                && $titreStage != FALSE && $technoStage != FALSE ) {

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
        
        BD::getConnection();
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
        
        BD::getConnection();
        $idProposition = mysql_real_escape_string(htmlspecialchars($idProposition));
        
        if ($idProposition != FALSE) {
            
            
            $requete = "DELETE FROM proposition WHERE idproposition='$idProposition'";
            mysql_query($requete);
        }
    }
    
    public static function editerPropositionStage($idProposition, $sujetStage, $titreStage, $technoStage){
    
        BD::getConnection();
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
        
        BD::getConnection();
        
        $stage = null;
        $requete = "SELECT stage.idstage, stage.identreprise, stage.idcontact,
                    stage.sujetstage, stage.datedebut, stage.datefin, stage.datesoutenance,
                    stage.remuneration, stage.lieusoutenance, stage.etatstage,
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
            
        }
        
        return $stage;
    }

    public static function modifierPromotionEtudiant($idPromo){

        BD::getConnection();
        $idPromo = mysql_real_escape_string(htmlspecialchars($idPromo));

        if ($idPromo != FALSE ) {

            $requete = "SELECT idpromotion FROM promotion WHERE idpromotion =".$idPromo;
            $retour = mysql_query($requete);
            while ($tableau = mysql_fetch_array($retour)) {

                $requete = "UPDATE utilisateur SET idpromotion = ".$idPromo." WHERE idutilisateur= ".$_SESSION['modeleUtilisateur']->getId();
                mysql_query($requete);
                BD::rechargerSessionUtilisateur();
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

        BD::getConnection();
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

        BD::getConnection();
        $numEtudiant = mysql_real_escape_string(htmlspecialchars($numEtudiant));

        if ($numEtudiant != FALSE ) {

            $requete = "UPDATE utilisateur SET numetudiant = '".$numEtudiant."' WHERE idutilisateur = ".$_SESSION['modeleUtilisateur']->getId();
            mysql_query($requete);   
            BD::rechargerSessionUtilisateur();
        }
    }

    //-----------------------------------------------------------------------------------------
    // PARTIE DES ACCES BASES ADMIN
    //-----------------------------------------------------------------------------------------    

    public static function ajouterPromotion($promo){
        
        BD::getConnection();
        $promo = mysql_real_escape_string(htmlspecialchars($promo));

        if ($promo != FALSE ) {

            $requete = "INSERT INTO promotion (nompromotion, accesentreprises) 
                VALUES ('$promo', '1')";

            mysql_query($requete);   
        }
    }
    
    public static function supprimerPromotion($idPromo){
        
        BD::getConnection();
        $idPromo = mysql_real_escape_string(htmlspecialchars($idPromo));

        if ($idPromo != FALSE ) {

            $requete = "DELETE FROM promotion WHERE idpromotion='$idPromo'";

            mysql_query($requete);   
        }
    }
    
    
    
    
    public static function getAdminById($idUtilisateur) {

        BD::getConnection();
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
    
    
    //retourne toutes les promotions
    public static function recherchePromotion(){
        
        BD::getConnection();
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
    
    // permet de retourner la liste des admin
    public static function rechercheListeAdmin(){
        
        BD::getConnection();
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
    
    /**
     * Permet d'afficher toutes les propositions de stage
     */
    public static function rechercherToutesPropositions() {
        BD::getConnection();
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

    public static function rechercherFicheSujetStage($id, $estUneProposition){

        BD::getConnection();

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

    public static function rechercherFicheRenseignement($id, $estUneProposition){

        BD::getConnection();

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
echo $requete;
            $retour = mysql_query($requete) ;
            
            while ($tableau = mysql_fetch_array($retour)) {

                $modeleFicheRenseignement = new ModeleFicheRenseignement($tableau['id'], $tableau['nomoriginal'], $tableau['nomunique'], $tableau['type']);
            }

        }

        return $modeleFicheRenseignement ;
    }
    /**
     * Permet d'obtenir la proposition $idProposition
     */
    public static function rechercherProposition($idProposition) {

        BD::getConnection();

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
                    
                    $entreprise = BD::rechercherEntrepriseById($tableau['identreprise']);
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

    public static function refuserProposition($idProp, $raisonrefus) {

        BD::getConnection();
        $idProp = mysql_real_escape_string(htmlspecialchars($idProp));
        $raisonrefus = mysql_real_escape_string(htmlspecialchars($raisonrefus));

        if ($idProp != FALSE ) {

            $requete = "UPDATE proposition SET raisonrefus='".$raisonrefus."', etat='refusée'
                WHERE idproposition=".$idProp;
                echo $requete ;
            mysql_query($requete);
        }

    }
    public static function validerProposition($idProp) {
        $i = 0;
        $tabProp = null;
        BD::getConnection();
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
            echo "AAAAA".$requete;
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
        BD::getConnection();
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
    
    public static function rechercherStageAnneeCourante($promotion){
        BD::getConnection();
        $tabStage = null;
        $i=0;

        $dateDuJour = date("Y/m/d");
        
        
        $requete = "SELECT s.idstage, s.etatstage, s.datevalidation, u.nomutilisateur,
                    u.prenomutilisateur, e.nomentreprise, e.villeentreprise, e.paysentreprise,
                    s.titrestage, pr.nompromotion
                    FROM stage s, entreprise e, utilisateur u, promotion pr
                    WHERE u.idutilisateur = s.idutilisateur
                    AND u.idpromotion = pr.idpromotion
                    AND u.idpromotion = $promotion
                    AND s.identreprise = e.identreprise
                    
        ";
        echo $requete ;
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
    
     
    public static function rechercherStageByID($idstage){
        BD::getConnection();
        $tabStage = null;
        $i=0;
        $requete = "SELECT s.idstage, s.datevalidation, s.sujetstage, s.titrestage, s.technostage, u.numetudiant, u.nomutilisateur, 
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
            $tabStage[$i] = new ModeleStage($tableau['idstage'], null, null, $tableau['sujetstage'], BD::dateENtoFR($tableau['datevalidation']), BD::dateENtoFR($tableau['datedebut']), BD::dateENtoFR($tableau['datefin']), BD::dateENtoFR($tableau['datesoutenance']), $tableau['lieusoutenance'], $tableau['etatstage'], $tableau['noteobtenue'], $tableau['appreciationobtenue'], $tableau['remuneration'], $tableau['embauche'], BD::dateENtoFR($tableau['dateembauche']), $etudiant, $entreprise, $contact, $promotion, $tableau['respcivil'],$tableau['titrestage'],$tableau['technostage']);
            $i++;
            
        }
        
        return $tabStage[0];
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

    
    public static function modifierDonneesStage() {
        
        BD::getConnection();
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
        
        $datedeb = BD::dateFRtoEN($datedeb);
        $dateembauche = BD::dateFRtoEN($dateembauche);
        $datefin = BD::dateFRtoEN($datefin);
        $datesoutenance = BD::dateFRtoEN($datesoutenance);
        
        
        $requete = "UPDATE stage SET etatstage = \"$etatstage\", respcivil = $respcivile, datedebut = '$datedeb', 
        datefin = '$datefin', datesoutenance = '$datesoutenance', lieusoutenance = \"$lieusoutenance\",
        noteobtenue = \"$noteobtenue\", appreciationobtenue = \"$appreciationobtenue\", 
        remuneration = $remuneration, embauche = $embauche, dateembauche = '$dateembauche'
        WHERE idstage = $idStage";
        
        
        if(mysql_query($requete)){
            return true;
        }else{
            echo mysql_error();
            return false;
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
