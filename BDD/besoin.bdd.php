<?php

    function afficher_cartes_besoins() {  //fonction pour l'affichage des cartes besoins
        
        $bdd = connect();
        
        if (isset($_POST['categorie'])) {
                 $st = "(";
                 foreach ($_POST["categorie"] as $categories) {                        
                     $st = $st.$categories;
                     $st = $st.",";
                 }
                 $st = rtrim($st, ',');
                 $st = $st.")";
        }

        if(isset($_SESSION['email'])) {
                    if(isset($st)) {                                            // Utilisateur connecté, sélectionné les catégories
                        if ($_SESSION['type'] != NULL) {                        // Utilisateur connecté, sélectionné les catégories, son type est Pro ou Perso
                            $requete = $bdd->query("select c.NomC, b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = '{$_SESSION['type']}' OR b.TypeB ='Pro et Perso') and b.CodeC in $st order by CodeB DESC");
                        } else {                                                // Utilisateur connecté, sélectionné les catégories, son type est Pro et Perso
                            $requete = $bdd->query("select c.NomC, b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeC in $st order by CodeB DESC");
                        }
                    } else {                                                    // Utilisateur connecté, n'a pas sélectionner les catégories
                        if ($_SESSION['type'] != NULL) {                        // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro ou Perso
                            $requete = $bdd->query("select c.NomC, b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = '{$_SESSION['type']}' OR b.TypeB ='Pro et Perso') order by CodeB DESC");
                        } else {                                                // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro et Perso
                            $requete = $bdd->query("select c.NomC, b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC order by CodeB DESC");
                        }
                    } 
                } else {
                    if (isset($_POST['type']) && isset($_POST['categorie'])) { // V-si un visiteur choisit les deux filtres
                        $requete = $bdd->query("select c.NomC, b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = '{$_POST['type']}' OR b.TypeB ='Pro et Perso') and b.CodeC in $st order by CodeB DESC");
                    } elseif (isset($_POST['type'])) {  // V-si un visiteur choisit filtre type
                        $requete = $bdd->query("select c.NomC,  b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and (b.TypeB = '{$_POST['type']}' OR b.TypeB ='Pro et Perso') order by CodeB DESC");
                    } elseif (isset($_POST['categorie'])) { // V-si un visiteur choisit filtre categorie
                        $requete = $bdd->query("select c.NomC, b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeC in $st order by CodeB DESC");
                    }  else {  // V-si un visiteur rien choisit 
                        $requete = $bdd->query("select c.NomC, b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC order by CodeB DESC");
                    }
                }
       
        
         if(isset($_GET['mot']) AND !empty($_GET['mot'])) {     /*Recherche par mot clé*/
                    $mot = htmlspecialchars($_GET['mot']);
                    if(isset($_SESSION['email']) and $_SESSION['type'] != NULL) {
                        $requete = $bdd->query("select c.NomC, b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.TitreB LIKE '%$mot%' and b.TypeB = '{$_SESSION['type']}' order by b.CodeB DESC");
                    } else {
                        $requete = $bdd->query("select c.NomC, b.CodeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DateButoireB, b.TypeB from besoins b, categories c where b.CodeC = c.CodeC and b.TitreB LIKE '%$mot%' order by b.CodeB DESC");
                    }
                }
        
        if ($requete == true) {
            while ($resultat = $requete ->fetch()) {
                 if ($resultat["VisibiliteB"] == 1) {   
                     // Fonctions pour gérer les badges
                                if ($resultat["TypeB"] == 'Pro et Perso') {
                                    echo ('<div><h5><span class="badge badge-info">'.$resultat["TypeB"].'</span></h5>');
                                } elseif ($resultat["TypeB"] == 'Pro') {
                                    echo ('<div><h5><span class="badge badge-success">'.$resultat["TypeB"].'</span></h5>');
                                } elseif ($resultat["TypeB"] == 'Perso') {
                                    echo ('<div><h5><span class="badge badge-warning">'.$resultat["TypeB"].'</span></h5>');
                                }               
                                echo('<div class="card" style="width: 12rem;">');                                 
                                echo('<img src="'.$resultat['PhotoC'].'" class="card-img-top" alt="'.$resultat['NomC'].'">');
                                echo('<div class="card-body card text-center">');
                                echo('<h5 class="card-title">'.$resultat['TitreB'].'</h5>');
                                echo('<p class="card-text">Délais souhaité: '.$resultat['DateButoireB'].'</p>');
                                //$_SESSION dans href pour le chemin ???
                                echo('<a href="'.$_SESSION['APPLICATION'].'/FONCTIONNALITE/BESOIN/besoinx.html.php?t='.$resultat['CodeB'].'" class="btn btn-outline-dark">Voir la demande</a>');
                                echo('</div>');
                                echo('</div>');
                                echo('</div>'); 
                                 }
            } 
        } else {
            echo('<h5> Aucun résultat</h5>');
        }  
    }
    
    function un_besoinx() {  //fonction pour afficher les information d'un carte besoin
        
          $bdd = connect();
          
          $requete = $bdd->query("select c.NomC, b.TypeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '{$_GET['t']}'");
         
          if ($requete == true) {
            while ($resultat = $requete ->fetch()) {
                 if ($resultat["VisibiliteB"] == 1) {                 
                    echo ('<h1>'.$resultat["TitreB"]. '</h1>');                        
                    echo ('<h3> Date Butoire: '.$resultat["DateButoireB"].'</h3>');
                    echo ('<p> Date Publication: '.$resultat["DatePublicationB"].'</p>');
                    echo ('<p><img src="'.$resultat["PhotoC"].'" class="card-img-top" alt="'.$resultat['NomC'].'" height="200" style="width: 20rem;"</p>');
                    echo ('<p><strong>Type: </strong>'.$resultat["TypeB"].'</p>');                        
                    echo ('<p><strong>Description</strong></p><p>'.$resultat["DescriptionB"].'</p>'); 
                    echo ('<hr>');
                    
                    if(isset($_SESSION['email'])){
                       echo ('<a href="mailbesoin.php?t='.$resultat["TitreB"].'"><button type="button" class="btn btn-dark btn-lg">Contacter</button></a>');
                    } else {
                       echo ('<a href="connexion.html.php"><button type="button" class="btn btn-dark btn-lg">Contacter</button></a>');
                    }   
                     
                 }
            } 
           } else {
               echo('<h5> Désolé, ce besoin ne peut pas être affiché. </h5>');   
           }              
    }
 
    
?>