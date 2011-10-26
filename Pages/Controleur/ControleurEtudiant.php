<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorps.php';
require_once 'BD.php';

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

                $entreprise = new ModeleEntreprise(NULL, $_POST['nom_entreprise'], $_POST['num_rue'], $_POST['code_postal'], $_POST['ville'], $_POST['pays'], $_POST['tel_accueil'], $numeroSiret, $siteInternet);
                

//                AffichePage($menuGauche, $corps);
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
            
        $tabContact = NULL ;
        // ici l'utilisteur a ajouté une entreprise (qui n'est pas encore en BD) ou en a
        // choisit une qui est dans la base. Si c'est le cas on va récupérer 
        // les contacts de cette entreprise dans la base
        if ( $entreprise->getId() != NULL){
            $tabContact = BD::rechercherContactParEntreprise($entreprise->getId());
        }
        
        $corps = genererProposerStageEtape2($tabContact);
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
    
    $corps = genererListePropositionStage();
    AffichePage(TRUE, $corps);
}

function afficherCompleterStage() {
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
