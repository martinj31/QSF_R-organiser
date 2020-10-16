<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/utilisateur.bdd.php');
require_once('../../BDD/abonner.bdd.php');
require_once('../../BDD/besoin.bdd.php');
require_once('../../BDD/talent.bdd.php');
/* Rendre l'utilisateur et tous ses cartes, catégories en anonyme */
/* tous ses cartes */

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$utilisateurs = new utilisateurBDD($bdd);
$abonners = new abonnerBDD($bdd);
$besoins = new besoinBDD($bdd);
$talents = new talentBDD($bdd);

$utilisateur = new utilisateur([]);

$utilisateur->setCodeU($usercode);
$utilisateur->setEmail('XXXXX');
//$utilisateur->setAnonyme(0);
$utilisateur->setNomU('XXXXX');
$utilisateur->setPrenomU('XXXXX');



$besoins->updateBesoinUserDeleting($usercode);
$talents->updateTalentUserDeleting($usercode);
$abonners->deleteAbonner($usercode);
$utilisateurs->updateUser($utilisateur);

/*
$S1 = mysqli_prepare($session, "UPDATE besoins INNER JOIN saisir ON besoins.CodeB = saisir.CodeB SET besoins.VisibiliteB = 0 WHERE saisir.CodeU = ?");
mysqli_stmt_bind_param($S1, 'i', $usercode);
mysqli_stmt_execute($S1);

$S2 = mysqli_prepare($session, "UPDATE talents INNER JOIN proposer ON talents.CodeT = proposer.CodeT SET talents.VisibiliteT = 0 WHERE proposer.CodeU = ?");
mysqli_stmt_bind_param($S2, 'i', $usercode);
mysqli_stmt_execute($S2);

/* tous ses categories */
/*
$S3 = mysqli_prepare($session, "DELETE FROM `abonner` WHERE `CodeU` = ? ");
mysqli_stmt_bind_param($S3, 'i', $usercode);
mysqli_stmt_execute($S3);

/* le compte */
/*
$S4 = mysqli_prepare($session, "UPDATE utilisateurs SET Anonyme = 0 WHERE CodeU = ?");
mysqli_stmt_bind_param($S4, 'i', $usercode);
mysqli_stmt_execute($S4);

$S5 = mysqli_prepare($session, "UPDATE utilisateurs SET Email = 'XXXXX' WHERE CodeU = ?");
mysqli_stmt_bind_param($S5, 'i', $usercode);
mysqli_stmt_execute($S5);

$S6 = mysqli_prepare($session, "UPDATE utilisateurs SET NomU = 'XXXXX' WHERE CodeU = ?");
mysqli_stmt_bind_param($S6, 'i', $usercode);
mysqli_stmt_execute($S6);

$S7 = mysqli_prepare($session, "UPDATE utilisateurs SET PrenomU = 'XXXXX' WHERE CodeU = ?");
mysqli_stmt_bind_param($S7, 'i', $usercode);
mysqli_stmt_execute($S7);
*/
session_destroy();
header("Location: ../ACCUEIL/index.php")
?>