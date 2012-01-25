<?php

    class ModeleFicheSujetStage {
        
        private $id ;
        private $nomOriginal ;
        private $nomUnique ;
        private $type ;
        
        function __construct($id, $nomOriginal, $nomUnique, $type){
            $this->id = $id;
            $this->nomOriginal = $nomOriginal;
            $this->nomUnique = $nomUnique;
            $this->type = $type;

        }

       public function getNomOriginal() {
            return $this->nomOriginal;
        }
        
        public function getNomUnique() {
            return $this->nomUnique;
        }

        public function getType() {
            return $this->type;
        }
    }


?>
