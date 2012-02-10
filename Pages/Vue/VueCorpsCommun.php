<?php

require_once(RACINE_VUE.'Fonctions.php');

function genererPageAccueil() {
    $corps = "<table class=\"login\">
                    <tr>
                        <td id=\"log_champ_connexion\">
                            Connexion
                        </td>
                    </tr>
                        <td class=\"corps_log\">
                            <form action=\"" . RACINE . "?action=connexion\" method=\"post\">
                                <table class=\"login\">
                                    <tr>
                                        <td colspan=\"2\">
                                            Service d'authentification de Nancy 2<br/><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Email :</td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:250px;\" name=\"login\" id=\"recherche\" title=\"saisie_login\"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Mot de passe :</td>
                                        <td>
                                            <input type=\"password\" class=\"forml\" style=\"width:250px;\" name=\"password\" id=\"recherche\" title=\"saisie_mdp\"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=\"2\" class=\"bouton_form\">
                                            <input id=\"log-submit\" type=\"submit\" value=\"Connexion\" />
                                            <input id=\"reset\" type=\"reset\" value=\"Reset\" />
                                        </td>
                                    </tr>
                                </table>
                            </form><br/><br/>
                            <a href=\"" . RACINE . "?action=inscription\">Cr&eacute;er un compte</a>
                        </td>
                    </tr>
                </table>
            ";

    return $corps;
}

function genererPageAccueilErreue() {
    $corps = "<table class=\"login\">
                <tr>
                    <td class=\"erreur\">
                        Erreur ! Identifiants incorrects
                    </td>
                </tr>
            </table>
            <table class=\"login\">
                    <tr>
                        <td id=\"log_champ_connexion\">
                            Connexion
                        </td>
                    </tr>
                        <td class=\"corps_log\">
                            <form action=\"" . RACINE . "?action=connexion\" method=\"post\">
                                <table class=\"login\">
                                    <tr>
                                        <td colspan=\"2\">
                                            Service d'authentification de Nancy 2<br/><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Email :</td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:250px;\" name=\"login\" id=\"recherche\" title=\"saisie_login\"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Mot de passe :</td>
                                        <td>
                                            <input type=\"password\" class=\"forml\" style=\"width:250px;\" name=\"password\" id=\"recherche\" title=\"saisie_mdp\"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=\"2\" class=\"bouton_form\">
                                            <input id=\"log-submit\" type=\"submit\" value=\"Connexion\" />
                                            <input id=\"reset\" type=\"reset\" value=\"Reset\" />
                                        </td>
                                    </tr>
                                </table>
                            </form><br/><br/>
                            <a href=\"" . RACINE . "?action=inscription\">Cr&eacute;er un compte</a>
                        </td>
                    </tr>
                </table>
            ";

    return $corps;
}

function genererPageInscriptionTerminee() {

    $corps = "<table class=\"login\">
                    <tr>
                        <td id=\"log_champ_connexion\">
                            Inscription termin&eacute;e.
                        </td>
                    </tr>
                        
                    <tr>
                        <td class=\"corps_inscription\">

                            Un lien de confirmation vous a &eacute;t&eacute; envoy&eacute; par mail.
                        </td>
                     </tr>
                </table>
            ";

    return $corps;
}

function genererPageInscription($tabPromotion) {

    $corps = "<table class=\"login\">
                    <tr>
                        <td id=\"log_champ_connexion\">
                            Inscription
                        </td>
                    </tr>
                        <td class=\"corps_inscription\">
                            <script src=\"" . RACINE . RACINE_SCRIPT . "VerifierInscription.js\" type=\"text/javascript\"></script>
                            <form onsubmit=\"return verifierFormulaire()\" action=\"" . RACINE . "?action=inscription\" method=\"post\">
                                <table class=\"login\">

                                    <tr>
                                        <td class=\"champ_log_mdp\">Nom :<etoile>*</etoile></td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:200px;\" name=\"nom\" id=\"nom\" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Pr&eacute;nom :<etoile>*</etoile></td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:200px;\" name=\"prenom\" id=\"prenom\" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Mail :<etoile>*</etoile></td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:200px;\" name=\"mail\" id=\"mail\" />
                                        </td>
                                        <td>
                                            @etudiant.univ-nancy2.fr
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Num&eacute;ro &eacute;tudiant :<etoile>*</etoile></td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:200px;\" name=\"numetudiant\" id=\"numetudiant\" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Promotion :<etoile>*</etoile></td>
                                        <td>
                                            <select name=\"promotion\" id=\"promotion\">";

    foreach ($tabPromotion as $promoCourante) {


        $corps .= "<option value=\"" . $promoCourante->getIdpromotion() . "\">" . $promoCourante->getNompromotion() . "</option>";
    }

    $corps .= "</select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Mot de passe :<etoile>*</etoile></td>
                                        <td>
                                            <input type=\"password\" class=\"forml\" style=\"width:200px;\" name=\"password\" id=\"password\" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Confirmation :<etoile>*</etoile></td>
                                        <td>
                                            <input type=\"password\" class=\"forml\" style=\"width:200px;\" name=\"password2\" id=\"password2\" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=\"2\" class=\"bouton_form\">
                                            <input id=\"log-submit\" type=\"submit\" value=\"Valider\" />
                                            <input id=\"reset\" type=\"reset\" value=\"Reset\" />
                                        </td>
                                    </tr>
                                </table>
                            </form><br/><br/>
                        </td>
                    </tr>
                </table>
            ";

    return $corps;
}

function genererValiderModificationsStage($ok) {
    if ($ok) {
        $corps = "
                <td id = \"corps\">
                    Les donn&eacute;es ont bien &eacute;t&eacute; modifi&eacute;es.
               </td>
            </tr>
        </table>
        ";
    } else {
        $corps = "
                <td id = \"corps\">
                   Erreur, les modifications ne seront pas prises en compte
               </td>
            </tr>
        </table>
        ";
    }
    return $corps;
}


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
