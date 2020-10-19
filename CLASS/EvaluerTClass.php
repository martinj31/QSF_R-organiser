<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EvaluerTClass
 *
 * @author MARTINEZFOUCHE-07265
 */
class evaluerT {

    private $_CodeET;
    private $_NoteT;
    private $_AvisT;
    private $_DateET;
    private $_CodeU;
    private $_CodeT;
    
    
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
    function setCodeET($_CodeET) {
        $this->_CodeET = $_CodeET;
    }

    function setNoteT($_NoteT) {
        $this->_NoteT = $_NoteT;
    }

    function setAvisT($_AvisT) {
        $this->_AvisT = $_AvisT;
    }

    function setDateET($_DateET) {
        $this->_DateET = $_DateET;
    }

    function setCodeU($_CodeU) {
        $this->_CodeU = $_CodeU;
    }

    function setCodeT($_CodeT) {
        $this->_CodeT = $_CodeT;
    }


    //Getter
    function getCodeET() {
        return $this->_CodeET;
    }

    function getNoteT() {
        return $this->_NoteT;
    }

    function getAvisT() {
        return $this->_AvisT;
    }

    function getDateET() {
        return $this->_DateET;
    }

    function getCodeU() {
        return $this->_CodeU;
    }

    function getCodeT() {
        return $this->_CodeT;
    }




}
