<?php

require('../../CLASS/UtilisateurClass.php');

class utilisateurBDD {
    /*
     * Attributs
     */

    private $_bdd;

    /*
     * private $_CodeU;
      private $_NomU;
      private $_PrenomU;
      private $_Email;
      private $_MotDePasse;
      private $_TypeU;
      private $_RoleU;
     */

    /*
     * Méthode de construction
     */

    public function __construct($bdd) {
        $this->setDb($bdd);
    }

    public function addUser(utilisateur $utilisateur) {  //fonction pour l'affichage des cartes besoins
        if ($Type != Null) {                            // Type est de Pro et Perso
            $query = "INSERT INTO utilisateurs SET NomU = :NomU, PrenomU = :PrenomU, Email = :Email, MotDePasse = :MotDePasse, TypeU = :TypeU";
            $req = $this->_bdd->prepare($query);
            $req->bindValue(':NomU', $utilisateur->getNomU(), PDO::PARAM_STR);
            $req->bindValue(':PrenomU', $utilisateur->getPrenomU(), PDO::PARAM_STR);
            $req->bindValue(':Email', $utilisateur->getEmail(), PDO::PARAM_STR);
            $req->bindValue(':MotDePasse', $utilisateur->getMotDePasse(), PDO::PARAM_STR);
            $req->bindValue(':TypeU', $utilisateur->getTypeU(), PDO::PARAM_INT);
        } else {
            $query = "INSERT INTO utilisateurs SET NomU = :NomU, PrenomU = :PrenomU, Email = :Email, MotDePasse = :MotDePasse";
            $req = $this->_bdd->prepare($query);
            $req->bindValue(':NomU', $utilisateur->getNomU(), PDO::PARAM_STR);
            $req->bindValue(':PrenomU', $utilisateur->getPrenomU(), PDO::PARAM_STR);
            $req->bindValue(':Email', $utilisateur->getEmail(), PDO::PARAM_STR);
            $req->bindValue(':MotDePasse', $utilisateur->getMotDePasse(), PDO::PARAM_STR);
        }



        return $req->execute();


        $req->closeCursor();
    }

//$sql = "select u.Email, b.TitreB from utilisateurs u, besoins b, saisir s where u.CodeU = $usercode and u.CodeU = s.CodeU and s.CodeB = b.CodeB order by b.CodeB DESC limit 1";
    //Pour le mail en créant un besoin
    public function saisirEmailEtTitreBesoin($usercode) {

        $besoinsTab = [];
        $req = $this->_bdd->query("select u.Email, b.TitreB from utilisateurs u, besoins b, saisir s where u.CodeU = $usercode and u.CodeU = s.CodeU and s.CodeB = b.CodeB order by b.CodeB DESC limit 1");
        //$query = "select b.CodeB, b.TypeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ";
        //$datas = $req->fetch(PDO::FETCH_ASSOC);

        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            $besoinsTab[] = ['Email' => $datas['Email'], 'Titre' => $datas['TitreB']];
        }


        return $besoinsTab;

        $req->closeCursor();
    }

    //select l'id du user par rapport à l'id de besoin
    public function saisirUserIDByBesoin($CodeB) {

        $atelierTab = [];
        $req = $this->_bdd->query("select s.CodeU from besoins as b, saisir as s where b.CodeB = $CodeB and b.CodeB = s.CodeB");

       $datas = $req->fetch(PDO::FETCH_ASSOC);

           
        return $datas['CodeU'];

        $req->closeCursor();
    }
    
    
    //select l'Email du user par rapport à l'id de besoin
    public function saisirUserEmailByBesoin($CodeB) {

        $atelierTab = [];
        $req = $this->_bdd->query("select u.Email from utilisateurs u, saisir s, besoins b where u.CodeU = s.CodeU and s.CodeB = b.CodeB and b.CodeB = $CodeB");

       $datas = $req->fetch(PDO::FETCH_ASSOC);

           
        return $datas['Email'];

        $req->closeCursor();
    }
    
    
    //Pour le mail en créant un atelier
    public function saisirEmailEtTitreAtelier($usercode) {

        $atelierTab = [];
        $req = $this->_bdd->query("select u.Email, a.TitreA from utilisateurs u, ateliers a, participera p where u.CodeU = " . $usercode . " and u.CodeU = p.CodeU and p.CodeA = a.CodeA order by a.CodeA DESC limit 1");

        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            $atelierTab[] = ['Email' => $datas['Email'], 'Titre' => $datas['TitreA']];
        }
        return $atelierTab;

        $req->closeCursor();
    }

    //Pour le mail en créant un talent
    public function saisirEmailEtTitreTalent($usercode) {

        $talentTab = [];
        $req = $this->_bdd->query("select u.Email, t.TitreT from utilisateurs u, talents t, proposer p where u.CodeU = " . $usercode . " and u.CodeU = p.CodeU and p.CodeT = t.CodeT order by t.CodeT DESC limit 1");


        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

            $talentTab[] = ['Email' => $datas['Email'], 'Titre' => $datas['TitreT']];
        }
        return $talentTab;

        $req->closeCursor();
    }

    public function selectAllUtilisateurs() {

        $vide = '';
        $utilisateurs = [];

        $req = $this->_bdd->query("select * from utilisateurs where  NomU <> 'XXXXX'");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
                $utilisateurs[] = new utilisateur($datas);
            }
        } else {
            return $vide;
        }




        return $utilisateurs;

        $req->closeCursor();
    }
    
    public function selectUtilisateurEmailTalentByDate($today) {

        $vide = '';
        $Mails = [];

        $req = $this->_bdd->query("select DISTINCT u.Email from emails as e, utilisateurs as u where e.TypeCarte = 'talent' and e.DateEvaluation = '$today' and ( e.Provenance = u.CodeU or e.Destinataire = u.CodeU )");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                 $Mails[] = $datas['Email'];
            }
        } else {
            return $vide;
        }




        return $Mails;

        $req->closeCursor();
    }
    
    
    public function selectUtilisateurEmailBesoinByDate($today) {

        $vide = '';
        $Mails = [];

        $req = $this->_bdd->query("select DISTINCT u.Email from emails as e, utilisateurs as u where e.TypeCarte = 'besoin' and e.DateEvaluation = '$today' and ( e.Provenance = u.CodeU or e.Destinataire = u.CodeU )");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                 $Mails[] = $datas['Email'];
            }
        } else {
            return $vide;
        }




        return $Mails;

        $req->closeCursor();
    }
    

    public function selectUtilisateurSearch($cartea) {

        $vide = '';
        $utilisateurs = [];

        $req = $this->_bdd->query("select * from utilisateurs where NomU <> 'XXXXX' and ( NomU LIKE '%$user%' or PrenomU LIKE '%$user%' or Email LIKE '%$user%' ) order by CodeU DESC");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            $utilisateurs[] = new utilisateur($datas);
        } else {
            return $vide;
        }




        return $utilisateurs;

        $req->closeCursor();
    }

    public function un_User($usercode) {  //fonction pour afficher les information d'un carte besoin
        $vide = '';
        // $usercode = (int)$usercode;

        $req = $this->_bdd->query("select * from utilisateurs where CodeU = {$usercode} ");
        //$query = "select b.CodeB, b.TypeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ";
        //$datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $utilisateur = new utilisateur([]);
                $utilisateur->setCodeU($datas['CodeU']);
                $utilisateur->setNomU($datas['NomU']);
                $utilisateur->setPrenomU($datas['PrenomU']);
                $utilisateur->setEmail($datas['Email']);
                $utilisateur->setMotDePasse($datas['MotDePasse']);
                $utilisateur->setTypeU($datas['TypeU']);
                $utilisateur->setRoleU($datas['RoleU']);
            }
        } else {
            return $vide;
        }



        return $utilisateur;

        $req->closeCursor();
    }
    
    
     //Select l'email et le titre en fonction de l'id de l'atelier
    public function saisirParticipantAtelier($CodeA) {

        $vide = '';
        $utilisateurs = [];
        $req = $this->_bdd->query("SELECT u.CodeU, u.NomU, u.PrenomU, u.Email FROM utilisateurs u, participera p, ateliers a WHERE u.CodeU = p.CodeU and p.CodeA = a.CodeA and p.CodeA = $CodeA and p.RoleA = 'participant'");



        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
                
                $utilisateur = new utilisateur([]);
                $utilisateur->setCodeU($datas['CodeU']);
                $utilisateur->setNomU($datas['NomU']);
                $utilisateur->setPrenomU($datas['PrenomU']);
                $utilisateur->setEmail($datas['Email']);
               
                $utilisateurs[] = $utilisateur;
            }
        } else {
            return $vide;
        }

        return $utilisateurs;
    }
    
    
    

    //T = ID de besoin
    public function un_userLog($Email) {  //fonction pour afficher les information d'un carte besoin
        $vide = '';


        $req = $this->_bdd->query("select * from utilisateurs where Email = '$Email' ");
        //$query = "select b.CodeB, b.TypeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ";
        //$datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $utilisateur = new utilisateur([]);

                $utilisateur->setCodeU($datas['CodeU']);
                $utilisateur->setEmail($datas['Email']);
                $utilisateur->setNomU($datas['NomU']);
                $utilisateur->setPrenomU($datas['PrenomU']);
                $utilisateur->setTypeU($datas['TypeU']);
                $utilisateur->setRoleU($datas['RoleU']);
                $utilisateur->setMotDePasse($datas['MotDePasse']);
            }
        } else {
            return $vide;
        }



        return $utilisateur;

        $req->closeCursor();
    }
    
    
     public function selectBesoinReponseTalentReponse($usercode) {

        $vide = 0;
        

        $req = $this->_bdd->query("select SUM(b.ReponseB) + SUM(t.ReponseT) as Reponse from besoins b, saisir s, talents t, proposer p where s.CodeB = b.CodeB and t.CodeT = p.CodeT and p.CodeU = $usercode and s.CodeU = $usercode and b.VisibiliteB = 1 and t.VisibiliteT = 1");

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            return $datas['Reponse'];
        } else {
            return $vide;
        }

        

        $req->closeCursor();
    }

    public function updateUser(utilisateur $utilisateur) {
        $req = $this->_bdd->prepare('UPDATE utilisateurs
                                        SET  Email = :Email,
                                            NomU = :NomU,
                                            PrenomU = :PrenomU
                                        WHERE CodeU = :CodeU
                                    ');

        // var_dump($utilisateur);

        $req->bindValue(':Email', $utilisateur->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':NomU', $utilisateur->getNomU(), PDO::PARAM_STR);
        $req->bindValue(':PrenomU', $utilisateur->getPrenomU(), PDO::PARAM_INT);
        $req->bindValue(':CodeU', $utilisateur->getCodeU(), PDO::PARAM_INT);



        $req->execute();

        $req->closeCursor();
    }
    
    
    public function updateType( $retype, $usercode) {
        $req = $this->_bdd->prepare('UPDATE utilisateurs
                                        SET TypeU = :TypeU
                                        WHERE CodeU = :CodeU
                                    ');

        // var_dump($utilisateur);

        $req->bindValue(':TypeU', $retype, PDO::PARAM_STR);
        $req->bindValue(':CodeU', $usercode, PDO::PARAM_STR);



        return $req->execute();

        $req->closeCursor();
    }
    
    
    
    public function updateMDP( $mdp, $email) {
        $req = $this->_bdd->prepare('UPDATE utilisateurs
                                        SET MotDePasse = :MotDePasse
                                        WHERE Email = :Email
                                    ');

        // var_dump($utilisateur);

        $req->bindValue(':MotDePasse', $mdp, PDO::PARAM_STR);
        $req->bindValue(':Email', $email, PDO::PARAM_STR);



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