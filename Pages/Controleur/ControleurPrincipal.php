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
                } else if($action == 'detailStage'){
                    return $action;
                }else if ($action == "editerStage") {
                    return $action;
                }else if ($action == "listeStageAnneeCourante") {
                    return $action;
                } else if ($action == "listeStages") {
                    return $action;
                } else if ($action == "gererCompteAdmin") {
                    return $action;
                } else if ($action == "accesDonneesEtudiants") {
                    return $action;
                } else if ($action == "pagePrincipale") {
                    return $action;
                } else if ($action == "connexion") {
                    return $action;
                } else if ($action == "deconnexion") {
                   return $action;
                } else if ($action == "ajouterAdmin") {
                   return $action;
                }else if ($action == "validerModifStage") {
                    return $action;
                }else if ($action == "modifierAdmin") {
                   return $action;
                }else if ($action == "modifierAdminEtape2") {
                   return $action;
                }else if ($action == "supprimerAdmin") {
                   return $action;
                }else if ($action == "option") {
                   return $action;
                }else if ($action == "gererPromotion") {
                   return $action;
                }else if ($action == "telechargement") {
                   return $action;
                }
                
                
                else {
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
                } else if ($action == "supprimerProposition") {
                    return $action;
                } else if ($action == "listePropositionStageEtudiant") {
                    return $action;
                } else if ($action == "voirStageEtudiant") {
                    return $action;
                }else if ($action == "modifierContact") {
                    return $action;
                }else if ($action == "modifierContactEtape2") {
                    return $action;
                } else if ($action == "modifierInformations") {
                    return $action;
                } else if ($action == "pagePrincipale") {
                    return $action;
                } else if ($action == "connexion") {
                    return $action;
                } else if ($action == "deconnexion") {
                    return $action;
                }else if ($action == "telechargement") {
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
            case 'telechargement' :
                $action = 'telechargement';
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

            case 'listePropositionStageEtudiant' :
                $action = 'afficherListePropositionStageEtudiant';
                break;

            case 'voirStageEtudiant' :
                $action = 'afficherStageEtudiant';
                break;
            case 'modifierContact' :
                $action = 'modifierContactEtape1';
                break;
            case 'modifierContactEtape2':
                $action = 'modifierContactEtape2';
                break;
            case 'modifierInformations' :
                $action = 'afficherModifierInformations';
                break;

            // Partie responsable

            
            case 'listePropositionStageResponsable' :
                $action = 'listePropositionStageResponsable';
                break;
            
            case 'option' :
                $action = 'afficherOption';
                break;
            
            case 'gererPromotion' :
                $action = 'afficherGererPromotion';
                break;
            
            case 'supprimerAdmin' :
                $action = 'supprimerAdmin';
                break;
            
            case 'modifierAdminEtape2' :
                $action = 'modifierAdminEtape2';
                break ;
                
            case 'modifierAdmin' :
                $action = 'modifierAdmin';
                break;
            
             case 'ajouterAdmin' :
                $action = 'ajouterAdmin';
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
            
            case 'detailStage' :
                $action = 'afficherDetailStage';
                break;
            case 'editerStage':
                $action = 'afficherEditerStage';
                break;
            
            case 'gererCompteAdmin' :
                $action = 'afficherGererCompteAdmin';
                break;

            case 'accesDonneesEtudiants' :
                $action = 'afficherAccesDonneesEtudiants';
                break;
            case 'validerModifStage' :
                $action = 'validerModifStage';
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
