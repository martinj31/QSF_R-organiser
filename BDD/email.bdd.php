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
        $query = "SELECT e.CodeCarte, e.Sujet, e.CodeEM, e.Contenu, u.Email, b.DateButoireB, b.VisibiliteB, e.Provenance FROM emails AS e, utilisateurs AS u, besoins AS b WHERE e.TypeCarte = 'besoin' AND e.Destinataire = {$codeu} AND e.VisibiliteE = 1 AND e.CodeCarte = {$code}  AND e.Provenance = u.CodeU AND b.CodeB = e.CodeCarte";

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $email = new email([]);
                $email->setCodeEM($datas['CodeEM']);
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

    public function selectMailTalent($code, $codeu) {

        $vide = '';

        $Mails = [];
        $query = "SELECT e.CodeCarte, e.Sujet, e.CodeEM, e.Contenu, u.Email, t.VisibiliteT, e.Provenance FROM emails AS e, utilisateurs AS u, talents AS t WHERE e.TypeCarte = 'talent' AND e.Destinataire = $codeu AND e.VisibiliteE = 1 AND e.CodeCarte = $code  AND e.Provenance = u.CodeU AND t.CodeT = e.CodeCarte";

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $email = new email([]);

                $email->setCodeCarte($datas['CodeCarte']);
                $email->setSujet($datas['Sujet']);
                $email->setContenu($datas['Contenu']);
                $email->setCodeEM($datas['CodeEM']);
                $email->setProvenance($datas['Provenance']);



                $Mails[] = ['email' => $email, 'VisibiliteT' => $datas['VisibiliteT'], 'EmailU' => $datas['Email']];
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

    public function addEmail(email $email) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO emails
                                             SET Provenance = :Provenance,
                                                 Destinataire = :Destinataire,
                                                 Sujet     = :Sujet,
                                                 Contenu = :Contenu,
                                                 VisibiliteE = :VisibiliteE,
                                                 CodeCarte = :CodeCarte,
                                                 TypeCarte     = :TypeCarte
                                    ');

        $req->bindValue(':Provenance', $email->getProvenance(), PDO::PARAM_STR);
        $req->bindValue(':Destinataire', $email->getDestinataire(), PDO::PARAM_STR);
        $req->bindValue(':Sujet', $email->getSujet(), PDO::PARAM_STR);
        $req->bindValue(':Contenu', $email->getContenu(), PDO::PARAM_STR);
  
        $req->bindValue(':VisibiliteE', $email->getVisibiliteE(), PDO::PARAM_STR);
        $req->bindValue(':CodeCarte', $email->getCodeCarte(), PDO::PARAM_STR);
        $req->bindValue(':TypeCarte', $email->getTypeCarte(), PDO::PARAM_STR);

        return $req->execute();



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
    public function UpdateVisibiliteT($CodeCarte, $Provenance, $CodeEM) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare("UPDATE emails SET VisibiliteE = 0 WHERE CodeCarte = :CodeCarte AND TypeCarte = 'talent' AND Provenance = :Provenance AND CodeEM = :CodeEM");

       
        $req->bindValue(':CodeCarte', $CodeCarte, PDO::PARAM_INT);
        $req->bindValue(':Provenance', $Provenance, PDO::PARAM_INT);
        $req->bindValue(':CodeEM', $CodeEM, PDO::PARAM_INT);

        return $req->execute();



        $req->closeCursor();
    }

    //Update Visible
    public function UpdateVisibiliteB($CodeCarte, $Provenance, $CodeEM) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare("UPDATE emails SET VisibiliteE = 0 WHERE CodeCarte = :CodeCarte AND TypeCarte = 'besoin' AND Provenance = :Provenance AND CodeEM = :CodeEM");

        
        $req->bindValue(':CodeCarte', $CodeCarte, PDO::PARAM_INT);
        $req->bindValue(':Provenance', $Provenance, PDO::PARAM_INT);
        $req->bindValue(':CodeEM', $CodeEM, PDO::PARAM_INT);

        return $req->execute();



        $req->closeCursor();
    }

}
