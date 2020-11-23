<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/projet.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
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
                <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">

                    <a href="Creer1Projet.php"><button type="button" class="btn btn-light">Ajouter un nouveau projet</button></a>
                </div>

                <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                    <a href="ProjetC.php"><div class="alert alert-light" role="alert">Filtrer les projets par catégorie</div></a>
                    <form class="form-inline my-2 my-lg-0" class="recherche">
                        <input class="form-control mr-sm-2" type="search" placeholder="Entrez un mot clé" aria-label="Recherche">
                        <button type="button" class="btn btn-outline-dark">Recherche</button>
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
                    //echo empty($projetTab);
                    if (!empty($projetTab)) {
                        $conteurProjet = 0;
                        foreach ($projetTab as $value) {

                            if ($value['projet']->getVisibiliteP() == 1 && strtotime($value['projet']->getDateButoireP()) >= strtotime(date("yy/m/d"))) {
                                $conteurProjet++;
                                if (isset($usercode)) {
                                    $role = $projet->saisirRoleUserProjet($value['projet']->getCodeP(), $usercode);
                                }
                                echo '<br><br>';
                                //var_dump($value['besoin']->getDateButoireB());
                                if ($value['projet']->getTypeP() == 'Pro et Perso') {
                                    echo ('<div><h5><span class="badge badge-info">' . $value['projet']->getTypeP() . '</span></h5>');
                                } elseif ($value['projet']->getTypeP() == 'Pro') {
                                    echo ('<div><h5><span class="badge badge-success">' . $value['projet']->getTypeP() . '</span></h5>');
                                } elseif ($value['projet']->getTypeP() == 'Perso') {
                                    echo ('<div><h5><span class="badge badge-warning">' . $value['projet']->getTypeP() . '</span></h5>');
                                }


                                echo ('<div class="card" style="width: 12rem;">');
                                echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                                echo ('<div class="card-body card text-center">');
                                echo ('<h5 class="card-title">' . $value['projet']->getTitreP() . '</h5>');
                                echo ('<p class="card-text">Date de publication: ' . date("d-m-yy", strtotime($value['projet']->getDatePublicationP())) . '</p>');
                                echo ('<p class="card-text">Date & Créneau : ' . $value['projet']->getDateButoireP() . '</p>');
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
                            echo('<h5>Aucun résultat</h5>');
                        }
                    } else {

                        echo('<h5>Aucun résultat</h5>');
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