<?php

    class Entreprise {
        
        private $id ;
        private $nom ;
        private $adresse ;
        private $ville ;
        private $pays ;
        private $numeroTelephone ;
        private $numeroSiret ;
        private $urlSiteInternet ;
        
        function __construct($id, $nom, $adresse, $ville, $pays, $numeroTelephone, $numeroSiret, $urlSiteInternet) {
            $this->id = $id;
            $this->nom = $nom;
            $this->adresse = $adresse;
            $this->ville = $ville;
            $this->pays = $pays;
            $this->numeroTelephone = $numeroTelephone;
            $this->numeroSiret = $numeroSiret;
            $this->urlSiteInternet = $urlSiteInternet;
        }

    }
?>
