<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorps.php';
require_once 'BD.php';


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

?>
