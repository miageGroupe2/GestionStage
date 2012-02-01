<?php

    function genererMenuGauche() {
        
        $utilisateurConnecte = FALSE ;        
        if (isset($_SESSION['connecte'])) {
            
            if ($_SESSION['connecte'] == 1) {
                
                $utilisateurConnecte = TRUE ;
            }
        }
        
        if ($utilisateurConnecte == TRUE){
            
                $menuGauche = "<table>
                            <tr>
                                <td id=\"menu_gauche\">
                                    <table>
                                        <tr>
                                            <td id=\"titre_menu_gauche\">
                                                Connect&eacute; en tant que : " . $_SESSION['login'] . "
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href=\"".RACINE."?action=deconnexion\">Se d&eacute;connecter</a>
                                                <a href=\"".RACINE."?action=deconnexion\"><img src=\"\"> <img src=\"Images/logo_deconnexion.png\"> </a><br/>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    
                             ";
        } else {
            $menuGauche = "<table>
                        <tr>
                            <td id=\"menu_gauche\">
                                Vous &ecirc;tes d&eacute;connect&eacute;.<br/>
                         ";
            
        }
        //on récupère l'utilisateur connecté 
        $utilisateur = $_SESSION['modeleUtilisateur'];
        
        if ($utilisateur->getAdmin()) {
            $menuGauche .= "
                        <ul>
                        <li><a href=\"".RACINE."?action=pagePrincipaleResponsable\">Accueil</a><br/></li>
                        <li><a href=\"".RACINE."?action=listePropositionStageResponsable\">Voir les propositions de stage</a><br/></li>
                        <li><a href=\"".RACINE."?action=listeStageAnneeCourante\">Voir les stages de l'ann&eacute;e courante</a><br/></li>
                        <li><a href=\"".RACINE."?action=listeStages\">Consulter les stages</a><br/></li>
                        <li><a href=\"".RACINE."?action=gererCompteAdmin\">G&eacute;rer les comptes administrateur</a><br/></li>
                        <li><a href=\"".RACINE."?action=option\">Options</a><br/></li>
                        </ul>
                        </td>";
        }else{
            $menuGauche .= "
                        <ul>
                        <li><a href=\"".RACINE."?action=pagePrincipaleEtudiant\">Accueil</a><br/></li>
                        <li><a href=\"".RACINE."?action=proposerStageEtape1\">Proposer un stage</a><br/></li>
                        <li><a href=\"".RACINE."?action=listePropositionStageEtudiant\">Mes propositions de stage</a><br/></li>
                        <li><a href=\"".RACINE."?action=voirStageEtudiant\">Voir mon stage</a><br/></li>
                        <li><a href=\"".RACINE."?action=optionEtudiant\">Options</a><br/></li>
                        </ul>
                        </td>";
        }

        return $menuGauche;
    }

?>
