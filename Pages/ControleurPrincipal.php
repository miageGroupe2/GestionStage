<?php
    require_once 'Afficheur.php';
    

    call_action();
    
    
    function afficherPagePrincipale($id){
        
        
        AffichePage($id);
    }
    
    function afficherProposerStage($id){
        
        
        AffichePage($id);
    }

    function call_action() {

        $action = 'pagePrincipale';
        $id = 'ceci est la page principale';
        if (!isset($_REQUEST['action'])) {
            $action = 'afficherPagePrincipale';
        } else {
            switch ($_REQUEST['action']) {

                case 'pagePrincipale' :
                    $action = 'afficherPagePrincipale';
                    $id = 'ceci est la page principale';
                    break;
                
                case 'proposerStage' :
                    $action = 'afficherProposerStage' ;
                    $id = 'ceci est la page poour proposer un stage';
                    break;

                default :
                    $action = 'afficherPagePrincipale';
                    $id='ceci est la page principale';
                    break;
            }
        }
        $action($id);
    }

    
?>
