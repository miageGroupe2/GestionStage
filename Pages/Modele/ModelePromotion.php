<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelePromotion
 *
 * @author anthony
 */
class ModelePromotion {
    
    private $idpromotion;
    private $nompromotion;
    private $accesentreprises;
    
    function __construct($idpromotion, $nompromotion, $accesentreprises) {
        $this->idpromotion = $idpromotion;
        $this->nompromotion = $nompromotion;
        $this->accesentreprises = $accesentreprises;
    }

    public function getIdpromotion() {
        return $this->idpromotion;
    }

    public function setIdpromotion($idpromotion) {
        $this->idpromotion = $idpromotion;
    }

    public function getNompromotion() {
        return $this->nompromotion;
    }

    public function setNompromotion($nompromotion) {
        $this->nompromotion = $nompromotion;
    }

    public function getAccesentreprises() {
        return $this->accesentreprises;
    }

    public function setAccesentreprises($accesentreprises) {
        $this->accesentreprises = $accesentreprises;
    }

        //put your code here
}

?>
