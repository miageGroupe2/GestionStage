<?php
function convertirDateENFR($date){
    $annee = substr($date, 0, 4);
    $mois = substr($date, 5, 2);
    $jour = substr($date, 8, 2);
    
    
    
    $date = $jour.'/'.$mois.'/'.$annee;
    
    return $date;
}

function convertirDateFREN($date){
    $jour = substr($date, 0, 2);
    $mois = substr($date, 3, 2);
    $annee = substr($date, 6, 4);
    
    $date = $annee.'-'.$mois.'-'.$jour;
    
    return $date;
}


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
