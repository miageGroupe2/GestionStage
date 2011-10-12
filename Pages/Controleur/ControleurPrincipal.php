<?php
    require_once RACINE_VUE.'Afficheur.php';
    require_once RACINE_VUE.'VueMenuGauche.php';
    require_once RACINE_VUE.'VueCorps.php';

    call_action();
    
    
    function afficherPagePrincipale($id){
        $menuGauche = genererMenuGauche();
        $corps = genererPageAccueil();
        AffichePage($menuGauche, $corps);
    }
    
    
    function afficherProposerStage($id){     
        $menuGauche = genererMenuGauche();
        $corps = genererProposerStage();
        AffichePage($menuGauche, $corps);
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
                    break;
                
                case 'proposerStage' :
                    $action = 'afficherProposerStage' ;
                    break;

                default :
                    $action = 'afficherPagePrincipale';
                    break;
            }
        }
        $action($id);
    }

    
?>
