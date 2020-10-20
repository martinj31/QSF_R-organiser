<?php

require_once '../../FONCTIONCOMMUNE/Fonctions.php';
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/categorie.bdd.php');

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$categories = new categorieBDD($bdd);

$categorie = new categorie([]);
// créer une nouvelle catégorie
if (isset($_POST['creer'])) {



    $categorie->setNomC($_POST['nomc']);
    $categorie->setDescriptionC($_POST['descriptionc']);
    $categorie->setPhotoC($_POST['photoc']);
    $categorie->setVisibiliteC(1);

    $categories->addCategorie($categorie);

    /* $stmt1 = mysqli_prepare($session, "INSERT INTO categories(NomC,DescriptionC,PhotoC) VALUES(?,?,?)");
      mysqli_stmt_bind_param($stmt1, 'sss', $NomC, $DescriptionC, $PhotoC);
      mysqli_stmt_execute($stmt1); */
}

//Modifier une catégorie existe
if (isset($_POST['modifier'])) {
    

    $categorie->setNomC($_POST['nomc']);
    $categorie->setDescriptionC($_POST['descriptionc']);
    $categorie->setPhotoC($_POST['photoc']);
    $categorie->setCodeC($_POST['modifier']);
    $categories->updateCategorie($categorie);


    /* $stmt2 = mysqli_prepare($session, "UPDATE categories SET NomC = ? WHERE CodeC = ?");
      mysqli_stmt_bind_param($stmt2, 'si', $NomC, $CodeC);
      mysqli_stmt_execute($stmt2);

      $stmt3 = mysqli_prepare($session, "UPDATE categories SET DescriptionC = ? WHERE CodeC = ?");
      mysqli_stmt_bind_param($stmt3, 'si', $DescriptionC, $CodeC);
      mysqli_stmt_execute($stmt3);

      $stmt4 = mysqli_prepare($session, "UPDATE categories SET PhotoC = ? WHERE CodeC = ?");
      mysqli_stmt_bind_param($stmt4, 'si', $PhotoC, $CodeC);
      mysqli_stmt_execute($stmt4); */
}

//Masquer une catégorie
if (isset($_POST['desactiver'])) {
    $CodeC = $_POST['desactiver'];
    $categories->userUpdateCategorieNotVisible($CodeC);
    /* $stmt4 = mysqli_prepare($session, "UPDATE categories SET VisibiliteC = 0 WHERE CodeC = ?");
      mysqli_stmt_bind_param($stmt4, 'i', $CodeC);
      mysqli_stmt_execute($stmt4); */
}

header("Location: Admin.php");
?>