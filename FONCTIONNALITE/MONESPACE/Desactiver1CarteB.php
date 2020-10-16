<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/besoin.bdd.php');

$CodeB = $_POST['codeB'];

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$besoins = new besoinBDD($bdd);

$besoins->userUpdateBesoinVisible($CodeB);

/*$S2 = mysqli_prepare($session, "UPDATE besoins SET VisibiliteB = 0 WHERE CodeB = ?");
mysqli_stmt_bind_param($S2, 'i', $CodeB);
mysqli_stmt_execute($S2);*/

header("Location: MonProfil.php");
?>