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

        $datas = $req->fetch(PDO::FETCH_ASSOC);

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
    

}
