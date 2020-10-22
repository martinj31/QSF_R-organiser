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
    
    public function addCompteur(compteurb $compteurb) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO compteurb
                                             SET NumOuiB = :NumOuiB,
                                                 NumNonB = :NumNonB,
                                                 RaisonB     = :RaisonB
                                    ');

        $req->bindValue(':NumOuiB', $compteurb->getNumOuiB(), PDO::PARAM_STR);
        $req->bindValue(':NumNonB', $compteurb->getNumNonB(), PDO::PARAM_STR);
        $req->bindValue(':RaisonB', $compteurb->getRaisonB(), PDO::PARAM_STR);
        return $req->execute();



        $req->closeCursor();
    }
    
    
    public function compteurReussi(compteurb $compteurb) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO compteurb
                                             SET NumOuiB = :NumOuiB,
                                                 NumNonB = :NumNonB
                                    ');

        $req->bindValue(':NumOuiB', $compteurb->getNumOuiB(), PDO::PARAM_STR);
        $req->bindValue(':NumNonB', $compteurb->getNumNonB(), PDO::PARAM_STR);
        
        return $req->execute();



        $req->closeCursor();
    }
    
    public function relationBesoinsNBREchoue() {

        $req = $this->_bdd->query("select * from compteurb where NumNonB = 1");

        return $req->rowCount();

        $req->closeCursor();
    }
    
    
    

    
}
