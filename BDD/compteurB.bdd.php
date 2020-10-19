<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../../CLASS/CompteurBClass.php');

/**
 * Description of compteurB
 *
 * @author MARTINEZFOUCHE-07265
 */
class compteurBBDD {
    
    private $_bdd;
    
    public function __construct($bdd) {
        $this->setDb($bdd);
    }
    
    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }
    
    public function relationBesoinsNBRAll() {

        $req = $this->_bdd->query("select * from compteurb ");

        return $req->rowCount();

        $req->closeCursor();
    }
    
    
    public function relationBesoinsNBRReussi() {

        $req = $this->_bdd->query("select * from compteurb where NumOuiB = 1");

        return $req->rowCount();

        $req->closeCursor();
    }
    
    
    public function relationBesoinsNBREchoue() {

        $req = $this->_bdd->query("select * from compteurb where NumNonB = 1");

        return $req->rowCount();

        $req->closeCursor();
    }
    

    
}
