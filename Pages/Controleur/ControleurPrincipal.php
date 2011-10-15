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
        $corps = genererProposerStage(false);
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
    
    function validerProposerStage(){
        
        // on vérifie que les champs obligatoire sont remplis
        if (isset ($_POST['nom']) && (!$_POST['nom'] == null)
                && isset ($_POST['prenom']) && (!$_POST['prenom'] == null)
                && ($_POST['fonction'] != "choisir")
                && isset ($_POST['nom_entreprise']) && (!$_POST['nom_entreprise'] == null)
                && isset ($_POST['num_rue']) && (!$_POST['num_rue'] == null)
                && isset ($_POST['code_postal']) && (!$_POST['code_postal'] == null)
                && isset ($_POST['ville']) && (!$_POST['ville'] == null)
                && isset ($_POST['tel_accueil']) && (!$_POST['tel_accueil'] == null)
                && isset ($_POST['sujet']) && (!$_POST['sujet'] == null)
                
                ){
            
            $corps = "ok";
            BD::ajouterPropositionStage();
        }else{
            
            
            $corps = genererProposerStage(true);
        }
        //htmlspecialchars
        
        $menuGauche = genererMenuGauche();
        AffichePage($menuGauche, $corps);
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
                
                case 'validerProposerStage':
                    $action = 'validerProposerStage' ;
                    
                    break;

                default :
                    $action = 'afficherPagePrincipale';
                    break;
            }
        }
        $action();
    }

    
?>
