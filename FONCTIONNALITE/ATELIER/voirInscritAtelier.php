<!doctype html>
<html lang="fr">
    <head>
        <link href="../../STYLE/voirInscritAtelier.css" rel="stylesheet">
        <!-- Link -->
        <?php require "../../FONCTIONNALITE/link.php"; ?>
        <!-- Link -->

        <title>Inscrit Atelier</title>
       <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >

                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                require_once('../../BDD/utilisateur.bdd.php');
                require_once('../../BDD/connexion.bdd.php');
                ?>

            </div>
            <br>
            <br>
            <a id="imprime" href="voirInscritAtelier.php" onclick="edition();return false;">Imprimer</a>
            <div class="container">

                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');

// $T = $_GET['t'];
                $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
                $bdd = $db->connect();
                $utilisateurs = new utilisateurBDD($bdd);

                $utilisateurTab = $utilisateurs->saisirParticipantAtelier($_GET['t']);

                $comteur = 0;
                if (!empty($utilisateurTab)) {

                    echo ('<table class="table table-striped">');      /* Tableau pour afficher les catégories existantes */
                    echo ('<thead>');
                    echo ('<tr>');
                    echo ('<th scope="col">#</th>');
                    echo ('<th scope="col">Nom</th>');
                    echo ('<th scope="col">Prénom</th>');
                    echo ('<th scope="col">Email</th>');
                    echo ('<th scope="col">Modification</th>');
                    echo ('</tr>');
                    echo ('</thead>');
                    echo ('<tbody>');
                    foreach ($utilisateurTab as $value) {
                        $comteur += 1;
                        echo ('<tr>');
                        echo ('<th scope="row">' . $comteur . '</th>');
                        echo ('<td>' . $value->getNomU() . '</td>');
                        echo ('<td>' . $value->getPrenomU() . '</td>');
                        echo ('<td>' . $value->getEmail() . '</td>');
                        echo ('<td>');
                        echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');

                        //echo ('<button type="button"  class="btn " data-toggle="modal" data-target="#supprimer' . $value->getCodeU() . '"><img src="img/trash.png" alt="demande de désinscription" width="30" height="30"></button>');
                        echo ('<p></p><a href="demandeEnleveInscritAtelier.php?u=' . $value->getCodeU() . '&t=' . $_GET['t'] . '""  onclick="Envoi()">demande de désinscription</a>');
                        echo ('</div>');
                        echo ('</td>');
                        echo ('</tr>');
                    }
                    echo ('</table>');
                } else {
                    echo('<p>Aucun inscrit </p>');
                }
                ?>


                <br/><br/>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="name">Ajouter une personne:</label>
                            <input type="search" class="form-control" onkeyup="fetchData()" id="find" placeholder="fill the information">

                        </div>
                    </div>

                </div>
                
	<div id="comehere"></div>
    </div>




                <script>

                    //if(jQuery) alert('jQuery is loaded');
                    function Envoi() {
                        alert("La demande a été envoyée à l'admin !");
                    }


                    function edition()
                    {

                        window.print();
                    }
                   
                    function reqListener() {
                        console.log(this.responseText);
                    }

                    function fetchData() {
                        var search = $('#find').val();

                        console.log(search);


                        var data = new FormData();
                        data.append('search', search);
                        data.append('t',<?php echo $_GET['t'] ?> );
                       

                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'searchInscritAtelier.php', true);
                        xhr.onload = function () {
                            // do something to response
                            console.log(this.responseText);
                            $('#comehere').html(this.responseText);
                        };
                        xhr.send(data);



                    }


                </script>

            </div>
        </div>
        <br>
        <!-- footer -->
        <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>
