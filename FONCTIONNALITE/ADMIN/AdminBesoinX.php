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
                <?php 
                
                 require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                
                 $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                $bdd = $db->connect();

                $besoins = new besoinBDD($bdd);
                $T = $_GET['t'];
                 $besoinTab = $besoins->un_besoinx($T);
                 
                 foreach ($besoinTab as $value) {

                    echo ('<h1 class="text-center">' . $value['besoin']->getTitreB() . '</h1>');
                   
                }
                ?>

            </div>
            <div class="container containerdescription">
                <?php
               
                 
                 foreach ($besoinTab as $value) {

                     echo ('<p><img src="' . $value["photo"] . '" class="card-img-top" alt="..."  style="width: 15rem;"</p>');
                    echo ('<p><strong>Date Butoire: </strong>' . date("d-m-Y", strtotime($value['besoin']->getDateButoireB())) . '</p>');
                    echo ('<p><strong> Date Publication: </strong>' . date("d-m-Y", strtotime($value['besoin']->getDatePublicationB())) . '</p>');
                    
                    echo ('<p><strong>Type: </strong>' . $value['besoin']->getTypeB() . '</p>');
                    echo ('<p><strong>Description: </strong>' . $value['besoin']->getDescriptionB() . '</p>');
                    
                }
                 
                 
                ?>
            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>

