<?php
    require_once RACINE_CONTROLEUR . 'ControleurCommun.php';
    require_once RACINE_CONTROLEUR . 'ControleurEtudiant.php';
    require_once RACINE_CONTROLEUR . 'ControleurResponsable.php';

    session_start();
    
    call_action();
    
    function call_action() {

        $action = 'pagePrincipale';
        
        if (!isset($_REQUEST['action'])) {
            $action = 'afficherAccueil';
        } else {
            switch ($_REQUEST['action']) {
                // Partie commune
                case 'pagePrincipale' :
                    $action = 'afficherPagePrincipale';
                    break;
                
                case 'connexion' :
                    $action = 'connecterUtilisateur' ;    
                    break;
                
                case 'deconnexion' :
                    $action = 'deconnecterUtilisateur' ;
                    break;
                
                case 'rechercherEntreprise':
                    $action = 'afficherRechercherEntreprise' ;
                    break;
                
                case 'effectuerRechercheEntreprise':
                    $action = 'effectuerRechercheEntreprise' ;
                    break;
                
                case 'choisirEntreprise':
                    $action = 'afficherContactParEntreprise' ;
                    break;
                
                // partie etudiant
                case 'proposerStage' :
                    $action = 'afficherProposerStage' ;
                    break;
                
//                case 'validerProposerStage':
//                    $action = 'validerProposerStage' ;
//                    break;
                
                case 'completerPropositionStage' :
                    $action = 'afficherCompleterStage' ;
                    break;
                
                case 'completerStage' :
                    $action = 'afficherCompleterStage' ;
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
        $action();
    }

    
?>
