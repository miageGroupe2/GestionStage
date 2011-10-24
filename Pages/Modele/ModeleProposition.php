<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModeleProposition
 *
 * @author anthony
 */
class ModeleProposition {
    private $idProposition;
    private $nomEntreprise;
    private $dateProposition;
    private $adresseEntreprise;
    private $codePostal;
    private $ville;
    private $pays;
    private $numTelephone;
    private $urlSite;
    private $sujet;
    private $etatProposition;
    
    function __construct($idProposition, $nomEntreprise, $dateProposition, $adresseEntreprise, $codePostal, $ville, $pays, $numTelephone, $urlSite, $sujet, $etatProposition) {
        $this->idProposition = $idProposition;
        $this->nomEntreprise = $nomEntreprise;
        $this->dateProposition = $dateProposition;
        $this->adresseEntreprise = $adresseEntreprise;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->numTelephone = $numTelephone;
        $this->urlSite = $urlSite;
        $this->sujet = $sujet;
        $this->etatProposition = $etatProposition;
    }

    public function getIdProposition() {
        return $this->idProposition;
    }

    public function setIdProposition($idProposition) {
        $this->idProposition = $idProposition;
    }

    public function getNomEntreprise() {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise($nomEntreprise) {
        $this->nomEntreprise = $nomEntreprise;
    }

    public function getDateProposition() {
        return $this->dateProposition;
    }

    public function setDateProposition($dateProposition) {
        $this->dateProposition = $dateProposition;
    }

    public function getAdresseEntreprise() {
        return $this->adresseEntreprise;
    }

    public function setAdresseEntreprise($adresseEntreprise) {
        $this->adresseEntreprise = $adresseEntreprise;
    }

    public function getCodePostal() {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;
    }

    public function getVille() {
        return $this->ville;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function getPays() {
        return $this->pays;
    }

    public function setPays($pays) {
        $this->pays = $pays;
    }

    public function getNumTelephone() {
        return $this->numTelephone;
    }

    public function setNumTelephone($numTelephone) {
        $this->numTelephone = $numTelephone;
    }

    public function getUrlSite() {
        return $this->urlSite;
    }

    public function setUrlSite($urlSite) {
        $this->urlSite = $urlSite;
    }

    public function getSujet() {
        return $this->sujet;
    }

    public function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    public function getEtatProposition() {
        return $this->etatProposition;
    }

    public function setEtatProposition($etatProposition) {
        $this->etatProposition = $etatProposition;
    }


    
    
}

?>
