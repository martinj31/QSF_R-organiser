<?php
require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/evaluerT.bdd.php');
$DateET = date("yy/m/d");

//ajouter une évaluation talent
$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();
$evaluert = new evaluerT([]);
$evaluerTBDD = new evaluerTBDD($bdd);
$evaluert->setNoteT($_POST["rating"]);
$evaluert->setAvisT($_POST["avis"]);
$evaluert->setCodeU($_POST['codeu']);
$evaluert->setCodeT($_POST['talent']);

$evaluerTBDD->addEvaluerT($evaluerB);
/*$sql = "INSERT INTO evaluert(NoteT,AvisT,DateET,CodeU,CodeT) VALUES({$_POST["rating"]},'{$_POST["avis"]}','{$DateET}',{$_POST['codeu']},{$_POST['talent']})";
mysqli_query ($session, $sql);*/
?>
<script type="text/javascript">
    alert("Merci d'avoir évaluer !");
    document.location.href = '../ACCUEIL/index.php';
</script> 

