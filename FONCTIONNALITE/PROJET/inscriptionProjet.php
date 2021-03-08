<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/projet.bdd.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/utilisateur.bdd.php');

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();
$projetBDD = new projetBDD($bdd);

if ($_GET['c'] and $_GET['userId']) {

    $projetBDD->participeraProjetEtUser($_GET['userId'], $_GET['t'], "participant");
} else {


    $projetBDD->participeraProjetEtUser($usercode, $_GET['t'], "participant");
}


header("Location:../MONESPACE/MonProfil.php");
?>