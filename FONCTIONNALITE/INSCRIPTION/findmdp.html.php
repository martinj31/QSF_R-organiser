<!doctype html>
<html lang="fr">
<head>
    
<!-- Link -->
 <?php require "../../FONCTIONNALITE/link.php"; ?>
<!-- Link -->

<title>Mot de passe oublié</title>

    
  </head>
  <body>

    
<!-- Menu -->
 <?php require "../../FONCTIONNALITE/menu.php"; ?>
<!-- Fin Menu -->


        <div class="jumbotron">
          
          <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Mot de passe oublié</h1>

</div>
          <div class="container ">
            <form action="findmdp.fonction.php" method="POST">
              <br>
                <p>1) Veuillez d'abord saisir votre adresse mail.</p>
                <p>Votre adresse mail : <input type="text" name="adressemail"></p>
                <p>2) Vous allez recevoir un nouveau mot de passe par mail. Vous pourrez le modifier ensuite dans "Mon Profil".</p><br>
                <input type="submit" value="Valider" class="btn btn-light">
                <a href="Login.php"><input type="button" value="Retour" class="btn btn-light"></a>
            </form>
          </div>
        </div>
<!-- footer -->
 <?php require "../../FONCTIONNALITE/footer.php"; ?>
<!-- Fin footer -->

</body>
</html>
