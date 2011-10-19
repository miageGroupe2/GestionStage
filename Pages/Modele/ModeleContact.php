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

        
        
    }


?>
