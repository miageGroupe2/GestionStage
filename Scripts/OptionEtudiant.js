function changementMdp(){


    if (document.getElementById("password_old").value == ""
        || document.getElementById("password").value == ""
        || document.getElementById("password2").value == ""
        ){

        alert("Veuillez remplir les 3 champs.");
        return false;
    }else{

        if (document.getElementById("password").value == document.getElementById("password2").value){

            return true ;
        }else{

            alert("Les deux mots de passe ne sont pas identique.");
            return false;
        }
    }
}

function changementNumEtudiant(){


    if (document.getElementById("numEtudiant").value == ""
        ){


        alert("Veuillez remplir le champ.");
        return false;
    }else{

        var re=new RegExp("^[0-9]+$");

        if (re.test(document.getElementById("numEtudiant").value)){

            return true ;
        }else{

            alert("Veuillez remplir le champ uniquement avec des chiffres.");
            return false;
        }
        
    }
}