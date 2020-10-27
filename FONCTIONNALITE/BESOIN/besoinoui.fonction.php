<?php
require_once '../../FONCTIONCOMMUNE/Fonctions.php';
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/compteurB.bdd.php');
require_once('../../BDD/besoin.bdd.php');
require_once('../../BDD/email.bdd.php');

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$compteurBBDD = new compteurBBDD($bdd);
$besoinBDD = new besoinBDD($bdd);
$emailBDD = new emailBDD($bdd);
$compteur = new compteurb([]);

$compteur->setNumOuiB(1);
$compteur->setNumNonB(0);
//Compter comme une mise en relation réussit
$compteurBBDD->compteurReussi($compteur);
/*$sql = "insert into compteurb (NumOuiB, NumNonB) VALUES(1, 0)";
$result = mysqli_query ($session, $sql);  */

//Réponse - 1, une réponse a été traité
$besoinBDD->UpdateReponseB($_GET['c']);
/*$req = "UPDATE besoins SET ReponseB = ReponseB - 1 WHERE CodeB = {$_GET['c']}";
mysqli_query($session, $req);*/

//Cette réponse ne sera plus visible
$emailBDD->UpdateVisibiliteB($_GET['c'], $_GET['p'], $_GET['cem']);
/*$query = "UPDATE emails SET VisibiliteE = 0 WHERE CodeCarte = {$_GET['c']} AND TypeCarte = 'besoin' AND Provenance = {$_GET['p']}";
mysqli_query ($session, $query);*/ 

header("Location:../MONESPACE/MonProfil.php");

?>