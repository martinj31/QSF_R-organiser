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
                    <button type="button" class="btn btn-primary btn-light btn-light-fade" data-toggle="modal" data-target="#exampleModal">
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
                                        <button type="reset" value="reset" class="btn btn-secondary btn-light-fade" data-dismiss="modal">Fermer</button>
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
                    

                    $atelierTab = $ateliers->selectAtelierEtPhoto($pCategorie, $pType, $sEmail, $sType, $st, $mot);


                    if (!empty($atelierTab)) {
                        $conteurAtelier = 0;

                        foreach ($atelierTab as $value) {
                           
                            if (isset($usercode)) {
                                $role = $ateliers->saisirRoleUserAtelier($value['atelier']->getCodeA(), $usercode);
                            }


                            if ($value['atelier']->getVisibiliteA() == 1 && strtotime($value['atelier']->getDateFinA()) >=strtotime(date("Y-m-d H:i:s"))) {
                                $conteurAtelier++;
                                if ($value['atelier']->getTypeA() == 'Pro et Perso') {
                                    echo ('<div class="card-margin"><h5><span class="badge badge-info">' . $value['atelier']->getTypeA() . '</span></h5>');
                                } elseif ($value['atelier']->getTypeA() == 'Pro') {
                                    echo ('<div class="card-margin"><h5><span class="badge badge-success">' . $value['atelier']->getTypeA() . '</span></h5>');
                                } elseif ($value['atelier']->getTypeA() == 'Perso') {
                                    echo ('<div class="card-margin"><h5><span class="badge badge-warning">' . $value['atelier']->getTypeA() . '</span></h5>');
                                }
                                echo ('<div class="card" style="width: 12rem;">');
                                echo ('<img src="' . $value["photo"] . '" class="card-img-top" alt="...">');
                                echo ('<div class="card-body card text-center">');
                                echo ('<h5 class="card-title">' . $value['atelier']->getTitreA() . '</h5>');
                                echo ('<p class="card-text"><strong>Date de publication: </strong><br>' . date("d-m-Y", strtotime($value['atelier']->getDatePublicationA())) . '</p>');
                                echo ('<p class="card-text"><strong>Date & Créneau : </strong><br>' . $value['atelier']->getDateDebutA() . ' à ' . $value['atelier']->getDateFinA() . '</p>');
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
                        
                        if($conteurAtelier == 0){
                            echo('<h5 style="color: red !important;">Aucun résultat</h5>');
                        }
                    } else {

                        echo('<h5style="color: red !important;">Aucun résultat</h5>');
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
