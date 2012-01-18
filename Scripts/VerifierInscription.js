function verifierFormulaire(){


    if (document.getElementById("mail").value == ""
        || document.getElementById("password").value == ""
        || document.getElementById("password2").value == ""
        || document.getElementById("nom").value == ""
        || document.getElementById("prenom").value == ""
        || document.getElementById("promotion").value == ""
        || document.getElementById("numetudiant").value == ""){

        alert("Veuillez remplir tous les champs.");
        return false;
    }else{

        if (document.getElementById("password").value == document.getElementById("password2").value){
            
            var re=new RegExp("^[a-zA-Z0-9\\-_.]+$");

            if (re.test(document.getElementById("mail").value)){


                re=new RegExp("^[0-9]+$");

                if (re.test(document.getElementById("numetudiant").value)){


                    return true ;
                }else{

                    alert("Le numéro étudiant n'est pas valide.");
                    return false;
                }
            }else{

                alert("L'adresse mail n'est pas valide.");
                return false;
            }
            

        }else{

            alert("Les deux mots de passe ne sont pas identique.");
            return false;
        }
    }
}

