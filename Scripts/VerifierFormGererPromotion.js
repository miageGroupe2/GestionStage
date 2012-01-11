function verifierAjoutPromotion(){
    
    var nbRadiosBouton = document.formulaireAjout.idPromo.length ;
        
    for (var i = 0 ; i < nbRadiosBouton; i++ ){

        if(document.formulaireAjout.idPromo[i].checked){


            var anneeUniversitaire = document.formulaireAjout.anneeUniv.value ;
            
            if( anneeUniversitaire.search("^[0-9]{4}-[0-9]{4}$") == -1){
                
                alert("Veuillez indiquer une année universitaire sous la forme \"2010-2011\".");
                return false ;
            }
            return true ;
        }
    }

    alert("Veuillez sélectionner une promotion.");
    return false;
    
}

function confirmerAvantSuppression(){
    
    
    var retour = confirm("Etes vous sur de vouloir supprimer cette promotion ?");
    
    if (retour == true){
        
        var nbRadiosBouton = document.formulaireSupprimer.idPromoSupprimer.length ;
        
        for (var i = 0 ; i < nbRadiosBouton; i++ ){

            if(document.formulaireSupprimer.idPromoSupprimer[i].checked){

                
                return true ;
            }
        }
    }
    return false ;
}
