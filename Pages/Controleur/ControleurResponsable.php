<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorps.php';
require_once 'BD.php';

    function validerModifStage(){
        $ok = BD::modifierDonneesStage();
        $corps = genererValiderModificationsStage($ok);
        AffichePage(TRUE, $corps);
    }

    function ListePropositionStageResponsable() {
        $tabProp = BD::rechercherToutesPropositions();
        $corps = genererListePropositionStageResponsable($tabProp);
        AffichePage(TRUE, $corps);
    }

    function afficherDetailProposition(){
        $proposition = BD::rechercherProposition($_GET['idprop']);
        $corps = genererDetailProposition($proposition);
        AffichePage(TRUE, $corps);        
    }

    function afficherEditerStage(){
        $stage = BD::rechercherStageByID($_GET['idstage']); 
        $corps = genererEditerStage($stage);
        AffichePage(TRUE, $corps);   
    }

    function validerProposition(){
        $ok = BD::validerProposition($idProp);
        $corps = genererValiderProposition($ok);
        AffichePage(TRUE, $corps);     
    }

    function afficherListeStage(){
        $tabStage = BD::rechercherStage();
        $corps = genererListeStage($tabStage);
        AffichePage(TRUE, $corps);     
    }


    function afficherDetailStage(){
        $stage = BD::rechercherStageByID($_GET['idstage']);
        $corps = genererDetailStage($stage);
        AffichePage(TRUE, $corps);
    }

    function afficherGererCompteAdmin(){

        $tabAdmin = BD::rechercheListeAdmin();
        $tabPromotion = BD::recherchePromotion();
        $corps = genererGererCompteAdmin($tabAdmin, $tabPromotion);
        AffichePage(TRUE, $corps);
    }
    
    function ajouterAdmin(){

        if (isset($_POST['nom_admin']) && $_POST['nom_admin'] != ""
                && isset($_POST['prenom_admin']) && $_POST['prenom_admin'] != ""
                && isset($_POST['mail_admin']) && $_POST['mail_admin'] != ""
                && isset($_POST['mdp_admin']) && $_POST['mdp_admin'] != ""
                && isset($_POST['mdp2_admin']) && $_POST['mdp2_admin'] != ""
                ){
            
            if ( $_POST['mdp_admin'] ==  $_POST['mdp2_admin']){
                
                BD::ajouterAdmin($_POST['nom_admin'], $_POST['prenom_admin'], $_POST['mail_admin'], $_POST['mdp_admin'], $_POST['promotion']);
                $_REQUEST['action'] = "gererCompteAdmin";
                
            }else{
                $_REQUEST['action'] = "gererCompteAdmin";
            }
            
        }else{
            
            $_REQUEST['action'] = "gererCompteAdmin";

        }
        
        call_action();
    }
    
    function modifierAdmin(){

        if (isset($_POST['idUtilisateur']) && $_POST['idUtilisateur'] != ""){
            
            $modeleUtilisateur = BD::getAdminById($_POST['idUtilisateur']);
            $tabPromotion = BD::recherchePromotion();
            $corps = genererModiferCompteAdmin($modeleUtilisateur, $tabPromotion);
            AffichePage(TRUE, $corps);
            
        }else{
            
            $_REQUEST['action'] = "gererCompteAdmin";
            call_action();
        }
    }
    
    function modifierAdminEtape2(){
        
        if (isset($_POST['idUtilisateur']) && $_POST['idUtilisateur'] != ""
                && isset($_POST['nom_admin']) && $_POST['nom_admin'] != ""
                && isset($_POST['prenom_admin']) && $_POST['prenom_admin'] != ""
                && isset($_POST['mail_admin']) && $_POST['mail_admin'] != ""
                && isset($_POST['mdp_admin']) && $_POST['mdp_admin'] != ""
                && isset($_POST['mdp2_admin']) && $_POST['mdp2_admin'] != ""
                ){
            
            if ( $_POST['mdp_admin'] ==  $_POST['mdp2_admin']){
                
                BD::modifierAdmin($_POST['idUtilisateur'], $_POST['nom_admin'], $_POST['prenom_admin'], $_POST['mail_admin'], $_POST['mdp_admin'], $_POST['promotion']);
                $_REQUEST['action'] = "gererCompteAdmin";
                
            }else{
                $_REQUEST['action'] = "gererCompteAdmin";
            }
            
        }else{
            
            $_REQUEST['action'] = "gererCompteAdmin";

        }
        
        call_action();
    }
    
    function supprimerAdmin(){
        
        if (isset ($_GET['idAdmin'])){


            BD::supprimerAdmin($_GET['idAdmin']);
        }
        
        $_REQUEST['action'] = "gererCompteAdmin";
        call_action();
    }
    
    function afficherOption(){
        
        $tabPromotion = BD::recherchePromotion();
        $corps = genererAfficherOption($tabPromotion);
        AffichePage(TRUE, $corps);
    }

?>
