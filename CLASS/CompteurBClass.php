<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of compteurb
 *
 * @author MARTINEZFOUCHE-07265
 */
class compteurb {
   
    private $_CodeCB;
    private $_NumOuiB;
    private $_NumNonB;
    private $_RaisonB;
    
    
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
    function setCodeCB($_CodeCB) {
        $this->_CodeCB = $_CodeCB;
    }

    function setNumOuiB($_NumOuiB) {
        $this->_NumOuiB = $_NumOuiB;
    }

    function setNumNonB($_NumNonB) {
        $this->_NumNonB = $_NumNonB;
    }

    function setRaisonB($_RaisonB) {
        $this->_RaisonB = $_RaisonB;
    }

        
    
    //Getter
    function getCodeCB() {
        return $this->_CodeCB;
    }

    function getNumOuiB() {
        return $this->_NumOuiB;
    }

    function getNumNonB() {
        return $this->_NumNonB;
    }

    function getRaisonB() {
        return $this->_RaisonB;
    }
    
}
