<?php

require_once('../../BDD/utilisateur.bdd.php');
require_once('../../BDD/connexion.bdd.php');

$db = new BDD(); // Utilisation d'une classe pour la connexion à la BDD
$bdd = $db->connect();
$utilisateurs = new utilisateurBDD($bdd);

if (isset($_POST['search'])) {





    $userMail = $utilisateurs->ajoutInscritSearchAutoCompete($_POST['search']);
    $userMailEnd = $utilisateurs->atelierSearchAutoCompete($userMail, $_POST['t']);



    if (!empty($userMailEnd)) {
        echo( '<table class="table table-bordered">
	
					
					<tbody>
						');


        foreach ($userMailEnd as $value) {
            echo( '<tr><td class="searchValue"><a href="../ATELIER/inscriptionAtelier.php?t=' . $_POST['t'] . '&userId=' . $value['Id'] . '&c=yes">' . $value['Email'] . '</a></td></tr>');
        }

        echo( ' 
        </tbody>

        </table>');
    } else {

        echo 'Aucun Resultat';
    }
    exit;
}