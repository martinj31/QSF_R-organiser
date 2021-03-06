<!doctype html>
<html lang="fr">
<head>
    
<!-- Link -->
 <?php require "../../FONCTIONNALITE/link.php"; ?>
<!-- Link -->

<title>Atelier X</title>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="../../STYLE/style.css">
    <script src="jquery.js"></script>
  </head>
  <body>

    
<!-- Menu -->
 <?php require "../../FONCTIONNALITE/menu.php"; ?>
<!-- Fin Menu -->


        <div class="jumbotron">
            
            <div class="section-title section-title-haut-page" >

            <?php
            require_once('../../FONCTIONCOMMUNE/Fonctions.php');
            $T = $_GET['t'];
            $req = "select a.TitreA from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeA = '$T' ";
            $resultat = mysqli_query ($session, $req);
            while ($ligne = mysqli_fetch_array($resultat)) {  
                echo ('<h1 class="text-center">'.$ligne["TitreA"]. '</h1>');
            }
            ?>

          </div>

          <div class="container">
               <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                $T = $_GET['t'];
                $query = "select a.CodeA, a.TitreA, a.DescriptionA, a.DateA, a.LieuA, a.NombreA, a.DatePublicationA, a.URL, a.PlusA, a.TypeA, a.VisibiliteA, c.PhotoC, c.NomC from ateliers a, categories c where a.CodeC = c.CodeC and a.CodeA = '$T' ";
                $result = mysqli_query ($session, $query);
                
                if ($result == false) {
                    die("ereur requête : ". mysqli_error($session) );
                }
                while ($ligne = mysqli_fetch_array($result)) {                      /* Afficher le détail de chaque besoin */
                    if ($ligne["VisibiliteA"] == 1) {                        
                        echo ('<p> Date  & Créneau horaire : '.$ligne["DateA"].'</p>');
                        echo ('<p> Date Publication : '.date("d-m-yy", strtotime($ligne["DatePublicationA"])).'</p>');
                        echo ('<p><img src="'.$ligne["PhotoC"].'" class="card-img-top" alt="'.$ligne["NomC"].'" style="width: 35rem;"</p>');
                        echo ('<p><strong>Type d\'atelier : </strong>'.$ligne["TypeA"].'</p>');                        
                        echo ('<p><strong>Description</strong></p><p>'.$ligne["DescriptionA"].'</p>'); 
                        echo ('<p><strong>Lieu d\'atelier : </strong>'.$ligne["LieuA"].'</p>');             
                        echo ('<p><strong>Nombre de personnes maximum : </strong>'.$ligne["NombreA"].'</p>');  
                        echo ('<strong>En savoir plus : </strong><a href="'.$ligne["PlusA"].'" target="_blank">'.$ligne["PlusA"].'</a>');  
                        echo ('<hr>');
                    if(isset($_SESSION['email'])){
                       echo ('<a href="'.$ligne["URL"].'" target="_blank"><button type="button" class="btn btn-primary btn-light">Je m\'inscris</button></a> ');    
                       echo ('<a href="Atelier.php"><button type="button" class="btn btn-dark btn-light">Retour</button></a>');
                    } else {
                       echo ('<a href="Login.php"><button type="button" class="btn btn-primary btn-light">Contacter</button></a> ');
                       echo ('<a href="Atelier.php"><button type="button" class="btn btn-dark btn-light">Retour</button></a>');
                    }   
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

