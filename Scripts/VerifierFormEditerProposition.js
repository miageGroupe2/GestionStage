function verifierEditerProposition(){
    
    if (document.getElementById("sujetStage").value == ""
        || document.getElementById("titreStage").value == "" 
        || document.getElementById("technoStage").value == "" 
        ){
        
        alert("Veuillez remplir tous les champs marqués d'une étoile.");
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
