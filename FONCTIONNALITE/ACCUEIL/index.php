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

                        //$query = "UPDATE besoins SET VisibiliteB = 0 WHERE CURDATE() > DateButoireB";
                        //mysqli_query($session, $query);
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


//selectBesoinsEtPhotoAccueil( $pType, $sEmail, $sType, $gPro, $gPerso, $mot)
                        $besoinTab = $besoins->selectBesoinsEtPhotoAccueil($pType, $sEmail, $sType, $gPro, $gPerso, $mot);


                        if (!empty($besoinTab)) {

                            foreach ($besoinTab as $value) {
                                echo '<br><br>';
                                //var_dump($value['besoin']->getDateButoireB());

                                if ($value['besoin']->getVisibiliteB() == 1) {
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
                        } else {

                            echo('<h5>Aucun résultat</h5>');
                        }







                        /* if (isset($_SESSION['email']) and ($_SESSION['type']) != NULL) {
                          $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = '{$_SESSION['type']}' OR b.TypeB ='Pro et Perso') order by CodeB DESC";
                          } elseif (empty($_SESSION['email']) and isset($_GET['pro'])) {
                          $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = 'Pro' OR b.TypeB ='Pro et Perso') order by CodeB DESC";
                          } elseif (empty($_SESSION['email']) and isset($_GET['perso'])) {
                          $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = 'Perso' OR b.TypeB ='Pro et Perso') order by CodeB DESC";
                          } else {
                          $query = "select  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC order by CodeB DESC";
                          }

                          if (isset($_GET['motB']) AND!empty($_GET['motB'])) { /* Recherche par mot clé */
                        /* $mot = htmlspecialchars($_GET['motB']);
                          if (isset($_SESSION['email']) and $_SESSION['type'] != NULL) {
                          $query = "select b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.TitreB LIKE '%$mot%' and b.TypeB = '{$_SESSION['type']}' order by b.CodeB DESC";
                          } else {
                          $query = "select b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.TitreB LIKE '%$mot%' order by b.CodeB DESC";
                          }
                          }

                          $result = mysqli_query($session, $query);
                          if (mysqli_num_rows($result) > 0) {
                          while ($ligne = mysqli_fetch_array($result)) { /* Afficher tous les besoins par l'ordre chronologique en format carte */
                        /* if ($ligne["VisibiliteB"] == 1) {
                          if ($ligne["TypeB"] == 'Pro et Perso') {
                          echo ('<div><h5><span class="badge badge-info">' . $ligne["TypeB"] . '</span></h5>');
                          } elseif ($ligne["TypeB"] == 'Pro') {
                          echo ('<div><h5><span class="badge badge-success">' . $ligne["TypeB"] . '</span></h5>');
                          } elseif ($ligne["TypeB"] == 'Perso') {
                          echo ('<div><h5><span class="badge badge-warning">' . $ligne["TypeB"] . '</span></h5>');
                          }
                          echo ('<div class="card" style="width: 12rem;">');
                          echo ('<img src="' . $ligne["PhotoC"] . '" class="card-img-top" alt="...">');
                          echo ('<div class="card-body card text-center">');
                          echo ('<h5 class="card-title">' . $ligne["TitreB"] . '</h5>');
                          echo ('<p class="card-text">Délais souhaité: ' . date("d-m-yy", strtotime($ligne["DateButoireB"])) . '</p>');
                          echo ('<a href="../BESOIN/BesoinX.php?t=' . $ligne["CodeB"] . '" class="btn btn-outline-dark">Voir la demande</a>');
                          echo ('</div>');
                          echo ('</div></div>');
                          }
                          }
                          } else {
                          echo('<h5> Aucun résultat</h5>');
                          } */
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

                            foreach ($talentTab as $value) {
                                echo '<br><br>';
                                //var_dump($value['besoin']->getDateButoireB());

                                if ($value['talent']->getVisibiliteT() == 1) {
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
                        } else {

                            echo('<h5>Aucun résultat</h5>');
                        }




                        /* if (isset($_SESSION['email']) and ($_SESSION['type']) != NULL) {
                          $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '{$_SESSION['type']}' or t.TypeT = 'Pro et Perso') order by t.CodeT DESC";
                          } elseif (empty($_SESSION['email']) and isset($_GET['pro'])) {
                          $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = 'Pro' or t.TypeT = 'Pro et Perso') order by t.CodeT DESC";
                          } elseif (empty($_SESSION['email']) and isset($_GET['perso'])) {
                          $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = 'Perso' or t.TypeT = 'Pro et Perso') order by t.CodeT DESC";
                          } else {
                          $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC order by t.CodeT DESC";
                          }


                          if (isset($_GET['motT']) AND!empty($_GET['motT'])) { /* Recherche par mot clé */
                        /* $mot = htmlspecialchars($_GET['motT']);
                          if (isset($_SESSION['email']) and $_SESSION['type'] != NULL) {
                          $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT LIKE '%$mot%' and t.TypeT = '{$_SESSION['type']}' order by t.CodeT DESC";
                          } else {
                          $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT LIKE '%$mot%' order by t.CodeT DESC";
                          }
                          }

                          $result = mysqli_query($session, $query);

                          if (mysqli_num_rows($result) > 0) {
                          while ($ligne = mysqli_fetch_array($result)) { /* Afficher tous les besoins par l'ordre chronologique en format carte */
                        /* if ($ligne["VisibiliteT"] == 1) {
                          if ($ligne["TypeT"] == 'Pro et Perso') {
                          echo ('<div><h5><span class="badge badge-info">' . $ligne["TypeT"] . '</span></h5>');
                          } elseif ($ligne["TypeT"] == 'Pro') {
                          echo ('<div><h5><span class="badge badge-success">' . $ligne["TypeT"] . '</span></h5>');
                          } elseif ($ligne["TypeT"] == 'Perso') {
                          echo ('<div><h5><span class="badge badge-warning">' . $ligne["TypeT"] . '</span></h5>');
                          }
                          echo ('<div class="card" style="width: 12rem;">');
                          echo ('<img src="' . $ligne["PhotoC"] . '" class="card-img-top" alt="...">');
                          echo ('<div class="card-body card text-center">');
                          echo ('<h5 class="card-title">' . $ligne["TitreT"] . '</h5>');
                          echo ('<a href="../TALENT/TalentX.php?t=' . $ligne["CodeT"] . '" class="btn btn-outline-dark">Voir le détail</a>');
                          echo ('</div>');
                          echo ('</div></div>');
                          }
                          }
                          } else {
                          echo('<h5> Aucun résultat</h5>');
                          } */
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

    foreach ($ateliersTab as $value) {

        if (isset($usercode)) {
            $role = $ateliers->saisirRoleUserAtelier($value['atelier']->getCodeA(), $usercode);
        }
        echo '<br><br>';
        //var_dump($value['besoin']->getDateButoireB());

        if ($value['atelier']->getVisibiliteA() == 1) {
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
} else {

    echo('<h5>Aucun résultat</h5>');
}














/* if (isset($_SESSION['email'])) {
  if (isset($st)) {                                            // Utilisateur connecté, sélectionné les catégories
  if ($_SESSION['type'] != NULL) {                        // Utilisateur connecté, sélectionné les catégories, son type est Pro ou Perso
  $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '{$_SESSION['type']}' OR a.TypeA ='Pro et Perso') and a.CodeC in $st order by CodeA DESC";
  } else {                                                // Utilisateur connecté, sélectionné les catégories, son type est Pro et Perso
  $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeC in $st order by CodeA DESC";
  }
  } else {                                                    // Utilisateur connecté, n'a pas sélectionner les catégories
  if ($_SESSION['type'] != NULL) {                        // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro ou Perso
  $query = "select  a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '{$_SESSION['type']}' OR a.TypeA ='Pro et Perso') order by CodeA DESC";
  } else {                                                // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro et Perso
  $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC order by CodeA DESC";
  }
  }
  } else {
  if (isset($_POST['type']) && isset($_POST['categorie'])) { // V-si un visiteur choisit les deux filtres
  $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '{$_POST['type']}' OR a.TypeA ='Pro et Perso') and a.CodeC in $st order by CodeA DESC";
  } elseif (isset($_POST['type'])) {  // V-si un visiteur choisit filtre type
  $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and (a.TypeA = '{$_POST['type']}' OR a.TypeA ='Pro et Perso') order by CodeA DESC";
  } elseif (isset($_POST['categorie'])) { // V-si un visiteur choisit filtre categorie
  $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeC in $st order by CodeA DESC";
  } else {  // V-si un visiteur rien choisit
  $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC order by CodeA DESC";
  }
  }

  if (isset($_GET['motA']) AND!empty($_GET['motA'])) { /* Recherche par mot clé */
/* $mot = htmlspecialchars($_GET['mot']);
  if (isset($_SESSION['email']) and $_SESSION['type'] != NULL) {
  $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.TitreA LIKE '%$mot%' and a.TypeA = '{$_SESSION['type']}' order by a.CodeA DESC";
  } else {
  $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC from ateliers a, categories c where a.CodeC = c.CodeC and a.TitreA LIKE '%$mot%' order by a.CodeA DESC";
  }
  }

  $result = mysqli_query($session, $query);

  if (mysqli_num_rows($result) > 0) {
  while ($ligne = mysqli_fetch_array($result)) { /* Afficher tous les besoins par l'ordre chronologique en format carte */
/* if ($ligne["VisibiliteA"] == 1) {
  if ($ligne["TypeA"] == 'Pro et Perso') {
  echo ('<div><h5><span class="badge badge-info">' . $ligne["TypeA"] . '</span></h5>');
  } elseif ($ligne["TypeA"] == 'Pro') {
  echo ('<div><h5><span class="badge badge-success">' . $ligne["TypeA"] . '</span></h5>');
  } elseif ($ligne["TypeA"] == 'Perso') {
  echo ('<div><h5><span class="badge badge-warning">' . $ligne["TypeA"] . '</span></h5>');
  }
  echo ('<div class="card" style="width: 12rem;">');
  echo ('<img src="' . $ligne["PhotoC"] . '" class="card-img-top" alt="...">');
  echo ('<div class="card-body card text-center">');
  echo ('<h5 class="card-title">' . $ligne["TitreA"] . '</h5>');
  echo ('<p class="card-text">Date de publication: ' . date("d-m-yy", strtotime($ligne["DatePublicationA"])) . '</p>');
  echo ('<p class="card-text">Date & Créneau : ' . $ligne["DateA"] . '</p>');
  echo ('<a href="../ATELIER/AtelierX.php?t=' . $ligne["CodeA"] . '" class="btn btn-outline-dark">Voir le détail</a><br>');
  echo ('<p></p><a href="' . $ligne["URL"] . '" class="btn btn-outline-dark">Je m\'inscris</a>');
  echo ('</div>');
  echo ('</div></div>');
  }
  }
  } else {
  echo('<h5> Aucun résultat</h5>');
  } */
?>
                    </div>
                    <div id="page_navigation3"></div>

                </div>
            </div>
    </section>

    <!-- footer -->
<?php require "../../FONCTIONNALITE/footer.php"; ?>
    <!-- Fin footer -->


</body>
</html>
