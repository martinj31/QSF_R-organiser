<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php require "../../FONCTIONNALITE/link.php"; ?>
        <!-- Link -->

        <title>Besoin X</title>

       
    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >

                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                require_once('../../BDD/besoin.bdd.php');
                require_once('../../BDD/connexion.bdd.php');
                $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                $bdd = $db->connect();

                $besoins = new besoinBDD($bdd);
                $T = $_GET['t'];
                
                $besoinTab = $besoins->un_besoinx($T);
               // $req = "select b.TitreB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ";
                //$resultat = mysqli_query($session, $req);
               foreach ($besoinTab as $value) {
                    echo ('<h1 class="text-center">' . $value['besoin']->getTitreB() . '</h1>');
                }
                
                
                ?>

            </div>

            <div class="container containerdescription">
                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                
               // $T = $_GET['t'];
                
                
                //$besoins = new besoin();

                

                
                foreach ($besoinTab as $value) {

                    if (strtotime($value['besoin']->getDateButoireB()) >= strtotime(date("Y-m-d H:i:s")) && $value['besoin']->getVisibiliteB() == 1) {
                        echo ('<p><img src="' . $value['photo'] . '" class="card-img-top" alt="..."  style="width: 15rem;"</p>');
                        echo ('<p><strong> Date Butoire: </strong>' . date("d-m-Y", strtotime($value['besoin']->getDateButoireB())) . '</p>');
                        echo ('<p><strong> Date Publication: </strong>' . date("d-m-Y", strtotime($value['besoin']->getDatePublicationB())) . '</p>');
                        
                        echo ('<p><strong>Type: </strong>' . $value['besoin']->getTypeB() . '</p>');
                        echo ('<p><strong>Description: </strong>' . $value['besoin']->getDescriptionB() . '</p>');
                        echo ('<hr>');
                        if (isset($_SESSION['email'])) {
                            echo ('<a href="../MAIL/MailBesoin.php?c=' . $value['besoin']->getCodeB() . '"><button type="button" class="btn btn-primary btn-light">Contacter</button></a>');
                            echo ('<a href="besoinx.fonction.php?c=' . $value['besoin']->getCodeB() . '">
                                <input type="submit" class="btn btn-primary btn-light" name="rejoint" value="Rejoindre à ce besoin"></input>
                              </a>');
                            echo ('<a href="Besoin.php"><button type="button" class="btn btn-dark btn-light btn-light-fade">Retour</button></a>');
                        } else {
                            echo ('<a href="../INSCRIPTION/Login.php"><button type="button" class="btn btn-primary btn-light">Contacter</button></a>');
                            echo ('<a href="../INSCRIPTION/Besoin.php" ><button type="button" class="btn btn-dark btn-light">Retour</button></a>');
                        }
                    }
                }






















                /* $query = "select b.CodeB, b.TypeB, b.VisibiliteB, b.TitreB, c.PhotoC, b.DatePublicationB, b.DescriptionB, b.DateButoireB from besoins b, categories c where b.CodeC = c.CodeC and b.CodeB = '$T' ";
                  $result = mysqli_query ($session, $query);

                  if ($result == false) {
                  die("ereur requête : ". mysqli_error($session) );
                  }
                  while ($ligne = mysqli_fetch_array($result)) { */ /* Afficher le détail de chaque besoin */
                /* if (strtotime($ligne["DateButoireB"]) >= strtotime(date("yy/m/d")) && $ligne["VisibiliteB"] == 1) {   
                  echo ('<p> Date Butoire: '.date("d-m-yy", strtotime($ligne["DateButoireB"])).'</p>');
                  echo ('<p> Date Publication: '.date("d-m-yy", strtotime($ligne["DatePublicationB"])).'</p>');
                  echo ('<p><img src="'.$ligne["PhotoC"].'" class="card-img-top" alt="..."  style="width: 35rem;"</p>');
                  echo ('<p><strong>Type: </strong>'.$ligne["TypeB"].'</p>');
                  echo ('<p><strong>Description</strong></p><p>'.$ligne["DescriptionB"].'</p>');
                  echo ('<hr>');
                  if(isset($_SESSION['email'])){
                  echo ('<a href="../MAIL/MailBesoin.php?c='.$ligne["CodeB"].'"><button type="button" class="btn btn-primary btn-light">Contacter</button></a>');
                  echo ('<a href="besoinx.fonction.php?c='.$ligne["CodeB"].'">
                  <input type="submit" class="btn btn-primary btn-light" name="rejoint" value="Rejoindre à ce besoin"></input>
                  </a>');
                  echo ('<a href="Besoin.php"><button type="button" class="btn btn-dark btn-light">Retour</button></a>');
                  } else {
                  echo ('<a href="../INSCRIPTION/Login.php"><button type="button" class="btn btn-primary btn-light">Contacter</button></a>');
                  echo ('<a href="../INSCRIPTION/Besoin.php" ><button type="button" class="btn btn-dark btn-light">Retour</button></a>');
                  }
                  }
                  } */
                ?>
            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>
