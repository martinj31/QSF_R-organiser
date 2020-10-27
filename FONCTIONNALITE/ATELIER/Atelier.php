<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/categorie.bdd.php');
        require_once('../../BDD/atelier.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
        ?>
        <!-- Link -->

        <title>Les ateliers</title>


    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Les ateliers</h1>

            </div>
            <div class="container">

                <br><br>
                <?php is_login_new_atelier(); ?>
                <br><br>
                <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-light" data-toggle="modal" data-target="#exampleModal">
                        三 Filtre
                    </button>

                    <form action="Atelier.php" method="post">
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Filter les ateliers</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3> Par catégorie </h3>
                                        <?php
                                        require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                                        $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                                        $bdd = $db->connect();

                                        $categorieBDD = new categorieBDD($bdd);

                                        //$query = "select CodeC, NomC from categories where VisibiliteC = 1";
                                        // $result = mysqli_query ($session, $query);
                                        $CategorieTab = $categorieBDD->allCategorieNameAndId();

                                        if (!empty($CategorieTab)) {

                                            foreach ($CategorieTab as $value) {
                                                echo ('<label class="radio-inline"> <input type="checkbox" name="categorie[]" value="' . $value['categorie']->getCodeC() . '"> <strong>' . $value['categorie']->getNomC() . '</strong>  </label> ');
                                            }
                                        }
                                        ?>

                                        <?php
                                        if (empty($_SESSION['email'])) {
                                            echo ('<br><br>');
                                            echo ('<h3> Par type </h3><p>(Ne pas choisir si vous voulez tous affichés)</p>');
                                            echo ('<label class="radio-inline"><input type="radio" name="type" value="Pro"><em><strong>Pro</strong></em></label>');
                                            echo ('<label class="radio-inline"><input type="radio" name="type" value="Perso"><em><strong>Perso</strong></em></label>');
                                        }
                                        ?>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="reset" value="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Filtrer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <input type=button value="Tout affficher" class="btn btn-light" onclick="location = 'Atelier.php'"> 

                    <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">
                        <input class="form-control mr-sm-2" type="search" name="mot" placeholder="Entrez un mot clé" aria-label="Recherche">
                        <button type="submit" class="btn btn-outline-dark">Recherche</button>
                    </form>
                </div>

                <div class="flex-parent d-flex flex-wrap justify-content-around mt-3">


                    <?php
                    require_once('../../FONCTIONCOMMUNE/Fonctions.php');

                    $st = NULL;
                    if (isset($_POST['categorie'])) {
                        $st = "(";
                        foreach ($_POST["categorie"] as $categories) {
                            $st = $st . $categories;
                            $st = $st . ",";
                        }
                        $st = rtrim($st, ',');
                        $st = $st . ")";
                    }



                    if (isset($_SESSION['type'])) {
                        $sType = $_SESSION['type'];
                    } else {
                        $sType = NULL;
                    }
                    // echo $sType.'   '.$_SESSION['type'];
                    if (isset($_SESSION['email'])) {
                        $sEmail = $_SESSION['email'];
                    } else {
                        $sEmail = NULL;
                    }

                    if (isset($_POST['type'])) {
                        $pType = $_POST['type'];
                    } else {
                        $pType = NULL;
                    }

                    if (isset($_POST['categorie'])) {
                        $pCategorie = $_POST['categorie'];
                    } else {
                        $pCategorie = NULL;
                    }


                    if (isset($_GET['mot'])) {
                        $mot = $_GET['mot'];
                    } else {
                        $mot = NULL;
                    }




                    $ateliers = new atelierBDD($bdd);
                    //$besoins = new besoin();

                    $atelierTab = $ateliers->selectAtelierEtPhoto($pCategorie, $pType, $sEmail, $sType, $st, $mot);


                    if (!empty($atelierTab)) {

                        foreach ($atelierTab as $value) {
                            echo '<br><br>';
                            if (isset($usercode)) {
                                $role = $ateliers->saisirRoleUserAtelier($value['atelier']->getCodeA(), $usercode);
                            }

                            //var_dump($role);

                            if ($value['atelier']->getVisibiliteA() == 1) {
                                if ($value['atelier']->getTypeA() == 'Pro et Perso') {
                                    echo ('<div><h5><span class="badge badge-info">' . $value['atelier']->getTypeA() . '</span></h5>');
                                } elseif ($value['atelier']->getTypeA() == 'Pro') {
                                    echo ('<div><h5><span class="badge badge-success">' . $value['atelier']->getTypeA() . '</span></h5>');
                                } elseif ($value['atelier']->getTypeA() == 'Perso') {
                                    echo ('<div><h5><span class="badge badge-warning">' . $value['atelier']->getTypeA() . '</span></h5>');
                                }
                                echo ('<div class="card" style="width: 12rem;">');
                                echo ('<img src="' . $value["photo"] . '" class="card-img-top" alt="...">');
                                echo ('<div class="card-body card text-center">');
                                echo ('<h5 class="card-title">' . $value['atelier']->getTitreA() . '</h5>');
                                echo ('<p class="card-text">Date de publication: ' . date("d-m-yy", strtotime($value['atelier']->getDatePublicationA())) . '</p>');
                                echo ('<p class="card-text">Date & Créneau : ' . $value['atelier']->getDateA() . '</p>');
                                echo ('<a href="../ATELIER/AtelierX.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Voir le détail</a><br>');
                                if (isset($usercode)) {
                                    if ($role == "createur") {
                                        echo ('<p></p><a href="../ATELIER/voirInscritAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Voir les inscrits</a>');
                                    } else if ($role == "participant") {
                                        echo ('<p></p><a href="../ATELIER/desinscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Je me désinscrit </a>');
                                    } else {
                                        echo ('<p></p><a href="../ATELIER/inscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                    }
                                }else{
                                    echo ('<p></p><a href="../ATELIER/inscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                }
                                echo ('</div>');
                                echo ('</div></div>');
                            }
                        }
                    } else {

                        echo('<h5>Aucun résultat</h5>');
                    }











                    //select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from categories c, ateliers a where c.CodeC = a.CodeC order by a.CodeA DESC ; 

                    /* if(isset($_SESSION['email'])) {
                      if(isset($st)) {                                            // Utilisateur connecté, sélectionné les catégories
                      if ($_SESSION['type'] != NULL) {                        // Utilisateur connecté, sélectionné les catégories, son type est Pro ou Perso
                      $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '{$_SESSION['type']}' OR a.TypeA ='Pro et Perso') and a.CodeC in $st order by CodeA DESC";
                      } else {                                                // Utilisateur connecté, sélectionné les catégories, son type est Pro et Perso
                      $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeC in $st order by CodeA DESC";
                      }
                      } else {                                                    // Utilisateur connecté, n'a pas sélectionner les catégories
                      if ($_SESSION['type'] != NULL) {                        // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro ou Perso
                      $query = "select  a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '{$_SESSION['type']}' OR a.TypeA ='Pro et Perso') order by CodeA DESC";
                      } else {                                                // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro et Perso
                      $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC order by CodeA DESC";
                      }
                      }
                      } else {
                      if (isset($_POST['type']) && isset($_POST['categorie'])) { // V-si un visiteur choisit les deux filtres
                      $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '{$_POST['type']}' OR a.TypeA ='Pro et Perso') and a.CodeC in $st order by CodeA DESC";
                      } elseif (isset($_POST['type'])) {  // V-si un visiteur choisit filtre type
                      $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '{$_POST['type']}' OR a.TypeA ='Pro et Perso') order by CodeA DESC";
                      } elseif (isset($_POST['categorie'])) { // V-si un visiteur choisit filtre categorie
                      $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeC in $st order by CodeA DESC";
                      }  else {  // V-si un visiteur rien choisit
                      $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC order by CodeA DESC";
                      }
                      }

                      if(isset($_GET['mot']) AND !empty($_GET['mot'])) {     /*Recherche par mot clé */
                    /* $mot = htmlspecialchars($_GET['mot']);
                      if(isset($_SESSION['email']) and $_SESSION['type'] != NULL) {
                      $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.TitreA LIKE '%$mot%' and a.TypeA = '{$_SESSION['type']}' order by a.CodeA DESC";
                      } else {
                      $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.TitreA LIKE '%$mot%' order by a.CodeA DESC";
                      }
                      }

                      $result = mysqli_query ($session, $query);

                      if (mysqli_num_rows($result)>0) {
                      while ($ligne = mysqli_fetch_array($result)) {                      /* Afficher tous les besoins par l'ordre chronologique en format carte */
                    /* if ($ligne["VisibiliteA"] == 1) {   
                      if ($ligne["TypeA"] == 'Pro et Perso') {
                      echo ('<div><h5><span class="badge badge-info">'.$ligne["TypeA"].'</span></h5>');
                      } elseif ($ligne["TypeA"] == 'Pro') {
                      echo ('<div><h5><span class="badge badge-success">'.$ligne["TypeA"].'</span></h5>');
                      } elseif ($ligne["TypeA"] == 'Perso') {
                      echo ('<div><h5><span class="badge badge-warning">'.$ligne["TypeA"].'</span></h5>');
                      }
                      echo ('<div class="card" style="width: 12rem;">');
                      echo ('<img src="'.$ligne["PhotoC"].'" class="card-img-top" alt="...">');
                      echo ('<div class="card-body card text-center">');
                      echo ('<h5 class="card-title">'.$ligne["TitreA"].'</h5>');
                      echo ('<p class="card-text">Date de publication: '.date("d-m-yy", strtotime($ligne["DatePublicationA"])).'</p>');
                      echo ('<p class="card-text">Date & Créneau : '.$ligne["DateA"].'</p>');
                      echo ('<a href="AtelierX.php?t='.$ligne["CodeA"].'" class="btn btn-outline-dark">Voir le détail</a><br>');
                      echo ('<p></p><a href="'.$ligne["URL"].'" class="btn btn-outline-dark">Je m\'inscris</a>');
                      echo ('</div>');
                      echo ('</div></div>');
                      }
                      }
                      } else {
                      echo('<h5>Aucun résultat</h5>');
                      } */
                    ?>
                </div>
            </div>
        </div>        

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>
