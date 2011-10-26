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
                    return $action;
                } else if ($action == "detailProp") {
                    return $action;
                } else if ($action == "listeStageAnneeCourante") {
                    return $action;
                } else if ($action == "consulterStage") {
                    return $action;
                } else if ($action == "creerCompteAdmin") {
                    return $action;
                } else if ($action == "accesDonneesEtudiants") {
                    return $action;
                } else if ($action == "pagePrincipale") {
                    return $action;
                } else if ($action == "connexion") {
                    return $action;
                } else if ($action == "deconnexion") {
                   return $action;
                } else {
                    return "pagePrincipale";
                }
            } else if ($_SESSION['admin'] == 0) {
                // Specifique ETUDIANT
                if ($action == "proposerStageEtape1") {
                    return $action;
                } else if ($action == "proposerStageEtape2") {
                    return $action;
                } else if ($action == "proposerStageEtape3") {
                    return $action;
                } else if ($action == "completerPropositionStage") {
                    return $action;
                } else if ($action == "completerStage") {
                    return $action;
                } else if ($action == "listePropositionStageEtudiant") {
                    return $action;
                } else if ($action == "listeStageEtudiant") {
                    return $action;
                } else if ($action == "modifierInformations") {
                    return $action;
                } else if ($action == "pagePrincipale") {
                    return $action;
                } else if ($action == "connexion") {
                    return $action;
                } else if ($action == "deconnexion") {
                    return $action;
                } else {
                    return "pagePrincipale";
                }
            }
        }
    } else {
        if ($action == "connexion") {
            return $action;
        } else {
            return "afficherAccueil";
        }
    }
}

function call_action() {

    $action = '';

    if (!isset($_REQUEST['action'])) {
        $action = 'afficherAccueil';
    } else {
        $action = $_REQUEST['action'];

        // Si l'action n'est pas autorisee pour l'utilisateur  (Admin/etudiant/guest)
        
        $action = verifierAutorisationAction($action);  
        switch ($action) {
            // Partie commune
            case 'afficherAccueil':
                $action = 'afficherAccueil';
                break;
            
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
                $action = 'proposerStageEtape1';
                break;
            
            case 'proposerStageEtape2' :
                $action = 'proposerStageEtape2' ;
                break;
            
            case 'proposerStageEtape3' :
                $action = 'proposerStageEtape3' ;
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
                $action = 'listePropositionStageResponsable';
                break;

            case 'detailProp' :
                $action = 'afficherDetailProposition';
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
    $action();
}

?>
