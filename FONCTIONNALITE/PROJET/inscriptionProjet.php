<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/projet.bdd.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/utilisateur.bdd.php');

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();
$projetBDD = new projetBDD($bdd);



    $res = $projetBDD->participeraProjetEtUser($usercode, $_GET['t'], "participant");

    var_dump($_GET['t']);

header("Location:../MONESPACE/MonProfil.php");

?>