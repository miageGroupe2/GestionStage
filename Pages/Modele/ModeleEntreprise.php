<?php

    class ModeleEntreprise {
        
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
        
        public function getId() {
            return $this->id;
        }

        public function getNom() {
            return $this->nom;
        }

        public function getAdresse() {
            return $this->adresse;
        }

        public function getVille() {
            return $this->ville;
        }

        public function getPays() {
            return $this->pays;
        }

        public function getNumeroTelephone() {
            return $this->numeroTelephone;
        }

        public function getNumeroSiret() {
            return $this->numeroSiret;
        }

        public function getUrlSiteInternet() {
            return $this->urlSiteInternet;
        }



    }
?>
