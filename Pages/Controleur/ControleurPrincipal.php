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
            
            //on récupère l'utilisateur connecté 
            $utilisateur = $_SESSION['modeleUtilisateur'];
            
            // Si admin, SINON etudiant
            if ($utilisateur->getAdmin()) {
                // specifique ADMIN
                if ($action == "listePropositionStageResponsable") {
                    return $action;
                } else if ($action == "detailProp") {
                    return $action;
                }else if ($action == "validerProp") {
                    return $action;
                } else if ($action == "listeStageAnneeCourante") {
                    return $action;
                } else if ($action == "listeStages") {
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
            } else {
                // Specifique ETUDIANT
                if ($action == "proposerStageEtape1") {
                    return $action;
                } else if ($action == "proposerStageEtape2") {
                    return $action;
                } else if ($action == "proposerStageEtape3") {
                    return $action;
                } else if ($action == "editerPropositionStage") {
                    return $action;
                } else if ($action == "editerStage") {
                    return $action;
                } else if ($action == "supprimerProposition") {
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

            case 'editerPropositionStage' :
                $action = 'editerPropositionStage' ;
                break;
            

            case 'supprimerProposition':
                $action = 'supprimerProposition' ;
                break;
            
//                case 'validerProposerStage':
//                    $action = 'validerProposerStage' ;
//                    break;

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
            
            case 'validerProp' :
                $action = 'validerProposition';
                break;
            
            case 'listeStageAnneeCourante' :
                $action = 'afficherListeStageAnneeCourante';
                break;

            case 'listeStages' :
                $action = 'afficherListeStage';
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
