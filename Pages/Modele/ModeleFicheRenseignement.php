<?php

    class ModeleFicheRenseignement {
        
        private $id ;
        private $nomOriginal ;
        private $nomUnique ;
        
        function __construct($id, $nomOriginal, $nomUnique){
            $this->id = $id;
            $this->nomOriginal = $nomOriginal;
            $this->nomUnique = $nomUnique;
        }

       public function getNomOriginal() {
            return $this->nomOriginal;
        }
        
        public function getNomUnique() {
            return $this->nomUnique;
        }
    }


?>
