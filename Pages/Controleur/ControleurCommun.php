<?php

function deconnecterUtilisateur() {

    if (isset($_SESSION['connecte'])) {

        unset($_SESSION['connecte']);
        unset($_SESSION['modeleUtilisateur']);
        unset($_SESSION['modeleEntreprise']);
        session_destroy();
    }

    afficherAccueil();
}

function connecterUtilisateur() {

    if (!isset($_SESSION['connecte'])) {

        if ($_POST['login'] != NULL AND $_POST['password'] != NULL) {

            $login = $_POST['login'];
            $password = $_POST['password'];

            $utilisateurExistant = BD::authentification($login, $password);

            if ($utilisateurExistant == TRUE) {

                $_SESSION['connecte'] = 1;
                $_SESSION['login'] = $login;
                afficherPagePrincipale();
            }else{
                afficherAccueilErreur();
            }
        }
    }

    
}

function afficherAccueil() {
    $corps = genererPageAccueil();
    AffichePage(FALSE, $corps);
}

function afficherAccueilErreur() {
    $corps = genererPageAccueilErreue();
    AffichePage(FALSE, $corps);
}

function afficherPagePrincipale() {
    $corps = genererPagePrincipal();
    AffichePage(TRUE, $corps);
}


function afficherRechercherEntreprise() {
    $corps = genererRechercheEntreprise();
    AffichePage(TRUE, $corps);
}

function effectuerRechercheEntreprise() {

    if (isset($_POST['nomEntreprise']) && ($_POST['nomEntreprise'] != null)) {


        $tabEntreprise = BD::rechercherEntreprise($_POST['nomEntreprise']);

        $corps = genererListeResultatRechercheEntreprise($tabEntreprise);
        AffichePage(TRUE, $corps);
    } else {

        afficherRechercherEntreprise();
    }
}

function afficherContactParEntreprise() {

    if (isset($_POST['idEntreprise']) && ($_POST['idEntreprise'] != null)) {


        $tabContact = BD::rechercherContactParEntreprise($_POST['idEntreprise']);
        $corps = genererListeResultatRechercheContact($tabContact);
        AffichePage(TRUE, $corps);
    } else {
        afficherPagePrincipale();
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
