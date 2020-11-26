<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/categorie.bdd.php');
        require_once('../../BDD/atelier.bdd.php');
        require_once('../../BDD/connexion.bdd.php');
        ?>
        <!-- Link -->

        <title>Créer un atelier</title>


    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Créer un atelier</h1>

            </div>
            <div class="container">

                <div class="row">
                    <div class="col-6">
                         <h3 style="color: #8c8d9e !important; text-align: left;">Etapes à suivre pour créer un atelier : </h3>
<br>
              <ol style="list-style: decimal !important;">
                <li>Je remplis le formulaire.</li>
                <li>Ma carte est en attente d'un admin pour valider.</li>
                <li>Je reçois une liste de participants la veille.</li>
              </ol>



                            </div>
                            <div class="col-6">
                                <form action="Saisir1Atelier.php" method="post">
                                    <?php
                                    require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                                    date_default_timezone_set('Europe/Paris');
                                    echo "Date de création :   " . date("d/m/yy");
                                    ?>
                                    <div class="form-row align-items-center">
                                        <div class="col-auto my-1">
                                            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                            <select class="custom-select mr-sm-2" name="categorie" id="inlineFormCustomSelect" required>
                                                <option value="" selected>Choisir une catégorie</option>
                                                <?php
                                                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                                                $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                                                $bdd = $db->connect();

                                                $categorieBDD = new categorieBDD($bdd);

                                                //$query = "select CodeC, NomC from categories where VisibiliteC = 1";
                                                // $result = mysqli_query ($session, $query);
                                                $CategorieTab = $categorieBDD->allCategorieNameAndId();

                                                if (count($CategorieTab) > 0) {

                                                    foreach ($CategorieTab as $value) {
                                                        echo ('<option  name="categorie" value="' . $value['categorie']->getCodeC() . '"> <strong>' . $value['categorie']->getNomC() . '</strong>  </option> ');
                                                    }
                                                }
                                                
                                                
                                                
                                                /* $query = "select DescriptionC, CodeC, NomC from categories where VisibiliteC = 1";
                                                  $result = mysqli_query ($session, $query);
                                                  if (mysqli_num_rows($result)>0) {
                                                  while ($ligne = mysqli_fetch_array($result)) {

                                                  echo ('<option value="'.$ligne["CodeC"].'" name="categorie" title="'.$ligne["DescriptionC"].'">'.$ligne["NomC"].'</option>');
                                                  }
                                                  } */
                                                ?>                     
                                            </select>
                                        </div><p>(<span style="color:red">*</span>)</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Titre(<span style="color:red">*</span>)</label>
                                        <input type="text" name="titre" class="form-control col-md-4" id="inputEmail4" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Description(<span style="color:red">*</span>)</label><br/>
                                        <textarea rows="4" cols="50" name="description" placeholder=" Veuillez préciser votre atelier" required></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail4">Date et Heure debut d'Atelier (<span style="color:red">*</span>)</label>
                                        <input type="datetime-local" id="meeting-time" 
                                               name="dateDebut" 
                                               min="2020-10-29T00:00" max="2022-06-14T00:00">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Date et Heure fin d'Atelier(<span style="color:red">*</span>)</label>
                                        <input type="datetime-local" id="meeting-time"
                                               name="dateFin" 
                                               min="2020-10-29T00:00" max="2022-06-14T00:00">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Lieu (Pensez à réserver la salle) [e.x. 6.36 Salle de créativité] (<span style="color:red">*</span>)</label>
                                        <input type="text" name="lieu" class="form-control col-md-4"  id="inputEmail4" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Nombre de personnes maximum [e.x. 5] (<span style="color:red">*</span>)</label>
                                        <input type="number" name="nb" class="form-control col-md-4" min="0" id="inputEmail4" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Type d'atelier(<span style="color:red">*</span>)</label>				
                                    </div>
                                    <div class="form-group" >
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio1" required value="Pro">
                                            <label class="form-check-label" for="inlineRadio1">Pro</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="Perso">
                                            <label class="form-check-label" for="inlineRadio2">Perso</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio3" value="Pro et Perso" checked>
                                            <label class="form-check-label" for="inlineRadio3">Pro&Perso</label>
                                        </div>               
                                    </div>   
                                    <div class="form-group">
                                        <label for="inputEmail4">En savoir plus (si vous le souhaitez, indiquez un site internet pour plus d'informations) <br> [e.x. https://fr.wikipedia.org/wiki/Yoga] </label>
                                        <input type="text" name="plus" class="form-control col-md-4" id="inputEmail4" />
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Créer</button> 
                                        <a href="../ACCUEIL/index.php"><button type="button" class="btn btn-dark">Annuler</button></a>
                                        <!--<input type="reset" class="btn btn-dark" value="Annuler">-->
                                    </div>

                                </form>  
                            </div>
                    </div>
                </div>  


                <!-- footer -->
                <?php require "../../FONCTIONNALITE/footer.php"; ?>
                <!-- Fin footer -->

                </body>
                </html>


