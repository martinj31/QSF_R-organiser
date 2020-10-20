<?php

require_once '../../FONCTIONCOMMUNE/Fonctions.php';
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/parametres.bdd.php');

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$parametres = new parametresBDD($bdd);
$parametres->updateParam($_GET['interval']);
// modifier le délais d'évaluation
/* query = "UPDATE `parametres` SET `Interval` = {$_GET['interval']}";
  mysqli_query($session, $query); */
header("Location:Admin.php");
?>
