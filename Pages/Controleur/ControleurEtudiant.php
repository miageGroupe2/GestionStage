<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorps.php';
require_once 'BD.php';

    function proposerStageEtape3() {
        
        $continuer = FALSE ;
        
        //si l'utilisateur a sélectionné un tuteur existant
        if (isset($_POST['idContact']) && $_POST['idContact'] != "ajouter"){


            $contact = BD::rechercherContactById($_POST['idContact']);
            if ( $contact != NULL){

                $continuer = TRUE ;
            }

        }else{
        // si l'utilisateur a ajouté un tuteur
            //on vérifie que tous les champs obligatoires sont remplis
            if (isset($_POST['nom_tuteur']) && $_POST['nom_tuteur'] != NULL
                && isset($_POST['prenom_tuteur']) && $_POST['prenom_tuteur'] != NULL 
                ){

                    $continuer = TRUE ;

                    $fonctionTuteur = "" ;
                    if (isset($_POST['fonction_tuteur']) && $_POST['fonction_tuteur'] != NULL){
                        $fonctionTuteur = $_POST['fonction_tuteur'] ;
                    }
                    $telFixe = "" ;
                    if (isset($_POST['tel_fixe']) && $_POST['tel_fixe'] != NULL){
                        $telFixe = $_POST['tel_fixe'] ;
                    }
                    $telPort = "" ;
                    if (isset($_POST['tel_port']) && $_POST['tel_port'] != NULL){
                        $telPort = $_POST['tel_port'] ;
                    }
                    $mail = "" ;
                    if (isset($_POST['mail']) && $_POST['mail'] != NULL){
                        $$mail = $_POST['mail'] ;
                    }

                    $contact = new ModeleContact(NULL, $_POST['prenom_tuteur'], $_POST['nom_tuteur'], $_POST['fonction_tuteur'], $_POST['tel_fixe'], $_POST['tel_port'], $_POST['mail']);
                    

            }else{
                $_REQUEST['action'] = "pagePrincipale";
                call_action();
            }
        }
        if ($continuer){

            //on récupère l'entreprise qui était en session
            $entreprise = $_SESSION['modeleEntreprise'];
            
            if ($entreprise != NULL){
                
                $corps = genererProposerStageEtape3($entreprise, $contact);
                AffichePage(TRUE, $corps);
            }
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

                    $entreprise = new ModeleEntreprise(NULL, $_POST['nom_entreprise'], $_POST['num_rue'], $_POST['code_postal'], $_POST['ville'], $_POST['pays'], $_POST['tel_accueil'], $numeroSiret, $siteInternet);

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

            // on stocke en session l'instance de la classe ModeleEntreprise
            // correspondante à l'entreprise choisit par l'utilisateur
            unset($_SESSION['modeleEntreprise']);
            $_SESSION['modeleEntreprise'] = $entreprise ;
            
            $tabContact = NULL ;
            // ici l'utilisteur a ajouté une entreprise (qui n'est pas encore en BD) ou en a
            // choisit une qui est dans la base. Si c'est le cas on va récupérer 
            // les contacts de cette entreprise dans la base
            if ( $entreprise->getId() != NULL){
                $tabContact = BD::rechercherContactParEntreprise($entreprise->getId());
            }

            $corps = genererProposerStageEtape2($tabContact);
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
