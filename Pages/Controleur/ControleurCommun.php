<?php

function deconnecterUtilisateur() {

    if (isset($_SESSION['connecte'])) {

        unset($_SESSION['connecte']);
        session_destroy();
    }

    afficherPagePrincipale();
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
            }
        }
    }

    afficherPagePrincipale();
}

function afficherAccueil() {
    $menuGauche = "";
    $corps = genererPageAccueil();
    AffichePage($menuGauche, $corps);
}

function afficherPagePrincipale() {
    $menuGauche = genererMenuGauche();
    $corps = genererPagePrincipal();
    AffichePage($menuGauche, $corps);
}


function afficherRechercherEntreprise() {
    $menuGauche = genererMenuGauche();
    $corps = genererRechercheEntreprise();
    AffichePage($menuGauche, $corps);
}

function effectuerRechercheEntreprise() {

    if (isset($_POST['nomEntreprise']) && ($_POST['nomEntreprise'] != null)) {


        $tabEntreprise = BD::rechercherEntreprise($_POST['nomEntreprise']);

        $corps = genererListeResultatRechercheEntreprise($tabEntreprise);
        $menuGauche = genererMenuGauche();
        AffichePage($menuGauche, $corps);
    } else {

        afficherRechercherEntreprise();
    }
}

function afficherContactParEntreprise() {

    if (isset($_POST['idEntreprise']) && ($_POST['idEntreprise'] != null)) {


        $tabContact = BD::rechercherContactParEntreprise($_POST['idEntreprise']);
        $corps = genererListeResultatRechercheContact($tabContact);
        $menuGauche = genererMenuGauche();
        AffichePage($menuGauche, $corps);
    } else {
        afficherPagePrincipale();
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
