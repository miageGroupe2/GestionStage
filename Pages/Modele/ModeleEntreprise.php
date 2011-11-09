<?php

    class ModeleEntreprise {
        
        private $id ;
        private $nom ;
        private $adresse ;
        private $ville ;
        private $codePostal ;
        private $pays ;
        private $numeroTelephone ;
        private $numeroSiret ;
        private $urlSiteInternet ;
        private $statutJuridique;
        
        function __construct($id, $nom, $adresse, $ville, $codePostal, $pays, $numeroTelephone, $numeroSiret, $urlSiteInternet, $statutJuridique) {
            $this->id = $id;
            $this->nom = $nom;
            $this->adresse = $adresse;
            $this->ville = $ville;
            $this->codePostal = $codePostal;
            $this->pays = $pays;
            $this->numeroTelephone = $numeroTelephone;
            $this->numeroSiret = $numeroSiret;
            $this->urlSiteInternet = $urlSiteInternet;
            $this->statutJuridique = $statutJuridique;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNom() {
            return $this->nom;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }

        public function getAdresse() {
            return $this->adresse;
        }

        public function setAdresse($adresse) {
            $this->adresse = $adresse;
        }

        public function getVille() {
            return $this->ville;
        }

        public function setVille($ville) {
            $this->ville = $ville;
        }

        public function getCodePostal() {
            return $this->codePostal;
        }

        public function setCodePostal($codePostal) {
            $this->codePostal = $codePostal;
        }

        public function getPays() {
            return $this->pays;
        }

        public function setPays($pays) {
            $this->pays = $pays;
        }

        public function getNumeroTelephone() {
            return $this->numeroTelephone;
        }

        public function setNumeroTelephone($numeroTelephone) {
            $this->numeroTelephone = $numeroTelephone;
        }

        public function getNumeroSiret() {
            return $this->numeroSiret;
        }

        public function setNumeroSiret($numeroSiret) {
            $this->numeroSiret = $numeroSiret;
        }

        public function getUrlSiteInternet() {
            return $this->urlSiteInternet;
        }

        public function setUrlSiteInternet($urlSiteInternet) {
            $this->urlSiteInternet = $urlSiteInternet;
        }

        public function getStatutJuridique() {
            return $this->statutJuridique;
        }

        public function setStatutJuridique($statutJuridique) {
            $this->statutJuridique = $statutJuridique;
        }


    }
        
        
?>
