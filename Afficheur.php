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
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"
\"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\">
<head>

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />


<body>


<a href=ControleurPrincipal.php?action=pagePrincipale>Menu principal</a>
<a href=ControleurPrincipal.php?action=proposerStage>Proposer un stage</a>

Page : $id

</body>
</html>";

}

?>
