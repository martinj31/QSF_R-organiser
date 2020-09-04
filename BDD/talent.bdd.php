<?php

    function afficher_cartes_talents() {  //fonction pour l'affichage des cartes besoins

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
                               $requete = $bdd->query("select c.NomC, t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '{$_SESSION['type']}' OR t.TypeT ='Pro et Perso') and t.CodeC in $st order by CodeT DESC");
                           } else {                                                // Utilisateur connecté, sélectionné les catégories, son type est Pro et Perso
                               $requete = $bdd->query("select c.NomC, t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.CodeC in $st order by CodeT DESC");
                           }
                       } else {                                                    // Utilisateur connecté, n'a pas sélectionner les catégories
                           if ($_SESSION['type'] != NULL) {                        // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro ou Perso
                               $requete = $bdd->query("select c.NomC, t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '{$_SESSION['type']}' OR t.TypeT ='Pro et Perso') order by CodeT DESC");
                           } else {                                                // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro et Perso
                               $requete = $bdd->query("select c.NomC, t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC order by CodeT DESC");
                           }
                       } 
                   } else {
                       if (isset($_POST['type']) && isset($_POST['categorie'])) { // V-si un visiteur choisit les deux filtres
                           $requete = $bdd->query("select c.NomC, t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '{$_POST['type']}' OR t.TypeT ='Pro et Perso') and t.CodeC in $st order by CodeT DESC");
                       } elseif (isset($_POST['type'])) {  // V-si un visiteur choisit filtre type
                           $requete = $bdd->query("select c.NomC, t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '{$_POST['type']}' OR t.TypeT ='Pro et Perso') order by CodeT DESC");
                       } elseif (isset($_POST['categorie'])) { // V-si un visiteur choisit filtre categorie
                           $requete = $bdd->query("select c.NomC, t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.CodeC in $st order by CodeT DESC");
                       }  else {  // V-si un visiteur rien choisit 
                           $requete = $bdd->query("select c.NomC, t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC order by CodeT DESC");
                       }
                   }


            if(isset($_GET['mot']) AND !empty($_GET['mot'])) {     /*Recherche par mot clé*/
                       $mot = htmlspecialchars($_GET['mot']);
                       if(isset($_SESSION['email']) and $_SESSION['type'] != NULL) {
                           $requete = $bdd->query("select c.NomC, t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT LIKE '%$mot%' and t.TypeT = '{$_SESSION['type']}' order by t.CodeT DESC");                     
                       } else {
                          $requete = $bdd->query("select c.NomC, t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT LIKE '%$mot%' order by t.CodeT DESC"); 
                       }
                   }

           if ($requete == true) {
               while ($resultat = $requete ->fetch()) {
                    if ($resultat["VisibiliteT"] == 1) {   
                        // Fonctions pour gérer les badges
                                   if ($resultat["TypeT"] == 'Pro et Perso') {
                                       echo ('<div><h5><span class="badge badge-info">'.$resultat["TypeT"].'</span></h5>');
                                   } elseif ($resultat["TypeT"] == 'Pro') {
                                       echo ('<div><h5><span class="badge badge-success">'.$resultat["TypeT"].'</span></h5>');
                                   } elseif ($resultat["TypeT"] == 'Perso') {
                                       echo ('<div><h5><span class="badge badge-warning">'.$resultat["TypeT"].'</span></h5>');
                                   }               
                                   echo('<div class="card" style="width: 12rem;">');                                 
                                   echo('<img src="'.$resultat['PhotoC'].'" class="card-img-top" alt="'.$resultat['NomC'].'">');
                                   echo('<div class="card-body card text-center">');
                                   echo('<h5 class="card-title">'.$resultat['TitreT'].'</h5>');
                                   echo('<a href="talentx.html.php?t='.$resultat['CodeT'].'" class="btn btn-outline-dark">Voir la demande</a>');
                                   echo('</div>');
                                   echo('</div>');
                                   echo('</div>'); 
                                    }
               } 
           } else {
               echo('<h5> Aucun résultat</h5>');
           }  
       }

    function un_talentx(){   //fonction pour afficher les information d'un carte talent
        
          $bdd = connect();
          
          $requete = $bdd->query("select c.NomC, t.TitreT, t.VisibiliteT, t.TypeT, c.PhotoC, t.DatePublicationT, t.DescriptionT from talents t, categories c where t.CodeC = c.CodeC and t.CodeT = '{$_GET['t']}' ");
         
          if ($requete == true) {
            while ($resultat = $requete ->fetch()) {
                 if ($resultat["VisibiliteT"] == 1) {                 
                    echo ('<h1>'.$resultat["TitreT"]. '</h1>');                        
                    echo ('<p> Date Publication: '.$resultat["DatePublicationT"].'</p>'); //Afficher ou pas ?
                    echo ('<p><img src="'.$resultat["PhotoC"].'" class="card-img-top" alt="'.$resultat['NomC'].'" height="200" style="width: 20rem;"</p>');
                    echo ('<p><strong>Type: </strong>'.$resultat["TypeT"].'</p>');                        
                    echo ('<p><strong>Description</strong></p><p>'.$resultat["DescriptionT"].'</p>'); 
                    echo ('<hr>');
                    
                    if(isset($_SESSION['email'])){
                       echo ('<a href="mailtalent.php?t='.$resultat["TitreT"].'"><button type="button" class="btn btn-dark btn-lg">Contacter</button></a>');
                    } else {
                       echo ('<a href="connexion.html.php"><button type="button" class="btn btn-dark btn-lg">Contacter</button></a>');
                    }   
                     
                 }
            } 
           } else {
               echo('<h5> Désolé, ce talent ne peut pas être affiché. </h5>');   
           }              
    }
 
    
    
    
?>