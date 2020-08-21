<!doctype html>
<html lang="fr">
<head>
    
<!-- Link -->
 <?php require "link.php"; ?>
<link rel="stylesheet" type="text/css" href="evaluation.css">
<!-- Link -->

<title>Evaluation besoin</title>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jquery.js"></script>
  </head>
  <body>

    
<!-- Menu -->
 <?php require "menu.php"; ?>
<!-- Fin Menu -->


        <div class="jumbotron">
          
          <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Evaluation besoin</h1>

</div>
          <div class="container">
      <form method="POST" action="evaluation-besoin.fonction.php">
        <?php
        require_once 'Fonctions.php';
        if(isset($_SESSION['email'])) {

                echo '<h1>Evaluer votre expérience [besoin]</h1><hr>';
                echo '<div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Veuillez choisir sur quel besoin vous voulez évaluer</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="besoin" required>';

                $query = "SELECT DISTINCT e.CodeCarte, b.TitreB FROM emails as e, besoins as b WHERE e.TypeCarte = 'besoin' and (e.Provenance = {$_SESSION['codeu']} or e.destinataire = {$_SESSION['codeu']}) and e.CodeCarte = b.CodeB";
                $result = mysqli_query ($session, $query);
                while ($ligne = mysqli_fetch_array($result)) {   
                    echo "<option value=\"{$ligne['CodeCarte']}\">{$ligne['TitreB']}</option>";    
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
                       <textarea name="avis" placeholder=""></textarea><br>'; ?>
                        <script>
                            var editor1 = CKEDITOR.replace('avis', {
                                extraAllowedContent: 'div',
                                height: 200
                              });
                        </script>
                    <?php echo '    
                   </rating>
                </fieldset>
                  <br><p>Si votre besoin a été résolu, n\'oubliez pas d\'désactiver votre carte</p>';

                $query2 = "select CodeU from utilisateurs WHERE Email = '{$_SESSION['email']}' ";
                $result2 = mysqli_query ($session, $query2);
                if ($ligne = mysqli_fetch_array($result2)) {
                    echo '<input id="codeu" name="codeu" type="hidden" value="'.$ligne['CodeU'].'">';
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
 <?php require "footer.php"; ?>
<!-- Fin footer -->

 
  </body>
</html>