<?php
        // Connexion à la base de donnée
                
        function connect(){
               try
               {  
                    //$bdd = new PDO("mysql:host=localhost;dbname=talentland;charset=utf8","root","");
                    
                    //1ère méthode
                    $aConfig = parse_ini_file($_SESSION["APPLICATION"].'/config.php');                     
                    $bdd = new PDO("mysql:host=".$aConfig['HOST'].";dbname=".$aConfig['BD'].";charset=utf8",$aConfig['LOGIN'],$aConfig['PASS']);
                    
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                    return $bdd;
                } catch (Exception $ex) {
                    die('Erreur : '.$ex->getMessage());
                }      
        }
        
?>


        
        
        
        

        
        