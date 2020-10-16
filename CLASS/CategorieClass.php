<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class categorie{
    
    
    private $_CodeC;
    private $_NomC;
    private $_DescriptionC;
    private $_PhotoC;
    private $_VisibiliteC;
    
    
    
    
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
    public function setCodeC($CodeC){
        
        $this->_CodeC = $CodeC;
        
    }
    
    public function setNomC($NomC){
        
        $this->_NomC = $NomC;
        
    }
    
    public function setDescriptionC($DescriptionC){
        
        $this->_DescriptionC = $DescriptionC;
        
    }
    
    public function setPhotoC($PhotoC){
        
        $this->_PhotoC = $PhotoC;
        
    }
    
    public function setVisibiliteC($VisibiliteC){
        
        $this->_VisibiliteC = $VisibiliteC;
        
    }
    
    
    
    
    
    
     //Getter
    public function getCodeC(){
        
        return $this->_CodeC;
        
    }
    
    public function getNomC(){
        
        return $this->_NomC;
        
    }
    
    public function getDescriptionC(){
       
        return $this->_DescriptionC;
        
    }
    
    public function getPhotoC(){
        
        return $this->_PhotoC;
        
    }
    
    
    
    public function getVisibiliteC(){
        
        return $this->_VisibiliteC;
        
    }
    
  
    
    
}

?>