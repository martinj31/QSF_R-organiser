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

            <div class="container">
                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');





                foreach ($projetTab as $value) {
                    if (isset($usercode)) {
                        $role = $projetBDD->saisirRoleUserProjet($value['projet']->getCodeP(), $usercode);
                    }

                   
                        echo ('<p> Date Butoire: ' . date("d-m-yy", strtotime($value['projet']->getDateButoireP())) . '</p>');
                        echo ('<p> Date Publication: ' . date("d-m-yy", strtotime($value['projet']->getDatePublicationP())) . '</p>');
                        echo ('<p><img src="' . $value['photo'] . '" class="card-img-top" alt="..."  style="width: 35rem;"</p>');
                        echo ('<p><strong>Type: </strong>' . $value['projet']->getTypeP() . '</p>');
                        echo ('<p><strong>Lieu : </strong></p><p>' . $value['projet']->getLieuP() . '</p>');
                        echo ('<p><strong>Description : </strong></p><p>' . $value['projet']->getDescriptionP() . '</p>');
                        echo ('<hr>');
                        if (isset($usercode)) {
                            if ($role == "createur") {
                                echo ('<p></p><a href="../PROJET/voirInscritProjet.php?t=' . $value['projet']->getCodeP() . '"><button type="button" class="btn btn-dark btn-light">Voir les inscrits</button></a>');
                                echo ('<a href="admin.php"><button type="button" class="btn btn-dark btn-light">Retour</button></a>'); 
                            } else if ($role == "participant") {
                                echo ('<p></p><a href="../PROJET/voirInscritProjet.php?t=' . $value['projet']->getCodeP() . '"><button type="button" class="btn btn-dark btn-light">Voir les inscrits</button></a>');
                                echo ('<p></p><a href="../PROJET/desinscriptionProjet.php?t=' . $value['projet']->getCodeP() . '"><button type="button" class="btn btn-dark btn-light">Je me désinscrit </button></a>');
                                echo ('<a href="admin.php"><button type="button" class="btn btn-dark btn-light">Retour</button></a>');
                            } else {
                                echo ('<p></p><a href="../PROJET/voirInscritProjet.php?t=' . $value['projet']->getCodeP() . '"><button type="button" class="btn btn-dark btn-light">Voir les inscrits</button></a>');
                                echo ('<p></p><a href="../PROJET/inscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" ><button type="button" class="btn btn-dark btn-light">Je m\'inscris</button></a>');
                                echo ('<a href="admin.php"><button type="button" class="btn btn-dark btn-light">Retour</button></a>');
                            }
                        } else {
                            echo ('<p></p><a href="../PROJET/inscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                            echo ('<a href="admin.php"><button type="button" class="btn btn-dark btn-light">Retour</button></a>');
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
