<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class projet{
    
    
    private $_CodeP;
    private $_TitreP;
    private $_DescriptionP;
    private $_LieuP;
    private $_DateButoireP;
    private $_DatePublicationP;
    private $_TypeP;
    private $_CodeC;
    private $_VisibiliteP;
    /*private $_ReponseP;
    private $_Nombre;*/
    
    
    
    
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
    function setCodeP($_CodeP) {
        $this->_CodeP = $_CodeP;
    }

    function setTitreP($_TitreP) {
        $this->_TitreP = $_TitreP;
    }

    function setDescriptionP($_DescriptionP) {
        $this->_DescriptionP = $_DescriptionP;
    }
    
    function setLieuP($_LieuP) {
        $this->_LieuP = $_LieuP;
    }

    
    function setDateButoireP($_DateButoireP) {
        $this->_DateButoireP = $_DateButoireP;
    }

    function setDatePublicationP($_DatePubicationP) {
        $this->_DatePubicationP = $_DatePubicationP;
    }

    function setTypeP($_TypeP) {
        $this->_TypeP = $_TypeP;
    }

    function setCodeC($_CodeC) {
        $this->_CodeC = $_CodeC;
    }

    function setVisibiliteP($_VisibiliteP) {
        $this->_VisibiliteP = $_VisibiliteP;
    }

            
    
    
     //Getter
     function getCodeP() {
         return $this->_CodeP;
     }

     function getTitreP() {
         return $this->_TitreP;
     }

     function getDescriptionP() {
         return $this->_DescriptionP;
     }
     
     function getLieuP() {
         return $this->_LieuP;
     }

     
     function getDateButoireP() {
         return $this->_DateButoireP;
     }

     function getDatePublicationP() {
         return $this->_DatePubicationP;
     }

     function getTypeP() {
         return $this->_TypeP;
     }

     function getCodeC() {
         return $this->_CodeC;
     }

     function getVisibiliteP() {
         return $this->_VisibiliteP;
     }




    
    
}


?>