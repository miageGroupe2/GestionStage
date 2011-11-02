function verifierEditerProposition(){
    
    if (document.getElementById("sujetStage").value == ""){
        
        alert("Veuillez indiquer un sujet de stage.");
        return false ;
    }else{
        
        return true ;
    }
}

function confirmerAvantSuppression(idProposition){
    
    
    var retour = confirm("Etes vous sur de vouloir supprimer cette proposition de stage ?");
    
    if (retour == true){
        
        window.location = "?action=supprimerProposition&idProposition="+idProposition;
        
    }
}
