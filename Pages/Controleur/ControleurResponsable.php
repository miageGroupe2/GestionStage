<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorpsResponsable.php';
require_once RACINE_VUE . 'VueCorpsCommun.php';
require_once 'BDResponsable.php';

function afficherPagePrincipaleResponsable() {
    $corps = genererPagePrincipalResponsable();
    AffichePage(TRUE, $corps);
}


    function validerModifStage(){
        $ok = BDResponsable::modifierDonneesStage();
        $corps = genererValiderModificationsStageResponsable($ok);
        AffichePage(TRUE, $corps);
    }

    function ListePropositionStageResponsable() {
        $tabProp = BDResponsable::rechercherToutesPropositions();
        $corps = genererListePropositionStageResponsable($tabProp);
        AffichePage(TRUE, $corps);
    }

    function afficherDetailProposition(){
        $proposition = BDCommun::rechercherProposition($_GET['idprop']);
        $modeleFicheRenseignement = BDCommun::rechercherFicheRenseignement($_GET['idprop'], TRUE);
        $modeleFicheSujetStage = BDCommun::rechercherFicheSujetStage($_GET['idprop'], TRUE);
        $tabTechno = BDResponsable::rechercheTechnoByProposition($_GET['idprop']);
        $corps = genererDetailProposition($proposition, $modeleFicheRenseignement, $modeleFicheSujetStage, $tabTechno);
        AffichePage(TRUE, $corps);        
    }

    function afficherEditerStage(){
        $stage = BDCommun::rechercherStageByID($_GET['idstage']);
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
            BDResponsable::refuserProposition($_GET['idprop'], $raisonrefus);
        }else{
            
            BDResponsable::validerProposition($_GET['idprop']);
        }

        
        $corps = genererValiderProposition($valider);
        AffichePage(TRUE, $corps);     
    }

    function afficherListeStage(){

        $tabStage = null ;
        $idPromoSelect = null ;
        $idPromoDejaSelec = null ;
        if( isset($_POST['promotion']) && $_POST['promotion'] != "-"){

            $idPromoSelect = $_POST['promotion'];
            
        }
        $tabTechnoSelect = null ;
        if (isset ($_POST['check'])){
            $tabCheckBox = $_POST['check'] ;

            foreach($tabCheckBox as $techno){

                $tabTechnoSelect[] = $techno ;
            }
        }
        if ($tabTechnoSelect == null && $idPromoSelect == null){

            $tabStage = BDResponsable::rechercherStage();
        }else{

            $tabStage = BDResponsable::rechercherStageByPromoByTechno($idPromoSelect, $tabTechnoSelect);
        }
        
        $tabPromotion = BDCommun::recherchePromotion();
        $technoTab = BDCommun::rechercheTechnos();
        $corps = genererListeStage($tabStage, $tabPromotion, $technoTab, $idPromoSelect, $tabTechnoSelect);
        AffichePage(TRUE, $corps);     
    }

    function afficherListeStageAnneeCourante(){

        $utilisateur = $_SESSION['modeleUtilisateur'];        
        $promotion = $utilisateur->getIdPromotion();
        $tabStage = BDResponsable::rechercherStageAnneeCourante($promotion);
        $corps = genererListeStageAnneeCourante($tabStage);
        AffichePage(TRUE, $corps);     
    }

    function afficherDetailStage(){
        $stage = BDCommun::rechercherStageByID($_GET['idstage']);
        $modeleFicheRenseignement = BDCommun::rechercherFicheRenseignement($stage->getIdstage(), FALSE);
        $technoTab = BDCommun::rechercheTechnosModeleByProposition($stage->getIdproposition());
        $modeleFicheSujetStage = BDCommun::rechercherFicheSujetStage($stage->getIdstage(), FALSE);
        $corps = genererDetailStage($stage, $modeleFicheRenseignement, $modeleFicheSujetStage, $technoTab);
        AffichePage(TRUE, $corps);
    }

    function afficherGererCompteAdmin(){

        $tabAdmin = BDResponsable::rechercheListeAdmin();
        $tabPromotion = BDCommun::recherchePromotion();
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
                
                BDResponsable::ajouterAdmin($_POST['nom_admin'], $_POST['prenom_admin'], $_POST['mail_admin'], $_POST['mdp_admin'], $_POST['promotion']);
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
            
            $modeleUtilisateur = BDResponsable::getAdminById($_POST['idUtilisateur']);
            $tabPromotion = BDCommun::recherchePromotion();
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
                
                BDResponsable::modifierAdmin($_POST['idUtilisateur'], $_POST['nom_admin'], $_POST['prenom_admin'], $_POST['mail_admin'], $_POST['mdp_admin'], $_POST['promotion']);
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


            BDResponsable::supprimerAdmin($_GET['idAdmin']);
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
                BDResponsable::ajouterPromotion($promo);
                
            }
        }else if(isset($_POST['actionPromotion']) && $_POST['actionPromotion']== 'supprimer'){
            
            
            BDResponsable::supprimerPromotion($_POST['idPromoSupprimer']);
        }
        $tabPromotion = BDCommun::recherchePromotion();
        $corps = genererGererPromotion($tabPromotion);
        AffichePage(TRUE, $corps);
    }

?>
