<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/connexion.bdd.php');
        require_once('../../BDD/email.bdd.php');
        require_once('../../BDD/utilisateur.bdd.php');
        ?>
        <link rel="stylesheet" type="text/css" href="../../STYLE/evaluation.css">
        <!-- Link -->

        <title>Evaluation besoin</title>


    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Evaluation besoin</h1>

            </div>
            <div class="container">
                <form method="POST" action="evaluation-besoin.fonction.php">
                    <?php
                    require_once '../../FONCTIONCOMMUNE/Fonctions.php';
                    if (isset($_SESSION['email'])) {

                        echo '<h1>Evaluer votre expérience [besoin]</h1><hr>';
                        echo '<div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Veuillez choisir sur quel besoin vous voulez évaluer</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="besoin" required>';
                        $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                        $bdd = $db->connect();
                        $emailBDD = new emailBDD($bdd);
                        $email = $emailBDD->selectCodeCarteBesoinTitre($_SESSION['codeu']);
                        /* $query = "SELECT DISTINCT e.CodeCarte, b.TitreB FROM emails as e, besoins as b WHERE e.TypeCarte = 'besoin' and (e.Provenance = {$_SESSION['codeu']} or e.destinataire = {$_SESSION['codeu']}) and e.CodeCarte = b.CodeB";
                          $result = mysqli_query ($session, $query); */
                        foreach ($email as $value) {
                            echo "<option value=\"{$value['email']}\">{$value['besoin']}</option>";
                        }
                        echo '</select></div>';

                        echo '<fieldset>
                  <legend>Notation :</legend>
                   <rating>
                     <input type="radio" name="rating" value="1" aria-label="1 star" required/>
                     <input type="radio" name="rating" value="2" aria-label="2 stars"/>
                     <input type="radio" name="rating" value="3" aria-label="3 stars"/>
                     <input type="radio" name="rating" value="4" aria-label="4 stars"/>
                     <input type="radio" name="rating" value="5" aria-label="5 stars"/>
                   </rating>
                </fieldset>
                  <br>
                <fieldset>
                  <legend>Votre avis nous intéresse :</legend>
                   <rating>
                       <textarea name="avis" placeholder=""></textarea><br>';
                        ?>
                        <script>
                            var editor1 = CKEDITOR.replace('avis', {
                                extraAllowedContent: 'div',
                                height: 200
                            });
                        </script>
                        <?php
                        echo '    
                   </rating>
                </fieldset>
                  <br><p>Si votre besoin a été résolu, n\'oubliez pas d\'désactiver votre carte</p>';
                        $utilisateurBDD = new utilisateurBDD($bdd);
                        $user = $utilisateurBDD->un_userLog($_SESSION['email']);
                       /* $query2 = "select CodeU from utilisateurs WHERE Email = '{$_SESSION['email']}' ";
                        $result2 = mysqli_query($session, $query2);*/
                        if ($user != null) {
                            echo '<input id="codeu" name="codeu" type="hidden" value="' . $user->getCodeU() . '">';
                        }

                        echo '<input type="submit" class="btn btn-primary"> <input type="reset" class="btn btn-dark" value="Annuler">';
                    } else {
                        echo ('<p>Veuillez d\'abord <a href="login.php">se connecter</a></p>');
                    }
                    ?>

                </form>
            </div>
        </div>

        <!-- Footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->


    </body>
</html>