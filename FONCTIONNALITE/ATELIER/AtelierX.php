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

        <title>Atelier X</title>


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
                $atelierTab = $ateliers->selectAtelierX($T);


                foreach ($atelierTab as $value) {
                     echo ('<h1 class="text-center">' .$value['atelier']->getTitreA() . '</h1>');
                }

                /* $req = "select a.TitreA from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeA = '$T' ";
                  $resultat = mysqli_query($session, $req);
                  while ($ligne = mysqli_fetch_array($resultat)) {
                  echo ('<h1 class="text-center">' . $ligne["TitreA"] . '</h1>');
                  } */
                ?>

            </div>

            <div class="container containerdescription">
                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                $T = $_GET['t'];
               
                
                if(!empty($atelierTab)){
                    if (isset($usercode)) {
                                $role = $ateliers->saisirRoleUserAtelier($value['atelier']->getCodeA(), $usercode);
                            }
                
                foreach ($atelierTab as $value) {
                     if ($value['atelier']->getVisibiliteA() == 1) {
                         echo ('<p><img src="' . $value["photo"] . '" class="card-img-top" alt="' . $value["nomPhoto"] . '" style="width: 15rem;"</p>');
                        echo ('<p><strong> Date  & Créneau horaire : </strong>' . $value['atelier']->getDateDebutA() . ' à ' . $value['atelier']->getDateFinA() . '</p>');
                        echo ('<p><strong> Date Publication : </strong>' . date("d-m-Y", strtotime($value['atelier']->getDatePublicationA())) . '</p>');
                        
                        echo ('<p><strong>Type d\'atelier : </strong>' . $value['atelier']->getTypeA() . '</p>');
                        echo ('<p><strong>Description: </strong>' . $value['atelier']->getDescriptionA() . '</p>');
                        echo ('<p><strong>Lieu d\'atelier : </strong>' . $value['atelier']->getLieuA() . '</p>');
                        echo ('<p><strong>Nombre de personnes maximum : </strong>' . $value['atelier']->getNombreA() . '</p>');
                        
                        if(!empty($value['atelier']->getPlusA())){
                        echo ('<strong>En savoir plus : </strong><a href="' . $value['atelier']->getPlusA() . '" target="_blank">' . $value['atelier']->getPlusA() . '</a>');
                    }
                        
                        echo ('<hr>');
                        if (!isset($_SESSION['email'])) {
                             echo ('<a href="Login.php"><button type="button" class="btn btn-primary btn-light">Contacter</button></a> ');
                        } 
                        if (isset($usercode)) {
                                    if ($role == "createur") {
                                        echo ('<a href="../ATELIER/voirInscritAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-primary btn-light">Voir les inscrits</a>');
                                    echo ('<a href="Atelier.php"><button type="button" class="btn btn-dark btn-light btn-light-fade">Retour</button></a>');
                                        
                                    } else if ($role == "participant") {
                                        echo ('<a href="../ATELIER/desinscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-primary btn-light">Je me désinscrit </a>');
                                    
                                        echo ('<a href="Atelier.php"><button type="button" class="btn btn-dark btn-light btn-light-fade">Retour</button></a>');
                                    } else {
                                        echo ('<a href="../ATELIER/inscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-primary btn-light">Je m\'inscris</a>');
                                    
                                        echo ('<a href="Atelier.php"><button type="button" class="btn btn-dark btn-light btn-light-fade">Retour</button></a>');
                                    }
                                }else{
                                    echo ('<p></p><a href="../ATELIER/inscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-primary btn-light">Je m\'inscris</a>');
                                
                                    echo ('<a href="Atelier.php"><button type="button" class="btn btn-dark btn-light btn-light-fade">Retour</button></a>');
                                }
                    }
                }
                
                
                }
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                /*$query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC, c.NomC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeA = '$T' ";
                $result = mysqli_query($session, $query);

                if ($result == false) {
                    die("ereur requête : " . mysqli_error($session));
                }
                while ($ligne = mysqli_fetch_array($result)) { /* Afficher le détail de chaque besoin */
                   /* if ($ligne["VisibiliteA"] == 1) {
                        echo ('<p> Date  & Créneau horaire : ' . $ligne["DateA"] . '</p>');
                        echo ('<p> Date Publication : ' . date("d-m-yy", strtotime($ligne["DatePublicationA"])) . '</p>');
                        echo ('<p><img src="' . $ligne["PhotoC"] . '" class="card-img-top" alt="' . $ligne["NomC"] . '" style="width: 35rem;"</p>');
                        echo ('<p><strong>Type d\'atelier : </strong>' . $ligne["TypeA"] . '</p>');
                        echo ('<p><strong>Description</strong></p><p>' . $ligne["DescriptionA"] . '</p>');
                        echo ('<p><strong>Lieu d\'atelier : </strong>' . $ligne["LieuA"] . '</p>');
                        echo ('<p><strong>Nombre de personnes maximum : </strong>' . $ligne["NombreA"] . '</p>');
                        echo ('<strong>En savoir plus : </strong><a href="' . $ligne["PlusA"] . '" target="_blank">' . $ligne["PlusA"] . '</a>');
                        echo ('<hr>');
                        if (isset($_SESSION['email'])) {
                            echo ('<a href="' . $ligne["URL"] . '" target="_blank"><button type="button" class="btn btn-primary btn-light">Je m\'inscris</button></a> ');
                            echo ('<a href="Atelier.php"><button type="button" class="btn btn-dark btn-light">Retour</button></a>');
                        } else {
                            echo ('<a href="Login.php"><button type="button" class="btn btn-primary btn-light">Contacter</button></a> ');
                            echo ('<a href="Atelier.php"><button type="button" class="btn btn-dark btn-light">Retour</button></a>');
                        }
                    }
                }*/
                ?>
            </div>
        </div>




        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>

