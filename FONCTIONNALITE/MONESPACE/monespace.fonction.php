<?php
require_once '../../FONCTIONCOMMUNE/Fonctions.php'; 
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/utilisateur.bdd.php');

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$user = new utilisateurBDD($bdd);

$retype = $_POST['switch-two'];  //modifier le type d'utilisateur dans mon espace via la boutton radio
echo $retype;




/*$stmt = mysqli_prepare($session, 'UPDATE `utilisateurs` SET `TypeU` = ? WHERE `utilisateurs`.`CodeU` = ? ; ');   
mysqli_stmt_bind_param($stmt, "si", $retype, $usercode);*/

if ($user->updateType($retype, $usercode)) {
  header("Location: MonProfil.php");
} 

?>    