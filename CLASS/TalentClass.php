<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class talent{
    
    
    private $_CodeT;
    private $_TitreT;
    private $_DescriptionT;
    private $_DatePublicationT;
    private $_TypeT;
    private $_CodeC;
    private $_VisibiliteT;
    private $_ReponseT;
    
    
    
    
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
    public function setCodeT($CodeT){
        
        $this->_CodeT = $CodeT;
        
    }
    
    public function setTitreT($TitreT){
        
        $this->_TitreT = $TitreT;
        
    }
    
    public function setDescriptionT($DescriptionT){
        
        $this->_DescriptionT = $DescriptionT;
        
    }
    
    public function setDatePublicationT($DatePublicationT){
        
        $this->_DatePublicationT = $DatePublicationT;
        
    }
    
    public function setTypeT($TypeT){
        
        $this->_TypeT = $TypeT;
        
    }
    
    public function setCodeC($CodeC){
        
        $this->_CodeC = $CodeC;
        
    }
    
    public function setVisibiliteT($VisibiliteT){
        
        $this->_VisibiliteT = $VisibiliteT;
        
    }
    
    public function setReponseT($ReponseT){
        
        $this->_ReponseT = $ReponseT;
        
    }
    
    
    
    
     //Getter
    public function getCodeT(){
        
        return $this->_CodeT;
        
    }
    
    public function getTitreT(){
        
        return $this->_TitreT;
        
    }
    
    public function getDescriptionT(){
       
        return $this->_DescriptionT;
        
    }
    
    public function getDatePublicationT(){
        
        return $this->_DatePublicationT;
        
    }
    
    public function getTypeT(){
        
        return $this->_TypeT;
        
    }
    
    public function getCodeC(){
        
        return $this->_CodeC;
        
    }
    
    
    
    public function getVisibiliteT(){
        
        return $this->_VisibiliteT;
        
    }
    
    public function getReponseT(){
        
        return $this->_ReponseT;
        
    }
    
    
}

?>