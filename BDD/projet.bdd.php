<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../../CLASS/ProjetClass.php');

//use '../CLASS/BesoinClass.php';

class projetBDD {
    /*
     * Attributs
     */

    private $_bdd;

    /*
     * private $_CodeB;
      private $_TitreB;
      private $_DescriptionB;
      private $_DateButoireB;
      private $_DatePubicationB;
      private $_TypeB;
      private $_CodeC;
      private $_VisibiliteB;
      private $_ReponseB;
      private $_Nombre;
     */

    /*
     * Méthode de construction
     */

    public function __construct($bdd) {
        $this->setDb($bdd);
    }

    public function estVide() {

        $query = "select * from projet ";

        $req = $this->_bdd->query($query);
        return $req;
    }

    public function selectProjetEtPhoto($mot) {


        $vide = '';
        $query = "select p.TitreP, c.PhotoC, p.DateButoireP from projet p, categories c where p.CodeC = c.CodeC order by CodeP DESC";

        if ($mot != NULL) { /* Recherche par mot clé */
            $mot = htmlspecialchars($mot);
            $query = "select p.TitreP, c.PhotoC, p.DateButoireP from projet p, categories c where p.CodeC = c.CodeC and p.TitreP LIKE '%$mot%' order by p.CodeP DESC";
        }

        $req = $this->_bdd->query($query);

        //var_dump($req);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $projet = new projet([]);


                $projet->setTitreA($datas['TitreP']);

                $projet->setDatePublicationA($datas['DateButoireP']);


                $projets[] = ['projet' => $projet, 'photo' => $datas['PhotoC']];
            }
        } else {
            return $vide;
        }


        return $projets;

        $req->closeCursor();
    }

    public function selectProjetEtPhotoAccueil($pType, $sEmail, $sType, $gPro, $gPerso, $mot) {

        $vide = '';
        $test = "";
        if ($sEmail != NULL and $sType != NULL) {
            $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '{$sType}' or a.TypeA = 'Pro et Perso') order by a.CodeA DESC";
        } elseif ($sEmail == NULL and $gPro != NULL) {
            $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = 'Pro' or a.TypeA = 'Pro et Perso') order by a.CodeA DESC";
        } elseif ($sEmail == NULL and $gPerso != NULL) {
            $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC  from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = 'Perso' or a.TypeA = 'Pro et Perso') order by a.CodeA DESC";
        } else {
            $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC order by a.CodeA DESC";
        }

        if ($mot != NULL) { /* Recherche par mot clé */
            $mot = htmlspecialchars($_GET['motB']);
            if ($sEmail != NULL and $sType != NULL) {
                $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.TitreA LIKE '%$mot%' and a.TypeA = '{$sType}' order by a.CodeA DESC";
            } else {
                $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.TitreA LIKE '%$mot%' order by a.CodeA DESC";
            }
        }

        $req = $this->_bdd->query($query);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $atelier = new atelier([]);

                $atelier->setCodeA($datas['CodeA']);
                $atelier->setVisibiliteA($datas['VisibiliteA']);
                $atelier->setTitreA($datas['TitreA']);
                $atelier->setDescriptionA($datas['DescriptionA']);
                $atelier->setDateA($datas['DateA']);
                $atelier->setLieuA($datas['LieuA']);
                $atelier->setNombreA($datas['NombreA']);
                $atelier->setDatePublicationA($datas['DatePublicationA']);
                $atelier->setURL($datas['URL']);
                $atelier->setPlusA($datas['PlusA']);

                $atelier->setTypeA($datas['TypeA']);

                $ateliers[] = ['atelier' => $atelier, 'photo' => $datas['PhotoC']];
            }
        }else {
            return $vide;
        }




        return $ateliers;

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