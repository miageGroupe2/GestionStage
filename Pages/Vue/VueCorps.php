<?php

function genererPageAccueil() {
$corps = "<td id = \"corps\">
                    Ceci est la page d'accueil
                </td>
            </tr>
        </table>";
return $corps;
}

/**
 * Permet d'afficher la page indiquant à l'utilisateur que sa proposition de stage a été acceptée
 * @return string le code html
 */
function genererStagePropose() {

$corps = "<td id = \"corps\">
                    Proposition de stage accept&eacute;e.
                </td>
            </tr>
        </table>";
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
 *
 * @param type $tabContact 
 */
function genererListeResultatRechercheContact($tabContact){
    
    $corps = "<td id = \"corps\">
                  <table class=\"tableau\"><tr>
                  <td class=\"tableau\"> Choix </td>
                  <td class=\"tableau\"> Pr&eacute;nom </td>
                  <td class=\"tableau\"> Nom </td>
                  <td class=\"tableau\"> Fonction </td>
                  <td class=\"tableau\"> T&eacute;l&eacute;phone Fixe </td>
                  <td class=\"tableau\"> T&eacute;l&eacute;phone Portable </td>
                  <td class=\"tableau\"> Mail </td>
                  </tr>";
    
    if ($tabContact != null){
        
        foreach ($tabContact as $contactCourant){

            $corps .= "<tr><td class=\"tableau\"> ";

            $corps .= "<input type=\"radio\" name=\"idEntreprise\" value=\"".$contactCourant->getIdContact()."\" id=\"".$contactCourant->getIdContact()."\" />";
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getPrenomContact();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getNomContact();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getFonctionContact();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getTelephoneFixeContact();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getTelephoneMobileContact();
            $corps .= "</td><td class=\"tableau\">";
            $corps .= $contactCourant->getMailContact();
            

            $corps .= "</td></tr>";  
        }
    }
                   
    $corps .= "
                    </table>
                </td>
            </tr>
        </table>";
    
    return $corps ;
}

/**
 * Permet de générer l'affichage des entreprises correspondantes à une recherche 
 * @param type $tabEntreprise 
 */
function genererListeResultatRechercheEntreprise($tabEntreprise){
  
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
    
    if ($tabEntreprise != null){
        
        foreach ($tabEntreprise as $entrepriseCourante){

            $corps .= "<tr><td class=\"tableau\"> ";
            $corps .= "<input type=\"radio\" name=\"idEntreprise\" value=\"".$entrepriseCourante->getId()."\" id=\"".$entrepriseCourante->getId()."\" />";
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

/**
 *  Permet d'afficher le formulaire de proposition de stage
 * @param type $erreurRemplissage si true si un des champs obligatoires n'a pas été renseigné
 * @return string le code html
 */
function genererProposerStage($erreurRemplissage) {

$messageErreurRemplissage = '';
if ($erreurRemplissage) {
$messageErreurRemplissage = "Veuillez renseigner tous les champs obligatoires (*).";
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
                                    Nom &eacute;tudiant <etoile>*</etoile> : 
                                </td>
                                <td>
                                    <input type=text name=\"nom\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pr&eacute;nom &eacute;tudiant <etoile>*</etoile> :
                                </td>
                                <td>
                                    <input type=text name=\"prenom\">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Formation <etoile>*</etoile> : 
                                </td>
                                <td>
                                    <select name=\"fonction\">
                                        <option VALUE=\"choisir\">Choisir</option>
                                        <option VALUE=\"l3_miage\">L3 MIAGE</option>
                                        <option VALUE=\"m2_acsi\">M2 MIAGE ACSI</option>
                                        <option VALUE=\"m2_sid\">M2 MIAGE SID</option>
                                    </select>
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
}

function genererListePropositionStage(){
    $tabStage = BD::recherherToutesPropositions();
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
    if ( $tabStage != null){
        foreach($tabStage as $stage){
        $corps = $corps."
                        <tr>
                            <td class=\"tableau\">".$stage->getNometudiant()
                            ."</td>
                            <td class=\"tableau\">".$stage->getPrenometudiant()
                            ."</td>
                            <td class=\"tableau\">".$stage->getNomentreprise()
                            ."</td>
                            <td class=\"tableau\"><a href=\"".RACINE."?action=proposerStage&idstage=".$stage->getIdentreprise()."\">D&eacute;tails</a>
                            </td>
                        </tr>";
        }
    }
    $corps = $corps."</table></td> </tr> </table>";
    return $corps;
}


?>
