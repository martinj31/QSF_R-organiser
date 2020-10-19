<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../../CLASS/CompteurTClass.php');

/**
 * Description of compteurT
 *
 * @author MARTINEZFOUCHE-07265
 */
class compteurTBDD {
   
    private $_bdd;
    
    public function __construct($bdd) {
        $this->setDb($bdd);
    }
    
    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }
    
    
    public function relationTalentsNBRAll() {

        $req = $this->_bdd->query("select * from compteurt ");

        return $req->rowCount();

        $req->closeCursor();
    }
    
    
    public function relationTalentsNBRReussi() {

        $req = $this->_bdd->query("select * from compteurt where NumOuiT = 1");

        return $req->rowCount();

        $req->closeCursor();
    }
    
    
    public function relationTalentsNBREchoue() {

        $req = $this->_bdd->query("select * from compteurt where NumNonT = 1");

        return $req->rowCount();

        $req->closeCursor();
    }
    
}
