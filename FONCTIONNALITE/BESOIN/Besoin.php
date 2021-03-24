<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php require "../../FONCTIONNALITE/link.php"; ?>
        <!-- Link -->

        <title>Les besoins</title>



    </head>
    <body>


        <!-- Menu -->
        <?php
        require "../../FONCTIONNALITE/menu.php";
        require_once('../../BDD/categorie.bdd.php');
        
        ?>
        <!-- Fin Menu -->
        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Les besoins</h1>

            </div>
            <div class="container">

                <br><br>
                <?php is_login_new_besoin(); ?>
                <br><br>

                <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-light btn-light-fade" data-toggle="modal" data-target="#exampleModal">
                        三 Filtre
                    </button>

                    <form action="Besoin.php" method="post">
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Filter les besoins</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3> Par catégorie </h3>
                                        <?php
                                        require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                                        require_once('../../BDD/connexion.bdd.php');


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
                                        <button type="reset" value="reset" class="btn btn-secondary  btn-light-fade" data-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Filtrer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <input type=button value="Tout affficher" class="btn btn-light" onclick="location = 'Besoin.php'"> 

                    <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">
                        <input class="form-control mr-sm-2" type="search" name="mot" placeholder="Entrez un mot clé" aria-label="Recherche">
                        <button type="submit" class="btn btn-outline-dark">Recherche</button>
                    </form>
                </div>

                <div class="flex-parent d-flex flex-wrap justify-content-around mt-3">


                    <?php
                    require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                    require_once('../../BDD/besoin.bdd.php');

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




                   

                    $besoins = new besoinBDD($bdd);
                    $besoinTab = $besoins->selectBesoinsEtPhoto($pCategorie, $pType, $sEmail, $sType, $st, $mot);


                    if (!empty($besoinTab)) {
                         $conteurBesoin = 0;
                        foreach ($besoinTab as $value) {
                            
                            //var_dump($value['besoin']->getDateButoireB());

                            if ($value['besoin']->getVisibiliteB() == 1 && strtotime($value['besoin']->getDateButoireB()) >= strtotime(date("Y-m-d H:i:s"))) {
                                $conteurBesoin++;
                                if ($value['besoin']->getTypeB() == 'Pro et Perso') {
                                    echo ('<div class="card-margin"><h5><span class="badge badge-info">' . $value['besoin']->getTypeB() . '</span></h5>');
                                } elseif ($value['besoin']->getTypeB() == 'Pro') {
                                    echo ('<div class="card-margin"><h5><span class="badge badge-success">' . $value['besoin']->getTypeB() . '</span></h5>');
                                } elseif ($value['besoin']->getTypeB() == 'Perso') {
                                    echo ('<div class="card-margin"><h5><span class="badge badge-warning">' . $value['besoin']->getTypeB() . '</span></h5>');
                                }
                                echo ('<div class="card" style="width: 12rem;">');
                                echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                                echo ('<div class="card-body card text-center">');
                                echo ('<h5 class="card-title">' . $value['besoin']->getTitreB() . '</h5>');
                                echo ('<p class="card-text"><strong>Délais souhaité: </strong><br>' . date("d-m-Y", strtotime($value['besoin']->getDateButoireB())) . '</p>');
                                echo ('<a href="BesoinX.php?t=' . $value['besoin']->getCodeB() . '" class="btn btn-outline-dark">Voir la demande</a>');
                                echo ('</div>');
                                echo ('</div></div>');
                            } 
                        }
                        
                        if($conteurBesoin == 0){
                            echo('<h5 style="color: red !important;">Aucun résultat</h5>');
                        }
                    } else {

                        echo('<h5 style="color: red !important;">Aucun résultat</h5>');
                    }
                  
                   
                    ?>
                </div>
            </div>
        </div>        

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>
