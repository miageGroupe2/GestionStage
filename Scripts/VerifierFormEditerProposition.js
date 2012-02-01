function verifierEditerProposition(){


    var i = 1;
    var auMoinsUneCase = false ;
    while(document.getElementById('techno' + i)){

        if(document.getElementById('techno' + i).checked){
            auMoinsUneCase = true ;
        }
        i++;
    }
    if (document.getElementById("sujetStage").value == ""
        || document.getElementById("titreStage").value == ""){

        alert("Veuillez remplir tous les champs marqués d'une étoile.");
        return false ;
    }

    if(document.getElementById("technoStage").value == "" && auMoinsUneCase == false){

        alert("Veuillez renseigner au moins une technologie");
        return false ;
    }
    return true ;
}

function confirmerAvantSuppression(idProposition){
    
    var retour = confirm("Etes vous sur de vouloir supprimer cette proposition de stage ?");
    
    if (retour == true){
        
        window.location = "?action=supprimerProposition&idProposition="+idProposition;
    }
}
