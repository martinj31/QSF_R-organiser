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
                <h1 class="text-center">Admin Atelier X</h1>

            </div>
            <div class="container">
                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                $T = $_GET['t'];
                
                
                $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                $bdd = $db->connect();

                $ateliers = new atelierBDD($bdd);
                //$besoins = new besoin();

                $atelierTab = $ateliers->selectAtelierX($T);
                
                
                
               
                    
                
                foreach ($atelierTab as $value) {
                   
                        echo ('<h1>' . $value['atelier']->getTitreA() . '</h1>');
                    echo ('<h3> Date  & Créneau horaire : ' . $value['atelier']->getDateA() . '</h3>');
                    echo ('<p> Date Publication : ' . date("d-m-yy", strtotime($value['atelier']->getDatePublicationA())) . '</p>');
                    echo ('<p><img src="' . $value["photo"] . '" class="card-img-top" alt="..." height="200" style="width: 20rem;"</p>');
                    echo ('<p><strong>Type d\'atelier : </strong>' . $value['atelier']->getTypeA() . '</p>');
                    echo ('<p><strong>Description</strong></p><p>' . $value['atelier']->getDescriptionA() . '</p>');
                    echo ('<p><strong>Lieu d\'atelier : </strong>' . $value['atelier']->getLieuA() . '</p>');
                    echo ('<p><strong>Nombre de personnes maximum : </strong>' . $value['atelier']->getNombreA() . '</p>');
                    echo ('<strong>En savoir plus : </strong><a href="' . $value['atelier']->getPlusA() . '" target="_blank">' . $value['atelier']->getPlusA() . '</a>');
                    
                }
                
                
                
               
                
               
                
               /* $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeA = '$T' ";
                $result = mysqli_query($session, $query);

                if ($result == false) {
                    die("ereur requête : " . mysqli_error($session));
                }
                while ($ligne = mysqli_fetch_array($result)) { /* Afficher le détaille de chaque talent */

                   /* echo ('<h1>' . $ligne["TitreA"] . '</h1>');
                    echo ('<h3> Date  & Créneau horaire : ' . $ligne["DateA"] . '</h3>');
                    echo ('<p> Date Publication : ' . date("d-m-yy", strtotime($ligne["DatePublicationA"])) . '</p>');
                    echo ('<p><img src="' . $ligne["PhotoC"] . '" class="card-img-top" alt="..." height="200" style="width: 20rem;"</p>');
                    echo ('<p><strong>Type d\'atelier : </strong>' . $ligne["TypeA"] . '</p>');
                    echo ('<p><strong>Description</strong></p><p>' . $ligne["DescriptionA"] . '</p>');
                    echo ('<p><strong>Lieu d\'atelier : </strong>' . $ligne["LieuA"] . '</p>');
                    echo ('<p><strong>Nombre de personnes maximum : </strong>' . $ligne["NombreA"] . '</p>');
                    echo ('<strong>En savoir plus : </strong><a href="' . $ligne["PlusA"] . '" target="_blank">' . $ligne["PlusA"] . '</a>');
                }*/
                ?>            
            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>

