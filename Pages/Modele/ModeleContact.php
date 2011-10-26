<?php

    class ModeleContact {
        
        private $id ;
        private $prenom ;
        private $nom ;
        private $fonction ;
        private $telephoneFixe ;
        private $telephoneMobile ;
        private $mailContact ;
        
        function __construct($id, $prenom, $nom, $fonction, $telephoneFixe, $telephoneMobile, $mail) {
            $this->id = $id;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->fonction = $fonction;
            $this->telephoneFixe = $telephoneFixe;
            $this->telephoneMobile = $telephoneMobile;
            $this->mail = $mail;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getPrenom() {
            return $this->prenom;
        }

        public function setPrenom($prenom) {
            $this->prenom = $prenom;
        }

        public function getNom() {
            return $this->nom;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }

        public function getFonction() {
            return $this->fonction;
        }

        public function setFonction($fonction) {
            $this->fonction = $fonction;
        }

        public function getTelephoneFixe() {
            return $this->telephoneFixe;
        }

        public function setTelephoneFixe($telephoneFixe) {
            $this->telephoneFixe = $telephoneFixe;
        }

        public function getTelephoneMobile() {
            return $this->telephoneMobile;
        }

        public function setTelephoneMobile($telephoneMobile) {
            $this->telephoneMobile = $telephoneMobile;
        }

        public function getMail() {
            return $this->mail;
        }

        public function setMail($mail) {
            $this->mail = $mail;
        }


        
    }


?>
