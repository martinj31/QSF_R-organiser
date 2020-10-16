<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/talent.bdd.php');

$CodeT = $_POST['codeT'];

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$talents = new talentBDD($bdd);

$talents->userUpdateTalentVisible($CodeT);
/*
$S4 = mysqli_prepare($session, "UPDATE talents SET VisibiliteT = 0 WHERE CodeT = ?");
mysqli_stmt_bind_param($S4, 'i', $CodeT);
mysqli_stmt_execute($S4);
*/
header("Location: MonProfil.php");
?>