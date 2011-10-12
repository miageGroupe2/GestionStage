<?php
    require_once RACINE_VUE.'Afficheur.php';
    require_once RACINE_VUE.'VueMenuGauche.php';
    require_once RACINE_VUE.'VueCorps.php';
    require_once 'BD.php';

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
    
    function connecterUtilisateur() {

        if (!isset($_SESSION['connecte'])) {
            
            if ($_POST['login'] != NULL AND $_POST['password'] != NULL) {

                $login = $_POST['login'];
                $password = $_POST['password'];
                $utilisateurExistant = BD::authentification($login, $password);

                if ($utilisateurExistant == TRUE ){

                    $_SESSION['connecte'] = 1 ;
                    $_SESSION['login'] = $login ;
                    
                } 
            }
        }
        
        afficherPagePrincipale($centre);
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
                
                case 'connexion' :
                    $action = 'connecterUtilisateur' ;
                    
                    break;

                default :
                    $action = 'afficherPagePrincipale';
                    break;
            }
        }
        $action($id);
    }

    
?>
