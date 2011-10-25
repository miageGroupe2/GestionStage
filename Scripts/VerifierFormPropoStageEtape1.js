function verifierFormulaire(){
    
    //si les radios boutons existent (cad l'utilisateur doit choisir entre sélectionner 
    //une entreprise existante ou en ajouter une)
    var radioBoutonExist = document.formulaire.idEntreprise ;
    
    if (radioBoutonExist){

        var nbRadiosBouton = document.formulaire.idEntreprise.length ;
        if(document.formulaire.idEntreprise[nbRadiosBouton - 1 ].checked){
        
            if (document.getElementById("nom_entreprise").value == ""
                || document.getElementById("num_rue").value == ""
                || document.getElementById("code_postal").value == ""
                || document.getElementById("ville").value == ""
                || document.getElementById("pays").value == ""
                || document.getElementById("tel_accueil").value == ""
                ){
        
                alert("Veuillez remplir tous les champs marqués d'une étoile.");
                return false;
            }else{

                return true ;
            }
    
        }else{
            return true ;
        }   
        
    }else{
        
        if (document.getElementById("nom_entreprise").value == ""
            || document.getElementById("num_rue").value == ""
            || document.getElementById("code_postal").value == ""
            || document.getElementById("ville").value == ""
            || document.getElementById("pays").value == ""
            || document.getElementById("tel_accueil").value == ""
            ){
        
            alert("Veuillez remplir tous les champs marqués d'une étoile.");
            return false;
        }else{
            
            return true ;
        }
    
    }    
}