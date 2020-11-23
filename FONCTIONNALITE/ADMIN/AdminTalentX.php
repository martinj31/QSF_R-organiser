<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";

        require_once('../../BDD/talent.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
        ?>
        <!-- Link -->

        <title>Admin Talent X</title>


    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Admin Talent X</h1>

            </div>
            <div class="container">
                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                $T = $_GET['t'];

                $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                $bdd = $db->connect();

                $talents = new talentBDD($bdd);

                $talentTab = $talents->selectTalentX($T);


                foreach ($talentTab as $value) {

                    echo ('<h1>' . $value['talent']->getTitreT() . '</h1><br>');
                    echo ('<p> Date Publication: ' . date("d-m-yy", strtotime($value['talent']->getDatePublicationT())) . '</p>');
                    echo ('<p><img src="' .  $value["photo"] . '" class="card-img-top" alt="..." height="200" style="width: 20rem;"</p>');
                    echo ('<p><strong>Type: </strong>' . $value['talent']->getTypeT() . '</p>');
                    echo ('<p><strong>Description</strong></p><p>' . $value['talent']->getDescriptionT() . '</p>');
                }


             
                ?>            
            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>

