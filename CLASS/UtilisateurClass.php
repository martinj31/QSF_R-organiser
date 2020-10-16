<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class utilisateur{
    
    
    private $_CodeU;
    private $_NomU;
    private $_PrenomU;
    private $_Email;
    private $_MotDePasse;
    private $_TypeU;
    private $_RoleU;
    
    
    
    
    
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
    public function setCodeU($CodeU){
        
        $this->_CodeU = $CodeU;
        
    }
    
    public function setNomU($NomU){
        
        $this->_NomU = $NomU;
        
    }
    
    public function setPrenomU($PrenomU){
        
        $this->_PrenomU = $PrenomU;
        
    }
    
    public function setEmail($Email){
        
        $this->_Email = $Email;
        
    }
    
    public function setMotDePasse($MotDePasse){
        
        $this->_MotDePasse = $MotDePasse;
        
    }
    
    public function setTypeU($TypeU){
        
        $this->_TypeU = $TypeU;
        
    }
    
    public function setRoleU($RoleU){
        
        $this->_RoleU = $RoleU;
        
    }
    
   
    
    
    
     //Getter
    public function getCodeU(){
        
        return $this->_CodeU;
        
    }
    
    public function getNomU(){
        
        return $this->_NomU;
        
    }
    
    public function getPrenomU(){
       
        return $this->_PrenomU;
        
    }
    
    public function getEmail(){
        
        return $this->_Email;
        
    }
    
    public function getMotDePasse(){
        
        return $this->_MotDePasse;
        
    }
    
    public function getTypeU(){
        
        return $this->_TypeU;
        
    }
    
    
    
    public function getRoleU(){
        
        return $this->_RoleU;
        
    }
    
   
    
    
}

?>