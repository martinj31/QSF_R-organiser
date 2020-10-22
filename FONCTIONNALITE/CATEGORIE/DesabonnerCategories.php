<?php 
require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/abonner.bdd.php');
$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$abonnerBDD = new abonnerBDD($bdd);
    if (isset($_POST['categorie'])) { //désabonner la carte
             foreach ($_POST["categorie"] as $categories) {
                 
                 $abonnerBDD->deleteAbonner($categories);
                 
                /*$stmt = mysqli_prepare($session, "DELETE FROM `abonner` WHERE `CodeC` = ? ");   // insérer le code de l'utilisateur et le code de catégorie dans la table abonner
                mysqli_stmt_bind_param($stmt, 'i', $categories);
                mysqli_stmt_execute($stmt); */
             }
        }

//header("Location: MesCategories.php");

     
?>