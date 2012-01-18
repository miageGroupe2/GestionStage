function verifierFormulaireEtape1(){
     
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
function verifierFormulaireEtape2(){
    
    if (document.getElementById("sujetStage").value == ""
        || document.getElementById("titreStage").value == ""
        || document.getElementById("technoStage").value == ""
        || document.getElementById("ficherenseignement").value == ""

        ){
        
        alert("Veuillez remplir tous les champs marqués d'une étoile.");
        return false ;
    }else{
        
        return true ;
    }
}