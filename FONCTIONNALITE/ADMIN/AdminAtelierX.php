<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/atelier.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
        ?>
        <!-- Link -->

        <title>Admin Atelier X</title>



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

                $ateliers = new atelierBDD($bdd);
                //$besoins = new besoin();

                $atelierTab = $ateliers->selectAtelierX($T);
                
                
                foreach ($atelierTab as $value) {
                   
                        echo ('<h1 class="text-center">' . $value['atelier']->getTitreA() . '</h1>');
                    
                }
               ?>

            </div>
            <div class="container containerdescription">
                <?php
               
                
                    
                
                foreach ($atelierTab as $value) {
                    echo ('<p><img src="' . $value["photo"] . '" class="card-img-top" alt="' . $value["nomPhoto"] . '" style="width: 15rem;"</p>');
                   
                    echo ('<h3><strong> Date : </strong>' . date("d-m-Y", strtotime($value['atelier']->getDateDebutA())) . ' à ' . date("d-m-Y", strtotime($value['atelier']->getDateFinA()))  . '</h3>');
                    echo ('<p><strong> Date Publication : </strong>' . date("d-m-Y", strtotime($value['atelier']->getDatePublicationA())) . '</p>');
                    echo ('<p><strong> Créneau horaire : </strong>' . $value['atelier']->getHoraireA() . '</p>');
                    echo ('<p><strong>Type d\'atelier : </strong>' . $value['atelier']->getTypeA() . '</p>');
                    echo ('<p><strong>Description: </strong>' . $value['atelier']->getDescriptionA() . '</p>');
                    echo ('<p><strong>Lieu d\'atelier : </strong>' . $value['atelier']->getLieuA() . '</p>');
                    echo ('<p><strong>Nombre de personnes maximum : </strong>' . $value['atelier']->getNombreA() . '</p>');
                    if(!empty($value['atelier']->getPlusA())){
                        echo ('<strong>En savoir plus : </strong><a href="' . $value['atelier']->getPlusA() . '" target="_blank">' . $value['atelier']->getPlusA() . '</a>');
                    }
                    
                    
                }
                
                ?>            
            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>

