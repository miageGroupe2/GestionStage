<?php

//function AffichePage( $menuleft, $content,$menuright) {
function AffichePage($id) {


	session_start(); 
//	if (isset ($_SESSION['logge'])) {
//		if ($_SESSION['logge']==1){	//l'utilisateur est loggé on affiche le menu d'admnistration
//			$menuleft .= '<br /><br />Bonjour '.$_SESSION['user'].'! ';
//			$menuleft .= '<br />Vous êtes connecté(e)<a href="UserControleur.php?action=seDeconnecter"><br />(Se deconnecter)</a>' ;
//			$menuleft .= '<BR/><BR/><a href=UserControleur.php?action=affichageUnUser&id='.$_SESSION['id'].'>Afficher mon profil</a> ';
//			$menuleft .= '<BR/><a href=UserControleur.php?action=ajouterUser>Ajouter un utilisateur</a> ';
//			
//			$menuleft .= '<BR/><BR/><a href=BilletControleur.php?action=ajouterArticle>Ajouter un article</a> ';
//			$menuleft .= '<BR/><a href=BilletControleur.php?action=modifierArticle>Modifier un article</a> ';
//			$menuleft .= '<BR/><a href=BilletControleur.php?action=supprimerArticle>Supprimer un article</a> ';
//			
//			$menuleft .= '<BR/><BR/><a href=CategorieControleur.php?action=ajouterCategorie>Ajouter une catégorie</a> ';
//			$menuleft .= '<BR/><a href=CategorieControleur.php?action=supprimerCategorie>Supprimer une catégorie</a> ';	
//		}
//	}else{
		
//	}
	
	

echo "
<!DOCTYPE html>
<html>
    <head>
        <link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" title=\"Design\" href=\"Styles/index.css\"/>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
        <title>Université Nancy 2 - Gestion des stages</title>
    </head>
    <body>
        <table>
            <tr>
                <td id =\"page\">
                    <!-- ICI table de la page entiere -->
                    <table>
                        <tr>    
                            <td id=\"banniere\">
                                ban
                            </td>
                        </tr>    
                    </table>
                    <table>
                        <tr>
                            <td id=\"menu_gauche\">
                                Connexion :
                                <form action=\"http://localhost/?action=log\" method=\"post\">
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
                                                <input type=\"text\" class=\"forml\" style=\"width:160px;\" name=\"mdp\" id=\"recherche\" title=\"saisie_mdp\"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input id=\"log-submit\" type=\"submit\" value=\"Connexion\" />
                                            </td>
                                        </tr>
                                    </table>
                                </form><br/>
                            </td>
                            <td id=\"corps\">
                               $id
                                
                            </td>
                        </tr>
                    </table>
                     <table>
                        <tr>
                            <td id=\"bas_page\">
                                (c) Université Nancy 2
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>";

}

?>
