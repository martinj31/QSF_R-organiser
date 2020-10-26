<!doctype html>
<html lang="fr">
<head>
    
<!-- Link -->
 <?php require "../../FONCTIONNALITE/link.php"; ?>
<!-- Link -->

<title>Besoin non</title>

  
  </head>
  <body>

    
<!-- Menu -->
 <?php require "../../FONCTIONNALITE/menu.php"; ?>
<!-- Fin Menu -->


        <div class="jumbotron">
          
          <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Besoin non</h1>

</div>
          <div class="container">
              <h1>Pourquoi ?</h1><hr>
              <p>Veuillez sélectionner une raison de refus : </p><br>
               <?php echo('<form action="besoinnon.fonction.php" method="GET">');  ?>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="raison_non_besoin" id="besoin_raison1" value="Merci, j’ai déjà reçu une solution pour mon besoin" checked>
                  <label class="form-check-label" for="besoin_raison1">
                    Merci, j’ai déjà reçu une solution pour mon besoin
                  </label>
                </div><br>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="raison_non_besoin" id="besoin_raison2" value="Je serais disponible à partir du ">
                  <label class="form-check-label" for="besoin_raison2">
                    Je serais disponible à partir du  
                  </label>
                  <input type="date" name="datedispo">
                </div><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="raison_non_besoin" id="besoin_raison3" value="">
                  <label class="form-check-label" for="besoin_raison3">
                    Autre raison (veuillez préciser)  
                  </label><br>
                  <textarea name="autre_raison" rows="4" cols="50"></textarea>
                </div><br>
                <?php
                echo '<input type="hidden" name="c" value="'.$_GET['c'].'">';
                echo '<input type="hidden" name="p" value="'.$_GET['p'].'">';
                echo '<input type="hidden" name="cem" value="'.$_GET['cem'].'">';
                ?>
                <button type="submit" class="btn btn-primary">Envoyer</button>
              </form>
              <hr>      
          </div>
        </div>

<!-- footer -->
 <?php require "../../FONCTIONNALITE/footer.php"; ?>
<!-- Fin footer -->

</body>
</html>
