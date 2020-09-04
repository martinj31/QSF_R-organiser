<?php

    function afficher_categories() {  //fonction pour l'affichage des catégories
        
        $bdd = connect();  

        $requete = $bdd->query("select NomC, PhotoC, CodeC from categories");
        
        if ($requete == true) {
            while ($resultat = $requete ->fetch()) {         
                        echo ('<div class="card" style="width: 12rem;">');
                        echo ('<div class="card-header">');
                        echo ('<center><input class="card-text" type="checkbox" id="inlineCheckbox" name="'.$resultat["CodeC"].'" value="'.$resultat["CodeC"].'"></center>');
                        echo ('</div>');
                        echo ('<img src="'.$resultat["PhotoC"].'" class="card-img-top" alt="...">');    
                        echo ('<div class="card-body text-center">');
                        echo('<h6 class="card-title">'.$resultat["NomC"].'</h6>');
                        echo ('</div>');
                        echo ('</div>');       
            } 
        } else {
            echo('<h5> Aucune catégorie</h5>');
        }  
    }


?>
