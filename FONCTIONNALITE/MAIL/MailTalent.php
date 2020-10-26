<!doctype html>
<html lang="fr">
<head>
    
<!-- Link -->
 <?php require "../../FONCTIONNALITE/link.php";
require_once('../../BDD/talent.bdd.php');
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
                    <label for="staticEmail" class="col-sm-2 col-form-label"><strong>Sujet</strong></label>
                    <div class="col-sm-10">
                        <form action="talent.email.php" method="POST">
                        <?php 
                        
                        
                         $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                            $bdd = $db->connect();

                            $talents = new talentBDD($bdd);
                            $talentTab = $talents->selectMailTalent($_GET['t']);
                        //requête prendre titre de besoin
                         /*$query = "select t.CodeT, p.CodeU, t.TitreT from talents as t, proposer as p where t.CodeT = {$_GET['t']} and t.CodeT = p.CodeT";
                         $result = mysqli_query ($session, $query);*/
                         
                          if (!empty($talentTab)) {
                                foreach ($talentTab as $value) {         
                                echo ('<input type="text" readonly class="form-control-plaintext" id="staticEmail" name="sujet" value="[COUP DE MAIN, COUP DE POUCE] Demande de partager votre talent '.$value['talent']->getTitreT().' " disabled >');                         
                                echo('</div>');
                                echo('</div>');
                                echo('<div class="form-group">');
                                echo('<label for="inputEmail4"><strong>Contenu du message</strong></label>');
                                echo('<textarea name="contenu_talent">');
                                echo ('Bonjour,');
                                echo('</textarea>');     
                                echo ('</div>');
                                echo ('<input type="hidden" name="codecarte" value="'.$value['talent']->getCodeT().'">');
                                echo ('<input type="hidden" name="destinataire" value="'.$value['CodeU'].'">');
                                echo ('<input type="hidden" name="titrecarte" value="'.$value['talent']->getTitreT().'">');
                                echo ('<button type="submit" class="btn btn-primary">Envoyer</button>');                               
                            }
                        }
                        ?>
                        </form>
                        <a href="../TALENT/Talent.php"> <button type="button" class="btn btn-secondary">Annuler</button></a>
                    </div>
                </div>
              
        <script>
            var editor1 = CKEDITOR.replace('contenu_talent', {
                extraAllowedContent: 'div',
                height: 250
              });
        </script>             
              
<!-- footer -->
 <?php require "../../FONCTIONNALITE/footer.php"; ?>
<!-- Fin footer -->

</body>
</html>