<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../../CLASS/EmailClass.php');

/**
 * Description of email
 *
 * @author MARTINEZFOUCHE-07265
 */
class emailBDD {

    private $_bdd;

    public function __construct($bdd) {
        $this->setDb($bdd);
    }

    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }

//$query = "SELECT e.CodeCarte, e.Sujet, e.Contenu, u.Email, b.DateButoireB, b.VisibiliteB, e.Provenance FROM emails AS e, utilisateurs AS u, besoins AS b WHERE e.TypeCarte = 'besoin' AND e.Destinataire = {$_SESSION['codeu']} AND e.VisibiliteE = 1 AND e.CodeCarte = {$_GET['code']}  AND e.Provenance = u.CodeU AND b.CodeB = e.CodeCarte"; 

    public function selectMailBesoin($code, $codeu) {

        $vide = '';

        $Mails = [];
        $query = "SELECT e.CodeCarte, e.Sujet, e.Contenu, u.Email, b.DateButoireB, b.VisibiliteB, e.Provenance FROM emails AS e, utilisateurs AS u, besoins AS b WHERE e.TypeCarte = 'besoin' AND e.Destinataire = {$codeu} AND e.VisibiliteE = 1 AND e.CodeCarte = {$code}  AND e.Provenance = u.CodeU AND b.CodeB = e.CodeCarte";

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $email = new email([]);

                $email->setCodeCarte($datas['CodeCarte']);
                $email->setSujet($datas['Sujet']);
                $email->setContenu($datas['Contenu']);

                $email->setProvenance($datas['Provenance']);



                $Mails[] = ['email' => $email, 'DateButoireB' => $datas['DateButoireB'], 'VisibiliteB' => $datas['VisibiliteB'], 'EmailU' => $datas['Email']];
            }
        } else {
            return $vide;
        }


        return $Mails;

        $req->closeCursor();
    }
    
    
    public function selectCodeCarteTalentTitre($codeu) {

        $vide = '';

        $Mails = [];
        $query = "SELECT DISTINCT e.CodeCarte, t.TitreT FROM emails as e, talents as t WHERE e.TypeCarte = 'talent' and (e.Provenance = {$codeu} or e.destinataire = {$codeu}) and e.CodeCarte = t.CodeT";

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

               


                $Mails[] = ['email' => $datas['CodeCarte'], 'talent' => $datas['TitreT']];
            }
        } else {
            return $vide;
        }


        return $Mails;

        $req->closeCursor();
    }
    
    
    
    public function selectCodeCarteBesoinTitre($codeu) {

        $vide = '';

        $Mails = [];
        $query = "SELECT DISTINCT e.CodeCarte, b.TitreB FROM emails as e, besoins as b WHERE e.TypeCarte = 'besoin' and (e.Provenance = {$codeu} or e.destinataire = {$codeu}) and e.CodeCarte = b.CodeB";

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

               


                $Mails[] = ['email' => $datas['CodeCarte'], 'besoin' => $datas['TitreB']];
            }
        } else {
            return $vide;
        }


        return $Mails;

        $req->closeCursor();
    }
    

    //Update Visible
    public function UpdateVisibilite($CodeCarte, $Provenance) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare("UPDATE emails SET VisibiliteE = 0 WHERE CodeCarte = $CodeB AND TypeCarte = besoin AND Provenance = $CodeB");

        $req->bindValue(':CodeB', $CodeB, PDO::PARAM_INT);


        return $req->execute();



        $req->closeCursor();
    }

}
