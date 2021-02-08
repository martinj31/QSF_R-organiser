<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php require "../../FONCTIONNALITE/link.php"; ?>
        <!-- Link -->

        <title>Réponses pour mes besoins</title>

        <!-- Custom styles for this template -->


    </head>
    <body>


        <!-- Menu -->
        <?php
        require "../../FONCTIONNALITE/menu.php";
        require_once('../../BDD/connexion.bdd.php');
        require_once('../../BDD/email.bdd.php');
        ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Réponses pour mes besoins</h1>

            </div>
            <div class="container">
                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');


                $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                $bdd = $db->connect();

                $emailBDD = new emailBDD($bdd);
                $emailTab = $emailBDD->selectMailBesoin($_GET['code'], $_SESSION['codeu']);
                /* $query = "SELECT e.CodeCarte, e.Sujet, e.Contenu, u.Email, b.DateButoireB, b.VisibiliteB, e.Provenance FROM emails AS e, utilisateurs AS u, besoins AS b WHERE e.TypeCarte = 'besoin' AND e.Destinataire = {$_SESSION['codeu']} AND e.VisibiliteE = 1 AND e.CodeCarte = {$_GET['code']}  AND e.Provenance = u.CodeU AND b.CodeB = e.CodeCarte"; 

                  $result = mysqli_query ($session, $query);

                  if ($result == false) {
                  die("ereur requête : ". mysqli_error($session) );
                  } */

                if (!empty($emailTab)) {

                    foreach ($emailTab as $value) {
                        /* Afficher la liste des réponses sur ce besoin */
                        if ( $value["VisibiliteB"] == 1) {
                            echo ('<h6>' . $value["email"]->getSujet() . '</h6>');
                            echo ('<p>' . $value["email"]->getContenu() . '</p><br>');
                            echo ('<a <a href="besoinoui.fonction.php?p=' . $value["email"]->getProvenance() . '&c=' . $value["email"]->getCodeCarte() .'&cem=' . $value["email"]->getCodeEM() . '"><button type="button" onclick="javascript: sendmail();" class="btn btn-primary">Super, je réponds</button></a> '); // envoyer un mail pour les mettre en contact
                            echo ('<a href="besoinnon.html.php?p=' . $value["email"]->getProvenance() . '&c=' . $value["email"]->getCodeCarte() .'&cem=' . $value["email"]->getCodeEM() . '"><button type="button" class="btn btn-secondary">Dommage, car...</button></a><hr>');
                           
                        }
                    }
                }else{
                    echo ('<h6>Pas de Mail</h6>');
                }
                ?>   
                <!-- href="mailto:'.$ligne["Email"].'"  -->
            </div>
        </div>
        <hr> 
         <!-- <script>
            var mail="<?php //echo $mail;  ?>";
            function sendmail() {
                window.location.href = "mailto:" + mail + "";   
            }
          </script> -->

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>
