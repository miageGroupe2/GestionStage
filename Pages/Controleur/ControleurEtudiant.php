<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorps.php';
require_once 'BDEtudiant.php';
require_once 'BDCommun.php';

    function proposerStageEtape3() {
        //jetais en train de faire les techno predefini (checkbokx) il reste plus qu'a faire des champs de recherche sur ces techno'
        $idFiche = 0 ;
        $idFiche = NULL ;
        $idFicheSujet = NULL ;

        // on vérifie que l'utilisateur a renseigné un sujet
        if (isset($_POST['sujetStage']) && $_POST['sujetStage'] != ""
                && isset($_POST['titreStage']) && $_POST['titreStage'] != "" ){

             // limite à 3 Mo
            if ($_FILES['ficherenseignement']['error'] == 0
                && $_FILES['ficherenseignement']['size'] <= 3145728){

                $nom = md5(uniqid(rand(), true)) ;
                $resultat = move_uploaded_file($_FILES['ficherenseignement']['tmp_name'],"./FicheRenseignement/".$nom);
                if($resultat ){

                    $idFiche = BDEtudiant::ajouterFicheRenseignement($_FILES['ficherenseignement']['name'],$_FILES['ficherenseignement']['type'], $nom);
                }


                
                if ($_FILES['fichesujetstage']['size'] != 0){

                    if ($_FILES['fichesujetstage']['error'] == 0
                        && $_FILES['fichesujetstage']['size'] <= 3145728){

                            $nomSujet = md5(uniqid(rand(), true)) ;
                            $resultat2 = move_uploaded_file($_FILES['fichesujetstage']['tmp_name'],"./FicheSujetStage/".$nomSujet);
                            if($resultat2 ){

                                $idFicheSujet = BDEtudiant::ajouterFicheSujetStage($_FILES['fichesujetstage']['name'],$_FILES['fichesujetstage']['type'], $nomSujet);
                            }
                        }else{

                            $corps = genererProblemeUploadFichier();
                            AffichePage(TRUE, $corps);
                            return ;
                        }
                }

                
            }else{
                $corps = genererProblemeUploadFichier();
                AffichePage(TRUE, $corps);
                return ;
            }


            $entreprise = $_SESSION['modeleEntreprise'];
            $idEntreprise = $entreprise->getId() ;
            
            //si l'entreprise n'a pas d'id c'est qu'elle n'existe pas
            //dans la base. Donc on l'ajoute
            if ($idEntreprise == NULL || $idEntreprise == ""){
                
                $idEntreprise = BDEtudiant::ajouterEntreprise($entreprise->getNom(), $entreprise->getAdresse(),
                        $entreprise->getVille(), $entreprise->getCodePostal(),
                        $entreprise->getPays(),
                        $entreprise->getNumeroTelephone(),
                        $entreprise->getUrlSiteInternet());
                
            }
            $technoDetails = "";
            if (isset($_POST['technoStage'])){
                $technoDetails = $_POST['technoStage'];
            }
            $idproposition = BDEtudiant::ajouterPropositionStage($idEntreprise, $_POST['sujetStage'], $_POST['titreStage'], $technoDetails, $idFiche, $idFicheSujet);

            if (isset ($_POST['check'])){
                $tabCheckBox = $_POST['check'] ;

                foreach($tabCheckBox as $techno){

                    BDEtudiant::ajouterTechnoProposition ($idproposition, $techno);
                }
            }

            $corps = genererProposerStageEtape3($entreprise);
            AffichePage(TRUE, $corps);
        }else{

            $_REQUEST['action'] = "pagePrincipale";
            call_action();
        }
        
    }

    function proposerStageEtape2() {

        $continuer = FALSE ;

        //si l'utilisateur a sélectionné une entreprise existante
        if (isset($_POST['idEntreprise']) && $_POST['idEntreprise'] != "ajouter"){


            $entreprise = BDEtudiant::rechercherEntrepriseById($_POST['idEntreprise']);
            if ( $entreprise != NULL){

                $continuer = TRUE ;
            }

        }else{
        // si l'utilisateur a ajouté une entreprise
            //on vérifie que tous les champs obligatoires sont remplis
            if (isset($_POST['nom_entreprise']) && $_POST['nom_entreprise'] != NULL
                && isset($_POST['num_rue']) && $_POST['num_rue'] != NULL 
                && isset($_POST['code_postal']) && $_POST['code_postal'] != NULL 
                && isset($_POST['ville']) && $_POST['ville'] != NULL 
                && isset($_POST['pays']) && $_POST['pays'] != NULL 
                && isset($_POST['tel_accueil']) && $_POST['tel_accueil'] != NULL  
                    ){


                $existe = BDEtudiant::entrepriseExistante($_POST['nom_entreprise']);

                if (!$existe){

                    $continuer = TRUE ;

                    $siteInternet = "" ;
                    if (isset($_POST['siteinternet']) && $_POST['siteinternet'] != NULL){
                        $siteInternet = $_POST['siteinternet'] ;
                    }
                    $numeroSiret = "" ;
                    if (isset($_POST['numerosiret']) && $_POST['numerosiret'] != NULL){
                        $numeroSiret = $_POST['numerosiret'] ;
                    }
                        
                    $entreprise = new ModeleEntreprise(NULL, $_POST['nom_entreprise'], $_POST['num_rue'], $_POST['ville'], $_POST['code_postal'], $_POST['pays'], $_POST['tel_accueil'], $numeroSiret, $siteInternet, null);

                }else{

                    $_REQUEST['action'] = "pagePrincipale";
                    call_action();
                }
            }else{
                $_REQUEST['action'] = "pagePrincipale";
                call_action();
            }
        }
        if ($continuer){

            $_SESSION['modeleEntreprise'] = $entreprise ;
            $technoTab = BDCommun::rechercheTechnos();
            $corps = genererProposerStageEtape2($entreprise,$technoTab);
            AffichePage(TRUE, $corps);
        }
    }

    function proposerStageEtape1() {

        $tabEntreprise = NULL ;

        // si l'utilisateur a renseigné le champs nom
        if (isset($_POST['nom']) && $_POST['nom'] != NULL){

            // on va chercher dans la base la liste des entreprises ayant un 
            //nom similaire
            $tabEntreprise = BDEtudiant::rechercherEntreprise($_POST['nom']);
        }


        $corps = genererProposerStage($tabEntreprise);
        AffichePage(TRUE, $corps);
    }

    function afficherListePropositionStageEtudiant() {

        $tabProp = BDEtudiant::rechercherPropositionsEtudiant();
        $corps = genererListePropositionStageEtudiant($tabProp);
        AffichePage(TRUE, $corps);
    }
    
    function editerPropositionStage(){
        
        $utilisateur = $_SESSION['modeleUtilisateur'];
        
        //si le sujet de stage a déjà été modifié
        if (isset ($_GET['sujetModifie']) && $_GET['sujetModifie']=="true"){
            
            
            $operationPermise = BDEtudiant::autorisationEditerProposition($_GET['idProposition'], $utilisateur->getId());

            if($operationPermise){

                BDEtudiant::editerPropositionStage($_GET['idProposition'], $_POST['sujetStage'], $_POST['titreStage'], $_POST['technoStage']);
                BDEtudiant::supprimerTechnoProposition($_GET['idProposition']);
                if (isset ($_POST['check'])){
                    $tabCheckBox = $_POST['check'] ;

                    foreach($tabCheckBox as $techno){

                        BDEtudiant::ajouterTechnoProposition ($_GET['idProposition'], $techno);
                    }
                }
                
                // limite à 3 Mo
                if ($_FILES['ficherenseignement']['error'] == 0
                        && $_FILES['ficherenseignement']['size'] <= 3145728){


                    $nom = md5(uniqid(rand(), true)) ;
                    $resultat = move_uploaded_file($_FILES['ficherenseignement']['tmp_name'],"./FicheRenseignement/".$nom);

                    if($resultat ){

                        BDEtudiant::modifierFicheRenseignement($_FILES['ficherenseignement']['name'], $_FILES['ficherenseignement']['type'], $nom, $_GET['idProposition']);

                    }else{

                        $corps = genererProblemeUploadFichier();
                        AffichePage(TRUE, $corps);
                        return ;
                    }

                }
                echo "avant fichier";
                if ($_FILES['fichesujetstage']['error'] == 0
                    && $_FILES['fichesujetstage']['size'] <= 3145728){

                    echo "dans fichier";
                    $nomSujet = md5(uniqid(rand(), true)) ;
                    $resultat2 = move_uploaded_file($_FILES['fichesujetstage']['tmp_name'],"./FicheSujetStage/".$nomSujet);


                    if($resultat2){

                        BDEtudiant::modifierFicheSujetStage($_FILES['fichesujetstage']['name'], $_FILES['fichesujetstage']['type'], $nomSujet, $_GET['idProposition']);

                    }else{

                        $corps = genererProblemeUploadFichier();
                        AffichePage(TRUE, $corps);
                        return ;
                    }
                }
            }

            $_REQUEST['action'] = "pagePrincipale";
            call_action();
            
        }
        //sinon affichage de la page editer stage
        else if (isset ($_GET['idProposition'])){
            
            $operationPermise = BDEtudiant::autorisationEditerProposition($_GET['idProposition'], $utilisateur->getId());
            
            if($operationPermise){
    
                $proposition = BDCommun::rechercherProposition($_GET['idProposition']);
                $modeleFicheRenseignement = BDCommun::rechercherFicheRenseignement($_GET['idProposition'], TRUE);
                $modeleFicheSujetStage = BDCommun::rechercherFicheSujetStage($_GET['idProposition'], TRUE);
                $technoTab = BDCommun::rechercheTechnos();
                $technoTabSelect = BDEtudiant::rechercheTechnosByProposition($_GET['idProposition']);
                $corps = genererEditerPropositionEtudiant($proposition, $modeleFicheRenseignement, $modeleFicheSujetStage, $technoTab, $technoTabSelect);
                AffichePage(TRUE, $corps);    
                
            }else{

                $_REQUEST['action'] = "pagePrincipale";
                call_action();
            }
        }
    }
    
    function editerStageEtudiant(){
        $utilisateur = $_SESSION['modeleUtilisateur'];
        $stage = BDEtudiant::rechercherStageEtudiant($utilisateur->getId());
        
        $corps = genererEditerStageEtudiant($stage);
        AffichePage(TRUE, $corps);
    }
    
     function validerModifStageEtudiant(){
        $ok = BDEtudiant::modifierDonneesStageEtudiant();
        $corps = genererValiderModificationsStage($ok);
        AffichePage(TRUE, $corps);
    }
    
    function supprimerProposition(){

        if (isset ($_GET['idProposition'])){

            $utilisateur = $_SESSION['modeleUtilisateur'];
            $operationPermise = BDEtudiant::autorisationEditerProposition($_GET['idProposition'], $utilisateur->getId());
            
            if($operationPermise){

                BDEtudiant::supprimerProposition($_GET['idProposition']);
            }
        }
        
        $_REQUEST['action'] = "pagePrincipale";
        call_action();
    }

    function afficherStageEtudiant() {
        $utilisateur = $_SESSION['modeleUtilisateur'];
        $idUtilisateur = $utilisateur->getId();
        $idPromotion = $utilisateur->getIdpromotion();
        
        $stage = BDEtudiant::rechercherIdStageEtudiant($idUtilisateur, $idPromotion);
        
        $stage = BDCommun::rechercherStageByID($stage->getIdstage());
        $modeleFicheRenseignement = BDCommun::rechercherFicheRenseignement($stage->getIdstage(), FALSE);
        $technoTab = BDCommun::rechercheTechnosModeleByProposition($stage->getIdproposition());
        $modeleFicheSujetStage = BDCommun::rechercherFicheSujetStage($stage->getIdstage(), FALSE);
        
        $corps = genererDetailStageEtudiant($stage, $modeleFicheRenseignement, $modeleFicheSujetStage, $technoTab);
        AffichePage(TRUE, $corps);
    }

    function modifierContactEtape1(){
        
        if (isset($_GET['idEntreprise']) && ($_GET['idEntreprise'] != null)) {

            
            $tabContact = BDEtudiant::rechercherContactParEntreprise($_GET['idEntreprise']);
            $corps = genererModifierContact($tabContact, $_GET['idEntreprise'], $_GET['idStage']);
            AffichePage(TRUE, $corps);
            
        }else {
            afficherPagePrincipale();
        }
    }
    
    function modifierContactEtape2(){
        
        $continuer = false ;
        $idContact = -1 ;
        
        //si l'utilisateur a sélectionné un contact existant
        if (isset($_POST['idContact']) && $_POST['idContact'] != "ajouter"){

            $continuer = TRUE ;
            $idContact = $_POST['idContact'] ;

        }else{
            
            // si l'utilisateur a ajouté un contact
            //on vérifie que tous les champs obligatoires sont remplis
            if (isset($_POST['nom_tuteur']) && $_POST['nom_tuteur'] != NULL
                && isset($_POST['prenom_tuteur']) && $_POST['prenom_tuteur'] != NULL 
                && isset($_POST['mail_tuteur']) && $_POST['mail_tuteur'] != NULL   
                    ){

                $idContact = BDEtudiant::ajouterContact($_POST['idEntreprise'],$_POST['nom_tuteur'], $_POST['prenom_tuteur'], $_POST['fonction_tuteur'], $_POST['tel_fixe'], $_POST['tel_port'], $_POST['mail_tuteur']);
                
                $continuer = true ;
                
            }else{
                $_REQUEST['action'] = "pagePrincipale";
                call_action();
            }
        }
        if ($continuer){

            $utilisateur = $_SESSION['modeleUtilisateur'];
            BDEtudiant::modifierContactDansStage($idContact, $_POST['idStage'], $utilisateur->getId());
            $_REQUEST['action'] = "voirStageEtudiant";
            call_action();
        }
    }
    
    function validerProposerStage(){
        
        // on vérifie que les champs obligatoire sont remplis
        if (isset ($_POST['nom']) && (!$_POST['nom'] == null)
                && isset ($_POST['prenom']) && (!$_POST['prenom'] == null)
                && ($_POST['promotion'] != "choisir")
                && isset ($_POST['nom_entreprise']) && (!$_POST['nom_entreprise'] == null)
                && isset ($_POST['num_rue']) && (!$_POST['num_rue'] == null)
                && isset ($_POST['code_postal']) && (!$_POST['code_postal'] == null)
                && isset ($_POST['ville']) && (!$_POST['ville'] == null)
                && isset ($_POST['tel_accueil']) && (!$_POST['tel_accueil'] == null)
                && isset ($_POST['sujet']) && (!$_POST['sujet'] == null)
                
                ){
         
            $corps = genererAjoutPropositionStageOk();
            BDEtudiant::ajouterPropositionStage($_POST['nom'], $_POST['prenom'], $_POST['formation'], $_POST['nom_entreprise'], $_POST['num_rue'], $_POST['code_postal'], $_POST['ville'], $_POST['tel_accueil'], $_POST['sujet']);
        }else{

            $corps = genererProposerStage(true);
        }
        //htmlspecialchars
        
        AffichePage(TRUE, $corps);
    }

    function afficherOptionEtudiant(){

        $messageChangementMdp = "" ;

        if (isset($_POST['changerPromotion'])&& isset($_POST['idPromo'])){

            BDEtudiant::modifierPromotionEtudiant($_POST['idPromo']);

        }else if (isset($_POST['changerMdp'])&& isset($_POST['password'])
                && isset($_POST['password2'])&& isset($_POST['password_old'])){

            if ($_POST['password'] != ''&& $_POST['password2']!= ''
            && $_POST['password_old']!= '' ){

                if ($_POST['password'] == $_POST['password2']){

                    $messageChangementMdp = BDEtudiant::changerMdpEtudiant($_POST['password_old'], $_POST['password']);
                }

            }

        }else if (isset($_POST['changerNumEtudiant'])&& isset($_POST['numEtudiant'])){

            if ($_POST['numEtudiant'] != ''){

                $messageChangementMdp = BDEtudiant::changerNumEtudiant($_POST['numEtudiant']);
            }
        }

        $tabPromotion = BDCommun::recherchePromotion();
        $corps = genererAfficherOptionEtudiant($tabPromotion, $messageChangementMdp);
        AffichePage(TRUE, $corps);
    }


?>
