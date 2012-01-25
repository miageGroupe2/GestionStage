<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorps.php';
require_once 'BD.php';

    function proposerStageEtape3() {
        
        $idFiche = 0 ;
        $idFiche = NULL ;
        $idFicheSujet = NULL ;

        // on vérifie que l'utilisateur a renseigné un sujet
        if (isset($_POST['sujetStage']) && $_POST['sujetStage'] != ""
                && isset($_POST['titreStage']) && $_POST['titreStage'] != ""
                && isset($_POST['technoStage']) && $_POST['technoStage'] != "" ){

             // limite à 3 Mo
            if ($_FILES['ficherenseignement']['error'] == 0
                && $_FILES['ficherenseignement']['size'] <= 3145728
                && $_FILES['fichesujetstage']['error'] == 0
                && $_FILES['fichesujetstage']['size'] <= 3145728){
                

                $nom = md5(uniqid(rand(), true)) ;
                $resultat = move_uploaded_file($_FILES['ficherenseignement']['tmp_name'],"./FicheRenseignement/".$nom);

                $nomSujet = md5(uniqid(rand(), true)) ;
                $resultat2 = move_uploaded_file($_FILES['fichesujetstage']['tmp_name'],"./FicheSujetStage/".$nomSujet);

                

                if($resultat && $resultat2){

                    $idFiche = BD::ajouterFicheRenseignement($_FILES['ficherenseignement']['name'],$_FILES['ficherenseignement']['type'], $nom);
                    $idFicheSujet = BD::ajouterFicheSujetStage($_FILES['fichesujetstage']['name'],$_FILES['fichesujetstage']['type'], $nomSujet);
                }else{

                    $corps = genererProblemeUploadFichier();
                    AffichePage(TRUE, $corps);
                    return ;
                }
            }


            $entreprise = $_SESSION['modeleEntreprise'];
            $idEntreprise = $entreprise->getId() ;
            
            //si l'entreprise n'a pas d'id c'est qu'elle n'existe pas
            //dans la base. Donc on l'ajoute
            if ($idEntreprise == NULL || $idEntreprise == ""){
                
                $idEntreprise = BD::ajouterEntreprise($entreprise->getNom(), $entreprise->getAdresse(),
                        $entreprise->getVille(), $entreprise->getCodePostal(),
                        $entreprise->getPays(),
                        $entreprise->getNumeroTelephone(),
                        $entreprise->getUrlSiteInternet());
                
            }
            
            BD::ajouterPropositionStage($idEntreprise, $_POST['sujetStage'], $_POST['titreStage'], $_POST['technoStage'], $idFiche, $idFicheSujet);
            
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


            $entreprise = BD::rechercherEntrepriseById($_POST['idEntreprise']);
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


                $existe = BD::entrepriseExistante($_POST['nom_entreprise']);

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
                
            $corps = genererProposerStageEtape2($entreprise);
            AffichePage(TRUE, $corps);
        }
    }

    function proposerStageEtape1() {

        $tabEntreprise = NULL ;

        // si l'utilisateur a renseigné le champs nom
        if (isset($_POST['nom']) && $_POST['nom'] != NULL){

            // on va chercher dans la base la liste des entreprises ayant un 
            //nom similaire
            $tabEntreprise = BD::rechercherEntreprise($_POST['nom']);
        }


        $corps = genererProposerStage($tabEntreprise);
        AffichePage(TRUE, $corps);
    }

    function afficherListePropositionStageEtudiant() {

        $tabProp = BD::rechercherPropositionsEtudiant();
        $corps = genererListePropositionStageEtudiant($tabProp);
        AffichePage(TRUE, $corps);
    }
    
    function editerPropositionStage(){
        
        $utilisateur = $_SESSION['modeleUtilisateur'];
        
        //si le sujet de stage a déjà été modifié
        if (isset ($_GET['sujetModifie']) && $_GET['sujetModifie']=="true"){
            
            
            $operationPermise = BD::autorisationEditerProposition($_GET['idProposition'], $utilisateur->getId());

            if($operationPermise){

                $proposition = BD::editerPropositionStage($_GET['idProposition'], $_POST['sujetStage'], $_POST['titreStage'], $_POST['technoStage']);
                // limite à 3 Mo
                if ($_FILES['ficherenseignement']['error'] == 0
                        && $_FILES['ficherenseignement']['size'] <= 3145728
                        &&$_FILES['fichesujetstage']['error'] == 0
                        && $_FILES['fichesujetstage']['size'] <= 3145728){


                    $nom = md5(uniqid(rand(), true)) ;
                    $resultat = move_uploaded_file($_FILES['ficherenseignement']['tmp_name'],"./FicheRenseignement/".$nom);

                    $nomSujet = md5(uniqid(rand(), true)) ;
                    $resultat2 = move_uploaded_file($_FILES['fichesujetstage']['tmp_name'],"./FicheSujetStage/".$nomSujet);


                    if($resultat && $resultat2){

                        BD::modifierFicheRenseignement($_FILES['ficherenseignement']['name'], $_FILES['ficherenseignement']['type'], $nom, $_GET['idProposition']);
                        BD::modifierFicheSujetStage($_FILES['fichesujetstage']['name'], $_FILES['fichesujetstage']['type'], $nomSujet, $_GET['idProposition']);

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
            
            $operationPermise = BD::autorisationEditerProposition($_GET['idProposition'], $utilisateur->getId());
            
            if($operationPermise){
    
                $proposition = BD::rechercherProposition($_GET['idProposition']);
                $modeleFicheRenseignement = BD::rechercherFicheRenseignement($_GET['idProposition'], TRUE);
                $modeleFicheSujetStage = BD::rechercherFicheSujetStage($_GET['idProposition'], TRUE);
                $corps = genererEditerPropositionEtudiant($proposition, $modeleFicheRenseignement, $modeleFicheSujetStage);
                AffichePage(TRUE, $corps);    
                
            }else{

                $_REQUEST['action'] = "pagePrincipale";
                call_action();
            }
        }
    }
    
    function supprimerProposition(){

        if (isset ($_GET['idProposition'])){

            $utilisateur = $_SESSION['modeleUtilisateur'];
            $operationPermise = BD::autorisationEditerProposition($_GET['idProposition'], $utilisateur->getId());
            
            if($operationPermise){

                BD::supprimerProposition($_GET['idProposition']);
            }
        }
        
        $_REQUEST['action'] = "pagePrincipale";
        call_action();
    }

    function afficherStageEtudiant() {
        
        $utilisateur = $_SESSION['modeleUtilisateur'];
        $stage = BD::rechercherStageEtudiant($utilisateur->getId());
        
        $corps = genererVoirStageEtudiant($stage);
        AffichePage(TRUE, $corps);
    }

    function modifierContactEtape1(){
        
        if (isset($_GET['idEntreprise']) && ($_GET['idEntreprise'] != null)) {

            
            $tabContact = BD::rechercherContactParEntreprise($_GET['idEntreprise']);
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

                $idContact = BD::ajouterContact($_POST['idEntreprise'],$_POST['nom_tuteur'], $_POST['prenom_tuteur'], $_POST['fonction_tuteur'], $_POST['tel_fixe'], $_POST['tel_port'], $_POST['mail_tuteur']);
                
                $continuer = true ;
                
            }else{
                $_REQUEST['action'] = "pagePrincipale";
                call_action();
            }
        }
        if ($continuer){

            $utilisateur = $_SESSION['modeleUtilisateur'];
            BD::modifierContactDansStage($idContact, $_POST['idStage'], $utilisateur->getId());
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
            BD::ajouterPropositionStage($_POST['nom'], $_POST['prenom'], $_POST['formation'], $_POST['nom_entreprise'], $_POST['num_rue'], $_POST['code_postal'], $_POST['ville'], $_POST['tel_accueil'], $_POST['sujet']);
        }else{

            $corps = genererProposerStage(true);
        }
        //htmlspecialchars
        
        AffichePage(TRUE, $corps);
    }

    function afficherOptionEtudiant(){

        $messageChangementMdp = "" ;

        if (isset($_POST['changerPromotion'])&& isset($_POST['idPromo'])){

            BD::modifierPromotionEtudiant($_POST['idPromo']);

        }else if (isset($_POST['changerMdp'])&& isset($_POST['password'])
                && isset($_POST['password2'])&& isset($_POST['password_old'])){

            if ($_POST['password'] != ''&& $_POST['password2']!= ''
            && $_POST['password_old']!= '' ){

                if ($_POST['password'] == $_POST['password2']){

                    $messageChangementMdp = BD::changerMdpEtudiant($_POST['password_old'], $_POST['password']);
                }

            }

        }else if (isset($_POST['changerNumEtudiant'])&& isset($_POST['numEtudiant'])){

            if ($_POST['numEtudiant'] != ''){

                $messageChangementMdp = BD::changerNumEtudiant($_POST['numEtudiant']);
            }
        }

        $tabPromotion = BD::recherchePromotion();
        $corps = genererAfficherOptionEtudiant($tabPromotion, $messageChangementMdp);
        AffichePage(TRUE, $corps);
    }


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
