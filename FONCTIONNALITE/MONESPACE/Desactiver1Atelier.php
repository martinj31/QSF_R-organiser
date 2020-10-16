<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/atelier.bdd.php');

$CodeA = $_POST['codeA'];

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$ateliers = new atelierBDD($bdd);

$ateliers->userUpdateAtelierVisible($CodeA);

/*$S2 = mysqli_prepare($session, "UPDATE ateliers SET VisibiliteA = 0 WHERE CodeA = ?");
mysqli_stmt_bind_param($S2, 'i', $CodeA);
mysqli_stmt_execute($S2);*/

header("Location: MonProfil.php");
?>