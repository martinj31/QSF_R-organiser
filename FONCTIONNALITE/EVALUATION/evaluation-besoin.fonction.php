<?php
require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/evaluerB.bdd.php');

$DateEB = date("yy/m/d");
$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();
$evaluerBBDD = new evaluerBBDD($bdd);
$evaluerB = new evaluerB([]);
$evaluerB->setNoteB($_POST["rating"]);
$evaluerB->setAvisB($_POST["avis"]);
$evaluerB->setCodeU($_POST['codeu']);
$evaluerB->setCodeB($_POST['besoin']);

$evaluerBBDD->addEvaluerB($evaluerB);
//ajouter une évaluation besoin
/*$sql = "INSERT INTO evaluerb(NoteB,AvisB,DateEB,CodeU,CodeB) VALUES({$_POST["rating"]},'{$_POST["avis"]}','{$DateEB}',{$_POST['codeu']},{$_POST['besoin']})";
mysqli_query ($session, $sql);*/
?>
<script type="text/javascript">
    alert("Merci d'avoir évaluer !");
    document.location.href = '../ACCUEIL/index.php';
</script> 