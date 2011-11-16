<?php

require_once RACINE_VUE . 'Afficheur.php';
require_once RACINE_VUE . 'VueMenuGauche.php';
require_once RACINE_VUE . 'VueCorps.php';
require_once 'BD.php';


function ListePropositionStageResponsable() {

    $corps = genererListePropositionStageResponsable();
    AffichePage(TRUE, $corps);
}

function afficherDetailProposition(){

    $corps = genererDetailProposition();
    AffichePage(TRUE, $corps);        
}

function afficherEditerStage(){
    $corps = genererEditerStage();
    AffichePage(TRUE, $corps);   
}

function validerProposition(){
    $corps = genererValiderProposition();
    AffichePage(TRUE, $corps);     
}

function afficherListeStage(){
    $corps = genererListeStage();
    AffichePage(TRUE, $corps);     
}


function afficherDetailStage(){
    $corps = genererDetailStage();
    AffichePage(TRUE, $corps);
}

?>
