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

    // $query = "select VisibiliteC, NomC, PhotoC, CodeC, DescriptionC from categories where codeC not in ( select c.codeC from categories c, abonner a where c.CodeC = a.CodeC and a.CodeU = $usercode )";
    //return les categories abonné
    public function allCategorieByUser($usercode) {  //fonction pour l'affichage des cartes besoins
        $vide = '';
        $req = $this->_bdd->query("select * from categories where codeC not in ( select c.codeC from categories c, abonner a where c.CodeC = a.CodeC and a.CodeU = " . $usercode . ")");

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
