<?php

function genererPageAccueil() {

    $utilisateurConnecte = FALSE;


    if (isset($_SESSION['connecte'])) {

        if ($_SESSION['connecte'] == 1) {

            $utilisateurConnecte = TRUE;
        }
    }

    if ($utilisateurConnecte == TRUE) {
        
    } else {
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
    }
    return $corps;
}


function genererPagePrincipal(){
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
                            <td class=\"tableau\"><a href=\"".RACINE."?action=detailStage&idstage=".$stage->getIdstage()."\">D&eacute;tails</a>
                            </td>
                        </tr>";
        }
    }
    $corps = $corps."</table></td> </tr> </table>";
    return $corps;
}

function genererDetailPropositionStage(){
    
    $stage = BD::rechercherProposition($_GET['idstage']);
    
    $corps = NULL ;
    
    if($stage != NULL){
        
        $entreprise = BD::rechercherEntrepriseById($_GET['idstage']);
        
        // la liste des entreprises ayant un nom similaire
        $tabEntreprise = BD::rechercherEntreprise($stage->getNomentreprise());

        //on construit l'affichage des données de l'étudiant et de l'entreprise
        $corps = "<td id = \"corps\">

                      <form method=\"post\" action=\"" . RACINE . "?action=editerStage\">
                      <table class=\"tableau\">
                      <tr>
                        <td class=\"tableau\" colspan=\"8\"> Etudiant </td>
                      </tr>
                      <tr>
                        <td class=\"tableau\"> Pr&eacute;nom : ".$stage->getPrenometudiant()."</td>
                        <td class=\"tableau\"> Nom : ".$stage->getNometudiant()."</td>
                        <td class=\"tableau\"> Promotion : ".$stage->getPromotion()."</td>
                      </tr>
                      <tr>
                        <td class=\"tableau\" colspan=\"8\"> Entreprise </td>
                      </tr>
                      <tr>
                        <td class=\"tableau\"> Nom : ".$entreprise->getNom()."</td>
                        <td class=\"tableau\"> ".$entreprise->getAdresse()." ".$entreprise->getVille()." ".$entreprise->getPays()."</td>
                        <td class=\"tableau\"> Tel :".$entreprise->getNumeroTelephone()."</td>
                        <td class=\"tableau\"> Siret :".$entreprise->getNumeroSiret()."</td>
                      </tr>";
        
        // si il existe des entreprises au nom similaire dans la base on construit 
        // l'affichage correspondant
        if ($tabEntreprise != NULL ){
            
          $corps .=
            "<tr>
                <td class=\"tableau\" colspan=\"8\"> Entreprise similaire dans la base :</td>
            </tr>
            

            
          
                    <tr>
                  <td class=\"tableau\"> Choix </td>
                  <td class=\"tableau\"> Nom entreprise </td>
                  <td class=\"tableau\"> Adresse </td>
                  <td class=\"tableau\"> Ville </td>
                  <td class=\"tableau\"> Pays </td>
                  <td class=\"tableau\"> T&eacute;l&eacute;phone Fixe </td>
                  <td class=\"tableau\"> Numéro de Siret </td>
                  <td class=\"tableau\"> Site web </td>
                  </tr>";
    
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
        

        $corps .= "</td>
                </tr>
            </table>";
                      
    }
    return $corps;
}

function genererProposerStage($tabEntreprise) {

    $nom = NULL ;
    if (isset($_POST['nom'])){
        
        $nom = htmlspecialchars($_POST['nom']);
    }
    
    $corps = "<script src=\"".RACINE . RACINE_SCRIPT . "VerifierFormPropoStageEtape1.js\" type=\"text/javascript\"></script>";
    $corps .= "<td id = \"corps\">
                <h2>Recherche d'une entreprise</h2>                
                
                
                
                <form method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape1\">
                    
                            Nom :
                   
                            <input type=text name=\"nom\" value=\"".$nom."\">
                      
                    
                   <input type=\"submit\" value=\"Rechercher\"></form><br /><br />";
                   
    
    $corps .= "<form name=\"formulaire\" onsubmit=\"return verifierFormulaire()\" method=\"post\" action=\"" . RACINE . "?action=proposerStageEtape2\">";

    // on liste les entreprises ayant un nom similaire
    if ($tabEntreprise != NULL){
        
        $corps .= "<table class=\"tableau\"><tr>
                  <td class=\"tableau\"> Choix </td>
                  <td class=\"tableau\"> Nom entreprise </td>
                  <td class=\"tableau\"> Adresse </td>
                  <td class=\"tableau\"> Ville </td>
                  <td class=\"tableau\"> Pays </td>
                  <td class=\"tableau\"> T&eacute;l&eacute;phone Fixe </td>
                  <td class=\"tableau\"> Numéro de Siret </td>
                  <td class=\"tableau\"> Site web </td>
                  </tr>";
        
        
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

            $corps .= "</td></tr>";

        }
        $corps .="</table>";
        
           
    }
    
   
    
    // si l'utilisateur a déjà entré un nom d'entreprise
    if (isset($_POST['nom'])){
        
        
        // on affiche le radio bouton "ajouter une entreprise"
        // si aucune entreprise existe dans la base on la selectionne
        if ((!isset($_POST['nom'])) && ($tabEntreprise == NULL)){

            $corps .= "<br /><input type=\"radio\" name=\"idEntreprise\" value=\"ajouter\" id=\"ajouter\" /> <label for=\"autre\">Ajouter une entreprise :</label>";
        }else{
            $corps .= "<br /><input type=\"radio\" name=\"idEntreprise\" value=\"ajouter\" id=\"ajouter\"  checked=\"checked\" /> <label for=\"autre\">Ajouter une entreprise :</label>";
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
                                <input type=text name=\"nom_entreprise\" id=\"nom_entreprise\">
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
                                <input type=text name=\"num_rue\" id=\"num_rue\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Code postal <etoile>*</etoile> :
                            </td>
                            <td>
                                <input type=text name=\"code_postal\" id=\"code_postal\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Ville <etoile>*</etoile> : 
                            </td>
                            <td>
                                 <input type=text name=\"ville\" id=\"ville\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Pays <etoile>*</etoile> : 
                            </td>
                            <td>
                                 <input type=text name=\"pays\" id=\"pays\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                T&eacute;l&eacute;phone accueil <etoile>*</etoile> : 
                            </td>
                            <td>
                                 <input type=text name=\"tel_accueil\" id=\"tel_accueil\">
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
                        </table>

                    <br /><input type=\"submit\" value=\"Etape suivante\"></form><br /><br />";


            $corps .="</form>";
    }
        $corps .="</td> </tr> </table>";
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


