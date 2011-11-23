function verifierAjouterAdmin(){
    
    if (document.getElementById("nom_admin").value != ""
        && document.getElementById("prenom_admin").value != ""
        && document.getElementById("mail_admin").value != ""
        && document.getElementById("mdp_admin").value != ""
        && document.getElementById("mdp2_admin").value != ""
        ){
        
        var mdp = document.getElementById("mdp_admin").value ;
        var mdp2 = document.getElementById("mdp2_admin").value ;
        
        if (mdp == mdp2){
            
            return true ;
        }else{
            
            alert("Les deux mots de passe ne sont pas identique." + mdp + mdp2);
            return false ;
        }
        
        
    }else{
        
        alert("Veuillez remplir tous les champs marqués d'une étoile.");
        return false ;
    }
}

function verifierSelectionnerAdmin(){
    
    //si les radios boutons existent 
    var radioBoutonExist = document.formulaireModifierAdmin.idUtilisateur ;

    if (radioBoutonExist){
        
        var nbRadiosBouton = document.formulaireModifierAdmin.idUtilisateur.length ;
        
        for (var i = 0 ; i < nbRadiosBouton; i++ ){
        
            if(document.formulaireModifierAdmin.idUtilisateur[i].checked){
                
                return true ;
            }
        }
        alert("Veuillez sélectionner un admin.");
        return false;
        
    }else{
        return false ;
    }
}