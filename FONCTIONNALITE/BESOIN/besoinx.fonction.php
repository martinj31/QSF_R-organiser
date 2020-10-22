<?php
    require_once('../../FONCTIONCOMMUNE/Fonctions.php');
    require_once('../../BDD/connexion.bdd.php');
require_once('../../BDD/besoin.bdd.php');


$besoinBDD = new besoinBDD($bdd);
    //rejoindre à un besoin
    if(isset($_GET['c'])){
        
        $besoinBDD->UpdateNombre($_GET['c']);
        $besoinBDD->saisirBesoinEtUser($_SESSION['codeu'], $_GET['c']);
       /*$increment = "update besoins set Nombre = Nombre + 1 where CodeB = {$_GET['c']}";
       mysqli_query ($session, $increment);
       
       $query = "insert into saisir(CodeU, CodeB) values({$_SESSION['codeu']},{$_GET['c']})";
       mysqli_query ($session, $query);*/
    }
 ?>
    <script>
        alert("Vous avez sollicité ce besoin !");
        document.location.href = "Besoin.php";
    </script>


