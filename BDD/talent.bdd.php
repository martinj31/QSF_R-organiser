<?php

require('CLASS/TalentClass.php');

//use '../CLASS/BesoinClass.php';

class talentBDD {
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

    public function selectTalentEtPhoto($pCategorie, $pType, $sEmail, $sType, $st, $mot) {

        $vide = '';
        $test = "";
        if ($sEmail != NULL) {
            if ($st != NULL) {                                            // Utilisateur connecté, sélectionné les catégories
                if ($sType != NULL) {                        // Utilisateur connecté, sélectionné les catégories, son type est Pro ou Perso
                    $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT =  '" . $sType . "' OR t.TypeT ='Pro et Perso') and t.CodeC in $st order by CodeT DESC";
                } else {                                                // Utilisateur connecté, sélectionné les catégories, son type est Pro et Perso
                    $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.CodeC in $st order by CodeT DESC";
                }
            } else {                                                    // Utilisateur connecté, n'a pas sélectionner les catégories
                if ($sType != NULL) {                        // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro ou Perso
                    $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '" . $sType . "' OR t.TypeT ='Pro et Perso') order by CodeT DESC";
                } else {                                                // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro et Perso
                    $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC order by CodeT DESC";
                }
            }
        } else {
            if ($pType != NULL && $pCategorie != NULL) { // V-si un visiteur choisit les deux filtres
                $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '" . $pType . "' OR t.TypeT ='Pro et Perso') and t.CodeC in $st order by CodeT DESC";
            } elseif ($pType != NULL) {  // V-si un visiteur choisit filtre type
                $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '" . $pType . "'  OR t.TypeT ='Pro et Perso') order by CodeT DESC";
            } elseif ($pCategorie != NULL) { // V-si un visiteur choisit filtre categorie
                $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.CodeC in $st order by CodeT DESC";
            } else {  // V-si un visiteur rien choisit 
                $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC order by CodeT DESC";
            }
        }


        if ($mot != NULL) { /* Recherche par mot clé */
            $mot = htmlspecialchars($mot);
            if ($sEmail != NULL and $sType != NULL) {
                $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT LIKE %'" . $mot . "'% and t.TypeT = '" . $sType . "' order by t.CodeT DESC";
            } else {
                $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT LIKE %'" . $mot . "'% order by t.CodeT DESC";
            }
        }

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $talent = new talent([]);

                $talent->setCodeT($datas['CodeT']);
                $talent->setVisibiliteT($datas['VisibiliteT']);
                $talent->setTitreT($datas['TitreT']);

                $talent->setTypeT($datas['TypeT']);

                $talents[] = ['talent' => $talent, 'photo' => $datas['PhotoC']];
            }
        } else {
            return $vide;
        }


        return $talents;

        $req->closeCursor();
    }

    public function selectTalentByUser($usercode) {
        
        $vide = '';
        $test = "";
        $talents = [];
        $query = " select t.ReponseT, t.VisibiliteT, t.CodeT, t.TitreT, t.DatePublicationT, c.PhotoC from categories c, talents t, proposer p where p.CodeT = t.CodeT and c.CodeC = t.CodeC and p.CodeU = {$usercode} order by t.CodeT DESC";
        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $talent = new talent([]);
                $talent->setReponseT($datas['ReponseT']);
                $talent->setCodeT($datas['CodeT']);
                $talent->setVisibiliteT($datas['VisibiliteT']);
                $talent->setDatePublicationT($datas['DatePublicationT']);

                $talent->setTitreT($datas['TitreT']);




                $talents[] = ['talent' => $talent, 'photo' => $datas['PhotoC']];
            }
        } else {
            return $vide;
        }


        return $talents;

        $req->closeCursor();
    }

    //Select l'id du dernier
    public function idLastTalent() {  //fonction pour afficher les information d'un carte besoin
        $req = $this->_bdd->query("select CodeT from talents order by CodeT DESC limit 1");


        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            return $datas['CodeT'];
        }



        $req->closeCursor();
    }

    //INSERT INTO proposer(CodeU,CodeT) VALUES(?,?)
    //Liaison User / Talent dans a table saisir
    public function proposerTalentEtUser($usercode, $codet) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO proposer
                                             SET CodeU = :CodeU,
                                                 CodeT = :CodeT
                                    ');

        $req->bindValue(':CodeU', $usercode, PDO::PARAM_INT);
        $req->bindValue(':CodeT', $codet, PDO::PARAM_INT);

        return $req->execute();



        $req->closeCursor();
    }

    public function selectTalentX($T) {

        $vide = '';
        $test = "";
        $query = "select t.CodeT, t.TypeT, t.VisibiliteT, t.TitreT, c.CodeC, c.PhotoC, c.NomC, t.DatePublicationT, t.DescriptionT from talents t, categories c where t.CodeC = c.CodeC and t.CodeT = '$T' ";



        $req = $this->_bdd->query($query);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $talent = new talent([]);

                $talent->setCodeT($datas['CodeT']);
                $talent->setVisibiliteT($datas['VisibiliteT']);
                $talent->setDatePublicationT($datas['DatePublicationT']);
                $talent->setDescriptionT($datas['DescriptionT']);
                $talent->setTitreT($datas['TitreT']);
                $talent->setCodeC($datas['CodeC']);
                $talent->setTypeT($datas['TypeT']);

                $talents[] = ['talent' => $talent, 'photo' => $datas['PhotoC'], 'nom' => $datas['NomC']];
            }
        } else {
            return $vide;
        }



        return $talents;

        $req->closeCursor();
    }
    
    
    
    public function selectMailTalent($T) {

        $vide = '';
        $test = "";
        $query = "select t.CodeT, p.CodeU, t.TitreT from talents as t, proposer as p where t.CodeT = $T and t.CodeT = p.CodeT";



        $req = $this->_bdd->query($query);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $talent = new talent([]);

                $talent->setCodeT($datas['CodeT']);
               
                $talent->setTitreT($datas['TitreT']);
                

                $talents[] = ['talent' => $talent, 'CodeU' => $datas['CodeU']];
            }
        } else {
            return $vide;
        }



        return $talents;

        $req->closeCursor();
    }
    
    
    
    public function selectAllTalents() {

        $vide = '';
        $talents = [];

        $req = $this->_bdd->query("select * from talents ");


        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
                $talents[] = new talent($datas);
            }
        } else {
            return $vide;
        }




        return $talents;

        $req->closeCursor();
    }
    
    
    
     public function selectTalentSearch($cartet) {

        $vide = '';
        $talents = [];

        $req = $this->_bdd->query("select * from talents where ( TitreT LIKE '%$cartet%' or DescriptionT LIKE '%$cartet%' ) order by CodeT DESC");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {
           
                $talents[] = new talent($datas);
            
        } else {
            return $vide;
        }




        return $talents;

        $req->closeCursor();
    }
    
    //Update Visible
    public function UpdateReponseT($CodeT) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE talents SET ReponseT = ReponseT - 1 WHERE CodeT = :CodeT');

        $req->bindValue(':CodeT', $CodeT, PDO::PARAM_INT);


        return $req->execute();



        $req->closeCursor();
    }
    
    
    public function UpdateReponseTAugment($CodeT) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE talents SET ReponseT = ReponseT + 1 WHERE CodeT = :CodeT');

        $req->bindValue(':CodeT', $CodeT, PDO::PARAM_INT);


        return $req->execute();



        $req->closeCursor();
    }

    

    public function addTalent(talent $talent) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO talents
                                             SET TitreT = :TitreT,
                                                 DescriptionT = :DescriptionT,
                                                 TypeT     = :TypeT,
                                                 CodeC = :CodeC
                                    ');

        $req->bindValue(':TitreT', $talent->getTitreT(), PDO::PARAM_STR);
        $req->bindValue(':DescriptionT', $talent->getDescriptionT(), PDO::PARAM_STR);
        $req->bindValue(':TypeT', $talent->getTypeT(), PDO::PARAM_STR);
        $req->bindValue(':CodeC', $talent->getCodeC(), PDO::PARAM_INT);

        return $req->execute();



        $req->closeCursor();
    }

    public function selectTalenttEtPhotoAccueil($pType, $sEmail, $sType, $gPro, $gPerso, $mot) {

        $vide = '';
        $test = "";
        if ($sEmail != NULL and $sType != NULL) {
            $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '{$sType}' or t.TypeT = 'Pro et Perso') order by t.CodeT DESC";
        } elseif ($sEmail == NULL and $gPro != NULL) {
            $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = 'Pro' or t.TypeT = 'Pro et Perso') order by t.CodeT DESC";
        } elseif ($sEmail == NULL and $gPerso != NULL) {
            $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = 'Perso' or t.TypeT = 'Pro et Perso') order by t.CodeT DESC";
        } else {
            $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC order by t.CodeT DESC";
        }

        if ($mot != NULL) { /* Recherche par mot clé */
            $mot = htmlspecialchars($_GET['motB']);
            if ($sEmail != NULL and $sType != NULL) {
                $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT LIKE '%$mot%' and t.TypeT = '{$sType}' order by t.CodeT DESC";
            } else {
                $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT LIKE '%$mot%' order by t.CodeT DESC";
            }
        }

        $req = $this->_bdd->query($query);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $talent = new talent([]);

                $talent->setCodeT($datas['CodeT']);
                $talent->setVisibiliteT($datas['VisibiliteT']);
                $talent->setTitreT($datas['TitreT']);

                $talent->setTypeT($datas['TypeT']);

                $talents[] = ['talent' => $talent, 'photo' => $datas['PhotoC']];
            }
        } else {
            return $vide;
        }



        return $talents;

        $req->closeCursor();
    }
    
    
    //le (user ou admin) veut que cette carte ne soit plus visible 
    public function userUpdateTalentNotVisible($CodeT) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE talents SET VisibiliteT = 0 WHERE CodeT = :CodeT ');

        $req->bindValue(':CodeT', $CodeT, PDO::PARAM_INT);


        return $req->execute();



        $req->closeCursor();
    }
    
    
    //le (user ou admin) veut que cette carte ne soit plus visible 
    public function userUpdateTalentVisible($CodeT) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE talents 
                                        SET VisibiliteT = 1 
                                    WHERE CodeT = :CodeT ');

        $req->bindValue(':CodeT', $CodeT, PDO::PARAM_INT);


        return $req->execute();


        $req->closeCursor();
    }
    
    
    //Select l'email et le titre en fonction de l'id du talent
    public function saisirEmailEtTitreTalent($CodeT) {

        $talentTab = [];
        $req = $this->_bdd->query("SELECT u.Email, t.TitreT FROM utilisateurs u, proposer p, talents t WHERE u.CodeU = p.CodeU and p.CodeT = t.CodeT and p.CodeT = $CodeT");

        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            $talentTab[] = ['Email' => $datas['Email'], 'Titre' => $datas['TitreT']];
        }
        return $talentTab;

        $req->closeCursor();
    }
    

    public function updateTalent(talent $talent) {
        $req = $this->_bdd->prepare('UPDATE talents
                                        SET CodeT = :CodeT,
                                            TitreT = :TitreT,
                                            DescriptionT = :DescriptionT,
                                            TypeT = :TypeT,
                                            CodeC = :CodeC
                                        WHERE CodeT = :CodeT
                                    ');

        // var_dump($talent);
        $req->bindValue(':TitreT', $talent->getTitreT(), PDO::PARAM_STR);
        $req->bindValue(':DescriptionT', $talent->getDescriptionT(), PDO::PARAM_STR);
        $req->bindValue(':TypeT', $talent->getTypeT(), PDO::PARAM_STR);
        $req->bindValue(':CodeC', $talent->getCodeC(), PDO::PARAM_INT);
        $req->bindValue(':CodeT', $talent->getCodeT(), PDO::PARAM_INT);




        $req->execute();

        $req->closeCursor();
    }
    
    
    //UPDATE talents INNER JOIN proposer ON talents.CodeT = proposer.CodeT SET talents.VisibiliteT = 0 WHERE proposer.CodeU = ?
    public function updateTalentUserDeleting($id) {
        $req = $this->_bdd->prepare('UPDATE talents
                                        INNER JOIN proposer ON talents.CodeT = proposer.CodeT SET
                                                 talents.Visibilite = 0
                                    WHERE proposer.CodeU =:id
                                    ');

        
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();

       
        $req->closeCursor();
    }
    
    //Update Visible
    public function updateVisible() {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE besoins SET VisibiliteB = 0 WHERE CURDATE() > DateButoireB" ');

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