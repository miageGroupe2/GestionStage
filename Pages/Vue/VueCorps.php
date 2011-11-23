<?php

// fonction utilisateur
// fonction responsable
// fonction communes

function genererPageAccueil() {
    $corps = "<table>
                    <tr>
                        <td id=\"corps_log\">
                            Connexion :
                            <form action=\"" . RACINE . "?action=connexion\" method=\"post\">
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
                        </td>
                    </tr>
                </table>
            ";

    return $corps;
}

function genererPageAccueilErreue() {
    $corps = "<table>
                <tr>
                    <td class=\"erreur\">
                        Erreur ! Mot de passe incorrect
                    </td>
                </tr>
            </table>
            <table>
                    
                    <tr>
                        <td id=\"corps_log\">
                            Connexion :
                            <form action=\"" . RACINE . "?action=connexion\" method=\"post\">
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
                        </td>
                    </tr>
                </table>
            ";

    return $corps;
}

function genererPagePrincipal() {
    $corps = "<td id = \"corps\">
                   Bienvenue
                   
                </td>
            </tr>
        </table>";
    return $corps;
}

/**
 * Permet d'afficher la page indiquant à l'utilisateur que sa proposition de stage a été acceptée
 * @return string le code html
 */
function genererAjoutPropositionStageOk() {

    $corps = "<td id = \"corps\">
                    Proposition de stage accept&eacute;e.
                </td>
            </tr>
        </table>";
    return $corps;
}

/**
 * Permet d'afficher la page permettant d'éditer une proposition de stage (côté étudiant)
 */
function genererEditerPropositionEtudiant($proposition) {
    if ($proposition == NULL) {
        $corps = "<td id = \"corps\">
                <h2>Edition d'une proposition de stage</h2>
                <script src=\"" . RACINE . RACINE_SCRIPT . "VerifierFormEditerProposition.js\" type=\"text/javascript\"></script>
                <form onsubmit=\"return verifierEditerProposition()\" action=\"" . RACINE . "?action=editerPropositionStage&idProposition=" . $proposition->getIdProposition() . "&sujetModifie=true\" method=\"post\">
                <table class = \"tableau\">
                    <tr>
                        <td class = \"tableau\">
                            Date de proposition :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($proposition->getDateProposition()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Nom de l'entreprise :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($proposition->getNomEntreprise()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Adresse :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($proposition->getAdresseEntreprise()) . "<br/>" .
                htmlentities($proposition->getCodePostal()) . "<br/>" .
                htmlentities($proposition->getVille()) . "<br/>" .
                htmlentities($proposition->getPays()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Num&eacute;ro de t&eacute;l&eacute;phone :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($proposition->getNumTelephone()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Site Web :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($proposition->getUrlSite()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Sujet :
                        </td>
                        <td class = \"tableau\">
                            <textarea rows=\"10\" cols=\"60\" id=\"sujetStage\" name=\"sujetStage\" >" . htmlentities($proposition->getSujet()) . "</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Etat de la proposition :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($proposition->getEtat()) . "
                        </td>
                    </tr>
                </table>
                <input type=\"button\" value=\"Supprimer\" onclick=\"confirmerAvantSuppression(" . $proposition->getIdProposition() . ")\">
                <input type=\"submit\" value=\"Valider\">


                </td>
            </tr>
        </table>";
    } else {
        $corps = "
                <td id = \"corps\">
                    La proposition de stage semble ne pas avoir &eacute;t&eacute; remont&eacute;e.
                </td>
            </tr>
        </table>
        ";
    }
    return $corps;
}

/**
 * 
 */
function genererRechercheEntreprise() {
    $corps = "<td id = \"corps\">
        <form action=\"" . RACINE . "?action=effectuerRechercheEntreprise\" method=\"post\">
                  <table>
                   <tr>
                       <td colspam=\"2\">
                           <h3>Rechercher une entreprise :</h3>
                       </td>
                   </tr>
                   <tr>
                       <td>
                            Nom entreprise <etoile>*</etoile> : 
                       </td>
                       <td>
                           <input type=text name=\"nomEntreprise\"> <input type=\"submit\" value=\"Envoyer\">
                       </td>
                    </tr>
                    </table>
                 </form>
                </td>
            </tr>
        </table>";
    return $corps;
}

/**
 * Permet de générer l'affichage des entreprises correspondantes à une recherche 
 * @param type $tabEntreprise 
 */
function genererListeResultatRechercheEntreprise($tabEntreprise) {

    $corps = "<td id = \"corps\">
        
                  <form method=\"post\" action=\"" . RACINE . "?action=choisirEntreprise\">
                  <table class=\"tableau\"><tr>
                  <td class=\"tableau\"> Choix </td>
                  <td class=\"tableau\"> Nom entreprise </td>
                  <td class=\"tableau\"> Adresse </td>
                  <td class=\"tableau\"> Ville </td>
                  <td class=\"tableau\"> Pays </td>
                  <td class=\"tableau\"> T&eacute;l&eacute;phone Fixe </td>
                  <td class=\"tableau\"> Numéro de Siret </td>
                  <td class=\"tableau\"> Site web </td>
                  </tr>";

    if ($tabEntreprise != null) {

        foreach ($tabEntreprise as $entrepriseCourante) {

            $corps .= "<tr><td class=\"tableau\"> ";
            $corps .= "<input type=\"radio\" name=\"idEntreprise\" value=\"" . $entrepriseCourante->getId() . "\" id=\"" . $entrepriseCourante->getId() . "\" />";
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getNom();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getAdresse();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getVille();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getPays();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getNumeroTelephone();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getNumeroSiret();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getUrlSiteInternet();

            $corps .= "</tr>";
        }
    }
    $corps .= "</table>";
    $corps .= "<input id=\"log-submit\" type=\"submit\" value=\"Choisir cette entreprise\"/>";
    $corps .= "</form>";

    $corps .= "</td>
            </tr>
        </table>";

    return $corps;
}

function genererListePropositionStageResponsable($tabProp) {


    $corps = "<td id = \"corps\">
                <table class=\"tableau\">
                    <tr>
                        <td class=\"tableau\">
                            Nom &eacute;tudiant
                        </td>
                        <td class=\"tableau\">
                            Pr&eacute;nom &eacute;tudiant
                        </td>
                        <td class=\"tableau\">
                            Nom de l'entreprise
                        </td>
                        <td class=\"tableau\">
                            Informations suppl&eacute;mentaires
                        </td>
                    </tr>
            ";
    if ($tabProp != null) {
        foreach ($tabProp as $prop) {
            $corps = $corps . "
                        <tr>
                            <td class=\"tableau\">" . $prop->getEtudiant()->getNom()
                    . "</td>
                            <td class=\"tableau\">" . $prop->getEtudiant()->getPrenom()
                    . "</td>
                            <td class=\"tableau\">" . $prop->getNomEntreprise()
                    . "</td>
                            <td class=\"tableau\"><a href=\"" . RACINE . "?action=detailProp&idprop=" . $prop->getIdProposition() . "\">D&eacute;tails</a>
                            </td>
                        </tr>";
        }
    }
    $corps = $corps . "</table></td> </tr> </table>";
    return $corps;
}

function genererDetailProposition($proposition) {
    $corps = "";
    if ($proposition != NULL) {
        $corps = "<td id = \"corps\">
            <h2>Proposition de stage</h2><br/>
            <form method=\"post\" action=\"" . RACINE . "?action=validerProp&idprop=" . htmlentities($proposition->getIdProposition()) . "\">
            <table>
            <tr>
                <td>
                    Date de proposition :
                </td>
                <td>
                    <input type=text readonly=\"true\" name=\"dateproposition\" value=\"" . htmlentities($proposition->getDateProposition()) . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Nom :
                </td>
                <td>
                    <input type=text readonly=\"true\" name=\"nom\" value=\"" . htmlentities($proposition->getEtudiant()->getNom()) . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Pr&eacute;om :
                </td>
                <td>
                    <input type=text readonly=\"true\" name=\"prenom\" value=\"" . htmlentities($proposition->getEtudiant()->getPrenom()) . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Promotion :
                </td>
                <td>
                    <input type=text readonly=\"true\" name=\"promotionetudiant\" value=\"" . htmlentities($proposition->getPromotionEtudiant()) . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Nom Entreprise :
                </td>
                <td>
                    <input type=text readonly=\"true\" name=\"nomentreprise\" value=\"" . htmlentities($proposition->getNomEntreprise()) . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Adresse :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" size=\"35\" name=\"adresseentreprise\" value=\"" . htmlentities($proposition->getAdresseEntreprise()) . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Code postal :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" name=\"codepostalentreprise\" value=\"" . htmlentities($proposition->getCodePostal()) . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Ville :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" name=\"villeentreprise\" value=\"" . htmlentities($proposition->getVille()) . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Pays :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" name=\"paysentreprise\" value=\"" . htmlentities($proposition->getPays()) . "\">
                </td>
            </tr>
            <tr>
                <td>
                    N&deg; Tel :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" name=\"telentreprise\" value=\"" . htmlentities($proposition->getNumTelephone()) . "\">
                </td>
            </tr>
            <tr>
                <td>
                    URL Site :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" name=\"urlsite\" value=\"" . htmlentities($proposition->getUrlSite()) . "\">
                </td>
            </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <h2>Sujet :</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        " . htmlentities($proposition->getSujet()) . "
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id=\"submit_valid_prop\" type=\"submit\" value=\"Valider cette proposition\"/>
                    </td>
                </tr>
            </table>
            </td>
                </tr>
            </table>
        ";
    } else {
        $corps = "
                <td id = \"corps\">
                    La proposition de stage semble ne pas avoir &eacute;t&eacute; remont&eacute;e.
                </td>
            </tr>
        </table>
        ";
    }
    return $corps;
}

function genererValiderProposition($ok) {
    $idProp = $_GET['idprop'];


    $corps = "<td id =   \"corps\">";
    if ($ok) {
        $corps .="La proposition de stage a bien &eacute;t&eacute; valid&eacute;e";
    } else {
        $corps .="ERREUR - Probl&egrave;me lors de la validation, transaction annul&eacute;e";
    }
    $corps .= "</td>
                </tr>
            </table>";
    return $corps;
}

function genererListeStage($tabStage) {
    $corps = "<td id = \"corps\">
                <table class=\"tableau\">
                    <tr>
                        <td class=\"tableau\">
                            Date validation
                        </td>
                        <td class=\"tableau\">
                            Nom &eacute;tudiant
                        </td>
                        <td class=\"tableau\">
                            Pr&eacute;nom &eacute;tudiant
                        </td>
                        <td class=\"tableau\">
                            Nom de l'entreprise
                        </td>
                        <td class=\"tableau\">
                            Etat stage
                        </td>
                        <td class=\"tableau\">
                            Note obtenue
                        </td>
                        <td class=\"tableau\">
                            Nom promotion
                        </td>
                    </tr>
            ";
    if ($tabStage != null) {
        foreach ($tabStage as $stage) {
            $corps = $corps . "
                        <tr>
                            <td class=\"tableau\">" . $stage->getDatevalidation()
                    . "</td>
                            <td class=\"tableau\">" . $stage->getUtilisateur()->getNom()
                    . "</td>
                            <td class=\"tableau\">" . $stage->getUtilisateur()->getPrenom()
                    . "</td>
                            <td class=\"tableau\">" . $stage->getEntreprise()->getNom()
                    . "</td>
                            <td class=\"tableau\">" . $stage->getEtatstage()
                    . "</td>
                            <td class=\"tableau\">" . $stage->getNoteobtenue()
                    . "</td>
                            <td class=\"tableau\">" . $stage->getPromotion()->getNompromotion()
                    . "</td>
                            <td class=\"tableau\"><a href=\"" . RACINE . "?action=detailStage&idstage=" . $stage->getIdstage() . "\">D&eacute;tails</a>
                            </td>
                     </tr>";
        }
        $corps .= "</table>";
    }

    $corps .= "</td>
                </tr>
            </table>";
    return $corps;
}

function genererGererCompteAdmin($tabAdmin, $tabPromotion) {

    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "VerifierFormAdmin.js\" type=\"text/javascript\"></script>";
    $corps .= "<form name=\"formulaireModifierAdmin\" onsubmit=\"return verifierModifierAdmin()\" method=\"post\" action=\"" . RACINE . "?action=modifierAdmin\">";

    $corps .= "<td id = \"corps\">
                <h2>Gestion des administrateurs</h2>";

    if ($tabAdmin != null) {

        $corps .= "<table class=\"tableau\"><tr>
                  <td class=\"tableau\"> Choix </td>
                  <td class=\"tableau\"> Pr&eacute;nom </td>
                  <td class=\"tableau\"> Nom </td>
                  <td class=\"tableau\"> Promotion </td>
                  <td class=\"tableau\"> Mail </td>
                  </tr>";

        foreach ($tabAdmin as $adminCourant) {

            $corps .= "<tr><td class=\"tableau\"> ";

            $corps .= "<input type=\"radio\" name=\"idUtilisateur\" value=\"" . $adminCourant->getId() . "\" id=\"" . $adminCourant->getId() . "\" />";
            $corps .= "</td><td class=\"tableau\">";
            $corps .= htmlentities($adminCourant->getPrenom());
            $corps .= "</td><td class=\"tableau\">";
            $corps .= htmlentities($adminCourant->getNom());
            $corps .= "</td><td class=\"tableau\">";
            $corps .= htmlentities($adminCourant->getPromotion());
            $corps .= "</td><td class=\"tableau\">";
            $corps .= htmlentities($adminCourant->getMail());


            $corps .= "</td></tr>";
        }

        $corps .= "</table>
            <input type=\"submit\" value=\"Modifier\" >
            </form>
                ";


        $corps .= "
            <form name=\"formulaire\" onsubmit=\"return verifierAjouterAdmin()\" method=\"post\" action=\"" . RACINE . "?action=ajouterAdmin\">
            <table> 
            <tr>
                <td>
                    Nom <etoile>*</etoile>:
                </td>
                <td>
                    <input type=text name=\"nom_admin\" id=\"nom_admin\">
                </td>
            </tr>
            <tr>
                <td>
                    Pr&eacute;nom <etoile>*</etoile>:
                </td>
                <td>
                    <input type=text name=\"prenom_admin\" id=\"prenom_admin\">
                </td>
            </tr>
            <tr>
                <td>
                    Promotion :
                </td>
                <td>
                    <select name=\"promotion\" id=\"promotion\">";

        foreach ($tabPromotion as $promoCourante) {


            $corps .= "<option value=\"" . $promoCourante->getIdpromotion() . "\">" . $promoCourante->getNompromotion() . "</option>";
        }

        $corps .= "</select>
                </td>
            </tr>
            <tr>
                <td>
                    Mail <etoile>*</etoile>:
                </td>
                <td>
                    <input type=text name=\"mail_admin\" id=\"mail_admin\">
                </td>

            </tr>
            <tr>
                <td>
                    Mot de passe <etoile>*</etoile>:
                </td>
                <td>
                    <input type=password name=\"mdp_admin\" id=\"mdp_admin\">
                </td>
            </tr>
            <tr>
                <td>
                    Mot de passe v&eacute;rification <etoile>*</etoile>:
                </td>
                <td>
                    <input type=password name=\"mdp2_admin\" id=\"mdp2_admin\">
                </td>
            </tr>
            </table>
            <br /><input type=\"submit\" value=\"Ajouter\"></form><br /><br />";

        return $corps;
    }
}

function genererModiferCompteAdmin($modeleUtilisateur, $tabPromotion) {

    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "VerifierFormAdmin.js\" type=\"text/javascript\"></script>";
    $corps .= "<form name=\"formulaireModifierAdmin\" onsubmit=\"return verifierModifierAdmin()\" method=\"post\" action=\"" . RACINE . "?action=modifierAdmin\">";

    $corps .= "<td id = \"corps\">
                <h2>Modifier un compte administrateur</h2>

            <form name=\"formulaire\" onsubmit=\"return verifierAjouterAdmin()\" method=\"post\" action=\"" . RACINE . "?action=ajouterAdmin\">
            <table> 
            <tr>
                <td>
                    Nom <etoile>*</etoile>:
                </td>
                <td>
                    <input type=text name=\"nom_admin\" id=\"nom_admin\" value=\"" . $modeleUtilisateur->getNom() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Pr&eacute;nom <etoile>*</etoile>:
                </td>
                <td>
                    <input type=text name=\"prenom_admin\" id=\"prenom_admin\" value=\"" . $modeleUtilisateur->getPrenom() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Promotion :
                </td>
                <td>
                    <select name=\"promotion\" id=\"promotion\">";

    foreach ($tabPromotion as $promoCourante) {

        //if ($modeleUtilisateur->get)
        $corps .= "<option value=\"" . $promoCourante->getIdpromotion() . "\">" . $promoCourante->getNompromotion() . "</option>";
    }

    $corps .= "</select>
            </td>
        </tr>
        <tr>
            <td>
                Mail <etoile>*</etoile>:
            </td>
            <td>
                <input type=text name=\"mail_admin\" id=\"mail_admin\" value=\"" . $modeleUtilisateur->getMail() . "\">
            </td>

        </tr>
        <tr>
            <td>
                Mot de passe <etoile>*</etoile>:
            </td>
            <td>
                <input type=password name=\"mdp_admin\" id=\"mdp_admin\">
            </td>
        </tr>
        <tr>
            <td>
                Mot de passe v&eacute;rification <etoile>*</etoile>:
            </td>
            <td>
                <input type=password name=\"mdp2_admin\" id=\"mdp2_admin\">
            </td>
        </tr>
        </table>
        <br /><input type=\"submit\" value=\"Ajouter\"></form><br /><br />";

    return $corps;
}

function genererDetailStage($stage) {

    $corps = "";
    if ($stage != NULL) {
        if ($stage[0]->getRespcivil() == 1) {
            $respcivil = "OK";
        } else {
            $respcivil = "en attente";
        }
        if ($stage[0]->getEmbauche() == 1) {
            $embauche = "OUI";
        } else {
            $embauche = "NON";
        }
        $corps = "<td id = \"corps\">
            <h2>D&eacute;tail du Stage</h2><br/>
            <table class = \"tableau\">
                <tr>
                    <td class = \"tableau\">
                        N° Etudiant : " . $stage[0]->getUtilisateur()->getNumeroetudiant() . "<br/><br/>" .
                $stage[0]->getUtilisateur()->getPrenom() . " " . $stage[0]->getUtilisateur()->getNom() . "<br/>
                        Formation : " . $stage[0]->getPromotion()->getNompromotion() . "<br/>
                        Mail : " . $stage[0]->getUtilisateur()->getMail() . "<br/>    
                    </td>
                     <td class = \"tableau\">
                        Contact Entreprise : <br/><br/>" .
                $stage[0]->getContact()->getPrenom() . " " . $stage[0]->getContact()->getNom() . "<br/>
                        Fonction : " . htmlentities($stage[0]->getContact()->getFonction()) . "<br/>
                        Tel fixe : " . $stage[0]->getContact()->getTelephoneFixe() . "<br/>    
                        Tel mobile : " . $stage[0]->getContact()->getTelephoneMobile() . "<br/>    
                        Mail : " . $stage[0]->getContact()->getMail() . "<br/>    
                    </td>
                </tr>
                <tr>
                    <td colspan=\"2\" class = \"tableau\">
                        Entreprise : <br/><br/>" .
                $stage[0]->getEntreprise()->getNom() . "<br/>
                        Siret : " . $stage[0]->getEntreprise()->getNumeroSiret() . "<br/>    
                        Adresse : <br/><br/>" . $stage[0]->getEntreprise()->getAdresse() . "<br/>" .
                $stage[0]->getEntreprise()->getCodePostal() . "<br/>" . $stage[0]->getEntreprise()->getVille() . "<br/>" .
                $stage[0]->getEntreprise()->getPays() . "<br/><br/> Tel : " .
                $stage[0]->getEntreprise()->getNumeroTelephone() . "<br/>Site Web : " .
                $stage[0]->getEntreprise()->getUrlSiteInternet() . "
                    </td>
                </tr>
                <tr>
                    <td colspan=\"2\" class = \"tableau\">
                        Stage : " . $stage[0]->getEtatstage() . "<br/>Responsabilité civile : " . $respcivil . "<br/><br/>
                        Date de validation : " . $stage[0]->getDatevalidation() . "<br/>
                        Date de d&eacute;but : " . $stage[0]->getDatedebut() . "<br/>
                        Date de fin : " . $stage[0]->getDatefin() . "<br/>
                        Date de soutenance : " . $stage[0]->getDatesoutenance() . "<br/>
                        Lieu de soutenance : " . $stage[0]->getLieusoutenance() . "<br/>
                        Note obtenue : " . $stage[0]->getNoteobtenue() . "<br/>
                        Appr&eacute;ciation obtenue : " . $stage[0]->getAppreciationobtenue() . "<br/>
                        R&eacute;mun&eacute;ration : " . $stage[0]->getRemuneration() . "<br/>
                        Embauche : " . $embauche . "<br/>
                        Date embauche : " . $stage[0]->getDateembauche() . "<br/><br/>
                        Sujet :<br/><br/>" .
                $stage[0]->getSujetstage() . "
                        <br/><br/><a href=\"" . RACINE . "?action=editerStage&idstage=" . $stage[0]->getIdstage() . "\">Modifier les donn&eacute;es du stage</a>
                    </td>
                </tr>
            </table>
             </td>
            </tr>
        </table>
        ";
    } else {
        $corps = "
                <td id = \"corps\">
                    La proposition de stage semble ne pas avoir &eacute;t&eacute; remont&eacute;e.
               </td>
            </tr>
        </table>
        ";
    }

    return $corps;
}

function genererEditerStage($stage) {

    $corps = "<td id = \"corps\"";

    if ($stage != NULL) {
        $corps .= "<form name=\"editionStage\" method=\"post\" action=\"" . RACINE . "?action=validerModifStage&idstage=" . $_GET['idstage'] . "\">
                <h2>Editer les informations du stage</h2><br/>
                <table class=\"tableau\">
                    <tr>
                        <td>
                            Etat du stage :
                        </td>
                        <td>
                            <input type=\"text\" name=\"etatstage\" value=\"" . $stage[0]->getEtatstage() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Responsabilit&eacute; civile :
                        </td>
                        <td>
                            <input type=\"text\" name=\"respcivil\" value=\"" . $stage[0]->getRespcivil() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Date de d&eacute;but :
                        </td>
                        <td>
                            <input type=\"text\" name=\"datedeb\" value=\"" . $stage[0]->getDatedebut() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Date de fin :
                        </td>
                        <td>
                            <input type=\"text\" name=\"datefin\" value=\"" . $stage[0]->getDatefin() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Date de soutenance :
                        </td>
                        <td>
                            <input type=\"text\" name=\"datesoutenance\" value=\"" . $stage[0]->getDatesoutenance() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Lieu desoutenance :
                        </td>
                        <td>
                            <input type=\"text\" name=\"lieusoutenance\" value=\"" . $stage[0]->getLieusoutenance() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Note obtenue :
                        </td>
                        <td>
                            <input type=\"text\" name=\"noteobtenue\" value=\"" . $stage[0]->getNoteobtenue() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Appr&eacute;ciation obtenue :
                        </td>
                        <td>
                            <input type=\"text\" name=\"appreciationobtenue\" value=\"" . $stage[0]->getAppreciationobtenue() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            R&eacute;mun&eacute;ration :
                        </td>
                        <td>
                            <input type=\"text\" name=\"remuneration\" value=\"" . $stage[0]->getRemuneration() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Enbauche :
                        </td>
                        <td>
                            <input type=\"text\" name=\"embauche\" value=\"" . $stage[0]->getEmbauche() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Date embauche :
                        </td>
                        <td>
                            <input type=\"text\" name=\"dateembauche\" value=\"" . $stage[0]->getDateembauche() . "\" >
                        </td>
                    </tr>
                    </table><br/><br/>
                    <input id=\"submit_valid_modif_stage\" type=\"submit\" name=\"Envoyer\" value=\"Envoyer\"><br/>
                </form>
                </td>
                </tr>
            </table>
        ";
    } else {
        $corps = "
                <td id = \"corps\">
                    Le stage semble ne pas avoir &eacute;t&eacute; remont&eacute;e.
               </td>
            </tr>
        </table>
        ";
    }
    return $corps;
}

function genererValiderModificationsStage($ok) {
    if (ok) {
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

function genererListePropositionStageEtudiant($tabProp) {


    $i = 1;

    $corps = "<td id = \"corps\">
            <h2>Proposition de stage</h2><br/>";

    if ($tabProp != NULL) {

        foreach ($tabProp as $prop) {
            $corps .="
                <h3>Proposition " . $i . " :</h3>
                <table class = \"tableau\">
                    <tr>
                        <td class = \"tableau\">
                            Date de proposition :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($prop->getDateProposition()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Nom de l'entreprise :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($prop->getNomEntreprise()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Adresse :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($prop->getAdresseEntreprise()) . "<br/>" .
                    htmlentities($prop->getCodePostal()) . "<br/>" .
                    htmlentities($prop->getVille()) . "<br/>" .
                    htmlentities($prop->getPays()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Num&eacute;ro de t&eacute;l&eacute;phone :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($prop->getNumTelephone()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Site Web :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($prop->getUrlSite()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Sujet :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($prop->getSujet()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Etat de la proposition :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($prop->getEtat()) . "
                        </td>
                    </tr>
                </table><br/>
                <a href=\"" . RACINE . "?action=editerPropositionStage&idProposition=" . $prop->getIdProposition() . "\">Editer cette proposition</a>
            ";
            $i++;
        }
        $corps .="</td></tr></table>";
    } else {
        $corps = "
                <td id = \"corps\">
                    Le stage semble ne pas avoir &eacute;t&eacute; remont&eacute;e.
               </td>
            </tr>
        </table>
        ";
    }
    return $corps;
}

//function genererProposerStageEtape2($tabContact) {
//    
//    $corps = "<script src=\"".RACINE . RACINE_SCRIPT . "VerifierFormPropoStage.js\" type=\"text/javascript\"></script>";
//    $corps .= "<form name=\"formulaire\" onsubmit=\"return verifierFormulaireEtape2()\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape3\">";
//    $corps .= "<td id = \"corps\">
//                <h2>Choix du tuteur</h2>";
//    
//    
//    // si il existe des contacts dans la base, on les affiche 
//    if ($tabContact != null) {
//        
//        $corps .= "<table class=\"tableau\"><tr>
//                  <td class=\"tableau\"> Choix </td>
//                  <td class=\"tableau\"> Pr&eacute;nom </td>
//                  <td class=\"tableau\"> Nom </td>
//                  <td class=\"tableau\"> Fonction </td>
//                  <td class=\"tableau\"> T&eacute;l&eacute;phone Fixe </td>
//                  <td class=\"tableau\"> T&eacute;l&eacute;phone Portable </td>
//                  <td class=\"tableau\"> Mail </td>
//                  </tr>";
//
//        foreach ($tabContact as $contactCourant) {
//
//            $corps .= "<tr><td class=\"tableau\"> ";
//
//            $corps .= "<input type=\"radio\" name=\"idContact\" value=\"" . $contactCourant->getId() . "\" id=\"" . $contactCourant->getId() . "\" />";
//            $corps .= "</td><td class=\"tableau\">";
//            $corps .= $contactCourant->getPrenom();
//            $corps .= "</td><td class=\"tableau\">";
//            $corps .= $contactCourant->getNom();
//            $corps .= "</td><td class=\"tableau\">";
//            $corps .= $contactCourant->getFonction();
//            $corps .= "</td><td class=\"tableau\">";
//            $corps .= $contactCourant->getTelephoneFixe();
//            $corps .= "</td><td class=\"tableau\">";
//            $corps .= $contactCourant->getTelephoneMobile();
//            $corps .= "</td><td class=\"tableau\">";
//            $corps .= $contactCourant->getMail();
//
//
//            $corps .= "</td></tr>";
//        }
//        
//        $corps .= "</table>";
//    }
//    
//    // on affiche le formulaire de saisie d'un nouveau tuteur
//    if ($tabContact == NULL){
//        $corps .= "<br />Il n'existe aucun tuteur pour cette entreprise dans la base. Vous devez l'ajouter :";
//    }else{
//        $corps .= "<br /><input type=\"radio\" name=\"idContact\" value=\"ajouter\" id=\"ajouter\" checked=\"checked\"/> <label for=\"autre\">Ajouter un tuteur :</label>";
//    }
//    
//    $corps .= "<table> 
//            <tr>
//                <td>
//                    Nom <etoile>*</etoile>:
//                </td>
//                <td>
//                    <input type=text name=\"nom_tuteur\" id=\"nom_tuteur\" value=\"Fort\">
//                </td>
//            </tr>
//            <tr>
//                <td>
//                    Pr&eacute;nom <etoile>*</etoile>:
//                </td>
//                <td>
//                    <input type=text name=\"prenom_tuteur\" id=\"prenom_tuteur\" value=\"Bertrand\">
//                </td>
//            </tr>
//            <tr>
//                <td>
//                    Fonction :
//                </td>
//                <td>
//                    <input type=text name=\"fonction_tuteur\">
//                </td>
//            </tr>
//            <tr>
//                <td>
//                    T&eacute;l&eacute;phone fixe :
//                </td>
//                <td>
//                    <input type=text name=\"tel_fixe\">
//                </td>
//            </tr>
//            <tr>
//                <td>
//                    T&eacute;l&eacute;phone portable :
//                </td>
//                <td>
//                    <input type=text name=\"tel_port\">
//                </td>
//            </tr>
//            <tr>
//                <td>
//                    Mail :
//                </td>
//                <td>
//                    <input type=text name=\"mail\">
//                </td>
//            </tr></table>
//            <br /><input type=\"submit\" value=\"Etape suivante\"></form><br /><br />";
//
//    $corps .= "
//                    
//                </td>
//            </tr>
//        </table>";
//
//    return $corps;
//    
//}

function genererProposerStageEtape3() {

    $corps = "<td id = \"corps\">
                <h2>Proposition de stage effectuée</h2>    ";

    $corps .="</td> </tr> </table>";
    return $corps;
}

function genererProposerStageEtape2($entreprise) {

    $utilisateur = $_SESSION['modeleUtilisateur'];

    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "VerifierFormPropoStage.js\" type=\"text/javascript\"></script>";
    $corps .= "<form onsubmit=\"return verifierFormulaireEtape2()\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape3\">
                <td id = \"corps\">
                    <h2>Sujet de stage</h2>   
                    
                <table> 
                    <tr>
                        <td>
                            <h3>Etudiant</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nom :
                        </td>
                        <td>
                            <input type=text readonly=\"true\" value=\"" . $utilisateur->getNom() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Pr&eacute;nom :
                        </td>
                        <td>
                            <input type=text readonly=\"true\" value=\"" . $utilisateur->getPrenom() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Promotion :
                        </td>
                        <td>
                            <input type=text readonly=\"true\" value=\"" . $utilisateur->getPromotion() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Entreprise</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nom de l'entreprise : 
                        </td>
                        <td>
                            <input type=text readonly=\"true\" value=\"" . $entreprise->getNom() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            N°, Rue : 
                        </td>
                        <td>
                            <input type=text readonly=\"true\" value=\"" . $entreprise->getAdresse() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Code postal :
                        </td>
                        <td>
                            <input type=text readonly=\"true\" value=\"" . $entreprise->getCodePostal() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ville : 
                        </td>
                        <td>
                             <input type=text readonly=\"true\" value=\"" . $entreprise->getVille() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Pays : 
                        </td>
                        <td>
                             <input type=text readonly=\"true\" value=\"" . $entreprise->getPays() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            T&eacute;l&eacute;phone accueil : 
                        </td>
                        <td>
                             <input type=text readonly=\"true\" value=\"" . $entreprise->getNumeroTelephone() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Site internet : 
                        </td>
                        <td>
                             <input type=text readonly=\"true\" value=\"" . $entreprise->getUrlSiteInternet() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Sujet de stage</h3>
                        </td>
                    </tr>
                </table>
                <textarea rows=\"10\" cols=\"60\" id=\"sujetStage\" name=\"sujetStage\" ></textarea>
                <br />
                <input type=\"submit\" value=\"Valider la proposition\"></form><br /><br />
                </form>";


    $corps .= "
                    
                </td>
            </tr>
        </table>";
    return $corps;
}

//permet à un étudiant de modifier son tuteur en entreprise
function genererModifierContact($tabContact, $idEntreprise, $idStage) {

    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "verifierModiferContactEtudiant.js\" type=\"text/javascript\"></script>";
    $corps .= "<form name=\"formulaire\" onsubmit=\"return verifierFormulaireModifierContact()\" method=\"post\" action=\"" . RACINE . "?action=modifierContactEtape2\">";
    $corps .= "<td id = \"corps\">
                <h2>Modification du tuteur</h2>";


    // si il existe des contacts dans la base, on les affiche 
    if ($tabContact != null) {

        $corps .= "<table class=\"tableau\"><tr>
                  <td class=\"tableau\"> Choix </td>
                  <td class=\"tableau\"> Pr&eacute;nom </td>
                  <td class=\"tableau\"> Nom </td>
                  <td class=\"tableau\"> Fonction </td>
                  <td class=\"tableau\"> T&eacute;l&eacute;phone Fixe </td>
                  <td class=\"tableau\"> T&eacute;l&eacute;phone Portable </td>
                  <td class=\"tableau\"> Mail </td>
                  </tr>";

        foreach ($tabContact as $contactCourant) {

            $corps .= "<tr><td class=\"tableau\"> ";

            $corps .= "<input type=\"radio\" name=\"idContact\" value=\"" . $contactCourant->getId() . "\" id=\"" . $contactCourant->getId() . "\" />";
            $corps .= "</td><td class=\"tableau\">";
            $corps .= htmlentities($contactCourant->getPrenom());
            $corps .= "</td><td class=\"tableau\">";
            $corps .= htmlentities($contactCourant->getNom());
            $corps .= "</td><td class=\"tableau\">";
            $corps .= htmlentities($contactCourant->getFonction());
            $corps .= "</td><td class=\"tableau\">";
            $corps .= htmlentities($contactCourant->getTelephoneFixe());
            $corps .= "</td><td class=\"tableau\">";
            $corps .= htmlentities($contactCourant->getTelephoneMobile());
            $corps .= "</td><td class=\"tableau\">";
            $corps .= htmlentities($contactCourant->getMail());


            $corps .= "</td></tr>";
        }

        $corps .= "</table>";
    }

    // on affiche le formulaire de saisie d'un nouveau tuteur
    if ($tabContact == NULL) {
        $corps .= "<br />Il n'existe aucun tuteur pour cette entreprise dans la base. Vous devez l'ajouter :";
    } else {
        $corps .= "<br /><input type=\"radio\" name=\"idContact\" value=\"ajouter\" id=\"ajouter\" checked=\"checked\"/> <label for=\"autre\">Ajouter un tuteur :</label>";
    }

    $corps .= "
            <input type=hidden id=\"idEntreprise\" name=\"idEntreprise\" value=\"$idEntreprise\">
            <input type=hidden id=\"idStage\" name=\"idStage\" value=\"$idStage\">
            <table> 
            <tr>
                <td>
                    Nom <etoile>*</etoile>:
                </td>
                <td>
                    <input type=text name=\"nom_tuteur\" id=\"nom_tuteur\" value=\"Fort\">
                </td>
            </tr>
            <tr>
                <td>
                    Pr&eacute;nom <etoile>*</etoile>:
                </td>
                <td>
                    <input type=text name=\"prenom_tuteur\" id=\"prenom_tuteur\" value=\"Bertrand\">
                </td>
            </tr>
            <tr>
                <td>
                    Fonction :
                </td>
                <td>
                    <input type=text name=\"fonction_tuteur\" id=\"fonction_tuteur\">
                </td>
            </tr>
            <tr>
                <td>
                    T&eacute;l&eacute;phone fixe :
                </td>
                <td>
                    <input type=text name=\"tel_fixe\" id=\"tel_fixe\">
                </td>
            </tr>
            <tr>
                <td>
                    T&eacute;l&eacute;phone portable :
                </td>
                <td>
                    <input type=text name=\"tel_port\" id=\"tel_port\">
                </td>
            </tr>
            <tr>
                <td>
                    Mail <etoile>*</etoile>:
                </td>
                <td>
                    <input type=text name=\"mail_tuteur\" id=\"mail_tuteur\">
                </td>
            </tr></table>
            <br /><input type=\"submit\" value=\"Valider\"></form><br /><br />";

    $corps .= "
                    
                </td>
            </tr>
        </table>";

    return $corps;
}

function genererProposerStage($tabEntreprise) {

    $nom = NULL;
    if (isset($_POST['nom'])) {

        $nom = htmlspecialchars($_POST['nom']);
    }


    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "VerifierFormPropoStage.js\" type=\"text/javascript\"></script>";
    $corps .= "<td id = \"corps\">
                <h2>Choix de l'entreprise</h2>                
                
                <form method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape1\">
                            Nom : <input type=text name=\"nom\" value=\"" . $nom . "\">
                    
               <input type=\"submit\" value=\"Rechercher\"></form><br /><br />";


    $corps .= "<form name=\"formulaire\" onsubmit=\"return verifierFormulaireEtape1()\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape2\">";

    // on liste les entreprises ayant un nom similaire
    if ($tabEntreprise != NULL) {

        $corps .= "<table class=\"tableau\"><tr>
                  <td class=\"tableau\"> Choix </td>
                  <td class=\"tableau\"> Nom entreprise </td>
                  <td class=\"tableau\"> Adresse </td>
                  <td class=\"tableau\"> Ville </td>
                  <td class=\"tableau\"> Code postal </td>
                  <td class=\"tableau\"> Pays </td>
                  <td class=\"tableau\"> T&eacute;l&eacute;phone Fixe </td>
                  <td class=\"tableau\"> Numéro de Siret </td>
                  <td class=\"tableau\"> Site web </td>
                  </tr>";


        foreach ($tabEntreprise as $entrepriseCourante) {

            $corps .= "<tr><td class=\"tableau\"> ";
            $corps .= "<input type=\"radio\" name=\"idEntreprise\" value=\"" . $entrepriseCourante->getId() . "\" id=\"" . $entrepriseCourante->getId() . "\" />";
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getNom();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getAdresse();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getVille();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getCodePostal();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getPays();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getNumeroTelephone();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getNumeroSiret();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $entrepriseCourante->getUrlSiteInternet();

            $corps .= "</td></tr>";
        }
        $corps .="</table>";
    }



    // si l'utilisateur a déjà entré un nom d'entreprise
    // on affiche le formulaire de saisie d'une nouvelle entreprise
    if (isset($_POST['nom'])) {


        if ($tabEntreprise == NULL) {

            $corps .= "<br />Il n'existe aucune entreprise ayant un nom similaire dans la base. Vous devez l'ajouter :";
        } else {
            $corps .= "<br /><input type=\"radio\" name=\"idEntreprise\" value=\"ajouter\" id=\"ajouter\" checked=\"checked\"/> <label for=\"autre\">Ajouter une entreprise :</label>";
        }

        $corps .= " <br /><br />
                    
                    <table>
                        <tr>
                            <td colspam=\"2\">
                                <h3>Coordonn&eacute;es  entreprise : </h3>
                             </td>
                        </tr>
                        <tr>
                            <td>
                                Nom de l'entreprise <etoile>*</etoile> : 
                            </td>
                            <td>
                                <input type=text name=\"nom_entreprise\" id=\"nom_entreprise\" value=\"carrefour\">
                            </td>
                        </tr>
                        <tr>
                            <td colspam=\"2\">
                                <br/><h3>Adresse de l'entreprise :</h3><br/>
                             </td>
                        </tr>
                        <tr>
                            <td>
                                N°, Rue <etoile>*</etoile> : 
                            </td>
                            <td>
                                <input type=text name=\"num_rue\" id=\"num_rue\" value=\"10 avenue de libe\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Code postal <etoile>*</etoile> :
                            </td>
                            <td>
                                <input type=text name=\"code_postal\" id=\"code_postal\" value=\"287637\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Ville <etoile>*</etoile> : 
                            </td>
                            <td>
                                 <input type=text name=\"ville\" id=\"ville\" value=\"Lyon\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Pays <etoile>*</etoile> : 
                            </td>
                            <td>
                                 <input type=text name=\"pays\" id=\"pays\" value=\"france\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                T&eacute;l&eacute;phone accueil <etoile>*</etoile> : 
                            </td>
                            <td>
                                 <input type=text name=\"tel_accueil\" id=\"tel_accueil\" value=\"86866\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Site internet : 
                            </td>
                            <td>
                                 <input type=text name=\"siteinternet\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Num&eacute;ro de siret : 
                            </td>
                            <td>
                                 <input type=text name=\"numerosiret\">
                            </td>
                        </tr>
                        </table>

                    <br /><input type=\"submit\" value=\"Etape suivante\"></form><br /><br />";


        $corps .="</form>";
    }
    $corps .="</td> </tr> </table>";
    return $corps;
}

function genererVoirStageEtudiant($stage) {
    $corps = "<td id = \"corps\">                   
                ";
    if ($stage == null) {

        $corps .= "Vous n'avez aucun stage validé pour l'instant.";

        $corps .= "</td>
            </tr>
        </table>";

        return $corps;
    }

    $corps .="
                <table class = \"tableau\">
                    <tr>
                        <td class = \"tableau\">
                            Etat stage :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($stage->getEtatstage()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Nom de l'entreprise :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($stage->getEntreprise()->getNom()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Sujet :
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($stage->getSujetstage()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Date de d&eacute;but : 
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($stage->getDatedebut()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Date de fin : 
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($stage->getDatefin()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Responsabilit&eacute;e civile : 
                        </td>
                        <td class = \"tableau\">
                            " . htmlentities($stage->getDatefin()) . "
                        </td>
                    </tr>
                    
                </table><br/>";

    if ($stage->getContact() == null) {

        $corps .="<a href=\"" . RACINE . "?action=ajouterContact&idStage=" . $stage->getIdstage() . "&idEntreprise=" . $stage->getIdentreprise() . "\">Ajouter un tuteur</a>";
    } else {


        $corps .="
                    Tuteur :
                    <table class = \"tableau\">
                        <tr>
                            <td class = \"tableau\">
                                Nom :
                            </td>
                            <td class = \"tableau\">
                                " . htmlentities($stage->getContact()->getNom()) . "
                            </td>
                        </tr>
                        <tr>
                            <td class = \"tableau\">
                                Pr&eacute;nom :
                            </td>
                            <td class = \"tableau\">
                                " . htmlentities($stage->getContact()->getPrenom()) . "
                            </td>
                        </tr>
                    </table>
                    
                    <a href=\"" . RACINE . "?action=modifierContact&idStage=" . $stage->getIdstage() . "&idEntreprise=" . $stage->getIdentreprise() . "\">Modifier le tuteur</a>


                ";
    }

    $corps .= "</td>
            </tr>
        </table>";

    return $corps;
}

/* ancienne fonction genererProposerStage :
 * $messageErreurRemplissage = '';

  if ($erreurRemplissage) {

  $messageErreurRemplissage = "Veuillez renseigner tous les champs obligatoires <etoile>*</etoile>.";
  }

  $nom = NULL ;
  if (isset ($_POST['nom'])){
  $nom= $_POST['nom'];
  }
  $prenom = NULL ;
  if (isset ($_POST['prenom'])){
  $nom= $_POST['prenom'];
  }
  $promoL3 = FALSE ;
  $promoM2_SID = FALSE ;
  $promoM2_ACSI = FALSE ;

  if (isset ($_POST['promotion'])){

  if($_POST['promotion']== "l3"){

  $promoL3 = TRUE ;

  }else if($_POST['promotion']== "m2_sid"){

  $promoM2_SID = TRUE ;


  }else if($_POST['promotion']== "m2_acsi"){

  $promoM2_ACSI = TRUE ;
  }
  }

  $corps = "
  <td id = \"corps\">
  <h2>Proposer un stage</h2>
  $messageErreurRemplissage
  <form action=\"" . RACINE . "?action=validerProposerStage\" method=\"post\">
  <table>
  <tr>
  <td colspam=\"2\">
  <h3>Coordonn&eacute;es &eacute;tudiant :</h3>
  </td>
  </tr>
  <tr>
  <td>
  Nom <etoile>*</etoile> :
  </td>
  <td>
  <input type=text name=\"nom\" value=\"".$nom."\">
  </td>
  </tr>
  <tr>
  <td>
  Pr&eacute;nom <etoile>*</etoile> :
  </td>
  <td>
  <input type=text name=\"prenom\ value=\"".$prenom."\">
  </td>
  </tr>
  <tr>
  <td>
  Formation <etoile>*</etoile> :
  </td>
  <td>
  <select name=\"promotion\">
  <option VALUE=\"choisir\">Choisir</option>";

  if ($promoL3 == TRUE){
  $corps .= "<option VALUE=\"l3\" selected=\"selected\">L3 MIAGE</option>" ;
  }else{
  $corps .= "<option VALUE=\"l3\">L3 MIAGE</option>" ;
  }
  if ($promoM2_ACSI == TRUE){
  $corps .= "<option VALUE=\"m2_acsi\" selected=\"selected\">M2 MIAGE ACSI</option>" ;
  }else{
  $corps .= "<option VALUE=\"m2_acsi\">M2 MIAGE ACSI</option>";
  }
  if ($promoM2_SID == TRUE){
  $corps .= "<option VALUE=\"m2_sid\" selected=\"selected\">M2 MIAGE SID</option>" ;
  }else{
  $corps .= "<option VALUE=\"m2_sid\">M2 MIAGE SID</option>";
  }

  $corps .="</select>
  </td>
  </tr>
  <tr>
  <td colspam=\"2\">
  <h3>Coordonn&eacute;es  entreprise : </h3>
  </td>
  </tr>
  <tr>
  <td>
  Nom de l'entreprise <etoile>*</etoile> :
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
  N°, Rue <etoile>*</etoile> :
  </td>
  <td>
  <input type=text name=\"num_rue\">
  </td>
  </tr>
  <tr>
  <td>
  Code postal <etoile>*</etoile> :
  </td>
  <td>
  <input type=text name=\"code_postal\">
  </td>
  </tr>
  <tr>
  <td>
  Ville <etoile>*</etoile> :
  </td>
  <td>
  <input type=text name=\"ville\">
  </td>
  </tr>
  <tr>
  <td>
  Pays <etoile>*</etoile> :
  </td>
  <td>
  <input type=text name=\"pays\">
  </td>
  </tr>
  <tr>
  <td>
  T&eacute;l&eacute;phone accueil <etoile>*</etoile> :
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
  Nom :
  </td>
  <td>
  <input type=text name=\"nom_tuteur\">
  </td>
  </tr>
  <tr>
  <td>
  Pr&eacute;nom :
  </td>
  <td>
  <input type=text name=\"prenom_tuteur\">
  </td>
  </tr>
  <tr>
  <tr>
  <td>
  Fonction :
  </td>
  <td>
  <input type=text name=\"fonction_tuteur\">
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
  Sujet <etoile>*</etoile> :
  </td>
  <td>
  <textarea cols=\"60\" rows=\"9\" name=\"sujet\"> Tapez ici une synthèse de votre sujet (mettre javascript ou rien et ajouter \"synthese\" dans le libelle)</textarea>
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
 */
?>


