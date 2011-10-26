function verifierFormulaireEtape1(){
    
    //si les radios boutons existent (cad l'utilisateur doit choisir entre sélectionner 
    //une entreprise existante ou en ajouter une)
    var radioBoutonExist = document.formulaire.idEntreprise ;
    var besoinDeVerifierFormulaire = false ;
    
    if (radioBoutonExist){

        var nbRadiosBouton = document.formulaire.idEntreprise.length ;
        if(document.formulaire.idEntreprise[nbRadiosBouton - 1 ].checked){
        
            besoinDeVerifierFormulaire = true  ;
    
        }else{
            return true ;
        }   
        
    }else{
        besoinDeVerifierFormulaire = true  ;
    }   
    
    if (besoinDeVerifierFormulaire){
        
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
        //inutile juste pour éviter un warning
        return TRUE ;
    }
}
function verifierFormulaireEtape2(){
    
    //si les radios boutons existent (cad l'utilisateur doit choisir entre sélectionner 
    //un tuteur existant ou en ajouter un)
    var radioBoutonExist = document.formulaire.idContact ;
    var besoinDeVerifierFormulaire = false ;
    
    if (radioBoutonExist){

        var nbRadiosBouton = document.formulaire.idContact.length ;
        if(document.formulaire.idContact[nbRadiosBouton - 1 ].checked){
        
            besoinDeVerifierFormulaire = true ;
    
        }else{
            return true ;
        }   
        
    }else{

        besoinDeVerifierFormulaire = true ;
    }
    
    if (besoinDeVerifierFormulaire){
        
        if (document.getElementById("nom_tuteur").value == ""
            || document.getElementById("prenom_tuteur").value == ""
            ){

            alert("Veuillez remplir tous les champs marqués d'une étoile.");
            return false;
        }else{

            return true ;
        }
    }else{
        //inutile juste pour éviter un warning
        return TRUE ;
    }
}