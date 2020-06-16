<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
​
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
​	<link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Quai des savoir-faire</title>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
       
<!--------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="jumbotron">
          <div class="container">
              <h1>Modifiez votre talent</h1>      
              <hr>
              <form action="Modifier1CarteT.php" method="POST">
               <?php
                require_once('Fonctions.php');
                date_default_timezone_set('Europe/Paris');
                echo "Date de modification :   " . date("yy/m/d"); 
               ?>         
               <?php

                $T = $_GET['t'];
                $query = "select t.CodeT, t.VisibiliteT, t.TitreT, c.NomC, t.DatePublicationT, t.DescriptionT from talents t, categories c where t.CodeC = c.CodeC and t.TitreT = '$T' ";
                $result = mysqli_query ($session, $query);
                
                if ($result == false) {
                    die("ereur requête : ". mysqli_error($session) );
                }
                while ($ligne = mysqli_fetch_array($result)) {                      /* Afficher le détail de chaque besoin */
                    if ($ligne["VisibiliteT"] == 1) {   
          
                        
                        echo('<div class="form-row align-items-center">');
                    echo('<div class="col-auto my-1">');
                      echo('<label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>');
                      echo('<select class="custom-select mr-sm-2" name="categorie" id="inlineFormCustomSelect" required>');
                            echo('<option selected>'.$ligne["NomC"].'</option>');
                            echo('<option value="1" name="categorie" title="...">Sport</option>');
                            echo('<option value="2" name="categorie" title="Réunions créatives/Pitcher .....">Animation</option>');
                            echo('<option value="3" name="categorie"title="...">Outils métiers</option>');
                            echo('<option value="4" name="categorie" title="Yoga, méditation...">Développement personnel</option>');
                            echo('<option value="5" name="categorie" title="...">Associatif</option>');
                            echo('<option value="6" name="categorie" title="...">Covoiturage</option>');
                            echo('<option value="7" name="categorie" title="Word, Excel, PowerPoint, Outlook...">Bureautique</option>');
                            echo('<option value="8" name="categorie" title="Internet, site Web, réparation PC...">Informatique</option>');
                            echo('<option value="9" name="categorie" title="Cuisine, bricolage, musique, théâtre, ciné, culture, philatélie, généalogie...">Loisir </option>');
                            echo ('<option value="10" name="categorie" title="Demande de créér une catégorie à administrateur" >Autres </option>');
                      echo('</select>');
                    echo('</div>');
                    echo('</div>');
                        
                   
                        echo ('<div class="form-group">');
                        echo ('<label for="inputEmail4">Titre(<span style="color:red">*</span>)</label>');
                        echo ('<input type="text" name="titre" class="form-control col-md-4" id="inputEmail4" maxlength="20" value="'.$ligne["TitreT"].'" required>');
                        echo ('</div>');
                        
                        echo('<div class="form-group">') ;
                        echo('<label for="inputEmail4">Déscription du besoin(<span style="color:red">*</span>)</label><br/>') ;
                        echo('<textarea rows="4" cols="50" name="description" required>'.$ligne["DescriptionT"].'</textarea>') ;
                        echo('</div>') ;
                        
                        echo('<div class="form-group">');
                                echo('<label for="inputAddress">Type de talent(<span style="color:red">*</span>)</label>');			
                          echo('</div>');
                          echo('<div class="form-group">');
                            echo('<div class="form-check form-check-inline">');
                              echo('<input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="Pro">');
                              echo('<label class="form-check-label" for="inlineRadio1">Pro</label>');
                            echo('</div>');
                            echo('<div class="form-check form-check-inline">');
                              echo('<input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="Perso">');
                              echo('<label class="form-check-label" for="inlineRadio2">Perso</label>');
                            echo('</div>');
                            echo('<div class="form-check form-check-inline">');
                              echo('<input class="form-check-input" type="radio" name="type" id="inlineRadio3" value="Pro et Perso">');
                              echo('<label class="form-check-label" for="inlineRadio3">Pro&Perso</label>');
                            echo('</div>');
                          echo('</div>');
                        

                     echo('<hr>');
            echo('<div class="form-group">');
                echo('<button name="codeT" type="submit" value="'.$ligne["CodeT"].'" class="btn btn-dark btn-lg">MODIFIER </button>');
           echo('</div>');
                              }
                }
                 ?> 
              </form>

          </div>
        </div>

        <footer>
          <p id="copyright"><em><small>copyright &#9400; Quai des savoir-faire, CPAM Haute-Garonne, 2020. All rights reserved.</small></em></p>
        </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>