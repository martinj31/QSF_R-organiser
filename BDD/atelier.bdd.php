<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../../CLASS/AtelierClass.php');



//use '../CLASS/BesoinClass.php';

class atelierBDD {
    /*
     * Attributs
     */

    private $_bdd;

    /*
     * Méthode de construction
     */

    public function __construct($bdd) {
        $this->setDb($bdd);
    }

    public function selectAtelierEtPhoto($pCategorie, $pType, $sEmail, $sType, $st, $mot) {

        $vide = '';
        $test = "";
        if ($sEmail != NULL) {
            if ($st != NULL) {                                            // Utilisateur connecté, sélectionné les catégories
                if ($sType != NULL) {                        // Utilisateur connecté, sélectionné les catégories, son type est Pro ou Perso
                    $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '" . $sType . "'  OR a.TypeA ='Pro et Perso') and a.CodeC in $st order by CodeA DESC";
                } else {                                                // Utilisateur connecté, sélectionné les catégories, son type est Pro et Perso
                    $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeC'" . $st . "' order by CodeA DESC";
                }
            } else {                                                    // Utilisateur connecté, n'a pas sélectionner les catégories
                if ($sType != NULL) {                        // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro ou Perso
                    $query = "select  a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '" . $sType . "'  OR a.TypeA ='Pro et Perso') order by CodeA DESC";
                } else {                                                // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro et Perso
                    $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC order by CodeA DESC";
                }
            }
        } else {
            if ($pType != NULL && $pCategorie != NULL) { // V-si un visiteur choisit les deux filtres
                $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '" . $pType . "' OR a.TypeA ='Pro et Perso') and a.CodeC in $st order by CodeA DESC";
            } elseif ($pType != NULL) {  // V-si un visiteur choisit filtre type
                $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA ='" . $pType . "' OR a.TypeA ='Pro et Perso') order by CodeA DESC";
            } elseif ($pCategorie != NULL) { // V-si un visiteur choisit filtre categorie
                $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeC in $st order by CodeA DESC";
            } else {  // V-si un visiteur rien choisit 
                $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC order by CodeA DESC";
            }
        }


        if ($mot != NULL) { /* Recherche par mot clé */
            $mot = htmlspecialchars($mot);
            if ($sEmail != NULL and $sType != NULL) {
                $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.TitreA LIKE  %'" . $mot . "'% and a.TypeA = '" . $sType . "' order by a.CodeA DESC";
            } else {
                $query = "select a.CodeA, a.TitreA, a.DescriptionA,a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.TitreA LIKE %'" . $mot . "'% order by a.CodeA DESC";
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
                $atelier->setDateDebutA($datas['DateDebutA']);
                $atelier->setDateFinA($datas['DateFinA']);
                $atelier->setLieuA($datas['LieuA']);
                $atelier->setNombreA($datas['NombreA']);
                $atelier->setDatePublicationA($datas['DatePublicationA']);
                $atelier->setURL($datas['URL']);
                $atelier->setPlusA($datas['PlusA']);
                $atelier->setHoraireA($datas['HoraireA']);
                $atelier->setTypeA($datas['TypeA']);

                $ateliers[] = ['atelier' => $atelier, 'photo' => $datas['PhotoC']];
            }
        } else {

            return $vide;
        }


        return $ateliers;

        $req->closeCursor();
    }

    public function selectAllAteliers() {

        $vide = '';
        $ateliers = [];

        $req = $this->_bdd->query("select * from ateliers ");


        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
                $ateliers[] = new atelier($datas);
            }
        } else {
            return $vide;
        }




        return $ateliers;

        $req->closeCursor();
    }
    
    
    public function MailAtelierCommence() {

        $atelierTab = selectMailAtelierCommence();
        
        if(!empty($atelierTab)){
            
            $req = $this->_bdd->prepare('UPDATE ateliers SET MailCommence = 1 WHERE CURDATE() > DATE_SUB(DateDebutA  INTERVAL 1 DAY)  and MailCommence = 0');

            $req->execute();
        }
        
       
        
        
        return $atelierTab;

        $req->closeCursor();
    }
    
    
    public function selectMailAtelierCommence() {

        $vide = '';
        $ateliers = [];

        $req = $this->_bdd->query("select * from ateliers where CURDATE() > DATE_SUB(DateDebutA  INTERVAL 1 DAY)  and MailCommence = 0");

        

        if ($req) {
            $datas = $req->fetch(PDO::FETCH_ASSOC); 
            $ateliers[] = new atelier($datas);
        } else {
            return $vide;
        }




        return $ateliers;

        $req->closeCursor();
    }
    
    

    public function selectAtelierSearch($cartea) {

        $vide = '';
        $ateliers = [];

        $req = $this->_bdd->query("select * from ateliers where ( TitreA LIKE '%$cartea%' or DescriptionA LIKE '%$cartea%' ) order by CodeA DESC");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            $ateliers[] = new atelier($datas);
        } else {
            return $vide;
        }




        return $ateliers;

        $req->closeCursor();
    }

    public function selectAtelierByUser($usercode) {

        $ateliers = [];
        $vide = '';
        $test = "";
        $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from categories c, ateliers a, participera p where p.CodeA = a.CodeA and c.CodeC = a.CodeC and p.CodeU = {$usercode} order by a.CodeA DESC ";

        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $atelier = new atelier([]);

                $atelier->setCodeA($datas['CodeA']);
                $atelier->setVisibiliteA($datas['VisibiliteA']);
                $atelier->setTitreA($datas['TitreA']);
                $atelier->setDescriptionA($datas['DescriptionA']);
                $atelier->setDateDebutA($datas['DateDebutA']);
                $atelier->setDateFinA($datas['DateFinA']);
                $atelier->setHoraireA($datas['HoraireA']);
                $atelier->setLieuA($datas['LieuA']);
                $atelier->setNombreA($datas['NombreA']);
                $atelier->setDatePublicationA($datas['DatePublicationA']);
                $atelier->setURL($datas['URL']);
                $atelier->setPlusA($datas['PlusA']);

                $atelier->setTypeA($datas['TypeA']);

                $ateliers[] = ['atelier' => $atelier, 'photo' => $datas['PhotoC']];
            }
        } else {
            return $vide;
        }


        return $ateliers;

        $req->closeCursor();
    }

    public function selectAtelierX($T) {


        $vide = '';

        $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.CodeC, c.PhotoC, c.NomC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeA = '$T' ";



        $req = $this->_bdd->query($query);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $atelier = new atelier([]);

                $atelier->setCodeA($datas['CodeA']);
                $atelier->setVisibiliteA($datas['VisibiliteA']);
                $atelier->setTitreA($datas['TitreA']);
                $atelier->setDescriptionA($datas['DescriptionA']);
                $atelier->setDateDebutA($datas['DateDebutA']);
                $atelier->setDateFinA($datas['DateFinA']);
                $atelier->setHoraireA($datas['HoraireA']);
                $atelier->setLieuA($datas['LieuA']);
                $atelier->setNombreA($datas['NombreA']);
                $atelier->setDatePublicationA($datas['DatePublicationA']);
                $atelier->setURL($datas['URL']);
                $atelier->setPlusA($datas['PlusA']);
                $atelier->setCodeC($datas['CodeC']);
                $atelier->setTypeA($datas['TypeA']);

                $ateliers[] = ['atelier' => $atelier, 'photo' => $datas['PhotoC'], 'nomPhoto' => $datas['NomC']];
            }
        } else {
            return $vide;
        }



        return $ateliers;

        $req->closeCursor();
    }

    public function selectAtelierEtPhotoAccueil($pType, $sEmail, $sType, $gPro, $gPerso, $mot) {


        $vide = '';
        if ($sEmail != NULL and $sType != NULL) {
            $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '{$sType}' or a.TypeA = 'Pro et Perso') order by a.CodeA DESC";
        } elseif ($sEmail == NULL and $gPro != NULL) {
            $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = 'Pro' or a.TypeA = 'Pro et Perso') order by a.CodeA DESC";
        } elseif ($sEmail == NULL and $gPerso != NULL) {
            $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC  from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = 'Perso' or a.TypeA = 'Pro et Perso') order by a.CodeA DESC";
        } else {
            $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC order by a.CodeA DESC";
        }

        if ($mot != NULL) { /* Recherche par mot clé */
            $mot = htmlspecialchars($_GET['motB']);
            if ($sEmail != NULL and $sType != NULL) {
                $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.TitreA LIKE '%$mot%' and a.TypeA = '{$sType}' order by a.CodeA DESC";
            } else {
                $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateFinA, a.HoraireA, a.DateDebutA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.TitreA LIKE '%$mot%' order by a.CodeA DESC";
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
                $atelier->setDateDebutA($datas['DateDebutA']);
                $atelier->setHoraireA($datas['HoraireA']);
                $atelier->setDateFinA($datas['DateFinA']);
                $atelier->setLieuA($datas['LieuA']);
                $atelier->setNombreA($datas['NombreA']);
                $atelier->setDatePublicationA($datas['DatePublicationA']);
                $atelier->setURL($datas['URL']);
                $atelier->setPlusA($datas['PlusA']);

                $atelier->setTypeA($datas['TypeA']);

                $ateliers[] = ['atelier' => $atelier, 'photo' => $datas['PhotoC']];
            }
        } else {
            return $vide;
        }



        return $ateliers;

        $req->closeCursor();
    }

    //Select l'id du dernier
    public function idLastAtelier() {  //fonction pour afficher les information d'un carte besoin
        $req = $this->_bdd->query("select CodeA from ateliers order by CodeA DESC limit 1");


        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            return $datas['CodeA'];
        }



        $req->closeCursor();
    }

//INSERT INTO ateliers SET TitreA = "etelier Test 1", 
//DescriptionA = "le testimportant", DateA = "du 16 au 18 ", LieuA = "6.16", NombreA = 15, PlusA = "", TypeA = "Pro et Perso", CodeC= 2
//"INSERT INTO ateliers(TitreA,DescriptionA,DateA,LieuA,NombreA,DatePublicationA,PlusA,TypeA,CodeC) VALUES(?,?,?,?,?,?,?,?,?)"); 
    public function addAtelier(atelier $atelier) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO ateliers
                                             SET TitreA = :TitreA,
                                                 DescriptionA = :DescriptionA,
                                                 DateFinA = :DateFinA, 
                                                 DateDebutA = :DateDebutA,
                                                 HoraireA = :HoraireA,
                                                 LieuA = :LieuA,
                                                 NombreA = :NombreA,
                                                 PlusA = :PlusA,
                                                 TypeA = :TypeA,
                                                 CodeC = :CodeC
                                    ');

        $req->bindValue(':TitreA', $atelier->getTitreA(), PDO::PARAM_STR);
        $req->bindValue(':DescriptionA', $atelier->getDescriptionA(), PDO::PARAM_STR);
        $req->bindValue(':DateFinA', $atelier->getDateFinA(), PDO::PARAM_STR);
        $req->bindValue(':DateDebutA', $atelier->getDateDebutA(), PDO::PARAM_STR);
        $req->bindValue(':HoraireA', $atelier->getHoraireA(), PDO::PARAM_STR);
        $req->bindValue(':LieuA', $atelier->getLieuA(), PDO::PARAM_STR);
        $req->bindValue(':NombreA', $atelier->getNombreA(), PDO::PARAM_INT);
        $req->bindValue(':PlusA', $atelier->getPlusA(), PDO::PARAM_STR);
        $req->bindValue(':TypeA', $atelier->getTypeA(), PDO::PARAM_STR);
        $req->bindValue(':CodeC', $atelier->getCodeC(), PDO::PARAM_INT);

        echo $atelier->getCodeC();


        return $req->execute();

        $req->closeCursor();
    }

    //le user veut que cette carte ne soit plus visible 
    public function userUpdateAtelierVisible($CodeA) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE ateliers 
                                        SET VisibiliteA = :VisibiliteA 
                                    WHERE CodeA = :CodeA');


        $req->bindValue(':CodeA', (int) $CodeA, PDO::PARAM_INT);
        $req->bindValue(':VisibiliteA', 0, PDO::PARAM_INT);


        return $req->execute();



        $req->closeCursor();
    }

    //Liaison User / Atelier dans a table saisir
    public function participeraAtelierEtUser($usercode, $codeA, $RoleA) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO participera
                                             SET CodeU = :CodeU,
                                                 CodeA = :CodeA,
                                                 RoleA = :RoleA
                                    ');

        $req->bindValue(':CodeU', $usercode, PDO::PARAM_INT);
        $req->bindValue(':CodeA', $codeA, PDO::PARAM_INT);
        $req->bindValue(':RoleA', $RoleA, PDO::PARAM_STR);

        

        return $req->execute();



        $req->closeCursor();
    }

    //Select l'email et le titre en fonction de l'id de l'atelier
    public function nombreParticipantVSNBRMax($CodeA) {


        $req = $this->_bdd->query("SELECT a.NombreA, COUNT(p.CodeA) as nbrParticipant FROM participera p, ateliers a WHERE p.RoleA = 'participant' and p.CodeA = a.CodeA and p.CodeA = $CodeA");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($datas['NombreA'] > $datas['nbrParticipant']) {
            return true;
        }else{
            return false;
        }

        $req->closeCursor();
    }

    //Select le role de l'user de l'atelier
    public function saisirRoleUserAtelier($CodeA, $usercode) {


        $req = $this->_bdd->query("SELECT p.RoleA FROM participera p, ateliers a WHERE $usercode = p.CodeU and p.CodeA = a.CodeA and p.CodeA = $CodeA");



        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            return $datas['RoleA'];
        }



        $req->closeCursor();
    }

    //delete la liaison du user et le projet dans participera
    public function DesinscriptionAtelier($CodeA, $usercode) {


        $req = $this->_bdd->query("DELETE FROM participera WHERE CodeU = $usercode and CodeA = $CodeA");



        return $req;




        $req->closeCursor();
    }

    //Select l'email et le titre en fonction de l'id de l'atelier
    public function saisirEmailEtTitreAtelier($CodeA) {

        $atelierTab = [];
        $req = $this->_bdd->query("SELECT u.Email, a.TitreA FROM utilisateurs u, participera p, ateliers a WHERE u.CodeU = p.CodeU and p.CodeA = a.CodeA and p.CodeA = $CodeA");


        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            $atelierTab[] = ['Email' => $datas['Email'], 'Titre' => $datas['TitreA']];
        }
        return $atelierTab;

        $req->closeCursor();
    }

    //le user veut que cette carte  soit  visible 
    public function userUpdateAtelierVisibleAndURL($CodeA, $URL) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE ateliers 
                                        SET VisibiliteA = :VisibiliteA,
                                            URL = :URL
                                    WHERE CodeA = :CodeA');

        $req->bindValue(':CodeA', $CodeA, PDO::PARAM_INT);
        $req->bindValue(':VisibiliteA', 1, PDO::PARAM_INT);
        $req->bindValue(':URL', $URL, PDO::PARAM_STR);


        return $req->execute();



        $req->closeCursor();
    }
    
    
    //le user veut que cette carte  soit  visible 
    public function userUpdateAtelierVisibleOui($CodeA) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE ateliers 
                                        SET VisibiliteA = :VisibiliteA
                                    WHERE CodeA = :CodeA');

        $req->bindValue(':CodeA', $CodeA, PDO::PARAM_INT);
        $req->bindValue(':VisibiliteA', 1, PDO::PARAM_INT);


        return $req->execute();



        $req->closeCursor();
    }

    public function updateAtelier(atelier $atelier) {
        $req = $this->_bdd->prepare('UPDATE ateliers
                                        SET TitreA = :TitreA,
                                                 DescriptionA = :DescriptionA,
                                                 DateFinA = :DateFinA, 
                                                 DateDebutA = :DateDebutA,
                                                 HoraireA = :HoraireA,
                                                 LieuA = :LieuA,
                                                 NombreA = :NombreA,
                                                 TypeA = :TypeA,
                                                 CodeC = :CodeC
                                    WHERE CodeA = :CodeA
                                    ');

        $req->bindValue(':TitreA', $atelier->getTitreA(), PDO::PARAM_STR);
        $req->bindValue(':DescriptionA', $atelier->getDescriptionA(), PDO::PARAM_STR);
        $req->bindValue(':DateDebutA', $atelier->getDateDebutA(), PDO::PARAM_STR);
        $req->bindValue(':DateFinA', $atelier->getDateFinA(), PDO::PARAM_STR);
        $req->bindValue(':LieuA', $atelier->getLieuA(), PDO::PARAM_STR);
        $req->bindValue(':NombreA', $atelier->getNombreA(), PDO::PARAM_INT);
        $req->bindValue(':HoraireA', $atelier->getHoraireA(), PDO::PARAM_STR);
        $req->bindValue(':TypeA', $atelier->getTypeA(), PDO::PARAM_STR);
        $req->bindValue(':CodeC', $atelier->getCodeC(), PDO::PARAM_INT);
        $req->bindValue(':CodeA', $atelier->getCodeA(), PDO::PARAM_INT);

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