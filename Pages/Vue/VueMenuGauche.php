<?php
    

    function genererMenuGauche() {

        $utilisateurConnecte = FALSE ;

        
        if (isset($_SESSION['connecte'])) {
            
            
            echo " dans le isset";
            
            if ($_SESSION['connecte'] == 1) {

                echo "<br/> ".$_SESSION['connecte'];
                $utilisateurConnecte = TRUE ;
            }

        }
        
        if ($utilisateurConnecte == TRUE){
            
                $menuGauche = "<table>
                            <tr>
                                <td id=\"menu_gauche\">
                                    Vous &ecirc;tes connect&eacute; en tant que " . $_SESSION['login'] . "
                                    <a href=\"".RACINE."?action=deconnexion\">(Se d&eacuteconnecter)</a>
                                 </td>
                             ";
        } else {

            $menuGauche = "<table>
                            <tr>
                                <td id=\"menu_gauche\">
                                    Connexion :
                                    <form action=\"".RACINE."?action=connexion\" method=\"post\">
                                        <table>
                                            <tr>
                                                <td>Login :</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type=\"text\" class=\"forml\" style=\"width:160px;\" name=\"login\" id=\"recherche\" title=\"saisie_login\"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mot de passe :</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type=\"password\" class=\"forml\" style=\"width:160px;\" name=\"password\" id=\"recherche\" title=\"saisie_mdp\"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input id=\"log-submit\" type=\"submit\" value=\"Connexion\" />
                                                </td>
                                            </tr>
                                        </table>
                                    </form><br/><br/>
                                    <a href=\"".RACINE."?action=proposerStage\">Proposer Stage</a>
                                </td>
                                ";
        }

        
        return $menuGauche;
    }

?>
