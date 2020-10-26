<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/besoin.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
        ?>
        <!-- Link -->

        <title>Rédiger votre e-mail</title>


    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Rédiger votre e-mail</h1>

            </div>
            <div class="container">

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" name="sujet"><strong>Sujet</strong></label>
                    <div class="col-sm-10">
                        <form action="besoin.email.php" method="POST">
                            <?php
                            $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                            $bdd = $db->connect();

                            $besoins = new besoinBDD($bdd);
                            $besoinTab = $besoins->un_besoinx($_GET['c']);
                            //requête prendre titre de besoin
                            /*$query1 = "select CodeB, TitreB from besoins where CodeB = {$_GET['c']}";
                            $result = mysqli_query($session, $query1);*/

                            if (!empty($besoinTab)) {
                                foreach ($besoinTab as $value) {
                                    echo ('<input type="text" readonly class="form-control-plaintext" id="staticEmail" name="sujet" value="[COUP DE MAIN, COUP DE POUCE] Répondre à votre besoin ' . $value['besoin']->getTitreB() . ' " disabled >');
                                    echo('</div>');
                                    echo('</div>');
                                    echo('<div class="form-group">');
                                    echo('<label for="inputEmail4"><strong>Contenu du message</strong></label>');
                                    echo('<textarea name="contenu_besoin">');
                                    echo ('Bonjour,');
                                    echo('</textarea>');
                                    echo ('</div>');
                                    echo ('<input type="hidden" name="codecarte" value="' . $value['besoin']->getCodeB() . '">');
                                    echo ('<input type="hidden" name="titrecarte" value="' . $value['besoin']->getTitreB() . '">');
                                    echo ('<button type="submit" class="btn btn-primary">Envoyer</button> ');
                                }
                            }
                            ?> 
                        </form>
                        <a href="../BESOIN/Besoin.php"> <button type="button" class="btn btn-secondary">Annuler</button></a>
                    </div>    
                </div>

            </div>

            <script>
                var editor1 = CKEDITOR.replace('contenu_besoin', {
                    extraAllowedContent: 'div',
                    height: 250
                });
            </script>

            <!-- footer -->
            <?php require "../../FONCTIONNALITE/footer.php"; ?>
            <!-- Fin footer -->

    </body>
</html>