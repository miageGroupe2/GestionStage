<?php


//function connecterUtilisateur() {
//
//    if (!isset($_SESSION['connecte'])) {
//        if ($_POST['loggin'] != NULL AND $_POST['password'] != NULL) {
//
//            $loggin = $_POST['loggin'];
//            $password = $_POST['password'];
//            $utilisateurExistant = authentification($loggin, $password);
//            
//            
//            if ($utilisateurExistant == TRUE ){
//                $_SESSION['loggin'] = $loggin ;
//                
//
//                $centre = "<strong>Vous êtes connecté(e)</strong><br />";
//            } else {
//                $centre = "<strong>Erreur lors de l'authentification</strong><br />";
//            }
//        }
//    } else {
//        $centre = "Vous êtes déjà connecté<br />";
//    }
//    $centre .= affichageSeConnecter();
//    $listeArticle = affichageListeArticles();
//    $listeCategorie = actionListerCategorie();
//    affichepage($listeCategorie, $centre, $listeArticle);
//}

?>
