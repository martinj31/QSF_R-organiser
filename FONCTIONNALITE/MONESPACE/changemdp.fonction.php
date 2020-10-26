<?php

require_once '../../FONCTIONCOMMUNE/Fonctions.php';
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/utilisateur.bdd.php');

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$user = new utilisateurBDD($bdd);

if (isset($_SESSION['email'])) {
    if ($_POST["newmdp1"] == $_POST["newmdp2"]) {                                 // si les 2 mots de passe saisies sont identiques
        $NewPassword = password_hash($_POST["newmdp1"], PASSWORD_DEFAULT);          //masquer le mdp
    } else {
        ?>
        <script type="text/javascript">
            alert("Veuillez saisir les mêmes mots de passe dans les deux champs !");
            document.location.href = "MonProfil.php";
        </script>
        <?php

    }

    /*$stmt = mysqli_prepare($session, "UPDATE utilisateurs SET MotDePasse = ? WHERE Email = '{$_SESSION['email']}'");    //modifier le mdp à ce nouveau
    mysqli_stmt_bind_param($stmt, 's', $NewPassword);*/

    if ($user->updateMDP($NewPassword, $_SESSION['email'])) {
        ?>
        <script type="text/javascript">
            alert("Votre mot de passe a été changé avec succès !");
            document.location.href = "MonProfil.php";
        </script>
        <?php

    } else {
        ?>
        <script type="text/javascript">
            alert("Désolé, veuillez réessayer");
           // document.location.href = "MonProfil.php";
        </script>    
        <?php

    }
} else {
    header("location:Login.php");
}
?>