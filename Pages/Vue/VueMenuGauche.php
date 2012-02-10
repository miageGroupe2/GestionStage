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
                                    </table><br/>
                                    
                                    
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
                        
                        <a href=\"".RACINE."?action=pagePrincipaleResponsable\"><img src=\"Images/MenuGauche/home.png\"></a>
                            <a href=\"".RACINE."?action=pagePrincipaleResponsable\">Accueil</a><br/>
                        <a href=\"".RACINE."?action=listePropositionStageResponsable\"><img src=\"Images/MenuGauche/mes_propositions.png\"></a>        
                            <a href=\"".RACINE."?action=listePropositionStageResponsable\">Propositions de stage</a><br/>
                        <a href=\"".RACINE."?action=listeStageAnneeCourante\"><img src=\"Images/MenuGauche/mon_stage.png\"></a>
                            <a href=\"".RACINE."?action=listeStageAnneeCourante\">Stages ann&eacute;e courante</a><br/>
                        <a href=\"".RACINE."?action=listeStages\"><img src=\"Images/MenuGauche/Folder.png\"></a>
                            <a href=\"".RACINE."?action=listeStages\">Tous les stages</a><br/>
                        <a href=\"".RACINE."?action=gererCompteAdmin\"><img src=\"Images/MenuGauche/compte_admin.png\"></a>
                            <a href=\"".RACINE."?action=gererCompteAdmin\">G&eacute;rer les comptes admin</a><br/>
                        <a href=\"".RACINE."?action=option\"><img src=\"Images/MenuGauche/options.png\"></a>
                            <a href=\"".RACINE."?action=option\">Options</a><br/>
                        
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
