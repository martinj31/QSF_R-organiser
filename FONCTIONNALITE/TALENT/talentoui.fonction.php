<?php
require_once '../../FONCTIONCOMMUNE/Fonctions.php';
require_once '../../FONCTIONCOMMUNE/Fonctions.php';
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/compteurT.bdd.php');
require_once('../../BDD/talent.bdd.php');
require_once('../../BDD/email.bdd.php');

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$compteurTBDD = new compteurTBDD($bdd);
$talentBDD = new talentBDD($bdd);
$emailBDD = new emailBDD($bdd);
$compteur = new CompteurT([]);
$compteur->setNumOuiT(1);
$compteur->setNumNonT(0);

//Compter comme une mise en relation réussit
$compteurTBDD->addCompteur($compteur);
/*$sql = "insert into compteurt (NumOuiT, NumNonT) VALUES(1, 0)";
$result = mysqli_query ($session, $sql); */

//Réponse - 1, une réponse a été traité
$talentBDD->UpdateReponseT($_GET['c']);
/*$req = "UPDATE talents SET ReponseT = ReponseT - 1 WHERE CodeT = {$_GET['c']}";
mysqli_query($session, $req);*/

//Cette réponse ne sera plus visible
$emailBDD->UpdateVisibiliteT($_GET['c'], $_GET['p'], $_GET['cem']);
/*$query = "UPDATE emails SET VisibiliteE = 0 WHERE CodeCarte = {$_GET['c']} AND TypeCarte = 'talent' AND Provenance = {$_GET['p']}";
mysqli_query ($session, $query); */

header("Location: ../MONESPACE/MonProfil.php");

?>