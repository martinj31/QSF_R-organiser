<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
​
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
​    <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Plateforme</title>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jquery.js"></script>
    
  </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="Accueil.php">Plateforme</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="Accueil.php">Accueil <span class="sr-only">(current)</span> </a> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Besoin.php">Besoins</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Talent.php">Talents</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="AbonnerCategorie.php">Catégories</a>
          </li>  
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropleft">   
            <?php
            require_once 'Fonctions.php';
            
            if(isset($_SESSION['email'])){
                    echo('<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">');
                    echo $_SESSION['email'];       // quand l'utiliateur n'a pas croché le case Anonyme au moment de l'inscription, on va afficher son adresse mail
                    echo('</a>');
            } else {
                echo('<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">');
                echo "Visiteur";                   //Utilisateur qui n'a pas conncté
                echo('</a>');
            } 
            ?>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php
                if(isset($_SESSION['email'])){
                    echo ('<a class="dropdown-item" href="MonProfil.php">Mon profil</a>');
                    echo ('<a class="dropdown-item" href="MesCategories.php">Mes catégories</a>');
                    echo ('<a class="dropdown-item" href="Deconnecter.php" onclick="Deconnexion()">Déconnecter</a>');
                ?>
                    <script>
                        function Deconnexion() {
                            alert("Déconnexion réussite !");
                            }
                            
                         $('.navbar-nav mr-auto').find('a').each(function () {
                            if (this.href == document.location.href || document.location.href.search(this.href) >= 0) {
                                $(this).parent().addClass('active'); // this.className = 'active';
                            }
                        });
                    </script>
                <?php
                } else {
                    echo ('<a class="dropdown-item" href="Login.php">Se connecter</a>');
                    echo ('<a class="dropdown-item" href="Inscription.php">S\'inscrire</a>');
                }
                ?>
            </div>
          </li>
        </ul>
      </div>
    </nav>
<!--------------------------------------------------------------------------------------------------------------------------------------------->   
        <div class="jumbotron">
          <div class="container">
               <h1>Admin</h1>        <!-- Bouton pour les onglets --> 
                <button class="tablink" onclick="openPage('Catégories', this, 'orange')" id="defaultOpen">Catégories</button>   <!-- moteur de recherche : après changer de page ?????-->   
                <button class="tablink" onclick="openPage('Cartes', this, 'orange')" >Cartes</button>
                <button class="tablink" onclick="openPage('Utilisateurs', this, 'orange')" >Utilisateurs</button>
                <button class="tablink" onclick="openPage('Stats', this, 'orange')">Stats</button>
                <button class="tablink" onclick="openPage('Bandeau', this, 'orange')" >Bandeau</button>
                <button class="tablink" onclick="openPage('Paramètres', this, 'orange')">Paramètres</button>
<!--------------------------------------------------------------------------------------------------------------------------------------------->  
                <div id="Catégories" class="tabcontent">    <!-- Onglet catégorie --> 
                  <h3>Catégories</h3><hr>
                    
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">⊕ Créer </button><br><br>
                    
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
                              <label for="message-text" class="col-form-label">Photo de catégorie :</label>  <!-- url de l'image ? -->
                              <textarea name="photoc" class="form-control" id="message-text"></textarea>
                            </div>                        
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button name="creer" type="submit" class="btn btn-primary">Créer</button>
                        </div>                     
                      </div>
                    </div>
                  </div>
                  </form>
                  
                   <?php
                    require_once('Fonctions.php');

                    $query = "select CodeC, NomC, DescriptionC, PhotoC, VisibiliteC from categories";

                    $result = mysqli_query ($session, $query);

                    if ($result == false) {
                        die("ereur requête : ". mysqli_error($session) );
                    }
                    
                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les catégories existantes*/       
                    echo ('<thead>');
                          echo ('<tr>');
                            echo ('<th scope="col">#</th>');
                            echo ('<th scope="col">Nom</th>');
                            echo ('<th scope="col">Description</th>');
                            echo ('<th scope="col">PhotoC</th>');
                            echo ('<th scope="col">Modification</th>');
                          echo ('</tr>');
                        echo ('</thead>');
                        echo ('<tbody>');
                    if (mysqli_num_rows($result)>0) {
                    while ($ligne = mysqli_fetch_array($result)) { 
                        if ($ligne["VisibiliteC"] == 1){
                            echo ('<tr>');
                            echo ('<th scope="row">'.$ligne["CodeC"].'</th>');
                            echo ('<td>'.$ligne["NomC"].'</td>');
                            echo ('<td>'.$ligne["DescriptionC"].'</td>');                       
                            echo ('<td><img src="'.$ligne["PhotoC"].'" alt="'.$ligne["NomC"].'" width="100" height="90"></td>');
                            echo ('<td>');
                             echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');  //Modifier une catégorie
                             echo ('<a href="AdminCategorieModification.php?t='.$ligne["CodeC"].'"><button type="button" class="btn btn-secondary"><img src="https://png.pngtree.com/png-vector/20190927/ourlarge/pngtree-pencil-icon-png-image_1753753.jpg" alt="Modifier" width="30" height="30"></button></a>');
                             echo ('<form action="AdminCategorieFonction.php" method="POST">');  //Désactiver une catégorie
                             echo ('<button name="desactiver" value="'.$ligne["CodeC"].'" type="submit" class="btn btn-secondary"><img src="https://static.vecteezy.com/system/resources/previews/000/630/530/non_2x/trash-can-icon-symbol-illustration-vector.jpg" alt="Supprimer" width="30" height="30"></button>');
                             echo ('</form>');
                             echo ('</div>');
                            echo ('</td>');
                          echo ('</tr>');                     
                    }          
                    }
                    } 
                     echo ('</tbody>');
                    echo ('</table>');
                    ?>                        
                </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------->   
                <div id="Cartes" class="tabcontent">      <!-- Onglet carte --> 
                
                  <h3>Cartes</h3><hr>  
           
                  <!-- Tab links -->
                    <div class="tab">
                      <button class="tablinksc" onclick="openCity(event, 'London')" id="defaultOpenc">Besoins</button>
                      <button class="tablinksc" onclick="openCity(event, 'Paris')">Talents</button>
                    </div>

                    <!-- Tab content -->
                    <div id="London" class="tabcontentc">
                    <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                        <h3>Besoins</h3>
                        <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">     <!-- Moteur de recherche dans titre & description -->
                            <input class="form-control mr-sm-2" type="search" name="carteb" placeholder="Titre/Description" aria-label="Recherche">
                            <button type="submit" class="btn btn-outline-dark">Recherche</button>
                        </form>
                    </div>
                  <form action="AdminCarteInapproprieB.php" method="post">
                  <?php
                   
                    $query = "select CodeB, TitreB, DescriptionB from besoins where VisibiliteB = 1 order by CodeB DESC";

                    if(isset($_GET['carteb']) AND !empty($_GET['carteb'])) {     /*Recherche par mot clé dans le titre et description*/
                        $carteb = htmlspecialchars($_GET['carteb']);
                        $query = "select CodeB, TitreB, DescriptionB from besoins where VisibiliteB = 1 and ( TitreB LIKE '%$carteb%' or DescriptionB LIKE '%$carteb%' ) order by CodeB DESC";
                    }
                                      
                    $result = mysqli_query ($session, $query);

                    if ($result == false) {
                        die("ereur requête : ". mysqli_error($session) );
                    }
                    
                 
                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les besoins existants*/       
                    echo ('<thead>');
                          echo ('<tr>');
                            echo ('<th scope="col">#</th>');
                            echo ('<th scope="col">Titre</th>');
                            echo ('<th scope="col">Description</th>');
                            echo ('<th scope="col">Modification</th>');
                          echo ('</tr>');
                        echo ('</thead>');
                        echo ('<tbody>');
                    if (mysqli_num_rows($result)>0) {
                    while ($ligne = mysqli_fetch_array($result)) {                                               
                          echo ('<tr>');
                            echo ('<th scope="row">'.$ligne["CodeB"].'</th>');                         
                            echo ('<td>'.$ligne["TitreB"].'</td>');                           
                            echo ('<td>'.$ligne["DescriptionB"].'</td>');
                            echo ('<td>');
                             echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                             echo ('<a href="AdminBesoinX.php?t='.$ligne["CodeB"].'"><button type="button" class="btn btn-secondary"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRUptTBSZ_MvCJwuSgHbU74zhNGo2FDtMhgvA&usqp=CAU" alt="Détail" width="30" height="30"></button></a>');
                             echo ('<button type="submit" name="desactiverb" value="'.$ligne["CodeB"].'" class="btn btn-secondary"><img src="https://static.vecteezy.com/system/resources/previews/000/630/530/non_2x/trash-can-icon-symbol-illustration-vector.jpg" alt="Désactiver" width="30" height="30"></button>');                            
                             echo ('</div>');
                            echo ('</td>');                        
                          echo ('</tr>');                     
                    }          
                    } 
                     echo ('</tbody>');
                    echo ('</table>');
                   
                    
                    echo('<br><h3>Besoins Cachés</h3><br>');   

                    $query2 = "select CodeB, TitreB, DescriptionB from besoins where VisibiliteB = 0 order by CodeB DESC";

                    if(isset($_GET['carteb']) AND !empty($_GET['carteb'])) {     /*Recherche par mot clé dans le titre et description*/
                        $carteb = htmlspecialchars($_GET['carteb']);
                        $query2 = "select CodeB, TitreB, DescriptionB from besoins where VisibiliteB = 0 and ( TitreB LIKE '%$carteb%' or DescriptionB LIKE '%$carteb%' ) order by CodeB DESC";
                    }
                                      
                    $result = mysqli_query ($session, $query2);

                    if ($result == false) {
                        die("ereur requête : ". mysqli_error($session) );
                    }
                    
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
                    if (mysqli_num_rows($result)>0) {
                    while ($ligne = mysqli_fetch_array($result)) {                                               
                          echo ('<tr>');
                            echo ('<th scope="row">'.$ligne["CodeB"].'</th>');
                            echo ('<td>'.$ligne["TitreB"].'</td>');
                            echo ('<td>'.$ligne["DescriptionB"].'</td>');
                            echo ('<td>');
                             echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                             echo ('<a href="AdminBesoinX.php?t='.$ligne["CodeB"].'"><button type="button" class="btn btn-secondary"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRUptTBSZ_MvCJwuSgHbU74zhNGo2FDtMhgvA&usqp=CAU" alt="Détail" width="30" height="30"></button></a>');
                             echo ('<button type="submit" name="activerb" value="'.$ligne["CodeB"].'" class="btn btn-secondary"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS82pYv9wgxfx27dUrgTr8zaGjZ6O3O2CONHA&usqp=CAU" alt="Activer" width="30" height="30"></button>');                                                       
                             echo ('</div>');
                            echo ('</td>');
                          echo ('</tr>');                     
                    }          
                    } 
                     echo ('</tbody>');
                    echo ('</table>');
                    
                    ?>        
                </form>
                </div>

                <div id="Paris" class="tabcontentc">      
                  <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                    <h3>Talents</h3>
                    <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">
                        <input class="form-control mr-sm-2" type="search" name="carteb" placeholder="Titre/Description" aria-label="Recherche">
                        <button type="submit" class="btn btn-outline-dark">Recherche</button>
                    </form>
                </div>
                    
                  <form action="AdminCarteInapproprieT.php" method="post">
                  <?php

                    $query = "select CodeT, TitreT, DescriptionT from talents where VisibiliteT = 1 order by CodeT DESC";

                    if(isset($_GET['cartet']) AND !empty($_GET['cartet'])) {     /*Recherche par mot clé dans le titre et description*/
                        $cartet = htmlspecialchars($_GET['cartet']);
                        $query = "select CodeT, TitreT, DescriptionT from talents where VisibiliteT = 1 and ( TitreT LIKE '%$cartet%' or DescriptionT LIKE '%$cartet%' ) order by CodeT DESC";
                    }
                                      
                    $result = mysqli_query ($session, $query);

                    if ($result == false) {
                        die("ereur requête : ". mysqli_error($session) );
                    }
                    
                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les talents existantes*/       
                    echo ('<thead>');
                          echo ('<tr>');
                            echo ('<th scope="col">#</th>');
                            echo ('<th scope="col">Titre</th>');
                            echo ('<th scope="col">Description</th>');
                            echo ('<th scope="col">Modification</th>');
                          echo ('</tr>');
                        echo ('</thead>');
                        echo ('<tbody>');
                    if (mysqli_num_rows($result)>0) {
                    while ($ligne = mysqli_fetch_array($result)) {                                               
                          echo ('<tr>');
                            echo ('<th scope="row">'.$ligne["CodeT"].'</th>');
                            echo ('<td>'.$ligne["TitreT"].'</td>');
                            echo ('<td>'.$ligne["DescriptionT"].'</td>');
                            echo ('<td>');
                             echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                             echo ('<a href="AdminTalentX.php?t='.$ligne["CodeT"].'"><button type="button" class="btn btn-secondary"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRUptTBSZ_MvCJwuSgHbU74zhNGo2FDtMhgvA&usqp=CAU" alt="Détail" width="30" height="30"></button></a>');
                              echo ('<button type="submit" name="desactivert" value="'.$ligne["CodeT"].'" class="btn btn-secondary"><img src="https://static.vecteezy.com/system/resources/previews/000/630/530/non_2x/trash-can-icon-symbol-illustration-vector.jpg" alt="Désactiver" width="30" height="30"></button>');                 
                             echo ('</div>');
                            echo ('</td>');
                          echo ('</tr>');                     
                    }          
                    } 
                     echo ('</tbody>');
                    echo ('</table>');
                    
                    echo('<br><h3>Talents Cachés</h3><br>');
                    
                    $query2 = "select CodeT, TitreT, DescriptionT from talents where VisibiliteT = 0 order by CodeT DESC";

                    if(isset($_GET['cartet']) AND !empty($_GET['cartet'])) {     /*Recherche par mot clé dans le titre et description*/
                        $cartet = htmlspecialchars($_GET['cartet']);
                        $query2 = "select CodeT, TitreT, DescriptionT from talents where VisibiliteT = 0 and ( TitreT LIKE '%$cartet%' or DescriptionT LIKE '%$cartet%' ) order by CodeT DESC";
                    }
                                      
                    $result = mysqli_query ($session, $query2);

                    if ($result == false) {
                        die("ereur requête : ". mysqli_error($session) );
                    }
                    
                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les talents cachés*/       
                    echo ('<thead>');
                          echo ('<tr>');
                            echo ('<th scope="col">#</th>');
                            echo ('<th scope="col">Titre</th>');
                            echo ('<th scope="col">Description</th>');
                            echo ('<th scope="col">Modification</th>');
                          echo ('</tr>');
                        echo ('</thead>');
                        echo ('<tbody>');
                    if (mysqli_num_rows($result)>0) {
                    while ($ligne = mysqli_fetch_array($result)) {                                               
                          echo ('<tr>');
                            echo ('<th scope="row">'.$ligne["CodeT"].'</th>');
                            echo ('<td>'.$ligne["TitreT"].'</td>');
                            echo ('<td>'.$ligne["DescriptionT"].'</td>');
                            echo ('<td>');
                             echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                             echo ('<a href="AdminTalentX.php?t='.$ligne["CodeT"].'"><button type="button" class="btn btn-secondary"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRUptTBSZ_MvCJwuSgHbU74zhNGo2FDtMhgvA&usqp=CAU" alt="Détail" width="30" height="30"></button></a>');
                             echo ('<button type="submit" name="activert" value="'.$ligne["CodeT"].'" class="btn btn-secondary"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS82pYv9wgxfx27dUrgTr8zaGjZ6O3O2CONHA&usqp=CAU" alt="Activer" width="30" height="30"></button>');                    
                             echo ('</div>');
                            echo ('</td>');
                          echo ('</tr>');                     
                    }          
                    } 
                     echo ('</tbody>');
                    echo ('</table>');
                   
                    ?>        
                </form>
            </div>

            <!-- CSS pour la tab des cartes-->
            <style>     
            /* Style the tab */
            .tab {
              overflow: hidden;
              border: 1px solid #ccc;
              background-color: #f1f1f1;
            }

            /* Style the buttons that are used to open the tab content */
            .tab button {
              background-color: inherit;
              float: left;
              border: none;
              outline: none;
              cursor: pointer;
              padding: 14px 16px;
              transition: 0.3s;
            }

            /* Change background color of buttons on hover */
            .tab button:hover {
              background-color: #ddd;
            }

            /* Create an active/current tablink class */
            .tab button.active {
              background-color: #ccc;
            }

            /* Style the tab content */
            .tabcontentc {
              display: none;
              padding: 6px 12px;
              border: 1px solid #ccc;
              border-top: none;
            }
            </style>

            <!-- JS pour la tab des cartes-->
            <script>
            function openCity(evt, cityName) {
              // Declare all variables
              var i, tabcontentc, tablinksc;

              // Get all elements with class="tabcontent" and hide them
              tabcontentc = document.getElementsByClassName("tabcontentc");
              for (i = 0; i < tabcontentc.length; i++) {
                tabcontentc[i].style.display = "none";
              }

              // Get all elements with class="tablinks" and remove the class "active"
              tablinksc = document.getElementsByClassName("tablinksc");
              for (i = 0; i < tablinksc.length; i++) {
                tablinksc[i].className = tablinksc[i].className.replace(" active", "");
              }

              // Show the current tab, and add an "active" class to the button that opened the tab
              document.getElementById(cityName).style.display = "block";
              evt.currentTarget.className += " active";
            }
            // Get the element with id="defaultOpen" and click on it
              document.getElementById("defaultOpenc").click();
            </script>

            </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------->   
                <div id="Utilisateurs" class="tabcontent">      <!-- Onglet utilisateur --> 
                  <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                      <h3>Utilisateurs</h3><hr>
                    <form method="GET" class="form-inline my-2 my-lg-0" class="recherche">  <!-- Moteur de recherche --> 
                        <input class="form-control mr-sm-2" type="search" name="user" placeholder="Nom/Prénom/Email" aria-label="Recherche">
                        <button type="submit" class="btn btn-outline-dark">Recherche</button>
                    </form>
                  </div>
                  <p>Accéder au profil d'utilisateur. Bloquer un compte avec un mail de prévenance (modal : êtes-vous sûr ? comme ne pouvoir pas réactiver un compte). Moteur de recherche dans nom, prénom, email</p>
                  <form name="Supprimer" action="AdminUtilisateurFonction.php" method="post">
                   <?php

                    $query = "select CodeU, NomU, PrenomU, Email from utilisateurs where NomU <> 'XXXXX' order by CodeU DESC";
                    
                    if(isset($_GET['user']) AND !empty($_GET['user'])) {     /*Recherche par mot clé dans prénom, nom, email des utilisateurs*/
                        $user = htmlspecialchars($_GET['user']);
                        $query = "select CodeU, NomU, PrenomU, Email from utilisateurs where NomU <> 'XXXXX' and ( NomU LIKE '%$user%' or PrenomU LIKE '%$user%' or Email LIKE '%$user%' ) order by CodeU DESC";
                    }

                    $result = mysqli_query ($session, $query);

                    if ($result == false) {
                        die("ereur requête : ". mysqli_error($session) );
                    }
                    
                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les catégories existantes*/       
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
                    if (mysqli_num_rows($result)>0) {
                    while ($ligne = mysqli_fetch_array($result)) {                                               
                            echo ('<tr>');
                            echo ('<th scope="row">'.$ligne["CodeU"].'</th>');
                            echo ('<td>'.$ligne["NomU"].'</td>');
                            echo ('<td>'.$ligne["PrenomU"].'</td>');
                            echo ('<td>'.$ligne["Email"].'</td>');
                            echo ('<td>');
                             echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');
                             echo ('<a href="AdminUtilisateur.php?t='.$ligne["CodeU"].'"><button type="button" class="btn btn-secondary"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRUptTBSZ_MvCJwuSgHbU74zhNGo2FDtMhgvA&usqp=CAU" alt="Détail" width="30" height="30"></button></a>');                 
                             echo ('<button type="button"  class="btn btn-secondary" data-toggle="modal" data-target="#supprimer'.$ligne["CodeU"].'"><img src="https://static.vecteezy.com/system/resources/previews/000/630/530/non_2x/trash-can-icon-symbol-illustration-vector.jpg" alt="Désactiver" width="30" height="30"></button>');    
                             echo ('</div>');
                            echo ('</td>');
                            echo ('</tr>');              
            
                             echo('<div class="modal" tabindex="-1" id="supprimer'.$ligne["CodeU"].'" role="dialog">');
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
                                      echo('<button name="codeu" value="'.$ligne["CodeU"].'" type="submit" class="btn btn-primary">Supprimer</button>');
                                      echo('<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>');
                                    echo('</div>');
                                  echo('</div>');
                                echo('</div>');
                              echo('</div>');         
         
                    }          
                    } 
                     echo ('</tbody>');
                    echo ('</table>');
                    ?>        
                   </form>
                </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------->   
            <div id="Stats" class="tabcontent">
              <h3>Nombre de connexion du site</h3><hr>                    
              <a href="https://analytics.google.com/analytics/web/?authuser=1#/report/visitors-overview/a173955301w241368476p225152034/" class="btn btn-light">Aller voir sur Google Analytics</a>
              <p><br></p>
              
              <h3>Mise en relation</h3><hr>
              <?php
                require_once('Fonctions.php');
                echo ('<dl>');
                echo ('<dt>Nombre de mise en relation besoins : ');
                $query5 = "select count(*) as reussit from compteurb";
                $result5 = mysqli_query ($session, $query5);
                if ($note = mysqli_fetch_array($result5)) {   
                    echo $note["reussit"]; 
                }                   
                echo ('</dt>');
                echo ('<dd style="text-indent:2em;"> - Nombre de mise en relation réussit : ');
                $query1 = "select count(*) as reussit from compteurb where NumOuiB = 1";
                $result1 = mysqli_query ($session, $query1);
                if ($note = mysqli_fetch_array($result1)) {   
                    echo $note["reussit"]; 
                }
                echo ('</dd>');
                echo ('<dd style="text-indent:2em;"> - Nombre de mise en relation échoué : ');
                $query2 = "select count(*) as echoue from compteurb where NumNonB = 1";
                $result2 = mysqli_query ($session, $query2);
                if ($note = mysqli_fetch_array($result2)) {   
                    echo $note["echoue"]; 
                }                   
                echo ('</dd>');
                echo ('</dl>');  

                echo ('<dl>');
                echo ('<dt>Nombre de mise en relation talents : ');
                $query6 = "select count(*) as reussit from compteurt";
                $result6 = mysqli_query ($session, $query6);
                if ($note = mysqli_fetch_array($result6)) {   
                    echo $note["reussit"]; 
                }                    
                echo ('</dt>');
                echo ('<dd style="text-indent:2em;"> - Nombre de mise en relation réussit : ');
                $query3 = "select count(*) as reussit from compteurt where NumOuiT = 1";
                $result3 = mysqli_query ($session, $query3);
                if ($note = mysqli_fetch_array($result3)) {   
                    echo $note["reussit"]; 
                }                    
                echo ('</dd>');
                echo ('<dd style="text-indent:2em;"> - Nombre de mise en relation échoué : ');
                $query4 = "select count(*) as echoue from compteurt where NumNonT = 1";
                $result4 = mysqli_query ($session, $query4);
                if ($note = mysqli_fetch_array($result4)) {   
                    echo $note["echoue"]; 
                }                    
                echo ('</dd>');
                echo ('</dl>');                                    

                echo ('<h3>Retour d\'expérience</h3><hr>');
                echo ('<p>Moyenne de notes : ');
                $moyenne = "select AVG(Note) as moyenne from evaluation";
                $notemoyenne = mysqli_query ($session, $moyenne);
                if ($note = mysqli_fetch_array($notemoyenne)) {   
                    echo $note["moyenne"];
                    echo ('</p>'); 
                }

                echo ('<table class="table table-striped">');      /* Tableau pour afficher les catégories existantes*/       
                echo ('<thead>');
                      echo ('<tr>');
                        echo ('<th scope="col">Note</th>');
                        echo ('<th scope="col">Commentaire</th>');
                      echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');
                $query = "select Note, Avis from evaluation where Avis != '' order by CodeE DESC limit 20";
                $result = mysqli_query ($session, $query);                        
                if (mysqli_num_rows($result)>0) {
                while ($ligne = mysqli_fetch_array($result)) {                                               
                      echo ('<tr>');
                        echo ('<th scope="row">'.$ligne["Note"].'</th>');
                        echo ('<td>'.$ligne["Avis"].'</td>');
                      echo ('</tr>');                     
                }          
                } 
                 echo ('</tbody>');
                echo ('</table>');                    

              ?>
            </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------->                  
            <div id="Bandeau" class="tabcontent">
                <h3>Bandeau</h3><hr>

            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
              </ol>
              <div class="carousel-inner">

                 <!--First slide-->
                <div class="carousel-item active">
                  <img src="https://r1pbk8s6fm-flywheel.netdna-ssl.com/wp-content/uploads/2018/04/map-connectivity-1200x400.jpg" class="d-block w-100" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                    <h1>Bienvenue !</h1>
                    <h5>Une plateforme qui permet de partager les compétences entre collaborateurs.</h5>
                    <hr class="my-4">
                    <p>Partageons nos talents, la solitarité c'est aussi entre nous.</p>
                    <button class="btn btn-light" onclick="document.location='https://notmoebius.github.io/quaidessavoirfaire/'">En savoir plus</button>
                  </div>
                </div>
                <!--First slide-->

                <!--Second slide-->
                <div class="carousel-item">
                  <img src="https://www.bravopromo.fr/cdn/blog/1200x400/le-green-friday-par-bravopromo-201911151231-preview.jpg" class="d-block w-100" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                    <h1>Oui, vous avez des talents !</h1>
                    <hr class="my-4">
                    <?php
                    require_once('Fonctions.php');

                    if(isset($_SESSION['email'])){
                        echo ('<button class="btn btn-light" onclick="document.location="https://eva.beta.gouv.fr/"">Ulitiser EVA pour faire éclorer vos talents.</button>');
                    } else {
                        echo ('<button class="btn btn-light" onclick="document.location="Login.php"">Ulitiser EVA pour faire éclorer vos talents.</button>');
                    }
                    ?>
                  </div>
                </div>
                <!--Second slide-->

                <!--Third slide-->
                <div class="carousel-item">
                  <img src="https://lh3.googleusercontent.com/proxy/ur1wHEyIfAwSOTYwSxv5_8PPYLXU1hAIURB9Fqva96V72KSazl5NK1UUzSoFXUUfQR4NF4F7arPwdNuOumCzvbi-ClmtR6oZ4SpuN9LvnQgIb6uzswy4g48cQyliKqsp" class="d-block w-100" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                    <h1>Nouvelle du jour</h1>
                    <hr class="my-4">
                    <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div> 
                <!--Third slide-->  

                <!--Fourth slide-->
                <div class="carousel-item">
                  <img src="https://i.pinimg.com/originals/d1/a5/d3/d1a5d3d96f0862664846c7800e3c8aff.jpg" class="d-block w-100" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                    <h1>Retours d'expériences des utilisateurs</h1>
                    <hr class="my-4">

                  <div class="row">
                    <div class="col-md-4">
                      <div class="card mb-2">
                        <div class="card-body">
                          <h4 class="text-secondary">User 1</h4>
                          <p class="text-secondary">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 clearfix d-none d-md-block">
                      <div class="card mb-2">
                        <div class="card-body">
                          <h4 class="text-secondary">User 2</h4>
                          <p class="text-secondary">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 clearfix d-none d-md-block">
                      <div class="card mb-2">
                        <div class="card-body">
                          <h4 class="text-secondary">User 3</h4>
                          <p class="text-secondary">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                <!--Fourth slide-->

              </div>

              <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Précédent</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Prochaine</span>
              </a>

            </div>
        </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------->   
            <div id="Paramètres" class="tabcontent">
                <h3>Paramètres</h3><hr>
              <p>Paramétrer le délais d'envoie de mail d’évaluation <input type='text' placeholder="15"> jours </p>
              <button type="button" class="btn btn-dark"> Changer </button>
            </div>

            <style>

            /* Style tab links */
            .tablink {
              background-color: #555;
              color: white;
              float: left;
              border: none;
              outline: none;
              cursor: pointer;
              padding: 14px 16px;
              font-size: 17px;
              width: 15%;
            }

            .tablink:hover {
              background-color: #777;
            }

            /* Style the tab content (and add height:100% for full page content) */
            .tabcontent {
              color: black;
              display: none;
              padding: 100px 20px;
              height: 100%;
            }

            </style>

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
<!---------------------------------------------------------------------------------------------------------------------------------------------> 
      </div>
    </div>

  <hr> 
  <footer>
    <p id="copyright"><em><small>copyright &#9400; Quai des savoir-faire, CPAM Haute-Garonne, 2020. All rights reserved.</small></em></p>
  </footer>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>