<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Link -->
        <?php
        require_once('FONCTIONCOMMUNE/Fonctions.php');
        require_once('FONCTIONNALITE/link.php');
        require_once('BDD/connexion.bdd.php');
        require_once('BDD/besoin.bdd.php');
        require_once('BDD/talent.bdd.php');
        require_once('BDD/atelier.bdd.php');
        require_once('BDD/projet.bdd.php');
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
    
</head>
<body>
    <!-- Menu -->
    <?php require_once('FONCTIONNALITE/menu.php'); ?><!-- Fin Menu -->
    <!--=========================================================================================================================================-->
    <?php
    require_once('FONCTIONNALITE/slide.html.php');
    ?><!--=========================================================================================================================================-->
    <section class="feature-section section-gap-full" id="feature-section">
        <div class="container">

            <div class="row align-items-center feature-wrap">


                <form method="get" id="form-pro-perso">
                    <?php
                    require_once('FONCTIONCOMMUNE/Fonctions.php');
                    
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
                        <h1><a href="FONCTIONNALITE/BESOIN/Besoin.php">Les besoins</a></h1>
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
                       require_once('FONCTIONCOMMUNE/Fonctions.php');


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
                                

                                if ($value['besoin']->getVisibiliteB() == 1 && strtotime($value['besoin']->getDateButoireB()) >= strtotime(date("Y-m-d H:i:s"))) {
                                    
                                    $conteurBesoin++;
                                    
                                    if ($value['besoin']->getTypeB() == 'Pro et Perso') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-info">' . $value['besoin']->getTypeB() . '</span></h5>');
                                    } elseif ($value['besoin']->getTypeB() == 'Pro') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-success">' . $value['besoin']->getTypeB() . '</span></h5>');
                                    } elseif ($value['besoin']->getTypeB() == 'Perso') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-warning">' . $value['besoin']->getTypeB() . '</span></h5>');
                                    }
                                    echo ('<div class="card" style="width: 12rem;">');
                                    echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                                    echo ('<div class="card-body card text-center">');
                                    echo ('<h5 class="card-title">' . $value['besoin']->getTitreB() . '</h5>');
                                    echo ('<p class="card-text"><strong>Délais souhaité: </strong><br>' . $value['besoin']->getDateButoireB() . '</p>');
                                    echo ('<a href="FONCTIONNALITE/BESOIN/BesoinX.php?t=' . $value['besoin']->getCodeB() . '" class="btn btn-outline-dark">Voir la demande</a>');
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
                        <h1><a href="FONCTIONNALITE/TALENT/Talent.php">Les talents</a></h1>
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
                              
                                //var_dump($value['besoin']->getDateButoireB());

                                if ($value['talent']->getVisibiliteT() == 1) {
                                    $conteurTalent++;
                                    if ($value['talent']->getTypeT() == 'Pro et Perso') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-info">' . $value['talent']->getTypeT() . '</span></h5>');
                                    } elseif ($value['talent']->getTypeT() == 'Pro') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-success">' . $value['talent']->getTypeT() . '</span></h5>');
                                    } elseif ($value['talent']->getTypeT() == 'Perso') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-warning">' . $value['talent']->getTypeT() . '</span></h5>');
                                    }
                                    echo ('<div class="card" style="width: 12rem;">');
                                    echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                                    echo ('<div class="card-body card text-center">');
                                    echo ('<h5 class="card-title">' . $value['talent']->getTitreT() . '</h5>');

                                    echo ('<a href="FONCTIONNALITE/TALENT/TalentX.php?t=' . $value['talent']->getCodeT() . '" class="btn btn-outline-dark">Voir la demande</a>');
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
                <script>

                   var show_per_page = 4;
                   var current_page = 0;

                   function set_display(first, last) {
                       $('#cartesB').children().css('display', 'none');
                       $('#cartesB').children().slice(first, last).css('display', 'block');
                   }
                   function set_display2(first, last) {
                       $('#cartesT').children().css('display', 'none');
                       $('#cartesT').children().slice(first, last).css('display', 'block');
                   }
                   
                   function set_display3(first, last) {
                       $('#cartesA').children().css('display', 'none');
                       $('#cartesA').children().slice(first, last).css('display', 'block');
                   }
                   
                   function set_display4(first, last) {
                       $('#cartesP').children().css('display', 'none');
                       $('#cartesP').children().slice(first, last).css('display', 'block');
                   }

                   function previous(){
                       if($('.active').prev('.page_link').length) go_to_page(current_page - 1);
                   }

                   function next(){
                       if($('.active').next('.page_link').length) go_to_page(current_page + 1);
                   }
                   
                   function previous2(){
                       if($('.active').prev('.page_link').length) go_to_page2(current_page - 1);
                   }

                   function next2(){
                       if($('.active').next('.page_link').length) go_to_page2(current_page + 1);
                   }
                   
                    function previous3(){
                       if($('.active').prev('.page_link').length) go_to_page3(current_page - 1);
                   }

                   function next3(){
                       if($('.active').next('.page_link').length) go_to_page3(current_page + 1);
                   }
                   
                   function previous4(){
                       if($('.active').prev('.page_link').length) go_to_page4(current_page - 1);
                   }

                   function next4(){
                       if($('.active').next('.page_link').length) go_to_page4(current_page + 1);
                   }
                   
                   function go_to_page(page_num){
                       current_page = page_num;
                       start_from = current_page * show_per_page;
                       end_on = start_from + show_per_page;
                       set_display(start_from, end_on);
                       $('.active').removeClass('active');
                       $('#id' + page_num).addClass('active');
                   }
                   
                   function go_to_page2(page_num){
                       current_page = page_num;
                       start_from = current_page * show_per_page;
                       end_on = start_from + show_per_page;
                       set_display2(start_from, end_on);
                       $('.active').removeClass('active');
                       $('#sid' + page_num).addClass('active');
                   }
                   
                   function go_to_page3(page_num){
                       current_page = page_num;
                       start_from = current_page * show_per_page;
                       end_on = start_from + show_per_page;
                       set_display3(start_from, end_on);
                       $('.active').removeClass('active');
                       $('#id3' + page_num).addClass('active');
                   }
                   
                   function go_to_page4(page_num){
                       current_page = page_num;
                       start_from = current_page * show_per_page;
                       end_on = start_from + show_per_page;
                       set_display4(start_from, end_on);
                       $('.active').removeClass('active');
                       $('#id3' + page_num).addClass('active');
                   }
                   
                   $(document).ready(function() {

                       var number_of_pages = Math.ceil($('#cartesB').children().length / show_per_page);
                       var number_of_pages2 = Math.ceil($('#cartesT').children().length / show_per_page);
                       var number_of_pages3 = Math.ceil($('#cartesA').children().length / show_per_page);
                       var number_of_pages4 = Math.ceil($('#cartesP').children().length / show_per_page);
                       
                       var nav = '<nav aria-label="Page navigation example" class="page"><ul class="pagination justify-content-center"><li class="page-item"><a class="page-link" href="javascript:previous();">Précédent<\/a>';
                       var nav2 = '<nav aria-label="Page navigation example" class="page"><ul class="pagination justify-content-center"><li class="page-item"><a class="page-link" href="javascript:previous2();">Précédent<\/a>';
                       var nav3 = '<nav aria-label="Page navigation example" class="page"><ul class="pagination justify-content-center"><li class="page-item"><a class="page-link" href="javascript:previous3();">Précédent<\/a>';
                       var nav4 = '<nav aria-label="Page navigation example" class="page"><ul class="pagination justify-content-center"><li class="page-item"><a class="page-link" href="javascript:previous4();">Précédent<\/a>';
                       
                       var i = -1;
                       while(number_of_pages > ++i){
                           nav += '<li class="page_link'
                           if(!i) nav += ' active';
                           nav += '" id="id' + i +'">';
                           nav += '<a class="page-link" href="javascript:go_to_page(' + i +')">'+ (i + 1) +'<\/a>';
                       }
                       nav += '<li class="page-item"><a class="page-link" href="javascript:next();">Suivant<\/a><\/ul><\/nav>';

                       $('#page_navigation').html(nav);
                       set_display(0, show_per_page);

                       var i = -1;
                       while(number_of_pages2 > ++i){
                           nav2 += '<li class="page_link'
                           if(!i) nav2 += ' active';
                           nav2 += '" id="sid' + i +'">';
                           nav2 += '<a class="page-link" href="javascript:go_to_page2(' + i +')">'+ (i + 1) +'<\/a>';
                       }
                       nav2 += '<li class="page-item"><a class="page-link" href="javascript:next2();">Suivant<\/a><\/ul><\/nav>';

                       $('#page_navigation2').html(nav2);
                       set_display2(0, show_per_page);
                       
                       var i = -1;
                       while(number_of_pages3 > ++i){
                           nav3 += '<li class="page_link'
                           if(!i) nav += ' active';
                           nav3 += '" id="id3' + i +'">';
                           nav3 += '<a class="page-link" href="javascript:go_to_page3(' + i +')">'+ (i + 1) +'<\/a>';
                       }
                       nav3 += '<li class="page-item"><a class="page-link" href="javascript:next3();">Suivant<\/a><\/ul><\/nav>';

                       $('#page_navigation3').html(nav3);
                       set_display3(0, show_per_page);
                       
                       
                       var i = -1;
                       while(number_of_pages4 > ++i){
                           nav4 += '<li class="page_link'
                           if(!i) nav += ' active';
                           nav4 += '" id="id3' + i +'">';
                           nav4 += '<a class="page-link" href="javascript:go_to_page4(' + i +')">'+ (i + 1) +'<\/a>';
                       }
                       nav4 += '<li class="page-item"><a class="page-link" href="javascript:next4();">Suivant<\/a><\/ul><\/nav>';

                       $('#page_navigation4').html(nav4);
                       set_display4(0, show_per_page);

                   });

      </script>
                <!--=========================================================================================================================================-->
                <div class="container" id="ateliers">
                    <div class="col-lg-12 header-left">
                        <h1><a href="FONCTIONNALITE/ATELIER/Atelier.php">Les ateliers</a></h1>
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
                               
                                //var_dump($value['besoin']->getDateButoireB());

                                if ($value['atelier']->getVisibiliteA() == 1 && strtotime($value['atelier']->getDateFinA()) >= strtotime(date("Y-m-d H:i:s"))) {
                                    $conteurAtelier++;
                                    
                                    if ($value['atelier']->getTypeA() == 'Pro et Perso') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-info">' . $value['atelier']->getTypeA() . '</span></h5>');
                                    } elseif ($value['atelier']->getTypeA() == 'Pro') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-success">' . $value['atelier']->getTypeA() . '</span></h5>');
                                    } elseif ($value['atelier']->getTypeA() == 'Perso') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-warning">' . $value['atelier']->getTypeA() . '</span></h5>');
                                    }
                                    echo ('<div class="card" style="width: 12rem;">');
                                    echo ('<img src="' . $value["photo"] . '" class="card-img-top" alt="...">');
                                    echo ('<div class="card-body card text-center">');
                                    echo ('<h5 class="card-title">' . $value['atelier']->getTitreA() . '</h5>');
                                    echo ('<p class="card-text"><strong>Date de publication: :</strong><br>' . $value['atelier']->getDatePublicationA() . '</p>');
                                    echo ('<p class="card-text"><strong>Date & Créneau : </strong><br>' . $value['atelier']->getDateDebutA() . ' à ' . $value['atelier']->getDateFinA() . '</p>');
                                    echo ('<a href="FONCTIONNALITE/ATELIER/AtelierX.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Voir le détail</a><br>');
                                    //echo ('<p></p><a href="' . $value['atelier']->getURL() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                    if (isset($usercode)) {
                                        if ($role == "createur") {
                                            echo ('<p></p><a href="FONCTIONNALITE/ATELIER/voirInscritAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Voir les inscrits</a>');
                                        } else if ($role == "participant") {
                                            echo ('<p></p><a href="FONCTIONNALITE/ATELIER/desinscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Je me désinscrit </a>');
                                        } else {
                                            echo ('<p></p><a href="FONCTIONNALITE/ATELIER/inscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                        }
                                    } else {
                                        echo ('<p></p><a href="FONCTIONNALITE/ATELIER/inscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
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
                        <h1><a href="FONCTIONNALITE/TALENT/Talent.php">Les Projets</a></h1>
                    </div>
                    <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                        <form class="form-inline my-2 my-lg-0" method="get">
                            <input aria-label="Search" class="form-control mr-sm-2" name="motT" placeholder="Animation/BI/..." type="search"> <button class="btn btn-outline-dark" type="submit">Recherche</button>
                        </form><?php is_login_new_talent(); ?>
                    </div>
                    <div class="flex-parent d-flex flex-wrap justify-content-around mt-3" id="cartesP">
                        <?php
                        $projet = new projetBDD($bdd);
                        $projetTab = $projet->selectProjetEtPhoto($mot);
                        if (!empty($projetTab)) {
                            
                            //Ce compteur sert à gerer la situation où $projetTab contient au moins un objet et la date butoire est passe
                            $conteurProjet = 0;
                                    
                            foreach ($projetTab as $value) {

                                if ($value['projet']->getVisibiliteP() == 1 && strtotime($value['projet']->getDateButoireP()) >= strtotime(date("Y-m-d H:i:s"))) {
                                    $conteurProjet++;

                                    if (isset($usercode)) {
                                        $role = $projet->saisirRoleUserProjet($value['projet']->getCodeP(), $usercode);
                                    }
                                   
                                    //var_dump($value['besoin']->getDateButoireB());
                                    if ($value['projet']->getTypeP() == 'Pro et Perso') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-info">' . $value['projet']->getTypeP() . '</span></h5>');
                                    } elseif ($value['projet']->getTypeP() == 'Pro') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-success">' . $value['projet']->getTypeP() . '</span></h5>');
                                    } elseif ($value['projet']->getTypeP() == 'Perso') {
                                        echo ('<div class="card-margin"><h5><span class="badge badge-warning">' . $value['projet']->getTypeP() . '</span></h5>');
                                    }


                                    echo ('<div class="card" style="width: 12rem;">');
                                    echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                                    echo ('<div class="card-body card text-center">');
                                    echo ('<h5 class="card-title">' . $value['projet']->getTitreP() . '</h5>');
                                    echo ('<p class="card-text"><strong>Date de publication: </strong><br>' . date("d-m-yy", strtotime($value['projet']->getDatePublicationP())) . '</p>');
                                    echo ('<p class="card-text"><strong>Date & Créneau : </strong><br>' . $value['projet']->getDateButoireP() . '</p>');
                                    echo ('<a href="FONCTIONNALITE/PROJET/ProjetX.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Voir la demande</a>');
                                    if (isset($usercode)) {
                                        if ($role == "createur") {
                                            echo ('<p></p><a href="FONCTIONNALITE/PROJET/voirInscritProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Voir les inscrits</a>');
                                        } else if ($role == "participant") {
                                            echo ('<p></p><a href="FONCTIONNALITE/PROJET/desinscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je me désinscrit </a>');
                                        } else {
                                            echo ('<p></p><a href="FONCTIONNALITE/PROJET/inscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
                                        }
                                    } else {
                                        echo ('<p></p><a href="FONCTIONNALITE/PROJET/inscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je m\'inscris</a>');
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
                    <div id="page_navigation4"></div>
                </div>
            </div>
    </section>

    <!-- footer -->
    <?php require('FONCTIONNALITE/footer.php'); ?>
    <!-- Fin footer -->


</body>
</html>
