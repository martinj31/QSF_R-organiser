<!doctype html>
<html lang="fr">
<head>
    
<!-- Link -->
 <?php require "../../FONCTIONNALITE/link.php"; ?>
<!-- Link -->

<title>Talent X</title>

   
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
            $req = "select t.TitreT from talents t, categories c where t.CodeC = c.CodeC and t.CodeT = '$T' ";
            $resultat = mysqli_query ($session, $req);
            while ($ligne = mysqli_fetch_array($resultat)) {  
                echo ('<h1 class="text-center">'.$ligne["TitreT"]. '</h1>');
            }
            ?>

          </div>

          <div class="container">
               <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                $T = $_GET['t'];
                $query = "select t.CodeT, t.TypeT, t.VisibiliteT, t.TitreT, c.PhotoC, t.DatePublicationT, t.DescriptionT from talents t, categories c where t.CodeC = c.CodeC and t.CodeT = '$T' ";
                $result = mysqli_query ($session, $query);

                if ($result == false) {
                    die("ereur requête : ". mysqli_error($session) );
                }
                while ($ligne = mysqli_fetch_array($result)) {                      /* Afficher le détaille de chaque talent */
                     if ($ligne["VisibiliteT"] == 1){
                    echo ('<p> Date Publication: '.date("d-m-yy", strtotime($ligne["DatePublicationT"])).'</p>');
                    echo ('<p><img src="'.$ligne["PhotoC"].'" class="card-img-top" alt="..." style="width: 35rem;"</p>');
                    echo ('<p><strong>Type: </strong>'.$ligne["TypeT"].'</p>');                    
                    echo ('<p><strong>Description</strong></p><p>'.$ligne["DescriptionT"].'</p>');  
                    echo ('<hr>'); 
                    if(isset($_SESSION['email'])){
                       echo ('<a href="../MAIL/MailTalent.php?t='.$ligne["CodeT"].'"><button type="button" class="btn btn-primary btn-light">Contacter</button></a> ');
                       echo ('<a href="Talent.php"><button type="button" class="btn light btn-light">Retour</button></a>');
                    } else {
                       echo ('<a href="../INSCRIPTION/Login.php"><button type="button" class="btn btn-primary btn-light">Contacter</button></a> ');
                       echo ('<a href="../TALENT/Talent.php"><button type="button" class="btn light btn-light">Retour</button></a>');
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

