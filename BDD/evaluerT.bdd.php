<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../../CLASS/EvaluerTClass.php');

/**
 * Description of EvaluerT
 *
 * @author MARTINEZFOUCHE-07265
 */
class evaluerTBDD {

    private $_bdd;

    public function __construct($bdd) {
        $this->setDb($bdd);
    }

    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }

    public function selectEvalTalent() {
        $vide = '';
        $evaluerTs = [];
        $req = $this->_bdd->query("select * from evaluert");


        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
                $evaluerTs[] = new evaluerT($datas);
            }
        } else {
            return $vide;
        }

        return $evaluerTs;

        $req->closeCursor();
    }

    public function moyenneNoteT() {

        $req = $this->_bdd->query("select AVG(NoteT) as moyenne from evaluert");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        return $datas['moyenne'];

        $req->closeCursor();
    }

    //Moyenne des notes en y ajoutant ceux de besoin
    public function moyenneNoteTAndNoteB() {

        $req = $this->_bdd->query("SELECT (SUM(b.NoteB) + SUM(t.NoteT))/(COUNT(b.NoteB) + COUNT(t.NoteT)) AS moyenne FROM evaluerb AS b, evaluert AS t");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        return $datas['moyenne'];

        $req->closeCursor();
    }
    
    
    
    public function addEvaluerT(evaluerT $evaluert) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO evaluert
                                             SET NoteT = :NoteT,
                                                 AvisT = :AvisT,
                                                 CodeU = :CodeU,
                                                 CodeT = :CodeT
                                    ');

        $req->bindValue(':NoteT', $evaluert->getNoteT(), PDO::PARAM_STR);
        $req->bindValue(':AvisT', $evaluert->getAvisT(), PDO::PARAM_STR);
        $req->bindValue(':CodeU', $evaluert->getCodeU(), PDO::PARAM_INT);
        $req->bindValue(':CodeT', $evaluert->getCodeT(), PDO::PARAM_INT);

        return $req->execute();



        $req->closeCursor();
    }

}
