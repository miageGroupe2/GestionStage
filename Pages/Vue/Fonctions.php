<?php

function convertirDateENFR($date) {
    $annee = substr($date, 0, 4);
    $mois = substr($date, 5, 2);
    $jour = substr($date, 8, 2);



    $date = $jour . '-' . $mois . '-' . $annee;

    return $date;
}

function convertirDateENFR2($date) {
    
    if (strlen($date) == 10) {
        $annee = substr($date, 6, 4);
        $mois = substr($date, 3, 2);
        $jour = substr($date, 0, 2);

        switch ($mois) {
            case '01':
                $mois = 'janvier';
                break;
            case '02':
                $mois = 'février';
                break;
            case '03':
                $mois = 'mars';
                break;
            case '04':
                $mois = 'avril';
                break;
            case '05':
                $mois = 'mai';
                break;
            case '06':
                $mois = 'juin';
                break;
            case '07':
                $mois = 'juillet';
                break;
            case '08':
                $mois = 'août';
                break;
            case '09':
                $mois = 'septembre';
                break;
            case '10':
                $mois = 'octobre';
                break;
            case '11':
                $mois = 'novembre';
                break;
            case '12':
                $mois = 'décembre';
                break;
            default :
                $mois = 'janvier';
        }

        $date = $jour . ' ' . $mois . ' ' . $annee;

        return $date;
    }else{
        return "Non renseignée";
    }
}

function convertirDateFREN($date) {
    $jour = substr($date, 0, 2);
    $mois = substr($date, 3, 2);
    $annee = substr($date, 6, 4);

    $date = $annee . '-' . $mois . '-' . $jour;

    return $date;
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
