<?php

function genererPageAccueil() {
    $corps = "<td id = \"corps\">
                    Ceci est la page d'accueil
                </td>
            </tr>
        </table>";
    return $corps;
}

function genererProposerStage() {
    $corps = "
                <td id = \"corps\">
                    <h2>Proposer un stage</h2>
                    <form action=\"".RACINE."?action=proposerStage\" method=\"post\">
                        <table>
                            <tr>
                                <td colspam=\"2\">
                                    <h3>Coordonn&eacute;es &eacute;tudiant :</h3>
                                 </td>
                            </tr>
                            <tr>
                                <td>
                                    Nom &eacute;tudiant :
                                </td>
                                <td>
                                    <input type=text name=\"nom\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pr&eacute;nom &eacute;tudiant :
                                </td>
                                <td>
                                    <input type=text name=\"prenom\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Formation :
                                </td>
                                <td>
                                    <select name=\"fonction\">
                                        <option VALUE=\"l3_miage\">L3 MIAGE</option>
                                        <option VALUE=\"m2_acsi\">M2 MIAGE ACSI</option>
                                        <option VALUE=\"m2_sid\">M2 MIAGE SID</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspam=\"2\">
                                    <h3>Coordonn&eacute;es de l'entreprise :</h3>
                                 </td>
                            </tr>
                            <tr>
                                <td>
                                    Nom de l'entreprise :
                                </td>
                                <td>
                                    <input type=text name=\"nom_entreprise\">
                                </td>
                            </tr>
                            <tr>
                                <td colspam=\"2\">
                                    <br/><h3>Adresse de l'entreprise :</h3><br/>
                                 </td>
                            </tr>
                            <tr>
                                <td>
                                    N°, Rue :
                                </td>
                                <td>
                                    <input type=text name=\"num_rue\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Code postal :
                                </td>
                                <td>
                                    <input type=text name=\"code_postal\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ville :
                                </td>
                                <td>
                                     <input type=text name=\"ville\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pays :
                                </td>
                                <td>
                                     <input type=text name=\"pays\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    T&eacute;l&eacute;phone accueil :
                                </td>
                                <td>
                                     <input type=text name=\"tel_accueil\">
                                </td>
                            </tr>
                             <tr>
                                <td colspam=\"2\">
                                    <h3>Coordonn&eacute;es du tuteur :</h3>
                                 </td>
                            </tr>
                            <tr>
                                <td>
                                    Nom tuteur :
                                </td>
                                <td>
                                    <input type=text name=\"nom_tuteur\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pr&eacute;nom tuteur :
                                </td>
                                <td>
                                    <input type=text name=\"prenom_tuteur\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    T&eacute;l&eacute;phone fixe :
                                </td>
                                <td>
                                    <input type=text name=\"tel_fixe\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    T&eacute;l&eacute;phone portable :
                                </td>
                                <td>
                                    <input type=text name=\"tel_port\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Mail :
                                </td>
                                <td>
                                    <input type=text name=\"mail\">
                                </td>
                            </tr>
                            <tr>
                                <td colspam=\"2\">
                                    <h3>Informations stage :</h3>                                 </td>
                            </tr>
                            <tr>
                                <td>
                                    Date d&eacute;but (JJ/MM/AAAA) :
                                </td>
                                <td>
                                    <input type=text name=\"date_deb\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Date fin (JJ/MM/AAAA) :
                                </td>
                                <td>
                                    <input type=text name=\"date_fin\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Sujet :
                                </td>
                                <td>
                                    <textarea cols=\"60\" rows=\"9\" name=\"sujet\"> Tapez ici une synthèse de votre sujet</textarea>
                                </td>
                            </tr>
                        </tabke>
                        <table>
                            <tr>
                                <td class=\"submit\">
                                    <input type=\"reset\" value=\"Annuler\">
                                    <input type=\"submit\" value=\"Envoyer\">
                                 </td>
                            </tr>                         
                        </table><br/>
                    </td>
                </tr>
            </table>";

    return $corps;
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
