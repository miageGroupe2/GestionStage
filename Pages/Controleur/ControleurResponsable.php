<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorps.php';
require_once 'BD.php';


function afficherListePropositionStageResponsable() {
    $menuGauche = genererMenuGauche();
    $corps = genererListePropositionStage();
    AffichePage($menuGauche, $corps);
}

function afficherDetailPropositionStage(){
        $menuGauche = genererMenuGauche();
        $corps = genererDetailPropositionStage();
        AffichePage($menuGauche, $corps);        
}

function afficherDetailStage(){
        $menuGauche = genererMenuGauche();
        $corps = genererDetailStage();
        AffichePage($menuGauche, $corps);
    }

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
