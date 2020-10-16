<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class projet{
    
    
    private $_CodeB;
    private $_TitreB;
    private $_DescriptionB;
    private $_DateButoireB;
    private $_DatePubicationB;
    private $_TypeB;
    private $_CodeC;
    private $_VisibiliteB;
    private $_ReponseB;
    private $_Nombre;
    
    
    
    
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
    function setCodeB($_CodeB) {
        $this->_CodeB = $_CodeB;
    }

    function setTitreB($_TitreB) {
        $this->_TitreB = $_TitreB;
    }

    function setDescriptionB($_DescriptionB) {
        $this->_DescriptionB = $_DescriptionB;
    }

    function setDateButoireB($_DateButoireB) {
        $this->_DateButoireB = $_DateButoireB;
    }

    function setDatePubicationB($_DatePubicationB) {
        $this->_DatePubicationB = $_DatePubicationB;
    }

    function setTypeB($_TypeB) {
        $this->_TypeB = $_TypeB;
    }

    function setCodeC($_CodeC) {
        $this->_CodeC = $_CodeC;
    }

    function setVisibiliteB($_VisibiliteB) {
        $this->_VisibiliteB = $_VisibiliteB;
    }

    function setReponseB($_ReponseB) {
        $this->_ReponseB = $_ReponseB;
    }

    function setNombre($_Nombre) {
        $this->_Nombre = $_Nombre;
    }

        
    
    
     //Getter
     function getCodeB() {
         return $this->_CodeB;
     }

     function getTitreB() {
         return $this->_TitreB;
     }

     function getDescriptionB() {
         return $this->_DescriptionB;
     }

     function getDateButoireB() {
         return $this->_DateButoireB;
     }

     function getDatePubicationB() {
         return $this->_DatePubicationB;
     }

     function getTypeB() {
         return $this->_TypeB;
     }

     function getCodeC() {
         return $this->_CodeC;
     }

     function getVisibiliteB() {
         return $this->_VisibiliteB;
     }

     function getReponseB() {
         return $this->_ReponseB;
     }

     function getNombre() {
         return $this->_Nombre;
     }


    
    
}


?>