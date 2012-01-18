<?php

// fonction utilisateur
// fonction responsable
// fonction communes

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
                                        <td class=\"champ_log_mdp\">Login :</td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:160px;\" name=\"login\" id=\"recherche\" title=\"saisie_login\"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Mot de passe :</td>
                                        <td>
                                            <input type=\"password\" class=\"forml\" style=\"width:160px;\" name=\"password\" id=\"recherche\" title=\"saisie_mdp\"/>
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
                            <a href=\"".RACINE."?action=inscription\">Cr&eacute;er un compte</a>
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
                                        <td class=\"champ_log_mdp\">Login :</td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:160px;\" name=\"login\" id=\"recherche\" title=\"saisie_login\"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Mot de passe :</td>
                                        <td>
                                            <input type=\"password\" class=\"forml\" style=\"width:160px;\" name=\"password\" id=\"recherche\" title=\"saisie_mdp\"/>
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
                                        <td class=\"champ_log_mdp\">Nom :</td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:200px;\" name=\"nom\" id=\"nom\" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Pr&eacute;nom :</td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:200px;\" name=\"prenom\" id=\"prenom\" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Mail :</td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:200px;\" name=\"mail\" id=\"mail\" />
                                        </td>
                                        <td>
                                            @etudiant.univ-nancy2.fr
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Num&eacute;ro &eacute;tudiant :</td>
                                        <td>
                                            <input type=\"text\" class=\"forml\" style=\"width:200px;\" name=\"numetudiant\" id=\"numetudiant\" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Promotion :</td>
                                        <td>
                                            <select name=\"promotion\" id=\"promotion\">";

                                            foreach ($tabPromotion as $promoCourante) {


                                                $corps .= "<option value=\"" . $promoCourante->getIdpromotion() . "\">" . $promoCourante->getNompromotion() . "</option>";
                                            }

                                            $corps .= "</select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Mot de passe :</td>
                                        <td>
                                            <input type=\"password\" class=\"forml\" style=\"width:200px;\" name=\"password\" id=\"password\" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=\"champ_log_mdp\">Confirmation :</td>
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

function genererPagePrincipal() {
    $corps = "<td rowspan=\"2\" id=\"corps\">
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
function genererEditerPropositionEtudiant($proposition, $modeleFicheRenseignement) {
    if ($proposition != NULL) {
        $corps = "<td id = \"corps\">
                <h2>Edition d'une proposition de stage</h2>
                <script src=\"" . RACINE . RACINE_SCRIPT . "VerifierFormEditerProposition.js\" type=\"text/javascript\"></script>
                <form onsubmit=\"return verifierEditerProposition()\" action=\"" . RACINE . "?action=editerPropositionStage&idProposition=" . $proposition->getIdProposition() . "&sujetModifie=true\" method=\"post\"  enctype=\"multipart/form-data\">
                <table class = \"tableau\">
                    <tr>
                        <td class = \"tableau\">
                            Date de proposition :
                        </td>
                        <td class = \"tableau\">
                            " . $proposition->getDateProposition() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Nom de l'entreprise :
                        </td>
                        <td class = \"tableau\">
                            " . $proposition->getNomEntreprise() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Adresse :
                        </td>
                        <td class = \"tableau\">
                            " . $proposition->getAdresseEntreprise() . "<br/>" .
                $proposition->getCodePostal() . "<br/>" .
                $proposition->getVille() . "<br/>" .
                $proposition->getPays() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Num&eacute;ro de t&eacute;l&eacute;phone :
                        </td>
                        <td class = \"tableau\">
                            " . $proposition->getNumTelephone() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Site Web :
                        </td>
                        <td class = \"tableau\">
                            " . $proposition->getUrlSite() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Titre du stage <etoile>*</etoile>:
                        </td>
                        <td class = \"tableau\">
                            <textarea rows=\"3\" cols=\"60\" id=\"titreStage\" name=\"titreStage\" >" . $proposition->getTitreStage() . "</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Sujet <etoile>*</etoile>:
                        </td>
                        <td class = \"tableau\">
                            <textarea rows=\"10\" cols=\"60\" id=\"sujetStage\" name=\"sujetStage\" >" . $proposition->getSujet() . "</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Technologies utilisées <etoile>*</etoile>:
                        </td>
                        <td class = \"tableau\">
                            <textarea rows=\"3\" cols=\"60\" id=\"technoStage\" name=\"technoStage\" >" . $proposition->getTechnoStage() . "</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Fiche de renseignement :
                        </td>
                        <td class = \"tableau\">";

                            if ($modeleFicheRenseignement != null){
                                $corps .= "<a href=\"".RACINE."?action=telechargement&idproposition=".$proposition->getIdProposition()."\">".$modeleFicheRenseignement->getNomOriginal()."</a>";
                            }
                        $corps .="</td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Changer la fiche de renseignement :
                        </td>
                        <td class = \"tableau\">
                            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"3145728\" />
                            <input type=\"file\" name=\"ficherenseignement\" id=\"ficherenseignement\" />
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Etat de la proposition :
                        </td>
                        <td class = \"tableau\">
                            " . $proposition->getEtat() . "
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
                            Sujet de stage
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
                            <td class=\"tableau\">" . $prop->getNomEntreprise() . ", " . $prop->getVille() . " (" . $prop->getPays() . ")"
                    . "</td>
                        <td class=\"tableau\">" . $prop->getTitreStage()
                    . "</td>
                            <td class=\"tableau\"><a href=\"" . RACINE . "?action=detailProp&idprop=" . $prop->getIdProposition() . "\">D&eacute;tails</a>
                            </td>
                        </tr>";
        }
    }
    $corps = $corps . "</table></td> </tr> </table>";
    return $corps;
}

function genererDetailProposition($proposition, $modeleFicheRenseignement) {
    $corps = "";
    if ($proposition != NULL) {
        $corps = "<td id = \"corps\">
            <h2>Proposition de stage</h2><br/>
            <form method=\"post\" action=\"" . RACINE . "?action=validerProp&idprop=" . $proposition->getIdProposition() . "\">
            <table>
            <tr>
                <td>
                    Date de proposition :
                </td>
                <td>
                    <input type=text readonly=\"true\" name=\"dateproposition\" value=\"" . $proposition->getDateProposition() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Nom :
                </td>
                <td>
                    <input type=text readonly=\"true\" name=\"nom\" value=\"" . $proposition->getEtudiant()->getNom() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Pr&eacute;om :
                </td>
                <td>
                    <input type=text readonly=\"true\" name=\"prenom\" value=\"" . $proposition->getEtudiant()->getPrenom() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Promotion :
                </td>
                <td>
                    <input type=text readonly=\"true\" name=\"promotionetudiant\" value=\"" . $proposition->getPromotionEtudiant() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Nom Entreprise :
                </td>
                <td>
                    <input type=text readonly=\"true\" name=\"nomentreprise\" value=\"" . $proposition->getNomEntreprise() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Adresse :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" size=\"35\" name=\"adresseentreprise\" value=\"" . $proposition->getAdresseEntreprise() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Code postal :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" name=\"codepostalentreprise\" value=\"" . $proposition->getCodePostal() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Ville :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" name=\"villeentreprise\" value=\"" . $proposition->getVille() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    Pays :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" name=\"paysentreprise\" value=\"" . $proposition->getPays() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    N&deg; Tel :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" name=\"telentreprise\" value=\"" . $proposition->getNumTelephone() . "\">
                </td>
            </tr>
            <tr>
                <td>
                    URL Site :
                </td>
                <td>
                    <input type=\"text\" readonly=\"true\" name=\"urlsite\" value=\"" . $proposition->getUrlSite() . "\">
                </td>
            </tr>
            </table>

            <h3>Sujet de stage</h3>
            </br>

            Titre du stage (résumé du sujet en quelques mots) :
            <br />
            <input type=text id=\"titreStage\" readonly=\"true\" name=\"titreStage\" size=\"75\" maxlength=\"200\" value=\"" . $proposition->getTitreStage() . "\">

            <br />
            Sujet complet de stage : <br />
            <textarea rows=\"10\" cols=\"60\" readonly=\"true\" id=\"sujetStage\" name=\"sujetStage\" >" . $proposition->getSujet() . "</textarea>
            <br />


            Technologies utilisées :
            </br>
                <input type=text id=\"technoStage\" readonly=\"true\" name=\"technoStage\" size=\"75\" maxlength=\"200\" value=\"" . $proposition->getTechnoStage() . "\">

            </br>
            </br>
            Fiche de renseignement : ";
            if ($modeleFicheRenseignement != null){
                $corps .= "<a href=\"".RACINE."?action=telechargement&idproposition=".$proposition->getIdProposition()."\">".$modeleFicheRenseignement->getNomOriginal()."</a>";
            }

            $corps .= "
            </br>
            </br>
            Raison du refus (le cas échéant) :
            </br>

                <textarea rows=\"5\" cols=\"60\" id=\"raisonrefus\" name=\"raisonrefus\"></textarea>

            </br>
            </br>

            <input id=\"submit_refus_prop\" type=\"submit\" name=\"refuser\" value=\"Refuser cette proposition\"/>
            <input id=\"submit_valid_prop\" type=\"submit\" name=\"valider\" value=\"Valider cette proposition\"/>

            </br>

            </td>
                </tr>
            </table>
            </form>
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
        $corps .="La proposition de stage a &eacute;t&eacute; refus&eacute;e";
    }
    $corps .= "</td>
                </tr>
            </table>";
    return $corps;
}

function genererListeStage($tabStage) {
    $corps = "<td id = \"corps\">
            <h2>Liste des stages</h2>
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
                            Titre du stage
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
                            <td class=\"tableau\">" . $stage->getEntreprise()->getNom() . ", " . $stage->getEntreprise()->getVille() . " (" . $stage->getEntreprise()->getPays() . ")"
                    . "</td>
                            <td class=\"tableau\">" . $stage->getEtatstage()
                    . "</td>
                            <td class=\"tableau\">" . $stage->getTitreStage()
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

function genererListeStageAnneeCourante($tabStage) {
    $corps = "<td id = \"corps\">
            <h2>Liste des stages de l'ann&eacute;e courante</h2>
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
                            Titre du stage
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
                            <td class=\"tableau\">" . $stage->getEntreprise()->getNom() . ", " . $stage->getEntreprise()->getVille() . " (" . $stage->getEntreprise()->getPays() . ")"
                    . "</td>
                            <td class=\"tableau\">" . $stage->getEtatstage()
                    . "</td>
                            <td class=\"tableau\">" . $stage->getTitreStage()
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
    $corps .= "<form name=\"formulaireModifierAdmin\" onsubmit=\"return verifierSelectionnerAdmin()\" method=\"post\" action=\"" . RACINE . "?action=modifierAdmin\">";

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

        $i = 0;
        foreach ($tabAdmin as $adminCourant) {

            $corps .= "<tr><td class=\"tableau\"> ";
            if ($i == 0) {

                $corps .= "<input type=\"radio\" name=\"idUtilisateur\" value=\"" . $adminCourant->getId() . "\" id=\"" . $adminCourant->getId() . "\" checked=\"checked\"/>";
            } else {

                $corps .= "<input type=\"radio\" name=\"idUtilisateur\" value=\"" . $adminCourant->getId() . "\" id=\"" . $adminCourant->getId() . "\" />";
            }
            $i++;
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $adminCourant->getPrenom();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $adminCourant->getNom();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $adminCourant->getPromotion();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $adminCourant->getMail();


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


        $corps .= "</td>
            </tr>
        </table>";
        return $corps;
    }
}

function genererModiferCompteAdmin($modeleUtilisateur, $tabPromotion) {

    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "VerifierFormAdmin.js\" type=\"text/javascript\"></script>";
    $corps .= "<form name=\"formulaireModifierAdmin\" onsubmit=\"return verifierAjouterAdmin()\" method=\"post\" action=\"" . RACINE . "?action=modifierAdminEtape2\">";


    $corps .= "<td id = \"corps\">
                <h2>Modifier un compte administrateur</h2>

            <form name=\"formulaire\" onsubmit=\"return verifierAjouterAdmin()\" method=\"post\" action=\"" . RACINE . "?action=ajouterAdmin\">

            <input type=hidden id=\"idUtilisateur\" name=\"idUtilisateur\" value=\"" . $modeleUtilisateur->getId() . "\">
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
        if ($modeleUtilisateur->getIdPromotion() == $promoCourante->getIdpromotion()) {
            $corps .= "<option value=\"" . $promoCourante->getIdpromotion() . "\"selected>" . $promoCourante->getNompromotion() . "</option>";
        } else {
            $corps .= "<option value=\"" . $promoCourante->getIdpromotion() . "\">" . $promoCourante->getNompromotion() . "</option>";
        }
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
        <br />
        <input type=\"button\" value=\"Supprimer\" onclick=\"confirmerAvantSuppression(" . $modeleUtilisateur->getId() . ")\">
        <input type=\"submit\" value=\"Modifier\"></form><br /><br />";

    $corps .= "</td>
            </tr>
        </table>";
    return $corps;
}

function genererAfficherOption() {

    $corps = "<td id = \"corps\">
                <h1>Option</h1>

                <a href=\"" . RACINE . "?action=gererPromotion\">G&eacute;rer les promotions</a>


            </td>
            </tr>
        </table>";
    return $corps;
}

function genererGererPromotion($tabPromotion) {

    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "VerifierFormGererPromotion.js\" type=\"text/javascript\"></script>";
    $corps .= "<form name=\"formulaireAjout\" onsubmit=\"return verifierAjoutPromotion()\" method=\"post\" action=\"" . RACINE . "?action=gererPromotion\">
                <input type=hidden id=\"actionPromotion\" name=\"actionPromotion\" value=\"ajouter\">";
    $corps .= "<td id = \"corps\">
                <h1>G&eacute;rer les promotions</h1>

                <h2>Liste des promotions</h2>

                <ul>
                ";

    foreach ($tabPromotion as $promoCourante) {

        $corps .= "<li>" . $promoCourante->getNompromotion() . "</li>";
    }

    $corps .= "</ul>

                <h2>Ajouter une promotion</h2>

                 S&eacute;lectionner la promotion :</br>";

    $tabPromoDejaAffiche[0] = "nagagull";
    $k = 0;

    foreach ($tabPromotion as $promoCourante) {

        $tab = preg_split('/ /', $promoCourante->getNompromotion());
        $taille = sizeof($tab);


        $aff = "";
        for ($i = 0; $i < $taille - 1; $i++) {

            $aff .= $tab[$i] . " ";
        }
        $aff = substr($aff, 0, strlen($aff) - 1);
        $afficherPromo = TRUE;

        if (in_array($aff, $tabPromoDejaAffiche)) {

            $afficherPromo = FALSE;
        } else {

            $tabPromoDejaAffiche[$k] = $aff;
            $k++;
        }

        if ($afficherPromo) {

            $corps .= "<input type=\"radio\" name=\"idPromo\" value=\"" . $aff . "\" id=\"" . $promoCourante->getIdpromotion() . "\" />
                                    <label for=" . $promoCourante->getIdpromotion() . ">" . $aff . "</label><br />";
        }
    }


    $corps .= "</br>Année universitaire :
                </br>(sous la forme \"2010-2011\")</br>
                <input type=text name=\"anneeUniv\" id=\"anneeUniv\" value=\"\">
                </br></br>
                <input type=\"submit\"  value=\"Ajouter\">
                </form>
                ";

    $corps .= "<h2>Supprimer une promotion</h2>

                <form name=\"formulaireSupprimer\" onsubmit=\"return confirmerAvantSuppression()\" method=\"post\" action=\"" . RACINE . "?action=gererPromotion\">
                <input type=hidden id=\"actionPromotion\" name=\"actionPromotion\" value=\"supprimer\">
                ";

    foreach ($tabPromotion as $promoCourante) {

        $corps .= "<input type=\"radio\" name=\"idPromoSupprimer\" value=\"" . $promoCourante->getIdpromotion() . "\" id=\"" . $promoCourante->getIdpromotion() . "\" />
                            <label for=" . $promoCourante->getIdpromotion() . ">" . $promoCourante->getNompromotion() . "</label><br />";
    }
    $corps .= "<input type=\"submit\" value=\"Supprimer\" >
                        </form>
                        ";

    $corps .= "</td>
            </tr>
        </table>";
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
                        Fonction : " . $stage[0]->getContact()->getFonction() . "<br/>
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
                        Date embauche : " . $stage[0]->getDateembauche() . "<br/>
                        Titre de stage :" . $stage[0]->getTitreStage() . "<br/>
                        Sujet :" . $stage[0]->getSujetstage() . "<br/>
                        Technologies utilisées :" . $stage[0]->getTechnoStage() . "<br/>
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

    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "DateChooser.js\" type=\"text/javascript\"></script>
        <td id = \"corps\">";

    if ($stage != NULL) {
        $corps .= "<form name=\"editionStage\" method=\"post\" action=\"" . RACINE . "?action=validerModifStage&idstage=" . $_GET['idstage'] . "\">
                <h2>Editer les informations du stage</h2><br/>
                <table class=\"tableau\">
                    <tr>
                        <td>
                            Etat du stage :
                        </td>
                        <td>
                            <select name=\"etatstage\" id=\"etatstage\">
                                <option value=\"" . $stage[0]->getEtatstage() . "\">" . $stage[0]->getEtatstage() . "</option>

        ";
        if ($stage[0]->getEtatstage() == "valide") {
            $corps .="
              <option value=\"attente signature entreprise\">attente signature entreprise</option>
              <option value=\"attente signature universite\">attente signature universite</option>
            ";
        } else if ($stage[0]->getEtatstage() == "attente signature entreprise") {
            $corps .="
              <option value=\"valide\">valide</option>
              <option value=\"attente signature universite\">attente signature universite</option>
            ";
        } else if ($stage[0]->getEtatstage() == "attente signature universite") {
            $corps .="
              <option value=\"valide\">
              <option value=\"attente signature entreprise\">
            ";
        } else if ($stage[0]->getEtatstage() == "") {
            $corps .="
              <option value=\"valide\">valide</option>
              <option value=\"attente signature entreprise\">attente signature entreprise</option>
              <option value=\"attente signature universite\">attente signature universite</option>
            ";
        } else if ($stage[0]->getEtatstage() == NULL) {
            $corps .="
              <option value=\"valide\">valide</option>
              <option value=\"attente signature entreprise\">attente signature entreprise</option>
              <option value=\"attente signature universite\">attente signature universite</option>
            ";
        }


        $corps .="
                            </select>
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
                            <input type=\"text\" name=\"datedeb\" class=\"calendrier\" value=\"" . $stage[0]->getDatedebut() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Date de fin :
                        </td>
                        <td>
                            <input type=\"text\" name=\"datefin\" class=\"calendrier\" value=\"" . $stage[0]->getDatefin() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Date de soutenance :
                        </td>
                        <td>
                            <input type=\"text\" name=\"datesoutenance\" class=\"calendrier\" value=\"" . $stage[0]->getDatesoutenance() . "\" >
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
                            Embauche :
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
                            <input type=\"text\" name=\"dateembauche\" class=\"calendrier\" value=\"" . $stage[0]->getDateembauche() . "\" >
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

function genererListePropositionStageEtudiant($tabProp) {


    $i = 1;

    $corps = "<td id = \"corps\">
            <h2>Proposition de stage</h2><br/>";

    if ($tabProp != NULL) {

        foreach ($tabProp as $prop) {

            $corps .= "
                <h3>Proposition " . $i . " :</h3>
                 <table class=\"proposition\">
                    <tr>
                      <td class=\"bloc_prop_entreprise\">
                
                 <table class=\"prop_entreprise\">
                    <tr>
                        <td colspan=\"2\" class=\"titre_prop\">
                            <h4>Informations sur l'entreprise</h4>
                        <td>
                    </tr>
                    <tr>
                        <td class=\"prop_align_text\">
                            Nom de l'entreprise :
                        </td>
                        <td>
                            " . $prop->getNomEntreprise() . "
                        </td>
                    </tr>
                    <tr>
                        <td class=\"proposition_adresse\">
                            Adresse :
                        </td>
                        <td>
                            " . $prop->getAdresseEntreprise() . "<br/>" .
                    $prop->getCodePostal() . "<br/>" .
                    $prop->getVille() . "<br/>" .
                    $prop->getPays() . "
                        </td>
                    </tr>
                    <tr>
                        <td class=\"prop_align_text\">
                            Num&eacute;ro de t&eacute;l&eacute;phone :
                        </td>
                        <td>
                            " . $prop->getNumTelephone() . "
                        </td>
                    </tr>
                    <tr>
                        <td class=\"prop_align_text\">
                            Site Web :
                        </td>
                        <td>
                            " . $prop->getUrlSite() . "
                        </td>
                    </tr>
                </table>
                </td>
                <td class=\"bloc_prop_entreprise\">
                        
                <table class=\"etat_prop\">
                    <tr>
                        <td colspan=\"2\" class=\"titre_prop\">
                            <h4>Suivi de la proposition</h4>
                        <td>
                    </tr>
                    <tr>
                        <td class=\"prop_align_text\">
                            Date de proposition :
                        </td>
                        <td>
                            " . $prop->getDateProposition() . "
                        </td>
                    </tr>";

            if ($prop->getEtat() == "refusée") {
                $corps .= "
                    <tr>
                        <td class=\"prop_align_text\">
                            Etat de la propositionn :
                        </td>
                        <td>
                            <rouge>" . $prop->getEtat() . "<rouge>
                        </td>
                    </tr>";

                if ($prop->getRaisonrefus() != "") {
                    $corps .= "
                    <tr>
                        <td class=\"prop_align_text\">
                            Motif du refus :
                        </td>
                        <td>
                          <rouge>" . $prop->getRaisonrefus() . "</rouge>
                        </td>
                    </tr>
                ";
                }
                $corps .= "</table>";
            } else {
                $corps .= "
                    <tr>
                        <td class=\"prop_align_text\">
                            Etat de la propositionn :
                        </td>
                        <td>
                            <vert>" . $prop->getEtat() . "</vert>
                        </td>
                    </tr>
                </table>
                ";
            }
             $corps .="
                 </td>
                </tr></table>
                <table class=\"sujet\">
                    <tr>
                        <td class=\"sujet_titre\">
                            <h4>Titre du sujet : </h4>
                        </td>
                        <td>
                            " . $prop->getTitreStage() . "
                        </td>
                    </tr>
                
                 ";
                    
            $corps .="<tr><td colspan=\"2\" class=\"prop_action\">";
            if ($prop->getEtat() == "refusée") {

                $corps .="<a href=\"" . RACINE . "?action=supprimerProposition&idProposition=" . $prop->getIdProposition() . "\">Supprimer cette proposition</a>";
            } else {
                $corps .="<a href=\"" . RACINE . "?action=editerPropositionStage&idProposition=" . $prop->getIdProposition() . "\">Editer cette proposition</a>";
            }
            $corps .="</td></tr></table>";


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
    $corps .= "<form onsubmit=\"return verifierFormulaireEtape2()\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape3\" enctype=\"multipart/form-data\">
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
                </table>

                </br>
                <h3>Sujet de stage</h3>
                </br>

                Titre du stage (résumé du sujet en quelques mots) <etoile>*</etoile>:
                <br />
                <input type=text id=\"titreStage\" name=\"titreStage\" size=\"75\" maxlength=\"200\">

                <br />
                Sujet complet de stage : <etoile>*</etoile><br />
                <textarea rows=\"10\" cols=\"60\" id=\"sujetStage\" name=\"sujetStage\" ></textarea>
                <br />


                Technologies utilisées <etoile>*</etoile>:
                </br>
                <input type=text id=\"technoStage\" name=\"technoStage\" size=\"75\" maxlength=\"200\" >

                
                </br>
                Fiche de renseignements (<= 3 Mo) <etoile>*</etoile>:
                </br>
                <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"3145728\" />
                <input type=\"file\" name=\"ficherenseignement\" id=\"ficherenseignement\" /><br />

                </br>
                <input type=\"submit\" value=\"Valider la proposition\"></form><br /><br />
                </br>
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
            $corps .= $contactCourant->getPrenom();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getNom();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getFonction();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getTelephoneFixe();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getTelephoneMobile();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getMail();


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
                <table>
                    <tr>
                        <td class=\"form_proposer_stage_choix_entreprise\">
                            
                            <form method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape1\">
                                Entrer le nom de l'entreprise : <input type=text name=\"nom\" value=\"" . $nom . "\">
                                <input type=\"submit\" value=\"Rechercher\">
                            </form><br /><br />
                        </td>
                    </tr>
                </table>
                ";
                


    $corps .= "<form name=\"formulaire\" onsubmit=\"return verifierFormulaireEtape1()\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape2\">";

    // on liste les entreprises ayant un nom similaire
    if ($tabEntreprise != NULL) {
        
        $corps .= "<table class=\"info_etape1\">
                        <tr>
                            <td>
                                <h3>Information</h3>
                                Des entreprises ayant un nom similaires ont &eacute;t&eacute; trouv&eacute;es dans la base.<br/>
                                Si votre entreprise apparait dans le tableau ci-dessous, veuillez la sélectionner puis cliquer sur \"Etape suivante\".<br/>
                                Dans le cas contraire, veuillez remplir le formulaire en bas de page.
                            </td>
                        </tr>
                    </table><br/>
            
                  <table class=\"tab_prop_stage\"><tr>
                  <td class=\"entete_tab_prop_stage\"></td>
                  <td class=\"entete_tab_prop_stage\"> Nom entreprise </td>
                  <td class=\"entete_tab_prop_stage\"> Adresse </td>
                  <td class=\"entete_tab_prop_stage\"> Ville </td>
                  <td class=\"entete_tab_prop_stage\"> Code postal </td>
                  <td class=\"entete_tab_prop_stage\"> Pays </td>
                  
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
            
            
            $corps .= "<br /><input type=\"submit\" value=\"Etape suivante\"></form><br /><hr/>
                <form name=\"formulaire_ajout\" onsubmit=\"return verifierFormulaireEtape1()\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape2\">
                    
                <input type=\"radio\" name=\"idEntreprise\" value=\"ajouter\" id=\"ajouter\" checked=\"checked\"/> <label for=\"autre\">Ajouter une entreprise :</label>";
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
    }
    $corps .="</form>";
    $corps .="</td> </tr> </table>";
    return $corps;
}

function genererProblemeUploadFichier() {

    $corps = "<td id = \"corps\">";

    $corps .= "Il y a un problème lors de l'envoie du(des) fichier(s). <BR />
                (Attention à la limite des 3 Mo)";
    $corps .= "</td>
            </tr>
        </table>";

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
                            " . $stage->getEtatstage() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Nom de l'entreprise :
                        </td>
                        <td class = \"tableau\">
                            " . $stage->getEntreprise()->getNom() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Titre du stage :
                        </td>
                        <td class = \"tableau\">
                            " . $stage->getTitreStage() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Sujet :
                        </td>
                        <td class = \"tableau\">
                            " . $stage->getSujetstage() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Technologies utilisées :
                        </td>
                        <td class = \"tableau\">
                            " . $stage->getTechnoStage() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Date de d&eacute;but :
                        </td>
                        <td class = \"tableau\">
                            " . $stage->getDatedebut() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Date de fin :
                        </td>
                        <td class = \"tableau\">
                            " . $stage->getDatefin() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tableau\">
                            Responsabilit&eacute;e civile :
                        </td>
                        <td class = \"tableau\">
                            " . $stage->getDatefin() . "
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
                                " . $stage->getContact()->getNom() . "
                            </td>
                        </tr>
                        <tr>
                            <td class = \"tableau\">
                                Pr&eacute;nom :
                            </td>
                            <td class = \"tableau\">
                                " . $stage->getContact()->getPrenom() . "
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
?>


