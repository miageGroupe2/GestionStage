<?php

require_once '../phpmailer/class.phpmailer.php';
require_once RACINE_VUE . 'VueCorpsCommun.php';
require_once RACINE_VUE . 'VueCorpsEtudiant.php';
require_once RACINE_VUE . 'VueCorpsResponsable.php';

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

            $utilisateur = BDEtudiant::authentification($login, $password);

            if ($utilisateur != NULL) {

                $_SESSION['connecte'] = 1;
                $_SESSION['login'] = $login;
                $_SESSION['nom'] = $utilisateur->getNom();
                $_SESSION['prenom'] = $utilisateur->getPrenom();

                //on stock en session l'utilisateur connecté
                $_SESSION['modeleUtilisateur'] = $utilisateur;

                if ($utilisateur->getAdmin() == 1) {
                    afficherPagePrincipaleResponsable();
                } else {
                    afficherPagePrincipaleEtudiant();
                }
            } else {
                afficherAccueilErreur();
            }
        } else {
            afficherAccueilErreur();
        }
    } else {
        $utilisateur = $_SESSION['modeleUtilisateur'];
        if ($utilisateur->getAdmin() == 1) {
            afficherPagePrincipaleResponsable();
        } else {
            afficherPagePrincipaleEtudiant();
        }
    }
}

function telechargement() {

    $estUneProposition = FALSE; // ou est un stage

    if (isset($_GET['estUneProposition'])) {

        $estUneProposition = TRUE;
    }
    if (isset($_GET['type']) && isset($_GET['id'])) {

        if ($_GET['type'] == "sujet") {

            $id = $_GET['id'];
            $modeleFicheSujetStage = BDCommun::rechercherFicheSujetStage($id, $estUneProposition);
            header('Content-type: ' . $modeleFicheSujetStage->getType());

            header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
            header('Content-Disposition: attachment; filename=' . $modeleFicheSujetStage->getNomOriginal()); //Nom du fichier
            readfile("FicheSujetStage/" . $modeleFicheSujetStage->getNomUnique());
        } else {
            //sinon fiche de renseignement

            $id = $_GET['id'];
            $modeleFicheRenseignement = BDCommun::rechercherFicheRenseignement($id, $estUneProposition);
            header('Content-type: ' . $modeleFicheRenseignement->getType());

            header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
            header('Content-Disposition: attachment; filename=' . $modeleFicheRenseignement->getNomOriginal()); //Nom du fichier
            readfile("FicheRenseignement/" . $modeleFicheRenseignement->getNomUnique());
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

function afficherInscription() {

    //si le formulaire a été renseigné
    if (isset($_POST['mail']) && isset($_POST['password'])
            && isset($_POST['password2']) && isset($_POST['numetudiant'])
            && isset($_POST['nom']) && isset($_POST['prenom'])) {


        if ($_POST['mail'] != '' && $_POST['password'] != '' && $_POST['password2'] != ''
                && $_POST['numetudiant'] != '' && $_POST['nom'] != '' && $_POST['prenom'] != '') {

            if ($_POST['password'] == $_POST['password2']) {


                $idConfirmationMail = BDEtudiant::inscriptionEtudiant($_POST['mail'], $_POST['numetudiant'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['promotion']);

                envoyerMail($_POST['mail'], $idConfirmationMail);

                $corps = genererPageInscriptionTerminee();
                AffichePage(FALSE, $corps);
            }
        }
    } else {

        $tabPromotion = BDCommun::recherchePromotion();
        $corps = genererPageInscription($tabPromotion);
        AffichePage(FALSE, $corps);
    }
}

function confirmationInscription() {

    BDEtudiant::confirmationInscription($_GET['id']);
    $corps = genererPageAccueil();
    AffichePage(FALSE, $corps);
}

function envoyerMail($mailEtudiant, $idConfirmationMail) {

    $mailEtudiant .= "@etudiant.univ-nancy2.fr";

    $mail = new PHPmailer();
    $mail->IsSMTP();

    $mail->SMTPAuth = true;
    $mail->Username = "stagegestion@gmail.com";
    $mail->Password = "miagemiage";

    $webmaster_email = "stagegestion@gmail.com";
    $email = $mailEtudiant;
    $name = "";
    $mail->From = $webmaster_email;
    $mail->FromName = "Gestion stage";
    $mail->AddAddress($email, $name);
    //$mail->AddReplyTo($webmaster_email,"Webmaster");
    $mail->WordWrap = 50; // set word wrap

    $mail->IsHTML(true); // send as HTML
    $mail->Subject = "Inscription " . utf8_decode("à") . " la plateforme de gestion des stages";
    $mail->Body = "Bonjour,</br></br>
    Vous venez de vous inscrire &agrave; la plateforme de gestion des stages.
    Pour confirmer votre inscription veuillez cliquer sur le lien suivant : <a href=\"".RACINE."?action=confirmationInscription&id=" . $idConfirmationMail . "\">Confirmer inscription</a>";
    $mail->AltBody = "Bonjour, \n\n
    Vous venez de vous inscrire &agrave; la plateforme de gestion des stages.
    Pour confirmer votre inscription veuillez vous rendre &agrave; l'adresse suivante : ".RACINE."?action=confirmationInscription&id=" . $idConfirmationMail; //Text Body
    $mail->Send();
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
