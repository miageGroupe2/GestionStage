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
    private $idEntreprise;
    private $idUtilisateur;
    private $idStage;
    private $nomEntreprise;
    private $dateProposition;
    private $adresseEntreprise;
    private $codePostal;
    private $ville;
    private $pays;
    private $numTelephone;
    private $urlSite;
    private $sujet;
    private $titrestage;
    private $etat;
    private $etudiant;
    private $promotionEtudiant;
    private $technoStage;
    private $raisonrefus ;

    function __construct($idProposition, $idEntreprise, $idUtilisateur, $idStage, $nomEntreprise, $dateProposition, $adresseEntreprise, $codePostal, $ville, $pays, $numTelephone, $urlSite, $sujet, $etat, $etudiant, $promotionEtudiant, $titreStage, $technoStage, $raisonrefus) {
        $this->idProposition = $idProposition;
        $this->idEntreprise = $idEntreprise;
        $this->idUtilisateur = $idUtilisateur;
        $this->idStage = $idStage;
        $this->nomEntreprise = $nomEntreprise;
        $this->dateProposition = $dateProposition;
        $this->adresseEntreprise = $adresseEntreprise;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->numTelephone = $numTelephone;
        $this->urlSite = $urlSite;
        $this->sujet = $sujet;
        $this->titrestage = $titreStage;
        $this->etat = $etat;
        $this->etudiant = $etudiant;
        $this->promotionEtudiant = $promotionEtudiant;
        $this->technoStage = $technoStage;
        $this->raisonrefus = $raisonrefus ;
        
    }

    public function getRaisonrefus() {
        return $this->raisonrefus;
    }

    public function getPromotionEtudiant() {
        return $this->promotionEtudiant;
    }
    public function getTechnoStage() {
        return $this->technoStage;
    }

    public function setPromotionEtudiant($promotionEtudiant) {
        $this->promotionEtudiant = $promotionEtudiant;
    }

    public function getTitreStage(){
        
        return $this->titrestage ;
    }
    
    public function getEtudiant() {
        return $this->etudiant;
    }

    public function setEtudiant($etudiant) {
        $this->etudiant = $etudiant;
    }

        public function getIdProposition() {
        return $this->idProposition;
    }

    public function setIdProposition($idProposition) {
        $this->idProposition = $idProposition;
    }

    public function getIdEntreprise() {
        return $this->idEntreprise;
    }

    public function setIdEntreprise($idEntreprise) {
        $this->idEntreprise = $idEntreprise;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getIdStage() {
        return $this->idStage;
    }

    public function setIdStage($idStage) {
        $this->idStage = $idStage;
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

    public function getEtat() {
        return $this->etat;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }


}

?>
