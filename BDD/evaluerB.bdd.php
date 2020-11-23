<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../../CLASS/EvaluerBClass.php');
/**
 * Description of evaluerB
 *
 * @author MARTINEZFOUCHE-07265
 */
class evaluerBBDD {

    private $_bdd;

    public function __construct($bdd) {
        $this->setDb($bdd);
    }

    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }
    
    
    public function selectEvalBesoin() {
        $vide = '';
        $evaluerBs = [];
        $req = $this->_bdd->query("select * from evaluerb");


        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
                $evaluerBs[] = new evaluerB($datas);
            }
        } else {
            return $vide;
        }

        return $evaluerBs;

        $req->closeCursor();
    }
    
    
    public function moyenneNoteB() {

        $req = $this->_bdd->query("select AVG(NoteB) as moyenne from evaluerb");
        
        $datas = $req->fetch(PDO::FETCH_ASSOC);

        return $datas['moyenne'];

        $req->closeCursor();
    }
    
    
    public function addEvaluerB(evaluerB $evaluerb) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO evaluerb
                                             SET NoteB = :NoteB,
                                                 AvisB = :AvisB,
                                                 CodeU = :CodeU,
                                                 CodeB = :CodeB
                                    ');

        $req->bindValue(':NoteB', $evaluerb->getNoteB(), PDO::PARAM_STR);
        $req->bindValue(':AvisB', $evaluerb->getAvisB(), PDO::PARAM_STR);
        $req->bindValue(':CodeU', $evaluerb->getCodeU(), PDO::PARAM_INT);
        $req->bindValue(':CodeB', $evaluerb->getCodeB(), PDO::PARAM_INT);

        return $req->execute();



        $req->closeCursor();
    }
    

}
