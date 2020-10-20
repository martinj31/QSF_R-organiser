<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SlideClass
 *
 * @author MARTINEZFOUCHE-07265
 */
class slide {
    
    
    private $_NumSlide;
    private $_TitreS;
    private $_PhotoS;
    private $_TextS1;
    private $_TextS2;
    private $_TextS3;
    
    public function __construct(array $donnees){
        
        $this->hydrate($donnees);
        
    }

    //Setter
    function setNumSlide($_NumSlide) {
        $this->_NumSlide = $_NumSlide;
    }

    function setTitreS($_TitreS) {
        $this->_TitreS = $_TitreS;
    }

    function setPhotoS($_PhotoS) {
        $this->_PhotoS = $_PhotoS;
    }

    function setTextS1($_TextS1) {
        $this->_TextS1 = $_TextS1;
    }

    function setTextS2($_TextS2) {
        $this->_TextS2 = $_TextS2;
    }

    function setTextS3($_TextS3) {
        $this->_TextS3 = $_TextS3;
    }

        
    //Getter
    function getNumSlide() {
        return $this->_NumSlide;
    }

    function getTitreS() {
        return $this->_TitreS;
    }

    function getPhotoS() {
        return $this->_PhotoS;
    }

    function getTextS1() {
        return $this->_TextS1;
    }

    function getTextS2() {
        return $this->_TextS2;
    }

    function getTextS3() {
        return $this->_TextS3;
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
}
