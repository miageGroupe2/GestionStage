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
                                                Statut : Connect&eacute; <img src=\"Images/MenuGauche/Link.png\" alt=\"link\"/> <br/> 
                                                <img src=\"Images/MenuGauche/people.png\" alt=\"link\"/> : " . $_SESSION['prenom'] ." ". $_SESSION['nom'] ."
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class=\"se_deconnecter\">
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
                        <a href=\"".RACINE."?action=pagePrincipaleEtudiant\"><img src=\"Images/MenuGauche/home.png\"></a>
                            <a href=\"".RACINE."?action=pagePrincipaleEtudiant\">Accueil</a><br/>
                        <a href=\"".RACINE."?action=proposerStageEtape1\"><img src=\"Images/MenuGauche/editer_stage.png\"></a>
                            <a href=\"".RACINE."?action=proposerStageEtape1\">Proposer un stage</a><br/>
                        <a href=\"".RACINE."?action=listePropositionStageEtudiant\"><img src=\"Images/MenuGauche/mes_propositions.png\"></a>
                            <a href=\"".RACINE."?action=listePropositionStageEtudiant\">Mes propositions de stage</a><br/>
                        <a href=\"".RACINE."?action=voirStageEtudiant\"><img src=\"Images/MenuGauche/mon_stage.png\"></a>
                            <a href=\"".RACINE."?action=voirStageEtudiant\">Voir mon stage</a><br/>
                        <a href=\"".RACINE."?action=optionEtudiant\"><img src=\"Images/MenuGauche/options.png\"></a>
                            <a href=\"".RACINE."?action=optionEtudiant\">Options</a><br/>
                        </td>";
        }

        return $menuGauche;
    }

?>
