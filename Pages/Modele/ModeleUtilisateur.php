    <?php

    class ModeleUtilisateur {
        
        private $id ;
        private $promotion ;
        private $prenom ;
        private $nom ;
        private $numeroetudiant ;
        private $mail ;
        private $admin ;
        
        function __construct($id, $promotion, $numeroetudiant, $prenom, $nom, $mail, $admin) {
            $this->id = $id;
            $this->promotion = $promotion;
            $this->numeroetudiant = $numeroetudiant;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->mail = $mail;
            $this->admin = $admin;
        }
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getPromotion() {
            return $this->promotion;
        }

        public function setPromotion($promotion) {
            $this->idpromotion = $promotion;
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
        public function getAdmin() {
            return $this->admin;
        }



    }
?>
