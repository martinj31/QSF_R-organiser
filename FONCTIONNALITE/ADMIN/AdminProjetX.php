<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php require "../../FONCTIONNALITE/link.php"; ?>
        <!-- Link -->

         <title>Admin Projet X</title>


    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >

                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                require_once('../../BDD/projet.bdd.php');
                require_once('../../BDD/connexion.bdd.php');
                $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                $bdd = $db->connect();

                $projetBDD = new projetBDD($bdd);
                $T = $_GET['t'];

                $projetTab = $projetBDD->un_projetx($T);
                //var_dump($projetTab);
                foreach ($projetTab as $value) {
                    echo ('<h1 class="text-center">' . $value['projet']->getTitreP() . '</h1>');
                }
                ?>

            </div>

            <div class="container containerdescription">
                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');





                foreach ($projetTab as $value) {
                    

                    echo ('<p><img src="' . $value['photo'] . '" class="card-img-top" alt="..."  style="width: 15rem;"</p>');
                        echo ('<p><strong> Date Butoire:  </strong>' . date("d-m-Y", strtotime($value['projet']->getDateButoireP())) . '</p>');
                        echo ('<p><strong> Date Publication:  </strong>' . date("d-m-Y", strtotime($value['projet']->getDatePublicationP())) . '</p>');
                       
                        echo ('<p><strong>Type: </strong>' . $value['projet']->getTypeP() . '</p>');
                        echo ('<p><strong>Lieu: </strong>' . $value['projet']->getLieuP() . '</p>');
                        echo ('<p><strong>Description: </strong>' . $value['projet']->getDescriptionP() . '</p>');
                       
                        
                       
                    
                }
                ?>
            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>
