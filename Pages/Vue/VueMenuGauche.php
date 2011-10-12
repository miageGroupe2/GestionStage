<?php

    function genererMenuGauche(){
        if($_SESSION['connecte'] == 1 ){
            $menuGauche = "<table>
                        <tr>
                            <td id=\"menu_gauche\">
                                Vous &ecirc;tes connect&eacute; en tant que". $_SESSION['login']."
                             </td>
                         ";
        }else{
            $menuGauche = "<table>
                        <tr>
                            <td id=\"menu_gauche\">
                                Connexion :
                                <form action=\"http://localhost/?action=log\" method=\"post\">
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
                                                <input type=\"text\" class=\"forml\" style=\"width:160px;\" name=\"mdp\" id=\"recherche\" title=\"saisie_mdp\"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input id=\"log-submit\" type=\"submit\" value=\"Connexion\" />
                                            </td>
                                        </tr>
                                    </table>
                                </form><br/>
                            </td>
                            ";
        }
        return $menuGauche;
    }

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
