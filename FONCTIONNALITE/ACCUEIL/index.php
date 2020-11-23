<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Link -->
        <?php
        require_once '../../FONCTIONCOMMUNE/Fonctions.php';
        require_once "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/connexion.bdd.php');
        require_once('../../BDD/besoin.bdd.php');
        require_once('../../BDD/talent.bdd.php');
        require_once('../../BDD/atelier.bdd.php');
        require_once('../../BDD/projet.bdd.php');
        ?><!-- Link -->
        <title>Plateforme</title><!-- Custom styles for this template -->

        <link href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700" rel="stylesheet"><!--
      CSS
      ============================================= -->
        <!--<link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
       <link href="css/themify-icons.css" rel="stylesheet">
       <link href="css/owl.carousel.min.css" rel="stylesheet">
       <link href="css/animate.css" rel="stylesheet">
       
       <link href="css/responsive.css" rel="stylesheet">
       <script src="../../SCRIPT/jquery.js">-->
    </script>
</head>
<body>
    <!-- Menu -->
    <?php require_once "../../FONCTIONNALITE/menu.php"; ?><!-- Fin Menu -->
    <!--=========================================================================================================================================-->
    <?php
    require_once('../../FONCTIONNALITE/slide.html.php');
    ?><!--=========================================================================================================================================-->
    <section class="feature-section section-gap-full" id="feature-section">
        <div class="container">

            <div class="row align-items-center feature-wrap">


                <form method="get" id="form-pro-perso">
                    <?php
                    if (empty($_SESSION['email'])) {
                        echo ('<div class="btn-group" role="group" aria-label="Basic example">');
                        echo ('<button type="radio" id="tout" class="btn btn-secondary btn-sm" name="tout">Tout</button>');
                        echo ('<button type="radio" id="pro" class="btn btn-secondary btn-sm" name="pro" value="Pro">Pro</button>');
                        echo ('<button type="radio" id="perso" class="btn btn-secondary btn-sm" name="perso" value="Perso">Perso</button>');
                        echo ('</div>');
                    }
                    ?>
                </form>

                <div class="container" id="besoins">
                    <div class="col-lg-12 header-left">
                        <h1><a href="../BESOIN/Besoin.php">Les besoins</a></h1>
                    </div>
                    <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                        <form class="form-inline my-2 my-lg-0" method="get">
                            <input aria-label="Search" class="form-control mr-sm-2" name="motB" placeholder="Fitness/Excel/..." type="search"> <button class="btn btn-outline-dark" type="submit">Recherche</button>
                        </form><?php
                        is_login_new_besoin();

                        $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                        $bdd = $db->connect();

                        $besoins = new besoinBDD($bdd);
                        $talents = new talentBDD($bdd);
                        $ateliers = new atelierBDD($bdd);
                        $besoins->updateVisible();

                        ?>
                    </div>
                    <div class="flex-parent d-flex flex-wrap justify-content-around mt-3" id="cartesB">
                        <?php
                        require_once('../../FONCTIONCOMMUNE/Fonctions.php');


                        if (isset($_SESSION['type'])) {
                            $sType = $_SESSION['type'];
                        } else {
                            $sType = NULL;
                        }
                        // echo $sType.'   '.$_SESSION['type'];
                        if (isset($_SESSION['email'])) {
                            $sEmail = $_SESSION['email'];
                        } else {
                            $sEmail = NULL;
                        }

                        if (isset($_POST['type'])) {
                            $pType = $_POST['type'];
                        } else {
                            $pType = NULL;
                        }

                        if (isset($_POST['categorie'])) {
                            $pCategorie = $_POST['categorie'];
                        } else {
                            $pCategorie = NULL;
                        }

                        if (isset($_GET['mot'])) {
                            $mot = $_GET['mot'];
                        } else {
                            $mot = NULL;
                        }

                        if (isset($_GET['pro'])) {
                            $gPro = $_GET['pro'];
                        } else {
                            $gPro = NULL;
                        }


                        if (isset($_GET['perso'])) {
                            $gPerso = $_GET['perso'];
                        } else {
                            $gPerso = NULL;
                        }


                        $besoinTab = $besoins->selectBesoinsEtPhotoAccueil($pType, $sEmail, $sType, $gPro, $gPerso, $mot);


                        if (!empty($besoinTab)) {
                            
                             //Ce compteur sert à gerer la situation où $projetTab contient au moins un objet et la date butoire est passe
                            $conteurBesoin = 0;
                            
                            foreach ($besoinTab as $value) {
                                echo '<br><br>';

                                if ($value['besoin']->getVisibiliteB() == 1 && strtotime($value['besoin']->getDateButoireB()) >= strtotime(date("yy/m/d"))) {
                                    
                                    $conteurBesoin++;
                                    
                                    if ($value['besoin']->getTypeB() == 'Pro et Perso') {
                                        echo ('<div><h5><span class="badge badge-info">' . $value['besoin']->getTypeB() . '</span></h5>');
                                    } elseif ($value['besoin']->getTypeB() == 'Pro') {
                                        echo ('<div><h5><span class="badge badge-success">' . $value['besoin']->getTypeB() . '</span></h5>');
                                    } elseif ($value['besoin']->getTypeB() == 'Perso') {
                                        echo ('<div><h5><span class="badge badge-warning">' . $value['besoin']->getTypeB() . '</span></h5>');
                                    }
                                    echo ('<div class="card" style="width: 12rem;">');
                                    echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                                    echo ('<div class="card-body card text-center">');
                                    echo ('<h5 class="card-title">' . $value['besoin']->getTitreB() . '</h5>');
                                    echo ('<p class="card-text">Délais souhaité: ' . $value['besoin']->getDateButoireB() . '</p>');
                                    echo ('<a href="../BESOIN/BesoinX.php?t=' . $value['besoin']->getCodeB() . '" class="btn btn-outline-dark">Voir la demande</a>');
                                    echo ('</div>');
                                    echo ('</div></div>');
                                }
                            }
                            if($conteurBesoin == 0){
                                echo('<h5>Aucun résultat</h5>');
                            }
                            
                        } else {

                            echo('<h5>Aucun résultat</h5>');
                        }



                        ?>
                    </div>
                    <div id="page_navigation"></div>
                </div>
                <!--=========================================================================================================================================-->
                <div class="container" id="talents">
                    <div class="col-lg-12 header-left">
                        <h1><a href="../TALENT/Talent.php">Les talents</a></h1>
                    </div>
                    <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                        <form class="form-inline my-2 my-lg-0" method="get">
                            <input aria-label="Search" class="form-control mr-sm-2" name="motT" placeholder="Animation/BI/..." type="search"> <button class="btn btn-outline-dark" type="submit">Recherche</button>
                        </form><?php is_login_new_talent(); ?>
                    </div>
                    <div class="flex-parent d-flex flex-wrap justify-content-around mt-3" id="cartesT">
                        <?php
                        $talentTab = $talents->selectTalenttEtPhotoAccueil($pType, $sEmail, $sType, $gPro, $gPerso, $mot);


                        if (!empty($talentTab)) {

                            $conteurTalent = 0;
                            foreach ($talentTab as $value) {
                                echo '<br><br>';
                                //var_dump($value['besoin']->getDateButoireB());

                                if ($value['talent']->getVisibiliteT() == 1) {
                                    $conteurTalent++;
                                    if ($value['talent']->getTypeT() == 'Pro et Perso') {
                                        echo ('<div><h5><span class="badge badge-info">' . $value['talent']->getTypeT() . '</span></h5>');
                                    } elseif ($value['talent']->getTypeT() == 'Pro') {
                                        echo ('<div><h5><span class="badge badge-success">' . $value['talent']->getTypeT() . '</span></h5>');
                                    } elseif ($value['talent']->getTypeT() == 'Perso') {
                                        echo ('<div><h5><span class="badge badge-warning">' . $value['talent']->getTypeT() . '</span></h5>');
                                    }
                                    echo ('<div class="card" style="width: 12rem;">');
                                    echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                                    echo ('<div class="card-body card text-center">');
                                    echo ('<h5 class="card-title">' . $value['talent']->getTitreT() . '</h5>');

                                    echo ('<a href="../TALENT/TalentX.php?t=' . $value['talent']->getCodeT() . '" class="btn btn-outline-dark">Voir la demande</a>');
                                    echo ('</div>');
                                    echo ('</div></div>');
                                }
                            }
                            
                            if($conteurTalent == 0){
                                 echo('<h5>Aucun résultat</h5>');
                            }
                        } else {

                            echo('<h5>Aucun résultat</h5>');
                        }



                        ?>
                    </div>
                    <div id="page_navigation2"></div>
                </div>
                <script src="../SCRIPT/index.js"></script>
                <!--=========================================================================================================================================-->
                <div class="container" id="ateliers">
                    <div class="col-lg-12 header-left">
                        <h1><a href="../ATELIER/Atelier.php">Les ateliers</a></h1>
                    </div>
                    <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                        <form class="form-inline my-2 my-lg-0" method="get">
                            <input aria-label="Search" class="form-control mr-sm-2" name="motA" placeholder="Fitness/Excel/..." type="search"> <button class="btn btn-outline-dark" type="submit">Recherche</button>
                        </form><?php is_login_new_atelier(); ?>
                    </div>
                    <div class="flex-parent d-flex flex-wrap justify-content-around mt-3" id="cartesA">
                        <?php
                        $ateliersTab = $ateliers->selectAtelierEtPhotoAccueil($pType, $sEmail, $sType, $gPro, $gPerso, $mot);


                        if (!empty($ateliersTab)) {
                            
                            //Ce compteur sert à gerer la situation où $ateliersTab contient au moins un objet et la date butoire est passe
                            $conteurAtelier = 0;
                            
                            foreach ($ateliersTab as $value) {
                                        
                                if (isset($usercode)) {
                                    $role = $ateliers->saisirRoleUserAtelier($value['atelier']->getCodeA(), $usercode);
                                }
                                echo '<br><br>';
                                //var_dump($value['besoin']->getDateButoireB());

                                if ($value['atelier']->getVisibiliteA() == 1 && strtotime($value['atelier']->getDateFinA()) >= strtotime(date("yy/m/d"))) {
                                    $conteurAtelier++;
                                    
                                    if ($value['atelier']->getTypeA() == 'Pro et Perso') {
                                        echo ('<div><h5><span class="badge badge-info">' . $value['atelier']->getTypeA() . '</span></h5>');
                                    } elseif ($value['atelier']->getTypeA() == 'Pro') {
                                        echo ('<div><h5><span class="badge badge-success">' . $value['atelier']->getTypeA() . '</span></h5>');
                                    } elseif ($value['atelier']->getTypeA() == 'Perso') {
                                        echo ('<div><h5><span class="badge badge-warning">' . $value['atelier']->getTypeA() . '</span></h5>');
                                    }
                                    echo ('<div class="card" style="width: 12rem;">');
                                    echo ('<img src="' . $value["photo"] . '" class="card-img-top" alt="...">');
                                    echo ('<div class="card-body card text-center">');
                                    echo ('<h5 class="card-title">' . $value['atelier']->getTitreA() . '</h5>');
                                    echo ('<p class="card-text">Date de publication: ' . $value['atelier']->getDatePublicationA() . '</p>');
                                    echo ('<p class="card-text">Date & Créneau : ' . $value['atelier']->getDateDebutA() . ' à ' . $value['atelier']->getDateFinA() . '</p>');
                                    echo ('<a href="../ATELIER/AtelierX.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Voir le détail</a><br>');
                                    //echo ('<p></p><a href="' . $value['atelier']->getURL() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                    if (isset($usercode)) {
                                        if ($role == "createur") {
                                            echo ('<p></p><a href="../ATELIER/voirInscritAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Voir les inscrits</a>');
                                        } else if ($role == "participant") {
                                            echo ('<p></p><a href="../ATELIER/desinscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Je me désinscrit </a>');
                                        } else {
                                            echo ('<p></p><a href="../ATELIER/inscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                        }
                                    } else {
                                        echo ('<p></p><a href="../ATELIER/inscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                    }
                                    echo ('</div>');
                                    echo ('</div></div>');
                                }
                            }
                            
                            if($conteurAtelier == 0){
                                echo('<h5>Aucun résultat</h5>');
                            }
                        } else {

                            echo('<h5>Aucun résultat</h5>');
                        }




                        ?>
                    </div>
                    <div id="page_navigation3"></div>

                </div>

                <!--=========================================================================================================================================-->
                <div class="container" id="talents">
                    <div class="col-lg-12 header-left">
                        <h1><a href="../TALENT/Talent.php">Les Projets</a></h1>
                    </div>
                    <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                        <form class="form-inline my-2 my-lg-0" method="get">
                            <input aria-label="Search" class="form-control mr-sm-2" name="motT" placeholder="Animation/BI/..." type="search"> <button class="btn btn-outline-dark" type="submit">Recherche</button>
                        </form><?php is_login_new_talent(); ?>
                    </div>
                    <div class="flex-parent d-flex flex-wrap justify-content-around mt-3" id="cartesT">
                        <?php
                        $projet = new projetBDD($bdd);
                        $projetTab = $projet->selectProjetEtPhoto($mot);
                        if (!empty($projetTab)) {
                            
                            //Ce compteur sert à gerer la situation où $projetTab contient au moins un objet et la date butoire est passe
                            $conteurProjet = 0;
                                    
                            foreach ($projetTab as $value) {

                                if ($value['projet']->getVisibiliteP() == 1 && strtotime($value['projet']->getDateButoireP()) >= strtotime(date("yy/m/d"))) {
                                    $conteurProjet++;

                                    if (isset($usercode)) {
                                        $role = $projet->saisirRoleUserProjet($value['projet']->getCodeP(), $usercode);
                                    }
                                    echo '<br><br>';
                                    //var_dump($value['besoin']->getDateButoireB());
                                    if ($value['projet']->getTypeP() == 'Pro et Perso') {
                                        echo ('<div><h5><span class="badge badge-info">' . $value['projet']->getTypeP() . '</span></h5>');
                                    } elseif ($value['projet']->getTypeP() == 'Pro') {
                                        echo ('<div><h5><span class="badge badge-success">' . $value['projet']->getTypeP() . '</span></h5>');
                                    } elseif ($value['projet']->getTypeP() == 'Perso') {
                                        echo ('<div><h5><span class="badge badge-warning">' . $value['projet']->getTypeP() . '</span></h5>');
                                    }


                                    echo ('<div class="card" style="width: 12rem;">');
                                    echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                                    echo ('<div class="card-body card text-center">');
                                    echo ('<h5 class="card-title">' . $value['projet']->getTitreP() . '</h5>');
                                    echo ('<p class="card-text">Date de publication: ' . date("d-m-yy", strtotime($value['projet']->getDatePublicationP())) . '</p>');
                                    echo ('<p class="card-text">Date & Créneau : ' . $value['projet']->getDateButoireP() . '</p>');
                                    echo ('<a href="../PROJET/ProjetX.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Voir la demande</a>');
                                    if (isset($usercode)) {
                                        if ($role == "createur") {
                                            echo ('<p></p><a href="../PROJET/voirInscritProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Voir les inscrits</a>');
                                        } else if ($role == "participant") {
                                            echo ('<p></p><a href="../PROJET/desinscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je me désinscrit </a>');
                                        } else {
                                            echo ('<p></p><a href="../PROJET/inscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                        }
                                    } else {
                                        echo ('<p></p><a href="../PROJET/inscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                    }

                                    echo ('</div>');
                                    echo ('</div></div>');
                                } 
                            }
                            if($conteurProjet == 0){
                                echo('<h5>Aucun résultat</h5>');
                            }
                            
                        } else {

                            echo('<h5>Aucun résultat</h5>');
                        }
                        
                        ?>
                    </div>
                    <div id="page_navigation2"></div>
                </div>
            </div>
    </section>

    <!-- footer -->
    <?php require "../../FONCTIONNALITE/footer.php"; ?>
    <!-- Fin footer -->


</body>
</html>
