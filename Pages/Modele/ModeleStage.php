<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModeleStage
 *
 * @author anthony
 */
class ModeleStage {
    private $idstage;
    private $identreprise;
    private $idcontact;
    private $nometudiant;
    private $prenometudiant;
    private $promotion;
    private $datedepoposition;
    private $sujetstage;
    private $datevalidation;
    private $datedebut;
    private $datefin;
    private $datesoutenance;
    private $lieusoutenance;
    private $etatstage;
    private $noteobtenue;
    private $appreciationobtenue;
    private $remuneration;
    private $embauche;
    private $dateembauche;
    
    function __construct($idstage, $identreprise, $idcontact, $nometudiant, $prenometudiant, $promotion, $datedepoposition, $sujetstage, $datevalidation, $datedebut, $datefin, $datesoutenance, $lieusoutenance, $etatstage, $noteobtenue, $appreciationobtenue, $remuneration, $embauche, $dateembauche) {
        $this->idstage = $idstage;
        $this->identreprise = $identreprise;
        $this->idcontact = $idcontact;
        $this->nometudiant = $nometudiant;
        $this->prenometudiant = $prenometudiant;
        $this->promotion = $promotion;
        $this->datedepoposition = $datedepoposition;
        $this->sujetstage = $sujetstage;
        $this->datevalidation = $datevalidation;
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->datesoutenance = $datesoutenance;
        $this->lieusoutenance = $lieusoutenance;
        $this->etatstage = $etatstage;
        $this->noteobtenue = $noteobtenue;
        $this->appreciationobtenue = $appreciationobtenue;
        $this->remuneration = $remuneration;
        $this->embauche = $embauche;
        $this->dateembauche = $dateembauche;
    }

    public function getIdstage() {
        return $this->idstage;
    }

    public function setIdstage($idstage) {
        $this->idstage = $idstage;
    }

    public function getIdentreprise() {
        return $this->identreprise;
    }

    public function setIdentreprise($identreprise) {
        $this->identreprise = $identreprise;
    }

    public function getIdcontact() {
        return $this->idcontact;
    }

    public function setIdcontact($idcontact) {
        $this->idcontact = $idcontact;
    }

    public function getNometudiant() {
        return $this->nometudiant;
    }

    public function setNometudiant($nometudiant) {
        $this->nometudiant = $nometudiant;
    }

    public function getPrenometudiant() {
        return $this->prenometudiant;
    }

    public function setPrenometudiant($prenometudiant) {
        $this->prenometudiant = $prenometudiant;
    }

    public function getPromotion() {
        return $this->promotion;
    }

    public function setPromotion($promotion) {
        $this->promotion = $promotion;
    }

    public function getDatedepoposition() {
        return $this->datedepoposition;
    }

    public function setDatedepoposition($datedepoposition) {
        $this->datedepoposition = $datedepoposition;
    }

    public function getSujetstage() {
        return $this->sujetstage;
    }

    public function setSujetstage($sujetstage) {
        $this->sujetstage = $sujetstage;
    }

    public function getDatevalidation() {
        return $this->datevalidation;
    }

    public function setDatevalidation($datevalidation) {
        $this->datevalidation = $datevalidation;
    }

    public function getDatedebut() {
        return $this->datedebut;
    }

    public function setDatedebut($datedebut) {
        $this->datedebut = $datedebut;
    }

    public function getDatefin() {
        return $this->datefin;
    }

    public function setDatefin($datefin) {
        $this->datefin = $datefin;
    }

    public function getDatesoutenance() {
        return $this->datesoutenance;
    }

    public function setDatesoutenance($datesoutenance) {
        $this->datesoutenance = $datesoutenance;
    }

    public function getLieusoutenance() {
        return $this->lieusoutenance;
    }

    public function setLieusoutenance($lieusoutenance) {
        $this->lieusoutenance = $lieusoutenance;
    }

    public function getEtatstage() {
        return $this->etatstage;
    }

    public function setEtatstage($etatstage) {
        $this->etatstage = $etatstage;
    }

    public function getNoteobtenue() {
        return $this->noteobtenue;
    }

    public function setNoteobtenue($noteobtenue) {
        $this->noteobtenue = $noteobtenue;
    }

    public function getAppreciationobtenue() {
        return $this->appreciationobtenue;
    }

    public function setAppreciationobtenue($appreciationobtenue) {
        $this->appreciationobtenue = $appreciationobtenue;
    }

    public function getRemuneration() {
        return $this->remuneration;
    }

    public function setRemuneration($remuneration) {
        $this->remuneration = $remuneration;
    }

    public function getEmbauche() {
        return $this->embauche;
    }

    public function setEmbauche($embauche) {
        $this->embauche = $embauche;
    }

    public function getDateembauche() {
        return $this->dateembauche;
    }

    public function setDateembauche($dateembauche) {
        $this->dateembauche = $dateembauche;
    }


}

?>
