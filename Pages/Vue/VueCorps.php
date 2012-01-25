<?php

// fonction utilisateur
// fonction responsable
// fonction communes

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
function genererEditerPropositionEtudiant($proposition, $modeleFicheRenseignement, $modeleFicheSujetStage) {
    if ($proposition != NULL) {
        $corps = "<td id = \"corps\">
                <h2>Edition d'une proposition de stage</h2>
                <script src=\"" . RACINE . RACINE_SCRIPT . "VerifierFormEditerProposition.js\" type=\"text/javascript\"></script>
                <form onsubmit=\"return verifierEditerProposition()\" action=\"" . RACINE . "?action=editerPropositionStage&idProposition=" . $proposition->getIdProposition() . "&sujetModifie=true\" method=\"post\"  enctype=\"multipart/form-data\">
                <table class = \"tableau\">
                    <tr>
                        <td class = \"intitule_colg\">
                            Date de proposition :
                        </td>
                        <td class = \"tableau\">
                            " .convertirDateENFR($proposition->getDateProposition()) . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
                            Nom de l'entreprise :
                        </td>
                        <td class = \"tableau\">
                            " . $proposition->getNomEntreprise() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
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
                        <td class = \"intitule_colg\">
                            Num&eacute;ro de t&eacute;l&eacute;phone :
                        </td>
                        <td class = \"tableau\">
                            " . $proposition->getNumTelephone() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
                            Site Web :
                        </td>
                        <td class = \"tableau\">
                            " . $proposition->getUrlSite() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
                            Titre du stage <etoile>*</etoile>:
                        </td>
                        <td class = \"tableau\">
                            <textarea rows=\"3\" cols=\"60\" id=\"titreStage\" name=\"titreStage\" >" . $proposition->getTitreStage() . "</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
                            Sujet <etoile>*</etoile>:
                        </td>
                        <td class = \"tableau\">
                            <textarea rows=\"10\" cols=\"60\" id=\"sujetStage\" name=\"sujetStage\" >" . $proposition->getSujet() . "</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
                            Technologies utilisées <etoile>*</etoile>:
                        </td>
                        <td class = \"tableau\">
                            <textarea rows=\"3\" cols=\"60\" id=\"technoStage\" name=\"technoStage\" >" . $proposition->getTechnoStage() . "</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
                            Fiche de renseignement :
                        </td>
                        <td class = \"tableau\">";

        if ($modeleFicheRenseignement != null) {
            $corps .= "<a href=\"" . RACINE . "?action=telechargement&type=renseignement&estUneProposition&id=" . $proposition->getIdProposition() . "\">" . $modeleFicheRenseignement->getNomOriginal() . "</a>";
        }
        $corps .="</td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
                            Changer la fiche de renseignement :
                        </td>
                        <td class = \"tableau\">
                            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"3145728\" />
                            <input type=\"file\" name=\"ficherenseignement\" id=\"ficherenseignement\" />
                        </td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
                            Fiche de sujet de stage :
                        </td>
                        <td class = \"tableau\">";

        if ($modeleFicheSujetStage != null) {
            $corps .= "<a href=\"" . RACINE . "?action=telechargement&type=sujet&estUneProposition&id=" . $proposition->getIdProposition() . "\">" . $modeleFicheSujetStage->getNomOriginal() . "</a>";
        }
        $corps .="</td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
                            Changer la fiche de sujet de stage :
                        </td>
                        <td class = \"tableau\">
                            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"3145728\" />
                            <input type=\"file\" name=\"fichesujetstage\" id=\"fichesujetstage\" />
                        </td>
                    </tr>
                    <tr>
                        <td class = \"intitule_colg\">
                            Etat de la proposition :
                        </td>
                        <td class = \"tableau\">
                            " . $proposition->getEtat() . "
                        </td>
                    </tr>
                </table><br/><br/>
                <table>
                    <tr>
                        <td class=\"submit\">
                            <input type=\"button\" value=\"Supprimer\" onclick=\"confirmerAvantSuppression(" . $proposition->getIdProposition() . ")\">
                            <input type=\"submit\" value=\"Valider\">
                        </td>
                    </tr>
                </table>

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
                <h2>Propositions de stage</h2>
                <table class=\"tab_prop_stage\">
                    <tr>
                        <td class=\"entete_tab_prop_stage\">
                            Nom &eacute;tudiant
                        </td>
                        <td class=\"entete_tab_prop_stage\">
                            Pr&eacute;nom &eacute;tudiant
                        </td>
                        <td class=\"entete_tab_prop_stage\">
                            Nom de l'entreprise
                        </td>
                        <td class=\"entete_tab_prop_stage\">
                            Sujet de stage
                        </td>
                        <td class=\"entete_tab_prop_stage\">
                            + d'infos
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

function genererDetailProposition($proposition, $modeleFicheRenseignement, $modeleSujetStage) {
    $corps = "";
    if ($proposition != NULL) {
        $corps = "<td id = \"corps\">
            <h2>Proposition de stage</h2><br/>
            <form method=\"post\" action=\"" . RACINE . "?action=validerProp&idprop=" . $proposition->getIdProposition() . "\">
            <table class=\"detail_prop_stage\">
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    Date de proposition :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . convertirDateENFR($proposition->getDateProposition()) . "
                </td>
            </tr>
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    Nom :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . $proposition->getEtudiant()->getNom() . "
                </td>
            </tr>
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    Pr&eacute;om :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . $proposition->getEtudiant()->getPrenom() . "
                </td>
            </tr>
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    Promotion :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . $proposition->getPromotionEtudiant() . "
                </td>
            </tr>
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    Nom Entreprise :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . $proposition->getNomEntreprise() . "
                </td>
            </tr>
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    Adresse :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . $proposition->getAdresseEntreprise() . "
                </td>
            </tr>
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    Code postal :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . $proposition->getCodePostal() . "
                </td>
            </tr>
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    Ville :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . $proposition->getVille() . "
                </td>
            </tr>
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    Pays :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . $proposition->getPays() . "
                </td>
            </tr>
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    N&deg; Tel :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . $proposition->getNumTelephone() . "
                </td>
            </tr>
            <tr>
                <td class=\"detail_prop_stage_colg\">
                    URL Site :
                </td>
                <td class=\"detail_prop_stage_cold\">
                    " . $proposition->getUrlSite() . "
                </td>
            </tr>
            </table>";
        
            $corps .="<h2>Fichiers attach&eacute;s - Technologies utilis&eacute;es</h2>
            <table class=\"detail_prop_stage\">
                <tr>
                    <td class=\"detail_prop_stage_colg\">
                        Technologies utilisées :
                    </td>
                    <td class=\"detail_prop_stage_colg\">
                        Fiche de renseignement : 
                    </td>
                    <td class=\"detail_prop_stage_colg\">
                        Fiche de sujet de stage :
                    </td>
                </tr>
                <tr>
                    <td class=\"detail_prop_stage_cold\">
                        ". $proposition->getTechnoStage() . "
                    </td>
                    <td class=\"detail_prop_stage_cold\">
                        ";
                        if ($modeleFicheRenseignement != null) {
                            $corps .= "<a href=\"" . RACINE . "?action=telechargement&type=renseignement&estUneProposition&id=" . $proposition->getIdProposition() . "\">" . $modeleFicheRenseignement->getNomOriginal() . "</a>";
                        }
                        $corps.="
                    </td>
                    <td class=\"detail_prop_stage_cold\">";
                        if ($modeleSujetStage != null) {
                            $corps .= "<a href=\"" . RACINE . "?action=telechargement&type=sujet&estUneProposition&id=" . $proposition->getIdProposition() . "\">" . $modeleSujetStage->getNomOriginal() . "</a>";
                        }
                        $corps.="
                    </td>
                </tr>
            </table>";

            $corps .="          
            <h2>Sujet de stage</h2>
            <table class=\"detail_prop_stage\">
                <tr>
                    <td>
                        Titre du stage (résumé du sujet en quelques mots) :
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea rows=\"4\" cols=\"60\" readonly=\"true\" id=\"sujetStage\" name=\"titreSujetStage\" >" . $proposition->getTitreStage() . "\"></textarea>
                    </td>
                </tr>
            </table>
            <table class=\"detail_prop_stage\">
                <tr>
                    <td>
                        Sujet complet de stage :
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea rows=\"10\" cols=\"60\" readonly=\"true\" id=\"sujetStage\" name=\"sujetStage\" >" . $proposition->getSujet() . "</textarea>
                    </td>
                </tr>
            </table>";
            
                      
        

        $corps .= "
            <br/><br/>
            <table class=\"information\">
                    <tr>
                        <td>
                        <h3>Information</h3>
                        En cas de refus de la proposition de stage, il est possible de faire mentionner un motif de refus.<br/>
                        Veuillez compl&eacute;r la zone de texte ci-dessous.<br/>
                    </td>
                </tr>
            </table>
            <br/><br:>
            <table class=\"detail_prop_stage\">
                <tr>
                    <td>
                        Motif de refus (facultatif) :
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea rows=\"5\" cols=\"60\" id=\"raisonrefus\" name=\"raisonrefus\"></textarea>
                    </td>
                </tr>
            </table>
            <table class=\"detail_prop_stage\">
                <tr>
                    <td>
                        <input id=\"submit_refus_prop\" type=\"submit\" name=\"refuser\" value=\"Refuser cette proposition\"/>
                    </td>
                    <td>
                        <input id=\"submit_valid_prop\" type=\"submit\" name=\"valider\" value=\"Valider cette proposition\"/>
                    </td>
                </tr>
            </table>

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
                <h3>Options</h3>

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

function genererDetailStage($stage, $modeleFicheRenseignement, $modeleFicheSujetStage) {

    $corps = "";
    if ($stage != NULL) {
        if ($stage->getRespcivil() == 1) {
            $respcivil = "OK";
        } else {
            $respcivil = "en attente";
        }
        if ($stage->getEmbauche() == 1) {
            $embauche = "OUI";
        } else {
            $embauche = "NON";
        }
        $corps = "<td id = \"corps\">
            <h2>D&eacute;tail du Stage</h2><br/>
            <table class = \"tableau\">
                <tr>
                    <td class = \"tableau\">
                        N° Etudiant : " . $stage->getUtilisateur()->getNumeroetudiant() . "<br/><br/>" .
                $stage->getUtilisateur()->getPrenom() . " " . $stage->getUtilisateur()->getNom() . "<br/>
                        Formation : " . $stage->getPromotion()->getNompromotion() . "<br/>
                        Mail : " . $stage->getUtilisateur()->getMail() . "<br/>
                    </td>
                     <td class = \"tableau\">
                        Contact Entreprise : <br/><br/>" .
                $stage->getContact()->getPrenom() . " " . $stage->getContact()->getNom() . "<br/>
                        Fonction : " . $stage->getContact()->getFonction() . "<br/>
                        Tel fixe : " . $stage->getContact()->getTelephoneFixe() . "<br/>
                        Tel mobile : " . $stage->getContact()->getTelephoneMobile() . "<br/>
                        Mail : " . $stage->getContact()->getMail() . "<br/>
                    </td>
                </tr>
                <tr>
                    <td colspan=\"2\" class = \"tableau\">
                        Entreprise : <br/><br/>" .
                $stage->getEntreprise()->getNom() . "<br/>
                        Siret : " . $stage->getEntreprise()->getNumeroSiret() . "<br/>
                        Adresse : <br/><br/>" . $stage->getEntreprise()->getAdresse() . "<br/>" .
                $stage->getEntreprise()->getCodePostal() . "<br/>" . $stage->getEntreprise()->getVille() . "<br/>" .
                $stage->getEntreprise()->getPays() . "<br/><br/> Tel : " .
                $stage->getEntreprise()->getNumeroTelephone() . "<br/>Site Web : " .
                $stage->getEntreprise()->getUrlSiteInternet() . "
                    </td>
                </tr>
                <tr>
                    <td colspan=\"2\" class = \"tableau\">
                        Stage : " . $stage->getEtatstage() . "<br/>Responsabilité civile : " . $respcivil . "<br/><br/>
                        Date de validation : " . $stage->getDatevalidation() . "<br/>
                        Date de d&eacute;but : " . $stage->getDatedebut() . "<br/>
                        Date de fin : " . $stage->getDatefin() . "<br/>
                        Date de soutenance : " . $stage->getDatesoutenance() . "<br/>
                        Lieu de soutenance : " . $stage->getLieusoutenance() . "<br/>
                        Note obtenue : " . $stage->getNoteobtenue() . "<br/>
                        Appr&eacute;ciation obtenue : " . $stage->getAppreciationobtenue() . "<br/>
                        R&eacute;mun&eacute;ration : " . $stage->getRemuneration() . "<br/>
                        Embauche : " . $embauche . "<br/>
                        Date embauche : " . $stage->getDateembauche() . "<br/>
                        Titre de stage :" . $stage->getTitreStage() . "<br/>
                        Sujet :" . $stage->getSujetstage() . "<br/>
                        Technologies utilisées :" . $stage->getTechnoStage() . "<br/>

                        Fiche de renseignement : <a href=\"" . RACINE . "?action=telechargement&type=renseignement&id=" . $stage->getIdstage() . "\">" .$modeleFicheRenseignement->getNomOriginal() . "</a>
                        <br/>
                        Fiche du sujet de stage : <a href=\"" . RACINE . "?action=telechargement&type=sujet&id=" . $stage->getIdstage() . "\">" .$modeleFicheSujetStage->getNomOriginal() . "</a>
                        <br/><br/><a href=\"" . RACINE . "?action=editerStage&idstage=" . $stage->getIdstage() . "\">Modifier les donn&eacute;es du stage</a>
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
                            <select name=\"etatstage\" id=\"etatstage\">";

                            $corps .= "<option selected=\"selected\" value=\"" . $stage->getEtatstage() . "\">" . $stage->getEtatstage() . "</option>";
                            if ($stage->getEtatstage() == "en cours"){

                                $corps .= "<option value=\"valide\">validé</option>" ;
                            }else{
                                $corps .= "<option value=\"en cours\">en cours</option>" ;
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
                            <input type=\"text\" name=\"respcivil\" value=\"" . $stage->getRespcivil() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Date de d&eacute;but :
                        </td>
                        <td>
                            <input type=\"text\" name=\"datedeb\" class=\"calendrier\" value=\"" . $stage->getDatedebut() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Date de fin :
                        </td>
                        <td>
                            <input type=\"text\" name=\"datefin\" class=\"calendrier\" value=\"" . $stage->getDatefin() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Date de soutenance :
                        </td>
                        <td>
                            <input type=\"text\" name=\"datesoutenance\" class=\"calendrier\" value=\"" . $stage->getDatesoutenance() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Lieu desoutenance :
                        </td>
                        <td>
                            <input type=\"text\" name=\"lieusoutenance\" value=\"" . $stage->getLieusoutenance() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Note obtenue :
                        </td>
                        <td>
                            <input type=\"text\" name=\"noteobtenue\" value=\"" . $stage->getNoteobtenue() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Appr&eacute;ciation obtenue :
                        </td>
                        <td>
                            <input type=\"text\" name=\"appreciationobtenue\" value=\"" . $stage->getAppreciationobtenue() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            R&eacute;mun&eacute;ration :
                        </td>
                        <td>
                            <input type=\"text\" name=\"remuneration\" value=\"" . $stage->getRemuneration() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Embauche :
                        </td>
                        <td>
                            <input type=\"text\" name=\"embauche\" value=\"" . $stage->getEmbauche() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Date embauche :
                        </td>
                        <td>
                            <input type=\"text\" name=\"dateembauche\" class=\"calendrier\" value=\"" . $stage->getDateembauche() . "\" >
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

function genererAfficherOptionEtudiant($tabPromotion, $messageChangementMdp) {

    $utilisateur = $_SESSION['modeleUtilisateur'];
    $promoEtudiante = $utilisateur->getIdPromotion();
    $corps = "<td id = \"corps\">
                <h2>Options</h2>

            <script src=\"" . RACINE . RACINE_SCRIPT . "OptionEtudiant.js\" type=\"text/javascript\"></script>
            <form onsubmit=\"return changementNumEtudiant()\" action=\"" . RACINE . "?action=optionEtudiant\" method=\"post\">
                <input type=\"hidden\" name=\"changerNumEtudiant\"  />
                <table class=\"form_options_etu\">
                    <tr>
                        <td class=\"form_ajout_option_sous_categ\" colspan=\"2\">
                            Modifier mon num&eacutero &eacutetudiant<br/<<br/>
                        </td>
                    </tr>
                    <tr>
                        <td class=\"form_options_etu_nom_champ\">
                            Num&eacute;ro &eacute;tudiant actuel :
                        </td>
                        <td class=\"form_options_etu_champ\">
                            ".$_SESSION['modeleUtilisateur']->getNumeroetudiant()."
                        </td>
                    </tr>
                    <tr>
                        <td class=\"form_options_etu_nom_champ\">
                            Nouveau num&eacute;ro &eacute;tudiant :
                        </td>
                        <td class=\"form_options_etu_champ\">
                            <input type=\"text\" class=\"forml\" style=\"width:250px;\" name=\"numEtudiant\" id=\"numEtudiant\" />
                        </td>
                    </tr>
                    <tr>
                        <td class=\"submit\" colspan=\"2\">
                            <input id=\"log-submit\" type=\"submit\" value=\"Changer\" />
                        </td>
                    </tr>
                </table>
            </form>
            </br></br>

                <script src=\"" . RACINE . RACINE_SCRIPT . "OptionEtudiant.js\" type=\"text/javascript\"></script>
                <form onsubmit=\"return changementMdp()\" action=\"" . RACINE . "?action=optionEtudiant\" method=\"post\">
                <input type=\"hidden\" name=\"changerMdp\"  />
                <table class=\"form_options_etu\">
                    <tr>
                        <td class=\"form_ajout_option_sous_categ\" colspan=\"2\">
                            Modifier mon mot de passe<br/<<br/>
                        </td>
                    </tr>
                    <tr>
                        <td class=\"form_options_etu_nom_champ\">
                            Ancien mot de passe :
                        </td>
                        <td class=\"form_options_etu_champ\">
                            <input type=\"password\" class=\"forml\" style=\"width:250px;\" name=\"password_old\" id=\"password_old\" />
                        </td>
                    </tr>
                    <tr>
                        <td class=\"form_options_etu_nom_champ\">
                            Nouveau mot de passe :
                        </td>
                        <td class=\"form_options_etu_champ\">
                            <input type=\"password\" class=\"forml\" style=\"width:250px;\" name=\"password\" id=\"password\" />
                        </td>
                    </tr>
                    <tr>
                        <td class=\"form_options_etu_nom_champ\">
                            Confirmation :
                        </td>
                        <td class=\"form_options_etu_champ\">
                            <input type=\"password\" class=\"forml\" style=\"width:250px;\" name=\"password2\" id=\"password2\" />
                        </td>
                    </tr>
                    <tr>
                        <td class=\"submit\" colspan=\"2\">
                            <input id=\"log-submit\" type=\"submit\" value=\"Changer\" />
                        </td>
                     </tr>
                     <tr>
                        <td class=\"submit\" colspan=\"2\">
                            ".$messageChangementMdp."
                        </td>

                    </tr>
                </table>
            </form><br/><br/>



                <form name=\"formulairePromotion\"  method=\"post\" action=\"" . RACINE . "?action=optionEtudiant\">
                <input type=\"hidden\" name=\"changerPromotion\"  />
                <table class=\"form_options_etu\">
                    <tr>
                        <td colspan=\"2\" class=\"form_ajout_option_sous_categ\" colspan=\"2\">
                            Changer ma promotion
                        </td>
                    </tr>
                ";

                foreach ($tabPromotion as $promoCourante) {

                    if($promoCourante->getIdpromotion() == $promoEtudiante){

                        $corps .= "<tr><td class=\"form_options_etu_nom_champ\"><input type=\"radio\" name=\"idPromo\" value=\"" . $promoCourante->getIdpromotion() . "\" id=\"" . $promoCourante->getIdpromotion() . "\" checked/></td>";
                    }else{

                        $corps .= "<tr><td class=\"form_options_etu_nom_champ\"><input type=\"radio\" name=\"idPromo\" value=\"" . $promoCourante->getIdpromotion() . "\" id=\"" . $promoCourante->getIdpromotion() . "\" /></td>";

                    }
                    $corps .="<td class=\"form_options_etu_champ\"><label for=" . $promoCourante->getIdpromotion() . ">" . $promoCourante->getNompromotion() . "</label></td></tr>";
                    
                }
                $corps .= "<tr><td class=\"submit\" colspan=\"2\"><input type=\"submit\" value=\"Changer\" >
                            </td></tr></table></form>";

     $corps .="</td>
            </tr>
        </table>";
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
                            " . convertirDateENFR($prop->getDateProposition()) . "
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
                    <h2>Ajouter une proposition de stage - Etape 2</h2>

                <table class=\"form_etape2\">
                    <tr>
                        <td class=\"form_etape2_sous_categ\">
                            Entreprise<br/><br/>
                        </td>
                        <td class=\"form_etape2_sous_categ\">
                            Etudiant<br/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td class=\"form_etape2_recap\">
                            <table>
                                <tr>
                                     <td class=\"form_etape2_colg\">
                                        Nom de l'entreprise :
                                    </td>
                                    <td class=\"form_etape2_cold\">
                                        " . $entreprise->getNom() . "
                                    </td>
                                  </tr>
                                  <tr>          
                                    <td class=\"form_etape2_colg\">
                                        N°, Rue :
                                    </td>
                                    <td class=\"form_etape2_cold\">
                                        " . $entreprise->getAdresse() . "
                                    </td>
                                  </tr>
                                 <tr>          
                                    <td class=\"form_etape2_colg\">
                                        Code postal :
                                    </td>
                                    <td class=\"form_etape2_cold\">
                                        " . $entreprise->getCodePostal() . "
                                    </td>
                                 </tr>
                                 <tr>  
                                    <td class=\"form_etape2_colg\">
                                        Ville :
                                    </td>
                                    <td class=\"form_etape2_cold\">
                                         " . $entreprise->getVille() . "
                                    </td>
                                 </tr>
                                 <tr>  
                                    <td class=\"form_etape2_colg\">
                                        Pays :
                                    </td>
                                    <td class=\"form_etape2_cold\">
                                         " . $entreprise->getPays() . "
                                    </td>
                                 </tr>
                                 <tr>  
                                    <td class=\"form_etape2_colg\">
                                        T&eacute;l&eacute;phone accueil :
                                    </td>
                                    <td class=\"form_etape2_cold\">
                                         " . $entreprise->getNumeroTelephone() . "
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class=\"form_etape2_colg\">
                                        Site internet :
                                    </td>
                                    <td class=\"form_etape2_cold\">
                                         " . $entreprise->getUrlSiteInternet() . "
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class=\"form_etape2_recap\">
                            <table>
                                <tr>
                                    <td class=\"form_etape2_colg\">
                                        Nom :
                                    </td>
                                    <td class=\"form_etape2_cold\">
                                    " . $utilisateur->getNom() . "
                                    </td> 
                                </tr>
                                <tr>
                                    <td class=\"form_etape2_colg\">
                                        Pr&eacute;nom :
                                    </td>
                                    <td class=\"form_etape2_cold\">
                                    " . $utilisateur->getPrenom() . "
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class=\"form_etape2_colg\">
                                        Promotion :
                                    </td>
                                    <td class=\"form_etape2_cold\">
                                        " . $utilisateur->getPromotion() . "
                                    </td>
                                 </tr>
                            </table>
                        </td>
                     </tr>
                  </table><br/><br/>
                  <table class=\"form_etape2_sujet\">
                    <tr>
                        <td class=\"form_etape2_titre\">
                            <h3>Sujet de stage</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Titre du stage (résumé du sujet en quelques mots) <etoile>*</etoile>:<br />
                            <input type=text id=\"titreStage\" name=\"titreStage\" size=\"75\" maxlength=\"200\">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Sujet complet de stage : <etoile>*</etoile><br />
                            <textarea rows=\"10\" cols=\"60\" id=\"sujetStage\" name=\"sujetStage\" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Technologies utilisées <etoile>*</etoile>:
                            <input type=text id=\"technoStage\" name=\"technoStage\" size=\"75\" maxlength=\"200\" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                             </br>
                            Fiche de renseignements (<= 3 Mo) <etoile>*</etoile>:</br>
                            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"3145728\" />
                            <input type=\"file\" name=\"ficherenseignement\" id=\"ficherenseignement\" /><br />
                        </td>
                    </tr>
                    <tr>
                        <td>
                             </br>
                            Fiche du sujet de stage (<= 3 Mo) (facultatif):</br>
                            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"3145728\" />
                            <input type=\"file\" name=\"fichesujetstage\" id=\"fichesujetstage\" /><br />
                        </td>
                    </tr>
                    <tr>
                        <td class=\"submit_prop\">
                            </br>
                            <input type=\"submit\" value=\"Valider la proposition\"></form><br /><br />
                            </br>
                        </td>
                    </tr>
                  </table>



               

                
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
    $corps .= "<td id = \"corps\">";
    $corps .= "<form name=\"formulaire\" method=\"post\" action=\"" . RACINE . "?action=modifierContactEtape2\">
        <input type=hidden id=\"idEntreprise\" name=\"idEntreprise\" value=\"$idEntreprise\">
        <input type=hidden id=\"idStage\" name=\"idStage\" value=\"$idStage\">
        <h2>Modification du tuteur</h2>";


    // si il existe des contacts dans la base, on les affiche
    if ($tabContact != null) {
        $corps .= "<table class=\"information\">
                        <tr>
                            <td>
                                <h3>Information</h3>
                                Des tuteurs associ&eacute;s &agrave; l'entreprise concernant votre stage ont &eacute;t&eacute; trouv&eacute;s dans la base de donn&eacute;es.<br/>
                                Si votre tuteur appara&icirc;t dans le tableau, s&eacute;lectionnez-le et cliquez sur Valider.<br/>
                                Dans le cas contraire, ajoutez un tuteur gr&acirc;ce au formulaire en bas de page.<br/>
                                
                            </td>
                        </tr>
                    </table><br/>";
        
        $corps .= "<table class=\"tab_tuteurs\"><tr>
                  <td class=\"entete_tab_tuteur\"> Choix </td>
                  <td class=\"entete_tab_tuteur\"> Pr&eacute;nom </td>
                  <td class=\"entete_tab_tuteur\"> Nom </td>
                  <td class=\"entete_tab_tuteur\"> Fonction </td>
                  <td class=\"entete_tab_tuteur\"> T&eacute;l&eacute;phone Fixe </td>
                  <td class=\"entete_tab_tuteur\"> T&eacute;l&eacute;phone Portable </td>
                  <td class=\"entete_tab_tuteur\"> Mail </td>
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

        $corps .= "
            <tr>
                <td colspan=\"7\" class=\"submit\">
                    <br /><input type=\"submit\" value=\"Valider\"></form><br /><br />
                </td>
            </tr>
            </table></form><hr/>";
    }

    // on affiche le formulaire de saisie d'un nouveau tuteur
    if ($tabContact == NULL) {
        $corps .= "<br /><table class=\"information\">
                        <tr>
                            <td>
                                <h3>Information</h3>
                                Aucun contact ayant le r&ocirc;le de tuteur de stage n'est renseign&eacute; dans la base.<br/>
                                Veuillez compl&eacute;ter les informations relatives au tuteur gr&acirc;ce au formulaire ci-dessous.
                            </td>
                        </tr>
                    </table><br/>";
    }

    $corps .= "
            <form name=\"formulaire2\" onsubmit=\"return verifierFormulaireModifierContact()\" method=\"post\" action=\"" . RACINE . "?action=modifierContactEtape2\">
            <input type=hidden id=\"idEntreprise\" name=\"idEntreprise\" value=\"$idEntreprise\">
            <input type=hidden id=\"idStage\" name=\"idStage\" value=\"$idStage\">
            <table class=\"form_ajout_tuteur\">
            <tr>
                <td colspan=\"2\">
                    <h2>Ajouter un tuteur</h2>
                </td>
            </tr>
            <tr>
                <td class=\"form_ajout_tuteur_nom_champ\">
                    Nom <etoile>*</etoile>:
                </td>
                <td class=\"form_ajout_tuteur_champ\">
                    <input type=text name=\"nom_tuteur\" id=\"nom_tuteur\">
                </td>
            </tr>
            <tr>
                <td class=\"form_ajout_tuteur_nom_champ\">
                    Pr&eacute;nom <etoile>*</etoile>:
                </td>
                <td class=\"form_ajout_tuteur_champ\">
                    <input type=text name=\"prenom_tuteur\" id=\"prenom_tuteur\">
                </td>
            </tr>
            <tr>
                <td class=\"form_ajout_tuteur_nom_champ\">
                    Fonction :
                </td>
                <td class=\"form_ajout_tuteur_champ\">
                    <input type=text name=\"fonction_tuteur\" id=\"fonction_tuteur\">
                </td>
            </tr>
            <tr>
                <td class=\"form_ajout_tuteur_nom_champ\">
                    T&eacute;l&eacute;phone fixe :
                </td>
                <td class=\"form_ajout_tuteur_champ\">
                    <input type=text name=\"tel_fixe\" id=\"tel_fixe\">
                </td>
            </tr>
            <tr>
                <td class=\"form_ajout_tuteur_nom_champ\">
                    T&eacute;l&eacute;phone portable :
                </td>
                <td class=\"form_ajout_tuteur_champ\">
                    <input type=text name=\"tel_port\" id=\"tel_port\">
                </td>
            </tr>
            <tr>
                <td class=\"form_ajout_tuteur_nom_champ\">
                    Mail <etoile>*</etoile>:
                </td>
                <td class=\"form_ajout_tuteur_champ\">
                    <input type=text name=\"mail_tuteur\" id=\"mail_tuteur\">
                </td>
            </tr>
            <tr>
                <td colspan=\"2\" class=\"submit\">
                    <br /><input type=\"submit\" value=\"Valider\"></form><br /><br />
                </td>
            </tr>
    </table>";
            
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
                <h2>Ajouter une proposition de stage - Etape 1</h2>
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



    $corps .= "<form name=\"formulaire\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape2\">";

    // on liste les entreprises ayant un nom similaire
    if ($tabEntreprise != NULL) {

        $corps .= "<table class=\"info_etape1\">
                        <tr>
                            <td>
                                <h3>Information</h3>
                                Des entreprises ayant un nom similaires ont &eacute;t&eacute; trouv&eacute;es dans la base.<br/>
                                Si votre entreprise apparait dans le tableau ci-dessous, veuillez la sélectionner puis cliquer sur \"Etape suivante\".<br/>
                                Dans le cas contraire, veuillez remplir le formulaire d'ajout d'une entreprise en bas de page.
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

        $i = 0;
        foreach ($tabEntreprise as $entrepriseCourante) {
            if ($i == 0) {
                $corps .= "<tr><td class=\"tableau\"> ";
                $corps .= "<input type=\"radio\" name=\"idEntreprise\" checked=\"checked\" value=\"" . $entrepriseCourante->getId() . "\" id=\"" . $entrepriseCourante->getId() . "\" />";
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
                $i++;
            } else {
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
        }
        $corps .="</table>";
    }



    // si l'utilisateur a déjà entré un nom d'entreprise
    // on affiche le formulaire de saisie d'une nouvelle entreprise
    if (isset($_POST['nom'])) {


        if ($tabEntreprise == NULL) {

            $corps .= "<br />Il n'existe aucune entreprise ayant un nom similaire dans la base. Vous devez l'ajouter :";
        } else {


            $corps .= "<table><tr><td class=\"submit_prop\"><br /><input type=\"submit\" value=\"Etape suivante\"></form><br/></td></tr></table><hr/>
                <form name=\"formulaire_ajout\" onsubmit=\"return verifierFormulaireEtape1()\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape2\">
                 <h2>Ajouter une entreprise</h2>";
        }

        $corps .= " 
                    <table class=\"form_ajout_new_company\">
                        <tr>
                            <td colspan=\"2\" class=\"titre_sous_categ_form\">
                                <br/>Coordonn&eacute;es  entreprise<br/><br/>
                             </td>
                        </tr>
                        <tr>
                            <td class=\"form_ajout_new_company_nom_champ\">
                                Nom de l'entreprise <etoile>*</etoile> :
                            </td>
                            <td class=\"form_ajout_new_company_champ\">
                                <input type=text name=\"nom_entreprise\" id=\"nom_entreprise\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" class=\"titre_sous_categ_form\">
                                <br/>Adresse de l'entreprise<br/><br/>
                             </td>
                        </tr>
                        <tr>
                            <td class=\"form_ajout_new_company_nom_champ\">
                                N°, Rue <etoile>*</etoile> :
                            </td>
                            <td class=\"form_ajout_new_company_champ\">
                                <input type=text name=\"num_rue\" id=\"num_rue\">
                            </td>
                        </tr>
                        <tr>
                            <td class=\"form_ajout_new_company_nom_champ\">
                                Code postal <etoile>*</etoile> :
                            </td>
                            <td class=\"form_ajout_new_company_champ\">
                                <input type=text name=\"code_postal\" id=\"code_postal\">
                            </td>
                        </tr>
                        <tr>
                            <td class=\"form_ajout_new_company_nom_champ\">
                                Ville <etoile>*</etoile> :
                            </td>
                            <td class=\"form_ajout_new_company_champ\">
                                 <input type=text name=\"ville\" id=\"ville\">
                            </td>
                        </tr>
                        <tr>
                            <td class=\"form_ajout_new_company_nom_champ\">
                                Pays <etoile>*</etoile> :
                            </td>
                            <td class=\"form_ajout_new_company_champ\">
                                 <input type=text name=\"pays\" id=\"pays\">
                            </td>
                        </tr>
                        <tr>
                            <td class=\"form_ajout_new_company_nom_champ\">
                                T&eacute;l&eacute;phone accueil <etoile>*</etoile> :
                            </td>
                            <td class=\"form_ajout_new_company_champ\">
                                 <input type=text name=\"tel_accueil\" id=\"tel_accueil\">
                            </td>
                        </tr>
                        <tr>
                            <td class=\"form_ajout_new_company_nom_champ\">
                                Site internet :
                            </td>
                            <td class=\"form_ajout_new_company_champ\">
                                 <input type=text name=\"siteinternet\">
                            </td>
                        </tr>
                        <tr>
                            <td class=\"form_ajout_new_company_nom_champ\">
                                Num&eacute;ro de siret :
                            </td>
                            <td class=\"form_ajout_new_company_champ\">
                                 <input type=text name=\"numerosiret\">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" class=\"submit_prop\">
                                <br/><etoile>*</etoile> Champs obligatoires
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" class=\"submit_prop\">
                                <input type=\"submit\" value=\"Etape suivante\"></form><br />
                            </td>
                        </tr>
                        </table>";

                    
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
                <h2>Mon stage</h2>
                ";
    if ($stage == null) {
        $corps .= "
        <table class=\"information\">
                        <tr>
                            <td>
                                <h3>Information</h3>
                                Vous n'avez pas de stage pour le moment.<br/>
                                Veuillez effectuer une proposition de stage gr&acirc;ce au formulaire disponible<br/> via le menu de gauche \"Proposer un stage\".<br/>
                                Si votre proposition de stage est accept&eacute;e par cotre responsable, alors votre stage appara&icirc;tra ici.                                
                            </td>
                        </tr>
                    </table>
        ";
        
        $corps .= "</td>
            </tr>
        </table>";

        return $corps;
    }

    $corps .="
                <table class = \"tabstage\">
                    <tr>
                        <td class = \"tabstagecolg\">
                            Etat stage :
                        </td>
                        <td class = \"tabstagecold\">
                            " . $stage->getEtatstage() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tabstagecolg\">
                            Nom de l'entreprise :
                        </td>
                        <td class = \"tabstagecold\">
                            " . $stage->getEntreprise()->getNom() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tabstagecolg\">
                            Titre du stage :
                        </td>
                        <td class = \"tabstagecold\">
                            " . $stage->getTitreStage() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tabstagecolg\">
                            Sujet :
                        </td>
                        <td class = \"tabstagecold\">
                            " . $stage->getSujetstage() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tabstagecolg\">
                            Technologies utilisées :
                        </td>
                        <td class = \"tabstagecold\">
                            " . $stage->getTechnoStage() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tabstagecolg\">
                            Date de d&eacute;but :
                        </td>
                        <td class = \"tabstagecold\">
                            " . $stage->getDatedebut() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tabstagecolg\">
                            Date de fin :
                        </td>
                        <td class = \"tabstagecold\">
                            " . $stage->getDatefin() . "
                        </td>
                    </tr>
                    <tr>
                        <td class = \"tabstagecolg\">
                            Responsabilit&eacute;e civile :
                        </td>
                        <td class = \"tabstagecold\">
                            " . $stage->getDatefin() . "
                        </td>
                    </tr>

                </table><br/>";

    if ($stage->getContact() == null) {

        $corps .="<a href=\"" . RACINE . "?action=ajouterContact&idStage=" . $stage->getIdstage() . "&idEntreprise=" . $stage->getIdentreprise() . "\">Ajouter un tuteur</a>";
    } else {


        $corps .="
                    <h2>Tuteur du stage</h2>
                    <table class = \"tabstage\">
                        <tr>
                            <td class = \"tabstagecolg\">
                                Nom :
                            </td>
                            <td class = \"tabstagecold\">
                                " . $stage->getContact()->getNom() . "
                            </td>
                        </tr>
                        <tr>
                            <td class = \"tabstagecolg\">
                                Pr&eacute;nom :
                            </td>
                            <td class = \"tabstagecold\">
                                " . $stage->getContact()->getPrenom() . "
                            </td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" class=\"tabstagemodiftuteur\">
                                <a href=\"" . RACINE . "?action=modifierContact&idStage=" . $stage->getIdstage() . "&idEntreprise=" . $stage->getIdentreprise() . "\">Modifier le tuteur</a>
                            </td>
                        </tr>
                    </table>

                ";
    }

    $corps .= "</td>
            </tr>
        </table>";

    return $corps;
}
?>


