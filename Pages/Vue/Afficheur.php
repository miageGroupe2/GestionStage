<?php

//function AffichePage( $menuleft, $content,$menuright) {
function AffichePage($afficherMenuGauche, $corps) {
    
    $menuGauche = "" ;
    if ($afficherMenuGauche){
     
        $menuGauche = genererMenuGauche();
    }

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
        <link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" title=\"Design\" href=\"Styles/site.css\"/>
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
                                <a href=\"".RACINE."\">Accueil</a>
                            </td>
                        </tr>    
                    </table>
                    $menuGauche
                    $corps
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
