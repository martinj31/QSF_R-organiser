<!doctype html>
<html lang="fr">
<head>
    
<!-- Link -->
 <?php require "../../FONCTIONNALITE/link.php"; ?>
<!-- Link -->

<title>Les talents</title>

    
  </head>
  <body>

    
<!-- Menu -->
 <?php require "../../FONCTIONNALITE/menu.php"; ?>
<!-- Fin Menu -->


        <div class="jumbotron">
          
          <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Les talents</h1>

</div>
          <div class="container">
			
         <br><br>
                       <?php is_login_new_talent(); ?>

<br><br>
            
            <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                 <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-light" data-toggle="modal" data-target="#exampleModal">
                三 Filtre
                </button>
                
            <form action="Talent.php" method="post">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Filter les talents</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                         <h3> Par catégorie </h3>
                            <?php
                             require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                             $query = "select CodeC, NomC from categories where VisibiliteC = 1";
                             $result = mysqli_query ($session, $query);
                             if (mysqli_num_rows($result)>0) {       
                                while ($ligne = mysqli_fetch_array($result)) { 
                                    echo ('<label class="radio-inline"> <input type="checkbox" name="categorie[]" value="'.$ligne["CodeC"].'"> <strong>'.$ligne["NomC"].'</strong>  </label> ');
                                }     
                             }
                             ?>
                            
                        
                        <?php     
                        if (empty($_SESSION['email'])) {
                            echo ('<br><br>');
                            echo ('<h3> Par type </h3><p>(Ne pas choisir si vous voulez tous affichés)</p>');
                            echo ('<label class="radio-inline"><input type="radio" name="type" value="Pro"><em><strong>Pro</strong></em></label>');
                            echo ('<label class="radio-inline"><input type="radio" name="type" value="Perso"><em><strong>Perso</strong></em></label>');
                        }
                      ?>
                      </div>
                        
                      <div class="modal-footer">
                        <button type="reset" value="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
                
              <input type=button value="Tout affficher" class="btn btn-light" onclick="location='Talent.php'"> 
                 
              <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">
                    <input class="form-control mr-sm-2" type="search" name="mot" placeholder="Entrez un mot clé" aria-label="Recherche">
                    <button type="submit" class="btn btn-outline-dark">Recherche</button>
              </form>
            </div> 
            
            <div class="flex-parent d-flex flex-wrap justify-content-around mt-3">
            <?php
             require_once('../../FONCTIONCOMMUNE/Fonctions.php');
             
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
                        $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '{$_SESSION['type']}' OR t.TypeT ='Pro et Perso') and t.CodeC in $st order by CodeT DESC";
                    } else {                                                // Utilisateur connecté, sélectionné les catégories, son type est Pro et Perso
                        $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.CodeC in $st order by CodeT DESC";
                    }
                } else {                                                    // Utilisateur connecté, n'a pas sélectionner les catégories
                    if ($_SESSION['type'] != NULL) {                        // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro ou Perso
                        $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '{$_SESSION['type']}' OR t.TypeT ='Pro et Perso') order by CodeT DESC";
                    } else {                                                // Utilisateur connecté, n'a pas sélectionner les catégories, son type est Pro et Perso
                        $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC order by CodeT DESC";
                    }
                }   
            } else {

                if (isset($_POST['type']) && isset($_POST['categorie'])) {      // V-si un visiteur choisit les deux filtres
                    $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '{$_POST['type']}' OR t.TypeT ='Pro et Perso') and t.CodeC in $st order by CodeT DESC";
                } elseif (isset($_POST['type'])) {                              // V-si un visiteur choisit filtre type
                    $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and (t.TypeT = '{$_POST['type']}' OR t.TypeT ='Pro et Perso') order by CodeT DESC";
                } elseif (isset($_POST['categorie'])) {                         // V-si un visiteur choisit filtre categorie
                    $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.CodeC in $st order by CodeT DESC";
                }  else {                                                       // V-si un visiteur rien choisit 
                    $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC order by CodeT DESC";
                }
            }                
               
            if(isset($_GET['mot']) AND !empty($_GET['mot'])) {     /*Recherche par mot clé*/
                $mot = htmlspecialchars($_GET['mot']);
                if(isset($_SESSION['email']) and $_SESSION['type'] != NULL) {
                   $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT LIKE '%$mot%' and t.TypeT = '{$_SESSION['type']}' order by t.CodeT DESC";
                } else {
                   $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.TypeT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT LIKE '%$mot%' order by t.CodeT DESC";
                }                   
            }

               $result = mysqli_query ($session, $query);

               if (mysqli_num_rows($result)>0) {       
                   while ($ligne = mysqli_fetch_array($result)) {                      /* Afficher tous les besoins par l'ordre chronologique en format carte */
                     if ($ligne["VisibiliteT"] == 1){
                           if ($ligne["TypeT"] == 'Pro et Perso') {
                               echo ('<div><h5><span class="badge badge-info">'.$ligne["TypeT"].'</span></h5>');
                           } elseif ($ligne["TypeT"] == 'Pro') {
                               echo ('<div><h5><span class="badge badge-success">'.$ligne["TypeT"].'</span></h5>');
                           } elseif ($ligne["TypeT"] == 'Perso') {
                               echo ('<div><h5><span class="badge badge-warning">'.$ligne["TypeT"].'</span></h5>');
                           }                                  
                       echo ('<div class="card" style="width: 12rem;">');                              
                       echo ('<img src="'.$ligne["PhotoC"].'" class="card-img-top" alt="...">');   
                       echo ('<div class="card-body card text-center">');
                       echo ('<h5 class="card-title">'.$ligne["TitreT"].'</h5>');
                       echo ('<a href="TalentX.php?t='.$ligne["CodeT"].'" class="btn btn-outline-dark">Voir le détail</a>'); 
                       echo ('</div>');   
                       echo ('</div></div>');             
                     }
                   }
               } else {
                 echo('<h5>Aucun résultat</h5>');
               }                                          
            ?>
            </div>
          </div>
        </div>

<!-- footer -->
 <?php require "../../FONCTIONNALITE/footer.php"; ?>
<!-- Fin footer -->

</body>
</html>