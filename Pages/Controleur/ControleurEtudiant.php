<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorps.php';
require_once 'BD.php';

    function proposerStageEtape3() {
        
        // on vérifie que l'utilisateur a renseigné un sujet
        if (isset($_POST['sujetStage']) && $_POST['sujetStage'] != ""){
            
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
            
            BD::ajouterPropositionStage($idEntreprise, $_POST['sujetStage']);
            
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
                        
                    $entreprise = new ModeleEntreprise(NULL, $_POST['nom_entreprise'], $_POST['num_rue'], $_POST['ville'], $_POST['code_postal'], $_POST['pays'], $_POST['tel_accueil'], $numeroSiret, $siteInternet);

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

        $corps = genererListePropositionStageEtudiant();
        AffichePage(TRUE, $corps);
    }
    
    function editerPropositionStage(){
        
        $utilisateur = $_SESSION['modeleUtilisateur'];
        
        //si le sujet de stage a déjà été modifié
        if (isset ($_GET['sujetModifie']) && $_GET['sujetModifie']=="true"){
            
            
            $operationPermise = BD::autorisationEditerProposition($_GET['idProposition'], $utilisateur->getId());

            if($operationPermise){
    
                $proposition = BD::editerPropositionStage($_GET['idProposition'], $_POST['sujetStage']);
            }

            $_REQUEST['action'] = "pagePrincipale";
            call_action();
            
        }
        //sinon affichage de la page editer stage
        else if (isset ($_GET['idProposition'])){
            
            $operationPermise = BD::autorisationEditerProposition($_GET['idProposition'], $utilisateur->getId());
            
            if($operationPermise){
    
                $proposition = BD::rechercherProposition($_GET['idProposition']);
                $corps = genererEditerPropositionEtudiant($proposition);
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
        BD::rechercherStage();
        $corps = genererPageAccueil();
        AffichePage(TRUE, $corps);
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

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
