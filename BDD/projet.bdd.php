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

    

    public function selectProjetEtPhoto($mot) {

        $projets = [];
        $vide = '';
        $query = "select p.TitreP, p.VisibiliteP, p.CodeP, p.DatePublicationP,  p.LieuP, c.PhotoC, p.DescriptionP, p.DateButoireP, p.TypeP from projets p, categories c where p.CodeC = c.CodeC order by CodeP DESC";

        if ($mot != NULL) { /* Recherche par mot clé */
            $mot = htmlspecialchars($mot);
            $query = "select p.TitreP, p.VisibiliteP, c.PhotoC, p.CodeP,  p.LieuP, p.DatePublicationP, p.DescriptionP, p.TypeP ,p.DateButoireP from projets p, categories c where p.CodeC = c.CodeC and p.TitreP LIKE '%$mot%' order by p.CodeP DESC";
        }

        $req = $this->_bdd->query($query);

        //var_dump($req);

        if ($req) { 
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $projet = new projet([]);


                $projet->setCodeP($datas['CodeP']);
                $projet->setVisibiliteP($datas['VisibiliteP']);
                $projet->setTitreP($datas['TitreP']);
                $projet->setLieuP($datas['LieuP']);
                $projet->setDescriptionP($datas['DescriptionP']);
                $projet->setDateButoireP($datas['DateButoireP']);
                $projet->setDatePublicationP($datas['DatePublicationP']);
                $projet->setTypeP($datas['TypeP']);

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
            $query = "select p.CodeP, p.TitreP, p.DescriptionP, p.DateButoireP, p.DatePublicationP,  p.LieuP, p.TypeP, p.VisibiliteP, c.PhotoC from projets p, categories c where p.CodeC = c.CodeC and (p.TypeP = '{$sType}' or p.TypeP = 'Pro et Perso') order by p.CodeP DESC";
        } elseif ($sEmail == NULL and $gPro != NULL) {
            $query = "select p.CodeP, p.TitreP, p.DescriptionP, p.DateButoireP, p.DatePublicationP,  p.LieuP,  p.TypeP, p.VisibiliteP, c.PhotoC from projets p, categories c where p.CodeC = c.CodeC and (p.TypeP = 'Pro' or p.TypeP = 'Pro et Perso') order by p.CodeP DESC";
        } elseif ($sEmail == NULL and $gPerso != NULL) {
            $query = "p.CodeP, p.TitreP, p.DescriptionP, p.DateButoireP, p.DatePublicationP,  p.LieuP,  p.TypeP, p.VisibiliteP, c.PhotoC from projets p, categories c where p.CodeC = c.CodeC and (p.TypeP = 'Perso' or p.TypeP = 'Pro et Perso') order by p.CodeP DESC";
        } else {
            $query = "p.CodeP, p.TitreP, p.DescriptionP, p.DateButoireP, p.DatePublicationP,  p.LieuP,  p.TypeP, p.VisibiliteP, c.PhotoC from projets p, categories c where p.CodeC = c.CodeC order by p.CodeP DESC";
        }

        if ($mot != NULL) { /* Recherche par mot clé */
            $mot = htmlspecialchars($_GET['motB']);
            if ($sEmail != NULL and $sType != NULL) {
                $query = "p.CodeP, p.TitreP, p.DescriptionP, p.DateButoireP, p.DatePublicationP,  p.LieuP,  p.TypeP, p.VisibiliteP, c.PhotoC from projets p, categories c where p.CodeC = c.CodeC and p.TitreP LIKE '%$mot%' and p.TypeP = '{$sType}' order by p.CodeP DESC";
            } else {
                $query = "p.CodeP, p.TitreP, p.DescriptionP, p.DateButoireP, p.DatePublicationP,  p.LieuP,  p.TypeP, p.VisibiliteP, c.PhotoC from projets p, categories c where p.CodeC = c.CodeC and p.TitreP LIKE '%$mot%' order by p.CodeP DESC";
            }
        }

        $req = $this->_bdd->query($query);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $projet = new projet([]);
                
                $projet->setCodeA($datas['CodeP']);
                $projet->setLieuP($datas['LieuP']);
                $projet->setVisibiliteA($datas['VisibiliteP']);
                $projet->setTitreA($datas['TitreP']);
                $projet->setDescriptionA($datas['DescriptionP']);
                $projet->setDateA($datas['DateButoireP']);
                $projet->setDatePublicationP($datas['DatePublicationP']);

                $projet->setTypeA($datas['TypeP']);

                $ateliers[] = ['projet' => $projet, 'photo' => $datas['PhotoC']];
            }
        }else {
            return $vide;
        }




        return $ateliers;

        $req->closeCursor();
    }
    
    
    public function addProjet(projet $projet) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO projets
                                             SET TitreP = :TitreP,
                                                 LieuP = :LieuP,
                                                 DescriptionP = :DescriptionP,
                                                 DateButoireP     = :DateButoireP,
                                                 typeP     = :typeP,
                                                 CodeC = :CodeC
                                    ');

        $req->bindValue(':TitreP', $projet->getTitreP(), PDO::PARAM_STR);
        $req->bindValue(':LieuP', $projet->getLieuP(), PDO::PARAM_STR);
        $req->bindValue(':DescriptionP', $projet->getDescriptionP(), PDO::PARAM_STR);
        $req->bindValue(':DateButoireP', $projet->getDateButoireP(), PDO::PARAM_STR);
        $req->bindValue(':typeP', $projet->getTypeP(), PDO::PARAM_STR);
        $req->bindValue(':CodeC', $projet->getCodeC(), PDO::PARAM_INT);

        
        
        return $req->execute();



        $req->closeCursor();
    }
    
    
    //Liaison User / Besoin dans a table saisir
    public function participerProjetEtUser($usercode, $codep, $rolep) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO participerp
                                             SET CodeU = :CodeU,
                                                 CodeP = :CodeP,
                                                 RoleP = :RoleP
                                    ');


        $req->bindValue(':CodeU', $usercode, PDO::PARAM_INT);
        $req->bindValue(':CodeP', $codep, PDO::PARAM_INT);
        $req->bindValue(':RoleP', $rolep, PDO::PARAM_STR);
        return $req->execute();



        $req->closeCursor();
    }
    
    
     //Select l'id du dernier
    public function idLastProjet() {  //fonction pour afficher les information d'un carte besoin
        $req = $this->_bdd->query("select CodeP from projets order by CodeP DESC limit 1");


        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            return $datas['CodeP'];
        }

        $req->closeCursor();
    }
    
    
    
    //T = ID de besoin
    public function un_projetx($T) {  //fonction pour afficher les information d'un carte besoin
        $vide = '';
        $T = (int) $T;
        $projetsTab = [];
        $req = $this->_bdd->query("select p.CodeP, p.TypeP, p.VisibiliteP, p.TitreP, p.LieuP, c.CodeC, c.PhotoC, c.NomC, p.DatePublicationP, p.DescriptionP, p.DateButoireP from projets p, categories c where p.CodeC = c.CodeC and p.CodeP = '$T' ");
        //$query = "select b.CodeB, b.TypeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ";
        //$datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $projets = new projet([]);
                $projets->setCodeP($datas['CodeP']);
                $projets->setLieuP($datas['LieuP']);
                $projets->setVisibiliteP($datas['VisibiliteP']);
                $projets->setTitreP($datas['TitreP']);
                $projets->setDescriptionP($datas['DescriptionP']);
                $projets->setDateButoireP($datas['DateButoireP']);
                $projets->setDatePublicationP($datas['DatePublicationP']);
                $projets->setTypeP($datas['TypeP']);
                $projets->setCodeC($datas['CodeC']);

                $projetsTab[] = ['projet' => $projets, 'photo' => $datas['PhotoC'], 'nom' => $datas['NomC']];
            }
        } else {
            return $vide;
        }

        

        return $projetsTab;

        $req->closeCursor();
    }
    
    
    public function selectProjetByUser($usercode) {

        $projets = [];
        $vide = '';
        $test = "";
        $query = "select p.CodeP, p.TitreP, p.DescriptionP, p.DateButoireP, p.LieuP, p.DatePublicationP, p.TypeP, p.VisibiliteP, c.PhotoC from categories c, projets p, participerp pp where pp.CodeP = p.CodeP and c.CodeC = p.CodeC and pp.CodeU = {$usercode} order by p.CodeP DESC ";

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $projet = new projet([]);

                $projet->setCodeP($datas['CodeP']);
                $projet->setVisibiliteP($datas['VisibiliteP']);
                $projet->setTitreP($datas['TitreP']);
                $projet->setDescriptionP($datas['DescriptionP']);
                $projet->setDateButoireP($datas['DateButoireP']);
                $projet->setLieuP($datas['LieuP']);
                $projet->setDatePublicationP($datas['DatePublicationP']);
                $projet->setTypeP($datas['TypeP']);

                $projets[] = ['projet' => $projet, 'photo' => $datas['PhotoC']];
            }
        } else {
            return $vide;
        }


        return $projets;

        $req->closeCursor();
    }
    
    
    
    //Select le role de l'user de l'atelier
    public function saisirRoleUserProjet($CodeP, $usercode) {


        $req = $this->_bdd->query("SELECT pp.RoleP FROM participerp pp, projets p WHERE $usercode = pp.CodeU and P.CodeP = P.CodeP and p.CodeP = $CodeP");



        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            return $datas['RoleP'];
        }



        $req->closeCursor();
    }
    
    //Liaison User / Atelier dans a table saisir
    public function participeraProjetEtUser($usercode, $codeA, $RoleA) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO participerp
                                             SET CodeU = :CodeU,
                                                 CodeP = :CodeP,
                                                 RoleP = :RoleP
                                    ');

        $req->bindValue(':CodeU', $usercode, PDO::PARAM_INT);
        $req->bindValue(':CodeP', $codeP, PDO::PARAM_INT);
        $req->bindValue(':RoleP', $RoleP, PDO::PARAM_STR);

        

        return $req->execute();



        $req->closeCursor();
    }

    
    
     public function updateProjet(projet $projet) {
        $req = $this->_bdd->prepare('UPDATE projets
                                        SET TitreP = :TitreP,
                                                 DescriptionP = :DescriptionP,
                                                 DateButoireP = :DateButoireP, 
                                                 LieuP = :LieuP,
                                                 TypeP = :TypeP,
                                                 CodeC = :CodeC
                                    WHERE CodeP = :CodeP
                                    ');

        $req->bindValue(':TitreP', $projet->getTitreP(), PDO::PARAM_STR);
        $req->bindValue(':DescriptionP', $projet->getDescriptionP(), PDO::PARAM_STR);
        $req->bindValue(':DateButoireP', $projet->getDateButoireP(), PDO::PARAM_STR);
        $req->bindValue(':LieuP', $projet->getLieuP(), PDO::PARAM_STR);
        $req->bindValue(':TypeP', $projet->getTypeP(), PDO::PARAM_STR);
        $req->bindValue(':CodeC', $projet->getCodeC(), PDO::PARAM_INT);
        $req->bindValue(':CodeP', $projet->getCodeP(), PDO::PARAM_INT);
       

        $req->execute();

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