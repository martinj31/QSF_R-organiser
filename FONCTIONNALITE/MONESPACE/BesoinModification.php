<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/besoin.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
        require_once('../../BDD/categorie.bdd.php');
        ?>
        <!-- Link -->

        <title>Modifier votre besoin</title>


    </head>
    <body>


        <!-- Menu -->
<?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Modifier votre besoin</h1>

            </div>
            <div class="container">
                <form action="Modifier1CarteB.php" method="POST">
                    <?php
                    require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                    date_default_timezone_set('Europe/Paris');
                    echo "Date de modification :   " . date("d/m/yy");
                    ?>         
                    <?php
                    $T = $_GET['t'];

                    $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                    $bdd = $db->connect();

                    $besoins = new besoinBDD($bdd);
                    //$besoins = new besoin();

                     $besoinTab = $besoins->un_besoinx($T);



                    /* $query = "select c.NomC, b.TypeB, b.CodeB, b.VisibiliteB, b.TitreB, c.CodeC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = $T and c.VisibiliteC = 1";
                      $result = mysqli_query ($session, $query);

                      if ($result == false) {
                      die("ereur requête : ". mysqli_error($session) );
                      } */
                    foreach ($besoinTab as $value) { /* Afficher le détail de chaque besoin */
                        
                        
                        if (/*strtotime($value['besoin']->getDateButoireB()) >= strtotime(date("yy/m/d")) &&*/ $value['besoin']->getVisibiliteB() == 1) {

                            echo('<div class="form-row align-items-center">');
                            echo('<div class="col-auto my-1">');
                            echo('<label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>');
                            echo('<select class="custom-select mr-sm-2" name="categorie" id="inlineFormCustomSelect" >');
                            echo('<option value="' . $value['besoin']->getCodeC() . '" name="categorie"  selected>' . $value['nom']  . '</option>');
                           
                            $categorieBDD = new categorieBDD($bdd);

                            //$query = "select CodeC, NomC from categories where VisibiliteC = 1";
                            // $result = mysqli_query ($session, $query);
                            $CategorieTab = $categorieBDD->allCategorieNameAndId();

                            if (!empty($CategorieTab)) {

                                foreach ($CategorieTab as $value1) {
                                   
                                    echo ('<option value="' .$value1['categorie']->getCodeC() . '" name="categorie" title="' . $value1['categorie']->getDescriptionC() . '">' . $value1['categorie']->getNomC() . '</option>');
                                }
                            }
                            
                            
                            /*$query2 = "select CodeC, NomC, DescriptionC from categories where VisibiliteC = 1";
                            $result = mysqli_query($session, $query2);
                            if (mysqli_num_rows($result) > 0) {
                                while ($c = mysqli_fetch_array($result)) {
                                    echo ('<option value="' . $c["CodeC"] . '" name="categorie" title="' . $c["DescriptionC"] . '">' . $c["NomC"] . '</option>');
                                }
                            }*/
                            echo('</select>');
                            echo('</div>');
                            echo('</div>');


                            echo ('<div class="form-group">');
                            echo ('<label for="inputEmail4">Titre(<span style="color:red">*</span>)</label>');
                            echo ('<input type="text" name="titre" class="form-control col-md-4" id="inputEmail4" maxlength="20" value="' . $value['besoin']->getTitreB() . '" required>');
                            echo ('</div>');

                            echo('<div class="form-group">');
                            echo('<label for="inputEmail4">Description du besoin(<span style="color:red">*</span>)</label><br/>');
                            echo('<textarea rows="4" cols="50" name="description" required>' . $value['besoin']->getDescriptionB() . '</textarea>');
                            echo('</div>');

                            echo('<div class="form-group">');
                            echo('<label for="inputEmail4">Date butoire(<span style="color:red">*</span>)</label>');
                            echo('<input type="date" name="datebutoire" value="' . $value['besoin']->getDateButoireB() . '" class="form-control col-md-4" id="inputEmail4" maxlength="10" required>');
                            echo('</div>');

                            if ($value['besoin']->getTypeB() == "Pro") {
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

                            if ($value['besoin']->getTypeB() == "Perso") {
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


                            if ($value['besoin']->getTypeB() == "Pro et Perso") {
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
                            echo('<button name="codeB" type="submit" value="' . $value['besoin']->getCodeB() . '" class="btn btn-primary">Modifier</button>');
                            echo ('<a href="../MONESPACE/MonProfil.php"><button type="button" class="btn btn-dark">Annuler</button></a>');
                            // echo (' <input type="reset" class="btn btn-dark" value="Annuler">');
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