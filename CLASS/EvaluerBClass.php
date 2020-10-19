<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EvaluerBClass
 *
 * @author MARTINEZFOUCHE-07265
 */
class evaluerB {
   
    
    private $_NoteB;
    private $_AvisB;
    private $_DateEB;
    private $_CodeU;
    private $_CodeB;
    
    
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
    
    function setNoteB($_NoteB) {
        $this->_NoteB = $_NoteB;
    }

    function setAvisB($_AvisB) {
        $this->_AvisB = $_AvisB;
    }

    function setDateEB($_DateEB) {
        $this->_DateEB = $_DateEB;
    }

    function setCodeU($_CodeU) {
        $this->_CodeU = $_CodeU;
    }

    function setCodeB($_CodeB) {
        $this->_CodeB = $_CodeB;
    }

    
    
    //Getter
   
    function getNoteB() {
        return $this->_NoteB;
    }

    function getAvisB() {
        return $this->_AvisB;
    }

    function getDateEB() {
        return $this->_DateEB;
    }

    function getCodeU() {
        return $this->_CodeU;
    }

    function getCodeB() {
        return $this->_CodeB;
    }



}
