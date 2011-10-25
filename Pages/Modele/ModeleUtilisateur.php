    <?php

    class ModeleUtilisateur {
        
        private $idetudiant ;
        private $idpromotion ;
        private $prenom ;
        private $nom ;
        private $numeroetudiant ;
        private $mail ;
        
        function __construct($idetudiant, $promotion, $numeroetudiant, $prenom, $nom, $mail) {
            $this->idetudiant = $idetudiant;
            $this->idpromotion = $promotion;
            $this->numeroetudiant = $numeroetudiant;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->mail = $mail;
        }
        
        public function getIdetudiant() {
            return $this->idetudiant;
        }

        public function setIdetudiant($idetudiant) {
            $this->idetudiant = $idetudiant;
        }

        public function getIdPromotion() {
            return $this->idpromotion;
        }

        public function setIdPromotion($idpromotion) {
            $this->idpromotion = $idpromotion;
        }

        public function getNumeroetudiant() {
            return $this->numeroetudiant;
        }

        public function setNumeroetudiant($numeroetudiant) {
            $this->numeroetudiant = $numeroetudiant;
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

        public function getMail() {
            return $this->mail;
        }

        public function setMail($mail) {
            $this->mail = $mail;
        }

    }
?>
