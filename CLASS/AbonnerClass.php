<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class abonner{
    
    
    private $_CodeU;
    private $_CodeC;
    
    
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

    function setCodeU($_CodeU) {
        $this->_CodeU = $_CodeU;
    }

    function setCodeC($_CodeC) {
        $this->_CodeC = $_CodeC;
    }

    function getCodeU() {
        return $this->_CodeU;
    }

    function getCodeC() {
        return $this->_CodeC;
    }


    
}

?>