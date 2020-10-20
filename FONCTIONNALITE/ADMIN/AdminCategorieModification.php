<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/connexion.bdd.php');
        require_once('../../BDD/categorie.bdd.php');
        ?>
        <!-- Link -->

        <title>Modifier une catégorie</title>


    </head>
    <body>


        <!-- Menu -->
<?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Modifier une catégorie</h1>

            </div>
            <div class="container">
                <br>
                <form action="AdminCategorieFonction.php" method="POST">

                    <?php
                    $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                    $bdd = $db->connect();

                    $categories = new categorieBDD($bdd);
                    $T = $_GET['t'];
                    $categorie = $categories->une_Categorie($T);
                    /*$query = "select CodeC, NomC, DescriptionC, PhotoC from categories where CodeC = $T ";
                    $result = mysqli_query($session, $query);

                    if ($result == false) {
                        die("ereur requête : " . mysqli_error($session));
                    }*/
                    if($categorie != null) { /* Afficher le détail de chaque besoin */

                        echo ('<div class="form-group">');
                        echo ('<label for="inputEmail4">Nom de catégorie</label>');
                        echo ('<input type="text" name="nomc" class="form-control col-md-4" id="inputEmail4" maxlength="20" value="' . $categorie->getNomC() . '" required>');
                        echo ('</div>');

                        echo('<div class="form-group">');
                        echo('<label for="inputEmail4">Description de catégorie</label><br/>');
                        echo('<textarea rows="4" cols="50" name="descriptionc" required>' . $categorie->getDescriptionC() . '</textarea>');
                        echo('</div>');

                        echo('<div class="form-group">');
                        echo('<label for="inputEmail4">URL de photo</label><br/>');
                        echo('<textarea rows="4" cols="50" name="photoc" required>' . $categorie->getPhotoC() . '</textarea>');
                        echo('</div>');

                        echo('<div class="form-group">');
                        echo('<button name="modifier" type="submit" value="' . $categorie->getCodeC() . '" class="btn btn-light">MODIFIER</button>');
                        echo('</div>');
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