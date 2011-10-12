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
    $corps = "<td id = \"corps\">
                    <h2>Proposer un stage</h2>
                    <form action=\"http://localhost/?action=proposerStage\" method=\"post\">
                        <table>
                            <tr>
                                <td colspam=\"2\">
                                    <br/>Coordonn&eacute;es &eacute;tudiant :<br/><br/>
                                 </td>
                            </tr>
                            <tr>
                                <td>
                                    Nom &eacute;tudiant :
                                </td>
                                <td>
                                    <INPUT type=text name=\"nom\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pr&eacute;nom &eacute;tudiant :
                                </td>
                                <td>
                                    <INPUT type=text name=\"prenom\">
                                </td>
                            </tr>
                            <tr>
                                <td colspam=\"2\">
                                    <br/>Coordonn&eacute;es de l'entreprise :<br/><br/>
                                 </td>
                            </tr>
                            <tr>
                                <td>
                                    Nom de l'entreprise :
                                </td>
                                <td>
                                    <INPUT type=text name=\"nom_entreprise\">
                                </td>
                            </tr>
                            <tr>
                                <td colspam=\"2\">
                                    <br/>Adresse de l'entreprise :<br/><br/>
                                 </td>
                            </tr>
                            <tr>
                                <td>
                                    N°, Rue :
                                </td>
                                <td>
                                    <INPUT type=text name=\"num_rue\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Code postal :
                                </td>
                                <td>
                                    <INPUT type=text name=\"code_postal\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ville :
                                </td>
                                <td>
                                     <INPUT type=text name=\"ville\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pays :
                                </td>
                                <td>
                                     <INPUT type=text name=\"pays\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    T&eacute;l&eacute;phone accueil :
                                </td>
                                <td>
                                     <INPUT type=text name=\"tel_accueil\">
                                </td>
                            </tr>
                             <tr>
                                <td colspam=\"2\">
                                    <br/>Coordonn&eacute;es du tuteur :<br/><br/>
                                 </td>
                            </tr>
                            <tr>
                                <td>
                                    Nom tuteur :
                                </td>
                                <td>
                                    <INPUT type=text name=\"nom_tuteur\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pr&eacute;nom tuteur :
                                </td>
                                <td>
                                    <INPUT type=text name=\"prenom_tuteur\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    T&eacute;l&eacute;phone fixe :
                                </td>
                                <td>
                                    <INPUT type=text name=\"tel_fixe\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    T&eacute;l&eacute;phone portable :
                                </td>
                                <td>
                                    <INPUT type=text name=\"tel_port\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Mail :
                                </td>
                                <td>
                                    <INPUT type=text name=\"mail\">
                                </td>
                            </tr>
                            <tr>
                                <td colspam=\"2\">
                                    <br/>Informations stage :<br/><br/>
                                 </td>
                            </tr>
                             <tr>
                                <td>
                                    Sujet :
                                </td>
                                <td>
                                    <textarea rows=\"3\" name=\"sujet\">
                                    Tapez ici votre sujet</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Date d&eacute;but (JJ/MM/AAAA) :
                                </td>
                                <td>
                                    <INPUT type=text name=\"date_deb\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Date fin (JJ/MM/AAAA) :
                                </td>
                                <td>
                                    <INPUT type=text name=\"date_fin\">
                                </td>
                            </tr>
                        </table>
                    </form><br/>
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
