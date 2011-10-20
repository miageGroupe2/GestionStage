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
    
    function afficherListePropositionStage(){     
        $menuGauche = genererMenuGauche();
        $corps = genererListePropositionStage();
        AffichePage($menuGauche, $corps);
    }
    
    function afficherRechercherEntreprise(){
         $menuGauche = genererMenuGauche();
         $corps = genererRechercheEntreprise();
         AffichePage($menuGauche, $corps);
    }
    
    function afficherCompleterStage(){
        $menuGauche = genererMenuGauche();
        $corps = genererPageAccueil();
        AffichePage($menuGauche, $corps);
    }
    
    function afficherDetailStage(){
        $menuGauche = genererMenuGauche();
        $corps = genererDetailStage();
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
                && ($_POST['promotion'] != "choisir")
                && isset ($_POST['nom_entreprise']) && (!$_POST['nom_entreprise'] == null)
                && isset ($_POST['num_rue']) && (!$_POST['num_rue'] == null)
                && isset ($_POST['code_postal']) && (!$_POST['code_postal'] == null)
                && isset ($_POST['ville']) && (!$_POST['ville'] == null)
                && isset ($_POST['tel_accueil']) && (!$_POST['tel_accueil'] == null)
                && isset ($_POST['sujet']) && (!$_POST['sujet'] == null)
                
                ){
         
            $corps = genererAjoutPropositionStageOk();
            BD::ajouterPropositionStage($_POST['nom'], $_POST['prenom'], $_POST['formation'], $_POST['nom_entreprise'], $_POST['num_rue'], $_POST['code_postal'], $_POST['ville'], $_POST['tel_accueil'], $_POST['sujet']);
        }else{

            $corps = genererProposerStage(true);
        }
        //htmlspecialchars
        
        $menuGauche = genererMenuGauche();
        AffichePage($menuGauche, $corps);
    }

    function effectuerRechercheEntreprise(){
        
        if (isset ($_POST['nomEntreprise']) && ($_POST['nomEntreprise'] != null)){
            
            
            $tabEntreprise = BD::rechercherEntreprise($_POST['nomEntreprise']);
            
            $corps = genererListeResultatRechercheEntreprise($tabEntreprise);
            $menuGauche = genererMenuGauche() ;
            AffichePage($menuGauche, $corps);
            
        }else{
            
            afficherRechercherEntreprise();
        }
    }
    
    function afficherContactParEntreprise (){
        
        if (isset ($_POST['idEntreprise']) && ($_POST['idEntreprise'] != null)){
            

            $tabContact = BD::rechercherContactParEntreprise($_POST['idEntreprise']);
            $corps = genererListeResultatRechercheContact($tabContact);
            $menuGauche = genererMenuGauche() ;
            AffichePage($menuGauche, $corps);
            
        }else{
            afficherPagePrincipale();
        }
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
               
                case 'listePropositionStage' :
                    $action = 'afficherListePropositionStage';        
                    break;
                
                case 'detailStage' :
                    $action = 'afficherDetailStage';        
                    break;
                
                case 'validerProposerStage':
                    $action = 'validerProposerStage' ;
                    break;
                
                case 'completerStage' :
                    $action = 'afficherCompleterStage' ;
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
                
                default :
                    $action = 'afficherPagePrincipale';
                    break;
            }
        }
        $action();
    }

    
?>
