<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/projet.bdd.php');

$Titre = $_POST['titre'];   // récupéré les valeurs selon la méthode POST
$Description = $_POST['description'];
$Lieu = $_POST['lieu'];
$DateButoire = $_POST['datebutoire'];
$Type = $_POST['type'];
$Categorie = $_POST['categorie'];
$codeP = $_POST['codeP'];

$projet = new projet([]);
$projet->setCodeP($codeP);
$projet->setCodeC($Categorie);
$projet->setTitreP($Titre);
$projet->setLieuP($Lieu);
$projet->setDescriptionP($Description);
$projet->setDateButoireP($DateButoire);
$projet->setTypeP($Type);


$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$projetBDD = new projetBDD($bdd);


$projetBDD->updateProjet($projet);

header("Location: MonProfil.php");

?>