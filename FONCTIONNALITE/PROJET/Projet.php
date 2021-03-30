<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/projet.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
        require_once('../../BDD/categorie.bdd.php');
        ?>
        <!-- Link -->

        <title>Les projets</title>


    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Les projets</h1>

            </div>
            <div class="container">
                <br><br>
                 <?php is_login_new_projet(); ?>
                <br><br>
               <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-light btn-light-fade" data-toggle="modal" data-target="#exampleModal">
                        三 Filtre
                    </button>

                    <form action="Projet.php" method="post">
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Filter les projets</h5>
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

                    <input type=button value="Tout affficher" class="btn btn-light" onclick="location = 'Projet.php'"> 

                    <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">
                        <input class="form-control mr-sm-2" type="search" name="mot" placeholder="Entrez un mot clé" aria-label="Recherche">
                        <button type="submit" class="btn btn-outline-dark">Recherche</button>
                    </form>
                </div>

                <div class="flex-parent d-flex flex-wrap justify-content-around mt-3">
                    <?php
                    $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD

                    $bdd = $db->connect();

                    $projet = new projetBDD($bdd);

                    if (isset($_GET['mot'])) {
                        $mot = $_GET['mot'];
                    } else {
                        $mot = NULL;
                    }

                   
                    $projetTab = $projet->selectProjetEtPhoto($mot);
                    //echo ($projetTab);
                    if (!empty($projetTab)) {
                        $conteurProjet = 0;
                        foreach ($projetTab as $value) {
                            
                            
                            if ($value['projet']->getVisibiliteP() == 1 && strtotime($value['projet']->getDateButoireP()) >= strtotime(date("Y-m-d H:i:s"))) {
                                $conteurProjet++;
                                if (isset($usercode)) {
                                    $role = $projet->saisirRoleUserProjet($value['projet']->getCodeP(), $usercode);
                                }
                                
                                //var_dump($value['besoin']->getDateButoireB());
                                if ($value['projet']->getTypeP() == 'Pro et Perso') {
                                    echo ('<div class="card-margin"><h5><span class="badge badge-info">' . $value['projet']->getTypeP() . '</span></h5>');
                                } elseif ($value['projet']->getTypeP() == 'Pro') {
                                    echo ('<div class="card-margin"><h5><span class="badge badge-success">' . $value['projet']->getTypeP() . '</span></h5>');
                                } elseif ($value['projet']->getTypeP() == 'Perso') {
                                    echo ('<div class="card-margin"><h5><span class="badge badge-warning">' . $value['projet']->getTypeP() . '</span></h5>');
                                }


                                echo ('<div class="card" style="width: 12rem;">');
                                echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                                echo ('<div class="card-body card text-center">');
                                echo ('<h5 class="card-title">' . $value['projet']->getTitreP() . '</h5>');
                                echo ('<p class="card-text"><strong>Date de publication:  </strong><br>' . date("d-m-Y", strtotime($value['projet']->getDatePublicationP())) . '</p>');
                                echo ('<p class="card-text"><strong>Date :  </strong><br>' . date("d-m-Y", strtotime($value['projet']->getDateButoireP())) . '</p>');
                                echo ('<a href="ProjetX.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Voir la demande</a>');
                                if (isset($usercode)) {
                                    if ($role == "createur") {
                                        echo ('<p></p><a href="../PROJET/voirInscritProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Voir les inscrits</a>');
                                    } else if ($role == "participant") {
                                        echo ('<p></p><a href="../PROJET/desinscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je me désinscrit </a>');
                                    } else {
                                        echo ('<p></p><a href="../PROJET/inscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                    }
                                } else {
                                    echo ('<p></p><a href="../PROJET/inscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                }

                                echo ('</div>');
                                echo ('</div></div>');
                            }
                        }
                        if($conteurProjet == 0){
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