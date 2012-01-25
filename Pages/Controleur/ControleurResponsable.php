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
        $modeleFicheRenseignement = BD::rechercherFicheRenseignement($_GET['idprop'], TRUE);
        $modeleFicheSujetStage = BD::rechercherFicheSujetStage($_GET['idprop'], TRUE);
        $tabTechno = BD::rechercheTechnoByProposition($_GET['idprop']);
        $corps = genererDetailProposition($proposition, $modeleFicheRenseignement, $modeleFicheSujetStage, $tabTechno);
        AffichePage(TRUE, $corps);        
    }

    function afficherEditerStage(){
        $stage = BD::rechercherStageByID($_GET['idstage']); 
        $corps = genererEditerStage($stage);
        AffichePage(TRUE, $corps);   
    }

    function validerProposition(){

        $valider = true ;

        if(isset($_POST['refuser'])){

            $valider = false ;
            $raisonrefus = "" ;
            
            if(isset($_POST['raisonrefus'])){

                $raisonrefus = $_POST['raisonrefus'] ;
            }
            BD::refuserProposition($_GET['idprop'], $raisonrefus);
        }else{
            
            BD::validerProposition($_GET['idprop']);
        }

        
        $corps = genererValiderProposition($valider);
        AffichePage(TRUE, $corps);     
    }

    function afficherListeStage(){
        $tabStage = BD::rechercherStage();
        $corps = genererListeStage($tabStage);
        AffichePage(TRUE, $corps);     
    }

    function afficherListeStageAnneeCourante(){

        $utilisateur = $_SESSION['modeleUtilisateur'];        
        $promotion = $utilisateur->getIdPromotion();
        $tabStage = BD::rechercherStageAnneeCourante($promotion);
        $corps = genererListeStageAnneeCourante($tabStage);
        AffichePage(TRUE, $corps);     
    }

    function afficherDetailStage(){
        $stage = BD::rechercherStageByID($_GET['idstage']);
        $modeleFicheRenseignement = BD::rechercherFicheRenseignement($stage->getIdstage(), FALSE);
        
        $modeleFicheSujetStage = BD::rechercherFicheSujetStage($stage->getIdstage(), FALSE);
        $corps = genererDetailStage($stage, $modeleFicheRenseignement, $modeleFicheSujetStage);
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

        $corps = genererAfficherOption();
        AffichePage(TRUE, $corps);
    }
    
    function afficherGererPromotion(){
        
        if(isset($_POST['actionPromotion']) && $_POST['actionPromotion']== 'ajouter'){
            
            if(isset($_POST['anneeUniv']) && $_POST['anneeUniv']!= ''
                    && isset($_POST['idPromo'])){
                
               
                $promo = $_POST['idPromo']. " " . $_POST['anneeUniv'] ;
                BD::ajouterPromotion($promo);
                
            }
        }else if(isset($_POST['actionPromotion']) && $_POST['actionPromotion']== 'supprimer'){
            
            
            BD::supprimerPromotion($_POST['idPromoSupprimer']);
        }
        $tabPromotion = BD::recherchePromotion();
        $corps = genererGererPromotion($tabPromotion);
        AffichePage(TRUE, $corps);
    }

?>
