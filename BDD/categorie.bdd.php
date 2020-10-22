<?php

require('../../CLASS/categorieClass.php');
/* function afficher_categories() {  //fonction pour l'affichage des catégories

  $bdd = connect();

  $requete = $bdd->query("select NomC, PhotoC, CodeC from categories");

  if ($requete == true) {
  while ($resultat = $requete ->fetch()) {
  echo ('<div class="card" style="width: 12rem;">');
  echo ('<div class="card-header">');
  echo ('<center><input class="card-text" type="checkbox" id="inlineCheckbox" name="'.$resultat["CodeC"].'" value="'.$resultat["CodeC"].'"></center>');
  echo ('</div>');
  echo ('<img src="'.$resultat["PhotoC"].'" class="card-img-top" alt="...">');
  echo ('<div class="card-body text-center">');
  echo('<h6 class="card-title">'.$resultat["NomC"].'</h6>');
  echo ('</div>');
  echo ('</div>');
  }
  } else {
  echo('<h5> Aucune catégorie</h5>');
  }
  } */

class categorieBDD {
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

    //return l'id et le nom de toutes les categories
    public function allCategorieNameAndId() {  //fonction pour l'affichage des cartes besoins
        $vide = '';
        $req = $this->_bdd->query("select * from categories where VisibiliteC = 1");

        // $categories[] = [];

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $categorie = new categorie($datas);

                /* $categorie->setCodeC($datas['CodeC']);
                  $categorie->setNomC($datas['NomC']); */

                $categories[] = ['categorie' => $categorie];
            }
        } else {
            return $vide;
        }


        return $categories;

        $req->closeCursor();
    }
    
    
    public function une_Categorie($CodeC) {  //fonction pour afficher les information d'un carte besoin
        $vide = '';
        // $usercode = (int)$usercode;

        $req = $this->_bdd->query("select * from categories where CodeC = {$CodeC} ");
        //$query = "select b.CodeB, b.TypeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ";
        //$datas = $req->fetch(PDO::FETCH_ASSOC);

        if ($req) {

            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $categorie = new categorie([]);
                $categorie->setCodeC($datas['CodeC']);
                $categorie->setNomC($datas['NomC']);
                $categorie->setDescriptionC($datas['DescriptionC']);
                $categorie->setPhotoC($datas['PhotoC']);
                $categorie->setVisibiliteC($datas['VisibiliteC']);
                
            }
        } else {
            return $vide;
        }



        return $categorie;

        $req->closeCursor();
    }
    
    
    //le (user ou admin) veut que cette carte ne soit plus visible 
    public function userUpdateCategorieNotVisible($CodeC) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('UPDATE categories SET VisibiliteC = 0 WHERE CodeC = :CodeC ');

        $req->bindValue(':CodeC', $CodeC, PDO::PARAM_INT);


        return $req->execute();



        $req->closeCursor();
    }
    
    
    public function updateCategorie(categorie $categorie) {
        $req = $this->_bdd->prepare('UPDATE categories
                                        SET NomC = :NomC,
                                            DescriptionC = :DescriptionC,
                                            PhotoC = :PhotoC
                                        WHERE CodeC = :CodeC
                                    ');

        // var_dump($talent);
        $req->bindValue(':NomC', $categorie->getNomC(), PDO::PARAM_STR);
        $req->bindValue(':DescriptionC', $categorie->getDescriptionC(), PDO::PARAM_STR);
        $req->bindValue(':PhotoC', $categorie->getPhotoC(), PDO::PARAM_STR);
        $req->bindValue(':CodeC', $categorie->getCodeC(), PDO::PARAM_STR);




        $req->execute();

        $req->closeCursor();
    }
    
    
    
    public function addCategorie(categorie $categorie) {  //fonction pour l'affichage des cartes besoins
        $req = $this->_bdd->prepare('INSERT INTO categories
                                             SET NomC = :NomC,
                                                 DescriptionC = :DescriptionC,
                                                 PhotoC     = :PhotoC,
                                                 VisibiliteC     = :VisibiliteC
                                    ');

        $req->bindValue(':NomC', $categorie->getNomC(), PDO::PARAM_STR);
        $req->bindValue(':DescriptionC', $categorie->getDescriptionC(), PDO::PARAM_STR);
        $req->bindValue(':PhotoC', $categorie->getPhotoC(), PDO::PARAM_STR);
        $req->bindValue(':VisibiliteC', $categorie->getVisibiliteC(), PDO::PARAM_INT);

        return $req->execute();



        $req->closeCursor();
    }

    // $query = "select VisibiliteC, NomC, PhotoC, CodeC, DescriptionC from categories where codeC not in ( select c.codeC from categories c, abonner a where c.CodeC = a.CodeC and a.CodeU = $usercode )";
    //return les categories non abonnées
    public function allCategorieByUser($usercode) {  //fonction pour l'affichage des cartes besoins
        $vide = '';
        $req = $this->_bdd->query("SELECT c.CodeC, c.NomC, c.DescriptionC, c.PhotoC, c.VisibiliteC FROM categories c, abonner a  WHERE c.CodeC = a.CodeC and a.CodeU = {$usercode}");

        // $categories[] = [];

        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

                $categorie = new categorie($datas);

                /* $categorie->setCodeC($datas['CodeC']);
                  $categorie->setNomC($datas['NomC']); */

                $categories[] = ['categorie' => $categorie];
            }
        } else {
            return $vide;
        }


        return $categories;

        $req->closeCursor();
    }
    
    
    
    //return les categories non abonnées
    public function allCategorieNotOnUser($usercode) {  //fonction pour l'affichage des cartes besoins
        $vide = '';
        $req = $this->_bdd->query("select VisibiliteC, NomC, PhotoC, CodeC, DescriptionC from categories where codeC not in ( select c.codeC from categories c, abonner a where c.CodeC = a.CodeC and a.CodeU = $usercode )");
//SELECT * FROM categories c, abonner a  WHERE c.CodeC = a.CodeC and a.CodeU = 2
//SELECT * FROM categories c, abonner a WHERE c.CodeC = a.CodeC and a.CodeU = 2
        // $categories[] = [];
        
        
        
        if ($req) {
            while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
               
                
                $categorie = new categorie($datas);
                
                    $categories[] = ['categorie' => $categorie];
                
                
                /* $categorie->setCodeC($datas['CodeC']);
                  $categorie->setNomC($datas['NomC']); */

                
            }
        } else {
            return $vide;
        }



        return $categories;

        $req->closeCursor();
    }

    /*
     * while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {

      $besoin = new besoin([]);

      $besoin->setCodeB($datas['CodeB']);
      $besoin->setVisibiliteB($datas['VisibiliteB']);
      $besoin->setTitreB($datas['TitreB']);
      $besoin->setDateButoireB($datas['DateButoireB']);
      $besoin->setTypeB($datas['TypeB']);

      $besoins[] = ['besoin' => $besoin, 'photo' => $datas['PhotoC']];
      }

      return $besoins;
     */



    /*
     * Méthodes Mutateurs (Setters) - Pour modifier la valeur des attributs
     */

    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }

}

?>
