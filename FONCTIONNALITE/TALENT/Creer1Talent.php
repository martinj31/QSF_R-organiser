<!doctype html>
<html lang="fr">
<head>
    
<!-- Link -->
 <?php require "../../FONCTIONNALITE/link.php"; ?>
<!-- Link -->

<title>Ajouter un talent</title>

  
   
    
  </head>
  <body>

    
<!-- Menu -->
 <?php require "../../FONCTIONNALITE/menu.php"; ?>
<!-- Fin Menu -->


        <div class="jumbotron">
          
          <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Ajouter un talent</h1>

</div>
          <div class="container">
            <form action="Saisir1Talent.php" method="post">
            <?php
            require_once('../../FONCTIONCOMMUNE/Fonctions.php');
            date_default_timezone_set('Europe/Paris');
            echo "Date de création : " . date("d/m/yy"); 
            ?>
            <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                      <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                      <select class="custom-select mr-sm-2" name="categorieT" id="inlineFormCustomSelect" required>
                            <option value="" selected>Choisir une catégorie</option>
                             <?php
                             require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                             $query = "select DescriptionC, CodeC, NomC from categories where VisibiliteC = 1";
                             $result = mysqli_query ($session, $query);
                             if (mysqli_num_rows($result)>0) {       
                                while ($ligne = mysqli_fetch_array($result)) { 
                                 
                                    echo ('<option value="'.$ligne["CodeC"].'" name="categorie" title="'.$ligne["DescriptionC"].'">'.$ligne["NomC"].'</option>');                                         
                                }     
                             }
                             ?>                     
                      </select>
              
                    </div> <p>(<span style="color:red">*</span>)</p>
            </div>
            <div class="form-group">
              <label for="inputEmail4">Titre(<span style="color:red">*</span>)</label>
              <input type="text" name="titreT" class="form-control col-md-4" id="inputEmail4" required>
            </div>
            <div class="form-group">
                    <label for="inputEmail4">Description du talent(<span style="color:red">*</span>)</label><br/>
                    <textarea rows="4" cols="50" name="descriptionT" placeholder=" Veuillez préciser votre talent" required></textarea>
            </div>
            <div class="form-group">
                    <label for="inputAddress">Type de talent(<span style="color:red">*</span>)</label>				
            </div>
                
            <div class="form-group">
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="typeT" id="inlineRadio1" required value="Pro">
                <label class="form-check-label" for="inlineRadio1">Pro</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="typeT" id="inlineRadio2" value="Perso">
                <label class="form-check-label" for="inlineRadio2">Perso</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="typeT" id="inlineRadio3" value="Pro et Perso">
                <label class="form-check-label" for="inlineRadio3">Pro&Perso</label>
              </div>               
            </div>

              <div class="form-group">
              <button type="submit" class="btn btn-primary">Créer</button> 
              <a href="../ACCUEIL/index.php"><button type="button" class="btn btn-dark">Annuler</button></a>
              <!-- <input type="reset" class="btn btn-dark" value="Annuler"> -->
              </div>
            </form>
          </div>
        </div>
        
            
<!-- footer -->
 <?php require "../../FONCTIONNALITE/footer.php"; ?>
<!-- Fin footer -->

</body>
</html>