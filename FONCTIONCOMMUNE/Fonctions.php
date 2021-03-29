<?php



require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/utilisateur.bdd.php');
require_once('../../BDD/projet.bdd.php');
require_once('../PROJET/ProjetCommenceMail.php');
require_once('../../BDD/atelier.bdd.php');
require_once('../ATELIER/AtelierCommenceMail.php');

// 1. Connexion à la base de donnée


 $nomlogin = "bd_qualif_qsf";                    // Ici, nous connectons avec le serveur local, si vous voulez le tester sur d'autre serveur, vous pouvez changer ces 3 variables
  $nompasswd = "mYSQLQSF31";
  $nombase = "bd_qualif_qsf";
  $serveur = "bm124975-001.privatesql";
  $port_bdd = "35171";

/*$nomlogin = "root";                    // Ici, nous connectons avec le serveur local, si vous voulez le tester sur d'autre serveur, vous pouvez changer ces 3 variables
$nompasswd = "";
$nombase = "qsf";
$serveur = "localhost";
//$port_bdd = "35171";*/ 

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();

$utilisateurBDD = new utilisateurBDD($bdd);
$atelierBDD = new atelierBDD($bdd);
$projetBDD = new projetBDD($bdd);

$session = mysqli_connect($serveur, $nomlogin, $nompasswd, $nombase  , $port_bdd );

if ($session == NULL) { // Test de connexion n'est pas réussié
    echo ("<p>Echec de connection</p>");
} else {
    // Sélection de la base de donnée
    if (mysqli_select_db($session, $nombase) == TRUE) {
        //echo ("Connection Réussite</br>");
    } else {
        echo ("Cette base n'existe pas</br>");
    }
}

// 2. Fonction vérification l'existnce d'email       

function is_unique_login($session, $Email) {

    $EndMailUrssaf = "@urssaf.fr";
    $EndMailCpam = "@assurance-maladie.fr";
    $db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
    $bdd = $db->connect();

    $utilisateurBDD = new utilisateurBDD($bdd);

    if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
     
        if (strpos($Email, $EndMailUrssaf) !== false || strpos($Email, $EndMailCpam) !== false) {
            
        } else {
            return false;
        }
    } else {
        return false;
    }

    $user = $utilisateurBDD->un_userLog($Email);

    //!empty($user)
    /* $stmt = mysqli_prepare($session, "SELECT Email from utilisateurs where Email = ?");
      mysqli_stmt_bind_param($stmt, "s", $Email);
      mysqli_stmt_execute($stmt); */
    if (!empty($user)) {
        return False;
    } else {
        return True;
    }
}

//var_dump($_SESSION['email']);
if (!isset($_SESSION['email'])) {

    session_start();
}
// 3. Session utilisateur
// session_start();
// 4. Session actuelle : récuperer le code utilisateur   
if (isset($_SESSION['email'])) {
    $user = $utilisateurBDD->un_userLog($_SESSION['email']);

    /* $sqlr = "select CodeU from utilisateurs WHERE Email = '{$_SESSION['email']}' ";
      $result = mysqli_query($session, $sqlr); */
    if (!empty($user)) {
        $usercode = $user->getCodeU();
    }
}

if (isset($_SESSION['email'])) {
    $user = $utilisateurBDD->un_userLog($_SESSION['email']);
    /* $requete = "select CodeU from utilisateurs WHERE Email = '{$_SESSION['email']}' ";
      $resultat = mysqli_query($session, $requete); */
    if (!empty($user)) {
        $_SESSION['codeu'] = $user->getCodeU();
    }
}

// 5. récupérer le type d'info d'un utilisateur
if (isset($_SESSION['email'])) {
    $user = $utilisateurBDD->un_userLog($_SESSION['email']);
    /* $query = "select TypeU from utilisateurs WHERE Email = '{$_SESSION['email']}' ";
      $result = mysqli_query($session, $query); */
    if (!empty($user)) {
        $_SESSION['type'] = $user->getTypeU();
    }
}

// 6.1 Tester si l'utilisateur est connecté avant saisir un nouveau besoin/talent
function is_login_new_besoin() {
    if (isset($_SESSION['email'])) {
        echo ('<a href="../BESOIN/Creer1Besoin.php"><button type="button" class="btn btn-light">Créer un nouveau besoin</button></a>');
    } else {
        echo ('<a href="../INSCRIPTION/Login.php"><button type="button" class="btn btn-light">Créer un nouveau besoin</button></a>');
    }
}

// 6.2 Tester si l'utilisateur est connecté avant saisir un nouveau besoin/talent
function is_login_new_talent() {
    if (isset($_SESSION['email'])) {
        echo ('<a href="../TALENT/Creer1Talent.php"><button type="button" class="btn btn-light">Créer un nouveau talent</button></a>');
    } else {
        echo ('<a href="../INSCRIPTION/Login.php"><button type="button" class="btn btn-light">Créer un nouveau talent</button></a>');
    }
}

// 6.3 Tester si l'utilisateur est connecté avant saisir un nouveau besoin/talent
function is_login_new_atelier() {
    if (isset($_SESSION['email'])) {
        echo ('<a href="../ATELIER/Creer1Atelier.php"><button type="button" class="btn btn-light">Créer un nouvel atelier</button></a>');
    } else {
        echo ('<a href="../INSCRIPTION/Login.php"><button type="button" class="btn btn-light">Créer un nouveau atelier</button></a>');
    }
}

// 6.3 Tester si l'utilisateur est connecté avant saisir un nouveau besoin/talent
function is_login_new_projet() {
    if (isset($_SESSION['email'])) {
        echo ('<a href="../PROJET/Creer1Projet.php"><button type="button" class="btn btn-light">Créer un nouveau projet</button></a>');
    } else {
        echo ('<a href="../INSCRIPTION/Login.php"><button type="button" class="btn btn-light">Créer un nouveau projet</button></a>');
    }
}

// 6.4 Génerer un mot de passe aléatoire
function generate_password($length = 8) {

    // un chaîne de caractères avec le quel on récupère les élément de mot de passe
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randpwd = '';
    for ($i = 0; $i < $length; $i++) {
        $randpwd .= $str{mt_rand(0, strlen($chars) - 1)};      // prendre au hasard un élément de $chars
        $randpwd .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $randpwd;
}

//atelier commence dans 1 jour
$atelierCommenceTab = $atelierBDD->selectMailAtelierCommence();
if (!empty($atelierCommenceTab)) {

    foreach ($atelierCommenceTab as $value) {

        $userParticipantTab = $utilisateurBDD->saisirParticipantAtelier($value->getCodeA());

        foreach ($userParticipantTab as $value1) {

            commenceMail($value1->getEmail(), $value->getTitreA());
        }

        $userCreateur = $utilisateurBDD->saisirCreateurAtelier($value->getCodeA());
        commenceMail($userCreateur->getEmail(), $value->getTitreA());
    }
}



//projet commence dans 1 jour
$projetCommenceTab = $projetBDD->selectMailProjetCommence();
if (!empty($projetCommenceTab)) {

    foreach ($projetCommenceTab as $value) {

        $userParticipantTab = $utilisateurBDD->saisirParticipantProjet($value->getCodeP());

        foreach ($userParticipantTab as $value1) {

            commenceProjetMail($value1->getEmail(), $value->getTitreP());
        }

        $userCreateur = $utilisateurBDD->saisirCreateurProjet($value->getCodeP());
        commenceProjetMail($userCreateur->getEmail(), $value->getTitreP());
    }
}
?>