function verifierFormulaire(){
    
    if(document.getElementById("nom").value == ""){
        
        alert("Formulaire invalide : le nom d'utilisateur est vide");
        return false;
    
    }else{
        
        alert("Le formulaire est valide");
        return true;
    }
}