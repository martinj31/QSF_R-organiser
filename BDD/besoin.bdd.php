<?php

require('../../CLASS/BesoinClass.php');

//use '../CLASS/BesoinClass.php';

class besoinBDD {
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

    /*
     * $stmt = mysqli_prepare($session, "INSERT INTO besoins(TitreB,DescriptionB,DateButoireB,DatePublicationB,TypeB,CodeC) VALUES(?,?,?,?,?,?)");  //insérer un nouveau besoin dans le table besoins
      mysqli_stmt_bind_param($stmt, 'sssssi', $Titre, $Description, $DateButoire, $DatePublicationB, $Type, $Categorie);
     */

    public function addBesoins(besoin $besoin) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO besoins
                                             SET TitreB = :TitreB,
                                                 DescriptionB = :DescriptionB,
                                                 DateButoireB     = :DateButoireB,
                                                 TypeB     = :TypeB,
                                                 CodeC = :CodeC
                                    ');

        $req->bindValue(':TitreB', $besoin->getTitreB(), PDO::PARAM_STR);
        $req->bindValue(':DescriptionB', $besoin->getDescriptionB(), PDO::PARAM_STR);
        $req->bindValue(':DateButoireB', $besoin->getDateButoireB(), PDO::PARAM_STR);
        $req->bindValue(':TypeB', $besoin->getTypeB(), PDO::PARAM_STR);
        $req->bindValue(':CodeC', $besoin->getCodeC(), PDO::PARAM_INT);

        return $req->execute();



        $req->closeCursor();
    }

    //Update Visible
    public function UpdateVisible() {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE besoins SET VisibiliteB = 0 WHERE CURDATE() > DateButoireB');




        return $req->execute();



        $req->closeCursor();
    }

    //Update Visible
    public function UpdateReponseB($CodeB) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE besoins SET ReponseB = ReponseB - 1 WHERE CodeB = :CodeB');

        $req->bindValue(':CodeB', $CodeB, PDO::PARAM_INT);


        return $req->execute();



        $req->closeCursor();
    }
    
    
    public function UpdateReponseBAugment($CodeB) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE besoins SET ReponseB = ReponseB + 1 WHERE CodeB = :CodeB');

        $req->bindValue(':CodeB', $CodeB, PDO::PARAM_INT);


        return $req->execute();



        $req->closeCursor();
    }

    public function UpdateNombre($CodeB) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('update besoins set Nombre = Nombre + 1 where CodeB = :CodeB');

        $req->bindValue(':CodeB', $CodeB, PDO::PARAM_INT);


        return $req->execute();



        $req->closeCursor();
    }

    //le user veut que cette carte soit visible 
    public function userUpdateBesoinVisible($CodeB, $VisibiliteB) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE besoins SET VisibiliteB = :VisibiliteB WHERE CodeB = :CodeB ');

        $req->bindValue(':CodeB', $CodeB, PDO::PARAM_INT);
        $req->bindValue(':VisibiliteB', $VisibiliteB, PDO::PARAM_INT);

        return $req->execute();



        $req->closeCursor();
    }

    //Liaison User / Besoin dans a table saisir
    public function saisirBesoinEtUser($usercode, $codeb) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO saisir
                                             SET CodeU = :CodeU,
                                                 CodeB = :CodeB
                                    ');


        $req->bindValue(':CodeU', $usercode, PDO::PARAM_INT);
        $req->bindValue(':CodeB', $codeb, PDO::PARAM_INT);

        return $req->execute();



        $req->closeCursor();
    }

    
    public function selectBesoinSearch($carteb) {

        $vide = '';
        $besoins = [];

        $req = $this->_bdd->query("select * from besoins where VisibiliteB = 1 and ( TitreB LIKE '%$carteb%' or DescriptionB LIKE '%$carteb%' ) order by CodeB DESC");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            $besoins[] = new besoin($datas);
        } else {
            return $vide;
        }

        return $besoins;

        $req->closeCursor();
    }

    public function selectAllBesoins() {

        $vide = '';
        $besoins = [];

        $req = $this->_bdd->query("select * from besoins ");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
                $besoins[] = new besoin($datas);
            }
        } else {
            return $vide;
        }

        return $besoins;

        $req->closeCursor();
    }

    public function deleteBesoins($id) {
        $this->_bdd->exec('DELETE FROM besoins WHERE id = ' . $id);
    }

    public function updateBesoin(besoin $besoin) {
        $req = $this->_bdd->prepare('UPDATE besoins
                                        SET TitreB = :TitreB,
                                                 DescriptionB = :DescriptionB,
                                                 DateButoireB = :DateButoireB,
                                                 TypeB = :TypeB,
                                                 CodeC = :CodeC
                                    WHERE CodeB = :CodeB
                                    ');

        $req->bindValue(':TitreB', $besoin->getTitreB(), PDO::PARAM_STR);
        $req->bindValue(':DescriptionB', $besoin->getDescriptionB(), PDO::PARAM_STR);
        $req->bindValue(':DateButoireB', $besoin->getDateButoireB(), PDO::PARAM_STR);
        $req->bindValue(':TypeB', $besoin->getTypeB(), PDO::PARAM_STR);
        $req->bindValue(':CodeC', $besoin->getCodeC(), PDO::PARAM_INT);
        $req->bindValue(':CodeB', $besoin->getCodeB(), PDO::PARAM_INT);

        $req->execute();


        $req->closeCursor();
    }

    //UPDATE besoins INNER JOIN saisir ON besoins.CodeB = saisir.CodeB SET besoins.VisibiliteB = 0 WHERE saisir.CodeU = ?
    public function updateBesoinUserDeleting($id) {
        $req = $this->_bdd->prepare('UPDATE besoins
                                        INNER JOIN saisir ON besoins.CodeB = saisir.CodeB SET
                                                 besoins.VisibiliteB = 0
                                    WHERE saisir.CodeU =:id
                                    ');


        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();


        $req->closeCursor();
    }

    //T = ID de besoin
    public function un_besoinx($T) {  //fonction pour afficher les information d'un carte besoin
        $vide = '';
        $T = (int) $T;

        $req = $this->_bdd->query("select b.CodeB, b.TypeB, b.VisibiliteB, b.TitreB, c.CodeC, c.PhotoC, c.NomC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ");
        //$query = "select b.CodeB, b.TypeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ";
        //$datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $besoins = new besoin([]);
                $besoins->setCodeB($datas['CodeB']);
                $besoins->setVisibiliteB($datas['VisibiliteB']);
                $besoins->setTitreB($datas['TitreB']);
                $besoins->setDescriptionB($datas['DescriptionB']);
                $besoins->setDateButoireB($datas['DateButoireB']);
                $besoins->setDatePublicationB($datas['DatePublicationB']);
                $besoins->setTypeB($datas['TypeB']);
                $besoins->setCodeC($datas['CodeC']);

                $besoinsTab[] = ['besoin' => $besoins, 'photo' => $datas['PhotoC'], 'nom' => $datas['NomC']];
            }
        } else {
            return $vide;
        }



        return $besoinsTab;

        $req->closeCursor();
    }

    //Select l'id du dernier
    public function idLastBesoin() {  //fonction pour afficher les information d'un carte besoin
        $req = $this->_bdd->query("select CodeB from besoins order by CodeB DESC limit 1");


        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            return $datas['CodeB'];
        }

        $req->closeCursor();
    }

    /*
     * $sType = {$_SESSION['type']}
     * $sEmail = $_SESSION['email']
     * $st = liste de categorie
     * $pType = $_POST['type']
     * $pCategorie = $_POST['categorie']
     * $mot = $_GET['mot'] 
     */

    public function selectBesoinsEtPhoto($pCategorie, $pType, $sEmail, $sType, $st, $mot) {

        $vide = '';
        $test = "";
        if ($sEmail != NULL) {
            if ($st != NULL) {                                            // Utilisateur connecté, sélectionné les catégories
                if ($sType != NULL) {                        // Utilisateur connecté, sélectionné les catégories, son type est Pro ou Perso
                    $query = "select b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = '" . $sType . "' OR b.TypeB ='Pro et Perso') and b.CodeC in $st order by CodeB DESC";
                } else {                                                // Utilisateur connecté, sélectionné les catégories, son type est Pro et Perso
                    $query = "select b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeC in '" . $st . "' order by CodeB DESC";
                }
            } else {                                                    // Utilisateur connecté, n'a pas sélectionner les catégories
                if ($sType != NULL) {                        // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro ou Perso
                    $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB ='" . $sType . "' OR b.TypeB ='Pro et Perso') order by CodeB DESC";
                } else {                                                // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro et Perso
                    $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC order by CodeB DESC";
                }
            }
        } else {
            if ($pType != NULL && $pCategorie != NULL) { // V-si un visiteur choisit les deux filtres
                $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = '" . $pType . "' OR b.TypeB ='Pro et Perso') and b.CodeC in '" . $st . "' order by CodeB DESC";
            } elseif ($pType != NULL) {  // V-si un visiteur choisit filtre type
                $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = '" . $pType . "' OR b.TypeB ='Pro et Perso') order by CodeB DESC";
            } elseif ($pCategorie != NULL) { // V-si un visiteur choisit filtre categorie
                $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeC in '" . $st . "' order by CodeB DESC";
            } else {  // V-si un visiteur rien choisit 
                $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC order by CodeB DESC";
            }
        }


        if ($mot != NULL) { /* Recherche par mot clé */
            $mot = htmlspecialchars($mot);
            if ($sEmail != NULL and $sType != NULL) {
                $query = "select b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.TitreB LIKE %'" . $mot . "'% and b.TypeB = '" . $sType . "' order by b.CodeB DESC";
            } else {
                $query = "select b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.TitreB LIKE %'" . $mot . "'% order by b.CodeB DESC";
            }
        }

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $besoin = new besoin([]);

                $besoin->setCodeB($datas['CodeB']);
                $besoin->setVisibiliteB($datas['VisibiliteB']);
                $besoin->setTitreB($datas['TitreB']);
                $besoin->setDateButoireB($datas['DateButoireB']);
                $besoin->setTypeB($datas['TypeB']);

                $besoins[] = ['besoin' => $besoin, 'photo' => $datas['PhotoC']];
            }
        } else {
            return $vide;
        }



        return $besoins;

        $req->closeCursor();
    }

    public function selectBesoinsEtPhotoAccueil($pType, $sEmail, $sType, $gPro, $gPerso, $mot) {

        $vide = '';
        $test = "";
        if ($sEmail != NULL && $sType != NULL) {
            $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = '{$pType}' OR b.TypeB ='Pro et Perso') order by CodeB DESC";
        } elseif ($sEmail == NULL && $gPro == "Pro") {
            $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = 'Pro' OR b.TypeB ='Pro et Perso') order by CodeB DESC";
        } elseif ($sEmail == NULL && $gPerso == "Perso") {
            $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = 'Perso' OR b.TypeB ='Pro et Perso') order by CodeB DESC";
        } else {
            $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC order by CodeB DESC";
        }

        if ($mot != NULL) { /* Recherche par mot clé */
            $mot = htmlspecialchars($mot);
            if ($sEmail != NULL and $sType != NULL) {
                $query = "select b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.TitreB LIKE '%$mot%' and b.TypeB = '{$pType}' order by b.CodeB DESC";
            } else {
                $query = "select b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.TitreB LIKE '%$mot%' order by b.CodeB DESC";
            }
        }

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $besoin = new besoin([]);

                $besoin->setCodeB($datas['CodeB']);
                $besoin->setVisibiliteB($datas['VisibiliteB']);
                $besoin->setTitreB($datas['TitreB']);
                $besoin->setDateButoireB($datas['DateButoireB']);
                $besoin->setTypeB($datas['TypeB']);

                $besoins[] = ['besoin' => $besoin, 'photo' => $datas['PhotoC']];
            }
        } else {
            return $vide;
        }


        return $besoins;

        $req->closeCursor();
    }

    //Select l'email et le titre en fonction de l'id de l'atelier
    public function saisirEmailEtTitreBesoin($CodeB) {

        $besoinTab = [];
        $req = $this->_bdd->query("SELECT u.Email, b.TitreB FROM utilisateurs u, saisir s, besoins b WHERE u.CodeU = s.CodeU and s.CodeB = b.CodeB and s.CodeB = $CodeB");


        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
            var_dump($datas);
            $besoinTab[] = ['Email' => $datas['Email'], 'Titre' => $datas['TitreB']];
        }
        return $besoinTab;

        $req->closeCursor();
    }

    public function selectBesoinsByUser($usercode) {

        $vide = '';
        $test = "";
        $besoins = [];
        $query = "select b.ReponseB, b.VisibiliteB, b.CodeB, b.TitreB, b.DescriptionB, b.DatePublicationB, b.DateButoireB, c.PhotoC from categories c, besoins b, saisir s where s.CodeB = b.CodeB and c.CodeC = b.CodeC and s.CodeU = {$usercode} order by b.CodeB DESC ";

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $besoin = new besoin([]);

                $besoin->setReponseB($datas['ReponseB']);
                $besoin->setCodeB($datas['CodeB']);
                $besoin->setVisibiliteB($datas['VisibiliteB']);
                $besoin->setTitreB($datas['TitreB']);
                $besoin->setDateButoireB($datas['DateButoireB']);
                $besoin->setDescriptionB($datas['DescriptionB']);
                // $besoin->setTypeB($datas['TypeB']);
                $besoin->setDatePublicationB($datas['DatePublicationB']);

                $besoins[] = ['besoin' => $besoin, 'photo' => $datas['PhotoC']];
            }
        } else {
            return $vide;
        }


        return $besoins;

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