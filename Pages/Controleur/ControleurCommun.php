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

            $utilisateur = BD::authentification($login, $password);
            
            if ($utilisateur != NULL) {

                $_SESSION['connecte'] = 1;
                $_SESSION['login'] = $login;
                
                //on stock en session l'utilisateur connecté
                $_SESSION['modeleUtilisateur'] = $utilisateur;
                
                afficherPagePrincipale();
            }else{
                afficherAccueilErreur();
            }
        }
    }

    
}

function telechargement(){


    //header('Content-Length: '.$bdd_infos['up_filesize']); //Taille du fichier
    if(isset($_GET['idproposition']) ){

        $idProposition = $_GET['idproposition'];
        $modeleFicheRenseignement = BD::rechercherFicheRenseignement($idProposition);
        header('Content-type: '.$modeleFicheRenseignement->getType());
        header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
        header('Content-Disposition: attachment; filename='.$modeleFicheRenseignement->getNomOriginal()); //Nom du fichier
        readfile("FicheRenseignement/".$modeleFicheRenseignement->getNomUnique());
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


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
