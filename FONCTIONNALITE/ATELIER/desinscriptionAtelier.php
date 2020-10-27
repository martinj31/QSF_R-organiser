<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/atelier.bdd.php');
require_once('../../BDD/connexion.bdd.php');


$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();
$atelierBDD = new atelierBDD($bdd);

$user = "";

if(isset($_GET['u'])){
    $user = $_GET['u'];
}else{
    $user = $usercode;
}

$atelierBDD->DesinscriptionAtelier($_GET['t'], $user);

//header("Location:../MONESPACE/MonProfil.php");

?>