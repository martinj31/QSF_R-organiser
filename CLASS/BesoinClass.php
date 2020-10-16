<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class besoin{
    
    
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
    public function setCodeB($CodeB){
        
        $this->_CodeB = $CodeB;
        
    }
    
    public function setVisibiliteB($VisibiliteB){
        
        $this->_VisibiliteB = $VisibiliteB;
        
    }
    
    public function setTitreB($TitreB){
        
        $this->_TitreB = $TitreB;
        
    }
    
    public function setDescriptionB($DescriptionB){
        
        $this->_DescriptionB = $DescriptionB;
        
    }
    
    public function setDateButoireB($DateButoireB){
        
        $this->_DateButoireB = $DateButoireB;
        
    }
    
    public function setDatePublicationB($DatePubicationB){
        
        $this->_DatePubicationB = $DatePubicationB;
        
    }
    
    public function setTypeB($TypeB){
        
        $this->_TypeB = $TypeB;
        
    }
    
    public function setCodeC($CodeC){
        
        $this->_CodeC = $CodeC;
        
    }
    
    
    public function setReponseB($ReponseB){
        
        $this->_ReponseB = $ReponseB;
        
    }
    
    
     //Getter
    public function getCodeB(){
        
        return $this->_CodeB;
        
    }
    
    public function getTitreB(){
        
        return $this->_TitreB;
        
    }
    
    public function getDescriptionB(){
       
        return $this->_DescriptionB;
        
    }
    
    public function getDateButoireB(){
        
        return $this->_DateButoireB;
        
    }
    
    public function getDatePublicationB(){
        
        return $this->_DatePubicationB;
        
    }
    
    public function getTypeB(){
        
        return $this->_TypeB;
        
    }
    
    public function getCodeC(){
        
        return $this->_CodeC;
        
    }
    
    public function getVisibiliteB(){
        
        return $this->_VisibiliteB;
        
    }
    
    public function getReponseB(){
        
        return $this->_ReponseB;
        
    }
    
    public function getNombre(){
        
        return $this->_Nombre;
        
    }
    
    
}


?>