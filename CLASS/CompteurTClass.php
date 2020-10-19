<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompteurT
 *
 * @author MARTINEZFOUCHE-07265
 */
class CompteurT {

    private $_CodeCT;
    private $_NumOuiT;
    private $_NumNonT;
    private $_RaisonT;
    
    
    
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
    function setCodeCT($_CodeCT) {
        $this->_CodeCT = $_CodeCT;
    }

    function setNumOuiT($_NumOuiT) {
        $this->_NumOuiT = $_NumOuiT;
    }

    function setNumNonT($_NumNonT) {
        $this->_NumNonT = $_NumNonT;
    }

    function setRaisonT($_RaisonT) {
        $this->_RaisonT = $_RaisonT;
    }

        
    
    //Getter
    function getCodeCT() {
        return $this->_CodeCT;
    }

    function getNumOuiT() {
        return $this->_NumOuiT;
    }

    function getNumNonT() {
        return $this->_NumNonT;
    }

    function getRaisonT() {
        return $this->_RaisonT;
    }



}
