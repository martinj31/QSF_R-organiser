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
        $this->_bdd->exec('DELETE FROM `abonner` WHERE `CodeC` = ' . $id);
        return ;
    }
    
    
    public function addabonner(abonner $abonner) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO abonner
                                             SET CodeU = :CodeU,
                                                 CodeC = :CodeC
                                    ');

        $req->bindValue(':CodeU', $abonner->getCodeU(), PDO::PARAM_STR);
        $req->bindValue(':CodeC', $abonner->getCodeC(), PDO::PARAM_STR);

        return $req->execute();



        $req->closeCursor();
    }
    

    /*
     * Méthodes Mutateurs (Setters) - Pour modifier la valeur des attributs
     */

    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }

}

?>