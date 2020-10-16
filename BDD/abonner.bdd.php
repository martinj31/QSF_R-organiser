<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../../CLASS/AbonnerClass.php');

class abonnerBDD {
    /*
     * Attributs
     */

    private $_bdd;

    

    /*
     * Méthode de construction
     */

    public function __construct($bdd) {
        $this->setDb($bdd);
    }
    
    
    
    //DELETE FROM `abonner` WHERE `CodeU` = ? 
     public function deleteAbonner($id) {
        $this->_bdd->exec('DELETE FROM `abonner` WHERE `CodeU` = ' . $id);
    }
    
    
    
    

    /*
     * Méthodes Mutateurs (Setters) - Pour modifier la valeur des attributs
     */

    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }

}

?>