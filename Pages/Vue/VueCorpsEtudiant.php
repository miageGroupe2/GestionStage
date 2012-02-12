<?php

require_once(RACINE_VUE.'Fonctions.php');

function genererPagePrincipalEtudiant() {
    $corps = "<td rowspan=\"2\" id=\"corps\">
                   <table>
                    <tr>
                        <td class=\"titre\">
                            <img src=\"Images/accueil.png\" alt=\"titre\">
                        </td>
                    </tr>
                </table>
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
function genererEditerPropositionEtudiant($proposition, $modeleFicheRenseignement, $modeleFicheSujetStage, $technoTab, $technoTabSelect) {
    if ($proposition != NULL) {
        $corps = "<td id = \"corps\">
                <table>
                    <tr>
                        <td class=\"titre\">
                            <img src=\"Images/editer_prop.png\" alt=\"titre\">
                        </td>
                    </tr>
                </table>
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
                    <tr><td class = \"intitule_colg\">
                        Technologies utilisées <etoile>*</etoile>:<br/></td><td>
                        <table>
                        ";

                            $i = 0;
                            $j = 1;
                            foreach ($technoTab as $techno) {

                                if($i == 0){
                                    $corps .= "<tr>";
                                }
                                $selectionne = FALSE ;
                                if ($technoTabSelect != null){
                                    foreach ($technoTabSelect as $technoSel) {
                                        
                                        if($techno->getId() == $technoSel){
                                            
                                            $selectionne = TRUE ;
                                            break ;
                                        }
                                    }
                                }
                                    
                                if ($selectionne){
                                    $corps .= "<td><input type=\"checkbox\" id=\"techno".$j."\"  value=\"".$techno->getId()."\" name=\"check[]\" checked>".$techno->getNom()."</td>";
                                }else{
                                    $corps .= "<td><input type=\"checkbox\" id=\"techno".$j."\"  value=\"".$techno->getId()."\" name=\"check[]\">".$techno->getNom()."</td>";
                                }
                                
                                $j++;
                                $i++ ;
                                if($i == 4){
                                    $corps .= "</tr>";
                                    $i = 0 ;
                                }
                            }

                        $corps .= "</table></td></tr>
                        <tr>
                        <td class = \"intitule_colg\">
                            Autres technologies :
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
            $corps .= "<a href=\"" . RACINE . "?action=telechargement&type=renseignement&estUneProposition&id=" . $proposition->getIdProposition() . "\"><img src=\"".RACINE_IMAGE."disquette.png\" /></a>
                <a href=\"" . RACINE . "?action=telechargement&type=renseignement&estUneProposition&id=" . $proposition->getIdProposition() . "\">" . $modeleFicheRenseignement->getNomOriginal() . "</a>";
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
                        $corps .= "<a href=\"" . RACINE . "?action=telechargement&type=sujet&estUneProposition&id=" . $proposition->getIdProposition() . "\"><img src=\"".RACINE_IMAGE."disquette.png\" /></a>
                            <a href=\"" . RACINE . "?action=telechargement&type=sujet&estUneProposition&id=" . $proposition->getIdProposition() . "\">" . $modeleFicheSujetStage->getNomOriginal() . "</a>";
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

function genererDetailStageEtudiant($stage, $modeleFicheRenseignement, $modeleFicheSujetStage, $tabTechno) {

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
        if ($stage->getDateEmbauche() == NULL) {
            $date_embauche = "NC";
        } else {
            $date_embauche = convertirDateENFR2($stage->getDateembauche());
        }
        $corps = "<td id = \"corps\">
            <table>
                    <tr>
                        <td class=\"titre\">
                            <img src=\"Images/detail_stage.png\" alt=\"titre\">
                        </td>
                    </tr>
                </table><br/>
            <table class = \"tab_detail_stage\">
                <tr>
                    <td class=\"tab_bloc_detail_stage\"\">
                        <table class=\"tab_interne_bloc\">
                            <tr>
                                <td colspan=\"2\" class=\"sous_titre_prop\">
                                    L'&eacute;tudiant
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    N&deg; Etudiant : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    " . $stage->getUtilisateur()->getNumeroetudiant() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Identit&eacute; : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    " . $stage->getUtilisateur()->getPrenom() . " " . $stage->getUtilisateur()->getNom() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Formation : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    " . $stage->getPromotion()->getNompromotion() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Mail : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    " . $stage->getUtilisateur()->getMail() . "
                                </td>
                            </tr>
                        </table>
                    </td>
                     <td class=\"tab_bloc_detail_stage\">
                                
                        <table class=\"tab_interne_bloc\">
                            <tr>
                                <td colspan=\"2\" class=\"sous_titre_prop\">
                                    Contact de l'entreprise
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Identit&eacute; :
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    " .$stage->getContact()->getPrenom() . " " . $stage->getContact()->getNom() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Fonction :
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    " . $stage->getContact()->getFonction() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Tel fixe : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    ". $stage->getContact()->getTelephoneFixe() .  "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Tel mobile : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    ". $stage->getContact()->getTelephoneMobile() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Mail : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    ". $stage->getContact()->getMail() ."
                                </td>
                            </tr>
                            <tr>
                            <td colspan=\"2\" class=\"tabstagemodiftuteur\">
                                <a href=\"" . RACINE . "?action=modifierContact&idStage=" . $stage->getIdstage() . "&idEntreprise=" . $stage->getIdentreprise(). "\">Modifier le tuteur</a>
                            </td>
                        </tr>
                        </table>
                    </td>
                </tr>
            </table><br/>    
            <table class = \"tab_detail_stage\">
                <tr>
                    <td class=\"tab_bloc_detail_stage\" colspan=\"2\" class = \"tableau\">
                        
                        <table class=\"tab_interne_bloc\">
                            <tr>
                                <td colspan=\"2\" class=\"sous_titre_prop\">
                                    L'entreprise
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Entreprise : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $stage->getEntreprise()->getNom() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    N&deg; Siret : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $stage->getEntreprise()->getNumeroSiret() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Adresse : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $stage->getEntreprise()->getAdresse() . "<br/>".
                                    $stage->getEntreprise()->getCodePostal() . "<br/>" . $stage->getEntreprise()->getVille() . "<br/>" .
                                    $stage->getEntreprise()->getPays() . "<br/>
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    N&deg; Tel : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    ".$stage->getEntreprise()->getNumeroTelephone() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Site Web : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                    ".$stage->getEntreprise()->getUrlSiteInternet() . "
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table><br/>
            <table class = \"tab_detail_stage\">
                <tr>
                    <td class=\"tab_bloc_detail_stage\" colspan=\"2\" class = \"tableau\">
                        <table class=\"tab_interne_bloc\">
                            <tr>
                                <td colspan=\"2\" class=\"sous_titre_prop\">
                                    Le stage
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Avancement administratif :
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $stage->getEtatstage() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Responsabilit&eacute; civile :
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $respcivil . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Date de validation :
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . convertirDateENFR2($stage->getDatevalidation()) . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Date de d&eacute;but : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . convertirDateENFR2($stage->getDatedebut()) . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Date de fin : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . convertirDateENFR2($stage->getDatefin()) . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Date de soutenance : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . convertirDateENFR2($stage->getDatesoutenance()) . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Lieu de soutenance : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $stage->getLieusoutenance() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Note obtenue : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $stage->getNoteobtenue() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    Appr&eacute;ciation obtenue : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $stage->getAppreciationobtenue() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                    R&eacute;mun&eacute;ration :
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $stage->getRemuneration() . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                     Embauche :
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $embauche . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                     Date embauche : 
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                " . $date_embauche . "
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                     Fiche de renseignement :
                                </td>
                                <td class=\"tab_interne_bloc_cold\">
                                <a href=\"" . RACINE . "?action=telechargement&type=renseignement&id=" . $stage->getIdstage() . "\">" .$modeleFicheRenseignement->getNomOriginal() . "</a>
                                    <a href=\"" . RACINE . "?action=telechargement&type=renseignement&id=" . $stage->getIdstage() . "\"><img src=\"".RACINE_IMAGE."disquette.png\" /></a>
                                </td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                     Fiche du sujet de stage :
                                </td>
                                <td class=\"tab_interne_bloc_cold\">";
                                    if ($modeleFicheSujetStage != null){
                                        $corps .="<a href=\"" . RACINE . "?action=telechargement&type=sujet&id=" . $stage->getIdstage() . "\">" .$modeleFicheSujetStage->getNomOriginal() . "</a>
                                    
                                                <a href=\"" . RACINE . "?action=telechargement&type=sujet&id=" . $stage->getIdstage() . "\"><img src=\"".RACINE_IMAGE."disquette.png\" /></a>";
                                    }
                                $corps .="</td>
                            </tr>
                            <tr>
                                <td class=\"tab_interne_bloc_colg\">
                                     Technologies utilisées :
                                </td>";


                                $technoConcat = "";
                                if($tabTechno != null){
                                    foreach($tabTechno as $techno){

                                        $technoConcat .= $techno->getNom() .",";
                                    }
                                }
                                $technoConcat .= $stage->getTechnoStage() ;
                                if ( substr($technoConcat, -1, 1)== ","){

                                    $technoConcat = substr($technoConcat, 0, strlen($technoConcat)-1);
                                }
                                $corps .= "


                                <td class=\"tab_interne_bloc_cold\">
                                    " . $technoConcat . "
                                </td>
                            </tr>
                        </table><br/><br/>
                        <table class=\"tab_interne_bloc\">
                            <tr>
                                <td>
                                    R&eacute;sum&eacute; du sujet de stage :
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea readonly rows=\"3\" cols=\"60\" id=\"titreStage\" name=\"titreStage\" >" . $stage->getTitreStage() . "</textarea>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    Sujet de stage :
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea readonly rows=\"10\" cols=\"60\" id=\"sujetStage\" name=\"sujetStage\" >" . $stage->getSujetstage() . "</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class=\"submit\">
                                    <a href=\"" . RACINE . "?action=editerStageEtudiant&idstage=" . $stage->getIdstage() . "\">Editer les informations du stage</a>
                                </td>
                            </tr>
                        </table>
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

function genererEditerStageEtudiant($stage) {

    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "DateChooser.js\" type=\"text/javascript\"></script>
        <td id = \"corps\">";

    if ($stage != NULL) {
        $corps .= "<form name=\"editionStage\" method=\"post\" action=\"" . RACINE . "?action=validerModifStageEtudiant&idstage=" . $_GET['idstage'] . "\">
                <table>
                    <tr>
                        <td class=\"titre\">
                            <img src=\"Images/editer_stage.png\" alt=\"titre\">
                        </td>
                    </tr>
                </table>
                <table class=\"form_edition_stage\">
                    <tr>
                        <td class=\"form_edition_stage_colg\">
                            Date de d&eacute;but :
                        </td>
                        <td class=\"form_edition_stage_cold\">
                            <input type=\"text\" name=\"datedeb\" class=\"calendrier\" value=\"" . convertirDateENFR($stage->getDatedebut()) . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td class=\"form_edition_stage_colg\">
                            Date de fin :
                        </td>
                        <td class=\"form_edition_stage_cold\">
                            <input type=\"text\" name=\"datefin\" class=\"calendrier\" value=\"" . convertirDateENFR($stage->getDatefin()) . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td class=\"form_edition_stage_colg\">
                            R&eacute;mun&eacute;ration :
                        </td>
                        <td class=\"form_edition_stage_cold\">
                            <input type=\"text\" name=\"remuneration\" value=\"" . $stage->getRemuneration() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td class=\"form_edition_stage_colg\">
                            Embauche :
                        </td>
                        <td class=\"form_edition_stage_cold\">";
                            if($stage->getEmbauche() == 1){
                                $corps.="<select name=\"embauche\">
                                    <option value=\"1\" checked>Oui</option>
                                    <option value=\"0\">Non</option>
                                </select>";
                            }else{
                                $corps.="<select name=\"embauche\">
                                    <option value=\"0\" checked>Non</option>
                                    <option value=\"1\">Oui</option>
                                </select>";
                            }
                            $corps.="
                        </td>
                    </tr>
                     <tr>
                        <td class=\"form_edition_stage_colg\">
                            Date embauche :
                        </td>
                        <td class=\"form_edition_stage_cold\">
                            <input type=\"text\" name=\"dateembauche\" class=\"calendrier\" value=\"" . convertirDateENFR($stage->getDateembauche()) . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td class=\"submit\" colspan=\"2\">
                            <input id=\"submit_valid_modif_stage\" type=\"submit\" name=\"Envoyer\" value=\"Envoyer\"><br/>
                        </td>
                    </tr>
                    </table><br/><br/>
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


function genererAfficherOptionEtudiant($tabPromotion, $messageChangementMdp) {

    $utilisateur = $_SESSION['modeleUtilisateur'];
    $promoEtudiante = $utilisateur->getIdPromotion();
    $corps = "<td id = \"corps\"><table>
                    <tr>
                        <td class=\"titre\">
                            <img src=\"Images/options.png\" alt=\"titre\">
                        </td>
                    </tr>
                </table>

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
            <table>
                    <tr>
                        <td class=\"titre\">
                            <img src=\"Images/mes_propositions.png\" alt=\"titre\">
                        </td>
                    </tr>
                </table>";

    if ($tabProp != NULL) {

        foreach ($tabProp as $prop) {

            $corps .= "
                
                 <table class=\"proposition\">
                    <tr>
                        <td colspan=\"2\" class=\"entete_tab_prop_stage\">
                            <img src=\"Images/logo_udl.png\" alt=\"titre\">Proposition " . $i . " :
                        </td>
                    </tr>
                    <tr>
                      <td class=\"bloc_prop_entreprise\">
                
                 <table class=\"prop_entreprise\">
                    <tr>
                        <td colspan=\"2\" class=\"titre_prop\">
                            <table>
                                <tr>
                                    <td class=\"sous_titre_prop\">
                                        L'entreprise
                                    </td>
                            </tr>
                </table>
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
                            <table>
                                <tr>
                                    <td class=\"sous_titre_prop\">
                                         Suivi de la proposition
                                    </td>
                            </tr>
                </table>
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
                            <table>
                                <tr>
                                    <td class=\"sous_titre_prop\">
                                        R&eacute;sum&eacute; du sujet :
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class=\"resume_sujet\">
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
            $corps .="</td></tr></table><br/>";


            $i++;
        }
        $corps .="</td></tr></table>";
    } else {
        $corps = "
                <td id = \"corps\">
                    
               </td>
            </tr>
        </table>
        ";
    }
    return $corps;
}


function genererProposerStageEtape3() {

    $corps = "<td id = \"corps\">
                <table class=\"information\">
                        <tr>
                            <td>
                                <h3>Information !</h3>
                                Votre proposition destage a bien &eacute;t&eacute; envoy&eacute;e.<br/>
                                Vous pouvez la consulter et l'&eacute;diter dans la rubrique - Voir mes propositions de stage -.
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class=\"submit\">
                                <a href=\"".RACINE."?action=pagePrincipaleEtudiant\">Retour &agrave; l'accueil</a>
                            </td>
                        </tr>
                    </table>    ";

    $corps .="</td> </tr> </table>";
    return $corps;
}

function genererProposerStageEtape2($entreprise, $technoTab) {

    $utilisateur = $_SESSION['modeleUtilisateur'];

    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "VerifierFormPropoStage.js\" type=\"text/javascript\"></script>";
    $corps .= "<form onsubmit=\"return verifierFormulaireEtape2()\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape3\" enctype=\"multipart/form-data\">
                <td id = \"corps\">
                     <table>
                    <tr>
                        <td class=\"titre\">
                            <img src=\"Images/ajouter_prop_etape2.png\" alt=\"titre\">
                        </td>
                    </tr>
                </table>

                <table class=\"form_etape2\">
                    <tr>
                        <td class=\"form_etape2_sous_categ\">
                            <table>
                             <tr>
                                <td class=\"sous_titre_prop\">
                                    L'entreprise
                                </td>
                            </tr>
                        </table>
                        </td>
                        <td class=\"form_etape2_sous_categ\">
                            <table>
                             <tr>
                                <td class=\"sous_titre_prop\">
                                    L'&eacute;tudiant
                                </td>
                            </tr>
                        </table>
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
                  <table>
                             <tr>
                                <td class=\"titre\">
                                    <img src=\"Images/sujet_stage.png\" alt=\"titre\">
                                </td>
                            </tr>
                        </table>
                  <table class=\"form_etape2_sujet\">
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
                    <tr><td>
                        Technologies utilisées <etoile>*</etoile>:<br/>
                        <table>
                        ";

                            $i = 0;
                            $j = 1;
                            foreach ($technoTab as $techno) {

                                if($i == 0){
                                    $corps .= "<tr>";
                                }
                                $corps .= "<td><input type=\"checkbox\" id=\"techno".$j."\"  value=\"".$techno->getId()."\" name=\"check[]\">".$techno->getNom()."</td>";
                                $j++;
                                $i++ ;
                                if($i == 4){
                                    $corps .= "</tr>";
                                    $i = 0 ;
                                }
                            }

                        $corps .= "</table>
                    </td></tr>
                    <tr>
                        <td>
                            <br/>Autres technologies :<br/>
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
                <table>
                    <tr>
                        <td class=\"titre\">
                            <img src=\"Images/ajouter_prop_etape1.png\" alt=\"titre\">
                        </td>
                    </tr>
                </table>
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

            $corps .= "<table class=\"info_etape1\">
                        <tr>
                            <td>
                                <h3>Information</h3>
                                Il n'existe aucune entreprise ayant un nom similaire dans la base.<br/>
                                Vous devez l'ajouter !
                            </td>
                        </tr>
                    </table>";
        } else {


            $corps .= "<table><tr><td class=\"submit_prop\"><br /><input type=\"submit\" value=\"Etape suivante\"></form><br/></td></tr></table><hr/>
                <form name=\"formulaire_ajout\" onsubmit=\"return verifierFormulaireEtape1()\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape2\">
                 <table>
                    <tr>
                        <td class=\"titre\">
                            <img src=\"Images/ajouter_entreprise.png\" alt=\"titre\">
                        </td>
                    </tr>
                </table>";
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

function genererValiderModificationsStageEtudiant($ok) {
    if ($ok) {
        $corps = "
                <td id = \"corps\">
                    <table class=\"information\">
                        <tr>
                            <td>
                                <h3>Information</h3>
                                Les modifications ont bien &eacute;t&eacute; effectu&eacute;es !
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class=\"submit\">
                                <a href=\"".RACINE."?action=voirStageEtudiant\">Retour au d&eacute;tail du stagel</a>
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
                    <table class=\"information\">
                        <tr>
                            <td>
                                <h3>Attention !</h3>
                                Une erreur est survenue !<br/>
                                Les modifications ne seront pas prises en compte
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class=\"submit\">
                                <a href=\"".RACINE."?action=pagePrincipaleEtudiant\">Retour &agrave; l'accueil</a>
                            </td>
                        </tr>
                    </table>
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
