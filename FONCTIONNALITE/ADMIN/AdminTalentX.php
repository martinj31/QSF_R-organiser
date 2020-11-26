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
                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                $T = $_GET['t'];

                $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                $bdd = $db->connect();

                $talents = new talentBDD($bdd);

                $talentTab = $talents->selectTalentX($T);


                foreach ($talentTab as $value) {

                    echo ('<h1 class="text-center">' . $value['talent']->getTitreT() . '</h1>');
                    
                }


             
                ?> 

            </div>
            <div class="container containerdescription">
                <?php
                

                foreach ($talentTab as $value) {

                     echo ('<p><img src="' .  $value["photo"] . '" class="card-img-top" alt="..."  style="width: 15rem;"</p>');
                    echo ('<p><strong> Date Publication: </strong>' . date("d-m-yy", strtotime($value['talent']->getDatePublicationT())) . '</p>');
                   
                    echo ('<p><strong>Type: </strong>' . $value['talent']->getTypeT() . '</p>');
                    echo ('<p><strong>Description</strong>' . $value['talent']->getDescriptionT() . '</p>');
                }


             
                ?>            
            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>

