<!doctype html>
<html lang="fr">
    <head>

        <!-- Link -->
        <?php require "../../FONCTIONNALITE/link.php"; ?>
        <!-- Link -->

        <title>Inscrit</title>


    </head>
    <body>


        <!-- Menu -->
        <?php require "../../FONCTIONNALITE/menu.php"; ?>
        <!-- Fin Menu -->


        <div class="jumbotron">

            <div class="section-title section-title-haut-page" >

                <?php
                require_once('../../FONCTIONCOMMUNE/Fonctions.php');
                require_once('../../BDD/besoin.bdd.php');
                require_once('../../BDD/connexion.bdd.php');
                ?>

            </div>
            
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
        echo ('<th scope="row">' .$comteur . '</th>');
        echo ('<td>' . $value->getNomU() . '</td>');
        echo ('<td>' . $value->getPrenomU() . '</td>');
        echo ('<td>' . $value->getEmail() . '</td>');
        echo ('<td>');
        echo ('<div class="btn-group mr-2" role="group" aria-label="First group">');

        echo ('<p></p><a href="../ATELIER/desinscriptionAtelier.php?u=' . $value->getCodeU() . '&t=' . $_GET['t'] . '""  onclick="Envoi()">Désinscrire</a>');
        echo ('</div>');
        echo ('</td>');
        echo ('</tr>');
 echo ('</table>');
        
    }
}else{
     echo('<p>Aucun inscrit </p>');
}
?>
            </div>
        </div>
        <br>
        <!-- footer -->
                <?php require "../../FONCTIONNALITE/footer.php"; ?>
        <!-- Fin footer -->

    </body>
</html>
