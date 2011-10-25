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
                                    Connect&eacute; en tant que " . $_SESSION['login'] . "
                                    <a href=\"".RACINE."?action=deconnexion\"><br/>(Se d&eacuteconnecter)</a><br/><br/>
                                 
                             ";
        } else {
            $menuGauche = "<table>
                        <tr>
                            <td id=\"menu_gauche\">
                                Vous &ecirc;tes d&eacute;connect&eacute;.<br/>
                         ";
            
        }

        if($_SESSION['admin'] == 1){
            $menuGauche .= "               
                        <a href=\"".RACINE."?action=listePropositionStageResponsable\">Voir les propositions de stage</a><br/>
                        <a href=\"".RACINE."?action=listeStageAnneeCourante\">Voir les stages de l'ann&eacute;e courante</a><br/>
                        <a href=\"".RACINE."?action=consulterStages\">Consulter les stages</a><br/>
                        <a href=\"".RACINE."?action=creerompteAdmin\">Cr&eacute;er un compte administrateur</a><br/>
                        <a href=\"".RACINE."?action=accesDonneesEtudiant\">Acc&egrave;s donn&eacute;es &eacute;tudiant</a><br/>
                        </td>";
        }else{
            $menuGauche .= "<a href=\"".RACINE."?action=proposerStage\">Proposer un Stage</a><br/>
                        <a href=\"".RACINE."?action=listePropositionStageEtudiant\">Voir mes propositions de stage</a><br/>
                        <a href=\"".RACINE."?action=completerPropositionStage\">Compl&eacute;ter les don&eacute;es de mes propositions de stage</a><br/>
                        <a href=\"".RACINE."?action=listeStageEtudiant\">Voir mon stage</a><br/>
                        </td>";
        }

        return $menuGauche;
    }

?>
