<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php
        require "../../FONCTIONNALITE/link.php";
        require_once('../../BDD/connexion.bdd.php');
        require_once('../../BDD/utilisateur.bdd.php');
        require_once('../../BDD/talent.bdd.php');
        require_once('../../BDD/projet.bdd.php');
        require_once('../../BDD/atelier.bdd.php');
        require_once('../../BDD/besoin.bdd.php');
        ?>
        <!-- Link -->

        <title>Mon profil</title>


    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->

        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >
                <h1 class="text-center">Mes informations personnelles</h1>

            </div>
            <div class="container">

                <?php
                if (isset($_SESSION['email'])) {
                    echo '<div class="container" id="MesInfos">';



                    echo '<div class="row">';
                    echo '<div class="col-8">';

                    if (isset($_SESSION['email'])) {



                        $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                        $bdd = $db->connect();

                        $utilisateurs = new utilisateurBDD($bdd);

                        $utilisateur = $utilisateurs->un_User($usercode);

                        echo ('<p><strong>Nom : </strong>' . $utilisateur->getNomU() . '</p>');
                        echo ('<p><strong>Prénom : </strong>' . $utilisateur->getPrenomU() . '</p>');
                        echo ('<p><strong>Adresse mail : </strong>' . $utilisateur->getEmail() . '</p>');
                        echo ('<p><a href="changemdp.html.php">Changer mon mot de passe</a></p>');
                    }
                    echo '</div>';
                    echo '<div class="col-4">';
                    echo '<form name="Supprimer" action="Supprimer1Compte.php" method="post"><br>';

                    echo('<button type="button" class="btn btn-outline-dark btn-light-fade" data-toggle="modal" data-target="#supprimer">Supprimer mon compte</button>');

                    echo('<div class="modal" tabindex="-1" id="supprimer" role="dialog">');
                    echo('<div class="modal-dialog" role="document">');
                    echo('<div class="modal-content">');
                    echo('<div class="modal-header">');
                    echo('<h5 class="modal-title">Vérification</h5>');
                    echo('<button type="button" class="close" data-dismiss="modal" aria-label="Close">');
                    echo('<span aria-hidden="true">&times;</span>');
                    echo('</button>');
                    echo('</div>');
                    echo('<div class="modal-body">');
                    echo('<p>Êtes-Vous sûr de supprimer votre compte ? <br>');
                    echo('Attention : toutes vos cartes associées seront supprimées.<br>');
                    echo('Pour tout problème, veuillez contacter l\'administrateur. </p>');
                    echo('</div>');
                    echo('<div class="modal-footer">');
                    echo('<button type="submit" class="btn btn-primary">Supprimer</button>');
                    echo('<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>');
                    echo('</div>');
                    echo('</div>');
                    echo('</div>');
                    echo('</div>');

                    echo '</form>';
                    echo '<br>';
                    echo '<p>Si vous voulez modifier votre adresse mail, veuillez recréer un nouveau compte. </p>';
                    echo '</div>';
                    echo '</div>';

                    echo '<form method="POST" action="monespace.fonction.php">';

                    echo ('<p>Type d\'information affichée : </p>');    //afficher le type d'utilisateur (checked)
                    if ($_SESSION['type'] == '') {
                        echo ('<div class="switch-field">');
                        echo ('<input type="radio" id="radio-three" name="switch-two" value="" checked/>');
                        echo ('<label for="radio-three">Tout</label>');
                        echo ('<input type="radio" id="radio-four" name="switch-two" value="Pro" />');
                        echo ('<label for="radio-four">Pro</label>');
                        echo ('<input type="radio" id="radio-five" name="switch-two" value="Perso" />');
                        echo ('<label for="radio-five">Perso</label>');
                        echo ('</div>');
                    } elseif ($_SESSION['type'] == 'Pro') {
                        echo ('<div class="switch-field">');
                        echo ('<input type="radio" id="radio-three" name="switch-two" value="" />');
                        echo ('<label for="radio-three">Tout</label>');
                        echo ('<input type="radio" id="radio-four" name="switch-two" value="Pro" checked />');
                        echo ('<label for="radio-four">Pro</label>');
                        echo ('<input type="radio" id="radio-five" name="switch-two" value="Perso" />');
                        echo ('<label for="radio-five">Perso</label>');
                        echo ('</div>');
                    } elseif ($_SESSION['type'] == 'Perso') {
                        echo ('<div class="switch-field">');
                        echo ('<input type="radio" id="radio-three" name="switch-two" value="" />');
                        echo ('<label for="radio-three">Tout</label>');
                        echo ('<input type="radio" id="radio-four" name="switch-two" value="Pro" />');
                        echo ('<label for="radio-four">Pro</label>');
                        echo ('<input type="radio" id="radio-five" name="switch-two" value="Perso" checked />');
                        echo ('<label for="radio-five">Perso</label>');
                        echo ('</div>');
                    }
                    echo '<br>';
                    echo '<button type="submit" onclick="Modifier()" class="btn btn-outline-dark">Modifier le type d\'information affichée</button>';
                    ?>
                    <script>
                        function Modifier() {
                            alert("Modification réussite !");
                        }
                    </script>   
    <?php
    echo '</form>';
    echo '</div>';
    echo '<br><br>';

//<!--------------------------------------------------------------------------------------------------------------------------------------------->           
    echo '<div class="container" id="MesBesoins">';

    echo '<div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">';
    echo '<h1 style="color: #5a00f0 !important;"> Mes besoins </h1>';
    is_login_new_besoin();
    echo '</div>';
    echo '<hr>';

    echo '<form method="POST" action="Desactiver1CarteB.php">';
    echo '<div class="row">';
    echo '<div class="col-10">';
    echo '<ul class="list-inline">';




    $besoins = new besoinBDD($bdd);



    $besoinTab = $besoins->selectBesoinsByUser($usercode);


    if (!empty($besoinTab)) {

        $conteurBesoin = 0;

        foreach ($besoinTab as $value) {

            if (strtotime($value['besoin']->getDateButoireB()) > strtotime(date("Y-m-d H:i:s")) && $value['besoin']->getVisibiliteB() == 1) {
                $conteurBesoin++;
                echo('<li class="list-inline-item">');
                if ($value['besoin']->getReponseB() > 0) {  // si il y a des réponses non traitées, affichir le badge rouge
                    echo ('<span class="badge badge-danger">Nouvelle réponse</span>');
                }
                echo ('<div class="card" style="width: 12rem;">');
                echo ('<div class="card-header">');
                echo ('<center><input type="radio" name="codeB" value="' . $value['besoin']->getCodeB() . '"/><center>');
                echo ('</div>');
                echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                echo ('<div class="card-body card text-center">');
                echo ('<h5 class="card-title">' . $value['besoin']->getTitreB() . '</h5>');
                echo ('<p class="card-text">Date de publication: ' . date("d-m-Y", strtotime($value['besoin']->getDatePublicationB())) . '</p>');
                echo ('<p class="card-text">Délais souhaité: ' . date("d-m-Y", strtotime($value['besoin']->getDateButoireB())) . '</p>');
                echo ('<a href="../BESOIN/BesoinX.php?t=' . $value['besoin']->getCodeB() . '" class="btn btn-outline-dark">Voir la demande</a>');
                echo ('<p></p><a href="BesoinModification.php?t=' . $value['besoin']->getCodeB() . '" class="btn btn-outline-dark">Modifier</a>');
                if ($value['besoin']->getReponseB() > 0) {       // si il y a des réponses non traitées, affichir le button "Voir la réponse"             
                    echo ('<p></p><a href="../Besoin/ReponseBesoin.php?code=' . $value['besoin']->getCodeB() . '" class="btn btn-outline-dark">Voir la réponse</a>');    //prendre les titres pour les besoins pour regrouper les réponses d'un besoin 
                }
                echo ('</div>');
                echo ('</div></li>');
            }
        }

        if ($conteurBesoin == 0) {
            echo('<h5>Vous n\'avez pas encore saisi un besoin</h5>');
        }
    } else {

        echo('<h5>Vous n\'avez pas encore saisi un besoin</h5>');
    }


    echo'    </ul>
                     </div>
                <div class="col-2">
                     <!-- Button trigger modal -->
                     <button  title="Veuillez sélectionner une carte" type="button" class="btn btn-outline-dark btn-light-fade" data-toggle="modal" data-target="#MyModal">Désactiver carte</button>

                     <!-- Modal -->
                    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Vérification</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                              <span aria-hidden="true">&times;</span> 
                            </button>
                          </div>
                          <div class="modal-body">
                            <p> Êtes-Vous sûr de désactiver cette carte ?</p>
                          </div>
                          <div class="modal-footer">
                            <button name="desactiverB" type="submit" class="btn btn-primary">Désactiver</button>  
                          </div>
                        </div>
                      </div>
                    </div>

                </div>          
            </div>
            </form>   
          </div>  
       
        <br><br>';
    ?>
                    <!--------------------------------------------------------------------------------------------------------------------------------------------->     
                    <div class="container" id="MesTalents">
                        <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                            <h1 style="color: #5a00f0 !important;"> Mes talents </h1>             
    <?php is_login_new_talent(); ?>
                        </div>

                        <hr>

                        <form method="POST" action="Desactiver1CarteT.php">
                            <div class="row">
                                <div class="col-10">
                                    <ul class="list-inline">

    <?php
    $talents = new talentBDD($bdd);

    $talentTab = $talents->selectTalentByUser($usercode);


    if (!empty($talentTab)) {

        $conteurTalent = 0;

        foreach ($talentTab as $value) {



            if ($value['talent']->getVisibiliteT() == 1) {
                $conteurTalent++;
                echo('<li class="list-inline-item">');
                if ($value['talent']->getReponseT() > 0) {  // si il y a des réponses non traitées, affichir "nouvelle message"
                    echo ('<span class="badge badge-danger">Nouvelle réponse</span>');
                }
                echo ('<div class="card" style="width: 12rem;">');
                echo ('<div class="card-header">');
                echo ('<center><input type="radio" name="codeT" value="' . $value['talent']->getCodeT() . '"/><center>');
                echo ('</div>');
                echo ('<img src="' . $value['photo'] . '" class="card-img-top" alt="...">');
                echo ('<div class="card-body card text-center">');
                echo ('<h5 class="card-title">' . $value['talent']->getTitreT() . '</h5>');
                echo ('<p class="card-text">Date de publication: ' . date("d-m-Y", strtotime($value['talent']->getDatePublicationT())) . '</p>');
                echo ('<a href="../TALENT/TalentX.php?t=' . $value['talent']->getCodeT() . '" class="btn btn-outline-dark">Voir le détail</a>');
                echo ('<p></p><a href="TalentModification.php?t=' . $value['talent']->getCodeT() . '" class="btn btn-outline-dark">Modifier</a>');
                if ($value['talent']->getReponseT() > 0) { // si il y a des réponses non traitées, affichir le button "Voir la réponse"
                    echo ('<p></p><a href="../TALENT/ReponseTalent.php?code=' . $value['talent']->getCodeT() . '" class="btn btn-outline-dark">Voir la réponse</a>');    //prendre les titres pour les besoins pour regrouper les réponses d'un besoin
                }
                echo ('</div>');
                echo ('</div></li>');
            }
        }

        if ($conteurTalent == 0) {
            echo('<h5>Vous n\'avez pas encore saisi un talent</h5>');
        }
    } else {

        echo('<h5>Vous n\'avez pas encore saisi un talent</h5>');
    }



    echo '</ul>     
                   </div>
                   <div class="col-2">
                     <!-- Button trigger modal -->
                     <button title="Veuillez sélectionner une carte" type="button" class="btn btn-outline-dark btn-light-fade" data-toggle="modal" data-target="#MyModalT">Désactiver carte</button>
                    
                     <!-- Modal -->
                    <div class="modal fade" id="MyModalT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Vérification</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                              <span aria-hidden="true">&times;</span> 
                            </button>
                          </div>
                          <div class="modal-body">
                            <p> Êtes-Vous sûr de désactiver cette carte ?</p>
                          </div>
                          <div class="modal-footer">
                            <button name="desactiverT" type="submit" class="btn btn-primary">Désactiver</button>  
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
            </div>           
            </form>        
          </div>
        <br><br>';
    ?>
                                        <!--------------------------------------------------------------------------------------------------------------------------------------------->     
                                        <div class="container" id="MesAteliers">

                                            <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                                                <h1 style="color: #5a00f0 !important;"> Mes ateliers </h1>
    <?php is_login_new_atelier(); ?>
                                            </div>
                                            <hr>

                                            <form method="POST" action="Desactiver1Atelier.php">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <ul class="list-inline">

    <?php
    $ateliers = new atelierBDD($bdd);

    $atelierTab = $ateliers->selectAtelierByUser($usercode);


    if (!empty($atelierTab)) {
        $conteurAtelier = 0;
        foreach ($atelierTab as $value) {
            $role = $ateliers->saisirRoleUserAtelier($value['atelier']->getCodeA(), $usercode);
            if ($value['atelier']->getVisibiliteA() == 1 && strtotime($value['atelier']->getDateFinA()) >= strtotime(date("Y-m-d H:i:s"))) {
                $conteurAtelier++;
                echo('<li class="list-inline-item">');
                echo ('<div class="card" style="width: 12rem;">');
                echo ('<div class="card-header">');
                echo ('<center><input type="radio" name="codeA" value="' . $value['atelier']->getCodeA() . '"/><center>');
                echo ('</div>');
                echo ('<img src="' . $value["photo"] . '" class="card-img-top" alt="...">');
                echo ('<div class="card-body card text-center">');
                echo ('<h5 class="card-title">' . $value['atelier']->getTitreA() . '</h5>');
                echo ('<p class="card-text">Date de publication: ' . date("d-m-Y", strtotime($value['atelier']->getDatePublicationA())) . '</p>');
                echo ('<p class="card-text">Date : ' . date("d-m-Y", strtotime($value['atelier']->getDateDebutA())) . ' à ' . date("d-m-Y", strtotime($value['atelier']->getDateFinA())) . '</p>');
                echo ('<a href="../ATELIER/AtelierX.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Voir le détail</a>');


                if ($role == "createur") {
                    echo ('<p></p><a href="AtelierModification.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Modifier</a>');
                    echo ('<p></p><a href="../ATELIER/voirInscritAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Voir les inscrits</a>');
                } else if ($role == "participant") {
                    echo ('<p></p><a href="../ATELIER/desinscriptionAtelier.php?t=' . $value['atelier']->getCodeA() . '" class="btn btn-outline-dark">Je me désinscrit </a>');
                }

                echo ('</div>');
                echo ('</div></li>');
            }
        }

        if ($conteurAtelier == 0) {
            echo('<h5>Vous n\'avez pas encore créé un atelier</h5>');
        }
    } else {

        echo('<h5>Vous n\'avez pas encore créé un atelier</h5>');
    }







    echo '</ul>
                     </div>
                <div class="col-2">
                     <!-- Button trigger modal -->
                     <button title="Veuillez sélectionner une carte" type="button" class="btn btn-outline-dark btn-light-fade" data-toggle="modal" data-target="#Myatelier">Désactiver carte</button>

                     <!-- Modal -->
                    <div class="modal fade" id="Myatelier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Vérification</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                              <span aria-hidden="true">&times;</span> 
                            </button>
                          </div>
                          <div class="modal-body">
                            <p> Êtes-Vous sûr de désactiver cette carte ?</p>
                          </div>
                          <div class="modal-footer">
                            <button name="desactiverA" type="submit" class="btn btn-primary">Désactiver</button>  
                          </div>
                        </div>
                      </div>
                    </div>

                </div>          
            </div>
            </form>   
          </div>  
       
        <br><br>';
    ?>
                                                    </div>
                                                   






                                                <!--------------------------------------------------------------------------------------------------------------------------------------------->     
                                                <div class="container" id="MesAteliers">

                                                    <div class="flex-parent d-flex justify-content-md-between bd-highlight mb-2">
                                                        <h1 style="color: #5a00f0 !important;"> Mes projets </h1>
    <?php is_login_new_projet(); ?>
                                                    </div>
                                                    <hr>

                                                    <form method="POST" action="Desactiver1Atelier.php">
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <ul class="list-inline">

    <?php
    $projets = new projetBDD($bdd);

    $projetTab = $projets->selectProjetByUser($usercode);


    if (!empty($projetTab)) {
        $conteurProjet = 0;
        foreach ($projetTab as $value) {

            $role = $projets->saisirRoleUserProjet($value['projet']->getCodeP(), $usercode);
            if ($value['projet']->getVisibiliteP() == 1 && strtotime($value['projet']->getDateButoireP()) >= strtotime(date("Y-m-d H:i:s"))) {
                $conteurProjet++;
                echo('<li class="list-inline-item">');
                echo ('<div class="card" style="width: 12rem;">');
                echo ('<div class="card-header">');
                echo ('<center><input type="radio" name="codeA" value="' . $value['projet']->getCodeP() . '"/><center>');
                echo ('</div>');
                echo ('<img src="' . $value["photo"] . '" class="card-img-top" alt="...">');
                echo ('<div class="card-body card text-center">');
                echo ('<h5 class="card-title">' . $value['projet']->getTitreP() . '</h5>');
                echo ('<p class="card-text">Date de publication: ' . date("d-m-Y", strtotime($value['projet']->getDatePublicationP())) . '</p>');
                echo ('<p class="card-text">Date : ' . date("d-m-Y", strtotime($value['projet']->getDateButoireP())) . '</p>');
                echo ('<a href="../PROJET/ProjetX.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Voir le détail</a>');


                if ($role == "createur") {
                    echo ('<p></p><a href="ProjetModification.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Modifier</a>');
                    echo ('<p></p><a href="../PROJET/voirInscritProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Voir les inscrits</a>');
                } else if ($role == "participant") {
                    echo ('<p></p><a href="../PROJET/desinscriptionProjet.php?t=' . $value['projet']->getCodeP() . '" class="btn btn-outline-dark">Je me désinscrit </a>');
                }

                echo ('</div>');
                echo ('</div></li>');
            }
        }

        if ($conteurProjet == 0) {
            echo('<h5>Vous n\'avez pas encore crée de projet</h5>');
        }
    } else {

        echo('<h5>Vous n\'avez pas encore crée de projet</h5>');
    }




    echo '</ul>
                     </div>
                <div class="col-2">
                     <!-- Button trigger modal -->
                     <button title="Veuillez sélectionner une carte" type="button" class="btn btn-outline-dark btn-light-fade" data-toggle="modal" data-target="#Myatelier">Désactiver carte</button>

                     <!-- Modal -->
                    <div class="modal fade" id="Myatelier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Vérification</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                              <span aria-hidden="true">&times;</span> 
                            </button>
                          </div>
                          <div class="modal-body">
                            <p> Êtes-Vous sûr de désactiver cette carte ?</p>
                          </div>
                          <div class="modal-footer">
                            <button name="desactiverA" type="submit" class="btn btn-primary">Désactiver</button>  
                          </div>
                        </div>
                      </div>
                    </div>

                </div>          
            </div>
            </form>   
          </div>  
       
        <br><br>';
} else {
    echo ('<center><p><br><br>Veuillez d\'abord <a href="../INSCRIPTION/Login.php">se connecter</a></p></center>');
}
?>
                                                        </div>
                                                    </div>

                                                    <!-- footer -->
<?php require "../../FONCTIONNALITE/footer.php"; ?>
                                                    <!-- Fin footer -->

                                                    </body>
                                                    </html>
