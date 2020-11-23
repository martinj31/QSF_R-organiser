<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/connexion.bdd.php');
        require_once('../../BDD/categorie.bdd.php');
        require_once('../../BDD/besoin.bdd.php');
        require_once('../../BDD/talent.bdd.php');
        require_once('../../BDD/atelier.bdd.php');
        require_once('../../BDD/projet.bdd.php');
        require_once('../../BDD/utilisateur.bdd.php');
        require_once('../../BDD/compteurT.bdd.php');
        require_once('../../BDD/compteurB.bdd.php');
        require_once('../../BDD/evaluerT.bdd.php');
        require_once('../../BDD/evaluerB.bdd.php');
        require_once('../../BDD/parametres.bdd.php');
        ?>
        <!-- Link -->

        <title>Espace administrateur</title>

        <link href="../../STYLE/admin.css" rel="stylesheet">
    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Espace administrateur</h1>

            </div>
            <div class="container">

                <?php
                if (isset($_SESSION['role'])) {
                    echo '
               <br><br>        <!-- Bouton pour les onglets --> 
                <button class="tablink btn btn-dark" onclick="openPage(\'Catégories\', this, \'orange\')" id="defaultOpen">Catégories</button>&nbsp;&nbsp;   <!-- moteur de recherche : après changer de page ?????-->   
                <button class="tablink btn btn-dark" onclick="openPage(\'Cartes\', this, \'orange\')" >Cartes</button>&nbsp;&nbsp;
                <button class="tablink btn btn-dark" onclick="openPage(\'Utilisateurs\', this, \'orange\')" >Utilisateurs</button>&nbsp;&nbsp;
                <button class="tablink btn btn-dark" onclick="openPage(\'Stats\', this, \'orange\')">Statistiques</button>&nbsp;&nbsp;
                <button class="tablink btn btn-dark" onclick="openPage(\'Bandeau\', this, \'orange\')" >Bandeau</button>&nbsp;&nbsp;
                <button class="tablink btn btn-dark" onclick="openPage(\'Paramètres\', this, \'orange\')">Paramètres</button><br><br>';
//<!--------------------------------------------------------------------------------------------------------------------------------------------->  
                    echo '<div id="Catégories" class="tabcontent">    <!-- Onglet catégorie --> 
                  <h3>Catégories</h3><hr>
                    
                  <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">⊕ Créer </button><br><br>
                    
                  <form action="AdminCategorieFonction.php" method="POST">  <!--Créer une nouvelle catégorie --> 
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Nouvelle catégorie</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">            
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Nom de catégorie :</label>
                              <input name="nomc" type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                              <label for="message-text" class="col-form-label">Description de catégorie :</label>
                              <textarea name="descriptionc" class="form-control" id="message-text"></textarea>
                            </div>
                            <div class="form-group">
                              <label for="message-text" class="col-form-label">URL d\'image :</label>  
                              <textarea name="photoc" class="form-control" id="message-text"></textarea>
                            </div>                        
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn " data-dismiss="modal">Fermer</button>
                          <button name="creer" type="submit" class="btn btn-primary">Créer</button>
                        </div>                     
                      </div>
                    </div>
                  </div>
                  </form>';

                    $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                    $bdd = $db->connect();

                    $categorieBDD = new categorieBDD($bdd);

                    //$query = "select CodeC, NomC from categories where VisibiliteC = 1";
                    // $result = mysqli_query ($session, $query);
                    $CategorieTab = $categorieBDD->allCategorieNameAndId();

                    /* $query = "select CodeC, NomC, DescriptionC, PhotoC, VisibiliteC from categories";

                      $result = mysqli_query($session, $query);

                      if ($result == false) {
                      die("ereur requête : " . mysqli_error($session));
                      } */

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les catégories existantes */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Nom</th>');
                    echo ('<th scope="col">Description</th>');
                    echo ('<th scope="col"><center>Photo</center></th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');


                    if (!empty($CategorieTab)) {

                        foreach ($CategorieTab as $value) {
                            if ($value['categorie']->getVisibiliteC() == 1) {
                                echo ('<tr>');
                                echo ('<th scope="row">' . $value['categorie']->getCodeC() . '</th>');
                                echo ('<td>' . $value['categorie']->getNomC() . '</td>');
                                echo ('<td>' . $value['categorie']->getDescriptionC() . '</td>');
                                echo ('<td><img src="' . $value['categorie']->getPhotoC() . '" alt="' . $value['categorie']->getNomC() . '" width="100" height="90"></td>');
                                echo ('<td>');
                                echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');  //Modifier une catégorie
                                echo ('<a href="AdminCategorieModification.php?t=' . $value['categorie']->getCodeC() . '"><button type="button" class="btn "><img src="https://png.pngtree.com/png-vector/20190927/ourlarge/pngtree-pencil-icon-png-image_1753753.jpg" alt="Modifier" width="30" height="30"></button></a>');
                                echo ('<form action="AdminCategorieFonction.php" method="POST">');  //Désactiver une catégorie                            
                                echo ('<button type="button"  class="btn " data-toggle="modal" data-target="#desactiver' . $value['categorie']->getCodeC() . '"><img src="img/trash.png" alt="Désactiver" width="30" height="30"></button>');

                                echo('<div class="modal" tabindex="-1" id="desactiver' . $value['categorie']->getCodeC() . '" role="dialog">');
                                echo('<div class="modal-dialog" role="document">');
                                echo('<div class="modal-content">');
                                echo('<div class="modal-header">');
                                echo('<h5 class="modal-title">Vérification</h5>');
                                echo('<button type="button" class="close" data-dismiss="modal" aria-label="Close">');
                                echo('<span aria-hidden="true">&times;</span>');
                                echo('</button>');
                                echo('</div>');
                                echo('<div class="modal-body">');
                                echo('<p>Êtes-Vous sûr de supprimer cette catégorie ?  </p>');
                                echo('</div>');
                                echo('<div class="modal-footer">');
                                echo('<button name="desactiver" value="' . $value['categorie']->getCodeC() . '" type="submit" class="btn btn-primary">Supprimer</button>');
                                echo('<button type="button" class="btn " data-dismiss="modal">Fermer</button>');
                                echo('</div>');
                                echo('</div>');
                                echo('</div>');
                                echo('</div>');

                                echo ('</form>');
                                echo ('</div>');
                                echo ('</td>');
                                echo ('</tr>');
                            }
                        }
                    }


                    /* if (mysqli_num_rows($result) > 0) {
                      while ($ligne = mysqli_fetch_array($result)) {
                      if ($ligne["VisibiliteC"] == 1) {
                      echo ('<tr>');
                      echo ('<th scope="row">' . $ligne["CodeC"] . '</th>');
                      echo ('<td>' . $ligne["NomC"] . '</td>');
                      echo ('<td>' . $ligne["DescriptionC"] . '</td>');
                      echo ('<td><img src="' . $ligne["PhotoC"] . '" alt="' . $ligne["NomC"] . '" width="100" height="90"></td>');
                      echo ('<td>');
                      echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');  //Modifier une catégorie
                      echo ('<a href="AdminCategorieModification.php?t=' . $ligne["CodeC"] . '"><button type="button" class="btn "><img src="https://png.pngtree.com/png-vector/20190927/ourlarge/pngtree-pencil-icon-png-image_1753753.jpg" alt="Modifier" width="30" height="30"></button></a>');
                      echo ('<form action="AdminCategorieFonction.php" method="POST">');  //Désactiver une catégorie
                      echo ('<button type="button"  class="btn " data-toggle="modal" data-target="#desactiver' . $ligne["CodeC"] . '"><img src="img/trash.png" alt="Désactiver" width="30" height="30"></button>');

                      echo('<div class="modal" tabindex="-1" id="desactiver' . $ligne["CodeC"] . '" role="dialog">');
                      echo('<div class="modal-dialog" role="document">');
                      echo('<div class="modal-content">');
                      echo('<div class="modal-header">');
                      echo('<h5 class="modal-title">Vérification</h5>');
                      echo('<button type="button" class="close" data-dismiss="modal" aria-label="Close">');
                      echo('<span aria-hidden="true">&times;</span>');
                      echo('</button>');
                      echo('</div>');
                      echo('<div class="modal-body">');
                      echo('<p>Êtes-Vous sûr de supprimer cette catégorie ?  </p>');
                      echo('</div>');
                      echo('<div class="modal-footer">');
                      echo('<button name="desactiver" value="' . $ligne["CodeC"] . '" type="submit" class="btn btn-primary">Supprimer</button>');
                      echo('<button type="button" class="btn " data-dismiss="modal">Fermer</button>');
                      echo('</div>');
                      echo('</div>');
                      echo('</div>');
                      echo('</div>');

                      echo ('</form>');
                      echo ('</div>');
                      echo ('</td>');
                      echo ('</tr>');
                      }
                      }
                      } */
                    echo ('</tbody>');
                    echo ('</table>');
                    echo ('</div>');
//<!--------------------------------------------------------------------------------------------------------------------------------------------->   
                    echo '<div id="Cartes" class="tabcontent">      <!-- Onglet carte --> 
                
                  <h3>Cartes</h3><hr>  
           
                  <!-- Tab links -->
                    <div class="tab">
                      <button class="tablinksc" onclick="openCity(event, \'London\')" id="defaultOpenc">Besoins</button>
                      <button class="tablinksc" onclick="openCity(event, \'Paris\')">Talents</button>
                      <button class="tablinksc" onclick="openCity(event, \'Pekin\')">Ateliers</button>
                      <button class="tablinksc" onclick="openCity(event, \'projet\')">Projets</button>
                    </div>

                    <!-- Tab content -->
                    <div id="London" class="tabcontentc">
                    <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                        <h3>Besoins en cours</h3>
                        <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">     <!-- Moteur de recherche dans titre & description -->
                            <input class="form-control mr-sm-2" type="search" name="carteb" placeholder="Titre/Description" aria-label="Recherche">
                            <button type="submit" class="btn btn-outline-dark">Recherche</button>
                        </form>
                    </div>
                  <form action="AdminCarteInapproprieB.php" method="post">';

                    $besoins = new besoinBDD($bdd);

                    $besoinTab = $besoins->selectAllBesoins();
                    // $query = "select CodeB, TitreB, DescriptionB from besoins where VisibiliteB = 1 order by CodeB DESC";

                    if (isset($_GET['carteb']) AND!empty($_GET['carteb'])) { /* Recherche par mot clé dans le titre et description */

                        $carteb = htmlspecialchars($_GET['carteb']);
                        //$query = "select CodeB, TitreB, DescriptionB from besoins where VisibiliteB = 1 and ( TitreB LIKE '%$carteb%' or DescriptionB LIKE '%$carteb%' ) order by CodeB DESC";

                        $besoinTab = $besoins->selectBesoinSearch($carteb);
                    }

                    /* $result = mysqli_query($session, $query);

                      if ($result == false) {
                      die("ereur requête : " . mysqli_error($session));
                      } */

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les besoins existants */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Titre</th>');
                    echo ('<th scope="col">Description</th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');


                    if (!empty($besoinTab)) {

                        foreach ($besoinTab as $value) {
                            if ($value->getVisibiliteB() == 1) {
                                echo ('<tr>');
                                echo ('<th scope="row">' . $value->getCodeB() . '</th>');
                                echo ('<td>' . $value->getTitreB() . '</td>');
                                echo ('<td>' . $value->getDescriptionB() . '</td>');
                                echo ('<td>');
                                echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                                echo ('<a href="AdminBesoinX.php?t=' . $value->getCodeB() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Détail" width="30" height="30"></button></a>');
                                echo ('<button type="submit" name="desactiverb" value="' . $value->getCodeB() . '" class="btn "><img src="img/trash.png" alt="Désactiver" width="30" height="30"></button>');
                                echo ('</div>');
                                echo ('</td>');
                                echo ('</tr>');
                            }
                        }
                    } else {

                        echo('<h5>Aucun résultat</h5>');
                    }




                    /*  if (mysqli_num_rows($result) > 0) {
                      while ($ligne = mysqli_fetch_array($result)) {
                      echo ('<tr>');
                      echo ('<th scope="row">' . $ligne["CodeB"] . '</th>');
                      echo ('<td>' . $ligne["TitreB"] . '</td>');
                      echo ('<td>' . $ligne["DescriptionB"] . '</td>');
                      echo ('<td>');
                      echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                      echo ('<a href="AdminBesoinX.php?t=' . $ligne["CodeB"] . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Détail" width="30" height="30"></button></a>');
                      echo ('<button type="submit" name="desactiverb" value="' . $ligne["CodeB"] . '" class="btn "><img src="img/trash.png" alt="Désactiver" width="30" height="30"></button>');
                      echo ('</div>');
                      echo ('</td>');
                      echo ('</tr>');
                      }
                      } */
                    echo ('</tbody>');
                    echo ('</table>');


                    echo('<br><h3>Besoins cachés</h3><br>');

                    /* $query2 = "select CodeB, TitreB, DescriptionB from besoins where VisibiliteB = 0 order by CodeB DESC";

                      if (isset($_GET['carteb']) AND!empty($_GET['carteb'])) { /* Recherche par mot clé dans le titre et description */
                    /*  $carteb = htmlspecialchars($_GET['carteb']);
                      $query2 = "select CodeB, TitreB, DescriptionB from besoins where VisibiliteB = 0 and ( TitreB LIKE '%$carteb%' or DescriptionB LIKE '%$carteb%' ) order by CodeB DESC";
                      }

                      $result = mysqli_query($session, $query2);

                      if ($result == false) {
                      die("ereur requête : " . mysqli_error($session));
                      } */

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les besoins cachés */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Titre</th>');
                    echo ('<th scope="col">Description</th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');
                    if (!empty($besoinTab)) {

                        foreach ($besoinTab as $value) {
                            if ($value->getVisibiliteB() == 0) {
                                echo ('<tr>');
                                echo ('<th scope="row">' . $value->getCodeB() . '</th>');
                                echo ('<td>' . $value->getTitreB() . '</td>');
                                echo ('<td>' . $value->getDescriptionB() . '</td>');
                                echo ('<td>');
                                echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                                echo ('<a href="AdminBesoinX.php?t=' . $value->getCodeB() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Détail" width="30" height="30"></button></a>');
                                echo ('<button type="submit" name="activerb" value="' . $value->getCodeB() . '" class="btn "><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS82pYv9wgxfx27dUrgTr8zaGjZ6O3O2CONHA&usqp=CAU" alt="Activer" width="30" height="30"></button>');
                                echo ('</div>');
                                echo ('</td>');
                                echo ('</tr>');
                            }
                        }
                    }
                    echo ('</tbody>');
                    echo ('</table>');


                    echo '</form>
                </div>

                <div id="Paris" class="tabcontentc">      
                  <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                    <h3>Talents en cours</h3>
                    <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">
                        <input class="form-control mr-sm-2" type="search" name="cartet" placeholder="Titre/Description" aria-label="Recherche">
                        <button type="submit" class="btn btn-outline-dark">Recherche</button>
                    </form>
                </div>
                    
                  <form action="AdminCarteInapproprieT.php" method="post">';

                    $talents = new talentBDD($bdd);

                    $talentTab = $talents->selectAllTalents();

                    // $query = "select CodeT, TitreT, DescriptionT from talents where VisibiliteT = 1 order by CodeT DESC";

                    if (isset($_GET['cartet']) AND!empty($_GET['cartet'])) { /* Recherche par mot clé dans le titre et description */
                        $cartet = htmlspecialchars($_GET['cartet']);
                        //$query = "select CodeT, TitreT, DescriptionT from talents where VisibiliteT = 1 and ( TitreT LIKE '%$cartet%' or DescriptionT LIKE '%$cartet%' ) order by CodeT DESC";


                        $talentTab = $talents->selectTalentSearch($cartet);
                    }

                    /* $result = mysqli_query($session, $query);

                      if ($result == false) {
                      die("ereur requête : " . mysqli_error($session));
                      } */

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les talents existantes */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Titre</th>');
                    echo ('<th scope="col">Description</th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');

                    if (!empty($talentTab)) {

                        foreach ($talentTab as $value) {
                            if ($value->getVisibiliteT() == 1) {
                                echo ('<tr>');
                                echo ('<th scope="row">' . $value->getCodeT() . '</th>');
                                echo ('<td>' . $value->getTitreT() . '</td>');
                                echo ('<td>' . $value->getDescriptionT() . '</td>');
                                echo ('<td>');
                                echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                                echo ('<a href="AdminTalentX.php?t=' . $value->getCodeT() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Détail" width="30" height="30"></button></a>');
                                echo ('<button type="submit" name="desactivert" value="' . $value->getCodeT() . '" class="btn "><img src="img/trash.png" alt="Désactiver" width="30" height="30"></button>');
                                echo ('</div>');
                                echo ('</td>');
                                echo ('</tr>');
                            }
                        }
                    } else {

                        echo('<h5>Aucun résultat</h5>');
                    }

                   
                    echo ('</tbody>');
                    echo ('</table>');

                    echo('<br><h3>Talents cachés</h3><br>');

                   

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les talents cachés */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Titre</th>');
                    echo ('<th scope="col">Description</th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');
                    if (!empty($talentTab)) {

                        foreach ($talentTab as $value) {
                            if ($value->getVisibiliteT() == 0) {
                                echo ('<tr>');
                                echo ('<th scope="row">' . $value->getCodeT() . '</th>');
                                echo ('<td>' . $value->getTitreT() . '</td>');
                                echo ('<td>' . $value->getDescriptionT() . '</td>');
                                echo ('<td>');
                                echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                                echo ('<a href="AdminTalentX.php?t=' . $value->getCodeT() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Détail" width="30" height="30"></button></a>');
                                echo ('<button type="submit" name="activert" value="' . $value->getCodeT() . '" class="btn "><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS82pYv9wgxfx27dUrgTr8zaGjZ6O3O2CONHA&usqp=CAU" alt="Activer" width="30" height="30"></button>');
                                echo ('</div>');
                                echo ('</td>');
                                echo ('</tr>');
                            }
                        }
                    }
                    echo ('</tbody>');
                    echo ('</table>');

                    echo '</form>
            </div>

                    <div id="Pekin" class="tabcontentc">      
                  <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                    <h3>Ateliers en cours</h3>
                    <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">
                        <input class="form-control mr-sm-2" type="search" name="cartea" placeholder="Titre/Description" aria-label="Recherche">
                        <button type="submit" class="btn btn-outline-dark">Recherche</button>
                    </form>
                </div>
                    
                  <form action="AdminCarteInapproprieA.php" method="post">';



                    $ateliers = new atelierBDD($bdd);

                    $atelierTab = $ateliers->selectAllAteliers();
                    if (isset($_GET['cartea']) AND!empty($_GET['cartea'])) { /* Recherche par mot clé dans le titre et description */
                        $cartet = htmlspecialchars($_GET['cartea']);
                       

                        $atelierTab = $ateliers->selectAtelierSearch($cartet);
                    }

                    

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les talents existantes */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Titre</th>');
                    echo ('<th scope="col">Description</th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');



                    if (!empty($atelierTab)) {

                        foreach ($atelierTab as $value) {
                            if ($value->getVisibiliteA() == 1) {
                                echo ('<tr>');
                                echo ('<th scope="row">' . $value->getCodeA() . '</th>');
                                echo ('<td>' . $value->getTitreA() . '</td>');
                                echo ('<td>' . $value->getDescriptionA() . '</td>');
                                echo ('<td>');
                                echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                                echo ('<a href="AdminAtelierX.php?t=' . $value->getCodeA() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Détail" width="30" height="30"></button></a>');
                                echo ('<button type="submit" name="desactivera" value="' . $value->getCodeA() . '" class="btn "><img src="img/trash.png" alt="Désactiver" width="30" height="30"></button>');
                                echo ('<a  href="AdminInscritAtelier.php?t=' . $value->getCodeA() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Voir les inscrits" width="30" height="30"></button></a>');
                                echo ('</div>');
                                echo ('</td>');
                                echo ('</tr>');
                            }
                        }
                    } else {

                        echo('<h5>Aucun résultat</h5>');
                    }


                   
                    echo ('</tbody>');
                    echo ('</table>');

                    echo('<br><h3>Ateliers cachés</h3><br>');

                   

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les talents cachés */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col"></th>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Titre</th>');
                    echo ('<th scope="col">Description</th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');
                     if (!empty($atelierTab)) {

                        foreach ($atelierTab as $value) {
                            if ($value->getVisibiliteA() == 0) {
                            echo ('<tr>');
                            echo ('<th scope="row">' . $value->getCodeA() . '</th>');
                            echo ('<td>' . $value->getTitreA() . '</td>');
                            echo ('<td>' . $value->getDescriptionA() . '</td>');
                            echo ('<td>');
                            echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                            echo ('<a href="AdminAtelierX.php?t=' . $value->getCodeA() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Détail" width="30" height="30"></button></a>');                          
                            echo ('<button type="submit" name="activera" value="' . $value->getCodeA() . '" class="btn btn-secondary"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS82pYv9wgxfx27dUrgTr8zaGjZ6O3O2CONHA&usqp=CAU" alt="Activer" width="30" height="30"></button>');
                            echo ('</div>');
                            echo ('</td>');
                            echo ('</tr>');
                            }
                        }
                    }
                    echo ('</tbody>');
                    echo ('</table>');
                    echo ('<p>Veuillez choisir un atelier puis saisir un URL pour l\'activer</p>');
                    echo ('<input name="url" type="text"/>');
                   
                    echo ('</form>');
                    echo ('</div>');
                    
                    
                    
                  echo '   
                    
                    <div id="projet" class="tabcontentc">      
                  <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                    <h3>Ateliers en cours</h3>
                    <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">
                        <input class="form-control mr-sm-2" type="search" name="cartep" placeholder="Titre/Description" aria-label="Recherche">
                        <button type="submit" class="btn btn-outline-dark">Recherche</button>
                    </form>
                </div>
                    
                  <form action="AdminCarteInapproprieP.php" method="post">';

                   


                    $projets = new projetBDD($bdd);

                    $projetTab = $projets->selectAllProjets();
                    if (isset($_GET['cartep']) AND!empty($_GET['cartep'])) { /* Recherche par mot clé dans le titre et description */
                        $cartep = htmlspecialchars($_GET['cartea']);
                        // $query = "select CodeA, TitreA, DescriptionA from ateliers where VisibiliteA = 1 and ( TitreA LIKE '%$cartea%' or DescriptionA LIKE '%$cartea%' ) order by CodeA DESC";


                        $projetTab = $projets->selectProjetSearch($cartep);
                    }

                   // var_dump($projetTab);

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les talents existantes */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Titre</th>');
                    echo ('<th scope="col">Description</th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');



                    if (!empty($projetTab)) {

                        foreach ($projetTab as $value) {
                            if ($value->getVisibiliteP() == 1) {
                                echo ('<tr>');
                                echo ('<th scope="row">' . $value->getCodeP() . '</th>');
                                echo ('<td>' . $value->getTitreP() . '</td>');
                                echo ('<td>' . $value->getDescriptionP() . '</td>');
                                echo ('<td>');
                                echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                                echo ('<a href="AdminProjetX.php?t=' . $value->getCodeP() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Détail" width="30" height="30"></button></a>');
                                echo ('<button type="submit" name="desactiverp" value="' . $value->getCodeP() . '" class="btn "><img src="img/trash.png" alt="Désactiver" width="30" height="30"></button>');
                                echo ('<a  href="AdminInscritProjet.php?t=' . $value->getCodeP() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Voir les inscrits" width="30" height="30"></button></a>');
                                echo ('</div>');
                                echo ('</td>');
                                echo ('</tr>');
                            }
                        }
                    } else {

                        echo('<h5>Aucun résultat</h5>');
                    }


                    echo ('</tbody>');
                    echo ('</table>');

                    echo('<br><h3>Ateliers cachés</h3><br>');

                  

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les talents cachés */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Titre</th>');
                    echo ('<th scope="col">Description</th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');
                     if (!empty($projetTab)) {

                        foreach ($projetTab as $value) {
                            if ($value->getVisibiliteP() == 0) {
                            echo ('<tr>');
                           
                            echo ('<th scope="row">' . $value->getCodeP() . '</th>');
                            
                            echo ('<td>' . $value->getTitreP() . '</td>');
                            echo ('<td>' . $value->getDescriptionP() . '</td>');
                             echo ('<td>');
                            echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                            echo ('<a href="AdminProjetX.php?t=' . $value->getCodeP() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Détail" width="30" height="30"></button></a>');                          
                           echo ('<button type="submit" name="activerp" value="' . $value->getCodeP() . '" class="btn btn-secondary"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS82pYv9wgxfx27dUrgTr8zaGjZ6O3O2CONHA&usqp=CAU" alt="Activer" width="30" height="30"></button>');
                            echo ('</div>');
                            echo ('</td>');
                            echo ('</tr>');
                            }
                        }
                    }
                    echo ('</tbody>');
                    echo ('</table>');
                   
                    echo ('</form>');
                    echo ('</div>')
                    ?>         
                    <!-- CSS pour la tab des cartes-->


                    <!-- JS pour la tab des cartes-->
                    <script type="text/javascript" src="../../SCRIPT/admin.js"></script>
                    <?php
                    echo ('</div>');
//<!--------------------------------------------------------------------------------------------------------------------------------------------->       
                    echo '<div id="Utilisateurs" class="tabcontent">      <!-- Onglet utilisateur --> 
                  <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                      <h3>Utilisateurs</h3><hr>
                    <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">  <!-- Moteur de recherche --> 
                        <input class="form-control mr-sm-2" type="search" name="user" placeholder="Nom/Prénom/Email" aria-label="Recherche">
                        <button type="submit" class="btn btn-outline-dark">Recherche</button>
                    </form>
                  </div>
                  <form name="Supprimer" action="AdminUtilisateurFonction.php" method="post">';
                    $utilisateurs = new utilisateurBDD($bdd);

                    $utilisateurTab = $utilisateurs->selectAllUtilisateurs();
                   

                    if (isset($_GET['user']) AND!empty($_GET['user'])) { /* Recherche par mot clé dans prénom, nom, email des utilisateurs */
                        $user = htmlspecialchars($_GET['user']);
                        
                        $utilisateurTab = $utilisateurs->selectUtilisateurSearch($user);
                    }

                    

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les catégories existantes */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Nom</th>');
                    echo ('<th scope="col">Prénom</th>');
                    echo ('<th scope="col">Email</th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');

                    if (!empty($utilisateurTab)) {
                        foreach ($utilisateurTab as $value) {
                            echo ('<tr>');
                            echo ('<th scope="row">' . $value->getCodeU() . '</th>');
                            echo ('<td>' . $value->getNomU() . '</td>');
                            echo ('<td>' . $value->getPrenomU() . '</td>');
                            echo ('<td>' . $value->getEmail() . '</td>');
                            echo ('<td>');
                            echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                            echo ('<a href="AdminUtilisateur.php?t=' . $value->getCodeU() . '"><button type="button" class="btn "><img src="img/loupe.png" alt="Détail" width="30" height="30"></button></a>');
                            echo ('<button type="button"  class="btn " data-toggle="modal" data-target="#supprimer' . $value->getCodeU() . '"><img src="img/trash.png" alt="Désactiver" width="30" height="30"></button>');
                            echo ('</div>');
                            echo ('</td>');
                            echo ('</tr>');

                            echo('<div class="modal" tabindex="-1" id="supprimer' . $value->getCodeU() . '" role="dialog">');
                            echo('<div class="modal-dialog" role="document">');
                            echo('<div class="modal-content">');
                            echo('<div class="modal-header">');
                            echo('<h5 class="modal-title">Vérification</h5>');
                            echo('<button type="button" class="close" data-dismiss="modal" aria-label="Close">');
                            echo('<span aria-hidden="true">&times;</span>');
                            echo('</button>');
                            echo('</div>');
                            echo('<div class="modal-body">');
                            echo('<p>Êtes-Vous sûr de supprimer ce compte ?  </p>');
                            echo('</div>');
                            echo('<div class="modal-footer">');
                            echo('<button name="codeu" value="' . $value->getCodeU() . '" type="submit" class="btn btn-primary">Supprimer</button>');
                            echo('<button type="button" class="btn " data-dismiss="modal">Fermer</button>');
                            echo('</div>');
                            echo('</div>');
                            echo('</div>');
                            echo('</div>');
                        }
                    }



                    echo ('</tbody>');
                    echo ('</table>');
                    echo '</form>
                </div>';
//<!--------------------------------------------------------------------------------------------------------------------------------------------->   
                    echo '<div id="Stats" class="tabcontent">
              <h3>Statistiques</h3><hr>   
              
              <h5>Nombre de connexion du site</h5>
              <a href="https://analytics.google.com/analytics/web/?authuser=1#/report/visitors-overview/a173955301w241368476p225152034/" target="_blank" class="btn btn-light">Aller voir sur Google Analytics</a>
              <p><br></p>
              
              <h5>Mise en relation</h5><hr>';

                    $compteurTBDDs = new compteurTBDD($bdd);
                    $compteurBBDDs = new compteurBBDD($bdd);
                    $evaluerTBDD = new evaluerTBDD($bdd);
                    $evaluerBBDD = new evaluerBBDD($bdd);

                    echo ('<dl>');
                    echo ('<dt>Nombre de mise en relation besoins : ' . $compteurBBDDs->relationBesoinsNBRAll() );
                    
                    echo ('</dt>');
                    echo ('<dd style="text-indent:2em;"> - Nombre de mise en relation réussit : ' . $compteurBBDDs->relationBesoinsNBRReussi() );
                   
                    echo ('</dd>');
                    echo ('<dd style="text-indent:2em;"> - Nombre de mise en relation échoué : ' . $compteurBBDDs->relationBesoinsNBREchoue() );
                   
                    echo ('</dd>');
                    echo ('</dl>');

                    echo ('<dl>');
                    echo ('<dt>Nombre de mise en relation talents : ' . $compteurTBDDs->relationTalentsNBRAll());
                   
                    echo ('</dt>');
                    echo ('<dd style="text-indent:2em;"> - Nombre de mise en relation réussit : ' . $compteurTBDDs->relationTalentsNBRReussi());
                   
                    echo ('</dd>');
                    echo ('<dd style="text-indent:2em;"> - Nombre de mise en relation échoué : ' . $compteurTBDDs->relationTalentsNBREchoue());
                    
                    echo ('</dd>');
                    echo ('</dl><br>');
                    //----------------------------------------------------------------------->                 
                    echo ('<h5>Notes</h5><hr>');
                    echo ('<dl>');
                    echo ('<dt>Note moyenne : ' . $evaluerTBDD->moyenneNoteTAndNoteB());
                    
                    echo ('</dt>');
                    echo ('<dd style="text-indent:2em;"><p> - Moyenne de notes besoin : ' . $evaluerBBDD->moyenneNoteB() );
                   
                    echo ('</p></dd>');
                    echo ('<dd style="text-indent:2em;"><p> - Moyenne de notes talent : ' . $evaluerTBDD->moyenneNoteT());
                  
                    echo ('</p></dd>');
                    echo ('</dl>');
                    //-----------------------------------------------------------------------> 
                    echo ('<br><h5>Retour d\'expérience</h5><hr>');

                    echo ('<h5>Avis besoin</h5>');
                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les catégories existantes */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">besoin</th>');
                    echo ('<th scope="col">Note</th>');
                    echo ('<th scope="col">Commentaire</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');



                    $evalBTab = $evaluerBBDD->selectEvalBesoin();

                    if (!empty($evalBTab)) {

                        foreach ($evalBTab as $value) {


                            echo ('<tr>');
                            echo ('<th scope="row">' . $value->getTitreB() . '</th>');
                            echo ('<td>' . $value->getNoteB() . '</td>');
                            echo ('<td>' . $value->getAvisB() . '</td>');
                            echo ('</tr>');
                        }
                    }


                    echo ('</tbody>');
                    echo ('</table><br><br>');

                    echo ('<h5>Avis talent</h5>');
                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les catégories existantes */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">talent</th>');
                    echo ('<th scope="col">Note</th>');
                    echo ('<th scope="col">Commentaire</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');



                    $evalTTab = $evaluerTBDD->selectEvalTalent();

                    if (!empty($evalTTab)) {

                        foreach ($evalTTab as $value) {


                            echo ('<tr>');
                            echo ('<th scope="row">' . $value->getTitreT() . '</th>');
                            echo ('<td>' . $value->getNoteT() . '</td>');
                            echo ('<td>' . $value->getAvisT() . '</td>');
                            echo ('</tr>');
                        }
                    }


                    echo ('</tbody>');
                    echo ('</table>');

                    echo ('</div>');
//<!--------------------------------------------------------------------------------------------------------------------------------------------->                  
                    echo '<div id="Bandeau" class="tabcontent">
            <h3>Bandeau</h3><hr>';

                    require_once('../../FONCTIONNALITE/slide.html.php');

                    echo '<br>  
        <h4>Modification</h4><hr>
        
        <form method="POST" action="AdminBandeauFonction.php">           
            <h5>Premier slide</h5>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Titre slide 1</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide1_1"></textarea>
                </div>
                
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Photo (URL)</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide1_2"></textarea>
                </div>
          
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Paragraphe 1</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide1_3"></textarea>
                </div>
            
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Paragraphe 2</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide1_4"></textarea>
                </div><br>        
                
            <h5>Deuxième slide</h5>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Titre slide 2</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide2_1"></textarea>
                </div>
            
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Photo (URL)</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide2_2"></textarea>
                </div><br>
            
            <h5>Troisième slide</h5>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Titre slide 3</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide3_1"></textarea>
                </div>
            
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Photo (URL)</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide3_2"></textarea>
                </div>            
            
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Nouvelle</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide3_3"></textarea>
                </div><br>
                
            <h5>Quatième slide</h5>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Titre slide 4</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide4_1"></textarea>
                </div>
            
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Photo (URL)</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide4_2"></textarea>
                </div>             
            
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Commentaire 1</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide4_3"></textarea>
                </div>
            
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Commentaire 2</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide4_4"></textarea>
                </div>
            
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Commentaire 3</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="slide4_5"></textarea>
                </div><br>           
            <input type="submit" class="btn btn-light" value="Modifier">
        </form>        
        </div> ';
//<!--------------------------------------------------------------------------------------------------------------------------------------------->   
                    echo '<div id="Paramètres" class="tabcontent">
                <h3>Paramètres</h3><hr>

                <form method="GET" action="AdminParametresFonction.php">';

                    $parametresBDD = new parametresBDD($bdd);


                    if (!empty($parametresBDD->selectParamtre())) {



                        echo '<p>Le délai actuel est de ' . $parametresBDD->selectParamtre() . ' jours</p>';
                    }

                    

                    echo '<form method="GET" action="AdminParametresFonction.php">
                    <p>Paramétrer le délais d\'envoie de mail d’évaluation : <input type=\'number\' name="interval"> jours </p>
                    <button type="submit" class="btn btn-dark"> Modifier </button>';

                    echo '  </form>
            </div>';
                } else {
                    echo '<div><center><p><br><br><br>Vous n\'avez pas le droit d\'accéder à cette page</p>';
                    echo '<a href="index.php">Retour à l\'acceuil</a></div></center>';
                }

//<!---------------------------------------------------------------------------------------------------------------------------------------------> 
                ?>
                <script>
                    function openPage(pageName, elmnt, color) {
                        // Hide all elements with class="tabcontent" by default */
                        var i, tabcontent, tablinks;
                        tabcontent = document.getElementsByClassName("tabcontent");
                        for (i = 0; i < tabcontent.length; i++) {
                            tabcontent[i].style.display = "none";
                        }

                        // Remove the background color of all tablinks/buttons
                        tablinks = document.getElementsByClassName("tablink");
                        for (i = 0; i < tablinks.length; i++) {
                            tablinks[i].style.backgroundColor = "";
                        }

                        // Show the specific tab content
                        document.getElementById(pageName).style.display = "block";

                        // Add the specific color to the button used to open the tab content
                        elmnt.style.backgroundColor = color;
                    }

                    // Get the element with id="defaultOpen" and click on it
                    document.getElementById("defaultOpen").click();
                </script>
            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>