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

    var i = 1;
    var auMoinsUneCase = false ;
    while(document.getElementById('techno' + i)){
     
        if(document.getElementById('techno' + i).checked){
            auMoinsUneCase = true ;
        }
        i++;
    }
    if (document.getElementById("sujetStage").value == ""
        || document.getElementById("titreStage").value == ""
        || document.getElementById("ficherenseignement").value == ""){
        
        alert("Veuillez remplir tous les champs marqués d'une étoile.");
        return false ;
    }

    if(document.getElementById("technoStage").value == "" && auMoinsUneCase == false){

        alert("Veuillez renseigner au moins une technologie");
        return false ;
    }
    return true ;
}