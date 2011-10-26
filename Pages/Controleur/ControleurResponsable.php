<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorps.php';
require_once 'BD.php';


function ListePropositionStageResponsable() {

    $corps = genererListePropositionStageResponsable();
    AffichePage(TRUE, $corps);
}

function afficherDetailPropositionStage(){

    $corps = genererDetailPropositionStage();
    AffichePage(TRUE, $corps);        
}

function afficherDetailStage(){
    $corps = genererDetailStage();
    AffichePage(TRUE, $corps);
}

?>
