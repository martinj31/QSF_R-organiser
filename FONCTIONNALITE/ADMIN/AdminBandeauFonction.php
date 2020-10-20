<?php

require_once '../../FONCTIONCOMMUNE/Fonctions.php';
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/slide.bdd.php');


$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$slideBDD = new slideBDD($bdd);
$slide1 = $slideBDD->un_slide(1);
$slide2 = $slideBDD->un_slide(2);
$slide3 = $slideBDD->un_slide(3);
$slide4 = $slideBDD->un_slide(4);


if (!empty($_POST['slide1_1'])) {
    $slide1->setTitreS($_POST['slide1_1']);
    $slideBDD->updateSlide($slide1);
}

if (!empty($_POST['slide1_2'])) {
    $slide1->setPhotoS($_POST['slide1_2']);
    $slideBDD->updateSlide($slide1);
}

if (!empty($_POST['slide1_3'])) {
    $slide1->setTextS1($_POST['slide1_3']);
    $slideBDD->updateSlide($slide1);
}

if (!empty($_POST['slide1_4'])) {
    $slide1->setTextS2($_POST['slide1_4']);
    $slideBDD->updateSlide($slide1);
}

if (!empty($_POST['slide2_1'])) {
    $slide2->setTitreS($_POST['slide2_1']);
    $slideBDD->updateSlide($slide2);
}

if (!empty($_POST['slide2_2'])) {
    $slide2->setPhotoS($_POST['slide2_2']);
    $slideBDD->updateSlide($slide2);
}

if (!empty($_POST['slide3_1'])) {
    $slide3->setTitreS($_POST['slide3_1']);
    $slideBDD->updateSlide($slide3);
}

if (!empty($_POST['slide3_2'])) {
    $slide3->setPhotoS($_POST['slide3_2']);
    $slideBDD->updateSlide($slide3);
}

if (!empty($_POST['slide3_3'])) {
    $slide3->setTextS1($_POST['slide3_3']);
    $slideBDD->updateSlide($slide3);
}

if (!empty($_POST['slide4_1'])) {
    $slide4->setTitreS($_POST['slide4_1']);
    $slideBDD->updateSlide($slide4);
}

if (!empty($_POST['slide4_2'])) {
    $slide4->setPhotoS($_POST['slide4_2']);
    $slideBDD->updateSlide($slide4);
}

if (!empty($_POST['slide4_3'])) {
    $slide4->setTextS1($_POST['slide4_3']);
    $slideBDD->updateSlide($slide4);
}

if (!empty($_POST['slide4_4'])) {
    $slide4->setTextS2($_POST['slide4_4']);
    $slideBDD->updateSlide($slide4);
}

if (!empty($_POST['slide4_5'])) {
    $slide4->setTextS3($_POST['slide4_5']);
    $slideBDD->updateSlide($slide4);
}

header("Location: Admin.php");
?>

