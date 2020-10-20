<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/besoin.bdd.php');

$Titre = $_POST['titre'];   // récupéré les valeurs selon la méthode POST
$Description = $_POST['description'];
$DateButoire = $_POST['datebutoire'];
$Type = $_POST['type'];
//$DatePublicationB = date("yy/m/d");
$Categorie = $_POST['categorie'];
$CodeB = $_POST['codeB'];


$besoin = new besoin([]);
$besoin->setCodeB($CodeB);
$besoin->setCodeC($Categorie);
$besoin->setTitreB($Titre);
$besoin->setDescriptionB($Description);
$besoin->setDateButoireB($DateButoire);
//$besoins->setDatePublicationB($datas['DatePublicationB']);
$besoin->setTypeB($Type);


$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$besoins = new besoinBDD($bdd);
//$besoins = new besoin();

$besoins->updateBesoin($besoin);

/*
$S1 = mysqli_prepare($session, "UPDATE besoins SET TitreB = ? WHERE CodeB = ?");
mysqli_stmt_bind_param($S1, 'si', $Titre, $CodeB);
mysqli_stmt_execute($S1);

$S2 = mysqli_prepare($session, "UPDATE besoins SET DescriptionB = ? WHERE CodeB = ?");
mysqli_stmt_bind_param($S2, 'si', $Description, $CodeB);
mysqli_stmt_execute($S2);

$S3 = mysqli_prepare($session, "UPDATE besoins SET DateButoireB = ? WHERE CodeB = ?");
mysqli_stmt_bind_param($S3, 'si', $DateButoire, $CodeB);
mysqli_stmt_execute($S3);

$S4 = mysqli_prepare($session, "UPDATE besoins SET DatePublicationB = ? WHERE CodeB = ?");
mysqli_stmt_bind_param($S4, 'si', $DatePublicationB, $CodeB);
mysqli_stmt_execute($S4);

$S5 = mysqli_prepare($session, "UPDATE besoins SET TypeB = ? WHERE CodeB = ?");
mysqli_stmt_bind_param($S5, 'si', $Type, $CodeB);
mysqli_stmt_execute($S5);

$S6 = mysqli_prepare($session, "UPDATE besoins SET CodeC = ? WHERE CodeB = ?");
mysqli_stmt_bind_param($S6, 'si', $Categorie, $CodeB);
mysqli_stmt_execute($S6);
*/

header("Location: MonProfil.php");
?>