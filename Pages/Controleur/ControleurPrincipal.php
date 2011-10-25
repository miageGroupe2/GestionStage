<?php

require_once RACINE_CONTROLEUR . 'ControleurCommun.php';
require_once RACINE_CONTROLEUR . 'ControleurEtudiant.php';
require_once RACINE_CONTROLEUR . 'ControleurResponsable.php';

session_start();

call_action();

function verifierAutorisationAction($action) {
    // Si on est connecte Evite le warning a l'etape du deddous
    if (isset($_SESSION['connecte'])) {
        // IDEM si on est conecte
        if ($_SESSION['connecte'] == 1) {
            // Si admin, SINON etudiant
            if ($_SESSION['admin'] == 1) {
                // specifique ADMIN
                if ($action == "listePropositionStageResponsable") {
                    return TRUE;
                } else if ($action == "detailStage") {
                    return TRUE;
                } else if ($action == "listeStageAnneeCourante") {
                    return TRUE;
                } else if ($action == "consulterStage") {
                    return TRUE;
                } else if ($action == "creerCompteAdmin") {
                    return TRUE;
                } else if ($action == "accesDonneesEtudiants") {
                    return TRUE;
                } else if ($action == "pagePrincipale") {
                    return TRUE;
                } else if ($action == "connexion") {
                    return TRUE;
                } else if ($action == "deconnexion") {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else if ($_SESSION['admin'] == 0) {
                // Specifique ETUDIANT
                if ($action == "proposerStageEtape1") {
                    return TRUE;
                } else if ($action == "proposerStageEtape2") {
                    return TRUE;
                } else if ($action == "completerPropositionStage") {
                    return TRUE;
                } else if ($action == "completerStage") {
                    return TRUE;
                } else if ($action == "listePropositionStageEtudiant") {
                    return TRUE;
                } else if ($action == "listeStageEtudiant") {
                    return TRUE;
                } else if ($action == "modifierInformations") {
                    return TRUE;
                } else if ($action == "pagePrincipale") {
                    return TRUE;
                } else if ($action == "connexion") {
                    return TRUE;
                } else if ($action == "deconnexion") {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }else{
        if ($action == "connexion") {
                return TRUE;
            } else {
                return FALSE;
            }
    }
}

function call_action() {

    $action = '';

    if (!isset($_REQUEST['action'])) {
        $action = 'afficherAccueil';
    } else {
        $action = $_REQUEST['action'];
        if (!verifierAutorisationAction($action)) {
            $action = "afficherAccueil";
        } else {
            switch ($_REQUEST['action']) {
                // Partie commune
                case 'pagePrincipale' :
                    $action = 'afficherPagePrincipale';
                    break;

                case 'connexion' :
                    $action = 'connecterUtilisateur';
                    break;

                case 'deconnexion' :
                    $action = 'deconnecterUtilisateur';
                    break;
                /*
                  case 'rechercherEntreprise':
                  $action = 'afficherRechercherEntreprise';
                  break;

                  case 'effectuerRechercheEntreprise':
                  $action = 'effectuerRechercheEntreprise';
                  break;

                  case 'choisirEntreprise':
                  $action = 'afficherContactParEntreprise';
                  break;
                 */
                // partie etudiant

                case 'proposerStageEtape1' :
                    $action = 'proposerStageEtape1' ;
                    break;
                
                case 'proposerStageEtape2' :
                    $action = 'proposerStageEtape2' ;
                    break;

//                case 'validerProposerStage':
//                    $action = 'validerProposerStage' ;
//                    break;

                case 'completerPropositionStage' :
                    $action = 'afficherCompleterStage';
                    break;

                case 'completerStage' :
                    $action = 'afficherCompleterStage';
                    break;

                case 'listePropositionStageEtudiant' :
                    $action = 'afficherListePropositionStageEtudiant';
                    break;

                case 'listeStageEtudiant' :
                    $action = 'afficherListeStageEtudiant';
                    break;

                case 'modifierInformations' :
                    $action = 'afficherModifierInformations';
                    break;

                // Partie responsable

                case 'listePropositionStageResponsable' :
                    $action = 'afficherListePropositionStageResponsable';
                    break;

                case 'detailStage' :
                    $action = 'afficherDetailStage';
                    break;

                case 'listeStageAnneeCourante' :
                    $action = 'afficherListeStageAnneeCourante';
                    break;

                case 'consulterStage' :
                    $action = 'afficherConsulterStage';
                    break;

                case 'creerCompteAdmin' :
                    $action = 'afficherCreerCompteAdmin';
                    break;

                case 'accesDonneesEtudiants' :
                    $action = 'afficherAccesDonneesEtudiants';
                    break;

                // DEFAUT 

                default :
                    $action = 'afficherPagePrincipale';
                    break;
            }
        }
    }
    $action();
}

?>
