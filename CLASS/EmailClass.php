<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emailClass
 *
 * @author MARTINEZFOUCHE-07265
 */
class email {
    
    private $_CodeEM;
    private $_Provenance;
    private $_Destinataire;
    private $_Sujet;
    private $_Contenu;
    private $_DateEvaluation;
    private $_VisibiliteE;
    private $_CodeCarte;
    private $_TypeCarte;
    
    
    public function __construct(array $donnees){
        
        $this->hydrate($donnees);
        
    }

    
    
    public function hydrate(array $donnees){
        
        foreach ($donnees as $key => $value){
            $method = 'set'.ucfirst($key); 
            if (method_exists($this, $method)){
                // On appelle le setter.
                $this->$method($value);
                
            }
        }
    }
    
    
    //Setter
    function setCodeEM($_CodeEM) {
        $this->_CodeEM = $_CodeEM;
    }

    function setProvenance($_Provenance) {
        $this->_Provenance = $_Provenance;
    }

    function setDestinataire($_Destinataire) {
        $this->_Destinataire = $_Destinataire;
    }

    function setSujet($_Sujet) {
        $this->_Sujet = $_Sujet;
    }

    function setContenu($_Contenu) {
        $this->_Contenu = $_Contenu;
    }

    function setDateEvaluation($_DateEvaluation) {
        $this->_DateEvaluation = $_DateEvaluation;
    }

    function setVisibiliteE($_VisibiliteE) {
        $this->_VisibiliteE = $_VisibiliteE;
    }

    function setCodeCarte($_CodeCarte) {
        $this->_CodeCarte = $_CodeCarte;
    }

    function setTypeCarte($_TypeCarte) {
        $this->_TypeCarte = $_TypeCarte;
    }


    
    
    //Getter
    function getCodeEM() {
        return $this->_CodeEM;
    }

    function getProvenance() {
        return $this->_Provenance;
    }

    function getDestinataire() {
        return $this->_Destinataire;
    }

    function getSujet() {
        return $this->_Sujet;
    }

    function getContenu() {
        return $this->_Contenu;
    }

    function getDateEvaluation() {
        return $this->_DateEvaluation;
    }

    function getVisibiliteE() {
        return $this->_VisibiliteE;
    }

    function getCodeCarte() {
        return $this->_CodeCarte;
    }

    function getTypeCarte() {
        return $this->_TypeCarte;
    }


    
}
