    <header class="header-area" id="header-area">
        <div class="dope-nav-container breakpoint-off ">
            <div class="container">
                <div class="row">
                    <!-- dope Menu -->
                    <nav class="dope-navbar justify-content-between" id="dopeNav">
      <a class="nav-brand" href="/QSF/QSF/FONCTIONNALITE/ACCUEIL/index.php">
        <img class="logo-normal" src="../../img/coup-de-main-coup-de-pouce.png">
        <img class="logo-sticky" src="../../img/coup-de-main-coup-de-pouce-2.png">

      </a>

   <!-- <style>    /*effet hover sur le sous-menu ne marche plus*/
        .dopenav li:hover>.dropdown-menu {
            display: block;
        }
    </style>-->

      <div class="dope-menu" id="navbarSupportedContent">


  <div class="dopenav">
    
        <ul id="nav">
          <li class="nav-item active">
            <a class="nav-link" href="../ACCUEIL/index.php">Accueil <span class="sr-only">(current)</span> </a> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../BESOIN/Besoin.php">Besoins</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../TALENT/Talent.php">Talents</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="../ATELIER/Atelier.php">Ateliers</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="../PROJET/Projet.php">Projets</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="../CATEGORIE/AbonnerCategorie.php">Catégories</a>
          </li>  
        </ul>
          


        <ul id="nav">
          <li class="nav-item dropright">   
            <?php
            //header('Content-type: text/html; charset=UTF-8', true);
          
          require_once ('../../FONCTIONCOMMUNE/Fonctions.php');
            
           
           
     
            if(isset($_SESSION['email'])){    
                 
                $query = "select SUM(b.ReponseB) + SUM(t.ReponseT) as Reponse from besoins b, saisir s, talents t, proposer p where s.CodeB = b.CodeB and t.CodeT = p.CodeT and p.CodeU = {$usercode} and s.CodeU = {$usercode} and b.VisibiliteB = 1 and t.VisibiliteT = 1";
                $result = mysqli_query ($session, $query);
                
                while ($ligne = mysqli_fetch_array($result)) { 
                    if ($ligne["Reponse"] > 0) {
                        echo ('<span class="badge badge-danger">Nouveau message</span>');                           
                    } 
                }    
                    echo('<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">');
                    $prenom = "select PrenomU from utilisateurs where CodeU = {$usercode} ";
                    $result = mysqli_query ($session, $prenom);
                    while ($prenom = mysqli_fetch_array($result)) {      
                        echo $prenom['PrenomU'];       // Afficher le prénom d'un utilisateur
                    }
                    echo('</a>');
            } else {
               
                echo('<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">');
                echo "Visiteur";                   //Utilisateur qui n'a pas conncté
                echo('</a>');
            } 
            ?>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php
                if(isset($_SESSION['email'])){
                    if(isset($_SESSION['role'])) {
                        echo ('<a class="dropdown-item" href="../ADMIN/Admin.php">Espace admin</a>');
                        echo ('<a class="dropdown-item" href="../INSCRIPTION/Deconnecter.php" onclick="Deconnexion()">Déconnecter</a>');                       
                    } else {
                        $req = "select SUM(b.ReponseB) + SUM(t.ReponseT) as Reponse from besoins b, saisir s, talents t, proposer p where s.CodeB = b.CodeB and t.CodeT = p.CodeT and p.CodeU = {$usercode} and s.CodeU = {$usercode} and b.VisibiliteB = 1 and t.VisibiliteT = 1";
                        $resultat = mysqli_query ($session, $req);

                        if ($reponse = mysqli_fetch_array($resultat)) { 
                            if ($reponse["Reponse"] > 0) {
                                echo ('<a class="dropdown-item" href="../MONESPACE/MonProfil.php">Mon profil <span class="badge badge-danger">ici</span></a>');                           
                            } else {
                                echo ('<a class="dropdown-item" href="../MONESPACE/MonProfil.php">Mon profil</a>');
                            }
                        }
                        echo ('<a class="dropdown-item" href="../CATEGORIE/MesCategories.php">Mes catégories</a>');
                        echo ('<a class="dropdown-item" href="../INSCRIPTION/Deconnecter.php" onclick="Deconnexion()">Déconnecter</a>');
                    }
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
                    echo ('<a class="dropdown-item" href="../INSCRIPTION/Login.php">Se connecter</a>');
                    echo ('<a class="dropdown-item" href="../INSCRIPTION/Inscription.php">S\'inscrire</a>');
                }
                ?>
            </div>
          </li>
        </ul>




</div>
      </div>


    </nav>

  </div></div></div></header>