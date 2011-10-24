<?php

    class ModeleEtudiant {
        
        private $idetudiant ;
        private $idpromotion ;
        private $numeroetudiant ;
        private $prenom ;
        private $nom ;
        private $mail ;
        
        function __construct($idetudiant, $idpromotion, $numeroetudiant, $prenom, $nom, $mail) {
            $this->idetudiant = $idetudiant;
            $this->idpromotion = $idpromotion;
            $this->numeroetudiant = $numeroetudiant;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->mail = $mail;
        }
        
        

        
        
    }
?>
