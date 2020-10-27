<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/atelier.bdd.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/utilisateur.bdd.php');

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();
$atelierBDD = new atelierBDD($bdd);


if($atelierBDD->nombreParticipantVSNBRMax($_GET['t'])){
    $res = $atelierBDD->participeraAtelierEtUser($usercode, $_GET['t'], "participant");
}


header("Location:../MONESPACE/MonProfil.php");

?>