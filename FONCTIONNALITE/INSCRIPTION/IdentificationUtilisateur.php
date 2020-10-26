<?php

require_once('../../FONCTIONCOMMUNE/Fonctions.php');
require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/utilisateur.bdd.php');

//session_start();
if (isset($_POST['email'])) {
    $Email = $_POST['email'];
    $Password = $_POST["password"];
    $RememberMe = $_POST['remember'];

    // se souvenir de moi, ajouter des cookies
    if ($RememberMe == 1) {
        setcookie('email', $Email, time() + 1296000);
        setcookie('password', $Password, time() + 1296000);
        setcookie('remember', $RememberMe, time() + 1296000);
    } else {
        setcookie('email', $Email, time() - 1296000);
        setcookie('password', $Password, time() - 1296000);
        setcookie('remember', $RememberMe, time() - 1296000);
    }


    $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
    $bdd = $db->connect();
    
    $utilisateurs = new utilisateurBDD($bdd);
    $utilisateur = $utilisateurs->un_userLog($Email);


    

    // déterminer si c'est un compte admin
   /* $sql = "SELECT RoleU from utilisateurs where Email = '{$Email}'";
    $result = mysqli_query($session, $sql);*/

    if (!empty($utilisateur)) {
        
        
            if ($utilisateur->getRoleU() != NULL) {
                /*$stmt = mysqli_prepare($session, "SELECT MotDePasse FROM utilisateurs WHERE Email=?");   // Connecter et vérification de mot de passe
                mysqli_stmt_bind_param($stmt, "s", $Email);
                mysqli_stmt_execute($stmt);

                mysqli_stmt_bind_result($stmt, $good_password);
                mysqli_stmt_fetch($stmt);*/
                
                $good_password = $utilisateur->getMotDePasse();

                if (password_verify($Password, $good_password)) {    // si le mot de passe est bon, ouvert la session 
                    $_SESSION['email'] = $Email;
                    echo $_SESSION['email'];
                    $_SESSION['password'] = $Password;
                    $_SESSION['role'] = 'admin';
                     header("Location:../ADMIN/Admin.php");
                    ?>
                    <?php

                } else {
                    ?>
                    <script type="text/javascript">
                        alert("Mauvais mot de passe ! \n Veuillez réessayer. ");
                        document.location.href = '../INSCRIPTION/Login.php';
                    </script>
                    <?php

                }
            } else {
                $good_password = $utilisateur->getMotDePasse();
                
               /* $stmt = mysqli_prepare($session, "SELECT MotDePasse FROM utilisateurs WHERE Email=?");   // Connecter et vérification de mot de passe
                mysqli_stmt_bind_param($stmt, "s", $Email);
                mysqli_stmt_execute($stmt);

                mysqli_stmt_bind_result($stmt, $good_password);
                mysqli_stmt_fetch($stmt);*/

                if (password_verify($Password, $good_password)) {    // si le mot de passe est bon, ouvert la session 
                    $_SESSION['email'] = $Email;
                    $_SESSION['password'] = $Password;
                    echo $Email;
                    ?>
                    <script>
                        document.location.href = '../ACCUEIL/index.php';
                    </script>
                    <?php

                } else {
                    ?>
                    <script type="text/javascript">
                        alert("Mauvais mot de passe ! \n Veuillez réessayer. ");
                        document.location.href = '../INSCRIPTION/Login.php';
                    </script>
                    <?php

                }
            }
        
    } else {
        ?>
        <script type="text/javascript">
            alert("Cet Email n\'existe pas ! \n Veuillez créer un compte. ");
            document.location.href = '../INSCRIPTION/Login.php';
        </script>
        <?php

    }
}
?>
        