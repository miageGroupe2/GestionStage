function verifierFormulaire(){
    
    alert("dedans");
    
    if(document.formulaire.idEntreprise.ajouter.checked){
        alert("if");
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
        alert("else");
        return true;
    }
    
}