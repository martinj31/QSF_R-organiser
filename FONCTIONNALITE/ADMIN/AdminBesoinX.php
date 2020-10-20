<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/besoin.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
        ?>
        <!-- Link -->

        <title>Admin Besoin X</title>


    </head>
    <body>


        <!-- Menu -->
<?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Admin Besoin X</h1>

            </div>
            <div class="container">
                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                
                 $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                $bdd = $db->connect();

                $besoins = new besoinBDD($bdd);
                $T = $_GET['t'];
                 $besoinTab = $besoins->un_besoinx($T);
                 
                 foreach ($besoinTab as $value) {

                    echo ('<h1>' . $value['besoin']->getTitreB() . '</h1>');
                    echo ('<h3> Date Butoire: ' . date("d-m-yy", strtotime($value['besoin']->getDateButoireB())) . '</h3>');
                    echo ('<p> Date Publication: ' . date("d-m-yy", strtotime($value['besoin']->getDatePublicationB())) . '</p>');
                    echo ('<p><img src="' . $value["photo"] . '" class="card-img-top" alt="..." height="200" style="width: 20rem;"</p>');
                    echo ('<p><strong>Type: </strong>' . $value['besoin']->getTypeB() . '</p>');
                    echo ('<p><strong>Description</strong></p><p>' . $value['besoin']->getDescriptionB() . '</p>');
                    
                }
                 
                 
                 
                 
                /*$query = "select b.CodeB, b.TypeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ";
                $result = mysqli_query($session, $query);

                if ($result == false) {
                    die("ereur requête : " . mysqli_error($session));
                }
                while ($ligne = mysqli_fetch_array($result)) { /* Afficher le détail de chaque besoin */

                   /* echo ('<h1>' . $ligne["TitreB"] . '</h1>');
                    echo ('<h3> Date Butoire: ' . date("d-m-yy", strtotime($ligne["DateButoireB"])) . '</h3>');
                    echo ('<p> Date Publication: ' . date("d-m-yy", strtotime($ligne["DatePublicationB"])) . '</p>');
                    echo ('<p><img src="' . $ligne["PhotoC"] . '" class="card-img-top" alt="..." height="200" style="width: 20rem;"</p>');
                    echo ('<p><strong>Type: </strong>' . $ligne["TypeB"] . '</p>');
                    echo ('<p><strong>Description</strong></p><p>' . $ligne["DescriptionB"] . '</p>');
                }*/
                ?>
            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>

