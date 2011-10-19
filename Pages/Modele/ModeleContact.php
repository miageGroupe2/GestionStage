<?php

    class ModeleContact {
        
        private $idContact ;
        private $prenomContact ;
        private $nomContact ;
        private $fonctionContact ;
        private $telephoneFixeContact ;
        private $telephoneMobileContact ;
        private $mailContact ;
        
        function __construct($idContact, $prenomContact, $nomContact, $fonctionContact, $telephoneFixeContact, $telephoneMobileContact, $mailContact) {
            $this->idContact = $idContact;
            $this->prenomContact = $prenomContact;
            $this->nomContact = $nomContact;
            $this->fonctionContact = $fonctionContact;
            $this->telephoneFixeContact = $telephoneFixeContact;
            $this->telephoneMobileContact = $telephoneMobileContact;
            $this->mailContact = $mailContact;
        }

        public function getIdContact() {
            return $this->idContact;
        }

        public function setIdContact($idContact) {
            $this->idContact = $idContact;
        }

        public function getPrenomContact() {
            return $this->prenomContact;
        }

        public function setPrenomContact($prenomContact) {
            $this->prenomContact = $prenomContact;
        }

        public function getNomContact() {
            return $this->nomContact;
        }

        public function setNomContact($nomContact) {
            $this->nomContact = $nomContact;
        }

        public function getFonctionContact() {
            return $this->fonctionContact;
        }

        public function setFonctionContact($fonctionContact) {
            $this->fonctionContact = $fonctionContact;
        }

        public function getTelephoneFixeContact() {
            return $this->telephoneFixeContact;
        }

        public function setTelephoneFixeContact($telephoneFixeContact) {
            $this->telephoneFixeContact = $telephoneFixeContact;
        }

        public function getTelephoneMobileContact() {
            return $this->telephoneMobileContact;
        }

        public function setTelephoneMobileContact($telephoneMobileContact) {
            $this->telephoneMobileContact = $telephoneMobileContact;
        }

        public function getMailContact() {
            return $this->mailContact;
        }

        public function setMailContact($mailContact) {
            $this->mailContact = $mailContact;
        }


        
    }


?>
