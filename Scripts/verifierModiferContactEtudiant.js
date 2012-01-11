function verifierFormulaireModifierContact(){
    
    //si les radios boutons existent 
    var radioBoutonExist = document.formulaire.idContact ;
    var besoinDeVerifierFormulaire = false ;
    
    if (radioBoutonExist){

        var nbRadiosBouton = document.formulaire.idContact.length ;
        if(document.formulaire.idContact[nbRadiosBouton - 1 ].checked){
        
            besoinDeVerifierFormulaire = true  ;
    
        }else{
            return true ;
        }   
        
    }else{
        besoinDeVerifierFormulaire = true  ;
    }   
    
    if (besoinDeVerifierFormulaire){
        
        if (document.getElementById("nom_tuteur").value == ""
            || document.getElementById("prenom_tuteur").value == ""
            || document.getElementById("mail_tuteur").value == ""
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


