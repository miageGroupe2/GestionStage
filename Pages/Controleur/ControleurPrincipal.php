<?php
    
    require_once RACINE_VUE.'Afficheur.php';
    require_once RACINE_VUE.'VueMenuGauche.php';
    require_once RACINE_VUE.'VueCorps.php';
    require_once 'BD.php';

    session_start();
    
    call_action();
    
    
    function afficherPagePrincipale(){
        $menuGauche = genererMenuGauche();
        $corps = genererPageAccueil();
        AffichePage($menuGauche, $corps);
    }
    
    
    function afficherProposerStage(){     
        $menuGauche = genererMenuGauche();
        $corps = genererProposerStage();
        AffichePage($menuGauche, $corps);
    }
    
    function deconnecterUtilisateur(){
        
        if (isset ($_SESSION['connecte'])) {
            
            unset ($_SESSION['connecte']);
            session_destroy();
        }
        
        afficherPagePrincipale();
    }
    
    function connecterUtilisateur() {

        if (!isset($_SESSION['connecte'])) {
            
            if ($_POST['login'] != NULL AND $_POST['password'] != NULL) {

                $login = $_POST['login'];
                $password = sha1($_POST['password']);
                
                $utilisateurExistant = BD::authentification($login, $password);

                if ($utilisateurExistant == TRUE ){

                    $_SESSION['connecte'] = 1 ;
                    $_SESSION['login'] = $login ;
                    
                } 
            }
        }
        
        afficherPagePrincipale();
    }

    function call_action() {

        $action = 'pagePrincipale';
        
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
                
                case 'deconnexion' :
                    $action = 'deconnecterUtilisateur' ;
                    
                    break;

                default :
                    $action = 'afficherPagePrincipale';
                    break;
            }
        }
        $action();
    }

    
?>
