function verifierAjouterAdmin(){
    
    if (document.getElementById("nom_admin").value != ""
        && document.getElementById("prenom_admin").value != ""
        && document.getElementById("mail_admin").value != ""
        && document.getElementById("mdp_admin").value != ""
        && document.getElementById("mdp2_admin").value != ""
        ){
        
        if (document.getElementById("mdp_admin")== document.getElementById("mdp2_admin")){
            
            
            return true ;
        }else{
            
            alert("Les deux mots de passe ne sont pas identique.");
            return false ;
        }
        
        
    }else{
        
        alert("Veuillez remplir tous les champs marqués d'une étoile.");
        return false ;
    }
}