<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/talent.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
        require_once('../../BDD/categorie.bdd.php');
        ?>
        <!-- Link -->

        <title>Modifier votre talent</title>


    </head>
    <body>


        <!-- Menu -->
<?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Modifier votre talent</h1>

            </div>
            <div class="container">
                <form action="Modifier1CarteT.php" method="POST">
                    <?php
                    require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                    date_default_timezone_set('Europe/Paris');
                    echo "Date de modification :   " . date("d/m/yy");
                    ?>         
                    <?php
                    $T = $_GET['t'];
                    
                     $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                    $bdd = $db->connect();

                    $talents = new talentBDD($bdd);
                    //$besoins = new besoin();

                    $talentTab = $talents->selectTalentX($T);
                    /*$query = "select t.TypeT, t.CodeT, t.VisibiliteT, t.TitreT, c.CodeC, c.NomC, t.DatePublicationT, t.DescriptionT from talents t, categories c where t.CodeC = c.CodeC and t.CodeT = $T ";
                    $result = mysqli_query($session, $query);

                    if ($result == false) {
                        die("ereur requête : " . mysqli_error($session));
                    }*/
                     foreach ($talentTab as $value) { /* Afficher le détail de chaque besoin */
                        if ($value['talent']->getVisibiliteT() == 1) {

 echo '<h1> cocuouc '.$value['talent']->getCodeC() . '</h1>';
                            echo('<div class="form-row align-items-center">');
                            echo('<div class="col-auto my-1">');
                            echo('<label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>');
                            echo('<select class="custom-select mr-sm-2" name="categorie" id="inlineFormCustomSelect" >');
                            echo('<option value="' .  $value['talent']->getCodeC() . '" name="categorie" selected>' . $value["nom"] . '</option>');
                            
                            $categorieBDD = new categorieBDD($bdd);
                            
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
                            echo ('<input type="text" name="titre" class="form-control col-md-4" id="inputEmail4" maxlength="20" value="' . $value['talent']->getTitreT() . '" required>');
                            echo ('</div>');

                            echo('<div class="form-group">');
                            echo('<label for="inputEmail4">Description du besoin(<span style="color:red">*</span>)</label><br/>');
                            echo('<textarea rows="4" cols="50" name="description" required>' . $value['talent']->getDescriptionT() . '</textarea>');
                            echo('</div>');

                            if ($value['talent']->getTypeT() == "Pro") {
                                echo('<div class="form-group">');
                                echo('<label for="inputAddress">Type de talent(<span style="color:red">*</span>)</label>');
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

                            if ($value['talent']->getTypeT() == "Perso") {
                                echo('<div class="form-group">');
                                echo('<label for="inputAddress">Type de talent(<span style="color:red">*</span>)</label>');
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


                            if ($value['talent']->getTypeT() == "Pro et Perso") {
                                echo('<div class="form-group">');
                                echo('<label for="inputAddress">Type de talent(<span style="color:red">*</span>)</label>');
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
                            echo('<button name="codeT" type="submit" value="' .$value['talent']->getCodeT() . '" class="btn btn-primary">Modifier</button>');
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