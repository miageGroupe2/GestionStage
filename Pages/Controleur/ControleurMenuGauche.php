<?php

function verifierConnexion() {

    if (!isset($_SESSION['connecte'])) {
        if ($_POST['loggin'] != NULL AND $_POST['password'] != NULL) {

            $loggin = $_POST['loggin'];
            $password = $_POST['password'];
            $estConnecte = BD::connecterUtilisateur($loggin, $password);
            
            //si $user != null alors l'utilisateur s'est loggé correctement
            if ($user != null) {
                $_SESSION['loggin'] = $loggin ;
                

                $centre = "<strong>Vous êtes connecté(e)</strong><br />";
            } else {
                $centre = "<strong>Erreur lors de l'authentification</strong><br />";
            }
        }
    } else {
        $centre = "Vous êtes déjà connecté<br />";
    }
    $centre .= affichageSeConnecter();
    $listeArticle = affichageListeArticles();
    $listeCategorie = actionListerCategorie();
    affichepage($listeCategorie, $centre, $listeArticle);
}

?>
