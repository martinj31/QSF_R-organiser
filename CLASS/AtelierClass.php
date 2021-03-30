<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class atelier{
    
    
    private $_CodeA;
    private $_TitreA;
    private $_DescriptionA;
    private $_DateDebutA;
    private $_DateFinA;
    private $_LieuA;
    private $_NombreA;
    private $_DatePublicationA;
    private $_URL;
    private $_PlusA;
    private $_TypeA;
    private $_CodeC;
    private $_VisibiliteA;
    private $_MailCommence;
    private $_HoraireA;
    
    
    
    
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
    function setCodeA($_CodeA) {
        $this->_CodeA = $_CodeA;
    }

    function setTitreA($_TitreA) {
        $this->_TitreA = $_TitreA;
    }

    function setDescriptionA($_DescriptionA) {
        $this->_DescriptionA = $_DescriptionA;
    }

    function setDateDebutA($_DateDebutA) {
        $this->_DateDebutA = $_DateDebutA;
    }

    function setDateFinA($_DateFinA) {
        $this->_DateFinA = $_DateFinA;
    }

    
    function setLieuA($_LieuA) {
        $this->_LieuA = $_LieuA;
    }

    function setNombreA($_NombreA) {
        $this->_NombreA = $_NombreA;
    }

    function setDatePublicationA($_DatePublicationA) {
        $this->_DatePublicationA = $_DatePublicationA;
    }

    function setURL($_URL) {
        $this->_URL = $_URL;
    }

    function setPlusA($_PlusA) {
        $this->_PlusA = $_PlusA;
    }

    function setTypeA($_TypeA) {
        $this->_TypeA = $_TypeA;
    }

    function setCodeC($_CodeC) {
        $this->_CodeC = $_CodeC;
    }

    function setVisibiliteA($_VisibiliteA) {
        $this->_VisibiliteA = $_VisibiliteA;
    }

    function setMailCommence($_MailCommence) {
        $this->_MailCommence = $_MailCommence;
    }

    function setHoraireA($_Horaire) {
        $this->_HoraireA = $_Horaire;
    }

            
    
    
    
     //Getter
    
     function getCodeA() {
         return $this->_CodeA;
     }

     function getTitreA() {
         return $this->_TitreA;
     }

     function getDescriptionA() {
         return $this->_DescriptionA;
     }

     function getDateDebutA() {
         return $this->_DateDebutA;
     }

     function getDateFinA() {
         return $this->_DateFinA;
     }

     
     function getLieuA() {
         return $this->_LieuA;
     }

     function getNombreA() {
         return $this->_NombreA;
     }

     function getDatePublicationA() {
         return $this->_DatePublicationA;
     }

     function getURL() {
         return $this->_URL;
     }

     function getPlusA() {
         return $this->_PlusA;
     }

     function getTypeA() {
         return $this->_TypeA;
     }

     function getCodeC() {
         return $this->_CodeC;
     }

     function getVisibiliteA() {
         return $this->_VisibiliteA;
     }

     function getMailCommence() {
         return $this->_MailCommence;
     }

     function getHoraireA() {
         return $this->_HoraireA;
     }




    
}


?>
