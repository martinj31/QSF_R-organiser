<?php
    session_start();
    session_destroy();
    header('location: ../ACCUEIL/index.php');
    exit;
?>
