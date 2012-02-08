<?php

require_once(RACINE_VUE.'Fonctions.php');

function genererPagePrincipalResponsable() {
    $corps = "<td rowspan=\"2\" id=\"corps\">
                   Bienvenue
                </td>
            </tr>
        </table>";
    return $corps;
}

function genererListePropositionStageResponsable($tabProp) {


    $corps = "<td id = \"corps\">
                <h2>Propositions de stage</h2>
                <table class=\"tab_prop_stage\">
                    <tr>
                        <td class=\"entete_tab_prop_stage_identity\">
                            Identit&eacute; &eacute;tudiant
                        </td>
                        <td class=\"entete_tab_prop_stage\">
                            Nom de l'entreprise
                        </td>
                        <td class=\"entete_tab_prop_stage\">
                            Sujet de stage
                        </td>
                    </tr>
            ";
    if ($tabProp != null) {
        foreach ($tabProp as $prop) {
            $corps = $corps . "
                        <tr>
                            <td class=\"contenu_tab\">" . $prop->getEtudiant()->getNom()." ".$prop->getEtudiant()->getPrenom()
                    . "</td>
                            <td class=\"contenu_tab\">" . $prop->getNomEntreprise() . ", " . $prop->getVille() . " (" . $prop->getPays() . ")"
                    . "</td>
                        <td class=\"contenu_tab\">" . $prop->getTitreStage()
                    . "</td>
                            <td class=\"contenu_tab\"><a href=\"" . RACINE . "?action=detailProp&idprop=" . $prop->getIdProposition() . "\"><img src=\"".RACINE_IMAGE."\loupe.png\" alt=\"loupe\" /></a>
                            </td>
                        </tr>";
        }
    }
    $corps = $corps . "</table></td> </tr> </table>";
    return $corps;
}

function genererDetailProposition($proposition, $modeleFicheRenseignement, $modeleSujetStage, $tabTechno) {
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
                    <td class=\"detail_prop_stage_colh\">
                        Technologies utilisées :</td>
                    <td class=\"detail_prop_stage_colh\">
                        Fiche de renseignement : 
                    </td>
                    <td class=\"detail_prop_stage_colh\">
                        Fiche de sujet de stage :
                    </td>
                </tr>
                <tr>
                    <td class=\"detail_prop_stage_cold\">
                        ";

                        $technoConcat = "";
                        if($tabTechno != null){
                            foreach($tabTechno as $techno){

                                $technoConcat .= $techno->getNom() .",";
                            }
                        }
                        $technoConcat .= $proposition->getTechnoStage();
                        if ( substr($technoConcat, -1, 1)== ","){

                            $technoConcat = substr($technoConcat, 0, strlen($technoConcat)-1);
                        }

                        $corps .= $technoConcat."
                    </td>
                    <td class=\"detail_prop_stage_cold\">
                        ";
                        if ($modeleFicheRenseignement != null) {
                            $corps .= "<a href=\"" . RACINE . "?action=telechargement&type=renseignement&estUneProposition&id=" . $proposition->getIdProposition() . "\">" . $modeleFicheRenseignement->getNomOriginal() . "</a>
                            <a href=\"" . RACINE . "?action=telechargement&type=renseignement&estUneProposition&id=" . $proposition->getIdProposition() . "\"><img src = \"".RACINE_IMAGE."disquette.png\" /></a>";
                        }
                        $corps.="
                    </td>
                    <td class=\"detail_prop_stage_cold\">";
                        if ($modeleSujetStage != null) {
                            $corps .= "<a href=\"" . RACINE . "?action=telechargement&type=sujet&estUneProposition&id=" . $proposition->getIdProposition() . "\">" . $modeleSujetStage->getNomOriginal() . "</a>
                                <a href=\"" . RACINE . "?action=telechargement&type=sujet&estUneProposition&id=" . $proposition->getIdProposition() . "\"><img src = \"".RACINE_IMAGE."disquette.png\" /></a>";
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
                        Veuillez compl&eacute;ter la zone de texte ci-dessous.<br/>
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

function genererListeStage($tabStage, $tabPromotion, $technoTab, $idPromoSelect, $tabTechnoSelect) {
    
    $corps = "<td id = \"corps\">
            <h2>Liste des stages</h2>

            <h3>Crit&egrave;res de recherche    </h3>
            <form name=\"formulaireListeStage\" method=\"post\" action=\"" . RACINE . "?action=listeStages\">
            <table class=\"tab_prop_stage\">
            <tr>
                <td class=\"entete_tab_prop_stage\">
                    Afficher par promotion
                </td>
                <td colspan=\"2\" class=\"entete_tab_prop_stage\">
                    Technologies utilisées
                </td>
             </tr>
             <tr>
                <td class=\"contenu_tab\">
            <select name=\"promotion\" id=\"promotion\">
            <option value=\"-\">-</option>";
            foreach ($tabPromotion as $promoCourante) {

                if ($idPromoSelect != null){

                    if ($idPromoSelect == $promoCourante->getIdpromotion()){

                        $corps .= "<option selected value=\"" . $promoCourante->getIdpromotion() . "\">" . $promoCourante->getNompromotion() . "</option>";
                        continue ;
                    }
                }
                $corps .= "<option value=\"" . $promoCourante->getIdpromotion() . "\">" . $promoCourante->getNompromotion() . "</option>";
            }

            $corps .= "</select>
            </td>
            <td class=\"contenu_tab\">
                <table>
                ";

                $i = 0;
                $j = 1;
                foreach ($technoTab as $techno) {

                    if($i == 0){
                        $corps .= "<tr>";
                    }
                    $aCocher = FALSE ;
                    if($tabTechnoSelect != null){
                        foreach ($tabTechnoSelect as $technoSelec) {

                            if($technoSelec == $techno->getId()){

                                $aCocher = TRUE ;
                            }
                        }
                    }
                    if($aCocher){
                        $corps .= "<td><input type=\"checkbox\" checked id=\"techno".$j."\"  value=\"".$techno->getId()."\" name=\"check[]\">".$techno->getNom()."</td>";
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

                $corps .= "</table>
                </td>
                <td class=\"contenu_tab\">
                    <input type=\"submit\" value=\"Rechercher\" ><br/>
                </td>
                </tr>
                </table>

                </form><br/><br/>



             <table class=\"tab_prop_stage\">
                    <tr>
                        <td class=\"entete_tab_prop_stage_identity\">
                            Identit&eacute; &eacute;tudiant
                        </td>
                        <td class=\"entete_tab_prop_stage\">
                            Nom de l'entreprise
                        </td>
                        <td class=\"entete_tab_prop_stage_resume\">
                            Titre du stage
                        </td>
                        <td class=\"entete_tab_prop_stage\">
                            Nom promotion
                        </td>
                    </tr>
            ";
    if ($tabStage != null) {
        foreach ($tabStage as $stage) {
            $corps = $corps . "
                        <tr>
                            <td class=\"contenu_tab\">" . $stage->getUtilisateur()->getNom()." ".$stage->getUtilisateur()->getPrenom()
                    . "</td>
                            <td class=\"contenu_tab\">" . $stage->getEntreprise()->getNom() . ", " . $stage->getEntreprise()->getVille() . " (" . $stage->getEntreprise()->getPays() . ")"
                    . "</td>
                            <td class=\"contenu_tab\">" . $stage->getTitreStage()
                    . "</td>
                            <td class=\"contenu_tab\">" . $stage->getPromotion()->getNompromotion()
                    . "</td>
                            <td class=\"contenu_tab\"><a href=\"" . RACINE . "?action=detailStage&idstage=" . $stage->getIdstage() . "\"><img src=\"".RACINE_IMAGE."loupe.png\" alt=\"loupe\"/></a>
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
                <table class=\"tab_prop_stage\">
                    <tr>
                        <td class=\"entete_tab_prop_stage\">
                            Identit&eacute; &eacute;tudiant
                        </td>
                        <td class=\"entete_tab_prop_stage\">
                            Nom de l'entreprise
                        </td>
                        <td class=\"entete_tab_prop_stage\">
                            Etat stage
                        </td>
                        <td class=\"entete_tab_prop_stage_resume\">
                            Sujet de stage
                        </td>
                    </tr>
            ";
    if ($tabStage != null) {
        foreach ($tabStage as $stage) {
            if($stage->getEtatstage() == "valide"){
                $corps = $corps . "
                        <tr>
                            <td class=\"valide\">" . $stage->getUtilisateur()->getNom()." ".$stage->getUtilisateur()->getPrenom()
                    . "</td>
                            <td class=\"valide\">" . $stage->getEntreprise()->getNom() . ", " . $stage->getEntreprise()->getVille() . " (" . $stage->getEntreprise()->getPays() . ")"
                    . "</td>
                            <td class=\"valide\">" . $stage->getEtatstage()
                    . "</td>
                            <td class=\"valide\">" . $stage->getTitreStage()
                    . "</td>
                            <td class=\"valide\"><a href=\"" . RACINE . "?action=detailStage&idstage=" . $stage->getIdstage() . "\"><img src=\"".RACINE_IMAGE."loupe.png\" alt=\"loupe\"/></a>
                            </td>
                     </tr>";
            }else{
                $corps = $corps . "
                        <tr>
                            <td class=\"en_cours\">" . $stage->getUtilisateur()->getNom()." ".$stage->getUtilisateur()->getPrenom()
                    . "</td>
                            <td class=\"en_cours\">" . $stage->getEntreprise()->getNom() . ", " . $stage->getEntreprise()->getVille() . " (" . $stage->getEntreprise()->getPays() . ")"
                    . "</td>
                            <td class=\"en_cours\">" . $stage->getEtatstage()
                    . "</td>
                            <td class=\"en_cours\">" . $stage->getTitreStage()
                    . "</td>
                            <td class=\"en_cours\"><a href=\"" . RACINE . "?action=detailStage&idstage=" . $stage->getIdstage() . "\"><img src=\"".RACINE_IMAGE."loupe.png\" alt=\"loupe\"/></a>
                            </td>
                     </tr>";
            }
            
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
    $corps .= "<td id = \"corps\">";
    $corps .= "<form name=\"formulaireModifierAdmin\" onsubmit=\"return verifierSelectionnerAdmin()\" method=\"post\" action=\"" . RACINE . "?action=modifierAdmin\">

    
                <h2>Gestion des administrateurs</h2>";

    if ($tabAdmin != null) {

        $corps .= "<table class=\"tab_prop_stage\"><tr>
                  <td class=\"entete_tab_prop_stage\"> Choix </td>
                  <td class=\"entete_tab_prop_stage\"> Pr&eacute;nom </td>
                  <td class=\"entete_tab_prop_stage\"> Nom </td>
                  <td class=\"entete_tab_prop_stage\"> Promotion </td>
                  <td class=\"entete_tab_prop_stage\"> Mail </td>
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
            <table>
                <tr>
                    <td class=\"submit\">
                        <br/><input type=\"submit\" value=\"Modifier\" ><br/><br/>
                    </td>
                </tr>
            </table>
            </form>
                ";


        $corps .= "
            <h2>Ajouter un administrateur</h2>
            <form name=\"formulaire\" onsubmit=\"return verifierAjouterAdmin()\" method=\"post\" action=\"" . RACINE . "?action=ajouterAdmin\">
            <table class=\"form_ajout_new_company\">
            <tr>
                <td class=\"form_ajout_new_company_nom_champ\">
                    Nom <etoile>*</etoile>:
                </td>
                <td class=\"form_ajout_new_company_champ\">
                    <input type=text name=\"nom_admin\" id=\"nom_admin\">
                </td>
            </tr>
            <tr>
                <td class=\"form_ajout_new_company_nom_champ\">
                    Pr&eacute;nom <etoile>*</etoile>:
                </td>
                <td class=\"form_ajout_new_company_champ\">
                    <input type=text name=\"prenom_admin\" id=\"prenom_admin\">
                </td>
            </tr>
            <tr>
                <td class=\"form_ajout_new_company_nom_champ\">
                    Promotion :
                </td>
                <td class=\"form_ajout_new_company_champ\">
                    <select name=\"promotion\" id=\"promotion\">";

        foreach ($tabPromotion as $promoCourante) {


            $corps .= "<option value=\"" . $promoCourante->getIdpromotion() . "\">" . $promoCourante->getNompromotion() . "</option>";
        }

        $corps .= "</select>
                </td>
            </tr>
            <tr>
                <td class=\"form_ajout_new_company_nom_champ\">
                    Mail <etoile>*</etoile>:
                </td>
                <td class=\"form_ajout_new_company_champ\">
                    <input type=text name=\"mail_admin\" id=\"mail_admin\">
                </td>

            </tr>
            <tr>
                <td class=\"form_ajout_new_company_nom_champ\">
                    Mot de passe <etoile>*</etoile>:
                </td>
                <td class=\"form_ajout_new_company_champ\">
                    <input type=password name=\"mdp_admin\" id=\"mdp_admin\">
                </td>
            </tr>
            <tr>
                <td class=\"form_ajout_new_company_nom_champ\">
                    Mot de passe v&eacute;rification <etoile>*</etoile>:
                </td>
                <td class=\"form_ajout_new_company_champ\">
                    <input type=password name=\"mdp2_admin\" id=\"mdp2_admin\">
                </td>
            </tr>
            </table>
            <table>
                <tr>
                    <td class=\"submit\">
                        <br /><input type=\"submit\" value=\"Ajouter\"></form><br /><br />
                    </td>
                </tr>
            </table>";
            


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
                <h2>G&eacute;rer les promotions</h2>
                <table class=\"tab_prop_stage\">
                    <tr>
                        <td class=\"titre_sous_categ_form\">Liste des promotions<br/><br/></td>
                    </tr>
                    
                        <ul>
                        ";

   foreach ($tabPromotion as $promoCourante) {

        $corps .= "<tr><td><li>" . $promoCourante->getNompromotion() . "</li></td></tr>";
    }
        
    $corps .= "</ul>
        </tr>
    </table><hr/><br/>
    <table  class=\"tab_prop_stage\">
        <tr>
            <td class=\"titre_sous_categ_form\">Ajouter une promotion<br/><br/></td>
        </tr>    
        <tr><td>S&eacute;lectionner la promotion :</td></tr>";

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

            $corps .= "<tr><td><input type=\"radio\" name=\"idPromo\" value=\"" . $aff . "\" id=\"" . $promoCourante->getIdpromotion() . "\" />
                                    <label for=" . $promoCourante->getIdpromotion() . ">" . $aff . "</label></td></tr>";
        }
    }
    $corps.="</table><table class=\"tab_prop_stage\">";

    $corps .= "<tr>
                    <td>
                        <br/>Saisir l'année universitaire :
                    </td>
                </tr>
                <tr>
                    <td>
                        (sous la forme \"2010-2011\")</br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type=text name=\"anneeUniv\" id=\"anneeUniv\" value=\"\">
                    </td>
                </tr>
                <tr>
                    <td>
                         <input type=\"submit\"  value=\"Ajouter\">
                    </td>
                </tr>
               
                </form></table><hr/>
                ";
    

    $corps .= "<form name=\"formulaireSupprimer\" onsubmit=\"return confirmerAvantSuppression()\" method=\"post\" action=\"" . RACINE . "?action=gererPromotion\">
            <table class=\"tab_prop_stage\">
                <tr>
                    <td class=\"titre_sous_categ_form\">
                        <br/>Supprimer une promotion<br/><br/>
                    </td>
                </tr>
                <tr>
                    <td>                    
                        <input type=hidden id=\"actionPromotion\" name=\"actionPromotion\" value=\"supprimer\">
                    </td>
                </tr>
                ";

    foreach ($tabPromotion as $promoCourante) {

        $corps .= "<tr><td><input type=\"radio\" name=\"idPromoSupprimer\" value=\"" . $promoCourante->getIdpromotion() . "\" id=\"" . $promoCourante->getIdpromotion() . "\" />
                            <label for=" . $promoCourante->getIdpromotion() . ">" . $promoCourante->getNompromotion() . "</label></td></tr>";
    }
    $corps .= "<tr><td><input type=\"submit\" value=\"Supprimer\" ></td></tr>
                        </form></table>
                        ";

    $corps .= "</td>
            </tr>
        </table>";
    return $corps;
}

function genererDetailStage($stage, $modeleFicheRenseignement, $modeleFicheSujetStage, $tabTechno) {

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
            <table class = \"tab_detail_stage\">
                <tr>
                    <td class=\"tab_bloc_detail_stage\"\">
                        <h2>Informations &eacute;tudiant</h2>
                        <table class=\"tab_interne_bloc\">
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
                        <h2>Contact entreprise</h2>
                        <table class=\"tab_interne_bloc\"> 
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
                        </table>
                    </td>
                </tr>
            </table>    
            <table class = \"tab_detail_stage\">
                <tr>
                    <td class=\"tab_bloc_detail_stage\" colspan=\"2\" class = \"tableau\">
                        <h2>L'entreprise</h2>
                        <table class=\"tab_interne_bloc\">
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
            </table>
            <table class = \"tab_detail_stage\">
                <tr>
                    <td class=\"tab_bloc_detail_stage\" colspan=\"2\" class = \"tableau\">
                        <h2>Le stage </h2>
                        <table class=\"tab_interne_bloc\">
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
                                " . convertirDateENFR2($stage->getDateembauche()) . "
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
                                    <a href=\"" . RACINE . "?action=editerStage&idstage=" . $stage->getIdstage() . "\">Modifier les donn&eacute;es du stage</a>
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

function genererEditerStage($stage) {

    $corps = "<script src=\"" . RACINE . RACINE_SCRIPT . "DateChooser.js\" type=\"text/javascript\"></script>
        <td id = \"corps\">";

    if ($stage != NULL) {
        $corps .= "<form name=\"editionStage\" method=\"post\" action=\"" . RACINE . "?action=validerModifStage&idstage=" . $_GET['idstage'] . "\">
                <h2>Editer les informations du stage</h2><br/>
                <table class=\"form_edition_stage\">
                    <tr>
                        <td class=\"form_edition_stage_colg\">
                            Etat du stage :
                        </td>
                        <td class=\"form_edition_stage_cold\">
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
                        <td class=\"form_edition_stage_colg\">
                            Responsabilit&eacute; civile :
                        </td>";
                        if($stage->getRespcivil() == 1){
                            $corps.="
                            <td class=\"form_edition_stage_cold\">
                                <select name=\"respcivil\">
                                    <option value=\"1\" checked>Ok</option>
                                    <option value=\"0\">En attente</option>
                                </select>
                            </td>
                            ";
                        }else{
                            $corps.="
                            <td class=\"form_edition_stage_cold\">
                                <select name=\"respcivil\">
                                    <option value=\"0\" checked>En attente</option>
                                    <option value=\"1\">Ok</option>
                                </select>
                            </td>
                            ";
                        }
           $corps.="</tr>
                    <tr>
                        <td class=\"form_edition_stage_colg\">
                            Date de d&eacute;but :
                        </td>
                        <td class=\"form_edition_stage_cold\">
                            <input type=\"text\" name=\"datedeb\" class=\"calendrier\" value=\"" . $stage->getDatedebut() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td class=\"form_edition_stage_colg\">
                            Date de fin :
                        </td>
                        <td class=\"form_edition_stage_cold\">
                            <input type=\"text\" name=\"datefin\" class=\"calendrier\" value=\"" . $stage->getDatefin() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td class=\"form_edition_stage_colg\">
                            Date de soutenance :
                        </td>
                        <td class=\"form_edition_stage_cold\">
                            <input type=\"text\" name=\"datesoutenance\" class=\"calendrier\" value=\"" . $stage->getDatesoutenance() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td class=\"form_edition_stage_colg\">
                            Lieu desoutenance :
                        </td>
                        <td class=\"form_edition_stage_cold\">
                            <input type=\"text\" name=\"lieusoutenance\" value=\"" . $stage->getLieusoutenance() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td class=\"form_edition_stage_colg\">
                            Note obtenue :
                        </td>
                        <td class=\"form_edition_stage_cold\">
                            <input type=\"text\" name=\"noteobtenue\" value=\"" . $stage->getNoteobtenue() . "\" >
                        </td>
                    </tr>
                     <tr>
                        <td class=\"form_edition_stage_colg\">
                            Appr&eacute;ciation obtenue :
                        </td>
                        <td class=\"form_edition_stage_cold\">
                            <input type=\"text\" name=\"appreciationobtenue\" value=\"" . $stage->getAppreciationobtenue() . "\" >
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
                            <input type=\"text\" name=\"dateembauche\" class=\"calendrier\" value=\"" . $stage->getDateembauche() . "\" >
                        </td>
                    </tr>
                    <tr>
                        <td colspan = \"2\" class=\"submit\">
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


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
