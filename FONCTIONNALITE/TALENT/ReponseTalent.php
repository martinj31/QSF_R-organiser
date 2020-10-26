<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php require "../../FONCTIONNALITE/link.php"; ?>
        <!-- Link -->

        <title>Réponses pour mes talents</title>


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
                <h1 class="text-center">Réponses pour mes talents</h1>

            </div>
            <div class="container">
                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                $bdd = $db->connect();

                $emailBDD = new emailBDD($bdd);
                $emailTab = $emailBDD->selectMailTalent($_GET['code'], $_SESSION['codeu']);
                /* $query = "SELECT e.CodeCarte, e.Sujet, e.Contenu, u.Email, t.VisibiliteT, e.Provenance FROM emails AS e, utilisateurs AS u, talents AS t WHERE e.TypeCarte = 'talent' AND e.Destinataire = {$_SESSION['codeu']} AND e.VisibiliteE = 1 AND e.CodeCarte = {$_GET['code']}  AND e.Provenance = u.CodeU AND t.CodeT = e.CodeCarte";

                  $result = mysqli_query($session, $query);
                  
                  if ($result == false) {
                  die("ereur requête : " . mysqli_error($session));
                  } */

                
                if (!empty($emailTab)) {

                    foreach ($emailTab as $value) { /* Afficher la liste des réponses sur ce talent */
                        if ($value["VisibiliteT"] == 1) {
                            echo ('<h6>' . $value["email"]->getSujet() . '</h6>');
                            echo ('<p>' . $value["email"]->getContenu() . '</p><br>');
                            echo ('<a href="mailto:' . $value["EmailU"] . '"><button type="button" onclick="javascript: sendmail();" class="btn btn-primary">Super, je réponds</button></a> '); // envoyer le mail pour les mettre en contact
                            echo ('<a href="talentnon.html.php?p=' . $value["email"]->getProvenance() . '&c=' . $value["email"]->getCodeCarte() . '&cem=' . $value["email"]->getCodeEM() .'"><button type="button" class="btn btn-secondary">Dommage, car...</button></a><hr>'); //refusé, demande la raison
                        
                          
                        }
                    }
                }else{
                    echo ('<h6>Pas de Mail</h6>');
                }
                ?>
              <!--<script>
                var mail="<?php //echo $ligne['Email'];  ?>"; 
                function sendmail() {
                    window.location.href = "mailto:" + mail + "";   
                }
              </script>-->       
            </div>
        </div>

        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>
