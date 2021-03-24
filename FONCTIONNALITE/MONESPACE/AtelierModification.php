<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/atelier.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
        require_once('../../BDD/categorie.bdd.php');
        ?>
        <!-- Link -->

        <title>Modifier votre atelier</title>


    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Modifier votre atelier</h1>

            </div>
            <div class="container">
                <form action="../ATELIER/Modifier1Atelier.php" method="POST">
                    <?php
                    require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                    date_default_timezone_set('Europe/Paris');
                    echo "Date de modification :   " . date("d/m/Y");
                    ?>         
                    <?php
                    $T = $_GET['t'];



                    $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                    $bdd = $db->connect();

                    $ateliers = new atelierBDD($bdd);
                    //$besoins = new besoin();

                    $atelierTab = $ateliers->selectAtelierX($T);

                    /* $query = "select c.NomC, a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeA = $T ";
                      $result = mysqli_query($session, $query);

                      if ($result == false) {
                      die("ereur requête : " . mysqli_error($session));
                      } */


                    foreach ($atelierTab as $value) { /* Afficher le détail de chaque besoin */



                        if ($value['atelier']->getVisibiliteA() == 1) {

                            

                            echo('<div class="form-row align-items-center">');
                            echo('<div class="col-auto my-1">');
                            echo('<label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>');
                            echo('<select class="custom-select mr-sm-2" name="categorie" id="inlineFormCustomSelect" >');
                            echo('<option name="categorie" value="' . $value['atelier']->getCodeC() . '" selected>' . $value['nomPhoto'] . '</option>');

                            $categorieBDD = new categorieBDD($bdd);

                            //$query = "select CodeC, NomC from categories where VisibiliteC = 1";
                            // $result = mysqli_query ($session, $query);
                            $CategorieTab = $categorieBDD->allCategorieNameAndId();

                            if (!empty($CategorieTab)) {

                                foreach ($CategorieTab as $value1) {
                                   
                                    echo ('<option value="' .$value1['categorie']->getCodeC() . '" name="categorie" title="' . $value1['categorie']->getDescriptionC() . '">' . $value1['categorie']->getNomC() . '</option>');
                                }
                            }



                            /* $query2 = "select CodeC, NomC, DescriptionC from categories where VisibiliteC = 1";
                              $result = mysqli_query($session, $query2);
                              if (mysqli_num_rows($result) > 0) {
                              while ($c = mysqli_fetch_array($result)) {
                              echo ('<option value="' . $c["CodeC"] . '" name="categorie" title="' . $c["DescriptionC"] . '">' . $c["NomC"] . '</option>');
                              }
                              } */
                            echo('</select>');
                            echo('</div>');
                            echo('</div>');


                            echo ('<div class="form-group">');
                            echo ('<label for="inputEmail4">Titre(<span style="color:red">*</span>)</label>');
                            echo ('<input type="text" name="titre" class="form-control col-md-4" id="inputEmail4" maxlength="20" value="' . $value['atelier']->getTitreA() . '" required>');
                            echo ('</div>');

                            echo('<div class="form-group">');
                            echo('<label for="inputEmail4">Date de debut atelier(<span style="color:red">*</span>)</label>');
                            echo('<input type="datetime-local" name="datedebut" value="' . strftime('%Y-%m-%dT%H:%M:%S', strtotime($value['atelier']->getDateFinA())) . '" class="form-control col-md-4" id="inputEmail4" maxlength="100" >');
                            echo('</div>');
                            
                            echo('<div class="form-group">');
                            echo('<label for="inputEmail4">Date de fin atelier (<span style="color:red">*</span>)</label>');
                            echo('<input type="datetime-local" name="datefin" value="' . strftime('%Y-%m-%dT%H:%M:%S', strtotime($value['atelier']->getDateFinA())) . '" class="form-control col-md-4" id="inputEmail4" maxlength="100" >');
                            echo('</div>');
                            
                            echo('<div class="form-group">');
                            echo('<label for="inputEmail4">Description(<span style="color:red">*</span>)</label><br/>');
                            echo('<textarea rows="4" cols="50" name="description" required>' . $value['atelier']->getDescriptionA() . '</textarea>');
                            echo('</div>');

                            echo ('<div class="form-group">');
                            echo ('<label for="inputEmail4">Lieu d\'atelier(<span style="color:red">*</span>)</label>');
                            echo ('<input type="text" name="lieu" class="form-control col-md-4" id="inputEmail4" maxlength="50" value="' . $value['atelier']->getLieuA() . '" required>');
                            echo ('</div>');

                            echo ('<div class="form-group">');
                            echo ('<label for="inputEmail4">Nombre de personnes maximum(<span style="color:red">*</span>)</label>');
                            echo ('<input type="text" name="nb" class="form-control col-md-4" id="inputEmail4" maxlength="50" value="' . $value['atelier']->getNombreA() . '" required>');
                            echo ('</div>');

                            echo ('<div class="form-group">');
                            echo ('<label for="inputEmail4">URL de l\'inscription(<span style="color:red">*</span>)</label>');
                            echo ('<input type="text" name="url" class="form-control col-md-4" id="inputEmail4" maxlength="100" value="' . $value['atelier']->getURL() . '" >');
                            echo ('</div>');

                            echo ('<div class="form-group">');
                            echo ('<label for="inputEmail4">En savoir plus</label>');
                            echo ('<input type="text" name="plus" class="form-control col-md-4" id="inputEmail4" maxlength="100" value="' . $value['atelier']->getPlusA() . '">');
                            echo ('</div>');


                            if ($value['atelier']->getTypeA() == "Pro") {
                                echo('<div class="form-group">');
                                echo('<label for="inputAddress">Type de besoin(<span style="color:red">*</span>)</label>');
                                echo('</div>');
                                echo('<div class="form-group">');
                                echo('<div class="form-check form-check-inline">');
                                echo('<input class="form-check-input" checked type="radio" name="type" id="inlineRadio1" value="Pro">');
                                echo('<label class="form-check-label" for="inlineRadio1">Pro</label>');
                                echo('</div>');
                                echo('<div class="form-check form-check-inline">');
                                echo('<input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="Perso">');
                                echo('<label class="form-check-label" for="inlineRadio2">Perso</label>');
                                echo('</div>');
                                echo('<div class="form-check form-check-inline">');
                                echo('<input class="form-check-input" type="radio" name="type" id="inlineRadio3" value="Pro et Perso">');
                                echo('<label class="form-check-label" for="inlineRadio3">Pro&Perso</label>');
                                echo('</div>');
                                echo('</div>');
                            }

                            if ($value['atelier']->getTypeA() == "Perso") {
                                echo('<div class="form-group">');
                                echo('<label for="inputAddress">Type de besoin(<span style="color:red">*</span>)</label>');
                                echo('</div>');
                                echo('<div class="form-group">');
                                echo('<div class="form-check form-check-inline">');
                                echo('<input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="Pro">');
                                echo('<label class="form-check-label" for="inlineRadio1">Pro</label>');
                                echo('</div>');
                                echo('<div class="form-check form-check-inline">');
                                echo('<input class="form-check-input"  checked type="radio" name="type" id="inlineRadio2" value="Perso">');
                                echo('<label class="form-check-label" for="inlineRadio2">Perso</label>');
                                echo('</div>');
                                echo('<div class="form-check form-check-inline">');
                                echo('<input class="form-check-input" type="radio" name="type" id="inlineRadio3" value="Pro et Perso">');
                                echo('<label class="form-check-label" for="inlineRadio3">Pro&Perso</label>');
                                echo('</div>');
                                echo('</div>');
                            }


                            if ($value['atelier']->getTypeA() == "Pro et Perso") {
                                echo('<div class="form-group">');
                                echo('<label for="inputAddress">Type de besoin(<span style="color:red">*</span>)</label>');
                                echo('</div>');
                                echo('<div class="form-group">');
                                echo('<div class="form-check form-check-inline">');
                                echo('<input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="Pro">');
                                echo('<label class="form-check-label" for="inlineRadio1">Pro</label>');
                                echo('</div>');
                                echo('<div class="form-check form-check-inline">');
                                echo('<input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="Perso">');
                                echo('<label class="form-check-label" for="inlineRadio2">Perso</label>');
                                echo('</div>');
                                echo('<div class="form-check form-check-inline">');
                                echo('<input class="form-check-input" type="radio" checked name="type" id="inlineRadio3" value="Pro et Perso">');
                                echo('<label class="form-check-label" for="inlineRadio3">Pro&Perso</label>');
                                echo('</div>');
                                echo('</div>');
                            }

                            echo('<hr>');
                            echo('<div class="form-group">');
                            echo('<button name="codeA" type="submit" value="' . $value['atelier']->getCodeA() . '" class="btn btn-primary">Modifier</button>');
                            echo ('<a href="../MONESPACE/MonProfil.php"><button type="button" class="btn btn-dark">Annuler</button></a>');
                            //echo (' <input type="reset" class="btn btn-dark" value="Annuler">');
                            echo('</div>');
                        }
                    }
                    ?> 
                </form>

            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>