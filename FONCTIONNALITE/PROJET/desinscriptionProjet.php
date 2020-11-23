<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/projet.bdd.php');
require_once('../../BDD/connexion.bdd.php');


$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();
$projetBDD = new projetBDD($bdd);

$user = "";

if(isset($_GET['u'])){
    $user = $_GET['u'];
}else{
    $user = $usercode;
}

$projetBDD->DesinscriptionProjet($_GET['t'], $user);

header("Location:../MONESPACE/MonProfil.php");

?>